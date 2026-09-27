<?php
declare(strict_types=1);

/**
 * Attribution des badges. Chaque badge définit un critère (criteria_type)
 * et une valeur (criteria_value). L'évaluation est idempotente.
 */
final class BadgeService
{
    public const CRITERIA = [
        'lessons_completed'  => 'Nombre de leçons terminées',
        'exercises_passed'   => 'Nombre d’exercices réussis',
        'course_completed'   => 'Cours terminé (slug du cours)',
        'module_completed'   => 'Module(s) terminé(s) (slugs séparés par des virgules)',
        'projects_submitted' => 'Nombre de projets soumis',
        'final_project'      => 'Projet final validé',
        'perfect_quizzes'    => 'Nombre de quiz réussis à 100 %',
        'path_completed'     => 'Parcours complet terminé',
    ];

    public static function all(): array
    {
        return Database::fetchAll('SELECT * FROM badges ORDER BY sort_order, id');
    }

    /** Tous les badges avec la date d'obtention (null si non obtenu). */
    public static function forUser(int $userId): array
    {
        return Database::fetchAll(
            'SELECT b.*, ub.awarded_at FROM badges b
             LEFT JOIN user_badges ub ON ub.badge_id = b.id AND ub.user_id = ?
             ORDER BY b.sort_order, b.id',
            [$userId]
        );
    }

    public static function earned(int $userId): array
    {
        return Database::fetchAll(
            'SELECT b.*, ub.awarded_at FROM user_badges ub JOIN badges b ON b.id = ub.badge_id
             WHERE ub.user_id = ? ORDER BY ub.awarded_at DESC',
            [$userId]
        );
    }

    /**
     * Vérifie tous les badges non obtenus et attribue ceux dont le critère est rempli.
     * @return array<int,array{code:string,name:string,description:string,icon:string,color:string}>
     */
    public static function evaluate(int $userId): array
    {
        $pending = Database::fetchAll(
            'SELECT b.* FROM badges b
             WHERE NOT EXISTS (SELECT 1 FROM user_badges ub WHERE ub.badge_id = b.id AND ub.user_id = ?)
             ORDER BY b.sort_order',
            [$userId]
        );
        if (!$pending) {
            return [];
        }
        $stats = ProgressModel::stats($userId);
        $awarded = [];

        foreach ($pending as $badge) {
            if (!self::meets($userId, $badge, $stats)) {
                continue;
            }
            Database::run('INSERT IGNORE INTO user_badges (user_id, badge_id) VALUES (?, ?)', [$userId, $badge['id']]);
            ActivityModel::log($userId, 'badge_awarded', $badge['name']);
            $awarded[] = [
                'code'        => $badge['code'],
                'name'        => $badge['name'],
                'description' => $badge['description'],
                'icon'        => $badge['icon'],
                'color'       => $badge['color'],
            ];
        }
        return $awarded;
    }

    private static function meets(int $userId, array $badge, array $stats): bool
    {
        $value = trim((string) $badge['criteria_value']);
        return match ($badge['criteria_type']) {
            'lessons_completed'  => $stats['lessons_completed'] >= (int) $value,
            'exercises_passed'   => $stats['exercises_passed'] >= (int) $value,
            'projects_submitted' => $stats['projects_submitted'] >= (int) $value,
            'course_completed'   => ProgressModel::courseCompleted($userId, $value),
            'module_completed'   => self::allModulesCompleted($userId, $value),
            'final_project'      => (bool) Database::value(
                "SELECT 1 FROM project_submissions s JOIN projects p ON p.id = s.project_id
                 WHERE s.user_id = ? AND p.is_final = 1 AND s.status IN ('validated','approved') LIMIT 1",
                [$userId]
            ),
            'perfect_quizzes'    => (int) Database::value(
                'SELECT COUNT(DISTINCT lesson_id) FROM quiz_results WHERE user_id = ? AND percentage = 100',
                [$userId]
            ) >= (int) $value,
            'path_completed'     => ProgressModel::pathCompleted($userId),
            default              => false,
        };
    }

    private static function allModulesCompleted(int $userId, string $slugs): bool
    {
        $list = array_filter(array_map('trim', explode(',', $slugs)));
        foreach ($list as $slug) {
            if (!ProgressModel::moduleCompleted($userId, $slug)) {
                return false;
            }
        }
        return $list !== [];
    }

    // ------------------------------------------------------------ Administration

    public static function find(int $id): ?array
    {
        return Database::fetch('SELECT * FROM badges WHERE id = ?', [$id]);
    }

    public static function save(?int $id, array $data): int
    {
        if ($id) {
            Database::update('badges', $data, $id);
            return $id;
        }
        return Database::insert('badges', $data);
    }

    public static function delete(int $id): void
    {
        Database::delete('badges', $id);
    }

    public static function awardCounts(): array
    {
        return Database::fetchAll(
            'SELECT b.id, b.name, b.code, b.icon, b.color, b.criteria_type, b.criteria_value, b.description, b.sort_order,
                    COUNT(ub.id) AS awarded
             FROM badges b LEFT JOIN user_badges ub ON ub.badge_id = b.id
             GROUP BY b.id ORDER BY b.sort_order, b.id'
        );
    }
}
