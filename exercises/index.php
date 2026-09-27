<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$category = in_array(input('categorie'), ['html', 'css'], true) ? input('categorie') : '';
$type = array_key_exists(input('type'), ExerciseModel::TYPES) ? input('type') : '';
$level = query_int('niveau');
$exercises = ExerciseModel::catalog($category, $type, $level);
$user = current_user();
$passed = $user ? ExerciseModel::passedIds((int) $user['id']) : [];

$filterUrl = static function (array $change) use ($category, $type, $level): string {
    $params = array_filter(array_merge(['categorie' => $category, 'type' => $type, 'niveau' => $level ?: ''], $change), static fn ($v) => $v !== '' && $v !== 0);
    return route('exercises') . ($params ? '?' . http_build_query($params) : '');
};
$icons = ['code' => 'code', 'fill' => 'edit', 'fix' => 'alert', 'qcm' => 'list', 'truefalse' => 'question'];

$pageTitle = 'Exercices HTML & CSS';
$pageDescription = 'Exercices interactifs HTML et CSS corrigés automatiquement : écrire du code, compléter, corriger, QCM et vrai/faux.';
$activeNav = 'exercises';
require ROOT_PATH . '/includes/header.php';
?>
<header class="page-head container">
  <p class="eyebrow"><?= icon('code', 'icon icon--sm') ?> Pratique</p>
  <h1>Exercices</h1>
  <p><?= count($exercises) ?> exercices corrigés automatiquement. <?php if ($user): ?>Vous en avez réussi <strong><?= count($passed) ?></strong>.<?php else: ?><a href="<?= e(url('auth/register.php')) ?>">Créez un compte</a> pour enregistrer vos réussites.<?php endif; ?></p>
</header>
<div class="container">
  <nav class="filters" aria-label="Filtrer par langage">
    <a class="chip<?= $category === '' ? ' is-active' : '' ?>" href="<?= e($filterUrl(['categorie' => ''])) ?>">HTML &amp; CSS</a>
    <a class="chip<?= $category === 'html' ? ' is-active' : '' ?>" href="<?= e($filterUrl(['categorie' => 'html'])) ?>">HTML</a>
    <a class="chip<?= $category === 'css' ? ' is-active' : '' ?>" href="<?= e($filterUrl(['categorie' => 'css'])) ?>">CSS</a>
  </nav>
  <nav class="filters" aria-label="Filtrer par type">
    <a class="chip<?= $type === '' ? ' is-active' : '' ?>" href="<?= e($filterUrl(['type' => ''])) ?>">Tous les types</a>
    <?php foreach (ExerciseModel::TYPES as $k => $label): ?>
      <a class="chip<?= $type === $k ? ' is-active' : '' ?>" href="<?= e($filterUrl(['type' => $k])) ?>"><?= icon($icons[$k], 'icon icon--sm') ?> <?= e($label) ?></a>
    <?php endforeach; ?>
  </nav>
  <nav class="filters" aria-label="Filtrer par niveau">
    <a class="chip<?= $level === 0 ? ' is-active' : '' ?>" href="<?= e($filterUrl(['niveau' => ''])) ?>">Tous niveaux</a>
    <?php foreach ([1, 2, 3] as $n): ?><a class="chip<?= $level === $n ? ' is-active' : '' ?>" href="<?= e($filterUrl(['niveau' => $n])) ?>"><?= e(level_label($n)) ?></a><?php endforeach; ?>
  </nav>

  <?php if (!$exercises): ?>
    <p class="empty"><?= icon('code') ?><br>Aucun exercice ne correspond à ces filtres.</p>
  <?php else: ?>
    <div class="grid grid--3">
      <?php foreach ($exercises as $ex): $isDone = isset($passed[(int) $ex['id']]); ?>
        <a class="card card--hover card--link exercise-card<?= $isDone ? ' is-done' : '' ?>" href="<?= e(route('exercise', $ex['slug'])) ?>">
          <?php if ($isDone): ?><span class="exercise-card__status" title="Réussi"><?= icon('check-circle', 'icon icon--lg') ?><span class="sr-only">Réussi</span></span><?php endif; ?>
          <div class="btn-row">
            <?php if ($ex['category_slug']): ?><span class="tag tag--<?= e($ex['category_slug']) ?>"><?= e($ex['category_name']) ?></span><?php endif; ?>
            <span class="tag"><?= icon($icons[$ex['type']], 'icon icon--sm') ?> <?= e(ExerciseModel::TYPES[$ex['type']]) ?></span>
          </div>
          <h2 class="card__title" style="font-size:1.08rem"><?= e($ex['title']) ?></h2>
          <?php if ($ex['lesson_title']): ?><p class="muted" style="margin:0;font-size:.88rem">Leçon : <?= e($ex['lesson_title']) ?></p><?php endif; ?>
          <div class="card__meta" style="margin-top:auto">
            <span><?= str_repeat('●', (int) $ex['difficulty']) . str_repeat('○', 3 - (int) $ex['difficulty']) ?></span>
            <span><?= icon('star', 'icon icon--sm') ?> <?= (int) $ex['points'] ?> pts</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
