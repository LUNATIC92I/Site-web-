<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

if (is_logged_in()) {
    redirect(url('dashboard/index.php'));
}

$errors = [];
if (is_post()) {
    verify_csrf();
    $v = new Validator($_POST);
    $minLength = (int) config('security.password_min_length');
    $v->required('first_name', 'Prénom')->name('first_name', 'Le prénom')->max('first_name', 60, 'Le prénom')
      ->required('last_name', 'Nom')->name('last_name', 'Le nom')->max('last_name', 60, 'Le nom')
      ->required('email', 'E-mail')->email('email')->max('email', 190, 'L’e-mail')
      ->password('password', $minLength)
      ->same('password', 'password_confirm', 'Les mots de passe ne correspondent pas.');
    if (empty($_POST['terms'])) {
        $v->add('terms', 'Vous devez accepter les conditions d’utilisation.');
    }
    if (!$v->fails() && UserModel::emailExists($v->value('email'))) {
        $v->add('email', 'Un compte existe déjà avec cette adresse e-mail.');
    }
    if (session_rate_limited('register', 5, 3600)) {
        $v->add('email', 'Trop d’inscriptions depuis cette session. Réessayez plus tard.');
    }

    if ($v->fails()) {
        $errors = $v->errors();
        with_old_input($_POST);
    } else {
        $id = UserModel::create($v->value('first_name'), $v->value('last_name'), $v->value('email'), (string) $_POST['password']);
        ActivityModel::log($id, 'register', 'Création du compte');
        clear_old_input();
        login_user(UserModel::find($id));
        flash('success', 'Bienvenue ' . $v->value('first_name') . ' ! Votre compte est prêt : commençons par la première leçon.');
        redirect(url('dashboard/index.php'));
    }
}

$pageTitle = 'Inscription';
$pageDescription = 'Créez gratuitement votre compte et commencez à apprendre HTML et CSS pas à pas.';
$activeNav = 'login';
require ROOT_PATH . '/includes/header.php';
?>
<section class="auth">
  <div class="card auth__card auth__card--wide">
    <header class="auth__head">
      <span class="brand__mark"><?= icon('logo') ?></span>
      <h1>Créer mon compte</h1>
      <p>Gratuit, sans engagement. Votre progression est sauvegardée automatiquement.</p>
    </header>
    <form class="form" method="post" action="" data-validate>
      <?= csrf_field() ?>
      <div class="form-row">
        <?php partial('field', ['name' => 'first_name', 'label' => 'Prénom', 'value' => old('first_name'), 'errors' => $errors, 'attrs' => 'required maxlength="60" autocomplete="given-name"']); ?>
        <?php partial('field', ['name' => 'last_name', 'label' => 'Nom', 'value' => old('last_name'), 'errors' => $errors, 'attrs' => 'required maxlength="60" autocomplete="family-name"']); ?>
      </div>
      <?php partial('field', ['name' => 'email', 'label' => 'Adresse e-mail', 'type' => 'email', 'value' => old('email'), 'errors' => $errors, 'attrs' => 'required maxlength="190" autocomplete="email"']); ?>
      <?php partial('field', ['name' => 'password', 'label' => 'Mot de passe', 'type' => 'password', 'errors' => $errors, 'password' => true, 'strength' => true,
          'hint' => 'Au moins ' . (int) config('security.password_min_length') . ' caractères, dont une lettre et un chiffre.',
          'attrs' => 'required minlength="' . (int) config('security.password_min_length') . '" data-password="1" autocomplete="new-password"']); ?>
      <?php partial('field', ['name' => 'password_confirm', 'label' => 'Confirmation du mot de passe', 'type' => 'password', 'errors' => $errors, 'password' => true,
          'attrs' => 'required data-match="password" autocomplete="new-password"']); ?>
      <div class="field">
        <label class="checkbox"><input type="checkbox" name="terms" value="1" required data-label="L’acceptation des conditions" <?= old('terms') ? 'checked' : '' ?>> J’accepte les conditions d’utilisation et la politique de confidentialité.</label>
        <?php if (isset($errors['terms'])): ?><p class="field__error"><?= e($errors['terms']) ?></p><?php endif; ?>
      </div>
      <button class="btn btn--primary btn--lg btn--block" type="submit">Créer mon compte</button>
    </form>
    <p class="auth__foot">Déjà inscrit ? <a href="<?= e(url('auth/login.php')) ?>">Se connecter</a></p>
  </div>
</section>
<?php clear_old_input(); require ROOT_PATH . '/includes/footer.php'; ?>
