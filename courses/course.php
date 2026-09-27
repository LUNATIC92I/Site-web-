<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$course = CourseModel::findBySlug(input('slug'));
if (!$course || (!$course['is_published'] && !is_admin())) {
    not_found();
}

$modules = CourseModel::modulesWithLessons((int) $course['id']);
$user = current_user();
$done = $user ? ProgressModel::completedIds((int) $user['id']) : [];

$total = 0;
$completed = 0;
$firstTodo = null;
foreach ($modules as $m) {
    foreach ($m['lessons'] as $l) {
        $total++;
        if (isset($done[(int) $l['id']])) {
            $completed++;
        } elseif ($firstTodo === null) {
            $firstTodo = $l;
        }
    }
}
$firstTodo ??= $modules[0]['lessons'][0] ?? null;
$percent = $total ? (int) floor($completed / $total * 100) : 0;
$cat = $course['category_slug'];

$pageTitle = $course['title'];
$pageDescription = $course['summary'];
$activeNav = 'courses';
$jsonLd = [
    '@context'    => 'https://schema.org',
    '@type'       => 'Course',
    'name'        => $course['title'],
    'description' => $course['summary'],
    'educationalLevel' => level_label((int) $course['level']),
    'inLanguage'  => 'fr',
    'provider'    => ['@type' => 'Organization', 'name' => setting('site_name', config('app.name')), 'sameAs' => absolute_url('')],
];
require ROOT_PATH . '/includes/header.php';
?>
<header class="page-head container">
  <ol class="breadcrumb">
    <li><a href="<?= e(route('courses')) ?>">Cours</a></li>
    <li aria-current="page"><?= e($course['title']) ?></li>
  </ol>
  <div class="btn-row" style="margin-bottom:1rem">
    <span class="tag tag--<?= e($cat) ?>"><?= icon($cat, 'icon icon--sm') ?> <?= e($course['category_name']) ?></span>
    <span class="tag tag--level-<?= (int) $course['level'] ?>">Niveau <?= (int) $course['level'] ?> · <?= e(level_label((int) $course['level'])) ?></span>
  </div>
  <h1><?= e($course['title']) ?></h1>
  <div class="prose"><?= Markdown::render($course['description'] ?: $course['summary']) ?></div>

  <div class="grid grid--2" style="align-items:center;margin-top:1.5rem">
    <div class="progress progress--<?= e($cat) ?>" data-animate-progress>
      <div class="progress__head"><span class="progress__label"><?= $completed ?> / <?= $total ?> leçons terminées</span><span class="progress__value"><?= $percent ?> %</span></div>
      <div class="progress__track"><div class="progress__bar" style="--p:<?= $percent ?>"></div></div>
    </div>
    <?php if ($firstTodo): ?>
      <div class="btn-row">
        <a class="btn btn--primary" href="<?= e(route('lesson', $firstTodo['slug'])) ?>"><?= icon('play') ?> <?= $completed > 0 ? 'Continuer' : 'Commencer le cours' ?></a>
      </div>
    <?php endif; ?>
  </div>
</header>

<div class="container">
  <?php foreach ($modules as $i => $m): ?>
    <section class="module reveal" aria-labelledby="module-<?= (int) $m['id'] ?>">
      <div class="module__head">
        <span class="module__num">M<?= sprintf('%02d', $i + 1) ?></span>
        <div>
          <h2 id="module-<?= (int) $m['id'] ?>" class="h3" style="font-size:1.1rem;margin:0"><?= e($m['title']) ?></h2>
          <?php if ($m['description']): ?><p><?= e($m['description']) ?></p><?php endif; ?>
        </div>
      </div>
      <ol class="module__lessons">
        <?php foreach ($m['lessons'] as $l): $isDone = isset($done[(int) $l['id']]); ?>
          <li class="module__lesson<?= $isDone ? ' is-done' : '' ?>">
            <a href="<?= e(route('lesson', $l['slug'])) ?>">
              <span class="lesson-status" aria-hidden="true"><?= $isDone ? icon('check') : '' ?></span>
              <span class="lesson-title"><?= e($l['title']) ?><?php if ($isDone): ?><span class="sr-only"> (terminée)</span><?php endif; ?></span>
              <span class="lesson-duration"><?= (int) $l['duration_minutes'] ?> min</span>
            </a>
          </li>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endforeach; ?>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
