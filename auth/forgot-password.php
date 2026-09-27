<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$errors = [];
$sent = false;
$devLink = null;

if (is_post()) {
    verify_csrf();
    $v = new Validator($_POST);
    $v->required('email', 'E-mail')->email('email');
    if (session_rate_limited('forgot', 5, 900)) {
        $v->add('email', 'Trop de demandes. Patientez quelques minutes avant de réessayer.');
    }
    if ($v->fails()) {
        $errors = $v->errors();
    } else {
        $user = UserModel::findForAuth($v->value('email'));
        if ($user && $user['is_active']) {
            $token = bin2hex(random_bytes(32));
            Database::run('DELETE FROM password_resets WHERE user_id = ?', [$user['id']]);
            Database::insert('password_resets', [
                'user_id'    => $user['id'],
                'token_hash' => hash('sha256', $token),
                'expires_at' => date('Y-m-d H:i:s', time() + (int) config('security.reset_token_minutes') * 60),
            ]);
            $link = absolute_url('auth/reset-password.php?token=' . $token);
            Mailer::send(
                $user['email'],
                'Réinitialisation de votre mot de passe',
                "Bonjour {$user['first_name']},\n\nPour choisir un nouveau mot de passe, ouvrez ce lien (valable "
                . (int) config('security.reset_token_minutes') . " minutes) :\n$link\n\n"
                . "Si vous n'êtes pas à l'origine de cette demande, ignorez simplement ce message.\n\n— L'équipe " . config('app.name')
            );
            // En développement uniquement : lien affiché pour tester sans serveur e-mail
            if (config('app.env') === 'development' && config('mail.driver') === 'log') {
                $devLink = $link;
            }
        }
        // Même message que le compte existe ou non (pas d'énumération des e-mails)
        $sent = true;
    }
}

$pageTitle = 'Mot de passe oublié';
$noindex = true;
require ROOT_PATH . '/includes/header.php';
?>
<section class="auth">
  <div class="card auth__card">
    <header class="auth__head">
      <span class="brand__mark"><?= icon('lock') ?></span>
      <h1>Mot de passe oublié</h1>
      <p>Indiquez votre e-mail : nous vous enverrons un lien de réinitialisation.</p>
    </header>
    <?php if ($sent): ?>
      <div class="flash flash--success" role="status"><?= icon('check-circle') ?><p>Si un compte correspond à cette adresse, un e-mail contenant un lien de réinitialisation vient d’être envoyé.</p></div>
      <?php if ($devLink): ?>
        <div class="callout callout--info"><p class="callout__title">Mode développement</p><p>Lien (également écrit dans <code>storage/logs/mail.log</code>) : <a href="<?= e($devLink) ?>">réinitialiser le mot de passe</a></p></div>
      <?php endif; ?>
    <?php else: ?>
      <form class="form" method="post" action="" data-validate>
        <?= csrf_field() ?>
        <?php partial('field', ['name' => 'email', 'label' => 'Adresse e-mail', 'type' => 'email', 'value' => input('email'), 'errors' => $errors, 'attrs' => 'required autocomplete="email"']); ?>
        <button class="btn btn--primary btn--block" type="submit">Envoyer le lien</button>
      </form>
    <?php endif; ?>
    <p class="auth__foot"><a href="<?= e(url('auth/login.php')) ?>"><?= icon('arrow-left', 'icon icon--sm') ?> Retour à la connexion</a></p>
  </div>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
