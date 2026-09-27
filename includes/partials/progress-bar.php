<?php
/** Variables : $label, $percent, $variant ('html'|'css'|''), $icon (facultatif), $detail (facultatif) */
declare(strict_types=1);
$variant ??= '';
$icon ??= null;
$detail ??= '';
$percent = max(0, min(100, (int) $percent));
?>
<div class="progress<?= $variant ? ' progress--' . e($variant) : '' ?>" data-animate-progress>
  <div class="progress__head">
    <span class="progress__label"><?= $icon ? icon($icon) : '' ?> <?= e($label) ?><?php if ($detail): ?> <small class="muted"><?= e($detail) ?></small><?php endif; ?></span>
    <span class="progress__value"><?= $percent ?> %</span>
  </div>
  <div class="progress__track" role="progressbar" aria-label="<?= e($label) ?>" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?= $percent ?>">
    <div class="progress__bar" style="--p:<?= $percent ?>"></div>
  </div>
</div>
