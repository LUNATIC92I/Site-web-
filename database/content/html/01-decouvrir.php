<?php
return [
    'slug' => 'html-decouvrir',
    'title' => 'Découvrir le HTML',
    'description' => 'Ce qu’est le HTML, comment fonctionne une page web et le vocabulaire de base : balises, éléments, attributs.',
    'lessons' => [
        [
            'slug' => 'qu-est-ce-que-html',
            'title' => 'Qu’est-ce que le HTML ?',
            'duration' => 12,
            'intro' => <<<'MD'
Chaque page que vous visitez — un article de presse, une boutique en ligne, un réseau social — est d’abord un **document HTML**. Avant les couleurs, les animations et les boutons interactifs, il y a une structure : un titre, des paragraphes, des images, des liens. Cette structure, c’est le HTML qui la décrit.

Dans cette leçon, vous allez comprendre ce qu’est réellement le HTML, à quoi il sert, ce qu’il ne fait pas, et écrire votre toute première ligne de code.
MD,
            'objectives' => ['Définir ce qu’est le HTML et son rôle', 'Distinguer HTML, CSS et JavaScript', 'Comprendre la notion de langage de balisage', 'Écrire et afficher une première balise'],
            'prerequisites' => ['Aucun : cette leçon part de zéro', 'Savoir utiliser un navigateur web'],
            'theory' => <<<'MD'
## Qu’est-ce que c’est ?

**HTML** signifie *HyperText Markup Language*, soit « langage de balisage hypertexte ». Décomposons :

- **HyperText** : du texte qui contient des liens vers d’autres textes. C’est l’idée fondatrice du Web : des documents reliés entre eux.
- **Markup** (balisage) : on « marque » des morceaux de texte pour indiquer ce qu’ils sont. « Ceci est un titre », « ceci est un paragraphe », « ceci est un lien ».
- **Language** : un ensemble de règles précises que le navigateur sait lire.

Le HTML n’est **pas un langage de programmation** : il ne calcule rien, ne prend aucune décision, ne contient pas de boucles. C’est un langage de **description** : il dit au navigateur *ce que représente* chaque partie du contenu.

## Pourquoi l’utiliser ?

Sans HTML, un navigateur ne recevrait qu’un bloc de texte brut, sans hiérarchie. Le HTML permet :

- de **structurer** l’information (titres, sections, listes) ;
- de **relier** les pages entre elles grâce aux liens ;
- d’**intégrer** des images, des vidéos, des formulaires ;
- de rendre le contenu **compréhensible par les machines** : moteurs de recherche, lecteurs d’écran pour les personnes aveugles, assistants vocaux.

## Le trio du Web : HTML, CSS, JavaScript

Une page web moderne repose sur trois langages complémentaires. Une analogie courante est celle de la maison :

| Langage | Rôle | Analogie |
|---|---|---|
| HTML | La structure et le sens du contenu | Les murs, les pièces, les portes |
| CSS | L’apparence : couleurs, polices, mise en page | La peinture, la décoration |
| JavaScript | Le comportement et l’interactivité | L’électricité, la domotique |

Dans cette plateforme, vous apprenez les deux premiers : HTML puis CSS. Ce sont les fondations indispensables, même pour les développeurs qui utilisent ensuite des outils plus avancés.

## Comment ça fonctionne ?

Le principe est simple : on entoure du contenu avec des **balises**. Une balise s’écrit entre chevrons `<` et `>`.

```html
<h1>Bienvenue sur mon site</h1>
```

Ici, `<h1>` indique au navigateur : « le texte qui suit est un titre de niveau 1 ». La balise `</h1>` (avec une barre oblique) marque la fin du titre. Le navigateur affiche alors le texte en grand et en gras, et surtout, il *sait* que c’est le titre principal de la page.

> [!INFO] Le navigateur n’affiche jamais les balises elles-mêmes : il les interprète. Vous voyez le résultat, pas le code. Pour voir le code d’une page, faites un clic droit puis « Afficher le code source ».

## Quand l’utiliser — et quand ne pas l’utiliser ?

Le HTML sert **toujours** à décrire le contenu d’une page web. En revanche, il ne faut pas l’utiliser pour :

- **choisir une couleur ou une taille de texte** : c’est le rôle du CSS ;
- **faire des calculs ou réagir à un clic** : c’est le rôle de JavaScript.

Une erreur classique de débutant est de choisir une balise pour son apparence (« j’utilise un titre parce que le texte est gros »). C’est une mauvaise pratique : on choisit une balise pour son **sens**.

## Un fichier HTML, concrètement

Un document HTML est un simple **fichier texte** portant l’extension `.html` (par exemple `index.html`). Vous pouvez l’écrire avec n’importe quel éditeur de texte — dans cette plateforme, l’éditeur intégré fait le travail — puis l’ouvrir dans un navigateur.
MD,
            'syntax' => '<balise>contenu</balise>',
            'simple_html' => '<h1>Bienvenue sur mon site</h1>
<p>Ceci est mon premier paragraphe en HTML.</p>',
            'example_html' => <<<'HTML'
<h1>Le blog de Léa</h1>
<p>Bonjour ! Je m’appelle Léa et j’apprends le développement web.</p>
<h2>Mon premier article</h2>
<p>Aujourd’hui, j’ai découvert le <strong>HTML</strong> : le langage qui structure les pages web.</p>
<p>Pour en savoir plus, consultez la <a href="https://developer.mozilla.org/fr/">documentation MDN</a>.</p>
HTML,
            'lines' => [
                ['<h1>Le blog de Léa</h1>', 'Titre principal de la page (niveau 1). Il n’y en a généralement qu’un par page.'],
                ['<p>Bonjour ! Je m’appelle Léa…</p>', 'Un paragraphe de texte. La balise `<p>` s’ouvre avant le texte et se ferme après.'],
                ['<h2>Mon premier article</h2>', 'Un sous-titre (niveau 2) qui introduit une nouvelle partie du contenu.'],
                ['<p>… le <strong>HTML</strong> …</p>', 'Une balise peut en contenir une autre : `<strong>` indique un mot important à l’intérieur du paragraphe.'],
                ['<a href="https://…">documentation MDN</a>', 'Un lien hypertexte : l’attribut `href` indique l’adresse de destination.'],
            ],
            'reference' => [
                ['<h1> … <h6>', 'Titres, du plus important (h1) au moins important (h6).'],
                ['<p>', 'Paragraphe de texte.'],
                ['<strong>', 'Texte de forte importance (affiché en gras par défaut).'],
                ['<a href="…">', 'Lien hypertexte vers une autre page ou ressource.'],
            ],
            'mistakes' => [
                'Penser que le HTML est un langage de programmation : il décrit du contenu, il ne « programme » rien.',
                'Choisir une balise pour son apparence (« `<h1>` parce que c’est gros ») au lieu de son sens.',
                'Oublier la balise fermante, par exemple `<p>Bonjour` sans `</p>`.',
                'Enregistrer le fichier en `.txt` au lieu de `.html` : le navigateur l’affichera comme du texte brut.',
            ],
            'practices' => [
                'Écrire les balises en minuscules : `<p>` plutôt que `<P>`.',
                'Toujours fermer les balises qui doivent l’être.',
                'Choisir chaque balise en fonction du sens du contenu, jamais de son rendu visuel.',
                'Consulter la documentation de référence [MDN Web Docs](https://developer.mozilla.org/fr/docs/Web/HTML) en cas de doute.',
            ],
            'practical' => <<<'MD'
Sur un site réel — par exemple la page d’accueil d’une boulangerie — le HTML décrit :

- le nom de la boulangerie (titre `<h1>`) ;
- une phrase d’accroche (paragraphe `<p>`) ;
- les horaires, l’adresse, un lien vers la carte.

Le graphiste choisira ensuite les couleurs et la mise en page en CSS, **sans toucher au HTML**. C’est cette séparation entre contenu et présentation qui rend un site facile à faire évoluer.
MD,
            'summary' => ['Le HTML décrit la **structure et le sens** du contenu d’une page web.', 'Il fonctionne avec des **balises** écrites entre chevrons : `<p>…</p>`.', 'HTML = structure, CSS = apparence, JavaScript = comportement.', 'On choisit une balise pour son **sens**, pas pour son apparence.'],
            'challenge' => 'Dans l’éditeur libre, créez une mini-page de présentation avec un titre `<h1>` contenant votre prénom, un sous-titre `<h2>` « Mes passions » et deux paragraphes décrivant ce que vous aimez.',
            'exercises' => [
                [
                    'title' => 'Votre premier titre',
                    'difficulty' => 1,
                    'instructions' => 'Créez un titre de niveau 1 (`<h1>`) contenant exactement le texte **Bienvenue**.',
                    'starter_html' => '<!-- Écrivez votre code ci-dessous -->
',
                    'solution_html' => '<h1>Bienvenue</h1>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'h1', 'msg' => 'La page contient un titre <h1>'],
                        ['t' => 'el', 'sel' => 'h1', 'text' => 'Bienvenue', 'msg' => 'Le titre <h1> contient le texte « Bienvenue »'],
                        ['t' => 'contains', 's' => '</h1>', 'msg' => 'La balise <h1> est correctement fermée avec </h1>'],
                    ],
                    'hint' => 'Une balise s’ouvre avec `<h1>` et se ferme avec `</h1>`. Le texte se place entre les deux.',
                    'explanation' => 'La balise `<h1>` indique le titre principal de la page. Le contenu se place entre la balise ouvrante `<h1>` et la balise fermante `</h1>`.',
                ],
                [
                    'title' => 'Le rôle de chaque langage',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Quel langage est responsable de la **structure** et du **sens** du contenu d’une page web ?',
                    'answers' => ['CSS', 'HTML', 'JavaScript', 'PHP'],
                    'correct' => 1,
                    'explanation' => 'Le HTML structure le contenu. Le CSS gère l’apparence, JavaScript l’interactivité, et PHP s’exécute côté serveur.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que signifie l’acronyme HTML ?', 'a' => ['HyperText Markup Language', 'High Technology Modern Language', 'HyperTransfer Machine Language', 'Home Tool Markup Language'], 'c' => 0, 'e' => 'HTML = HyperText Markup Language : un langage de balisage pour des documents reliés par des liens.'],
                ['q' => 'Le HTML est un langage de programmation.', 'tf' => true, 'c' => false, 'e' => 'Faux : c’est un langage de balisage. Il décrit le contenu mais ne contient ni calcul ni logique.'],
                ['q' => 'Quel langage faut-il utiliser pour changer la couleur d’un titre ?', 'a' => ['HTML', 'CSS', 'SQL', 'Aucun, c’est impossible'], 'c' => 1, 'e' => 'L’apparence (couleurs, polices, tailles) est le rôle du CSS.'],
                ['q' => 'Quelle est la balise fermante correspondant à `<p>` ?', 'a' => ['`<p/>`', '`</p>`', '`<\p>`', '`<end p>`'], 'c' => 1, 'e' => 'Une balise fermante reprend le nom de la balise précédé d’une barre oblique : `</p>`.'],
            ],
        ],
        [
            'slug' => 'comment-fonctionne-une-page-web',
            'title' => 'Comment fonctionne une page web',
            'duration' => 12,
            'intro' => <<<'MD'
Quand vous tapez une adresse dans votre navigateur, une page s’affiche en une fraction de seconde. Que s’est-il passé entre-temps ? Comprendre ce trajet vous aidera à savoir **où** se trouvent vos fichiers, **pourquoi** un lien ou une image peut ne pas s’afficher, et **comment** le navigateur transforme du code en page visible.
MD,
            'objectives' => ['Comprendre le modèle client / serveur', 'Savoir ce qu’est une URL et ses parties', 'Comprendre comment le navigateur lit un fichier HTML', 'Connaître les outils pour écrire et tester du HTML'],
            'prerequisites' => ['Leçon « Qu’est-ce que le HTML ? »'],
            'theory' => <<<'MD'
## Le client et le serveur

Le Web fonctionne sur un modèle **client / serveur** :

1. Le **client**, c’est votre navigateur (Chrome, Firefox, Safari, Edge…).
2. Il envoie une **requête** : « donne-moi la page `/contact.html` ».
3. Le **serveur**, un ordinateur connecté en permanence à Internet, cherche le fichier et le renvoie dans une **réponse**.
4. Le navigateur reçoit le HTML, puis demande les fichiers liés (CSS, images, polices…) et construit la page.

## L’URL : l’adresse d’une ressource

Une URL (*Uniform Resource Locator*) comme `https://www.exemple.fr/blog/article.html` se décompose en :

| Partie | Exemple | Rôle |
|---|---|---|
| Protocole | `https://` | La façon de communiquer (le `s` signifie sécurisé) |
| Nom de domaine | `www.exemple.fr` | Le serveur à contacter |
| Chemin | `/blog/article.html` | Le fichier demandé sur ce serveur |

## Du code à l’affichage : le rendu

Le navigateur lit votre fichier HTML **de haut en bas**. Pour chaque balise, il crée un élément dans une structure en arbre appelée le **DOM** (*Document Object Model*). Puis il applique les styles CSS et « peint » le résultat à l’écran. C’est pourquoi l’ordre des éléments dans votre code correspond, par défaut, à leur ordre d’affichage.

> [!TIP] Le navigateur est tolérant : s’il rencontre une erreur (une balise oubliée), il essaie de deviner ce que vous vouliez. C’est pratique mais trompeur : une page peut « marcher » dans un navigateur et s’afficher différemment dans un autre. D’où l’importance d’écrire un code correct.

## Les outils du développeur

- Un **éditeur de code** : l’éditeur intégré à cette plateforme, puis plus tard VS Code (gratuit) sur votre ordinateur.
- Un **navigateur** moderne pour tester le résultat.
- Les **outils de développement** du navigateur (touche `F12`) : ils affichent le DOM, les styles appliqués et les erreurs.

## Fichiers locaux et fichiers en ligne

Quand vous ouvrez un fichier `index.html` depuis votre ordinateur, l’adresse commence par `file://` : aucun serveur n’intervient. Pour publier un site, on copie ses fichiers sur un serveur (un *hébergeur*) : il devient alors accessible via une URL en `https://`.
MD,
            'syntax' => 'https://www.exemple.fr/dossier/page.html',
            'simple_html' => '<p>Cette page a été envoyée par un serveur, puis affichée par votre navigateur.</p>',
            'example_html' => <<<'HTML'
<h1>Comment arrive cette page ?</h1>
<p>1. Vous saisissez une adresse (URL).</p>
<p>2. Le navigateur envoie une requête au serveur.</p>
<p>3. Le serveur renvoie ce fichier HTML.</p>
<p>4. Le navigateur lit le code de haut en bas et affiche la page.</p>
<p>Essayez : déplacez la ligne 5 tout en haut. L’ordre d’affichage change aussi !</p>
HTML,
            'lines' => [
                ['<h1>Comment arrive cette page ?</h1>', 'Premier élément lu par le navigateur, donc affiché en premier.'],
                ['<p>1. Vous saisissez une adresse (URL).</p>', 'Chaque paragraphe devient un élément du DOM, dans l’ordre du code.'],
                ['<p>2. Le navigateur envoie une requête…</p>', 'Le navigateur est le « client ».'],
                ['<p>3. Le serveur renvoie ce fichier HTML.</p>', 'Le serveur répond en envoyant le fichier demandé.'],
                ['<p>4. Le navigateur lit le code…</p>', 'Lecture de haut en bas : l’ordre du code = l’ordre d’affichage par défaut.'],
            ],
            'reference' => [
                ['Client', 'Le logiciel qui demande et affiche la page : le navigateur.'],
                ['Serveur', 'L’ordinateur qui stocke les fichiers du site et les envoie.'],
                ['URL', 'L’adresse unique d’une ressource sur le Web.'],
                ['DOM', 'La représentation en arbre de la page, construite par le navigateur à partir du HTML.'],
            ],
            'mistakes' => [
                'Croire que la page est « stockée » dans le navigateur : elle est téléchargée à chaque visite (sauf mise en cache).',
                'Confondre le nom du fichier et l’URL : sur un serveur, le chemin de l’URL correspond à l’emplacement du fichier.',
                'Se fier à un seul navigateur pour vérifier son code.',
            ],
            'practices' => [
                'Tester vos pages dans au moins deux navigateurs différents.',
                'Apprendre à ouvrir les outils de développement (`F12`) dès maintenant.',
                'Nommer vos fichiers en minuscules, sans espaces ni accents : `a-propos.html`.',
            ],
            'practical' => 'Lorsqu’une image ne s’affiche pas sur un site, le réflexe professionnel est d’ouvrir les outils de développement, onglet **Réseau** : on y voit chaque requête envoyée au serveur et sa réponse (par exemple une erreur 404 si le fichier n’existe pas à l’adresse indiquée).',
            'summary' => ['Le navigateur (client) demande une page, le serveur la renvoie.', 'Une URL = protocole + nom de domaine + chemin.', 'Le navigateur lit le HTML de haut en bas et construit le DOM.', 'Les outils de développement (`F12`) permettent d’inspecter une page.'],
            'challenge' => 'Ouvrez les outils de développement de votre navigateur sur cette page (touche `F12`) et trouvez la balise `<h1>` de la leçon dans l’onglet « Éléments ».',
            'exercises' => [
                [
                    'title' => 'L’ordre des éléments',
                    'type' => 'fix',
                    'difficulty' => 1,
                    'instructions' => 'Les étapes sont dans le désordre ! Réorganisez les paragraphes pour que l’**étape 1** soit affichée en premier, puis l’étape 2, puis l’étape 3.',
                    'starter_html' => '<p>Étape 3 : le navigateur affiche la page.</p>
<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>',
                    'solution_html' => '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'p', 'count' => 3, 'msg' => 'La page contient toujours trois paragraphes'],
                        ['t' => 'el', 'sel' => 'p:first-child', 'contains' => 'Étape 1', 'msg' => 'Le premier paragraphe est l’étape 1'],
                        ['t' => 'el', 'sel' => 'p:last-child', 'contains' => 'Étape 3', 'msg' => 'Le dernier paragraphe est l’étape 3'],
                    ],
                    'hint' => 'Le navigateur affiche les éléments dans l’ordre où ils apparaissent dans le code : déplacez les lignes.',
                    'explanation' => 'Le navigateur lit le HTML de haut en bas. Pour changer l’ordre d’affichage (sans CSS), il suffit de changer l’ordre des éléments dans le code.',
                ],
            ],
            'quiz' => [
                ['q' => 'Dans le modèle client / serveur, qui est le client ?', 'a' => ['L’hébergeur du site', 'Le navigateur de l’internaute', 'Le nom de domaine', 'Le fichier HTML'], 'c' => 1, 'e' => 'Le client est le logiciel qui envoie la requête et affiche la réponse : le navigateur.'],
                ['q' => 'Dans `https://www.exemple.fr/blog/page.html`, quel est le chemin ?', 'a' => ['`https://`', '`www.exemple.fr`', '`/blog/page.html`', '`.html`'], 'c' => 2, 'e' => 'Le chemin est la partie qui suit le nom de domaine : il désigne la ressource sur le serveur.'],
                ['q' => 'Le navigateur lit le code HTML de haut en bas.', 'tf' => true, 'c' => true, 'e' => 'Vrai : il construit les éléments dans l’ordre du code, ce qui détermine l’ordre d’affichage par défaut.'],
            ],
        ],
        [
            'slug' => 'balises-elements-attributs',
            'title' => 'Balises, éléments et attributs',
            'duration' => 15,
            'intro' => <<<'MD'
Trois mots reviennent sans cesse en HTML : **balise**, **élément** et **attribut**. Ils sont souvent confondus, y compris par des développeurs expérimentés. Les maîtriser dès maintenant vous permettra de lire n’importe quelle documentation et de comprendre précisément ce que vous écrivez.
MD,
            'objectives' => ['Distinguer balise, élément et attribut', 'Comprendre l’imbrication des éléments', 'Reconnaître les éléments vides (auto-fermants)', 'Écrire des attributs correctement'],
            'prerequisites' => ['Leçon « Qu’est-ce que le HTML ? »'],
            'theory' => <<<'MD'
## La balise

Une **balise** est le code entre chevrons. Il en existe deux sortes :

- la **balise ouvrante** : `<p>`
- la **balise fermante** : `</p>` (avec une barre oblique)

## L’élément

Un **élément** est l’ensemble formé par la balise ouvrante, le contenu et la balise fermante :

```html
<p>Je suis un élément paragraphe.</p>
```

C’est l’élément — pas la balise — que le navigateur place dans la page.

## L’attribut

Un **attribut** ajoute une information supplémentaire à un élément. Il s’écrit **dans la balise ouvrante**, sous la forme `nom="valeur"` :

```html
<a href="https://www.wikipedia.org" title="Encyclopédie libre">Wikipédia</a>
```

- `href` est le nom de l’attribut, `https://www.wikipedia.org` sa valeur ;
- un élément peut avoir plusieurs attributs, séparés par des espaces ;
- l’ordre des attributs n’a pas d’importance.

## Les éléments vides

Certains éléments n’ont **pas de contenu** et donc pas de balise fermante. On les appelle éléments vides :

```html
<img src="chat.jpg" alt="Un chat roux endormi">
<br>
<hr>
```

Vous verrez parfois `<br />` avec une barre à la fin : c’est une ancienne syntaxe (XHTML), acceptée mais inutile en HTML5.

## L’imbrication

Un élément peut en contenir d’autres. La règle d’or : **on ferme dans l’ordre inverse de l’ouverture** (comme des poupées russes).

```html
<p>Un mot <strong>très important</strong> ici.</p>
```

Incorrect :

```html
<p>Un mot <strong>très important</p></strong>
```

On parle alors d’élément **parent** (`<p>`) et d’élément **enfant** (`<strong>`). Cette relation parent / enfant sera essentielle en CSS.

> [!WARN] Les valeurs d’attributs doivent être entourées de guillemets droits `"…"`. Les guillemets typographiques `« »` ou `“ ”` (souvent ajoutés par les traitements de texte) cassent le code.

## Les espaces et retours à la ligne

Le navigateur **regroupe les espaces multiples** en un seul et ignore les retours à la ligne du code. Vous pouvez donc indenter librement votre code pour le rendre lisible : cela ne change pas l’affichage.
MD,
            'syntax' => '<nom attribut="valeur">contenu</nom>',
            'simple_html' => '<p title="Info-bulle au survol">Survolez ce paragraphe avec la souris.</p>',
            'example_html' => <<<'HTML'
<h1 title="Titre principal">Mon animal préféré</h1>
<p>Le chat est un animal <strong>indépendant</strong> et <em>curieux</em>.</p>
<img src="https://placehold.co/300x180/png?text=Chat" alt="Illustration d'un chat" width="300">
<p>
  En savoir plus sur
  <a href="https://fr.wikipedia.org/wiki/Chat" title="Article Wikipédia">les chats</a>.
</p>
HTML,
            'lines' => [
                ['<h1 title="Titre principal">…</h1>', 'Un élément `h1` avec un attribut `title` : une info-bulle apparaît au survol.'],
                ['<p>… <strong>indépendant</strong> et <em>curieux</em>.</p>', 'Deux éléments enfants imbriqués dans le paragraphe parent, fermés avant `</p>`.'],
                ['<img src="…" alt="…" width="300">', 'Élément vide (pas de balise fermante) avec trois attributs : la source, le texte alternatif et la largeur.'],
                ['<p>', 'Ouverture d’un paragraphe écrit sur plusieurs lignes : les retours à la ligne du code sont ignorés à l’affichage.'],
                ['<a href="…" title="…">les chats</a>', 'Un lien avec deux attributs. L’ordre des attributs n’a pas d’importance.'],
                ['</p>', 'Fermeture du paragraphe, après la fermeture de ses enfants.'],
            ],
            'reference' => [
                ['balise', 'Le code entre chevrons : `<p>` (ouvrante) ou `</p>` (fermante).'],
                ['élément', 'Balise ouvrante + contenu + balise fermante.'],
                ['attribut', 'Information supplémentaire écrite dans la balise ouvrante : `nom="valeur"`.'],
                ['élément vide', 'Élément sans contenu ni balise fermante : `<img>`, `<br>`, `<hr>`, `<input>`, `<meta>`.'],
                ['title', 'Attribut global : texte d’info-bulle affiché au survol.'],
            ],
            'mistakes' => [
                'Écrire un attribut dans la balise fermante : `</a href="…">`.',
                'Oublier les guillemets autour des valeurs contenant des espaces.',
                'Utiliser des guillemets typographiques `“ ”` copiés depuis un traitement de texte.',
                'Mal imbriquer les balises : `<p><strong>texte</p></strong>`.',
                'Ajouter une balise fermante à un élément vide : `</img>` n’existe pas.',
            ],
            'practices' => [
                'Indenter le contenu des éléments parents de deux espaces pour visualiser l’imbrication.',
                'Toujours mettre les valeurs d’attributs entre guillemets doubles.',
                'Écrire les noms de balises et d’attributs en minuscules.',
            ],
            'practical' => 'Dans un vrai projet, un même élément porte souvent plusieurs attributs : `<a href="/contact" class="bouton" title="Nous écrire">Contact</a>`. Savoir distinguer l’attribut `href` (la destination) de l’attribut `class` (utilisé par le CSS) est indispensable pour lire et modifier le code d’un collègue.',
            'summary' => ['Élément = balise ouvrante + contenu + balise fermante.', 'Les attributs se placent dans la balise ouvrante : `nom="valeur"`.', 'Les éléments vides (`<img>`, `<br>`) n’ont pas de balise fermante.', 'On ferme les balises dans l’ordre inverse de leur ouverture.'],
            'challenge' => 'Créez un paragraphe qui contient un lien, lui-même contenant un mot en `<strong>`. Ajoutez un attribut `title` au lien. Vérifiez que l’imbrication est correcte.',
            'exercises' => [
                [
                    'title' => 'Ajouter un attribut',
                    'type' => 'fill',
                    'difficulty' => 1,
                    'instructions' => 'Complétez le code : remplacez `______` par un attribut `title` dont la valeur est **Mon info-bulle**.',
                    'starter_html' => '<p ______>Survolez-moi !</p>',
                    'solution_html' => '<p title="Mon info-bulle">Survolez-moi !</p>',
                    'rules' => [
                        ['t' => 'absent', 's' => '______', 'msg' => 'Le texte « ______ » a été remplacé'],
                        ['t' => 'attr', 'sel' => 'p', 'attr' => 'title', 'msg' => 'Le paragraphe possède un attribut title'],
                        ['t' => 'attr', 'sel' => 'p', 'attr' => 'title', 'value' => 'Mon info-bulle', 'msg' => 'La valeur de title est « Mon info-bulle »'],
                    ],
                    'hint' => 'Un attribut s’écrit `nom="valeur"` dans la balise ouvrante.',
                    'explanation' => 'L’attribut `title` s’écrit dans la balise ouvrante : `<p title="Mon info-bulle">`.',
                ],
                [
                    'title' => 'Réparer une imbrication',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Ce code contient une erreur d’imbrication. Corrigez-le pour que `<strong>` soit fermé **avant** `</p>`.',
                    'starter_html' => '<p>HTML est <strong>vraiment simple</p></strong>',
                    'solution_html' => '<p>HTML est <strong>vraiment simple</strong></p>',
                    'rules' => [
                        ['t' => 'contains', 's' => '</strong></p>', 'msg' => '</strong> est fermé avant </p>'],
                        ['t' => 'el', 'sel' => 'p > strong', 'text' => 'vraiment simple', 'msg' => '<strong> est bien à l’intérieur du paragraphe'],
                    ],
                    'hint' => 'La dernière balise ouverte doit être la première fermée.',
                    'explanation' => 'Les balises se ferment dans l’ordre inverse de leur ouverture : `<p><strong>…</strong></p>`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Où place-t-on un attribut ?', 'a' => ['Dans la balise fermante', 'Dans la balise ouvrante', 'Entre les deux balises', 'Dans un fichier séparé'], 'c' => 1, 'e' => 'Les attributs s’écrivent toujours dans la balise ouvrante.'],
                ['q' => 'Lequel de ces éléments est un élément vide ?', 'a' => ['`<p>`', '`<h1>`', '`<img>`', '`<strong>`'], 'c' => 2, 'e' => '`<img>` n’a pas de contenu textuel ni de balise fermante.'],
                ['q' => 'Quelle imbrication est correcte ?', 'a' => ['`<p><em>texte</p></em>`', '`<p><em>texte</em></p>`', '`<em><p>texte</em></p>`', '`<p><em>texte</p>`'], 'c' => 1, 'e' => 'On ferme d’abord l’élément ouvert en dernier (`em`), puis son parent (`p`).'],
                ['q' => 'Plusieurs espaces consécutifs dans le code sont affichés tels quels par le navigateur.', 'tf' => true, 'c' => false, 'e' => 'Faux : le navigateur regroupe les espaces et retours à la ligne consécutifs en un seul espace.'],
            ],
        ],
    ],
];
