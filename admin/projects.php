<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$catOptions = ['' => 'HTML + CSS'] + array_column(CourseModel::categories(), 'name', 'id');
$errors = [];

if (is_post()) {
    verify_csrf();
    $action = input('action');
    $id = admin_post_id() ?: null;

    if ($action === 'save') {
        $v = new Validator($_POST);
        $v->required('title', 'Titre')->max('title', 150, 'Le titre')->required('slug', 'Slug')->slug('slug')
          ->in('level', [1, 2, 3], 'Niveau')->required('objective', 'Objectif')->required('instructions', 'Consignes')
          ->max('summary', 300, 'Le résumé')->json('validation_rules', 'Règles de vérification');
        if (input('category_id') !== '') {
            $v->in('category_id', array_keys($catOptions), 'Catégorie');
        }
        if (!$v->fails() && CourseModel::slugTaken('projects', $v->value('slug'), (int) $id)) {
            $v->add('slug', 'Ce slug est déjà utilisé.');
        }
        if ($v->fails()) {
            $errors = $v->errors();
        } else {
            $raw = static fn (string $k): string => str_replace("\r\n", "\n", (string) ($_POST[$k] ?? ''));
            ProjectModel::save($id, [
                'category_id'      => input('category_id') !== '' ? (int) input('category_id') : null,
                'title'            => $v->value('title'),
                'slug'             => $v->value('slug'),
                'level'            => (int) $v->value('level'),
                'summary'          => $v->value('summary'),
                'objective'        => $raw('objective'),
                'instructions'     => $raw('instructions'),
                'steps'            => lines_to_json($raw('steps')),
                'resources'        => lines_to_json($raw('resources')),
                'success_criteria' => lines_to_json($raw('success_criteria')),
                'starter_html'     => $raw('starter_html') ?: null,
                'starter_css'      => $raw('starter_css') ?: null,
                'solution_html'    => $raw('solution_html') ?: null,
                'solution_css'     => $raw('solution_css') ?: null,
                'validation_rules' => normalize_json($raw('validation_rules')),
                'bonus_challenge'  => $raw('bonus_challenge') ?: null,
                'is_final'         => isset($_POST['is_final']) ? 1 : 0,
                'sort_order'       => (int) $v->value('sort_order'),
            ]);
            flash('success', 'Projet enregistré.');
            redirect(url('admin/projects.php'));
        }
    } elseif ($action === 'delete' && $id) {
        ProjectModel::delete($id);
        flash('success', 'Projet supprimé.');
        redirect(url('admin/projects.php'));
    } elseif ($action === 'review' && $id) {
        $status = input('status');
        if (in_array($status, ['approved', 'rejected', 'submitted', 'validated'], true)) {
            ProjectModel::review($id, (int) $admin['id'], $status, mb_substr(input('feedback'), 0, 3000));
            flash('success', 'Revue enregistrée.');
        }
        redirect(url('admin/projects.php#soumissions'));
    }
}

$review = query_int('review') ? ProjectModel::findSubmission(query_int('review')) : null;
$edit = isset($_GET['edit']) ? (query_int('edit') ? ProjectModel::find(query_int('edit')) : []) : null;
if ($errors) {
    $edit = $_POST;
}

admin_header($review ? 'Revue de projet' : ($edit !== null ? 'Projet' : 'Projets'), 'projects');

