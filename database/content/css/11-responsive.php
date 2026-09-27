<?php
return [
    'slug' => 'css-responsive',
    'title' => 'Responsive design',
    'description' => 'Adapter les pages à tous les écrans : viewport, approche mobile first, media queries, images et typographie fluides.',
    'lessons' => [
        [
            'slug' => 'principes-responsive',
            'title' => 'Les principes du responsive design',
            'duration' => 13,
            'intro' => <<<'MD'
Plus de la moitié du trafic web mondial vient des smartphones. Un site doit donc s’afficher correctement sur un écran de 320 pixels comme sur un moniteur de 2560 pixels. Le **responsive design** n’est pas une technique unique, mais une façon de penser la mise en page.
MD,
            'objectives' => ['Comprendre les principes du responsive design', 'Adopter l’approche mobile first', 'Utiliser des mises en page fluides', 'Tester sur différentes tailles d’écran'],
            'prerequisites' => ['Flexbox', 'CSS Grid', 'Les unités CSS'],
            'theory' => <<<'MD'
## Trois ingrédients

Le responsive design (Ethan Marcotte, 2010) repose sur :

1. une **grille fluide** : des largeurs relatives (`%`, `fr`, `max-width`) plutôt que fixes ;
2. des **médias flexibles** : des images qui ne dépassent jamais leur conteneur ;
3. des **media queries** : des règles CSS appliquées selon la taille de l’écran.

## Le prérequis : la balise viewport

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

Sans elle, le mobile simule un écran de 980px et réduit la page : aucune de vos règles responsive ne fonctionnera comme prévu.

## Mobile first

On écrit d’abord le CSS pour **les petits écrans** (souvent une seule colonne, plus simple), puis on **enrichit** la mise en page pour les écrans plus larges avec des media queries `min-width`.

Avantages :

- le CSS de base est léger, idéal pour les mobiles (souvent sur des connexions plus lentes) ;
- on se concentre sur l’essentiel du contenu ;
- les ajouts pour grand écran sont progressifs.

## Les règles de base

```css
img, video { max-width: 100%; height: auto; }
.conteneur { width: min(100% - 32px, 1200px); margin-inline: auto; }
```

- **jamais** de largeur fixe supérieure à l’écran ;
- pas de **défilement horizontal** ;
- des zones cliquables d’au moins **44×44px** sur mobile ;
- un texte lisible **sans zoom** (16px minimum).

## Tester

Les outils de développement proposent un **mode appareil** (`Ctrl + Maj + M`) : testez au minimum 320, 375, 414, 768, 1024 et 1440 pixels. Rien ne remplace toutefois un test sur un vrai téléphone.

> [!TIP] Commencez par redimensionner lentement la fenêtre de votre navigateur de très large à très étroit : les points où la mise en page « casse » vous indiquent où placer vos media queries.
MD,
            'syntax' => 'img { max-width: 100%; height: auto; }
.conteneur { max-width: 1200px; margin: 0 auto; }',
            'example_html' => <<<'HTML'
<div class="conteneur">
  <h1>Page fluide</h1>
  <img src="https://placehold.co/1200x400/png?text=Image+large" alt="Bannière de démonstration" width="1200" height="400">
  <p>Réduisez la largeur de l’aperçu : l’image et le texte s’adaptent sans jamais provoquer de défilement horizontal.</p>
  <a class="btn" href="#">Bouton tactile confortable</a>
</div>
HTML,
            'example_css' => <<<'CSS'
*, *::before, *::after { box-sizing: border-box; }

body {
  margin: 0;
  font-family: system-ui, sans-serif;
  font-size: 1rem;
  line-height: 1.6;
}

.conteneur {
  width: min(100% - 32px, 900px);
  margin-inline: auto;
}

img {
  max-width: 100%;
  height: auto;
  display: block;
  border-radius: 12px;
}

.btn {
  display: inline-block;
  min-height: 44px;
  padding: 12px 20px;
  border-radius: 8px;
  background: #0f766e;
  color: white;
  text-decoration: none;
}
CSS,
            'lines' => [
                ['  width: min(100% - 32px, 900px);', 'Largeur fluide : la plus petite entre « écran moins 32px » et 900px.'],
                ['  margin-inline: auto;', 'Centré horizontalement.'],
                ['  max-width: 100%;', 'L’image ne dépasse jamais son conteneur…'],
                ['  height: auto;', '…et garde ses proportions.'],
                ['  min-height: 44px;', 'Zone tactile confortable.'],
            ],
            'reference' => [
                ['meta viewport', 'Indispensable au responsive.'],
                ['Mobile first', 'CSS de base pour mobile, enrichi avec `min-width`.'],
                ['max-width: 100%', 'Médias flexibles.'],
                ['min(), max(), clamp()', 'Fonctions de dimensionnement fluide.'],
            ],
            'mistakes' => [
                'Oublier la balise viewport.',
                'Des largeurs fixes (`width: 1000px`) qui provoquent un défilement horizontal.',
                'Des boutons minuscules sur mobile.',
                'Tester uniquement sur son propre écran.',
            ],
            'practices' => [
                'Penser mobile first.',
                'Largeurs relatives et `max-width`.',
                'Tester aux tailles clés et sur un vrai appareil.',
            ],
            'practical' => 'Google indexe en priorité la version mobile des sites (*mobile-first indexing*). Un site mal adapté au mobile est donc pénalisé dans les résultats de recherche, même pour les recherches faites sur ordinateur.',
            'summary' => ['Grille fluide + médias flexibles + media queries.', 'Viewport obligatoire.', 'Mobile first : le petit écran d’abord.', 'Pas de défilement horizontal, zones tactiles de 44px.'],
            'challenge' => 'Ouvrez le mode appareil de votre navigateur sur trois sites connus et observez comment leur navigation change entre mobile et ordinateur.',
            'exercises' => [
                [
                    'title' => 'Une image fluide',
                    'difficulty' => 1,
                    'instructions' => 'L’image déborde de son conteneur. Ajoutez une règle `img` avec `max-width: 100%` et `height: auto`.',
                    'starter_html' => '<div class="boite">
  <img src="https://placehold.co/900x300/png" alt="Paysage" width="900" height="300">
</div>',
                    'starter_css' => '.boite {
  width: 300px;
  border: 2px solid #94a3b8;
}',
                    'solution_css' => '.boite {
  width: 300px;
  border: 2px solid #94a3b8;
}

img {
  max-width: 100%;
  height: auto;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => 'img|.boite img', 'prop' => 'max-width', 'value' => '100%', 'msg' => 'img a max-width: 100%'],
                        ['t' => 'css', 'sel' => 'img|.boite img', 'prop' => 'height', 'value' => 'auto', 'msg' => 'img a height: auto'],
                    ],
                    'hint' => 'Une nouvelle règle ciblant `img`.',
                    'explanation' => '`max-width: 100%` empêche le débordement et `height: auto` conserve les proportions.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que signifie « mobile first » ?', 'a' => ['Créer uniquement une version mobile', 'Écrire d’abord le CSS pour petits écrans puis l’enrichir', 'Tester sur mobile en premier', 'Utiliser des applications mobiles'], 'c' => 1, 'e' => 'Le CSS de base cible le mobile, les media queries `min-width` enrichissent.'],
                ['q' => 'Quelle taille minimale recommandée pour une zone tactile ?', 'a' => ['16×16px', '24×24px', '44×44px', '100×100px'], 'c' => 2, 'e' => '44×44 pixels.'],
                ['q' => 'Sans balise viewport, les media queries ne se comportent pas comme prévu sur mobile.', 'tf' => true, 'c' => true, 'e' => 'Vrai : le mobile simule un écran large.'],
            ],
        ],
        [
            'slug' => 'media-queries',
            'title' => 'Les media queries',
            'duration' => 16,
            'intro' => <<<'MD'
Une colonne sur mobile, deux sur tablette, trois sur ordinateur ; un menu burger sur petit écran, une barre de navigation complète sur grand écran : les **media queries** permettent d’appliquer des règles CSS seulement lorsque certaines conditions sont réunies.
MD,
            'objectives' => ['Écrire une media query `min-width`', 'Choisir ses points de rupture', 'Utiliser les requêtes de préférences (`prefers-color-scheme`, `prefers-reduced-motion`)'],
            'prerequisites' => ['Les principes du responsive design'],
            'theory' => <<<'MD'
## La syntaxe

```css
/* Styles de base : mobile */
.grille { display: grid; gap: 16px; }

/* À partir de 768px de large */
@media (min-width: 768px) {
  .grille { grid-template-columns: 1fr 1fr; }
}

/* À partir de 1024px */
@media (min-width: 1024px) {
  .grille { grid-template-columns: repeat(3, 1fr); }
}
```

Les règles à l’intérieur de `@media` ne s’appliquent que si la condition est vraie. Elles s’ajoutent aux règles de base (la cascade s’applique normalement : placez les media queries **après** les styles de base).

## `min-width` ou `max-width` ?

- `min-width` : « à partir de » → approche **mobile first** (recommandée) ;
- `max-width` : « jusqu’à » → approche desktop first.

## Choisir les points de rupture

Ne ciblez pas des appareils précis (ils changent chaque année). Placez un point de rupture **là où votre contenu en a besoin**. Des valeurs courantes servent de repères : **480px, 768px, 1024px, 1280px**.

## Combiner des conditions

```css
@media (min-width: 768px) and (max-width: 1023px) { … } /* tablettes uniquement */
@media (orientation: landscape) { … }
@media print { … }                                     /* impression */
```

## Les préférences de l’utilisateur

```css
@media (prefers-color-scheme: dark) {
  body { background: #0f172a; color: #e2e8f0; }
}

@media (prefers-reduced-motion: reduce) {
  * { animation: none !important; transition: none !important; }
}
```

Ces requêtes respectent les réglages du système : thème sombre, réduction des animations (important pour les personnes sujettes aux vertiges ou aux crises d’épilepsie).

> [!INFO] Cette plateforme respecte `prefers-reduced-motion` et propose en plus un interrupteur « Réduire les animations » dans le pied de page.
MD,
            'syntax' => '@media (min-width: 768px) {
  .selecteur { … }
}',
            'example_html' => <<<'HTML'
