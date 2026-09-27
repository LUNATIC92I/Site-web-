<?php
/**
 * Champ de formulaire accessible (label + message d'erreur relié).
 * Variables : $name, $label, $type='text', $value='', $errors=[], $attrs='' (attributs HTML sûrs, écrits par le développeur),
 *             $hint='', $password=false (bouton afficher/masquer), $strength=false
 */
declare(strict_types=1);

$type ??= 'text';
$value ??= '';
$errors ??= [];
$attrs ??= '';
$hint ??= '';
$password ??= false;
$strength ??= false;
$id = 'f-' . $name;
$error = $errors[$name] ?? null;
$describedBy = trim(($hint ? "$id-hint " : '') . ($error ? "$id-error" : ''));
?>
<div class="field">
  <label for="<?= e($id) ?>"><?= e($label) ?></label>
  <?php if ($password): ?><div class="password-field"><?php endif; ?>
  <input class="input" id="<?= e($id) ?>" name="<?= e($name) ?>" type="<?= e($type) ?>" data-label="<?= e($label) ?>"
    <?php if ($type !== 'password'): ?>value="<?= e($value) ?>"<?php endif; ?>
    <?= $error ? 'aria-invalid="true"' : '' ?> <?= $describedBy ? 'aria-describedby="' . e($describedBy) . '"' : '' ?>
    <?= $strength ? 'data-strength="' . e($id) . '-strength"' : '' ?> <?= $attrs ?>>
  <?php if ($password): ?>
    <button type="button" class="password-field__toggle" data-password-toggle aria-label="Afficher le mot de passe" aria-pressed="false"><?= icon('eye') ?></button>
  </div>
  <?php endif; ?>
  <?php if ($strength): ?>
    <div class="strength" aria-hidden="true"><div class="strength__bar" id="<?= e($id) ?>-strength"></div></div>
    <p class="field__hint" id="<?= e($id) ?>-strength-label" aria-live="polite"></p>
  <?php endif; ?>
  <?php if ($hint): ?><p class="field__hint" id="<?= e($id) ?>-hint"><?= e($hint) ?></p><?php endif; ?>
  <?php if ($error): ?><p class="field__error" id="<?= e($id) ?>-error"><?= icon('alert', 'icon icon--sm') ?><?= e($error) ?></p><?php endif; ?>
</div>
