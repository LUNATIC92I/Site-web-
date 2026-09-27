<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$selfId = (int) $admin['id'];

if (is_post()) {
    verify_csrf();
    $id = admin_post_id();
    $target = UserModel::find($id);
    $action = input('action');
    if (!$target) {
        flash('error', 'Utilisateur introuvable.');
    } elseif ($id === $selfId && in_array($action, ['role', 'toggle', 'delete'], true)) {
        flash('error', 'Vous ne pouvez pas modifier le rôle, désactiver ou supprimer votre propre compte ici.');
    } elseif ($action === 'role') {
        UserModel::setRole($id, $target['role'] === 'admin' ? 'student' : 'admin');
        flash('success', 'Rôle mis à jour pour ' . $target['email'] . '.');
    } elseif ($action === 'toggle') {
        UserModel::setActive($id, !$target['is_active']);
        flash('success', $target['is_active'] ? 'Compte désactivé.' : 'Compte réactivé.');
    } elseif ($action === 'delete') {
        UserModel::delete($id);
        flash('success', 'Utilisateur supprimé.');
    }
    redirect(url('admin/users.php') . (isset($_GET['page']) ? '?page=' . query_int('page', 1) : ''));
}

$view = query_int('view');
if ($view) {
    $u = UserModel::find($view);
    if (!$u) {
        not_found();
    }
    $d = StatsModel::userDetail($view);
    admin_header('Progression de ' . $u['first_name'] . ' ' . $u['last_name'], 'users');
    ?>
    <p><a href="<?= e(url('admin/users.php')) ?>"><?= icon('arrow-left', 'icon icon--sm') ?> Retour aux utilisateurs</a></p>
    <div class="dash-grid">
      <section class="card span-5">
        <dl class="kv">
          <dt>E-mail</dt><dd><?= e($u['email']) ?></dd>
          <dt>Rôle</dt><dd><?= e($u['role']) ?></dd>
          <dt>Statut</dt><dd><?= $u['is_active'] ? 'Actif' : 'Désactivé' ?></dd>
          <dt>Inscription</dt><dd><?= e(format_date($u['created_at'])) ?></dd>
          <dt>Dernière activité</dt><dd><?= e(time_ago($u['last_activity_at'])) ?></dd>
          <dt>Exercices réussis</dt><dd><?= (int) $d['stats']['exercises_passed'] ?> (<?= (int) $d['stats']['exercise_attempts'] ?> tentatives)</dd>
          <dt>Quiz réussis</dt><dd><?= (int) $d['stats']['quizzes_passed'] ?></dd>
          <dt>Score moyen</dt><dd><?= $d['stats']['average_score'] !== null ? (int) $d['stats']['average_score'] . ' %' : '—' ?></dd>
        </dl>
      </section>
      <section class="card span-7">
        <div class="progress-list">
          <?php partial('progress-bar', ['label' => 'Global', 'percent' => $d['overview']['global']['percent'], 'detail' => $d['overview']['global']['done'] . '/' . $d['overview']['global']['total']]); ?>
          <?php foreach ($d['overview']['categories'] as $slug => $c): ?>
            <?php partial('progress-bar', ['label' => $c['name'], 'percent' => $c['percent'], 'variant' => $slug, 'detail' => $c['done'] . '/' . $c['total']]); ?>
          <?php endforeach; ?>
        </div>
        <div class="badge-row" style="margin-top:1rem">
          <?php foreach ($d['badges'] as $b): ?><span class="badge-medal badge-medal--sm" style="--c:<?= e($b['color']) ?>" title="<?= e($b['name']) ?>"><?= icon($b['icon']) ?></span><?php endforeach; ?>
        </div>
      </section>
      <section class="card span-6">
        <h2 class="card__title">Leçons terminées (<?= count($d['lessons']) ?>)</h2>
        <div class="table-wrap"><table class="table"><thead><tr><th>Leçon</th><th>Quiz</th><th>Date</th></tr></thead><tbody>
          <?php foreach ($d['lessons'] as $l): ?><tr><td><?= e($l['title']) ?></td><td><?= $l['best_quiz'] !== null ? (int) $l['best_quiz'] . ' %' : '—' ?></td><td><?= e(format_date($l['completed_at'])) ?></td></tr><?php endforeach; ?>
        </tbody></table></div>
      </section>
      <section class="card span-6">
        <h2 class="card__title">Projets</h2>
        <?php if (!$d['projects']): ?><p class="muted">Aucun projet soumis.</p><?php else: ?>
          <ul class="activity-list"><?php foreach ($d['projects'] as $p): ?><li><span><?= e($p['title']) ?> — <?= e(ProjectModel::STATUS[$p['status']]) ?></span><span class="activity-list__time"><?= (int) $p['auto_score'] ?> %</span></li><?php endforeach; ?></ul>
        <?php endif; ?>
        <h2 class="card__title" style="margin-top:1.5rem">Activité</h2>
        <ul class="activity-list"><?php foreach ($d['activity'] as $a): ?><li><span><strong><?= e(ActivityModel::label($a['action'])) ?></strong> <?= e($a['subject']) ?></span><span class="activity-list__time"><?= e(time_ago($a['created_at'])) ?></span></li><?php endforeach; ?></ul>
      </section>
    </div>
    <?php
    admin_footer();
    exit;
}

