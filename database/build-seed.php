<?php
/**
 * Génère database/seed.sql à partir du contenu pédagogique de database/content/.
 *
 *   php database/build-seed.php
 *
 * Le contenu est rédigé dans des fichiers PHP (un par module) pour rester lisible
 * et versionnable ; ce script le convertit en requêtes INSERT avec des ids stables.
 * Les comptes de démonstration ne contiennent QUE des hash de mots de passe.
 */

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    exit('CLI uniquement');
}

const CONTENT = __DIR__ . '/content';
require __DIR__ . '/../includes/classes/CodeChecker.php';

/** Contrôle qualité : la solution doit valider toutes les règles, le code de départ non. */
function check_solution(string $label, array $rules, ?string $html, ?string $css, ?string $starterHtml, ?string $starterCss): void
{
    $res = (new CodeChecker((string) $html, (string) $css))->check($rules);
    if (!$res['passed']) {
        $failed = array_column(array_filter($res['results'], static fn ($r) => !$r['ok']), 'msg');
        fwrite(STDERR, "ERREUR — la solution de « $label » ne passe pas : " . implode(' | ', $failed) . "\n");
        exit(1);
    }
    if ((new CodeChecker((string) $starterHtml, (string) $starterCss))->check($rules)['passed']) {
        fwrite(STDERR, "Attention — le code de départ de « $label » valide déjà l'exercice.\n");
    }
}

// Mots de passe des comptes de DÉMONSTRATION (documentés dans le README, à supprimer en production).
// Seuls leurs hash sont écrits dans seed.sql.
const DEMO_PASSWORDS = ['admin' => 'Admin@2026!', 'student' => 'Demo@2026!'];

