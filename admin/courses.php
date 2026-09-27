<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$categories = CourseModel::categories();
$catOptions = array_column($categories, 'name', 'id');
$errors = [];

if (is_post()) {
    verify_csrf();
    $action = input('action');
    $id = admin_post_id() ?: null;

    if ($action === 'save_course') {
        $v = new Validator($_POST);
        $v->required('title', 'Titre')->max('title', 150, 'Le titre')->required('slug', 'Slug')->slug('slug')
          ->in('category_id', array_keys($catOptions), 'Catégorie')->in('level', [1, 2, 3], 'Niveau')->max('summary', 300, 'Le résumé');
        if (!$v->fails() && CourseModel::slugTaken('courses', $v->value('slug'), (int) $id)) {
            $v->add('slug', 'Ce slug est déjà utilisé.');
        }
        if ($v->fails()) {
            $errors = $v->errors();
        } else {
            CourseModel::save($id, [
                'category_id'  => (int) $v->value('category_id'),
                'title'        => $v->value('title'),
                'slug'         => $v->value('slug'),
                'level'        => (int) $v->value('level'),
                'summary'      => $v->value('summary'),
                'description'  => $v->value('description') ?: null,
                'is_published' => isset($_POST['is_published']) ? 1 : 0,
                'sort_order'   => (int) $v->value('sort_order'),
            ]);
            flash('success', 'Cours enregistré.');
            redirect(url('admin/courses.php'));
        }
    } elseif ($action === 'delete_course' && $id) {
        CourseModel::delete($id);
        flash('success', 'Cours supprimé (ainsi que ses modules et leçons).');
        redirect(url('admin/courses.php'));
    } elseif ($action === 'save_module') {
        $courseIds = array_column(CourseModel::allForAdmin(), 'id');
        $v = new Validator($_POST);
        $v->required('title', 'Titre')->max('title', 150, 'Le titre')->required('slug', 'Slug')->slug('slug')
          ->in('course_id', $courseIds, 'Cours');
        if (!$v->fails() && CourseModel::slugTaken('modules', $v->value('slug'), (int) $id)) {
            $v->add('slug', 'Ce slug est déjà utilisé.');
        }
        if ($v->fails()) {
            $errors = $v->errors();
        } else {
            CourseModel::saveModule($id, [
                'course_id'   => (int) $v->value('course_id'),
                'title'       => $v->value('title'),
                'slug'        => $v->value('slug'),
                'description' => $v->value('description') ?: null,
                'sort_order'  => (int) $v->value('sort_order'),
            ]);
            flash('success', 'Module enregistré.');
            redirect(url('admin/courses.php#modules'));
        }
    } elseif ($action === 'delete_module' && $id) {
        CourseModel::deleteModule($id);
        flash('success', 'Module supprimé.');
        redirect(url('admin/courses.php#modules'));
    }
}

$courses = CourseModel::allForAdmin();
$modules = CourseModel::modulesForAdmin();
$editCourse = isset($_GET['course']) ? (CourseModel::find(query_int('course')) ?? []) : null;
$editModule = isset($_GET['module']) ? (CourseModel::findModule(query_int('module')) ?? []) : null;
// En cas d'erreur de validation, on réaffiche le formulaire avec la saisie
if ($errors && input('action') === 'save_course') {
    $editCourse = $_POST;
} elseif ($errors && input('action') === 'save_module') {
    $editModule = $_POST;
}
$courseOptions = array_column($courses, 'title', 'id');

admin_header('Cours & modules', 'courses');
foreach ($errors as $err): ?><div class="flash flash--error" role="alert"><?= icon('alert') ?><p><?= e($err) ?></p></div><?php endforeach; ?>

<?php if ($editCourse !== null): ?>
  <section class="card" style="margin-bottom:2rem">
    <h2 class="card__title"><?= !empty($editCourse['id']) ? 'Modifier le cours' : 'Nouveau cours' ?></h2>
    <form method="post" class="admin-form">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="save_course">
      <input type="hidden" name="id" value="<?= (int) ($editCourse['id'] ?? 0) ?>">
      <div class="form-row">
        <?= admin_input('title', 'Titre', $editCourse['title'] ?? '', 'text', 'required maxlength="150"') ?>
        <?= admin_input('slug', 'Slug (URL)', $editCourse['slug'] ?? '', 'text', 'required pattern="[a-z0-9-]+" data-slug-from="a-title"') ?>
      </div>
      <div class="form-row">
        <?= admin_select('category_id', 'Catégorie', $catOptions, $editCourse['category_id'] ?? '') ?>
        <?= admin_select('level', 'Niveau', [1 => '1 — Débutant', 2 => '2 — Intermédiaire', 3 => '3 — Avancé'], $editCourse['level'] ?? 1) ?>
        <?= admin_input('sort_order', 'Ordre', $editCourse['sort_order'] ?? 0, 'number') ?>
      </div>
      <?= admin_input('summary', 'Résumé (cartes, SEO)', $editCourse['summary'] ?? '', 'text', 'maxlength="300"') ?>
      <?= admin_textarea('description', 'Description (Markdown)', $editCourse['description'] ?? '') ?>
      <?= admin_checkbox('is_published', 'Publié', (bool) ($editCourse['is_published'] ?? true)) ?>
      <div class="btn-row"><button class="btn btn--primary" type="submit">Enregistrer</button><a class="btn btn--ghost" href="<?= e(url('admin/courses.php')) ?>">Annuler</a></div>
    </form>
  </section>
