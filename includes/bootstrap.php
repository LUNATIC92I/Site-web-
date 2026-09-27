<?php
/**
 * Point d'entrée commun à toutes les pages.
 * Charge la configuration, l'autoloader, la gestion d'erreurs, la session
 * sécurisée et l'utilisateur courant.
 */

declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));

$GLOBALS['__config'] = require ROOT_PATH . '/config/config.php';
date_default_timezone_set($GLOBALS['__config']['app']['timezone']);
mb_internal_encoding('UTF-8');

// Autoloader : includes/classes/NomDeClasse.php
spl_autoload_register(static function (string $class): void {
    $file = ROOT_PATH . '/includes/classes/' . basename(str_replace('\\', '/', $class)) . '.php';
    if (is_file($file)) {
        require $file;
    }
});

require ROOT_PATH . '/includes/functions.php';
require ROOT_PATH . '/includes/security.php';
require ROOT_PATH . '/includes/auth.php';

// ------------------------------------------------------------------ Erreurs
error_reporting(E_ALL);
ini_set('display_errors', config('app.debug') ? '1' : '0');
ini_set('log_errors', '1');

set_exception_handler(static function (Throwable $e): void {
    Logger::error($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
    if (!headers_sent()) {
        http_response_code(500);
    }
    if (is_api_request()) {
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
        }
        echo json_encode(['ok' => false, 'error' => 'Une erreur interne est survenue.']);
        return;
    }
    $debugMessage = config('app.debug') ? $e->getMessage() . ' (' . basename($e->getFile()) . ':' . $e->getLine() . ')' : null;
    require ROOT_PATH . '/includes/error-page.php';
});

// ------------------------------------------------------------------ Session & en-têtes
if (PHP_SAPI !== 'cli') {
    send_security_headers();
    start_secure_session();
    auto_login_from_cookie();
    touch_user_activity();
}
