<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$starterHtml = <<<'HTML'
<header class="hero">
  <h1>Mon terrain de jeu</h1>
  <p>Modifiez ce code : l’aperçu se met à jour en direct.</p>
  <a class="btn" href="#">Un bouton</a>
</header>
HTML;
$starterCss = <<<'CSS'
.hero {
  padding: 40px 24px;
  text-align: center;
  border-radius: 16px;
  background: linear-gradient(135deg, #0f766e, #2563eb);
  color: white;
}

.btn {
  display: inline-block;
  padding: 10px 20px;
  border-radius: 8px;
  background: white;
  color: #0f172a;
  text-decoration: none;
  font-weight: bold;
}
CSS;

$pageTitle = 'Éditeur HTML & CSS en ligne';
$pageDescription = 'Éditeur HTML et CSS en ligne avec aperçu en direct : testez vos idées librement, directement dans votre navigateur.';
$activeNav = '';
$pageScripts = ['editor.js'];
require ROOT_PATH . '/includes/header.php';
?>
<div class="container section--tight">
  <p class="eyebrow"><?= icon('terminal', 'icon icon--sm') ?> Bac à sable</p>
  <h1>Éditeur libre</h1>
  <p class="lead">Expérimentez sans limite. Votre code est sauvegardé automatiquement dans ce navigateur.</p>
  <?php partial('editor', ['id' => 'playground', 'html' => $starterHtml, 'css' => $starterCss, 'storageKey' => 'playground', 'label' => 'Éditeur libre HTML et CSS']); ?>
  <p class="muted" style="margin-top:1rem;font-size:.88rem">Raccourcis : <kbd>Tab</kbd> indenter · <kbd>Maj</kbd>+<kbd>Tab</kbd> désindenter · <kbd>Ctrl</kbd>+<kbd>Entrée</kbd> exécuter · <kbd>Échap</kbd> quitter la zone de code. Pour des raisons de sécurité, le JavaScript n’est pas exécuté dans l’aperçu.</p>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
