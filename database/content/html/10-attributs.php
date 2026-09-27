<?php
return [
    'slug' => 'html-attributs-classes-ids',
    'title' => 'Attributs globaux, classes et identifiants',
    'description' => 'class et id en profondeur, attributs globaux (title, lang, hidden, data-*) et conteneurs génériques.',
    'lessons' => [
        [
            'slug' => 'classes-et-identifiants',
            'title' => 'Classes et identifiants en HTML',
            'duration' => 12,
            'intro' => <<<'MD'
Vous avez utilisé `class` et `id` en CSS. Côté HTML, ils sont bien plus qu’un crochet pour le style : l’`id` sert aux ancres, aux labels et à l’accessibilité ; la `class` décrit des familles d’éléments. Bien les nommer rend un projet compréhensible par toute une équipe.
MD,
            'objectives' => ['Appliquer une ou plusieurs classes', 'Respecter l’unicité des id', 'Nommer classes et identifiants de façon cohérente', 'Découvrir la convention BEM'],
            'prerequisites' => ['Sélecteurs de type, de classe et d’identifiant (CSS)'],
            'theory' => <<<'MD'
## `class` : des familles d’éléments

```html
<article class="carte carte--promo">…</article>
<article class="carte">…</article>
```

- plusieurs classes séparées par des **espaces** ;
- la même classe sur autant d’éléments que nécessaire ;
- l’ordre des classes dans l’attribut n’a pas d’importance.

## `id` : un élément unique

Un `id` doit être **unique dans la page**. Il sert à :

- les **ancres** : `href="#contact"` ;
- les **labels** : `<label for="email">` ;
- l’**accessibilité** : `aria-describedby="aide-mdp"` ;
- **JavaScript** : `document.getElementById('menu')`.

## Règles de nommage

- lettres minuscules, chiffres, tirets : `carte-produit`, `menu-principal` ;
- pas d’espace, pas d’accent, ne commence pas par un chiffre ;
- un nom qui décrit le **rôle** : `.alerte`, `.prix-barre`, pas `.rouge` ou `.gauche`.

## La convention BEM

Très utilisée en entreprise : **B**loc, **É**lément, **M**odificateur.

```html
<div class="carte carte--mise-en-avant">
  <h3 class="carte__titre">…</h3>
  <p class="carte__texte">…</p>
</div>
```

- `carte` : le bloc ;
- `carte__titre` : un élément du bloc (deux underscores) ;
- `carte--mise-en-avant` : une variante (deux tirets).

On sait immédiatement à quoi sert chaque classe et où se trouve son style.
MD,
            'syntax' => '<div class="bloc bloc--variante" id="unique">…</div>',
            'example_html' => <<<'HTML'
<section id="offres">
  <h2>Nos offres</h2>
  <article class="offre">
    <h3 class="offre__titre">Découverte</h3>
    <p class="offre__prix">9 € / mois</p>
  </article>
  <article class="offre offre--populaire">
    <h3 class="offre__titre">Pro</h3>
    <p class="offre__prix">19 € / mois</p>
  </article>
</section>
<p><a href="#offres">Revoir les offres</a></p>
HTML,
            'example_css' => <<<'CSS'
.offre {
  display: inline-block;
  width: 160px;
  padding: 16px;
  border: 1px solid #cbd5e1;
  border-radius: 12px;
  font-family: system-ui, sans-serif;
}

.offre--populaire {
  border: 2px solid #7c3aed;
  background: #f5f3ff;
}

.offre__prix {
  font-size: 1.25rem;
  font-weight: bold;
}
CSS,
            'lines' => [
                ['<section id="offres">', 'Identifiant unique : cible de l’ancre en bas de page.'],
                ['<article class="offre">', 'Bloc « offre » réutilisé.'],
                ['<h3 class="offre__titre">', 'Élément du bloc (convention BEM).'],
                ['<article class="offre offre--populaire">', 'Deux classes : le bloc + sa variante.'],
                ['<a href="#offres">', 'Lien vers l’`id`.'],
            ],
            'reference' => [
                ['class', 'Une ou plusieurs classes, séparées par des espaces.'],
                ['id', 'Identifiant unique dans la page.'],
                ['bloc__element', 'BEM : élément d’un bloc.'],
                ['bloc--modificateur', 'BEM : variante d’un bloc.'],
            ],
            'mistakes' => [
                'Deux attributs `class` sur le même élément.',
                'Le même `id` utilisé plusieurs fois.',
                'Des noms avec espaces ou accents : `class="carte produit"` crée deux classes.',
                'Des noms basés sur l’apparence.',
            ],
            'practices' => [
                'Des noms en minuscules avec tirets.',
                'Des noms selon le rôle.',
                'Une convention (comme BEM) appliquée dans tout le projet.',
            ],
            'practical' => 'Dans une équipe, un développeur qui lit `class="panier__ligne panier__ligne--vide"` comprend instantanément la structure, sans ouvrir le CSS. C’est l’intérêt d’une convention partagée.',
            'summary' => ['`class` : plusieurs, réutilisables ; `id` : unique.', 'Noms en minuscules, tirets, selon le rôle.', 'BEM : `bloc__element--modificateur`.'],
            'challenge' => 'Codez trois cartes de profil en BEM (`profil`, `profil__nom`, `profil__role`, `profil--admin`).',
            'exercises' => [
                [
                    'title' => 'Deux classes sur un élément',
                    'difficulty' => 1,
                    'instructions' => 'Donnez au bouton **les deux classes** `btn` et `btn--danger` (dans un seul attribut `class`).',
                    'starter_html' => '<button type="button">Supprimer</button>',
                    'starter_css' => '.btn { padding: 8px 16px; border: 0; border-radius: 6px; }
.btn--danger { background: #dc2626; color: white; }',
                    'solution_html' => '<button type="button" class="btn btn--danger">Supprimer</button>',
                    'solution_css' => '.btn { padding: 8px 16px; border: 0; border-radius: 6px; }
.btn--danger { background: #dc2626; color: white; }',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'button.btn.btn--danger', 'msg' => 'Le bouton a les classes btn et btn--danger'],
                        ['t' => 'match', 're' => '<button[^>]*class="[^"]*"[^>]*>', 'msg' => 'Un seul attribut class'],
                        ['t' => 'absent', 's' => 'class="btn" class', 'msg' => 'Pas d’attribut class dupliqué'],
                    ],
                    'hint' => '`class="btn btn--danger"`',
                    'explanation' => 'Plusieurs classes s’écrivent dans le même attribut, séparées par un espace.',
                ],
            ],
            'quiz' => [
                ['q' => 'Combien de fois un même `id` peut-il apparaître dans une page ?', 'a' => ['Une fois', 'Deux fois', 'Illimité', 'Une fois par section'], 'c' => 0, 'e' => 'Un identifiant est unique.'],
                ['q' => 'Que crée `class="carte produit"` ?', 'a' => ['Une classe « carte produit »', 'Deux classes : carte et produit', 'Une erreur', 'Un id'], 'c' => 1, 'e' => 'L’espace sépare deux classes.'],
                ['q' => 'En BEM, `menu__lien` désigne…', 'a' => ['une variante du menu', 'un élément du bloc menu', 'un id', 'un sélecteur CSS invalide'], 'c' => 1, 'e' => 'Deux underscores = élément du bloc.'],
            ],
        ],
        [
            'slug' => 'attributs-globaux',
            'title' => 'Attributs globaux, div et span',
            'duration' => 13,
            'intro' => <<<'MD'
Certains attributs fonctionnent sur **tous** les éléments : `title`, `lang`, `hidden`, `tabindex`, `data-*`… Et deux éléments n’ont **aucun sens** particulier : `<div>` et `<span>`. Savoir quand les utiliser — et surtout quand ne pas le faire — distingue un HTML propre d’une « soupe de div ».
MD,
            'objectives' => ['Utiliser les attributs globaux courants', 'Stocker des données avec `data-*`', 'Choisir entre `<div>`, `<span>` et une balise sémantique'],
            'prerequisites' => ['Classes et identifiants en HTML'],
            'theory' => <<<'MD'
## Les attributs globaux utiles

| Attribut | Rôle |
|---|---|
| `id`, `class` | Identification, style |
| `title` | Info-bulle (complément, jamais indispensable) |
| `lang` | Langue du contenu de l’élément |
| `hidden` | Masque l’élément (pour tout le monde, lecteurs d’écran compris) |
| `tabindex` | Ordre de tabulation (`0` = focusable, `-1` = focusable par script) |
| `data-*` | Données personnalisées |
| `dir` | Sens d’écriture (`rtl` pour l’arabe, l’hébreu) |
| `contenteditable` | Rend le contenu éditable |

## Les attributs `data-*`

Ils stockent des informations destinées au CSS ou au JavaScript, sans détourner d’autres attributs :

```html
<li data-categorie="fruits" data-prix="2.50">Pommes</li>
```

En CSS : `[data-categorie="fruits"] { … }`. En JavaScript : `element.dataset.prix`.

## `<div>` et `<span>` : les conteneurs neutres

- `<div>` : conteneur **bloc** sans signification ;
- `<span>` : conteneur **en ligne** sans signification.

On les utilise **uniquement quand aucune balise sémantique ne convient**, généralement pour appliquer un style ou regrouper des éléments pour la mise en page :

```html
<p>Prix : <span class="prix">19 €</span></p>
<div class="grille">…</div>
```

## La « soupe de div »

```html
<div class="header"><div class="nav"><div class="item">…
```

Ce code fonctionne, mais il n’a aucun sens pour les lecteurs d’écran et les moteurs de recherche. Le niveau 3 vous apprendra les balises sémantiques (`<header>`, `<nav>`, `<main>`, `<article>`…) qui remplacent avantageusement la plupart de ces div.

> [!TIP] Réflexe : avant d’écrire `<div>`, demandez-vous « existe-t-il une balise qui décrit ce contenu ? ». Si oui, utilisez-la.
MD,
            'syntax' => '<div class="…">bloc neutre</div>
<span class="…">texte en ligne neutre</span>
<li data-id="42">…</li>',
            'example_html' => <<<'HTML'
<div class="catalogue">
  <p>Prix du jour : <span class="prix">3,20 €</span> le kilo.</p>
  <ul>
    <li data-categorie="fruits">Pommes</li>
    <li data-categorie="legumes">Carottes</li>
    <li data-categorie="fruits">Poires</li>
  </ul>
  <p lang="en" title="Citation de John Lennon">Life is what happens while you are busy making other plans.</p>
  <p hidden>Ce paragraphe est masqué.</p>
</div>
HTML,
            'example_css' => <<<'CSS'
.catalogue {
  font-family: system-ui, sans-serif;
  padding: 16px;
  background: #f8fafc;
}

.prix {
  font-weight: bold;
  color: #15803d;
}

[data-categorie="fruits"] {
  color: #c2410c;
}
CSS,
            'lines' => [
                ['<div class="catalogue">', 'Conteneur neutre utilisé pour le style (fond, marges).'],
                ['<span class="prix">3,20 €</span>', 'Conteneur en ligne neutre : on veut juste styler le prix.'],
                ['<li data-categorie="fruits">', 'Donnée personnalisée, exploitée par le CSS.'],
                ['<p lang="en" title="…">', 'Langue locale et info-bulle.'],
                ['<p hidden>', 'Élément masqué pour tous.'],
            ],
            'reference' => [
                ['title', 'Info-bulle.'],
                ['lang / dir', 'Langue et sens d’écriture.'],
                ['hidden', 'Masque l’élément.'],
                ['tabindex', 'Participation à la navigation clavier.'],
                ['data-*', 'Données personnalisées.'],
                ['<div> / <span>', 'Conteneurs neutres bloc / en ligne.'],
            ],
            'mistakes' => [
                'Utiliser des `<div>` partout au lieu de balises sémantiques.',
                'Utiliser `<div>` à l’intérieur d’un `<p>` (bloc dans un paragraphe).',
                'Mettre des informations essentielles uniquement dans `title`.',
                'Utiliser `tabindex` avec des valeurs positives (1, 2, 3…) qui brouillent l’ordre naturel.',
            ],
            'practices' => [
                'Une balise sémantique dès qu’elle existe ; div/span en dernier recours.',
                '`data-*` pour les données destinées aux scripts.',
                '`tabindex` limité à `0` et `-1`.',
            ],
            'practical' => 'Les filtres des boutiques (« Afficher : fruits / légumes ») utilisent souvent `data-*` : JavaScript lit `data-categorie` pour masquer ou afficher les produits, sans toucher aux classes de style.',
            'summary' => ['Les attributs globaux s’appliquent à tous les éléments.', '`data-*` stocke des données personnalisées.', '`<div>`/`<span>` n’ont aucun sens : à utiliser en dernier recours.'],
            'challenge' => 'Reprenez une page existante et remplacez chaque `<div>` qui pourrait être une balise plus précise (titre, liste, paragraphe…).',
            'exercises' => [
                [
                    'title' => 'Mettre un mot en valeur avec span',
                    'difficulty' => 1,
                    'instructions' => 'Entourez **19,90 €** avec un `<span>` de classe `prix`, et ajoutez à l’élément `<li>` l’attribut `data-stock` avec la valeur `12`.',
                    'starter_html' => '<ul>
  <li>T-shirt bio — 19,90 €</li>
</ul>',
                    'starter_css' => '.prix { color: #15803d; font-weight: bold; }',
                    'solution_html' => '<ul>
  <li data-stock="12">T-shirt bio — <span class="prix">19,90 €</span></li>
</ul>',
                    'solution_css' => '.prix { color: #15803d; font-weight: bold; }',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'li span.prix', 'text' => '19,90 €', 'msg' => 'Le prix est dans un span.prix'],
                        ['t' => 'attr', 'sel' => 'li', 'attr' => 'data-stock', 'value' => '12', 'msg' => 'Le li a data-stock="12"'],
                    ],
                    'hint' => '`<li data-stock="12">… <span class="prix">19,90 €</span></li>`',
                    'explanation' => '`<span>` permet de styler un morceau de texte sans lui donner de sens ; `data-stock` stocke une donnée personnalisée.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle est la différence entre `<div>` et `<span>` ?', 'a' => ['Aucune', '`<div>` est un bloc, `<span>` est en ligne', '`<span>` est obsolète', '`<div>` est sémantique'], 'c' => 1, 'e' => 'Tous deux sont neutres ; l’un est bloc, l’autre en ligne.'],
                ['q' => 'Quel attribut stocke une donnée personnalisée ?', 'a' => ['`custom`', '`data-*`', '`value`', '`info`'], 'c' => 1, 'e' => 'Les attributs `data-*`.'],
                ['q' => 'L’attribut `hidden` masque aussi l’élément pour les lecteurs d’écran.', 'tf' => true, 'c' => true, 'e' => 'Vrai : il est masqué pour tout le monde.'],
            ],
        ],
    ],
];
