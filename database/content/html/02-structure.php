<?php
return [
    'slug' => 'html-structure-page',
    'title' => 'Structure d’une page HTML',
    'description' => 'Le squelette obligatoire de tout document : DOCTYPE, html, head, body, et les règles d’écriture d’un code lisible.',
    'lessons' => [
        [
            'slug' => 'doctype-et-element-html',
            'title' => 'Le DOCTYPE et l’élément html',
            'duration' => 12,
            'intro' => <<<'MD'
Jusqu’ici, vous avez écrit des fragments de HTML. Une vraie page web est un **document complet** qui commence toujours de la même façon. Ces premières lignes semblent techniques, mais elles ont des effets très concrets : mode d’affichage du navigateur, langue lue par les synthèses vocales, traduction automatique…
MD,
            'objectives' => ['Comprendre le rôle de `<!DOCTYPE html>`', 'Connaître l’élément racine `<html>`', 'Déclarer la langue du document avec l’attribut `lang`'],
            'prerequisites' => ['Balises, éléments et attributs'],
            'theory' => <<<'MD'
## Le DOCTYPE : qu’est-ce que c’est ?

La toute première ligne d’un document HTML est :

```html
<!DOCTYPE html>
```

Ce n’est **pas une balise HTML** mais une **déclaration** : elle indique au navigateur que le document utilise le standard HTML moderne (HTML5).

## Pourquoi est-ce indispensable ?

Sans DOCTYPE, les navigateurs passent en **mode « quirks »** (mode bizarre) : ils imitent les comportements des navigateurs des années 1990 pour rester compatibles avec de très vieux sites. Résultat : certaines règles CSS (tailles des boîtes, hauteurs de lignes…) sont calculées différemment. Votre page peut alors s’afficher de façon incohérente.

Avec `<!DOCTYPE html>`, le navigateur utilise le **mode standard** : le comportement est prévisible et identique d’un navigateur moderne à l’autre.

> [!INFO] Les anciennes versions de HTML utilisaient des DOCTYPE très longs, par exemple `<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" …>`. En HTML5, la forme courte suffit. Elle n’est pas sensible à la casse, mais on l’écrit généralement ainsi.

## L’élément racine `<html>`

Tout le reste du document est contenu dans l’élément `<html>`. On l’appelle l’**élément racine** : c’est l’ancêtre de tous les autres éléments.

```html
<!DOCTYPE html>
<html lang="fr">
  …
</html>
```

## L’attribut `lang`

L’attribut `lang` déclare la **langue principale** du contenu. Il est très important :

- les **lecteurs d’écran** choisissent la bonne prononciation (un texte français lu avec une voix anglaise est incompréhensible) ;
- les **moteurs de recherche** savent à quel public s’adresse la page ;
- le navigateur peut proposer une **traduction** et appliquer les bonnes règles de césure.

Les valeurs sont des codes de langue : `fr`, `en`, `es`, `de`… On peut préciser la région : `fr-CA` (français du Canada), `en-GB`.

Si un passage est dans une autre langue, on peut l’indiquer localement :

```html
<p>Comme disent les Anglais : <span lang="en">better late than never</span>.</p>
```

## Quand l’utiliser ?

Toujours : **chaque** page HTML doit commencer par `<!DOCTYPE html>` et être entièrement contenue dans `<html lang="…">`.
MD,
            'syntax' => '<!DOCTYPE html>
<html lang="fr">
  <!-- tout le document -->
</html>',
            'example_html' => <<<'HTML'
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Ma première vraie page</title>
</head>
<body>
  <h1>Une page complète</h1>
  <p>Cette page commence par un DOCTYPE et déclare le français comme langue.</p>
  <p>Citation : <q lang="en">Stay hungry, stay foolish.</q></p>
</body>
</html>
HTML,
            'lines' => [
                ['<!DOCTYPE html>', 'Déclaration : le navigateur utilise le mode standard HTML5.'],
                ['<html lang="fr">', 'Élément racine ; la langue principale du document est le français.'],
                ['<head>', 'En-tête invisible : informations sur la page (vu à la leçon suivante).'],
                ['<meta charset="utf-8">', 'Encodage des caractères, pour afficher correctement les accents.'],
                ['<title>Ma première vraie page</title>', 'Titre affiché dans l’onglet du navigateur.'],
                ['<body>', 'Début du contenu visible.'],
                ['<q lang="en">Stay hungry…</q>', 'Citation courte en anglais : `lang` local pour la bonne prononciation.'],
                ['</html>', 'Fin du document : rien ne doit être écrit après.'],
            ],
            'reference' => [
                ['<!DOCTYPE html>', 'Déclaration du type de document (HTML5), toujours en première ligne.'],
                ['<html>', 'Élément racine qui contient tout le document.'],
                ['lang', 'Attribut indiquant la langue du contenu (`fr`, `en`, `fr-CA`…).'],
                ['<q>', 'Citation courte en ligne (le navigateur ajoute les guillemets).'],
            ],
            'mistakes' => [
                'Oublier le DOCTYPE : la page passe en mode « quirks » et le CSS se comporte de manière inattendue.',
                'Placer du contenu avant `<!DOCTYPE html>`, même un commentaire ou une ligne vide avec des espaces inutiles dans certains outils.',
                'Oublier l’attribut `lang` ou indiquer la mauvaise langue (`lang="en"` pour un site français).',
                'Écrire du contenu après `</html>`.',
            ],
            'practices' => [
                'Commencer chaque fichier par un modèle (squelette) complet que vous réutilisez.',
                'Toujours déclarer `lang` sur `<html>` ; utiliser `lang` localement pour les passages en langue étrangère.',
            ],
            'practical' => 'Les éditeurs de code professionnels proposent des raccourcis pour générer le squelette : dans VS Code, tapez `!` puis `Tab` dans un fichier `.html`. Pensez seulement à remplacer `lang="en"` par `lang="fr"` !',
            'summary' => ['`<!DOCTYPE html>` est toujours la première ligne : il active le mode standard.', '`<html>` est l’élément racine qui contient tout le document.', 'L’attribut `lang="fr"` déclare la langue pour l’accessibilité et le référencement.'],
            'challenge' => 'Créez une page complète en anglais (`lang="en"`) contenant un paragraphe en français marqué avec `lang="fr"`.',
            'exercises' => [
                [
                    'title' => 'Déclarer le document',
                    'difficulty' => 1,
                    'instructions' => 'Complétez ce document : ajoutez la déclaration `<!DOCTYPE html>` en première ligne et l’attribut `lang` avec la valeur `fr` sur l’élément `<html>`.',
                    'starter_html' => '<html>
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>',
                    'solution_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>',
                    'rules' => [
                        ['t' => 'contains', 's' => '<!DOCTYPE html>', 'ci' => true, 'msg' => 'Le document contient <!DOCTYPE html>'],
                        ['t' => 'attr', 'sel' => 'html', 'attr' => 'lang', 'value' => 'fr', 'msg' => 'L’élément <html> possède lang="fr"'],
                        ['t' => 'el', 'sel' => 'body p', 'msg' => 'Le paragraphe est toujours dans le body'],
                    ],
                    'hint' => 'Le DOCTYPE s’écrit avant `<html>`. L’attribut se place dans la balise ouvrante : `<html lang="fr">`.',
                    'explanation' => 'Tout document commence par `<!DOCTYPE html>`, suivi de l’élément racine `<html lang="fr">`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que se passe-t-il si on oublie le DOCTYPE ?', 'a' => ['La page ne s’affiche pas du tout', 'Le navigateur passe en mode de compatibilité « quirks »', 'Le CSS est ignoré', 'Rien du tout'], 'c' => 1, 'e' => 'Sans DOCTYPE, le navigateur imite d’anciens comportements (mode quirks), ce qui rend l’affichage imprévisible.'],
                ['q' => 'Quel attribut déclare la langue d’une page ?', 'a' => ['`language`', '`lang`', '`locale`', '`charset`'], 'c' => 1, 'e' => 'L’attribut `lang`, placé sur `<html>`, déclare la langue principale.'],
                ['q' => 'L’élément `<html>` est appelé l’élément racine.', 'tf' => true, 'c' => true, 'e' => 'Vrai : il contient tous les autres éléments du document.'],
            ],
        ],
        [
            'slug' => 'head-et-body',
            'title' => 'Les sections head et body',
            'duration' => 14,
            'intro' => <<<'MD'
L’élément `<html>` contient exactement deux enfants : `<head>` et `<body>`. Le premier parle **de** la page (aux navigateurs et aux moteurs de recherche), le second contient **la** page (ce que voit le visiteur). Confondre les deux est l’une des erreurs les plus fréquentes chez les débutants.
MD,
            'objectives' => ['Distinguer le rôle de `<head>` et de `<body>`', 'Écrire un `<head>` minimal correct', 'Comprendre `<meta charset>`, `<meta viewport>` et `<title>`'],
            'prerequisites' => ['Le DOCTYPE et l’élément html'],
            'theory' => <<<'MD'
## `<head>` : les informations sur la page

Le contenu de `<head>` n’est **pas affiché** dans la page. Il contient des **métadonnées** (des données sur les données) :

- l’**encodage** des caractères : `<meta charset="utf-8">` ;
- le **titre** de la page : `<title>` (onglet, favoris, résultats Google) ;
- les réglages d’affichage mobile : `<meta name="viewport" …>` ;
- les liens vers les **feuilles de style** CSS : `<link rel="stylesheet" href="style.css">` ;
- la **description** pour les moteurs de recherche, les icônes, etc.

## `<body>` : le contenu visible

Tout ce que le visiteur voit — textes, images, liens, formulaires — se place dans `<body>`. Il n’y a qu’un seul `<body>` par page.

## Les trois balises du `<head>` minimal

### `<meta charset="utf-8">`

Un ordinateur stocke les lettres sous forme de nombres. L’**encodage** est la table de correspondance. UTF-8 couvre tous les alphabets du monde, accents et emojis compris. Sans lui, « Été » peut s’afficher « Ã‰tÃ© ». Placez-le **en premier** dans le `<head>`.

### `<title>`

Le titre apparaît dans l’onglet du navigateur et comme lien cliquable dans les résultats de recherche. Il doit être **unique** pour chaque page et **descriptif** : « Contact — Boulangerie Dupain » plutôt que « Page 3 ».

### `<meta name="viewport">`

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

Sans cette ligne, les smartphones affichent la page comme sur un écran d’ordinateur de 980 pixels, puis la rétrécissent : tout devient minuscule. Cette balise est indispensable au responsive design (niveau 3).

> [!WARN] Ne placez jamais de contenu visible (titres, paragraphes) dans `<head>`. Le navigateur le déplacerait automatiquement dans `<body>`, mais votre code serait invalide.

## Le squelette complet à retenir

```html
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Titre de la page</title>
</head>
<body>
  <!-- contenu visible -->
</body>
</html>
```
MD,
            'syntax' => '<head>…métadonnées…</head>
<body>…contenu visible…</body>',
            'example_html' => <<<'HTML'
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Boulangerie Dupain — Pains et viennoiseries à Lyon</title>
  <meta name="description" content="Pains au levain, croissants pur beurre et pâtisseries maison.">
</head>
<body>
  <h1>Boulangerie Dupain</h1>
  <p>Pains au levain et viennoiseries depuis 1987.</p>
  <p>Ouvert du mardi au dimanche, de 7 h à 19 h 30.</p>
</body>
</html>
HTML,
            'lines' => [
                ['<head>', 'Début des métadonnées : rien d’ici ne s’affiche dans la page.'],
                ['<meta charset="utf-8">', 'Encodage UTF-8, en premier pour que les accents soient correctement lus.'],
                ['<meta name="viewport" …>', 'Adapte la largeur de la page à l’écran de l’appareil.'],
                ['<title>Boulangerie Dupain — …</title>', 'Titre de l’onglet et des résultats de recherche : unique et descriptif.'],
                ['<meta name="description" …>', 'Résumé proposé aux moteurs de recherche.'],
                ['</head>', 'Fin des métadonnées.'],
                ['<body>', 'Début du contenu visible par le visiteur.'],
                ['<h1>Boulangerie Dupain</h1>', 'Premier élément visible de la page.'],
            ],
            'reference' => [
                ['<head>', 'Conteneur des métadonnées (non affichées).'],
                ['<body>', 'Conteneur du contenu visible.'],
                ['<meta charset="utf-8">', 'Déclare l’encodage des caractères.'],
                ['<title>', 'Titre du document (onglet, favoris, moteurs de recherche).'],
                ['<meta name="viewport">', 'Contrôle l’affichage sur mobile.'],
                ['<link rel="stylesheet">', 'Relie une feuille de style CSS externe.'],
            ],
            'mistakes' => [
                'Placer un `<h1>` ou un `<p>` dans le `<head>`.',
                'Confondre `<title>` (dans head, onglet) et `<h1>` (dans body, titre visible).',
                'Oublier `<meta charset="utf-8">` : caractères accentués illisibles.',
                'Utiliser le même `<title>` pour toutes les pages d’un site.',
            ],
            'practices' => [
                'Placer `<meta charset="utf-8">` en toute première position du `<head>`.',
                'Rédiger des titres de 50 à 60 caractères, du plus spécifique au plus général : « Contact — Mon site ».',
                'Toujours inclure la balise viewport.',
            ],
            'practical' => 'Dans un site professionnel, le `<head>` contient souvent une quinzaine de lignes : favicon, feuilles de style, balises Open Graph pour le partage sur les réseaux sociaux, préchargement des polices… Mais la base reste la même que celle de cette leçon.',
            'summary' => ['`<head>` = informations sur la page, invisibles.', '`<body>` = contenu visible, un seul par page.', 'Head minimal : `charset`, `viewport`, `title`.', '`<title>` (onglet) ≠ `<h1>` (titre visible).'],
            'challenge' => 'Écrivez de mémoire, sans regarder, le squelette HTML complet avec `charset`, `viewport` et `title`. Comparez ensuite avec la leçon.',
            'exercises' => [
                [
                    'title' => 'Ranger le head et le body',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Le titre visible `<h1>` a été placé par erreur dans le `<head>`, et il manque le `<title>` de la page. Déplacez le `<h1>` dans le `<body>` et ajoutez un `<title>` contenant **Mon site** dans le `<head>`.',
                    'starter_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <h1>Bienvenue sur mon site</h1>
</head>
<body>
  <p>Contenu de la page.</p>
</body>
</html>',
                    'solution_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
</head>
<body>
  <h1>Bienvenue sur mon site</h1>
  <p>Contenu de la page.</p>
</body>
</html>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'head title', 'text' => 'Mon site', 'msg' => 'Le head contient <title>Mon site</title>'],
                        ['t' => 'contains', 's' => '<title>', 'msg' => 'La balise <title> est écrite dans le code'],
                        ['t' => 'el', 'sel' => 'h1', 'text' => 'Bienvenue sur mon site', 'msg' => 'Le titre <h1> est toujours présent'],
                        ['t' => 'match', 're' => '</head>[\\s\\S]*<body[^>]*>[\\s\\S]*<h1', 'msg' => 'Le <h1> est écrit dans le body, pas dans le head'],
                    ],
                    'hint' => 'Coupez la ligne du `<h1>` et collez-la juste après `<body>`. Écrivez `<title>Mon site</title>` à sa place dans le head.',
                    'explanation' => 'Le `<head>` contient uniquement des métadonnées (comme `<title>`), tandis que le contenu visible (comme `<h1>`) va dans le `<body>`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Où place-t-on le contenu visible de la page ?', 'a' => ['Dans `<head>`', 'Dans `<body>`', 'Dans `<title>`', 'Après `</html>`'], 'c' => 1, 'e' => 'Tout le contenu visible se place dans `<body>`.'],
                ['q' => 'À quoi sert `<meta charset="utf-8">` ?', 'a' => ['À choisir la police', 'À déclarer l’encodage des caractères', 'À définir la langue', 'À adapter la page aux mobiles'], 'c' => 1, 'e' => 'Il déclare l’encodage UTF-8, qui permet d’afficher correctement tous les caractères.'],
                ['q' => 'Le contenu de `<title>` s’affiche dans…', 'a' => ['le haut de la page', 'l’onglet du navigateur', 'le pied de page', 'nulle part'], 'c' => 1, 'e' => 'Le titre du document s’affiche dans l’onglet et dans les résultats des moteurs de recherche.'],
                ['q' => 'Sans balise viewport, un site peut apparaître minuscule sur smartphone.', 'tf' => true, 'c' => true, 'e' => 'Vrai : le mobile simule alors un écran large puis réduit la page.'],
            ],
        ],
        [
            'slug' => 'commentaires-et-indentation',
            'title' => 'Commentaires et indentation',
            'duration' => 10,
            'intro' => <<<'MD'
Un code est écrit une fois, mais relu des dizaines de fois : par vous dans trois mois, par un collègue, par un formateur. Deux outils simples rendent votre HTML lisible : les **commentaires** et l’**indentation**. Ils n’ont aucun effet sur l’affichage… et pourtant, ils font toute la différence entre un code amateur et un code professionnel.
MD,
            'objectives' => ['Écrire des commentaires HTML', 'Indenter correctement un document', 'Savoir quand commenter (et quand ne pas le faire)'],
            'prerequisites' => ['Head et body'],
            'theory' => <<<'MD'
## Les commentaires

Un commentaire est un texte **ignoré par le navigateur**. Il s’écrit entre `<!--` et `-->` :

```html
<!-- Ceci est un commentaire -->
<p>Ceci est affiché.</p>
```

Un commentaire peut s’étendre sur plusieurs lignes. On l’utilise pour :

- **expliquer** une partie complexe ou un choix non évident ;
- **délimiter** les grandes zones du document (`<!-- En-tête -->`, `<!-- Pied de page -->`) ;
- **désactiver temporairement** un morceau de code pendant un test.

> [!WARN] Les commentaires sont **visibles par tout le monde** via « Afficher le code source ». N’y écrivez jamais de mot de passe, d’information confidentielle ou de remarque désobligeante.

## Quand ne pas commenter ?

Un commentaire qui répète le code est inutile : `<!-- un paragraphe --><p>…</p>`. Commentez le **pourquoi**, pas le **quoi**.

## L’indentation

Indenter, c’est décaler vers la droite le contenu d’un élément par rapport à son parent. Comparez :

```html
<ul><li>Pain</li><li>Lait</li></ul><p>Liste de courses</p>
```

```html
<ul>
  <li>Pain</li>
  <li>Lait</li>
</ul>
<p>Liste de courses</p>
```

Les deux codes produisent le même affichage, mais le second montre immédiatement la hiérarchie. Conventions courantes :

- **2 espaces** par niveau (ou 4, ou une tabulation — l’important est d’être cohérent) ;
- une balise ouvrante et sa balise fermante sont **alignées** ;
- les éléments courts en ligne (`<strong>`, `<a>`) restent sur la même ligne que le texte.

> [!TIP] Dans cette plateforme, la touche `Tab` de l’éditeur indente la ligne ou la sélection, et `Maj + Tab` désindente.
MD,
            'syntax' => '<!-- Mon commentaire -->',
            'example_html' => <<<'HTML'
<!-- ===== En-tête de la page ===== -->
<h1>Recette : crêpes maison</h1>

<!-- ===== Ingrédients ===== -->
<h2>Ingrédients</h2>
<ul>
  <li>250 g de farine</li>
  <li>4 œufs</li>
  <li>50 cl de lait</li>
</ul>

<!-- Section désactivée en attendant les photos :
<h2>Galerie</h2>
<p>Photos à venir.</p>
-->

<p>Bon appétit !</p>
HTML,
            'lines' => [
                ['<!-- ===== En-tête de la page ===== -->', 'Commentaire de délimitation : repère visuel dans le code.'],
                ['<ul>', 'Liste parente, au niveau 0 d’indentation.'],
                ['  <li>250 g de farine</li>', 'Éléments enfants indentés de 2 espaces.'],
                ['</ul>', 'Balise fermante alignée avec la balise ouvrante.'],
                ['<!-- Section désactivée …', 'Commentaire sur plusieurs lignes qui désactive du code : il n’est pas affiché.'],
                ['-->', 'Fin du commentaire.'],
            ],
            'reference' => [
                ['<!-- … -->', 'Commentaire HTML, ignoré par le navigateur mais visible dans le code source.'],
                ['Indentation', 'Décalage du code enfant (2 espaces par niveau), purement visuel.'],
            ],
            'mistakes' => [
                'Oublier de fermer un commentaire avec `-->` : tout le reste de la page disparaît.',
                'Imbriquer des commentaires : `<!-- a <!-- b --> c -->` ne fonctionne pas.',
                'Écrire des informations sensibles dans les commentaires.',
                'Mélanger tabulations et espaces : l’indentation devient incohérente d’un éditeur à l’autre.',
            ],
            'practices' => [
                'Délimiter les grandes zones du document par des commentaires.',
                'Commenter les choix non évidents, pas les évidences.',
                'Supprimer le code commenté obsolète avant de publier.',
                'Choisir une convention d’indentation et s’y tenir.',
            ],
            'practical' => 'En entreprise, les équipes adoptent un **formateur automatique** (par exemple Prettier) qui indente tout le code de la même façon à chaque enregistrement : plus de débat, et un code toujours lisible.',
            'summary' => ['Un commentaire s’écrit `<!-- … -->` et n’est pas affiché.', 'Il reste visible dans le code source : rien de confidentiel.', 'L’indentation (2 espaces par niveau) révèle la hiérarchie des éléments.'],
            'challenge' => 'Reprenez l’exemple de la recette et ajoutez une section « Préparation » avec une liste numérotée `<ol>`, correctement indentée et précédée d’un commentaire de délimitation.',
            'exercises' => [
                [
                    'title' => 'Désactiver un paragraphe',
                    'difficulty' => 1,
                    'instructions' => 'Transformez le **deuxième** paragraphe en commentaire HTML pour qu’il ne s’affiche plus. Le premier paragraphe doit rester visible.',
                    'starter_html' => '<p>Ce paragraphe doit rester visible.</p>
<p>Ce paragraphe doit disparaître.</p>',
                    'solution_html' => '<p>Ce paragraphe doit rester visible.</p>
<!-- <p>Ce paragraphe doit disparaître.</p> -->',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'p', 'count' => 1, 'msg' => 'Un seul paragraphe est affiché'],
                        ['t' => 'el', 'sel' => 'p', 'text' => 'Ce paragraphe doit rester visible.', 'msg' => 'Le premier paragraphe est toujours visible'],
                        ['t' => 'contains', 's' => '<!--', 'msg' => 'Un commentaire est ouvert avec <!--'],
                        ['t' => 'contains', 's' => '-->', 'msg' => 'Le commentaire est fermé avec -->'],
                    ],
                    'hint' => 'Entourez la ligne entière avec `<!--` au début et `-->` à la fin.',
                    'explanation' => 'Tout ce qui se trouve entre `<!--` et `-->` est ignoré par le navigateur.',
                ],
                [
                    'title' => 'Les commentaires sont-ils secrets ?',
                    'type' => 'truefalse',
                    'instructions' => 'Vrai ou faux ?',
                    'question' => 'Un commentaire HTML est invisible pour les visiteurs, on peut donc y noter un mot de passe sans risque.',
                    'correct' => 1,
                    'explanation' => 'Faux : le code source (commentaires compris) est accessible à n’importe qui via « Afficher le code source ».',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle est la syntaxe d’un commentaire HTML ?', 'a' => ['`// commentaire`', '`/* commentaire */`', '`<!-- commentaire -->`', '`# commentaire`'], 'c' => 2, 'e' => 'En HTML, un commentaire s’écrit `<!-- … -->`. `/* */` est la syntaxe CSS.'],
                ['q' => 'L’indentation modifie l’affichage de la page.', 'tf' => true, 'c' => false, 'e' => 'Faux : elle sert uniquement à la lisibilité du code.'],
                ['q' => 'Que se passe-t-il si on oublie `-->` ?', 'a' => ['Rien', 'Le reste de la page est considéré comme commenté', 'Le navigateur ajoute la fermeture au bon endroit', 'Une erreur s’affiche à l’écran'], 'c' => 1, 'e' => 'Sans fermeture, tout ce qui suit est traité comme un commentaire et disparaît.'],
            ],
        ],
    ],
];
