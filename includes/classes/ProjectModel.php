<?php
declare(strict_types=1);

/** Projets pratiques et soumissions. */
final class ProjectModel
{
    public const STATUS = [
        'submitted' => 'En attente de revue',
        'validated' => 'Validé automatiquement',
        'approved'  => 'Approuvé par un formateur',
        'rejected'  => 'À retravailler',
    ];

    public static function all(): array
    {
        return Database::fetchAll(
            'SELECT p.*, cat.name AS category_name, cat.slug AS category_slug
             FROM projects p LEFT JOIN categories cat ON cat.id = p.category_id
             ORDER BY p.sort_order, p.id'
        );
    }

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetch(
            'SELECT p.*, cat.name AS category_name FROM projects p
             LEFT JOIN categories cat ON cat.id = p.category_id WHERE p.slug = ?',
            [$slug]
        );
    }

    public static function find(int $id): ?array
    {
        return Database::fetch('SELECT * FROM projects WHERE id = ?', [$id]);
    }

    public static function submission(int $userId, int $projectId): ?array
    {
        return Database::fetch('SELECT * FROM project_submissions WHERE user_id = ? AND project_id = ?', [$userId, $projectId]);
    }

    /** @return array<int,array> soumissions de l'utilisateur indexées par project_id */
    public static function submissionsFor(int $userId): array
    {
        $out = [];
        foreach (Database::fetchAll('SELECT * FROM project_submissions WHERE user_id = ?', [$userId]) as $s) {
            $out[(int) $s['project_id']] = $s;
        }
        return $out;
    }

    /**
     * Enregistre (ou met à jour) la soumission d'un projet.
     * Si toutes les règles automatiques passent, le projet est "validé".
     */
    public static function submit(int $userId, array $project, string $html, string $css, string $notes): array
    {
        $html = mb_substr($html, 0, 200000);
        $css = mb_substr($css, 0, 200000);
        $check = (new CodeChecker($html, $css))->check(json_list($project['validation_rules']));
        $existing = self::submission($userId, (int) $project['id']);

        // Un projet approuvé par un formateur reste approuvé s'il est toujours conforme
        $status = $check['passed'] ? 'validated' : 'submitted';
        if ($existing && $existing['status'] === 'approved' && $check['passed']) {
            $status = 'approved';
        }

        Database::run(
            'INSERT INTO project_submissions (user_id, project_id, html_code, css_code, notes, auto_score, status)
             VALUES (:u, :p, :h, :c, :n, :s, :st)
             ON DUPLICATE KEY UPDATE html_code = VALUES(html_code), css_code = VALUES(css_code), notes = VALUES(notes),
                auto_score = VALUES(auto_score), status = VALUES(status), feedback = IF(VALUES(status) = \'approved\', feedback, NULL),
                reviewed_by = IF(VALUES(status) = \'approved\', reviewed_by, NULL), reviewed_at = IF(VALUES(status) = \'approved\', reviewed_at, NULL)',
            ['u' => $userId, 'p' => $project['id'], 'h' => $html, 'c' => $css, 'n' => mb_substr($notes, 0, 2000), 's' => $check['score'], 'st' => $status]
        );

        ActivityModel::log($userId, 'project_submitted', $project['title']);
        $badges = BadgeService::evaluate($userId);
        return $check + ['status' => $status, 'badges' => $badges];
    }

    // ------------------------------------------------------------ Administration

    public static function save(?int $id, array $data): int
    {
        if ($id) {
            Database::update('projects', $data, $id);
            return $id;
        }
        return Database::insert('projects', $data);
    }

    public static function delete(int $id): void
    {
        Database::delete('projects', $id);
    }

    public static function submissionsForAdmin(string $status = ''): array
    {
        $where = $status !== '' && isset(self::STATUS[$status]) ? 'WHERE s.status = ?' : '';
        return Database::fetchAll(
            "SELECT s.id, s.status, s.auto_score, s.updated_at, s.feedback, p.title AS project_title, p.slug AS project_slug,
                    u.first_name, u.last_name, u.email
             FROM project_submissions s JOIN projects p ON p.id = s.project_id JOIN users u ON u.id = s.user_id
             $where ORDER BY s.updated_at DESC",
            $where ? [$status] : []
        );
    }

    public static function findSubmission(int $id): ?array
    {
        return Database::fetch(
            'SELECT s.*, p.title AS project_title, u.first_name, u.last_name, u.email
             FROM project_submissions s JOIN projects p ON p.id = s.project_id JOIN users u ON u.id = s.user_id
             WHERE s.id = ?',
            [$id]
        );
    }

    public static function review(int $submissionId, int $reviewerId, string $status, string $feedback): void
    {
        Database::run(
            'UPDATE project_submissions SET status = ?, feedback = ?, reviewed_by = ?, reviewed_at = NOW() WHERE id = ?',
            [$status, $feedback, $reviewerId, $submissionId]
        );
        $userId = (int) Database::value('SELECT user_id FROM project_submissions WHERE id = ?', [$submissionId]);
        if ($userId) {
            BadgeService::evaluate($userId);
        }
    }
}
