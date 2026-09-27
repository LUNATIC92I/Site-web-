<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$lessonOptions = ['' => '— Aucune (exercice indépendant) —'];
foreach (LessonModel::options() as $l) {
    $lessonOptions[$l['id']] = $l['category_name'] . ' › ' . $l['title'];
}
$errors = [];

if (is_post()) {
    verify_csrf();
    $action = input('action');
    $id = admin_post_id() ?: null;

    if ($action === 'save') {
        $type = input('type');
        $isChoice = in_array($type, ['qcm', 'truefalse'], true);
        $v = new Validator($_POST);
        $v->required('title', 'Titre')->max('title', 150, 'Le titre')->required('slug', 'Slug')->slug('slug')
          ->in('type', array_keys(ExerciseModel::TYPES), 'Type')->in('difficulty', [1, 2, 3], 'Difficulté')
          ->required('instructions', 'Consignes')->json('validation_rules', 'Règles de vérification');
        if (input('lesson_id') !== '') {
            $v->in('lesson_id', array_keys($lessonOptions), 'Leçon');
        }
        if (!$v->fails() && CourseModel::slugTaken('exercises', $v->value('slug'), (int) $id)) {
            $v->add('slug', 'Ce slug est déjà utilisé.');
        }
        $answers = array_values(array_filter(array_map('trim', (array) ($_POST['answers'] ?? [])), 'strlen'));
        $correct = (int) ($_POST['correct'] ?? -1);
        if ($isChoice) {
            if ($type === 'truefalse') {
                $answers = ['Vrai', 'Faux'];
            }
            if (trim(input('question')) === '') {
                $v->add('question', 'La question est obligatoire pour un QCM / Vrai-Faux.');
            }
            if (count($answers) < 2 || $correct < 0 || $correct >= count($answers)) {
                $v->add('answers', 'Indiquez au moins deux réponses et cochez la bonne.');
            }
        } elseif (trim(input('validation_rules')) === '') {
            $v->add('validation_rules', 'Un exercice de code doit avoir au moins une règle de vérification.');
        }

        if ($v->fails()) {
            $errors = $v->errors();
        } else {
            $raw = static fn (string $k): string => str_replace("\r\n", "\n", (string) ($_POST[$k] ?? ''));
            $id = ExerciseModel::save($id, [
                'lesson_id'        => input('lesson_id') !== '' ? (int) input('lesson_id') : null,
                'title'            => $v->value('title'),
                'slug'             => $v->value('slug'),
                'type'             => $type,
                'difficulty'       => (int) $v->value('difficulty'),
                'instructions'     => $raw('instructions'),
                'starter_html'     => $raw('starter_html') ?: null,
                'starter_css'      => $raw('starter_css') ?: null,
                'solution_html'    => $raw('solution_html') ?: null,
                'solution_css'     => $raw('solution_css') ?: null,
                'validation_rules' => $isChoice ? null : normalize_json($raw('validation_rules')),
                'hint'             => $raw('hint') ?: null,
                'explanation'      => $raw('explanation') ?: null,
                'points'           => max(0, min(1000, (int) $v->value('points'))),
                'sort_order'       => (int) $v->value('sort_order'),
            ]);
            if ($isChoice) {
                ExerciseModel::saveQuestion($id, $type, $raw('question'), $raw('code_snippet'), $answers, $correct);
            }
            flash('success', 'Exercice enregistré.');
            redirect(url('admin/exercises.php?edit=' . $id));
        }
    } elseif ($action === 'delete' && $id) {
        ExerciseModel::delete($id);
        flash('success', 'Exercice supprimé.');
        redirect(url('admin/exercises.php'));
    }
}

$edit = isset($_GET['edit']) ? (query_int('edit') ? ExerciseModel::find(query_int('edit')) : ['lesson_id' => query_int('lesson') ?: '']) : null;
$question = !empty($edit['id']) ? ExerciseModel::questionForAdmin((int) $edit['id']) : null;
if ($errors) {
    $edit = $_POST;
}

