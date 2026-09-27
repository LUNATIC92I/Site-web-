<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$lessonId = query_int('lesson');
$lesson = $lessonId ? LessonModel::find($lessonId) : null;
$errors = [];

if (is_post() && $lesson) {
    verify_csrf();
    $action = input('action');
    if ($action === 'save') {
        $type = input('type') === 'truefalse' ? 'truefalse' : 'single';
        $answers = $type === 'truefalse' ? ['Vrai', 'Faux'] : array_values(array_filter(array_map('trim', (array) ($_POST['answers'] ?? [])), 'strlen'));
        $correct = (int) ($_POST['correct'] ?? -1);
        if (trim(input('question')) === '') {
            $errors[] = 'La question est obligatoire.';
        }
        if (count($answers) < 2 || $correct < 0 || $correct >= count($answers)) {
            $errors[] = 'Indiquez au moins deux réponses et cochez la bonne.';
        }
        // Protection IDOR : la question modifiée doit appartenir à la leçon affichée
        $qid = admin_post_id() ?: null;
        if ($qid && (int) Database::value('SELECT lesson_id FROM questions WHERE id = ?', [$qid]) !== $lessonId) {
            $errors[] = 'Question invalide.';
        }
        if (!$errors) {
            QuizModel::saveQuestion($qid, $lessonId, [
                'question'     => input('question'),
                'type'         => $type,
                'code_snippet' => str_replace("\r\n", "\n", (string) ($_POST['code_snippet'] ?? '')),
                'explanation'  => input('explanation'),
                'sort_order'   => (int) input('sort_order'),
            ], $answers, $correct);
            flash('success', 'Question enregistrée.');
            redirect(url('admin/quizzes.php?lesson=' . $lessonId));
        }
    } elseif ($action === 'delete') {
        $qid = admin_post_id();
        if ((int) Database::value('SELECT lesson_id FROM questions WHERE id = ?', [$qid]) === $lessonId) {
            QuizModel::deleteQuestion($qid);
            flash('success', 'Question supprimée.');
        }
        redirect(url('admin/quizzes.php?lesson=' . $lessonId));
    }
}

admin_header($lesson ? 'Quiz — ' . $lesson['title'] : 'Quiz', 'quizzes');

if (!$lesson):
    $lessons = LessonModel::allForAdmin();
    ?>
  <p class="muted">Chaque leçon possède son quiz de validation. Choisissez une leçon pour gérer ses questions (QCM et Vrai/Faux).</p>
  <div class="table-wrap"><table class="table">
    <thead><tr><th>Leçon</th><th>Module</th><th>Questions</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($lessons as $l): ?>
        <tr><td><?= e($l['title']) ?></td><td><?= e($l['module_title']) ?></td><td><?= (int) $l['question_count'] ?></td>
          <td><a class="btn btn--sm" href="?lesson=<?= (int) $l['id'] ?>"><?= icon('edit') ?> Gérer</a></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table></div>
