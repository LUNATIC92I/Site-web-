<?php
declare(strict_types=1);

if (!defined('ROOT_PATH')) {
    require __DIR__ . '/includes/bootstrap.php';
    http_response_code(404);
}
$pageTitle = 'Page introuvable';
$noindex = true;
require ROOT_PATH . '/includes/header.php';
?>
<section class="error-page container">
  <p class="error-page__code" aria-hidden="true">&lt;404/&gt;</p>
  <h1>Cette page n’existe pas (ou plus)</h1>
  <p>Le lien est peut-être incorrect. Comme une balise mal fermée, ça arrive aux meilleurs !</p>
  <div class="btn-row">
    <a class="btn btn--primary" href="<?= e(url('')) ?>">Retour à l’accueil</a>
    <a class="btn btn--ghost" href="<?= e(route('courses')) ?>">Voir les cours</a>
  </div>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
