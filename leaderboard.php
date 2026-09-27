<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$rows = UserModel::leaderboard(50);
$me = user_id();
$podium = array_slice($rows, 0, 3);
// Par respect de la vie privée, seul le prénom et l'initiale du nom sont affichés
$display = static fn (array $r) => $r['first_name'] . ' ' . mb_substr($r['last_name'], 0, 1) . '.';

$pageTitle = 'Classement';
$pageDescription = 'Le classement des apprenants de la plateforme : leçons terminées, exercices réussis, quiz et projets.';
$activeNav = 'leaderboard';
require ROOT_PATH . '/includes/header.php';
?>
<header class="page-head container">
  <p class="eyebrow"><?= icon('trophy', 'icon icon--sm') ?> Classement</p>
  <h1>Classement des apprenants</h1>
  <p>Points : 10 par leçon validée, les points de chaque exercice réussi, 5 par quiz réussi et 50 par projet validé.</p>
</header>
<div class="container">
  <?php if (!$rows): ?>
    <p class="empty"><?= icon('trophy') ?><br>Le classement est encore vide : soyez le premier à marquer des points !</p>
  <?php else: ?>
    <div class="podium" aria-label="Podium">
      <?php foreach ($podium as $i => $r): ?>
        <div class="podium__step podium__step--<?= $i + 1 ?> reveal">
          <p class="podium__rank"><?= $i === 0 ? icon('crown') : '' ?> #<?= $i + 1 ?></p>
          <span class="avatar avatar--lg" style="margin:0 auto .6rem" aria-hidden="true"><?= e(initials($r['first_name'], $r['last_name'])) ?></span>
          <p style="font-weight:750;margin:0"><?= e($display($r)) ?></p>
          <p class="muted" style="margin:0"><?= (int) $r['points'] ?> pts</p>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="table-wrap">
      <table class="table">
        <caption class="sr-only">Classement complet</caption>
        <thead><tr><th scope="col">Rang</th><th scope="col">Apprenant</th><th scope="col">Points</th><th scope="col">Leçons</th><th scope="col">Quiz</th><th scope="col">Projets</th><th scope="col">Badges</th></tr></thead>
        <tbody>
          <?php foreach ($rows as $i => $r): ?>
            <tr class="<?= (int) $r['id'] === $me ? 'is-me' : '' ?>">
              <td class="rank-cell">#<?= $i + 1 ?></td>
              <td><?= e($display($r)) ?><?= (int) $r['id'] === $me ? ' <span class="tag tag--success">Vous</span>' : '' ?></td>
              <td><strong><?= (int) $r['points'] ?></strong></td>
              <td><?= (int) $r['lessons'] ?></td>
              <td><?= (int) $r['quizzes'] ?></td>
              <td><?= (int) $r['projects'] ?></td>
              <td><?= (int) $r['badges'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
