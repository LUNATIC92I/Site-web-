<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$user = require_login();
$userId = (int) $user['id'];
$overview = ProgressModel::overview($userId);
$byCourse = ProgressModel::byCourse($userId);
$catalog = CourseModel::catalog();
$completed = ProgressModel::completedLessons($userId);
$stats = ProgressModel::stats($userId);
$projects = ProjectModel::all();
$subs = ProjectModel::submissionsFor($userId);

$pageTitle = 'Ma progression';
$noindex = true;
$activeNav = 'dashboard';
require ROOT_PATH . '/includes/header.php';
?>
<div class="container section--tight">
  <?php partial('dash-nav', ['dashActive' => 'progress']); ?>
  <h1>Ma progression</h1>

  <div class="dash-grid">
    <section class="card span-6">
      <h2 class="card__title">Vue d’ensemble</h2>
      <div class="progress-list">
        <?php partial('progress-bar', ['label' => 'Parcours global', 'percent' => $overview['global']['percent'], 'icon' => 'target', 'detail' => $overview['global']['done'] . '/' . $overview['global']['total']]); ?>
        <?php foreach ($overview['categories'] as $slug => $c): ?>
          <?php partial('progress-bar', ['label' => $c['name'], 'percent' => $c['percent'], 'variant' => $slug, 'icon' => $slug, 'detail' => $c['done'] . '/' . $c['total']]); ?>
        <?php endforeach; ?>
      </div>
    </section>
    <section class="card span-6">
      <h2 class="card__title">Par cours</h2>
      <div class="progress-list">
        <?php foreach ($catalog as $c): $p = $byCourse[(int) $c['id']] ?? ['percent' => 0, 'done' => 0, 'total' => 0]; ?>
          <?php partial('progress-bar', ['label' => $c['title'], 'percent' => $p['percent'], 'variant' => $c['category_slug'], 'detail' => $p['done'] . '/' . $p['total']]); ?>
        <?php endforeach; ?>
      </div>
    </section>

    <section class="card span-12">
      <h2 class="card__title"><?= icon('folder') ?> Projets</h2>
      <div class="table-wrap"><table class="table">
        <thead><tr><th scope="col">Projet</th><th scope="col">Statut</th><th scope="col">Score auto.</th><th scope="col">Mis à jour</th></tr></thead>
        <tbody>
          <?php foreach ($projects as $p): $s = $subs[(int) $p['id']] ?? null; ?>
            <tr>
              <td><a href="<?= e(route('project', $p['slug'])) ?>"><?= e($p['title']) ?></a></td>
              <td><?= $s ? e(ProjectModel::STATUS[$s['status']]) : '<span class="muted">Non commencé</span>' ?></td>
              <td><?= $s ? (int) $s['auto_score'] . ' %' : '—' ?></td>
              <td><?= $s ? e(format_date($s['updated_at'])) : '—' ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table></div>
    </section>

    <section class="card span-12">
      <h2 class="card__title"><?= icon('check-circle') ?> Leçons terminées (<?= count($completed) ?>)</h2>
      <?php if (!$completed): ?>
        <p class="muted">Aucune leçon terminée pour l’instant. <a href="<?= e(route('path')) ?>">Commencez le parcours</a>.</p>
      <?php else: ?>
        <div class="table-wrap"><table class="table">
          <thead><tr><th scope="col">Leçon</th><th scope="col">Langage</th><th scope="col">Meilleur quiz</th><th scope="col">Terminée le</th></tr></thead>
          <tbody>
            <?php foreach ($completed as $l): ?>
              <tr>
                <td><a href="<?= e(route('lesson', $l['slug'])) ?>"><?= e($l['title']) ?></a></td>
                <td><span class="tag tag--<?= e(strtolower($l['category_name'])) ?>"><?= e($l['category_name']) ?></span></td>
                <td><?= $l['best_quiz'] !== null ? (int) $l['best_quiz'] . ' %' : '—' ?></td>
                <td><?= e(format_date($l['completed_at'])) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table></div>
      <?php endif; ?>
      <p class="muted" style="margin-top:1rem">Score moyen aux quiz : <strong><?= $stats['average_score'] !== null ? (int) $stats['average_score'] . ' %' : '—' ?></strong> · Exercices réussis : <strong><?= (int) $stats['exercises_passed'] ?></strong></p>
    </section>
  </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
