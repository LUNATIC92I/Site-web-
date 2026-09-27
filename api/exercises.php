<?php
/**
 * API exercices
 *   POST {exercise_id, html, css}   -> exercices de code (code / fill / fix)
 *   POST {exercise_id, answer_id}   -> QCM / Vrai-Faux
 */
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

if (!is_post()) {
    json_response(['ok' => false, 'error' => 'Méthode non autorisée.'], 405);
}
$user = require_api_user();
verify_api_csrf();

$data = json_input();
$exercise = ExerciseModel::find((int) ($data['exercise_id'] ?? 0));
if (!$exercise) {
    json_response(['ok' => false, 'error' => 'Exercice introuvable.'], 404);
}
if (session_rate_limited('exercise', 60, 60)) {
    json_response(['ok' => false, 'error' => 'Trop de vérifications en peu de temps. Patientez quelques secondes.'], 429);
}

$result = ExerciseModel::submit((int) $user['id'], $exercise, [
    'html'      => is_string($data['html'] ?? null) ? $data['html'] : '',
    'css'       => is_string($data['css'] ?? null) ? $data['css'] : '',
    'answer_id' => (int) ($data['answer_id'] ?? 0),
]);
json_response($result, $result['ok'] ? 200 : 422);
