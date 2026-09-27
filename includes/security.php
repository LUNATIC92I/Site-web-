<?php
/**
 * Sécurité : en-têtes HTTP, session, jetons CSRF, limitation des tentatives.
 */

declare(strict_types=1);

function send_security_headers(): void
{
    if (headers_sent()) {
        return;
    }
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=()');
    header('Cross-Origin-Opener-Policy: same-origin');
    // Les aperçus de code utilisent des iframes "srcdoc" sandboxées sans scripts ;
    // elles héritent de cette CSP. Les styles en ligne y sont donc autorisés.
    header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; "
        . "img-src 'self' data: https:; media-src 'self' data: https:; font-src 'self' data: https:; "
        . "frame-src 'self' https:; connect-src 'self'; object-src 'none'; base-uri 'self'; "
        . "form-action 'self'; frame-ancestors 'self'");
    if (is_https()) {
        header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
    }
}

function cookies_secure(): bool
{
    $forced = config('security.force_https_cookies');
    return $forced === null ? is_https() : (bool) $forced;
}

function start_secure_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_httponly', '1');
    ini_set('session.use_trans_sid', '0');

    session_name(config('security.session_name'));
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => (base_path() ?: '') . '/',
        'secure'   => cookies_secure(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();

    // Expiration après inactivité
    $now = time();
    $lifetime = (int) config('security.session_lifetime');
    if (isset($_SESSION['last_seen']) && $now - $_SESSION['last_seen'] > $lifetime) {
        $_SESSION = [];
        session_regenerate_id(true);
    }
    $_SESSION['last_seen'] = $now;

    // Renouvellement périodique de l'identifiant (fixation de session)
    if (!isset($_SESSION['created_at'])) {
        $_SESSION['created_at'] = $now;
    } elseif ($now - $_SESSION['created_at'] > 900) {
        session_regenerate_id(true);
        $_SESSION['created_at'] = $now;
    }
}

// ------------------------------------------------------------------ CSRF

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function csrf_valid(?string $token): bool
{
    return is_string($token) && !empty($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/** À appeler au début de chaque traitement POST de formulaire. */
function verify_csrf(): void
{
    if (!csrf_valid($_POST['_csrf'] ?? null)) {
        http_response_code(403);
        flash('error', 'Votre session a expiré ou le formulaire est invalide. Merci de réessayer.');
        $ref = parse_url((string) ($_SERVER['HTTP_REFERER'] ?? ''));
        $back = ($ref['path'] ?? '') . (isset($ref['query']) ? '?' . $ref['query'] : '');
        redirect(safe_redirect_target($back, url('')));
    }
}

/** Vérification CSRF pour les appels API (en-tête X-CSRF-Token). */
function verify_api_csrf(): void
{
    if (!csrf_valid($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null)) {
        json_response(['ok' => false, 'error' => 'Jeton de sécurité invalide. Rechargez la page.'], 403);
    }
}

function regenerate_csrf(): void
{
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// ------------------------------------------------------------------ Limitation des tentatives

function client_ip(): string
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
}

function login_is_throttled(string $email): bool
{
    $window = (int) config('security.login_window_minutes');
    $max = (int) config('security.login_max_attempts');
    $since = date('Y-m-d H:i:s', time() - $window * 60);

    $byEmail = (int) Database::value(
        'SELECT COUNT(*) FROM login_attempts WHERE email = ? AND success = 0 AND attempted_at > ?',
        [mb_strtolower($email), $since]
    );
    $byIp = (int) Database::value(
        'SELECT COUNT(*) FROM login_attempts WHERE ip_address = ? AND success = 0 AND attempted_at > ?',
        [client_ip(), $since]
    );
    return $byEmail >= $max || $byIp >= $max * 4;
}

function record_login_attempt(string $email, bool $success): void
{
    Database::insert('login_attempts', [
        'email'      => mb_substr(mb_strtolower($email), 0, 190),
        'ip_address' => client_ip(),
        'success'    => $success ? 1 : 0,
    ]);
    if ($success) {
        Database::run('DELETE FROM login_attempts WHERE email = ? AND success = 0', [mb_strtolower($email)]);
    }
}

/** Limitation simple par session (formulaires publics : mot de passe oublié...). */
function session_rate_limited(string $key, int $max, int $seconds): bool
{
    $now = time();
    $hits = array_filter($_SESSION['rate'][$key] ?? [], static fn ($t) => $t > $now - $seconds);
    if (count($hits) >= $max) {
        $_SESSION['rate'][$key] = $hits;
        return true;
    }
    $hits[] = $now;
    $_SESSION['rate'][$key] = $hits;
    return false;
}
