<?php declare(strict_types=1); $dashActive ??= 'index'; ?>
<nav class="side-nav" aria-label="Mon espace">
  <?php foreach (['index' => ['Tableau de bord', 'dashboard'], 'progress' => ['Progression', 'chart'], 'badges' => ['Badges', 'award'], 'profile' => ['Profil', 'user']] as $k => [$label, $ico]): ?>
    <a class="chip<?= $dashActive === $k ? ' is-active' : '' ?>" href="<?= e(url('dashboard/' . $k . '.php')) ?>"<?= $dashActive === $k ? ' aria-current="page"' : '' ?>><?= icon($ico, 'icon icon--sm') ?> <?= e($label) ?></a>
  <?php endforeach; ?>
</nav>
