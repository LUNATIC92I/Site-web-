<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$user = require_login();
$userId = (int) $user['id'];
$errors = [];
$pwErrors = [];

if (is_post()) {
    verify_csrf();
    if (input('form') === 'profile') {
        $v = new Validator($_POST);
        $v->required('first_name', 'Prénom')->name('first_name', 'Le prénom')->max('first_name', 60, 'Le prénom')
          ->required('last_name', 'Nom')->name('last_name', 'Le nom')->max('last_name', 60, 'Le nom')
          ->required('email', 'E-mail')->email('email')->max('email', 190, 'L’e-mail')
          ->max('bio', 500, 'La présentation');
        if (!$v->fails() && UserModel::emailExists($v->value('email'), $userId)) {
            $v->add('email', 'Cette adresse e-mail est déjà utilisée.');
        }
        if ($v->fails()) {
            $errors = $v->errors();
        } else {
            // L'utilisateur ne peut modifier QUE son propre profil : l'id vient de la session, jamais du formulaire (anti-IDOR)
            UserModel::updateProfile($userId, $v->value('first_name'), $v->value('last_name'), $v->value('email'), $v->value('bio') ?: null);
            flash('success', 'Profil mis à jour.');
            redirect(url('dashboard/profile.php'));
        }
    } elseif (input('form') === 'password') {
        $v = new Validator($_POST);
        if (!UserModel::verifyPassword($userId, (string) ($_POST['current_password'] ?? ''))) {
            $v->add('current_password', 'Mot de passe actuel incorrect.');
        }
        $v->password('password', (int) config('security.password_min_length'))
          ->same('password', 'password_confirm', 'Les mots de passe ne correspondent pas.');
        if ($v->fails()) {
            $pwErrors = $v->errors();
        } else {
            UserModel::updatePassword($userId, (string) $_POST['password']);
            session_regenerate_id(true);
            flash('success', 'Mot de passe modifié. Vos autres sessions « rester connecté » ont été révoquées.');
            redirect(url('dashboard/profile.php'));
        }
    }
}

$pageTitle = 'Mon profil';
$noindex = true;
$activeNav = 'dashboard';
require ROOT_PATH . '/includes/header.php';
?>
<div class="container section--tight">
  <?php partial('dash-nav', ['dashActive' => 'profile']); ?>
  <h1>Mon profil</h1>
  <div class="dash-grid">
    <section class="card span-7" aria-labelledby="profile-title">
      <h2 id="profile-title" class="card__title">Informations personnelles</h2>
      <form class="form" method="post" data-validate>
        <?= csrf_field() ?>
        <input type="hidden" name="form" value="profile">
        <div class="form-row">
          <?php partial('field', ['name' => 'first_name', 'label' => 'Prénom', 'value' => $_POST['first_name'] ?? $user['first_name'], 'errors' => $errors, 'attrs' => 'required maxlength="60" autocomplete="given-name"']); ?>
          <?php partial('field', ['name' => 'last_name', 'label' => 'Nom', 'value' => $_POST['last_name'] ?? $user['last_name'], 'errors' => $errors, 'attrs' => 'required maxlength="60" autocomplete="family-name"']); ?>
        </div>
        <?php partial('field', ['name' => 'email', 'label' => 'Adresse e-mail', 'type' => 'email', 'value' => $_POST['email'] ?? $user['email'], 'errors' => $errors, 'attrs' => 'required maxlength="190" autocomplete="email"']); ?>
        <div class="field">
          <label for="f-bio">Présentation <span class="muted">(facultatif)</span></label>
          <textarea class="textarea" id="f-bio" name="bio" maxlength="500"><?= e($_POST['bio'] ?? $user['bio'] ?? '') ?></textarea>
          <?php if (isset($errors['bio'])): ?><p class="field__error"><?= e($errors['bio']) ?></p><?php endif; ?>
        </div>
        <button class="btn btn--primary" type="submit">Enregistrer</button>
      </form>
    </section>
    <section class="card span-5" aria-labelledby="pw-title">
      <h2 id="pw-title" class="card__title">Changer de mot de passe</h2>
      <form class="form" method="post" data-validate>
        <?= csrf_field() ?>
        <input type="hidden" name="form" value="password">
        <?php partial('field', ['name' => 'current_password', 'label' => 'Mot de passe actuel', 'type' => 'password', 'errors' => $pwErrors, 'password' => true, 'attrs' => 'required autocomplete="current-password"']); ?>
        <?php partial('field', ['name' => 'password', 'label' => 'Nouveau mot de passe', 'type' => 'password', 'errors' => $pwErrors, 'password' => true, 'strength' => true, 'attrs' => 'required minlength="' . (int) config('security.password_min_length') . '" data-password="1" autocomplete="new-password"']); ?>
        <?php partial('field', ['name' => 'password_confirm', 'label' => 'Confirmation', 'type' => 'password', 'errors' => $pwErrors, 'password' => true, 'attrs' => 'required data-match="password" autocomplete="new-password"']); ?>
        <button class="btn" type="submit">Modifier le mot de passe</button>
      </form>
      <p class="muted" style="margin-top:1.5rem;font-size:.88rem">Membre depuis le <?= e(format_date($user['created_at'])) ?>.</p>
    </section>
  </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
