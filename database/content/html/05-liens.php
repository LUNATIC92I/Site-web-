<?php
return [
    'slug' => 'html-liens',
    'title' => 'Les liens',
    'description' => 'Relier les pages entre elles : liens absolus et relatifs, ancres, nouvel onglet, e-mail et téléphone.',
    'lessons' => [
        [
            'slug' => 'creer-un-lien',
            'title' => 'Créer un lien',
            'duration' => 14,
            'intro' => <<<'MD'
Le lien est l’invention qui a fait du Web… un **web** : une toile de documents reliés. Sans liens, chaque page serait une île. Dans cette leçon, vous allez créer vos premiers liens et apprendre à rédiger un texte de lien utile, accessible et efficace.
MD,
            'objectives' => ['Créer un lien avec `<a href>`', 'Rédiger un texte de lien explicite', 'Comprendre les états d’un lien (visité, survolé, focus)'],
            'prerequisites' => ['Balises, éléments et attributs'],
            'theory' => <<<'MD'
## La syntaxe

Un lien s’écrit avec l’élément `<a>` (*anchor*, ancre) et l’attribut `href` (*hypertext reference*) qui contient la destination :

```html
<a href="https://developer.mozilla.org">Documentation MDN</a>
```

- `href` : l’adresse de destination ;
- le contenu de l’élément (« Documentation MDN ») : le **texte cliquable**.

## Ce qui peut être un lien

Le contenu d’un `<a>` peut être du texte, une image, ou même un bloc entier (une carte de produit) :

```html
<a href="produit.html">
  <img src="chaussure.jpg" alt="Chaussure de course bleue, modèle Aero">
</a>
```

## Rédiger un bon texte de lien

Le texte du lien doit **décrire la destination**, même lu hors contexte. Les utilisateurs de lecteurs d’écran peuvent afficher la liste de tous les liens de la page : une liste de « Cliquez ici » est inutilisable.

| ❌ À éviter | ✅ Préférer |
|---|---|
| Pour nos tarifs, `<a>cliquez ici</a>` | Consultez `<a>nos tarifs</a>` |
| `<a>En savoir plus</a>` (×10 sur la page) | `<a>En savoir plus sur la livraison</a>` |
| `<a>https://www.exemple.fr/doc/2026/…</a>` | `<a>Guide d’installation (PDF)</a>` |

## Les états d’un lien

Par défaut, un lien est souligné et bleu ; il devient violet une fois **visité**. Il réagit aussi au **survol** et au **focus clavier** (touche `Tab`). Ces états se personnaliseront en CSS avec `:hover`, `:focus`, `:visited`. Ne supprimez jamais l’indication visuelle du focus : les personnes qui naviguent au clavier en ont besoin.

## Lien ou bouton ?

- Un **lien** (`<a>`) **mène quelque part** : une autre page, une section, un fichier.
- Un **bouton** (`<button>`) **déclenche une action** : envoyer un formulaire, ouvrir un menu.

> [!WARN] Un `<a>` sans attribut `href` n’est pas un vrai lien : il n’est pas atteignable au clavier.
MD,
            'syntax' => '<a href="destination">Texte du lien</a>',
            'simple_html' => '<a href="https://www.wikipedia.org">Wikipédia, l’encyclopédie libre</a>',
            'example_html' => <<<'HTML'
<h1>Mes ressources favorites</h1>
<p>Pour apprendre le HTML, je recommande la <a href="https://developer.mozilla.org/fr/docs/Web/HTML">documentation HTML de MDN</a>.</p>
<p>Pour vérifier mon code, j’utilise le <a href="https://validator.w3.org/" title="Service de validation du W3C">validateur du W3C</a>.</p>
<p>
  <a href="https://www.w3.org/">
    <img src="https://placehold.co/160x60/png?text=W3C" alt="Site du W3C">
  </a>
</p>
HTML,
            'lines' => [
                ['<a href="https://developer.mozilla.org/…">', 'Début du lien ; `href` contient l’adresse complète.'],
                ['documentation HTML de MDN</a>', 'Texte cliquable qui décrit clairement la destination.'],
                ['title="Service de validation du W3C"', 'Information complémentaire au survol (facultative).'],
                ['<a href="https://www.w3.org/">', 'Un lien peut contenir une image.'],
                ['<img … alt="Site du W3C">', 'Le `alt` d’une image-lien décrit la destination du lien.'],
            ],
            'reference' => [
                ['<a>', 'Élément de lien hypertexte.'],
                ['href', 'Adresse de destination du lien.'],
                ['title', 'Information complémentaire affichée au survol.'],
            ],
            'mistakes' => [
                'Écrire « cliquez ici » comme texte de lien.',
                'Oublier `https://` pour un site externe : `href="www.site.fr"` est interprété comme un chemin relatif.',
                'Utiliser un lien pour déclencher une action (au lieu d’un bouton).',
                'Imbriquer un lien dans un autre lien.',
            ],
            'practices' => [
                'Des textes de liens explicites et uniques.',
                'Une adresse complète (`https://…`) pour les sites externes.',
                'Préciser le format d’un fichier : « Rapport annuel (PDF, 2 Mo) ».',
            ],
            'practical' => 'Le menu de navigation d’un site n’est rien d’autre qu’une liste de liens. Les pieds de page regroupent les liens légaux (« Mentions légales », « Confidentialité »). Chaque bouton « Voir le produit » d’une boutique est souvent un lien stylisé en CSS.',
            'summary' => ['Un lien : `<a href="destination">texte</a>`.', 'Le texte du lien doit décrire la destination.', 'Lien = navigation ; bouton = action.'],
            'challenge' => 'Créez une page « Mes sites préférés » avec cinq liens externes, chacun dans un paragraphe expliquant pourquoi vous aimez ce site.',
            'exercises' => [
                [
                    'title' => 'Votre premier lien',
                    'difficulty' => 1,
                    'instructions' => 'Créez un lien vers `https://www.wikipedia.org` dont le texte est **Wikipédia**.',
                    'starter_html' => '<p>Mon encyclopédie préférée : </p>',
                    'solution_html' => '<p>Mon encyclopédie préférée : <a href="https://www.wikipedia.org">Wikipédia</a></p>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'a', 'msg' => 'La page contient un lien <a>'],
                        ['t' => 'attr', 'sel' => 'a', 'attr' => 'href', 'value' => 'https://www.wikipedia.org', 'msg' => 'Le href vaut https://www.wikipedia.org'],
                        ['t' => 'el', 'sel' => 'a', 'text' => 'Wikipédia', 'msg' => 'Le texte du lien est « Wikipédia »'],
                    ],
                    'hint' => '`<a href="adresse">texte</a>`',
                    'explanation' => 'L’attribut `href` contient la destination ; le contenu de `<a>` est le texte cliquable.',
                ],
                [
                    'title' => 'Un texte de lien accessible',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Le texte « cliquez ici » n’est pas accessible. Réécrivez la phrase pour que le **texte du lien** soit **nos horaires d’ouverture** (le lien doit toujours pointer vers `horaires.html`).',
                    'starter_html' => '<p>Pour connaître nos horaires d’ouverture, <a href="horaires.html">cliquez ici</a>.</p>',
                    'solution_html' => '<p>Consultez <a href="horaires.html">nos horaires d’ouverture</a>.</p>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'a', 'text' => 'nos horaires d’ouverture', 'msg' => 'Le texte du lien est « nos horaires d’ouverture »'],
                        ['t' => 'attr', 'sel' => 'a', 'attr' => 'href', 'value' => 'horaires.html', 'msg' => 'Le lien pointe toujours vers horaires.html'],
                        ['t' => 'absent', 's' => 'cliquez ici', 'ci' => true, 'msg' => 'L’expression « cliquez ici » a disparu'],
                    ],
                    'hint' => 'Déplacez les balises `<a>` et `</a>` autour des mots qui décrivent la destination.',
                    'explanation' => 'Un texte de lien doit être compréhensible hors contexte : « nos horaires d’ouverture » indique clairement où mène le lien.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel attribut contient la destination d’un lien ?', 'a' => ['`src`', '`link`', '`href`', '`url`'], 'c' => 2, 'e' => '`href` (hypertext reference) contient l’adresse de destination.'],
                ['q' => 'Quel texte de lien est le plus accessible ?', 'a' => ['« Cliquez ici »', '« Lire la suite »', '« Télécharger le guide de montage (PDF) »', '« Ici »'], 'c' => 2, 'e' => 'Il décrit précisément la destination et le format.'],
                ['q' => 'Pour envoyer un formulaire, on utilise un lien `<a>`.', 'tf' => true, 'c' => false, 'e' => 'Faux : une action se déclenche avec un `<button>`.'],
            ],
        ],
        [
            'slug' => 'liens-relatifs-absolus-ancres',
            'title' => 'Liens relatifs, absolus, ancres et nouveaux onglets',
            'duration' => 16,
            'intro' => <<<'MD'
Un site réel compte plusieurs pages, rangées dans des dossiers. Comment relier `index.html` à `contact.html` ? Comment sauter directement à une section de la page ? Comment ouvrir un site externe dans un nouvel onglet **sans risque de sécurité** ? C’est ce que couvre cette leçon essentielle.
MD,
            'objectives' => ['Distinguer URL absolue et chemin relatif', 'Naviguer dans une arborescence de dossiers (`../`)', 'Créer des ancres vers une section', 'Utiliser `target="_blank"` de façon sécurisée', 'Créer des liens e-mail et téléphone'],
            'prerequisites' => ['Créer un lien'],
            'theory' => <<<'MD'
## URL absolue

Une URL absolue contient l’adresse **complète**, protocole compris. On l’utilise pour les **sites externes** :

```html
<a href="https://www.exemple.fr/contact.html">Contact</a>
```

## Chemin relatif

Un chemin relatif indique où se trouve le fichier **par rapport à la page actuelle**. On l’utilise pour les pages **de son propre site**. Prenons cette arborescence :

```text
mon-site/
├── index.html
├── contact.html
├── blog/
│   ├── article.html
└── images/
    └── logo.png
```

| Depuis | Vers | Chemin |
|---|---|---|
| `index.html` | `contact.html` | `contact.html` |
| `index.html` | `blog/article.html` | `blog/article.html` |
| `blog/article.html` | `index.html` | `../index.html` |
| `blog/article.html` | `images/logo.png` | `../images/logo.png` |

`../` signifie « remonter d’un dossier ». Un chemin commençant par `/` part de la **racine** du site : `/contact.html`.

## Les ancres : lien vers une section

On donne un identifiant (`id`) à l’élément cible, puis on crée un lien avec `#` suivi de cet identifiant :

```html
<a href="#tarifs">Voir les tarifs</a>
…
<h2 id="tarifs">Nos tarifs</h2>
```

On peut combiner page et ancre : `href="services.html#tarifs"`. Et `href="#"` remonte en haut de page.

## Ouvrir dans un nouvel onglet

```html
<a href="https://www.exemple.fr" target="_blank" rel="noopener noreferrer">Site externe (nouvel onglet)</a>
```

- `target="_blank"` ouvre un nouvel onglet ;
- `rel="noopener"` empêche la page ouverte d’accéder à votre page via JavaScript (faille connue sous le nom de *tabnabbing*) ; `noreferrer` n’envoie pas l’adresse de votre page.

> [!TIP] N’ouvrez un nouvel onglet que lorsque c’est utile (document externe, formulaire en cours de saisie) et signalez-le dans le texte : l’utilisateur doit garder le contrôle de sa navigation.

## E-mail, téléphone et téléchargement

```html
<a href="mailto:contact@exemple.fr">contact@exemple.fr</a>
<a href="tel:+33412345678">04 12 34 56 78</a>
<a href="docs/tarifs.pdf" download>Télécharger les tarifs (PDF)</a>
```

`tel:` est particulièrement utile sur mobile : un appui lance l’appel.
MD,
            'syntax' => '<a href="page.html">…</a>
<a href="#section">…</a>
<a href="https://…" target="_blank" rel="noopener">…</a>',
            'example_html' => <<<'HTML'
<nav>
  <a href="#presentation">Présentation</a> |
  <a href="#contact">Contact</a> |
  <a href="https://www.openstreetmap.org" target="_blank" rel="noopener noreferrer">Plan d’accès (nouvel onglet)</a>
</nav>

<h1>Cabinet du Dr Martin</h1>

<h2 id="presentation">Présentation</h2>
<p>Médecine générale, consultations sur rendez-vous.</p>
<p><a href="docs/tarifs.pdf" download>Télécharger les tarifs (PDF)</a></p>

<h2 id="contact">Contact</h2>
<p>
  Téléphone : <a href="tel:+33412345678">04 12 34 56 78</a><br>
  E-mail : <a href="mailto:cabinet@exemple.fr">cabinet@exemple.fr</a>
</p>
<p><a href="#">Retour en haut</a></p>
HTML,
            'lines' => [
                ['<a href="#presentation">Présentation</a>', 'Ancre : fait défiler jusqu’à l’élément `id="presentation"`.'],
                ['<a href="https://…" target="_blank" rel="noopener noreferrer">', 'Lien externe dans un nouvel onglet, sécurisé ; le texte prévient l’utilisateur.'],
                ['<h2 id="presentation">', 'Cible de l’ancre, identifiée par son `id`.'],
                ['<a href="docs/tarifs.pdf" download>', 'Chemin relatif vers un fichier ; `download` propose le téléchargement.'],
                ['<a href="tel:+33412345678">', 'Lien téléphone au format international.'],
                ['<a href="mailto:cabinet@exemple.fr">', 'Ouvre le logiciel de messagerie.'],
                ['<a href="#">Retour en haut</a>', '`#` seul ramène en haut de la page.'],
            ],
            'reference' => [
                ['href="https://…"', 'URL absolue (site externe).'],
                ['href="dossier/page.html"', 'Chemin relatif depuis la page courante.'],
                ['href="../page.html"', 'Remonte d’un dossier.'],
                ['href="#id"', 'Ancre vers l’élément ayant cet `id`.'],
                ['target="_blank"', 'Ouvre dans un nouvel onglet.'],
                ['rel="noopener noreferrer"', 'Sécurise les liens ouverts dans un nouvel onglet.'],
                ['mailto: / tel:', 'Liens e-mail et téléphone.'],
                ['download', 'Propose de télécharger la ressource.'],
            ],
            'mistakes' => [
                'Écrire `href="www.site.fr"` sans `https://` pour un site externe.',
                'Utiliser des chemins absolus de votre ordinateur : `C:\\Users\\…\\page.html`.',
                'Oublier le `#` dans une ancre, ou mettre un `#` dans l’`id` (`id="#contact"`).',
                'Utiliser `target="_blank"` sans `rel="noopener"`.',
                'Avoir deux éléments avec le même `id` : l’ancre ne sait plus où aller.',
            ],
            'practices' => [
                'Chemins relatifs pour les pages internes, URL absolues pour l’externe.',
                'Noms de fichiers en minuscules, sans espaces ni accents.',
                'Toujours associer `target="_blank"` à `rel="noopener"`.',
                'Signaler l’ouverture d’un nouvel onglet ou d’un fichier.',
            ],
            'practical' => 'Les pages longues (FAQ, conditions générales, documentation) commencent souvent par un **sommaire** composé d’ancres. Et le bouton « Appeler » des sites de restaurants sur mobile est un simple lien `tel:`.',
            'summary' => ['URL absolue pour l’externe, chemin relatif pour l’interne.', '`../` remonte d’un dossier.', 'Ancre : `href="#id"` vers un élément `id="id"`.', '`target="_blank"` toujours avec `rel="noopener"`.', '`mailto:` et `tel:` pour contacter.'],
            'challenge' => 'Créez une FAQ de quatre questions avec un sommaire d’ancres en haut et un lien « Retour au sommaire » après chaque réponse.',
            'exercises' => [
                [
                    'title' => 'Un sommaire avec ancre',
                    'difficulty' => 2,
                    'instructions' => 'Ajoutez l’identifiant `tarifs` au titre **Nos tarifs**, puis créez en haut de page un lien **Voir les tarifs** qui mène à ce titre.',
                    'starter_html' => '<h1>Salon de coiffure</h1>
<p>Bienvenue dans notre salon.</p>
<h2>Nos tarifs</h2>
<p>Coupe : 25 €</p>',
                    'solution_html' => '<h1>Salon de coiffure</h1>
<p><a href="#tarifs">Voir les tarifs</a></p>
<p>Bienvenue dans notre salon.</p>
<h2 id="tarifs">Nos tarifs</h2>
<p>Coupe : 25 €</p>',
                    'rules' => [
                        ['t' => 'attr', 'sel' => 'h2', 'attr' => 'id', 'value' => 'tarifs', 'msg' => 'Le titre « Nos tarifs » a l’id « tarifs »'],
                        ['t' => 'attr', 'sel' => 'a', 'attr' => 'href', 'value' => '#tarifs', 'msg' => 'Un lien pointe vers #tarifs'],
                        ['t' => 'el', 'sel' => 'a', 'text' => 'Voir les tarifs', 'msg' => 'Le texte du lien est « Voir les tarifs »'],
                    ],
                    'hint' => 'La cible : `<h2 id="tarifs">`. Le lien : `<a href="#tarifs">`.',
                    'explanation' => 'Une ancre relie `href="#tarifs"` à l’élément portant `id="tarifs"` (sans le dièse).',
                ],
                [
                    'title' => 'Nouvel onglet sécurisé',
                    'type' => 'fill',
                    'difficulty' => 2,
                    'instructions' => 'Complétez les deux `______` pour que le lien s’ouvre dans un **nouvel onglet** de façon **sécurisée**.',
                    'starter_html' => '<a href="https://www.w3.org" target="______" rel="______">Site du W3C (nouvel onglet)</a>',
                    'solution_html' => '<a href="https://www.w3.org" target="_blank" rel="noopener noreferrer">Site du W3C (nouvel onglet)</a>',
                    'rules' => [
                        ['t' => 'absent', 's' => '______', 'msg' => 'Tous les « ______ » sont remplacés'],
                        ['t' => 'attr', 'sel' => 'a', 'attr' => 'target', 'value' => '_blank', 'msg' => 'target vaut _blank'],
                        ['t' => 'attr', 'sel' => 'a', 'attr' => 'rel', 'contains' => 'noopener', 'msg' => 'rel contient noopener'],
                    ],
                    'hint' => '`target="_blank"` et `rel="noopener noreferrer"`.',
                    'explanation' => '`_blank` ouvre un nouvel onglet ; `noopener` empêche la nouvelle page de contrôler la vôtre.',
                ],
                [
                    'title' => 'Chemin relatif',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Depuis `blog/article.html`, quel chemin mène à `index.html` situé à la racine du site ?',
                    'answers' => ['`index.html`', '`blog/index.html`', '`../index.html`', '`./blog/index.html`'],
                    'correct' => 2,
                    'explanation' => '`../` remonte d’un niveau, du dossier `blog/` vers la racine.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel lien mène à l’élément `<section id="equipe">` ?', 'a' => ['`<a href="equipe">`', '`<a href="#equipe">`', '`<a id="#equipe">`', '`<a href=".equipe">`'], 'c' => 1, 'e' => 'Une ancre s’écrit avec `#` suivi de l’`id` ciblé.'],
                ['q' => 'Quel attribut accompagne toujours `target="_blank"` ?', 'a' => ['`rel="noopener"`', '`title`', '`download`', '`lang`'], 'c' => 0, 'e' => '`rel="noopener"` protège contre le tabnabbing.'],
                ['q' => 'Que signifie `../` dans un chemin ?', 'a' => ['Le dossier courant', 'Remonter d’un dossier', 'La racine du disque', 'Un dossier caché'], 'c' => 1, 'e' => '`../` désigne le dossier parent.'],
                ['q' => 'Un lien `tel:` permet de lancer un appel sur mobile.', 'tf' => true, 'c' => true, 'e' => 'Vrai : par exemple `href="tel:+33412345678"`.'],
            ],
        ],
    ],
];
