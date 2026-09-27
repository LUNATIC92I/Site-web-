<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

$project = ProjectModel::findBySlug(input('slug'));
if (!$project) {
    not_found();
}
$user = current_user();
$submission = $user ? ProjectModel::submission((int) $user['id'], (int) $project['id']) : null;
$steps = json_list($project['steps']);
$resources = json_list($project['resources']);
$criteria = json_list($project['success_criteria']);
$rules = json_list($project['validation_rules']);
$lastCheck = $_SESSION['project_check'][$project['id']] ?? null;
unset($_SESSION['project_check'][$project['id']]);
$showSolution = $submission && in_array($submission['status'], ['validated', 'approved'], true);

$pageTitle = $project['title'] . ' — Projet';
$pageDescription = $project['summary'];
$activeNav = 'projects';
$pageScripts = ['editor.js', 'project.js'];
require ROOT_PATH . '/includes/header.php';
?>
<div class="container">
  <header class="page-head">
    <ol class="breadcrumb"><li><a href="<?= e(route('projects')) ?>">Projets</a></li><li aria-current="page"><?= e($project['title']) ?></li></ol>
    <div class="btn-row" style="margin-bottom:1rem">
      <span class="tag tag--level-<?= (int) $project['level'] ?>"><?= e(level_label((int) $project['level'])) ?></span>
      <?php if ($project['is_final']): ?><span class="tag tag--warning"><?= icon('crown', 'icon icon--sm') ?> Projet final</span><?php endif; ?>
      <?php if ($submission): ?><span class="tag <?= in_array($submission['status'], ['validated', 'approved'], true) ? 'tag--success' : 'tag--warning' ?>"><?= e(ProjectModel::STATUS[$submission['status']]) ?></span><?php endif; ?>
    </div>
    <h1><?= e($project['title']) ?></h1>
    <p class="lead"><?= e($project['summary']) ?></p>
  </header>

  <div class="dash-grid">
    <section class="card span-7" aria-labelledby="obj">
      <h2 id="obj" class="card__title"><?= icon('target') ?> Objectif</h2>
      <div class="prose"><?= Markdown::render($project['objective']) ?></div>
      <h2 class="card__title" style="margin-top:1.5rem"><?= icon('list') ?> Consignes</h2>
      <div class="prose"><?= Markdown::render($project['instructions']) ?></div>
    </section>
    <aside class="span-5 stack">
      <div class="card">
        <h2 class="card__title"><?= icon('check-circle') ?> Critères de réussite</h2>
        <ul class="list-check"><?php foreach ($criteria as $c): ?><li><?= icon('check') ?><span><?= Markdown::inline((string) $c) ?></span></li><?php endforeach; ?></ul>
      </div>
      <?php if ($resources): ?>
      <div class="card">
        <h2 class="card__title"><?= icon('book') ?> Ressources</h2>
        <ul class="feature-list" style="margin:0"><?php foreach ($resources as $r): ?><li><?= icon('arrow-right') ?><span><?= Markdown::inline((string) $r) ?></span></li><?php endforeach; ?></ul>
      </div>
      <?php endif; ?>
    </aside>

    <section class="span-12" aria-labelledby="steps-title">
      <h2 id="steps-title"><?= icon('map') ?> Étapes</h2>
      <ol class="steps"><?php foreach ($steps as $s): ?><li><?= Markdown::inline((string) $s) ?></li><?php endforeach; ?></ol>
    </section>

    <section class="span-12" aria-labelledby="work-title">
      <h2 id="work-title"><?= icon('code') ?> Votre réalisation</h2>
      <?php if ($submission && $submission['feedback']): ?>
        <div class="callout callout--info"><p class="callout__title">Retour du formateur</p><p><?= nl2br(e($submission['feedback'])) ?></p></div>
      <?php endif; ?>
      <?php if ($lastCheck): ?>
        <div class="result-banner <?= $lastCheck['passed'] ? 'is-ok' : 'is-ko' ?>"><?= icon($lastCheck['passed'] ? 'check-circle' : 'alert') ?><span><?= $lastCheck['passed'] ? 'Projet validé automatiquement : tous les critères techniques sont remplis !' : 'Projet enregistré. ' . (int) $lastCheck['score'] . ' % des vérifications automatiques sont validées.' ?></span></div>
        <ul class="check-results"><?php foreach ($lastCheck['results'] as $r): ?><li class="<?= $r['ok'] ? 'is-ok' : 'is-ko' ?>"><?= icon($r['ok'] ? 'check-circle' : 'x-circle') ?><span><?= e($r['msg']) ?></span></li><?php endforeach; ?></ul>
      <?php endif; ?>

      <form method="post" action="<?= e(url('projects/submit.php')) ?>" data-project-form style="margin-top:1rem">
        <?= csrf_field() ?>
        <input type="hidden" name="project_id" value="<?= (int) $project['id'] ?>">
        <input type="hidden" name="html" data-sync="html">
        <input type="hidden" name="css" data-sync="css">
        <?php partial('editor', [
            'id'          => 'project-' . $project['id'],
            'html'        => $submission['html_code'] ?? (string) $project['starter_html'],
            'css'         => $submission['css_code'] ?? (string) $project['starter_css'],
            'starterHtml' => (string) $project['starter_html'],
            'starterCss'  => (string) $project['starter_css'],
            'label'       => 'Éditeur du projet',
        ]); ?>
        <div class="field" style="margin-top:1rem">
          <label for="notes">Notes pour le formateur (facultatif)</label>
          <textarea class="textarea" id="notes" name="notes" maxlength="2000"><?= e($submission['notes'] ?? '') ?></textarea>
        </div>
        <div class="btn-row" style="margin-top:1rem">
          <?php if ($user): ?>
            <button class="btn btn--primary" type="submit"><?= icon('flag') ?> <?= $submission ? 'Mettre à jour ma soumission' : 'Soumettre mon projet' ?></button>
          <?php else: ?>
            <a class="btn btn--primary" href="<?= e(url('auth/login.php')) ?>?redirect=<?= e(rawurlencode(current_path())) ?>">Connectez-vous pour soumettre</a>
          <?php endif; ?>
          <span class="muted" style="font-size:.88rem"><?= count($rules) ?> vérifications automatiques</span>
        </div>
      </form>
    </section>

    <section class="span-12" aria-labelledby="solution-title">
      <h2 id="solution-title"><?= icon('lightbulb') ?> Solution</h2>
      <?php if ($showSolution || is_admin()): ?>
        <details class="card"><summary class="btn btn--ghost">Afficher la solution commentée</summary>
          <?= Markdown::codeBlock((string) $project['solution_html'], 'html', 'index.html') ?>
          <?php if ($project['solution_css']): ?><?= Markdown::codeBlock((string) $project['solution_css'], 'css', 'style.css') ?><?php endif; ?>
        </details>
      <?php else: ?>
        <p class="muted"><?= icon('lock', 'icon icon--sm') ?> La solution se débloque une fois votre projet validé. Accrochez-vous : c’est en cherchant qu’on progresse le plus !</p>
      <?php endif; ?>
    </section>

    <?php if ($project['bonus_challenge']): ?>
    <section class="span-12 challenge-box prose">
      <h2><?= icon('zap') ?> Challenge supplémentaire</h2>
      <?= Markdown::render($project['bonus_challenge']) ?>
    </section>
    <?php endif; ?>
  </div>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
