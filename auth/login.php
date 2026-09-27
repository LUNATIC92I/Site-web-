<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$redirectTo = safe_redirect_target(input('redirect'), url('dashboard/index.php'));
if (is_logged_in()) {
    redirect($redirectTo);
}

$errors = [];
if (is_post()) {
    verify_csrf();
    $email = mb_strtolower(input('email'));
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        $errors['email'] = 'Saisissez votre e-mail et votre mot de passe.';
    } elseif (login_is_throttled($email)) {
        $errors['email'] = sprintf(
            'Trop de tentatives de connexion. Pour votre sécurité, réessayez dans %d minutes.',
            (int) config('security.login_window_minutes')
        );
    } else {
        $user = UserModel::findForAuth($email);
        // password_verify est appelé même si le compte n'existe pas (temps de réponse constant)
        $hash = $user['password_hash'] ?? password_hash(random_bytes(16), PASSWORD_DEFAULT);
        $valid = password_verify($password, $hash) && $user !== null;

        if ($valid && !$user['is_active']) {
            $errors['email'] = 'Ce compte a été désactivé. Contactez l’administrateur.';
        } elseif ($valid) {
            record_login_attempt($email, true);
            UserModel::rehashIfNeeded($user, $password);
            login_user($user, !empty($_POST['remember']));
            flash('success', 'Bon retour parmi nous, ' . $user['first_name'] . ' !');
            redirect($user['role'] === 'admin' && $redirectTo === url('dashboard/index.php') ? url('admin/dashboard.php') : $redirectTo);
        } else {
            record_login_attempt($email, false);
            $errors['email'] = 'E-mail ou mot de passe incorrect.';
        }
    }
    with_old_input(['email' => $email]);
}

$pageTitle = 'Connexion';
$pageDescription = 'Connectez-vous pour reprendre votre apprentissage HTML & CSS.';
$activeNav = 'login';
require ROOT_PATH . '/includes/header.php';
?>
<section class="auth">
  <div class="card auth__card">
    <header class="auth__head">
      <span class="brand__mark"><?= icon('logo') ?></span>
      <h1>Connexion</h1>
      <p>Reprenez là où vous vous êtes arrêté.</p>
    </header>
    <form class="form" method="post" action="" data-validate>
      <?= csrf_field() ?>
      <input type="hidden" name="redirect" value="<?= e($redirectTo) ?>">
      <?php partial('field', ['name' => 'email', 'label' => 'Adresse e-mail', 'type' => 'email', 'value' => old('email'), 'errors' => $errors, 'attrs' => 'required autocomplete="email" autofocus']); ?>
      <?php partial('field', ['name' => 'password', 'label' => 'Mot de passe', 'type' => 'password', 'errors' => [], 'password' => true, 'attrs' => 'required autocomplete="current-password"']); ?>
      <div class="auth__split">
        <label class="checkbox"><input type="checkbox" name="remember" value="1"> Rester connecté</label>
        <a href="<?= e(url('auth/forgot-password.php')) ?>">Mot de passe oublié ?</a>
      </div>
      <button class="btn btn--primary btn--lg btn--block" type="submit">Se connecter</button>
    </form>
    <p class="auth__foot">Pas encore de compte ? <a href="<?= e(url('auth/register.php')) ?>">Inscrivez-vous gratuitement</a></p>
    <?php if (setting('show_demo_accounts', '0') === '1'): ?>
      <div class="demo-accounts">
        <p><strong>Comptes de démonstration</strong> (voir README.md pour les mots de passe)</p>
        <p>Apprenant : <code>demo@academy.test</code> — Administrateur : <code>admin@academy.test</code></p>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php clear_old_input(); require ROOT_PATH . '/includes/footer.php'; ?>
