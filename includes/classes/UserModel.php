<?php
declare(strict_types=1);

/** Accès aux données des utilisateurs. */
final class UserModel
{
    private const PUBLIC_COLUMNS = 'id, first_name, last_name, email, role, is_active, bio, last_login_at, last_activity_at, created_at, updated_at';

    public static function find(int $id): ?array
    {
        return Database::fetch('SELECT ' . self::PUBLIC_COLUMNS . ' FROM users WHERE id = ?', [$id]);
    }

    /** Inclut le hash du mot de passe : réservé à l'authentification. */
    public static function findForAuth(string $email): ?array
    {
        return Database::fetch('SELECT * FROM users WHERE email = ?', [mb_strtolower(trim($email))]);
    }

    public static function emailExists(string $email, ?int $exceptId = null): bool
    {
        return (bool) Database::value(
            'SELECT 1 FROM users WHERE email = ? AND id <> ?',
            [mb_strtolower(trim($email)), $exceptId ?? 0]
        );
    }

    public static function create(string $first, string $last, string $email, string $password, string $role = 'student'): int
    {
        return Database::insert('users', [
            'first_name'    => $first,
            'last_name'     => $last,
            'email'         => mb_strtolower(trim($email)),
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role'          => $role,
        ]);
    }

    public static function updateProfile(int $id, string $first, string $last, string $email, ?string $bio): void
    {
        Database::update('users', [
            'first_name' => $first,
            'last_name'  => $last,
            'email'      => mb_strtolower(trim($email)),
            'bio'        => $bio,
        ], $id);
    }

    public static function updatePassword(int $id, string $password): void
    {
        Database::update('users', ['password_hash' => password_hash($password, PASSWORD_DEFAULT)], $id);
        // Toute session "rester connecté" existante est révoquée
        Database::run('DELETE FROM remember_tokens WHERE user_id = ?', [$id]);
    }

    public static function verifyPassword(int $id, string $password): bool
    {
        $hash = Database::value('SELECT password_hash FROM users WHERE id = ?', [$id]);
        return is_string($hash) && password_verify($password, $hash);
    }

    public static function rehashIfNeeded(array $user, string $password): void
    {
        if (password_needs_rehash($user['password_hash'], PASSWORD_DEFAULT)) {
            Database::update('users', ['password_hash' => password_hash($password, PASSWORD_DEFAULT)], (int) $user['id']);
        }
    }

    public static function touchLogin(int $id): void
    {
        Database::run('UPDATE users SET last_login_at = NOW(), last_activity_at = NOW() WHERE id = ?', [$id]);
    }

    /** Liste paginée pour l'administration. */
    public static function paginate(string $search, int $page, int $perPage = 20): array
    {
        $where = '';
        $params = [];
        if ($search !== '') {
            $where = 'WHERE u.email LIKE ? OR u.first_name LIKE ? OR u.last_name LIKE ?';
            $like = '%' . addcslashes($search, '%_\\') . '%';
            $params = [$like, $like, $like];
        }
        $total = (int) Database::value("SELECT COUNT(*) FROM users u $where", $params);
        $offset = max(0, ($page - 1) * $perPage);
        $rows = Database::fetchAll(
            "SELECT u.id, u.first_name, u.last_name, u.email, u.role, u.is_active, u.created_at, u.last_activity_at,
                    (SELECT COUNT(*) FROM user_progress p WHERE p.user_id = u.id AND p.status = 'completed') AS lessons_done
             FROM users u $where ORDER BY u.created_at DESC LIMIT $perPage OFFSET $offset",
            $params
        );
        return ['rows' => $rows, 'total' => $total, 'pages' => max(1, (int) ceil($total / $perPage))];
    }

    public static function setRole(int $id, string $role): void
    {
        Database::update('users', ['role' => $role === 'admin' ? 'admin' : 'student'], $id);
    }

    public static function setActive(int $id, bool $active): void
    {
        Database::update('users', ['is_active' => $active ? 1 : 0], $id);
        if (!$active) {
            Database::run('DELETE FROM remember_tokens WHERE user_id = ?', [$id]);
        }
    }

    public static function delete(int $id): void
    {
        Database::delete('users', $id);
    }

    public static function countAdmins(): int
    {
        return (int) Database::value("SELECT COUNT(*) FROM users WHERE role = 'admin' AND is_active = 1");
    }

    /**
     * Classement : points = leçons x10 + points des exercices réussis
     * + quiz validés x5 + projets validés x50.
     */
    public static function leaderboard(int $limit = 50): array
    {
        return Database::fetchAll(
            "SELECT u.id, u.first_name, u.last_name,
                    COALESCE(l.cnt, 0) AS lessons,
                    COALESCE(x.pts, 0) AS exercise_points,
                    COALESCE(q.cnt, 0) AS quizzes,
                    COALESCE(pr.cnt, 0) AS projects,
                    COALESCE(b.cnt, 0) AS badges,
                    COALESCE(l.cnt, 0) * 10 + COALESCE(x.pts, 0) + COALESCE(q.cnt, 0) * 5 + COALESCE(pr.cnt, 0) * 50 AS points
             FROM users u
             LEFT JOIN (SELECT user_id, COUNT(*) cnt FROM user_progress WHERE status = 'completed' GROUP BY user_id) l ON l.user_id = u.id
             LEFT JOIN (SELECT a.user_id, SUM(e.points) pts
                        FROM (SELECT DISTINCT user_id, exercise_id FROM exercise_attempts WHERE is_correct = 1) a
                        JOIN exercises e ON e.id = a.exercise_id GROUP BY a.user_id) x ON x.user_id = u.id
             LEFT JOIN (SELECT user_id, COUNT(DISTINCT lesson_id) cnt FROM quiz_results WHERE passed = 1 GROUP BY user_id) q ON q.user_id = u.id
             LEFT JOIN (SELECT user_id, COUNT(*) cnt FROM project_submissions WHERE status IN ('validated','approved') GROUP BY user_id) pr ON pr.user_id = u.id
             LEFT JOIN (SELECT user_id, COUNT(*) cnt FROM user_badges GROUP BY user_id) b ON b.user_id = u.id
             WHERE u.is_active = 1 AND u.role = 'student'
             HAVING points > 0
             ORDER BY points DESC, badges DESC, u.id ASC
             LIMIT " . (int) $limit
        );
    }
}
