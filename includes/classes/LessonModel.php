<?php
declare(strict_types=1);

/** Leçons et ordre global du parcours. */
final class LessonModel
{
    private static ?array $ordered = null;

    /** Ordre pédagogique global : niveau > catégorie > cours > module > leçon. */
    private const ORDER = 'c.level, cat.sort_order, c.sort_order, m.sort_order, m.id, l.sort_order, l.id';

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetch(
            'SELECT l.*, m.title AS module_title, m.slug AS module_slug, m.id AS module_id,
                    c.id AS course_id, c.title AS course_title, c.slug AS course_slug, c.level,
                    cat.name AS category_name, cat.slug AS category_slug, cat.color AS category_color
             FROM lessons l
             JOIN modules m ON m.id = l.module_id
             JOIN courses c ON c.id = m.course_id
             JOIN categories cat ON cat.id = c.category_id
             WHERE l.slug = ?',
            [$slug]
        );
    }

    public static function find(int $id): ?array
    {
        return Database::fetch('SELECT * FROM lessons WHERE id = ?', [$id]);
    }

    /** Liste ordonnée légère de toutes les leçons publiées (mise en cache par requête). */
    public static function ordered(): array
    {
        if (self::$ordered === null) {
            self::$ordered = Database::fetchAll(
                'SELECT l.id, l.slug, l.title, l.duration_minutes, m.id AS module_id, m.title AS module_title,
                        c.id AS course_id, c.title AS course_title, c.slug AS course_slug, c.level,
                        cat.slug AS category_slug, cat.name AS category_name
                 FROM lessons l
                 JOIN modules m ON m.id = l.module_id
                 JOIN courses c ON c.id = m.course_id
                 JOIN categories cat ON cat.id = c.category_id
                 WHERE l.is_published = 1 AND c.is_published = 1
                 ORDER BY ' . self::ORDER
            );
        }
        return self::$ordered;
    }

    /** @return array{prev:?array,next:?array,position:int,total:int} */
    public static function neighbours(int $lessonId): array
    {
        $list = self::ordered();
        foreach ($list as $i => $l) {
            if ((int) $l['id'] === $lessonId) {
                return [
                    'prev'     => $list[$i - 1] ?? null,
                    'next'     => $list[$i + 1] ?? null,
                    'position' => $i + 1,
                    'total'    => count($list),
                ];
            }
        }
        return ['prev' => null, 'next' => null, 'position' => 0, 'total' => count($list)];
    }

    public static function siblings(int $moduleId): array
    {
        return Database::fetchAll(
            'SELECT id, title, slug FROM lessons WHERE module_id = ? AND is_published = 1 ORDER BY sort_order, id',
            [$moduleId]
        );
    }

    public static function search(string $term, int $limit = 20): array
    {
        $like = '%' . addcslashes($term, '%_\\') . '%';
        return Database::fetchAll(
            'SELECT l.title, l.slug, l.introduction, m.title AS module_title, cat.name AS category_name
             FROM lessons l JOIN modules m ON m.id = l.module_id
             JOIN courses c ON c.id = m.course_id JOIN categories cat ON cat.id = c.category_id
             WHERE l.is_published = 1 AND (l.title LIKE ? OR l.introduction LIKE ? OR m.title LIKE ?)
             ORDER BY ' . self::ORDER . ' LIMIT ' . (int) $limit,
            [$like, $like, $like]
        );
    }

    // ------------------------------------------------------------ Administration

    public static function allForAdmin(?int $moduleId = null): array
    {
        $where = $moduleId ? 'WHERE l.module_id = ?' : '';
        return Database::fetchAll(
            "SELECT l.id, l.title, l.slug, l.is_published, l.sort_order, l.duration_minutes, l.updated_at,
                    m.title AS module_title, c.title AS course_title,
                    (SELECT COUNT(*) FROM questions q WHERE q.lesson_id = l.id) AS question_count,
                    (SELECT COUNT(*) FROM exercises e WHERE e.lesson_id = l.id) AS exercise_count
             FROM lessons l JOIN modules m ON m.id = l.module_id
             JOIN courses c ON c.id = m.course_id JOIN categories cat ON cat.id = c.category_id
             $where ORDER BY " . self::ORDER,
            $moduleId ? [$moduleId] : []
        );
    }

    public static function options(): array
    {
        return Database::fetchAll(
            'SELECT l.id, l.title, cat.name AS category_name, m.title AS module_title
             FROM lessons l JOIN modules m ON m.id = l.module_id
             JOIN courses c ON c.id = m.course_id JOIN categories cat ON cat.id = c.category_id
             ORDER BY ' . self::ORDER
        );
    }

    public static function save(?int $id, array $data): int
    {
        if ($id) {
            Database::update('lessons', $data, $id);
            return $id;
        }
        return Database::insert('lessons', $data);
    }

    public static function delete(int $id): void
    {
        Database::delete('lessons', $id);
    }
}
