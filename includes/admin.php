<?php
/**
 * Outils communs à l'espace d'administration : garde d'accès, champs de
 * formulaire et conversion des listes (une ligne = un élément) <-> JSON.
 */

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

$admin = require_admin();

function admin_header(string $title, string $active): void
{
    $GLOBALS['pageTitle'] = $title . ' — Administration';
    $GLOBALS['adminActive'] = $active;
    extract(['pageTitle' => $GLOBALS['pageTitle'], 'noindex' => true, 'bodyClass' => 'admin', 'activeNav' => 'admin', 'pageScripts' => ['admin.js']]);
    require ROOT_PATH . '/includes/header.php';
    $items = [
        'dashboard'  => ['Dashboard', 'dashboard'],
        'users'      => ['Utilisateurs', 'users'],
        'courses'    => ['Cours & modules', 'layers'],
        'lessons'    => ['Leçons', 'book'],
        'exercises'  => ['Exercices', 'code'],
        'quizzes'    => ['Quiz', 'question'],
        'projects'   => ['Projets', 'folder'],
        'badges'     => ['Badges', 'award'],
        'statistics' => ['Statistiques', 'chart'],
        'settings'   => ['Paramètres', 'settings'],
    ];
    echo '<div class="admin-shell container"><aside class="admin-side" aria-label="Menu d’administration"><p class="admin-side__title">Administration</p><nav><ul>';
    foreach ($items as $key => [$label, $ico]) {
        $current = $key === $active ? ' aria-current="page" class="is-active"' : '';
        echo '<li><a href="' . e(url("admin/$key.php")) . '"' . $current . '>' . icon($ico) . '<span>' . e($label) . '</span></a></li>';
    }
    echo '</ul></nav></aside><div class="admin-main"><h1 class="admin-title">' . e($title) . '</h1>';
}

function admin_footer(): void
{
    echo '</div></div>';
    require ROOT_PATH . '/includes/footer.php';
}

/** Champ texte / nombre. $attrs est écrit par le développeur (jamais une donnée utilisateur). */
function admin_input(string $name, string $label, $value = '', string $type = 'text', string $attrs = '', string $hint = ''): string
{
    $id = 'a-' . $name;
    return '<div class="field"><label for="' . e($id) . '">' . e($label) . '</label>'
        . '<input class="input" type="' . e($type) . '" id="' . e($id) . '" name="' . e($name) . '" value="' . e((string) $value) . '" ' . $attrs . '>'
        . ($hint ? '<p class="field__hint">' . e($hint) . '</p>' : '') . '</div>';
}

function admin_textarea(string $name, string $label, $value = '', bool $code = false, string $hint = '', int $rows = 6): string
{
    $id = 'a-' . $name;
    return '<div class="field"><label for="' . e($id) . '">' . e($label) . '</label>'
        . '<textarea class="textarea' . ($code ? ' textarea--code' : '') . '" id="' . e($id) . '" name="' . e($name) . '" rows="' . $rows . '" spellcheck="' . ($code ? 'false' : 'true') . '">' . e((string) $value) . '</textarea>'
        . ($hint ? '<p class="field__hint">' . e($hint) . '</p>' : '') . '</div>';
}

function admin_select(string $name, string $label, array $options, $selected, string $attrs = ''): string
{
    $id = 'a-' . $name;
    $html = '<div class="field"><label for="' . e($id) . '">' . e($label) . '</label><select class="select" id="' . e($id) . '" name="' . e($name) . '" ' . $attrs . '>';
    foreach ($options as $value => $text) {
        $html .= '<option value="' . e((string) $value) . '"' . ((string) $value === (string) $selected ? ' selected' : '') . '>' . e((string) $text) . '</option>';
    }
    return $html . '</select></div>';
}

function admin_checkbox(string $name, string $label, bool $checked): string
{
    return '<label class="checkbox"><input type="checkbox" name="' . e($name) . '" value="1"' . ($checked ? ' checked' : '') . '> ' . e($label) . '</label>';
}

/** Bouton de suppression (formulaire POST + CSRF + confirmation). */
function admin_delete_button(int $id, string $confirm, string $action = 'delete'): string
{
    return '<form method="post" class="inline-form" data-confirm="' . e($confirm) . '">' . csrf_field()
        . '<input type="hidden" name="action" value="' . e($action) . '"><input type="hidden" name="id" value="' . $id . '">'
        . '<button class="btn btn--danger btn--sm btn--icon" type="submit" aria-label="Supprimer">' . icon('trash') . '</button></form>';
}

/** "une ligne = un élément" -> JSON */
function lines_to_json(string $text): ?string
{
    $items = array_values(array_filter(array_map('trim', preg_split('/\R/', $text)), 'strlen'));
    return $items ? json_encode($items, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;
}

function json_to_lines(?string $json): string
{
    return implode("\n", array_map('strval', json_list($json)));
}

/** "gauche ||| droite" par ligne -> JSON [[gauche, droite], ...] */
function pairs_to_json(string $text): ?string
{
    $pairs = [];
    foreach (preg_split('/\R/', $text) as $line) {
        if (trim($line) === '') {
            continue;
        }
        [$a, $b] = array_map('trim', explode('|||', $line, 2)) + ['', ''];
        $pairs[] = [$a, $b];
    }
    return $pairs ? json_encode($pairs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;
}

function json_to_pairs(?string $json): string
{
    return implode("\n", array_map(static fn ($p) => ($p[0] ?? '') . ' ||| ' . ($p[1] ?? ''), json_list($json)));
}

/** Normalise une valeur JSON saisie (ou null si vide). */
function normalize_json(string $text): ?string
{
    $text = trim($text);
    if ($text === '') {
        return null;
    }
    return json_encode(json_decode($text, true), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}

function admin_post_id(): int
{
    return (int) ($_POST['id'] ?? 0);
}
