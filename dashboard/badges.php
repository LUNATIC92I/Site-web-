<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$user = require_login();
$badges = BadgeService::forUser((int) $user['id']);
$earned = count(array_filter($badges, static fn ($b) => $b['awarded_at'] !== null));

$pageTitle = 'Mes badges';
$noindex = true;
$activeNav = 'dashboard';
require ROOT_PATH . '/includes/header.php';
?>
<div class="container section--tight">
  <?php partial('dash-nav', ['dashActive' => 'badges']); ?>
  <h1>Mes badges</h1>
  <p class="lead">Vous avez débloqué <strong><?= $earned ?></strong> badge<?= $earned > 1 ? 's' : '' ?> sur <?= count($badges) ?>. Chaque badge récompense une étape clé de votre apprentissage.</p>
  <?php partial('progress-bar', ['label' => 'Collection', 'percent' => count($badges) ? (int) floor($earned / count($badges) * 100) : 0, 'icon' => 'award']); ?>

  <div class="badge-grid" style="margin-top:2rem">
    <?php foreach ($badges as $b): $locked = $b['awarded_at'] === null; $isNew = !$locked && strtotime($b['awarded_at']) > time() - 86400; ?>
      <article class="card badge-card<?= $locked ? ' is-locked' : '' ?><?= $isNew ? ' is-new' : '' ?> reveal">
        <span class="badge-medal" style="--c:<?= e($b['color']) ?>"><?= icon($locked ? 'lock' : $b['icon']) ?></span>
        <h2 class="badge-card__name" style="font-size:1rem"><?= e($b['name']) ?><?php if ($locked): ?><span class="sr-only"> (verrouillé)</span><?php endif; ?></h2>
        <p class="badge-card__desc"><?= e($b['description']) ?></p>
        <?php if (!$locked): ?><p class="badge-card__date">Obtenu le <?= e(format_date($b['awarded_at'])) ?></p><?php endif; ?>
      </article>
    <?php endforeach; ?>
  </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
