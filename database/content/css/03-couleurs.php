<?php
return [
    'slug' => 'css-couleurs-arriere-plans',
    'title' => 'Couleurs et arrière-plans',
    'description' => 'Les formats de couleur (nom, hexadécimal, RGB, HSL, transparence) et les arrière-plans (couleur, image, taille, position).',
    'lessons' => [
        [
            'slug' => 'les-couleurs-css',
            'title' => 'Les couleurs en CSS',
            'duration' => 15,
            'intro' => <<<'MD'
Les couleurs sont souvent la première chose que l’on remarque sur un site. CSS propose plusieurs notations : noms, hexadécimal, RGB, HSL. Elles décrivent toutes les mêmes couleurs, mais chacune a ses avantages. Vous apprendrez aussi à vérifier qu’une couleur de texte reste **lisible** pour tous.
MD,
            'objectives' => ['Utiliser les noms de couleurs, l’hexadécimal, `rgb()` et `hsl()`', 'Gérer la transparence', 'Comprendre le contraste et l’accessibilité'],
            'prerequisites' => ['Les sélecteurs'],
            'theory' => <<<'MD'
## Où utilise-t-on les couleurs ?

`color` (texte), `background-color` (fond), `border-color` (bordure), mais aussi les ombres, dégradés, soulignements…

## 1. Les noms de couleurs

CSS reconnaît environ 140 noms : `red`, `navy`, `tomato`, `gold`, `rebeccapurple`… Pratiques pour tester, trop limités pour un vrai design.

## 2. L’hexadécimal

`#RRVVBB` : trois paires de chiffres hexadécimaux (0 à 9 puis a à f) pour le **rouge**, le **vert** et le **bleu**, de `00` (rien) à `ff` (maximum).

```css
color: #ff0000; /* rouge pur */
color: #1e293b; /* bleu ardoise très foncé */
color: #fff;    /* forme courte de #ffffff : blanc */
```

C’est le format le plus répandu : c’est celui que donnent les logiciels de design (Figma, Photoshop).

## 3. `rgb()`

Les mêmes composantes, en nombres de 0 à 255 :

```css
color: rgb(255 0 0);        /* rouge */
color: rgb(0 0 0 / 50%);    /* noir à 50 % d’opacité */
```

L’ancienne syntaxe `rgba(0, 0, 0, 0.5)` avec des virgules fonctionne toujours.

## 4. `hsl()` : la plus intuitive

- **H**ue (teinte) : un angle sur le cercle chromatique, de 0 à 360 (0 = rouge, 120 = vert, 240 = bleu) ;
- **S**aturation : de 0 % (gris) à 100 % (couleur vive) ;
- **L**ightness (luminosité) : de 0 % (noir) à 100 % (blanc).

```css
background: hsl(220 90% 50%);  /* bleu vif */
background: hsl(220 90% 90%);  /* même bleu, très clair */
```

Idéal pour créer des variantes d’une même couleur : il suffit de changer la luminosité.

## La transparence

- `opacity: 0.5;` rend **tout l’élément** transparent (texte et enfants compris) ;
- une couleur avec canal alpha (`rgb(0 0 0 / 50%)`) ne rend transparente **que cette couleur**.

## Le contraste : une question d’accessibilité

Un texte gris clair sur fond blanc est illisible pour beaucoup de personnes (vue faible, écran au soleil…). Les règles **WCAG** demandent un **rapport de contraste** d’au moins **4,5:1** pour le texte courant (3:1 pour les grands textes).

> [!TIP] Vérifiez vos couleurs avec un outil comme le *Contrast Checker* de WebAIM ou directement dans les outils de développement (sélecteur de couleur → ratio de contraste).
MD,
            'syntax' => 'color: tomato;
color: #ff6347;
color: rgb(255 99 71);
color: hsl(9 100% 64%);',
            'example_html' => <<<'HTML'
<div class="carte">
  <h2>Formats de couleur</h2>
  <p class="nom">Nom : tomato</p>
  <p class="hexa">Hexadécimal : #0ea5e9</p>
  <p class="rgb">RGB : rgb(22 163 74)</p>
  <p class="hsl">HSL : hsl(270 70% 50%)</p>
  <p class="alpha">Fond noir à 60 % d’opacité</p>
</div>
HTML,
            'example_css' => <<<'CSS'
.carte {
  background-color: #f8fafc;
  color: #0f172a;
  padding: 16px;
  font-family: system-ui, sans-serif;
}

.nom   { color: tomato; }
.hexa  { color: #0ea5e9; }
.rgb   { color: rgb(22 163 74); }
.hsl   { color: hsl(270 70% 50%); }

.alpha {
  background-color: rgb(0 0 0 / 60%);
  color: white;
  padding: 8px;
}
CSS,
            'lines' => [
                ['  background-color: #f8fafc;', 'Fond presque blanc en hexadécimal.'],
                ['  color: #0f172a;', 'Texte presque noir : contraste élevé.'],
                ['.nom   { color: tomato; }', 'Nom de couleur prédéfini.'],
                ['.rgb   { color: rgb(22 163 74); }', 'Vert défini par ses composantes rouge, vert, bleu.'],
                ['.hsl   { color: hsl(270 70% 50%); }', 'Violet : teinte 270°, saturation 70 %, luminosité 50 %.'],
                ['  background-color: rgb(0 0 0 / 60%);', 'Noir semi-transparent : seul le fond est transparent, pas le texte.'],
            ],
            'reference' => [
                ['color', 'Couleur du texte (héritée).'],
                ['background-color', 'Couleur de fond (non héritée).'],
                ['#rrggbb', 'Notation hexadécimale.'],
                ['rgb(r g b / a)', 'Rouge, vert, bleu (0-255) et opacité.'],
                ['hsl(h s l / a)', 'Teinte (0-360), saturation et luminosité (%).'],
                ['opacity', 'Opacité de tout l’élément, de 0 à 1.'],
                ['currentColor', 'Mot-clé : la valeur actuelle de `color`.'],
            ],
            'mistakes' => [
                'Oublier le `#` : `color: ff0000;` est invalide.',
                'Utiliser `opacity` pour un fond transparent : le texte devient transparent aussi.',
                'Choisir des couleurs trop peu contrastées (gris clair sur blanc).',
                'Transmettre une information uniquement par la couleur (« les champs en rouge sont obligatoires »).',
            ],
            'practices' => [
                'Définir une palette limitée (3 à 5 couleurs) et s’y tenir.',
                'Vérifier le contraste de chaque couple texte/fond.',
                'Utiliser HSL pour créer des variantes claires/foncées.',
            ],
            'practical' => 'Une charte graphique fournit généralement les couleurs en hexadécimal. L’intégrateur les déclare une fois (en variables CSS, niveau 3) : `--couleur-primaire: #4f46e5;`, puis décline des variantes (survol plus foncé, fond plus clair).',
            'summary' => ['Quatre notations : nom, `#hex`, `rgb()`, `hsl()`.', 'Transparence : canal alpha (couleur) ou `opacity` (élément entier).', 'Contraste minimum 4,5:1 pour le texte.'],
            'challenge' => 'Créez une palette de 5 nuances d’un même bleu en HSL (luminosité 20 %, 35 %, 50 %, 70 %, 90 %) affichées dans 5 blocs.',
            'exercises' => [
                [
                    'title' => 'Un bandeau d’alerte',
                    'difficulty' => 1,
                    'instructions' => 'Stylisez `.alerte` : fond `#fee2e2` (propriété `background-color`) et texte `#991b1b` (propriété `color`).',
                    'starter_html' => '<p class="alerte">Votre session va bientôt expirer.</p>',
                    'solution_css' => '.alerte {
  background-color: #fee2e2;
  color: #991b1b;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.alerte|p.alerte', 'prop' => 'background-color|background', 'value' => '#fee2e2', 'msg' => 'Le fond vaut #fee2e2'],
                        ['t' => 'css', 'sel' => '.alerte|p.alerte', 'prop' => 'color', 'value' => '#991b1b', 'msg' => 'Le texte vaut #991b1b'],
                    ],
                    'hint' => 'Deux déclarations dans la même règle `.alerte { … }`.',
                    'explanation' => '`background-color` colore le fond, `color` le texte : ce couple rouge clair / rouge foncé offre un bon contraste.',
                ],
                [
                    'title' => 'Fond semi-transparent',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Comment rendre **uniquement le fond** d’un élément semi-transparent, sans affecter son texte ?',
                    'answers' => ['`opacity: 0.5;`', '`background-color: rgb(0 0 0 / 50%);`', '`color: transparent;`', '`visibility: 50%;`'],
                    'correct' => 1,
                    'explanation' => 'Le canal alpha de la couleur de fond ne touche que le fond ; `opacity` rend tout l’élément transparent.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que représente `#000000` ?', 'a' => ['Blanc', 'Noir', 'Rouge', 'Transparent'], 'c' => 1, 'e' => 'Toutes les composantes à 0 : noir.'],
                ['q' => 'Dans `hsl(120 100% 50%)`, que vaut la teinte 120 ?', 'a' => ['Rouge', 'Vert', 'Bleu', 'Jaune'], 'c' => 1, 'e' => '0 = rouge, 120 = vert, 240 = bleu.'],
                ['q' => 'Quel ratio de contraste minimum est recommandé pour du texte courant ?', 'a' => ['1:1', '2:1', '4,5:1', '21:1'], 'c' => 2, 'e' => 'WCAG niveau AA : 4,5:1 pour le texte courant.'],
                ['q' => '`opacity: 0.5` rend aussi le texte de l’élément transparent.', 'tf' => true, 'c' => true, 'e' => 'Vrai : `opacity` s’applique à tout l’élément et à ses enfants.'],
            ],
        ],
        [
            'slug' => 'arriere-plans',
            'title' => 'Les arrière-plans',
            'duration' => 15,
            'intro' => <<<'MD'
Un bandeau avec une photo en fond, un motif discret, un visuel qui couvre tout l’écran… Les propriétés `background-*` permettent tout cela. Bien utilisées, elles rendent une page vivante ; mal utilisées, elles rendent le texte illisible. Voyons comment les maîtriser.
MD,
            'objectives' => ['Ajouter une image de fond', 'Contrôler la répétition, la taille et la position', 'Utiliser la propriété raccourcie `background`', 'Garantir la lisibilité du texte'],
            'prerequisites' => ['Les couleurs en CSS'],
            'theory' => <<<'MD'
## Les propriétés d’arrière-plan

| Propriété | Rôle | Valeurs courantes |
|---|---|---|
| `background-color` | Couleur de fond | toute couleur |
| `background-image` | Image de fond | `url("image.jpg")`, dégradés |
| `background-repeat` | Répétition | `repeat`, `no-repeat`, `repeat-x` |
| `background-size` | Taille | `cover`, `contain`, `100px auto` |
| `background-position` | Position | `center`, `top right`, `50% 20%` |
| `background-attachment` | Défilement | `scroll`, `fixed` |

## `cover` ou `contain` ?

- `cover` : l’image **couvre toute la zone**, quitte à être rognée. Parfait pour une bannière.
- `contain` : l’image est **entièrement visible**, quitte à laisser des vides.

## La propriété raccourcie

```css
.banniere {
  background: #1e293b url("montagne.jpg") center / cover no-repeat;
}
```

L’ordre est souple, mais `taille` doit suivre `position` avec une barre oblique : `center / cover`.

## Image de fond ou balise `<img>` ?

- Une image qui fait **partie du contenu** (photo d’un produit, illustration d’un article) → `<img>` avec un `alt`.
- Une image **décorative** (texture, ambiance derrière un titre) → `background-image`.

Les images de fond n’ont pas de texte alternatif : les lecteurs d’écran les ignorent.

## Lisibilité du texte sur une image

Une photo contient des zones claires et foncées : le texte peut devenir illisible. Solution classique : superposer un **voile** sombre grâce à un dégradé :

```css
background:
  linear-gradient(rgb(0 0 0 / 55%), rgb(0 0 0 / 55%)),
  url("photo.jpg") center / cover;
```

Et toujours définir une `background-color` de secours, affichée pendant le chargement ou si l’image est absente.
MD,
            'syntax' => 'background: couleur url("image.jpg") position / taille répétition;',
            'example_html' => <<<'HTML'
<header class="banniere">
  <h1>Randonnée dans les Alpes</h1>
  <p>Trois jours entre lacs et sommets.</p>
</header>
<section class="motif">
  <p>Section avec un motif de points répété.</p>
</section>
HTML,
            'example_css' => <<<'CSS'
.banniere {
  padding: 60px 24px;
  color: white;
  text-align: center;
  background-color: #1e293b;
  background-image:
    linear-gradient(rgb(0 0 0 / 50%), rgb(0 0 0 / 50%)),
    url("https://placehold.co/1200x500/png?text=Montagnes");
  background-size: cover;
  background-position: center;
}

.motif {
  padding: 32px;
  background-color: #fefce8;
  background-image: radial-gradient(#facc15 2px, transparent 2px);
  background-size: 20px 20px;
}
CSS,
            'lines' => [
                ['  background-color: #1e293b;', 'Couleur de secours pendant le chargement de l’image.'],
                ['  background-image: linear-gradient(…), url(…);', 'Deux couches : un voile sombre semi-transparent PAR-DESSUS la photo.'],
                ['  background-size: cover;', 'L’image couvre toute la bannière.'],
                ['  background-position: center;', 'L’image est centrée : les bords sont rognés en priorité.'],
                ['  background-image: radial-gradient(…);', 'Un petit dégradé circulaire sert de motif (pas besoin de fichier image).'],
                ['  background-size: 20px 20px;', 'Le motif mesure 20×20 px et se répète.'],
            ],
            'reference' => [
                ['background-image', 'Une ou plusieurs images de fond (la première est au-dessus).'],
                ['background-size', '`cover`, `contain` ou dimensions.'],
                ['background-position', 'Position de l’image dans la zone.'],
                ['background-repeat', 'Répétition de l’image.'],
                ['background', 'Propriété raccourcie qui regroupe toutes les autres.'],
            ],
            'mistakes' => [
                'Oublier `url()` ou les guillemets autour du chemin.',
                'Se tromper de chemin relatif (il est relatif au fichier CSS, pas au HTML).',
                'Placer une information importante dans une image de fond (inaccessible).',
                'Mettre du texte blanc sur une photo claire sans voile.',
                'Écrire `background` après `background-image` : la propriété raccourcie réinitialise l’image.',
            ],
            'practices' => [
                'Toujours prévoir une `background-color` de secours.',
                'Utiliser `cover` + `center` pour les bannières.',
                'Réserver les images de fond à la décoration.',
                'Optimiser le poids des images (WebP, compression).',
            ],
            'practical' => 'La section « héro » en haut des sites vitrines utilise presque toujours une image de fond en `cover` avec un voile dégradé et un titre centré : c’est exactement l’exemple de cette leçon.',
            'summary' => ['`background-image: url(…)` ajoute une image de fond.', '`cover` couvre, `contain` montre tout.', 'Un voile en dégradé assure la lisibilité.', 'Image de contenu → `<img>` ; décoration → background.'],
            'challenge' => 'Créez une bannière pleine largeur de 300 px de haut avec une image de fond, un voile bleu semi-transparent et un titre centré.',
            'exercises' => [
                [
                    'title' => 'Une bannière avec image',
                    'difficulty' => 2,
                    'instructions' => 'Stylisez `.hero` : une image de fond `url("https://placehold.co/800x300/png")`, qui **couvre** toute la zone (`background-size`), **centrée** (`background-position`) et **sans répétition**.',
                    'starter_html' => '<section class="hero">
  <h1>Bienvenue</h1>
</section>',
                    'starter_css' => '.hero {
  padding: 80px 20px;
  color: white;
}
',
                    'solution_css' => '.hero {
  padding: 80px 20px;
  color: white;
  background-image: url("https://placehold.co/800x300/png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}',
                    'rules' => [
                        ['t' => 'match', 're' => 'background(-image)?\s*:[^;]*url\(', 'in' => 'css', 'msg' => 'Une image de fond est définie avec url()'],
                        ['t' => 'match', 're' => '(background-size\s*:\s*cover)|(/\s*cover)', 'in' => 'css', 'msg' => 'L’image couvre la zone (cover)'],
                        ['t' => 'match', 're' => '(background-position\s*:\s*center)|(center\s*/)', 'in' => 'css', 'msg' => 'L’image est centrée'],
                        ['t' => 'match', 're' => 'no-repeat', 'in' => 'css', 'msg' => 'L’image ne se répète pas'],
                    ],
                    'hint' => 'Quatre propriétés : `background-image`, `background-size`, `background-position`, `background-repeat`.',
                    'explanation' => '`cover` remplit la zone, `center` garde le centre visible, `no-repeat` empêche la répétition.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle valeur de `background-size` remplit toute la zone quitte à rogner l’image ?', 'a' => ['`contain`', '`cover`', '`auto`', '`fill`'], 'c' => 1, 'e' => '`cover` couvre toute la zone.'],
                ['q' => 'Une photo de produit dans une boutique doit être…', 'a' => ['une image de fond', 'une balise `<img>` avec alt', 'un dégradé', 'un commentaire'], 'c' => 1, 'e' => 'C’est un contenu : `<img>` avec un texte alternatif.'],
                ['q' => 'Avec plusieurs images de fond, la première listée est affichée au-dessus.', 'tf' => true, 'c' => true, 'e' => 'Vrai : c’est pourquoi le voile dégradé est écrit avant la photo.'],
            ],
        ],
    ],
];
