<?php
declare(strict_types=1);

/** Quiz de fin de leçon. */
final class QuizModel
{
    /** Questions + réponses d'une leçon. La bonne réponse n'est JAMAIS envoyée au client avant correction. */
    public static function forLesson(int $lessonId): array
    {
        $questions = Database::fetchAll(
            'SELECT id, question, type, code_snippet FROM questions WHERE lesson_id = ? ORDER BY sort_order, id',
            [$lessonId]
        );
        if (!$questions) {
            return [];
        }
        $ids = array_column($questions, 'id');
        $in = implode(',', array_fill(0, count($ids), '?'));
        $answers = Database::fetchAll(
            "SELECT id, question_id, answer_text FROM answers WHERE question_id IN ($in) ORDER BY sort_order, id",
            $ids
        );
        $byQ = [];
        foreach ($answers as $a) {
            $byQ[$a['question_id']][] = $a;
        }
        foreach ($questions as &$q) {
            $q['answers'] = $byQ[$q['id']] ?? [];
        }
        return $questions;
    }

    public static function count(int $lessonId): int
    {
        return (int) Database::value('SELECT COUNT(*) FROM questions WHERE lesson_id = ?', [$lessonId]);
    }

    /**
     * Corrige un quiz. $given = [question_id => answer_id].
     */
    public static function grade(int $userId, array $lesson, array $given): array
    {
        $lessonId = (int) $lesson['id'];
        $rows = Database::fetchAll(
            'SELECT q.id AS question_id, q.explanation, a.id AS answer_id, a.is_correct
             FROM questions q JOIN answers a ON a.question_id = q.id
             WHERE q.lesson_id = ?',
            [$lessonId]
        );
        if (!$rows) {
            return ['ok' => false, 'error' => 'Cette leçon ne contient pas de quiz.'];
        }

        $questions = [];
        foreach ($rows as $r) {
            $qid = (int) $r['question_id'];
            $questions[$qid] ??= ['explanation' => (string) $r['explanation'], 'answers' => [], 'correct' => null];
            $questions[$qid]['answers'][(int) $r['answer_id']] = true;
            if ($r['is_correct']) {
                $questions[$qid]['correct'] = (int) $r['answer_id'];
            }
        }

        $score = 0;
        $details = [];
        $stored = [];
        foreach ($questions as $qid => $q) {
            $chosen = isset($given[$qid]) ? (int) $given[$qid] : 0;
            // Une réponse n'est prise en compte que si elle appartient bien à la question (anti-manipulation)
            if (!isset($q['answers'][$chosen])) {
                $chosen = 0;
            }
            $ok = $chosen !== 0 && $chosen === $q['correct'];
            $score += $ok ? 1 : 0;
            $stored[$qid] = $chosen;
            $details[] = [
                'question_id' => $qid,
                'chosen'      => $chosen,
                'correct_id'  => $q['correct'],
                'ok'          => $ok,
                'explanation' => $q['explanation'],
            ];
        }

        $total = count($questions);
        $percentage = (int) round($score / $total * 100);
        $passed = $percentage >= (int) config('learning.quiz_pass_percentage');

        Database::insert('quiz_results', [
            'user_id'      => $userId,
            'lesson_id'    => $lessonId,
            'score'        => $score,
            'total'        => $total,
            'percentage'   => $percentage,
            'passed'       => $passed ? 1 : 0,
            'answers_json' => json_encode($stored),
        ]);

        ActivityModel::log($userId, $passed ? 'quiz_passed' : 'quiz_failed', $lesson['title'] . " ($percentage %)");
        // L'évaluation est idempotente : seuls les nouveaux badges sont retournés
        $badges = $passed ? BadgeService::evaluate($userId) : [];

        return [
            'ok'         => true,
            'score'      => $score,
            'total'      => $total,
            'percentage' => $percentage,
            'passed'     => $passed,
            'threshold'  => (int) config('learning.quiz_pass_percentage'),
            'details'    => $details,
            'badges'     => $badges,
        ];
    }

    public static function hasPassed(int $userId, int $lessonId): bool
    {
        return (bool) Database::value(
            'SELECT 1 FROM quiz_results WHERE user_id = ? AND lesson_id = ? AND passed = 1 LIMIT 1',
            [$userId, $lessonId]
        );
    }

    public static function best(int $userId, int $lessonId): ?int
    {
        $v = Database::value('SELECT MAX(percentage) FROM quiz_results WHERE user_id = ? AND lesson_id = ?', [$userId, $lessonId]);
        return $v === null ? null : (int) $v;
    }

    // ------------------------------------------------------------ Administration

    public static function questionsForAdmin(int $lessonId): array
    {
        $questions = Database::fetchAll('SELECT * FROM questions WHERE lesson_id = ? ORDER BY sort_order, id', [$lessonId]);
        foreach ($questions as &$q) {
            $q['answers'] = Database::fetchAll('SELECT * FROM answers WHERE question_id = ? ORDER BY sort_order, id', [$q['id']]);
        }
        return $questions;
    }

    public static function saveQuestion(?int $questionId, int $lessonId, array $data, array $answers, int $correctIndex): int
    {
        return Database::transaction(static function () use ($questionId, $lessonId, $data, $answers, $correctIndex) {
            $row = [
                'lesson_id'    => $lessonId,
                'question'     => $data['question'],
                'type'         => $data['type'] === 'truefalse' ? 'truefalse' : 'single',
                'code_snippet' => $data['code_snippet'] ?: null,
                'explanation'  => $data['explanation'] ?: null,
                'sort_order'   => (int) $data['sort_order'],
            ];
            if ($questionId) {
                Database::update('questions', $row, $questionId);
                Database::run('DELETE FROM answers WHERE question_id = ?', [$questionId]);
            } else {
                $questionId = Database::insert('questions', $row);
            }
            foreach (array_values($answers) as $i => $text) {
                Database::insert('answers', [
                    'question_id' => $questionId,
                    'answer_text' => $text,
                    'is_correct'  => $i === $correctIndex ? 1 : 0,
                    'sort_order'  => $i,
                ]);
            }
            return $questionId;
        });
    }

    public static function deleteQuestion(int $id): void
    {
        Database::delete('questions', $id);
    }

    public static function findQuestion(int $id): ?array
    {
        $q = Database::fetch('SELECT * FROM questions WHERE id = ?', [$id]);
        if ($q) {
            $q['answers'] = Database::fetchAll('SELECT * FROM answers WHERE question_id = ? ORDER BY sort_order, id', [$id]);
        }
        return $q;
    }
}
