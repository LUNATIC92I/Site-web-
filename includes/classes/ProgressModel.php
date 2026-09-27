<?php
declare(strict_types=1);

/** Progression de l'apprenant : leçons, statistiques, recommandations. */
final class ProgressModel
{
    public static function markStarted(int $userId, int $lessonId): void
    {
        Database::run(
            "INSERT INTO user_progress (user_id, lesson_id, status) VALUES (?, ?, 'started')
             ON DUPLICATE KEY UPDATE updated_at = NOW()",
            [$userId, $lessonId]
        );
    }

    /** @return bool true si la leçon vient d'être terminée (et ne l'était pas avant). */
    public static function complete(int $userId, int $lessonId): bool
    {
        $already = self::isCompleted($userId, $lessonId);
        if ($already) {
            return false;
        }
        Database::run(
            "INSERT INTO user_progress (user_id, lesson_id, status, completed_at) VALUES (?, ?, 'completed', NOW())
             ON DUPLICATE KEY UPDATE status = 'completed', completed_at = NOW()",
            [$userId, $lessonId]
        );
        return true;
    }

    public static function isCompleted(int $userId, int $lessonId): bool
    {
        return (bool) Database::value(
            "SELECT 1 FROM user_progress WHERE user_id = ? AND lesson_id = ? AND status = 'completed'",
            [$userId, $lessonId]
        );
    }

    /** @return array<int,true> ids des leçons terminées */
    public static function completedIds(int $userId): array
    {
        $ids = Database::column("SELECT lesson_id FROM user_progress WHERE user_id = ? AND status = 'completed'", [$userId]);
        return array_fill_keys(array_map('intval', $ids), true);
    }

    /**
     * Progression par catégorie (html, css) et globale.
     * @return array{global:array, categories:array<string,array>}
     */
    public static function overview(int $userId): array
    {
        $done = self::completedIds($userId);
        $cats = [];
        $total = 0;
        $completed = 0;
        foreach (LessonModel::ordered() as $l) {
            $slug = $l['category_slug'];
            $cats[$slug] ??= ['name' => $l['category_name'], 'total' => 0, 'done' => 0];
            $cats[$slug]['total']++;
            $total++;
            if (isset($done[(int) $l['id']])) {
                $cats[$slug]['done']++;
                $completed++;
            }
        }
        foreach ($cats as &$c) {
            $c['percent'] = $c['total'] ? (int) floor($c['done'] / $c['total'] * 100) : 0;
        }
        return [
            'global'     => ['total' => $total, 'done' => $completed, 'percent' => $total ? (int) floor($completed / $total * 100) : 0],
            'categories' => $cats,
        ];
    }

    /** Progression par cours : [course_id => [total, done, percent]] */
    public static function byCourse(int $userId): array
    {
        $done = self::completedIds($userId);
        $out = [];
        foreach (LessonModel::ordered() as $l) {
            $cid = (int) $l['course_id'];
            $out[$cid] ??= ['total' => 0, 'done' => 0, 'percent' => 0];
            $out[$cid]['total']++;
            if (isset($done[(int) $l['id']])) {
                $out[$cid]['done']++;
            }
        }
        foreach ($out as &$c) {
            $c['percent'] = $c['total'] ? (int) floor($c['done'] / $c['total'] * 100) : 0;
        }
        return $out;
    }

    /** Prochaine leçon recommandée : la première non terminée dans l'ordre du parcours. */
    public static function nextLesson(int $userId): ?array
    {
        $done = self::completedIds($userId);
        foreach (LessonModel::ordered() as $l) {
            if (!isset($done[(int) $l['id']])) {
                return $l;
            }
        }
        return null;
    }

