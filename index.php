<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';

$counts = Database::fetch(
    "SELECT (SELECT COUNT(*) FROM lessons WHERE is_published = 1) AS lessons,
            (SELECT COUNT(*) FROM modules) AS modules,
            (SELECT COUNT(*) FROM exercises) AS exercises,
            (SELECT COUNT(*) FROM questions WHERE lesson_id IS NOT NULL) AS questions,
            (SELECT COUNT(*) FROM projects) AS projects,
            (SELECT COUNT(*) FROM users WHERE role = 'student') AS learners"
);
$projects = ProjectModel::all();
$badges = array_slice(BadgeService::all(), 0, 8);
$catalog = CourseModel::catalog();

$faq = [
    ['Faut-il des connaissances préalables ?', 'Non. Le parcours commence à zéro : ce qu’est une page web, comment fonctionne un navigateur, puis votre toute première balise. Chaque notion est expliquée avec des exemples, ligne par ligne.'],
    ['Dois-je installer un logiciel ?', 'Non. Tout se passe dans votre navigateur grâce à l’éditeur intégré : vous écrivez du HTML et du CSS et voyez le résultat immédiatement. Plus tard, nous vous montrons comment travailler avec un éditeur comme VS Code.'],
    ['Combien de temps faut-il pour terminer le parcours ?', 'Comptez environ 30 à 40 heures pour l’ensemble des trois niveaux, à votre rythme. Les leçons durent de 10 à 20 minutes : idéal pour progresser un peu chaque jour.'],
    ['Comment ma progression est-elle validée ?', 'Chaque leçon se termine par un quiz. Une fois le quiz réussi (70 % minimum), vous validez le chapitre. Les exercices pratiques sont corrigés automatiquement : le système vérifie que votre code contient les éléments attendus.'],
    ['Est-ce que j’obtiens un certificat ?', 'Oui. Lorsque vous avez terminé toutes les leçons du parcours, un certificat nominatif avec un identifiant unique et votre score final est généré. Il est vérifiable en ligne.'],
    ['Le HTML et le CSS suffisent-ils pour créer un site ?', 'Ils suffisent pour créer des sites vitrines, portfolios, pages de présentation et interfaces complètes. Ils sont aussi la base indispensable avant d’apprendre JavaScript ou un framework.'],
];

$pageDescription = 'Apprenez HTML & CSS en construisant de vrais projets : cours pas à pas, éditeur de code dans le navigateur, exercices corrigés, quiz, badges et certificat.';
$activeNav = 'home';
$jsonLd = [
    '@context' => 'https://schema.org',
    '@graph'   => [
        ['@type' => 'EducationalOrganization', 'name' => setting('site_name', config('app.name')), 'url' => absolute_url('')],
        ['@type' => 'FAQPage', 'mainEntity' => array_map(static fn ($q) => [
            '@type' => 'Question', 'name' => $q[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $q[1]],
        ], $faq)],
    ],
];
require ROOT_PATH . '/includes/header.php';
?>
<!-- HERO ------------------------------------------------------------- -->
<section class="hero">
  <div class="container hero__grid">
    <div>
      <p class="eyebrow"><?= icon('terminal', 'icon icon--sm') ?> Plateforme d’apprentissage interactive</p>
      <h1>Apprenez <span class="gradient-text">HTML &amp; CSS</span> en construisant de vrais projets.</h1>
      <p class="lead">Une plateforme interactive pour apprendre le développement web étape par étape, pratiquer directement dans votre navigateur et construire vos premières interfaces professionnelles.</p>
      <div class="btn-row hero__actions">
        <a class="btn btn--primary btn--lg" href="<?= e(is_logged_in() ? url('dashboard/index.php') : url('auth/register.php')) ?>">Commencer gratuitement <?= icon('arrow-right') ?></a>
        <a class="btn btn--ghost btn--lg" href="<?= e(route('courses')) ?>">Découvrir les cours</a>
      </div>
      <div class="hero__trust">
        <span><?= icon('check') ?> <?= (int) $counts['lessons'] ?> leçons détaillées</span>
        <span><?= icon('check') ?> Éditeur de code intégré</span>
        <span><?= icon('check') ?> Certificat de fin de parcours</span>
      </div>
    </div>

    <div class="hero__visual reveal">
      <span class="floating-chip floating-chip--1"><?= icon('award') ?> Badge « Flexbox Master »</span>
      <div class="code-window" aria-label="Animation : du code HTML et CSS s’écrit et le rendu apparaît en direct" role="img">
        <div class="code-window__bar">
          <span class="code-block__dots" aria-hidden="true"><i></i><i></i><i></i></span>
          <div class="code-window__tabs"><span class="code-window__tab is-active">index.html</span><span class="code-window__tab">style.css</span></div>
        </div>
        <div class="code-window__body">
          <div class="code-window__code" data-typing="html" aria-hidden="true"></div>
          <div class="code-window__preview" aria-hidden="true">
            <div class="demo-nav demo-step" data-trigger="<nav>">Mon Site <span><i>Accueil</i><i>Projets</i></span></div>
            <div class="demo-hero demo-step" data-trigger="<h1>"><b>Bonjour, je suis Léa</b><small>Développeuse web front-end</small></div>
            <div class="demo-cards demo-step" data-trigger="class=&quot;cards&quot;"><i></i><i></i><i></i></div>
            <span class="demo-btn demo-step" data-trigger="<a">Me contacter →</span>
          </div>
        </div>
      </div>
      <span class="floating-chip floating-chip--2"><?= icon('check-circle') ?> Exercice réussi +15 pts</span>
      <script type="text/plain" id="typing-source">
