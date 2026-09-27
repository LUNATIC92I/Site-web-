<?php
/** Projets pratiques proposés à la fin de chaque grande section. */
return [
    [
        'slug' => 'ma-premiere-page-personnelle',
        'title' => 'Ma première page personnelle',
        'category' => 'html',
        'level' => 1,
        'summary' => 'Créez une page HTML complète qui vous présente : titres, paragraphes, liste, image et liens.',
        'objective' => 'Mettre en pratique toutes les notions du cours **HTML — Les fondations** en construisant une page de présentation personnelle complète et valide, **uniquement en HTML**.',
        'instructions' => <<<'MD'
Créez une page qui vous présente (ou présente un personnage imaginaire). La page doit contenir :

- un document HTML complet : `<!DOCTYPE html>`, `<html lang="fr">`, `<head>` avec `<meta charset>` et `<title>`, `<body>` ;
- un titre principal `<h1>` avec votre nom ;
- au moins **deux sous-titres** `<h2>` (par exemple « À propos » et « Mes passions ») ;
- au moins **deux paragraphes** ;
- un mot ou une phrase mis en valeur avec `<strong>` ou `<em>` ;
- une **image** avec un texte alternatif pertinent ;
- une **liste** de vos passions ou compétences ;
- au moins **un lien** externe qui s’ouvre dans un nouvel onglet de façon sécurisée.
MD,
        'steps' => [
            'Écrivez le squelette du document : `<!DOCTYPE html>`, `<html lang="fr">`, `<head>`, `<body>`.',
            'Dans `<head>`, ajoutez `<meta charset="utf-8">` et un `<title>` explicite.',
            'Ajoutez votre nom dans un `<h1>`, puis une phrase d’accroche dans un paragraphe.',
            'Créez une section « À propos » avec un `<h2>` et un ou deux paragraphes.',
            'Ajoutez une image avec les attributs `src` et `alt`.',
            'Créez une section « Mes passions » avec une liste `<ul>`.',
            'Terminez par un lien vers un site que vous aimez, avec `target="_blank"` et `rel="noopener"`.',
            'Relisez votre code : indentation, balises fermées, imbrication correcte.',
        ],
        'resources' => [
            '[MDN — Structure d’un document HTML](https://developer.mozilla.org/fr/docs/Learn/HTML/Introduction_to_HTML/Getting_started)',
            '[Validateur W3C](https://validator.w3.org/#validate_by_input)',
            'Images libres de droits : [placehold.co](https://placehold.co) pour des images de test',
        ],
        'criteria' => [
            'Le document commence par `<!DOCTYPE html>` et déclare la langue française',
            'La page possède un titre `<title>` et un seul `<h1>`',
            'Au moins deux `<h2>` et deux paragraphes',
            'Une image avec un attribut `alt` non vide',
            'Une liste d’au moins trois éléments',
            'Un lien externe ouvert dans un nouvel onglet avec `rel="noopener"`',
        ],
        'starter_html' => <<<'HTML'
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <!-- Votre page commence ici -->

</body>
</html>
HTML,
        'solution_html' => <<<'HTML'
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Léa Martin — Ma page personnelle</title>
</head>
<body>
  <h1>Léa Martin</h1>
  <p>Future développeuse web, passionnée par le <strong>design</strong> et la photographie.</p>

  <h2>À propos</h2>
  <img src="https://placehold.co/240x240/png?text=Photo" alt="Portrait de Léa souriante" width="240" height="240">
  <p>J’apprends le HTML et le CSS pour créer mon propre portfolio. J’aime comprendre <em>comment</em> les choses fonctionnent.</p>

  <h2>Mes passions</h2>
  <ul>
    <li>La photographie de rue</li>
    <li>Les jeux de société</li>
    <li>La randonnée en montagne</li>
  </ul>

  <h2>Me suivre</h2>
  <p>Mes photos préférées sont sur <a href="https://unsplash.com" target="_blank" rel="noopener">Unsplash</a>.</p>
</body>
</html>
HTML,
        'rules' => [
            ['t' => 'contains', 's' => '<!doctype html>', 'ci' => true, 'msg' => 'Le document commence par <!DOCTYPE html>'],
            ['t' => 'attr', 'sel' => 'html', 'attr' => 'lang', 'value' => 'fr', 'msg' => 'La balise <html> déclare lang="fr"'],
            ['t' => 'attr', 'sel' => 'meta', 'attr' => 'charset', 'msg' => 'L’encodage est déclaré avec <meta charset>'],
            ['t' => 'el', 'sel' => 'title', 'contains' => '', 'msg' => 'La page possède une balise <title>'],
            ['t' => 'el', 'sel' => 'h1', 'count' => 1, 'msg' => 'La page contient exactement un <h1>'],
            ['t' => 'el', 'sel' => 'h2', 'min' => 2, 'msg' => 'Au moins deux sous-titres <h2>'],
            ['t' => 'el', 'sel' => 'p', 'min' => 2, 'msg' => 'Au moins deux paragraphes'],
            ['t' => 'el', 'sel' => 'strong, em', 'msg' => 'Un texte est mis en valeur avec <strong> ou <em>'],
            ['t' => 'attr', 'sel' => 'img', 'attr' => 'alt', 'nonempty' => true, 'msg' => 'Une image possède un texte alternatif non vide'],
            ['t' => 'el', 'sel' => 'ul li, ol li', 'min' => 3, 'msg' => 'Une liste contient au moins trois éléments'],
            ['t' => 'attr', 'sel' => 'a[target]', 'attr' => 'rel', 'contains' => 'noopener', 'msg' => 'Le lien externe utilise target="_blank" et rel="noopener"'],
        ],
        'bonus' => 'Ajoutez un tableau « Mon emploi du temps idéal » (jours / activités) et une ancre en haut de page permettant de revenir au début depuis le bas de la page.',
    ],
    [
        'slug' => 'landing-page-moderne',
        'title' => 'Une landing page moderne',
        'category' => 'css',
        'level' => 1,
        'summary' => 'Stylisez une page de présentation de produit : typographie, couleurs, boîtes, bouton d’appel à l’action.',
        'objective' => 'Appliquer les fondations du CSS (sélecteurs, couleurs, typographie, modèle de boîte) pour transformer une page HTML brute en **landing page** élégante.',
        'instructions' => <<<'MD'
Le HTML de la page de présentation de l’application fictive **« FocusApp »** vous est fourni. Votre mission : écrire le CSS.

Exigences :

- une police lisible définie sur `body`, avec une hauteur de ligne confortable ;
- une section d’en-tête (`.hero`) avec une couleur ou un dégradé de fond et du texte centré ;
- un bouton d’appel à l’action (`.btn`) avec padding, coins arrondis et un état `:hover` ;
- des cartes de fonctionnalités (`.feature`) avec padding, bordure ou ombre et coins arrondis ;
- `box-sizing: border-box` appliqué à tous les éléments ;
- un contenu centré avec une largeur maximale (`max-width`).
MD,
        'steps' => [
            'Ajoutez une règle universelle `*, *::before, *::after { box-sizing: border-box; }`.',
            'Définissez `font-family`, `line-height` et une couleur de texte sur `body`.',
            'Centrez le contenu avec `.container { max-width: …; margin: 0 auto; }`.',
            'Stylisez `.hero` : fond coloré, texte centré, grand padding.',
            'Transformez le lien `.btn` en bouton : `display: inline-block`, padding, `border-radius`.',
            'Ajoutez un effet `:hover` sur le bouton.',
            'Stylisez les cartes `.feature` : fond, padding, `border-radius`, ombre.',
            'Finalisez le pied de page et vérifiez les contrastes de couleurs.',
        ],
        'resources' => ['[MDN — Le modèle de boîte](https://developer.mozilla.org/fr/docs/Learn/CSS/Building_blocks/The_box_model)', '[Coolors — générateur de palettes](https://coolors.co)', 'Leçons « Couleurs », « Typographie » et « Box model » de ce parcours'],
        'criteria' => ['`box-sizing: border-box` est appliqué globalement', 'Le `body` définit police et hauteur de ligne', 'La section `.hero` a un fond et un texte centré', 'Le bouton `.btn` a un padding, des coins arrondis et un état `:hover`', 'Les cartes `.feature` ont des coins arrondis et un padding', 'Le contenu est limité en largeur avec `max-width`'],
        'starter_html' => <<<'HTML'
<header class="hero">
  <div class="container">
    <h1>FocusApp</h1>
    <p class="hero__text">L’application qui vous aide à rester concentré, une tâche à la fois.</p>
    <a class="btn" href="#fonctionnalites">Découvrir</a>
  </div>
</header>

<main class="container" id="fonctionnalites">
  <h2>Pourquoi FocusApp ?</h2>
  <div class="features">
    <article class="feature">
      <h3>Minuteur Pomodoro</h3>
      <p>Travaillez 25 minutes, reposez-vous 5 minutes. Simple et efficace.</p>
    </article>
    <article class="feature">
      <h3>Listes intelligentes</h3>
      <p>Vos tâches sont classées automatiquement par priorité.</p>
    </article>
    <article class="feature">
      <h3>Statistiques</h3>
      <p>Visualisez vos progrès semaine après semaine.</p>
    </article>
  </div>
</main>

<footer class="footer">
  <p>© FocusApp — Projet d’apprentissage CSS</p>
</footer>
HTML,
        'starter_css' => "/* Écrivez votre CSS ici */\n",
        'solution_html' => null,
        'solution_css' => <<<'CSS'
*, *::before, *::after {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
  line-height: 1.6;
  color: #1e293b;
  background: #f8fafc;
}

.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 0 20px;
}

.hero {
  padding: 80px 0;
  text-align: center;
  color: #ffffff;
  background: linear-gradient(135deg, #4f46e5, #0ea5e9);
}

.hero h1 {
  margin: 0 0 12px;
  font-size: 48px;
  letter-spacing: -1px;
}

.hero__text {
  font-size: 20px;
  opacity: 0.9;
}

.btn {
  display: inline-block;
  margin-top: 16px;
  padding: 12px 28px;
  border-radius: 999px;
  background: #ffffff;
  color: #4f46e5;
  font-weight: bold;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(15, 23, 42, 0.25);
}

main h2 {
  margin: 48px 0 24px;
  text-align: center;
}

.feature {
  margin-bottom: 20px;
  padding: 24px;
  border-radius: 16px;
  background: #ffffff;
  box-shadow: 0 4px 16px rgba(15, 23, 42, 0.08);
}

.feature h3 {
  margin-top: 0;
  color: #4f46e5;
}

.footer {
  margin-top: 48px;
  padding: 24px;
  text-align: center;
  color: #64748b;
}
CSS,
        'rules' => [
            ['t' => 'css', 'prop' => 'box-sizing', 'value' => 'border-box', 'msg' => 'box-sizing: border-box est utilisé'],
            ['t' => 'css', 'sel' => 'body', 'prop' => 'font-family', 'msg' => 'Le body définit une police (font-family)'],
            ['t' => 'css', 'sel' => 'body', 'prop' => 'line-height', 'msg' => 'Le body définit une hauteur de ligne (line-height)'],
            ['t' => 'css', 'sel' => '.hero', 'prop' => 'text-align', 'value' => 'center', 'msg' => 'Le texte de .hero est centré'],
            ['t' => 'css', 'sel' => '.hero', 'prop' => 'background', 'msg' => 'La section .hero a un arrière-plan (background)'],
            ['t' => 'css', 'sel' => '.btn', 'prop' => 'padding', 'msg' => 'Le bouton .btn a un padding'],
            ['t' => 'css', 'sel' => '.btn', 'prop' => 'border-radius', 'msg' => 'Le bouton .btn a des coins arrondis'],
            ['t' => 'css', 'sel' => '.btn:hover', 'prop' => 'transform|background|background-color|box-shadow|color', 'msg' => 'Le bouton a un effet :hover'],
            ['t' => 'css', 'sel' => '.feature', 'prop' => 'border-radius', 'msg' => 'Les cartes .feature ont des coins arrondis'],
            ['t' => 'css', 'sel' => '.feature', 'prop' => 'padding', 'msg' => 'Les cartes .feature ont un padding'],
            ['t' => 'css', 'prop' => 'max-width', 'msg' => 'Le contenu est limité avec max-width'],
        ],
        'bonus' => 'Ajoutez une section « Témoignages » avec des citations (`<blockquote>`) stylisées, et une variante de bouton `.btn--outline` avec une bordure et un fond transparent.',
    ],
    [
        'slug' => 'portfolio-personnel',
        'title' => 'Portfolio personnel',
        'category' => null,
        'level' => 2,
        'summary' => 'Construisez un portfolio avec navigation, grille de projets en Flexbox ou Grid et formulaire de contact.',
        'objective' => 'Réaliser un portfolio complet, en HTML **et** CSS, utilisant une structure sémantique, une mise en page Flexbox/Grid et un formulaire de contact accessible.',
        'instructions' => <<<'MD'
Créez votre portfolio sur une seule page :

- un `<header>` contenant votre nom et une `<nav>` avec des liens d’ancre vers les sections ;
- une section **Projets** affichant au moins **trois cartes** disposées avec **Flexbox ou Grid** ;
- chaque carte contient une image (avec `alt`), un titre et une courte description ;
- une section **Contact** avec un formulaire : nom, e-mail (type `email`), message (`<textarea>`) et bouton d’envoi, chaque champ ayant un `<label>` associé ;
- un `<footer>` ;
- des effets `:hover` sur les liens de navigation et les cartes.
MD,
        'steps' => ['Écrivez la structure sémantique : `header`, `nav`, `main`, `section`, `footer`.', 'Ajoutez des `id` aux sections et des liens d’ancre dans la navigation.', 'Créez trois cartes de projet dans un conteneur `.projects`.', 'Disposez la navigation en ligne avec Flexbox.', 'Disposez les cartes avec Grid (`repeat(auto-fit, minmax(…))`) ou Flexbox avec `flex-wrap`.', 'Construisez le formulaire avec des `<label for>` reliés aux `id` des champs.', 'Ajoutez les états `:hover` et `:focus`.', 'Soignez les espacements (`gap`, `padding`) et la typographie.'],
        'resources' => ['[CSS-Tricks — A Complete Guide to Flexbox](https://css-tricks.com/snippets/css/a-guide-to-flexbox/)', '[CSS-Tricks — A Complete Guide to Grid](https://css-tricks.com/snippets/css/complete-guide-grid/)', 'Leçons « Formulaires », « Flexbox » et « Grid » de ce parcours'],
        'criteria' => ['Structure sémantique : `header`, `nav`, `main`, `footer`', 'Au moins trois cartes de projet avec image et texte alternatif', 'Mise en page avec `display: flex` ou `display: grid`', 'Formulaire avec champ e-mail, zone de message et labels associés', 'Au moins un état `:hover`'],
        'starter_html' => "<!-- Construisez votre portfolio ici -->\n",
        'starter_css' => "/* Styles du portfolio */\n",
        'solution_html' => <<<'HTML'
<header class="site-header">
  <p class="logo">Léa Martin</p>
  <nav aria-label="Navigation principale">
    <ul class="nav">
      <li><a href="#projets">Projets</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>
</header>

<main>
  <section class="intro">
    <h1>Développeuse web front-end</h1>
    <p>Je conçois des interfaces claires, accessibles et responsives.</p>
  </section>

  <section id="projets">
    <h2>Mes projets</h2>
    <div class="projects">
      <article class="card">
        <img src="https://placehold.co/400x240/png?text=Projet+1" alt="Capture de la landing page FocusApp">
        <h3>FocusApp</h3>
        <p>Landing page d’une application de productivité.</p>
      </article>
      <article class="card">
        <img src="https://placehold.co/400x240/png?text=Projet+2" alt="Capture du site de la boulangerie">
        <h3>Boulangerie Dupain</h3>
        <p>Site vitrine avec horaires et carte des produits.</p>
      </article>
      <article class="card">
        <img src="https://placehold.co/400x240/png?text=Projet+3" alt="Capture du blog de voyage">
        <h3>Carnet de voyage</h3>
        <p>Blog responsive avec galerie photo en Grid.</p>
      </article>
    </div>
  </section>

  <section id="contact">
    <h2>Me contacter</h2>
    <form class="contact-form" action="#" method="post">
      <label for="name">Nom</label>
      <input id="name" name="name" type="text" required>
      <label for="email">E-mail</label>
      <input id="email" name="email" type="email" required>
      <label for="message">Message</label>
      <textarea id="message" name="message" rows="5" required></textarea>
      <button type="submit">Envoyer</button>
    </form>
  </section>
</main>

<footer class="site-footer">
  <p>© Léa Martin — Portfolio</p>
</footer>
HTML,
        'solution_css' => <<<'CSS'
*, *::before, *::after { box-sizing: border-box; }

body {
  margin: 0;
  font-family: system-ui, sans-serif;
  line-height: 1.6;
  color: #0f172a;
}

.site-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 24px;
  border-bottom: 1px solid #e2e8f0;
}

.logo { margin: 0; font-weight: 800; }

.nav {
  display: flex;
  gap: 16px;
  margin: 0;
  padding: 0;
  list-style: none;
}

.nav a { color: #334155; text-decoration: none; }
.nav a:hover { color: #4f46e5; }

main { max-width: 1000px; margin: 0 auto; padding: 0 24px; }
.intro { padding: 64px 0 32px; text-align: center; }

.projects {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 24px;
}

.card {
  overflow: hidden;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
}

.card img { display: block; width: 100%; height: auto; }
.card h3, .card p { margin: 12px 16px; }

.contact-form {
  display: flex;
  flex-direction: column;
  gap: 8px;
  max-width: 480px;
}

.contact-form input,
.contact-form textarea {
  padding: 10px;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  font: inherit;
}

.contact-form input:focus,
.contact-form textarea:focus { outline: 2px solid #4f46e5; }

.contact-form button {
  align-self: flex-start;
  padding: 10px 24px;
  border: 0;
  border-radius: 8px;
  background: #4f46e5;
  color: white;
  font: inherit;
  cursor: pointer;
}

.site-footer { margin-top: 64px; padding: 24px; text-align: center; color: #64748b; }
CSS,
        'rules' => [
            ['t' => 'el', 'sel' => 'header', 'msg' => 'La page contient un <header>'],
            ['t' => 'el', 'sel' => 'nav a', 'min' => 2, 'msg' => 'Une <nav> contient au moins deux liens'],
            ['t' => 'el', 'sel' => 'main', 'msg' => 'La page contient un <main>'],
            ['t' => 'el', 'sel' => 'footer', 'msg' => 'La page contient un <footer>'],
            ['t' => 'el', 'sel' => 'article, .card', 'min' => 3, 'msg' => 'Au moins trois cartes de projet'],
            ['t' => 'attr', 'sel' => 'img', 'attr' => 'alt', 'nonempty' => true, 'msg' => 'Les images ont un texte alternatif'],
            ['t' => 'css', 'prop' => 'display', 'in' => ['grid', 'flex'], 'msg' => 'La mise en page utilise Flexbox ou Grid'],
            ['t' => 'el', 'sel' => 'form input[type=email]', 'msg' => 'Le formulaire contient un champ de type email'],
            ['t' => 'el', 'sel' => 'form textarea', 'msg' => 'Le formulaire contient une zone de message'],
            ['t' => 'el', 'sel' => 'label[for]', 'min' => 2, 'msg' => 'Les champs ont des <label for> associés'],
            ['t' => 'contains', 's' => ':hover', 'in' => 'css', 'msg' => 'Au moins un état :hover est défini'],
        ],
        'bonus' => 'Ajoutez un filtre visuel des projets (catégories en « chips ») et un mode sombre grâce aux variables CSS et à `prefers-color-scheme`.',
    ],
    [
        'slug' => 'site-professionnel-responsive',
        'title' => 'Site web professionnel responsive',
        'category' => null,
        'level' => 3,
        'final' => true,
        'summary' => 'Le projet final : un site d’entreprise complet, sémantique, accessible, responsive et animé.',
        'objective' => 'Démontrer la maîtrise de l’ensemble du parcours en réalisant la page d’accueil complète d’une entreprise fictive : **structure sémantique**, **accessibilité**, **SEO**, **responsive design**, **variables CSS** et **animations**.',
        'instructions' => <<<'MD'
Réalisez la page d’accueil de **« Studio Nova »**, une agence web fictive. Exigences :

**HTML**

- document complet : `<!DOCTYPE html>`, `lang="fr"`, `charset`, `viewport`, `<title>` et `<meta name="description">` ;
- structure sémantique : `header`, `nav`, `main`, au moins trois `section`, `footer` ;
- une hiérarchie de titres cohérente (un seul `<h1>`) ;
- une grille de services ou de réalisations, un formulaire de contact accessible ;
- images avec texte alternatif.

**CSS**

- des **variables CSS** (`:root { --… }`) pour les couleurs principales ;
- une mise en page **Flexbox** et/ou **Grid** ;
- au moins une **media query** pour adapter la page aux petits écrans ;
- une **transition** ou une **animation** ;
- la prise en compte de `prefers-reduced-motion`.
MD,
        'steps' => ['Rédigez le `<head>` complet (SEO + viewport).', 'Construisez la structure sémantique de toute la page.', 'Définissez vos couleurs et espacements en variables CSS.', 'Stylisez l’en-tête et la navigation (Flexbox).', 'Créez la section héro avec un appel à l’action.', 'Réalisez la grille de services (Grid + `auto-fit`).', 'Ajoutez le formulaire de contact avec labels.', 'Écrivez les media queries (approche mobile first recommandée).', 'Ajoutez des transitions sur les éléments interactifs, puis une règle `prefers-reduced-motion`.', 'Testez à 320px, 768px et 1440px ; vérifiez contraste et navigation au clavier.'],
        'resources' => ['[MDN — Responsive design](https://developer.mozilla.org/fr/docs/Learn/CSS/CSS_layout/Responsive_Design)', '[WebAIM — Contrast Checker](https://webaim.org/resources/contrastchecker/)', '[W3C — Validateur HTML](https://validator.w3.org/)', 'Toutes les leçons du niveau Avancé'],
        'criteria' => ['Balises `viewport` et `description` présentes', 'Structure sémantique complète', 'Un seul `<h1>`, au moins trois sections', 'Variables CSS utilisées', 'Au moins une media query', 'Flexbox ou Grid', 'Une transition ou animation', 'Prise en compte de `prefers-reduced-motion`', 'Formulaire accessible avec labels'],
        'starter_html' => <<<'HTML'
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <!-- Complétez le head : viewport, title, description -->
</head>
<body>

</body>
</html>
HTML,
        'starter_css' => ":root {\n  /* Vos variables */\n}\n",
        'solution_html' => <<<'HTML'
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Studio Nova — Agence web à Lyon</title>
  <meta name="description" content="Studio Nova conçoit des sites web rapides, accessibles et responsives pour les PME.">
</head>
<body>
  <header class="header">
    <a class="logo" href="#">Studio<span>Nova</span></a>
    <nav aria-label="Navigation principale">
      <ul class="nav">
        <li><a href="#services">Services</a></li>
        <li><a href="#realisations">Réalisations</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero">
      <h1>Des sites web qui font grandir votre activité</h1>
      <p>Design sur mesure, performance et accessibilité : nous créons votre présence en ligne.</p>
      <a class="btn" href="#contact">Demander un devis</a>
    </section>

    <section id="services" class="section">
      <h2>Nos services</h2>
      <div class="grid">
        <article class="card"><h3>Sites vitrines</h3><p>Une image professionnelle, optimisée pour le référencement.</p></article>
        <article class="card"><h3>Refonte</h3><p>Modernisez un site existant sans perdre votre audience.</p></article>
        <article class="card"><h3>Accessibilité</h3><p>Audit et mise en conformité avec les normes WCAG.</p></article>
      </div>
    </section>

    <section id="realisations" class="section">
      <h2>Réalisations</h2>
      <div class="grid">
        <figure class="work"><img src="https://placehold.co/480x300/png?text=Boulangerie" alt="Site de la boulangerie Dupain sur mobile et ordinateur"><figcaption>Boulangerie Dupain</figcaption></figure>
        <figure class="work"><img src="https://placehold.co/480x300/png?text=Cabinet" alt="Site du cabinet d'architectes Lignes"><figcaption>Cabinet Lignes</figcaption></figure>
      </div>
    </section>

    <section id="contact" class="section">
      <h2>Contact</h2>
      <form class="form" action="#" method="post">
        <label for="c-name">Nom</label>
        <input id="c-name" name="name" required>
        <label for="c-email">E-mail</label>
        <input id="c-email" name="email" type="email" required>
        <label for="c-msg">Votre projet</label>
        <textarea id="c-msg" name="message" rows="5" required></textarea>
        <button class="btn" type="submit">Envoyer</button>
      </form>
    </section>
  </main>

  <footer class="footer"><p>© Studio Nova — Tous droits réservés</p></footer>
</body>
</html>
HTML,
        'solution_css' => <<<'CSS'
:root {
  --color-primary: #7c3aed;
  --color-dark: #0f172a;
  --color-light: #f8fafc;
  --radius: 14px;
  --space: 24px;
}

*, *::before, *::after { box-sizing: border-box; }

body {
  margin: 0;
  font-family: system-ui, sans-serif;
  line-height: 1.6;
  color: var(--color-dark);
  background: var(--color-light);
}

.header {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  padding: var(--space);
}

.logo { font-weight: 800; font-size: 1.4rem; color: var(--color-dark); text-decoration: none; }
.logo span { color: var(--color-primary); }

.nav { display: flex; gap: 16px; margin: 0; padding: 0; list-style: none; }
.nav a { color: inherit; text-decoration: none; }
.nav a:hover, .nav a:focus-visible { color: var(--color-primary); }

.hero {
  padding: 64px var(--space);
  text-align: center;
  color: white;
  background: linear-gradient(135deg, var(--color-primary), #2563eb);
}

.hero h1 { font-size: clamp(1.8rem, 5vw, 3.2rem); margin-top: 0; }

.btn {
  display: inline-block;
  padding: 12px 28px;
  border: 0;
  border-radius: 999px;
  background: white;
  color: var(--color-primary);
  font: inherit;
  font-weight: 700;
  text-decoration: none;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2); }
.form .btn { background: var(--color-primary); color: white; align-self: flex-start; }

.section { max-width: 1100px; margin: 0 auto; padding: 56px var(--space); }

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: var(--space);
}

.card, .work {
  margin: 0;
  padding: var(--space);
  border-radius: var(--radius);
  background: white;
  box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
  animation: fade-up 0.6s ease both;
}

.work img { width: 100%; height: auto; border-radius: 8px; }

.form { display: flex; flex-direction: column; gap: 8px; max-width: 520px; }
.form input, .form textarea { padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font: inherit; }

.footer { padding: var(--space); text-align: center; color: #64748b; }

@keyframes fade-up {
  from { opacity: 0; transform: translateY(16px); }
  to { opacity: 1; transform: none; }
}

@media (min-width: 768px) {
  .header { flex-direction: row; justify-content: space-between; }
  .hero { padding: 120px var(--space); }
}

@media (prefers-reduced-motion: reduce) {
  * { animation: none !important; transition: none !important; }
}
CSS,
        'rules' => [
            ['t' => 'attr', 'sel' => 'meta[name=viewport]', 'attr' => 'content', 'contains' => 'width=device-width', 'msg' => 'La balise meta viewport est présente'],
            ['t' => 'attr', 'sel' => 'meta[name=description]', 'attr' => 'content', 'nonempty' => true, 'msg' => 'Une meta description est présente'],
            ['t' => 'attr', 'sel' => 'html', 'attr' => 'lang', 'nonempty' => true, 'msg' => 'La langue du document est déclarée'],
            ['t' => 'el', 'sel' => 'header', 'msg' => 'Un <header> est présent'],
            ['t' => 'el', 'sel' => 'nav', 'msg' => 'Une <nav> est présente'],
            ['t' => 'el', 'sel' => 'main', 'count' => 1, 'msg' => 'Un unique <main> est présent'],
            ['t' => 'el', 'sel' => 'section', 'min' => 3, 'msg' => 'Au moins trois <section>'],
            ['t' => 'el', 'sel' => 'footer', 'msg' => 'Un <footer> est présent'],
            ['t' => 'el', 'sel' => 'h1', 'count' => 1, 'msg' => 'Un seul <h1>'],
            ['t' => 'el', 'sel' => 'label[for]', 'min' => 2, 'msg' => 'Le formulaire utilise des labels associés'],
            ['t' => 'contains', 's' => 'var(--', 'in' => 'css', 'msg' => 'Des variables CSS sont utilisées'],
            ['t' => 'contains', 's' => '@media', 'in' => 'css', 'msg' => 'Au moins une media query'],
            ['t' => 'css', 'prop' => 'display', 'in' => ['grid', 'flex'], 'msg' => 'Flexbox ou Grid est utilisé'],
            ['t' => 'css', 'prop' => 'transition|animation', 'msg' => 'Une transition ou une animation est définie'],
            ['t' => 'contains', 's' => 'prefers-reduced-motion', 'in' => 'css', 'msg' => 'La préférence prefers-reduced-motion est respectée'],
        ],
        'bonus' => 'Ajoutez un menu mobile repliable (sans JavaScript, avec `<details>`), une section « Tarifs » en Grid avec une offre mise en avant, et visez un score Lighthouse Accessibilité de 100.',
    ],
];
