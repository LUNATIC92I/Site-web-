<?php
/**
 * Éditeur de code interactif.
 * Variables : $id (string), $html, $css (code initial), $starterHtml, $starterCss (valeurs de réinitialisation),
 *             $langs (['html','css']), $storageKey (brouillon local, facultatif), $label (titre accessible)
 */
declare(strict_types=1);

$langs ??= ['html', 'css'];
$html ??= '';
$css ??= '';
$starterHtml ??= $html;
$starterCss ??= $css;
$storageKey ??= '';
$label ??= 'Éditeur de code';
$names = ['html' => 'HTML', 'css' => 'CSS'];
?>
<section class="editor" data-editor="<?= e($id) ?>"<?= $storageKey !== '' ? ' data-storage-key="' . e($storageKey) . '"' : '' ?> aria-label="<?= e($label) ?>">
  <textarea hidden data-starter="html" tabindex="-1" aria-hidden="true"><?= e($starterHtml) ?></textarea>
  <textarea hidden data-starter="css" tabindex="-1" aria-hidden="true"><?= e($starterCss) ?></textarea>

  <div class="editor__toolbar">
    <div class="editor__tabs" role="tablist" aria-label="Choisir le langage">
      <?php foreach ($langs as $i => $lang): ?>
        <button type="button" class="editor__tab" role="tab" data-tab="<?= e($lang) ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>"><?= e($names[$lang]) ?></button>
      <?php endforeach; ?>
    </div>
    <button type="button" class="btn btn--primary btn--sm" data-action="run" title="Exécuter (Ctrl + Entrée)"><?= icon('play') ?><span>Exécuter</span></button>
    <button type="button" class="btn btn--sm" data-action="reset" aria-label="Réinitialiser le code" title="Réinitialiser"><?= icon('refresh') ?><span>Réinitialiser</span></button>
    <button type="button" class="btn btn--sm" data-action="copy" aria-label="Copier le code" title="Copier"><?= icon('copy') ?><span>Copier</span></button>
    <button type="button" class="btn btn--sm" data-action="fullscreen" aria-pressed="false" aria-label="Agrandir l’éditeur" title="Agrandir"><?= icon('expand') ?><span>Agrandir</span></button>
    <button type="button" class="btn btn--sm" data-action="preview" aria-pressed="true" aria-label="Afficher ou masquer l’aperçu" title="Aperçu"><?= icon('eye-off') ?><span>Masquer l’aperçu</span></button>
    <span class="spacer"></span>
    <label class="switch editor__status"><input type="checkbox" data-live checked><span class="switch__track" aria-hidden="true"></span>Live</label>
    <span class="editor__status" data-status aria-live="polite"></span>
  </div>

  <div class="editor__panes">
    <div class="editor__code">
      <?php foreach ($langs as $i => $lang): $fieldId = $id . '-' . $lang; ?>
        <div class="editor__pane<?= $i === 0 ? ' is-current' : '' ?>" data-pane="<?= e($lang) ?>">
          <label class="editor__label editor__label--<?= e($lang) ?>" for="<?= e($fieldId) ?>"><?= icon($lang, 'icon icon--sm') ?> Code <?= e($names[$lang]) ?></label>
          <div class="code-input" data-lang="<?= e($lang) ?>">
            <div class="code-input__gutter" aria-hidden="true">1</div>
            <div class="code-input__area">
              <pre class="code-input__highlight" aria-hidden="true"><code></code></pre>
              <textarea id="<?= e($fieldId) ?>" class="code-input__textarea" spellcheck="false" autocapitalize="off" autocomplete="off" autocorrect="off" wrap="off"
                aria-describedby="<?= e($id) ?>-help"><?= e($lang === 'html' ? $html : $css) ?></textarea>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="editor__preview">
      <p class="editor__label"><?= icon('eye', 'icon icon--sm') ?> Aperçu</p>
      <iframe class="editor__frame" title="Aperçu du rendu de votre code" sandbox=""></iframe>
    </div>
  </div>
  <p id="<?= e($id) ?>-help" class="sr-only">Tabulation pour indenter, Échap pour quitter la zone de code, Ctrl + Entrée pour exécuter.</p>
</section>
