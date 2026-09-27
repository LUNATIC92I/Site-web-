<?php
return [
    'slug' => 'html-mise-en-forme-texte',
    'title' => 'Mise en forme du texte',
    'description' => 'Donner du sens aux mots : importance, emphase, citations, abréviations, code, exposants et indices.',
    'lessons' => [
        [
            'slug' => 'strong-et-em',
            'title' => 'Importance et emphase : strong et em',
            'duration' => 12,
            'intro' => <<<'MD'
Mettre un mot en gras ou en italique, c’est facile. Mais en HTML, la question n’est pas « comment doit-il apparaître ? » mais « **pourquoi** ce mot est-il différent ? ». Est-il important ? Faut-il l’accentuer à l’oral ? La réponse détermine la bonne balise.
MD,
            'objectives' => ['Utiliser `<strong>` pour l’importance', 'Utiliser `<em>` pour l’emphase', 'Distinguer `<strong>`/`<b>` et `<em>`/`<i>`'],
            'prerequisites' => ['Les paragraphes'],
            'theory' => <<<'MD'
## `<strong>` : l’importance

`<strong>` signale un contenu **important, sérieux ou urgent** : un avertissement, une information clé.

```html
<p><strong>Attention :</strong> le four est encore chaud.</p>
```

Le navigateur l’affiche en gras par défaut, et certains lecteurs d’écran peuvent le signaler.

## `<em>` : l’emphase

`<em>` (*emphasis*) indique une **accentuation** qui change le sens de la phrase, comme à l’oral :

```html
<p>Je n’ai <em>jamais</em> dit ça.</p>
<p>Je n’ai jamais dit <em>ça</em>.</p>
```

Les deux phrases n’ont pas le même sens ! Le navigateur affiche `<em>` en italique.

## Et `<b>`, `<i>` ?

Ces balises existent aussi, avec un sens différent en HTML5 :

| Balise | Sens | Exemple |
|---|---|---|
| `<strong>` | Importance | Avertissement, information clé |
| `<b>` | Attirer l’attention **sans** importance particulière | Mots-clés d’un résumé, nom de produit |
| `<em>` | Emphase qui modifie le sens | Accent oral |
| `<i>` | Ton ou voix différents | Mot étranger, titre d’œuvre, pensée |

```html
<p>Le mot <i lang="la">carpe diem</i> vient du latin.</p>
```

## Quand ne pas les utiliser ?

Si vous voulez simplement du texte en gras pour **le style** (par exemple tous les noms de rubriques d’un menu), utilisez le CSS (`font-weight: bold`). Les balises HTML doivent porter un sens.

> [!TIP] Question à se poser : « Si je lisais ce texte à voix haute, changerais-je de ton ? » Si oui → `<em>`. « Le lecteur doit-il absolument voir ceci ? » → `<strong>`.
MD,
            'syntax' => '<strong>important</strong>  <em>accentué</em>',
            'example_html' => <<<'HTML'
<h1>Recette du gâteau au chocolat</h1>
<p><strong>Important :</strong> préchauffez le four à 180 °C avant de commencer.</p>
<p>Faites fondre le chocolat <em>doucement</em>, sinon il va brûler.</p>
<p>Le <i lang="it">tiramisù</i> est un autre dessert au chocolat, mais c’est une autre histoire.</p>
<p>Ingrédients clés : <b>chocolat noir</b>, <b>beurre</b> et <b>œufs</b>.</p>
HTML,
            'lines' => [
                ['<strong>Important :</strong>', 'Information à ne pas manquer : importance forte.'],
                ['<em>doucement</em>', 'Accentuation : c’est le mot sur lequel on insisterait à l’oral.'],
                ['<i lang="it">tiramisù</i>', 'Mot étranger : `<i>` avec la langue indiquée pour la prononciation.'],
                ['<b>chocolat noir</b>', 'Mots mis en évidence sans importance particulière : `<b>`.'],
            ],
            'reference' => [
                ['<strong>', 'Contenu important, sérieux ou urgent.'],
                ['<em>', 'Emphase qui modifie le sens de la phrase.'],
                ['<b>', 'Mise en évidence sans importance supplémentaire.'],
                ['<i>', 'Texte dans un ton différent (terme étranger, titre d’œuvre…).'],
            ],
            'mistakes' => [
                'Mettre des paragraphes entiers en `<strong>` : si tout est important, plus rien ne l’est.',
                'Utiliser `<strong>` pour faire un titre de section.',
                'Utiliser `<b>` et `<i>` uniquement pour leur apparence.',
            ],
            'practices' => [
                'Choisir la balise selon le sens, régler l’apparence en CSS.',
                'Utiliser `<strong>` avec parcimonie.',
                'Ajouter `lang` aux mots étrangers en `<i>`.',
            ],
            'practical' => 'Dans les conditions générales de vente d’un site, les clauses essentielles (délai de rétractation, frais) sont en `<strong>`. Dans un article, les titres d’œuvres (films, livres) sont en `<i>` ou mieux en `<cite>`.',
            'summary' => ['`<strong>` = importance ; `<em>` = emphase.', '`<b>` et `<i>` ont un sens plus faible.', 'L’apparence se gère en CSS.'],
            'challenge' => 'Écrivez un message de consignes de sécurité pour une piscine en utilisant correctement `<strong>` et `<em>`.',
            'exercises' => [
                [
                    'title' => 'Signaler une information importante',
                    'difficulty' => 1,
                    'instructions' => 'Dans le paragraphe, entourez le mot **Attention** avec la balise d’importance, et le mot **jamais** avec la balise d’emphase.',
                    'starter_html' => '<p>Attention : ne laissez jamais un enfant seul près de l’eau.</p>',
                    'solution_html' => '<p><strong>Attention</strong> : ne laissez <em>jamais</em> un enfant seul près de l’eau.</p>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'p strong', 'text' => 'Attention', 'msg' => '« Attention » est dans <strong>'],
                        ['t' => 'el', 'sel' => 'p em', 'text' => 'jamais', 'msg' => '« jamais » est dans <em>'],
                        ['t' => 'noel', 'sel' => 'b, i', 'msg' => 'Pas de <b> ni de <i> (on veut un sens, pas seulement un style)'],
                    ],
                    'hint' => '`<strong>` pour l’importance, `<em>` pour l’emphase.',
                    'explanation' => 'L’avertissement est important (`strong`) et le mot « jamais » porte l’accentuation de la phrase (`em`).',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle balise exprime une forte importance ?', 'a' => ['`<b>`', '`<strong>`', '`<em>`', '`<i>`'], 'c' => 1, 'e' => '`<strong>` porte le sens d’importance ; `<b>` n’est qu’une mise en évidence.'],
                ['q' => 'Quelle balise convient pour un mot étranger ?', 'a' => ['`<em>`', '`<strong>`', '`<i>`', '`<mark>`'], 'c' => 2, 'e' => '`<i>` représente un texte dans un ton différent, comme un terme étranger.'],
                ['q' => 'Pour mettre tous les liens du menu en gras, il faut utiliser `<strong>`.', 'tf' => true, 'c' => false, 'e' => 'Faux : c’est un choix de présentation, on utilise le CSS.'],
            ],
        ],
        [
            'slug' => 'autres-balises-de-texte',
            'title' => 'Citations, code et autres balises de texte',
            'duration' => 14,
            'intro' => <<<'MD'
HTML possède une balise pour presque chaque type de contenu textuel : une citation, une abréviation, du code informatique, une formule chimique, un texte surligné… Les utiliser, c’est rendre votre contenu plus précis, plus accessible et mieux compris des moteurs de recherche.
MD,
            'objectives' => ['Citer avec `<blockquote>`, `<q>` et `<cite>`', 'Marquer du code avec `<code>` et `<kbd>`', 'Utiliser `<abbr>`, `<mark>`, `<small>`, `<sub>`, `<sup>`'],
            'prerequisites' => ['Importance et emphase : strong et em'],
            'theory' => <<<'MD'
## Les citations

- `<blockquote>` : citation **longue**, en bloc. L’attribut `cite` peut indiquer l’URL de la source.
- `<q>` : citation **courte** dans une phrase ; le navigateur ajoute les guillemets.
- `<cite>` : le **titre d’une œuvre** (livre, film, article).

```html
<blockquote cite="https://fr.wikipedia.org/wiki/Antoine_de_Saint-Exupéry">
  <p>On ne voit bien qu’avec le cœur. L’essentiel est invisible pour les yeux.</p>
</blockquote>
<p>— Antoine de Saint-Exupéry, <cite>Le Petit Prince</cite></p>
```

## Le code informatique

- `<code>` : un fragment de code : `<code>color: red;</code>` ;
- `<kbd>` : une touche du clavier : `<kbd>Ctrl</kbd> + <kbd>C</kbd>` ;
- `<pre><code>` : un bloc de code sur plusieurs lignes.

## Autres éléments utiles

| Balise | Usage | Exemple |
|---|---|---|
| `<abbr title="…">` | Abréviation, avec sa forme complète au survol | `<abbr title="HyperText Markup Language">HTML</abbr>` |
| `<mark>` | Texte surligné (pertinent dans un contexte, ex. résultats de recherche) | `<mark>chocolat</mark>` |
| `<small>` | Mentions secondaires : copyright, petites mentions légales | `<small>© 2026</small>` |
| `<sub>` | Indice | H`<sub>2</sub>`O |
| `<sup>` | Exposant | E = mc`<sup>2</sup>`, 1`<sup>er</sup>` |
| `<del>` / `<ins>` | Texte supprimé / ajouté | Prix barré |

> [!INFO] `<sup>` et `<sub>` ont un vrai sens : l’exposant de « 1er » ou le « 2 » de H₂O font partie de l’information. Ne les utilisez pas uniquement pour réduire la taille d’un texte.
MD,
            'syntax' => '<blockquote>…</blockquote>  <q>…</q>  <code>…</code>  <abbr title="…">…</abbr>',
            'example_html' => <<<'HTML'
<h1>Fiche révision</h1>
<p>Le <abbr title="HyperText Markup Language">HTML</abbr> a été inventé par Tim Berners-Lee.</p>
<blockquote cite="https://www.w3.org/People/Berners-Lee/">
  <p>Le pouvoir du Web réside dans son universalité.</p>
</blockquote>
<p>Pour copier, appuyez sur <kbd>Ctrl</kbd> + <kbd>C</kbd>.</p>
<p>La balise <code>&lt;p&gt;</code> crée un paragraphe.</p>
<p>L’eau a pour formule H<sub>2</sub>O ; la surface d’un carré vaut c<sup>2</sup>.</p>
<p>Prix : <del>49 €</del> <ins>39 €</ins> — <mark>promotion</mark> jusqu’au 1<sup>er</sup> mai.</p>
<p><small>Document à usage pédagogique.</small></p>
HTML,
            'lines' => [
                ['<abbr title="HyperText Markup Language">HTML</abbr>', 'Abréviation : la forme complète s’affiche au survol.'],
                ['<blockquote cite="…">', 'Citation longue avec l’URL de la source dans `cite`.'],
                ['<kbd>Ctrl</kbd> + <kbd>C</kbd>', 'Touches du clavier.'],
                ['<code>&lt;p&gt;</code>', 'Code en ligne ; les entités `&lt;` `&gt;` affichent les chevrons.'],
                ['H<sub>2</sub>O … c<sup>2</sup>', 'Indice et exposant qui font partie de l’information.'],
                ['<del>49 €</del> <ins>39 €</ins>', 'Ancien prix supprimé, nouveau prix ajouté.'],
                ['<small>…</small>', 'Mention secondaire.'],
            ],
            'reference' => [
                ['<blockquote>', 'Citation longue (bloc).'],
                ['<q>', 'Citation courte en ligne.'],
                ['<cite>', 'Titre d’une œuvre.'],
                ['<code> / <kbd>', 'Code informatique / touche du clavier.'],
                ['<abbr>', 'Abréviation (attribut `title` pour la forme longue).'],
                ['<mark>', 'Texte surligné pour sa pertinence.'],
                ['<sub> / <sup>', 'Indice / exposant.'],
                ['<del> / <ins>', 'Texte supprimé / inséré.'],
            ],
            'mistakes' => [
                'Utiliser `<blockquote>` pour simplement décaler un texte vers la droite.',
                'Écrire `<p>` dans `<code>` sans entités : le navigateur crée un vrai paragraphe.',
                'Utiliser `<small>` pour réduire la taille d’un texte important.',
                'Utiliser `<sup>` pour de la décoration.',
            ],
            'practices' => [
                'Indiquer la source des citations avec l’attribut `cite` et `<cite>`.',
                'Déclarer les abréviations lors de leur première apparition.',
                'Échapper `<` et `>` avec `&lt;` et `&gt;` dans le code affiché.',
            ],
            'practical' => 'Les sites de documentation technique (comme MDN) utilisent massivement `<code>`, `<kbd>` et `<pre>`. Les boutiques en ligne utilisent `<del>` et `<ins>` pour les prix barrés, et `<mark>` pour surligner les mots recherchés.',
            'summary' => ['Citations : `<blockquote>`, `<q>`, `<cite>`.', 'Code : `<code>`, `<kbd>`, `<pre>`.', 'Sens précis : `<abbr>`, `<mark>`, `<small>`, `<sub>`, `<sup>`, `<del>`, `<ins>`.'],
            'challenge' => 'Créez une mini-fiche de chimie avec trois formules (CO₂, H₂SO₄, NaCl) et une citation de Marie Curie en `<blockquote>`.',
            'exercises' => [
                [
                    'title' => 'Formule et abréviation',
                    'difficulty' => 2,
                    'instructions' => 'Écrivez un paragraphe contenant la formule du dioxyde de carbone **CO₂** avec le 2 en indice (`<sub>`), puis l’abréviation **ONU** avec sa forme longue **Organisation des Nations unies** dans l’attribut `title`.',
                    'starter_html' => '<p></p>',
                    'solution_html' => '<p>Le CO<sub>2</sub> est un sujet majeur pour l’<abbr title="Organisation des Nations unies">ONU</abbr>.</p>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'p sub', 'text' => '2', 'msg' => 'Le chiffre 2 est en indice avec <sub>'],
                        ['t' => 'match', 're' => 'CO<sub>2</sub>', 'msg' => 'La formule s’écrit CO<sub>2</sub>'],
                        ['t' => 'el', 'sel' => 'abbr', 'text' => 'ONU', 'msg' => 'Une abréviation <abbr> contient « ONU »'],
                        ['t' => 'attr', 'sel' => 'abbr', 'attr' => 'title', 'value' => 'Organisation des Nations unies', 'msg' => 'Le title donne la forme longue'],
                    ],
                    'hint' => '`CO<sub>2</sub>` et `<abbr title="…">ONU</abbr>`.',
                    'explanation' => '`<sub>` place le texte en indice ; `<abbr>` associe une abréviation à sa signification via `title`.',
                ],
                [
                    'title' => 'Afficher une balise comme du texte',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Comment afficher littéralement le texte `<p>` dans une page ?',
                    'answers' => ['`<code><p></code>`', '`<code>&lt;p&gt;</code>`', '`<pre><p></pre>`', '`<q><p></q>`'],
                    'correct' => 1,
                    'explanation' => 'Les entités `&lt;` et `&gt;` sont affichées comme `<` et `>` sans être interprétées comme une balise.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle balise pour une citation longue ?', 'a' => ['`<q>`', '`<cite>`', '`<blockquote>`', '`<quote>`'], 'c' => 2, 'e' => '`<blockquote>` est destiné aux citations longues en bloc.'],
                ['q' => 'Comment écrire « 1er » avec l’exposant ?', 'a' => ['`1<sub>er</sub>`', '`1<sup>er</sup>`', '`1<small>er</small>`', '`<sup>1er</sup>`'], 'c' => 1, 'e' => 'L’exposant s’écrit avec `<sup>`.'],
                ['q' => 'À quoi sert l’attribut `title` de `<abbr>` ?', 'a' => ['À changer la couleur', 'À donner la forme développée', 'À créer un lien', 'À rien'], 'c' => 1, 'e' => 'Il indique la signification complète de l’abréviation.'],
                ['q' => '`<kbd>` sert à représenter une touche du clavier.', 'tf' => true, 'c' => true, 'e' => 'Vrai : par exemple `<kbd>Entrée</kbd>`.'],
            ],
        ],
    ],
];
