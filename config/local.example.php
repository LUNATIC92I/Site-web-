<?php
/**
 * Exemple de configuration locale.
 * Copiez ce fichier en config/local.php et adaptez les valeurs.
 * config/local.php est ignoré par Git : vos identifiants ne sont jamais versionnés.
 */

return [
    'app' => [
        'env'   => 'development',
        'debug' => true,
        'url'   => 'http://localhost:8000',
        // 'base_path' => '/html-css-academy', // si le projet est dans un sous-dossier et que la détection échoue
        // 'pretty_urls' => false,             // si mod_rewrite n'est pas disponible
    ],
    'database' => [
        'host' => '127.0.0.1',
        'port' => 3306,
        'name' => 'html_css_academy',
        'user' => 'academy',
        'pass' => 'change-me',
    ],
    'mail' => [
        'driver' => 'log',
    ],
];