<header class="entete">
  <strong>Mon site</strong>
  <nav class="nav"><a href="#">Accueil</a><a href="#">Blog</a><a href="#">Contact</a></nav>
</header>
<main class="grille">
  <article class="carte">Article 1</article>
  <article class="carte">Article 2</article>
  <article class="carte">Article 3</article>
</main>
HTML,
            'example_css' => <<<'CSS'
body { margin: 0; font-family: system-ui, sans-serif; }

/* Mobile : tout est empilé */
.entete { display: flex; flex-direction: column; gap: 8px; padding: 12px; background: #1e293b; color: white; }
.nav { display: flex; gap: 12px; }
.nav a { color: #cbd5e1; }
.grille { display: grid; gap: 12px; padding: 12px; }
.carte { padding: 24px; border-radius: 10px; background: #e0e7ff; }

/* Tablette */
@media (min-width: 600px) {
  .entete { flex-direction: row; justify-content: space-between; align-items: center; }
  .grille { grid-template-columns: 1fr 1fr; }
}

/* Ordinateur */
@media (min-width: 900px) {
  .grille { grid-template-columns: repeat(3, 1fr); }
}

@media (prefers-color-scheme: dark) {
  .carte { background: #312e81; color: white; }
}
CSS,
            'lines' => [
                ['/* Mobile : tout est empilé */', 'Les styles de base concernent les petits écrans.'],
                ['@media (min-width: 600px) {', 'À partir de 600px…'],
                ['  .entete { flex-direction: row; … }', '…l’en-tête passe sur une ligne.'],
                ['  .grille { grid-template-columns: 1fr 1fr; }', '…et la grille passe à 2 colonnes.'],
                ['@media (min-width: 900px) {', 'À partir de 900px : 3 colonnes.'],
                ['@media (prefers-color-scheme: dark) {', 'Cartes adaptées au thème sombre du système.'],
            ],
            'reference' => [
                ['@media (min-width: …)', 'À partir d’une largeur.'],
                ['@media (max-width: …)', 'Jusqu’à une largeur.'],
                ['and', 'Combine des conditions.'],
                ['print', 'Styles d’impression.'],
                ['prefers-color-scheme', 'Thème clair/sombre du système.'],
                ['prefers-reduced-motion', 'Préférence de réduction des animations.'],
            ],
            'mistakes' => [
                'Placer les media queries avant les styles de base (elles sont écrasées).',
                'Multiplier les points de rupture pour chaque modèle de téléphone.',
                'Oublier les parenthèses : `@media min-width: 768px`.',
                'Mélanger `min-width` et `max-width` sans logique.',
            ],
            'practices' => [
                'Mobile first avec `min-width`.',
                'Des points de rupture dictés par le contenu.',
                'Respecter `prefers-reduced-motion`.',
            ],
            'practical' => 'Le menu de cette plateforme devient un menu plein écran activé par un bouton burger sous 900px : c’est une media query qui change son `position`, sa `transform` et l’affichage du bouton.',
            'summary' => ['`@media (min-width: X) { … }` applique des règles à partir de X.', 'Mobile first + points de rupture selon le contenu.', 'Respectez les préférences système (thème, animations).'],
            'challenge' => 'Créez une galerie qui affiche 1, 2, 3 puis 4 colonnes selon la largeur, et une feuille d’impression qui masque la navigation.',
            'exercises' => [
                [
                    'title' => 'Deux colonnes sur grand écran',
                    'difficulty' => 2,
                    'instructions' => 'La grille `.colonnes` affiche une colonne. Ajoutez une media query `(min-width: 700px)` qui lui donne `grid-template-columns: 1fr 1fr`.',
                    'starter_html' => '<div class="colonnes">
  <div class="bloc">Gauche</div>
  <div class="bloc">Droite</div>
</div>',
                    'starter_css' => '.colonnes {
  display: grid;
  gap: 12px;
}

.bloc {
  padding: 24px;
  background: #fce7f3;
}',
                    'solution_css' => '.colonnes {
  display: grid;
  gap: 12px;
}

.bloc {
  padding: 24px;
  background: #fce7f3;
}

@media (min-width: 700px) {
  .colonnes {
    grid-template-columns: 1fr 1fr;
  }
}',
                    'rules' => [
                        ['t' => 'match', 're' => '@media\s*\(\s*min-width\s*:\s*700px\s*\)', 'in' => 'css', 'msg' => 'Une media query (min-width: 700px)'],
                        ['t' => 'match', 're' => '@media[^{]*\{\s*\.colonnes\s*\{[^}]*grid-template-columns\s*:\s*(1fr 1fr|repeat\(2,\s*1fr\))', 'in' => 'css', 'msg' => '.colonnes passe à 2 colonnes dans la media query'],
                    ],
                    'hint' => '`@media (min-width: 700px) { .colonnes { … } }`',
                    'explanation' => 'La règle n’est appliquée qu’à partir de 700px : sur mobile, la grille reste en une colonne.',
                ],
                [
                    'title' => 'Respecter les préférences',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Quelle media query détecte que l’utilisateur souhaite moins d’animations ?',
                    'answers' => ['`@media (no-animation)`', '`@media (prefers-reduced-motion: reduce)`', '`@media (motion: off)`', '`@media (reduced)`'],
                    'correct' => 1,
                    'explanation' => '`prefers-reduced-motion: reduce`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle media query correspond à l’approche mobile first ?', 'a' => ['`max-width`', '`min-width`', '`orientation`', '`print`'], 'c' => 1, 'e' => '`min-width` enrichit progressivement.'],
                ['q' => 'Où placer les media queries dans la feuille de style ?', 'a' => ['Avant les styles de base', 'Après les styles de base', 'Dans le HTML', 'Peu importe'], 'c' => 1, 'e' => 'Après, pour surcharger les styles de base grâce à la cascade.'],
                ['q' => 'Les points de rupture doivent correspondre exactement aux modèles de téléphones récents.', 'tf' => true, 'c' => false, 'e' => 'Faux : ils dépendent du contenu.'],
            ],
        ],
        [
            'slug' => 'typographie-et-images-fluides',
            'title' => 'Typographie fluide et images responsives',
            'duration' => 14,
            'intro' => <<<'MD'
Un titre de 48px est magnifique sur ordinateur… et écrase tout sur un téléphone. Plutôt que d’ajouter une media query pour chaque taille, la fonction `clamp()` crée une typographie qui **s’adapte en continu**. Et `object-fit` règle le cadrage des images dans des zones de taille variable.
MD,
            'objectives' => ['Utiliser `clamp()` pour une typographie fluide', 'Cadrer une image avec `object-fit` et `aspect-ratio`', 'Combiner ces techniques'],
            'prerequisites' => ['Les media queries'],
            'theory' => <<<'MD'
## `clamp(minimum, idéal, maximum)`

```css
h1 { font-size: clamp(1.75rem, 1rem + 3vw, 3.5rem); }
```

- la taille ne descend jamais sous **1.75rem** ;
- elle vaut idéalement **1rem + 3vw** (elle grandit avec la largeur de l’écran) ;
- elle ne dépasse jamais **3.5rem**.

Le mélange `rem + vw` conserve un lien avec la taille de police de l’utilisateur (accessibilité) tout en suivant l’écran. `clamp()` fonctionne aussi pour les espacements :

```css
.section { padding-block: clamp(2rem, 5vw, 6rem); }
```

## `aspect-ratio`

Fixe les proportions d’une boîte, quelle que soit sa largeur :

```css
.video { aspect-ratio: 16 / 9; width: 100%; }
.avatar { aspect-ratio: 1; }
```

## `object-fit`

Quand une image doit remplir une zone aux proportions différentes des siennes :

| Valeur | Effet |
|---|---|
| `fill` | Déformée pour remplir (défaut) |
| `cover` | Remplit la zone, rognée si besoin |
| `contain` | Entièrement visible, bandes vides possibles |

```css
.vignette img {
  width: 100%;
  aspect-ratio: 4 / 3;
  object-fit: cover;
}
```

`object-position: top;` choisit la partie conservée lors du rognage (utile pour les portraits).

> [!TIP] Des vignettes aux dimensions **identiques** rendent une grille de cartes bien plus harmonieuse, même si les photos d’origine ont des formats variés.
MD,
            'syntax' => 'font-size: clamp(1.5rem, 1rem + 2vw, 3rem);
aspect-ratio: 16 / 9;
object-fit: cover;',
            'example_html' => <<<'HTML'
<section class="hero">
  <h1>Typographie fluide</h1>
  <p>Redimensionnez l’aperçu : le titre grandit et rétrécit en douceur.</p>
</section>
<div class="galerie">
  <img src="https://placehold.co/600x900/png?text=Portrait" alt="Photo portrait recadrée">
  <img src="https://placehold.co/900x500/png?text=Paysage" alt="Photo paysage recadrée">
  <img src="https://placehold.co/500x500/png?text=Carr%C3%A9" alt="Photo carrée">
</div>
HTML,
            'example_css' => <<<'CSS'
body { margin: 0; font-family: system-ui, sans-serif; }

.hero {
  padding: clamp(1.5rem, 5vw, 4rem);
  background: #ecfccb;
}

.hero h1 {
  margin: 0;
  font-size: clamp(1.75rem, 1rem + 4vw, 4rem);
  line-height: 1.1;
}

.galerie {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
  gap: 8px;
  padding: 8px;
}

.galerie img {
  width: 100%;
  aspect-ratio: 4 / 3;
  object-fit: cover;
  border-radius: 8px;
}
CSS,
            'lines' => [
                ['  padding: clamp(1.5rem, 5vw, 4rem);', 'Espacement fluide, borné.'],
                ['  font-size: clamp(1.75rem, 1rem + 4vw, 4rem);', 'Titre fluide entre 1.75rem et 4rem.'],
                ['  aspect-ratio: 4 / 3;', 'Toutes les vignettes ont les mêmes proportions…'],
                ['  object-fit: cover;', '…et les images les remplissent sans déformation.'],
            ],
            'reference' => [
                ['clamp(min, idéal, max)', 'Valeur fluide bornée.'],
                ['aspect-ratio', 'Proportions d’une boîte.'],
                ['object-fit', 'Ajustement d’une image dans sa boîte.'],
                ['object-position', 'Partie de l’image conservée.'],
            ],
            'mistakes' => [
                'Utiliser uniquement `vw` pour la taille du texte (ignore le zoom de l’utilisateur).',
                'Oublier les bornes : un texte trop grand sur écran géant.',
                'Déformer des images avec `width` et `height` fixes sans `object-fit`.',
            ],
            'practices' => [
                '`clamp()` avec `rem + vw` pour les titres.',
                '`aspect-ratio` + `object-fit: cover` pour les vignettes.',
                'Tester le zoom navigateur à 200 %.',
            ],
            'practical' => 'Les titres de la page d’accueil de cette plateforme utilisent `clamp()` : ils passent en douceur de 2.2rem sur mobile à 4rem sur grand écran, sans aucune media query.',
            'summary' => ['`clamp()` : typographie et espacements fluides.', '`aspect-ratio` fixe les proportions.', '`object-fit: cover` remplit sans déformer.'],
            'challenge' => 'Créez une grille de profils d’équipe avec des photos de formats variés, toutes affichées en carré parfait avec le visage conservé (`object-position: top`).',
            'exercises' => [
                [
                    'title' => 'Un titre fluide',
                    'difficulty' => 2,
                    'instructions' => 'Donnez au `h1` une taille fluide : `font-size: clamp(2rem, 5vw, 4rem)`.',
                    'starter_html' => '<h1>Titre adaptable</h1>',
                    'solution_css' => 'h1 {
  font-size: clamp(2rem, 5vw, 4rem);
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => 'h1', 'prop' => 'font-size', 'value' => 'clamp(2rem, 5vw, 4rem)', 'msg' => 'font-size: clamp(2rem, 5vw, 4rem)'],
                    ],
                    'hint' => 'Recopiez la fonction avec ses trois valeurs séparées par des virgules.',
                    'explanation' => 'Le titre suit la largeur de l’écran (5vw) sans descendre sous 2rem ni dépasser 4rem.',
                ],
                [
                    'title' => 'Des vignettes sans déformation',
                    'difficulty' => 2,
                    'instructions' => 'Les images sont déformées. Ajoutez `object-fit: cover` à `.vignette`.',
                    'starter_html' => '<img class="vignette" src="https://placehold.co/800x400/png" alt="Vignette">',
                    'starter_css' => '.vignette {
  width: 200px;
  height: 200px;
}',
                    'solution_css' => '.vignette {
  width: 200px;
  height: 200px;
  object-fit: cover;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.vignette|img.vignette', 'prop' => 'object-fit', 'value' => 'cover', 'msg' => 'object-fit: cover'],
                    ],
                    'hint' => 'Une seule propriété.',
                    'explanation' => '`cover` remplit le carré en rognant l’image au lieu de la déformer.',
                ],
            ],
            'quiz' => [
                ['q' => 'Dans `clamp(1rem, 3vw, 2rem)`, que vaut le maximum ?', 'a' => ['1rem', '3vw', '2rem', 'Aucun'], 'c' => 2, 'e' => 'Le troisième argument est le maximum.'],
                ['q' => 'Quelle valeur d’`object-fit` remplit la zone en rognant l’image ?', 'a' => ['`fill`', '`contain`', '`cover`', '`none`'], 'c' => 2, 'e' => '`cover`.'],
                ['q' => '`aspect-ratio: 16 / 9` garde les proportions quelle que soit la largeur.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
    ],
];
