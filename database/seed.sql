-- =====================================================================
-- HTML & CSS Academy — Données initiales (généré par database/build-seed.php)
-- Ne pas modifier à la main : éditez database/content/ puis relancez le script.
-- Contenu : 2 catégories, 6 cours, 2 modules, 6 leçons, 9 exercices, 23 questions, 4 projets, 13 badges.
-- Comptes de DÉMONSTRATION (voir README.md) : à supprimer avant une mise en production.
-- =====================================================================

USE html_css_academy;
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DELETE FROM `activity_log`;
DELETE FROM `certificates`;
DELETE FROM `project_submissions`;
DELETE FROM `user_badges`;
DELETE FROM `quiz_results`;
DELETE FROM `exercise_attempts`;
DELETE FROM `user_progress`;
DELETE FROM `answers`;
DELETE FROM `questions`;
DELETE FROM `exercises`;
DELETE FROM `lessons`;
DELETE FROM `modules`;
DELETE FROM `courses`;
DELETE FROM `categories`;
DELETE FROM `projects`;
DELETE FROM `badges`;
DELETE FROM `settings`;
DELETE FROM `remember_tokens`;
DELETE FROM `password_resets`;
DELETE FROM `login_attempts`;
DELETE FROM `users`;

INSERT INTO `settings` (`id`, `setting_key`, `setting_value`, `label`) VALUES
(1, 'site_name', 'HTML & CSS Academy', 'Nom du site'),
(2, 'site_description', 'Plateforme interactive pour apprendre HTML et CSS pas à pas : cours, éditeur de code, exercices, quiz, projets, badges et certificat.', 'Description (SEO)'),
(3, 'contact_email', 'contact@academy.local', 'E-mail de contact'),
(4, 'free_navigation', '1', 'Navigation libre entre les leçons (sinon, déblocage progressif)'),
(5, 'show_demo_accounts', '1', 'Afficher les comptes de démonstration sur la page de connexion');

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password_hash`, `role`, `is_active`, `bio`, `last_login_at`, `last_activity_at`, `created_at`) VALUES
(1, 'Admin', 'Academy', 'admin@academy.test', '$2y$12$xjqL6GHS0t2Cw2Syl8kFyeyGwXTGCvHXY9r4W.rYNV6Xx2W.FXkua', 'admin', 1, 'Compte administrateur de démonstration.', '2026-09-27 09:00:00', '2026-09-27 09:00:00', '2026-08-18 10:00:00'),
(2, 'Léa', 'Martin', 'demo@academy.test', '$2y$12$dnCmA6NmFMJvl3Q5Oqz5Uepg5X1HgkZRk5wmmTbLfwsk8CMysWa8a', 'student', 1, 'Apprenante de démonstration.', '2026-09-26 18:00:00', '2026-09-26 18:00:00', '2026-09-06 10:00:00'),
(3, 'Karim', 'Benali', 'karim@academy.test', '$2y$12$dnCmA6NmFMJvl3Q5Oqz5Uepg5X1HgkZRk5wmmTbLfwsk8CMysWa8a', 'student', 1, NULL, '2026-09-25 10:00:00', '2026-09-25 10:00:00', '2026-08-30 10:00:00'),
(4, 'Sofia', 'Rossi', 'sofia@academy.test', '$2y$12$dnCmA6NmFMJvl3Q5Oqz5Uepg5X1HgkZRk5wmmTbLfwsk8CMysWa8a', 'student', 1, NULL, '2026-09-27 08:00:00', '2026-09-27 08:00:00', '2026-08-23 10:00:00'),
(5, 'Tom', 'Dubois', 'tom@academy.test', '$2y$12$dnCmA6NmFMJvl3Q5Oqz5Uepg5X1HgkZRk5wmmTbLfwsk8CMysWa8a', 'student', 1, NULL, '2026-09-22 10:00:00', '2026-09-22 10:00:00', '2026-09-18 10:00:00');

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `color`, `sort_order`) VALUES
(1, 'HTML', 'html', 'Le langage de structure des pages web.', '#ff8a4c', 1),
(2, 'CSS', 'css', 'Le langage de mise en forme et de mise en page.', '#5aa9ff', 2);

INSERT INTO `courses` (`id`, `category_id`, `title`, `slug`, `level`, `summary`, `description`, `is_published`, `sort_order`) VALUES
(1, 1, 'HTML — Les fondations', 'html-fondations', 1, 'Comprendre le Web, structurer une page, écrire des titres, des paragraphes, mettre en forme du texte et créer des liens.', 'Ce premier cours part de zéro. Vous découvrirez ce qu’est réellement une page web, comment le navigateur l’interprète, puis vous écrirez vos premières balises.

À la fin du cours, vous saurez créer une page HTML complète et valide, avec du texte structuré et des liens.', 1, 1),
(2, 2, 'CSS — Les fondations', 'css-fondations', 1, 'Syntaxe, sélecteurs, cascade, couleurs, typographie, unités et modèle de boîte : les bases indispensables du style.', 'Une fois la structure HTML maîtrisée, place à l’apparence. Ce cours explique comment le navigateur applique les styles, comment cibler précisément les éléments et comment chaque élément occupe l’espace grâce au modèle de boîte.', 1, 2),
(3, 1, 'HTML — Contenus et formulaires', 'html-contenus-formulaires', 2, 'Images, listes, tableaux, formulaires complets, attributs globaux, classes et identifiants.', 'Ce cours vous apprend à intégrer tous les types de contenus d’une vraie interface : images optimisées, listes, tableaux de données et formulaires accessibles avec validation native.', 1, 3),
(4, 2, 'CSS — Mise en page et interfaces', 'css-mise-en-page', 2, 'Display, positionnement, Flexbox, Grid, pseudo-classes et pseudo-éléments pour construire de vraies interfaces.', 'Place à la mise en page moderne. Vous apprendrez à placer les éléments exactement où vous le souhaitez avec Flexbox et Grid, et à rendre vos interfaces interactives avec les pseudo-classes.', 1, 4),
(5, 1, 'HTML — Sémantique, médias et qualité', 'html-semantique-qualite', 3, 'HTML sémantique, audio, vidéo, iframe, métadonnées, SEO, accessibilité et bonnes pratiques professionnelles.', 'Le niveau avancé transforme vos pages en documents professionnels : bien structurés pour les moteurs de recherche, accessibles à tous et faciles à maintenir.', 1, 5),
(6, 2, 'CSS — Responsive, animations et architecture', 'css-responsive-animations', 3, 'Responsive design, media queries, transitions, animations, effets visuels, variables CSS et architecture.', 'Le dernier cours vous donne les outils des intégrateurs professionnels : des interfaces qui s’adaptent à tous les écrans, des animations soignées et une feuille de style organisée pour durer.', 1, 6);

INSERT INTO `modules` (`id`, `course_id`, `title`, `slug`, `description`, `sort_order`) VALUES
(1, 1, 'Découvrir le HTML', 'html-decouvrir', 'Ce qu’est le HTML, comment fonctionne une page web et le vocabulaire de base : balises, éléments, attributs.', 1),
(2, 1, 'Structure d’une page HTML', 'html-structure-page', 'Le squelette obligatoire de tout document : DOCTYPE, html, head, body, et les règles d’écriture d’un code lisible.', 2);

INSERT INTO `lessons` (`id`, `module_id`, `title`, `slug`, `duration_minutes`, `introduction`, `objectives`, `prerequisites`, `theory`, `syntax_code`, `simple_html`, `simple_css`, `example_html`, `example_css`, `line_by_line`, `reference_items`, `common_mistakes`, `best_practices`, `practical`, `summary_points`, `challenge`, `is_published`, `sort_order`) VALUES
(1, 1, 'Qu’est-ce que le HTML ?', 'qu-est-ce-que-html', 12, 'Chaque page que vous visitez — un article de presse, une boutique en ligne, un réseau social — est d’abord un **document HTML**. Avant les couleurs, les animations et les boutons interactifs, il y a une structure : un titre, des paragraphes, des images, des liens. Cette structure, c’est le HTML qui la décrit.

Dans cette leçon, vous allez comprendre ce qu’est réellement le HTML, à quoi il sert, ce qu’il ne fait pas, et écrire votre toute première ligne de code.', '["Définir ce qu’est le HTML et son rôle","Distinguer HTML, CSS et JavaScript","Comprendre la notion de langage de balisage","Écrire et afficher une première balise"]', '["Aucun : cette leçon part de zéro","Savoir utiliser un navigateur web"]', '## Qu’est-ce que c’est ?

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

Un document HTML est un simple **fichier texte** portant l’extension `.html` (par exemple `index.html`). Vous pouvez l’écrire avec n’importe quel éditeur de texte — dans cette plateforme, l’éditeur intégré fait le travail — puis l’ouvrir dans un navigateur.', '<balise>contenu</balise>', '<h1>Bienvenue sur mon site</h1>
<p>Ceci est mon premier paragraphe en HTML.</p>', NULL, '<h1>Le blog de Léa</h1>
<p>Bonjour ! Je m’appelle Léa et j’apprends le développement web.</p>
<h2>Mon premier article</h2>
<p>Aujourd’hui, j’ai découvert le <strong>HTML</strong> : le langage qui structure les pages web.</p>
<p>Pour en savoir plus, consultez la <a href="https://developer.mozilla.org/fr/">documentation MDN</a>.</p>', NULL, '[["<h1>Le blog de Léa</h1>","Titre principal de la page (niveau 1). Il n’y en a généralement qu’un par page."],["<p>Bonjour ! Je m’appelle Léa…</p>","Un paragraphe de texte. La balise `<p>` s’ouvre avant le texte et se ferme après."],["<h2>Mon premier article</h2>","Un sous-titre (niveau 2) qui introduit une nouvelle partie du contenu."],["<p>… le <strong>HTML</strong> …</p>","Une balise peut en contenir une autre : `<strong>` indique un mot important à l’intérieur du paragraphe."],["<a href=\\"https://…\\">documentation MDN</a>","Un lien hypertexte : l’attribut `href` indique l’adresse de destination."]]', '[["<h1> … <h6>","Titres, du plus important (h1) au moins important (h6)."],["<p>","Paragraphe de texte."],["<strong>","Texte de forte importance (affiché en gras par défaut)."],["<a href=\\"…\\">","Lien hypertexte vers une autre page ou ressource."]]', '["Penser que le HTML est un langage de programmation : il décrit du contenu, il ne « programme » rien.","Choisir une balise pour son apparence (« `<h1>` parce que c’est gros ») au lieu de son sens.","Oublier la balise fermante, par exemple `<p>Bonjour` sans `</p>`.","Enregistrer le fichier en `.txt` au lieu de `.html` : le navigateur l’affichera comme du texte brut."]', '["Écrire les balises en minuscules : `<p>` plutôt que `<P>`.","Toujours fermer les balises qui doivent l’être.","Choisir chaque balise en fonction du sens du contenu, jamais de son rendu visuel.","Consulter la documentation de référence [MDN Web Docs](https://developer.mozilla.org/fr/docs/Web/HTML) en cas de doute."]', 'Sur un site réel — par exemple la page d’accueil d’une boulangerie — le HTML décrit :

- le nom de la boulangerie (titre `<h1>`) ;
- une phrase d’accroche (paragraphe `<p>`) ;
- les horaires, l’adresse, un lien vers la carte.

Le graphiste choisira ensuite les couleurs et la mise en page en CSS, **sans toucher au HTML**. C’est cette séparation entre contenu et présentation qui rend un site facile à faire évoluer.', '["Le HTML décrit la **structure et le sens** du contenu d’une page web.","Il fonctionne avec des **balises** écrites entre chevrons : `<p>…</p>`.","HTML = structure, CSS = apparence, JavaScript = comportement.","On choisit une balise pour son **sens**, pas pour son apparence."]', 'Dans l’éditeur libre, créez une mini-page de présentation avec un titre `<h1>` contenant votre prénom, un sous-titre `<h2>` « Mes passions » et deux paragraphes décrivant ce que vous aimez.', 1, 1),
(2, 1, 'Comment fonctionne une page web', 'comment-fonctionne-une-page-web', 12, 'Quand vous tapez une adresse dans votre navigateur, une page s’affiche en une fraction de seconde. Que s’est-il passé entre-temps ? Comprendre ce trajet vous aidera à savoir **où** se trouvent vos fichiers, **pourquoi** un lien ou une image peut ne pas s’afficher, et **comment** le navigateur transforme du code en page visible.', '["Comprendre le modèle client / serveur","Savoir ce qu’est une URL et ses parties","Comprendre comment le navigateur lit un fichier HTML","Connaître les outils pour écrire et tester du HTML"]', '["Leçon « Qu’est-ce que le HTML ? »"]', '## Le client et le serveur

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

Quand vous ouvrez un fichier `index.html` depuis votre ordinateur, l’adresse commence par `file://` : aucun serveur n’intervient. Pour publier un site, on copie ses fichiers sur un serveur (un *hébergeur*) : il devient alors accessible via une URL en `https://`.', 'https://www.exemple.fr/dossier/page.html', '<p>Cette page a été envoyée par un serveur, puis affichée par votre navigateur.</p>', NULL, '<h1>Comment arrive cette page ?</h1>
<p>1. Vous saisissez une adresse (URL).</p>
<p>2. Le navigateur envoie une requête au serveur.</p>
<p>3. Le serveur renvoie ce fichier HTML.</p>
<p>4. Le navigateur lit le code de haut en bas et affiche la page.</p>
<p>Essayez : déplacez la ligne 5 tout en haut. L’ordre d’affichage change aussi !</p>', NULL, '[["<h1>Comment arrive cette page ?</h1>","Premier élément lu par le navigateur, donc affiché en premier."],["<p>1. Vous saisissez une adresse (URL).</p>","Chaque paragraphe devient un élément du DOM, dans l’ordre du code."],["<p>2. Le navigateur envoie une requête…</p>","Le navigateur est le « client »."],["<p>3. Le serveur renvoie ce fichier HTML.</p>","Le serveur répond en envoyant le fichier demandé."],["<p>4. Le navigateur lit le code…</p>","Lecture de haut en bas : l’ordre du code = l’ordre d’affichage par défaut."]]', '[["Client","Le logiciel qui demande et affiche la page : le navigateur."],["Serveur","L’ordinateur qui stocke les fichiers du site et les envoie."],["URL","L’adresse unique d’une ressource sur le Web."],["DOM","La représentation en arbre de la page, construite par le navigateur à partir du HTML."]]', '["Croire que la page est « stockée » dans le navigateur : elle est téléchargée à chaque visite (sauf mise en cache).","Confondre le nom du fichier et l’URL : sur un serveur, le chemin de l’URL correspond à l’emplacement du fichier.","Se fier à un seul navigateur pour vérifier son code."]', '["Tester vos pages dans au moins deux navigateurs différents.","Apprendre à ouvrir les outils de développement (`F12`) dès maintenant.","Nommer vos fichiers en minuscules, sans espaces ni accents : `a-propos.html`."]', 'Lorsqu’une image ne s’affiche pas sur un site, le réflexe professionnel est d’ouvrir les outils de développement, onglet **Réseau** : on y voit chaque requête envoyée au serveur et sa réponse (par exemple une erreur 404 si le fichier n’existe pas à l’adresse indiquée).', '["Le navigateur (client) demande une page, le serveur la renvoie.","Une URL = protocole + nom de domaine + chemin.","Le navigateur lit le HTML de haut en bas et construit le DOM.","Les outils de développement (`F12`) permettent d’inspecter une page."]', 'Ouvrez les outils de développement de votre navigateur sur cette page (touche `F12`) et trouvez la balise `<h1>` de la leçon dans l’onglet « Éléments ».', 1, 2),
(3, 1, 'Balises, éléments et attributs', 'balises-elements-attributs', 15, 'Trois mots reviennent sans cesse en HTML : **balise**, **élément** et **attribut**. Ils sont souvent confondus, y compris par des développeurs expérimentés. Les maîtriser dès maintenant vous permettra de lire n’importe quelle documentation et de comprendre précisément ce que vous écrivez.', '["Distinguer balise, élément et attribut","Comprendre l’imbrication des éléments","Reconnaître les éléments vides (auto-fermants)","Écrire des attributs correctement"]', '["Leçon « Qu’est-ce que le HTML ? »"]', '## La balise

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

Le navigateur **regroupe les espaces multiples** en un seul et ignore les retours à la ligne du code. Vous pouvez donc indenter librement votre code pour le rendre lisible : cela ne change pas l’affichage.', '<nom attribut="valeur">contenu</nom>', '<p title="Info-bulle au survol">Survolez ce paragraphe avec la souris.</p>', NULL, '<h1 title="Titre principal">Mon animal préféré</h1>
<p>Le chat est un animal <strong>indépendant</strong> et <em>curieux</em>.</p>
<img src="https://placehold.co/300x180/png?text=Chat" alt="Illustration d''un chat" width="300">
<p>
  En savoir plus sur
  <a href="https://fr.wikipedia.org/wiki/Chat" title="Article Wikipédia">les chats</a>.
</p>', NULL, '[["<h1 title=\\"Titre principal\\">…</h1>","Un élément `h1` avec un attribut `title` : une info-bulle apparaît au survol."],["<p>… <strong>indépendant</strong> et <em>curieux</em>.</p>","Deux éléments enfants imbriqués dans le paragraphe parent, fermés avant `</p>`."],["<img src=\\"…\\" alt=\\"…\\" width=\\"300\\">","Élément vide (pas de balise fermante) avec trois attributs : la source, le texte alternatif et la largeur."],["<p>","Ouverture d’un paragraphe écrit sur plusieurs lignes : les retours à la ligne du code sont ignorés à l’affichage."],["<a href=\\"…\\" title=\\"…\\">les chats</a>","Un lien avec deux attributs. L’ordre des attributs n’a pas d’importance."],["</p>","Fermeture du paragraphe, après la fermeture de ses enfants."]]', '[["balise","Le code entre chevrons : `<p>` (ouvrante) ou `</p>` (fermante)."],["élément","Balise ouvrante + contenu + balise fermante."],["attribut","Information supplémentaire écrite dans la balise ouvrante : `nom=\\"valeur\\"`."],["élément vide","Élément sans contenu ni balise fermante : `<img>`, `<br>`, `<hr>`, `<input>`, `<meta>`."],["title","Attribut global : texte d’info-bulle affiché au survol."]]', '["Écrire un attribut dans la balise fermante : `</a href=\\"…\\">`.","Oublier les guillemets autour des valeurs contenant des espaces.","Utiliser des guillemets typographiques `“ ”` copiés depuis un traitement de texte.","Mal imbriquer les balises : `<p><strong>texte</p></strong>`.","Ajouter une balise fermante à un élément vide : `</img>` n’existe pas."]', '["Indenter le contenu des éléments parents de deux espaces pour visualiser l’imbrication.","Toujours mettre les valeurs d’attributs entre guillemets doubles.","Écrire les noms de balises et d’attributs en minuscules."]', 'Dans un vrai projet, un même élément porte souvent plusieurs attributs : `<a href="/contact" class="bouton" title="Nous écrire">Contact</a>`. Savoir distinguer l’attribut `href` (la destination) de l’attribut `class` (utilisé par le CSS) est indispensable pour lire et modifier le code d’un collègue.', '["Élément = balise ouvrante + contenu + balise fermante.","Les attributs se placent dans la balise ouvrante : `nom=\\"valeur\\"`.","Les éléments vides (`<img>`, `<br>`) n’ont pas de balise fermante.","On ferme les balises dans l’ordre inverse de leur ouverture."]', 'Créez un paragraphe qui contient un lien, lui-même contenant un mot en `<strong>`. Ajoutez un attribut `title` au lien. Vérifiez que l’imbrication est correcte.', 1, 3),
(4, 2, 'Le DOCTYPE et l’élément html', 'doctype-et-element-html', 12, 'Jusqu’ici, vous avez écrit des fragments de HTML. Une vraie page web est un **document complet** qui commence toujours de la même façon. Ces premières lignes semblent techniques, mais elles ont des effets très concrets : mode d’affichage du navigateur, langue lue par les synthèses vocales, traduction automatique…', '["Comprendre le rôle de `<!DOCTYPE html>`","Connaître l’élément racine `<html>`","Déclarer la langue du document avec l’attribut `lang`"]', '["Balises, éléments et attributs"]', '## Le DOCTYPE : qu’est-ce que c’est ?

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

Toujours : **chaque** page HTML doit commencer par `<!DOCTYPE html>` et être entièrement contenue dans `<html lang="…">`.', '<!DOCTYPE html>
<html lang="fr">
  <!-- tout le document -->
</html>', NULL, NULL, '<!DOCTYPE html>
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
</html>', NULL, '[["<!DOCTYPE html>","Déclaration : le navigateur utilise le mode standard HTML5."],["<html lang=\\"fr\\">","Élément racine ; la langue principale du document est le français."],["<head>","En-tête invisible : informations sur la page (vu à la leçon suivante)."],["<meta charset=\\"utf-8\\">","Encodage des caractères, pour afficher correctement les accents."],["<title>Ma première vraie page</title>","Titre affiché dans l’onglet du navigateur."],["<body>","Début du contenu visible."],["<q lang=\\"en\\">Stay hungry…</q>","Citation courte en anglais : `lang` local pour la bonne prononciation."],["</html>","Fin du document : rien ne doit être écrit après."]]', '[["<!DOCTYPE html>","Déclaration du type de document (HTML5), toujours en première ligne."],["<html>","Élément racine qui contient tout le document."],["lang","Attribut indiquant la langue du contenu (`fr`, `en`, `fr-CA`…)."],["<q>","Citation courte en ligne (le navigateur ajoute les guillemets)."]]', '["Oublier le DOCTYPE : la page passe en mode « quirks » et le CSS se comporte de manière inattendue.","Placer du contenu avant `<!DOCTYPE html>`, même un commentaire ou une ligne vide avec des espaces inutiles dans certains outils.","Oublier l’attribut `lang` ou indiquer la mauvaise langue (`lang=\\"en\\"` pour un site français).","Écrire du contenu après `</html>`."]', '["Commencer chaque fichier par un modèle (squelette) complet que vous réutilisez.","Toujours déclarer `lang` sur `<html>` ; utiliser `lang` localement pour les passages en langue étrangère."]', 'Les éditeurs de code professionnels proposent des raccourcis pour générer le squelette : dans VS Code, tapez `!` puis `Tab` dans un fichier `.html`. Pensez seulement à remplacer `lang="en"` par `lang="fr"` !', '["`<!DOCTYPE html>` est toujours la première ligne : il active le mode standard.","`<html>` est l’élément racine qui contient tout le document.","L’attribut `lang=\\"fr\\"` déclare la langue pour l’accessibilité et le référencement."]', 'Créez une page complète en anglais (`lang="en"`) contenant un paragraphe en français marqué avec `lang="fr"`.', 1, 1),
(5, 2, 'Les sections head et body', 'head-et-body', 14, 'L’élément `<html>` contient exactement deux enfants : `<head>` et `<body>`. Le premier parle **de** la page (aux navigateurs et aux moteurs de recherche), le second contient **la** page (ce que voit le visiteur). Confondre les deux est l’une des erreurs les plus fréquentes chez les débutants.', '["Distinguer le rôle de `<head>` et de `<body>`","Écrire un `<head>` minimal correct","Comprendre `<meta charset>`, `<meta viewport>` et `<title>`"]', '["Le DOCTYPE et l’élément html"]', '## `<head>` : les informations sur la page

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
```', '<head>…métadonnées…</head>
<body>…contenu visible…</body>', NULL, NULL, '<!DOCTYPE html>
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
</html>', NULL, '[["<head>","Début des métadonnées : rien d’ici ne s’affiche dans la page."],["<meta charset=\\"utf-8\\">","Encodage UTF-8, en premier pour que les accents soient correctement lus."],["<meta name=\\"viewport\\" …>","Adapte la largeur de la page à l’écran de l’appareil."],["<title>Boulangerie Dupain — …</title>","Titre de l’onglet et des résultats de recherche : unique et descriptif."],["<meta name=\\"description\\" …>","Résumé proposé aux moteurs de recherche."],["</head>","Fin des métadonnées."],["<body>","Début du contenu visible par le visiteur."],["<h1>Boulangerie Dupain</h1>","Premier élément visible de la page."]]', '[["<head>","Conteneur des métadonnées (non affichées)."],["<body>","Conteneur du contenu visible."],["<meta charset=\\"utf-8\\">","Déclare l’encodage des caractères."],["<title>","Titre du document (onglet, favoris, moteurs de recherche)."],["<meta name=\\"viewport\\">","Contrôle l’affichage sur mobile."],["<link rel=\\"stylesheet\\">","Relie une feuille de style CSS externe."]]', '["Placer un `<h1>` ou un `<p>` dans le `<head>`.","Confondre `<title>` (dans head, onglet) et `<h1>` (dans body, titre visible).","Oublier `<meta charset=\\"utf-8\\">` : caractères accentués illisibles.","Utiliser le même `<title>` pour toutes les pages d’un site."]', '["Placer `<meta charset=\\"utf-8\\">` en toute première position du `<head>`.","Rédiger des titres de 50 à 60 caractères, du plus spécifique au plus général : « Contact — Mon site ».","Toujours inclure la balise viewport."]', 'Dans un site professionnel, le `<head>` contient souvent une quinzaine de lignes : favicon, feuilles de style, balises Open Graph pour le partage sur les réseaux sociaux, préchargement des polices… Mais la base reste la même que celle de cette leçon.', '["`<head>` = informations sur la page, invisibles.","`<body>` = contenu visible, un seul par page.","Head minimal : `charset`, `viewport`, `title`.","`<title>` (onglet) ≠ `<h1>` (titre visible)."]', 'Écrivez de mémoire, sans regarder, le squelette HTML complet avec `charset`, `viewport` et `title`. Comparez ensuite avec la leçon.', 1, 2),
(6, 2, 'Commentaires et indentation', 'commentaires-et-indentation', 10, 'Un code est écrit une fois, mais relu des dizaines de fois : par vous dans trois mois, par un collègue, par un formateur. Deux outils simples rendent votre HTML lisible : les **commentaires** et l’**indentation**. Ils n’ont aucun effet sur l’affichage… et pourtant, ils font toute la différence entre un code amateur et un code professionnel.', '["Écrire des commentaires HTML","Indenter correctement un document","Savoir quand commenter (et quand ne pas le faire)"]', '["Head et body"]', '## Les commentaires

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

> [!TIP] Dans cette plateforme, la touche `Tab` de l’éditeur indente la ligne ou la sélection, et `Maj + Tab` désindente.', '<!-- Mon commentaire -->', NULL, NULL, '<!-- ===== En-tête de la page ===== -->
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

<p>Bon appétit !</p>', NULL, '[["<!-- ===== En-tête de la page ===== -->","Commentaire de délimitation : repère visuel dans le code."],["<ul>","Liste parente, au niveau 0 d’indentation."],["  <li>250 g de farine</li>","Éléments enfants indentés de 2 espaces."],["</ul>","Balise fermante alignée avec la balise ouvrante."],["<!-- Section désactivée …","Commentaire sur plusieurs lignes qui désactive du code : il n’est pas affiché."],["-->","Fin du commentaire."]]', '[["<!-- … -->","Commentaire HTML, ignoré par le navigateur mais visible dans le code source."],["Indentation","Décalage du code enfant (2 espaces par niveau), purement visuel."]]', '["Oublier de fermer un commentaire avec `-->` : tout le reste de la page disparaît.","Imbriquer des commentaires : `<!-- a <!-- b --> c -->` ne fonctionne pas.","Écrire des informations sensibles dans les commentaires.","Mélanger tabulations et espaces : l’indentation devient incohérente d’un éditeur à l’autre."]', '["Délimiter les grandes zones du document par des commentaires.","Commenter les choix non évidents, pas les évidences.","Supprimer le code commenté obsolète avant de publier.","Choisir une convention d’indentation et s’y tenir."]', 'En entreprise, les équipes adoptent un **formateur automatique** (par exemple Prettier) qui indente tout le code de la même façon à chaque enregistrement : plus de débat, et un code toujours lisible.', '["Un commentaire s’écrit `<!-- … -->` et n’est pas affiché.","Il reste visible dans le code source : rien de confidentiel.","L’indentation (2 espaces par niveau) révèle la hiérarchie des éléments."]', 'Reprenez l’exemple de la recette et ajoutez une section « Préparation » avec une liste numérotée `<ol>`, correctement indentée et précédée d’un commentaire de délimitation.', 1, 3);

INSERT INTO `exercises` (`id`, `lesson_id`, `title`, `slug`, `type`, `difficulty`, `instructions`, `starter_html`, `starter_css`, `solution_html`, `solution_css`, `validation_rules`, `hint`, `explanation`, `points`, `sort_order`) VALUES
(1, 1, 'Votre premier titre', 'qu-est-ce-que-html-ex1', 'code', 1, 'Créez un titre de niveau 1 (`<h1>`) contenant exactement le texte **Bienvenue**.', '<!-- Écrivez votre code ci-dessous -->', NULL, '<h1>Bienvenue</h1>', NULL, '[{"t":"el","sel":"h1","msg":"La page contient un titre <h1>"},{"t":"el","sel":"h1","text":"Bienvenue","msg":"Le titre <h1> contient le texte « Bienvenue »"},{"t":"contains","s":"</h1>","msg":"La balise <h1> est correctement fermée avec </h1>"}]', 'Une balise s’ouvre avec `<h1>` et se ferme avec `</h1>`. Le texte se place entre les deux.', 'La balise `<h1>` indique le titre principal de la page. Le contenu se place entre la balise ouvrante `<h1>` et la balise fermante `</h1>`.', 15, 1),
(2, 1, 'Le rôle de chaque langage', 'qu-est-ce-que-html-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'Le HTML structure le contenu. Le CSS gère l’apparence, JavaScript l’interactivité, et PHP s’exécute côté serveur.', 10, 2),
(3, 2, 'L’ordre des éléments', 'comment-fonctionne-une-page-web-ex1', 'fix', 1, 'Les étapes sont dans le désordre ! Réorganisez les paragraphes pour que l’**étape 1** soit affichée en premier, puis l’étape 2, puis l’étape 3.', '<p>Étape 3 : le navigateur affiche la page.</p>
<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>', NULL, '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>', NULL, '[{"t":"el","sel":"p","count":3,"msg":"La page contient toujours trois paragraphes"},{"t":"el","sel":"p:first-child","contains":"Étape 1","msg":"Le premier paragraphe est l’étape 1"},{"t":"el","sel":"p:last-child","contains":"Étape 3","msg":"Le dernier paragraphe est l’étape 3"}]', 'Le navigateur affiche les éléments dans l’ordre où ils apparaissent dans le code : déplacez les lignes.', 'Le navigateur lit le HTML de haut en bas. Pour changer l’ordre d’affichage (sans CSS), il suffit de changer l’ordre des éléments dans le code.', 10, 1),
(4, 3, 'Ajouter un attribut', 'balises-elements-attributs-ex1', 'fill', 1, 'Complétez le code : remplacez `______` par un attribut `title` dont la valeur est **Mon info-bulle**.', '<p ______>Survolez-moi !</p>', NULL, '<p title="Mon info-bulle">Survolez-moi !</p>', NULL, '[{"t":"absent","s":"______","msg":"Le texte « ______ » a été remplacé"},{"t":"attr","sel":"p","attr":"title","msg":"Le paragraphe possède un attribut title"},{"t":"attr","sel":"p","attr":"title","value":"Mon info-bulle","msg":"La valeur de title est « Mon info-bulle »"}]', 'Un attribut s’écrit `nom="valeur"` dans la balise ouvrante.', 'L’attribut `title` s’écrit dans la balise ouvrante : `<p title="Mon info-bulle">`.', 10, 1),
(5, 3, 'Réparer une imbrication', 'balises-elements-attributs-ex2', 'fix', 2, 'Ce code contient une erreur d’imbrication. Corrigez-le pour que `<strong>` soit fermé **avant** `</p>`.', '<p>HTML est <strong>vraiment simple</p></strong>', NULL, '<p>HTML est <strong>vraiment simple</strong></p>', NULL, '[{"t":"contains","s":"</strong></p>","msg":"</strong> est fermé avant </p>"},{"t":"el","sel":"p > strong","text":"vraiment simple","msg":"<strong> est bien à l’intérieur du paragraphe"}]', 'La dernière balise ouverte doit être la première fermée.', 'Les balises se ferment dans l’ordre inverse de leur ouverture : `<p><strong>…</strong></p>`.', 10, 2),
(6, 4, 'Déclarer le document', 'doctype-et-element-html-ex1', 'code', 1, 'Complétez ce document : ajoutez la déclaration `<!DOCTYPE html>` en première ligne et l’attribut `lang` avec la valeur `fr` sur l’élément `<html>`.', '<html>
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>', NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>', NULL, '[{"t":"contains","s":"<!DOCTYPE html>","ci":true,"msg":"Le document contient <!DOCTYPE html>"},{"t":"attr","sel":"html","attr":"lang","value":"fr","msg":"L’élément <html> possède lang=\\"fr\\""},{"t":"el","sel":"body p","msg":"Le paragraphe est toujours dans le body"}]', 'Le DOCTYPE s’écrit avant `<html>`. L’attribut se place dans la balise ouvrante : `<html lang="fr">`.', 'Tout document commence par `<!DOCTYPE html>`, suivi de l’élément racine `<html lang="fr">`.', 15, 1),
(7, 5, 'Ranger le head et le body', 'head-et-body-ex1', 'fix', 2, 'Le titre visible `<h1>` a été placé par erreur dans le `<head>`, et il manque le `<title>` de la page. Déplacez le `<h1>` dans le `<body>` et ajoutez un `<title>` contenant **Mon site** dans le `<head>`.', '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <h1>Bienvenue sur mon site</h1>
</head>
<body>
  <p>Contenu de la page.</p>
</body>
</html>', NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
</head>
<body>
  <h1>Bienvenue sur mon site</h1>
  <p>Contenu de la page.</p>
</body>
</html>', NULL, '[{"t":"el","sel":"head title","text":"Mon site","msg":"Le head contient <title>Mon site</title>"},{"t":"contains","s":"<title>","msg":"La balise <title> est écrite dans le code"},{"t":"el","sel":"h1","text":"Bienvenue sur mon site","msg":"Le titre <h1> est toujours présent"},{"t":"match","re":"</head>[\\\\s\\\\S]*<body[^>]*>[\\\\s\\\\S]*<h1","msg":"Le <h1> est écrit dans le body, pas dans le head"}]', 'Coupez la ligne du `<h1>` et collez-la juste après `<body>`. Écrivez `<title>Mon site</title>` à sa place dans le head.', 'Le `<head>` contient uniquement des métadonnées (comme `<title>`), tandis que le contenu visible (comme `<h1>`) va dans le `<body>`.', 10, 1),
(8, 6, 'Désactiver un paragraphe', 'commentaires-et-indentation-ex1', 'code', 1, 'Transformez le **deuxième** paragraphe en commentaire HTML pour qu’il ne s’affiche plus. Le premier paragraphe doit rester visible.', '<p>Ce paragraphe doit rester visible.</p>
<p>Ce paragraphe doit disparaître.</p>', NULL, '<p>Ce paragraphe doit rester visible.</p>
<!-- <p>Ce paragraphe doit disparaître.</p> -->', NULL, '[{"t":"el","sel":"p","count":1,"msg":"Un seul paragraphe est affiché"},{"t":"el","sel":"p","text":"Ce paragraphe doit rester visible.","msg":"Le premier paragraphe est toujours visible"},{"t":"contains","s":"<!--","msg":"Un commentaire est ouvert avec <!--"},{"t":"contains","s":"-->","msg":"Le commentaire est fermé avec -->"}]', 'Entourez la ligne entière avec `<!--` au début et `-->` à la fin.', 'Tout ce qui se trouve entre `<!--` et `-->` est ignoré par le navigateur.', 15, 1),
(9, 6, 'Les commentaires sont-ils secrets ?', 'commentaires-et-indentation-ex2', 'truefalse', 1, 'Vrai ou faux ?', NULL, NULL, NULL, NULL, NULL, NULL, 'Faux : le code source (commentaires compris) est accessible à n’importe qui via « Afficher le code source ».', 10, 2);

INSERT INTO `questions` (`id`, `lesson_id`, `exercise_id`, `question`, `type`, `code_snippet`, `explanation`, `sort_order`) VALUES
(1, NULL, 2, 'Quel langage est responsable de la **structure** et du **sens** du contenu d’une page web ?', 'single', NULL, NULL, 0),
(2, 1, NULL, 'Que signifie l’acronyme HTML ?', 'single', NULL, 'HTML = HyperText Markup Language : un langage de balisage pour des documents reliés par des liens.', 0),
(3, 1, NULL, 'Le HTML est un langage de programmation.', 'truefalse', NULL, 'Faux : c’est un langage de balisage. Il décrit le contenu mais ne contient ni calcul ni logique.', 1),
(4, 1, NULL, 'Quel langage faut-il utiliser pour changer la couleur d’un titre ?', 'single', NULL, 'L’apparence (couleurs, polices, tailles) est le rôle du CSS.', 2),
(5, 1, NULL, 'Quelle est la balise fermante correspondant à `<p>` ?', 'single', NULL, 'Une balise fermante reprend le nom de la balise précédé d’une barre oblique : `</p>`.', 3),
(6, 2, NULL, 'Dans le modèle client / serveur, qui est le client ?', 'single', NULL, 'Le client est le logiciel qui envoie la requête et affiche la réponse : le navigateur.', 0),
(7, 2, NULL, 'Dans `https://www.exemple.fr/blog/page.html`, quel est le chemin ?', 'single', NULL, 'Le chemin est la partie qui suit le nom de domaine : il désigne la ressource sur le serveur.', 1),
(8, 2, NULL, 'Le navigateur lit le code HTML de haut en bas.', 'truefalse', NULL, 'Vrai : il construit les éléments dans l’ordre du code, ce qui détermine l’ordre d’affichage par défaut.', 2),
(9, 3, NULL, 'Où place-t-on un attribut ?', 'single', NULL, 'Les attributs s’écrivent toujours dans la balise ouvrante.', 0),
(10, 3, NULL, 'Lequel de ces éléments est un élément vide ?', 'single', NULL, '`<img>` n’a pas de contenu textuel ni de balise fermante.', 1),
(11, 3, NULL, 'Quelle imbrication est correcte ?', 'single', NULL, 'On ferme d’abord l’élément ouvert en dernier (`em`), puis son parent (`p`).', 2),
(12, 3, NULL, 'Plusieurs espaces consécutifs dans le code sont affichés tels quels par le navigateur.', 'truefalse', NULL, 'Faux : le navigateur regroupe les espaces et retours à la ligne consécutifs en un seul espace.', 3),
(13, 4, NULL, 'Que se passe-t-il si on oublie le DOCTYPE ?', 'single', NULL, 'Sans DOCTYPE, le navigateur imite d’anciens comportements (mode quirks), ce qui rend l’affichage imprévisible.', 0),
(14, 4, NULL, 'Quel attribut déclare la langue d’une page ?', 'single', NULL, 'L’attribut `lang`, placé sur `<html>`, déclare la langue principale.', 1),
(15, 4, NULL, 'L’élément `<html>` est appelé l’élément racine.', 'truefalse', NULL, 'Vrai : il contient tous les autres éléments du document.', 2),
(16, 5, NULL, 'Où place-t-on le contenu visible de la page ?', 'single', NULL, 'Tout le contenu visible se place dans `<body>`.', 0),
(17, 5, NULL, 'À quoi sert `<meta charset="utf-8">` ?', 'single', NULL, 'Il déclare l’encodage UTF-8, qui permet d’afficher correctement tous les caractères.', 1),
(18, 5, NULL, 'Le contenu de `<title>` s’affiche dans…', 'single', NULL, 'Le titre du document s’affiche dans l’onglet et dans les résultats des moteurs de recherche.', 2),
(19, 5, NULL, 'Sans balise viewport, un site peut apparaître minuscule sur smartphone.', 'truefalse', NULL, 'Vrai : le mobile simule alors un écran large puis réduit la page.', 3),
(20, NULL, 9, 'Un commentaire HTML est invisible pour les visiteurs, on peut donc y noter un mot de passe sans risque.', 'truefalse', NULL, NULL, 0),
(21, 6, NULL, 'Quelle est la syntaxe d’un commentaire HTML ?', 'single', NULL, 'En HTML, un commentaire s’écrit `<!-- … -->`. `/* */` est la syntaxe CSS.', 0),
(22, 6, NULL, 'L’indentation modifie l’affichage de la page.', 'truefalse', NULL, 'Faux : elle sert uniquement à la lisibilité du code.', 1),
(23, 6, NULL, 'Que se passe-t-il si on oublie `-->` ?', 'single', NULL, 'Sans fermeture, tout ce qui suit est traité comme un commentaire et disparaît.', 2);

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`, `sort_order`) VALUES
(1, 1, 'CSS', 0, 0),
(2, 1, 'HTML', 1, 1),
(3, 1, 'JavaScript', 0, 2),
(4, 1, 'PHP', 0, 3),
(5, 2, 'HyperText Markup Language', 1, 0),
(6, 2, 'High Technology Modern Language', 0, 1),
(7, 2, 'HyperTransfer Machine Language', 0, 2),
(8, 2, 'Home Tool Markup Language', 0, 3),
(9, 3, 'Vrai', 0, 0),
(10, 3, 'Faux', 1, 1),
(11, 4, 'HTML', 0, 0),
(12, 4, 'CSS', 1, 1),
(13, 4, 'SQL', 0, 2),
(14, 4, 'Aucun, c’est impossible', 0, 3),
(15, 5, '`<p/>`', 0, 0),
(16, 5, '`</p>`', 1, 1),
(17, 5, '`<\\p>`', 0, 2),
(18, 5, '`<end p>`', 0, 3),
(19, 6, 'L’hébergeur du site', 0, 0),
(20, 6, 'Le navigateur de l’internaute', 1, 1),
(21, 6, 'Le nom de domaine', 0, 2),
(22, 6, 'Le fichier HTML', 0, 3),
(23, 7, '`https://`', 0, 0),
(24, 7, '`www.exemple.fr`', 0, 1),
(25, 7, '`/blog/page.html`', 1, 2),
(26, 7, '`.html`', 0, 3),
(27, 8, 'Vrai', 1, 0),
(28, 8, 'Faux', 0, 1),
(29, 9, 'Dans la balise fermante', 0, 0),
(30, 9, 'Dans la balise ouvrante', 1, 1),
(31, 9, 'Entre les deux balises', 0, 2),
(32, 9, 'Dans un fichier séparé', 0, 3),
(33, 10, '`<p>`', 0, 0),
(34, 10, '`<h1>`', 0, 1),
(35, 10, '`<img>`', 1, 2),
(36, 10, '`<strong>`', 0, 3),
(37, 11, '`<p><em>texte</p></em>`', 0, 0),
(38, 11, '`<p><em>texte</em></p>`', 1, 1),
(39, 11, '`<em><p>texte</em></p>`', 0, 2),
(40, 11, '`<p><em>texte</p>`', 0, 3),
(41, 12, 'Vrai', 0, 0),
(42, 12, 'Faux', 1, 1),
(43, 13, 'La page ne s’affiche pas du tout', 0, 0),
(44, 13, 'Le navigateur passe en mode de compatibilité « quirks »', 1, 1),
(45, 13, 'Le CSS est ignoré', 0, 2),
(46, 13, 'Rien du tout', 0, 3),
(47, 14, '`language`', 0, 0),
(48, 14, '`lang`', 1, 1),
(49, 14, '`locale`', 0, 2),
(50, 14, '`charset`', 0, 3),
(51, 15, 'Vrai', 1, 0),
(52, 15, 'Faux', 0, 1),
(53, 16, 'Dans `<head>`', 0, 0),
(54, 16, 'Dans `<body>`', 1, 1),
(55, 16, 'Dans `<title>`', 0, 2),
(56, 16, 'Après `</html>`', 0, 3),
(57, 17, 'À choisir la police', 0, 0),
(58, 17, 'À déclarer l’encodage des caractères', 1, 1),
(59, 17, 'À définir la langue', 0, 2),
(60, 17, 'À adapter la page aux mobiles', 0, 3),
(61, 18, 'le haut de la page', 0, 0),
(62, 18, 'l’onglet du navigateur', 1, 1),
(63, 18, 'le pied de page', 0, 2),
(64, 18, 'nulle part', 0, 3),
(65, 19, 'Vrai', 1, 0),
(66, 19, 'Faux', 0, 1),
(67, 20, 'Vrai', 1, 0),
(68, 20, 'Faux', 0, 1),
(69, 21, '`// commentaire`', 0, 0),
(70, 21, '`/* commentaire */`', 0, 1),
(71, 21, '`<!-- commentaire -->`', 1, 2),
(72, 21, '`# commentaire`', 0, 3),
(73, 22, 'Vrai', 0, 0),
(74, 22, 'Faux', 1, 1),
(75, 23, 'Rien', 0, 0),
(76, 23, 'Le reste de la page est considéré comme commenté', 1, 1),
(77, 23, 'Le navigateur ajoute la fermeture au bon endroit', 0, 2),
(78, 23, 'Une erreur s’affiche à l’écran', 0, 3);

INSERT INTO `projects` (`id`, `category_id`, `title`, `slug`, `level`, `summary`, `objective`, `instructions`, `steps`, `resources`, `success_criteria`, `starter_html`, `starter_css`, `solution_html`, `solution_css`, `validation_rules`, `bonus_challenge`, `is_final`, `sort_order`) VALUES
(1, 1, 'Ma première page personnelle', 'ma-premiere-page-personnelle', 1, 'Créez une page HTML complète qui vous présente : titres, paragraphes, liste, image et liens.', 'Mettre en pratique toutes les notions du cours **HTML — Les fondations** en construisant une page de présentation personnelle complète et valide, **uniquement en HTML**.', 'Créez une page qui vous présente (ou présente un personnage imaginaire). La page doit contenir :

- un document HTML complet : `<!DOCTYPE html>`, `<html lang="fr">`, `<head>` avec `<meta charset>` et `<title>`, `<body>` ;
- un titre principal `<h1>` avec votre nom ;
- au moins **deux sous-titres** `<h2>` (par exemple « À propos » et « Mes passions ») ;
- au moins **deux paragraphes** ;
- un mot ou une phrase mis en valeur avec `<strong>` ou `<em>` ;
- une **image** avec un texte alternatif pertinent ;
- une **liste** de vos passions ou compétences ;
- au moins **un lien** externe qui s’ouvre dans un nouvel onglet de façon sécurisée.', '["Écrivez le squelette du document : `<!DOCTYPE html>`, `<html lang=\\"fr\\">`, `<head>`, `<body>`.","Dans `<head>`, ajoutez `<meta charset=\\"utf-8\\">` et un `<title>` explicite.","Ajoutez votre nom dans un `<h1>`, puis une phrase d’accroche dans un paragraphe.","Créez une section « À propos » avec un `<h2>` et un ou deux paragraphes.","Ajoutez une image avec les attributs `src` et `alt`.","Créez une section « Mes passions » avec une liste `<ul>`.","Terminez par un lien vers un site que vous aimez, avec `target=\\"_blank\\"` et `rel=\\"noopener\\"`.","Relisez votre code : indentation, balises fermées, imbrication correcte."]', '["[MDN — Structure d’un document HTML](https://developer.mozilla.org/fr/docs/Learn/HTML/Introduction_to_HTML/Getting_started)","[Validateur W3C](https://validator.w3.org/#validate_by_input)","Images libres de droits : [placehold.co](https://placehold.co) pour des images de test"]', '["Le document commence par `<!DOCTYPE html>` et déclare la langue française","La page possède un titre `<title>` et un seul `<h1>`","Au moins deux `<h2>` et deux paragraphes","Une image avec un attribut `alt` non vide","Une liste d’au moins trois éléments","Un lien externe ouvert dans un nouvel onglet avec `rel=\\"noopener\\"`"]', '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
  <!-- Votre page commence ici -->

</body>
</html>', NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Léa Martin — Ma page personnelle</title>
</head>
<body>
  <h1>Léa Martin</h1>
  <p>Future développeuse web, passionnée par le <strong>design</strong> et la photographie.</p>

  <h2>À propos</h2>
  <img src="https://placehold.co/240x240/png?text=Photo" alt="Portrait de Léa souriante" width="240" height="240">
  <p>J’apprends le HTML et le CSS pour créer mon propre portfolio. J’aime comprendre <em>comment</em> les choses fonctionnent.</p>

  <h2>Mes passions</h2>
  <ul>
    <li>La photographie de rue</li>
    <li>Les jeux de société</li>
    <li>La randonnée en montagne</li>
  </ul>

  <h2>Me suivre</h2>
  <p>Mes photos préférées sont sur <a href="https://unsplash.com" target="_blank" rel="noopener">Unsplash</a>.</p>
</body>
</html>', NULL, '[{"t":"contains","s":"<!doctype html>","ci":true,"msg":"Le document commence par <!DOCTYPE html>"},{"t":"attr","sel":"html","attr":"lang","value":"fr","msg":"La balise <html> déclare lang=\\"fr\\""},{"t":"attr","sel":"meta","attr":"charset","msg":"L’encodage est déclaré avec <meta charset>"},{"t":"el","sel":"title","contains":"","msg":"La page possède une balise <title>"},{"t":"el","sel":"h1","count":1,"msg":"La page contient exactement un <h1>"},{"t":"el","sel":"h2","min":2,"msg":"Au moins deux sous-titres <h2>"},{"t":"el","sel":"p","min":2,"msg":"Au moins deux paragraphes"},{"t":"el","sel":"strong, em","msg":"Un texte est mis en valeur avec <strong> ou <em>"},{"t":"attr","sel":"img","attr":"alt","nonempty":true,"msg":"Une image possède un texte alternatif non vide"},{"t":"el","sel":"ul li, ol li","min":3,"msg":"Une liste contient au moins trois éléments"},{"t":"attr","sel":"a[target]","attr":"rel","contains":"noopener","msg":"Le lien externe utilise target=\\"_blank\\" et rel=\\"noopener\\""}]', 'Ajoutez un tableau « Mon emploi du temps idéal » (jours / activités) et une ancre en haut de page permettant de revenir au début depuis le bas de la page.', 0, 1),
(2, 2, 'Une landing page moderne', 'landing-page-moderne', 1, 'Stylisez une page de présentation de produit : typographie, couleurs, boîtes, bouton d’appel à l’action.', 'Appliquer les fondations du CSS (sélecteurs, couleurs, typographie, modèle de boîte) pour transformer une page HTML brute en **landing page** élégante.', 'Le HTML de la page de présentation de l’application fictive **« FocusApp »** vous est fourni. Votre mission : écrire le CSS.

Exigences :

- une police lisible définie sur `body`, avec une hauteur de ligne confortable ;
- une section d’en-tête (`.hero`) avec une couleur ou un dégradé de fond et du texte centré ;
- un bouton d’appel à l’action (`.btn`) avec padding, coins arrondis et un état `:hover` ;
- des cartes de fonctionnalités (`.feature`) avec padding, bordure ou ombre et coins arrondis ;
- `box-sizing: border-box` appliqué à tous les éléments ;
- un contenu centré avec une largeur maximale (`max-width`).', '["Ajoutez une règle universelle `*, *::before, *::after { box-sizing: border-box; }`.","Définissez `font-family`, `line-height` et une couleur de texte sur `body`.","Centrez le contenu avec `.container { max-width: …; margin: 0 auto; }`.","Stylisez `.hero` : fond coloré, texte centré, grand padding.","Transformez le lien `.btn` en bouton : `display: inline-block`, padding, `border-radius`.","Ajoutez un effet `:hover` sur le bouton.","Stylisez les cartes `.feature` : fond, padding, `border-radius`, ombre.","Finalisez le pied de page et vérifiez les contrastes de couleurs."]', '["[MDN — Le modèle de boîte](https://developer.mozilla.org/fr/docs/Learn/CSS/Building_blocks/The_box_model)","[Coolors — générateur de palettes](https://coolors.co)","Leçons « Couleurs », « Typographie » et « Box model » de ce parcours"]', '["`box-sizing: border-box` est appliqué globalement","Le `body` définit police et hauteur de ligne","La section `.hero` a un fond et un texte centré","Le bouton `.btn` a un padding, des coins arrondis et un état `:hover`","Les cartes `.feature` ont des coins arrondis et un padding","Le contenu est limité en largeur avec `max-width`"]', '<header class="hero">
  <div class="container">
    <h1>FocusApp</h1>
    <p class="hero__text">L’application qui vous aide à rester concentré, une tâche à la fois.</p>
    <a class="btn" href="#fonctionnalites">Découvrir</a>
  </div>
</header>

<main class="container" id="fonctionnalites">
  <h2>Pourquoi FocusApp ?</h2>
  <div class="features">
    <article class="feature">
      <h3>Minuteur Pomodoro</h3>
      <p>Travaillez 25 minutes, reposez-vous 5 minutes. Simple et efficace.</p>
    </article>
    <article class="feature">
      <h3>Listes intelligentes</h3>
      <p>Vos tâches sont classées automatiquement par priorité.</p>
    </article>
    <article class="feature">
      <h3>Statistiques</h3>
      <p>Visualisez vos progrès semaine après semaine.</p>
    </article>
  </div>
</main>

<footer class="footer">
  <p>© FocusApp — Projet d’apprentissage CSS</p>
</footer>', '/* Écrivez votre CSS ici */', NULL, '*, *::before, *::after {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
  line-height: 1.6;
  color: #1e293b;
  background: #f8fafc;
}

.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 0 20px;
}

.hero {
  padding: 80px 0;
  text-align: center;
  color: #ffffff;
  background: linear-gradient(135deg, #4f46e5, #0ea5e9);
}

.hero h1 {
  margin: 0 0 12px;
  font-size: 48px;
  letter-spacing: -1px;
}

.hero__text {
  font-size: 20px;
  opacity: 0.9;
}

.btn {
  display: inline-block;
  margin-top: 16px;
  padding: 12px 28px;
  border-radius: 999px;
  background: #ffffff;
  color: #4f46e5;
  font-weight: bold;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s;
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(15, 23, 42, 0.25);
}

main h2 {
  margin: 48px 0 24px;
  text-align: center;
}

.feature {
  margin-bottom: 20px;
  padding: 24px;
  border-radius: 16px;
  background: #ffffff;
  box-shadow: 0 4px 16px rgba(15, 23, 42, 0.08);
}

.feature h3 {
  margin-top: 0;
  color: #4f46e5;
}

.footer {
  margin-top: 48px;
  padding: 24px;
  text-align: center;
  color: #64748b;
}', '[{"t":"css","prop":"box-sizing","value":"border-box","msg":"box-sizing: border-box est utilisé"},{"t":"css","sel":"body","prop":"font-family","msg":"Le body définit une police (font-family)"},{"t":"css","sel":"body","prop":"line-height","msg":"Le body définit une hauteur de ligne (line-height)"},{"t":"css","sel":".hero","prop":"text-align","value":"center","msg":"Le texte de .hero est centré"},{"t":"css","sel":".hero","prop":"background","msg":"La section .hero a un arrière-plan (background)"},{"t":"css","sel":".btn","prop":"padding","msg":"Le bouton .btn a un padding"},{"t":"css","sel":".btn","prop":"border-radius","msg":"Le bouton .btn a des coins arrondis"},{"t":"css","sel":".btn:hover","prop":"transform|background|background-color|box-shadow|color","msg":"Le bouton a un effet :hover"},{"t":"css","sel":".feature","prop":"border-radius","msg":"Les cartes .feature ont des coins arrondis"},{"t":"css","sel":".feature","prop":"padding","msg":"Les cartes .feature ont un padding"},{"t":"css","prop":"max-width","msg":"Le contenu est limité avec max-width"}]', 'Ajoutez une section « Témoignages » avec des citations (`<blockquote>`) stylisées, et une variante de bouton `.btn--outline` avec une bordure et un fond transparent.', 0, 2),
(3, NULL, 'Portfolio personnel', 'portfolio-personnel', 2, 'Construisez un portfolio avec navigation, grille de projets en Flexbox ou Grid et formulaire de contact.', 'Réaliser un portfolio complet, en HTML **et** CSS, utilisant une structure sémantique, une mise en page Flexbox/Grid et un formulaire de contact accessible.', 'Créez votre portfolio sur une seule page :

- un `<header>` contenant votre nom et une `<nav>` avec des liens d’ancre vers les sections ;
- une section **Projets** affichant au moins **trois cartes** disposées avec **Flexbox ou Grid** ;
- chaque carte contient une image (avec `alt`), un titre et une courte description ;
- une section **Contact** avec un formulaire : nom, e-mail (type `email`), message (`<textarea>`) et bouton d’envoi, chaque champ ayant un `<label>` associé ;
- un `<footer>` ;
- des effets `:hover` sur les liens de navigation et les cartes.', '["Écrivez la structure sémantique : `header`, `nav`, `main`, `section`, `footer`.","Ajoutez des `id` aux sections et des liens d’ancre dans la navigation.","Créez trois cartes de projet dans un conteneur `.projects`.","Disposez la navigation en ligne avec Flexbox.","Disposez les cartes avec Grid (`repeat(auto-fit, minmax(…))`) ou Flexbox avec `flex-wrap`.","Construisez le formulaire avec des `<label for>` reliés aux `id` des champs.","Ajoutez les états `:hover` et `:focus`.","Soignez les espacements (`gap`, `padding`) et la typographie."]', '["[CSS-Tricks — A Complete Guide to Flexbox](https://css-tricks.com/snippets/css/a-guide-to-flexbox/)","[CSS-Tricks — A Complete Guide to Grid](https://css-tricks.com/snippets/css/complete-guide-grid/)","Leçons « Formulaires », « Flexbox » et « Grid » de ce parcours"]', '["Structure sémantique : `header`, `nav`, `main`, `footer`","Au moins trois cartes de projet avec image et texte alternatif","Mise en page avec `display: flex` ou `display: grid`","Formulaire avec champ e-mail, zone de message et labels associés","Au moins un état `:hover`"]', '<!-- Construisez votre portfolio ici -->', '/* Styles du portfolio */', '<header class="site-header">
  <p class="logo">Léa Martin</p>
  <nav aria-label="Navigation principale">
    <ul class="nav">
      <li><a href="#projets">Projets</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>
</header>

<main>
  <section class="intro">
    <h1>Développeuse web front-end</h1>
    <p>Je conçois des interfaces claires, accessibles et responsives.</p>
  </section>

  <section id="projets">
    <h2>Mes projets</h2>
    <div class="projects">
      <article class="card">
        <img src="https://placehold.co/400x240/png?text=Projet+1" alt="Capture de la landing page FocusApp">
        <h3>FocusApp</h3>
        <p>Landing page d’une application de productivité.</p>
      </article>
      <article class="card">
        <img src="https://placehold.co/400x240/png?text=Projet+2" alt="Capture du site de la boulangerie">
        <h3>Boulangerie Dupain</h3>
        <p>Site vitrine avec horaires et carte des produits.</p>
      </article>
      <article class="card">
        <img src="https://placehold.co/400x240/png?text=Projet+3" alt="Capture du blog de voyage">
        <h3>Carnet de voyage</h3>
        <p>Blog responsive avec galerie photo en Grid.</p>
      </article>
    </div>
  </section>

  <section id="contact">
    <h2>Me contacter</h2>
    <form class="contact-form" action="#" method="post">
      <label for="name">Nom</label>
      <input id="name" name="name" type="text" required>
      <label for="email">E-mail</label>
      <input id="email" name="email" type="email" required>
      <label for="message">Message</label>
      <textarea id="message" name="message" rows="5" required></textarea>
      <button type="submit">Envoyer</button>
    </form>
  </section>
</main>

<footer class="site-footer">
  <p>© Léa Martin — Portfolio</p>
</footer>', '*, *::before, *::after { box-sizing: border-box; }

body {
  margin: 0;
  font-family: system-ui, sans-serif;
  line-height: 1.6;
  color: #0f172a;
}

.site-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 24px;
  border-bottom: 1px solid #e2e8f0;
}

.logo { margin: 0; font-weight: 800; }

.nav {
  display: flex;
  gap: 16px;
  margin: 0;
  padding: 0;
  list-style: none;
}

.nav a { color: #334155; text-decoration: none; }
.nav a:hover { color: #4f46e5; }

main { max-width: 1000px; margin: 0 auto; padding: 0 24px; }
.intro { padding: 64px 0 32px; text-align: center; }

.projects {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 24px;
}

.card {
  overflow: hidden;
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  transition: transform 0.2s, box-shadow 0.2s;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 24px rgba(15, 23, 42, 0.12);
}

.card img { display: block; width: 100%; height: auto; }
.card h3, .card p { margin: 12px 16px; }

.contact-form {
  display: flex;
  flex-direction: column;
  gap: 8px;
  max-width: 480px;
}

.contact-form input,
.contact-form textarea {
  padding: 10px;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  font: inherit;
}

.contact-form input:focus,
.contact-form textarea:focus { outline: 2px solid #4f46e5; }

.contact-form button {
  align-self: flex-start;
  padding: 10px 24px;
  border: 0;
  border-radius: 8px;
  background: #4f46e5;
  color: white;
  font: inherit;
  cursor: pointer;
}

.site-footer { margin-top: 64px; padding: 24px; text-align: center; color: #64748b; }', '[{"t":"el","sel":"header","msg":"La page contient un <header>"},{"t":"el","sel":"nav a","min":2,"msg":"Une <nav> contient au moins deux liens"},{"t":"el","sel":"main","msg":"La page contient un <main>"},{"t":"el","sel":"footer","msg":"La page contient un <footer>"},{"t":"el","sel":"article, .card","min":3,"msg":"Au moins trois cartes de projet"},{"t":"attr","sel":"img","attr":"alt","nonempty":true,"msg":"Les images ont un texte alternatif"},{"t":"css","prop":"display","in":["grid","flex"],"msg":"La mise en page utilise Flexbox ou Grid"},{"t":"el","sel":"form input[type=email]","msg":"Le formulaire contient un champ de type email"},{"t":"el","sel":"form textarea","msg":"Le formulaire contient une zone de message"},{"t":"el","sel":"label[for]","min":2,"msg":"Les champs ont des <label for> associés"},{"t":"contains","s":":hover","in":"css","msg":"Au moins un état :hover est défini"}]', 'Ajoutez un filtre visuel des projets (catégories en « chips ») et un mode sombre grâce aux variables CSS et à `prefers-color-scheme`.', 0, 3),
(4, NULL, 'Site web professionnel responsive', 'site-professionnel-responsive', 3, 'Le projet final : un site d’entreprise complet, sémantique, accessible, responsive et animé.', 'Démontrer la maîtrise de l’ensemble du parcours en réalisant la page d’accueil complète d’une entreprise fictive : **structure sémantique**, **accessibilité**, **SEO**, **responsive design**, **variables CSS** et **animations**.', 'Réalisez la page d’accueil de **« Studio Nova »**, une agence web fictive. Exigences :

**HTML**

- document complet : `<!DOCTYPE html>`, `lang="fr"`, `charset`, `viewport`, `<title>` et `<meta name="description">` ;
- structure sémantique : `header`, `nav`, `main`, au moins trois `section`, `footer` ;
- une hiérarchie de titres cohérente (un seul `<h1>`) ;
- une grille de services ou de réalisations, un formulaire de contact accessible ;
- images avec texte alternatif.

**CSS**

- des **variables CSS** (`:root { --… }`) pour les couleurs principales ;
- une mise en page **Flexbox** et/ou **Grid** ;
- au moins une **media query** pour adapter la page aux petits écrans ;
- une **transition** ou une **animation** ;
- la prise en compte de `prefers-reduced-motion`.', '["Rédigez le `<head>` complet (SEO + viewport).","Construisez la structure sémantique de toute la page.","Définissez vos couleurs et espacements en variables CSS.","Stylisez l’en-tête et la navigation (Flexbox).","Créez la section héro avec un appel à l’action.","Réalisez la grille de services (Grid + `auto-fit`).","Ajoutez le formulaire de contact avec labels.","Écrivez les media queries (approche mobile first recommandée).","Ajoutez des transitions sur les éléments interactifs, puis une règle `prefers-reduced-motion`.","Testez à 320px, 768px et 1440px ; vérifiez contraste et navigation au clavier."]', '["[MDN — Responsive design](https://developer.mozilla.org/fr/docs/Learn/CSS/CSS_layout/Responsive_Design)","[WebAIM — Contrast Checker](https://webaim.org/resources/contrastchecker/)","[W3C — Validateur HTML](https://validator.w3.org/)","Toutes les leçons du niveau Avancé"]', '["Balises `viewport` et `description` présentes","Structure sémantique complète","Un seul `<h1>`, au moins trois sections","Variables CSS utilisées","Au moins une media query","Flexbox ou Grid","Une transition ou animation","Prise en compte de `prefers-reduced-motion`","Formulaire accessible avec labels"]', '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <!-- Complétez le head : viewport, title, description -->
</head>
<body>

</body>
</html>', ':root {
  /* Vos variables */
}', '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Studio Nova — Agence web à Lyon</title>
  <meta name="description" content="Studio Nova conçoit des sites web rapides, accessibles et responsives pour les PME.">
</head>
<body>
  <header class="header">
    <a class="logo" href="#">Studio<span>Nova</span></a>
    <nav aria-label="Navigation principale">
      <ul class="nav">
        <li><a href="#services">Services</a></li>
        <li><a href="#realisations">Réalisations</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero">
      <h1>Des sites web qui font grandir votre activité</h1>
      <p>Design sur mesure, performance et accessibilité : nous créons votre présence en ligne.</p>
      <a class="btn" href="#contact">Demander un devis</a>
    </section>

    <section id="services" class="section">
      <h2>Nos services</h2>
      <div class="grid">
        <article class="card"><h3>Sites vitrines</h3><p>Une image professionnelle, optimisée pour le référencement.</p></article>
        <article class="card"><h3>Refonte</h3><p>Modernisez un site existant sans perdre votre audience.</p></article>
        <article class="card"><h3>Accessibilité</h3><p>Audit et mise en conformité avec les normes WCAG.</p></article>
      </div>
    </section>

    <section id="realisations" class="section">
      <h2>Réalisations</h2>
      <div class="grid">
        <figure class="work"><img src="https://placehold.co/480x300/png?text=Boulangerie" alt="Site de la boulangerie Dupain sur mobile et ordinateur"><figcaption>Boulangerie Dupain</figcaption></figure>
        <figure class="work"><img src="https://placehold.co/480x300/png?text=Cabinet" alt="Site du cabinet d''architectes Lignes"><figcaption>Cabinet Lignes</figcaption></figure>
      </div>
    </section>

    <section id="contact" class="section">
      <h2>Contact</h2>
      <form class="form" action="#" method="post">
        <label for="c-name">Nom</label>
        <input id="c-name" name="name" required>
        <label for="c-email">E-mail</label>
        <input id="c-email" name="email" type="email" required>
        <label for="c-msg">Votre projet</label>
        <textarea id="c-msg" name="message" rows="5" required></textarea>
        <button class="btn" type="submit">Envoyer</button>
      </form>
    </section>
  </main>

  <footer class="footer"><p>© Studio Nova — Tous droits réservés</p></footer>
</body>
</html>', ':root {
  --color-primary: #7c3aed;
  --color-dark: #0f172a;
  --color-light: #f8fafc;
  --radius: 14px;
  --space: 24px;
}

*, *::before, *::after { box-sizing: border-box; }

body {
  margin: 0;
  font-family: system-ui, sans-serif;
  line-height: 1.6;
  color: var(--color-dark);
  background: var(--color-light);
}

.header {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  padding: var(--space);
}

.logo { font-weight: 800; font-size: 1.4rem; color: var(--color-dark); text-decoration: none; }
.logo span { color: var(--color-primary); }

.nav { display: flex; gap: 16px; margin: 0; padding: 0; list-style: none; }
.nav a { color: inherit; text-decoration: none; }
.nav a:hover, .nav a:focus-visible { color: var(--color-primary); }

.hero {
  padding: 64px var(--space);
  text-align: center;
  color: white;
  background: linear-gradient(135deg, var(--color-primary), #2563eb);
}

.hero h1 { font-size: clamp(1.8rem, 5vw, 3.2rem); margin-top: 0; }

.btn {
  display: inline-block;
  padding: 12px 28px;
  border: 0;
  border-radius: 999px;
  background: white;
  color: var(--color-primary);
  font: inherit;
  font-weight: 700;
  text-decoration: none;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2); }
.form .btn { background: var(--color-primary); color: white; align-self: flex-start; }

.section { max-width: 1100px; margin: 0 auto; padding: 56px var(--space); }

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: var(--space);
}

.card, .work {
  margin: 0;
  padding: var(--space);
  border-radius: var(--radius);
  background: white;
  box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08);
  animation: fade-up 0.6s ease both;
}

.work img { width: 100%; height: auto; border-radius: 8px; }

.form { display: flex; flex-direction: column; gap: 8px; max-width: 520px; }
.form input, .form textarea { padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; font: inherit; }

.footer { padding: var(--space); text-align: center; color: #64748b; }

@keyframes fade-up {
  from { opacity: 0; transform: translateY(16px); }
  to { opacity: 1; transform: none; }
}

@media (min-width: 768px) {
  .header { flex-direction: row; justify-content: space-between; }
  .hero { padding: 120px var(--space); }
}

@media (prefers-reduced-motion: reduce) {
  * { animation: none !important; transition: none !important; }
}', '[{"t":"attr","sel":"meta[name=viewport]","attr":"content","contains":"width=device-width","msg":"La balise meta viewport est présente"},{"t":"attr","sel":"meta[name=description]","attr":"content","nonempty":true,"msg":"Une meta description est présente"},{"t":"attr","sel":"html","attr":"lang","nonempty":true,"msg":"La langue du document est déclarée"},{"t":"el","sel":"header","msg":"Un <header> est présent"},{"t":"el","sel":"nav","msg":"Une <nav> est présente"},{"t":"el","sel":"main","count":1,"msg":"Un unique <main> est présent"},{"t":"el","sel":"section","min":3,"msg":"Au moins trois <section>"},{"t":"el","sel":"footer","msg":"Un <footer> est présent"},{"t":"el","sel":"h1","count":1,"msg":"Un seul <h1>"},{"t":"el","sel":"label[for]","min":2,"msg":"Le formulaire utilise des labels associés"},{"t":"contains","s":"var(--","in":"css","msg":"Des variables CSS sont utilisées"},{"t":"contains","s":"@media","in":"css","msg":"Au moins une media query"},{"t":"css","prop":"display","in":["grid","flex"],"msg":"Flexbox ou Grid est utilisé"},{"t":"css","prop":"transition|animation","msg":"Une transition ou une animation est définie"},{"t":"contains","s":"prefers-reduced-motion","in":"css","msg":"La préférence prefers-reduced-motion est respectée"}]', 'Ajoutez un menu mobile repliable (sans JavaScript, avec `<details>`), une section « Tarifs » en Grid avec une offre mise en avant, et visez un score Lighthouse Accessibilité de 100.', 1, 4);

INSERT INTO `badges` (`id`, `code`, `name`, `description`, `icon`, `color`, `criteria_type`, `criteria_value`, `sort_order`) VALUES
(1, 'premier-cours', 'Premier cours terminé', 'Vous avez validé votre toute première leçon.', 'flag', '#6ee7b7', 'lessons_completed', '1', 1),
(2, 'premier-exercice', 'Premier exercice', 'Votre premier exercice est réussi : le début d’une longue série !', 'code', '#5aa9ff', 'exercises_passed', '1', 2),
(3, 'cinq-exercices', '5 exercices réussis', 'Cinq exercices réussis : la pratique paie.', 'zap', '#fcd34d', 'exercises_passed', '5', 3),
(4, 'html-debutant', 'HTML débutant', 'Cours « HTML — Les fondations » terminé.', 'html', '#ff8a4c', 'course_completed', 'html-fondations', 4),
(5, 'html-confirme', 'HTML confirmé', 'Cours « HTML — Contenus et formulaires » terminé.', 'html', '#fb923c', 'course_completed', 'html-contenus-formulaires', 5),
(6, 'css-debutant', 'CSS débutant', 'Cours « CSS — Les fondations » terminé.', 'css', '#5aa9ff', 'course_completed', 'css-fondations', 6),
(7, 'css-confirme', 'CSS confirmé', 'Cours « CSS — Mise en page et interfaces » terminé.', 'css', '#60a5fa', 'course_completed', 'css-mise-en-page', 7),
(8, 'flexbox-master', 'Flexbox Master', 'Toutes les leçons du module Flexbox sont validées.', 'flex', '#a78bfa', 'module_completed', 'css-flexbox', 8),
(9, 'responsive-design', 'Responsive Design', 'Module Responsive design terminé : vos pages s’adaptent à tous les écrans.', 'devices', '#34d399', 'module_completed', 'css-responsive', 9),
(10, 'premier-projet', 'Premier projet', 'Vous avez soumis votre premier projet pratique.', 'folder', '#f472b6', 'projects_submitted', '1', 10),
(11, 'projet-final', 'Projet final terminé', 'Votre site web professionnel responsive est validé.', 'crown', '#fcd34d', 'final_project', '1', 11),
(12, 'quiz-parfait', 'Sans faute', 'Cinq quiz réussis avec 100 % de bonnes réponses.', 'star', '#facc15', 'perfect_quizzes', '5', 12),
(13, 'parcours-complet', 'Parcours complet', 'Toutes les leçons du parcours HTML & CSS sont validées.', 'certificate', '#6ee7b7', 'path_completed', '1', 13);

INSERT INTO `user_progress` (`id`, `user_id`, `lesson_id`, `status`, `completed_at`, `created_at`) VALUES
(1, 2, 1, 'completed', '2026-09-16 17:00:00', '2026-09-16 17:00:00'),
(2, 2, 2, 'completed', '2026-09-17 18:05:00', '2026-09-17 18:05:00'),
(3, 2, 3, 'completed', '2026-09-18 19:10:00', '2026-09-18 19:10:00'),
(4, 2, 4, 'completed', '2026-09-19 20:15:00', '2026-09-19 20:15:00'),
(5, 2, 5, 'completed', '2026-09-20 17:20:00', '2026-09-20 17:20:00'),
(6, 2, 6, 'completed', '2026-09-21 18:25:00', '2026-09-21 18:25:00'),
(7, 3, 1, 'completed', '2026-09-22 17:00:00', '2026-09-22 17:00:00'),
(8, 3, 2, 'completed', '2026-09-23 18:05:00', '2026-09-23 18:05:00'),
(9, 3, 3, 'completed', '2026-09-24 19:10:00', '2026-09-24 19:10:00'),
(10, 3, 4, 'completed', '2026-09-25 20:15:00', '2026-09-25 20:15:00'),
(11, 3, 5, 'completed', '2026-09-26 17:20:00', '2026-09-26 17:20:00'),
(12, 4, 1, 'completed', '2026-09-10 17:00:00', '2026-09-10 17:00:00'),
(13, 4, 2, 'completed', '2026-09-11 18:05:00', '2026-09-11 18:05:00'),
(14, 4, 3, 'completed', '2026-09-12 19:10:00', '2026-09-12 19:10:00'),
(15, 4, 4, 'completed', '2026-09-13 20:15:00', '2026-09-13 20:15:00'),
(16, 4, 5, 'completed', '2026-09-14 17:20:00', '2026-09-14 17:20:00'),
(17, 4, 6, 'completed', '2026-09-15 18:25:00', '2026-09-15 18:25:00'),
(18, 5, 1, 'completed', '2026-09-23 17:00:00', '2026-09-23 17:00:00'),
(19, 5, 2, 'completed', '2026-09-24 18:05:00', '2026-09-24 18:05:00');

INSERT INTO `exercise_attempts` (`id`, `user_id`, `exercise_id`, `submitted_html`, `submitted_css`, `is_correct`, `score`, `created_at`) VALUES
(1, 2, 1, '<h1>Bienvenue</h1>', NULL, 1, 100, '2026-09-16 17:00:00'),
(2, 2, 2, NULL, NULL, 1, 100, '2026-09-16 17:00:00'),
(3, 2, 3, '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>', NULL, 1, 100, '2026-09-17 18:05:00'),
(4, 2, 4, '<p title="Mon info-bulle">Survolez-moi !</p>', NULL, 1, 100, '2026-09-18 19:10:00'),
(5, 2, 5, '<p>HTML est <strong>vraiment simple</strong></p>', NULL, 1, 100, '2026-09-18 19:10:00'),
(6, 2, 6, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>', NULL, 1, 100, '2026-09-19 20:15:00'),
(7, 2, 7, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
</head>
<body>
  <h1>Bienvenue sur mon site</h1>
  <p>Contenu de la page.</p>
</body>
</html>', NULL, 1, 100, '2026-09-20 17:20:00'),
(8, 2, 8, '<p>Ce paragraphe doit rester visible.</p>
<!-- <p>Ce paragraphe doit disparaître.</p> -->', NULL, 1, 100, '2026-09-21 18:25:00'),
(9, 3, 1, '<h1>Bienvenue</h1>', NULL, 1, 100, '2026-09-22 17:00:00'),
(10, 3, 3, '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>', NULL, 1, 100, '2026-09-23 18:05:00'),
(11, 3, 4, '<p title="Mon info-bulle">Survolez-moi !</p>', NULL, 1, 100, '2026-09-24 19:10:00'),
(12, 3, 6, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>', NULL, 1, 100, '2026-09-25 20:15:00'),
(13, 3, 7, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
</head>
<body>
  <h1>Bienvenue sur mon site</h1>
  <p>Contenu de la page.</p>
</body>
</html>', NULL, 1, 100, '2026-09-26 17:20:00'),
(14, 4, 1, '<h1>Bienvenue</h1>', NULL, 1, 100, '2026-09-10 17:00:00'),
(15, 4, 2, NULL, NULL, 1, 100, '2026-09-10 17:00:00'),
(16, 4, 3, '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>', NULL, 1, 100, '2026-09-11 18:05:00'),
(17, 4, 4, '<p title="Mon info-bulle">Survolez-moi !</p>', NULL, 1, 100, '2026-09-12 19:10:00'),
(18, 4, 5, '<p>HTML est <strong>vraiment simple</strong></p>', NULL, 1, 100, '2026-09-12 19:10:00'),
(19, 4, 6, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>', NULL, 1, 100, '2026-09-13 20:15:00'),
(20, 4, 7, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
</head>
<body>
  <h1>Bienvenue sur mon site</h1>
  <p>Contenu de la page.</p>
</body>
</html>', NULL, 1, 100, '2026-09-14 17:20:00'),
(21, 4, 8, '<p>Ce paragraphe doit rester visible.</p>
<!-- <p>Ce paragraphe doit disparaître.</p> -->', NULL, 1, 100, '2026-09-15 18:25:00'),
(22, 5, 1, '<h1>Bienvenue</h1>', NULL, 1, 100, '2026-09-23 17:00:00'),
(23, 5, 3, '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>', NULL, 1, 100, '2026-09-24 18:05:00'),
(24, 5, 1, '<p>Bienvenue</p>', NULL, 0, 0, '2026-09-21 10:00:00');

INSERT INTO `quiz_results` (`id`, `user_id`, `lesson_id`, `score`, `total`, `percentage`, `passed`, `answers_json`, `created_at`) VALUES
(1, 2, 1, 4, 4, 100, 1, NULL, '2026-09-16 17:00:00'),
(2, 2, 2, 2, 3, 67, 0, NULL, '2026-09-17 18:05:00'),
(3, 2, 3, 4, 4, 100, 1, NULL, '2026-09-18 19:10:00'),
(4, 2, 4, 3, 3, 100, 1, NULL, '2026-09-19 20:15:00'),
(5, 2, 5, 3, 4, 75, 1, NULL, '2026-09-20 17:20:00'),
(6, 2, 6, 3, 3, 100, 1, NULL, '2026-09-21 18:25:00'),
(7, 3, 1, 3, 4, 75, 1, NULL, '2026-09-22 17:00:00'),
(8, 3, 2, 3, 3, 100, 1, NULL, '2026-09-23 18:05:00'),
(9, 3, 3, 4, 4, 100, 1, NULL, '2026-09-24 19:10:00'),
(10, 3, 4, 2, 3, 67, 0, NULL, '2026-09-25 20:15:00'),
(11, 3, 5, 4, 4, 100, 1, NULL, '2026-09-26 17:20:00'),
(12, 4, 1, 4, 4, 100, 1, NULL, '2026-09-10 17:00:00'),
(13, 4, 2, 3, 3, 100, 1, NULL, '2026-09-11 18:05:00'),
(14, 4, 3, 3, 4, 75, 1, NULL, '2026-09-12 19:10:00'),
(15, 4, 4, 3, 3, 100, 1, NULL, '2026-09-13 20:15:00'),
(16, 4, 5, 4, 4, 100, 1, NULL, '2026-09-14 17:20:00'),
(17, 4, 6, 2, 3, 67, 0, NULL, '2026-09-15 18:25:00'),
(18, 5, 1, 4, 4, 100, 1, NULL, '2026-09-23 17:00:00'),
(19, 5, 2, 2, 3, 67, 0, NULL, '2026-09-24 18:05:00');

INSERT INTO `user_badges` (`id`, `user_id`, `badge_id`, `awarded_at`) VALUES
(1, 2, 1, '2026-09-26 10:00:00'),
(2, 2, 2, '2026-09-26 10:00:00'),
(3, 2, 3, '2026-09-26 10:00:00'),
(4, 3, 1, '2026-09-26 10:00:00'),
(5, 3, 2, '2026-09-26 10:00:00'),
(6, 3, 3, '2026-09-26 10:00:00'),
(7, 4, 1, '2026-09-26 10:00:00'),
(8, 4, 2, '2026-09-26 10:00:00'),
(9, 4, 3, '2026-09-26 10:00:00'),
(10, 5, 1, '2026-09-26 10:00:00'),
(11, 5, 2, '2026-09-26 10:00:00');

INSERT INTO `activity_log` (`id`, `user_id`, `action`, `subject`, `created_at`) VALUES
(1, 2, 'register', 'Création du compte', '2026-09-06 10:00:00'),
(2, 2, 'exercise_passed', 'Votre premier titre', '2026-09-16 17:00:00'),
(3, 2, 'exercise_passed', 'Le rôle de chaque langage', '2026-09-16 17:00:00'),
(4, 2, 'quiz_passed', 'Qu’est-ce que le HTML ? (100 %)', '2026-09-16 17:00:00'),
(5, 2, 'lesson_completed', 'Qu’est-ce que le HTML ?', '2026-09-16 17:00:00'),
(6, 2, 'exercise_passed', 'L’ordre des éléments', '2026-09-17 18:05:00'),
(7, 2, 'quiz_passed', 'Comment fonctionne une page web (67 %)', '2026-09-17 18:05:00'),
(8, 2, 'lesson_completed', 'Comment fonctionne une page web', '2026-09-17 18:05:00'),
(9, 2, 'exercise_passed', 'Ajouter un attribut', '2026-09-18 19:10:00'),
(10, 2, 'exercise_passed', 'Réparer une imbrication', '2026-09-18 19:10:00'),
(11, 2, 'quiz_passed', 'Balises, éléments et attributs (100 %)', '2026-09-18 19:10:00'),
(12, 2, 'lesson_completed', 'Balises, éléments et attributs', '2026-09-18 19:10:00'),
(13, 2, 'exercise_passed', 'Déclarer le document', '2026-09-19 20:15:00'),
(14, 2, 'quiz_passed', 'Le DOCTYPE et l’élément html (100 %)', '2026-09-19 20:15:00'),
(15, 2, 'lesson_completed', 'Le DOCTYPE et l’élément html', '2026-09-19 20:15:00'),
(16, 2, 'exercise_passed', 'Ranger le head et le body', '2026-09-20 17:20:00'),
(17, 2, 'quiz_passed', 'Les sections head et body (75 %)', '2026-09-20 17:20:00'),
(18, 2, 'lesson_completed', 'Les sections head et body', '2026-09-20 17:20:00'),
(19, 2, 'exercise_passed', 'Désactiver un paragraphe', '2026-09-21 18:25:00'),
(20, 2, 'quiz_passed', 'Commentaires et indentation (100 %)', '2026-09-21 18:25:00'),
(21, 2, 'lesson_completed', 'Commentaires et indentation', '2026-09-21 18:25:00'),
(22, 2, 'badge_awarded', 'Premier cours terminé', '2026-09-26 10:00:00'),
(23, 2, 'badge_awarded', 'Premier exercice', '2026-09-26 10:00:00'),
(24, 2, 'badge_awarded', '5 exercices réussis', '2026-09-26 10:00:00'),
(25, 3, 'register', 'Création du compte', '2026-08-30 10:00:00'),
(26, 3, 'exercise_passed', 'Votre premier titre', '2026-09-22 17:00:00'),
(27, 3, 'quiz_passed', 'Qu’est-ce que le HTML ? (75 %)', '2026-09-22 17:00:00'),
(28, 3, 'lesson_completed', 'Qu’est-ce que le HTML ?', '2026-09-22 17:00:00'),
(29, 3, 'exercise_passed', 'L’ordre des éléments', '2026-09-23 18:05:00'),
(30, 3, 'quiz_passed', 'Comment fonctionne une page web (100 %)', '2026-09-23 18:05:00'),
(31, 3, 'lesson_completed', 'Comment fonctionne une page web', '2026-09-23 18:05:00'),
(32, 3, 'exercise_passed', 'Ajouter un attribut', '2026-09-24 19:10:00'),
(33, 3, 'quiz_passed', 'Balises, éléments et attributs (100 %)', '2026-09-24 19:10:00'),
(34, 3, 'lesson_completed', 'Balises, éléments et attributs', '2026-09-24 19:10:00'),
(35, 3, 'exercise_passed', 'Déclarer le document', '2026-09-25 20:15:00'),
(36, 3, 'quiz_passed', 'Le DOCTYPE et l’élément html (67 %)', '2026-09-25 20:15:00'),
(37, 3, 'lesson_completed', 'Le DOCTYPE et l’élément html', '2026-09-25 20:15:00'),
(38, 3, 'exercise_passed', 'Ranger le head et le body', '2026-09-26 17:20:00'),
(39, 3, 'quiz_passed', 'Les sections head et body (100 %)', '2026-09-26 17:20:00'),
(40, 3, 'lesson_completed', 'Les sections head et body', '2026-09-26 17:20:00'),
(41, 3, 'badge_awarded', 'Premier cours terminé', '2026-09-26 10:00:00'),
(42, 3, 'badge_awarded', 'Premier exercice', '2026-09-26 10:00:00'),
(43, 3, 'badge_awarded', '5 exercices réussis', '2026-09-26 10:00:00'),
(44, 4, 'register', 'Création du compte', '2026-08-23 10:00:00'),
(45, 4, 'exercise_passed', 'Votre premier titre', '2026-09-10 17:00:00'),
(46, 4, 'exercise_passed', 'Le rôle de chaque langage', '2026-09-10 17:00:00'),
(47, 4, 'quiz_passed', 'Qu’est-ce que le HTML ? (100 %)', '2026-09-10 17:00:00'),
(48, 4, 'lesson_completed', 'Qu’est-ce que le HTML ?', '2026-09-10 17:00:00'),
(49, 4, 'exercise_passed', 'L’ordre des éléments', '2026-09-11 18:05:00'),
(50, 4, 'quiz_passed', 'Comment fonctionne une page web (100 %)', '2026-09-11 18:05:00'),
(51, 4, 'lesson_completed', 'Comment fonctionne une page web', '2026-09-11 18:05:00'),
(52, 4, 'exercise_passed', 'Ajouter un attribut', '2026-09-12 19:10:00'),
(53, 4, 'exercise_passed', 'Réparer une imbrication', '2026-09-12 19:10:00'),
(54, 4, 'quiz_passed', 'Balises, éléments et attributs (75 %)', '2026-09-12 19:10:00'),
(55, 4, 'lesson_completed', 'Balises, éléments et attributs', '2026-09-12 19:10:00'),
(56, 4, 'exercise_passed', 'Déclarer le document', '2026-09-13 20:15:00'),
(57, 4, 'quiz_passed', 'Le DOCTYPE et l’élément html (100 %)', '2026-09-13 20:15:00'),
(58, 4, 'lesson_completed', 'Le DOCTYPE et l’élément html', '2026-09-13 20:15:00'),
(59, 4, 'exercise_passed', 'Ranger le head et le body', '2026-09-14 17:20:00'),
(60, 4, 'quiz_passed', 'Les sections head et body (100 %)', '2026-09-14 17:20:00'),
(61, 4, 'lesson_completed', 'Les sections head et body', '2026-09-14 17:20:00'),
(62, 4, 'exercise_passed', 'Désactiver un paragraphe', '2026-09-15 18:25:00'),
(63, 4, 'quiz_passed', 'Commentaires et indentation (67 %)', '2026-09-15 18:25:00'),
(64, 4, 'lesson_completed', 'Commentaires et indentation', '2026-09-15 18:25:00'),
(65, 4, 'badge_awarded', 'Premier cours terminé', '2026-09-26 10:00:00'),
(66, 4, 'badge_awarded', 'Premier exercice', '2026-09-26 10:00:00'),
(67, 4, 'badge_awarded', '5 exercices réussis', '2026-09-26 10:00:00'),
(68, 5, 'register', 'Création du compte', '2026-09-18 10:00:00'),
(69, 5, 'exercise_passed', 'Votre premier titre', '2026-09-23 17:00:00'),
(70, 5, 'quiz_passed', 'Qu’est-ce que le HTML ? (100 %)', '2026-09-23 17:00:00'),
(71, 5, 'lesson_completed', 'Qu’est-ce que le HTML ?', '2026-09-23 17:00:00'),
(72, 5, 'exercise_passed', 'L’ordre des éléments', '2026-09-24 18:05:00'),
(73, 5, 'quiz_passed', 'Comment fonctionne une page web (67 %)', '2026-09-24 18:05:00'),
(74, 5, 'lesson_completed', 'Comment fonctionne une page web', '2026-09-24 18:05:00'),
(75, 5, 'badge_awarded', 'Premier cours terminé', '2026-09-26 10:00:00'),
(76, 5, 'badge_awarded', 'Premier exercice', '2026-09-26 10:00:00');

SET FOREIGN_KEY_CHECKS = 1;
