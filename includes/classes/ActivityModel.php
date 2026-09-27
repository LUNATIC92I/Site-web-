<?php
declare(strict_types=1);

/** Journal d'activité (tableau de bord apprenant et administrateur). */
final class ActivityModel
{
    public const LABELS = [
        'register'         => 'Inscription',
        'login'            => 'Connexion',
        'lesson_completed' => 'Leçon terminée',
        'exercise_passed'  => 'Exercice réussi',
        'quiz_passed'      => 'Quiz réussi',
        'quiz_failed'      => 'Quiz à retenter',
        'badge_awarded'    => 'Badge obtenu',
        'project_submitted' => 'Projet soumis',
        'certificate'      => 'Certificat obtenu',
    ];

    public static function log(?int $userId, string $action, string $subject = ''): void
    {
        try {
            Database::insert('activity_log', [
                'user_id' => $userId,
                'action'  => $action,
                'subject' => mb_substr($subject, 0, 255),
            ]);
        } catch (Throwable $e) {
            Logger::error('Activity log failed: ' . $e->getMessage());
        }
    }

    public static function forUser(int $userId, int $limit = 8): array
    {
        return Database::fetchAll(
            "SELECT action, subject, created_at FROM activity_log
             WHERE user_id = ? AND action <> 'login' ORDER BY created_at DESC, id DESC LIMIT " . (int) $limit,
            [$userId]
        );
    }

    public static function recent(int $limit = 12): array
    {
        return Database::fetchAll(
            'SELECT a.action, a.subject, a.created_at, u.id AS user_id, u.first_name, u.last_name
             FROM activity_log a LEFT JOIN users u ON u.id = a.user_id
             ORDER BY a.created_at DESC, a.id DESC LIMIT ' . (int) $limit
        );
    }

    public static function label(string $action): string
    {
        return self::LABELS[$action] ?? ucfirst(str_replace('_', ' ', $action));
    }
}
