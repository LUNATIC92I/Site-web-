<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$user = require_login();
$userId = (int) $user['id'];

// Délivrance du certificat
if (is_post() && input('action') === 'certificate') {
    verify_csrf();
    $cert = CertificateModel::issue($user);
    if ($cert) {
        flash('success', 'Félicitations ! Votre certificat « Parcours HTML & CSS terminé » a été généré.');
        redirect(route('certificate', $cert['certificate_code']));
    }
    flash('error', 'Terminez toutes les leçons du parcours pour obtenir votre certificat.');
    redirect(url('dashboard/index.php'));
}

$overview = ProgressModel::overview($userId);
$byCourse = ProgressModel::byCourse($userId);
$stats = ProgressModel::stats($userId);
$next = ProgressModel::nextLesson($userId);
$activity = ActivityModel::forUser($userId, 8);
$badges = BadgeService::earned($userId);
$badgeTotal = count(BadgeService::all());
$certificate = CertificateModel::forUser($userId);
$eligible = !$certificate && $overview['global']['total'] > 0 && $overview['global']['done'] === $overview['global']['total'];
$coursesDone = count(array_filter($byCourse, static fn ($c) => $c['total'] > 0 && $c['done'] === $c['total']));
$html = $overview['categories']['html'] ?? ['percent' => 0, 'done' => 0, 'total' => 0];
$css = $overview['categories']['css'] ?? ['percent' => 0, 'done' => 0, 'total' => 0];
$ring = static fn (int $p) => sprintf('<svg viewBox="0 0 120 120" aria-hidden="true"><circle class="ring__bg" cx="60" cy="60" r="52" fill="none" stroke-width="10"/><circle class="ring__fg" cx="60" cy="60" r="52" fill="none" stroke-width="10"/></svg>');

