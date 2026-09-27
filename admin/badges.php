<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$icons = ['flag', 'star', 'code', 'zap', 'html', 'css', 'award', 'crown', 'flex', 'grid', 'devices', 'rocket', 'folder', 'trophy', 'target', 'flame', 'certificate', 'sparkle'];
$errors = [];

if (is_post()) {
    verify_csrf();
    $action = input('action');
    $id = admin_post_id() ?: null;
    if ($action === 'save') {
        $v = new Validator($_POST);
        $v->required('name', 'Nom')->max('name', 100, 'Le nom')->required('code', 'Code')->slug('code')
          ->required('description', 'Description')->max('description', 255, 'La description')
          ->in('criteria_type', array_keys(BadgeService::CRITERIA), 'Critère')->in('icon', $icons, 'Icône')
          ->required('criteria_value', 'Valeur du critère');
        if (!preg_match('/^#[0-9a-fA-F]{6}$/', input('color'))) {
            $v->add('color', 'Couleur invalide (format #RRGGBB).');
        }
        if (!$v->fails() && CourseModel::slugTaken('badges', $v->value('code'), (int) $id)) {
            $v->add('code', 'Ce code est déjà utilisé.');
        }
        if ($v->fails()) {
            $errors = $v->errors();
        } else {
            BadgeService::save($id, [
                'code'           => $v->value('code'),
                'name'           => $v->value('name'),
                'description'    => $v->value('description'),
                'icon'           => $v->value('icon'),
                'color'          => strtolower(input('color')),
                'criteria_type'  => $v->value('criteria_type'),
                'criteria_value' => $v->value('criteria_value'),
                'sort_order'     => (int) $v->value('sort_order'),
            ]);
            flash('success', 'Badge enregistré. Il sera attribué automatiquement lors de la prochaine activité des apprenants.');
            redirect(url('admin/badges.php'));
        }
    } elseif ($action === 'delete' && $id) {
        BadgeService::delete($id);
        flash('success', 'Badge supprimé.');
        redirect(url('admin/badges.php'));
    }
}

$badges = BadgeService::awardCounts();
$edit = isset($_GET['edit']) ? (query_int('edit') ? BadgeService::find(query_int('edit')) : []) : null;
if ($errors) {
    $edit = $_POST;
}

admin_header('Badges', 'badges');
foreach ($errors as $err): ?><div class="flash flash--error" role="alert"><?= icon('alert') ?><p><?= e($err) ?></p></div><?php endforeach; ?>

<?php if ($edit !== null): ?>
  <form method="post" class="admin-form card" style="margin-bottom:2rem">
    <h2 class="card__title"><?= !empty($edit['id']) ? 'Modifier le badge' : 'Nouveau badge' ?></h2>
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
    <div class="form-row">
      <?= admin_input('name', 'Nom', $edit['name'] ?? '', 'text', 'required maxlength="100"') ?>
      <?= admin_input('code', 'Code unique', $edit['code'] ?? '', 'text', 'required pattern="[a-z0-9-]+" data-slug-from="a-name"') ?>
    </div>
    <?= admin_input('description', 'Description', $edit['description'] ?? '', 'text', 'required maxlength="255"') ?>
    <div class="form-row">
      <?= admin_select('icon', 'Icône', array_combine($icons, $icons), $edit['icon'] ?? 'star') ?>
      <?= admin_input('color', 'Couleur', $edit['color'] ?? '#6ee7b7', 'color') ?>
      <?= admin_input('sort_order', 'Ordre', $edit['sort_order'] ?? 0, 'number') ?>
    </div>
    <div class="form-row">
      <?= admin_select('criteria_type', 'Critère d’attribution', BadgeService::CRITERIA, $edit['criteria_type'] ?? 'lessons_completed') ?>
      <?= admin_input('criteria_value', 'Valeur', $edit['criteria_value'] ?? '1', 'text', 'required', 'Nombre, slug de cours ou slug(s) de module selon le critère.') ?>
    </div>
    <div class="btn-row"><button class="btn btn--primary" type="submit">Enregistrer</button><a class="btn btn--ghost" href="<?= e(url('admin/badges.php')) ?>">Annuler</a></div>
  </form>
<?php endif; ?>

<div class="admin-toolbar"><span class="muted"><?= count($badges) ?> badges</span><a class="btn btn--primary btn--sm" href="?edit=0"><?= icon('plus') ?> Créer un badge</a></div>
<div class="table-wrap"><table class="table">
  <thead><tr><th>Badge</th><th>Critère</th><th>Attribué</th><th>Actions</th></tr></thead>
  <tbody>
    <?php foreach ($badges as $b): ?>
      <tr>
        <td style="display:flex;gap:.75rem;align-items:center"><span class="badge-medal badge-medal--sm" style="--c:<?= e($b['color']) ?>"><?= icon($b['icon']) ?></span><span><strong><?= e($b['name']) ?></strong><br><small class="muted"><?= e($b['description']) ?></small></span></td>
        <td><?= e(BadgeService::CRITERIA[$b['criteria_type']] ?? $b['criteria_type']) ?> : <code><?= e($b['criteria_value']) ?></code></td>
        <td><?= (int) $b['awarded'] ?> fois</td>
        <td class="actions"><a class="btn btn--sm btn--icon" href="?edit=<?= (int) $b['id'] ?>" aria-label="Modifier"><?= icon('edit') ?></a><?= admin_delete_button((int) $b['id'], 'Supprimer ce badge (et le retirer à tous les apprenants) ?') ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table></div>
<?php admin_footer(); ?>
