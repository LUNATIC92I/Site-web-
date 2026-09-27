<?php
/**
 * En-tête HTML commun.
 * Variables facultatives définies par la page avant l'inclusion :
 *   $pageTitle, $pageDescription, $pageCanonical, $pageImage, $pageType,
 *   $bodyClass, $pageScripts (liste de fichiers JS), $jsonLd (tableau), $noindex (bool)
 */

declare(strict_types=1);

$siteName = setting('site_name', config('app.name'));
$pageTitle = isset($pageTitle) ? $pageTitle . ' — ' . $siteName : $siteName . ' — Apprenez HTML & CSS en pratiquant';
$pageDescription ??= setting('site_description', 'Plateforme interactive pour apprendre HTML et CSS pas à pas : cours, éditeur de code, exercices, quiz, projets et badges.');
$pageCanonical ??= absolute_url(strtok(substr(current_path(), strlen(base_path())), '?') ?: '');
$pageImage ??= absolute_url('assets/images/og-image.svg');
$pageType ??= 'website';
$bodyClass ??= '';
$pageScripts ??= [];
$noindex ??= false;
$user = current_user();
?>
<!DOCTYPE html>
<html lang="fr" class="no-js">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e($pageDescription) ?>">
  <?php if ($noindex): ?><meta name="robots" content="noindex, nofollow"><?php endif; ?>
  <link rel="canonical" href="<?= e($pageCanonical) ?>">
  <meta name="theme-color" content="#0b0f17">
  <meta name="color-scheme" content="dark">

  <meta property="og:site_name" content="<?= e($siteName) ?>">
  <meta property="og:type" content="<?= e($pageType) ?>">
  <meta property="og:title" content="<?= e($pageTitle) ?>">
  <meta property="og:description" content="<?= e($pageDescription) ?>">
  <meta property="og:url" content="<?= e($pageCanonical) ?>">
  <meta property="og:image" content="<?= e($pageImage) ?>">
  <meta property="og:locale" content="fr_FR">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" href="<?= e(url('assets/images/favicon.svg')) ?>" type="image/svg+xml">
  <link rel="stylesheet" href="<?= e(asset('css/main.css')) ?>">
  <?php if (str_contains($bodyClass, 'admin')): ?><link rel="stylesheet" href="<?= e(asset('css/admin.css')) ?>"><?php endif; ?>
  <script src="<?= e(asset('js/app.js')) ?>" defer></script>
  <?php foreach ($pageScripts as $script): ?>
  <script src="<?= e(asset('js/' . $script)) ?>" defer></script>
  <?php endforeach; ?>
  <?php if (!empty($jsonLd)): ?>
  <script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
  <?php endif; ?>
</head>
<body class="<?= e($bodyClass) ?>" data-base="<?= e(base_path()) ?>" data-csrf="<?= e(csrf_token()) ?>">
  <a class="skip-link" href="#contenu">Aller au contenu</a>
  <?php require ROOT_PATH . '/includes/navbar.php'; ?>
  <div class="toasts" id="toasts" role="status" aria-live="polite"></div>
  <?php $flashes = pull_flashes(); if ($flashes): ?>
  <div class="flash-stack container">
    <?php foreach ($flashes as $f): ?>
      <div class="flash flash--<?= e($f['type']) ?>" role="<?= $f['type'] === 'error' ? 'alert' : 'status' ?>">
        <?= icon($f['type'] === 'error' ? 'alert' : ($f['type'] === 'success' ? 'check-circle' : 'info')) ?>
        <p><?= e($f['message']) ?></p>
        <button type="button" class="flash__close" data-dismiss aria-label="Fermer le message"><?= icon('close') ?></button>
      </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <main id="contenu" tabindex="-1" class="page-enter">
