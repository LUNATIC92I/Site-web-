<?php
declare(strict_types=1);

/** Exercices interactifs : code, compléter, corriger, QCM, vrai/faux. */
final class ExerciseModel
{
    public const TYPES = [
        'code'      => 'Exercice pratique',
        'fill'      => 'Compléter le code',
        'fix'       => 'Corriger le code',
        'qcm'       => 'QCM',
        'truefalse' => 'Vrai / Faux',
    ];

    private const BASE_SELECT =
        'SELECT e.*, l.title AS lesson_title, l.slug AS lesson_slug,
                cat.name AS category_name, cat.slug AS category_slug, c.level
         FROM exercises e
         LEFT JOIN lessons l ON l.id = e.lesson_id
         LEFT JOIN modules m ON m.id = l.module_id
         LEFT JOIN courses c ON c.id = m.course_id
         LEFT JOIN categories cat ON cat.id = c.category_id';

    public static function findBySlug(string $slug): ?array
    {
        return Database::fetch(self::BASE_SELECT . ' WHERE e.slug = ?', [$slug]);
    }

    public static function find(int $id): ?array
    {
        return Database::fetch(self::BASE_SELECT . ' WHERE e.id = ?', [$id]);
    }

    public static function forLesson(int $lessonId): array
    {
        return Database::fetchAll('SELECT * FROM exercises WHERE lesson_id = ? ORDER BY sort_order, id', [$lessonId]);
    }

    /** Catalogue filtrable des exercices. */
    public static function catalog(string $category = '', string $type = '', int $level = 0): array
    {
        $where = ['1 = 1'];
        $params = [];
        if ($category !== '') {
            $where[] = 'cat.slug = ?';
            $params[] = $category;
        }
        if ($type !== '' && isset(self::TYPES[$type])) {
            $where[] = 'e.type = ?';
            $params[] = $type;
        }
        if ($level >= 1 && $level <= 3) {
            $where[] = 'c.level = ?';
            $params[] = $level;
        }
        return Database::fetchAll(
            self::BASE_SELECT . ' WHERE ' . implode(' AND ', $where) . '
             ORDER BY c.level, cat.sort_order, c.sort_order, m.sort_order, l.sort_order, e.sort_order, e.id',
            $params
        );
    }

    /** @return array<int,true> ids des exercices réussis par l'utilisateur */
    public static function passedIds(int $userId): array
    {
        $ids = Database::column('SELECT DISTINCT exercise_id FROM exercise_attempts WHERE user_id = ? AND is_correct = 1', [$userId]);
        return array_fill_keys(array_map('intval', $ids), true);
    }

    /** Question + réponses d'un exercice QCM / Vrai-Faux (sans révéler la bonne réponse). */
    public static function question(int $exerciseId): ?array
    {
        $q = Database::fetch('SELECT id, question, code_snippet, type FROM questions WHERE exercise_id = ? ORDER BY sort_order, id LIMIT 1', [$exerciseId]);
        if (!$q) {
            return null;
        }
        $q['answers'] = Database::fetchAll('SELECT id, answer_text FROM answers WHERE question_id = ? ORDER BY sort_order, id', [$q['id']]);
        return $q;
    }

