<?php
/**
 * Soumission d'un exercice par formulaire classique (fonctionne sans JavaScript).
 * L'interface principale utilise l'API JSON api/exercises.php ; la logique de correction est commune.
 */
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

if (!is_post()) {
    redirect(route('exercises'));
}
$user = require_login();
verify_csrf();

$exercise = ExerciseModel::find((int) input('exercise_id'));
if (!$exercise) {
    not_found();
}

$result = ExerciseModel::submit((int) $user['id'], $exercise, [
    'html'      => (string) ($_POST['html'] ?? ''),
    'css'       => (string) ($_POST['css'] ?? ''),
    'answer_id' => (int) input('answer_id'),
]);

if (!$result['ok']) {
    flash('error', $result['error'] ?? 'Soumission invalide.');
} elseif ($result['passed']) {
    flash('success', 'Exercice réussi ! ' . ($result['first_success'] ? '+' . $result['points'] . ' points.' : ''));
    foreach ($result['badges'] as $b) {
        flash('success', 'Nouveau badge : ' . $b['name']);
    }
} else {
    $failed = array_map(static fn ($r) => $r['msg'], array_filter($result['results'], static fn ($r) => !$r['ok']));
    flash('warning', 'Score : ' . $result['score'] . ' %. À corriger : ' . implode(' · ', $failed ?: ['réponse incorrecte']));
}
redirect(route('exercise', $exercise['slug']));
