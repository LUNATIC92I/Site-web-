<?php
/**
 * Certificat de fin de parcours : /certificate.php?id=XXXX (ou /certificat/XXXX).
 * Page publique de vérification : elle n'affiche que les informations du certificat.
 */
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$cert = CertificateModel::findByCode(strtoupper(input('id')));
if (!$cert) {
    not_found();
}
$isOwner = user_id() === (int) $cert['user_id'];

$pageTitle = 'Certificat — ' . $cert['full_name'];
$pageDescription = 'Certificat de réussite du parcours HTML & CSS délivré à ' . $cert['full_name'] . '.';
$noindex = true;
require ROOT_PATH . '/includes/header.php';
?>
<div class="container">
  <article class="certificate" aria-labelledby="cert-name">
    <p class="certificate__title"><?= e(setting('site_name', config('app.name'))) ?> · Certificat de réussite</p>
    <p class="brand__mark" style="margin:1.5rem auto;width:64px;height:64px" aria-hidden="true"><?= icon('logo', 'icon icon--xl') ?></p>
    <p class="muted">Ce certificat atteste que</p>
    <h1 id="cert-name" class="certificate__name gradient-text"><?= e($cert['full_name']) ?></h1>
    <p class="lead" style="margin-inline:auto">a terminé avec succès l’intégralité du</p>
    <h2>Parcours HTML &amp; CSS terminé</h2>
    <p class="muted">HTML5 · CSS3 · Sémantique · Accessibilité · Flexbox · Grid · Responsive design · Animations</p>
    <div class="certificate__meta">
      <div><span>Niveau</span><strong><?= e($cert['level_label']) ?></strong></div>
      <div><span>Score final</span><strong><?= (int) $cert['final_score'] ?> %</strong></div>
      <div><span>Date</span><strong><?= e(format_date($cert['issued_at'])) ?></strong></div>
      <div><span>Identifiant</span><strong><?= e($cert['certificate_code']) ?></strong></div>
    </div>
  </article>
  <div class="btn-row no-print" style="justify-content:center">
    <?php if ($isOwner): ?><button class="btn btn--primary" type="button" data-print><?= icon('certificate') ?> Imprimer / Enregistrer en PDF</button><?php endif; ?>
    <a class="btn btn--ghost" href="<?= e(route('certificate', $cert['certificate_code'])) ?>"><?= icon('copy') ?> Lien de vérification</a>
  </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