if ($review): ?>
  <p><a href="<?= e(url('admin/projects.php#soumissions')) ?>"><?= icon('arrow-left', 'icon icon--sm') ?> Soumissions</a></p>
  <div class="dash-grid">
    <section class="card span-7">
      <h2 class="card__title"><?= e($review['project_title']) ?> — <?= e($review['first_name'] . ' ' . $review['last_name']) ?></h2>
      <p class="muted">Score automatique : <?= (int) $review['auto_score'] ?> % · Statut : <?= e(ProjectModel::STATUS[$review['status']]) ?> · <?= e(format_date($review['updated_at'], true)) ?></p>
      <?php if ($review['notes']): ?><div class="callout callout--info"><p class="callout__title">Notes de l’apprenant</p><p><?= nl2br(e($review['notes'])) ?></p></div><?php endif; ?>
      <p class="field__label">Rendu (aperçu sandboxé)</p>
      <iframe class="editor__frame" style="border-radius:12px;min-height:420px" sandbox="" title="Aperçu du projet soumis"
        srcdoc="<?= e('<!DOCTYPE html><html><head><meta charset="utf-8"><style>' . str_ireplace('</style', '<\/style', (string) $review['css_code']) . '</style></head><body>' . $review['html_code'] . '</body></html>') ?>"></iframe>
      <div class="code-preview"><?= Markdown::codeBlock((string) $review['html_code'], 'html') ?><?= Markdown::codeBlock((string) $review['css_code'], 'css') ?></div>
    </section>
    <section class="span-5">
      <form method="post" class="admin-form card">
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="review">
        <input type="hidden" name="id" value="<?= (int) $review['id'] ?>">
        <?= admin_select('status', 'Décision', ['approved' => 'Approuver', 'rejected' => 'À retravailler', 'validated' => 'Validé automatiquement', 'submitted' => 'En attente'], $review['status']) ?>
        <?= admin_textarea('feedback', 'Retour pour l’apprenant', $review['feedback'] ?? '', false, '', 8) ?>
        <button class="btn btn--primary" type="submit">Enregistrer la revue</button>
      </form>
    </section>
  </div>
