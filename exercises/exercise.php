<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$exercise = ExerciseModel::findBySlug(input('slug'));
if (!$exercise) {
    not_found();
}
$user = current_user();
$passed = $user && isset(ExerciseModel::passedIds((int) $user['id'])[(int) $exercise['id']]);
$last = $user ? ExerciseModel::lastAttempt((int) $user['id'], (int) $exercise['id']) : null;
$isCode = in_array($exercise['type'], ['code', 'fill', 'fix'], true);

// Exercice suivant dans le catalogue
$all = ExerciseModel::catalog();
$next = null;
foreach ($all as $i => $ex) {
    if ((int) $ex['id'] === (int) $exercise['id']) {
        $next = $all[$i + 1] ?? null;
        break;
    }
}

$pageTitle = $exercise['title'] . ' — Exercice';
$pageDescription = mb_strimwidth(strip_tags($exercise['instructions']), 0, 158, '…');
$activeNav = 'exercises';
$pageScripts = ['editor.js', 'exercise.js'];
require ROOT_PATH . '/includes/header.php';
?>
<div class="container">
  <header class="page-head" style="padding-bottom:0">
    <ol class="breadcrumb">
      <li><a href="<?= e(route('exercises')) ?>">Exercices</a></li>
      <?php if ($exercise['lesson_slug']): ?><li><a href="<?= e(route('lesson', $exercise['lesson_slug'])) ?>"><?= e($exercise['lesson_title']) ?></a></li><?php endif; ?>
      <li aria-current="page"><?= e($exercise['title']) ?></li>
    </ol>
    <h1><?= e($exercise['title']) ?></h1>
  </header>

  <div class="exercise-layout" style="grid-template-columns:1fr">
    <div class="card">
      <?php partial('exercise-widget', ['exercise' => $exercise, 'user' => $user, 'passed' => $passed]); ?>
      <?php if ($isCode && $user): ?>
        <noscript>
          <form class="form" method="post" action="<?= e(url('exercises/submit.php')) ?>" style="margin-top:1rem">
            <?= csrf_field() ?>
            <input type="hidden" name="exercise_id" value="<?= (int) $exercise['id'] ?>">
            <div class="field"><label for="ns-html">Votre code HTML</label><textarea class="textarea textarea--code" id="ns-html" name="html"><?= e($last['submitted_html'] ?? (string) $exercise['starter_html']) ?></textarea></div>
            <div class="field"><label for="ns-css">Votre code CSS</label><textarea class="textarea textarea--code" id="ns-css" name="css"><?= e($last['submitted_css'] ?? (string) $exercise['starter_css']) ?></textarea></div>
            <button class="btn btn--primary" type="submit">Vérifier (sans JavaScript)</button>
          </form>
        </noscript>
      <?php endif; ?>
    </div>
    <?php if ($last): ?>
      <p class="muted"><?= icon('clock', 'icon icon--sm') ?> Dernière tentative <?= e(time_ago($last['created_at'])) ?> — score <?= (int) $last['score'] ?> %.</p>
    <?php endif; ?>
    <div class="btn-row">
      <?php if ($exercise['lesson_slug']): ?><a class="btn btn--ghost" href="<?= e(route('lesson', $exercise['lesson_slug'])) ?>"><?= icon('book') ?> Revoir la leçon</a><?php endif; ?>
      <?php if ($next): ?><a class="btn" href="<?= e(route('exercise', $next['slug'])) ?>">Exercice suivant <?= icon('arrow-right') ?></a><?php endif; ?>
    </div>
  </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