function q($v): string
{
    if ($v === null) {
        return 'NULL';
    }
    if (is_bool($v)) {
        return $v ? '1' : '0';
    }
    if (is_int($v)) {
        return (string) $v;
    }
    if (is_array($v)) {
        $v = json_encode($v, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    return "'" . str_replace(['\\', "'", "\0"], ['\\\\', "''", ''], (string) $v) . "'";
}

function insert(string $table, array $rows): string
{
    if (!$rows) {
        return '';
    }
    $cols = array_keys($rows[0]);
    $out = "INSERT INTO `$table` (`" . implode('`, `', $cols) . "`) VALUES\n";
    $values = [];
    foreach ($rows as $r) {
        $values[] = '(' . implode(', ', array_map('q', array_values($r))) . ')';
    }
    return $out . implode(",\n", $values) . ";\n\n";
}

function t(?string $s): ?string
{
    if ($s === null) {
        return null;
    }
    $s = trim(str_replace("\r\n", "\n", $s), "\n");
    return $s === '' ? null : $s;
}

$catalog = require CONTENT . '/catalog.php';

$categories = [];
$courses = [];
$modules = [];
$lessons = [];
$exercises = [];
$questions = [];
$answers = [];
$lessonOrder = [];     // ordre global du parcours (pour les comptes de démo)
$slugs = [];

$ids = ['cat' => 0, 'course' => 0, 'module' => 0, 'lesson' => 0, 'exercise' => 0, 'question' => 0, 'answer' => 0];
$catIds = [];

foreach ($catalog['categories'] as $i => $c) {
    $catIds[$c['slug']] = ++$ids['cat'];
    $categories[] = ['id' => $ids['cat'], 'name' => $c['name'], 'slug' => $c['slug'], 'description' => $c['description'], 'color' => $c['color'], 'sort_order' => $i + 1];
}

function unique_slug(string $slug, string $kind): void
{
    global $slugs;
    if (isset($slugs[$kind][$slug])) {
        fwrite(STDERR, "Slug en double ($kind) : $slug\n");
        exit(1);
    }
    $slugs[$kind][$slug] = true;
}

function add_question(array $q, ?int $lessonId, ?int $exerciseId, int $order): void
{
    global $ids, $questions, $answers;
    $qid = ++$ids['question'];
    $isTf = !empty($q['tf']);
    $choices = $isTf ? ['Vrai', 'Faux'] : $q['a'];
    $correct = $isTf ? ($q['c'] ? 0 : 1) : (int) $q['c'];
    if (!isset($choices[$correct])) {
        fwrite(STDERR, "Bonne réponse invalide : {$q['q']}\n");
        exit(1);
    }
    $questions[] = [
        'id' => $qid, 'lesson_id' => $lessonId, 'exercise_id' => $exerciseId, 'question' => $q['q'],
        'type' => $isTf ? 'truefalse' : 'single', 'code_snippet' => t($q['code'] ?? null),
        'explanation' => $q['e'] ?? null, 'sort_order' => $order,
    ];
    foreach ($choices as $i => $text) {
        $answers[] = ['id' => ++$ids['answer'], 'question_id' => $qid, 'answer_text' => $text, 'is_correct' => $i === $correct ? 1 : 0, 'sort_order' => $i];
    }
}

foreach ($catalog['courses'] as $ci => $course) {
    $courseId = ++$ids['course'];
    unique_slug($course['slug'], 'course');
    $courses[] = [
        'id' => $courseId, 'category_id' => $catIds[$course['category']], 'title' => $course['title'], 'slug' => $course['slug'],
        'level' => $course['level'], 'summary' => $course['summary'], 'description' => t($course['description']),
        'is_published' => 1, 'sort_order' => $ci + 1,
    ];
    foreach ($course['modules'] as $mi => $moduleFile) {
        if (getenv('PARTIAL') && !is_file(CONTENT . '/' . $moduleFile . '.php')) {
            continue; // mode développement : contenu en cours de rédaction
        }
        $module = require CONTENT . '/' . $moduleFile . '.php';
        $moduleId = ++$ids['module'];
        unique_slug($module['slug'], 'module');
        $modules[] = ['id' => $moduleId, 'course_id' => $courseId, 'title' => $module['title'], 'slug' => $module['slug'], 'description' => $module['description'] ?? null, 'sort_order' => $mi + 1];

        foreach ($module['lessons'] as $li => $L) {
            $lessonId = ++$ids['lesson'];
            unique_slug($L['slug'], 'lesson');
            $lessons[] = [
                'id' => $lessonId, 'module_id' => $moduleId, 'title' => $L['title'], 'slug' => $L['slug'],
                'duration_minutes' => $L['duration'] ?? 12,
                'introduction' => t($L['intro']),
                'objectives' => $L['objectives'] ?? null,
                'prerequisites' => $L['prerequisites'] ?? null,
                'theory' => t($L['theory']),
                'syntax_code' => t($L['syntax'] ?? null),
                'simple_html' => t($L['simple_html'] ?? null),
                'simple_css' => t($L['simple_css'] ?? null),
                'example_html' => t($L['example_html'] ?? null),
                'example_css' => t($L['example_css'] ?? null),
                'line_by_line' => $L['lines'] ?? null,
                'reference_items' => $L['reference'] ?? null,
                'common_mistakes' => $L['mistakes'] ?? null,
                'best_practices' => $L['practices'] ?? null,
                'practical' => t($L['practical'] ?? null),
                'summary_points' => $L['summary'] ?? null,
                'challenge' => t($L['challenge'] ?? null),
                'is_published' => 1,
                'sort_order' => $li + 1,
            ];
            $lessonOrder[] = ['id' => $lessonId, 'title' => $L['title'], 'level' => $course['level'], 'cat' => $course['category'], 'course_order' => $ci, 'module' => $mi, 'lesson' => $li];

            foreach ($L['exercises'] ?? [] as $xi => $X) {
                $exId = ++$ids['exercise'];
                $slug = $X['slug'] ?? $L['slug'] . '-ex' . ($xi + 1);
                unique_slug($slug, 'exercise');
                $type = $X['type'] ?? 'code';
                $exercises[] = [
                    'id' => $exId, 'lesson_id' => $lessonId, 'title' => $X['title'], 'slug' => $slug, 'type' => $type,
                    'difficulty' => $X['difficulty'] ?? 1, 'instructions' => t($X['instructions']),
                    'starter_html' => t($X['starter_html'] ?? null), 'starter_css' => t($X['starter_css'] ?? null),
                    'solution_html' => t($X['solution_html'] ?? null), 'solution_css' => t($X['solution_css'] ?? null),
                    'validation_rules' => in_array($type, ['qcm', 'truefalse'], true) ? null : ($X['rules'] ?? null),
                    'hint' => $X['hint'] ?? null, 'explanation' => $X['explanation'] ?? null,
                    'points' => $X['points'] ?? ($type === 'code' ? 15 : 10), 'sort_order' => $xi + 1,
                ];
                if (in_array($type, ['qcm', 'truefalse'], true)) {
                    add_question(['q' => $X['question'], 'a' => $X['answers'] ?? [], 'c' => $X['correct'], 'tf' => $type === 'truefalse', 'code' => $X['code'] ?? null], null, $exId, 0);
                } elseif (empty($X['rules'])) {
                    fwrite(STDERR, "Exercice sans règles : $slug\n");
                    exit(1);
                } else {
                    $solHtml = $X['solution_html'] ?? null;
                    // Exercice CSS sans solution HTML : on vérifie avec le HTML de départ
                    check_solution($slug, $X['rules'], $solHtml ?? ($X['starter_html'] ?? ''), $X['solution_css'] ?? null, $X['starter_html'] ?? null, $X['starter_css'] ?? null);
                }
            }
            foreach ($L['quiz'] ?? [] as $qi => $Q) {
                add_question($Q, $lessonId, null, $qi);
            }
        }
    }
}

// Ordre global identique à LessonModel::ORDER : niveau > catégorie > cours > module > leçon
usort($lessonOrder, static fn ($a, $b) => [$a['level'], $a['cat'] === 'html' ? 0 : 1, $a['course_order'], $a['module'], $a['lesson']]
    <=> [$b['level'], $b['cat'] === 'html' ? 0 : 1, $b['course_order'], $b['module'], $b['lesson']]);

// ---------------------------------------------------------------- Projets, badges, paramètres
$projectsData = require CONTENT . '/projects.php';
$projects = [];
foreach ($projectsData as $i => $p) {
    unique_slug($p['slug'], 'project');
    check_solution($p['slug'], $p['rules'], $p['solution_html'] ?? $p['starter_html'], $p['solution_css'] ?? null, $p['starter_html'] ?? null, $p['starter_css'] ?? null);
    $projects[] = [
        'id' => $i + 1, 'category_id' => isset($p['category']) ? $catIds[$p['category']] : null, 'title' => $p['title'], 'slug' => $p['slug'],
        'level' => $p['level'], 'summary' => $p['summary'], 'objective' => t($p['objective']), 'instructions' => t($p['instructions']),
        'steps' => $p['steps'], 'resources' => $p['resources'], 'success_criteria' => $p['criteria'],
        'starter_html' => t($p['starter_html'] ?? null), 'starter_css' => t($p['starter_css'] ?? null),
        'solution_html' => t($p['solution_html']), 'solution_css' => t($p['solution_css'] ?? null),
        'validation_rules' => $p['rules'], 'bonus_challenge' => t($p['bonus'] ?? null), 'is_final' => !empty($p['final']) ? 1 : 0, 'sort_order' => $i + 1,
    ];
}

$badges = [];
foreach (require CONTENT . '/badges.php' as $i => $b) {
    $badges[] = ['id' => $i + 1, 'code' => $b[0], 'name' => $b[1], 'description' => $b[2], 'icon' => $b[3], 'color' => $b[4], 'criteria_type' => $b[5], 'criteria_value' => $b[6], 'sort_order' => $i + 1];
}
$badgeId = array_column($badges, 'id', 'code');

$settings = [
    ['id' => 1, 'setting_key' => 'site_name', 'setting_value' => 'HTML & CSS Academy', 'label' => 'Nom du site'],
    ['id' => 2, 'setting_key' => 'site_description', 'setting_value' => 'Plateforme interactive pour apprendre HTML et CSS pas à pas : cours, éditeur de code, exercices, quiz, projets, badges et certificat.', 'label' => 'Description (SEO)'],
    ['id' => 3, 'setting_key' => 'contact_email', 'setting_value' => 'contact@academy.local', 'label' => 'E-mail de contact'],
    ['id' => 4, 'setting_key' => 'free_navigation', 'setting_value' => '1', 'label' => 'Navigation libre entre les leçons (sinon, déblocage progressif)'],
    ['id' => 5, 'setting_key' => 'show_demo_accounts', 'setting_value' => '1', 'label' => 'Afficher les comptes de démonstration sur la page de connexion'],
];

// ---------------------------------------------------------------- Comptes & activité de démonstration
$now = time();
$dt = static fn (int $daysAgo, int $h = 10, int $m = 0) => date('Y-m-d H:i:s', strtotime(date('Y-m-d', $now - $daysAgo * 86400)) + $h * 3600 + $m * 60);
$adminHash = password_hash(DEMO_PASSWORDS['admin'], PASSWORD_DEFAULT);
$studentHash = password_hash(DEMO_PASSWORDS['student'], PASSWORD_DEFAULT);

$users = [
    ['id' => 1, 'first_name' => 'Admin', 'last_name' => 'Academy', 'email' => 'admin@academy.test', 'password_hash' => $adminHash, 'role' => 'admin', 'is_active' => 1, 'bio' => 'Compte administrateur de démonstration.', 'last_login_at' => $dt(0, 9), 'last_activity_at' => $dt(0, 9), 'created_at' => $dt(40)],
    ['id' => 2, 'first_name' => 'Léa', 'last_name' => 'Martin', 'email' => 'demo@academy.test', 'password_hash' => $studentHash, 'role' => 'student', 'is_active' => 1, 'bio' => 'Apprenante de démonstration.', 'last_login_at' => $dt(1, 18), 'last_activity_at' => $dt(1, 18), 'created_at' => $dt(21)],
    ['id' => 3, 'first_name' => 'Karim', 'last_name' => 'Benali', 'email' => 'karim@academy.test', 'password_hash' => $studentHash, 'role' => 'student', 'is_active' => 1, 'bio' => null, 'last_login_at' => $dt(2), 'last_activity_at' => $dt(2), 'created_at' => $dt(28)],
    ['id' => 4, 'first_name' => 'Sofia', 'last_name' => 'Rossi', 'email' => 'sofia@academy.test', 'password_hash' => $studentHash, 'role' => 'student', 'is_active' => 1, 'bio' => null, 'last_login_at' => $dt(0, 8), 'last_activity_at' => $dt(0, 8), 'created_at' => $dt(35)],
    ['id' => 5, 'first_name' => 'Tom', 'last_name' => 'Dubois', 'email' => 'tom@academy.test', 'password_hash' => $studentHash, 'role' => 'student', 'is_active' => 1, 'bio' => null, 'last_login_at' => $dt(5), 'last_activity_at' => $dt(5), 'created_at' => $dt(9)],
];
// Nombre de leçons terminées par apprenant de démo
$demoProgress = [2 => 9, 3 => 5, 4 => 16, 5 => 2];

$exercisesByLesson = [];
foreach ($exercises as $x) {
    $exercisesByLesson[$x['lesson_id']][] = $x;
}
$questionsByLesson = [];
foreach ($questions as $qq) {
    if ($qq['lesson_id']) {
        $questionsByLesson[$qq['lesson_id']][] = $qq;
    }
}

$progressRows = $attemptRows = $quizRows = $activityRows = $userBadgeRows = [];
$pid = $aid = $qrid = $actid = $ubid = 0;
foreach ($demoProgress as $uid => $count) {
    $activityRows[] = ['id' => ++$actid, 'user_id' => $uid, 'action' => 'register', 'subject' => 'Création du compte', 'created_at' => $users[$uid - 1]['created_at']];
    $exPassed = 0;
    $perfect = 0;
    foreach (array_slice($lessonOrder, 0, $count) as $k => $lo) {
        $day = max(0, $count - $k);
        $when = $dt($day + ($uid % 3), 17 + ($k % 4), 5 * $k % 60);
        $progressRows[] = ['id' => ++$pid, 'user_id' => $uid, 'lesson_id' => $lo['id'], 'status' => 'completed', 'completed_at' => $when, 'created_at' => $when];
        foreach ($exercisesByLesson[$lo['id']] ?? [] as $xi => $x) {
            if ($xi > 0 && ($k + $uid) % 2) {
                continue;
            }
            $attemptRows[] = ['id' => ++$aid, 'user_id' => $uid, 'exercise_id' => $x['id'], 'submitted_html' => $x['solution_html'], 'submitted_css' => $x['solution_css'], 'is_correct' => 1, 'score' => 100, 'created_at' => $when];
            $exPassed++;
            $activityRows[] = ['id' => ++$actid, 'user_id' => $uid, 'action' => 'exercise_passed', 'subject' => $x['title'], 'created_at' => $when];
        }
        $total = count($questionsByLesson[$lo['id']] ?? []);
        if ($total) {
            $score = ($k + $uid) % 3 === 0 ? $total - 1 : $total;
            $pct = (int) round($score / $total * 100);
            $perfect += $pct === 100 ? 1 : 0;
            $quizRows[] = ['id' => ++$qrid, 'user_id' => $uid, 'lesson_id' => $lo['id'], 'score' => $score, 'total' => $total, 'percentage' => $pct, 'passed' => $pct >= 70 ? 1 : 0, 'answers_json' => null, 'created_at' => $when];
            $activityRows[] = ['id' => ++$actid, 'user_id' => $uid, 'action' => 'quiz_passed', 'subject' => $lo['title'] . " ($pct %)", 'created_at' => $when];
        }
        $activityRows[] = ['id' => ++$actid, 'user_id' => $uid, 'action' => 'lesson_completed', 'subject' => $lo['title'], 'created_at' => $when];
    }
    $earned = ['premier-cours'];
    if ($exPassed >= 1) $earned[] = 'premier-exercice';
    if ($exPassed >= 5) $earned[] = 'cinq-exercices';
    if ($perfect >= 5) $earned[] = 'quiz-parfait';
    foreach ($earned as $code) {
        $userBadgeRows[] = ['id' => ++$ubid, 'user_id' => $uid, 'badge_id' => $badgeId[$code], 'awarded_at' => $dt(1)];
        $activityRows[] = ['id' => ++$actid, 'user_id' => $uid, 'action' => 'badge_awarded', 'subject' => $badges[$badgeId[$code] - 1]['name'], 'created_at' => $dt(1)];
    }
}
// Une leçon en cours pour l'apprenante de démo
if (count($lessonOrder) > $demoProgress[2]) {
    $progressRows[] = ['id' => ++$pid, 'user_id' => 2, 'lesson_id' => $lessonOrder[$demoProgress[2]]['id'], 'status' => 'started', 'completed_at' => null, 'created_at' => $dt(1, 18)];
}
// Un exercice raté (statistiques de réussite réalistes)
$firstEx = $exercisesByLesson[$lessonOrder[0]['id']][0];
$attemptRows[] = ['id' => ++$aid, 'user_id' => 5, 'exercise_id' => $firstEx['id'], 'submitted_html' => '<p>Bienvenue</p>', 'submitted_css' => null, 'is_correct' => 0, 'score' => 0, 'created_at' => $dt(6)];

// ---------------------------------------------------------------- Écriture
$sql = "-- =====================================================================\n"
    . "-- HTML & CSS Academy — Données initiales (généré par database/build-seed.php)\n"
    . "-- Ne pas modifier à la main : éditez database/content/ puis relancez le script.\n"
    . "-- Contenu : " . count($categories) . " catégories, " . count($courses) . " cours, " . count($modules) . " modules, "
    . count($lessons) . " leçons, " . count($exercises) . " exercices, " . count($questions) . " questions, "
    . count($projects) . " projets, " . count($badges) . " badges.\n"
    . "-- Comptes de DÉMONSTRATION (voir README.md) : à supprimer avant une mise en production.\n"
    . "-- =====================================================================\n\n"
    . "SET NAMES utf8mb4;\nSET FOREIGN_KEY_CHECKS = 0;\n\n";

foreach (['activity_log', 'certificates', 'project_submissions', 'user_badges', 'quiz_results', 'exercise_attempts', 'user_progress', 'answers', 'questions', 'exercises', 'lessons', 'modules', 'courses', 'categories', 'projects', 'badges', 'settings', 'remember_tokens', 'password_resets', 'login_attempts', 'users'] as $table) {
    $sql .= "DELETE FROM `$table`;\n";
}
$sql .= "\n";

$sql .= insert('settings', $settings);
$sql .= insert('users', $users);
$sql .= insert('categories', $categories);
$sql .= insert('courses', $courses);
$sql .= insert('modules', $modules);
foreach (array_chunk($lessons, 10) as $chunk) {
    $sql .= insert('lessons', $chunk);
}
foreach (array_chunk($exercises, 25) as $chunk) {
    $sql .= insert('exercises', $chunk);
}
foreach (array_chunk($questions, 100) as $chunk) {
    $sql .= insert('questions', $chunk);
}
foreach (array_chunk($answers, 200) as $chunk) {
    $sql .= insert('answers', $chunk);
}
$sql .= insert('projects', $projects);
$sql .= insert('badges', $badges);
$sql .= insert('user_progress', $progressRows);
$sql .= insert('exercise_attempts', $attemptRows);
$sql .= insert('quiz_results', $quizRows);
$sql .= insert('user_badges', $userBadgeRows);
$sql .= insert('activity_log', $activityRows);
$sql .= "SET FOREIGN_KEY_CHECKS = 1;\n";

file_put_contents(__DIR__ . '/seed.sql', $sql);
printf(
    "seed.sql généré : %d cours, %d modules, %d leçons, %d exercices, %d questions, %d projets, %d badges (%s Ko)\n",
    count($courses), count($modules), count($lessons), count($exercises), count($questions), count($projects), count($badges),
    number_format(strlen($sql) / 1024, 0, ',', ' ')
);
