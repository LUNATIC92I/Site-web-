<?php
return [
    'slug' => 'html-titres-paragraphes',
    'title' => 'Titres et paragraphes',
    'description' => 'Hiérarchiser l’information avec les titres, écrire des paragraphes, gérer les sauts de ligne et les séparations.',
    'lessons' => [
        [
            'slug' => 'les-titres-h1-h6',
            'title' => 'Les titres de h1 à h6',
            'duration' => 12,
            'intro' => <<<'MD'
Avant même de lire, un visiteur **survole** une page : il repère les titres pour savoir si elle répond à sa question. Les moteurs de recherche et les lecteurs d’écran font exactement la même chose. Les titres HTML ne sont donc pas une affaire de taille de texte : ils construisent le **plan** de votre page.
MD,
            'objectives' => ['Connaître les six niveaux de titres', 'Construire une hiérarchie de titres logique', 'Comprendre l’impact des titres sur l’accessibilité et le SEO'],
            'prerequisites' => ['Structure d’une page HTML'],
            'theory' => <<<'MD'
## Six niveaux de titres

HTML propose six balises de titres, de `<h1>` (le plus important) à `<h6>` (le moins important) :

```html
<h1>Titre principal de la page</h1>
<h2>Grande partie</h2>
<h3>Sous-partie</h3>
<h4>Sous-sous-partie</h4>
```

Par défaut, le navigateur affiche `h1` en très grand et `h6` en petit, mais **la taille est secondaire** : c’est le CSS qui décidera de l’apparence finale.

## Le plan du document

Pensez à la table des matières d’un livre :

```text
h1  Guide du jardinage
  h2  Les légumes
    h3  Les tomates
    h3  Les courgettes
  h2  Les fleurs
    h3  Les roses
```

Chaque titre introduit la section qui le suit, jusqu’au prochain titre de même niveau ou de niveau supérieur.

## Les règles d’une bonne hiérarchie

1. **Un seul `<h1>` par page** : il décrit le sujet principal (souvent proche du `<title>`).
2. **Ne sautez pas de niveau** : après un `h2`, on utilise un `h3`, pas directement un `h4`.
3. **Ne choisissez jamais un titre pour sa taille** : si vous voulez un texte plus gros qui n’est pas un titre, utilisez le CSS.
4. N’utilisez pas un titre pour un texte qui n’introduit pas de section (un slogan, une citation).

## Pourquoi c’est important ?

- Les **utilisateurs de lecteurs d’écran** naviguent de titre en titre (touche `H`) pour comprendre la page, comme vous la survolez des yeux.
- Les **moteurs de recherche** utilisent les titres pour comprendre les sujets traités.
- Un plan clair aide **tous** les lecteurs à trouver l’information.

> [!TIP] Testez votre plan : lisez uniquement vos titres, dans l’ordre. Si vous comprenez le contenu de la page, la hiérarchie est bonne.
MD,
            'syntax' => '<h1>…</h1>  <h2>…</h2>  <h3>…</h3>  <h4>…</h4>  <h5>…</h5>  <h6>…</h6>',
            'simple_html' => '<h1>Guide du jardinage</h1>
<h2>Les légumes</h2>
<h3>Les tomates</h3>',
            'example_html' => <<<'HTML'
<h1>Guide du jardinage pour débutants</h1>
<p>Tout ce qu’il faut savoir pour réussir son premier potager.</p>

<h2>Les légumes faciles</h2>
<h3>Les tomates</h3>
<p>Plantez-les en mai, au soleil, et arrosez au pied.</p>
<h3>Les courgettes</h3>
<p>Très productives : deux pieds suffisent pour une famille.</p>

<h2>Les fleurs</h2>
<h3>Les roses</h3>
<p>Taillez-les à la fin de l’hiver.</p>
HTML,
            'lines' => [
                ['<h1>Guide du jardinage pour débutants</h1>', 'Le sujet de la page : un seul h1.'],
                ['<h2>Les légumes faciles</h2>', 'Première grande partie.'],
                ['<h3>Les tomates</h3>', 'Sous-partie de « Les légumes faciles ».'],
                ['<h3>Les courgettes</h3>', 'Autre sous-partie du même niveau.'],
                ['<h2>Les fleurs</h2>', 'Nouvelle grande partie : on remonte au niveau 2.'],
                ['<h3>Les roses</h3>', 'Sous-partie de « Les fleurs ».'],
            ],
            'reference' => [
                ['<h1>', 'Titre principal de la page (un seul).'],
                ['<h2>', 'Titre d’une grande section.'],
                ['<h3> à <h6>', 'Sous-sections de plus en plus spécifiques.'],
            ],
            'mistakes' => [
                'Mettre plusieurs `<h1>` pour avoir plusieurs gros titres.',
                'Utiliser `<h4>` juste après `<h2>` parce que sa taille plaît davantage.',
                'Mettre un paragraphe entier dans une balise de titre.',
                'Utiliser `<strong>` en guise de titre de section : il n’apparaît pas dans le plan.',
            ],
            'practices' => [
                'Un seul `<h1>` décrivant le sujet de la page.',
                'Une hiérarchie sans saut de niveau.',
                'Des titres courts et explicites.',
                'Régler la taille des titres en CSS, jamais en changeant de niveau.',
            ],
            'practical' => 'Sur un site e-commerce, la fiche produit a pour `<h1>` le nom du produit, puis des `<h2>` « Description », « Caractéristiques », « Avis clients ». Chaque avis peut commencer par un `<h3>`. Cette structure aide Google à afficher des extraits enrichis.',
            'summary' => ['Six niveaux de titres : `<h1>` à `<h6>`.', 'Un seul `<h1>`, pas de saut de niveau.', 'Les titres construisent le plan de la page, la taille se règle en CSS.'],
            'challenge' => 'Rédigez le plan (titres uniquement) d’une page « Visiter Paris » avec au moins trois `h2` et deux `h3` sous chacun.',
            'exercises' => [
                [
                    'title' => 'Construire un plan',
                    'difficulty' => 1,
                    'instructions' => 'Créez un plan de page : un `<h1>` **Mes voyages**, puis deux `<h2>` : **Europe** et **Asie**. Sous « Europe », ajoutez un `<h3>` **Italie**.',
                    'starter_html' => '',
                    'solution_html' => '<h1>Mes voyages</h1>
<h2>Europe</h2>
<h3>Italie</h3>
<h2>Asie</h2>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'h1', 'count' => 1, 'text' => 'Mes voyages', 'msg' => 'Un unique <h1> « Mes voyages »'],
                        ['t' => 'el', 'sel' => 'h2', 'text' => 'Europe', 'msg' => 'Un <h2> « Europe »'],
                        ['t' => 'el', 'sel' => 'h2', 'text' => 'Asie', 'msg' => 'Un <h2> « Asie »'],
                        ['t' => 'el', 'sel' => 'h3', 'text' => 'Italie', 'msg' => 'Un <h3> « Italie »'],
                        ['t' => 'match', 're' => 'Europe\s*</h2>\s*<h3[^>]*>\s*Italie', 'msg' => 'Le <h3> « Italie » est placé juste après « Europe »'],
                    ],
                    'hint' => 'L’ordre du code est important : le `<h3>` doit suivre le `<h2>` dont il dépend.',
                    'explanation' => 'Le `<h3>` « Italie » dépend du `<h2>` « Europe » qui le précède ; « Asie » ouvre ensuite une nouvelle section de niveau 2.',
                ],
                [
                    'title' => 'Hiérarchie des titres',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Après un `<h2>`, quel titre utiliser pour une sous-partie ?',
                    'answers' => ['`<h1>`', '`<h3>`', '`<h4>`', '`<h6>`'],
                    'correct' => 1,
                    'explanation' => 'On descend d’un seul niveau à la fois : une sous-partie d’un `h2` est un `h3`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Combien de `<h1>` une page devrait-elle contenir ?', 'a' => ['Aucun', 'Un seul', 'Deux', 'Autant qu’on veut'], 'c' => 1, 'e' => 'Un seul `<h1>` décrit le sujet principal de la page.'],
                ['q' => 'On choisit le niveau d’un titre en fonction de sa taille d’affichage.', 'tf' => true, 'c' => false, 'e' => 'Faux : le niveau reflète la hiérarchie du contenu ; la taille se règle en CSS.'],
                ['q' => 'Qui utilise les titres pour naviguer dans une page ?', 'a' => ['Uniquement les moteurs de recherche', 'Uniquement les lecteurs d’écran', 'Les lecteurs, les lecteurs d’écran et les moteurs de recherche', 'Personne'], 'c' => 2, 'e' => 'Tout le monde en profite : humains, technologies d’assistance et robots.'],
            ],
        ],
        [
            'slug' => 'les-paragraphes',
            'title' => 'Les paragraphes',
            'duration' => 10,
            'intro' => <<<'MD'
Le paragraphe est l’élément le plus utilisé du Web. Simple en apparence, il cache quelques comportements surprenants : pourquoi vos retours à la ligne disparaissent-ils ? Pourquoi un espace entre deux paragraphes apparaît-il tout seul ? Cette leçon répond à ces questions.
MD,
            'objectives' => ['Écrire des paragraphes avec `<p>`', 'Comprendre la gestion des espaces et des retours à la ligne', 'Savoir ce qu’un paragraphe peut contenir'],
            'prerequisites' => ['Les titres de h1 à h6'],
            'theory' => <<<'MD'
## Comprendre

Un paragraphe regroupe une ou plusieurs phrases qui développent **une même idée**. En HTML, il s’écrit avec `<p>` :

```html
<p>Bonjour le monde</p>
```

Décomposons :

- `<p>` = balise ouvrante ;
- `Bonjour le monde` = contenu ;
- `</p>` = balise fermante.

## Un élément de type « bloc »

Un paragraphe est un élément **bloc** : il occupe toute la largeur disponible et commence sur une nouvelle ligne. Le navigateur ajoute par défaut une **marge** au-dessus et en dessous, ce qui crée l’espace entre deux paragraphes. Cet espace se modifie en CSS (`margin`).

## Les espaces sont « fusionnés »

Dans le code, plusieurs espaces, tabulations ou retours à la ligne consécutifs sont affichés comme **un seul espace** :

```html
<p>Ce     texte
   s’affichera
   sur une seule ligne.</p>
```

Pour créer un nouveau paragraphe, on ferme le premier et on en ouvre un autre. Ne multipliez pas les espaces pour « aligner » un texte : c’est le travail du CSS.

## Ce qu’un paragraphe peut contenir

Un `<p>` contient du **texte** et des éléments **en ligne** : `<strong>`, `<em>`, `<a>`, `<img>`, `<br>`…

Il ne peut **pas** contenir d’éléments blocs comme un autre `<p>`, un titre `<h2>` ou une liste `<ul>`. Si vous le faites, le navigateur ferme automatiquement le paragraphe avant, ce qui produit un résultat inattendu.

> [!WARN] `<p><h2>Titre</h2></p>` est invalide : un titre ne se place jamais dans un paragraphe.

## Quand ne pas l’utiliser ?

N’utilisez pas de paragraphe vide `<p></p>` ou `<p>&nbsp;</p>` pour créer de l’espace : ajustez les marges en CSS.
MD,
            'syntax' => '<p>Texte du paragraphe.</p>',
            'example_html' => <<<'HTML'
<h1>Le café</h1>
<p>Le café est une boisson préparée à partir des graines torréfiées du caféier.</p>
<p>
  Originaire d’Éthiopie, il est aujourd’hui cultivé dans plus de
  <strong>70 pays</strong>, principalement en Amérique latine.
</p>
<p>Ce     paragraphe    contient    beaucoup    d’espaces,
mais le navigateur n’en affiche qu’un seul à chaque fois.</p>
HTML,
            'lines' => [
                ['<p>Le café est une boisson…</p>', 'Paragraphe simple sur une ligne.'],
                ['<p>', 'Ouverture d’un paragraphe écrit sur plusieurs lignes, pour la lisibilité du code.'],
                ['<strong>70 pays</strong>', 'Un élément en ligne à l’intérieur d’un paragraphe : autorisé.'],
                ['</p>', 'Fermeture : le texte forme un seul paragraphe malgré les retours à la ligne du code.'],
                ['<p>Ce     paragraphe …', 'Les espaces multiples sont fusionnés en un seul à l’affichage.'],
            ],
            'reference' => [
                ['<p>', 'Paragraphe de texte (élément bloc).'],
                ['&nbsp;', 'Espace insécable : empêche un retour à la ligne entre deux mots (ex. `10&nbsp;€`).'],
            ],
            'mistakes' => [
                'Oublier de fermer `</p>`.',
                'Placer un titre ou une liste dans un paragraphe.',
                'Multiplier les espaces ou les `<p></p>` vides pour créer de l’espace.',
                'Écrire tout un article dans un seul paragraphe géant.',
            ],
            'practices' => [
                'Une idée = un paragraphe.',
                'Des paragraphes courts, plus faciles à lire à l’écran.',
                'Utiliser `&nbsp;` entre un nombre et son unité : `20&nbsp;km`.',
            ],
            'practical' => 'Dans un blog, chaque article est une suite de `<h2>` et de `<p>`. Les rédacteurs web visent des paragraphes de 2 à 4 phrases : un texte aéré est lu jusqu’au bout bien plus souvent.',
            'summary' => ['`<p>` crée un paragraphe, élément bloc.', 'Les espaces et retours à la ligne du code sont fusionnés.', 'Un paragraphe ne contient que du texte et des éléments en ligne.'],
            'challenge' => 'Écrivez un court article de trois paragraphes sur votre film préféré, avec un titre `<h1>` et un mot important en `<strong>` dans chaque paragraphe.',
            'exercises' => [
                [
                    'title' => 'Deux paragraphes',
                    'difficulty' => 1,
                    'instructions' => 'Sous le titre, écrivez **deux paragraphes** distincts. Le premier doit contenir le mot **HTML**, le second le mot **CSS**.',
                    'starter_html' => '<h1>Mes premiers pas</h1>
',
                    'solution_html' => '<h1>Mes premiers pas</h1>
<p>J’apprends le HTML pour structurer mes pages.</p>
<p>Ensuite, j’apprendrai le CSS pour les mettre en forme.</p>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'p', 'min' => 2, 'msg' => 'Au moins deux paragraphes <p>'],
                        ['t' => 'el', 'sel' => 'p', 'contains' => 'HTML', 'msg' => 'Un paragraphe contient « HTML »'],
                        ['t' => 'el', 'sel' => 'p', 'contains' => 'CSS', 'msg' => 'Un paragraphe contient « CSS »'],
                    ],
                    'hint' => 'Chaque paragraphe a sa propre paire `<p>` … `</p>`.',
                    'explanation' => 'Deux idées distinctes forment deux paragraphes : on ferme le premier `</p>` avant d’ouvrir le second.',
                ],
                [
                    'title' => 'Un titre dans un paragraphe ?',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Ce code place un titre à l’intérieur d’un paragraphe, ce qui est invalide. Corrigez-le : le `<h2>` doit être placé **avant** le paragraphe, pas dedans.',
                    'starter_html' => '<p><h2>Horaires</h2>Ouvert tous les jours de 9 h à 18 h.</p>',
                    'solution_html' => '<h2>Horaires</h2>
<p>Ouvert tous les jours de 9 h à 18 h.</p>',
                    'rules' => [
                        ['t' => 'match', 're' => '</h2>\s*<p', 'msg' => 'Le paragraphe commence après le titre'],
                        ['t' => 'el', 'sel' => 'p', 'contains' => 'Ouvert tous les jours', 'msg' => 'Le texte des horaires est dans un paragraphe'],
                        ['t' => 'absent', 's' => '<p><h2>', 'msg' => 'Le titre n’est plus dans le paragraphe'],
                    ],
                    'hint' => 'Écrivez d’abord `<h2>Horaires</h2>`, puis `<p>…</p>`.',
                    'explanation' => 'Un paragraphe ne peut contenir que des éléments en ligne ; un titre est un élément bloc indépendant.',
                ],
            ],
            'quiz' => [
                ['q' => 'Comment le navigateur affiche-t-il 5 espaces consécutifs dans un paragraphe ?', 'a' => ['5 espaces', 'Un seul espace', 'Un retour à la ligne', 'Aucun espace'], 'c' => 1, 'e' => 'Les espaces blancs consécutifs sont fusionnés en un seul.'],
                ['q' => 'Quel élément peut être placé dans un `<p>` ?', 'a' => ['`<h2>`', '`<ul>`', '`<strong>`', '`<p>`'], 'c' => 2, 'e' => '`<strong>` est un élément en ligne ; les autres sont des éléments blocs.'],
                ['q' => 'Un paragraphe est un élément de type bloc.', 'tf' => true, 'c' => true, 'e' => 'Vrai : il occupe toute la largeur et commence sur une nouvelle ligne.'],
            ],
        ],
        [
            'slug' => 'sauts-de-ligne-et-separateurs',
            'title' => 'Sauts de ligne et séparateurs',
            'duration' => 10,
            'intro' => <<<'MD'
Parfois, un retour à la ligne fait partie du contenu lui-même : une adresse postale, un poème, les paroles d’une chanson. Et parfois, on veut marquer un changement de sujet. HTML propose deux éléments vides pour cela : `<br>` et `<hr>`. Encore faut-il savoir quand **ne pas** les utiliser.
MD,
            'objectives' => ['Utiliser `<br>` pour un saut de ligne significatif', 'Utiliser `<hr>` pour une rupture thématique', 'Découvrir `<pre>` pour conserver la mise en forme'],
            'prerequisites' => ['Les paragraphes'],
            'theory' => <<<'MD'
## `<br>` : le saut de ligne

`<br>` (*break*) force un retour à la ligne **à l’intérieur** d’un même bloc de texte. C’est un élément vide : pas de balise fermante.

```html
<p>
  Boulangerie Dupain<br>
  12 rue des Lilas<br>
  69001 Lyon
</p>
```

Utilisez-le quand le retour à la ligne **a un sens** : adresse, poème, signature.

**N’utilisez pas** `<br><br>` pour espacer des paragraphes ou des blocs : créez de vrais paragraphes et réglez les marges en CSS.

## `<hr>` : la rupture thématique

`<hr>` (*horizontal rule*) marque un **changement de sujet** au sein d’une section, comme un saut de scène dans un roman. Le navigateur l’affiche par défaut comme une ligne horizontale, mais son sens est la **séparation**, pas la ligne décorative.

```html
<p>Fin du premier chapitre.</p>
<hr>
<p>Trois ans plus tard…</p>
```

## `<pre>` : texte préformaté

`<pre>` conserve **tous** les espaces et retours à la ligne du code, et affiche le texte dans une police à chasse fixe. Utile pour des extraits de code ou de l’art ASCII.

```html
<pre>
  /\_/\
 ( o.o )
  > ^ <
</pre>
```

> [!INFO] Pour afficher des balises comme du texte (par exemple dans un tutoriel), remplacez `<` par `&lt;` et `>` par `&gt;` : ce sont des **entités HTML**.
MD,
            'syntax' => 'Ligne 1<br>Ligne 2
<hr>',
            'example_html' => <<<'HTML'
<h1>Contact</h1>
<p>
  <strong>Boulangerie Dupain</strong><br>
  12 rue des Lilas<br>
  69001 Lyon
</p>
<hr>
<h2>Poème du jour</h2>
<p>
  Le pain chaud du matin,<br>
  L’odeur qui danse au coin,<br>
  Et la journée commence bien.
</p>
<pre>
Horaires :
  Mardi-Samedi   7h - 19h30
  Dimanche       7h - 13h
</pre>
HTML,
            'lines' => [
                ['<strong>Boulangerie Dupain</strong><br>', 'Nom en gras, suivi d’un saut de ligne : l’adresse continue dans le même paragraphe.'],
                ['12 rue des Lilas<br>', 'Chaque ligne de l’adresse est séparée par `<br>`.'],
                ['<hr>', 'Changement de sujet : on passe du contact au poème.'],
                ['Le pain chaud du matin,<br>', 'Dans un poème, les retours à la ligne font partie du texte.'],
                ['<pre>', 'Texte préformaté : les espaces d’alignement sont conservés.'],
            ],
            'reference' => [
                ['<br>', 'Saut de ligne à l’intérieur d’un texte (élément vide).'],
                ['<hr>', 'Rupture thématique entre deux paragraphes (élément vide).'],
                ['<pre>', 'Texte préformaté : espaces et retours à la ligne conservés.'],
                ['&lt; &gt; &amp;', 'Entités pour écrire `<`, `>` et `&` comme du texte.'],
            ],
            'mistakes' => [
                'Enchaîner `<br><br><br>` pour créer de l’espace vertical.',
                'Utiliser `<br>` à la place de paragraphes distincts.',
                'Écrire `</br>` : `<br>` n’a pas de balise fermante.',
                'Utiliser `<hr>` comme simple décoration.',
            ],
            'practices' => [
                'Réserver `<br>` aux retours à la ligne qui font partie du contenu.',
                'Gérer tous les espacements en CSS.',
                'Utiliser `<hr>` pour un vrai changement de sujet.',
            ],
            'practical' => 'Dans un pied de page, l’adresse de l’entreprise utilise souvent `<br>` (idéalement dans un élément `<address>`, vu plus tard). Les séparations visuelles entre sections, elles, sont faites en CSS avec des bordures.',
            'summary' => ['`<br>` = saut de ligne significatif (adresse, poème).', '`<hr>` = rupture thématique.', '`<pre>` conserve la mise en forme du texte.', 'Les espacements se gèrent en CSS, pas avec des `<br>`.'],
            'challenge' => 'Écrivez votre carte de visite : nom, métier, adresse sur trois lignes, puis un `<hr>` et une phrase de présentation.',
            'exercises' => [
                [
                    'title' => 'Une adresse postale',
                    'difficulty' => 1,
                    'instructions' => 'Dans **un seul paragraphe**, écrivez une adresse sur trois lignes (nom, rue, ville) en utilisant **deux** balises `<br>`.',
                    'starter_html' => '',
                    'solution_html' => '<p>
  Marie Curie<br>
  11 rue Pierre et Marie Curie<br>
  75005 Paris
</p>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'p', 'count' => 1, 'msg' => 'Un seul paragraphe'],
                        ['t' => 'el', 'sel' => 'p br', 'min' => 2, 'msg' => 'Au moins deux <br> dans le paragraphe'],
                        ['t' => 'absent', 's' => '</br>', 'msg' => 'Pas de balise fermante </br> (élément vide)'],
                    ],
                    'hint' => 'Écrivez `<br>` à la fin de la première et de la deuxième ligne.',
                    'explanation' => 'Une adresse est un seul bloc d’information : un paragraphe avec des sauts de ligne `<br>`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle balise marque un changement de sujet ?', 'a' => ['`<br>`', '`<hr>`', '`<pre>`', '`<line>`'], 'c' => 1, 'e' => '`<hr>` représente une rupture thématique.'],
                ['q' => 'Quelle est la bonne façon d’espacer deux paragraphes ?', 'a' => ['`<br><br>`', 'Des `<p></p>` vides', 'La propriété CSS `margin`', 'Des espaces'], 'c' => 2, 'e' => 'L’espacement est une question de présentation : on utilise le CSS.'],
                ['q' => '`<br>` possède une balise fermante `</br>`.', 'tf' => true, 'c' => false, 'e' => 'Faux : `<br>` est un élément vide.'],
            ],
        ],
    ],
];
