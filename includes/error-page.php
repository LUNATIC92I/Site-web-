<?php
/**
 * Page d'erreur générique (500 / 403). Aucun détail technique n'est affiché
 * sauf si APP_DEBUG est activé.
 */
declare(strict_types=1);

$errorCode ??= 500;
$debugMessage ??= null;
$titles = [403 => 'Accès refusé', 500 => 'Une erreur est survenue'];
$texts = [
    403 => 'Vous n’avez pas les droits nécessaires pour accéder à cette page.',
    500 => 'Un problème technique nous empêche d’afficher cette page. L’incident a été enregistré ; merci de réessayer dans quelques instants.',
];
$pageTitle = $titles[$errorCode] ?? 'Erreur';
$noindex = true;
try {
    require ROOT_PATH . '/includes/header.php';
} catch (Throwable) {
    // Si l'en-tête ne peut pas être rendu (ex : base de données indisponible), page minimale
    echo '<!DOCTYPE html><html lang="fr"><head><meta charset="utf-8"><title>Erreur</title></head><body><main>';
}
?>
<section class="error-page container">
  <p class="error-page__code"><?= (int) $errorCode ?></p>
  <h1><?= e($pageTitle) ?></h1>
  <p><?= e($texts[$errorCode] ?? $texts[500]) ?></p>
  <?php if ($debugMessage): ?><pre class="error-page__debug"><?= e($debugMessage) ?></pre><?php endif; ?>
  <a class="btn btn--primary" href="<?= e(url('')) ?>">Retour à l’accueil</a>
</section>
<?php
try {
    require ROOT_PATH . '/includes/footer.php';
} catch (Throwable) {
    echo '</main></body></html>';
}
