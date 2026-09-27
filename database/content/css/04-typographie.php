<?php
return [
    'slug' => 'css-typographie',
    'title' => 'Typographie',
    'description' => 'Polices, tailles, graisses, hauteur de ligne, alignement, décoration du texte et unités de mesure.',
    'lessons' => [
        [
            'slug' => 'polices-et-tailles',
            'title' => 'Polices, tailles et hauteur de ligne',
            'duration' => 15,
            'intro' => <<<'MD'
Le Web, c’est à 90 % du texte. Une bonne typographie rend la lecture agréable sans que personne ne la remarque ; une mauvaise fait fuir les visiteurs sans qu’ils sachent pourquoi. Dans cette leçon, vous apprendrez les propriétés qui comptent vraiment : la police, sa taille, sa graisse et l’interligne.
MD,
            'objectives' => ['Choisir une pile de polices avec `font-family`', 'Régler `font-size`, `font-weight`, `font-style`', 'Régler une hauteur de ligne confortable', 'Charger une police web'],
            'prerequisites' => ['Cascade, spécificité et héritage'],
            'theory' => <<<'MD'
## `font-family` : la pile de polices

On indique une **liste** de polices, par ordre de préférence. Le navigateur utilise la première disponible sur l’appareil :

```css
body {
  font-family: "Helvetica Neue", Arial, sans-serif;
}
```

La liste se termine toujours par une **famille générique** :

| Famille | Aspect | Usage |
|---|---|---|
| `serif` | Empattements (petits pieds) | Presse, textes littéraires |
| `sans-serif` | Sans empattements | Interfaces, écrans |
| `monospace` | Chasse fixe | Code |
| `system-ui` | Police du système | Interfaces natives |

## Polices web

Pour utiliser une police qui n’est pas installée, on la charge (fichier `.woff2` ou service comme Google Fonts) avec `@font-face` ou un `<link>`. Limitez-vous à deux familles et quelques graisses : chaque fichier ralentit le chargement.

## `font-size`

```css
body { font-size: 18px; }
h1 { font-size: 2.5rem; }
```

Pour le texte courant, **16 à 18 px** est un bon minimum sur écran. (Les unités `rem` et `em` sont détaillées dans la leçon Unités.)

## `font-weight` et `font-style`

- `font-weight` : `normal` (400), `bold` (700), ou une valeur numérique de 100 à 900 si la police les propose ;
- `font-style` : `normal` ou `italic`.

## `line-height` : l’interligne

C’est la propriété la plus sous-estimée. Un texte trop serré fatigue la lecture. On utilise une valeur **sans unité**, multipliée par la taille de police :

```css
body { line-height: 1.6; }
h1 { line-height: 1.2; }
```

Pour les paragraphes : **1.5 à 1.7**. Pour les titres : **1.1 à 1.3**.

> [!TIP] Une ligne de texte agréable compte **50 à 75 caractères**. Au-delà, l’œil se perd en revenant à la ligne. Limitez la largeur des paragraphes (par exemple `max-width: 65ch`).
MD,
            'syntax' => 'font-family: Arial, sans-serif;
font-size: 18px;
font-weight: 700;
line-height: 1.6;',
            'example_html' => <<<'HTML'
<article class="article">
  <h1>L’art de la typographie</h1>
  <p class="chapeau">Une bonne typographie se remarque à peine : elle rend simplement la lecture facile.</p>
  <p>La taille, la graisse et l’interligne travaillent ensemble. Un paragraphe bien réglé se lit sans effort, même sur un petit écran.</p>
  <p class="code">font-family: monospace;</p>
</article>
HTML,
            'example_css' => <<<'CSS'
.article {
  font-family: Georgia, "Times New Roman", serif;
  font-size: 18px;
  line-height: 1.7;
  color: #1f2937;
  max-width: 65ch;
}

.article h1 {
  font-family: "Trebuchet MS", Arial, sans-serif;
  font-size: 40px;
  font-weight: 800;
  line-height: 1.15;
}

.chapeau {
  font-size: 22px;
  font-style: italic;
  color: #4b5563;
}

.code {
  font-family: "Courier New", monospace;
}
CSS,
            'lines' => [
                ['  font-family: Georgia, "Times New Roman", serif;', 'Pile de polices serif pour la lecture d’un article.'],
                ['  line-height: 1.7;', 'Interligne généreux (valeur sans unité).'],
                ['  max-width: 65ch;', 'Environ 65 caractères par ligne : largeur de lecture idéale.'],
                ['  font-weight: 800;', 'Graisse très forte pour le titre.'],
                ['  line-height: 1.15;', 'Les titres ont un interligne plus serré.'],
                ['  font-style: italic;', 'Italique pour le chapeau (introduction).'],
            ],
            'reference' => [
                ['font-family', 'Pile de polices, terminée par une famille générique.'],
                ['font-size', 'Taille du texte.'],
                ['font-weight', 'Graisse : 100 à 900, `normal`, `bold`.'],
                ['font-style', '`normal` ou `italic`.'],
                ['line-height', 'Hauteur de ligne (idéalement sans unité).'],
                ['font', 'Raccourci : `font: italic 700 18px/1.6 Georgia, serif;`.'],
            ],
            'mistakes' => [
                'Oublier la famille générique de secours.',
                'Oublier les guillemets pour les noms contenant des espaces.',
                'Un texte courant inférieur à 16 px.',
                'Un `line-height` en pixels fixes qui ne suit pas la taille du texte.',
                'Charger 6 polices différentes.',
            ],
            'practices' => [
                'Deux familles de polices maximum.',
                'Définir la typographie de base sur `body`, puis ajuster les titres.',
                '`line-height` sans unité : 1.5–1.7 pour le texte.',
                'Limiter la largeur des lignes.',
            ],
            'practical' => 'Les sites de presse en ligne soignent particulièrement leur typographie : police serif pour les articles, sans-serif pour l’interface, interligne généreux et colonnes étroites. C’est ce qui donne cette sensation de « confort de lecture ».',
            'summary' => ['`font-family` = pile de polices + famille générique.', 'Texte courant : 16–18 px, `line-height` 1.5–1.7.', '`font-weight` et `font-style` pour la graisse et l’italique.', '50 à 75 caractères par ligne.'],
            'challenge' => 'Créez deux versions d’un même article (serif et sans-serif) et comparez leur lisibilité en changeant uniquement le CSS.',
            'exercises' => [
                [
                    'title' => 'Une typographie lisible',
                    'difficulty' => 1,
                    'instructions' => 'Sur le sélecteur `body`, définissez : `font-family` avec `Arial` puis la famille générique `sans-serif`, une `font-size` de `18px` et un `line-height` de `1.6`.',
                    'starter_html' => '<h1>Mon blog</h1>
<p>Un paragraphe agréable à lire, avec une taille et un interligne confortables.</p>',
                    'solution_css' => 'body {
  font-family: Arial, sans-serif;
  font-size: 18px;
  line-height: 1.6;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => 'body', 'prop' => 'font-family', 'contains' => 'sans-serif', 'msg' => 'La pile se termine par sans-serif'],
                        ['t' => 'css', 'sel' => 'body', 'prop' => 'font-family', 'contains' => 'arial', 'msg' => 'Arial est dans la pile de polices'],
                        ['t' => 'css', 'sel' => 'body', 'prop' => 'font-size', 'value' => '18px', 'msg' => 'font-size vaut 18px'],
                        ['t' => 'css', 'sel' => 'body', 'prop' => 'line-height', 'value' => '1.6', 'msg' => 'line-height vaut 1.6'],
                    ],
                    'hint' => 'Trois déclarations dans `body { … }`.',
                    'explanation' => 'Définies sur `body`, ces propriétés de texte sont héritées par tout le document.',
                ],
            ],
            'quiz' => [
                ['q' => 'Pourquoi terminer `font-family` par `sans-serif` ?', 'a' => ['C’est obligatoire syntaxiquement', 'Pour avoir une police de secours si les autres manquent', 'Pour mettre en gras', 'Pour accélérer le site'], 'c' => 1, 'e' => 'La famille générique garantit un affichage correct si aucune police listée n’est disponible.'],
                ['q' => 'Quelle valeur de `line-height` convient à un paragraphe ?', 'a' => ['`0.8`', '`1`', '`1.6`', '`4`'], 'c' => 2, 'e' => 'Entre 1.5 et 1.7 pour le texte courant.'],
                ['q' => '`font-weight: 700` équivaut à `bold`.', 'tf' => true, 'c' => true, 'e' => 'Vrai : 400 = normal, 700 = bold.'],
            ],
        ],
        [
            'slug' => 'mise-en-forme-du-texte-css',
            'title' => 'Alignement et décoration du texte',
            'duration' => 12,
            'intro' => <<<'MD'
Centrer un titre, souligner un lien au survol, mettre une étiquette en majuscules, espacer les lettres d’un logo : ces réglages fins donnent du caractère à une interface. Tous passent par une poignée de propriétés `text-*` et `letter-spacing`.
MD,
            'objectives' => ['Aligner le texte avec `text-align`', 'Gérer les soulignements avec `text-decoration`', 'Transformer la casse avec `text-transform`', 'Régler l’espacement des lettres et des mots'],
            'prerequisites' => ['Polices, tailles et hauteur de ligne'],
            'theory' => <<<'MD'
## `text-align`

Aligne le **contenu en ligne** d’un bloc : `left`, `right`, `center`, `justify`.

```css
h1 { text-align: center; }
```

> [!WARN] `justify` crée souvent des « rivières » d’espaces blancs irrégulières sur le Web, surtout sur mobile. Préférez `left` pour les longs textes.

`text-align` centre le **texte**, pas le bloc lui-même : pour centrer une boîte, on utilisera `margin: auto` ou Flexbox.

## `text-decoration`

Ajoute ou retire soulignement, surlignement ou barré :

```css
a { text-decoration: none; }
a:hover { text-decoration: underline; }
```

On peut régler la couleur, le style et l’épaisseur : `text-decoration: underline wavy red 2px;` et l’écart avec `text-underline-offset`.

## `text-transform`

Change la casse **à l’affichage** : `uppercase`, `lowercase`, `capitalize`. Le texte reste écrit normalement dans le HTML, ce qui est préférable pour l’accessibilité et le référencement.

## Espacements

- `letter-spacing` : espace entre les lettres (utile pour les majuscules : `0.08em`) ;
- `word-spacing` : espace entre les mots ;
- `text-indent` : retrait de la première ligne.

## Autres propriétés utiles

- `white-space: nowrap;` empêche les retours à la ligne ;
- `text-overflow: ellipsis;` (avec `overflow: hidden` et `white-space: nowrap`) coupe un texte trop long avec « … » ;
- `text-shadow` ajoute une ombre au texte (vu dans le module Effets visuels).
MD,
            'syntax' => 'text-align: center;
text-decoration: none;
text-transform: uppercase;
letter-spacing: 0.1em;',
            'example_html' => <<<'HTML'
<p class="etiquette">Nouveauté</p>
<h1 class="titre">Collection printemps</h1>
<p class="texte">Découvrez nos créations aux couleurs pastel. <a href="#">Voir la collection</a></p>
<p class="ancien-prix">79,00 €</p>
HTML,
            'example_css' => <<<'CSS'
.etiquette {
  text-transform: uppercase;
  letter-spacing: 0.15em;
  font-size: 12px;
  color: #be185d;
}

.titre {
  text-align: center;
}

.texte a {
  color: #be185d;
  text-decoration: none;
}

.texte a:hover {
  text-decoration: underline;
  text-underline-offset: 4px;
}

.ancien-prix {
  text-decoration: line-through;
  color: #6b7280;
}
CSS,
            'lines' => [
                ['  text-transform: uppercase;', 'Majuscules à l’affichage ; le HTML reste « Nouveauté ».'],
                ['  letter-spacing: 0.15em;', 'Lettres espacées : les majuscules respirent.'],
                ['  text-align: center;', 'Titre centré dans son bloc.'],
                ['  text-decoration: none;', 'Retire le soulignement par défaut du lien.'],
                ['.texte a:hover {', 'Au survol, le soulignement réapparaît (retour visuel).'],
                ['  text-decoration: line-through;', 'Texte barré (ancien prix).'],
            ],
            'reference' => [
                ['text-align', 'Alignement horizontal du texte.'],
                ['text-decoration', 'Soulignement, barré, surlignement.'],
                ['text-transform', 'Casse à l’affichage.'],
                ['letter-spacing', 'Espacement entre les lettres.'],
                ['text-indent', 'Retrait de première ligne.'],
                ['white-space', 'Gestion des espaces et retours à la ligne.'],
            ],
            'mistakes' => [
                'Écrire le texte en majuscules dans le HTML au lieu d’utiliser `text-transform`.',
                'Supprimer le soulignement des liens dans un texte sans autre indice visuel.',
                'Justifier les textes sur mobile.',
                'Utiliser `text-align: center` pour centrer une image bloc ou une boîte.',
            ],
            'practices' => [
                'Garder les liens identifiables dans le texte (soulignés ou très contrastés).',
                'Augmenter légèrement `letter-spacing` pour les textes en capitales.',
                'Aligner à gauche les textes longs.',
            ],
            'practical' => 'Les petites étiquettes au-dessus des titres (« NOUVEAUTÉ », « ÉTUDE DE CAS ») que l’on voit sur la plupart des sites modernes combinent `text-transform: uppercase`, `letter-spacing` et une petite taille. C’est aussi le cas des « eyebrows » de cette plateforme.',
            'summary' => ['`text-align` aligne le texte dans son bloc.', '`text-decoration` gère le soulignement.', '`text-transform` change la casse à l’affichage.', '`letter-spacing` espace les lettres.'],
            'challenge' => 'Créez une carte « fiche produit » avec une étiquette en capitales espacées, un titre centré, un ancien prix barré et un nouveau prix en gras.',
            'exercises' => [
                [
                    'title' => 'Une étiquette en capitales',
                    'difficulty' => 1,
                    'instructions' => 'Stylisez `.badge` : texte en majuscules avec `text-transform`, `letter-spacing` de `0.1em`, et centrez le titre `h1` avec `text-align`.',
                    'starter_html' => '<p class="badge">promotion</p>
<h1>Soldes d’été</h1>',
                    'solution_css' => '.badge {
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

h1 {
  text-align: center;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.badge|p.badge', 'prop' => 'text-transform', 'value' => 'uppercase', 'msg' => '.badge est en majuscules'],
                        ['t' => 'css', 'sel' => '.badge|p.badge', 'prop' => 'letter-spacing', 'value' => '0.1em', 'msg' => 'letter-spacing vaut 0.1em'],
                        ['t' => 'css', 'sel' => 'h1', 'prop' => 'text-align', 'value' => 'center', 'msg' => 'Le h1 est centré'],
                        ['t' => 'el', 'sel' => '.badge', 'text' => 'promotion', 'msg' => 'Le texte HTML reste en minuscules'],
                    ],
                    'hint' => 'Deux règles : `.badge { … }` et `h1 { … }`.',
                    'explanation' => '`text-transform` change la casse à l’affichage sans modifier le contenu HTML.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle propriété retire le soulignement d’un lien ?', 'a' => ['`text-style: none`', '`text-decoration: none`', '`font-decoration: none`', '`underline: false`'], 'c' => 1, 'e' => '`text-decoration: none` supprime le soulignement.'],
                ['q' => 'Quelle valeur de `text-transform` met la première lettre de chaque mot en majuscule ?', 'a' => ['`uppercase`', '`capitalize`', '`title`', '`first`'], 'c' => 1, 'e' => '`capitalize`.'],
                ['q' => '`text-align: center` centre une boîte dans la page.', 'tf' => true, 'c' => false, 'e' => 'Faux : il centre le contenu en ligne (le texte) à l’intérieur du bloc.'],
            ],
        ],
        [
            'slug' => 'unites-css',
            'title' => 'Les unités : px, em, rem, %, vw',
            'duration' => 16,
            'intro' => <<<'MD'
`16px`, `1.2em`, `2rem`, `50%`, `100vw`… Les unités CSS déroutent souvent les débutants. Pourtant, bien choisir son unité fait la différence entre un site rigide et un site qui s’adapte aux réglages de l’utilisateur et à toutes les tailles d’écran.
MD,
            'objectives' => ['Distinguer unités absolues et relatives', 'Maîtriser `em` et `rem`', 'Utiliser `%`, `vw`, `vh`, `ch`', 'Choisir l’unité adaptée à chaque situation'],
            'prerequisites' => ['Polices, tailles et hauteur de ligne'],
            'theory' => <<<'MD'
## Unités absolues : `px`

Le pixel CSS est une unité fixe. Prévisible, mais elle **ignore la taille de police choisie par l’utilisateur** dans son navigateur (réglage utilisé par de nombreuses personnes malvoyantes).

## `rem` : relatif à la racine

`1rem` = la taille de police de l’élément racine `<html>`, soit **16 px par défaut**. Si l’utilisateur agrandit la police par défaut à 20 px, `1rem` vaut 20 px : tout le site s’adapte.

```css
h1 { font-size: 2.5rem; }  /* 40px par défaut */
p  { font-size: 1.125rem; } /* 18px */
```

## `em` : relatif au parent (ou à l’élément)

- pour `font-size`, `1em` = la taille de police du **parent** ;
- pour les autres propriétés (padding, margin), `1em` = la taille de police de **l’élément lui-même**.

```css
.bouton {
  font-size: 1rem;
  padding: 0.5em 1em; /* s’adapte si on agrandit le bouton */
}
.bouton-grand { font-size: 1.25rem; } /* le padding grandit aussi */
```

Attention à l’effet cumulatif des `em` imbriqués pour `font-size` : `1.2em` dans `1.2em` dans `1.2em`…

## Les pourcentages

Relatifs au **parent** : `width: 50%` = la moitié de la largeur du conteneur.

## Unités de la fenêtre : `vw`, `vh`

- `1vw` = 1 % de la largeur de la fenêtre ;
- `1vh` = 1 % de la hauteur de la fenêtre (`100vh` = plein écran ; sur mobile, préférez `100dvh`).

## `ch`

`1ch` = la largeur du caractère « 0 » dans la police courante. Idéal pour limiter la longueur des lignes : `max-width: 65ch`.

## Quelle unité choisir ?

| Usage | Unité conseillée |
|---|---|
| Taille de texte | `rem` |
| Espacements internes d’un composant | `em` ou `rem` |
| Largeurs de mise en page | `%`, `fr` (Grid), `max-width` en `rem`/`px` |
| Bordures fines | `px` |
| Sections plein écran | `vh` / `dvh` |
| Longueur de ligne | `ch` |

> [!TIP] La fonction `clamp(min, idéal, max)` permet une taille fluide bornée : `font-size: clamp(1.75rem, 4vw, 3rem);` (voir module Responsive).
MD,
            'syntax' => 'font-size: 1.25rem;
padding: 0.5em 1em;
width: 50%;
min-height: 100vh;
max-width: 65ch;',
            'example_html' => <<<'HTML'
<div class="page">
  <h1>Unités relatives</h1>
  <p>Ce texte mesure 1.125rem. Changez la taille de police par défaut de votre navigateur : tout suit.</p>
  <a class="btn" href="#">Bouton normal</a>
  <a class="btn btn-grand" href="#">Bouton grand</a>
  <div class="demi">Je fais 50 % de la largeur de mon parent.</div>
</div>
HTML,
            'example_css' => <<<'CSS'
.page {
  font-family: system-ui, sans-serif;
  max-width: 60ch;
}

h1 { font-size: 2.5rem; }
p  { font-size: 1.125rem; line-height: 1.6; }

.btn {
  display: inline-block;
  font-size: 1rem;
  padding: 0.5em 1em;
  background: #2563eb;
  color: white;
  text-decoration: none;
  border-radius: 0.4em;
}

.btn-grand { font-size: 1.5rem; }

.demi {
  width: 50%;
  margin-top: 1rem;
  padding: 1rem;
  background: #e0e7ff;
}
CSS,
            'lines' => [
                ['  max-width: 60ch;', 'La page ne dépasse pas ~60 caractères de large.'],
                ['h1 { font-size: 2.5rem; }', '2,5 × la taille racine (40 px par défaut).'],
                ['  padding: 0.5em 1em;', 'Padding relatif à la taille de police du bouton.'],
                ['  border-radius: 0.4em;', 'Arrondi proportionnel : il grandit avec le bouton.'],
                ['.btn-grand { font-size: 1.5rem; }', 'Seule la police change… et le padding et l’arrondi suivent grâce aux `em`.'],
                ['  width: 50%;', 'La moitié de la largeur du parent `.page`.'],
            ],
            'reference' => [
                ['px', 'Pixel CSS, unité fixe.'],
                ['rem', 'Relatif à la taille de police de `<html>` (16px par défaut).'],
                ['em', 'Relatif à la taille de police du parent (ou de l’élément).'],
                ['%', 'Relatif à la dimension correspondante du parent.'],
                ['vw / vh / dvh', 'Pourcentage de la largeur / hauteur de la fenêtre.'],
                ['ch', 'Largeur du caractère « 0 ».'],
            ],
            'mistakes' => [
                'Oublier l’unité : `font-size: 18;` est invalide (sauf pour `line-height` et `0`).',
                'Mettre un espace entre le nombre et l’unité : `18 px`.',
                'Imbriquer des `font-size` en `em` et obtenir des tailles démesurées.',
                'Utiliser `100vw` pour une largeur : la barre de défilement provoque un débordement horizontal.',
            ],
            'practices' => [
                'Tailles de texte en `rem`.',
                'Padding des composants en `em` pour qu’ils grandissent avec leur texte.',
                'Aucun espace entre la valeur et l’unité.',
                '`0` s’écrit sans unité.',
            ],
            'practical' => 'Les design systems définissent une échelle d’espacements en `rem` (0.25, 0.5, 1, 1.5, 2, 3rem) et de tailles de texte (0.875, 1, 1.25, 1.5, 2rem). Utiliser toujours les mêmes valeurs donne une interface harmonieuse.',
            'summary' => ['`px` fixe ; `rem` relatif à la racine ; `em` relatif au parent/élément.', '`%` relatif au parent ; `vw`/`vh` à la fenêtre ; `ch` à la police.', 'Textes en `rem`, composants en `em`.'],
            'challenge' => 'Créez trois boutons (petit, moyen, grand) ne différant que par leur `font-size` en `rem`, avec padding et arrondi en `em`.',
            'exercises' => [
                [
                    'title' => 'Passer aux unités relatives',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Remplacez les tailles en pixels par des unités relatives : le `h1` doit mesurer `2rem` et le paragraphe `1.125rem`. Le `.btn` doit avoir un padding de `0.5em 1em`.',
                    'starter_html' => '<h1>Titre</h1>
<p>Paragraphe.</p>
<a class="btn" href="#">Bouton</a>',
                    'starter_css' => 'h1 { font-size: 32px; }
p { font-size: 18px; }
.btn { padding: 8px 16px; }',
                    'solution_css' => 'h1 { font-size: 2rem; }
p { font-size: 1.125rem; }
.btn { padding: 0.5em 1em; }',
                    'rules' => [
                        ['t' => 'css', 'sel' => 'h1', 'prop' => 'font-size', 'value' => '2rem', 'msg' => 'Le h1 mesure 2rem'],
                        ['t' => 'css', 'sel' => 'p', 'prop' => 'font-size', 'value' => '1.125rem', 'msg' => 'Le paragraphe mesure 1.125rem'],
                        ['t' => 'css', 'sel' => '.btn|a.btn', 'prop' => 'padding', 'value' => '0.5em 1em', 'msg' => 'Le bouton a un padding de 0.5em 1em'],
                        ['t' => 'absent', 's' => 'px', 'in' => 'css', 'msg' => 'Plus aucune valeur en px'],
                    ],
                    'hint' => '32 px = 2 × 16 px = `2rem` ; 18 px = `1.125rem`.',
                    'explanation' => 'Avec une racine de 16 px, on divise la taille en pixels par 16 pour obtenir des `rem`.',
                ],
                [
                    'title' => 'Que vaut 1rem ?',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Par défaut (sans réglage de l’utilisateur), combien vaut `1.5rem` ?',
                    'answers' => ['15px', '16px', '24px', '150%'],
                    'correct' => 2,
                    'explanation' => '1rem = 16px par défaut, donc 1.5rem = 24px.',
                ],
            ],
            'quiz' => [
                ['q' => '`rem` est relatif à…', 'a' => ['la taille de police du parent', 'la taille de police de l’élément `<html>`', 'la largeur de l’écran', 'la hauteur de l’écran'], 'c' => 1, 'e' => '`rem` = root em : la taille de police de la racine.'],
                ['q' => 'Quelle unité correspond à 1 % de la largeur de la fenêtre ?', 'a' => ['`%`', '`vh`', '`vw`', '`ch`'], 'c' => 2, 'e' => '`vw` = viewport width.'],
                ['q' => 'Pourquoi préférer `rem` à `px` pour les textes ?', 'a' => ['C’est plus court', 'Cela respecte la taille de police choisie par l’utilisateur', 'C’est plus rapide', 'Les px sont interdits'], 'c' => 1, 'e' => 'Les `rem` suivent le réglage de taille de police du navigateur.'],
                ['q' => 'On peut écrire `margin: 0;` sans unité.', 'tf' => true, 'c' => true, 'e' => 'Vrai : zéro est zéro, quelle que soit l’unité.'],
            ],
        ],
    ],
];
