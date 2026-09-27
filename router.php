<?php
/**
 * Routeur pour le serveur intégré de PHP (développement uniquement) :
 *   php -S localhost:8000 router.php
 * Reproduit les règles de réécriture et les protections du fichier .htaccess.
 */
declare(strict_types=1);

$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/');

// Dossiers internes interdits
if (preg_match('#^/(config|includes|database|storage)(/|$)#i', $path) || preg_match('#(^|/)\.(git|env|htaccess)#', $path)
    || preg_match('#\.(sql|log|md)$#i', $path)) {
    http_response_code(403);
    echo 'Accès interdit';
    return true;
}

$routes = [
    '#^/cours/?$#'                     => ['courses/index.php', []],
    '#^/cours/([a-z0-9-]+)/?$#'        => ['courses/course.php', ['slug']],
    '#^/lecon/([a-z0-9-]+)/?$#'        => ['courses/lesson.php', ['slug']],
    '#^/parcours/?$#'                  => ['parcours.php', []],
    '#^/exercices/?$#'                 => ['exercises/index.php', []],
    '#^/exercice/([a-z0-9-]+)/?$#'     => ['exercises/exercise.php', ['slug']],
    '#^/projets/?$#'                   => ['projects/index.php', []],
    '#^/projet/([a-z0-9-]+)/?$#'       => ['projects/project.php', ['slug']],
    '#^/classement/?$#'                => ['leaderboard.php', []],
    '#^/editeur/?$#'                   => ['playground.php', []],
    '#^/certificat/([A-Za-z0-9]+)/?$#' => ['certificate.php', ['id']],
    '#^/sitemap\.xml$#'                => ['sitemap.php', []],
];

foreach ($routes as $pattern => [$file, $params]) {
    if (preg_match($pattern, $path, $m)) {
        foreach ($params as $i => $name) {
            $_GET[$name] = $m[$i + 1];
        }
        $_SERVER['SCRIPT_NAME'] = '/' . $file;
        chdir(__DIR__ . '/' . dirname($file));
        require __DIR__ . '/' . $file;
        return true;
    }
}

$file = __DIR__ . $path;
if ($path !== '/' && is_file($file)) {
    return false; // fichier statique ou script PHP existant : servi normalement
}
if (is_dir($file) && is_file(rtrim($file, '/') . '/index.php')) {
    return false;
}

http_response_code(404);
require __DIR__ . '/404.php';
return true;