<header>
  <nav>Mon Site</nav>
</header>
<main>
  <h1>Bonjour, je suis Léa</h1>
  <p>Développeuse web front-end</p>
  <section class="cards">
    <article>Portfolio</article>
  </section>
  <a href="#contact">Me contacter</a>
</main></script>
    </div>
  </div>
</section>

<!-- CHIFFRES ---------------------------------------------------------- -->
<section class="container">
  <div class="stats-band reveal">
    <div class="stats-band__item"><div class="stats-band__value" data-count="<?= (int) $counts['modules'] ?>">0</div><div class="stats-band__label">modules</div></div>
    <div class="stats-band__item"><div class="stats-band__value" data-count="<?= (int) $counts['lessons'] ?>">0</div><div class="stats-band__label">leçons</div></div>
    <div class="stats-band__item"><div class="stats-band__value" data-count="<?= (int) $counts['exercises'] ?>">0</div><div class="stats-band__label">exercices interactifs</div></div>
    <div class="stats-band__item"><div class="stats-band__value" data-count="<?= (int) $counts['questions'] ?>">0</div><div class="stats-band__label">questions de quiz</div></div>
  </div>
</section>

<!-- POURQUOI ---------------------------------------------------------- -->
<section class="section" id="pourquoi">
  <div class="container">
    <div class="section__head section__head--center reveal">
      <p class="eyebrow">Pourquoi HTML &amp; CSS ?</p>
      <h2>Les fondations de tout ce que vous voyez sur le Web</h2>
      <p class="lead">Chaque site, chaque application web, chaque e-mail mis en forme repose sur HTML pour la structure et CSS pour l’apparence. Les maîtriser, c’est comprendre le Web de l’intérieur.</p>
    </div>
    <div class="grid grid--3">
      <article class="card card--hover reveal">
        <span class="card__icon card__icon--html"><?= icon('html', 'icon icon--lg') ?></span>
        <h3 class="card__title">Structurer l’information</h3>
        <p class="muted">HTML décrit le sens du contenu : titres, paragraphes, liens, images, formulaires. Un HTML bien écrit est lisible par les humains, les moteurs de recherche et les technologies d’assistance.</p>
      </article>
      <article class="card card--hover reveal reveal-delay-1">
        <span class="card__icon card__icon--css"><?= icon('css', 'icon icon--lg') ?></span>
        <h3 class="card__title">Créer des interfaces</h3>
        <p class="muted">CSS transforme une page brute en interface moderne : couleurs, typographie, mises en page Flexbox et Grid, animations, adaptation à tous les écrans.</p>
      </article>
      <article class="card card--hover reveal reveal-delay-2">
        <span class="card__icon card__icon--violet"><?= icon('rocket', 'icon icon--lg') ?></span>
        <h3 class="card__title">Ouvrir des portes</h3>
        <p class="muted">Intégrateur web, développeur front-end, webdesigner, créateur de contenu : ces compétences sont le premier pas vers de nombreux métiers et projets personnels.</p>
      </article>
    </div>
  </div>
</section>

