<?php
return [
    'slug' => 'css-grid',
    'title' => 'CSS Grid',
    'description' => 'La mise en page en deux dimensions : colonnes, lignes, unité fr, placement, zones nommées et grilles adaptatives.',
    'lessons' => [
        [
            'slug' => 'grid-les-bases',
            'title' => 'Grid : colonnes, lignes et unité fr',
            'duration' => 16,
            'intro' => <<<'MD'
Flexbox aligne sur **une** dimension. **CSS Grid** travaille sur **deux** : lignes ET colonnes à la fois. C’est l’outil idéal pour les galeries, les tableaux de bord et la structure générale d’une page.
MD,
            'objectives' => ['Créer une grille avec `display: grid`', 'Définir des colonnes avec `grid-template-columns`', 'Utiliser l’unité `fr` et `repeat()`', 'Espacer avec `gap`'],
            'prerequisites' => ['Flexbox'],
            'theory' => <<<'MD'
## Créer une grille

```css
.galerie {
  display: grid;
  grid-template-columns: 200px 200px 200px;
  gap: 16px;
}
```

Les enfants directs se placent automatiquement dans les cases, de gauche à droite, puis ligne suivante.

## L’unité `fr`

`fr` (*fraction*) partage l’**espace disponible** :

```css
grid-template-columns: 1fr 1fr 1fr;  /* 3 colonnes égales */
grid-template-columns: 2fr 1fr;      /* la 1re colonne est deux fois plus large */
grid-template-columns: 250px 1fr;    /* barre latérale fixe + contenu flexible */
```

## `repeat()`

```css
grid-template-columns: repeat(4, 1fr); /* = 1fr 1fr 1fr 1fr */
```

## Les lignes

- `grid-template-rows` définit la hauteur des lignes : `grid-template-rows: auto 1fr auto;` ;
- les lignes supplémentaires créées automatiquement suivent `grid-auto-rows`.

## `gap`

Comme en Flexbox : `gap: 16px;` ou `row-gap` / `column-gap`.

## Aligner le contenu des cases

- `justify-items` / `align-items` : alignement du contenu dans chaque case ;
- `place-items: center;` : raccourci pour centrer sur les deux axes.

> [!INFO] Flexbox ou Grid ? Flexbox : le **contenu** dicte la taille (une ligne d’éléments de tailles variables). Grid : la **structure** dicte la place (des colonnes alignées). On les combine souvent : Grid pour la page, Flexbox dans les composants.
MD,
            'syntax' => '.grille {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}',
            'example_html' => <<<'HTML'
<div class="tableau">
  <div class="tuile">Visiteurs<br><strong>12 480</strong></div>
  <div class="tuile">Inscriptions<br><strong>342</strong></div>
  <div class="tuile">Ventes<br><strong>58</strong></div>
  <div class="tuile large">Graphique d’activité</div>
  <div class="tuile">Tâches</div>
</div>
HTML,
            'example_css' => <<<'CSS'
.tableau {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-auto-rows: minmax(90px, auto);
  gap: 12px;
  font-family: system-ui, sans-serif;
}

.tuile {
  padding: 16px;
  border-radius: 12px;
  background: #e0e7ff;
}

.large {
  grid-column: span 2;
  background: #c7d2fe;
}
CSS,
            'lines' => [
                ['  display: grid;', 'Le conteneur devient une grille.'],
                ['  grid-template-columns: repeat(3, 1fr);', 'Trois colonnes de largeur égale.'],
                ['  grid-auto-rows: minmax(90px, auto);', 'Chaque ligne mesure au moins 90px et grandit si nécessaire.'],
                ['  gap: 12px;', 'Espace entre lignes et colonnes.'],
                ['  grid-column: span 2;', 'Cette tuile occupe deux colonnes (détaillé à la leçon suivante).'],
            ],
            'reference' => [
                ['display: grid', 'Crée une grille.'],
                ['grid-template-columns', 'Définit les colonnes.'],
                ['grid-template-rows / grid-auto-rows', 'Définit les lignes.'],
                ['fr', 'Fraction de l’espace disponible.'],
                ['repeat(n, taille)', 'Répète une définition de piste.'],
                ['gap', 'Espacement entre les cases.'],
            ],
            'mistakes' => [
                'Écrire `grid-template-columns: 3;` (il faut définir chaque colonne ou utiliser `repeat`).',
                'Utiliser des `%` et `gap` ensemble et déborder (préférez `fr`).',
                'Appliquer `display: grid` aux enfants au lieu du parent.',
            ],
            'practices' => [
                '`fr` plutôt que `%` pour partager l’espace.',
                '`repeat()` pour les colonnes identiques.',
                'Grid pour la structure, Flexbox pour les alignements internes.',
            ],
            'practical' => 'Les tableaux de bord (comme l’espace administrateur de cette plateforme) sont construits avec Grid : une grille de 12 colonnes dans laquelle chaque carte occupe 4, 6 ou 12 colonnes.',
            'summary' => ['`display: grid` + `grid-template-columns`.', '`fr` partage l’espace disponible.', '`repeat(3, 1fr)` = 3 colonnes égales.', '`gap` espace les cases.'],
            'challenge' => 'Créez une mise en page « barre latérale de 240px + contenu flexible » avec Grid.',
            'exercises' => [
                [
                    'title' => 'Une galerie en 3 colonnes',
                    'difficulty' => 1,
                    'instructions' => 'Transformez `.galerie` en grille de **3 colonnes égales** (`repeat(3, 1fr)`) avec un `gap` de `10px`.',
                    'starter_html' => '<div class="galerie">
  <div class="photo">1</div><div class="photo">2</div><div class="photo">3</div>
  <div class="photo">4</div><div class="photo">5</div><div class="photo">6</div>
</div>',
                    'starter_css' => '.photo {
  padding: 40px 0;
  text-align: center;
  background: #fecdd3;
}',
                    'solution_css' => '.galerie {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.photo {
  padding: 40px 0;
  text-align: center;
  background: #fecdd3;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.galerie|div.galerie', 'prop' => 'display', 'value' => 'grid', 'msg' => 'display: grid'],
                        ['t' => 'css', 'sel' => '.galerie|div.galerie', 'prop' => 'grid-template-columns', 'in' => ['repeat(3, 1fr)', '1fr 1fr 1fr'], 'msg' => 'Trois colonnes égales'],
                        ['t' => 'css', 'sel' => '.galerie|div.galerie', 'prop' => 'gap', 'value' => '10px', 'msg' => 'gap: 10px'],
                    ],
                    'hint' => '`grid-template-columns: repeat(3, 1fr);`',
                    'explanation' => 'Trois fractions égales de l’espace disponible forment trois colonnes identiques.',
                ],
                [
                    'title' => 'L’unité fr',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Avec `grid-template-columns: 1fr 3fr;` dans un conteneur de 800px (sans gap), quelle est la largeur de la 2e colonne ?',
                    'answers' => ['200px', '400px', '600px', '800px'],
                    'correct' => 2,
                    'explanation' => '4 parts au total : 800 ÷ 4 = 200px par part, donc 3 × 200 = 600px.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que signifie l’unité `fr` ?', 'a' => ['Frame', 'Fraction de l’espace disponible', 'Fixed row', 'Font ratio'], 'c' => 1, 'e' => '`fr` = fraction.'],
                ['q' => 'Quelle écriture équivaut à `1fr 1fr 1fr 1fr` ?', 'a' => ['`repeat(1fr, 4)`', '`repeat(4, 1fr)`', '`4fr`', '`grid(4)`'], 'c' => 1, 'e' => '`repeat(nombre, taille)`.'],
                ['q' => 'Grid permet de contrôler lignes et colonnes en même temps.', 'tf' => true, 'c' => true, 'e' => 'Vrai : c’est un système à deux dimensions.'],
            ],
        ],
        [
            'slug' => 'grid-placement-et-zones',
            'title' => 'Grid : placement et zones nommées',
            'duration' => 16,
            'intro' => <<<'MD'
Un en-tête sur toute la largeur, une barre latérale à gauche, le contenu au centre, un pied de page en bas : avec `grid-template-areas`, vous **dessinez** cette structure directement dans le CSS, avec des mots.
MD,
            'objectives' => ['Placer un élément avec `grid-column` et `grid-row`', 'Faire couvrir plusieurs cases avec `span`', 'Nommer des zones avec `grid-template-areas`'],
            'prerequisites' => ['Grid : colonnes, lignes et unité fr'],
            'theory' => <<<'MD'
## Les lignes de grille

Une grille de 3 colonnes possède **4 lignes verticales**, numérotées de 1 à 4. On place un élément en indiquant ses lignes de début et de fin :

```css
.titre { grid-column: 1 / 4; }  /* de la ligne 1 à la ligne 4 : toute la largeur */
.titre { grid-column: 1 / -1; } /* -1 = dernière ligne, quelle que soit la grille */
```

## `span`

```css
.grande { grid-column: span 2; } /* couvre 2 colonnes */
.haute  { grid-row: span 2; }    /* couvre 2 lignes */
```

## Les zones nommées

On dessine la mise en page dans le conteneur :

```css
.page {
  display: grid;
  grid-template-columns: 220px 1fr;
  grid-template-areas:
    "entete entete"
    "menu   contenu"
    "pied   pied";
}
```

Puis on affecte chaque enfant à sa zone :

```css
.entete  { grid-area: entete; }
.menu    { grid-area: menu; }
.contenu { grid-area: contenu; }
.pied    { grid-area: pied; }
```

Chaque chaîne de caractères représente une **ligne** ; chaque mot, une **colonne**. Un point `.` représente une case vide. Les zones doivent être **rectangulaires**.

> [!TIP] Pour une version mobile, il suffit de redéfinir `grid-template-areas` dans une media query (une seule colonne) : le HTML ne change pas.
MD,
            'syntax' => 'grid-template-areas:
  "entete entete"
  "menu contenu";
.entete { grid-area: entete; }',
            'example_html' => <<<'HTML'
<div class="page">
  <header class="entete">En-tête</header>
  <nav class="menu">Menu</nav>
  <main class="contenu">Contenu principal</main>
  <aside class="pub">Encart</aside>
  <footer class="pied">Pied de page</footer>
</div>
HTML,
            'example_css' => <<<'CSS'
.page {
  display: grid;
  grid-template-columns: 140px 1fr 140px;
  grid-template-rows: auto 1fr auto;
  grid-template-areas:
    "entete  entete  entete"
    "menu    contenu pub"
    "pied    pied    pied";
  gap: 8px;
  min-height: 320px;
  font-family: system-ui, sans-serif;
}

.page > * { padding: 12px; border-radius: 8px; }
.entete  { grid-area: entete;  background: #fde68a; }
.menu    { grid-area: menu;    background: #bfdbfe; }
.contenu { grid-area: contenu; background: #e2e8f0; }
.pub     { grid-area: pub;     background: #fbcfe8; }
.pied    { grid-area: pied;    background: #bbf7d0; }
CSS,
            'lines' => [
                ['  grid-template-columns: 140px 1fr 140px;', 'Deux colonnes latérales fixes, une centrale flexible.'],
                ['  grid-template-rows: auto 1fr auto;', 'L’en-tête et le pied s’adaptent au contenu, le milieu prend le reste.'],
                ['    "entete  entete  entete"', 'Première ligne : l’en-tête couvre les trois colonnes.'],
                ['    "menu    contenu pub"', 'Deuxième ligne : trois zones distinctes.'],
                ['.entete  { grid-area: entete; … }', 'L’élément est affecté à sa zone nommée.'],
            ],
            'reference' => [
                ['grid-column / grid-row', 'Lignes de début / fin : `1 / 3`, `span 2`.'],
                ['grid-template-areas', 'Dessin des zones de la grille.'],
                ['grid-area', 'Zone occupée par un élément.'],
                ['-1', 'Dernière ligne de grille.'],
            ],
            'mistakes' => [
                'Des zones non rectangulaires (en L) : la déclaration est ignorée.',
                'Un nombre de colonnes différent d’une chaîne à l’autre.',
                'Oublier les guillemets dans `grid-template-areas`.',
                'Des fautes de frappe entre le nom dans les zones et dans `grid-area`.',
            ],
            'practices' => [
                'Des noms de zones explicites.',
                'Aligner visuellement les chaînes dans le code.',
                'Redéfinir les zones dans les media queries pour le responsive.',
            ],
            'practical' => 'La structure « en-tête / menu latéral / contenu / pied » des applications web et des sites de documentation se code en quelques lignes avec `grid-template-areas`, et devient une colonne unique sur mobile en redéfinissant uniquement les zones.',
            'summary' => ['`grid-column: 1 / -1` : toute la largeur.', '`span n` : couvrir plusieurs cases.', '`grid-template-areas` dessine la page, `grid-area` place les éléments.'],
            'challenge' => 'Réalisez une page magazine : un grand article occupant 2 colonnes et 2 lignes, entouré de 4 petits articles.',
            'exercises' => [
                [
                    'title' => 'Une mise en page par zones',
                    'difficulty' => 3,
                    'instructions' => 'Complétez `.page` avec `grid-template-areas` : première ligne **"haut haut"**, seconde ligne **"cote principal"**. Affectez ensuite `.haut`, `.cote` et `.principal` à leurs zones avec `grid-area`.',
                    'starter_html' => '<div class="page">
  <header class="haut">Haut</header>
  <aside class="cote">Côté</aside>
  <main class="principal">Principal</main>
</div>',
                    'starter_css' => '.page {
  display: grid;
  grid-template-columns: 150px 1fr;
  gap: 8px;
}

.page > * {
  padding: 16px;
  background: #e0f2fe;
}',
                    'solution_css' => '.page {
  display: grid;
  grid-template-columns: 150px 1fr;
  grid-template-areas:
    "haut haut"
    "cote principal";
  gap: 8px;
}

.page > * {
  padding: 16px;
  background: #e0f2fe;
}

.haut { grid-area: haut; }
.cote { grid-area: cote; }
.principal { grid-area: principal; }',
                    'rules' => [
                        ['t' => 'match', 're' => 'grid-template-areas\s*:\s*"haut\s+haut"\s*"cote\s+principal"', 'in' => 'css', 'msg' => 'Les zones "haut haut" / "cote principal" sont définies'],
                        ['t' => 'css', 'sel' => '.haut|header.haut', 'prop' => 'grid-area', 'value' => 'haut', 'msg' => '.haut occupe la zone haut'],
                        ['t' => 'css', 'sel' => '.cote|aside.cote', 'prop' => 'grid-area', 'value' => 'cote', 'msg' => '.cote occupe la zone cote'],
                        ['t' => 'css', 'sel' => '.principal|main.principal', 'prop' => 'grid-area', 'value' => 'principal', 'msg' => '.principal occupe la zone principal'],
                    ],
                    'hint' => 'Chaque ligne de la grille est une chaîne entre guillemets.',
                    'explanation' => 'On dessine la grille avec des noms, puis chaque élément rejoint sa zone avec `grid-area`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que fait `grid-column: 1 / -1` ?', 'a' => ['Supprime la colonne', 'L’élément couvre toute la largeur de la grille', 'Place l’élément en dernier', 'Rien'], 'c' => 1, 'e' => 'De la première à la dernière ligne verticale.'],
                ['q' => 'Que représente un point `.` dans `grid-template-areas` ?', 'a' => ['Une erreur', 'Une case vide', 'Une zone nommée « point »', 'La fin de la ligne'], 'c' => 1, 'e' => 'Une case sans zone.'],
                ['q' => 'Une zone nommée peut avoir une forme en L.', 'tf' => true, 'c' => false, 'e' => 'Faux : les zones doivent être rectangulaires.'],
            ],
        ],
        [
            'slug' => 'grid-adaptative',
            'title' => 'Grilles adaptatives : auto-fit et minmax',
            'duration' => 14,
            'intro' => <<<'MD'
Voici l’une des lignes de CSS les plus puissantes jamais écrites : une grille qui passe toute seule de 4 colonnes sur grand écran à 1 colonne sur téléphone, **sans aucune media query**. Elle combine `repeat()`, `auto-fit` et `minmax()`.
MD,
            'objectives' => ['Comprendre `minmax()`', 'Utiliser `auto-fit` et `auto-fill`', 'Créer une grille responsive sans media query'],
            'prerequisites' => ['Grid : placement et zones nommées'],
            'theory' => <<<'MD'
## `minmax(min, max)`

Définit une taille **comprise entre** un minimum et un maximum :

```css
grid-template-columns: minmax(200px, 1fr) 2fr;
```

La première colonne ne descend jamais sous 200px, mais peut grandir jusqu’à 1fr.

## `auto-fit` : autant de colonnes que possible

```css
.cartes {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
}
```

Lecture : « crée **autant de colonnes que possible**, chacune d’au moins **220px**, puis étire-les pour **remplir** la ligne ».

- sur 1000px : 4 colonnes ;
- sur 600px : 2 colonnes ;
- sur 360px : 1 colonne.

## `auto-fit` ou `auto-fill` ?

Les deux créent le maximum de colonnes. La différence apparaît quand il y a **peu d’éléments** :

- `auto-fit` : les colonnes vides sont **supprimées**, les éléments s’étirent pour remplir la ligne ;
- `auto-fill` : les colonnes vides sont **conservées**, les éléments gardent leur largeur.

## Éviter le débordement sur très petit écran

Si l’écran est plus étroit que le minimum (220px), la grille déborde. Astuce robuste :

```css
grid-template-columns: repeat(auto-fit, minmax(min(100%, 220px), 1fr));
```

`min(100%, 220px)` prend la plus petite des deux valeurs. C’est la technique utilisée sur cette plateforme pour ses grilles de cartes.
MD,
            'syntax' => 'grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));',
            'example_html' => <<<'HTML'
<section class="cartes">
  <article class="carte"><h3>HTML</h3><p>Structure</p></article>
  <article class="carte"><h3>CSS</h3><p>Style</p></article>
  <article class="carte"><h3>Flexbox</h3><p>Alignement</p></article>
  <article class="carte"><h3>Grid</h3><p>Mise en page</p></article>
  <article class="carte"><h3>Responsive</h3><p>Adaptation</p></article>
</section>
HTML,
            'example_css' => <<<'CSS'
.cartes {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(100%, 160px), 1fr));
  gap: 12px;
  font-family: system-ui, sans-serif;
}

.carte {
  padding: 16px;
  border-radius: 12px;
  background: #0f172a;
  color: white;
}

.carte h3 { margin: 0 0 4px; }
.carte p { margin: 0; color: #94a3b8; }
CSS,
            'lines' => [
                ['  grid-template-columns: repeat(auto-fit, …);', 'Autant de colonnes que la largeur le permet.'],
                ['minmax(min(100%, 160px), 1fr)', 'Chaque colonne : au moins 160px (ou 100 % si l’écran est plus petit), au plus 1fr.'],
                ['  gap: 12px;', 'Espacement constant quel que soit le nombre de colonnes.'],
            ],
            'reference' => [
                ['minmax(min, max)', 'Taille bornée.'],
                ['auto-fit', 'Crée le maximum de colonnes, supprime les vides.'],
                ['auto-fill', 'Crée le maximum de colonnes, garde les vides.'],
                ['min() / max()', 'Plus petite / plus grande de plusieurs valeurs.'],
            ],
            'mistakes' => [
                'Écrire `repeat(auto-fit, 1fr)` sans taille minimale (une seule colonne).',
                'Un minimum trop grand qui provoque un débordement sur mobile.',
                'Confondre `auto-fit` et `auto-fill` quand il y a peu d’éléments.',
            ],
            'practices' => [
                'La formule `repeat(auto-fit, minmax(min(100%, X), 1fr))` pour les grilles de cartes.',
                'Choisir le minimum selon le contenu (lisibilité d’une carte).',
            ],
            'practical' => 'Les grilles de produits, d’articles de blog ou de membres d’équipe utilisent cette formule : le contenu s’adapte à tous les écrans sans écrire une seule media query.',
            'summary' => ['`minmax()` borne une taille.', '`repeat(auto-fit, minmax(220px, 1fr))` = grille responsive automatique.', '`min(100%, 220px)` évite le débordement.'],
            'challenge' => 'Créez une galerie de 12 images qui affiche 6 colonnes sur grand écran et 2 sur mobile, uniquement avec `auto-fit`.',
            'exercises' => [
                [
                    'title' => 'Une grille responsive automatique',
                    'difficulty' => 2,
                    'instructions' => 'Faites de `.produits` une grille avec `grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))` et un `gap` de `16px`.',
                    'starter_html' => '<div class="produits">
  <div class="produit">Produit 1</div>
  <div class="produit">Produit 2</div>
  <div class="produit">Produit 3</div>
  <div class="produit">Produit 4</div>
</div>',
                    'starter_css' => '.produit {
  padding: 24px;
  background: #fef9c3;
  text-align: center;
}',
                    'solution_css' => '.produits {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 16px;
}

.produit {
  padding: 24px;
  background: #fef9c3;
  text-align: center;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.produits|div.produits', 'prop' => 'display', 'value' => 'grid', 'msg' => 'display: grid'],
                        ['t' => 'css', 'sel' => '.produits|div.produits', 'prop' => 'grid-template-columns', 'in' => ['repeat(auto-fit, minmax(150px, 1fr))', 'repeat(auto-fill, minmax(150px, 1fr))'], 'msg' => 'repeat(auto-fit, minmax(150px, 1fr))'],
                        ['t' => 'css', 'sel' => '.produits|div.produits', 'prop' => 'gap', 'value' => '16px', 'msg' => 'gap: 16px'],
                    ],
                    'hint' => 'Recopiez exactement la formule : `repeat(auto-fit, minmax(150px, 1fr))`.',
                    'explanation' => 'La grille crée autant de colonnes de 150px minimum que possible, puis les étire.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que fait `minmax(200px, 1fr)` ?', 'a' => ['Une colonne de 200px exactement', 'Une colonne d’au moins 200px pouvant grandir jusqu’à 1fr', 'Une colonne de 1fr maximum 200px', 'Rien'], 'c' => 1, 'e' => 'Elle est bornée entre 200px et 1fr.'],
                ['q' => 'Quel mot-clé supprime les colonnes vides ?', 'a' => ['`auto-fill`', '`auto-fit`', '`fit-content`', '`auto`'], 'c' => 1, 'e' => '`auto-fit`.'],
                ['q' => 'Cette technique nécessite obligatoirement des media queries.', 'tf' => true, 'c' => false, 'e' => 'Faux : c’est justement son intérêt.'],
            ],
        ],
    ],
];
