<?php
return [
    'slug' => 'html-listes',
    'title' => 'Les listes',
    'description' => 'Listes à puces, listes numérotées, listes imbriquées et listes de définitions.',
    'lessons' => [
        [
            'slug' => 'listes-ordonnees-et-non-ordonnees',
            'title' => 'Listes à puces et listes numérotées',
            'duration' => 12,
            'intro' => <<<'MD'
Ingrédients d’une recette, étapes d’un tutoriel, menu de navigation, liste de fonctionnalités : les listes sont partout sur le Web, parfois là où on ne les voit pas. Les coder correctement aide les lecteurs d’écran à annoncer « liste de 5 éléments » — une information précieuse.
MD,
            'objectives' => ['Créer une liste non ordonnée `<ul>`', 'Créer une liste ordonnée `<ol>`', 'Utiliser les attributs `start`, `reversed`, `type`'],
            'prerequisites' => ['Les paragraphes'],
            'theory' => <<<'MD'
## Liste non ordonnée : `<ul>`

Quand l’**ordre n’a pas d’importance** (ingrédients, fonctionnalités) :

```html
<ul>
  <li>Farine</li>
  <li>Œufs</li>
  <li>Lait</li>
</ul>
```

`<ul>` (*unordered list*) contient des `<li>` (*list item*). Le navigateur affiche des puces.

## Liste ordonnée : `<ol>`

Quand l’**ordre compte** (étapes, classement) :

```html
<ol>
  <li>Mélanger la farine et les œufs.</li>
  <li>Ajouter le lait progressivement.</li>
  <li>Laisser reposer une heure.</li>
</ol>
```

La numérotation est automatique : insérez une étape, tout se renumérote.

## Attributs de `<ol>`

- `start="5"` : commence à 5 ;
- `reversed` : compte à rebours (top 10) ;
- `type="A"`, `"a"`, `"I"`, `"i"` : lettres ou chiffres romains (quand le type fait partie du sens, par exemple des articles de loi numérotés en romains).

## La règle d’or

Un `<ul>` ou `<ol>` ne contient **que** des `<li>`. Le texte, les liens, les images vont **dans** les `<li>`.

## Une liste invisible

Un menu de navigation est sémantiquement une liste de liens. On le code en `<ul>`, puis on retire les puces en CSS (`list-style: none`). La sémantique reste, l’apparence change.
MD,
            'syntax' => '<ul>
  <li>Élément</li>
</ul>
<ol>
  <li>Étape 1</li>
</ol>',
            'example_html' => <<<'HTML'
<h1>Crêpes faciles</h1>
<h2>Ingrédients</h2>
<ul>
  <li>250 g de farine</li>
  <li>4 œufs</li>
  <li>50 cl de lait</li>
  <li>Une pincée de sel</li>
</ul>
<h2>Préparation</h2>
<ol>
  <li>Versez la farine dans un saladier.</li>
  <li>Ajoutez les œufs et mélangez.</li>
  <li>Incorporez le lait petit à petit.</li>
  <li>Laissez reposer <strong>1 heure</strong>.</li>
</ol>
<h2>Top 3 des garnitures</h2>
<ol reversed>
  <li>Sucre et citron</li>
  <li>Confiture</li>
  <li>Pâte à tartiner</li>
</ol>
HTML,
            'lines' => [
                ['<ul>', 'Liste non ordonnée : l’ordre des ingrédients n’a pas d’importance.'],
                ['  <li>250 g de farine</li>', 'Chaque élément dans un `<li>`.'],
                ['<ol>', 'Liste ordonnée : les étapes doivent être suivies dans l’ordre.'],
                ['  <li>Laissez reposer <strong>1 heure</strong>.</li>', 'Un `<li>` peut contenir des éléments en ligne.'],
                ['<ol reversed>', 'Numérotation décroissante : 3, 2, 1.'],
            ],
            'reference' => [
                ['<ul>', 'Liste non ordonnée.'],
                ['<ol>', 'Liste ordonnée.'],
                ['<li>', 'Élément de liste.'],
                ['start / reversed / type', 'Attributs de numérotation de `<ol>`.'],
            ],
            'mistakes' => [
                'Écrire les puces à la main (`- Farine<br>`).',
                'Placer du texte ou un `<p>` directement dans `<ul>` sans `<li>`.',
                'Numéroter manuellement dans une `<ol>` (« 1. Mélanger »).',
                'Choisir `<ol>` pour son apparence et non pour le sens.',
            ],
            'practices' => [
                'Choisir `<ul>` ou `<ol>` selon que l’ordre a un sens.',
                'Styler les puces en CSS (`list-style`).',
                'Coder les menus comme des listes de liens.',
            ],
            'practical' => 'Presque tous les menus de navigation du Web sont codés `<nav><ul><li><a>…</a></li></ul></nav>`. Les lecteurs d’écran annoncent alors « navigation, liste de 5 éléments ».',
            'summary' => ['`<ul>` : ordre sans importance ; `<ol>` : ordre significatif.', 'Seuls des `<li>` dans une liste.', 'La numérotation de `<ol>` est automatique.'],
            'challenge' => 'Codez le classement de vos 5 films préférés du 5e au 1er avec `reversed`.',
            'exercises' => [
                [
                    'title' => 'Liste de courses',
                    'difficulty' => 1,
                    'instructions' => 'Créez une liste **non ordonnée** contenant trois éléments : **Pain**, **Beurre**, **Confiture**.',
                    'starter_html' => '<h2>Courses</h2>
',
                    'solution_html' => '<h2>Courses</h2>
<ul>
  <li>Pain</li>
  <li>Beurre</li>
  <li>Confiture</li>
</ul>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'ul', 'msg' => 'Une liste <ul> est présente'],
                        ['t' => 'el', 'sel' => 'ul > li', 'count' => 3, 'msg' => 'La liste contient 3 éléments <li>'],
                        ['t' => 'el', 'sel' => 'li', 'text' => 'Pain', 'msg' => '« Pain » est dans la liste'],
                        ['t' => 'el', 'sel' => 'li', 'text' => 'Confiture', 'msg' => '« Confiture » est dans la liste'],
                    ],
                    'hint' => '`<ul>` puis un `<li>` par élément.',
                    'explanation' => 'L’ordre des courses n’a pas d’importance : liste non ordonnée.',
                ],
                [
                    'title' => 'Des étapes numérotées',
                    'type' => 'fix',
                    'difficulty' => 1,
                    'instructions' => 'Ces étapes sont numérotées à la main dans des paragraphes. Transformez-les en **liste ordonnée** `<ol>` (sans les numéros écrits à la main).',
                    'starter_html' => '<p>1. Ouvrir l’éditeur</p>
<p>2. Écrire le code</p>
<p>3. Enregistrer le fichier</p>',
                    'solution_html' => '<ol>
  <li>Ouvrir l’éditeur</li>
  <li>Écrire le code</li>
  <li>Enregistrer le fichier</li>
</ol>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'ol > li', 'count' => 3, 'msg' => 'Une <ol> contient 3 <li>'],
                        ['t' => 'el', 'sel' => 'li', 'text' => 'Ouvrir l’éditeur', 'msg' => 'Le premier élément est « Ouvrir l’éditeur » (sans numéro)'],
                        ['t' => 'noel', 'sel' => 'p', 'msg' => 'Plus de paragraphes'],
                    ],
                    'hint' => 'La numérotation est automatique dans une `<ol>`.',
                    'explanation' => 'Des étapes dont l’ordre compte forment une liste ordonnée ; le navigateur numérote tout seul.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle balise pour les étapes d’une recette ?', 'a' => ['`<ul>`', '`<ol>`', '`<dl>`', '`<list>`'], 'c' => 1, 'e' => 'L’ordre des étapes compte : `<ol>`.'],
                ['q' => 'Quel est le seul enfant direct autorisé dans un `<ul>` ?', 'a' => ['`<p>`', '`<li>`', '`<a>`', '`<div>`'], 'c' => 1, 'e' => 'Seuls des `<li>` (et éventuellement des scripts/templates).'],
                ['q' => 'Un menu de navigation se code généralement avec une liste.', 'tf' => true, 'c' => true, 'e' => 'Vrai : c’est une liste de liens.'],
            ],
        ],
        [
            'slug' => 'listes-imbriquees-et-definitions',
            'title' => 'Listes imbriquées et listes de définitions',
            'duration' => 12,
            'intro' => <<<'MD'
Un sommaire à plusieurs niveaux, un menu avec sous-menus, un glossaire, une FAQ… Ces structures reposent sur deux techniques : **imbriquer** des listes, et utiliser la liste de **définitions** `<dl>`, souvent méconnue mais très utile.
MD,
            'objectives' => ['Imbriquer une liste dans un élément de liste', 'Créer une liste de définitions `<dl>`, `<dt>`, `<dd>`'],
            'prerequisites' => ['Listes à puces et listes numérotées'],
            'theory' => <<<'MD'
## Imbriquer des listes

Une sous-liste se place **à l’intérieur d’un `<li>`**, après son texte :

```html
<ul>
  <li>Fruits
    <ul>
      <li>Pommes</li>
      <li>Poires</li>
    </ul>
  </li>
  <li>Légumes</li>
</ul>
```

Erreur fréquente : placer le `<ul>` imbriqué **entre** deux `<li>`, directement dans la liste parente. C’est invalide.

On peut mélanger : une `<ol>` dans une `<ul>` et inversement.

## La liste de définitions : `<dl>`

Pour des paires **terme / description** :

```html
<dl>
  <dt>HTML</dt>
  <dd>Langage de structure des pages web.</dd>
  <dt>CSS</dt>
  <dd>Langage de mise en forme.</dd>
</dl>
```

- `<dl>` : *description list* ;
- `<dt>` : *description term* (le terme) ;
- `<dd>` : *description details* (la description).

Un terme peut avoir plusieurs descriptions, et plusieurs termes peuvent partager une description.

## Quand utiliser `<dl>` ?

Glossaires, fiches techniques (« Poids : 1,2 kg »), métadonnées (« Auteur : … », « Date : … »), FAQ simples.
MD,
            'syntax' => '<li>Parent
  <ul><li>Enfant</li></ul>
</li>
<dl><dt>Terme</dt><dd>Définition</dd></dl>',
            'example_html' => <<<'HTML'
<h2>Sommaire</h2>
<ol>
  <li>Introduction</li>
  <li>Les bases
    <ol>
      <li>Balises</li>
      <li>Attributs</li>
    </ol>
  </li>
  <li>Conclusion</li>
</ol>

<h2>Fiche technique</h2>
<dl>
  <dt>Poids</dt>
  <dd>1,2 kg</dd>
  <dt>Autonomie</dt>
  <dd>12 heures</dd>
  <dt>Couleurs</dt>
  <dd>Noir</dd>
  <dd>Argent</dd>
</dl>
HTML,
            'lines' => [
                ['  <li>Les bases', 'Le `<li>` parent contient son texte…'],
                ['    <ol>', '…puis la sous-liste, toujours à l’intérieur du `<li>`.'],
                ['  </li>', 'Le `<li>` parent se ferme après la sous-liste.'],
                ['<dl>', 'Liste de définitions pour une fiche technique.'],
                ['  <dt>Poids</dt>', 'Le terme.'],
                ['  <dd>1,2 kg</dd>', 'Sa description.'],
                ['  <dd>Noir</dd> <dd>Argent</dd>', 'Un terme peut avoir plusieurs descriptions.'],
            ],
            'reference' => [
                ['<dl>', 'Liste de définitions.'],
                ['<dt>', 'Terme.'],
                ['<dd>', 'Description du terme.'],
            ],
            'mistakes' => [
                'Placer la sous-liste entre deux `<li>` au lieu de dedans.',
                'Oublier de fermer le `<li>` parent après la sous-liste.',
                'Utiliser un tableau pour de simples paires terme/valeur.',
            ],
            'practices' => [
                'Indenter soigneusement les listes imbriquées.',
                'Limiter l’imbrication à 2 ou 3 niveaux.',
                'Utiliser `<dl>` pour les paires clé/valeur.',
            ],
            'practical' => 'Les « méga-menus » des grands sites e-commerce sont des listes imbriquées : Catégorie > Sous-catégorie > Produit. Les fiches produits utilisent souvent `<dl>` pour les caractéristiques.',
            'summary' => ['Une sous-liste se place dans un `<li>`.', '`<dl>` / `<dt>` / `<dd>` pour les paires terme/description.'],
            'challenge' => 'Codez le plan d’un site : Accueil, Services (avec 3 sous-pages), Blog (avec 2 catégories contenant chacune 2 articles), Contact.',
            'exercises' => [
                [
                    'title' => 'Une sous-liste',
                    'difficulty' => 2,
                    'instructions' => 'Dans l’élément **Fruits**, ajoutez une sous-liste `<ul>` contenant **Pomme** et **Banane**.',
                    'starter_html' => '<ul>
  <li>Fruits</li>
  <li>Légumes</li>
</ul>',
                    'solution_html' => '<ul>
  <li>Fruits
    <ul>
      <li>Pomme</li>
      <li>Banane</li>
    </ul>
  </li>
  <li>Légumes</li>
</ul>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'ul > li > ul > li', 'count' => 2, 'msg' => 'Une sous-liste de 2 éléments est dans un <li>'],
                        ['t' => 'el', 'sel' => 'li li', 'text' => 'Pomme', 'msg' => '« Pomme » est dans la sous-liste'],
                        ['t' => 'el', 'sel' => 'li li', 'text' => 'Banane', 'msg' => '« Banane » est dans la sous-liste'],
                        ['t' => 'el', 'sel' => 'ul > li', 'min' => 4, 'msg' => '« Légumes » est toujours présent'],
                    ],
                    'hint' => 'Le `</li>` de « Fruits » doit venir après le `</ul>` de la sous-liste.',
                    'explanation' => 'La sous-liste appartient à l’élément « Fruits » : elle se place à l’intérieur de son `<li>`.',
                ],
                [
                    'title' => 'Un glossaire',
                    'difficulty' => 1,
                    'instructions' => 'Créez une liste de définitions `<dl>` avec le terme **URL** et sa définition **Adresse d’une ressource sur le Web**.',
                    'starter_html' => '',
                    'solution_html' => '<dl>
  <dt>URL</dt>
  <dd>Adresse d’une ressource sur le Web</dd>
</dl>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'dl dt', 'text' => 'URL', 'msg' => 'Un terme <dt> « URL »'],
                        ['t' => 'el', 'sel' => 'dl dd', 'contains' => 'Adresse d’une ressource', 'msg' => 'Une définition <dd>'],
                    ],
                    'hint' => '`<dl><dt>…</dt><dd>…</dd></dl>`',
                    'explanation' => '`<dt>` contient le terme, `<dd>` sa description.',
                ],
            ],
            'quiz' => [
                ['q' => 'Où place-t-on une sous-liste ?', 'a' => ['Entre deux `<li>`', 'Dans un `<li>`', 'Après `</ul>`', 'Dans un `<dt>`'], 'c' => 1, 'e' => 'Elle appartient à un élément : dans son `<li>`.'],
                ['q' => 'Quelle balise contient le terme d’une liste de définitions ?', 'a' => ['`<dd>`', '`<dt>`', '`<li>`', '`<term>`'], 'c' => 1, 'e' => '`<dt>` = description term.'],
                ['q' => 'Un `<dt>` peut avoir plusieurs `<dd>`.', 'tf' => true, 'c' => true, 'e' => 'Vrai : plusieurs descriptions pour un même terme.'],
            ],
        ],
    ],
];