$search = mb_substr(input('q'), 0, 100);
$page = max(1, query_int('page', 1));
$list = UserModel::paginate($search, $page);

admin_header('Utilisateurs', 'users');
?>
<div class="admin-toolbar">
  <form method="get" class="btn-row" role="search">
    <label class="sr-only" for="q">Rechercher un utilisateur</label>
    <input class="input" type="search" id="q" name="q" value="<?= e($search) ?>" placeholder="Nom ou e-mail" style="max-width:280px">
    <button class="btn" type="submit"><?= icon('search') ?> Rechercher</button>
  </form>
  <span class="muted"><?= (int) $list['total'] ?> utilisateur(s)</span>
</div>
<div class="table-wrap">
  <table class="table">
    <thead><tr><th scope="col">Nom</th><th scope="col">E-mail</th><th scope="col">Rôle</th><th scope="col">Leçons</th><th scope="col">Inscription</th><th scope="col">Activité</th><th scope="col">Actions</th></tr></thead>
    <tbody>
      <?php foreach ($list['rows'] as $u): $isSelf = (int) $u['id'] === $selfId; ?>
        <tr>
          <td><a href="<?= e(url('admin/users.php?view=' . (int) $u['id'])) ?>"><?= e($u['first_name'] . ' ' . $u['last_name']) ?></a><?= $u['is_active'] ? '' : ' <span class="tag tag--danger">désactivé</span>' ?></td>
          <td><?= e($u['email']) ?></td>
          <td><span class="tag<?= $u['role'] === 'admin' ? ' tag--warning' : '' ?>"><?= e($u['role'] === 'admin' ? 'Admin' : 'Apprenant') ?></span></td>
          <td><?= (int) $u['lessons_done'] ?></td>
          <td><?= e(format_date($u['created_at'])) ?></td>
          <td><?= e(time_ago($u['last_activity_at'])) ?></td>
          <td class="actions">
            <a class="btn btn--sm btn--icon" href="<?= e(url('admin/users.php?view=' . (int) $u['id'])) ?>" aria-label="Voir la progression"><?= icon('chart') ?></a>
            <?php if (!$isSelf): ?>
              <form method="post" class="inline-form"><?= csrf_field() ?><input type="hidden" name="action" value="role"><input type="hidden" name="id" value="<?= (int) $u['id'] ?>"><button class="btn btn--sm" type="submit"><?= $u['role'] === 'admin' ? 'Retirer admin' : 'Rendre admin' ?></button></form>
              <form method="post" class="inline-form"><?= csrf_field() ?><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= (int) $u['id'] ?>"><button class="btn btn--sm" type="submit"><?= $u['is_active'] ? 'Désactiver' : 'Réactiver' ?></button></form>
              <?= admin_delete_button((int) $u['id'], 'Supprimer définitivement ce compte et toute sa progression ?') ?>
            <?php else: ?><span class="muted">(vous)</span><?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php if ($list['pages'] > 1): ?>
  <nav class="pagination" aria-label="Pagination">
    <?php for ($p = 1; $p <= $list['pages']; $p++): ?>
      <a class="chip<?= $p === $page ? ' is-active' : '' ?>" href="?<?= e(http_build_query(['q' => $search, 'page' => $p])) ?>"<?= $p === $page ? ' aria-current="page"' : '' ?>><?= $p ?></a>
    <?php endfor; ?>
  </nav>
<?php endif; ?>
<?php admin_footer(); ?>
