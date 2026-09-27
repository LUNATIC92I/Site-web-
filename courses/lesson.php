<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$lesson = LessonModel::findBySlug(input('slug'));
if (!$lesson || (!$lesson['is_published'] && !is_admin())) {
    not_found();
}

$user = current_user();
$userId = $user ? (int) $user['id'] : null;
$lessonId = (int) $lesson['id'];

if (!ProgressModel::canAccess($userId, $lesson)) {
    flash('info', 'Terminez la leçon précédente pour débloquer celle-ci.');
    $n = LessonModel::neighbours($lessonId);
    redirect(route('lesson', $n['prev']['slug']));
}
if ($userId) {
    ProgressModel::markStarted($userId, $lessonId);
}

$nav = LessonModel::neighbours($lessonId);
$siblings = LessonModel::siblings((int) $lesson['module_id']);
$exercises = ExerciseModel::forLesson($lessonId);
$mainExercise = $exercises[0] ?? null;
$passedIds = $userId ? ExerciseModel::passedIds($userId) : [];
$questions = QuizModel::forLesson($lessonId);
$isCompleted = $userId && ProgressModel::isCompleted($userId, $lessonId);
$quizPassed = $userId && QuizModel::hasPassed($userId, $lessonId);
$bestQuiz = $userId ? QuizModel::best($userId, $lessonId) : null;
$cat = $lesson['category_slug'];

$objectives = json_list($lesson['objectives']);
$prerequisites = json_list($lesson['prerequisites']);
$lines = json_list($lesson['line_by_line']);
$references = json_list($lesson['reference_items']);
$mistakes = json_list($lesson['common_mistakes']);
$practices = json_list($lesson['best_practices']);
$summary = json_list($lesson['summary_points']);

// Sommaire : [ancre, titre] — seules les sections ayant du contenu sont affichées
$sections = array_filter([
    ['introduction', 'Introduction', true],
    ['objectifs', 'Objectifs et prérequis', $objectives || $prerequisites],
    ['comprendre', 'Comprendre', true],
    ['exemple-simple', 'Exemple simple', $lesson['syntax_code'] || $lesson['simple_html'] || $lesson['simple_css']],
    ['exemple-detaille', 'Exemple détaillé', $lesson['example_html'] || $lesson['example_css']],
    ['ligne-par-ligne', 'Explication ligne par ligne', (bool) $lines],
    ['reference', $cat === 'css' ? 'Propriétés expliquées' : 'Balises et attributs expliqués', (bool) $references],
    ['erreurs', 'Erreurs fréquentes', (bool) $mistakes],
    ['bonnes-pratiques', 'Bonnes pratiques', (bool) $practices],
    ['pratique', 'Exemple pratique', (bool) $lesson['practical']],
    ['exercice', 'Exercice', (bool) $mainExercise],
    ['quiz', 'Quiz', (bool) $questions],
    ['correction', 'Correction', $mainExercise && in_array($mainExercise['type'], ['code', 'fill', 'fix'], true)],
    ['resume', 'Résumé', (bool) $summary],
    ['challenge', 'Challenge final', (bool) $lesson['challenge']],
    ['validation', 'Validation du chapitre', true],
], static fn ($s) => $s[2]);
$sections = array_values($sections);
$num = static function (string $anchor) use ($sections): string {
    foreach ($sections as $i => $s) {
        if ($s[0] === $anchor) {
            return sprintf('%02d', $i + 1);
        }
    }
    return '';
};

