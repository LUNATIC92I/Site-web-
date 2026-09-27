<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$catalog = CourseModel::catalog();
$user = current_user();
$progress = $user ? ProgressModel::byCourse((int) $user['id']) : [];
$filter = in_array(input('categorie'), ['html', 'css'], true) ? input('categorie') : '';
$search = mb_substr(input('q'), 0, 80);
$results = $search !== '' ? LessonModel::search($search) : [];

$byLevel = [];
foreach ($catalog as $c) {
    if ($filter !== '' && $c['category_slug'] !== $filter) {
        continue;
    }
    $byLevel[(int) $c['level']][] = $c;
}

$pageTitle = 'Cours HTML & CSS';
$pageDescription = 'Tous les cours HTML et CSS classés par niveau : débutant, intermédiaire et avancé. Leçons détaillées, exemples, exercices et quiz.';
$activeNav = 'courses';
require ROOT_PATH . '/includes/header.php';
?>
<header class="page-head container">
  <p class="eyebrow"><?= icon('book', 'icon icon--sm') ?> Catalogue</p>
  <h1>Les cours</h1>
  <p>Six cours répartis sur trois niveaux. Suivez-les dans l’ordre du <a href="<?= e(route('path')) ?>">parcours</a> ou piochez librement les notions qui vous intéressent.</p>

  <form class="btn-row" method="get" action="<?= e(route('courses')) ?>" role="search" style="margin-top:1.5rem">
    <label class="sr-only" for="q">Rechercher une leçon</label>
    <input class="input" style="max-width:360px" type="search" id="q" name="q" value="<?= e($search) ?>" placeholder="Rechercher : flexbox, formulaire, liens…">
    <button class="btn" type="submit"><?= icon('search') ?> Rechercher</button>
  </form>
</header>

<div class="container">
  <?php if ($search !== ''): ?>
    <section class="level-block" aria-labelledby="results-title">
      <h2 id="results-title">Résultats pour « <?= e($search) ?> » (<?= count($results) ?>)</h2>
      <?php if (!$results): ?>
        <p class="empty"><?= icon('search') ?><br>Aucune leçon ne correspond à cette recherche.</p>
      <?php else: ?>
        <div class="grid grid--3">
          <?php foreach ($results as $r): ?>
            <a class="card card--hover card--link" href="<?= e(route('lesson', $r['slug'])) ?>">
              <span class="tag tag--<?= e(strtolower($r['category_name'])) ?>"><?= e($r['category_name']) ?></span>
              <h3 class="card__title" style="margin-top:.6rem"><?= e($r['title']) ?></h3>
              <p class="muted"><?= e($r['module_title']) ?></p>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endif; ?>

  <nav class="filters" aria-label="Filtrer par langage">
    <a class="chip<?= $filter === '' ? ' is-active' : '' ?>" href="<?= e(route('courses')) ?>">Tous</a>
    <a class="chip<?= $filter === 'html' ? ' is-active' : '' ?>" href="<?= e(route('courses')) ?>?categorie=html"><?= icon('html', 'icon icon--sm') ?> HTML</a>
    <a class="chip<?= $filter === 'css' ? ' is-active' : '' ?>" href="<?= e(route('courses')) ?>?categorie=css"><?= icon('css', 'icon icon--sm') ?> CSS</a>
  </nav>

  <?php foreach ($byLevel as $level => $courses): ?>
    <section class="level-block" aria-labelledby="level-<?= $level ?>">
      <div class="level-block__head">
        <span class="level-block__num">NIVEAU <?= $level ?></span>
        <h2 id="level-<?= $level ?>"><?= e(level_label($level)) ?></h2>
      </div>
      <div class="grid grid--2">
        <?php foreach ($courses as $c): $p = $progress[(int) $c['id']] ?? null; $cat = $c['category_slug']; ?>
          <a class="card card--hover card--link course-card card--accent-<?= e($cat) ?> reveal" href="<?= e(route('course', $c['slug'])) ?>">
            <div class="course-card__top">
              <span class="card__icon card__icon--<?= e($cat) ?>" style="margin:0"><?= icon($cat, 'icon icon--lg') ?></span>
              <span class="tag tag--level-<?= $level ?>"><?= e(level_label($level)) ?></span>
            </div>
            <h3 class="card__title"><?= e($c['title']) ?></h3>
            <p><?= e($c['summary']) ?></p>
            <div class="card__meta">
              <span><?= icon('layers', 'icon icon--sm') ?> <?= (int) $c['module_count'] ?> modules</span>
              <span><?= icon('book', 'icon icon--sm') ?> <?= (int) $c['lesson_count'] ?> leçons</span>
              <span><?= icon('clock', 'icon icon--sm') ?> <?= round((int) $c['duration'] / 60, 1) ?> h</span>
            </div>
            <?php if ($p): ?>
              <div class="progress progress--sm progress--<?= e($cat) ?>" data-animate-progress>
                <div class="progress__head"><span class="progress__label">Progression</span><span class="progress__value"><?= $p['percent'] ?> %</span></div>
                <div class="progress__track"><div class="progress__bar" style="--p:<?= $p['percent'] ?>"></div></div>
              </div>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endforeach; ?>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
