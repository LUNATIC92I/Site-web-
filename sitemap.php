<?php
/** Sitemap XML dynamique (servi sous /sitemap.xml grâce à la réécriture d'URL). */
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

header('Content-Type: application/xml; charset=utf-8');
$abs = static fn (string $routeUrl): string => absolute_url(substr($routeUrl, strlen(base_path())));

$urls = [
    [$abs(route('home')), '1.0', null],
    [$abs(route('courses')), '0.9', null],
    [$abs(route('path')), '0.8', null],
    [$abs(route('exercises')), '0.7', null],
    [$abs(route('projects')), '0.7', null],
    [$abs(route('playground')), '0.5', null],
    [$abs(route('leaderboard')), '0.3', null],
];
foreach (CourseModel::catalog() as $c) {
    $urls[] = [$abs(route('course', $c['slug'])), '0.8', $c['updated_at']];
}
foreach (Database::fetchAll('SELECT slug, updated_at FROM lessons WHERE is_published = 1') as $l) {
    $urls[] = [$abs(route('lesson', $l['slug'])), '0.7', $l['updated_at']];
}
foreach (Database::fetchAll('SELECT slug, updated_at FROM exercises') as $x) {
    $urls[] = [$abs(route('exercise', $x['slug'])), '0.5', $x['updated_at']];
}
foreach (ProjectModel::all() as $p) {
    $urls[] = [$abs(route('project', $p['slug'])), '0.6', $p['updated_at']];
}

echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', "\n";
foreach ($urls as [$loc, $priority, $lastmod]) {
    echo '  <url><loc>', htmlspecialchars($loc, ENT_XML1), '</loc>';
    if ($lastmod) {
        echo '<lastmod>', date('Y-m-d', strtotime($lastmod)), '</lastmod>';
    }
    echo '<priority>', $priority, '</priority></url>', "\n";
}
echo '</urlset>';
