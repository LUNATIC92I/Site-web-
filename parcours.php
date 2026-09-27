<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$catalog = CourseModel::catalog();
$user = current_user();
$progress = $user ? ProgressModel::byCourse((int) $user['id']) : [];
$projects = ProjectModel::all();

$levels = [
    1 => ['Débutant', 'HTML et CSS fondamentaux : vous apprenez à structurer une page et à lui donner du style.', 'flag'],
    2 => ['Intermédiaire', 'Création de véritables interfaces : médias, formulaires, positionnement, Flexbox et Grid.', 'layers'],
    3 => ['Avancé', 'Responsive design, sémantique, accessibilité, animations, architecture CSS et projets complets.', 'rocket'],
];

$pageTitle = 'Parcours pédagogique';
$pageDescription = 'Le parcours complet pour apprendre HTML et CSS : trois niveaux, six cours, trente modules et quatre projets pour devenir autonome.';
$activeNav = 'path';
require ROOT_PATH . '/includes/header.php';
?>
<header class="page-head container">
  <p class="eyebrow"><?= icon('map', 'icon icon--sm') ?> Parcours</p>
  <h1>Votre parcours, étape par étape</h1>
  <p>Accueil → Inscription → Leçons → Éditeur → Exercices → Quiz → Validation → Badges → Projets → Certificat. Suivez les niveaux dans l’ordre : chaque cours prépare le suivant.</p>
</header>

<div class="container">
  <div class="timeline">
    <?php foreach ($levels as $n => [$name, $desc, $ico]):
        $courses = array_filter($catalog, static fn ($c) => (int) $c['level'] === $n);
        $levelProjects = array_filter($projects, static fn ($p) => (int) $p['level'] === $n);
        $levelDone = $courses && $user && array_reduce($courses, static fn ($ok, $c) => $ok && (($progress[(int) $c['id']]['percent'] ?? 0) === 100), true);
    ?>
      <section class="timeline__item<?= $levelDone ? ' is-done' : '' ?> reveal" aria-labelledby="lvl-<?= $n ?>">
        <span class="timeline__dot"><?= $levelDone ? icon('check') : icon($ico) ?></span>
        <div>
          <p class="eyebrow">Niveau <?= $n ?></p>
          <h2 id="lvl-<?= $n ?>"><?= e($name) ?></h2>
          <p class="muted"><?= e($desc) ?></p>
          <div class="grid grid--2" style="margin-top:1rem">
            <?php foreach ($courses as $c): $p = $progress[(int) $c['id']] ?? null; ?>
              <a class="card card--hover card--link card--accent-<?= e($c['category_slug']) ?>" href="<?= e(route('course', $c['slug'])) ?>">
                <h3 class="card__title"><?= icon($c['category_slug']) ?> <?= e($c['title']) ?></h3>
                <p class="muted"><?= e($c['summary']) ?></p>
                <div class="card__meta"><span><?= (int) $c['module_count'] ?> modules</span><span><?= (int) $c['lesson_count'] ?> leçons</span></div>
                <?php if ($p): ?><div style="margin-top:.8rem"><?php partial('progress-bar', ['label' => 'Progression', 'percent' => $p['percent'], 'variant' => $c['category_slug']]); ?></div><?php endif; ?>
              </a>
            <?php endforeach; ?>
          </div>
          <?php foreach ($levelProjects as $p): ?>
            <a class="card card--hover card--link" style="margin-top:1rem;display:flex;gap:1rem;align-items:center" href="<?= e(route('project', $p['slug'])) ?>">
              <span class="card__icon card__icon--yellow" style="margin:0"><?= icon($p['is_final'] ? 'crown' : 'folder', 'icon icon--lg') ?></span>
              <span><strong>Projet : <?= e($p['title']) ?></strong><br><span class="muted"><?= e($p['summary']) ?></span></span>
            </a>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endforeach; ?>

    <section class="timeline__item reveal" aria-labelledby="lvl-cert">
      <span class="timeline__dot"><?= icon('certificate') ?></span>
      <div class="card">
        <h2 id="lvl-cert" style="font-size:1.4rem">Certification</h2>
        <p class="muted">Terminez toutes les leçons pour obtenir le certificat « Parcours HTML &amp; CSS terminé » : nominatif, daté, avec votre score final et un identifiant unique vérifiable en ligne.</p>
        <a class="btn btn--primary" href="<?= e($user ? url('dashboard/index.php') : url('auth/register.php')) ?>"><?= $user ? 'Voir ma progression' : 'Commencer le parcours' ?></a>
      </div>
    </section>
  </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
