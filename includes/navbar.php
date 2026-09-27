<?php
declare(strict_types=1);

$activeNav ??= '';
$navItems = [
    'home'        => ['Accueil', route('home'), 'home'],
    'courses'     => ['Cours', route('courses'), 'book'],
    'path'        => ['Parcours', route('path'), 'map'],
    'exercises'   => ['Exercices', route('exercises'), 'code'],
    'projects'    => ['Projets', route('projects'), 'folder'],
    'leaderboard' => ['Classement', route('leaderboard'), 'trophy'],
];
?>
<header class="site-header" data-header>
  <div class="container site-header__inner">
    <a class="brand" href="<?= e(route('home')) ?>" aria-label="<?= e(setting('site_name', config('app.name'))) ?> — accueil">
      <span class="brand__mark"><?= icon('logo') ?></span>
      <span class="brand__name">HTML<span class="brand__amp">&amp;</span>CSS <span class="brand__sub">Academy</span></span>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-nav" data-nav-toggle>
      <span class="sr-only">Ouvrir le menu</span>
      <?= icon('menu', 'icon nav-toggle__open') ?><?= icon('close', 'icon nav-toggle__close') ?>
    </button>

    <nav class="main-nav" id="main-nav" aria-label="Navigation principale" data-nav>
      <ul class="main-nav__list">
        <?php foreach ($navItems as $key => [$label, $href, $ico]): ?>
          <li><a class="main-nav__link<?= $activeNav === $key ? ' is-active' : '' ?>" href="<?= e($href) ?>"<?= $activeNav === $key ? ' aria-current="page"' : '' ?>><?= icon($ico) ?><span><?= e($label) ?></span></a></li>
        <?php endforeach; ?>
      </ul>

      <div class="main-nav__account">
        <?php if ($user): ?>
          <a class="main-nav__link<?= $activeNav === 'dashboard' ? ' is-active' : '' ?>" href="<?= e(url('dashboard/index.php')) ?>"><?= icon('dashboard') ?><span>Mon espace</span></a>
          <?php if ($user['role'] === 'admin'): ?>
            <a class="main-nav__link main-nav__link--admin<?= $activeNav === 'admin' ? ' is-active' : '' ?>" href="<?= e(url('admin/dashboard.php')) ?>"><?= icon('settings') ?><span>Admin</span></a>
          <?php endif; ?>
          <div class="user-menu" data-dropdown>
            <button type="button" class="user-menu__btn" aria-expanded="false" aria-haspopup="true" data-dropdown-toggle>
              <span class="avatar" aria-hidden="true"><?= e(initials($user['first_name'], $user['last_name'])) ?></span>
              <span class="sr-only">Menu de <?= e($user['first_name']) ?></span>
              <?= icon('chevron-down', 'icon icon--sm') ?>
            </button>
            <div class="user-menu__panel" data-dropdown-panel hidden>
              <p class="user-menu__name"><?= e($user['first_name'] . ' ' . $user['last_name']) ?><small><?= e($user['email']) ?></small></p>
              <a href="<?= e(url('dashboard/progress.php')) ?>"><?= icon('chart') ?> Ma progression</a>
              <a href="<?= e(url('dashboard/badges.php')) ?>"><?= icon('award') ?> Mes badges</a>
              <a href="<?= e(url('dashboard/profile.php')) ?>"><?= icon('user') ?> Mon profil</a>
              <form method="post" action="<?= e(url('auth/logout.php')) ?>">
                <?= csrf_field() ?>
                <button type="submit"><?= icon('logout') ?> Déconnexion</button>
              </form>
            </div>
          </div>
        <?php else: ?>
          <a class="main-nav__link<?= $activeNav === 'login' ? ' is-active' : '' ?>" href="<?= e(url('auth/login.php')) ?>"><?= icon('login') ?><span>Connexion</span></a>
          <a class="btn btn--primary btn--sm" href="<?= e(url('auth/register.php')) ?>">Commencer gratuitement</a>
        <?php endif; ?>
      </div>
    </nav>
  </div>
</header>
