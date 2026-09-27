<?php
/**
 * Widget d'exercice (code, compléter, corriger, QCM, vrai/faux).
 * Variables : $exercise (ligne de la table exercises), $user (utilisateur courant ou null), $passed (bool)
 */
declare(strict_types=1);

$passed ??= false;
$isCode = in_array($exercise['type'], ['code', 'fill', 'fix'], true);
$question = $isCode ? null : ExerciseModel::question((int) $exercise['id']);
$hasCss = trim((string) $exercise['starter_css']) !== '' || trim((string) $exercise['solution_css']) !== '';
$langs = $hasCss ? ['html', 'css'] : ['html'];
$wid = 'ex-' . (int) $exercise['id'];
?>
<div class="exercise-widget" data-exercise="<?= (int) $exercise['id'] ?>" data-type="<?= e($exercise['type']) ?>" data-editor-id="<?= e($wid) ?>">
  <div class="btn-row" style="margin-bottom:.75rem">
    <span class="tag"><?= e(ExerciseModel::TYPES[$exercise['type']]) ?></span>
    <span class="tag tag--level-<?= (int) $exercise['difficulty'] ?>">Difficulté <?= str_repeat('●', (int) $exercise['difficulty']) . str_repeat('○', 3 - (int) $exercise['difficulty']) ?></span>
    <span class="tag"><?= icon('star', 'icon icon--sm') ?> <?= (int) $exercise['points'] ?> pts</span>
    <?php if ($passed): ?><span class="tag tag--success" data-passed-tag><?= icon('check', 'icon icon--sm') ?> Réussi</span><?php endif; ?>
  </div>
  <div class="prose"><?= Markdown::render($exercise['instructions']) ?></div>

  <?php if ($isCode): ?>
    <?php partial('editor', [
        'id'          => $wid,
        'html'        => (string) $exercise['starter_html'],
        'css'         => (string) $exercise['starter_css'],
        'langs'       => $langs,
        'storageKey'  => 'exercise-' . $exercise['id'],
        'label'       => 'Éditeur de l’exercice : ' . $exercise['title'],
    ]); ?>
    <textarea hidden data-solution="html" aria-hidden="true" tabindex="-1"><?= e((string) $exercise['solution_html']) ?></textarea>
    <textarea hidden data-solution="css" aria-hidden="true" tabindex="-1"><?= e((string) $exercise['solution_css']) ?></textarea>
  <?php elseif ($question): ?>
    <fieldset class="quiz-question" data-question>
      <legend><?= e($question['question']) ?></legend>
      <?php if ($question['code_snippet']): ?><?= Markdown::codeBlock($question['code_snippet'], 'html') ?><?php endif; ?>
      <div class="quiz-options">
        <?php foreach ($question['answers'] as $a): ?>
          <label class="quiz-option" data-answer="<?= (int) $a['id'] ?>">
            <input type="radio" name="<?= e($wid) ?>-answer" value="<?= (int) $a['id'] ?>">
            <span><?= Markdown::inline($a['answer_text']) ?></span>
            <span class="quiz-option__mark" aria-hidden="true"></span>
          </label>
        <?php endforeach; ?>
      </div>
    </fieldset>
  <?php endif; ?>

  <div class="btn-row" style="margin-top:1rem">
    <?php if ($user): ?>
      <button type="button" class="btn btn--primary" data-check><?= icon('check-circle') ?> <?= $isCode ? 'Vérifier mon code' : 'Valider ma réponse' ?></button>
    <?php else: ?>
      <a class="btn btn--primary" href="<?= e(url('auth/login.php')) ?>?redirect=<?= e(rawurlencode(current_path())) ?>"><?= icon('login') ?> Connectez-vous pour valider</a>
    <?php endif; ?>
    <?php if ($isCode && ($exercise['solution_html'] || $exercise['solution_css'])): ?>
      <button type="button" class="btn btn--ghost" data-solution-btn<?= $passed ? '' : ' data-confirm-solution' ?>><?= icon('lightbulb') ?> Voir la correction</button>
    <?php endif; ?>
  </div>

  <?php if ($exercise['hint']): ?>
    <details class="hint"><summary><?= icon('lightbulb', 'icon icon--sm') ?> Besoin d’un indice ?</summary><p><?= Markdown::inline($exercise['hint']) ?></p></details>
  <?php endif; ?>

  <div data-result aria-live="polite"></div>
</div>
