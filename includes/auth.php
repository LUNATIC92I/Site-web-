<?php
/**
 * Authentification : utilisateur courant, connexion, déconnexion,
 * "rester connecté", contrôle des accès.
 */

declare(strict_types=1);

const REMEMBER_COOKIE = 'hca_remember';

function current_user(): ?array
{
    static $cache = false;
    if ($cache !== false) {
        return $cache;
    }
    $id = $_SESSION['user_id'] ?? null;
    if (!$id) {
        return $cache = null;
    }
    $user = UserModel::find((int) $id);
    if (!$user || !$user['is_active']) {
        // Compte supprimé ou désactivé : on invalide la session
        unset($_SESSION['user_id']);
        return $cache = null;
    }
    return $cache = $user;
}

function is_logged_in(): bool
{
    return current_user() !== null;
}

function is_admin(): bool
{
    return (current_user()['role'] ?? '') === 'admin';
}

function user_id(): ?int
{
    $u = current_user();
    return $u ? (int) $u['id'] : null;
}

function require_login(): array
{
    $user = current_user();
    if (!$user) {
        flash('info', 'Connectez-vous pour accéder à cette page.');
        redirect(url('auth/login.php') . '?redirect=' . rawurlencode(current_path()));
    }
    return $user;
}

function require_admin(): array
{
    $user = require_login();
    if ($user['role'] !== 'admin') {
        http_response_code(403);
        $errorCode = 403;
        require ROOT_PATH . '/includes/error-page.php';
        exit;
    }
    return $user;
}

/** Variante API : réponse JSON 401 au lieu d'une redirection. */
function require_api_user(): array
{
    $user = current_user();
    if (!$user) {
        json_response(['ok' => false, 'error' => 'Connectez-vous pour enregistrer votre progression.', 'login' => url('auth/login.php')], 401);
    }
    return $user;
}

function login_user(array $user, bool $remember = false): void
{
    session_regenerate_id(true);
    $_SESSION['user_id'] = (int) $user['id'];
    $_SESSION['created_at'] = time();
    regenerate_csrf();
    UserModel::touchLogin((int) $user['id']);
    ActivityModel::log((int) $user['id'], 'login', 'Connexion');

    if ($remember) {
        issue_remember_token((int) $user['id']);
    }
}

function logout_user(): void
{
    if (!empty($_COOKIE[REMEMBER_COOKIE])) {
        [$selector] = explode(':', (string) $_COOKIE[REMEMBER_COOKIE]) + [''];
        Database::run('DELETE FROM remember_tokens WHERE selector = ?', [$selector]);
        set_remember_cookie('', time() - 3600);
    }
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', [
            'expires' => time() - 42000, 'path' => $p['path'], 'secure' => $p['secure'],
            'httponly' => true, 'samesite' => 'Lax',
        ]);
    }
    session_destroy();
}

function issue_remember_token(int $userId): void
{
    $selector = bin2hex(random_bytes(12));
    $validator = bin2hex(random_bytes(32));
    $days = (int) config('security.remember_days');
    Database::insert('remember_tokens', [
        'user_id'        => $userId,
        'selector'       => $selector,
        'validator_hash' => hash('sha256', $validator),
        'expires_at'     => date('Y-m-d H:i:s', time() + $days * 86400),
    ]);
    set_remember_cookie($selector . ':' . $validator, time() + $days * 86400);
}

function set_remember_cookie(string $value, int $expires): void
{
    setcookie(REMEMBER_COOKIE, $value, [
        'expires'  => $expires,
        'path'     => (base_path() ?: '') . '/',
        'secure'   => cookies_secure(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

/** Reconnexion automatique grâce au cookie "rester connecté". */
function auto_login_from_cookie(): void
{
    if (!empty($_SESSION['user_id']) || empty($_COOKIE[REMEMBER_COOKIE])) {
        return;
    }
    $parts = explode(':', (string) $_COOKIE[REMEMBER_COOKIE]);
    if (count($parts) !== 2 || !ctype_xdigit($parts[0]) || !ctype_xdigit($parts[1])) {
        set_remember_cookie('', time() - 3600);
        return;
    }
    [$selector, $validator] = $parts;
    try {
        $token = Database::fetch('SELECT * FROM remember_tokens WHERE selector = ? AND expires_at > NOW()', [$selector]);
    } catch (Throwable $e) {
        Logger::error('Remember token lookup failed: ' . $e->getMessage());
        return;
    }
    if (!$token || !hash_equals($token['validator_hash'], hash('sha256', $validator))) {
        set_remember_cookie('', time() - 3600);
        return;
    }
    // Jeton à usage unique : on le remplace par un nouveau (rotation)
    Database::run('DELETE FROM remember_tokens WHERE id = ?', [$token['id']]);
    $user = UserModel::find((int) $token['user_id']);
    if ($user && $user['is_active']) {
        login_user($user, true);
    }
}

function touch_user_activity(): void
{
    if (empty($_SESSION['user_id'])) {
        return;
    }
    $last = $_SESSION['activity_touched'] ?? 0;
    if (time() - $last > 60) {
        $_SESSION['activity_touched'] = time();
        try {
            Database::run('UPDATE users SET last_activity_at = NOW() WHERE id = ?', [(int) $_SESSION['user_id']]);
        } catch (Throwable $e) {
            Logger::error('Activity update failed: ' . $e->getMessage());
        }
    }
}
