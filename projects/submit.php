<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

if (!is_post()) {
    redirect(route('projects'));
}
$user = require_login();
verify_csrf();

$project = ProjectModel::find((int) input('project_id'));
if (!$project) {
    not_found();
}

$html = (string) ($_POST['html'] ?? '');
$css = (string) ($_POST['css'] ?? '');
if (trim($html) === '') {
    flash('error', 'Votre projet est vide : écrivez votre code HTML avant de le soumettre.');
    redirect(route('project', $project['slug']));
}

$result = ProjectModel::submit((int) $user['id'], $project, $html, $css, input('notes'));
$_SESSION['project_check'][$project['id']] = ['passed' => $result['passed'], 'score' => $result['score'], 'results' => $result['results']];

flash($result['passed'] ? 'success' : 'info', $result['passed']
    ? 'Projet soumis et validé automatiquement. Félicitations !'
    : 'Projet enregistré. Corrigez les points signalés puis soumettez à nouveau.');
foreach ($result['badges'] as $b) {
    flash('success', 'Nouveau badge débloqué : ' . $b['name']);
}
redirect(route('project', $project['slug']) . '#work-title');
