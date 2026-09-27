<?php
/**
 * Paramètres de connexion MySQL / MariaDB.
 *
 * Ne jamais écrire de mot de passe de production dans ce fichier :
 * utilisez les variables d'environnement (DB_HOST, DB_NAME, DB_USER, DB_PASS...)
 * ou le fichier config/local.php (non versionné).
 */

declare(strict_types=1);

$env = static fn (string $key, $default = null) => ($v = getenv($key)) !== false ? $v : $default;

$database = [
    'host'     => $env('DB_HOST', '127.0.0.1'),
    'port'     => (int) $env('DB_PORT', 3306),
    'socket'   => $env('DB_SOCKET', ''),
    'name'     => $env('DB_NAME', 'html_css_academy'),
    'user'     => $env('DB_USER', 'root'),
    'pass'     => $env('DB_PASS', ''),
    'charset'  => 'utf8mb4',
];

$local = __DIR__ . '/local.php';
if (is_file($local)) {
    $overrides = require $local;
    if (is_array($overrides) && isset($overrides['database']) && is_array($overrides['database'])) {
        $database = array_replace($database, $overrides['database']);
    }
}

return $database;
