<?php
return [
    'slug' => 'css-box-model',
    'title' => 'Le modèle de boîte',
    'description' => 'Content, padding, border, margin : comprendre comment chaque élément occupe l’espace, et box-sizing.',
    'lessons' => [
        [
            'slug' => 'le-modele-de-boite',
            'title' => 'Le modèle de boîte',
            'duration' => 15,
            'intro' => <<<'MD'
Voici le concept le plus important du CSS : **chaque élément est une boîte rectangulaire**. Un titre, un paragraphe, une image, un lien : tous. Comprendre de quoi est faite cette boîte, c’est comprendre tous les problèmes d’espacement et de dimensions que vous rencontrerez.
MD,
            'objectives' => ['Identifier les quatre zones d’une boîte', 'Visualiser les boîtes avec les outils de développement', 'Comprendre le calcul des dimensions'],
            'prerequisites' => ['Les unités CSS'],
            'theory' => <<<'MD'
## Les quatre couches

De l’intérieur vers l’extérieur :

1. **Content** (contenu) : le texte, l’image. Sa taille est définie par `width` et `height`.
2. **Padding** (marge intérieure) : l’espace entre le contenu et la bordure. Il prend la couleur de fond de l’élément.
3. **Border** (bordure) : le trait autour du padding.
4. **Margin** (marge extérieure) : l’espace transparent entre la bordure et les éléments voisins.

```text
┌──────────────── margin ────────────────┐
│  ┌───────────── border ─────────────┐  │
│  │  ┌────────── padding ─────────┐  │  │
│  │  │          content           │  │  │
│  │  └────────────────────────────┘  │  │
│  └──────────────────────────────────┘  │
└────────────────────────────────────────┘
```

## Padding ou margin ?

- Vous voulez de l’espace **à l’intérieur**, avec le fond coloré → `padding`.
- Vous voulez **éloigner** l’élément de ses voisins → `margin`.

Un bouton a du padding (pour que le texte respire dans le fond coloré) ; deux cartes sont séparées par une margin (ou un `gap`).

## Le calcul par défaut

Par défaut (`box-sizing: content-box`), `width` ne concerne **que le contenu**. Largeur visible = `width` + padding gauche et droite + bordures :

```css
.boite {
  width: 300px;
  padding: 20px;
  border: 5px solid;
}
/* largeur visible : 300 + 20 + 20 + 5 + 5 = 350px */
```

C’est contre-intuitif : on règlera ce problème avec `box-sizing: border-box` (leçon « Dimensions et box-sizing »).

## Voir les boîtes

Dans les outils de développement (`F12`), sélectionnez un élément : un schéma du modèle de boîte affiche ses dimensions, son padding (vert), sa bordure (jaune) et sa marge (orange). Au survol, ces zones sont colorées dans la page.

> [!TIP] Astuce de débogage : ajoutez temporairement `* { outline: 1px solid red; }` pour voir les contours de toutes les boîtes. `outline` ne prend pas de place, contrairement à `border`.
MD,
            'syntax' => '.boite {
  width: 300px;
  padding: 20px;
  border: 2px solid black;
  margin: 16px;
}',
            'example_html' => <<<'HTML'
<div class="boite">Contenu</div>
<div class="boite boite-large">Contenu avec plus de padding</div>
HTML,
            'example_css' => <<<'CSS'
.boite {
  width: 260px;
  padding: 16px;
  border: 4px solid #2563eb;
  margin: 24px;
  background-color: #dbeafe;
  font-family: system-ui, sans-serif;
}

.boite-large {
  padding: 40px;
}
CSS,
            'lines' => [
                ['  width: 260px;', 'Largeur du CONTENU uniquement (comportement par défaut).'],
                ['  padding: 16px;', 'Espace intérieur, coloré par le fond.'],
                ['  border: 4px solid #2563eb;', 'Bordure de 4 px autour du padding.'],
                ['  margin: 24px;', 'Espace extérieur transparent autour de la bordure.'],
                ['.boite-large { padding: 40px; }', 'Plus de padding : la boîte visible devient plus large (260 + 80 + 8 = 348px).'],
            ],
            'reference' => [
                ['width / height', 'Dimensions du contenu (par défaut).'],
                ['padding', 'Espace intérieur.'],
                ['border', 'Bordure.'],
                ['margin', 'Espace extérieur.'],
                ['outline', 'Contour qui n’occupe pas de place (débogage, focus).'],
            ],
            'mistakes' => [
                'Utiliser `margin` pour agrandir la zone colorée d’un bouton (c’est le padding).',
                'Être surpris qu’une boîte de `width: 100%` avec du padding déborde de son parent.',
                'Confondre `border` et `outline`.',
            ],
            'practices' => [
                'Inspecter les boîtes avec `F12` dès qu’un espacement surprend.',
                'Padding pour l’intérieur, margin (ou gap) pour l’extérieur.',
            ],
            'practical' => 'Une carte de produit est une boîte : padding pour aérer son contenu, bordure ou ombre pour la délimiter, marge (ou `gap` dans une grille) pour l’éloigner des autres cartes.',
            'summary' => ['Boîte = content + padding + border + margin.', 'Padding intérieur (coloré), margin extérieure (transparente).', 'Par défaut, `width` ne compte que le contenu.'],
            'challenge' => 'Calculez la largeur visible d’une boîte `width: 200px; padding: 10px 30px; border: 3px solid;`. Vérifiez avec les outils de développement.',
            'exercises' => [
                [
                    'title' => 'Une carte aérée',
                    'difficulty' => 1,
                    'instructions' => 'Stylisez `.carte` : un `padding` de `20px`, une `border` de `1px solid #d1d5db` et une `margin` de `16px`.',
                    'starter_html' => '<div class="carte">
  <h2>Carte</h2>
  <p>Mon contenu respire grâce au padding.</p>
</div>',
                    'solution_css' => '.carte {
  padding: 20px;
  border: 1px solid #d1d5db;
  margin: 16px;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.carte|div.carte', 'prop' => 'padding', 'value' => '20px', 'msg' => 'padding: 20px'],
                        ['t' => 'css', 'sel' => '.carte|div.carte', 'prop' => 'border', 'value' => '1px solid #d1d5db', 'msg' => 'border: 1px solid #d1d5db'],
                        ['t' => 'css', 'sel' => '.carte|div.carte', 'prop' => 'margin', 'value' => '16px', 'msg' => 'margin: 16px'],
                    ],
                    'hint' => 'Trois déclarations dans `.carte`.',
                    'explanation' => 'Padding à l’intérieur, bordure autour, margin à l’extérieur.',
                ],
                [
                    'title' => 'Calcul de largeur',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse (box-sizing par défaut).',
                    'question' => 'Quelle est la largeur visible de : `width: 200px; padding: 10px; border: 5px solid;` ?',
                    'code' => '.boite { width: 200px; padding: 10px; border: 5px solid; }',
                    'answers' => ['200px', '210px', '220px', '230px'],
                    'correct' => 3,
                    'explanation' => '200 + 10 × 2 (padding) + 5 × 2 (bordure) = 230px.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle zone prend la couleur de fond de l’élément ?', 'a' => ['La margin', 'Le padding', 'Aucune', 'Seulement le contenu'], 'c' => 1, 'e' => 'Le fond couvre le contenu ET le padding (jusqu’à la bordure).'],
                ['q' => 'Pour éloigner une carte de sa voisine, on utilise…', 'a' => ['`padding`', '`margin`', '`width`', '`outline`'], 'c' => 1, 'e' => 'La marge extérieure crée l’espace entre les éléments.'],
                ['q' => '`outline` occupe de la place dans la mise en page.', 'tf' => true, 'c' => false, 'e' => 'Faux : contrairement à `border`, il ne modifie pas les dimensions.'],
            ],
        ],
        [
            'slug' => 'margin-et-padding',
            'title' => 'Margin et padding en détail',
            'duration' => 14,
            'intro' => <<<'MD'
Écrire `margin: 10px 20px` au lieu de quatre lignes, centrer un bloc avec `margin: 0 auto`, comprendre pourquoi deux marges se « fusionnent »… Cette leçon vous donne toutes les clés pour gérer les espacements comme un professionnel.
MD,
            'objectives' => ['Utiliser les propriétés raccourcies à 1, 2, 3 ou 4 valeurs', 'Centrer un bloc avec `margin: auto`', 'Comprendre la fusion des marges'],
            'prerequisites' => ['Le modèle de boîte'],
            'theory' => <<<'MD'
## Les quatre côtés

Chaque côté peut être réglé séparément : `margin-top`, `margin-right`, `margin-bottom`, `margin-left` (idem pour `padding`).

## Les raccourcis (sens des aiguilles d’une montre)

| Écriture | Signification |
|---|---|
| `margin: 10px;` | 10px sur les 4 côtés |
| `margin: 10px 20px;` | 10px haut/bas, 20px gauche/droite |
| `margin: 10px 20px 30px;` | haut 10, gauche/droite 20, bas 30 |
| `margin: 10px 20px 30px 40px;` | haut, droite, bas, gauche |

Moyen mnémotechnique pour 4 valeurs : **TRouBLe** (*Top, Right, Bottom, Left*).

## Centrer un bloc horizontalement

Un bloc qui a une largeur définie peut être centré avec des marges latérales automatiques :

```css
.conteneur {
  max-width: 960px;
  margin: 0 auto;
}
```

Le navigateur répartit l’espace restant à parts égales à gauche et à droite.

## La fusion des marges (margin collapsing)

Les marges **verticales** de deux blocs voisins **ne s’additionnent pas** : la plus grande l’emporte.

```css
h2 { margin-bottom: 30px; }
p  { margin-top: 20px; }
/* espace entre les deux : 30px, pas 50px */
```

Ce comportement ne concerne que les marges verticales des blocs dans un flux normal (pas en Flexbox ni en Grid).

## Marges négatives

Une marge peut être négative : l’élément est tiré dans cette direction et peut chevaucher son voisin. Utile ponctuellement, à manier avec prudence.

> [!INFO] Le padding ne peut jamais être négatif.

## Les marges par défaut du navigateur

`body` a une marge de 8px, les paragraphes et titres ont des marges verticales. Beaucoup de projets commencent par une petite remise à zéro : `body { margin: 0; }`.
MD,
            'syntax' => 'margin: haut droite bas gauche;
padding: vertical horizontal;
margin: 0 auto;',
            'example_html' => <<<'HTML'
<main class="conteneur">
  <h2 class="titre">Espacements</h2>
  <p class="texte">Ce conteneur est centré grâce à margin: 0 auto.</p>
  <a class="bouton" href="#">Un bouton bien rembourré</a>
</main>
HTML,
            'example_css' => <<<'CSS'
body {
  margin: 0;
  background: #f1f5f9;
  font-family: system-ui, sans-serif;
}

.conteneur {
  max-width: 480px;
  margin: 40px auto;
  padding: 24px 32px;
  background: white;
}

.titre {
  margin-top: 0;
  margin-bottom: 30px;
}

.texte {
  margin-top: 20px;
}

.bouton {
  display: inline-block;
  padding: 12px 24px;
  background: #0f766e;
  color: white;
  text-decoration: none;
}
CSS,
            'lines' => [
                ['  margin: 0;', 'Supprime la marge par défaut de 8px du body.'],
                ['  margin: 40px auto;', '40px en haut et en bas, marges latérales automatiques : le bloc est centré.'],
                ['  padding: 24px 32px;', '24px en haut/bas, 32px à gauche/droite.'],
                ['  margin-bottom: 30px;', 'Marge basse du titre…'],
                ['  margin-top: 20px;', '…et marge haute du texte : elles fusionnent, l’écart vaut 30px.'],
                ['  padding: 12px 24px;', 'Le bouton est plus large que haut : proportions classiques.'],
            ],
            'reference' => [
                ['margin / padding', 'Raccourcis 1 à 4 valeurs (haut, droite, bas, gauche).'],
                ['margin-top …', 'Réglage d’un seul côté.'],
                ['auto', 'Répartit l’espace disponible (centrage horizontal).'],
                ['margin-inline / padding-block', 'Versions logiques (gauche+droite / haut+bas).'],
            ],
            'mistakes' => [
                'Oublier l’ordre des 4 valeurs.',
                'Vouloir centrer avec `margin: auto` un élément sans largeur ou un élément en ligne.',
                'Additionner deux marges verticales dans sa tête (fusion).',
                'Espacer avec des `<br>` au lieu de margin.',
            ],
            'practices' => [
                'Utiliser les raccourcis pour un code concis.',
                'Espacer dans une seule direction (par exemple toujours `margin-bottom`) pour éviter les surprises de fusion.',
                'Utiliser une échelle d’espacements cohérente.',
            ],
            'practical' => 'Presque tous les sites utilisent une classe `.container` avec `max-width` et `margin: 0 auto` pour centrer le contenu sur les grands écrans, et un `padding` latéral pour qu’il ne colle pas aux bords sur mobile.',
            'summary' => ['Raccourcis : 1, 2, 3 ou 4 valeurs, sens horaire depuis le haut.', '`margin: 0 auto` centre un bloc de largeur définie.', 'Les marges verticales voisines fusionnent.'],
            'challenge' => 'Créez un conteneur centré de 600px maximum avec 3 cartes espacées verticalement de 24px, sans que la première ait de marge en haut.',
            'exercises' => [
                [
                    'title' => 'Centrer un conteneur',
                    'difficulty' => 2,
                    'instructions' => 'Centrez horizontalement `.conteneur` : donnez-lui un `max-width` de `600px` et des marges `0 auto`. Ajoutez un `padding` de `16px 24px` (16px vertical, 24px horizontal).',
                    'starter_html' => '<div class="conteneur">
  <p>Je veux être centré dans la page.</p>
</div>',
                    'starter_css' => '.conteneur {
  background: #e0f2fe;
}',
                    'solution_css' => '.conteneur {
  background: #e0f2fe;
  max-width: 600px;
  margin: 0 auto;
  padding: 16px 24px;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.conteneur|div.conteneur', 'prop' => 'max-width|width', 'value' => '600px', 'msg' => 'Largeur maximale de 600px'],
                        ['t' => 'css', 'sel' => '.conteneur|div.conteneur', 'prop' => 'margin', 'in' => ['0 auto', '0px auto', 'auto'], 'msg' => 'Marges latérales automatiques (0 auto)'],
                        ['t' => 'css', 'sel' => '.conteneur|div.conteneur', 'prop' => 'padding', 'value' => '16px 24px', 'msg' => 'padding: 16px 24px'],
                    ],
                    'hint' => '`margin: 0 auto;` = 0 en haut/bas, auto à gauche/droite.',
                    'explanation' => 'Avec une largeur limitée, les marges automatiques se partagent l’espace libre : le bloc est centré.',
                ],
                [
                    'title' => 'Lire un raccourci',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Avec `padding: 5px 10px 15px 20px;`, quel est le padding **gauche** ?',
                    'answers' => ['5px', '10px', '15px', '20px'],
                    'correct' => 3,
                    'explanation' => 'Ordre : haut (5), droite (10), bas (15), gauche (20).',
                ],
            ],
            'quiz' => [
                ['q' => '`margin: 10px 20px;` signifie…', 'a' => ['10px à gauche, 20px à droite', '10px en haut/bas, 20px à gauche/droite', '10px en haut, 20px en bas', '10px partout puis 20px'], 'c' => 1, 'e' => 'Deux valeurs : vertical puis horizontal.'],
                ['q' => 'Deux blocs voisins ont `margin-bottom: 40px` et `margin-top: 25px`. Quel est l’écart ?', 'a' => ['25px', '40px', '65px', '15px'], 'c' => 1, 'e' => 'Les marges verticales fusionnent : la plus grande l’emporte.'],
                ['q' => 'Le padding peut avoir une valeur négative.', 'tf' => true, 'c' => false, 'e' => 'Faux : seule la margin accepte des valeurs négatives.'],
            ],
        ],
        [
            'slug' => 'bordures-et-coins-arrondis',
            'title' => 'Bordures et coins arrondis',
            'duration' => 12,
            'intro' => <<<'MD'
Une bordure fine pour délimiter une carte, un trait coloré à gauche d’une citation, des coins arrondis pour adoucir un bouton, un avatar parfaitement rond… Les propriétés `border` et `border-radius` sont partout dans les interfaces modernes.
MD,
            'objectives' => ['Définir une bordure (épaisseur, style, couleur)', 'Styler un seul côté', 'Arrondir les angles avec `border-radius`', 'Créer un cercle'],
            'prerequisites' => ['Margin et padding en détail'],
            'theory' => <<<'MD'
## La propriété `border`

Raccourci de trois valeurs : **épaisseur**, **style**, **couleur**.

```css
.carte { border: 1px solid #e5e7eb; }
```

Le **style** est obligatoire (sans lui, pas de bordure) : `solid`, `dashed`, `dotted`, `double`, `none`.

## Un seul côté

```css
blockquote { border-left: 4px solid #6366f1; }
.onglet-actif { border-bottom: 3px solid currentColor; }
```

## `border-radius`

Arrondit les angles :

```css
.bouton { border-radius: 8px; }
.pilule { border-radius: 999px; }   /* bords entièrement ronds */
.avatar { border-radius: 50%; }     /* cercle si l’élément est carré */
```

Comme `margin`, il accepte 1 à 4 valeurs (en partant du coin **haut-gauche**, sens horaire) : `border-radius: 16px 16px 0 0;` arrondit seulement le haut.

## Bordure et dimensions

La bordure s’ajoute à la taille de la boîte (sauf avec `box-sizing: border-box`). Pour un effet de survol sans « saut » de mise en page, prévoyez une bordure transparente au repos :

```css
.carte { border: 2px solid transparent; }
.carte:hover { border-color: #6366f1; }
```

> [!TIP] `border-radius` s’applique aussi au fond et aux images. Pour arrondir une image dans une carte, ajoutez `overflow: hidden` à la carte.
MD,
            'syntax' => 'border: 1px solid #ccc;
border-left: 4px solid blue;
border-radius: 8px;',
            'example_html' => <<<'HTML'
<div class="carte">
  <img class="avatar" src="https://placehold.co/80x80/png" alt="Photo de profil de Sam">
  <h3>Sam Dupont</h3>
  <blockquote class="citation">Le CSS, c’est de la géométrie avec des couleurs.</blockquote>
  <a class="pilule" href="#">Suivre</a>
</div>
HTML,
            'example_css' => <<<'CSS'
.carte {
  max-width: 320px;
  padding: 20px;
  border: 1px solid #e5e7eb;
  border-radius: 16px;
  font-family: system-ui, sans-serif;
}

.avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  border: 3px solid #a78bfa;
}

