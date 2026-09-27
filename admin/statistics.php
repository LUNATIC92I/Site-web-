<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$s = StatsModel::overview();
$daily = StatsModel::daily(30);
$lessons = StatsModel::lessons(200);
$hardest = StatsModel::hardestExercises(10);
$badges = BadgeService::awardCounts();
$maxCompleted = max(1, ...array_map(static fn ($l) => (int) $l['completed'], $lessons ?: [['completed' => 1]]));

/**
 * Graphique en barres HTML/CSS (une seule série par graphique : deux mesures = deux graphiques,
 * jamais de double axe). Chaque barre porte une infobulle native et un libellé accessible.
 */
$chart = static function (string $key, string $title, string $color) use ($daily): void {
    $max = max(1, ...array_column($daily, $key));
    $total = array_sum(array_column($daily, $key));
    ?>
    <figure class="card chart" style="margin:0">
      <figcaption class="btn-row" style="justify-content:space-between">
        <strong><?= e($title) ?></strong><span class="muted"><?= (int) $total ?> sur 30 jours · max <?= (int) $max ?>/jour</span>
      </figcaption>
      <div class="chart__bars" style="--n:<?= count($daily) ?>" role="img" aria-label="<?= e($title) ?> par jour sur 30 jours, total <?= (int) $total ?>">
        <?php foreach ($daily as $d): $v = (int) $d[$key]; ?>
          <div class="chart__col" title="<?= e(format_date($d['date']) . ' : ' . $v) ?>">
            <span class="chart__bar" style="--v:<?= round($v / $max * 100, 1) ?>;background:<?= e($color) ?>"></span>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="chart__axis"><span><?= e(date('d/m', strtotime($daily[0]['date']))) ?></span><span><?= e(date('d/m', strtotime(end($daily)['date']))) ?></span></div>
    </figure>
    <?php
};

admin_header('Statistiques', 'statistics');
?>
<div class="grid grid--4" style="margin-bottom:1.5rem">
  <div class="stat"><div class="stat__label">Apprenants actifs (7 j)</div><div class="stat__value"><?= $s['active_week'] ?></div></div>
  <div class="stat"><div class="stat__label">Leçons validées</div><div class="stat__value"><?= $s['lessons_completed'] ?></div></div>
  <div class="stat"><div class="stat__label">Réussite exercices</div><div class="stat__value"><?= $s['exercise_rate'] ?> %</div></div>
  <div class="stat"><div class="stat__label">Réussite quiz</div><div class="stat__value"><?= $s['quiz_rate'] ?> %</div></div>
</div>

<div class="grid grid--2">
  <?php $chart('signups', 'Inscriptions', '#3d8fe0'); ?>
  <?php $chart('completions', 'Leçons terminées', '#27a578'); ?>
</div>
<details class="card" style="margin-top:1rem">
  <summary>Voir les données sous forme de tableau</summary>
  <div class="table-wrap"><table class="table">
    <thead><tr><th>Date</th><th>Inscriptions</th><th>Leçons terminées</th></tr></thead>
    <tbody><?php foreach (array_reverse($daily) as $d): ?><tr><td><?= e(format_date($d['date'])) ?></td><td><?= (int) $d['signups'] ?></td><td><?= (int) $d['completions'] ?></td></tr><?php endforeach; ?></tbody>
  </table></div>
</details>

<div class="dash-grid" style="margin-top:1.5rem">
  <section class="card span-7">
    <h2 class="card__title">Progression par leçon</h2>
    <div class="table-wrap code-preview" style="max-height:520px"><table class="table">
      <thead><tr><th>Leçon</th><th>Terminée par</th><th>Moyenne quiz</th></tr></thead>
      <tbody>
        <?php foreach ($lessons as $l): ?>
          <tr>
            <td><?= e($l['title']) ?> <small class="muted"><?= e($l['category_name']) ?></small></td>
            <td><div style="display:flex;gap:.6rem;align-items:center"><span class="meter" style="flex:1"><span style="width:<?= round((int) $l['completed'] / $maxCompleted * 100) ?>%"></span></span><span><?= (int) $l['completed'] ?></span></div></td>
            <td><?= $l['quiz_avg'] !== null ? (int) $l['quiz_avg'] . ' %' : '—' ?> <small class="muted">(<?= (int) $l['quiz_attempts'] ?>)</small></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table></div>
  </section>
  <section class="span-5 stack">
    <div class="card">
      <h2 class="card__title">Exercices les plus difficiles</h2>
      <?php if (!$hardest): ?><p class="muted">Pas encore de tentatives.</p><?php else: ?>
        <ul class="activity-list">
          <?php foreach ($hardest as $h): $rate = (int) $h['rate']; ?>
            <li><span style="flex:1"><?= e($h['title']) ?></span>
              <span class="meter <?= $rate < 40 ? 'meter--low' : ($rate < 70 ? 'meter--mid' : '') ?>" style="width:80px"><span style="width:<?= $rate ?>%"></span></span>
              <span class="activity-list__time"><?= $rate ?> % (<?= (int) $h['attempts'] ?>)</span></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
    <div class="card">
      <h2 class="card__title">Badges attribués</h2>
      <ul class="activity-list">
        <?php foreach ($badges as $b): ?><li><span class="badge-medal badge-medal--sm" style="--c:<?= e($b['color']) ?>;width:32px;height:32px"><?= icon($b['icon'], 'icon icon--sm') ?></span><span><?= e($b['name']) ?></span><span class="activity-list__time"><?= (int) $b['awarded'] ?></span></li><?php endforeach; ?>
      </ul>
    </div>
  </section>
</div>
<?php admin_footer(); ?>
