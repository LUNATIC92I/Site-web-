<?php
/**
 * API progression
 *   POST {action: "complete", lesson_id}  -> valide une leçon (quiz réussi requis s'il existe)
 *   POST {action: "overview"}             -> progression globale de l'utilisateur
 */
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

if (!is_post()) {
    json_response(['ok' => false, 'error' => 'Méthode non autorisée.'], 405);
}
$user = require_api_user();
verify_api_csrf();

$data = json_input();
$userId = (int) $user['id'];

switch ($data['action'] ?? '') {
    case 'complete':
        $lesson = LessonModel::find((int) ($data['lesson_id'] ?? 0));
        if (!$lesson || !$lesson['is_published']) {
            json_response(['ok' => false, 'error' => 'Leçon introuvable.'], 404);
        }
        $lessonId = (int) $lesson['id'];
        if (QuizModel::count($lessonId) > 0 && !QuizModel::hasPassed($userId, $lessonId)) {
            json_response(['ok' => false, 'error' => 'Réussissez d’abord le quiz de la leçon.'], 422);
        }
        $new = ProgressModel::complete($userId, $lessonId);
        $badges = [];
        if ($new) {
            ActivityModel::log($userId, 'lesson_completed', $lesson['title']);
            $badges = BadgeService::evaluate($userId);
        }
        $next = ProgressModel::nextLesson($userId);
        json_response([
            'ok'                => true,
            'newly_completed'   => $new,
            'progress'          => ProgressModel::overview($userId),
            'next'              => $next ? ['title' => $next['title'], 'url' => route('lesson', $next['slug'])] : null,
            'certificate_ready' => $next === null && CertificateModel::eligible($userId),
            'badges'            => $badges,
        ]);

    case 'overview':
        json_response(['ok' => true, 'progress' => ProgressModel::overview($userId), 'stats' => ProgressModel::stats($userId)]);

    default:
        json_response(['ok' => false, 'error' => 'Action inconnue.'], 400);
}