    /**
     * Correction d'une soumission, enregistrement de la tentative et attribution des badges.
     */
    public static function submit(int $userId, array $exercise, array $payload): array
    {
        $exerciseId = (int) $exercise['id'];
        $alreadyPassed = (bool) Database::value(
            'SELECT 1 FROM exercise_attempts WHERE user_id = ? AND exercise_id = ? AND is_correct = 1 LIMIT 1',
            [$userId, $exerciseId]
        );

        $html = mb_substr((string) ($payload['html'] ?? ''), 0, 100000);
        $css = mb_substr((string) ($payload['css'] ?? ''), 0, 100000);
        $answerId = null;

        if (in_array($exercise['type'], ['qcm', 'truefalse'], true)) {
            $answerId = (int) ($payload['answer_id'] ?? 0);
            $answer = Database::fetch(
                'SELECT a.id, a.is_correct FROM answers a JOIN questions q ON q.id = a.question_id
                 WHERE a.id = ? AND q.exercise_id = ?',
                [$answerId, $exerciseId]
            );
            if (!$answer) {
                return ['ok' => false, 'error' => 'Réponse invalide.'];
            }
            $passed = (bool) $answer['is_correct'];
            $correctId = (int) Database::value(
                'SELECT a.id FROM answers a JOIN questions q ON q.id = a.question_id WHERE q.exercise_id = ? AND a.is_correct = 1 LIMIT 1',
                [$exerciseId]
            );
            $result = [
                'passed'    => $passed,
                'score'     => $passed ? 100 : 0,
                'results'   => [],
                'correct_id' => $correctId,
            ];
            $html = $css = null;
        } else {
            $rules = json_list($exercise['validation_rules']);
            $result = (new CodeChecker($html, $css))->check($rules);
        }

        Database::insert('exercise_attempts', [
            'user_id'        => $userId,
            'exercise_id'    => $exerciseId,
            'submitted_html' => $html,
            'submitted_css'  => $css,
            'answer_id'      => $answerId ?: null,
            'is_correct'     => $result['passed'] ? 1 : 0,
            'score'          => $result['score'],
        ]);

        $badges = [];
        $firstSuccess = $result['passed'] && !$alreadyPassed;
        if ($firstSuccess) {
            ActivityModel::log($userId, 'exercise_passed', $exercise['title']);
            $badges = BadgeService::evaluate($userId);
        }

        return $result + [
            'ok'            => true,
            'first_success' => $firstSuccess,
            'points'        => $firstSuccess ? (int) $exercise['points'] : 0,
            'explanation'   => $result['passed'] || in_array($exercise['type'], ['qcm', 'truefalse'], true) ? (string) $exercise['explanation'] : '',
            'badges'        => $badges,
        ];
    }

    public static function lastAttempt(int $userId, int $exerciseId): ?array
    {
        return Database::fetch(
            'SELECT submitted_html, submitted_css, is_correct, score, created_at FROM exercise_attempts
             WHERE user_id = ? AND exercise_id = ? ORDER BY id DESC LIMIT 1',
            [$userId, $exerciseId]
        );
    }

    // ------------------------------------------------------------ Administration

    public static function allForAdmin(string $type = ''): array
    {
        $where = $type !== '' && isset(self::TYPES[$type]) ? 'WHERE e.type = ?' : '';
        return Database::fetchAll(
            "SELECT e.id, e.title, e.slug, e.type, e.difficulty, e.points, l.title AS lesson_title,
                    (SELECT COUNT(*) FROM exercise_attempts a WHERE a.exercise_id = e.id) AS attempts,
                    (SELECT COUNT(*) FROM exercise_attempts a WHERE a.exercise_id = e.id AND a.is_correct = 1) AS successes
             FROM exercises e LEFT JOIN lessons l ON l.id = e.lesson_id $where
             ORDER BY e.lesson_id IS NULL, e.lesson_id, e.sort_order, e.id",
            $where ? [$type] : []
        );
    }

    public static function save(?int $id, array $data): int
    {
        if ($id) {
            Database::update('exercises', $data, $id);
            return $id;
        }
        return Database::insert('exercises', $data);
    }

    public static function delete(int $id): void
    {
        Database::delete('exercises', $id);
    }

    /** Remplace la question/les réponses d'un exercice QCM ou Vrai/Faux. */
    public static function saveQuestion(int $exerciseId, string $type, string $question, ?string $code, array $answers, int $correctIndex): void
    {
        Database::transaction(static function () use ($exerciseId, $type, $question, $code, $answers, $correctIndex) {
            Database::run('DELETE FROM questions WHERE exercise_id = ?', [$exerciseId]);
            $qid = Database::insert('questions', [
                'exercise_id'  => $exerciseId,
                'question'     => $question,
                'type'         => $type === 'truefalse' ? 'truefalse' : 'single',
                'code_snippet' => $code ?: null,
            ]);
            foreach (array_values($answers) as $i => $text) {
                Database::insert('answers', [
                    'question_id' => $qid,
                    'answer_text' => $text,
                    'is_correct'  => $i === $correctIndex ? 1 : 0,
                    'sort_order'  => $i,
                ]);
            }
        });
    }

    public static function questionForAdmin(int $exerciseId): ?array
    {
        $q = Database::fetch('SELECT * FROM questions WHERE exercise_id = ? LIMIT 1', [$exerciseId]);
        if ($q) {
            $q['answers'] = Database::fetchAll('SELECT * FROM answers WHERE question_id = ? ORDER BY sort_order, id', [$q['id']]);
        }
        return $q;
    }
}
