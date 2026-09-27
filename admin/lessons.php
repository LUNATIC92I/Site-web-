<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$moduleOptions = [];
foreach (CourseModel::modulesForAdmin() as $m) {
    $moduleOptions[$m['id']] = $m['course_title'] . ' › ' . $m['title'];
}
$errors = [];

if (is_post()) {
    verify_csrf();
    $action = input('action');
    $id = admin_post_id() ?: null;

    if ($action === 'save') {
        $v = new Validator($_POST);
        $v->required('title', 'Titre')->max('title', 150, 'Le titre')->required('slug', 'Slug')->slug('slug')
          ->in('module_id', array_keys($moduleOptions), 'Module')
          ->required('introduction', 'Introduction')->required('theory', 'Explication théorique');
        if (!$v->fails() && CourseModel::slugTaken('lessons', $v->value('slug'), (int) $id)) {
            $v->add('slug', 'Ce slug est déjà utilisé.');
        }
        if ($v->fails()) {
            $errors = $v->errors();
        } else {
            $raw = static fn (string $k): string => str_replace("\r\n", "\n", (string) ($_POST[$k] ?? ''));
            $id = LessonModel::save($id, [
                'module_id'        => (int) $v->value('module_id'),
                'title'            => $v->value('title'),
                'slug'             => $v->value('slug'),
                'duration_minutes' => max(1, (int) $v->value('duration_minutes')),
                'introduction'     => $raw('introduction'),
                'objectives'       => lines_to_json($raw('objectives')),
                'prerequisites'    => lines_to_json($raw('prerequisites')),
                'theory'           => $raw('theory'),
                'syntax_code'      => $raw('syntax_code') ?: null,
                'simple_html'      => $raw('simple_html') ?: null,
                'simple_css'       => $raw('simple_css') ?: null,
                'example_html'     => $raw('example_html') ?: null,
                'example_css'      => $raw('example_css') ?: null,
                'line_by_line'     => pairs_to_json($raw('line_by_line')),
                'reference_items'  => pairs_to_json($raw('reference_items')),
                'common_mistakes'  => lines_to_json($raw('common_mistakes')),
                'best_practices'   => lines_to_json($raw('best_practices')),
                'practical'        => $raw('practical') ?: null,
                'summary_points'   => lines_to_json($raw('summary_points')),
                'challenge'        => $raw('challenge') ?: null,
                'is_published'     => isset($_POST['is_published']) ? 1 : 0,
                'sort_order'       => (int) $v->value('sort_order'),
            ]);
            flash('success', 'Leçon enregistrée.');
            redirect(url('admin/lessons.php?edit=' . $id));
        }
    } elseif ($action === 'delete' && $id) {
        LessonModel::delete($id);
        flash('success', 'Leçon supprimée.');
        redirect(url('admin/lessons.php'));
    }
}

$edit = isset($_GET['edit']) ? (query_int('edit') ? LessonModel::find(query_int('edit')) : []) : null;
if ($errors) {
    $edit = $_POST;
}

admin_header($edit !== null ? (!empty($edit['id']) ? 'Modifier la leçon' : 'Nouvelle leçon') : 'Leçons', 'lessons');