    public static function stats(int $userId): array
    {
        $row = Database::fetch(
            "SELECT
                (SELECT COUNT(*) FROM user_progress WHERE user_id = :u1 AND status = 'completed') AS lessons_completed,
                (SELECT COUNT(DISTINCT exercise_id) FROM exercise_attempts WHERE user_id = :u2 AND is_correct = 1) AS exercises_passed,
                (SELECT COUNT(*) FROM exercise_attempts WHERE user_id = :u3) AS exercise_attempts,
                (SELECT COUNT(DISTINCT lesson_id) FROM quiz_results WHERE user_id = :u4 AND passed = 1) AS quizzes_passed,
                (SELECT COUNT(*) FROM user_badges WHERE user_id = :u5) AS badges,
                (SELECT COUNT(*) FROM project_submissions WHERE user_id = :u6) AS projects_submitted",
            ['u1' => $userId, 'u2' => $userId, 'u3' => $userId, 'u4' => $userId, 'u5' => $userId, 'u6' => $userId]
        );
        // Score moyen : moyenne du meilleur résultat de chaque quiz tenté
        $avg = Database::value(
            'SELECT ROUND(AVG(best)) FROM (SELECT MAX(percentage) AS best FROM quiz_results WHERE user_id = ? GROUP BY lesson_id) t',
            [$userId]
        );
        $row['average_score'] = $avg !== null ? (int) $avg : null;
        return array_map(static fn ($v) => $v === null ? null : (int) $v, $row);
    }

    /** Leçons terminées récemment (tableau de progression détaillée). */
    public static function completedLessons(int $userId): array
    {
        return Database::fetchAll(
            "SELECT l.title, l.slug, p.completed_at, cat.name AS category_name,
                    (SELECT MAX(q.percentage) FROM quiz_results q WHERE q.user_id = p.user_id AND q.lesson_id = l.id) AS best_quiz
             FROM user_progress p
             JOIN lessons l ON l.id = p.lesson_id
             JOIN modules m ON m.id = l.module_id JOIN courses c ON c.id = m.course_id
             JOIN categories cat ON cat.id = c.category_id
             WHERE p.user_id = ? AND p.status = 'completed'
             ORDER BY p.completed_at DESC",
            [$userId]
        );
    }

    /** Un cours (par slug) est-il entièrement terminé ? */
    public static function courseCompleted(int $userId, string $courseSlug): bool
    {
        $row = Database::fetch(
            "SELECT COUNT(l.id) AS total, COUNT(p.id) AS done
             FROM courses c JOIN modules m ON m.course_id = c.id
             JOIN lessons l ON l.module_id = m.id AND l.is_published = 1
             LEFT JOIN user_progress p ON p.lesson_id = l.id AND p.user_id = ? AND p.status = 'completed'
             WHERE c.slug = ?",
            [$userId, $courseSlug]
        );
        return $row && (int) $row['total'] > 0 && (int) $row['total'] === (int) $row['done'];
    }

    public static function moduleCompleted(int $userId, string $moduleSlug): bool
    {
        $row = Database::fetch(
            "SELECT COUNT(l.id) AS total, COUNT(p.id) AS done
             FROM modules m JOIN lessons l ON l.module_id = m.id AND l.is_published = 1
             LEFT JOIN user_progress p ON p.lesson_id = l.id AND p.user_id = ? AND p.status = 'completed'
             WHERE m.slug = ?",
            [$userId, $moduleSlug]
        );
        return $row && (int) $row['total'] > 0 && (int) $row['total'] === (int) $row['done'];
    }

    /** Toutes les leçons publiées sont-elles terminées ? */
    public static function pathCompleted(int $userId): bool
    {
        $o = self::overview($userId);
        return $o['global']['total'] > 0 && $o['global']['done'] === $o['global']['total'];
    }

    /** Leçon débloquée ? (réglage "progression libre" désactivable par l'admin) */
    public static function canAccess(?int $userId, array $lesson): bool
    {
        if (setting('free_navigation', '1') === '1' || $userId === null) {
            return true;
        }
        $n = LessonModel::neighbours((int) $lesson['id']);
        return $n['prev'] === null || self::isCompleted($userId, (int) $n['prev']['id']) || self::isCompleted($userId, (int) $lesson['id']);
    }
}