<!-- PARCOURS ----------------------------------------------------------- -->
<section class="section section--tight" id="parcours">
  <div class="container">
    <div class="section__head reveal">
      <p class="eyebrow">Parcours pédagogique</p>
      <h2>Trois niveaux, une progression pensée pas à pas</h2>
      <p class="lead">Chaque niveau s’appuie sur le précédent. Vous ne passez à la suite qu’après avoir compris, pratiqué et validé.</p>
    </div>
    <div class="timeline">
      <?php
      $levels = [
          1 => ['Débutant', 'Les fondamentaux de HTML et CSS : structure d’une page, textes, liens, sélecteurs, couleurs, typographie et modèle de boîte.'],
          2 => ['Intermédiaire', 'Construire de vraies interfaces : images, listes, tableaux, formulaires, positionnement, Flexbox, Grid et pseudo-classes.'],
          3 => ['Avancé', 'Sémantique, accessibilité, SEO, responsive design, animations, variables CSS, architecture et projets complets.'],
      ];
      foreach ($levels as $n => [$name, $desc]): ?>
        <div class="timeline__item reveal">
          <span class="timeline__dot"><?= sprintf('%02d', $n) ?></span>
          <div class="card">
            <p class="eyebrow">Niveau <?= $n ?></p>
            <h3 class="card__title"><?= e($name) ?></h3>
            <p class="muted"><?= e($desc) ?></p>
            <div class="btn-row">
              <?php foreach ($catalog as $c): if ((int) $c['level'] !== $n) continue; ?>
                <a class="chip" href="<?= e(route('course', $c['slug'])) ?>"><?= icon($c['category_slug'] === 'css' ? 'css' : 'html', 'icon icon--sm') ?> <?= e($c['title']) ?></a>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CE QUE VOUS ALLEZ APPRENDRE ----------------------------------------- -->
<section class="section" id="programme">
  <div class="container">
    <div class="section__head section__head--center reveal">
      <p class="eyebrow">Programme</p>
      <h2>Ce que vous allez apprendre</h2>
    </div>
    <div class="grid grid--2">
      <div class="card card--accent-html reveal">
        <h3 class="card__title text-html"><?= icon('html') ?> HTML — 15 modules</h3>
        <p class="muted">De votre première balise à une page sémantique, accessible et optimisée pour le référencement.</p>
        <div class="topics topics--html">
          <?php foreach (['DOCTYPE', '<head>', '<body>', 'titres', 'paragraphes', 'liens', 'images', 'listes', 'tableaux', 'formulaires', 'attributs', 'classes & IDs', '<header>', '<nav>', '<main>', '<section>', '<article>', 'audio & vidéo', 'iframe', 'métadonnées', 'accessibilité', 'SEO'] as $t): ?><span><?= e($t) ?></span><?php endforeach; ?>
        </div>
      </div>
      <div class="card card--accent-css reveal reveal-delay-1">
        <h3 class="card__title text-css"><?= icon('css') ?> CSS — 15 modules</h3>
        <p class="muted">De la syntaxe de base aux mises en page modernes, responsive et animées.</p>
        <div class="topics topics--css">
          <?php foreach (['sélecteurs', 'cascade', 'couleurs', 'typographie', 'unités', 'box model', 'margin', 'padding', 'display', 'position', 'flexbox', 'grid', 'media queries', 'pseudo-classes', '::before', 'transitions', 'animations', 'transform', 'ombres', 'dégradés', 'variables', 'architecture'] as $t): ?><span><?= e($t) ?></span><?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- EXERCICES ---------------------------------------------------------- -->
<section class="section section--tight" id="exercices">
  <div class="container grid grid--2" style="align-items:center">
    <div class="reveal">
      <p class="eyebrow">Exercices interactifs</p>
      <h2>Vous apprenez en écrivant du code, pas en le regardant</h2>
      <p class="lead">Un éditeur HTML/CSS avec aperçu en direct est intégré à chaque leçon. Vos exercices sont corrigés automatiquement, avec un retour précis sur ce qui manque.</p>
      <ul class="feature-list">
        <li><?= icon('check-circle') ?> Exercices pratiques : écrivez le code demandé</li>
        <li><?= icon('check-circle') ?> Compléter le code : trouvez la partie manquante</li>
        <li><?= icon('check-circle') ?> Corriger le code : repérez et réparez les erreurs</li>
        <li><?= icon('check-circle') ?> QCM et Vrai/Faux avec explication immédiate</li>
      </ul>
      <div class="btn-row" style="margin-top:1.5rem"><a class="btn btn--primary" href="<?= e(route('playground')) ?>"><?= icon('code') ?> Essayer l’éditeur</a><a class="btn btn--ghost" href="<?= e(route('exercises')) ?>">Voir les exercices</a></div>
    </div>
    <div class="reveal reveal-delay-1">
      <?= Markdown::codeBlock("<h1>Bienvenue</h1>\n<p class=\"intro\">Mon premier paragraphe.</p>", 'html', 'Exercice — Votre code') ?>
      <ul class="check-results" aria-label="Exemple de correction automatique">
        <li class="is-ok"><?= icon('check-circle') ?> Un titre &lt;h1&gt; contient « Bienvenue »</li>
        <li class="is-ok"><?= icon('check-circle') ?> Un paragraphe possède la classe « intro »</li>
        <li class="is-ok"><?= icon('check-circle') ?> Toutes les balises sont correctement fermées</li>
      </ul>
    </div>
  </div>