<?php else:
    $questions = QuizModel::questionsForAdmin($lessonId);
    $edit = isset($_GET['q']) ? (query_int('q') ? QuizModel::findQuestion(query_int('q')) : []) : [];
    if ($edit && (int) ($edit['lesson_id'] ?? 0) !== $lessonId) {
        $edit = [];
    }
    $answers = $errors ? (array) ($_POST['answers'] ?? []) : array_column($edit['answers'] ?? [], 'answer_text');
    $correctIdx = $errors ? (int) ($_POST['correct'] ?? -1) : -1;
    foreach ($edit['answers'] ?? [] as $i => $a) {
        if ($a['is_correct'] && !$errors) {
            $correctIdx = $i;
        }
    }
    foreach ($errors as $err): ?><div class="flash flash--error" role="alert"><?= icon('alert') ?><p><?= e($err) ?></p></div><?php endforeach; ?>
  <p><a href="<?= e(url('admin/quizzes.php')) ?>"><?= icon('arrow-left', 'icon icon--sm') ?> Toutes les leçons</a> · <a href="<?= e(route('lesson', $lesson['slug'])) ?>#quiz">Voir le quiz</a></p>

  <div class="dash-grid">
    <section class="span-7">
      <h2>Questions (<?= count($questions) ?>)</h2>
      <?php if (!$questions): ?><p class="empty">Aucune question : ajoutez-en au moins trois.</p><?php endif; ?>
      <?php foreach ($questions as $i => $q): ?>
        <article class="card" style="margin-bottom:1rem">
          <div class="admin-toolbar" style="margin-bottom:.5rem">
            <strong><?= $i + 1 ?>. <?= e($q['question']) ?></strong>
            <span class="actions"><a class="btn btn--sm btn--icon" href="?lesson=<?= $lessonId ?>&q=<?= (int) $q['id'] ?>" aria-label="Modifier"><?= icon('edit') ?></a><?= admin_delete_button((int) $q['id'], 'Supprimer cette question ?') ?></span>
          </div>
          <ul class="list-check">
            <?php foreach ($q['answers'] as $a): ?><li><?= icon($a['is_correct'] ? 'check-circle' : 'x-circle') ?><span<?= $a['is_correct'] ? ' style="color:var(--success)"' : '' ?>><?= e($a['answer_text']) ?></span></li><?php endforeach; ?>
          </ul>
          <?php if ($q['explanation']): ?><p class="muted" style="margin:.6rem 0 0;font-size:.88rem"><?= e($q['explanation']) ?></p><?php endif; ?>
        </article>
      <?php endforeach; ?>
    </section>
    <section class="span-5">
      <form method="post" class="admin-form card" action="?lesson=<?= $lessonId ?>">
        <h2 class="card__title"><?= !empty($edit['id']) ? 'Modifier la question' : 'Nouvelle question' ?></h2>
        <?= csrf_field() ?>
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
        <?= admin_textarea('question', 'Question', $errors ? input('question') : ($edit['question'] ?? ''), false, '', 3) ?>
        <?= admin_select('type', 'Type', ['single' => 'QCM', 'truefalse' => 'Vrai / Faux'], $errors ? input('type') : ($edit['type'] ?? 'single')) ?>
        <?= admin_textarea('code_snippet', 'Extrait de code (facultatif)', $errors ? (string) ($_POST['code_snippet'] ?? '') : ($edit['code_snippet'] ?? ''), true, '', 3) ?>
        <div class="field">
          <span class="field__label">Réponses (cochez la bonne ; Vrai/Faux : 1 = Vrai, 2 = Faux)</span>
          <div class="answers-editor">
            <?php for ($i = 0; $i < 4; $i++): ?>
              <div class="answers-editor__row">
                <input type="radio" name="correct" value="<?= $i ?>" aria-label="Réponse <?= $i + 1 ?> correcte"<?= $correctIdx === $i ? ' checked' : '' ?>>
                <input class="input" type="text" name="answers[]" value="<?= e((string) ($answers[$i] ?? '')) ?>" aria-label="Réponse <?= $i + 1 ?>" maxlength="500">
              </div>
            <?php endfor; ?>
          </div>
        </div>
        <?= admin_textarea('explanation', 'Explication affichée après correction', $errors ? input('explanation') : ($edit['explanation'] ?? ''), false, '', 3) ?>
        <?= admin_input('sort_order', 'Ordre', $errors ? input('sort_order') : ($edit['sort_order'] ?? count($questions)), 'number') ?>
        <div class="btn-row"><button class="btn btn--primary" type="submit">Enregistrer</button><?php if (!empty($edit['id'])): ?><a class="btn btn--ghost" href="?lesson=<?= $lessonId ?>">Annuler</a><?php endif; ?></div>
      </form>
    </section>
  </div>
<?php endif;
admin_footer();
