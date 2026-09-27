<?php
return [
    'slug' => 'css-flexbox',
    'title' => 'Flexbox',
    'description' => 'Le modèle de mise en page flexible : conteneur, axes, alignements, espacements, retour à la ligne et éléments flexibles.',
    'lessons' => [
        [
            'slug' => 'flexbox-le-conteneur',
            'title' => 'Flexbox : le conteneur et les axes',
            'duration' => 16,
            'intro' => <<<'MD'
Aligner des éléments côte à côte, les espacer régulièrement, centrer verticalement : pendant des années, ces tâches demandaient des astuces compliquées. **Flexbox** les rend simples. C’est l’outil de mise en page que vous utiliserez le plus souvent, pour les menus, les barres d’outils, les cartes, les formulaires…
MD,
            'objectives' => ['Créer un conteneur flex', 'Comprendre l’axe principal et l’axe secondaire', 'Changer la direction avec `flex-direction`', 'Espacer les éléments avec `gap`'],
            'prerequisites' => ['La propriété display', 'Le modèle de boîte'],
            'theory' => <<<'MD'
## Le principe

Flexbox agit sur **deux niveaux** :

- le **conteneur** (le parent), auquel on applique `display: flex` ;
- les **éléments flexibles** (ses enfants directs), qui s’organisent automatiquement.

```css
.menu { display: flex; }
```

Instantanément, les enfants de `.menu` se placent **côte à côte**, sur une ligne.

## Les deux axes

- l’**axe principal** (*main axis*) : la direction dans laquelle les éléments s’enchaînent. Par défaut, horizontal (de gauche à droite) ;
- l’**axe secondaire** (*cross axis*) : perpendiculaire au premier.

Toutes les propriétés d’alignement de Flexbox font référence à ces deux axes, **pas** à « horizontal » et « vertical ».

## `flex-direction`

Change l’axe principal :

| Valeur | Axe principal |
|---|---|
| `row` (défaut) | Horizontal, de gauche à droite |
| `row-reverse` | Horizontal, de droite à gauche |
| `column` | Vertical, de haut en bas |
| `column-reverse` | Vertical, de bas en haut |

Avec `column`, l’axe principal devient **vertical** : les propriétés d’alignement « tournent » avec lui.

## `gap` : l’espacement

```css
.menu { display: flex; gap: 16px; }
```

`gap` crée un espace **entre** les éléments (pas avant le premier ni après le dernier). Fini les marges à retirer sur le dernier élément !

> [!INFO] Seuls les **enfants directs** du conteneur deviennent des éléments flexibles. Les petits-enfants suivent le flux normal, sauf si leur propre parent est aussi en `display: flex`.
MD,
            'syntax' => '.conteneur {
  display: flex;
  flex-direction: row;
  gap: 16px;
}',
            'example_html' => <<<'HTML'
<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#">Cours</a>
  <a href="#">Projets</a>
  <a href="#">Contact</a>
</nav>
<div class="pile">
  <div class="bloc">1</div>
  <div class="bloc">2</div>
  <div class="bloc">3</div>
</div>
HTML,
            'example_css' => <<<'CSS'
.menu {
  display: flex;
  gap: 20px;
  padding: 12px 16px;
  background: #111827;
  font-family: system-ui, sans-serif;
}

.menu a {
  color: white;
  text-decoration: none;
}

.pile {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-top: 16px;
  width: 120px;
}

.bloc {
  padding: 12px;
  background: #a5b4fc;
  text-align: center;
}
CSS,
            'lines' => [
                ['  display: flex;', 'Le nav devient un conteneur flex : ses liens s’alignent en ligne.'],
                ['  gap: 20px;', 'Espace régulier entre les liens.'],
                ['  flex-direction: column;', 'Axe principal vertical : les blocs s’empilent.'],
                ['  gap: 8px;', 'L’espacement suit l’axe principal (vertical ici).'],
            ],
            'reference' => [
                ['display: flex', 'Crée un conteneur flex.'],
                ['flex-direction', '`row`, `row-reverse`, `column`, `column-reverse`.'],
                ['gap', 'Espacement entre les éléments (aussi `row-gap`, `column-gap`).'],
                ['display: inline-flex', 'Conteneur flex qui se comporte comme un élément en ligne.'],
            ],
            'mistakes' => [
                'Appliquer `display: flex` sur les enfants au lieu du parent.',
                'Penser « horizontal/vertical » au lieu d’« axe principal/secondaire ».',
                'Utiliser des marges sur chaque élément au lieu de `gap`.',
            ],
            'practices' => [
                'Flexbox pour les alignements sur une dimension (une ligne OU une colonne).',
                '`gap` pour les espacements entre éléments.',
                'Garder le HTML dans l’ordre logique de lecture.',
            ],
            'practical' => 'L’en-tête de cette plateforme est un conteneur flex : le logo, le menu et les boutons de compte sont alignés sur une ligne, avec des espaces gérés par `gap`.',
            'summary' => ['`display: flex` sur le parent.', 'Axe principal (défini par `flex-direction`) et axe secondaire.', '`gap` espace les éléments.'],
            'challenge' => 'Créez une barre d’outils avec 5 boutons alignés en ligne, puis passez-la en colonne en changeant une seule propriété.',
            'exercises' => [
                [
                    'title' => 'Un menu horizontal',
                    'difficulty' => 1,
                    'instructions' => 'Transformez `.menu` en conteneur flex (`display: flex`) avec un espacement `gap` de `24px`.',
                    'starter_html' => '<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#">Services</a>
  <a href="#">Contact</a>
</nav>',
                    'starter_css' => '.menu a {
  display: block;
  padding: 8px;
  background: #e0e7ff;
}',
                    'solution_css' => '.menu {
  display: flex;
  gap: 24px;
}

.menu a {
  display: block;
  padding: 8px;
  background: #e0e7ff;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.menu|nav.menu|nav', 'prop' => 'display', 'value' => 'flex', 'msg' => '.menu est en display: flex'],
                        ['t' => 'css', 'sel' => '.menu|nav.menu|nav', 'prop' => 'gap', 'value' => '24px', 'msg' => 'gap: 24px'],
                    ],
                    'hint' => 'Les propriétés s’appliquent au parent `.menu`, pas aux liens.',
                    'explanation' => '`display: flex` place les enfants côte à côte ; `gap` les espace régulièrement.',
                ],
                [
                    'title' => 'Changer de direction',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Quelle déclaration empile les éléments flexibles verticalement ?',
                    'answers' => ['`flex-direction: row;`', '`flex-direction: column;`', '`flex-wrap: wrap;`', '`display: block;`'],
                    'correct' => 1,
                    'explanation' => '`column` rend l’axe principal vertical.',
                ],
            ],
            'quiz' => [
                ['q' => 'Sur quel élément applique-t-on `display: flex` ?', 'a' => ['Sur chaque enfant', 'Sur le conteneur parent', 'Sur le body uniquement', 'Sur les petits-enfants'], 'c' => 1, 'e' => 'Sur le parent, qui devient conteneur flex.'],
                ['q' => 'Quel est l’axe principal par défaut ?', 'a' => ['Vertical', 'Horizontal', 'Diagonal', 'Aucun'], 'c' => 1, 'e' => '`flex-direction: row` par défaut.'],
                ['q' => '`gap` ajoute aussi un espace avant le premier élément.', 'tf' => true, 'c' => false, 'e' => 'Faux : seulement entre les éléments.'],
            ],
        ],
        [
            'slug' => 'flexbox-alignements',
            'title' => 'Flexbox : aligner et centrer',
            'duration' => 16,
            'intro' => <<<'MD'
« Comment centrer une div ? » a longtemps été la question la plus posée par les développeurs web. Avec Flexbox, la réponse tient en trois lignes. Cette leçon vous apprend à placer les éléments exactement où vous le souhaitez, sur les deux axes.
MD,
            'objectives' => ['Aligner sur l’axe principal avec `justify-content`', 'Aligner sur l’axe secondaire avec `align-items`', 'Centrer parfaitement un élément', 'Aligner un élément isolé avec `align-self` et `margin-left: auto`'],
            'prerequisites' => ['Flexbox : le conteneur et les axes'],
            'theory' => <<<'MD'
## `justify-content` : l’axe principal

| Valeur | Effet |
|---|---|
| `flex-start` | Au début (défaut) |
| `flex-end` | À la fin |
| `center` | Au centre |
| `space-between` | Premier et dernier aux extrémités, espace réparti entre |
| `space-around` | Espace autour de chaque élément |
| `space-evenly` | Espaces strictement égaux |

`space-between` est parfait pour un en-tête : logo à gauche, menu à droite.

## `align-items` : l’axe secondaire

| Valeur | Effet |
|---|---|
| `stretch` | Étire les éléments sur toute la hauteur (défaut) |
| `flex-start` | En haut |
| `flex-end` | En bas |
| `center` | Centrés |
| `baseline` | Alignés sur la ligne de base du texte |

## Centrer parfaitement

```css
.parent {
  display: flex;
  justify-content: center; /* axe principal */
  align-items: center;     /* axe secondaire */
  min-height: 300px;
}
```

Pour voir le centrage vertical, le conteneur doit être **plus haut** que son contenu.

## Aligner un seul élément

- `align-self` sur un enfant remplace `align-items` pour lui seul ;
- `margin-left: auto` sur un enfant **pousse** cet élément (et les suivants) vers la droite : très pratique pour un bouton « Connexion » à droite d’un menu.

> [!TIP] Si `flex-direction: column`, les rôles tournent : `justify-content` agit verticalement et `align-items` horizontalement.
MD,
            'syntax' => 'justify-content: space-between;
align-items: center;',
            'example_html' => <<<'HTML'
<header class="entete">
  <strong class="logo">Studio</strong>
  <nav class="liens">
    <a href="#">Projets</a>
    <a href="#">Équipe</a>
  </nav>
  <a class="connexion" href="#">Connexion</a>
</header>
<section class="hero">
  <p class="centre">Je suis parfaitement centré</p>
</section>
HTML,
            'example_css' => <<<'CSS'
.entete {
  display: flex;
  align-items: center;
  gap: 24px;
  padding: 12px 20px;
  background: #0f172a;
  font-family: system-ui, sans-serif;
}

.entete a, .logo { color: white; text-decoration: none; }
.liens { display: flex; gap: 16px; }

.connexion {
  margin-left: auto;
  padding: 6px 14px;
  border: 1px solid white;
  border-radius: 6px;
}

.hero {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 220px;
  background: #ecfeff;
}

.centre {
  padding: 16px 24px;
  background: white;
  border-radius: 8px;
}
CSS,
            'lines' => [
                ['  align-items: center;', 'Logo, menu et bouton centrés verticalement dans la barre.'],
                ['.liens { display: flex; gap: 16px; }', 'Un conteneur flex peut en contenir un autre.'],
                ['  margin-left: auto;', 'Pousse le bouton de connexion tout à droite.'],
                ['  justify-content: center;', 'Centrage sur l’axe principal (horizontal)…'],
                ['  align-items: center;', '…et sur l’axe secondaire (vertical).'],
                ['  min-height: 220px;', 'Hauteur suffisante pour voir le centrage vertical.'],
            ],
            'reference' => [
                ['justify-content', 'Alignement sur l’axe principal.'],
                ['align-items', 'Alignement sur l’axe secondaire.'],
                ['align-self', 'Alignement d’un seul élément.'],
                ['margin-left: auto', 'Pousse un élément à l’extrémité.'],
            ],
            'mistakes' => [
                'Confondre `justify-content` et `align-items`.',
                'Vouloir centrer verticalement dans un conteneur sans hauteur.',
                'Oublier que les axes s’inversent en `column`.',
            ],
            'practices' => [
                '`space-between` pour logo + navigation.',
                '`align-items: center` pour aligner icônes et textes.',
                '`margin-left: auto` pour isoler un élément à droite.',
            ],
            'practical' => 'La combinaison `display: flex; align-items: center; gap: …` est probablement la ligne de CSS la plus écrite au monde : bouton avec icône, avatar + nom, logo + titre…',
            'summary' => ['`justify-content` = axe principal.', '`align-items` = axe secondaire.', 'Centrer : `justify-content: center` + `align-items: center`.', '`margin-left: auto` pousse un élément.'],
            'challenge' => 'Créez une carte de profil : avatar à gauche, nom et métier à côté (centrés verticalement), bouton « Suivre » poussé à droite.',
            'exercises' => [
                [
                    'title' => 'Centrer une boîte',
                    'difficulty' => 2,
                    'instructions' => 'Centrez `.message` horizontalement ET verticalement dans `.ecran` avec Flexbox (`display: flex`, `justify-content` et `align-items`).',
                    'starter_html' => '<div class="ecran">
  <p class="message">Au centre !</p>
</div>',
                    'starter_css' => '.ecran {
  min-height: 250px;
  background: #fef3c7;
}

.message {
  padding: 12px 20px;
  background: white;
}',
                    'solution_css' => '.ecran {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 250px;
  background: #fef3c7;
}

.message {
  padding: 12px 20px;
  background: white;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.ecran|div.ecran', 'prop' => 'display', 'value' => 'flex', 'msg' => '.ecran est un conteneur flex'],
                        ['t' => 'css', 'sel' => '.ecran|div.ecran', 'prop' => 'justify-content', 'value' => 'center', 'msg' => 'justify-content: center'],
                        ['t' => 'css', 'sel' => '.ecran|div.ecran', 'prop' => 'align-items', 'value' => 'center', 'msg' => 'align-items: center'],
                    ],
                    'hint' => 'Tout se passe sur le parent `.ecran`.',
                    'explanation' => '`justify-content` centre sur l’axe principal, `align-items` sur l’axe secondaire.',
                ],
                [
                    'title' => 'Logo à gauche, menu à droite',
                    'type' => 'fill',
                    'difficulty' => 1,
                    'instructions' => 'Remplacez `______` par la valeur de `justify-content` qui place le logo tout à gauche et le menu tout à droite.',
                    'starter_html' => '<header class="barre"><strong>Logo</strong><nav>Menu</nav></header>',
                    'starter_css' => '.barre {
  display: flex;
  justify-content: ______;
  padding: 12px;
  background: #e2e8f0;
}',
                    'solution_css' => '.barre {
  display: flex;
  justify-content: space-between;
  padding: 12px;
  background: #e2e8f0;
}',
                    'rules' => [
                        ['t' => 'absent', 's' => '______', 'in' => 'css', 'msg' => 'Le « ______ » est remplacé'],
                        ['t' => 'css', 'sel' => '.barre|header.barre', 'prop' => 'justify-content', 'value' => 'space-between', 'msg' => 'justify-content: space-between'],
                    ],
                    'hint' => 'L’espace est réparti « entre » les éléments.',
                    'explanation' => '`space-between` colle le premier et le dernier élément aux extrémités.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle propriété aligne les éléments sur l’axe secondaire ?', 'a' => ['`justify-content`', '`align-items`', '`flex-direction`', '`gap`'], 'c' => 1, 'e' => '`align-items`.'],
                ['q' => 'Quelle valeur met les éléments aux extrémités avec l’espace réparti entre eux ?', 'a' => ['`center`', '`space-around`', '`space-between`', '`stretch`'], 'c' => 2, 'e' => '`space-between`.'],
                ['q' => 'En `flex-direction: column`, `justify-content` agit verticalement.', 'tf' => true, 'c' => true, 'e' => 'Vrai : l’axe principal est devenu vertical.'],
            ],
        ],
        [
            'slug' => 'flexbox-elements-flexibles',
            'title' => 'Flexbox : wrap, flex-grow, flex-shrink et flex-basis',
            'duration' => 17,
            'intro' => <<<'MD'
Jusqu’ici, les éléments gardaient leur taille. Mais Flexbox porte bien son nom : les éléments peuvent **grandir**, **rétrécir** et **passer à la ligne** pour occuper l’espace intelligemment. C’est ce qui permet de créer des grilles de cartes qui s’adaptent à la largeur de l’écran.
MD,
            'objectives' => ['Autoriser le retour à la ligne avec `flex-wrap`', 'Comprendre `flex-grow`, `flex-shrink`, `flex-basis`', 'Utiliser le raccourci `flex`', 'Réordonner avec `order`'],
            'prerequisites' => ['Flexbox : aligner et centrer'],
            'theory' => <<<'MD'
## `flex-wrap`

Par défaut (`nowrap`), tous les éléments restent sur **une seule ligne**, quitte à rétrécir ou déborder. Avec `flex-wrap: wrap`, ils passent à la ligne quand la place manque.

## Les trois propriétés des éléments

- `flex-basis` : la **taille de départ** de l’élément sur l’axe principal (`200px`, `30%`, `auto`) ;
- `flex-grow` : la part de l’**espace restant** que l’élément peut prendre (`0` = ne grandit pas, `1` = grandit) ;
- `flex-shrink` : la capacité à **rétrécir** quand la place manque (`1` = oui par défaut, `0` = jamais).

Exemple : trois éléments avec `flex-grow: 1` se partagent l’espace libre à parts égales. Si l’un a `flex-grow: 2`, il reçoit deux parts.

## Le raccourci `flex`

```css
.item { flex: 1; }          /* flex: 1 1 0 : grandit, rétrécit, base 0 → parts égales */
.item { flex: 1 1 250px; }  /* base 250px, puis grandit/rétrécit */
.item { flex: none; }       /* taille fixe */
```

## La grille de cartes responsive

```css
.cartes { display: flex; flex-wrap: wrap; gap: 16px; }
.carte  { flex: 1 1 250px; }
```

Chaque carte vise 250px ; il y en a autant que possible par ligne, et elles s’étirent pour remplir la ligne. **Sans aucune media query !**

## `order`

Change l’ordre d’**affichage** d’un élément (défaut `0`). À utiliser avec prudence : l’ordre de lecture au clavier et par les lecteurs d’écran reste celui du HTML.

> [!TIP] Pour une grille à deux dimensions stricte (lignes ET colonnes alignées), CSS Grid est souvent plus adapté. Flexbox excelle pour les alignements sur une dimension.
MD,
            'syntax' => '.conteneur { display: flex; flex-wrap: wrap; }
.element { flex: 1 1 250px; }',
            'example_html' => <<<'HTML'
<div class="barre">
  <input class="recherche" type="search" placeholder="Rechercher…" aria-label="Rechercher">
  <button type="button">OK</button>
</div>
<div class="cartes">
  <article class="carte">Carte 1</article>
  <article class="carte">Carte 2</article>
  <article class="carte">Carte 3</article>
  <article class="carte">Carte 4</article>
  <article class="carte">Carte 5</article>
</div>
HTML,
            'example_css' => <<<'CSS'
.barre {
  display: flex;
  gap: 8px;
  margin-bottom: 16px;
}

.recherche {
  flex: 1;        /* prend toute la place disponible */
  padding: 8px;
}

.cartes {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.carte {
  flex: 1 1 180px;
  padding: 24px;
  border-radius: 12px;
  background: #ddd6fe;
  font-family: system-ui, sans-serif;
  text-align: center;
}
CSS,
            'lines' => [
                ['  flex: 1;        /* prend toute la place */', 'Le champ grandit ; le bouton garde sa taille naturelle.'],
                ['  flex-wrap: wrap;', 'Les cartes passent à la ligne quand la place manque.'],
                ['  flex: 1 1 180px;', 'Base 180px, puis chaque carte grandit pour remplir la ligne.'],
            ],
            'reference' => [
                ['flex-wrap', '`nowrap` (défaut), `wrap`.'],
                ['flex-grow', 'Capacité à grandir (proportion de l’espace libre).'],
                ['flex-shrink', 'Capacité à rétrécir.'],
                ['flex-basis', 'Taille de départ.'],
                ['flex', 'Raccourci grow shrink basis.'],
                ['order', 'Ordre d’affichage.'],
            ],
            'mistakes' => [
                'Oublier `flex-wrap: wrap` et voir les éléments s’écraser.',
                'Utiliser `order` pour réorganiser tout le contenu (l’ordre de tabulation devient incohérent).',
                'Confondre `flex-basis` et `width` quand les deux sont définis.',
            ],
            'practices' => [
                '`flex: 1` pour l’élément qui doit occuper l’espace restant (champ de recherche).',
                '`flex-wrap` + `flex: 1 1 <base>` pour des grilles souples.',
                'Garder l’ordre HTML logique.',
            ],
            'practical' => 'Les barres de recherche (champ extensible + bouton), les pieds de page multi-colonnes et les listes de fonctionnalités qui passent de 3 à 1 colonne sur mobile utilisent exactement ces propriétés.',
            'summary' => ['`flex-wrap: wrap` autorise le retour à la ligne.', '`flex: grow shrink basis`.', '`flex: 1` = occupe l’espace disponible.', '`flex: 1 1 250px` + wrap = grille responsive sans media query.'],
            'challenge' => 'Créez un pied de page avec 4 colonnes (`flex: 1 1 200px`) qui passent sur 2 puis 1 colonne quand l’aperçu rétrécit.',
            'exercises' => [
                [
                    'title' => 'Une grille de cartes souple',
                    'difficulty' => 2,
                    'instructions' => 'Faites passer les cartes à la ligne (`flex-wrap: wrap` sur `.grille`) et donnez à `.carte` la propriété `flex: 1 1 200px`.',
                    'starter_html' => '<div class="grille">
  <div class="carte">A</div>
  <div class="carte">B</div>
  <div class="carte">C</div>
  <div class="carte">D</div>
</div>',
                    'starter_css' => '.grille {
  display: flex;
  gap: 12px;
}

.carte {
  padding: 30px;
  background: #bbf7d0;
}',
                    'solution_css' => '.grille {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}

.carte {
  flex: 1 1 200px;
  padding: 30px;
  background: #bbf7d0;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.grille|div.grille', 'prop' => 'flex-wrap', 'value' => 'wrap', 'msg' => 'flex-wrap: wrap sur .grille'],
                        ['t' => 'css', 'sel' => '.carte|div.carte|.grille .carte', 'prop' => 'flex', 'value' => '1 1 200px', 'msg' => 'flex: 1 1 200px sur .carte'],
                    ],
                    'hint' => 'Une propriété sur le parent, une sur les enfants.',
                    'explanation' => 'Le retour à la ligne est autorisé par le conteneur ; chaque carte part de 200px puis s’étire.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que signifie `flex: 1` ?', 'a' => ['Largeur de 1px', 'L’élément grandit pour occuper l’espace disponible', 'L’élément ne grandit jamais', 'Il passe en premier'], 'c' => 1, 'e' => '`flex: 1` = `1 1 0` : il partage l’espace libre.'],
                ['q' => 'Quelle propriété autorise le retour à la ligne ?', 'a' => ['`flex-direction`', '`flex-wrap`', '`flex-flow-line`', '`wrap-items`'], 'c' => 1, 'e' => '`flex-wrap: wrap`.'],
                ['q' => '`order` modifie aussi l’ordre de lecture par les lecteurs d’écran.', 'tf' => true, 'c' => false, 'e' => 'Faux : seul l’affichage change, d’où le risque d’incohérence.'],
            ],
        ],
    ],
];