</section>

<!-- PROJETS ------------------------------------------------------------ -->
<section class="section" id="projets">
  <div class="container">
    <div class="section__head reveal">
      <p class="eyebrow">Projets pratiques</p>
      <h2>Chaque grande étape se termine par un vrai projet</h2>
      <p class="lead">Consignes, étapes guidées, critères de réussite, solution commentée et challenge bonus.</p>
    </div>
    <div class="grid grid--4">
      <?php foreach ($projects as $i => $p): ?>
        <a class="card card--hover card--link project-card reveal reveal-delay-<?= min(3, $i) ?>" href="<?= e(route('project', $p['slug'])) ?>">
          <span class="project-card__num" aria-hidden="true"><?= sprintf('%02d', $i + 1) ?></span>
          <span class="tag tag--level-<?= (int) $p['level'] ?>"><?= e(level_label((int) $p['level'])) ?></span>
          <h3 class="card__title"><?= e($p['title']) ?></h3>
          <p class="muted"><?= e($p['summary']) ?></p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- PROGRESSION & BADGES ----------------------------------------------- -->
<section class="section section--tight" id="progression">
  <div class="container grid grid--2" style="align-items:center">
    <div class="card reveal">
      <h3 class="card__title">Votre tableau de bord</h3>
      <p class="muted">Suivez votre avancement en temps réel.</p>
      <div class="progress-list">
        <div class="progress progress--html" data-animate-progress>
          <div class="progress__head"><span class="progress__label"><?= icon('html') ?> HTML</span><span class="progress__value">75 %</span></div>
          <div class="progress__track"><div class="progress__bar" style="--p:75"></div></div>
        </div>
        <div class="progress progress--css" data-animate-progress>
          <div class="progress__head"><span class="progress__label"><?= icon('css') ?> CSS</span><span class="progress__value">45 %</span></div>
          <div class="progress__track"><div class="progress__bar" style="--p:45"></div></div>
        </div>
        <div class="progress" data-animate-progress>
          <div class="progress__head"><span class="progress__label"><?= icon('target') ?> Parcours global</span><span class="progress__value">60 %</span></div>
          <div class="progress__track"><div class="progress__bar" style="--p:60"></div></div>
        </div>
      </div>
    </div>
    <div class="reveal reveal-delay-1">
      <p class="eyebrow">Progression &amp; badges</p>
      <h2>Chaque étape franchie est récompensée</h2>
      <p class="lead">Leçons terminées, exercices réussis, score moyen, prochain cours recommandé : tout est enregistré. Débloquez des badges et grimpez dans le classement.</p>
      <div class="badge-row" style="margin-top:1.25rem">
        <?php foreach ($badges as $b): ?>
          <span class="badge-medal badge-medal--sm" style="--c:<?= e($b['color']) ?>" title="<?= e($b['name']) ?>"><?= icon($b['icon']) ?><span class="sr-only"><?= e($b['name']) ?></span></span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- FAQ ------------------------------------------------------------------ -->
<section class="section" id="faq">
  <div class="container" style="max-width:860px">
    <div class="section__head section__head--center reveal">
      <p class="eyebrow">FAQ</p>
      <h2>Questions fréquentes</h2>
    </div>
    <div class="accordion reveal">
      <?php foreach ($faq as [$q, $a]): ?>
        <details><summary><?= e($q) ?></summary><div><p><?= e($a) ?></p></div></details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA ------------------------------------------------------------------ -->
<section class="container">
  <div class="cta reveal">
    <p class="eyebrow">Prêt à écrire votre première balise ?</p>
    <h2>Commencez aujourd’hui, construisez votre premier site cette semaine.</h2>
    <p class="lead">Inscription gratuite. Aucun prérequis. Un navigateur suffit.</p>
    <div class="btn-row">
      <a class="btn btn--primary btn--lg" href="<?= e(is_logged_in() ? url('dashboard/index.php') : url('auth/register.php')) ?>">Commencer gratuitement <?= icon('arrow-right') ?></a>
      <a class="btn btn--ghost btn--lg" href="<?= e(route('path')) ?>">Voir le parcours</a>
    </div>
  </div>
</section>
<?php require ROOT_PATH . '/includes/footer.php'; ?>
