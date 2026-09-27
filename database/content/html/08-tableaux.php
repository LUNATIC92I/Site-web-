<?php
return [
    'slug' => 'html-tableaux',
    'title' => 'Les tableaux',
    'description' => 'Présenter des données tabulaires : structure, en-têtes, légende, groupes de lignes et fusion de cellules.',
    'lessons' => [
        [
            'slug' => 'structure-d-un-tableau',
            'title' => 'Structure d’un tableau',
            'duration' => 14,
            'intro' => <<<'MD'
Horaires d’ouverture, grille tarifaire, résultats sportifs, comparatif de produits : dès que des données se lisent **en lignes et en colonnes**, le tableau HTML est l’outil adapté. À condition de bien déclarer les en-têtes, sans quoi un lecteur d’écran ne peut pas savoir à quoi correspond une cellule.
MD,
            'objectives' => ['Construire un tableau avec `<table>`, `<tr>`, `<td>`', 'Déclarer des en-têtes avec `<th>` et `scope`', 'Ajouter une légende avec `<caption>`'],
            'prerequisites' => ['Les listes'],
            'theory' => <<<'MD'
## La structure de base

Un tableau se construit **ligne par ligne** :

```html
<table>
  <tr>
    <td>Lundi</td>
    <td>Fermé</td>
  </tr>
  <tr>
    <td>Mardi</td>
    <td>9 h – 19 h</td>
  </tr>
</table>
```

- `<table>` : le tableau ;
- `<tr>` (*table row*) : une ligne ;
- `<td>` (*table data*) : une cellule de données.

## Les en-têtes : `<th>`

Les cellules d’en-tête utilisent `<th>` (*table header*). Le navigateur les met en gras et centrées, mais surtout, elles donnent le **sens** des données.

L’attribut `scope` précise ce que l’en-tête décrit :

- `scope="col"` : l’en-tête d’une **colonne** ;
- `scope="row"` : l’en-tête d’une **ligne**.

Grâce à cela, un lecteur d’écran annonce « Mardi, Horaires : 9 h – 19 h » au lieu d’une suite de cellules sans contexte.

## La légende : `<caption>`

`<caption>` donne un **titre au tableau**. C’est le premier enfant de `<table>` :

```html
<table>
  <caption>Horaires d’ouverture de la boutique</caption>
  …
</table>
```

## Quand NE PAS utiliser un tableau

Pendant des années, les sites entiers étaient mis en page avec des tableaux. **C’est révolu** : un tableau sert uniquement à des **données tabulaires**. Pour la mise en page, on utilise CSS (Flexbox, Grid).

> [!TIP] Test simple : les cellules ont-elles un sens si on lit « en-tête de ligne + en-tête de colonne » ? Si oui, c’est un vrai tableau.
MD,
            'syntax' => '<table>
  <caption>Titre</caption>
  <tr><th scope="col">En-tête</th></tr>
  <tr><td>Donnée</td></tr>
</table>',
            'example_html' => <<<'HTML'
<table>
  <caption>Horaires d’ouverture</caption>
  <tr>
    <th scope="col">Jour</th>
    <th scope="col">Matin</th>
    <th scope="col">Après-midi</th>
  </tr>
  <tr>
    <th scope="row">Lundi</th>
    <td>Fermé</td>
    <td>14 h – 19 h</td>
  </tr>
  <tr>
    <th scope="row">Mardi</th>
    <td>9 h – 12 h</td>
    <td>14 h – 19 h</td>
  </tr>
</table>
HTML,
            'example_css' => <<<'CSS'
table {
  border-collapse: collapse;
  font-family: system-ui, sans-serif;
}

caption {
  font-weight: bold;
  margin-bottom: 8px;
}

th, td {
  border: 1px solid #cbd5e1;
  padding: 8px 12px;
  text-align: left;
}

th {
  background: #f1f5f9;
}
CSS,
            'lines' => [
                ['<caption>Horaires d’ouverture</caption>', 'Titre du tableau, juste après `<table>`.'],
                ['<th scope="col">Jour</th>', 'En-tête de colonne.'],
                ['<th scope="row">Lundi</th>', 'En-tête de ligne : il décrit toutes les cellules de sa ligne.'],
                ['<td>Fermé</td>', 'Cellule de données.'],
                ['border-collapse: collapse;', '(CSS) Fusionne les bordures doubles entre cellules.'],
            ],
            'reference' => [
                ['<table>', 'Tableau.'],
                ['<tr>', 'Ligne.'],
                ['<th>', 'Cellule d’en-tête (`scope="col"` ou `"row"`).'],
                ['<td>', 'Cellule de données.'],
                ['<caption>', 'Légende / titre du tableau.'],
            ],
            'mistakes' => [
                'Utiliser un tableau pour la mise en page.',
                'Mettre les en-têtes dans des `<td>` en gras au lieu de `<th>`.',
                'Oublier `<caption>`.',
                'Des lignes avec un nombre de cellules différent.',
                'Styler le tableau avec les attributs obsolètes `border`, `cellpadding`.',
            ],
            'practices' => [
                'Toujours des `<th>` avec `scope`.',
                'Une `<caption>` descriptive.',
                'Le style en CSS (`border-collapse`, padding).',
            ],
            'practical' => 'Les grilles tarifaires (« Formule / Prix / Engagement »), les calendriers de matchs ou les comparatifs techniques sont de vrais tableaux. Sur mobile, on les place dans un conteneur `overflow-x: auto` pour qu’ils défilent horizontalement.',
            'summary' => ['`<table>` > `<tr>` > `<th>`/`<td>`.', '`<th scope>` associe les en-têtes aux données.', '`<caption>` titre le tableau.', 'Tableau = données, jamais mise en page.'],
            'challenge' => 'Créez votre emploi du temps de la semaine (jours en colonnes, créneaux en lignes) avec en-têtes et légende.',
            'exercises' => [
                [
                    'title' => 'Un tableau de prix',
                    'difficulty' => 2,
                    'instructions' => 'Créez un tableau avec une `<caption>` **Tarifs**, une ligne d’en-têtes (`<th scope="col">`) **Produit** et **Prix**, puis deux lignes de données : **Café / 2 €** et **Thé / 2,50 €**.',
                    'starter_html' => '',
                    'solution_html' => '<table>
  <caption>Tarifs</caption>
  <tr>
    <th scope="col">Produit</th>
    <th scope="col">Prix</th>
  </tr>
  <tr>
    <td>Café</td>
    <td>2 €</td>
  </tr>
  <tr>
    <td>Thé</td>
    <td>2,50 €</td>
  </tr>
</table>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'table caption', 'text' => 'Tarifs', 'msg' => 'La légende est « Tarifs »'],
                        ['t' => 'el', 'sel' => 'th[scope=col]', 'count' => 2, 'msg' => 'Deux en-têtes de colonne avec scope="col"'],
                        ['t' => 'el', 'sel' => 'td', 'min' => 4, 'msg' => 'Au moins 4 cellules de données'],
                        ['t' => 'el', 'sel' => 'td', 'text' => 'Thé', 'msg' => 'Une cellule « Thé »'],
                        ['t' => 'el', 'sel' => 'tr', 'count' => 3, 'msg' => 'Trois lignes au total'],
                    ],
                    'hint' => 'Une ligne `<tr>` d’en-têtes, puis une `<tr>` par produit.',
                    'explanation' => 'Les en-têtes de colonnes en `<th scope="col">` donnent leur sens aux cellules de données.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle balise crée une ligne de tableau ?', 'a' => ['`<td>`', '`<tr>`', '`<th>`', '`<row>`'], 'c' => 1, 'e' => '`<tr>` = table row.'],
                ['q' => 'À quoi sert `scope="row"` sur un `<th>` ?', 'a' => ['À fusionner des lignes', 'À indiquer que l’en-tête décrit sa ligne', 'À changer la couleur', 'À trier la ligne'], 'c' => 1, 'e' => 'Il associe l’en-tête aux cellules de sa ligne.'],
                ['q' => 'Les tableaux sont recommandés pour la mise en page d’un site.', 'tf' => true, 'c' => false, 'e' => 'Faux : la mise en page se fait en CSS.'],
            ],
        ],
        [
            'slug' => 'tableaux-avances',
            'title' => 'thead, tbody, tfoot et fusion de cellules',
            'duration' => 14,
            'intro' => <<<'MD'
Un relevé bancaire a un en-tête, des lignes d’opérations et une ligne de total. Un planning a des cellules qui couvrent plusieurs créneaux. HTML sait représenter tout cela : groupes de lignes et cellules fusionnées.
MD,
            'objectives' => ['Structurer un tableau avec `<thead>`, `<tbody>`, `<tfoot>`', 'Fusionner des cellules avec `colspan` et `rowspan`'],
            'prerequisites' => ['Structure d’un tableau'],
            'theory' => <<<'MD'
## Les groupes de lignes

- `<thead>` : les lignes d’en-tête ;
- `<tbody>` : le corps des données (il peut y en avoir plusieurs) ;
- `<tfoot>` : le pied (totaux, résumés).

```html
<table>
  <thead>
    <tr><th scope="col">Article</th><th scope="col">Prix</th></tr>
  </thead>
  <tbody>
    <tr><td>Clavier</td><td>49 €</td></tr>
    <tr><td>Souris</td><td>25 €</td></tr>
  </tbody>
  <tfoot>
    <tr><th scope="row">Total</th><td>74 €</td></tr>
  </tfoot>
</table>
```

Avantages : structure claire, style ciblé (`thead th { … }`), et à l’impression d’un long tableau, l’en-tête peut être répété sur chaque page.

## Fusionner des cellules

- `colspan="2"` : la cellule s’étend sur **2 colonnes** ;
- `rowspan="3"` : la cellule s’étend sur **3 lignes**.

```html
<tr>
  <td colspan="2">Fermé toute la journée</td>
</tr>
```

Quand une cellule en fusionne plusieurs, on **retire** les cellules qu’elle recouvre : chaque ligne doit rester cohérente avec le nombre de colonnes.

> [!WARN] Les fusions complexes rendent un tableau difficile à comprendre avec un lecteur d’écran. Utilisez-les avec parcimonie, ou scindez le tableau en plusieurs tableaux plus simples.
MD,
            'syntax' => '<thead>…</thead><tbody>…</tbody><tfoot>…</tfoot>
<td colspan="2">…</td>
<td rowspan="2">…</td>',
            'example_html' => <<<'HTML'
<table>
  <caption>Commande n° 1042</caption>
  <thead>
    <tr>
      <th scope="col">Article</th>
      <th scope="col">Quantité</th>
      <th scope="col">Prix</th>
    </tr>
  </thead>
  <tbody>
    <tr><td>Carnet</td><td>2</td><td>12 €</td></tr>
    <tr><td>Stylo</td><td>5</td><td>7,50 €</td></tr>
    <tr><td colspan="2">Livraison offerte</td><td>0 €</td></tr>
  </tbody>
  <tfoot>
    <tr><th scope="row" colspan="2">Total</th><td>19,50 €</td></tr>
  </tfoot>
</table>
HTML,
            'example_css' => <<<'CSS'
table { border-collapse: collapse; font-family: system-ui, sans-serif; }
th, td { border: 1px solid #cbd5e1; padding: 8px 12px; }
thead th { background: #1e3a8a; color: white; }
tfoot { font-weight: bold; background: #f1f5f9; }
tbody tr:nth-child(even) { background: #f8fafc; }
CSS,
            'lines' => [
                ['<thead>', 'Groupe des lignes d’en-tête.'],
                ['<tbody>', 'Corps du tableau.'],
                ['<td colspan="2">Livraison offerte</td>', 'Cellule fusionnée sur 2 colonnes : la ligne n’a que 2 cellules.'],
                ['<tfoot>', 'Pied du tableau pour le total.'],
                ['<th scope="row" colspan="2">Total</th>', 'En-tête de ligne fusionné sur 2 colonnes.'],
            ],
            'reference' => [
                ['<thead> / <tbody> / <tfoot>', 'Groupes de lignes.'],
                ['colspan', 'Nombre de colonnes couvertes.'],
                ['rowspan', 'Nombre de lignes couvertes.'],
            ],
            'mistakes' => [
                'Oublier de supprimer les cellules recouvertes par une fusion.',
                'Placer des `<td>` directement dans `<table>` en mélangeant avec `<tbody>`.',
                'Multiplier les fusions au point de rendre le tableau illisible.',
            ],
            'practices' => [
                'Toujours `<thead>` et `<tbody>` pour les tableaux de données.',
                'Un `<tfoot>` pour les totaux.',
                'Des fusions simples et rares.',
            ],
            'practical' => 'Les factures, relevés et paniers de commande en ligne sont des tableaux avec `<tfoot>` pour les sous-totaux, taxes et total. Le style « zébré » (`nth-child(even)`) améliore la lecture des longues listes.',
            'summary' => ['`<thead>`, `<tbody>`, `<tfoot>` structurent le tableau.', '`colspan` / `rowspan` fusionnent des cellules.', 'Retirez les cellules recouvertes par une fusion.'],
            'challenge' => 'Créez un planning hebdomadaire où une réunion de 2 heures occupe deux lignes grâce à `rowspan`.',
            'exercises' => [
                [
                    'title' => 'Ajouter un pied de tableau',
                    'difficulty' => 2,
                    'instructions' => 'Ajoutez un `<tfoot>` au tableau contenant une ligne : une cellule `<th scope="row">` **Total** et une cellule `<td>` **30 €**.',
                    'starter_html' => '<table>
  <thead>
    <tr><th scope="col">Article</th><th scope="col">Prix</th></tr>
  </thead>
  <tbody>
    <tr><td>Livre</td><td>18 €</td></tr>
    <tr><td>Magazine</td><td>12 €</td></tr>
  </tbody>
</table>',
                    'solution_html' => '<table>
  <thead>
    <tr><th scope="col">Article</th><th scope="col">Prix</th></tr>
  </thead>
  <tbody>
    <tr><td>Livre</td><td>18 €</td></tr>
    <tr><td>Magazine</td><td>12 €</td></tr>
  </tbody>
  <tfoot>
    <tr><th scope="row">Total</th><td>30 €</td></tr>
  </tfoot>
</table>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'table tfoot', 'msg' => 'Le tableau contient un <tfoot>'],
                        ['t' => 'el', 'sel' => 'tfoot th[scope=row]', 'text' => 'Total', 'msg' => 'Un en-tête de ligne « Total »'],
                        ['t' => 'el', 'sel' => 'tfoot td', 'text' => '30 €', 'msg' => 'Une cellule « 30 € »'],
                    ],
                    'hint' => 'Le `<tfoot>` se place après le `</tbody>`.',
                    'explanation' => '`<tfoot>` regroupe les lignes de synthèse comme les totaux.',
                ],
                [
                    'title' => 'Fusion de colonnes',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Dans un tableau de 3 colonnes, une ligne contient `<td colspan="2">`. Combien d’autres `<td>` faut-il dans cette ligne ?',
                    'answers' => ['0', '1', '2', '3'],
                    'correct' => 1,
                    'explanation' => 'La cellule fusionnée occupe 2 colonnes : il en reste 1.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel élément contient la ligne des totaux ?', 'a' => ['`<thead>`', '`<tbody>`', '`<tfoot>`', '`<caption>`'], 'c' => 2, 'e' => '`<tfoot>` est le pied du tableau.'],
                ['q' => 'Quel attribut fusionne une cellule sur plusieurs lignes ?', 'a' => ['`colspan`', '`rowspan`', '`merge`', '`span`'], 'c' => 1, 'e' => '`rowspan` couvre plusieurs lignes.'],
                ['q' => 'Un tableau peut contenir plusieurs `<tbody>`.', 'tf' => true, 'c' => true, 'e' => 'Vrai : pour grouper des séries de lignes.'],
            ],
        ],
    ],
];
