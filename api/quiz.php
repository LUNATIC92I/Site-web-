<?php
/**
 * API quiz
 *   POST {lesson_id, answers: {question_id: answer_id}} -> correction détaillée
 */
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

if (!is_post()) {
    json_response(['ok' => false, 'error' => 'Méthode non autorisée.'], 405);
}
$user = require_api_user();
verify_api_csrf();

$data = json_input();
$lesson = LessonModel::find((int) ($data['lesson_id'] ?? 0));
if (!$lesson || !$lesson['is_published']) {
    json_response(['ok' => false, 'error' => 'Leçon introuvable.'], 404);
}
if (session_rate_limited('quiz', 20, 60)) {
    json_response(['ok' => false, 'error' => 'Trop de tentatives rapprochées. Patientez un instant.'], 429);
}

$answers = [];
foreach ((array) ($data['answers'] ?? []) as $qid => $aid) {
    if (is_numeric($qid) && is_numeric($aid)) {
        $answers[(int) $qid] = (int) $aid;
    }
}

$result = QuizModel::grade((int) $user['id'], $lesson, $answers);
json_response($result, $result['ok'] ? 200 : 422);