$pageTitle = 'Mon espace';
$noindex = true;
$activeNav = 'dashboard';
require ROOT_PATH . '/includes/header.php';
?>
<div class="container section--tight">
  <?php partial('dash-nav', ['dashActive' => 'index']); ?>
  <div class="dash-grid">
    <section class="card span-8">
      <div class="welcome">
        <span class="avatar avatar--lg" aria-hidden="true"><?= e(initials($user['first_name'], $user['last_name'])) ?></span>
        <div>
          <p class="eyebrow" style="margin:0">Bonjour</p>
          <h1><?= e($user['first_name']) ?>, prêt à coder ?</h1>
          <p class="muted" style="margin:0">Dernière activité : <?= e(time_ago($user['last_activity_at'])) ?></p>
        </div>
      </div>
      <div class="progress-list" style="margin-top:1.5rem">
        <?php partial('progress-bar', ['label' => 'HTML', 'percent' => $html['percent'], 'variant' => 'html', 'icon' => 'html', 'detail' => $html['done'] . '/' . $html['total'] . ' leçons']); ?>
        <?php partial('progress-bar', ['label' => 'CSS', 'percent' => $css['percent'], 'variant' => 'css', 'icon' => 'css', 'detail' => $css['done'] . '/' . $css['total'] . ' leçons']); ?>
      </div>
    </section>

    <section class="card span-4" style="display:grid;place-items:center;text-align:center">
      <div class="ring" style="--p:<?= (int) $overview['global']['percent'] ?>">
        <?= $ring((int) $overview['global']['percent']) ?>
        <div class="ring__label"><?= (int) $overview['global']['percent'] ?> %<small>parcours global</small></div>
      </div>
      <p class="muted" style="margin:.75rem 0 0"><?= (int) $overview['global']['done'] ?> / <?= (int) $overview['global']['total'] ?> leçons terminées</p>
    </section>

    <?php if ($next): ?>
    <section class="card next-lesson span-12">
      <div class="btn-row" style="justify-content:space-between">
        <div>
          <p class="eyebrow" style="margin-bottom:.3rem"><?= icon('sparkle', 'icon icon--sm') ?> Prochain cours recommandé</p>
          <h2 style="font-size:1.4rem;margin:0"><?= e($next['title']) ?></h2>
          <p class="muted" style="margin:.2rem 0 0"><?= e($next['category_name']) ?> · <?= e($next['module_title']) ?> · <?= (int) $next['duration_minutes'] ?> min</p>
        </div>
        <a class="btn btn--primary btn--lg" href="<?= e(route('lesson', $next['slug'])) ?>"><?= icon('play') ?> <?= $overview['global']['done'] ? 'Continuer' : 'Commencer' ?></a>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($certificate || $eligible): ?>
    <section class="card span-12" style="border-color:var(--primary)">
      <div class="btn-row" style="justify-content:space-between">
        <div>
          <h2 style="font-size:1.3rem;margin:0"><?= icon('certificate') ?> Parcours HTML &amp; CSS terminé</h2>
          <p class="muted" style="margin:.3rem 0 0"><?= $certificate ? 'Votre certificat est disponible et vérifiable en ligne.' : 'Vous avez terminé toutes les leçons : votre certificat vous attend !' ?></p>
        </div>
        <?php if ($certificate): ?>
          <a class="btn btn--primary" href="<?= e(route('certificate', $certificate['certificate_code'])) ?>">Voir mon certificat</a>
        <?php else: ?>
          <form method="post"><?= csrf_field() ?><input type="hidden" name="action" value="certificate"><button class="btn btn--primary" type="submit"><?= icon('award') ?> Générer mon certificat</button></form>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>

    <div class="span-12 grid grid--4">
      <div class="stat"><div class="stat__label"><?= icon('layers', 'icon icon--sm') ?> Cours terminés</div><div class="stat__value" data-count="<?= $coursesDone ?>">0</div><div class="stat__hint">sur <?= count($byCourse) ?> cours</div></div>
      <div class="stat"><div class="stat__label"><?= icon('code', 'icon icon--sm') ?> Exercices réussis</div><div class="stat__value" data-count="<?= (int) $stats['exercises_passed'] ?>">0</div><div class="stat__hint"><?= (int) $stats['exercise_attempts'] ?> tentatives</div></div>
      <div class="stat"><div class="stat__label"><?= icon('question', 'icon icon--sm') ?> Quiz réussis</div><div class="stat__value" data-count="<?= (int) $stats['quizzes_passed'] ?>">0</div><div class="stat__hint"><?= (int) $stats['lessons_completed'] ?> leçons validées</div></div>
      <div class="stat"><div class="stat__label"><?= icon('target', 'icon icon--sm') ?> Score moyen</div><div class="stat__value"><?= $stats['average_score'] !== null ? '<span data-count="' . (int) $stats['average_score'] . '" data-suffix=" %">0</span>' : '—' ?></div><div class="stat__hint">meilleur score par quiz</div></div>
    </div>

    <section class="card span-7">
      <div class="btn-row" style="justify-content:space-between;margin-bottom:1rem">
        <h2 class="card__title" style="margin:0"><?= icon('award') ?> Badges obtenus (<?= count($badges) ?>/<?= $badgeTotal ?>)</h2>
        <a href="<?= e(url('dashboard/badges.php')) ?>">Tous les badges</a>
      </div>
      <?php if (!$badges): ?>
        <p class="muted">Aucun badge pour l’instant. Terminez votre première leçon pour débloquer « Premier cours terminé » !</p>
      <?php else: ?>
        <div class="badge-grid" style="grid-template-columns:repeat(auto-fill,minmax(130px,1fr))">
          <?php foreach (array_slice($badges, 0, 6) as $b): ?>
            <div class="badge-card" style="padding:.5rem">
              <span class="badge-medal" style="--c:<?= e($b['color']) ?>;width:60px;height:60px"><?= icon($b['icon']) ?></span>
              <p class="badge-card__name" style="font-size:.88rem"><?= e($b['name']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <section class="card span-5">
      <h2 class="card__title"><?= icon('clock') ?> Activité récente</h2>
      <?php if (!$activity): ?>
        <p class="muted">Votre activité apparaîtra ici.</p>
      <?php else: ?>
        <ul class="activity-list">
          <?php foreach ($activity as $a): ?>
            <li><span class="activity-list__dot" aria-hidden="true"></span><span><strong><?= e(ActivityModel::label($a['action'])) ?></strong> — <?= e($a['subject']) ?></span><span class="activity-list__time"><?= e(time_ago($a['created_at'])) ?></span></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </section>
  </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
