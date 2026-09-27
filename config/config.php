<?php
/**
 * Configuration générale de l'application.
 *
 * Toutes les valeurs sensibles ou dépendantes de l'environnement sont lues
 * depuis des variables d'environnement. Pour un usage local, copiez
 * config/local.example.php vers config/local.php (ignoré par Git) :
 * les valeurs qu'il retourne écrasent celles-ci.
 */

declare(strict_types=1);

$env = static fn (string $key, $default = null) => ($v = getenv($key)) !== false && $v !== '' ? $v : $default;

$config = [
    'app' => [
        'name'        => $env('APP_NAME', 'HTML & CSS Academy'),
        'env'         => $env('APP_ENV', 'production'),          // production | development
        'debug'       => filter_var($env('APP_DEBUG', 'false'), FILTER_VALIDATE_BOOLEAN),
        'url'         => rtrim((string) $env('APP_URL', ''), '/'), // URL absolue (SEO, e-mails, sitemap)
        'base_path'   => $env('APP_BASE_PATH'),                    // null = détection automatique
        'pretty_urls' => filter_var($env('APP_PRETTY_URLS', 'true'), FILTER_VALIDATE_BOOLEAN),
        'timezone'    => $env('APP_TIMEZONE', 'Europe/Paris'),
        'locale'      => 'fr_FR',
    ],

    'security' => [
        'session_name'          => 'hca_session',
        'session_lifetime'      => 7200,     // secondes d'inactivité avant expiration
        'remember_days'         => 30,       // durée du cookie "rester connecté"
        'login_max_attempts'    => 5,        // tentatives échouées autorisées...
        'login_window_minutes'  => 15,       // ...sur cette fenêtre glissante
        'password_min_length'   => 8,
        'reset_token_minutes'   => 60,
        'force_https_cookies'   => filter_var($env('APP_SECURE_COOKIES', 'auto'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
    ],

    'mail' => [
        // "log" écrit les e-mails dans storage/logs/mail.log (développement).
        // "mail" utilise la fonction mail() de PHP. Un driver SMTP peut être ajouté dans Mailer.
        'driver'    => $env('MAIL_DRIVER', 'log'),
        'from'      => $env('MAIL_FROM', 'no-reply@academy.local'),
        'from_name' => $env('MAIL_FROM_NAME', 'HTML & CSS Academy'),
    ],

    'learning' => [
        'quiz_pass_percentage'  => 70,
        'lesson_points'         => 10,
    ],
];

$local = __DIR__ . '/local.php';
if (is_file($local)) {
    $overrides = require $local;
    if (is_array($overrides)) {
        $config = array_replace_recursive($config, $overrides);
    }
}

return $config;