$rulesHelp = 'Exemples : [{"t":"el","sel":"h1","text":"Bienvenue","msg":"Un titre h1 contient « Bienvenue »"}, '
    . '{"t":"attr","sel":"img","attr":"alt","nonempty":true}, {"t":"css","sel":"p","prop":"color","value":"red"}, '
    . '{"t":"contains","s":"<!DOCTYPE html>","ci":true}, {"t":"absent","s":"______"}, {"t":"noel","sel":"font"}]';

admin_header($edit !== null ? (!empty($edit['id']) ? 'Modifier l’exercice' : 'Nouvel exercice') : 'Exercices', 'exercises');

if ($edit !== null):
    foreach ($errors as $err): ?><div class="flash flash--error" role="alert"><?= icon('alert') ?><p><?= e($err) ?></p></div><?php endforeach;
    $answerValues = $errors ? (array) ($_POST['answers'] ?? []) : array_column($question['answers'] ?? [], 'answer_text');
    $pos = array_search(1, array_map('intval', array_column($question['answers'] ?? [], 'is_correct')), true);
    $correctIdx = $errors ? (int) ($_POST['correct'] ?? -1) : ($pos === false ? -1 : (int) $pos);
    ?>
  <p><a href="<?= e(url('admin/exercises.php')) ?>"><?= icon('arrow-left', 'icon icon--sm') ?> Tous les exercices</a><?php if (!empty($edit['slug']) && !empty($edit['id'])): ?> · <a href="<?= e(route('exercise', $edit['slug'])) ?>">Voir l’exercice</a><?php endif; ?></p>
  <form method="post" class="admin-form card">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="id" value="<?= (int) ($edit['id'] ?? 0) ?>">
    <fieldset><legend>Informations</legend>
      <div class="form-row">
        <?= admin_input('title', 'Titre', $edit['title'] ?? '', 'text', 'required maxlength="150"') ?>
        <?= admin_input('slug', 'Slug', $edit['slug'] ?? '', 'text', 'required pattern="[a-z0-9-]+" data-slug-from="a-title"') ?>
      </div>
      <div class="form-row">
        <?= admin_select('type', 'Type', ExerciseModel::TYPES, $edit['type'] ?? 'code', 'data-exercise-type') ?>
        <?= admin_select('difficulty', 'Difficulté', [1 => '1 — Facile', 2 => '2 — Moyen', 3 => '3 — Difficile'], $edit['difficulty'] ?? 1) ?>
        <?= admin_input('points', 'Points', $edit['points'] ?? 10, 'number', 'min="0" max="1000"') ?>
        <?= admin_input('sort_order', 'Ordre', $edit['sort_order'] ?? 0, 'number') ?>
      </div>
      <?= admin_select('lesson_id', 'Leçon associée', $lessonOptions, $edit['lesson_id'] ?? '') ?>
      <?= admin_textarea('instructions', 'Consignes (Markdown)', $edit['instructions'] ?? '', false, '', 5) ?>
    </fieldset>

    <fieldset data-for="code"><legend>Code de départ et solution</legend>
      <div class="form-row">
        <?= admin_textarea('starter_html', 'HTML de départ', $edit['starter_html'] ?? '', true) ?>
        <?= admin_textarea('starter_css', 'CSS de départ', $edit['starter_css'] ?? '', true) ?>
      </div>
      <div class="form-row">
        <?= admin_textarea('solution_html', 'Solution HTML', $edit['solution_html'] ?? '', true) ?>
        <?= admin_textarea('solution_css', 'Solution CSS', $edit['solution_css'] ?? '', true) ?>
      </div>
      <div class="field">
        <label for="a-validation_rules">Règles de vérification (JSON)</label>
        <textarea class="textarea textarea--code" id="a-validation_rules" name="validation_rules" rows="8" data-json spellcheck="false"><?= e($errors ? (string) ($edit['validation_rules'] ?? '') : (isset($edit['validation_rules']) && $edit['validation_rules'] ? json_encode(json_decode($edit['validation_rules']), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : '')) ?></textarea>
        <p class="field__hint"><?= e($rulesHelp) ?></p>
      </div>
    </fieldset>

    <fieldset data-for="choice"><legend>Question à choix</legend>
      <?= admin_textarea('question', 'Question', $errors ? (string) ($_POST['question'] ?? '') : ($question['question'] ?? ''), false, '', 2) ?>
      <?= admin_textarea('code_snippet', 'Extrait de code (facultatif)', $errors ? (string) ($_POST['code_snippet'] ?? '') : ($question['code_snippet'] ?? ''), true, '', 3) ?>
      <div class="field">
        <span class="field__label">Réponses (cochez la bonne — pour Vrai/Faux : 1 = Vrai, 2 = Faux)</span>
        <div class="answers-editor">
          <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="answers-editor__row">
              <input type="radio" name="correct" value="<?= $i ?>" aria-label="Réponse <?= $i + 1 ?> correcte"<?= $correctIdx === $i ? ' checked' : '' ?>>
              <input class="input" type="text" name="answers[]" value="<?= e((string) ($answerValues[$i] ?? '')) ?>" aria-label="Réponse <?= $i + 1 ?>" maxlength="500">
            </div>
          <?php endfor; ?>
        </div>
      </div>
    </fieldset>

    <fieldset><legend>Aide</legend>
      <?= admin_textarea('hint', 'Indice', $edit['hint'] ?? '', false, '', 2) ?>
      <?= admin_textarea('explanation', 'Explication / correction commentée', $edit['explanation'] ?? '', false, '', 3) ?>
    </fieldset>
    <div class="btn-row"><button class="btn btn--primary btn--lg" type="submit"><?= icon('check') ?> Enregistrer</button></div>
  </form>
<?php else:
    $typeFilter = array_key_exists(input('type'), ExerciseModel::TYPES) ? input('type') : '';
    $rows = ExerciseModel::allForAdmin($typeFilter);
    ?>
  <div class="admin-toolbar">
    <nav class="filters" style="margin:0" aria-label="Filtrer par type">
      <a class="chip<?= $typeFilter === '' ? ' is-active' : '' ?>" href="?">Tous</a>
      <?php foreach (ExerciseModel::TYPES as $k => $label): ?><a class="chip<?= $typeFilter === $k ? ' is-active' : '' ?>" href="?type=<?= e($k) ?>"><?= e($label) ?></a><?php endforeach; ?>
    </nav>
    <a class="btn btn--primary btn--sm" href="?edit=0"><?= icon('plus') ?> Ajouter un exercice</a>
  </div>
  <div class="table-wrap"><table class="table">
    <thead><tr><th>Exercice</th><th>Type</th><th>Leçon</th><th>Tentatives</th><th>Réussite</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach ($rows as $x): $rate = $x['attempts'] ? (int) round($x['successes'] / $x['attempts'] * 100) : null; ?>
        <tr>
          <td><a href="<?= e(route('exercise', $x['slug'])) ?>"><?= e($x['title']) ?></a></td>
          <td><?= e(ExerciseModel::TYPES[$x['type']]) ?></td>
          <td><?= e($x['lesson_title'] ?? '—') ?></td>
          <td><?= (int) $x['attempts'] ?></td>
          <td><?= $rate === null ? '—' : $rate . ' %' ?></td>
          <td class="actions"><a class="btn btn--sm btn--icon" href="?edit=<?= (int) $x['id'] ?>" aria-label="Modifier"><?= icon('edit') ?></a><?= admin_delete_button((int) $x['id'], 'Supprimer cet exercice et ses tentatives ?') ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table></div>
<?php endif;
admin_footer();
