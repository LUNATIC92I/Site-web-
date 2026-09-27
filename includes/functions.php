<?php
/**
 * Fonctions utilitaires générales : configuration, URLs, échappement,
 * redirections, messages flash, formatage.
 */

declare(strict_types=1);

/** Lecture de la configuration avec notation pointée : config('app.name'). */
function config(string $key, $default = null)
{
    $value = $GLOBALS['__config'];
    foreach (explode('.', $key) as $part) {
        if (!is_array($value) || !array_key_exists($part, $value)) {
            return $default;
        }
        $value = $value[$part];
    }
    return $value;
}

/** Échappement HTML (protection XSS) — à utiliser pour TOUTE donnée affichée. */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Chemin de base de l'application (ex : "" ou "/html-css-academy"). */
function base_path(): string
{
    static $base = null;
    if ($base !== null) {
        return $base;
    }
    $configured = config('app.base_path');
    if ($configured !== null) {
        return $base = rtrim((string) $configured, '/');
    }
    $docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '') ?: '';
    $root = realpath(ROOT_PATH) ?: ROOT_PATH;
    if ($docRoot !== '' && str_starts_with($root, $docRoot)) {
        return $base = rtrim(str_replace('\\', '/', substr($root, strlen($docRoot))), '/');
    }
    return $base = '';
}

/** URL relative à la racine de l'application. */
function url(string $path = ''): string
{
    return base_path() . '/' . ltrim($path, '/');
}

/** URL absolue (SEO, e-mails). */
function absolute_url(string $path = ''): string
{
    $root = rtrim((string) config('app.url'), '/');
    if ($root === '' && isset($_SERVER['HTTP_HOST'])) {
        $root = (is_https() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
    }
    // APP_URL peut contenir le sous-dossier : on évite de le répéter
    if (base_path() !== '' && str_ends_with($root, base_path())) {
        $root = substr($root, 0, -strlen(base_path()));
    }
    return $root . url($path);
}

/** URL d'un fichier statique avec numéro de version (cache busting). */
function asset(string $path): string
{
    $file = ROOT_PATH . '/assets/' . ltrim($path, '/');
    $version = is_file($file) ? substr((string) filemtime($file), -6) : '1';
    return url('assets/' . ltrim($path, '/')) . '?v=' . $version;
}

/**
 * Routes nommées : URLs propres si la réécriture est activée,
 * sinon URLs classiques vers les fichiers PHP.
 */
function route(string $name, ?string $param = null): string
{
    $pretty = [
        'home'        => '',
        'courses'     => 'cours',
        'course'      => 'cours/%s',
        'lesson'      => 'lecon/%s',
        'path'        => 'parcours',
        'exercises'   => 'exercices',
        'exercise'    => 'exercice/%s',
        'projects'    => 'projets',
        'project'     => 'projet/%s',
        'leaderboard' => 'classement',
        'playground'  => 'editeur',
        'certificate' => 'certificat/%s',
    ];
    $plain = [
        'home'        => '',
        'courses'     => 'courses/index.php',
        'course'      => 'courses/course.php?slug=%s',
        'lesson'      => 'courses/lesson.php?slug=%s',
        'path'        => 'parcours.php',
        'exercises'   => 'exercises/index.php',
        'exercise'    => 'exercises/exercise.php?slug=%s',
        'projects'    => 'projects/index.php',
        'project'     => 'projects/project.php?slug=%s',
        'leaderboard' => 'leaderboard.php',
        'playground'  => 'playground.php',
        'certificate' => 'certificate.php?id=%s',
    ];
    $map = config('app.pretty_urls') ? $pretty : $plain;
    $pattern = $map[$name] ?? $name;
    return url($param !== null ? sprintf($pattern, rawurlencode($param)) : $pattern);
}

function redirect(string $to): never
{
    header('Location: ' . $to, true, 303);
    exit;
}

/** N'autorise que les redirections internes (protection "open redirect"). */
function safe_redirect_target(?string $target, string $fallback): string
{
    $target = (string) $target;
    if ($target === '' || !str_starts_with($target, '/') || str_starts_with($target, '//') || str_contains($target, '\\')
        || preg_match('/[\r\n]/', $target)) {
        return $fallback;
    }
    return $target;
}

function current_path(): string
{
    return (string) ($_SERVER['REQUEST_URI'] ?? '/');
}

function is_post(): bool
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}

