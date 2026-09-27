<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$projects = ProjectModel::all();
$user = current_user();
$subs = $user ? ProjectModel::submissionsFor((int) $user['id']) : [];

$pageTitle = 'Projets pratiques';
$pageDescription = 'Mettez vos compétences HTML et CSS en pratique avec des projets guidés : page personnelle, landing page, portfolio et site professionnel responsive.';
$activeNav = 'projects';
require ROOT_PATH . '/includes/header.php';
?>
<header class="page-head container">
  <p class="eyebrow"><?= icon('folder', 'icon icon--sm') ?> Projets</p>
  <h1>Projets pratiques</h1>
  <p>À la fin de chaque grande section, un projet complet vous permet d’assembler toutes les notions. Chaque projet est vérifié automatiquement puis peut être relu par un formateur.</p>
</header>
<div class="container grid grid--2">
  <?php foreach ($projects as $i => $p): $s = $subs[(int) $p['id']] ?? null; ?>
    <a class="card card--hover card--link project-card reveal" href="<?= e(route('project', $p['slug'])) ?>">
      <span class="project-card__num" aria-hidden="true"><?= sprintf('%02d', $i + 1) ?></span>
      <div class="btn-row">
        <span class="tag tag--level-<?= (int) $p['level'] ?>"><?= e(level_label((int) $p['level'])) ?></span>
        <?php if ($p['category_name']): ?><span class="tag tag--<?= e($p['category_slug']) ?>"><?= e($p['category_name']) ?></span><?php else: ?><span class="tag">HTML + CSS</span><?php endif; ?>
        <?php if ($p['is_final']): ?><span class="tag tag--warning"><?= icon('crown', 'icon icon--sm') ?> Projet final</span><?php endif; ?>
      </div>
      <h2 class="card__title"><?= e($p['title']) ?></h2>
      <p class="muted"><?= e($p['summary']) ?></p>
      <?php if ($s): ?>
        <span class="tag <?= in_array($s['status'], ['validated', 'approved'], true) ? 'tag--success' : ($s['status'] === 'rejected' ? 'tag--danger' : 'tag--warning') ?>" style="align-self:flex-start"><?= e(ProjectModel::STATUS[$s['status']]) ?> · <?= (int) $s['auto_score'] ?> %</span>
      <?php endif; ?>
    </a>
  <?php endforeach; ?>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