if ($edit !== null):
    // En cas d'erreur, les champs "liste" sont déjà au format texte
    $asLines = static fn (string $k) => $errors ? (string) ($edit[$k] ?? '') : json_to_lines($edit[$k] ?? null);
    $asPairs = static fn (string $k) => $errors ? (string) ($edit[$k] ?? '') : json_to_pairs($edit[$k] ?? null);
    foreach ($errors as $err): ?><div class="flash flash--error" role="alert"><?= icon('alert') ?><p><?= e($err) ?></p></div><?php endforeach; ?>
  <p><a href="<?= e(url('admin/lessons.php')) ?>"><?= icon('arrow-left', 'icon icon--sm') ?> Toutes les leçons</a>
    <?php if (!empty($edit['id']) && !empty($edit['slug'])): ?> · <a href="<?= e(route('lesson', $edit['slug'])) ?>">Voir la leçon</a> · <a href="<?= e(url('admin/quizzes.php?lesson=' . (int) $edit['id'])) ?>">Gérer le quiz</a> · <a href="<?= e(url('admin/exercises.php?edit=0&lesson=' . (int) $edit['id'])) ?>">Ajouter un exercice</a><?php endif; ?></p>
  <form method="post" class="admin-form card">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
    <fieldset><legend>Informations</legend>
      <div class="form-row">
        <?= admin_input('title', 'Titre', $edit['title'] ?? '', 'text', 'required maxlength="150"') ?>
        <?= admin_input('slug', 'Slug (URL)', $edit['slug'] ?? '', 'text', 'required pattern="[a-z0-9-]+" data-slug-from="a-title"') ?>
      </div>
      <div class="form-row">
        <?= admin_select('module_id', 'Module', $moduleOptions, $edit['module_id'] ?? query_int('module')) ?>
        <?= admin_input('duration_minutes', 'Durée (minutes)', $edit['duration_minutes'] ?? 10, 'number', 'min="1" max="300"') ?>
        <?= admin_input('sort_order', 'Ordre', $edit['sort_order'] ?? 0, 'number') ?>
      </div>
      <?= admin_checkbox('is_published', 'Publiée', (bool) ($edit['is_published'] ?? true)) ?>
    </fieldset>
    <fieldset><legend>1–3. Introduction, objectifs, prérequis</legend>
      <?= admin_textarea('introduction', 'Introduction (Markdown)', $edit['introduction'] ?? '', false, '', 4) ?>
      <div class="form-row">
        <?= admin_textarea('objectives', 'Objectifs (un par ligne)', $asLines('objectives'), false, '', 4) ?>
        <?= admin_textarea('prerequisites', 'Prérequis (un par ligne)', $asLines('prerequisites'), false, '', 4) ?>
      </div>
    </fieldset>
    <fieldset><legend>4. Explication théorique</legend>
      <?= admin_textarea('theory', 'Contenu (Markdown : ## titre, **gras**, `code`, listes, ```html blocs```, > [!TIP] encadrés, tableaux)', $edit['theory'] ?? '', true, '', 16) ?>
    </fieldset>
    <fieldset><legend>5–6. Exemples</legend>
      <?= admin_textarea('syntax_code', 'Syntaxe', $edit['syntax_code'] ?? '', true, '', 3) ?>
      <div class="form-row">
        <?= admin_textarea('simple_html', 'Exemple simple — HTML', $edit['simple_html'] ?? '', true) ?>
        <?= admin_textarea('simple_css', 'Exemple simple — CSS', $edit['simple_css'] ?? '', true) ?>
      </div>
      <div class="form-row">
        <?= admin_textarea('example_html', 'Exemple détaillé — HTML', $edit['example_html'] ?? '', true, '', 10) ?>
        <?= admin_textarea('example_css', 'Exemple détaillé — CSS', $edit['example_css'] ?? '', true, '', 10) ?>
      </div>
    </fieldset>
    <fieldset><legend>7–8. Explications détaillées</legend>
      <?= admin_textarea('line_by_line', 'Ligne par ligne (une ligne : code ||| explication)', $asPairs('line_by_line'), true, '', 8) ?>
      <?= admin_textarea('reference_items', 'Balises / propriétés (une ligne : élément ||| description)', $asPairs('reference_items'), true, '', 6) ?>
    </fieldset>
    <fieldset><legend>9–11. Erreurs, bonnes pratiques, exemple pratique</legend>
      <div class="form-row">
        <?= admin_textarea('common_mistakes', 'Erreurs fréquentes (une par ligne)', $asLines('common_mistakes')) ?>
        <?= admin_textarea('best_practices', 'Bonnes pratiques (une par ligne)', $asLines('best_practices')) ?>
      </div>
      <?= admin_textarea('practical', 'Exemple pratique — dans un vrai projet (Markdown)', $edit['practical'] ?? '', true) ?>
    </fieldset>
    <fieldset><legend>15–16. Résumé et challenge</legend>
      <?= admin_textarea('summary_points', 'Points à retenir (un par ligne)', $asLines('summary_points')) ?>
      <?= admin_textarea('challenge', 'Challenge final (Markdown)', $edit['challenge'] ?? '', false, '', 4) ?>
    </fieldset>
    <div class="btn-row"><button class="btn btn--primary btn--lg" type="submit"><?= icon('check') ?> Enregistrer la leçon</button></div>
  </form>
<?php else:
    $moduleFilter = query_int('module');
    $lessons = LessonModel::allForAdmin($moduleFilter ?: null);
    ?>
  <div class="admin-toolbar">
    <form method="get" class="btn-row">
      <label class="sr-only" for="module">Filtrer par module</label>
      <select class="select" id="module" name="module" style="max-width:360px">
        <option value="0">Tous les modules</option>
        <?php foreach ($moduleOptions as $mid => $label): ?><option value="<?= (int) $mid ?>"<?= $mid === $moduleFilter ? ' selected' : '' ?>><?= e($label) ?></option><?php endforeach; ?>
      </select>
      <button class="btn" type="submit">Filtrer</button>
    </form>
    <a class="btn btn--primary btn--sm" href="?edit=0<?= $moduleFilter ? '&module=' . $moduleFilter : '' ?>"><?= icon('plus') ?> Créer une leçon</a>
  </div>
  <div class="table-wrap"><table class="table">
    <thead><tr><th>Leçon</th><th>Module</th><th>Quiz</th><th>Exercices</th><th>Statut</th><th>Modifiée</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach ($lessons as $l): ?>
        <tr>
          <td><a href="<?= e(route('lesson', $l['slug'])) ?>"><?= e($l['title']) ?></a></td>
          <td><?= e($l['module_title']) ?></td>
          <td><a href="<?= e(url('admin/quizzes.php?lesson=' . (int) $l['id'])) ?>"><?= (int) $l['question_count'] ?> Q</a></td>
          <td><?= (int) $l['exercise_count'] ?></td>
          <td><?= $l['is_published'] ? '<span class="tag tag--success">Publiée</span>' : '<span class="tag">Brouillon</span>' ?></td>
          <td><?= e(format_date($l['updated_at'])) ?></td>
          <td class="actions"><a class="btn btn--sm btn--icon" href="?edit=<?= (int) $l['id'] ?>" aria-label="Modifier"><?= icon('edit') ?></a><?= admin_delete_button((int) $l['id'], 'Supprimer cette leçon, son quiz et la progression associée ?') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table></div>
<?php endif;
admin_footer();
