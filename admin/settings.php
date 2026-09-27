<?php
declare(strict_types=1);
require __DIR__ . '/../includes/admin.php';

$settings = SettingModel::all();

if (is_post()) {
    verify_csrf();
    foreach ($settings as $key => $row) {
        if (in_array($key, ['free_navigation', 'show_demo_accounts'], true)) {
            SettingModel::set($key, isset($_POST[$key]) ? '1' : '0');
        } elseif (isset($_POST[$key]) && is_string($_POST[$key])) {
            SettingModel::set($key, mb_substr(trim($_POST[$key]), 0, 1000));
        }
    }
    flash('success', 'Paramètres enregistrés.');
    redirect(url('admin/settings.php'));
}

admin_header('Paramètres', 'settings');
?>
<form method="post" class="admin-form card" style="max-width:760px">
  <?= csrf_field() ?>
  <?php foreach ($settings as $key => $row): ?>
    <?php if (in_array($key, ['free_navigation', 'show_demo_accounts'], true)): ?>
      <?= admin_checkbox($key, $row['label'], $row['setting_value'] === '1') ?>
    <?php elseif (strlen((string) $row['setting_value']) > 80): ?>
      <?= admin_textarea($key, $row['label'], $row['setting_value'], false, '', 3) ?>
    <?php else: ?>
      <?= admin_input($key, $row['label'], $row['setting_value']) ?>
    <?php endif; ?>
  <?php endforeach; ?>
  <div class="btn-row"><button class="btn btn--primary" type="submit">Enregistrer</button></div>
</form>
<div class="card" style="max-width:760px;margin-top:1.5rem">
  <h2 class="card__title">Configuration technique</h2>
  <dl class="kv">
    <dt>Environnement</dt><dd><?= e(config('app.env')) ?><?= config('app.debug') ? ' (debug activé)' : '' ?></dd>
    <dt>Version PHP</dt><dd><?= e(PHP_VERSION) ?></dd>
    <dt>URLs propres</dt><dd><?= config('app.pretty_urls') ? 'activées' : 'désactivées' ?></dd>
    <dt>Envoi d’e-mails</dt><dd>driver « <?= e(config('mail.driver')) ?> »</dd>
    <dt>Seuil de réussite des quiz</dt><dd><?= (int) config('learning.quiz_pass_percentage') ?> %</dd>
  </dl>
  <p class="muted" style="margin:.8rem 0 0;font-size:.88rem">Ces valeurs se modifient dans <code>config/config.php</code> ou via les variables d’environnement (voir README).</p>
</div>
<?php admin_footer(); ?>