.citation {
  margin: 16px 0;
  padding-left: 12px;
  border-left: 4px solid #a78bfa;
  font-style: italic;
}

.pilule {
  display: inline-block;
  padding: 8px 20px;
  border: 2px dashed #7c3aed;
  border-radius: 999px;
  color: #7c3aed;
  text-decoration: none;
}
CSS,
            'lines' => [
                ['  border: 1px solid #e5e7eb;', 'Bordure fine et discrète : épaisseur, style, couleur.'],
                ['  border-radius: 16px;', 'Coins arrondis de la carte.'],
                ['  border-radius: 50%;', 'Image carrée + 50 % = cercle parfait.'],
                ['  border-left: 4px solid #a78bfa;', 'Bordure sur un seul côté pour la citation.'],
                ['  border: 2px dashed #7c3aed;', 'Style en tirets.'],
                ['  border-radius: 999px;', 'Valeur très grande : forme de pilule.'],
            ],
            'reference' => [
                ['border', 'Raccourci : épaisseur style couleur.'],
                ['border-top / -right / -bottom / -left', 'Bordure d’un seul côté.'],
                ['border-color / -width / -style', 'Réglage d’un seul aspect.'],
                ['border-radius', 'Arrondi des angles.'],
            ],
            'mistakes' => [
                'Oublier le style : `border: 1px red;` n’affiche rien.',
                'Utiliser `border-radius: 50%` sur un rectangle : on obtient une ellipse.',
                'Ajouter une bordure au survol, ce qui décale le contenu.',
            ],
            'practices' => [
                'Bordures fines et claires pour délimiter sans alourdir.',
                'Une bordure transparente au repos pour les effets de survol.',
                'Un même rayon d’arrondi dans toute l’interface.',
            ],
            'practical' => 'Les interfaces modernes utilisent une échelle d’arrondis : 4px pour les champs, 8–12px pour les boutons et cartes, 999px pour les étiquettes « pilule », 50 % pour les avatars.',
            'summary' => ['`border: épaisseur style couleur`.', 'Le style est obligatoire.', '`border-radius` arrondit ; 50 % sur un carré = cercle.'],
            'challenge' => 'Créez trois étiquettes « pilule » (succès, avertissement, erreur) avec bordure colorée et fond très clair de la même teinte.',
            'exercises' => [
                [
                    'title' => 'Un avatar rond',
                    'difficulty' => 1,
                    'instructions' => 'Rendez l’image `.avatar` parfaitement ronde avec `border-radius: 50%`, et ajoutez-lui une bordure `4px solid #22c55e`.',
                    'starter_html' => '<img class="avatar" src="https://placehold.co/120x120/png" alt="Avatar de Nina" width="120" height="120">',
                    'solution_css' => '.avatar {
  border-radius: 50%;
  border: 4px solid #22c55e;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.avatar|img.avatar', 'prop' => 'border-radius', 'value' => '50%', 'msg' => 'border-radius: 50%'],
                        ['t' => 'css', 'sel' => '.avatar|img.avatar', 'prop' => 'border', 'value' => '4px solid #22c55e', 'msg' => 'Bordure de 4px verte'],
                    ],
                    'hint' => 'Une image carrée avec 50 % d’arrondi devient un cercle.',
                    'explanation' => 'Avec `border-radius: 50%`, chaque coin est arrondi à la moitié de la taille : un carré devient un cercle.',
                ],
                [
                    'title' => 'Une bordure invisible',
                    'type' => 'fix',
                    'difficulty' => 1,
                    'instructions' => 'La bordure de `.citation` ne s’affiche pas. Corrigez la déclaration pour obtenir une bordure gauche **pleine** (`solid`) de 4px couleur `#6366f1`.',
                    'starter_html' => '<blockquote class="citation">Le savoir est la seule richesse qui s’accroît quand on la partage.</blockquote>',
                    'starter_css' => '.citation {
  border-left: 4px #6366f1;
  padding-left: 12px;
}',
                    'solution_css' => '.citation {
  border-left: 4px solid #6366f1;
  padding-left: 12px;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.citation|blockquote.citation', 'prop' => 'border-left', 'value' => '4px solid #6366f1', 'msg' => 'border-left: 4px solid #6366f1'],
                    ],
                    'hint' => 'Il manque le style de la bordure.',
                    'explanation' => 'Sans style (`solid`, `dashed`…), une bordure n’est pas dessinée.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle déclaration affiche bien une bordure ?', 'a' => ['`border: 2px red;`', '`border: 2px;`', '`border: 2px solid red;`', '`border: red 2px;`'], 'c' => 2, 'e' => 'Le style (`solid`) est indispensable : sans lui, aucune bordure n’est dessinée.'],
                ['q' => 'Comment obtenir un cercle à partir d’une image carrée ?', 'a' => ['`border-radius: 100px`', '`border-radius: 50%`', '`border: circle`', '`shape: round`'], 'c' => 1, 'e' => '50 % d’arrondi sur un carré = cercle.'],
                ['q' => 'Une bordure augmente la taille visible de la boîte avec box-sizing: content-box.', 'tf' => true, 'c' => true, 'e' => 'Vrai : elle s’ajoute à la largeur et à la hauteur.'],
            ],
        ],
        [
            'slug' => 'dimensions-et-box-sizing',
            'title' => 'Dimensions et box-sizing',
            'duration' => 14,
            'intro' => <<<'MD'
« J’ai mis `width: 100%` et ma boîte dépasse de l’écran ! » Ce problème a fait perdre des heures à des générations de développeurs. La solution tient en une ligne : `box-sizing: border-box`. Cette leçon explique aussi comment gérer largeurs et hauteurs de façon souple avec `min-` et `max-`.
MD,
            'objectives' => ['Utiliser `width`, `height`, `min-*` et `max-*`', 'Comprendre `box-sizing: border-box`', 'Gérer le débordement avec `overflow`'],
            'prerequisites' => ['Bordures et coins arrondis'],
            'theory' => <<<'MD'
## `width` et `height`

Définissent la taille de la boîte. Pour le Web, **évitez les hauteurs fixes** sur les blocs de texte : le contenu (et la taille de police de l’utilisateur) varie, et un texte qui dépasse d’une boîte de hauteur fixe déborde.

## `min-` et `max-`

- `max-width: 800px;` : la boîte peut rétrécir, mais ne dépasse jamais 800px. **Parfait pour le responsive.**
- `min-height: 300px;` : au moins 300px, mais peut grandir si le contenu l’exige.

```css
img { max-width: 100%; height: auto; } /* images jamais plus larges que leur conteneur */
```

## Le problème de `content-box`

Par défaut, `width` n’inclut pas le padding ni la bordure :

```css
.colonne { width: 100%; padding: 20px; } /* = 100% + 40px : ça déborde ! */
```

## La solution : `box-sizing: border-box`

Avec `border-box`, `width` **inclut** padding et bordure : une boîte de `width: 300px` mesure 300px à l’écran, quel que soit son padding.

La quasi-totalité des projets modernes l’applique à tous les éléments dès la première ligne du CSS :

```css
*, *::before, *::after {
  box-sizing: border-box;
}
```

## `overflow` : que faire du contenu qui déborde ?

| Valeur | Effet |
|---|---|
| `visible` | Le contenu dépasse (par défaut) |
| `hidden` | Le surplus est masqué |
| `auto` | Barre de défilement si nécessaire |
| `scroll` | Barre de défilement toujours présente |

`overflow-x` et `overflow-y` agissent sur un seul axe. Exemple : un tableau large dans un conteneur `overflow-x: auto` défile horizontalement sur mobile au lieu de casser la page.

> [!WARN] `overflow: hidden` peut cacher du contenu important (ou le contour de focus). Utilisez-le en connaissance de cause.
MD,
            'syntax' => '*, *::before, *::after { box-sizing: border-box; }
.bloc { max-width: 800px; min-height: 200px; overflow: auto; }',
            'example_html' => <<<'HTML'
<div class="comparaison">
  <div class="boite content">content-box : 200px + padding + bordure</div>
  <div class="boite border">border-box : 200px au total</div>
</div>
<div class="defilement">
  <p>Ce bloc a une hauteur maximale. Le texte supplémentaire fait apparaître une barre de défilement plutôt que de déborder sur la suite de la page. Ajoutez du texte pour tester !</p>
</div>
HTML,
            'example_css' => <<<'CSS'
.boite {
  width: 200px;
  padding: 20px;
  border: 5px solid #0ea5e9;
  margin-bottom: 12px;
  background: #e0f2fe;
  font-family: system-ui, sans-serif;
}

.content { box-sizing: content-box; } /* 250px à l’écran */
.border  { box-sizing: border-box; }  /* 200px à l’écran */

.defilement {
  max-width: 300px;
  max-height: 80px;
  overflow: auto;
  border: 1px solid #cbd5e1;
  padding: 8px;
}
CSS,
            'lines' => [
                ['  width: 200px;', 'Même largeur déclarée pour les deux boîtes.'],
                ['.content { box-sizing: content-box; }', 'Comportement par défaut : 200 + 40 + 10 = 250px visibles.'],
                ['.border  { box-sizing: border-box; }', 'Padding et bordure inclus : 200px visibles.'],
                ['  max-height: 80px;', 'Hauteur plafonnée…'],
                ['  overflow: auto;', '…et défilement si le contenu dépasse.'],
            ],
            'reference' => [
                ['width / height', 'Dimensions.'],
                ['min-width / max-width', 'Bornes de largeur.'],
                ['min-height / max-height', 'Bornes de hauteur.'],
                ['box-sizing', '`content-box` (défaut) ou `border-box`.'],
                ['overflow', 'Gestion du contenu qui dépasse.'],
                ['aspect-ratio', 'Proportions d’une boîte : `aspect-ratio: 16 / 9;`.'],
            ],
            'mistakes' => [
                'Fixer une `height` sur un bloc de texte.',
                'Utiliser `width` fixe en pixels au lieu de `max-width` pour un conteneur.',
                'Oublier `box-sizing: border-box` et accumuler les débordements.',
                'Masquer un débordement avec `overflow: hidden` au lieu d’en corriger la cause.',
            ],
            'practices' => [
                'Commencer chaque feuille de style par la règle `box-sizing: border-box` globale.',
                'Préférer `max-width` à `width` pour les conteneurs.',
                'Préférer `min-height` à `height`.',
                '`img { max-width: 100%; height: auto; }` dans tous les projets.',
            ],
            'practical' => 'Les « reset CSS » modernes (fichiers de base utilisés en début de projet) contiennent presque tous ces trois lignes : `box-sizing: border-box` global, `body { margin: 0 }` et `img { max-width: 100%; display: block; }`.',
            'summary' => ['`box-sizing: border-box` : la largeur inclut padding et bordure.', '`max-width` et `min-height` rendent les boîtes souples.', '`overflow` gère le contenu qui dépasse.'],
            'challenge' => 'Créez trois colonnes de `width: 33.333%` avec padding et bordure, côte à côte (`display: inline-block` ou `float`), qui tiennent sur une ligne grâce à `border-box`.',
            'exercises' => [
                [
                    'title' => 'Le reset box-sizing',
                    'difficulty' => 1,
                    'instructions' => 'Ajoutez en haut du CSS la règle universelle qui applique `box-sizing: border-box` à tous les éléments (sélecteur `*`). La boîte `.panneau` ne doit plus déborder de son parent.',
                    'starter_html' => '<div class="parent">
  <div class="panneau">Je fais 100 % de mon parent, padding compris.</div>
</div>',
                    'starter_css' => '.parent {
  width: 300px;
  border: 2px dashed #94a3b8;
}

.panneau {
  width: 100%;
  padding: 20px;
  background: #fde68a;
}',
                    'solution_css' => '*, *::before, *::after {
  box-sizing: border-box;
}

.parent {
  width: 300px;
  border: 2px dashed #94a3b8;
}

.panneau {
  width: 100%;
  padding: 20px;
  background: #fde68a;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '*|*, *::before, *::after|*::before|.panneau', 'prop' => 'box-sizing', 'value' => 'border-box', 'msg' => 'box-sizing: border-box est appliqué'],
                        ['t' => 'match', 're' => '\*[^{]*\{[^}]*box-sizing\s*:\s*border-box', 'in' => 'css', 'msg' => 'La règle utilise le sélecteur universel *'],
                        ['t' => 'css', 'sel' => '.panneau', 'prop' => 'width', 'value' => '100%', 'msg' => 'Le panneau garde width: 100%'],
                    ],
                    'hint' => '`*, *::before, *::after { box-sizing: border-box; }`',
                    'explanation' => 'Avec `border-box`, les 100 % incluent le padding : la boîte ne dépasse plus.',
                ],
            ],
            'quiz' => [
                ['q' => 'Avec `box-sizing: border-box`, `width: 300px; padding: 20px;` mesure…', 'a' => ['260px', '300px', '320px', '340px'], 'c' => 1, 'e' => 'La largeur déclarée inclut le padding : 300px.'],
                ['q' => 'Quelle propriété empêche une image de dépasser de son conteneur ?', 'a' => ['`width: auto`', '`max-width: 100%`', '`overflow: scroll`', '`min-width: 100%`'], 'c' => 1, 'e' => '`max-width: 100%` la limite à la largeur disponible.'],
                ['q' => 'Quelle valeur d’`overflow` affiche une barre de défilement seulement si nécessaire ?', 'a' => ['`visible`', '`hidden`', '`auto`', '`scroll`'], 'c' => 2, 'e' => '`auto` n’ajoute la barre que si le contenu dépasse.'],
                ['q' => 'Fixer une `height` sur un paragraphe est une bonne pratique.', 'tf' => true, 'c' => false, 'e' => 'Faux : le contenu risque de déborder ; préférez `min-height`.'],
            ],
        ],
    ],
];
