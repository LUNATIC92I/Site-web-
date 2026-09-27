<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$token = input('token');
$reset = null;
if (preg_match('/^[a-f0-9]{64}$/', $token)) {
    $reset = Database::fetch(
        'SELECT * FROM password_resets WHERE token_hash = ? AND used_at IS NULL AND expires_at > NOW()',
        [hash('sha256', $token)]
    );
}

$errors = [];
if ($reset && is_post()) {
    verify_csrf();
    $v = new Validator($_POST);
    $v->password('password', (int) config('security.password_min_length'))
      ->same('password', 'password_confirm', 'Les mots de passe ne correspondent pas.');
    if ($v->fails()) {
        $errors = $v->errors();
    } else {
        UserModel::updatePassword((int) $reset['user_id'], (string) $_POST['password']);
        Database::run('UPDATE password_resets SET used_at = NOW() WHERE id = ?', [$reset['id']]);
        flash('success', 'Votre mot de passe a été modifié. Vous pouvez vous connecter.');
        redirect(url('auth/login.php'));
    }
}

$pageTitle = 'Nouveau mot de passe';
$noindex = true;
require ROOT_PATH . '/includes/header.php';
?>
<section class="auth">
  <div class="card auth__card">
    <header class="auth__head">
      <span class="brand__mark"><?= icon('lock') ?></span>
      <h1>Nouveau mot de passe</h1>
    </header>
    <?php if (!$reset): ?>
      <div class="flash flash--error" role="alert"><?= icon('alert') ?><p>Ce lien est invalide ou a expiré. Faites une nouvelle demande.</p></div>
      <p class="auth__foot"><a class="btn btn--primary" href="<?= e(url('auth/forgot-password.php')) ?>">Nouvelle demande</a></p>
    <?php else: ?>
      <form class="form" method="post" action="" data-validate>
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= e($token) ?>">
        <?php partial('field', ['name' => 'password', 'label' => 'Nouveau mot de passe', 'type' => 'password', 'errors' => $errors, 'password' => true, 'strength' => true,
            'attrs' => 'required minlength="' . (int) config('security.password_min_length') . '" data-password="1" autocomplete="new-password"']); ?>
        <?php partial('field', ['name' => 'password_confirm', 'label' => 'Confirmation', 'type' => 'password', 'errors' => $errors, 'password' => true,
            'attrs' => 'required data-match="password" autocomplete="new-password"']); ?>
        <button class="btn btn--primary btn--block" type="submit">Enregistrer</button>
      </form>
    <?php endif; ?>
  </div>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
