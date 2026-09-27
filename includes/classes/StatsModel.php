<?php
declare(strict_types=1);

/** Indicateurs de l'espace d'administration. */
final class StatsModel
{
    public static function overview(): array
    {
        $row = Database::fetch(
            "SELECT
                (SELECT COUNT(*) FROM users) AS users,
                (SELECT COUNT(*) FROM users WHERE created_at >= NOW() - INTERVAL 7 DAY) AS users_week,
                (SELECT COUNT(*) FROM users WHERE last_activity_at >= NOW() - INTERVAL 7 DAY) AS active_week,
                (SELECT COUNT(*) FROM courses WHERE is_published = 1) AS courses,
                (SELECT COUNT(*) FROM modules) AS modules,
                (SELECT COUNT(*) FROM lessons WHERE is_published = 1) AS lessons,
                (SELECT COUNT(*) FROM exercises) AS exercises,
                (SELECT COUNT(*) FROM user_progress WHERE status = 'completed') AS lessons_completed,
                (SELECT COUNT(*) FROM exercise_attempts) AS attempts,
                (SELECT COUNT(*) FROM exercise_attempts WHERE is_correct = 1) AS attempts_ok,
                (SELECT COUNT(*) FROM quiz_results) AS quizzes,
                (SELECT COUNT(*) FROM quiz_results WHERE passed = 1) AS quizzes_ok,
                (SELECT COUNT(*) FROM project_submissions) AS submissions,
                (SELECT COUNT(*) FROM project_submissions WHERE status = 'submitted') AS submissions_pending,
                (SELECT COUNT(*) FROM user_badges) AS badges_awarded,
                (SELECT COUNT(*) FROM certificates) AS certificates"
        );
        $row = array_map('intval', $row);
        $row['exercise_rate'] = $row['attempts'] ? (int) round($row['attempts_ok'] / $row['attempts'] * 100) : 0;
        $row['quiz_rate'] = $row['quizzes'] ? (int) round($row['quizzes_ok'] / $row['quizzes'] * 100) : 0;

        // "Cours terminés" : nombre de couples (utilisateur, cours) entièrement terminés
        $row['courses_completed'] = (int) Database::value(
            "SELECT COUNT(*) FROM (
                SELECT p.user_id, m.course_id, COUNT(*) AS done, t.total
                FROM user_progress p
                JOIN lessons l ON l.id = p.lesson_id AND l.is_published = 1
                JOIN modules m ON m.id = l.module_id
                JOIN (SELECT m2.course_id, COUNT(*) AS total FROM lessons l2 JOIN modules m2 ON m2.id = l2.module_id
                      WHERE l2.is_published = 1 GROUP BY m2.course_id) t ON t.course_id = m.course_id
                WHERE p.status = 'completed'
                GROUP BY p.user_id, m.course_id, t.total
                HAVING done = t.total
             ) x"
        );
        return $row;
    }

    /** Inscriptions et leçons terminées par jour sur N jours. */
    public static function daily(int $days = 30): array
    {
        $signups = Database::fetchAll(
            'SELECT DATE(created_at) d, COUNT(*) n FROM users WHERE created_at >= CURDATE() - INTERVAL ? DAY GROUP BY d',
            [$days - 1]
        );
        $completions = Database::fetchAll(
            "SELECT DATE(completed_at) d, COUNT(*) n FROM user_progress
             WHERE status = 'completed' AND completed_at >= CURDATE() - INTERVAL ? DAY GROUP BY d",
            [$days - 1]
        );
        $s = array_column($signups, 'n', 'd');
        $c = array_column($completions, 'n', 'd');
        $out = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $d = date('Y-m-d', strtotime("-$i day"));
            $out[] = ['date' => $d, 'signups' => (int) ($s[$d] ?? 0), 'completions' => (int) ($c[$d] ?? 0)];
        }
        return $out;
    }

    /** Leçons : nombre d'apprenants l'ayant terminée + moyenne des quiz. */
    public static function lessons(int $limit = 100): array
    {
        return Database::fetchAll(
            "SELECT l.title, l.slug, cat.name AS category_name,
                    (SELECT COUNT(*) FROM user_progress p WHERE p.lesson_id = l.id AND p.status = 'completed') AS completed,
                    (SELECT ROUND(AVG(q.percentage)) FROM quiz_results q WHERE q.lesson_id = l.id) AS quiz_avg,
                    (SELECT COUNT(*) FROM quiz_results q WHERE q.lesson_id = l.id) AS quiz_attempts
             FROM lessons l JOIN modules m ON m.id = l.module_id JOIN courses c ON c.id = m.course_id
             JOIN categories cat ON cat.id = c.category_id
             ORDER BY completed DESC, c.level, cat.sort_order, m.sort_order, l.sort_order LIMIT " . (int) $limit
        );
    }

    /** Exercices les plus difficiles (taux de réussite le plus bas). */
    public static function hardestExercises(int $limit = 10): array
    {
        return Database::fetchAll(
            'SELECT e.title, e.slug, e.type, COUNT(a.id) AS attempts, SUM(a.is_correct) AS successes,
                    ROUND(SUM(a.is_correct) / COUNT(a.id) * 100) AS rate
             FROM exercises e JOIN exercise_attempts a ON a.exercise_id = e.id
             GROUP BY e.id HAVING attempts >= 1 ORDER BY rate ASC, attempts DESC LIMIT ' . (int) $limit
        );
    }

    /** Progression d'un apprenant (vue administrateur). */
    public static function userDetail(int $userId): array
    {
        return [
            'overview'  => ProgressModel::overview($userId),
            'stats'     => ProgressModel::stats($userId),
            'lessons'   => ProgressModel::completedLessons($userId),
            'badges'    => BadgeService::earned($userId),
            'activity'  => ActivityModel::forUser($userId, 15),
            'projects'  => Database::fetchAll(
                'SELECT p.title, s.status, s.auto_score, s.updated_at FROM project_submissions s
                 JOIN projects p ON p.id = s.project_id WHERE s.user_id = ?',
                [$userId]
            ),
        ];
    }
}
