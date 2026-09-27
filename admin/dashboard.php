<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$s = StatsModel::overview();
$recent = ActivityModel::recent(12);
$pending = ProjectModel::submissionsForAdmin('submitted');

admin_header('Dashboard', 'dashboard');
?>
<div class="grid grid--4">
  <div class="stat"><div class="stat__label"><?= icon('users', 'icon icon--sm') ?> Utilisateurs</div><div class="stat__value" data-count="<?= $s['users'] ?>">0</div><div class="stat__hint">+<?= $s['users_week'] ?> cette semaine · <?= $s['active_week'] ?> actifs</div></div>
  <div class="stat"><div class="stat__label"><?= icon('layers', 'icon icon--sm') ?> Cours disponibles</div><div class="stat__value" data-count="<?= $s['courses'] ?>">0</div><div class="stat__hint"><?= $s['modules'] ?> modules · <?= $s['lessons'] ?> leçons</div></div>
  <div class="stat"><div class="stat__label"><?= icon('check-circle', 'icon icon--sm') ?> Cours terminés</div><div class="stat__value" data-count="<?= $s['courses_completed'] ?>">0</div><div class="stat__hint"><?= $s['lessons_completed'] ?> leçons validées</div></div>
  <div class="stat"><div class="stat__label"><?= icon('code', 'icon icon--sm') ?> Exercices réalisés</div><div class="stat__value" data-count="<?= $s['attempts'] ?>">0</div><div class="stat__hint"><?= $s['exercises'] ?> exercices disponibles</div></div>
  <div class="stat"><div class="stat__label"><?= icon('target', 'icon icon--sm') ?> Taux de réussite exercices</div><div class="stat__value"><span data-count="<?= $s['exercise_rate'] ?>" data-suffix=" %">0</span></div><div class="stat__hint"><?= $s['attempts_ok'] ?> tentatives réussies</div></div>
  <div class="stat"><div class="stat__label"><?= icon('question', 'icon icon--sm') ?> Taux de réussite quiz</div><div class="stat__value"><span data-count="<?= $s['quiz_rate'] ?>" data-suffix=" %">0</span></div><div class="stat__hint"><?= $s['quizzes'] ?> quiz passés</div></div>
  <div class="stat"><div class="stat__label"><?= icon('folder', 'icon icon--sm') ?> Projets soumis</div><div class="stat__value" data-count="<?= $s['submissions'] ?>">0</div><div class="stat__hint"><?= $s['submissions_pending'] ?> en attente de revue</div></div>
  <div class="stat"><div class="stat__label"><?= icon('award', 'icon icon--sm') ?> Badges attribués</div><div class="stat__value" data-count="<?= $s['badges_awarded'] ?>">0</div><div class="stat__hint"><?= $s['certificates'] ?> certificat(s) délivré(s)</div></div>
</div>

<div class="dash-grid" style="margin-top:1.5rem">
  <section class="card span-7">
    <h2 class="card__title"><?= icon('clock') ?> Activité récente</h2>
    <?php if (!$recent): ?><p class="muted">Aucune activité.</p><?php else: ?>
      <ul class="activity-list">
        <?php foreach ($recent as $a): ?>
          <li><span class="activity-list__dot" aria-hidden="true"></span>
            <span><?php if ($a['user_id']): ?><a href="<?= e(url('admin/users.php?view=' . (int) $a['user_id'])) ?>"><?= e($a['first_name'] . ' ' . $a['last_name']) ?></a><?php else: ?>Système<?php endif; ?> — <strong><?= e(ActivityModel::label($a['action'])) ?></strong> <?= e($a['subject']) ?></span>
            <span class="activity-list__time"><?= e(time_ago($a['created_at'])) ?></span></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </section>
  <section class="card span-5">
    <h2 class="card__title"><?= icon('folder') ?> Projets à relire</h2>
    <?php if (!$pending): ?><p class="muted">Aucun projet en attente.</p><?php else: ?>
      <ul class="activity-list">
        <?php foreach (array_slice($pending, 0, 8) as $p): ?>
          <li><span><a href="<?= e(url('admin/projects.php?review=' . (int) $p['id'])) ?>"><?= e($p['project_title']) ?></a> — <?= e($p['first_name'] . ' ' . $p['last_name']) ?></span><span class="activity-list__time"><?= (int) $p['auto_score'] ?> %</span></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <div class="btn-row" style="margin-top:1rem">
      <a class="btn btn--sm" href="<?= e(url('admin/lessons.php?edit=0')) ?>"><?= icon('plus') ?> Nouvelle leçon</a>
      <a class="btn btn--sm" href="<?= e(url('admin/exercises.php?edit=0')) ?>"><?= icon('plus') ?> Nouvel exercice</a>
      <a class="btn btn--sm" href="<?= e(url('admin/statistics.php')) ?>"><?= icon('chart') ?> Statistiques</a>
    </div>
  </section>
</div>
<?php admin_footer(); ?>