$pageTitle = $lesson['title'] . ' — ' . $lesson['category_name'];
$pageDescription = mb_strimwidth(strip_tags($lesson['introduction']), 0, 158, '…');
$pageType = 'article';
$activeNav = 'courses';
$pageScripts = ['editor.js', 'exercise.js', 'lesson.js'];
$jsonLd = [
    '@context' => 'https://schema.org',
    '@type'    => 'LearningResource',
    'name'     => $lesson['title'],
    'description' => $pageDescription,
    'learningResourceType' => 'Lesson',
    'educationalLevel' => level_label((int) $lesson['level']),
    'inLanguage' => 'fr',
    'timeRequired' => 'PT' . (int) $lesson['duration_minutes'] . 'M',
    'isPartOf' => ['@type' => 'Course', 'name' => $lesson['course_title'], 'url' => absolute_url(substr(route('course', $lesson['course_slug']), strlen(base_path())))],
];
require ROOT_PATH . '/includes/header.php';
?>
<div class="lesson-reading-progress" aria-hidden="true"><span></span></div>
<div class="container lesson-layout">
  <aside class="lesson-toc" aria-label="Sommaire de la leçon">
    <p class="lesson-toc__title">Dans cette leçon</p>
    <ol data-toc>
      <?php foreach ($sections as [$anchor, $title]): ?><li><a href="#<?= e($anchor) ?>"><?= e($title) ?></a></li><?php endforeach; ?>
    </ol>
    <p class="lesson-toc__title"><?= e($lesson['module_title']) ?></p>
    <ol class="lesson-toc__module">
      <?php foreach ($siblings as $s): ?>
        <li><a href="<?= e(route('lesson', $s['slug'])) ?>"<?= (int) $s['id'] === $lessonId ? ' aria-current="page"' : '' ?>><?= e($s['title']) ?></a></li>
      <?php endforeach; ?>
    </ol>
  </aside>

  <article class="lesson-content" data-lesson="<?= $lessonId ?>">
    <header class="lesson-header">
      <ol class="breadcrumb">
        <li><a href="<?= e(route('courses')) ?>">Cours</a></li>
        <li><a href="<?= e(route('course', $lesson['course_slug'])) ?>"><?= e($lesson['course_title']) ?></a></li>
        <li><?= e($lesson['module_title']) ?></li>
      </ol>
      <p class="eyebrow">Leçon <?= (int) $nav['position'] ?> / <?= (int) $nav['total'] ?></p>
      <h1><?= e($lesson['title']) ?></h1>
      <div class="lesson-header__meta">
        <span class="tag tag--<?= e($cat) ?>"><?= icon($cat, 'icon icon--sm') ?> <?= e($lesson['category_name']) ?></span>
        <span class="tag tag--level-<?= (int) $lesson['level'] ?>"><?= e(level_label((int) $lesson['level'])) ?></span>
        <span><?= icon('clock', 'icon icon--sm') ?> <?= (int) $lesson['duration_minutes'] ?> min</span>
        <?php if ($isCompleted): ?><span class="tag tag--success"><?= icon('check', 'icon icon--sm') ?> Terminée</span><?php endif; ?>
      </div>
    </header>

    <section class="lesson-section" id="introduction">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('introduction') ?></span> Introduction</h2>
      <div class="prose"><?= Markdown::render($lesson['introduction']) ?></div>
    </section>

    <?php if ($objectives || $prerequisites): ?>
    <section class="lesson-section" id="objectifs">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('objectifs') ?></span> Objectifs et prérequis</h2>
      <div class="objectives">
        <div class="card"><h3><?= icon('target', 'icon icon--sm') ?> Objectifs du chapitre</h3><ul><?php foreach ($objectives as $o): ?><li><?= Markdown::inline((string) $o) ?></li><?php endforeach; ?></ul></div>
        <div class="card"><h3><?= icon('list', 'icon icon--sm') ?> Prérequis</h3><ul><?php foreach ($prerequisites ?: ['Aucun prérequis'] as $p): ?><li><?= Markdown::inline((string) $p) ?></li><?php endforeach; ?></ul></div>
      </div>
    </section>
    <?php endif; ?>

    <section class="lesson-section" id="comprendre">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('comprendre') ?></span> Comprendre</h2>
      <div class="prose"><?= Markdown::render($lesson['theory']) ?></div>
    </section>

    <?php if ($lesson['syntax_code'] || $lesson['simple_html'] || $lesson['simple_css']): ?>
    <section class="lesson-section" id="exemple-simple">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('exemple-simple') ?></span> Exemple simple</h2>
      <?php if ($lesson['syntax_code']): ?>
        <p class="muted">La syntaxe à retenir :</p>
        <?= Markdown::codeBlock($lesson['syntax_code'], $cat === 'css' && !str_contains($lesson['syntax_code'], '<') ? 'css' : 'html', 'Syntaxe') ?>
      <?php endif; ?>
      <?php if ($lesson['simple_html']): ?><?= Markdown::codeBlock($lesson['simple_html'], 'html') ?><?php endif; ?>
      <?php if ($lesson['simple_css']): ?><?= Markdown::codeBlock($lesson['simple_css'], 'css') ?><?php endif; ?>
    </section>
    <?php endif; ?>

    <?php if ($lesson['example_html'] || $lesson['example_css']): ?>
    <section class="lesson-section" id="exemple-detaille">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('exemple-detaille') ?></span> Exemple détaillé</h2>
      <p class="muted">Modifiez ce code librement : l’aperçu se met à jour en direct. Le bouton « Réinitialiser » restaure l’exemple d’origine.</p>
      <?php partial('editor', [
          'id'    => 'example-' . $lessonId,
          'html'  => (string) $lesson['example_html'],
          'css'   => (string) $lesson['example_css'],
          'langs' => trim((string) $lesson['example_css']) !== '' ? ['html', 'css'] : ['html'],
          'label' => 'Exemple détaillé modifiable',
      ]); ?>
    </section>
    <?php endif; ?>

    <?php if ($lines): ?>
    <section class="lesson-section" id="ligne-par-ligne">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('ligne-par-ligne') ?></span> Explication ligne par ligne</h2>
      <div class="table-wrap">
        <table class="line-table">
          <caption class="sr-only">Explication de chaque ligne de l’exemple</caption>
          <tbody>
            <?php foreach ($lines as $i => $row): ?>
              <tr><td><span class="line-table__n"><?= $i + 1 ?></span><code class="language-<?= str_contains((string) ($row[0] ?? ''), '<') || $cat !== 'css' ? 'html' : 'css' ?>"><?= e((string) ($row[0] ?? '')) ?></code></td><td><?= Markdown::inline((string) ($row[1] ?? '')) ?></td></tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($references): ?>
    <section class="lesson-section" id="reference">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('reference') ?></span> <?= $cat === 'css' ? 'Propriétés expliquées' : 'Balises et attributs expliqués' ?></h2>
      <div class="ref-list">
        <?php foreach ($references as $r): ?>
          <div class="ref-item"><code><?= e((string) ($r[0] ?? '')) ?></code><p><?= Markdown::inline((string) ($r[1] ?? '')) ?></p></div>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($mistakes): ?>
    <section class="lesson-section" id="erreurs">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('erreurs') ?></span> Erreurs fréquentes</h2>
      <ul class="list-cross"><?php foreach ($mistakes as $m): ?><li><?= icon('x-circle') ?><span><?= Markdown::inline((string) $m) ?></span></li><?php endforeach; ?></ul>
    </section>
    <?php endif; ?>

    <?php if ($practices): ?>
    <section class="lesson-section" id="bonnes-pratiques">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('bonnes-pratiques') ?></span> Bonnes pratiques</h2>
      <ul class="list-check"><?php foreach ($practices as $p): ?><li><?= icon('check-circle') ?><span><?= Markdown::inline((string) $p) ?></span></li><?php endforeach; ?></ul>
    </section>
    <?php endif; ?>

    <?php if ($lesson['practical']): ?>
    <section class="lesson-section" id="pratique">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('pratique') ?></span> Exemple pratique : dans un vrai projet</h2>
      <div class="prose"><?= Markdown::render($lesson['practical']) ?></div>
    </section>
    <?php endif; ?>

    <?php if ($mainExercise): ?>
    <section class="lesson-section" id="exercice">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('exercice') ?></span> Exercice : <?= e($mainExercise['title']) ?></h2>
      <?php partial('exercise-widget', ['exercise' => $mainExercise, 'user' => $user, 'passed' => isset($passedIds[(int) $mainExercise['id']])]); ?>
      <?php if (count($exercises) > 1): ?>
        <p class="muted" style="margin-top:1.25rem">Pour aller plus loin :</p>
        <div class="btn-row">
          <?php foreach (array_slice($exercises, 1) as $ex): ?>
            <a class="chip<?= isset($passedIds[(int) $ex['id']]) ? ' is-active' : '' ?>" href="<?= e(route('exercise', $ex['slug'])) ?>"><?= icon(isset($passedIds[(int) $ex['id']]) ? 'check' : 'code', 'icon icon--sm') ?> <?= e($ex['title']) ?> · <?= e(ExerciseModel::TYPES[$ex['type']]) ?></a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php if ($questions): ?>
    <section class="lesson-section" id="quiz">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('quiz') ?></span> Quiz</h2>
      <p class="muted">Répondez aux <?= count($questions) ?> questions. Il faut au moins <?= (int) config('learning.quiz_pass_percentage') ?> % de bonnes réponses pour valider le chapitre.<?= $bestQuiz !== null ? ' Votre meilleur score : ' . $bestQuiz . ' %.' : '' ?></p>
      <form class="quiz" data-quiz="<?= $lessonId ?>">
        <?php foreach ($questions as $qi => $q): ?>
          <fieldset class="quiz-question" data-question="<?= (int) $q['id'] ?>">
            <legend><span class="quiz-question__n"><?= $qi + 1 ?>.</span> <span><?= Markdown::inline($q['question']) ?></span></legend>
            <?php if ($q['code_snippet']): ?><?= Markdown::codeBlock($q['code_snippet'], str_contains($q['code_snippet'], '<') ? 'html' : 'css') ?><?php endif; ?>
            <div class="quiz-options">
              <?php foreach ($q['answers'] as $a): ?>
                <label class="quiz-option" data-answer="<?= (int) $a['id'] ?>">
                  <input type="radio" name="q<?= (int) $q['id'] ?>" value="<?= (int) $a['id'] ?>" required>
                  <span><?= Markdown::inline($a['answer_text']) ?></span>
                  <span class="quiz-option__mark" aria-hidden="true"></span>
                </label>
              <?php endforeach; ?>
            </div>
            <div data-feedback aria-live="polite"></div>
          </fieldset>
        <?php endforeach; ?>
        <div class="btn-row">
          <?php if ($user): ?>
            <button type="submit" class="btn btn--primary"><?= icon('check-circle') ?> Valider mes réponses</button>
            <button type="reset" class="btn btn--ghost" data-quiz-reset><?= icon('refresh') ?> Recommencer</button>
          <?php else: ?>
            <a class="btn btn--primary" href="<?= e(url('auth/login.php')) ?>?redirect=<?= e(rawurlencode(current_path())) ?>"><?= icon('login') ?> Connectez-vous pour passer le quiz</a>
          <?php endif; ?>
        </div>
        <div data-quiz-result aria-live="polite"></div>
      </form>
    </section>
    <?php endif; ?>

    <?php if ($mainExercise && in_array($mainExercise['type'], ['code', 'fill', 'fix'], true)): ?>
    <section class="lesson-section" id="correction">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('correction') ?></span> Correction</h2>
      <p class="muted">Les corrections du quiz s’affichent question par question après validation. Voici la solution commentée de l’exercice : essayez d’abord par vous-même !</p>
      <details class="card">
        <summary class="btn btn--ghost"><?= icon('lightbulb') ?> Afficher la solution de l’exercice</summary>
        <?php if ($mainExercise['solution_html']): ?><?= Markdown::codeBlock($mainExercise['solution_html'], 'html', 'Solution HTML') ?><?php endif; ?>
        <?php if ($mainExercise['solution_css']): ?><?= Markdown::codeBlock($mainExercise['solution_css'], 'css', 'Solution CSS') ?><?php endif; ?>
        <?php if ($mainExercise['explanation']): ?><div class="prose"><?= Markdown::render($mainExercise['explanation']) ?></div><?php endif; ?>
      </details>
    </section>
    <?php endif; ?>

    <?php if ($summary): ?>
    <section class="lesson-section" id="resume">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('resume') ?></span> Résumé : à retenir</h2>
      <div class="summary-box"><ul class="list-check"><?php foreach ($summary as $s): ?><li><?= icon('check') ?><span><?= Markdown::inline((string) $s) ?></span></li><?php endforeach; ?></ul></div>
    </section>
    <?php endif; ?>

    <?php if ($lesson['challenge']): ?>
    <section class="lesson-section" id="challenge">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('challenge') ?></span> Challenge final</h2>
      <div class="challenge-box prose"><?= Markdown::render($lesson['challenge']) ?>
        <p><a class="btn btn--sm" href="<?= e(route('playground')) ?>"><?= icon('code') ?> Relever le défi dans l’éditeur libre</a></p>
      </div>
    </section>
    <?php endif; ?>

    <section class="lesson-section" id="validation">
      <h2 class="lesson-section__title"><span class="lesson-section__num"><?= $num('validation') ?></span> Validation du chapitre</h2>
      <div class="validate-box<?= $isCompleted ? ' is-done' : '' ?>" data-validate-box>
        <?php if (!$user): ?>
          <p>Créez un compte gratuit pour enregistrer votre progression, gagner des badges et obtenir votre certificat.</p>
          <div class="btn-row" style="justify-content:center"><a class="btn btn--primary" href="<?= e(url('auth/register.php')) ?>">Créer mon compte</a><a class="btn btn--ghost" href="<?= e(url('auth/login.php')) ?>?redirect=<?= e(rawurlencode(current_path())) ?>">Se connecter</a></div>
        <?php elseif ($isCompleted): ?>
          <p><?= icon('check-circle', 'icon icon--xl') ?></p>
          <h3>Chapitre validé !</h3>
          <p class="muted">Vous pouvez revoir cette leçon à tout moment.</p>
        <?php else: ?>
          <p data-validate-hint><?= $questions && !$quizPassed ? 'Réussissez le quiz ci-dessus pour débloquer la validation.' : 'Vous avez tout compris ? Validez le chapitre pour enregistrer votre progression.' ?></p>
          <button type="button" class="btn btn--primary btn--lg" data-complete="<?= $lessonId ?>"<?= $questions && !$quizPassed ? ' disabled' : '' ?>><?= icon('flag') ?> Valider le chapitre</button>
        <?php endif; ?>
      </div>
    </section>

    <nav class="lesson-nav" aria-label="Leçons précédente et suivante">
      <?php if ($nav['prev']): ?>
        <a href="<?= e(route('lesson', $nav['prev']['slug'])) ?>"><small><?= icon('arrow-left', 'icon icon--sm') ?> Leçon précédente</small><?= e($nav['prev']['title']) ?></a>
      <?php endif; ?>
      <?php if ($nav['next']): ?>
        <a class="lesson-nav__next" href="<?= e(route('lesson', $nav['next']['slug'])) ?>" data-next-lesson><small>Leçon suivante <?= icon('arrow-right', 'icon icon--sm') ?></small><?= e($nav['next']['title']) ?></a>
      <?php endif; ?>
    </nav>
  </article>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