function is_https(): bool
{
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
}

function is_api_request(): bool
{
    return str_contains((string) ($_SERVER['SCRIPT_NAME'] ?? ''), '/api/')
        || str_contains((string) ($_SERVER['HTTP_ACCEPT'] ?? ''), 'application/json');
}

function input(string $key, string $default = ''): string
{
    $v = $_POST[$key] ?? $_GET[$key] ?? $default;
    return is_string($v) ? trim($v) : $default;
}

function query_int(string $key, int $default = 0): int
{
    $v = filter_var($_GET[$key] ?? null, FILTER_VALIDATE_INT);
    return $v === false || $v === null ? $default : (int) $v;
}

// ------------------------------------------------------------------ Flash & anciennes valeurs

function flash(string $type, string $message): void
{
    $_SESSION['flash'][] = ['type' => $type, 'message' => $message];
}

function pull_flashes(): array
{
    $f = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $f;
}

function with_old_input(array $data): void
{
    unset($data['password'], $data['password_confirm'], $data['current_password'], $data['_csrf']);
    $_SESSION['old'] = $data;
}

function old(string $key, string $default = ''): string
{
    $v = $_SESSION['old'][$key] ?? $default;
    return is_string($v) ? $v : $default;
}

function clear_old_input(): void
{
    unset($_SESSION['old']);
}

// ------------------------------------------------------------------ Réponses JSON

function json_response(array $data, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

/** Lit le corps JSON d'une requête API. */
function json_input(): array
{
    $raw = file_get_contents('php://input') ?: '';
    if (strlen($raw) > 400000) {
        json_response(['ok' => false, 'error' => 'Requête trop volumineuse.'], 413);
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : [];
}

// ------------------------------------------------------------------ Formatage

function format_date(?string $datetime, bool $withTime = false): string
{
    if (!$datetime) {
        return '—';
    }
    $ts = strtotime($datetime);
    $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
    $out = date('j', $ts) . ' ' . $months[(int) date('n', $ts) - 1] . ' ' . date('Y', $ts);
    return $withTime ? $out . ' à ' . date('H:i', $ts) : $out;
}

function time_ago(?string $datetime): string
{
    if (!$datetime) {
        return 'jamais';
    }
    $diff = time() - strtotime($datetime);
    return match (true) {
        $diff < 60     => 'à l’instant',
        $diff < 3600   => 'il y a ' . intdiv($diff, 60) . ' min',
        $diff < 86400  => 'il y a ' . intdiv($diff, 3600) . ' h',
        $diff < 172800 => 'hier',
        $diff < 2592000 => 'il y a ' . intdiv($diff, 86400) . ' jours',
        default        => 'le ' . format_date($datetime),
    };
}

function level_label(int $level): string
{
    return [1 => 'Débutant', 2 => 'Intermédiaire', 3 => 'Avancé'][$level] ?? 'Débutant';
}

function slugify(string $text): string
{
    $text = function_exists('transliterator_transliterate')
        ? (transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $text) ?: strtolower($text))
        : strtolower((string) iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function json_list(?string $json): array
{
    if ($json === null || $json === '') {
        return [];
    }
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function initials(string $first, string $last): string
{
    return mb_strtoupper(mb_substr($first, 0, 1) . mb_substr($last, 0, 1));
}

/** Rend un fichier "partial" en lui passant des variables. */
function partial(string $__partial, array $__vars = []): void
{
    // Noms de paramètres préfixés : ils ne doivent pas masquer les variables transmises (ex. "name")
    extract($__vars, EXTR_SKIP);
    require ROOT_PATH . '/includes/partials/' . basename($__partial) . '.php';
}

/** Icône SVG du sprite (assets/icons/sprite.svg). */
function icon(string $name, string $class = 'icon'): string
{
    return sprintf(
        '<svg class="%s" aria-hidden="true" focusable="false"><use href="%s#%s"></use></svg>',
        e($class),
        e(url('assets/icons/sprite.svg')),
        e($name)
    );
}

function not_found(): never
{
    http_response_code(404);
    require ROOT_PATH . '/404.php';
    exit;
}

function setting(string $key, string $default = ''): string
{
    return SettingModel::get($key, $default);
}