<?php elseif ($edit !== null):
    foreach ($errors as $err): ?><div class="flash flash--error" role="alert"><?= icon('alert') ?><p><?= e($err) ?></p></div><?php endforeach;
    $lines = static fn (string $k) => $errors ? (string) ($edit[$k] ?? '') : json_to_lines($edit[$k] ?? null);
    ?>
  <p><a href="<?= e(url('admin/projects.php')) ?>"><?= icon('arrow-left', 'icon icon--sm') ?> Tous les projets</a></p>
  <form method="post" class="admin-form card">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
    <fieldset><legend>Informations</legend>
      <div class="form-row">
        <?= admin_input('title', 'Titre', $edit['title'] ?? '', 'text', 'required maxlength="150"') ?>
        <?= admin_input('slug', 'Slug', $edit['slug'] ?? '', 'text', 'required pattern="[a-z0-9-]+" data-slug-from="a-title"') ?>
      </div>
      <div class="form-row">
        <?= admin_select('category_id', 'Catégorie', $catOptions, $edit['category_id'] ?? '') ?>
        <?= admin_select('level', 'Niveau', [1 => 'Débutant', 2 => 'Intermédiaire', 3 => 'Avancé'], $edit['level'] ?? 1) ?>
        <?= admin_input('sort_order', 'Ordre', $edit['sort_order'] ?? 0, 'number') ?>
      </div>
      <?= admin_input('summary', 'Résumé', $edit['summary'] ?? '', 'text', 'maxlength="300"') ?>
      <?= admin_checkbox('is_final', 'Projet final (débloque le badge « Projet final terminé »)', (bool) ($edit['is_final'] ?? false)) ?>
    </fieldset>
    <fieldset><legend>Contenu</legend>
      <?= admin_textarea('objective', 'Objectif (Markdown)', $edit['objective'] ?? '', false, '', 3) ?>
      <?= admin_textarea('instructions', 'Consignes (Markdown)', $edit['instructions'] ?? '', false, '', 6) ?>
      <div class="form-row">
        <?= admin_textarea('steps', 'Étapes (une par ligne)', $lines('steps')) ?>
        <?= admin_textarea('success_criteria', 'Critères de réussite (un par ligne)', $lines('success_criteria')) ?>
      </div>
      <?= admin_textarea('resources', 'Ressources (une par ligne, liens Markdown acceptés)', $lines('resources'), false, '', 3) ?>
      <?= admin_textarea('bonus_challenge', 'Challenge supplémentaire (Markdown)', $edit['bonus_challenge'] ?? '', false, '', 3) ?>
    </fieldset>
    <fieldset><legend>Code</legend>
      <div class="form-row">
        <?= admin_textarea('starter_html', 'HTML de départ', $edit['starter_html'] ?? '', true) ?>
        <?= admin_textarea('starter_css', 'CSS de départ', $edit['starter_css'] ?? '', true) ?>
      </div>
      <div class="form-row">
        <?= admin_textarea('solution_html', 'Solution HTML', $edit['solution_html'] ?? '', true, '', 10) ?>
        <?= admin_textarea('solution_css', 'Solution CSS', $edit['solution_css'] ?? '', true, '', 10) ?>
      </div>
      <div class="field">
        <label for="a-validation_rules">Règles de vérification automatique (JSON)</label>
        <textarea class="textarea textarea--code" id="a-validation_rules" name="validation_rules" rows="8" data-json spellcheck="false"><?= e($errors ? (string) ($edit['validation_rules'] ?? '') : (!empty($edit['validation_rules']) ? json_encode(json_decode($edit['validation_rules']), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '')) ?></textarea>
      </div>
    </fieldset>
    <div class="btn-row"><button class="btn btn--primary btn--lg" type="submit">Enregistrer</button></div>
  </form>
<?php else:
    $projects = ProjectModel::all();
    $statusFilter = array_key_exists(input('status'), ProjectModel::STATUS) ? input('status') : '';
    $subs = ProjectModel::submissionsForAdmin($statusFilter);
    ?>
  <div class="admin-toolbar"><h2 style="margin:0">Projets (<?= count($projects) ?>)</h2><a class="btn btn--primary btn--sm" href="?edit=0"><?= icon('plus') ?> Ajouter un projet</a></div>
  <div class="table-wrap"><table class="table">
    <thead><tr><th>Projet</th><th>Niveau</th><th>Final</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach ($projects as $p): ?>
        <tr><td><a href="<?= e(route('project', $p['slug'])) ?>"><?= e($p['title']) ?></a></td><td><?= e(level_label((int) $p['level'])) ?></td><td><?= $p['is_final'] ? 'Oui' : '—' ?></td>
          <td class="actions"><a class="btn btn--sm btn--icon" href="?edit=<?= (int) $p['id'] ?>" aria-label="Modifier"><?= icon('edit') ?></a><?= admin_delete_button((int) $p['id'], 'Supprimer ce projet et toutes ses soumissions ?') ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table></div>

  <div class="admin-toolbar" id="soumissions" style="margin-top:2.5rem">
    <h2 style="margin:0">Soumissions (<?= count($subs) ?>)</h2>
    <nav class="filters" style="margin:0" aria-label="Filtrer les soumissions">
      <a class="chip<?= $statusFilter === '' ? ' is-active' : '' ?>" href="?#soumissions">Toutes</a>
      <?php foreach (ProjectModel::STATUS as $k => $label): ?><a class="chip<?= $statusFilter === $k ? ' is-active' : '' ?>" href="?status=<?= e($k) ?>#soumissions"><?= e($label) ?></a><?php endforeach; ?>
    </nav>
  </div>
  <?php if (!$subs): ?><p class="empty">Aucune soumission.</p><?php else: ?>
  <div class="table-wrap"><table class="table">
    <thead><tr><th>Apprenant</th><th>Projet</th><th>Score auto.</th><th>Statut</th><th>Date</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($subs as $s): ?>
        <tr><td><?= e($s['first_name'] . ' ' . $s['last_name']) ?><br><small class="muted"><?= e($s['email']) ?></small></td><td><?= e($s['project_title']) ?></td><td><?= (int) $s['auto_score'] ?> %</td><td><?= e(ProjectModel::STATUS[$s['status']]) ?></td><td><?= e(format_date($s['updated_at'])) ?></td>
          <td><a class="btn btn--sm" href="?review=<?= (int) $s['id'] ?>">Relire</a></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table></div>
  <?php endif; ?>
<?php endif;
admin_footer();
