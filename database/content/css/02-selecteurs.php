<?php
return [
    'slug' => 'css-selecteurs',
    'title' => 'Les sélecteurs',
    'description' => 'Cibler précisément les éléments : type, classe, identifiant, combinateurs, cascade, spécificité et héritage.',
    'lessons' => [
        [
            'slug' => 'selecteurs-de-base',
            'title' => 'Sélecteurs de type, de classe et d’identifiant',
            'duration' => 15,
            'intro' => <<<'MD'
Styler tous les paragraphes d’un coup, c’est bien. Mais comment styler **un seul** paragraphe d’introduction ? Ou tous les boutons, quelle que soit leur balise ? Les sélecteurs de classe et d’identifiant sont la réponse — et ils sont au cœur de 90 % du CSS que vous écrirez.
MD,
            'objectives' => ['Utiliser les sélecteurs de type, de classe et d’identifiant', 'Ajouter des classes dans le HTML', 'Savoir quand préférer une classe à un id'],
            'prerequisites' => ['La syntaxe d’une règle CSS'],
            'theory' => <<<'MD'
## Le sélecteur de type (balise)

Cible **tous** les éléments d’un type :

```css
p { color: #333; }
```

## Le sélecteur de classe

Dans le HTML, on ajoute un attribut `class` ; dans le CSS, on cible cette classe avec un **point** :

```html
<p class="intro">Texte d’introduction</p>
```

```css
.intro { font-size: 20px; }
```

Une classe :

- peut être utilisée sur **autant d’éléments** que nécessaire, de types différents ;
- un élément peut avoir **plusieurs classes**, séparées par des espaces : `class="btn btn-primary"`.

## Le sélecteur d’identifiant

L’attribut `id` identifie **un élément unique** dans la page. En CSS, on le cible avec un **dièse** :

```html
<header id="en-tete">…</header>
```

```css
#en-tete { background: navy; }
```

## Classe ou id ?

| | Classe `.nom` | Identifiant `#nom` |
|---|---|---|
| Nombre d’éléments | Plusieurs | Un seul par page |
| Réutilisable | Oui | Non |
| Priorité (spécificité) | Moyenne | Très élevée |
| Usage recommandé en CSS | ✅ Oui | ⚠️ À limiter |

La convention moderne est de **styler avec des classes** et de réserver les `id` aux ancres, aux formulaires (`label for`) et à JavaScript. Un id est si prioritaire qu’il devient difficile à surcharger.

## Le sélecteur universel

`*` cible **tous** les éléments. Il est surtout utilisé pour des réglages globaux :

```css
* { box-sizing: border-box; }
```

## Combiner

`p.intro` cible les `<p>` qui ont la classe `intro` (sans espace entre les deux). `.btn.btn-large` cible les éléments qui ont **les deux** classes.

> [!TIP] Nommez vos classes selon leur **rôle**, pas leur apparence : `.alerte` plutôt que `.texte-rouge`. Si demain l’alerte devient orange, le nom reste juste.
MD,
            'syntax' => 'p { }        /* type */
.intro { }   /* classe */
#menu { }    /* identifiant */
* { }        /* universel */',
            'example_html' => <<<'HTML'
<header id="en-tete">
  <h1>Le Journal du Code</h1>
</header>
<p class="intro">Chaque semaine, une astuce pour mieux coder.</p>
<p>Cette semaine : les sélecteurs CSS.</p>
<p class="alerte">Nouveau : la newsletter est disponible !</p>
<a class="alerte bouton" href="#">S’abonner</a>
HTML,
            'example_css' => <<<'CSS'
* {
  font-family: system-ui, sans-serif;
}

#en-tete {
  background-color: #1e3a8a;
  color: white;
  padding: 16px;
}

p {
  color: #374151;
}

.intro {
  font-size: 20px;
  font-style: italic;
}

.alerte {
  color: #b91c1c;
  font-weight: bold;
}

.bouton {
  display: inline-block;
  padding: 8px 16px;
  border: 2px solid currentColor;
}
CSS,
            'lines' => [
                ['* {', 'Sélecteur universel : police appliquée à tous les éléments.'],
                ['#en-tete {', 'Cible l’élément unique `id="en-tete"`.'],
                ['p {', 'Cible tous les paragraphes.'],
                ['.intro {', 'Cible les éléments ayant la classe `intro`.'],
                ['.alerte {', 'S’applique à un `<p>` ET à un `<a>` : une classe se réutilise.'],
                ['.bouton {', 'Le lien a deux classes : il reçoit les styles de `.alerte` et de `.bouton`.'],
            ],
            'reference' => [
                ['element', 'Sélecteur de type : tous les éléments de cette balise.'],
                ['.classe', 'Éléments ayant cette classe.'],
                ['#id', 'L’élément ayant cet identifiant.'],
                ['*', 'Tous les éléments.'],
                ['p.intro', 'Les `<p>` ayant la classe `intro`.'],
            ],
            'mistakes' => [
                'Oublier le point : `intro { }` cible une balise `<intro>` inexistante.',
                'Mettre le point dans le HTML : `class=".intro"`.',
                'Utiliser le même `id` sur plusieurs éléments.',
                'Écrire `class="intro" class="grand"` : un seul attribut class, valeurs séparées par des espaces.',
                'Nommer les classes d’après l’apparence (`.rouge`, `.gauche`).',
            ],
            'practices' => [
                'Styler principalement avec des classes.',
                'Noms en minuscules avec tirets : `.carte-produit`.',
                'Noms selon le rôle, pas l’apparence.',
            ],
            'practical' => 'Les frameworks et design systems reposent entièrement sur les classes : `class="btn btn-primary btn-lg"`. Chaque classe apporte un aspect (base, couleur, taille), combinables à volonté.',
            'summary' => ['Type : `p` — Classe : `.nom` — Id : `#nom` — Tous : `*`.', 'Une classe se réutilise, un id est unique.', 'On style avec des classes, nommées selon leur rôle.'],
            'challenge' => 'Créez trois boutons `<a>` partageant une classe `.btn`, avec des classes de variante `.btn-succes`, `.btn-danger`, `.btn-neutre` qui changent seulement la couleur de fond.',
            'exercises' => [
                [
                    'title' => 'Styler une classe',
                    'difficulty' => 1,
                    'instructions' => 'Le second paragraphe possède la classe `important`. Écrivez une règle qui lui donne la couleur `darkred` **sans** modifier le premier paragraphe.',
                    'starter_html' => '<p>Paragraphe normal.</p>
<p class="important">Paragraphe important.</p>',
                    'solution_css' => '.important {
  color: darkred;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.important|p.important', 'prop' => 'color', 'value' => 'darkred', 'msg' => 'La classe .important est colorée en darkred'],
                        ['t' => 'noel', 'sel' => 'p[style]', 'msg' => 'Pas de style en ligne dans le HTML'],
                    ],
                    'hint' => 'Le sélecteur de classe commence par un point.',
                    'explanation' => '`.important` cible uniquement les éléments ayant `class="important"`.',
                ],
                [
                    'title' => 'Ajouter une classe',
                    'type' => 'fill',
                    'difficulty' => 1,
                    'instructions' => 'Le CSS est déjà écrit. Complétez le HTML en remplaçant `______` pour que le lien reçoive le style `.bouton`.',
                    'starter_html' => '<a href="#" ______>Commander</a>',
                    'starter_css' => '.bouton {
  background: #16a34a;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
}',
                    'solution_html' => '<a href="#" class="bouton">Commander</a>',
                    'solution_css' => '.bouton {
  background: #16a34a;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
}',
                    'rules' => [
                        ['t' => 'absent', 's' => '______', 'msg' => 'Le « ______ » est remplacé'],
                        ['t' => 'el', 'sel' => 'a.bouton', 'msg' => 'Le lien possède la classe bouton'],
                        ['t' => 'absent', 's' => 'class=".', 'msg' => 'Pas de point dans l’attribut class'],
                    ],
                    'hint' => 'Dans le HTML, on écrit `class="bouton"` sans point.',
                    'explanation' => 'Le point sert uniquement dans le sélecteur CSS ; dans le HTML, on écrit le nom de la classe seul.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel sélecteur cible les éléments `class="menu"` ?', 'a' => ['`menu`', '`#menu`', '`.menu`', '`*menu`'], 'c' => 2, 'e' => 'Le point désigne une classe.'],
                ['q' => 'Un même `id` peut être utilisé sur plusieurs éléments d’une page.', 'tf' => true, 'c' => false, 'e' => 'Faux : un identifiant doit être unique dans la page.'],
                ['q' => 'Que cible `p.note` ?', 'a' => ['Tous les p et tous les .note', 'Les p qui ont la classe note', 'Les .note à l’intérieur d’un p', 'Rien'], 'c' => 1, 'e' => 'Sans espace, le sélecteur combine les conditions sur le même élément.'],
                ['q' => 'Quel nom de classe est le meilleur ?', 'a' => ['`.bleu-gras`', '`.gauche`', '`.message-erreur`', '`.div2`'], 'c' => 2, 'e' => 'Il décrit le rôle de l’élément, pas son apparence.'],
            ],
        ],
        [
            'slug' => 'combinateurs-et-groupement',
            'title' => 'Combinateurs : descendant, enfant, frère',
            'duration' => 14,
            'intro' => <<<'MD'
Les liens du menu doivent être blancs, mais pas ceux des articles. Le premier paragraphe après un titre doit être plus grand. Pour ce genre de ciblage **selon la position** dans la page, CSS propose les **combinateurs**, qui s’appuient sur l’arbre parent/enfant du HTML.
MD,
            'objectives' => ['Utiliser le sélecteur descendant (espace)', 'Utiliser le sélecteur enfant direct (`>`)', 'Découvrir les sélecteurs de frères (`+`, `~`) et d’attribut'],
            'prerequisites' => ['Sélecteurs de type, de classe et d’identifiant'],
            'theory' => <<<'MD'
## Le descendant : l’espace

`nav a` cible les `<a>` situés **n’importe où à l’intérieur** d’un `<nav>` (enfants, petits-enfants…) :

```css
nav a { color: white; }
```

## L’enfant direct : `>`

`ul > li` cible uniquement les `<li>` qui sont **enfants directs** d’un `<ul>` (pas ceux d’une sous-liste imbriquée plus bas) :

```css
.menu > li { display: inline-block; }
```

## Le frère adjacent : `+`

`h2 + p` cible le `<p>` placé **immédiatement après** un `<h2>` (même parent) :

```css
h2 + p { font-size: 1.2em; }
```

## Les frères suivants : `~`

`h2 ~ p` cible **tous** les `<p>` qui suivent un `<h2>` au même niveau.

## Les sélecteurs d’attribut

| Sélecteur | Cible |
|---|---|
| `[title]` | éléments ayant un attribut `title` |
| `a[target="_blank"]` | liens ouverts dans un nouvel onglet |
| `a[href^="https"]` | liens dont l’adresse **commence** par https |
| `a[href$=".pdf"]` | liens dont l’adresse **finit** par .pdf |
| `input[type="email"]` | champs e-mail |

## Attention à l’espace !

| Sélecteur | Signification |
|---|---|
| `p.note` | un `<p>` qui a la classe `note` |
| `p .note` | un élément `.note` **à l’intérieur** d’un `<p>` |
| `p, .note` | les `<p>` **et** les `.note` |

> [!WARN] Évitez les sélecteurs trop longs comme `body div.page main section article p a` : ils sont fragiles (la moindre modification du HTML les casse) et difficiles à surcharger. Deux ou trois niveaux suffisent presque toujours.
MD,
            'syntax' => 'A B    /* B dans A */
A > B  /* B enfant direct de A */
A + B  /* B juste après A */
A ~ B  /* B après A */',
            'example_html' => <<<'HTML'
<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#">Blog</a>
</nav>
<article>
  <h2>Les combinateurs</h2>
  <p>Ce premier paragraphe suit directement le titre.</p>
  <p>Ce deuxième paragraphe, non. Voir le <a href="guide.pdf">guide PDF</a>.</p>
</article>
HTML,
            'example_css' => <<<'CSS'
.menu {
  background: #111827;
  padding: 12px;
}

.menu a {
  color: white;
  margin-right: 12px;
}

h2 + p {
  font-size: 20px;
  color: #1d4ed8;
}

a[href$=".pdf"] {
  color: #b91c1c;
  font-weight: bold;
}
CSS,
            'lines' => [
                ['.menu a {', 'Descendant : uniquement les liens situés dans `.menu`.'],
                ['  color: white;', 'Les liens de l’article gardent leur couleur par défaut.'],
                ['h2 + p {', 'Frère adjacent : seulement le paragraphe qui suit immédiatement le titre.'],
                ['a[href$=".pdf"] {', 'Attribut : les liens dont l’adresse se termine par `.pdf`.'],
            ],
            'reference' => [
                ['A B', 'Descendant (à n’importe quelle profondeur).'],
                ['A > B', 'Enfant direct.'],
                ['A + B', 'Frère immédiatement suivant.'],
                ['A ~ B', 'Tous les frères suivants.'],
                ['[attr="val"]', 'Attribut égal à une valeur.'],
                ['[attr^="val"] / [attr$="val"]', 'Commence par / finit par.'],
            ],
            'mistakes' => [
                'Confondre `p.note` et `p .note`.',
                'Enchaîner cinq ou six niveaux de sélecteurs.',
                'Utiliser `+` en pensant cibler tous les frères suivants (c’est `~`).',
            ],
            'practices' => [
                'Limiter la profondeur à deux ou trois niveaux.',
                'Préférer une classe dédiée quand le ciblage devient compliqué.',
                'Utiliser les sélecteurs d’attribut pour les cas « naturels » (liens externes, types de champs).',
            ],
            'practical' => 'Les sélecteurs d’attribut sont très utilisés pour signaler visuellement les liens externes (`a[target="_blank"]`) ou les fichiers à télécharger (`a[href$=".pdf"]`), sans ajouter de classes à la main.',
            'summary' => ['Espace = descendant, `>` = enfant direct.', '`+` = frère suivant immédiat, `~` = frères suivants.', '`[attr]` cible selon les attributs.', 'Des sélecteurs courts sont plus robustes.'],
            'challenge' => 'Dans un article, rendez gris et en italique tous les paragraphes qui suivent un `<blockquote>`, et ajoutez une couleur spécifique aux liens `mailto:`.',
            'exercises' => [
                [
                    'title' => 'Uniquement les liens du menu',
                    'difficulty' => 2,
                    'instructions' => 'Avec un sélecteur **descendant**, donnez la couleur `orange` uniquement aux liens situés dans l’élément `.menu`. Le lien du paragraphe ne doit pas être concerné.',
                    'starter_html' => '<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#">Contact</a>
</nav>
<p>Un <a href="#">lien normal</a> dans le texte.</p>',
                    'solution_css' => '.menu a {
  color: orange;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.menu a|nav.menu a|.menu > a|nav a', 'prop' => 'color', 'value' => 'orange', 'msg' => 'Les liens de .menu sont orange'],
                        ['t' => 'noel', 'sel' => '[style]', 'msg' => 'Aucun style en ligne'],
                    ],
                    'hint' => 'Écrivez le parent, un espace, puis l’élément ciblé : `.menu a`.',
                    'explanation' => 'Le sélecteur descendant `.menu a` ne cible que les liens contenus dans `.menu`.',
                ],
                [
                    'title' => 'Le premier paragraphe',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Quel sélecteur cible uniquement le paragraphe placé **juste après** un `<h2>` ?',
                    'answers' => ['`h2 p`', '`h2 > p`', '`h2 + p`', '`h2 ~ p`'],
                    'correct' => 2,
                    'explanation' => '`+` est le combinateur de frère adjacent.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que cible `ul > li` ?', 'a' => ['Tous les li de la page', 'Les li enfants directs d’un ul', 'Les ul dans un li', 'Le premier li'], 'c' => 1, 'e' => '`>` limite aux enfants directs.'],
                ['q' => 'Quel sélecteur cible les liens vers des fichiers PDF ?', 'a' => ['`a[href^=".pdf"]`', '`a[href$=".pdf"]`', '`a.pdf`', '`a > pdf`'], 'c' => 1, 'e' => '`$=` signifie « se termine par ».'],
                ['q' => '`nav a` cible aussi un lien situé dans une liste à l’intérieur du nav.', 'tf' => true, 'c' => true, 'e' => 'Vrai : le combinateur descendant fonctionne à toute profondeur.'],
            ],
        ],
        [
            'slug' => 'cascade-specificite-heritage',
            'title' => 'Cascade, spécificité et héritage',
            'duration' => 18,
            'intro' => <<<'MD'
« J’ai écrit `color: red`, mais mon texte reste bleu ! » C’est LA frustration classique en CSS. La raison : une autre règle l’emporte. Comprendre **la cascade**, **la spécificité** et **l’héritage**, c’est comprendre enfin pourquoi un style s’applique… ou pas.
MD,
            'objectives' => ['Comprendre l’ordre de la cascade', 'Calculer la spécificité d’un sélecteur', 'Savoir quelles propriétés sont héritées', 'Éviter `!important`'],
            'prerequisites' => ['Combinateurs : descendant, enfant, frère'],
            'theory' => <<<'MD'
## Le problème

Plusieurs règles peuvent viser le même élément avec des valeurs différentes. Le navigateur doit choisir. Il applique trois critères **dans cet ordre** :

1. l’**importance** et l’origine (`!important`, styles du navigateur, vos styles) ;
2. la **spécificité** du sélecteur ;
3. l’**ordre d’apparition** : à égalité, la dernière règle gagne.

## La spécificité : un score à trois colonnes

On compte, pour chaque sélecteur :

| Colonne | Ce qu’on compte | Exemple |
|---|---|---|
| A | les identifiants `#id` | `#menu` → (1,0,0) |
| B | les classes, attributs, pseudo-classes | `.btn`, `[type]`, `:hover` → (0,1,0) |
| C | les types et pseudo-éléments | `p`, `::before` → (0,0,1) |

On compare colonne par colonne, de gauche à droite :

| Sélecteur | Score |
|---|---|
| `p` | 0,0,1 |
| `article p` | 0,0,2 |
| `.intro` | 0,1,0 |
| `p.intro` | 0,1,1 |
| `#main .intro` | 1,1,0 |

`.intro` (0,1,0) bat `article p` (0,0,2) : une seule classe l’emporte sur n’importe quel nombre de balises. Un style en ligne (`style="…"`) bat tous les sélecteurs.

## L’ordre

```css
p { color: blue; }
p { color: green; } /* même spécificité, écrite après : gagne */
```

## `!important` : l’arme de dernier recours

`color: red !important;` passe devant toutes les règles normales. C’est tentant… et c’est un piège : pour surcharger ensuite, il faut un autre `!important`, et la feuille devient ingérable. Réservez-le à de rares cas (classes utilitaires, surcharge d’un code tiers).

## L’héritage

Certaines propriétés sont **transmises aux enfants** : essentiellement celles liées au **texte** (`color`, `font-family`, `font-size`, `line-height`, `text-align`…). C’est pourquoi on définit la police sur `body` : tous les éléments en héritent.

D’autres ne sont **pas héritées** : les boîtes (`margin`, `padding`, `border`, `width`, `background`).

Le mot-clé `inherit` force l’héritage : `a { color: inherit; }` donne aux liens la couleur de leur parent.

> [!TIP] Dans les outils de développement (`F12`), le panneau Styles liste toutes les règles appliquées, triées par priorité : les déclarations perdantes sont **barrées**. C’est la meilleure façon de comprendre un conflit.
MD,
            'syntax' => '/* spécificité : (id, classes, balises) */
#a .b p   /* 1,1,1 */',
            'example_html' => <<<'HTML'
<article class="article" id="principal">
  <p>Paragraphe 1 : quelle couleur ?</p>
  <p class="important">Paragraphe 2 : quelle couleur ?</p>
  <p>Un <a href="#">lien</a> qui hérite de la couleur.</p>
</article>
HTML,
            'example_css' => <<<'CSS'
body {
  font-family: Georgia, serif; /* hérité par tous */
}

article p {
  color: blue;        /* 0,0,2 */
}

p {
  color: gray;        /* 0,0,1 : perd contre article p */
}

.important {
  color: crimson;     /* 0,1,0 : gagne contre article p */
}

a {
  color: inherit;     /* prend la couleur du parent */
}
CSS,
            'lines' => [
                ['body { font-family: … }', 'Propriété de texte héritée par tous les descendants.'],
                ['article p { color: blue; }', 'Spécificité 0,0,2.'],
                ['p { color: gray; }', 'Écrite après mais moins spécifique (0,0,1) : elle perd.'],
                ['.important { color: crimson; }', 'Une classe (0,1,0) l’emporte sur deux balises (0,0,2).'],
                ['a { color: inherit; }', 'Le lien prend la couleur de son paragraphe (bleu).'],
            ],
            'reference' => [
                ['Spécificité', 'Score (id, classes/attributs/pseudo-classes, balises) d’un sélecteur.'],
                ['!important', 'Priorité maximale ; à éviter.'],
                ['inherit', 'Force l’héritage de la valeur du parent.'],
                ['initial', 'Remet la valeur par défaut de la propriété.'],
            ],
            'mistakes' => [
                'Ajouter `!important` partout pour « forcer » un style.',
                'Allonger les sélecteurs pour gagner en spécificité au lieu de repenser les classes.',
                'Penser que `margin` ou `border` sont hérités.',
                'Oublier qu’à spécificité égale, la dernière règle gagne.',
            ],
            'practices' => [
                'Garder des spécificités faibles et homogènes (une classe).',
                'Définir les styles de texte communs sur `body`.',
                'Inspecter les conflits avec les outils de développement.',
            ],
            'practical' => 'Quand vous intégrez un thème ou une bibliothèque, vos styles doivent la surcharger. Une méthode propre : charger votre feuille **après** celle de la bibliothèque et utiliser des sélecteurs de même spécificité. L’ordre fait alors le travail, sans `!important`.',
            'summary' => ['Ordre : importance > spécificité > ordre d’écriture.', 'Spécificité : id > classe > balise.', 'Les propriétés de texte sont héritées, pas celles des boîtes.', '`!important` est un dernier recours.'],
            'challenge' => 'Calculez la spécificité de : `nav ul li a`, `.menu a:hover`, `#top .menu a`. Classez-les de la plus faible à la plus forte.',
            'exercises' => [
                [
                    'title' => 'Gagner la cascade sans !important',
                    'difficulty' => 2,
                    'instructions' => 'Le paragraphe `.promo` reste bleu à cause de la règle `section p`. **Sans utiliser `!important`** et sans modifier le HTML, ajoutez une règle plus spécifique pour qu’il devienne `green`.',
                    'starter_html' => '<section>
  <p>Paragraphe normal.</p>
  <p class="promo">Promotion du jour !</p>
</section>',
                    'starter_css' => 'section p {
  color: blue;
}
',
                    'solution_css' => 'section p {
  color: blue;
}

section .promo {
  color: green;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => 'section .promo|section p.promo|p.promo|.promo', 'prop' => 'color', 'value' => 'green', 'msg' => 'Une règle ciblant .promo donne la couleur green'],
                        ['t' => 'absent', 's' => '!important', 'in' => 'css', 'msg' => 'Pas de !important'],
                        ['t' => 'css', 'sel' => 'section p', 'prop' => 'color', 'value' => 'blue', 'msg' => 'La règle d’origine est conservée'],
                    ],
                    'hint' => '`.promo` seul a une spécificité de 0,1,0, supérieure à `section p` (0,0,2).',
                    'explanation' => 'Une classe a une spécificité supérieure à n’importe quel nombre de balises : `.promo` ou `section .promo` l’emporte.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel sélecteur est le plus spécifique ?', 'a' => ['`div p span`', '`.texte`', '`body article p`', '`p`'], 'c' => 1, 'e' => 'Une classe (0,1,0) bat trois balises (0,0,3).'],
                ['q' => 'À spécificité égale, quelle règle gagne ?', 'a' => ['La première écrite', 'La dernière écrite', 'La plus longue', 'Aucune'], 'c' => 1, 'e' => 'L’ordre d’apparition départage : la dernière gagne.'],
                ['q' => 'Quelle propriété est héritée par les enfants ?', 'a' => ['`margin`', '`border`', '`color`', '`padding`'], 'c' => 2, 'e' => 'Les propriétés de texte comme `color` sont héritées.'],
                ['q' => 'Utiliser `!important` est une bonne pratique pour éviter les conflits.', 'tf' => true, 'c' => false, 'e' => 'Faux : il crée des conflits encore plus difficiles à résoudre.'],
            ],
        ],
    ],
];
