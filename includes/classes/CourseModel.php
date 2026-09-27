<?php
declare(strict_types=1);

/** Catégories, cours et modules. */
final class CourseModel
{
    public static function categories(): array
    {
        return Database::fetchAll('SELECT * FROM categories ORDER BY sort_order, id');
    }

    /**
     * Catalogue complet (cours publiés), avec nombre de modules / leçons.
     * @return array<int,array> cours indexés par ordre de parcours
     */
    public static function catalog(): array
    {
        return Database::fetchAll(
            "SELECT c.*, cat.name AS category_name, cat.slug AS category_slug, cat.color AS category_color,
                    (SELECT COUNT(*) FROM modules m WHERE m.course_id = c.id) AS module_count,
                    (SELECT COUNT(*) FROM lessons l JOIN modules m ON m.id = l.module_id
                      WHERE m.course_id = c.id AND l.is_published = 1) AS lesson_count,
                    (SELECT COALESCE(SUM(l.duration_minutes), 0) FROM lessons l JOIN modules m ON m.id = l.module_id
                      WHERE m.course_id = c.id AND l.is_published = 1) AS duration
             FROM courses c JOIN categories cat ON cat.id = c.category_id
             WHERE c.is_published = 1
             ORDER BY c.level, cat.sort_order, c.sort_order"
        );
    }

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetch(
            'SELECT c.*, cat.name AS category_name, cat.slug AS category_slug, cat.color AS category_color
             FROM courses c JOIN categories cat ON cat.id = c.category_id
             WHERE c.slug = ?',
            [$slug]
        );
    }

    public static function find(int $id): ?array
    {
        return Database::fetch('SELECT * FROM courses WHERE id = ?', [$id]);
    }

    /** Modules d'un cours avec leurs leçons publiées. */
    public static function modulesWithLessons(int $courseId): array
    {
        $modules = Database::fetchAll('SELECT * FROM modules WHERE course_id = ? ORDER BY sort_order, id', [$courseId]);
        if (!$modules) {
            return [];
        }
        $ids = array_column($modules, 'id');
        $in = implode(',', array_fill(0, count($ids), '?'));
        $lessons = Database::fetchAll(
            "SELECT id, module_id, title, slug, duration_minutes, introduction
             FROM lessons WHERE module_id IN ($in) AND is_published = 1 ORDER BY sort_order, id",
            $ids
        );
        $byModule = [];
        foreach ($lessons as $l) {
            $byModule[$l['module_id']][] = $l;
        }
        foreach ($modules as &$m) {
            $m['lessons'] = $byModule[$m['id']] ?? [];
        }
        return $modules;
    }

    // ------------------------------------------------------------ Administration

    public static function allForAdmin(): array
    {
        return Database::fetchAll(
            'SELECT c.*, cat.name AS category_name,
                    (SELECT COUNT(*) FROM modules m WHERE m.course_id = c.id) AS module_count
             FROM courses c JOIN categories cat ON cat.id = c.category_id
             ORDER BY c.level, cat.sort_order, c.sort_order'
        );
    }

    public static function save(?int $id, array $data): int
    {
        if ($id) {
            Database::update('courses', $data, $id);
            return $id;
        }
        return Database::insert('courses', $data);
    }

    public static function delete(int $id): void
    {
        Database::delete('courses', $id);
    }

    public static function modulesForAdmin(): array
    {
        return Database::fetchAll(
            'SELECT m.*, c.title AS course_title,
                    (SELECT COUNT(*) FROM lessons l WHERE l.module_id = m.id) AS lesson_count
             FROM modules m JOIN courses c ON c.id = m.course_id
             JOIN categories cat ON cat.id = c.category_id
             ORDER BY c.level, cat.sort_order, c.sort_order, m.sort_order'
        );
    }

    public static function findModule(int $id): ?array
    {
        return Database::fetch('SELECT * FROM modules WHERE id = ?', [$id]);
    }

    public static function saveModule(?int $id, array $data): int
    {
        if ($id) {
            Database::update('modules', $data, $id);
            return $id;
        }
        return Database::insert('modules', $data);
    }

    public static function deleteModule(int $id): void
    {
        Database::delete('modules', $id);
    }

    public static function slugTaken(string $table, string $slug, int $exceptId = 0): bool
    {
        if (!in_array($table, ['courses', 'modules', 'lessons', 'exercises', 'projects', 'badges'], true)) {
            throw new InvalidArgumentException('Table non autorisée');
        }
        $column = $table === 'badges' ? 'code' : 'slug';
        return (bool) Database::value("SELECT 1 FROM `$table` WHERE `$column` = ? AND id <> ?", [$slug, $exceptId]);
    }
}
