<?php declare(strict_types=1); ?>
  </main>
  <footer class="site-footer">
    <div class="container site-footer__grid">
      <div class="site-footer__brand">
        <a class="brand" href="<?= e(route('home')) ?>">
          <span class="brand__mark"><?= icon('logo') ?></span>
          <span class="brand__name">HTML<span class="brand__amp">&amp;</span>CSS <span class="brand__sub">Academy</span></span>
        </a>
        <p>Apprenez le développement web étape par étape : comprendre, pratiquer, construire.</p>
      </div>
      <nav aria-label="Apprendre">
        <h2 class="site-footer__title">Apprendre</h2>
        <ul>
          <li><a href="<?= e(route('courses')) ?>">Tous les cours</a></li>
          <li><a href="<?= e(route('path')) ?>">Parcours pédagogique</a></li>
          <li><a href="<?= e(route('exercises')) ?>">Exercices</a></li>
          <li><a href="<?= e(route('projects')) ?>">Projets pratiques</a></li>
          <li><a href="<?= e(route('playground')) ?>">Éditeur libre</a></li>
        </ul>
      </nav>
      <nav aria-label="Communauté">
        <h2 class="site-footer__title">Progresser</h2>
        <ul>
          <li><a href="<?= e(route('leaderboard')) ?>">Classement</a></li>
          <li><a href="<?= e(url('dashboard/badges.php')) ?>">Badges</a></li>
          <li><a href="<?= e(url('dashboard/index.php')) ?>">Mon espace</a></li>
        </ul>
      </nav>
      <div>
        <h2 class="site-footer__title">Préférences</h2>
        <label class="switch">
          <input type="checkbox" data-motion-toggle>
          <span class="switch__track" aria-hidden="true"></span>
          <span>Réduire les animations</span>
        </label>
      </div>
    </div>
    <div class="container site-footer__bottom">
      <p>&copy; <?= date('Y') ?> <?= e(setting('site_name', config('app.name'))) ?>. Plateforme pédagogique HTML &amp; CSS.</p>
      <p><a href="<?= e(url('sitemap.xml')) ?>">Plan du site</a></p>
    </div>
  </footer>
</body>
</html>
