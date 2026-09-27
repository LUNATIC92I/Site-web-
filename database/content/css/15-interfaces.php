<?php
return [
    'slug' => 'css-interfaces-modernes',
    'title' => 'Interfaces modernes et bonnes pratiques',
    'description' => 'Assembler toutes les notions pour construire des composants d’interface soignés, performants et accessibles.',
    'lessons' => [
        [
            'slug' => 'creer-un-composant-carte',
            'title' => 'Créer un composant carte complet',
            'duration' => 18,
            'intro' => <<<'MD'
La **carte** est le composant roi des interfaces modernes : produit, article, profil, offre tarifaire… Construire une carte de A à Z mobilise presque tout ce que vous avez appris : HTML sémantique, box model, Flexbox, variables, ombres, transitions, responsive et accessibilité. C’est le moment de tout assembler.
MD,
            'objectives' => ['Concevoir la structure HTML d’un composant', 'Styler un composant réutilisable avec variables et BEM', 'Rendre toute la carte cliquable de façon accessible', 'Ajouter des états interactifs soignés'],
            'prerequisites' => ['Toutes les leçons CSS précédentes'],
            'theory' => <<<'MD'
## 1. La structure HTML

```html
<article class="carte">
  <img class="carte__image" src="…" alt="…">
  <div class="carte__corps">
    <p class="carte__categorie">Tutoriel</p>
    <h3 class="carte__titre"><a href="…">Maîtriser Flexbox</a></h3>
    <p class="carte__resume">…</p>
    <p class="carte__meta">12 min de lecture</p>
  </div>
</article>
```

- `<article>` : la carte est un contenu autonome ;
- le lien est placé **sur le titre** (un texte explicite) plutôt qu’autour de toute la carte.

## 2. Toute la carte cliquable… proprement

On étend la zone cliquable du lien à toute la carte avec un pseudo-élément :

```css
.carte { position: relative; }
.carte__titre a::after {
  content: "";
  position: absolute;
  inset: 0;
}
```

Le lecteur d’écran annonce un seul lien au texte clair, et la souris peut cliquer n’importe où.

## 3. Mise en page interne

Flexbox en colonne, et `margin-top: auto` sur la méta pour la coller en bas, même si les résumés ont des longueurs différentes :

```css
.carte { display: flex; flex-direction: column; }
.carte__corps { display: flex; flex-direction: column; flex: 1; }
.carte__meta { margin-top: auto; }
```

## 4. Les états

- survol : légère élévation (`transform` + `box-shadow`) ;
- focus clavier : `.carte:focus-within` affiche un contour quand le lien a le focus.

## 5. Les images

`aspect-ratio` + `object-fit: cover` : toutes les cartes ont la même hauteur d’image.

## 6. La grille

```css
.grille { display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 260px), 1fr)); gap: 1.5rem; }
```

> [!TIP] Un composant bien conçu fonctionne **quel que soit son contenu** : titre très long, pas d’image, résumé vide. Testez ces cas limites.
MD,
            'syntax' => '.carte { position: relative; display: flex; flex-direction: column; }
.carte__titre a::after { content: ""; position: absolute; inset: 0; }
.carte:focus-within { outline: 3px solid …; }',
            'example_html' => <<<'HTML'
<section class="grille">
  <article class="carte">
    <img class="carte__image" src="https://placehold.co/600x400/png?text=Flexbox" alt="">
    <div class="carte__corps">
      <p class="carte__categorie">Tutoriel</p>
      <h3 class="carte__titre"><a href="#">Maîtriser Flexbox en 10 exemples</a></h3>
      <p class="carte__resume">Alignements, espacements et grilles souples expliqués pas à pas.</p>
      <p class="carte__meta">12 min de lecture</p>
    </div>
  </article>
  <article class="carte">
    <img class="carte__image" src="https://placehold.co/600x400/png?text=Grid" alt="">
    <div class="carte__corps">
      <p class="carte__categorie">Guide</p>
      <h3 class="carte__titre"><a href="#">CSS Grid : le guide complet</a></h3>
      <p class="carte__resume">Des zones nommées aux grilles adaptatives.</p>
      <p class="carte__meta">20 min de lecture</p>
    </div>
  </article>
</section>
HTML,
            'example_css' => <<<'CSS'
:root {
  --c-accent: #7c3aed;
  --rayon: 16px;
}

body { font-family: system-ui, sans-serif; background: #f8fafc; padding: 16px; }

.grille {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr));
  gap: 1.5rem;
}

.carte {
  position: relative;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  border-radius: var(--rayon);
  background: white;
  box-shadow: 0 2px 8px rgb(15 23 42 / 8%);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.carte:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 28px rgb(15 23 42 / 14%);
}

.carte:focus-within {
  outline: 3px solid var(--c-accent);
  outline-offset: 2px;
}

.carte__image {
  width: 100%;
  aspect-ratio: 3 / 2;
  object-fit: cover;
}

.carte__corps {
  display: flex;
  flex-direction: column;
  flex: 1;
  gap: 0.4rem;
  padding: 1.25rem;
}

.carte__corps p { margin: 0; }
.carte__categorie { color: var(--c-accent); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; }
.carte__titre { margin: 0; font-size: 1.15rem; }
.carte__titre a { color: #0f172a; text-decoration: none; }
.carte__titre a:focus { outline: none; }
.carte__titre a::after { content: ""; position: absolute; inset: 0; }
.carte__resume { color: #475569; }
.carte__meta { margin-top: auto !important; padding-top: 0.5rem; color: #94a3b8; font-size: 0.85rem; }

@media (prefers-reduced-motion: reduce) {
  .carte { transition: none; }
}
CSS,
            'lines' => [
                ['  position: relative;', 'Repère pour le pseudo-élément qui étend le lien.'],
                ['  display: flex; flex-direction: column;', 'Contenu empilé verticalement.'],
                ['.carte:focus-within {', 'Contour visible quand le lien interne a le focus clavier.'],
                ['  aspect-ratio: 3 / 2; object-fit: cover;', 'Images homogènes quelles que soient leurs proportions.'],
                ['.carte__titre a::after { content: ""; position: absolute; inset: 0; }', 'La zone cliquable du lien couvre toute la carte.'],
                ['.carte__meta { margin-top: auto … }', 'La méta est poussée en bas de la carte.'],
                ['@media (prefers-reduced-motion: reduce)', 'Pas d’animation pour ceux qui ne le souhaitent pas.'],
            ],
            'reference' => [
                [':focus-within', 'L’élément ou un de ses descendants a le focus.'],
                ['inset: 0', 'Couvre tout le parent positionné.'],
                ['margin-top: auto', 'Pousse un élément flex vers le bas.'],
            ],
            'mistakes' => [
                'Envelopper toute la carte dans un `<a>` contenant titres et paragraphes : le lecteur d’écran lit tout le contenu comme nom du lien.',
                'Plusieurs liens vers la même destination dans une carte (image, titre, bouton « Lire »).',
                'Des cartes de hauteurs différentes à cause des images.',
                'Oublier l’état de focus.',
            ],
            'practices' => [
                'Un seul lien par carte, étendu avec `::after`.',
                'Variables pour les couleurs et arrondis.',
                'Tester les cas limites de contenu.',
            ],
            'practical' => 'Les cartes de cours de cette plateforme suivent ce modèle : un lien principal, un contenu empilé en Flexbox, une élévation au survol et un contour au focus.',
            'summary' => ['HTML sémantique d’abord (`article`, titre, lien explicite).', 'Lien étendu à toute la carte avec `::after`.', 'Flexbox + `margin-top: auto`, images homogènes, états hover et focus.'],
            'challenge' => 'Créez une carte tarifaire « Pro » mise en avant (badge, bordure colorée, bouton) et deux cartes standard, alignées dans une grille responsive.',
            'exercises' => [
                [
                    'title' => 'Étendre la zone cliquable',
                    'difficulty' => 3,
                    'instructions' => 'Rendez toute la carte cliquable : `.carte` doit être en `position: relative`, et `.carte a::after` doit avoir `content: ""`, `position: absolute` et `inset: 0`.',
                    'starter_html' => '<article class="carte">
  <h3><a href="#">Découvrir Grid</a></h3>
  <p>Cliquez n’importe où sur la carte.</p>
</article>',
                    'starter_css' => '.carte {
  padding: 20px;
  border: 1px solid #cbd5e1;
  border-radius: 12px;
  max-width: 280px;
}',
                    'solution_css' => '.carte {
  position: relative;
  padding: 20px;
  border: 1px solid #cbd5e1;
  border-radius: 12px;
  max-width: 280px;
}

.carte a::after {
  content: "";
  position: absolute;
  inset: 0;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.carte|article.carte', 'prop' => 'position', 'value' => 'relative', 'msg' => '.carte est en position: relative'],
                        ['t' => 'css', 'sel' => '.carte a::after|.carte h3 a::after|a::after', 'prop' => 'content', 'in' => ['""', "''"], 'msg' => 'Le ::after du lien a content: ""'],
                        ['t' => 'css', 'sel' => '.carte a::after|.carte h3 a::after|a::after', 'prop' => 'position', 'value' => 'absolute', 'msg' => 'Le ::after est en position: absolute'],
                        ['t' => 'css', 'sel' => '.carte a::after|.carte h3 a::after|a::after', 'prop' => 'inset', 'in' => ['0', '0px'], 'msg' => 'Le ::after couvre la carte (inset: 0)'],
                    ],
                    'hint' => 'Le pseudo-élément du lien se positionne par rapport à la carte.',
                    'explanation' => 'Le `::after` absolu du lien couvre toute la carte (repère relatif) : un seul lien, une grande zone cliquable.',
                ],
            ],
            'quiz' => [
                ['q' => 'Pourquoi éviter d’envelopper toute la carte dans un `<a>` ?', 'a' => ['C’est invalide', 'Le lecteur d’écran annonce tout le contenu comme texte du lien', 'Le lien ne fonctionne pas', 'Le CSS ne s’applique plus'], 'c' => 1, 'e' => 'Le nom du lien devient interminable.'],
                ['q' => 'Quelle pseudo-classe cible une carte dont un descendant a le focus ?', 'a' => ['`:focus`', '`:focus-within`', '`:active`', '`:has-focus`'], 'c' => 1, 'e' => '`:focus-within`.'],
                ['q' => '`margin-top: auto` dans un conteneur flex en colonne pousse l’élément vers le bas.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
        [
            'slug' => 'bonnes-pratiques-css-performance',
            'title' => 'Bonnes pratiques CSS et performance',
            'duration' => 14,
            'intro' => <<<'MD'
Vous voici à la dernière leçon du parcours ! Pour conclure, voici les réflexes des intégrateurs professionnels : un CSS **performant**, **accessible**, **compatible** et **maintenable**. C’est cette check-list qui fait la différence dans un vrai projet.
MD,
            'objectives' => ['Optimiser le chargement du CSS', 'Vérifier la compatibilité des propriétés', 'Appliquer une check-list qualité complète'],
            'prerequisites' => ['Créer un composant carte complet'],
            'theory' => <<<'MD'
## Performance

- **Une ou deux feuilles** pour tout le site, **minifiées** (espaces et commentaires retirés) et **compressées** (gzip/brotli) par le serveur ;
- un **cache** long grâce à un numéro de version dans l’URL (`style.css?v=123`) : cette plateforme ajoute automatiquement la date de modification du fichier ;
- des **polices** limitées, au format WOFF2, avec `font-display: swap` pour que le texte reste visible pendant leur chargement ;
- animer `transform` et `opacity` plutôt que les dimensions ;
- supprimer le CSS inutilisé (les outils de développement ont un onglet *Coverage*).

## Compatibilité

Le site [caniuse.com](https://caniuse.com) indique quels navigateurs supportent chaque propriété. Pour une propriété récente, prévoyez une **solution de repli** :

```css
.carte {
  background: #4f46e5;                                  /* repli */
  background: color-mix(in srgb, #4f46e5 80%, white);   /* moderne */
}
```

`@supports` teste le support d’une fonctionnalité :

```css
@supports (display: grid) { … }
```

## Accessibilité

- contrastes de 4,5:1 minimum ;
- focus visible sur tous les éléments interactifs ;
- `prefers-reduced-motion` respecté ;
- pas de texte en `px` fixe trop petit, zoom à 200 % fonctionnel ;
- pas d’information transmise uniquement par la couleur.

## Maintenabilité

- variables pour la charte graphique ;
- convention de nommage (BEM) ;
- spécificité faible, pas de `!important` ;
- feuille organisée et commentée.

## La check-list finale

- [ ] Aucun défilement horizontal de 320px à 1440px
- [ ] Focus visible partout, navigation clavier testée
- [ ] Contrastes vérifiés
- [ ] Animations désactivables
- [ ] Images fluides
- [ ] CSS validé ([validateur CSS du W3C](https://jigsaw.w3.org/css-validator/))
- [ ] Audit Lighthouse > 90 en performance et accessibilité

> [!TIP] Félicitations : en validant cette leçon, vous avez parcouru l’ensemble du programme. Terminez les projets pratiques, puis obtenez votre certificat depuis votre tableau de bord !
MD,
            'syntax' => '@supports (propriété: valeur) { … }
@font-face { font-display: swap; }',
            'example_html' => <<<'HTML'
<main class="page">
  <h1>Check-list qualité</h1>
  <ul class="checklist">
    <li class="ok">Responsive de 320 à 1440px</li>
    <li class="ok">Focus visible</li>
    <li class="ok">Contrastes vérifiés</li>
    <li>Audit Lighthouse</li>
  </ul>
</main>
HTML,
            'example_css' => <<<'CSS'
:root { --ok: #15803d; --a-faire: #b45309; }

.page { width: min(100% - 2rem, 640px); margin: 2rem auto; font-family: system-ui, sans-serif; }

.checklist { list-style: none; padding: 0; display: grid; gap: 0.5rem; }

.checklist li {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  padding: 0.75rem 1rem;
  border-radius: 10px;
  background: #fffbeb;
  color: var(--a-faire);
}

/* L’état est porté par le texte ET une icône, pas seulement la couleur */
.checklist li::before { content: "○"; font-weight: bold; }
.checklist li.ok { background: #f0fdf4; color: var(--ok); }
.checklist li.ok::before { content: "✓"; }

@supports (background: color-mix(in srgb, red 50%, white)) {
  .checklist li.ok { background: color-mix(in srgb, var(--ok) 8%, white); }
}
CSS,
            'lines' => [
                [':root { --ok: …; --a-faire: …; }', 'Couleurs d’état centralisées.'],
                ['.checklist li::before { content: "○"; }', 'L’état est aussi indiqué par un symbole, pas seulement la couleur.'],
                ['.checklist li.ok::before { content: "✓"; }', 'Symbole différent pour les éléments validés.'],
                ['@supports (background: color-mix(…)) {', 'Amélioration appliquée seulement si le navigateur la supporte.'],
            ],
            'reference' => [
                ['@supports', 'Teste le support d’une fonctionnalité.'],
                ['font-display: swap', 'Texte visible pendant le chargement de la police.'],
                ['caniuse.com', 'Compatibilité des fonctionnalités.'],
                ['Minification', 'Suppression des caractères inutiles pour la production.'],
            ],
            'mistakes' => [
                'Charger plusieurs feuilles CSS volumineuses inutilisées.',
                'Utiliser une propriété récente sans repli pour un public large.',
                'Négliger l’accessibilité « parce que ça s’affiche bien ».',
            ],
            'practices' => [
                'Mesurer avec Lighthouse avant et après les modifications.',
                'Amélioration progressive : une base qui fonctionne partout, des enrichissements modernes.',
                'Suivre une check-list avant chaque mise en ligne.',
            ],
            'practical' => 'Les agences livrent un site avec un rapport Lighthouse et un audit d’accessibilité. Maîtriser cette check-list vous permet de livrer un travail professionnel dès vos premiers projets.',
            'summary' => ['Performance : peu de fichiers, minifiés, mis en cache ; animations légères.', 'Compatibilité : caniuse, replis, `@supports`.', 'Accessibilité et maintenabilité jusqu’au bout.'],
            'challenge' => 'Passez l’audit Lighthouse sur votre projet final et atteignez un score d’au moins 90 en Performance et 100 en Accessibilité.',
            'exercises' => [
                [
                    'title' => 'Amélioration progressive',
                    'difficulty' => 2,
                    'instructions' => 'Ajoutez un bloc `@supports (display: grid)` qui applique `display: grid` et `grid-template-columns: 1fr 1fr` à `.duo`. Sans support, les blocs restent empilés.',
                    'starter_html' => '<div class="duo">
  <div class="bloc">Un</div>
  <div class="bloc">Deux</div>
</div>',
                    'starter_css' => '.bloc {
  padding: 20px;
  margin-bottom: 8px;
  background: #e0e7ff;
}',
                    'solution_css' => '.bloc {
  padding: 20px;
  margin-bottom: 8px;
  background: #e0e7ff;
}

@supports (display: grid) {
  .duo {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
  }
}',
                    'rules' => [
                        ['t' => 'match', 're' => '@supports\s*\(\s*display\s*:\s*grid\s*\)', 'in' => 'css', 'msg' => 'Un bloc @supports (display: grid)'],
                        ['t' => 'css', 'sel' => '.duo|div.duo', 'prop' => 'display', 'value' => 'grid', 'msg' => '.duo passe en grid'],
                        ['t' => 'css', 'sel' => '.duo|div.duo', 'prop' => 'grid-template-columns', 'in' => ['1fr 1fr', 'repeat(2, 1fr)'], 'msg' => 'Deux colonnes'],
                    ],
                    'hint' => '`@supports (display: grid) { .duo { … } }`',
                    'explanation' => 'Le contenu fonctionne partout ; la mise en page en grille s’ajoute là où elle est supportée.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel site indique la compatibilité des propriétés CSS ?', 'a' => ['caniuse.com', 'github.com', 'css.fr', 'w3schools.com'], 'c' => 0, 'e' => 'caniuse.com.'],
                ['q' => 'À quoi sert `font-display: swap` ?', 'a' => ['À changer de police au survol', 'À afficher le texte avec une police de secours pendant le chargement', 'À réduire la taille du texte', 'Rien'], 'c' => 1, 'e' => 'Le texte reste lisible pendant le chargement de la police web.'],
                ['q' => 'La minification réduit le poids des fichiers CSS.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
    ],
];
