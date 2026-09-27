<?php
return [
    'slug' => 'css-variables-organisation',
    'title' => 'Variables CSS et organisation',
    'description' => 'Les propriétés personnalisées (variables), les thèmes, et l’organisation d’une feuille de style maintenable.',
    'lessons' => [
        [
            'slug' => 'variables-css',
            'title' => 'Les variables CSS',
            'duration' => 15,
            'intro' => <<<'MD'
Votre couleur principale apparaît 40 fois dans la feuille de style. Le client veut la changer. Avec les **variables CSS** (propriétés personnalisées), il suffit de modifier **une ligne**. Elles permettent aussi de créer un thème sombre, des variantes de composants et des designs systems cohérents.
MD,
            'objectives' => ['Déclarer et utiliser une variable', 'Comprendre leur portée et leur héritage', 'Prévoir une valeur de repli', 'Créer un thème clair/sombre'],
            'prerequisites' => ['Cascade, spécificité et héritage', 'Les media queries'],
            'theory' => <<<'MD'
## Déclarer et utiliser

```css
:root {
  --couleur-primaire: #4f46e5;
  --rayon: 12px;
  --espace: 1.5rem;
}

.btn {
  background: var(--couleur-primaire);
  border-radius: var(--rayon);
  padding: calc(var(--espace) / 2) var(--espace);
}
```

- le nom commence par **deux tirets** `--` ;
- `:root` désigne l’élément racine (`<html>`) : les variables y sont disponibles **partout** ;
- `var(--nom)` lit la valeur.

## Valeur de repli

```css
color: var(--couleur-texte, #111);
```

Si `--couleur-texte` n’est pas définie, `#111` est utilisée.

## Portée et héritage

Les variables suivent la **cascade** : on peut les redéfinir sur un élément, et ses descendants hériteront de la nouvelle valeur.

```css
.btn { background: var(--btn-fond, #4f46e5); }
.btn--danger { --btn-fond: #dc2626; }
```

C’est la technique idéale pour les **variantes** de composants : on ne réécrit que la variable.

## Un thème sombre en quelques lignes

```css
:root {
  --fond: #ffffff;
  --texte: #0f172a;
}

@media (prefers-color-scheme: dark) {
  :root {
    --fond: #0f172a;
    --texte: #e2e8f0;
  }
}

body { background: var(--fond); color: var(--texte); }
```

## Calculer avec `calc()`

```css
.carte { padding: calc(var(--espace) * 2); }
```

> [!INFO] Variables CSS et variables Sass (`$couleur`) sont différentes : les variables Sass disparaissent à la compilation, les variables CSS existent **dans le navigateur** et peuvent changer selon le contexte (media query, classe, JavaScript).

Toute la charte graphique de cette plateforme est définie en variables sur `:root` : `--bg`, `--surface`, `--primary`, `--html`, `--css`…
MD,
            'syntax' => ':root { --nom: valeur; }
.el { propriété: var(--nom, repli); }',
            'example_html' => <<<'HTML'
<div class="carte">
  <h2>Offre Découverte</h2>
  <p>Tous les cours pendant 30 jours.</p>
  <a class="btn" href="#">Essayer</a>
  <a class="btn btn--secondaire" href="#">En savoir plus</a>
</div>
<div class="carte theme-sombre">
  <h2>Même composant, thème sombre</h2>
  <p>Seules les variables changent.</p>
  <a class="btn" href="#">Essayer</a>
</div>
HTML,
            'example_css' => <<<'CSS'
:root {
  --primaire: #4f46e5;
  --fond: #ffffff;
  --texte: #1e293b;
  --rayon: 12px;
  --espace: 1rem;
}

.theme-sombre {
  --fond: #0f172a;
  --texte: #e2e8f0;
  --primaire: #818cf8;
}

body { font-family: system-ui, sans-serif; display: grid; gap: var(--espace); padding: var(--espace); }

.carte {
  padding: calc(var(--espace) * 1.5);
  border-radius: var(--rayon);
  background: var(--fond);
  color: var(--texte);
  border: 1px solid #cbd5e1;
}

.btn {
  display: inline-block;
  padding: calc(var(--espace) / 2) var(--espace);
  border-radius: calc(var(--rayon) / 2);
  background: var(--btn-fond, var(--primaire));
  color: white;
  text-decoration: none;
}

.btn--secondaire { --btn-fond: #64748b; }
CSS,
            'lines' => [
                [':root {', 'Variables globales, disponibles partout.'],
                ['  --primaire: #4f46e5;', 'Déclaration : deux tirets + nom.'],
                ['.theme-sombre { --fond: #0f172a; … }', 'Redéfinition locale : les descendants héritent des nouvelles valeurs.'],
                ['  padding: calc(var(--espace) * 1.5);', 'Calcul à partir d’une variable.'],
                ['  background: var(--btn-fond, var(--primaire));', 'Variable avec valeur de repli (elle-même une variable).'],
                ['.btn--secondaire { --btn-fond: #64748b; }', 'Variante : on change seulement la variable.'],
            ],
            'reference' => [
                ['--nom: valeur', 'Déclaration d’une variable.'],
                ['var(--nom, repli)', 'Utilisation avec valeur de repli.'],
                [':root', 'Élément racine : portée globale.'],
                ['calc()', 'Calculs avec unités et variables.'],
            ],
            'mistakes' => [
                'Oublier les deux tirets : `-couleur` ou `couleur`.',
                'Oublier `var()` : `color: --primaire;`.',
                'Déclarer une variable dans un sélecteur trop spécifique et ne pas y avoir accès ailleurs.',
                'Des noms trop liés à la valeur (`--bleu`) plutôt qu’au rôle (`--primaire`).',
            ],
            'practices' => [
                'Définir couleurs, espacements, rayons et typographies en variables sur `:root`.',
                'Nommer selon le rôle.',
                'Utiliser des variables locales pour les variantes de composants.',
            ],
            'practical' => 'Changer le thème d’une application (clair/sombre, couleurs d’une marque cliente) se résume souvent à redéfinir une dizaine de variables : c’est la base des systèmes de thèmes modernes.',
            'summary' => ['`--nom: valeur` pour déclarer, `var(--nom)` pour utiliser.', 'Portée et héritage suivent la cascade.', 'Idéal pour thèmes et variantes.'],
            'challenge' => 'Créez un thème sombre complet pour une page existante uniquement en redéfinissant des variables dans `@media (prefers-color-scheme: dark)`.',
            'exercises' => [
                [
                    'title' => 'Centraliser une couleur',
                    'difficulty' => 2,
                    'instructions' => 'Déclarez dans `:root` la variable `--marque` valant `#e11d48`, puis utilisez-la avec `var(--marque)` pour le `color` du `h1` ET le `background` du `.btn`.',
                    'starter_html' => '<h1>Ma marque</h1>
<a class="btn" href="#">Acheter</a>',
                    'starter_css' => '.btn {
  display: inline-block;
  padding: 10px 18px;
  color: white;
  text-decoration: none;
}',
                    'solution_css' => ':root {
  --marque: #e11d48;
}

h1 {
  color: var(--marque);
}

.btn {
  display: inline-block;
  padding: 10px 18px;
  color: white;
  text-decoration: none;
  background: var(--marque);
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => ':root|html', 'prop' => '--marque', 'value' => '#e11d48', 'msg' => '--marque: #e11d48 est déclarée dans :root'],
                        ['t' => 'css', 'sel' => 'h1', 'prop' => 'color', 'value' => 'var(--marque)', 'msg' => 'Le h1 utilise var(--marque)'],
                        ['t' => 'css', 'sel' => '.btn|a.btn', 'prop' => 'background|background-color', 'value' => 'var(--marque)', 'msg' => 'Le .btn utilise var(--marque)'],
                        ['t' => 'match', 're' => '^(?![\\s\\S]*#e11d48[\\s\\S]*#e11d48)', 'in' => 'css', 'msg' => 'La couleur #e11d48 n’est écrite qu’une seule fois'],
                    ],
                    'hint' => '`:root { --marque: #e11d48; }` puis `var(--marque)`.',
                    'explanation' => 'La couleur est définie une seule fois : pour la changer, une seule ligne suffit.',
                ],
                [
                    'title' => 'Valeur de repli',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Que vaut `color: var(--accent, orange);` si `--accent` n’est définie nulle part ?',
                    'answers' => ['Rien (erreur)', '`orange`', 'noir', 'la couleur du parent'],
                    'correct' => 1,
                    'explanation' => 'La seconde valeur de `var()` sert de repli.',
                ],
            ],
            'quiz' => [
                ['q' => 'Comment commence le nom d’une variable CSS ?', 'a' => ['`$`', '`@`', '`--`', '`#`'], 'c' => 2, 'e' => 'Deux tirets.'],
                ['q' => 'Que désigne `:root` ?', 'a' => ['Le body', 'L’élément racine html', 'Le premier élément', 'Le head'], 'c' => 1, 'e' => '`<html>`.'],
                ['q' => 'Une variable redéfinie sur un élément s’applique à ses descendants.', 'tf' => true, 'c' => true, 'e' => 'Vrai : elle suit l’héritage.'],
            ],
        ],
        [
            'slug' => 'organiser-une-feuille-css',
            'title' => 'Organiser une feuille de style',
            'duration' => 14,
            'intro' => <<<'MD'
Une feuille CSS de 50 lignes se lit facilement. À 3 000 lignes, sans organisation, elle devient un cauchemar : styles en double, règles qui s’écrasent, peur de supprimer quoi que ce soit. Quelques principes d’**architecture CSS** gardent un projet maintenable.
MD,
            'objectives' => ['Structurer une feuille en sections logiques', 'Appliquer une convention de nommage (BEM)', 'Maintenir une spécificité faible', 'Découvrir le découpage en fichiers'],
            'prerequisites' => ['Les variables CSS'],
            'theory' => <<<'MD'
## Du général au particulier

Organisez la feuille par couches, du plus global au plus spécifique :

1. **Variables** (`:root`) : couleurs, espacements, typographies ;
2. **Reset / base** : `box-sizing`, marges, styles des balises (`body`, `h1`, `a`, `img`) ;
3. **Mise en page** : conteneurs, grilles, en-tête, pied de page ;
4. **Composants** : boutons, cartes, formulaires, badges ;
5. **Utilitaires** : petites classes à usage unique (`.sr-only`, `.text-center`) ;
6. **Media queries** : à la fin de chaque composant, ou regroupées.

C’est exactement la structure de la feuille `main.css` de cette plateforme, avec une table des matières en commentaire.

## Nommer : BEM

```css
.carte { }                   /* bloc */
.carte__titre { }            /* élément */
.carte--promo { }            /* modificateur */
```

Avantages : les classes sont uniques, explicites, et chaque sélecteur a la même spécificité faible (une classe).

## Garder une spécificité faible

- stylez avec des **classes**, pas des id ;
- évitez les sélecteurs imbriqués profonds (`.page .contenu .article .texte p`) ;
- n’utilisez pas `!important` (sauf utilitaires).

## Découper en fichiers

Sur un gros projet, on sépare : `variables.css`, `base.css`, `layout.css`, `components/button.css`… Ils sont ensuite regroupés en un seul fichier pour la production (par un outil de build ou avec `@import` / `@layer`).

## Éviter la duplication

Avant d’écrire une nouvelle règle, cherchez si un composant ou une variable existe déjà. Préférez composer des classes (`class="btn btn--large"`) plutôt que de dupliquer un bloc de 15 déclarations.

## L’ordre des propriétés

Une convention courante regroupe les propriétés par famille : positionnement, modèle de boîte, typographie, apparence, animation. L’important : que toute l’équipe suive la même.
MD,
            'syntax' => '/* 1. Variables */ :root { … }
/* 2. Base */ body { … }
/* 3. Layout */ .container { … }
/* 4. Composants */ .btn { … }
/* 5. Utilitaires */ .sr-only { … }',
            'example_html' => <<<'HTML'
<main class="container">
  <article class="carte carte--promo">
    <h2 class="carte__titre">Offre spéciale</h2>
    <p class="carte__texte">-30 % sur l’abonnement annuel.</p>
    <a class="btn btn--large" href="#">J’en profite</a>
  </article>
</main>
HTML,
            'example_css' => <<<'CSS'
/* ========== 1. Variables ========== */
:root {
  --c-primaire: #7c3aed;
  --c-promo: #f59e0b;
  --rayon: 12px;
  --espace: 1rem;
}

/* ========== 2. Base ========== */
*, *::before, *::after { box-sizing: border-box; }
body { margin: 0; font-family: system-ui, sans-serif; line-height: 1.6; }

/* ========== 3. Layout ========== */
.container { width: min(100% - 2rem, 720px); margin: 2rem auto; }

/* ========== 4. Composants ========== */
/* Carte */
.carte { padding: calc(var(--espace) * 1.5); border-radius: var(--rayon); border: 1px solid #e2e8f0; }
.carte--promo { border-color: var(--c-promo); background: #fffbeb; }
.carte__titre { margin-top: 0; }

/* Bouton */
.btn { display: inline-block; padding: 0.5em 1em; border-radius: calc(var(--rayon) / 2); background: var(--c-primaire); color: white; text-decoration: none; }
.btn--large { font-size: 1.125rem; padding: 0.75em 1.5em; }

/* ========== 5. Utilitaires ========== */
.sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); }
CSS,
            'lines' => [
                ['/* ========== 1. Variables ========== */', 'Sections clairement délimitées par des commentaires.'],
                ['*, *::before, *::after { box-sizing: border-box; }', 'Base : réglages globaux.'],
                ['.container { … }', 'Mise en page.'],
                ['.carte--promo { … }', 'Modificateur BEM : variante de la carte.'],
                ['.carte__titre { … }', 'Élément BEM du bloc carte.'],
                ['.btn--large { … }', 'Composition : `class="btn btn--large"`.'],
            ],
            'reference' => [
                ['Couches', 'Variables > base > layout > composants > utilitaires.'],
                ['BEM', '`bloc__element--modificateur`.'],
                ['@layer', 'Ordonne explicitement des couches de cascade (CSS moderne).'],
                ['@import', 'Importe une autre feuille de style.'],
            ],
            'mistakes' => [
                'Ajouter systématiquement les nouvelles règles à la fin du fichier.',
                'Dupliquer des blocs de styles.',
                'Des sélecteurs longs et imbriqués.',
                'Des noms de classes incohérents (`.btnRouge`, `.bouton-bleu`, `.Button`).',
            ],
            'practices' => [
                'Une table des matières en tête de fichier.',
                'Une convention de nommage unique.',
                'Des composants réutilisables et composables.',
            ],
            'practical' => 'Les grandes équipes documentent leurs composants dans une bibliothèque vivante (comme Storybook) : chaque composant a sa feuille de style isolée, ses variantes et ses exemples d’utilisation.',
            'summary' => ['Du général au particulier : variables, base, layout, composants, utilitaires.', 'BEM pour des noms clairs et une spécificité faible.', 'Réutiliser avant d’écrire.'],
            'challenge' => 'Réorganisez la feuille CSS de votre projet « landing page » selon les cinq couches, avec une table des matières.',
            'exercises' => [
                [
                    'title' => 'Classes BEM',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Selon BEM, quelle classe désigne une variante « désactivée » du bloc `bouton` ?',
                    'answers' => ['`.bouton__desactive`', '`.bouton--desactive`', '`.bouton-desactive`', '`.desactive .bouton`'],
                    'correct' => 1,
                    'explanation' => 'Deux tirets `--` pour un modificateur (variante) ; deux underscores `__` pour un élément.',
                ],
                [
                    'title' => 'Réduire la spécificité',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Remplacez le sélecteur trop long `body main .zone div p.note` par une simple classe `.note` (le résultat visuel doit rester le même).',
                    'starter_html' => '<main><div class="zone"><div><p class="note">Pensez à sauvegarder.</p></div></div></main>',
                    'starter_css' => 'body main .zone div p.note {
  color: #92400e;
  background: #fef3c7;
  padding: 8px;
}',
                    'solution_css' => '.note {
  color: #92400e;
  background: #fef3c7;
  padding: 8px;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.note', 'prop' => 'color', 'value' => '#92400e', 'msg' => 'La règle utilise le sélecteur .note'],
                        ['t' => 'absent', 's' => 'body main', 'in' => 'css', 'msg' => 'Le sélecteur long a disparu'],
                    ],
                    'hint' => 'Gardez les déclarations, changez seulement le sélecteur.',
                    'explanation' => 'Une classe unique suffit : le style est plus simple à surcharger et ne dépend plus de la structure HTML.',
                ],
            ],
            'quiz' => [
                ['q' => 'Dans quel ordre organiser une feuille de style ?', 'a' => ['Composants, variables, base', 'Variables, base, layout, composants, utilitaires', 'Au hasard', 'Alphabétique'], 'c' => 1, 'e' => 'Du général au particulier.'],
                ['q' => 'Pourquoi éviter les sélecteurs longs ?', 'a' => ['Ils sont interdits', 'Ils sont fragiles et difficiles à surcharger', 'Ils sont plus lents à écrire', 'Ils ne fonctionnent pas'], 'c' => 1, 'e' => 'Forte spécificité et dépendance à la structure HTML.'],
                ['q' => 'En BEM, `.menu__lien` est un élément du bloc `menu`.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
    ],
];
