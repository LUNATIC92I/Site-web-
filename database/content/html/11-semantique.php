<?php
return [
    'slug' => 'html-semantique',
    'title' => 'Le HTML sémantique',
    'description' => 'Structurer une page avec les balises de sens : header, nav, main, section, article, aside, footer.',
    'lessons' => [
        [
            'slug' => 'pourquoi-la-semantique',
            'title' => 'Pourquoi le HTML sémantique ?',
            'duration' => 12,
            'intro' => <<<'MD'
Deux pages peuvent avoir exactement le même rendu à l’écran, l’une construite avec des dizaines de `<div>`, l’autre avec des balises sémantiques. Pour un humain qui regarde, aucune différence. Pour un moteur de recherche, un lecteur d’écran ou un développeur qui reprend le code, c’est le jour et la nuit.
MD,
            'objectives' => ['Comprendre ce qu’est la sémantique', 'Mesurer ses bénéfices : accessibilité, SEO, maintenance', 'Repérer une « soupe de div »'],
            'prerequisites' => ['Attributs globaux, div et span'],
            'theory' => <<<'MD'
## Qu’est-ce que la sémantique ?

La **sémantique**, c’est le **sens**. Une balise sémantique décrit la **nature** de son contenu : `<nav>` dit « ceci est une navigation », `<article>` dit « ceci est un contenu autonome ». Un `<div>`, lui, ne dit rien.

## Comparaison

```html
<!-- Non sémantique -->
<div class="header">
  <div class="menu">…</div>
</div>
<div class="content">…</div>
<div class="footer">…</div>
```

```html
<!-- Sémantique -->
<header>
  <nav>…</nav>
</header>
<main>…</main>
<footer>…</footer>
```

## Les bénéfices

### 1. Accessibilité

Les lecteurs d’écran créent des **repères** (*landmarks*) à partir de ces balises. L’utilisateur peut sauter directement au contenu principal ou à la navigation, au lieu d’écouter toute la page.

### 2. Référencement (SEO)

Les moteurs de recherche comprennent mieux quelle partie est le contenu principal, quelle partie est une navigation répétée sur chaque page, quel bloc est un article.

### 3. Maintenance

Le code se lit comme un plan. Un collègue comprend la structure en quelques secondes.

### 4. Fonctionnalités gratuites

Le mode lecture des navigateurs, les extensions, les assistants vocaux exploitent cette structure.

## Les balises de structure

| Balise | Rôle |
|---|---|
| `<header>` | En-tête (de la page ou d’une section) |
| `<nav>` | Bloc de navigation principal |
| `<main>` | Contenu principal (un seul par page) |
| `<section>` | Section thématique avec un titre |
| `<article>` | Contenu autonome (article, carte produit, commentaire) |
| `<aside>` | Contenu complémentaire (encadré, barre latérale) |
| `<footer>` | Pied (de la page ou d’une section) |

> [!TIP] Désactivez le CSS d’une page (dans Firefox : Affichage > Style de page > Aucun style). Une page sémantique reste parfaitement compréhensible.
MD,
            'syntax' => '<header>…</header>
<nav>…</nav>
<main>…</main>
<footer>…</footer>',
            'example_html' => <<<'HTML'
<header>
  <p><strong>Le Petit Journal</strong></p>
  <nav>
    <a href="#">Accueil</a> · <a href="#">Sports</a> · <a href="#">Culture</a>
  </nav>
</header>
<main>
  <article>
    <h1>Un nouveau musée ouvre ses portes</h1>
    <p>Le musée d’art moderne accueille ses premiers visiteurs ce week-end.</p>
  </article>
  <aside>
    <h2>À lire aussi</h2>
    <p>Les expositions à ne pas manquer cet été.</p>
  </aside>
</main>
<footer>
  <p>© Le Petit Journal</p>
</footer>
HTML,
            'lines' => [
                ['<header>', 'En-tête du site : logo, navigation.'],
                ['<nav>', 'Navigation principale : un repère pour les lecteurs d’écran.'],
                ['<main>', 'Le contenu principal, unique dans la page.'],
                ['<article>', 'Un contenu autonome : l’article de presse.'],
                ['<aside>', 'Contenu lié mais secondaire.'],
                ['<footer>', 'Pied de page : mentions, copyright.'],
            ],
            'reference' => [
                ['<header>', 'En-tête.'],
                ['<nav>', 'Navigation.'],
                ['<main>', 'Contenu principal.'],
                ['<footer>', 'Pied.'],
            ],
            'mistakes' => [
                'Construire toute la page avec des `<div class="header">`, `<div class="nav">`…',
                'Choisir une balise sémantique pour son apparence (elle n’en a aucune par défaut).',
                'Penser que la sémantique est « optionnelle » parce que l’écran ne change pas.',
            ],
            'practices' => [
                'Commencer par la structure sémantique, styler ensuite.',
                'Réserver `<div>` au regroupement purement visuel.',
                'Vérifier la structure avec l’arbre d’accessibilité des outils de développement.',
            ],
            'practical' => 'Les audits d’accessibilité (obligatoires pour de nombreux sites publics et, depuis 2025, pour beaucoup d’entreprises en Europe) vérifient la présence des repères `header`, `nav`, `main` et `footer`.',
            'summary' => ['Sémantique = sens du contenu.', 'Bénéfices : accessibilité, SEO, maintenance.', 'Remplacez les div de structure par header, nav, main, footer…'],
            'challenge' => 'Prenez une page de votre choix, affichez son code source et comptez les balises sémantiques. Pourriez-vous en ajouter ?',
            'exercises' => [
                [
                    'title' => 'Remplacer la soupe de div',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Remplacez les `<div>` par les balises sémantiques adaptées : `.header` → `<header>`, `.nav` → `<nav>`, `.content` → `<main>`, `.footer` → `<footer>`.',
                    'starter_html' => '<div class="header">
  <div class="nav"><a href="#">Accueil</a> <a href="#">Blog</a></div>
</div>
<div class="content">
  <h1>Bienvenue</h1>
</div>
<div class="footer">© 2026</div>',
                    'solution_html' => '<header>
  <nav><a href="#">Accueil</a> <a href="#">Blog</a></nav>
</header>
<main>
  <h1>Bienvenue</h1>
</main>
<footer>© 2026</footer>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'header nav', 'msg' => 'Un <nav> dans un <header>'],
                        ['t' => 'el', 'sel' => 'main h1', 'msg' => 'Le titre est dans <main>'],
                        ['t' => 'el', 'sel' => 'footer', 'msg' => 'Un <footer> est présent'],
                        ['t' => 'noel', 'sel' => 'div', 'msg' => 'Plus aucune <div>'],
                    ],
                    'hint' => 'Remplacez aussi les balises fermantes `</div>`.',
                    'explanation' => 'Chaque zone a désormais une balise qui décrit son rôle.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que signifie « sémantique » en HTML ?', 'a' => ['L’apparence', 'Le sens du contenu', 'La vitesse', 'La couleur'], 'c' => 1, 'e' => 'La sémantique décrit la nature du contenu.'],
                ['q' => 'Qui profite directement des balises sémantiques ?', 'a' => ['Les lecteurs d’écran', 'Les moteurs de recherche', 'Les développeurs', 'Tous'], 'c' => 3, 'e' => 'Accessibilité, SEO et maintenance.'],
                ['q' => 'Les balises sémantiques ont une apparence spéciale par défaut.', 'tf' => true, 'c' => false, 'e' => 'Faux : elles s’affichent comme des blocs neutres ; le sens est invisible.'],
            ],
        ],
        [
            'slug' => 'header-nav-main-footer',
            'title' => 'header, nav, main et footer',
            'duration' => 13,
            'intro' => <<<'MD'
Ces quatre balises forment le **squelette** de presque toutes les pages web. Chacune a des règles d’usage précises : combien peut-il y en avoir ? où les placer ? que peuvent-elles contenir ?
MD,
            'objectives' => ['Utiliser correctement header, nav, main et footer', 'Connaître leurs règles (nombre, emplacement)', 'Ajouter un lien d’évitement vers le contenu'],
            'prerequisites' => ['Pourquoi le HTML sémantique ?'],
            'theory' => <<<'MD'
## `<header>`

Contenu d’introduction : logo, titre du site, navigation, recherche. Il peut y en avoir **plusieurs** : un pour la page, un en haut d’un `<article>` (titre, auteur, date).

## `<nav>`

Réservé aux **blocs de navigation majeurs** : menu principal, fil d’Ariane, sommaire, pagination. Les liens isolés dans un paragraphe n’ont pas besoin de `<nav>`.

Si une page contient plusieurs `<nav>`, distinguez-les avec `aria-label` :

```html
<nav aria-label="Navigation principale">…</nav>
<nav aria-label="Fil d’Ariane">…</nav>
```

## `<main>`

Le **contenu principal et unique** de la page — ce qui la différencie des autres pages du site.

- **un seul** `<main>` visible par page ;
- il ne doit pas être placé dans `<header>`, `<nav>`, `<article>`, `<aside>` ou `<footer>`.

## `<footer>`

Informations de fin : copyright, liens légaux, contact, réseaux sociaux. Comme `<header>`, il peut aussi terminer un `<article>` ou une `<section>`.

## Le lien d’évitement

Les utilisateurs du clavier doivent traverser tout le menu avant d’atteindre le contenu. Un lien d’évitement, visible au focus, leur permet de sauter directement au `<main>` :

```html
<a class="skip-link" href="#contenu">Aller au contenu</a>
…
<main id="contenu">…</main>
```

Cette plateforme en possède un : appuyez sur `Tab` en arrivant sur une page.
MD,
            'syntax' => '<header><nav aria-label="…">…</nav></header>
<main id="contenu">…</main>
<footer>…</footer>',
            'example_html' => <<<'HTML'
<a class="skip" href="#contenu">Aller au contenu</a>
<header class="site">
  <strong>Atelier Bois</strong>
  <nav aria-label="Navigation principale">
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Créations</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>
</header>
<main id="contenu">
  <h1>Meubles artisanaux en chêne massif</h1>
  <p>Chaque pièce est fabriquée à la main dans notre atelier.</p>
</main>
<footer class="site">
  <p>© Atelier Bois — <a href="#">Mentions légales</a></p>
</footer>
HTML,
            'example_css' => <<<'CSS'
body { margin: 0; font-family: system-ui, sans-serif; }
.skip { position: absolute; left: -999px; }
.skip:focus { left: 8px; top: 8px; background: #fde68a; padding: 8px; }
header.site { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; background: #78350f; color: white; }
header.site ul { display: flex; gap: 16px; list-style: none; margin: 0; padding: 0; }
header.site a { color: white; }
main { padding: 20px; }
footer.site { padding: 12px 20px; background: #fef3c7; }
CSS,
            'lines' => [
                ['<a class="skip" href="#contenu">', 'Lien d’évitement, masqué jusqu’à ce qu’il reçoive le focus.'],
                ['<nav aria-label="Navigation principale">', 'Navigation nommée pour les lecteurs d’écran.'],
                ['<ul>', 'Les liens de navigation forment une liste.'],
                ['<main id="contenu">', 'Contenu principal, cible du lien d’évitement.'],
                ['<footer class="site">', 'Pied de page du site.'],
            ],
            'reference' => [
                ['<header>', 'Introduction (plusieurs possibles).'],
                ['<nav aria-label>', 'Navigation majeure, nommée si plusieurs.'],
                ['<main>', 'Contenu principal, un seul.'],
                ['<footer>', 'Pied (plusieurs possibles).'],
            ],
            'mistakes' => [
                'Plusieurs `<main>` dans la page.',
                'Mettre `<main>` à l’intérieur de `<header>` ou `<article>`.',
                'Entourer chaque petit groupe de liens d’un `<nav>`.',
                'Plusieurs `<nav>` sans `aria-label`.',
            ],
            'practices' => [
                'Un lien d’évitement vers `<main>`.',
                'Nommer les `<nav>` multiples.',
                'Menu principal en liste `<ul>`.',
            ],
            'practical' => 'Les frameworks de sites (WordPress, gabarits Laravel…) génèrent presque toujours ce squelette : un `header` et un `footer` communs à toutes les pages, et un `main` dont le contenu change.',
            'summary' => ['`header`/`footer` : plusieurs possibles.', '`nav` : navigations majeures, nommées si multiples.', '`main` : unique, contenu principal.', 'Lien d’évitement vers `main`.'],
            'challenge' => 'Ajoutez à une page un fil d’Ariane dans un second `<nav aria-label="Fil d’Ariane">` contenant une liste ordonnée.',
            'exercises' => [
                [
                    'title' => 'Le squelette sémantique',
                    'difficulty' => 2,
                    'instructions' => 'Construisez le squelette : un `<header>` contenant un `<nav>` avec `aria-label="Principale"` et au moins 2 liens, un unique `<main>` contenant un `<h1>`, puis un `<footer>`.',
                    'starter_html' => '',
                    'solution_html' => '<header>
  <nav aria-label="Principale">
    <a href="#">Accueil</a>
    <a href="#">Contact</a>
  </nav>
</header>
<main>
  <h1>Mon site</h1>
</main>
<footer>
  <p>© 2026</p>
</footer>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'header nav a', 'min' => 2, 'msg' => 'Un nav avec 2 liens dans le header'],
                        ['t' => 'attr', 'sel' => 'nav', 'attr' => 'aria-label', 'value' => 'Principale', 'msg' => 'Le nav a aria-label="Principale"'],
                        ['t' => 'el', 'sel' => 'main', 'count' => 1, 'msg' => 'Un seul <main>'],
                        ['t' => 'el', 'sel' => 'main h1', 'msg' => 'Un h1 dans le main'],
                        ['t' => 'el', 'sel' => 'footer', 'msg' => 'Un <footer>'],
                    ],
                    'hint' => 'L’ordre : header (avec nav), main, footer.',
                    'explanation' => 'Ce squelette crée les repères essentiels de la page.',
                ],
            ],
            'quiz' => [
                ['q' => 'Combien de `<main>` visibles par page ?', 'a' => ['Zéro', 'Un', 'Deux', 'Illimité'], 'c' => 1, 'e' => 'Un seul contenu principal.'],
                ['q' => 'Comment distinguer deux `<nav>` ?', 'a' => ['Avec des classes', 'Avec `aria-label`', 'Avec `id` uniquement', 'On ne peut pas'], 'c' => 1, 'e' => '`aria-label` leur donne un nom accessible.'],
                ['q' => 'Un `<article>` peut avoir son propre `<header>`.', 'tf' => true, 'c' => true, 'e' => 'Vrai : titre, auteur, date de l’article.'],
            ],
        ],
        [
            'slug' => 'section-article-aside',
            'title' => 'section, article et aside',
            'duration' => 14,
            'intro' => <<<'MD'
`<section>` ou `<article>` ? C’est une des questions les plus débattues du HTML. La règle est pourtant simple : un article a du sens **tout seul**, une section est une **partie** d’un tout. Et `<aside>` accueille ce qui est lié, mais secondaire.
MD,
            'objectives' => ['Choisir entre `<section>` et `<article>`', 'Utiliser `<aside>` à bon escient', 'Savoir quand un `<div>` reste le bon choix'],
            'prerequisites' => ['header, nav, main et footer'],
            'theory' => <<<'MD'
## `<article>` : un contenu autonome

Question à se poser : **ce contenu aurait-il du sens s’il était publié seul**, ailleurs (flux RSS, partage) ?

Exemples : article de blog, fiche produit dans une liste, commentaire, carte d’un événement, message d’un forum.

## `<section>` : une partie thématique

Un regroupement **thématique** d’une page, qui a en général **un titre** (`<h2>`, `<h3>`) :

```html
<main>
  <section>
    <h2>Nos services</h2>…
  </section>
  <section>
    <h2>Témoignages</h2>…
  </section>
</main>
```

Si vous ne pouvez pas donner de titre à votre section, c’est probablement un `<div>`.

## Imbrication

Les deux s’imbriquent librement : une `<section>` « Derniers articles » contient plusieurs `<article>` ; un long `<article>` peut être découpé en `<section>`.

## `<aside>` : le contenu complémentaire

Contenu **lié** au contenu principal mais **pas indispensable** à sa compréhension : encadré « Le saviez-vous ? », biographie de l’auteur, liens connexes, publicité, barre latérale.

## L’arbre de décision

1. Le contenu est-il autonome ? → `<article>`
2. Est-il secondaire / annexe ? → `<aside>`
3. Est-ce une partie thématique avec un titre ? → `<section>`
4. Sinon (regroupement visuel) → `<div>`
MD,
            'syntax' => '<section><h2>…</h2> <article>…</article> </section>
<aside>…</aside>',
            'example_html' => <<<'HTML'
<main>
  <section>
    <h2>Derniers articles</h2>
    <article>
      <h3>Débuter en photographie</h3>
      <p>Les réglages essentiels pour vos premières photos.</p>
    </article>
    <article>
      <h3>La règle des tiers</h3>
      <p>Composer une image équilibrée en un coup d’œil.</p>
    </article>
  </section>
  <aside>
    <h2>Le saviez-vous ?</h2>
    <p>La première photographie date de 1826.</p>
  </aside>
</main>
HTML,
            'lines' => [
                ['<section>', 'Partie thématique de la page, avec son titre.'],
                ['<h2>Derniers articles</h2>', 'Le titre qui justifie la section.'],
                ['<article>', 'Chaque résumé est autonome : il pourrait être partagé seul.'],
                ['<aside>', 'Anecdote liée au thème mais non indispensable.'],
            ],
            'reference' => [
                ['<article>', 'Contenu autonome.'],
                ['<section>', 'Partie thématique, avec un titre.'],
                ['<aside>', 'Contenu complémentaire.'],
            ],
            'mistakes' => [
                'Remplacer tous les `<div>` par des `<section>`.',
                'Une `<section>` sans titre.',
                'Placer le contenu principal dans `<aside>`.',
            ],
            'practices' => [
                'Une section = un titre.',
                'Un article = compréhensible seul.',
                'Garder `<div>` pour la mise en page pure.',
            ],
            'practical' => 'Sur une page d’accueil de site vitrine, chaque bloc (« Services », « Réalisations », « Contact ») est une `<section>` avec son `<h2>` ; les cartes de réalisations à l’intérieur sont des `<article>`.',
            'summary' => ['`<article>` : autonome.', '`<section>` : partie thématique avec titre.', '`<aside>` : complémentaire.', 'Aucun des trois ? `<div>`.'],
            'challenge' => 'Structurez la page d’un restaurant : sections « La carte » (plats en articles), « Horaires », « Avis clients » (avis en articles), et un aside « Offre du jour ».',
            'exercises' => [
                [
                    'title' => 'Une section d’articles',
                    'difficulty' => 2,
                    'instructions' => 'Créez une `<section>` avec un `<h2>` **Actualités**, contenant **deux** `<article>` ayant chacun un `<h3>`. Ajoutez ensuite un `<aside>` contenant un paragraphe.',
                    'starter_html' => '',
                    'solution_html' => '<section>
  <h2>Actualités</h2>
  <article>
    <h3>Nouvelle recette</h3>
    <p>La tarte aux pommes revisitée.</p>
  </article>
  <article>
    <h3>Atelier du samedi</h3>
    <p>Apprenez à faire votre pain.</p>
  </article>
</section>
<aside>
  <p>Inscrivez-vous à la newsletter !</p>
</aside>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'section > h2', 'text' => 'Actualités', 'msg' => 'La section a un h2 « Actualités »'],
                        ['t' => 'el', 'sel' => 'section article', 'min' => 2, 'msg' => 'Deux articles dans la section'],
                        ['t' => 'el', 'sel' => 'article h3', 'min' => 2, 'msg' => 'Chaque article a un h3'],
                        ['t' => 'el', 'sel' => 'aside p', 'msg' => 'Un aside avec un paragraphe'],
                    ],
                    'hint' => 'section > h2 + article + article, puis aside.',
                    'explanation' => 'La section thématique regroupe des articles autonomes ; l’aside apporte un complément.',
                ],
                [
                    'title' => 'Article ou section ?',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Quel élément pour un commentaire laissé par un lecteur sous un article ?',
                    'answers' => ['`<section>`', '`<article>`', '`<aside>`', '`<footer>`'],
                    'correct' => 1,
                    'explanation' => 'Un commentaire est un contenu autonome : `<article>`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Un `<article>` est un contenu…', 'a' => ['décoratif', 'autonome', 'de navigation', 'invisible'], 'c' => 1, 'e' => 'Il a du sens tout seul.'],
                ['q' => 'Que doit généralement contenir une `<section>` ?', 'a' => ['Une image', 'Un titre', 'Un formulaire', 'Un lien'], 'c' => 1, 'e' => 'Une section thématique a un titre.'],
                ['q' => 'Une biographie d’auteur en marge d’un article peut être un `<aside>`.', 'tf' => true, 'c' => true, 'e' => 'Vrai : complémentaire au contenu principal.'],
            ],
        ],
    ],
];