<?php endif; ?>

<?php if ($editModule !== null): ?>
  <section class="card" style="margin-bottom:2rem">
    <h2 class="card__title"><?= !empty($editModule['id']) ? 'Modifier le module' : 'Nouveau module' ?></h2>
    <form method="post" class="admin-form">
      <?= csrf_field() ?>
      <input type="hidden" name="action" value="save_module">
      <input type="hidden" name="id" value="<?= (int) ($editModule['id'] ?? 0) ?>">
      <div class="form-row">
        <?= admin_input('title', 'Titre', $editModule['title'] ?? '', 'text', 'required maxlength="150"') ?>
        <?= admin_input('slug', 'Slug', $editModule['slug'] ?? '', 'text', 'required pattern="[a-z0-9-]+" data-slug-from="a-title"') ?>
      </div>
      <div class="form-row">
        <?= admin_select('course_id', 'Cours', $courseOptions, $editModule['course_id'] ?? '') ?>
        <?= admin_input('sort_order', 'Ordre', $editModule['sort_order'] ?? 0, 'number') ?>
      </div>
      <?= admin_textarea('description', 'Description', $editModule['description'] ?? '', false, '', 3) ?>
      <div class="btn-row"><button class="btn btn--primary" type="submit">Enregistrer</button><a class="btn btn--ghost" href="<?= e(url('admin/courses.php')) ?>">Annuler</a></div>
    </form>
  </section>
<?php endif; ?>

<div class="admin-toolbar"><h2 style="margin:0">Cours (<?= count($courses) ?>)</h2><a class="btn btn--primary btn--sm" href="?course=0"><?= icon('plus') ?> Ajouter un cours</a></div>
<div class="table-wrap"><table class="table">
  <thead><tr><th>Titre</th><th>Catégorie</th><th>Niveau</th><th>Modules</th><th>Statut</th><th>Actions</th></tr></thead>
  <tbody>
    <?php foreach ($courses as $c): ?>
      <tr>
        <td><a href="<?= e(route('course', $c['slug'])) ?>"><?= e($c['title']) ?></a></td>
        <td><?= e($c['category_name']) ?></td>
        <td><?= e(level_label((int) $c['level'])) ?></td>
        <td><?= (int) $c['module_count'] ?></td>
        <td><?= $c['is_published'] ? '<span class="tag tag--success">Publié</span>' : '<span class="tag">Brouillon</span>' ?></td>
        <td class="actions"><a class="btn btn--sm btn--icon" href="?course=<?= (int) $c['id'] ?>" aria-label="Modifier"><?= icon('edit') ?></a><?= admin_delete_button((int) $c['id'], 'Supprimer ce cours ET tous ses modules et leçons ?', 'delete_course') ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table></div>

<div class="admin-toolbar" id="modules" style="margin-top:2.5rem"><h2 style="margin:0">Modules (<?= count($modules) ?>)</h2><a class="btn btn--primary btn--sm" href="?module=0"><?= icon('plus') ?> Créer un module</a></div>
<div class="table-wrap"><table class="table">
  <thead><tr><th>Module</th><th>Cours</th><th>Leçons</th><th>Ordre</th><th>Actions</th></tr></thead>
  <tbody>
    <?php foreach ($modules as $m): ?>
      <tr>
        <td><?= e($m['title']) ?></td>
        <td><?= e($m['course_title']) ?></td>
        <td><a href="<?= e(url('admin/lessons.php?module=' . (int) $m['id'])) ?>"><?= (int) $m['lesson_count'] ?> leçon(s)</a></td>
        <td><?= (int) $m['sort_order'] ?></td>
        <td class="actions"><a class="btn btn--sm btn--icon" href="?module=<?= (int) $m['id'] ?>" aria-label="Modifier"><?= icon('edit') ?></a><?= admin_delete_button((int) $m['id'], 'Supprimer ce module et ses leçons ?', 'delete_module') ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table></div>
<?php admin_footer(); ?>
