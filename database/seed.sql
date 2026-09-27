-- =====================================================================
-- HTML & CSS Academy — Données initiales (généré par database/build-seed.php)
-- Ne pas modifier à la main : éditez database/content/ puis relancez le script.
-- Contenu : 2 catégories, 6 cours, 30 modules, 75 leçons, 108 exercices, 257 questions, 4 projets, 13 badges.
-- Comptes de DÉMONSTRATION (voir README.md) : à supprimer avant une mise en production.
-- =====================================================================

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
(1, 'Admin', 'Academy', 'admin@academy.test', '$2y$12$zDBYfer6L9Z6w1rOpe9CreB52L6iK0fK5.8AeYatyCiVsiHBnYcAK', 'admin', 1, 'Compte administrateur de démonstration.', '2026-09-27 09:00:00', '2026-09-27 09:00:00', '2026-08-18 10:00:00'),
(2, 'Léa', 'Martin', 'demo@academy.test', '$2y$12$fIhPPYn20TSAaq7Pj8vFaeOIHhdiFjm939zotrMf8yeeYrsmKs8Ye', 'student', 1, 'Apprenante de démonstration.', '2026-09-26 18:00:00', '2026-09-26 18:00:00', '2026-09-06 10:00:00'),
(3, 'Karim', 'Benali', 'karim@academy.test', '$2y$12$fIhPPYn20TSAaq7Pj8vFaeOIHhdiFjm939zotrMf8yeeYrsmKs8Ye', 'student', 1, NULL, '2026-09-25 10:00:00', '2026-09-25 10:00:00', '2026-08-30 10:00:00'),
(4, 'Sofia', 'Rossi', 'sofia@academy.test', '$2y$12$fIhPPYn20TSAaq7Pj8vFaeOIHhdiFjm939zotrMf8yeeYrsmKs8Ye', 'student', 1, NULL, '2026-09-27 08:00:00', '2026-09-27 08:00:00', '2026-08-23 10:00:00'),
(5, 'Tom', 'Dubois', 'tom@academy.test', '$2y$12$fIhPPYn20TSAaq7Pj8vFaeOIHhdiFjm939zotrMf8yeeYrsmKs8Ye', 'student', 1, NULL, '2026-09-22 10:00:00', '2026-09-22 10:00:00', '2026-09-18 10:00:00');

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
(2, 1, 'Structure d’une page HTML', 'html-structure-page', 'Le squelette obligatoire de tout document : DOCTYPE, html, head, body, et les règles d’écriture d’un code lisible.', 2),
(3, 1, 'Titres et paragraphes', 'html-titres-paragraphes', 'Hiérarchiser l’information avec les titres, écrire des paragraphes, gérer les sauts de ligne et les séparations.', 3),
(4, 1, 'Mise en forme du texte', 'html-mise-en-forme-texte', 'Donner du sens aux mots : importance, emphase, citations, abréviations, code, exposants et indices.', 4),
(5, 1, 'Les liens', 'html-liens', 'Relier les pages entre elles : liens absolus et relatifs, ancres, nouvel onglet, e-mail et téléphone.', 5),
(6, 2, 'Découvrir le CSS', 'css-decouvrir', 'Ce qu’est le CSS, les trois façons de l’intégrer et la syntaxe d’une règle.', 1),
(7, 2, 'Les sélecteurs', 'css-selecteurs', 'Cibler précisément les éléments : type, classe, identifiant, combinateurs, cascade, spécificité et héritage.', 2),
(8, 2, 'Couleurs et arrière-plans', 'css-couleurs-arriere-plans', 'Les formats de couleur (nom, hexadécimal, RGB, HSL, transparence) et les arrière-plans (couleur, image, taille, position).', 3),
(9, 2, 'Typographie', 'css-typographie', 'Polices, tailles, graisses, hauteur de ligne, alignement, décoration du texte et unités de mesure.', 4),
(10, 2, 'Le modèle de boîte', 'css-box-model', 'Content, padding, border, margin : comprendre comment chaque élément occupe l’espace, et box-sizing.', 5),
(11, 3, 'Les images', 'html-images', 'Intégrer des images accessibles et performantes : alt, dimensions, formats, figure, lazy loading et images responsives.', 1),
(12, 3, 'Les listes', 'html-listes', 'Listes à puces, listes numérotées, listes imbriquées et listes de définitions.', 2),
(13, 3, 'Les tableaux', 'html-tableaux', 'Présenter des données tabulaires : structure, en-têtes, légende, groupes de lignes et fusion de cellules.', 3),
(14, 3, 'Les formulaires', 'html-formulaires', 'Recueillir des informations : form, input, types de champs, labels, listes, zones de texte, boutons et validation native.', 4),
(15, 3, 'Attributs globaux, classes et identifiants', 'html-attributs-classes-ids', 'class et id en profondeur, attributs globaux (title, lang, hidden, data-*) et conteneurs génériques.', 5),
(16, 4, 'La propriété display', 'css-display', 'Bloc, en ligne, inline-block, none : comprendre comment les éléments s’enchaînent dans le flux.', 1),
(17, 4, 'Le positionnement', 'css-positionnement', 'position static, relative, absolute, fixed, sticky et gestion de la superposition avec z-index.', 2),
(18, 4, 'Flexbox', 'css-flexbox', 'Le modèle de mise en page flexible : conteneur, axes, alignements, espacements, retour à la ligne et éléments flexibles.', 3),
(19, 4, 'CSS Grid', 'css-grid', 'La mise en page en deux dimensions : colonnes, lignes, unité fr, placement, zones nommées et grilles adaptatives.', 4),
(20, 4, 'Pseudo-classes et pseudo-éléments', 'css-pseudo-classes-elements', 'Réagir aux interactions (:hover, :focus), cibler selon la position (:nth-child) et générer du contenu (::before, ::after).', 5),
(21, 5, 'Le HTML sémantique', 'html-semantique', 'Structurer une page avec les balises de sens : header, nav, main, section, article, aside, footer.', 1),
(22, 5, 'Audio, vidéo et contenus intégrés', 'html-medias', 'Intégrer du son et de la vidéo accessibles, et des contenus externes avec iframe.', 2),
(23, 5, 'Métadonnées et SEO', 'html-metadonnees-seo', 'Les balises meta, Open Graph, favicon, et les fondamentaux du référencement naturel en HTML.', 3),
(24, 5, 'Accessibilité', 'html-accessibilite', 'Concevoir des pages utilisables par tous : principes WCAG, navigation clavier, ARIA et tests.', 4),
(25, 5, 'Bonnes pratiques et validation', 'html-bonnes-pratiques', 'Écrire un HTML professionnel : conventions, organisation des fichiers, validation W3C et débogage.', 5),
(26, 6, 'Responsive design', 'css-responsive', 'Adapter les pages à tous les écrans : viewport, approche mobile first, media queries, images et typographie fluides.', 1),
(27, 6, 'Transitions, transformations et animations', 'css-transitions-animations', 'Donner vie aux interfaces avec transition, transform et @keyframes, dans le respect des utilisateurs.', 2),
(28, 6, 'Effets visuels', 'css-effets-visuels', 'Ombres portées, ombres de texte, dégradés linéaires, radiaux et coniques, filtres.', 3),
(29, 6, 'Variables CSS et organisation', 'css-variables-organisation', 'Les propriétés personnalisées (variables), les thèmes, et l’organisation d’une feuille de style maintenable.', 4),
(30, 6, 'Interfaces modernes et bonnes pratiques', 'css-interfaces-modernes', 'Assembler toutes les notions pour construire des composants d’interface soignés, performants et accessibles.', 5);

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

<p>Bon appétit !</p>', NULL, '[["<!-- ===== En-tête de la page ===== -->","Commentaire de délimitation : repère visuel dans le code."],["<ul>","Liste parente, au niveau 0 d’indentation."],["  <li>250 g de farine</li>","Éléments enfants indentés de 2 espaces."],["</ul>","Balise fermante alignée avec la balise ouvrante."],["<!-- Section désactivée …","Commentaire sur plusieurs lignes qui désactive du code : il n’est pas affiché."],["-->","Fin du commentaire."]]', '[["<!-- … -->","Commentaire HTML, ignoré par le navigateur mais visible dans le code source."],["Indentation","Décalage du code enfant (2 espaces par niveau), purement visuel."]]', '["Oublier de fermer un commentaire avec `-->` : tout le reste de la page disparaît.","Imbriquer des commentaires : `<!-- a <!-- b --> c -->` ne fonctionne pas.","Écrire des informations sensibles dans les commentaires.","Mélanger tabulations et espaces : l’indentation devient incohérente d’un éditeur à l’autre."]', '["Délimiter les grandes zones du document par des commentaires.","Commenter les choix non évidents, pas les évidences.","Supprimer le code commenté obsolète avant de publier.","Choisir une convention d’indentation et s’y tenir."]', 'En entreprise, les équipes adoptent un **formateur automatique** (par exemple Prettier) qui indente tout le code de la même façon à chaque enregistrement : plus de débat, et un code toujours lisible.', '["Un commentaire s’écrit `<!-- … -->` et n’est pas affiché.","Il reste visible dans le code source : rien de confidentiel.","L’indentation (2 espaces par niveau) révèle la hiérarchie des éléments."]', 'Reprenez l’exemple de la recette et ajoutez une section « Préparation » avec une liste numérotée `<ol>`, correctement indentée et précédée d’un commentaire de délimitation.', 1, 3),
(7, 3, 'Les titres de h1 à h6', 'les-titres-h1-h6', 12, 'Avant même de lire, un visiteur **survole** une page : il repère les titres pour savoir si elle répond à sa question. Les moteurs de recherche et les lecteurs d’écran font exactement la même chose. Les titres HTML ne sont donc pas une affaire de taille de texte : ils construisent le **plan** de votre page.', '["Connaître les six niveaux de titres","Construire une hiérarchie de titres logique","Comprendre l’impact des titres sur l’accessibilité et le SEO"]', '["Structure d’une page HTML"]', '## Six niveaux de titres

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

> [!TIP] Testez votre plan : lisez uniquement vos titres, dans l’ordre. Si vous comprenez le contenu de la page, la hiérarchie est bonne.', '<h1>…</h1>  <h2>…</h2>  <h3>…</h3>  <h4>…</h4>  <h5>…</h5>  <h6>…</h6>', '<h1>Guide du jardinage</h1>
<h2>Les légumes</h2>
<h3>Les tomates</h3>', NULL, '<h1>Guide du jardinage pour débutants</h1>
<p>Tout ce qu’il faut savoir pour réussir son premier potager.</p>

<h2>Les légumes faciles</h2>
<h3>Les tomates</h3>
<p>Plantez-les en mai, au soleil, et arrosez au pied.</p>
<h3>Les courgettes</h3>
<p>Très productives : deux pieds suffisent pour une famille.</p>

<h2>Les fleurs</h2>
<h3>Les roses</h3>
<p>Taillez-les à la fin de l’hiver.</p>', NULL, '[["<h1>Guide du jardinage pour débutants</h1>","Le sujet de la page : un seul h1."],["<h2>Les légumes faciles</h2>","Première grande partie."],["<h3>Les tomates</h3>","Sous-partie de « Les légumes faciles »."],["<h3>Les courgettes</h3>","Autre sous-partie du même niveau."],["<h2>Les fleurs</h2>","Nouvelle grande partie : on remonte au niveau 2."],["<h3>Les roses</h3>","Sous-partie de « Les fleurs »."]]', '[["<h1>","Titre principal de la page (un seul)."],["<h2>","Titre d’une grande section."],["<h3> à <h6>","Sous-sections de plus en plus spécifiques."]]', '["Mettre plusieurs `<h1>` pour avoir plusieurs gros titres.","Utiliser `<h4>` juste après `<h2>` parce que sa taille plaît davantage.","Mettre un paragraphe entier dans une balise de titre.","Utiliser `<strong>` en guise de titre de section : il n’apparaît pas dans le plan."]', '["Un seul `<h1>` décrivant le sujet de la page.","Une hiérarchie sans saut de niveau.","Des titres courts et explicites.","Régler la taille des titres en CSS, jamais en changeant de niveau."]', 'Sur un site e-commerce, la fiche produit a pour `<h1>` le nom du produit, puis des `<h2>` « Description », « Caractéristiques », « Avis clients ». Chaque avis peut commencer par un `<h3>`. Cette structure aide Google à afficher des extraits enrichis.', '["Six niveaux de titres : `<h1>` à `<h6>`.","Un seul `<h1>`, pas de saut de niveau.","Les titres construisent le plan de la page, la taille se règle en CSS."]', 'Rédigez le plan (titres uniquement) d’une page « Visiter Paris » avec au moins trois `h2` et deux `h3` sous chacun.', 1, 1),
(8, 3, 'Les paragraphes', 'les-paragraphes', 10, 'Le paragraphe est l’élément le plus utilisé du Web. Simple en apparence, il cache quelques comportements surprenants : pourquoi vos retours à la ligne disparaissent-ils ? Pourquoi un espace entre deux paragraphes apparaît-il tout seul ? Cette leçon répond à ces questions.', '["Écrire des paragraphes avec `<p>`","Comprendre la gestion des espaces et des retours à la ligne","Savoir ce qu’un paragraphe peut contenir"]', '["Les titres de h1 à h6"]', '## Comprendre

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

N’utilisez pas de paragraphe vide `<p></p>` ou `<p>&nbsp;</p>` pour créer de l’espace : ajustez les marges en CSS.', '<p>Texte du paragraphe.</p>', NULL, NULL, '<h1>Le café</h1>
<p>Le café est une boisson préparée à partir des graines torréfiées du caféier.</p>
<p>
  Originaire d’Éthiopie, il est aujourd’hui cultivé dans plus de
  <strong>70 pays</strong>, principalement en Amérique latine.
</p>
<p>Ce     paragraphe    contient    beaucoup    d’espaces,
mais le navigateur n’en affiche qu’un seul à chaque fois.</p>', NULL, '[["<p>Le café est une boisson…</p>","Paragraphe simple sur une ligne."],["<p>","Ouverture d’un paragraphe écrit sur plusieurs lignes, pour la lisibilité du code."],["<strong>70 pays</strong>","Un élément en ligne à l’intérieur d’un paragraphe : autorisé."],["</p>","Fermeture : le texte forme un seul paragraphe malgré les retours à la ligne du code."],["<p>Ce     paragraphe …","Les espaces multiples sont fusionnés en un seul à l’affichage."]]', '[["<p>","Paragraphe de texte (élément bloc)."],["&nbsp;","Espace insécable : empêche un retour à la ligne entre deux mots (ex. `10&nbsp;€`)."]]', '["Oublier de fermer `</p>`.","Placer un titre ou une liste dans un paragraphe.","Multiplier les espaces ou les `<p></p>` vides pour créer de l’espace.","Écrire tout un article dans un seul paragraphe géant."]', '["Une idée = un paragraphe.","Des paragraphes courts, plus faciles à lire à l’écran.","Utiliser `&nbsp;` entre un nombre et son unité : `20&nbsp;km`."]', 'Dans un blog, chaque article est une suite de `<h2>` et de `<p>`. Les rédacteurs web visent des paragraphes de 2 à 4 phrases : un texte aéré est lu jusqu’au bout bien plus souvent.', '["`<p>` crée un paragraphe, élément bloc.","Les espaces et retours à la ligne du code sont fusionnés.","Un paragraphe ne contient que du texte et des éléments en ligne."]', 'Écrivez un court article de trois paragraphes sur votre film préféré, avec un titre `<h1>` et un mot important en `<strong>` dans chaque paragraphe.', 1, 2),
(9, 3, 'Sauts de ligne et séparateurs', 'sauts-de-ligne-et-separateurs', 10, 'Parfois, un retour à la ligne fait partie du contenu lui-même : une adresse postale, un poème, les paroles d’une chanson. Et parfois, on veut marquer un changement de sujet. HTML propose deux éléments vides pour cela : `<br>` et `<hr>`. Encore faut-il savoir quand **ne pas** les utiliser.', '["Utiliser `<br>` pour un saut de ligne significatif","Utiliser `<hr>` pour une rupture thématique","Découvrir `<pre>` pour conserver la mise en forme"]', '["Les paragraphes"]', '## `<br>` : le saut de ligne

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
  /\\_/\\
 ( o.o )
  > ^ <
</pre>
```

> [!INFO] Pour afficher des balises comme du texte (par exemple dans un tutoriel), remplacez `<` par `&lt;` et `>` par `&gt;` : ce sont des **entités HTML**.', 'Ligne 1<br>Ligne 2
<hr>', NULL, NULL, '<h1>Contact</h1>
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
</pre>', NULL, '[["<strong>Boulangerie Dupain</strong><br>","Nom en gras, suivi d’un saut de ligne : l’adresse continue dans le même paragraphe."],["12 rue des Lilas<br>","Chaque ligne de l’adresse est séparée par `<br>`."],["<hr>","Changement de sujet : on passe du contact au poème."],["Le pain chaud du matin,<br>","Dans un poème, les retours à la ligne font partie du texte."],["<pre>","Texte préformaté : les espaces d’alignement sont conservés."]]', '[["<br>","Saut de ligne à l’intérieur d’un texte (élément vide)."],["<hr>","Rupture thématique entre deux paragraphes (élément vide)."],["<pre>","Texte préformaté : espaces et retours à la ligne conservés."],["&lt; &gt; &amp;","Entités pour écrire `<`, `>` et `&` comme du texte."]]', '["Enchaîner `<br><br><br>` pour créer de l’espace vertical.","Utiliser `<br>` à la place de paragraphes distincts.","Écrire `</br>` : `<br>` n’a pas de balise fermante.","Utiliser `<hr>` comme simple décoration."]', '["Réserver `<br>` aux retours à la ligne qui font partie du contenu.","Gérer tous les espacements en CSS.","Utiliser `<hr>` pour un vrai changement de sujet."]', 'Dans un pied de page, l’adresse de l’entreprise utilise souvent `<br>` (idéalement dans un élément `<address>`, vu plus tard). Les séparations visuelles entre sections, elles, sont faites en CSS avec des bordures.', '["`<br>` = saut de ligne significatif (adresse, poème).","`<hr>` = rupture thématique.","`<pre>` conserve la mise en forme du texte.","Les espacements se gèrent en CSS, pas avec des `<br>`."]', 'Écrivez votre carte de visite : nom, métier, adresse sur trois lignes, puis un `<hr>` et une phrase de présentation.', 1, 3),
(10, 4, 'Importance et emphase : strong et em', 'strong-et-em', 12, 'Mettre un mot en gras ou en italique, c’est facile. Mais en HTML, la question n’est pas « comment doit-il apparaître ? » mais « **pourquoi** ce mot est-il différent ? ». Est-il important ? Faut-il l’accentuer à l’oral ? La réponse détermine la bonne balise.', '["Utiliser `<strong>` pour l’importance","Utiliser `<em>` pour l’emphase","Distinguer `<strong>`/`<b>` et `<em>`/`<i>`"]', '["Les paragraphes"]', '## `<strong>` : l’importance

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

> [!TIP] Question à se poser : « Si je lisais ce texte à voix haute, changerais-je de ton ? » Si oui → `<em>`. « Le lecteur doit-il absolument voir ceci ? » → `<strong>`.', '<strong>important</strong>  <em>accentué</em>', NULL, NULL, '<h1>Recette du gâteau au chocolat</h1>
<p><strong>Important :</strong> préchauffez le four à 180 °C avant de commencer.</p>
<p>Faites fondre le chocolat <em>doucement</em>, sinon il va brûler.</p>
<p>Le <i lang="it">tiramisù</i> est un autre dessert au chocolat, mais c’est une autre histoire.</p>
<p>Ingrédients clés : <b>chocolat noir</b>, <b>beurre</b> et <b>œufs</b>.</p>', NULL, '[["<strong>Important :</strong>","Information à ne pas manquer : importance forte."],["<em>doucement</em>","Accentuation : c’est le mot sur lequel on insisterait à l’oral."],["<i lang=\\"it\\">tiramisù</i>","Mot étranger : `<i>` avec la langue indiquée pour la prononciation."],["<b>chocolat noir</b>","Mots mis en évidence sans importance particulière : `<b>`."]]', '[["<strong>","Contenu important, sérieux ou urgent."],["<em>","Emphase qui modifie le sens de la phrase."],["<b>","Mise en évidence sans importance supplémentaire."],["<i>","Texte dans un ton différent (terme étranger, titre d’œuvre…)."]]', '["Mettre des paragraphes entiers en `<strong>` : si tout est important, plus rien ne l’est.","Utiliser `<strong>` pour faire un titre de section.","Utiliser `<b>` et `<i>` uniquement pour leur apparence."]', '["Choisir la balise selon le sens, régler l’apparence en CSS.","Utiliser `<strong>` avec parcimonie.","Ajouter `lang` aux mots étrangers en `<i>`."]', 'Dans les conditions générales de vente d’un site, les clauses essentielles (délai de rétractation, frais) sont en `<strong>`. Dans un article, les titres d’œuvres (films, livres) sont en `<i>` ou mieux en `<cite>`.', '["`<strong>` = importance ; `<em>` = emphase.","`<b>` et `<i>` ont un sens plus faible.","L’apparence se gère en CSS."]', 'Écrivez un message de consignes de sécurité pour une piscine en utilisant correctement `<strong>` et `<em>`.', 1, 1);

INSERT INTO `lessons` (`id`, `module_id`, `title`, `slug`, `duration_minutes`, `introduction`, `objectives`, `prerequisites`, `theory`, `syntax_code`, `simple_html`, `simple_css`, `example_html`, `example_css`, `line_by_line`, `reference_items`, `common_mistakes`, `best_practices`, `practical`, `summary_points`, `challenge`, `is_published`, `sort_order`) VALUES
(11, 4, 'Citations, code et autres balises de texte', 'autres-balises-de-texte', 14, 'HTML possède une balise pour presque chaque type de contenu textuel : une citation, une abréviation, du code informatique, une formule chimique, un texte surligné… Les utiliser, c’est rendre votre contenu plus précis, plus accessible et mieux compris des moteurs de recherche.', '["Citer avec `<blockquote>`, `<q>` et `<cite>`","Marquer du code avec `<code>` et `<kbd>`","Utiliser `<abbr>`, `<mark>`, `<small>`, `<sub>`, `<sup>`"]', '["Importance et emphase : strong et em"]', '## Les citations

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

> [!INFO] `<sup>` et `<sub>` ont un vrai sens : l’exposant de « 1er » ou le « 2 » de H₂O font partie de l’information. Ne les utilisez pas uniquement pour réduire la taille d’un texte.', '<blockquote>…</blockquote>  <q>…</q>  <code>…</code>  <abbr title="…">…</abbr>', NULL, NULL, '<h1>Fiche révision</h1>
<p>Le <abbr title="HyperText Markup Language">HTML</abbr> a été inventé par Tim Berners-Lee.</p>
<blockquote cite="https://www.w3.org/People/Berners-Lee/">
  <p>Le pouvoir du Web réside dans son universalité.</p>
</blockquote>
<p>Pour copier, appuyez sur <kbd>Ctrl</kbd> + <kbd>C</kbd>.</p>
<p>La balise <code>&lt;p&gt;</code> crée un paragraphe.</p>
<p>L’eau a pour formule H<sub>2</sub>O ; la surface d’un carré vaut c<sup>2</sup>.</p>
<p>Prix : <del>49 €</del> <ins>39 €</ins> — <mark>promotion</mark> jusqu’au 1<sup>er</sup> mai.</p>
<p><small>Document à usage pédagogique.</small></p>', NULL, '[["<abbr title=\\"HyperText Markup Language\\">HTML</abbr>","Abréviation : la forme complète s’affiche au survol."],["<blockquote cite=\\"…\\">","Citation longue avec l’URL de la source dans `cite`."],["<kbd>Ctrl</kbd> + <kbd>C</kbd>","Touches du clavier."],["<code>&lt;p&gt;</code>","Code en ligne ; les entités `&lt;` `&gt;` affichent les chevrons."],["H<sub>2</sub>O … c<sup>2</sup>","Indice et exposant qui font partie de l’information."],["<del>49 €</del> <ins>39 €</ins>","Ancien prix supprimé, nouveau prix ajouté."],["<small>…</small>","Mention secondaire."]]', '[["<blockquote>","Citation longue (bloc)."],["<q>","Citation courte en ligne."],["<cite>","Titre d’une œuvre."],["<code> / <kbd>","Code informatique / touche du clavier."],["<abbr>","Abréviation (attribut `title` pour la forme longue)."],["<mark>","Texte surligné pour sa pertinence."],["<sub> / <sup>","Indice / exposant."],["<del> / <ins>","Texte supprimé / inséré."]]', '["Utiliser `<blockquote>` pour simplement décaler un texte vers la droite.","Écrire `<p>` dans `<code>` sans entités : le navigateur crée un vrai paragraphe.","Utiliser `<small>` pour réduire la taille d’un texte important.","Utiliser `<sup>` pour de la décoration."]', '["Indiquer la source des citations avec l’attribut `cite` et `<cite>`.","Déclarer les abréviations lors de leur première apparition.","Échapper `<` et `>` avec `&lt;` et `&gt;` dans le code affiché."]', 'Les sites de documentation technique (comme MDN) utilisent massivement `<code>`, `<kbd>` et `<pre>`. Les boutiques en ligne utilisent `<del>` et `<ins>` pour les prix barrés, et `<mark>` pour surligner les mots recherchés.', '["Citations : `<blockquote>`, `<q>`, `<cite>`.","Code : `<code>`, `<kbd>`, `<pre>`.","Sens précis : `<abbr>`, `<mark>`, `<small>`, `<sub>`, `<sup>`, `<del>`, `<ins>`."]', 'Créez une mini-fiche de chimie avec trois formules (CO₂, H₂SO₄, NaCl) et une citation de Marie Curie en `<blockquote>`.', 1, 2),
(12, 5, 'Créer un lien', 'creer-un-lien', 14, 'Le lien est l’invention qui a fait du Web… un **web** : une toile de documents reliés. Sans liens, chaque page serait une île. Dans cette leçon, vous allez créer vos premiers liens et apprendre à rédiger un texte de lien utile, accessible et efficace.', '["Créer un lien avec `<a href>`","Rédiger un texte de lien explicite","Comprendre les états d’un lien (visité, survolé, focus)"]', '["Balises, éléments et attributs"]', '## La syntaxe

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

> [!WARN] Un `<a>` sans attribut `href` n’est pas un vrai lien : il n’est pas atteignable au clavier.', '<a href="destination">Texte du lien</a>', '<a href="https://www.wikipedia.org">Wikipédia, l’encyclopédie libre</a>', NULL, '<h1>Mes ressources favorites</h1>
<p>Pour apprendre le HTML, je recommande la <a href="https://developer.mozilla.org/fr/docs/Web/HTML">documentation HTML de MDN</a>.</p>
<p>Pour vérifier mon code, j’utilise le <a href="https://validator.w3.org/" title="Service de validation du W3C">validateur du W3C</a>.</p>
<p>
  <a href="https://www.w3.org/">
    <img src="https://placehold.co/160x60/png?text=W3C" alt="Site du W3C">
  </a>
</p>', NULL, '[["<a href=\\"https://developer.mozilla.org/…\\">","Début du lien ; `href` contient l’adresse complète."],["documentation HTML de MDN</a>","Texte cliquable qui décrit clairement la destination."],["title=\\"Service de validation du W3C\\"","Information complémentaire au survol (facultative)."],["<a href=\\"https://www.w3.org/\\">","Un lien peut contenir une image."],["<img … alt=\\"Site du W3C\\">","Le `alt` d’une image-lien décrit la destination du lien."]]', '[["<a>","Élément de lien hypertexte."],["href","Adresse de destination du lien."],["title","Information complémentaire affichée au survol."]]', '["Écrire « cliquez ici » comme texte de lien.","Oublier `https://` pour un site externe : `href=\\"www.site.fr\\"` est interprété comme un chemin relatif.","Utiliser un lien pour déclencher une action (au lieu d’un bouton).","Imbriquer un lien dans un autre lien."]', '["Des textes de liens explicites et uniques.","Une adresse complète (`https://…`) pour les sites externes.","Préciser le format d’un fichier : « Rapport annuel (PDF, 2 Mo) »."]', 'Le menu de navigation d’un site n’est rien d’autre qu’une liste de liens. Les pieds de page regroupent les liens légaux (« Mentions légales », « Confidentialité »). Chaque bouton « Voir le produit » d’une boutique est souvent un lien stylisé en CSS.', '["Un lien : `<a href=\\"destination\\">texte</a>`.","Le texte du lien doit décrire la destination.","Lien = navigation ; bouton = action."]', 'Créez une page « Mes sites préférés » avec cinq liens externes, chacun dans un paragraphe expliquant pourquoi vous aimez ce site.', 1, 1),
(13, 5, 'Liens relatifs, absolus, ancres et nouveaux onglets', 'liens-relatifs-absolus-ancres', 16, 'Un site réel compte plusieurs pages, rangées dans des dossiers. Comment relier `index.html` à `contact.html` ? Comment sauter directement à une section de la page ? Comment ouvrir un site externe dans un nouvel onglet **sans risque de sécurité** ? C’est ce que couvre cette leçon essentielle.', '["Distinguer URL absolue et chemin relatif","Naviguer dans une arborescence de dossiers (`../`)","Créer des ancres vers une section","Utiliser `target=\\"_blank\\"` de façon sécurisée","Créer des liens e-mail et téléphone"]', '["Créer un lien"]', '## URL absolue

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

`tel:` est particulièrement utile sur mobile : un appui lance l’appel.', '<a href="page.html">…</a>
<a href="#section">…</a>
<a href="https://…" target="_blank" rel="noopener">…</a>', NULL, NULL, '<nav>
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
<p><a href="#">Retour en haut</a></p>', NULL, '[["<a href=\\"#presentation\\">Présentation</a>","Ancre : fait défiler jusqu’à l’élément `id=\\"presentation\\"`."],["<a href=\\"https://…\\" target=\\"_blank\\" rel=\\"noopener noreferrer\\">","Lien externe dans un nouvel onglet, sécurisé ; le texte prévient l’utilisateur."],["<h2 id=\\"presentation\\">","Cible de l’ancre, identifiée par son `id`."],["<a href=\\"docs/tarifs.pdf\\" download>","Chemin relatif vers un fichier ; `download` propose le téléchargement."],["<a href=\\"tel:+33412345678\\">","Lien téléphone au format international."],["<a href=\\"mailto:cabinet@exemple.fr\\">","Ouvre le logiciel de messagerie."],["<a href=\\"#\\">Retour en haut</a>","`#` seul ramène en haut de la page."]]', '[["href=\\"https://…\\"","URL absolue (site externe)."],["href=\\"dossier/page.html\\"","Chemin relatif depuis la page courante."],["href=\\"../page.html\\"","Remonte d’un dossier."],["href=\\"#id\\"","Ancre vers l’élément ayant cet `id`."],["target=\\"_blank\\"","Ouvre dans un nouvel onglet."],["rel=\\"noopener noreferrer\\"","Sécurise les liens ouverts dans un nouvel onglet."],["mailto: / tel:","Liens e-mail et téléphone."],["download","Propose de télécharger la ressource."]]', '["Écrire `href=\\"www.site.fr\\"` sans `https://` pour un site externe.","Utiliser des chemins absolus de votre ordinateur : `C:\\\\Users\\\\…\\\\page.html`.","Oublier le `#` dans une ancre, ou mettre un `#` dans l’`id` (`id=\\"#contact\\"`).","Utiliser `target=\\"_blank\\"` sans `rel=\\"noopener\\"`.","Avoir deux éléments avec le même `id` : l’ancre ne sait plus où aller."]', '["Chemins relatifs pour les pages internes, URL absolues pour l’externe.","Noms de fichiers en minuscules, sans espaces ni accents.","Toujours associer `target=\\"_blank\\"` à `rel=\\"noopener\\"`.","Signaler l’ouverture d’un nouvel onglet ou d’un fichier."]', 'Les pages longues (FAQ, conditions générales, documentation) commencent souvent par un **sommaire** composé d’ancres. Et le bouton « Appeler » des sites de restaurants sur mobile est un simple lien `tel:`.', '["URL absolue pour l’externe, chemin relatif pour l’interne.","`../` remonte d’un dossier.","Ancre : `href=\\"#id\\"` vers un élément `id=\\"id\\"`.","`target=\\"_blank\\"` toujours avec `rel=\\"noopener\\"`.","`mailto:` et `tel:` pour contacter."]', 'Créez une FAQ de quatre questions avec un sommaire d’ancres en haut et un lien « Retour au sommaire » après chaque réponse.', 1, 2),
(14, 6, 'Qu’est-ce que le CSS ?', 'qu-est-ce-que-css', 12, 'Votre HTML décrit parfaitement le contenu… mais il est austère : texte noir, fond blanc, police par défaut. Le **CSS** va transformer cette structure en interface. Et surtout, il permet de changer l’apparence d’un site entier sans toucher à une seule ligne de HTML.', '["Comprendre le rôle du CSS","Comprendre la séparation contenu / présentation","Lire une première règle CSS"]', '["Cours « HTML — Les fondations »"]', '## Qu’est-ce que c’est ?

**CSS** signifie *Cascading Style Sheets* : « feuilles de style en cascade ». C’est le langage qui décrit **l’apparence** des éléments HTML : couleurs, polices, tailles, espacements, mise en page, animations…

## Pourquoi séparer le style du contenu ?

Imaginez un site de 200 pages où tous les titres sont bleus. Le client veut maintenant des titres verts :

- si la couleur était écrite dans chaque page HTML, il faudrait modifier 200 fichiers ;
- avec une feuille CSS commune, on change **une seule ligne**.

Cette séparation apporte aussi :

- un HTML plus **léger et lisible** ;
- la possibilité d’adapter l’affichage à l’**écran** (mobile, ordinateur) ou à l’**impression** ;
- un **cache** efficace : le fichier CSS est téléchargé une fois pour tout le site.

> [!INFO] Le site historique [CSS Zen Garden](https://csszengarden.com) le démontre depuis 2003 : un même fichier HTML, des centaines de designs totalement différents, uniquement grâce au CSS.

## Comment ça fonctionne ?

Le CSS est composé de **règles**. Chaque règle dit : « pour **ces** éléments, applique **ces** styles ».

```css
h1 {
  color: navy;
  font-size: 32px;
}
```

« Pour tous les éléments `h1`, la couleur du texte est bleu marine et la taille de police 32 pixels. »

## « En cascade » ?

Plusieurs règles peuvent s’appliquer au même élément. La **cascade** est l’ensemble des règles qui décident laquelle l’emporte (origine, spécificité, ordre). Vous l’étudierez en détail dans le module Sélecteurs.

## Quand l’utiliser ?

Pour **toute** question d’apparence. Si vous vous demandez « à quoi ça ressemble ? », c’est du CSS. Si c’est « qu’est-ce que c’est ? », c’est du HTML.', 'sélecteur {
  propriété: valeur;
}', '<h1>Mon titre</h1>', 'h1 {
  color: navy;
}', '<h1>Café des Arts</h1>
<p>Un lieu chaleureux au cœur de la ville.</p>
<p>Concerts tous les vendredis soir.</p>', 'body {
  background-color: #fdf6ec;
  font-family: Georgia, serif;
}

h1 {
  color: #7c2d12;
  font-size: 40px;
}

p {
  color: #44403c;
  font-size: 18px;
}', '[["body {","Sélecteur : la règle s’applique à l’élément `body` (toute la page)."],["  background-color: #fdf6ec;","Couleur de fond crème."],["  font-family: Georgia, serif;","Police utilisée ; `serif` en solution de repli."],["h1 {","Nouvelle règle pour tous les titres `h1`."],["  color: #7c2d12;","Couleur du texte : brun foncé."],["  font-size: 40px;","Taille du texte : 40 pixels."],["p {","Règle pour tous les paragraphes."]]', '[["color","Couleur du texte."],["background-color","Couleur de fond."],["font-family","Police de caractères."],["font-size","Taille du texte."]]', '["Écrire du CSS dans le HTML sans balise `<style>` ni fichier : il s’affiche comme du texte.","Oublier le point-virgule à la fin d’une déclaration.","Vouloir choisir des balises HTML pour leur apparence au lieu d’utiliser le CSS."]', '["Garder le HTML pour le sens et le CSS pour l’apparence.","Une propriété par ligne, indentée.","Utiliser une feuille de style commune à tout le site."]', 'Les grandes entreprises maintiennent un **design system** : une bibliothèque de styles CSS (couleurs, typographies, composants) partagée par tous leurs sites. Changer la couleur de marque se fait en un seul endroit.', '["CSS = apparence ; HTML = structure.","Une règle : sélecteur + déclarations `propriété: valeur;`.","Le style centralisé se modifie en un seul endroit."]', 'Dans l’éditeur libre, reprenez votre page de présentation HTML et donnez-lui une couleur de fond, une police et une couleur de titre.', 1, 1),
(15, 6, 'Intégrer le CSS à une page', 'integrer-le-css', 12, 'Il existe trois façons d’ajouter du CSS à une page HTML. Toutes fonctionnent, mais une seule est recommandée pour un vrai site. Comprendre les trois vous permettra de lire n’importe quel code… et de choisir la bonne méthode.', '["Connaître le style en ligne, la balise `<style>` et le fichier externe","Relier une feuille de style avec `<link>`","Choisir la méthode adaptée"]', '["Qu’est-ce que le CSS ?","Head et body"]', '## 1. Le style en ligne (attribut `style`)

```html
<p style="color: red; font-size: 20px;">Texte rouge</p>
```

Le style s’applique à **un seul élément**. À éviter : il mélange contenu et présentation, ne se réutilise pas et l’emporte sur presque toutes les autres règles, ce qui complique la maintenance.

## 2. La balise `<style>` dans le `<head>`

```html
<head>
  <style>
    p { color: red; }
  </style>
</head>
```

Pratique pour un test ou une page unique, mais les styles ne sont pas partagés entre les pages.

## 3. La feuille de style externe (recommandée)

On écrit le CSS dans un fichier séparé, par exemple `style.css`, puis on le relie dans le `<head>` :

```html
<head>
  <link rel="stylesheet" href="css/style.css">
</head>
```

- `rel="stylesheet"` : la ressource liée est une feuille de style ;
- `href` : le chemin du fichier (relatif, comme pour les liens).

Avantages : un seul fichier pour tout le site, mis en cache par le navigateur, et un HTML parfaitement propre.

> [!INFO] Dans l’éditeur de cette plateforme, le panneau CSS joue le rôle du fichier `style.css` : il est automatiquement relié à votre HTML.

## Ordre et priorité

Si plusieurs sources définissent la même propriété pour le même élément :

1. le style **en ligne** l’emporte en général ;
2. sinon, entre `<style>` et `<link>`, c’est la règle **déclarée en dernier** qui gagne (à spécificité égale).', '<link rel="stylesheet" href="style.css">', NULL, NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Trois méthodes</title>
  <style>
    h1 { color: darkgreen; }
    p { color: gray; }
  </style>
</head>
<body>
  <h1>Méthode interne</h1>
  <p>Ce paragraphe est gris grâce à la balise style.</p>
  <p style="color: crimson;">Ce paragraphe utilise un style en ligne.</p>
</body>
</html>', NULL, '[["<style>","Début des styles internes, dans le head."],["  h1 { color: darkgreen; }","Règle écrite sur une ligne (acceptable pour une règle courte)."],["</style>","Fin des styles internes."],["<p style=\\"color: crimson;\\">","Style en ligne : il l’emporte sur la règle `p` du head."]]', '[["style=\\"…\\"","Attribut de style en ligne (à éviter)."],["<style>","Balise de styles internes, dans le head."],["<link rel=\\"stylesheet\\" href=\\"…\\">","Relie une feuille de style externe (recommandé)."]]', '["Oublier `rel=\\"stylesheet\\"` : le fichier n’est pas appliqué.","Se tromper de chemin dans `href` (dossier `css/` oublié).","Mettre des balises `<style>` dans le `<body>` ou du HTML dans le fichier `.css`.","Multiplier les styles en ligne."]', '["Utiliser une feuille externe pour tout vrai site.","Ranger les fichiers CSS dans un dossier `css/` ou `assets/css/`.","Réserver les styles en ligne aux cas exceptionnels (e-mails HTML)."]', 'La plupart des sites chargent une ou deux feuilles externes dans le `<head>`. Les newsletters HTML, elles, sont une exception : de nombreux logiciels de messagerie ignorent les feuilles externes, d’où l’usage massif du style en ligne dans les e-mails.', '["Trois méthodes : attribut `style`, balise `<style>`, fichier externe.","Recommandé : `<link rel=\\"stylesheet\\" href=\\"…\\">` dans le head.","Le style en ligne est prioritaire mais difficile à maintenir."]', 'Créez un squelette HTML complet qui relie un fichier `css/style.css` et un second fichier `css/print.css` avec l’attribut `media="print"`.', 1, 2),
(16, 6, 'La syntaxe d’une règle CSS', 'syntaxe-css', 12, 'Le CSS a une syntaxe simple mais stricte : une accolade oubliée ou un point-virgule manquant, et la règle — voire toute la suite du fichier — est ignorée, **sans message d’erreur**. Connaître précisément chaque partie d’une règle vous évitera de longues séances de débogage.', '["Nommer chaque partie d’une règle","Écrire des déclarations valides","Commenter du CSS","Comprendre comment le navigateur gère les erreurs"]', '["Intégrer le CSS à une page"]', '## Anatomie d’une règle

```css
p {
  color: #333;
  line-height: 1.6;
}
```

| Partie | Exemple | Rôle |
|---|---|---|
| Sélecteur | `p` | Quels éléments sont ciblés |
| Bloc de déclarations | `{ … }` | Entre accolades |
| Déclaration | `color: #333;` | Une propriété et sa valeur |
| Propriété | `color` | Ce que l’on modifie |
| Valeur | `#333` | Comment on le modifie |

Chaque déclaration se termine par un **point-virgule**. Il est facultatif après la dernière, mais le mettre toujours évite des erreurs lors d’ajouts.

## Grouper des sélecteurs

Pour appliquer les mêmes styles à plusieurs éléments, on les sépare par des virgules :

```css
h1, h2, h3 {
  font-family: Arial, sans-serif;
}
```

## Les commentaires CSS

```css
/* Styles des titres */
h1 { color: navy; }
```

Attention : la syntaxe est différente du HTML (`<!-- -->` ne fonctionne pas en CSS).

## Les erreurs : le navigateur ignore sans prévenir

- Une **propriété inconnue** (`colr: red;`) : seule cette déclaration est ignorée.
- Une **valeur invalide** (`color: 12px;`) : la déclaration est ignorée.
- Une **accolade manquante** : la suite peut être mal interprétée.

> [!TIP] Les outils de développement (`F12` → onglet Éléments → Styles) barrent les déclarations invalides et affichent un triangle d’avertissement : c’est le premier réflexe quand un style « ne marche pas ».

## Casse et espaces

Les propriétés et la plupart des valeurs ne sont pas sensibles à la casse, mais la convention est de tout écrire en **minuscules**. Les espaces et retours à la ligne sont libres : on indente pour la lisibilité.', 'sélecteur {
  propriété: valeur;
  propriété: valeur;
}', NULL, NULL, '<h1>Menu du jour</h1>
<h2>Entrée</h2>
<p>Velouté de potiron.</p>
<h2>Plat</h2>
<p>Risotto aux champignons.</p>', '/* Titres : même police pour h1 et h2 */
h1, h2 {
  font-family: "Trebuchet MS", sans-serif;
  color: #065f46;
}

h1 {
  font-size: 36px;
}

/* Paragraphes */
p {
  color: #374151;
  font-size: 18px;
}', '[["/* Titres : même police pour h1 et h2 */","Commentaire CSS : ignoré par le navigateur."],["h1, h2 {","Sélecteurs groupés : la règle s’applique aux h1 ET aux h2."],["  font-family: \\"Trebuchet MS\\", sans-serif;","Les noms de police contenant des espaces se mettent entre guillemets."],["h1 {","Règle spécifique aux h1, en plus de la règle groupée."],["  font-size: 36px;","Déclaration : propriété `font-size`, valeur `36px`."]]', '[["{ }","Délimitent le bloc de déclarations."],[":","Sépare la propriété de sa valeur."],[";","Termine une déclaration."],[",","Sépare des sélecteurs groupés."],["/* … */","Commentaire CSS."]]', '["Oublier le point-virgule : `color: red font-size: 20px;` est invalide.","Utiliser `=` au lieu de `:` : `color = red;`.","Oublier l’accolade fermante.","Écrire un commentaire HTML `<!-- -->` dans un fichier CSS.","Faute de frappe dans une propriété : `backgroud-color`."]', '["Une déclaration par ligne, indentée de 2 espaces.","Toujours terminer par un point-virgule.","Grouper les sélecteurs qui partagent les mêmes styles.","Commenter les grandes sections de la feuille."]', 'Les équipes utilisent des outils comme **Stylelint** qui signalent automatiquement les propriétés inconnues, les points-virgules manquants ou les doublons avant même que le code soit publié.', '["Règle = sélecteur + `{ propriété: valeur; }`.","Sélecteurs groupés avec des virgules.","Commentaires : `/* … */`.","Une erreur est ignorée silencieusement : vérifiez avec `F12`."]', 'Écrivez une feuille de style de 5 règles pour une page de recette, avec un commentaire au-dessus de chaque règle et au moins un groupe de sélecteurs.', 1, 3),
(17, 7, 'Sélecteurs de type, de classe et d’identifiant', 'selecteurs-de-base', 15, 'Styler tous les paragraphes d’un coup, c’est bien. Mais comment styler **un seul** paragraphe d’introduction ? Ou tous les boutons, quelle que soit leur balise ? Les sélecteurs de classe et d’identifiant sont la réponse — et ils sont au cœur de 90 % du CSS que vous écrirez.', '["Utiliser les sélecteurs de type, de classe et d’identifiant","Ajouter des classes dans le HTML","Savoir quand préférer une classe à un id"]', '["La syntaxe d’une règle CSS"]', '## Le sélecteur de type (balise)

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

> [!TIP] Nommez vos classes selon leur **rôle**, pas leur apparence : `.alerte` plutôt que `.texte-rouge`. Si demain l’alerte devient orange, le nom reste juste.', 'p { }        /* type */
.intro { }   /* classe */
#menu { }    /* identifiant */
* { }        /* universel */', NULL, NULL, '<header id="en-tete">
  <h1>Le Journal du Code</h1>
</header>
<p class="intro">Chaque semaine, une astuce pour mieux coder.</p>
<p>Cette semaine : les sélecteurs CSS.</p>
<p class="alerte">Nouveau : la newsletter est disponible !</p>
<a class="alerte bouton" href="#">S’abonner</a>', '* {
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
}', '[["* {","Sélecteur universel : police appliquée à tous les éléments."],["#en-tete {","Cible l’élément unique `id=\\"en-tete\\"`."],["p {","Cible tous les paragraphes."],[".intro {","Cible les éléments ayant la classe `intro`."],[".alerte {","S’applique à un `<p>` ET à un `<a>` : une classe se réutilise."],[".bouton {","Le lien a deux classes : il reçoit les styles de `.alerte` et de `.bouton`."]]', '[["element","Sélecteur de type : tous les éléments de cette balise."],[".classe","Éléments ayant cette classe."],["#id","L’élément ayant cet identifiant."],["*","Tous les éléments."],["p.intro","Les `<p>` ayant la classe `intro`."]]', '["Oublier le point : `intro { }` cible une balise `<intro>` inexistante.","Mettre le point dans le HTML : `class=\\".intro\\"`.","Utiliser le même `id` sur plusieurs éléments.","Écrire `class=\\"intro\\" class=\\"grand\\"` : un seul attribut class, valeurs séparées par des espaces.","Nommer les classes d’après l’apparence (`.rouge`, `.gauche`)."]', '["Styler principalement avec des classes.","Noms en minuscules avec tirets : `.carte-produit`.","Noms selon le rôle, pas l’apparence."]', 'Les frameworks et design systems reposent entièrement sur les classes : `class="btn btn-primary btn-lg"`. Chaque classe apporte un aspect (base, couleur, taille), combinables à volonté.', '["Type : `p` — Classe : `.nom` — Id : `#nom` — Tous : `*`.","Une classe se réutilise, un id est unique.","On style avec des classes, nommées selon leur rôle."]', 'Créez trois boutons `<a>` partageant une classe `.btn`, avec des classes de variante `.btn-succes`, `.btn-danger`, `.btn-neutre` qui changent seulement la couleur de fond.', 1, 1),
(18, 7, 'Combinateurs : descendant, enfant, frère', 'combinateurs-et-groupement', 14, 'Les liens du menu doivent être blancs, mais pas ceux des articles. Le premier paragraphe après un titre doit être plus grand. Pour ce genre de ciblage **selon la position** dans la page, CSS propose les **combinateurs**, qui s’appuient sur l’arbre parent/enfant du HTML.', '["Utiliser le sélecteur descendant (espace)","Utiliser le sélecteur enfant direct (`>`)","Découvrir les sélecteurs de frères (`+`, `~`) et d’attribut"]', '["Sélecteurs de type, de classe et d’identifiant"]', '## Le descendant : l’espace

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

> [!WARN] Évitez les sélecteurs trop longs comme `body div.page main section article p a` : ils sont fragiles (la moindre modification du HTML les casse) et difficiles à surcharger. Deux ou trois niveaux suffisent presque toujours.', 'A B    /* B dans A */
A > B  /* B enfant direct de A */
A + B  /* B juste après A */
A ~ B  /* B après A */', NULL, NULL, '<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#">Blog</a>
</nav>
<article>
  <h2>Les combinateurs</h2>
  <p>Ce premier paragraphe suit directement le titre.</p>
  <p>Ce deuxième paragraphe, non. Voir le <a href="guide.pdf">guide PDF</a>.</p>
</article>', '.menu {
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
}', '[[".menu a {","Descendant : uniquement les liens situés dans `.menu`."],["  color: white;","Les liens de l’article gardent leur couleur par défaut."],["h2 + p {","Frère adjacent : seulement le paragraphe qui suit immédiatement le titre."],["a[href$=\\".pdf\\"] {","Attribut : les liens dont l’adresse se termine par `.pdf`."]]', '[["A B","Descendant (à n’importe quelle profondeur)."],["A > B","Enfant direct."],["A + B","Frère immédiatement suivant."],["A ~ B","Tous les frères suivants."],["[attr=\\"val\\"]","Attribut égal à une valeur."],["[attr^=\\"val\\"] / [attr$=\\"val\\"]","Commence par / finit par."]]', '["Confondre `p.note` et `p .note`.","Enchaîner cinq ou six niveaux de sélecteurs.","Utiliser `+` en pensant cibler tous les frères suivants (c’est `~`)."]', '["Limiter la profondeur à deux ou trois niveaux.","Préférer une classe dédiée quand le ciblage devient compliqué.","Utiliser les sélecteurs d’attribut pour les cas « naturels » (liens externes, types de champs)."]', 'Les sélecteurs d’attribut sont très utilisés pour signaler visuellement les liens externes (`a[target="_blank"]`) ou les fichiers à télécharger (`a[href$=".pdf"]`), sans ajouter de classes à la main.', '["Espace = descendant, `>` = enfant direct.","`+` = frère suivant immédiat, `~` = frères suivants.","`[attr]` cible selon les attributs.","Des sélecteurs courts sont plus robustes."]', 'Dans un article, rendez gris et en italique tous les paragraphes qui suivent un `<blockquote>`, et ajoutez une couleur spécifique aux liens `mailto:`.', 1, 2),
(19, 7, 'Cascade, spécificité et héritage', 'cascade-specificite-heritage', 18, '« J’ai écrit `color: red`, mais mon texte reste bleu ! » C’est LA frustration classique en CSS. La raison : une autre règle l’emporte. Comprendre **la cascade**, **la spécificité** et **l’héritage**, c’est comprendre enfin pourquoi un style s’applique… ou pas.', '["Comprendre l’ordre de la cascade","Calculer la spécificité d’un sélecteur","Savoir quelles propriétés sont héritées","Éviter `!important`"]', '["Combinateurs : descendant, enfant, frère"]', '## Le problème

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

> [!TIP] Dans les outils de développement (`F12`), le panneau Styles liste toutes les règles appliquées, triées par priorité : les déclarations perdantes sont **barrées**. C’est la meilleure façon de comprendre un conflit.', '/* spécificité : (id, classes, balises) */
#a .b p   /* 1,1,1 */', NULL, NULL, '<article class="article" id="principal">
  <p>Paragraphe 1 : quelle couleur ?</p>
  <p class="important">Paragraphe 2 : quelle couleur ?</p>
  <p>Un <a href="#">lien</a> qui hérite de la couleur.</p>
</article>', 'body {
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
}', '[["body { font-family: … }","Propriété de texte héritée par tous les descendants."],["article p { color: blue; }","Spécificité 0,0,2."],["p { color: gray; }","Écrite après mais moins spécifique (0,0,1) : elle perd."],[".important { color: crimson; }","Une classe (0,1,0) l’emporte sur deux balises (0,0,2)."],["a { color: inherit; }","Le lien prend la couleur de son paragraphe (bleu)."]]', '[["Spécificité","Score (id, classes/attributs/pseudo-classes, balises) d’un sélecteur."],["!important","Priorité maximale ; à éviter."],["inherit","Force l’héritage de la valeur du parent."],["initial","Remet la valeur par défaut de la propriété."]]', '["Ajouter `!important` partout pour « forcer » un style.","Allonger les sélecteurs pour gagner en spécificité au lieu de repenser les classes.","Penser que `margin` ou `border` sont hérités.","Oublier qu’à spécificité égale, la dernière règle gagne."]', '["Garder des spécificités faibles et homogènes (une classe).","Définir les styles de texte communs sur `body`.","Inspecter les conflits avec les outils de développement."]', 'Quand vous intégrez un thème ou une bibliothèque, vos styles doivent la surcharger. Une méthode propre : charger votre feuille **après** celle de la bibliothèque et utiliser des sélecteurs de même spécificité. L’ordre fait alors le travail, sans `!important`.', '["Ordre : importance > spécificité > ordre d’écriture.","Spécificité : id > classe > balise.","Les propriétés de texte sont héritées, pas celles des boîtes.","`!important` est un dernier recours."]', 'Calculez la spécificité de : `nav ul li a`, `.menu a:hover`, `#top .menu a`. Classez-les de la plus faible à la plus forte.', 1, 3),
(20, 8, 'Les couleurs en CSS', 'les-couleurs-css', 15, 'Les couleurs sont souvent la première chose que l’on remarque sur un site. CSS propose plusieurs notations : noms, hexadécimal, RGB, HSL. Elles décrivent toutes les mêmes couleurs, mais chacune a ses avantages. Vous apprendrez aussi à vérifier qu’une couleur de texte reste **lisible** pour tous.', '["Utiliser les noms de couleurs, l’hexadécimal, `rgb()` et `hsl()`","Gérer la transparence","Comprendre le contraste et l’accessibilité"]', '["Les sélecteurs"]', '## Où utilise-t-on les couleurs ?

`color` (texte), `background-color` (fond), `border-color` (bordure), mais aussi les ombres, dégradés, soulignements…

## 1. Les noms de couleurs

CSS reconnaît environ 140 noms : `red`, `navy`, `tomato`, `gold`, `rebeccapurple`… Pratiques pour tester, trop limités pour un vrai design.

## 2. L’hexadécimal

`#RRVVBB` : trois paires de chiffres hexadécimaux (0 à 9 puis a à f) pour le **rouge**, le **vert** et le **bleu**, de `00` (rien) à `ff` (maximum).

```css
color: #ff0000; /* rouge pur */
color: #1e293b; /* bleu ardoise très foncé */
color: #fff;    /* forme courte de #ffffff : blanc */
```

C’est le format le plus répandu : c’est celui que donnent les logiciels de design (Figma, Photoshop).

## 3. `rgb()`

Les mêmes composantes, en nombres de 0 à 255 :

```css
color: rgb(255 0 0);        /* rouge */
color: rgb(0 0 0 / 50%);    /* noir à 50 % d’opacité */
```

L’ancienne syntaxe `rgba(0, 0, 0, 0.5)` avec des virgules fonctionne toujours.

## 4. `hsl()` : la plus intuitive

- **H**ue (teinte) : un angle sur le cercle chromatique, de 0 à 360 (0 = rouge, 120 = vert, 240 = bleu) ;
- **S**aturation : de 0 % (gris) à 100 % (couleur vive) ;
- **L**ightness (luminosité) : de 0 % (noir) à 100 % (blanc).

```css
background: hsl(220 90% 50%);  /* bleu vif */
background: hsl(220 90% 90%);  /* même bleu, très clair */
```

Idéal pour créer des variantes d’une même couleur : il suffit de changer la luminosité.

## La transparence

- `opacity: 0.5;` rend **tout l’élément** transparent (texte et enfants compris) ;
- une couleur avec canal alpha (`rgb(0 0 0 / 50%)`) ne rend transparente **que cette couleur**.

## Le contraste : une question d’accessibilité

Un texte gris clair sur fond blanc est illisible pour beaucoup de personnes (vue faible, écran au soleil…). Les règles **WCAG** demandent un **rapport de contraste** d’au moins **4,5:1** pour le texte courant (3:1 pour les grands textes).

> [!TIP] Vérifiez vos couleurs avec un outil comme le *Contrast Checker* de WebAIM ou directement dans les outils de développement (sélecteur de couleur → ratio de contraste).', 'color: tomato;
color: #ff6347;
color: rgb(255 99 71);
color: hsl(9 100% 64%);', NULL, NULL, '<div class="carte">
  <h2>Formats de couleur</h2>
  <p class="nom">Nom : tomato</p>
  <p class="hexa">Hexadécimal : #0ea5e9</p>
  <p class="rgb">RGB : rgb(22 163 74)</p>
  <p class="hsl">HSL : hsl(270 70% 50%)</p>
  <p class="alpha">Fond noir à 60 % d’opacité</p>
</div>', '.carte {
  background-color: #f8fafc;
  color: #0f172a;
  padding: 16px;
  font-family: system-ui, sans-serif;
}

.nom   { color: tomato; }
.hexa  { color: #0ea5e9; }
.rgb   { color: rgb(22 163 74); }
.hsl   { color: hsl(270 70% 50%); }

.alpha {
  background-color: rgb(0 0 0 / 60%);
  color: white;
  padding: 8px;
}', '[["  background-color: #f8fafc;","Fond presque blanc en hexadécimal."],["  color: #0f172a;","Texte presque noir : contraste élevé."],[".nom   { color: tomato; }","Nom de couleur prédéfini."],[".rgb   { color: rgb(22 163 74); }","Vert défini par ses composantes rouge, vert, bleu."],[".hsl   { color: hsl(270 70% 50%); }","Violet : teinte 270°, saturation 70 %, luminosité 50 %."],["  background-color: rgb(0 0 0 / 60%);","Noir semi-transparent : seul le fond est transparent, pas le texte."]]', '[["color","Couleur du texte (héritée)."],["background-color","Couleur de fond (non héritée)."],["#rrggbb","Notation hexadécimale."],["rgb(r g b / a)","Rouge, vert, bleu (0-255) et opacité."],["hsl(h s l / a)","Teinte (0-360), saturation et luminosité (%)."],["opacity","Opacité de tout l’élément, de 0 à 1."],["currentColor","Mot-clé : la valeur actuelle de `color`."]]', '["Oublier le `#` : `color: ff0000;` est invalide.","Utiliser `opacity` pour un fond transparent : le texte devient transparent aussi.","Choisir des couleurs trop peu contrastées (gris clair sur blanc).","Transmettre une information uniquement par la couleur (« les champs en rouge sont obligatoires »)."]', '["Définir une palette limitée (3 à 5 couleurs) et s’y tenir.","Vérifier le contraste de chaque couple texte/fond.","Utiliser HSL pour créer des variantes claires/foncées."]', 'Une charte graphique fournit généralement les couleurs en hexadécimal. L’intégrateur les déclare une fois (en variables CSS, niveau 3) : `--couleur-primaire: #4f46e5;`, puis décline des variantes (survol plus foncé, fond plus clair).', '["Quatre notations : nom, `#hex`, `rgb()`, `hsl()`.","Transparence : canal alpha (couleur) ou `opacity` (élément entier).","Contraste minimum 4,5:1 pour le texte."]', 'Créez une palette de 5 nuances d’un même bleu en HSL (luminosité 20 %, 35 %, 50 %, 70 %, 90 %) affichées dans 5 blocs.', 1, 1);

INSERT INTO `lessons` (`id`, `module_id`, `title`, `slug`, `duration_minutes`, `introduction`, `objectives`, `prerequisites`, `theory`, `syntax_code`, `simple_html`, `simple_css`, `example_html`, `example_css`, `line_by_line`, `reference_items`, `common_mistakes`, `best_practices`, `practical`, `summary_points`, `challenge`, `is_published`, `sort_order`) VALUES
(21, 8, 'Les arrière-plans', 'arriere-plans', 15, 'Un bandeau avec une photo en fond, un motif discret, un visuel qui couvre tout l’écran… Les propriétés `background-*` permettent tout cela. Bien utilisées, elles rendent une page vivante ; mal utilisées, elles rendent le texte illisible. Voyons comment les maîtriser.', '["Ajouter une image de fond","Contrôler la répétition, la taille et la position","Utiliser la propriété raccourcie `background`","Garantir la lisibilité du texte"]', '["Les couleurs en CSS"]', '## Les propriétés d’arrière-plan

| Propriété | Rôle | Valeurs courantes |
|---|---|---|
| `background-color` | Couleur de fond | toute couleur |
| `background-image` | Image de fond | `url("image.jpg")`, dégradés |
| `background-repeat` | Répétition | `repeat`, `no-repeat`, `repeat-x` |
| `background-size` | Taille | `cover`, `contain`, `100px auto` |
| `background-position` | Position | `center`, `top right`, `50% 20%` |
| `background-attachment` | Défilement | `scroll`, `fixed` |

## `cover` ou `contain` ?

- `cover` : l’image **couvre toute la zone**, quitte à être rognée. Parfait pour une bannière.
- `contain` : l’image est **entièrement visible**, quitte à laisser des vides.

## La propriété raccourcie

```css
.banniere {
  background: #1e293b url("montagne.jpg") center / cover no-repeat;
}
```

L’ordre est souple, mais `taille` doit suivre `position` avec une barre oblique : `center / cover`.

## Image de fond ou balise `<img>` ?

- Une image qui fait **partie du contenu** (photo d’un produit, illustration d’un article) → `<img>` avec un `alt`.
- Une image **décorative** (texture, ambiance derrière un titre) → `background-image`.

Les images de fond n’ont pas de texte alternatif : les lecteurs d’écran les ignorent.

## Lisibilité du texte sur une image

Une photo contient des zones claires et foncées : le texte peut devenir illisible. Solution classique : superposer un **voile** sombre grâce à un dégradé :

```css
background:
  linear-gradient(rgb(0 0 0 / 55%), rgb(0 0 0 / 55%)),
  url("photo.jpg") center / cover;
```

Et toujours définir une `background-color` de secours, affichée pendant le chargement ou si l’image est absente.', 'background: couleur url("image.jpg") position / taille répétition;', NULL, NULL, '<header class="banniere">
  <h1>Randonnée dans les Alpes</h1>
  <p>Trois jours entre lacs et sommets.</p>
</header>
<section class="motif">
  <p>Section avec un motif de points répété.</p>
</section>', '.banniere {
  padding: 60px 24px;
  color: white;
  text-align: center;
  background-color: #1e293b;
  background-image:
    linear-gradient(rgb(0 0 0 / 50%), rgb(0 0 0 / 50%)),
    url("https://placehold.co/1200x500/png?text=Montagnes");
  background-size: cover;
  background-position: center;
}

.motif {
  padding: 32px;
  background-color: #fefce8;
  background-image: radial-gradient(#facc15 2px, transparent 2px);
  background-size: 20px 20px;
}', '[["  background-color: #1e293b;","Couleur de secours pendant le chargement de l’image."],["  background-image: linear-gradient(…), url(…);","Deux couches : un voile sombre semi-transparent PAR-DESSUS la photo."],["  background-size: cover;","L’image couvre toute la bannière."],["  background-position: center;","L’image est centrée : les bords sont rognés en priorité."],["  background-image: radial-gradient(…);","Un petit dégradé circulaire sert de motif (pas besoin de fichier image)."],["  background-size: 20px 20px;","Le motif mesure 20×20 px et se répète."]]', '[["background-image","Une ou plusieurs images de fond (la première est au-dessus)."],["background-size","`cover`, `contain` ou dimensions."],["background-position","Position de l’image dans la zone."],["background-repeat","Répétition de l’image."],["background","Propriété raccourcie qui regroupe toutes les autres."]]', '["Oublier `url()` ou les guillemets autour du chemin.","Se tromper de chemin relatif (il est relatif au fichier CSS, pas au HTML).","Placer une information importante dans une image de fond (inaccessible).","Mettre du texte blanc sur une photo claire sans voile.","Écrire `background` après `background-image` : la propriété raccourcie réinitialise l’image."]', '["Toujours prévoir une `background-color` de secours.","Utiliser `cover` + `center` pour les bannières.","Réserver les images de fond à la décoration.","Optimiser le poids des images (WebP, compression)."]', 'La section « héro » en haut des sites vitrines utilise presque toujours une image de fond en `cover` avec un voile dégradé et un titre centré : c’est exactement l’exemple de cette leçon.', '["`background-image: url(…)` ajoute une image de fond.","`cover` couvre, `contain` montre tout.","Un voile en dégradé assure la lisibilité.","Image de contenu → `<img>` ; décoration → background."]', 'Créez une bannière pleine largeur de 300 px de haut avec une image de fond, un voile bleu semi-transparent et un titre centré.', 1, 2),
(22, 9, 'Polices, tailles et hauteur de ligne', 'polices-et-tailles', 15, 'Le Web, c’est à 90 % du texte. Une bonne typographie rend la lecture agréable sans que personne ne la remarque ; une mauvaise fait fuir les visiteurs sans qu’ils sachent pourquoi. Dans cette leçon, vous apprendrez les propriétés qui comptent vraiment : la police, sa taille, sa graisse et l’interligne.', '["Choisir une pile de polices avec `font-family`","Régler `font-size`, `font-weight`, `font-style`","Régler une hauteur de ligne confortable","Charger une police web"]', '["Cascade, spécificité et héritage"]', '## `font-family` : la pile de polices

On indique une **liste** de polices, par ordre de préférence. Le navigateur utilise la première disponible sur l’appareil :

```css
body {
  font-family: "Helvetica Neue", Arial, sans-serif;
}
```

La liste se termine toujours par une **famille générique** :

| Famille | Aspect | Usage |
|---|---|---|
| `serif` | Empattements (petits pieds) | Presse, textes littéraires |
| `sans-serif` | Sans empattements | Interfaces, écrans |
| `monospace` | Chasse fixe | Code |
| `system-ui` | Police du système | Interfaces natives |

## Polices web

Pour utiliser une police qui n’est pas installée, on la charge (fichier `.woff2` ou service comme Google Fonts) avec `@font-face` ou un `<link>`. Limitez-vous à deux familles et quelques graisses : chaque fichier ralentit le chargement.

## `font-size`

```css
body { font-size: 18px; }
h1 { font-size: 2.5rem; }
```

Pour le texte courant, **16 à 18 px** est un bon minimum sur écran. (Les unités `rem` et `em` sont détaillées dans la leçon Unités.)

## `font-weight` et `font-style`

- `font-weight` : `normal` (400), `bold` (700), ou une valeur numérique de 100 à 900 si la police les propose ;
- `font-style` : `normal` ou `italic`.

## `line-height` : l’interligne

C’est la propriété la plus sous-estimée. Un texte trop serré fatigue la lecture. On utilise une valeur **sans unité**, multipliée par la taille de police :

```css
body { line-height: 1.6; }
h1 { line-height: 1.2; }
```

Pour les paragraphes : **1.5 à 1.7**. Pour les titres : **1.1 à 1.3**.

> [!TIP] Une ligne de texte agréable compte **50 à 75 caractères**. Au-delà, l’œil se perd en revenant à la ligne. Limitez la largeur des paragraphes (par exemple `max-width: 65ch`).', 'font-family: Arial, sans-serif;
font-size: 18px;
font-weight: 700;
line-height: 1.6;', NULL, NULL, '<article class="article">
  <h1>L’art de la typographie</h1>
  <p class="chapeau">Une bonne typographie se remarque à peine : elle rend simplement la lecture facile.</p>
  <p>La taille, la graisse et l’interligne travaillent ensemble. Un paragraphe bien réglé se lit sans effort, même sur un petit écran.</p>
  <p class="code">font-family: monospace;</p>
</article>', '.article {
  font-family: Georgia, "Times New Roman", serif;
  font-size: 18px;
  line-height: 1.7;
  color: #1f2937;
  max-width: 65ch;
}

.article h1 {
  font-family: "Trebuchet MS", Arial, sans-serif;
  font-size: 40px;
  font-weight: 800;
  line-height: 1.15;
}

.chapeau {
  font-size: 22px;
  font-style: italic;
  color: #4b5563;
}

.code {
  font-family: "Courier New", monospace;
}', '[["  font-family: Georgia, \\"Times New Roman\\", serif;","Pile de polices serif pour la lecture d’un article."],["  line-height: 1.7;","Interligne généreux (valeur sans unité)."],["  max-width: 65ch;","Environ 65 caractères par ligne : largeur de lecture idéale."],["  font-weight: 800;","Graisse très forte pour le titre."],["  line-height: 1.15;","Les titres ont un interligne plus serré."],["  font-style: italic;","Italique pour le chapeau (introduction)."]]', '[["font-family","Pile de polices, terminée par une famille générique."],["font-size","Taille du texte."],["font-weight","Graisse : 100 à 900, `normal`, `bold`."],["font-style","`normal` ou `italic`."],["line-height","Hauteur de ligne (idéalement sans unité)."],["font","Raccourci : `font: italic 700 18px/1.6 Georgia, serif;`."]]', '["Oublier la famille générique de secours.","Oublier les guillemets pour les noms contenant des espaces.","Un texte courant inférieur à 16 px.","Un `line-height` en pixels fixes qui ne suit pas la taille du texte.","Charger 6 polices différentes."]', '["Deux familles de polices maximum.","Définir la typographie de base sur `body`, puis ajuster les titres.","`line-height` sans unité : 1.5–1.7 pour le texte.","Limiter la largeur des lignes."]', 'Les sites de presse en ligne soignent particulièrement leur typographie : police serif pour les articles, sans-serif pour l’interface, interligne généreux et colonnes étroites. C’est ce qui donne cette sensation de « confort de lecture ».', '["`font-family` = pile de polices + famille générique.","Texte courant : 16–18 px, `line-height` 1.5–1.7.","`font-weight` et `font-style` pour la graisse et l’italique.","50 à 75 caractères par ligne."]', 'Créez deux versions d’un même article (serif et sans-serif) et comparez leur lisibilité en changeant uniquement le CSS.', 1, 1),
(23, 9, 'Alignement et décoration du texte', 'mise-en-forme-du-texte-css', 12, 'Centrer un titre, souligner un lien au survol, mettre une étiquette en majuscules, espacer les lettres d’un logo : ces réglages fins donnent du caractère à une interface. Tous passent par une poignée de propriétés `text-*` et `letter-spacing`.', '["Aligner le texte avec `text-align`","Gérer les soulignements avec `text-decoration`","Transformer la casse avec `text-transform`","Régler l’espacement des lettres et des mots"]', '["Polices, tailles et hauteur de ligne"]', '## `text-align`

Aligne le **contenu en ligne** d’un bloc : `left`, `right`, `center`, `justify`.

```css
h1 { text-align: center; }
```

> [!WARN] `justify` crée souvent des « rivières » d’espaces blancs irrégulières sur le Web, surtout sur mobile. Préférez `left` pour les longs textes.

`text-align` centre le **texte**, pas le bloc lui-même : pour centrer une boîte, on utilisera `margin: auto` ou Flexbox.

## `text-decoration`

Ajoute ou retire soulignement, surlignement ou barré :

```css
a { text-decoration: none; }
a:hover { text-decoration: underline; }
```

On peut régler la couleur, le style et l’épaisseur : `text-decoration: underline wavy red 2px;` et l’écart avec `text-underline-offset`.

## `text-transform`

Change la casse **à l’affichage** : `uppercase`, `lowercase`, `capitalize`. Le texte reste écrit normalement dans le HTML, ce qui est préférable pour l’accessibilité et le référencement.

## Espacements

- `letter-spacing` : espace entre les lettres (utile pour les majuscules : `0.08em`) ;
- `word-spacing` : espace entre les mots ;
- `text-indent` : retrait de la première ligne.

## Autres propriétés utiles

- `white-space: nowrap;` empêche les retours à la ligne ;
- `text-overflow: ellipsis;` (avec `overflow: hidden` et `white-space: nowrap`) coupe un texte trop long avec « … » ;
- `text-shadow` ajoute une ombre au texte (vu dans le module Effets visuels).', 'text-align: center;
text-decoration: none;
text-transform: uppercase;
letter-spacing: 0.1em;', NULL, NULL, '<p class="etiquette">Nouveauté</p>
<h1 class="titre">Collection printemps</h1>
<p class="texte">Découvrez nos créations aux couleurs pastel. <a href="#">Voir la collection</a></p>
<p class="ancien-prix">79,00 €</p>', '.etiquette {
  text-transform: uppercase;
  letter-spacing: 0.15em;
  font-size: 12px;
  color: #be185d;
}

.titre {
  text-align: center;
}

.texte a {
  color: #be185d;
  text-decoration: none;
}

.texte a:hover {
  text-decoration: underline;
  text-underline-offset: 4px;
}

.ancien-prix {
  text-decoration: line-through;
  color: #6b7280;
}', '[["  text-transform: uppercase;","Majuscules à l’affichage ; le HTML reste « Nouveauté »."],["  letter-spacing: 0.15em;","Lettres espacées : les majuscules respirent."],["  text-align: center;","Titre centré dans son bloc."],["  text-decoration: none;","Retire le soulignement par défaut du lien."],[".texte a:hover {","Au survol, le soulignement réapparaît (retour visuel)."],["  text-decoration: line-through;","Texte barré (ancien prix)."]]', '[["text-align","Alignement horizontal du texte."],["text-decoration","Soulignement, barré, surlignement."],["text-transform","Casse à l’affichage."],["letter-spacing","Espacement entre les lettres."],["text-indent","Retrait de première ligne."],["white-space","Gestion des espaces et retours à la ligne."]]', '["Écrire le texte en majuscules dans le HTML au lieu d’utiliser `text-transform`.","Supprimer le soulignement des liens dans un texte sans autre indice visuel.","Justifier les textes sur mobile.","Utiliser `text-align: center` pour centrer une image bloc ou une boîte."]', '["Garder les liens identifiables dans le texte (soulignés ou très contrastés).","Augmenter légèrement `letter-spacing` pour les textes en capitales.","Aligner à gauche les textes longs."]', 'Les petites étiquettes au-dessus des titres (« NOUVEAUTÉ », « ÉTUDE DE CAS ») que l’on voit sur la plupart des sites modernes combinent `text-transform: uppercase`, `letter-spacing` et une petite taille. C’est aussi le cas des « eyebrows » de cette plateforme.', '["`text-align` aligne le texte dans son bloc.","`text-decoration` gère le soulignement.","`text-transform` change la casse à l’affichage.","`letter-spacing` espace les lettres."]', 'Créez une carte « fiche produit » avec une étiquette en capitales espacées, un titre centré, un ancien prix barré et un nouveau prix en gras.', 1, 2),
(24, 9, 'Les unités : px, em, rem, %, vw', 'unites-css', 16, '`16px`, `1.2em`, `2rem`, `50%`, `100vw`… Les unités CSS déroutent souvent les débutants. Pourtant, bien choisir son unité fait la différence entre un site rigide et un site qui s’adapte aux réglages de l’utilisateur et à toutes les tailles d’écran.', '["Distinguer unités absolues et relatives","Maîtriser `em` et `rem`","Utiliser `%`, `vw`, `vh`, `ch`","Choisir l’unité adaptée à chaque situation"]', '["Polices, tailles et hauteur de ligne"]', '## Unités absolues : `px`

Le pixel CSS est une unité fixe. Prévisible, mais elle **ignore la taille de police choisie par l’utilisateur** dans son navigateur (réglage utilisé par de nombreuses personnes malvoyantes).

## `rem` : relatif à la racine

`1rem` = la taille de police de l’élément racine `<html>`, soit **16 px par défaut**. Si l’utilisateur agrandit la police par défaut à 20 px, `1rem` vaut 20 px : tout le site s’adapte.

```css
h1 { font-size: 2.5rem; }  /* 40px par défaut */
p  { font-size: 1.125rem; } /* 18px */
```

## `em` : relatif au parent (ou à l’élément)

- pour `font-size`, `1em` = la taille de police du **parent** ;
- pour les autres propriétés (padding, margin), `1em` = la taille de police de **l’élément lui-même**.

```css
.bouton {
  font-size: 1rem;
  padding: 0.5em 1em; /* s’adapte si on agrandit le bouton */
}
.bouton-grand { font-size: 1.25rem; } /* le padding grandit aussi */
```

Attention à l’effet cumulatif des `em` imbriqués pour `font-size` : `1.2em` dans `1.2em` dans `1.2em`…

## Les pourcentages

Relatifs au **parent** : `width: 50%` = la moitié de la largeur du conteneur.

## Unités de la fenêtre : `vw`, `vh`

- `1vw` = 1 % de la largeur de la fenêtre ;
- `1vh` = 1 % de la hauteur de la fenêtre (`100vh` = plein écran ; sur mobile, préférez `100dvh`).

## `ch`

`1ch` = la largeur du caractère « 0 » dans la police courante. Idéal pour limiter la longueur des lignes : `max-width: 65ch`.

## Quelle unité choisir ?

| Usage | Unité conseillée |
|---|---|
| Taille de texte | `rem` |
| Espacements internes d’un composant | `em` ou `rem` |
| Largeurs de mise en page | `%`, `fr` (Grid), `max-width` en `rem`/`px` |
| Bordures fines | `px` |
| Sections plein écran | `vh` / `dvh` |
| Longueur de ligne | `ch` |

> [!TIP] La fonction `clamp(min, idéal, max)` permet une taille fluide bornée : `font-size: clamp(1.75rem, 4vw, 3rem);` (voir module Responsive).', 'font-size: 1.25rem;
padding: 0.5em 1em;
width: 50%;
min-height: 100vh;
max-width: 65ch;', NULL, NULL, '<div class="page">
  <h1>Unités relatives</h1>
  <p>Ce texte mesure 1.125rem. Changez la taille de police par défaut de votre navigateur : tout suit.</p>
  <a class="btn" href="#">Bouton normal</a>
  <a class="btn btn-grand" href="#">Bouton grand</a>
  <div class="demi">Je fais 50 % de la largeur de mon parent.</div>
</div>', '.page {
  font-family: system-ui, sans-serif;
  max-width: 60ch;
}

h1 { font-size: 2.5rem; }
p  { font-size: 1.125rem; line-height: 1.6; }

.btn {
  display: inline-block;
  font-size: 1rem;
  padding: 0.5em 1em;
  background: #2563eb;
  color: white;
  text-decoration: none;
  border-radius: 0.4em;
}

.btn-grand { font-size: 1.5rem; }

.demi {
  width: 50%;
  margin-top: 1rem;
  padding: 1rem;
  background: #e0e7ff;
}', '[["  max-width: 60ch;","La page ne dépasse pas ~60 caractères de large."],["h1 { font-size: 2.5rem; }","2,5 × la taille racine (40 px par défaut)."],["  padding: 0.5em 1em;","Padding relatif à la taille de police du bouton."],["  border-radius: 0.4em;","Arrondi proportionnel : il grandit avec le bouton."],[".btn-grand { font-size: 1.5rem; }","Seule la police change… et le padding et l’arrondi suivent grâce aux `em`."],["  width: 50%;","La moitié de la largeur du parent `.page`."]]', '[["px","Pixel CSS, unité fixe."],["rem","Relatif à la taille de police de `<html>` (16px par défaut)."],["em","Relatif à la taille de police du parent (ou de l’élément)."],["%","Relatif à la dimension correspondante du parent."],["vw / vh / dvh","Pourcentage de la largeur / hauteur de la fenêtre."],["ch","Largeur du caractère « 0 »."]]', '["Oublier l’unité : `font-size: 18;` est invalide (sauf pour `line-height` et `0`).","Mettre un espace entre le nombre et l’unité : `18 px`.","Imbriquer des `font-size` en `em` et obtenir des tailles démesurées.","Utiliser `100vw` pour une largeur : la barre de défilement provoque un débordement horizontal."]', '["Tailles de texte en `rem`.","Padding des composants en `em` pour qu’ils grandissent avec leur texte.","Aucun espace entre la valeur et l’unité.","`0` s’écrit sans unité."]', 'Les design systems définissent une échelle d’espacements en `rem` (0.25, 0.5, 1, 1.5, 2, 3rem) et de tailles de texte (0.875, 1, 1.25, 1.5, 2rem). Utiliser toujours les mêmes valeurs donne une interface harmonieuse.', '["`px` fixe ; `rem` relatif à la racine ; `em` relatif au parent/élément.","`%` relatif au parent ; `vw`/`vh` à la fenêtre ; `ch` à la police.","Textes en `rem`, composants en `em`."]', 'Créez trois boutons (petit, moyen, grand) ne différant que par leur `font-size` en `rem`, avec padding et arrondi en `em`.', 1, 3),
(25, 10, 'Le modèle de boîte', 'le-modele-de-boite', 15, 'Voici le concept le plus important du CSS : **chaque élément est une boîte rectangulaire**. Un titre, un paragraphe, une image, un lien : tous. Comprendre de quoi est faite cette boîte, c’est comprendre tous les problèmes d’espacement et de dimensions que vous rencontrerez.', '["Identifier les quatre zones d’une boîte","Visualiser les boîtes avec les outils de développement","Comprendre le calcul des dimensions"]', '["Les unités CSS"]', '## Les quatre couches

De l’intérieur vers l’extérieur :

1. **Content** (contenu) : le texte, l’image. Sa taille est définie par `width` et `height`.
2. **Padding** (marge intérieure) : l’espace entre le contenu et la bordure. Il prend la couleur de fond de l’élément.
3. **Border** (bordure) : le trait autour du padding.
4. **Margin** (marge extérieure) : l’espace transparent entre la bordure et les éléments voisins.

```text
┌──────────────── margin ────────────────┐
│  ┌───────────── border ─────────────┐  │
│  │  ┌────────── padding ─────────┐  │  │
│  │  │          content           │  │  │
│  │  └────────────────────────────┘  │  │
│  └──────────────────────────────────┘  │
└────────────────────────────────────────┘
```

## Padding ou margin ?

- Vous voulez de l’espace **à l’intérieur**, avec le fond coloré → `padding`.
- Vous voulez **éloigner** l’élément de ses voisins → `margin`.

Un bouton a du padding (pour que le texte respire dans le fond coloré) ; deux cartes sont séparées par une margin (ou un `gap`).

## Le calcul par défaut

Par défaut (`box-sizing: content-box`), `width` ne concerne **que le contenu**. Largeur visible = `width` + padding gauche et droite + bordures :

```css
.boite {
  width: 300px;
  padding: 20px;
  border: 5px solid;
}
/* largeur visible : 300 + 20 + 20 + 5 + 5 = 350px */
```

C’est contre-intuitif : on règlera ce problème avec `box-sizing: border-box` (leçon « Dimensions et box-sizing »).

## Voir les boîtes

Dans les outils de développement (`F12`), sélectionnez un élément : un schéma du modèle de boîte affiche ses dimensions, son padding (vert), sa bordure (jaune) et sa marge (orange). Au survol, ces zones sont colorées dans la page.

> [!TIP] Astuce de débogage : ajoutez temporairement `* { outline: 1px solid red; }` pour voir les contours de toutes les boîtes. `outline` ne prend pas de place, contrairement à `border`.', '.boite {
  width: 300px;
  padding: 20px;
  border: 2px solid black;
  margin: 16px;
}', NULL, NULL, '<div class="boite">Contenu</div>
<div class="boite boite-large">Contenu avec plus de padding</div>', '.boite {
  width: 260px;
  padding: 16px;
  border: 4px solid #2563eb;
  margin: 24px;
  background-color: #dbeafe;
  font-family: system-ui, sans-serif;
}

.boite-large {
  padding: 40px;
}', '[["  width: 260px;","Largeur du CONTENU uniquement (comportement par défaut)."],["  padding: 16px;","Espace intérieur, coloré par le fond."],["  border: 4px solid #2563eb;","Bordure de 4 px autour du padding."],["  margin: 24px;","Espace extérieur transparent autour de la bordure."],[".boite-large { padding: 40px; }","Plus de padding : la boîte visible devient plus large (260 + 80 + 8 = 348px)."]]', '[["width / height","Dimensions du contenu (par défaut)."],["padding","Espace intérieur."],["border","Bordure."],["margin","Espace extérieur."],["outline","Contour qui n’occupe pas de place (débogage, focus)."]]', '["Utiliser `margin` pour agrandir la zone colorée d’un bouton (c’est le padding).","Être surpris qu’une boîte de `width: 100%` avec du padding déborde de son parent.","Confondre `border` et `outline`."]', '["Inspecter les boîtes avec `F12` dès qu’un espacement surprend.","Padding pour l’intérieur, margin (ou gap) pour l’extérieur."]', 'Une carte de produit est une boîte : padding pour aérer son contenu, bordure ou ombre pour la délimiter, marge (ou `gap` dans une grille) pour l’éloigner des autres cartes.', '["Boîte = content + padding + border + margin.","Padding intérieur (coloré), margin extérieure (transparente).","Par défaut, `width` ne compte que le contenu."]', 'Calculez la largeur visible d’une boîte `width: 200px; padding: 10px 30px; border: 3px solid;`. Vérifiez avec les outils de développement.', 1, 1),
(26, 10, 'Margin et padding en détail', 'margin-et-padding', 14, 'Écrire `margin: 10px 20px` au lieu de quatre lignes, centrer un bloc avec `margin: 0 auto`, comprendre pourquoi deux marges se « fusionnent »… Cette leçon vous donne toutes les clés pour gérer les espacements comme un professionnel.', '["Utiliser les propriétés raccourcies à 1, 2, 3 ou 4 valeurs","Centrer un bloc avec `margin: auto`","Comprendre la fusion des marges"]', '["Le modèle de boîte"]', '## Les quatre côtés

Chaque côté peut être réglé séparément : `margin-top`, `margin-right`, `margin-bottom`, `margin-left` (idem pour `padding`).

## Les raccourcis (sens des aiguilles d’une montre)

| Écriture | Signification |
|---|---|
| `margin: 10px;` | 10px sur les 4 côtés |
| `margin: 10px 20px;` | 10px haut/bas, 20px gauche/droite |
| `margin: 10px 20px 30px;` | haut 10, gauche/droite 20, bas 30 |
| `margin: 10px 20px 30px 40px;` | haut, droite, bas, gauche |

Moyen mnémotechnique pour 4 valeurs : **TRouBLe** (*Top, Right, Bottom, Left*).

## Centrer un bloc horizontalement

Un bloc qui a une largeur définie peut être centré avec des marges latérales automatiques :

```css
.conteneur {
  max-width: 960px;
  margin: 0 auto;
}
```

Le navigateur répartit l’espace restant à parts égales à gauche et à droite.

## La fusion des marges (margin collapsing)

Les marges **verticales** de deux blocs voisins **ne s’additionnent pas** : la plus grande l’emporte.

```css
h2 { margin-bottom: 30px; }
p  { margin-top: 20px; }
/* espace entre les deux : 30px, pas 50px */
```

Ce comportement ne concerne que les marges verticales des blocs dans un flux normal (pas en Flexbox ni en Grid).

## Marges négatives

Une marge peut être négative : l’élément est tiré dans cette direction et peut chevaucher son voisin. Utile ponctuellement, à manier avec prudence.

> [!INFO] Le padding ne peut jamais être négatif.

## Les marges par défaut du navigateur

`body` a une marge de 8px, les paragraphes et titres ont des marges verticales. Beaucoup de projets commencent par une petite remise à zéro : `body { margin: 0; }`.', 'margin: haut droite bas gauche;
padding: vertical horizontal;
margin: 0 auto;', NULL, NULL, '<main class="conteneur">
  <h2 class="titre">Espacements</h2>
  <p class="texte">Ce conteneur est centré grâce à margin: 0 auto.</p>
  <a class="bouton" href="#">Un bouton bien rembourré</a>
</main>', 'body {
  margin: 0;
  background: #f1f5f9;
  font-family: system-ui, sans-serif;
}

.conteneur {
  max-width: 480px;
  margin: 40px auto;
  padding: 24px 32px;
  background: white;
}

.titre {
  margin-top: 0;
  margin-bottom: 30px;
}

.texte {
  margin-top: 20px;
}

.bouton {
  display: inline-block;
  padding: 12px 24px;
  background: #0f766e;
  color: white;
  text-decoration: none;
}', '[["  margin: 0;","Supprime la marge par défaut de 8px du body."],["  margin: 40px auto;","40px en haut et en bas, marges latérales automatiques : le bloc est centré."],["  padding: 24px 32px;","24px en haut/bas, 32px à gauche/droite."],["  margin-bottom: 30px;","Marge basse du titre…"],["  margin-top: 20px;","…et marge haute du texte : elles fusionnent, l’écart vaut 30px."],["  padding: 12px 24px;","Le bouton est plus large que haut : proportions classiques."]]', '[["margin / padding","Raccourcis 1 à 4 valeurs (haut, droite, bas, gauche)."],["margin-top …","Réglage d’un seul côté."],["auto","Répartit l’espace disponible (centrage horizontal)."],["margin-inline / padding-block","Versions logiques (gauche+droite / haut+bas)."]]', '["Oublier l’ordre des 4 valeurs.","Vouloir centrer avec `margin: auto` un élément sans largeur ou un élément en ligne.","Additionner deux marges verticales dans sa tête (fusion).","Espacer avec des `<br>` au lieu de margin."]', '["Utiliser les raccourcis pour un code concis.","Espacer dans une seule direction (par exemple toujours `margin-bottom`) pour éviter les surprises de fusion.","Utiliser une échelle d’espacements cohérente."]', 'Presque tous les sites utilisent une classe `.container` avec `max-width` et `margin: 0 auto` pour centrer le contenu sur les grands écrans, et un `padding` latéral pour qu’il ne colle pas aux bords sur mobile.', '["Raccourcis : 1, 2, 3 ou 4 valeurs, sens horaire depuis le haut.","`margin: 0 auto` centre un bloc de largeur définie.","Les marges verticales voisines fusionnent."]', 'Créez un conteneur centré de 600px maximum avec 3 cartes espacées verticalement de 24px, sans que la première ait de marge en haut.', 1, 2),
(27, 10, 'Bordures et coins arrondis', 'bordures-et-coins-arrondis', 12, 'Une bordure fine pour délimiter une carte, un trait coloré à gauche d’une citation, des coins arrondis pour adoucir un bouton, un avatar parfaitement rond… Les propriétés `border` et `border-radius` sont partout dans les interfaces modernes.', '["Définir une bordure (épaisseur, style, couleur)","Styler un seul côté","Arrondir les angles avec `border-radius`","Créer un cercle"]', '["Margin et padding en détail"]', '## La propriété `border`

Raccourci de trois valeurs : **épaisseur**, **style**, **couleur**.

```css
.carte { border: 1px solid #e5e7eb; }
```

Le **style** est obligatoire (sans lui, pas de bordure) : `solid`, `dashed`, `dotted`, `double`, `none`.

## Un seul côté

```css
blockquote { border-left: 4px solid #6366f1; }
.onglet-actif { border-bottom: 3px solid currentColor; }
```

## `border-radius`

Arrondit les angles :

```css
.bouton { border-radius: 8px; }
.pilule { border-radius: 999px; }   /* bords entièrement ronds */
.avatar { border-radius: 50%; }     /* cercle si l’élément est carré */
```

Comme `margin`, il accepte 1 à 4 valeurs (en partant du coin **haut-gauche**, sens horaire) : `border-radius: 16px 16px 0 0;` arrondit seulement le haut.

## Bordure et dimensions

La bordure s’ajoute à la taille de la boîte (sauf avec `box-sizing: border-box`). Pour un effet de survol sans « saut » de mise en page, prévoyez une bordure transparente au repos :

```css
.carte { border: 2px solid transparent; }
.carte:hover { border-color: #6366f1; }
```

> [!TIP] `border-radius` s’applique aussi au fond et aux images. Pour arrondir une image dans une carte, ajoutez `overflow: hidden` à la carte.', 'border: 1px solid #ccc;
border-left: 4px solid blue;
border-radius: 8px;', NULL, NULL, '<div class="carte">
  <img class="avatar" src="https://placehold.co/80x80/png" alt="Photo de profil de Sam">
  <h3>Sam Dupont</h3>
  <blockquote class="citation">Le CSS, c’est de la géométrie avec des couleurs.</blockquote>
  <a class="pilule" href="#">Suivre</a>
</div>', '.carte {
  max-width: 320px;
  padding: 20px;
  border: 1px solid #e5e7eb;
  border-radius: 16px;
  font-family: system-ui, sans-serif;
}

.avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  border: 3px solid #a78bfa;
}

.citation {
  margin: 16px 0;
  padding-left: 12px;
  border-left: 4px solid #a78bfa;
  font-style: italic;
}

.pilule {
  display: inline-block;
  padding: 8px 20px;
  border: 2px dashed #7c3aed;
  border-radius: 999px;
  color: #7c3aed;
  text-decoration: none;
}', '[["  border: 1px solid #e5e7eb;","Bordure fine et discrète : épaisseur, style, couleur."],["  border-radius: 16px;","Coins arrondis de la carte."],["  border-radius: 50%;","Image carrée + 50 % = cercle parfait."],["  border-left: 4px solid #a78bfa;","Bordure sur un seul côté pour la citation."],["  border: 2px dashed #7c3aed;","Style en tirets."],["  border-radius: 999px;","Valeur très grande : forme de pilule."]]', '[["border","Raccourci : épaisseur style couleur."],["border-top / -right / -bottom / -left","Bordure d’un seul côté."],["border-color / -width / -style","Réglage d’un seul aspect."],["border-radius","Arrondi des angles."]]', '["Oublier le style : `border: 1px red;` n’affiche rien.","Utiliser `border-radius: 50%` sur un rectangle : on obtient une ellipse.","Ajouter une bordure au survol, ce qui décale le contenu."]', '["Bordures fines et claires pour délimiter sans alourdir.","Une bordure transparente au repos pour les effets de survol.","Un même rayon d’arrondi dans toute l’interface."]', 'Les interfaces modernes utilisent une échelle d’arrondis : 4px pour les champs, 8–12px pour les boutons et cartes, 999px pour les étiquettes « pilule », 50 % pour les avatars.', '["`border: épaisseur style couleur`.","Le style est obligatoire.","`border-radius` arrondit ; 50 % sur un carré = cercle."]', 'Créez trois étiquettes « pilule » (succès, avertissement, erreur) avec bordure colorée et fond très clair de la même teinte.', 1, 3),
(28, 10, 'Dimensions et box-sizing', 'dimensions-et-box-sizing', 14, '« J’ai mis `width: 100%` et ma boîte dépasse de l’écran ! » Ce problème a fait perdre des heures à des générations de développeurs. La solution tient en une ligne : `box-sizing: border-box`. Cette leçon explique aussi comment gérer largeurs et hauteurs de façon souple avec `min-` et `max-`.', '["Utiliser `width`, `height`, `min-*` et `max-*`","Comprendre `box-sizing: border-box`","Gérer le débordement avec `overflow`"]', '["Bordures et coins arrondis"]', '## `width` et `height`

Définissent la taille de la boîte. Pour le Web, **évitez les hauteurs fixes** sur les blocs de texte : le contenu (et la taille de police de l’utilisateur) varie, et un texte qui dépasse d’une boîte de hauteur fixe déborde.

## `min-` et `max-`

- `max-width: 800px;` : la boîte peut rétrécir, mais ne dépasse jamais 800px. **Parfait pour le responsive.**
- `min-height: 300px;` : au moins 300px, mais peut grandir si le contenu l’exige.

```css
img { max-width: 100%; height: auto; } /* images jamais plus larges que leur conteneur */
```

## Le problème de `content-box`

Par défaut, `width` n’inclut pas le padding ni la bordure :

```css
.colonne { width: 100%; padding: 20px; } /* = 100% + 40px : ça déborde ! */
```

## La solution : `box-sizing: border-box`

Avec `border-box`, `width` **inclut** padding et bordure : une boîte de `width: 300px` mesure 300px à l’écran, quel que soit son padding.

La quasi-totalité des projets modernes l’applique à tous les éléments dès la première ligne du CSS :

```css
*, *::before, *::after {
  box-sizing: border-box;
}
```

## `overflow` : que faire du contenu qui déborde ?

| Valeur | Effet |
|---|---|
| `visible` | Le contenu dépasse (par défaut) |
| `hidden` | Le surplus est masqué |
| `auto` | Barre de défilement si nécessaire |
| `scroll` | Barre de défilement toujours présente |

`overflow-x` et `overflow-y` agissent sur un seul axe. Exemple : un tableau large dans un conteneur `overflow-x: auto` défile horizontalement sur mobile au lieu de casser la page.

> [!WARN] `overflow: hidden` peut cacher du contenu important (ou le contour de focus). Utilisez-le en connaissance de cause.', '*, *::before, *::after { box-sizing: border-box; }
.bloc { max-width: 800px; min-height: 200px; overflow: auto; }', NULL, NULL, '<div class="comparaison">
  <div class="boite content">content-box : 200px + padding + bordure</div>
  <div class="boite border">border-box : 200px au total</div>
</div>
<div class="defilement">
  <p>Ce bloc a une hauteur maximale. Le texte supplémentaire fait apparaître une barre de défilement plutôt que de déborder sur la suite de la page. Ajoutez du texte pour tester !</p>
</div>', '.boite {
  width: 200px;
  padding: 20px;
  border: 5px solid #0ea5e9;
  margin-bottom: 12px;
  background: #e0f2fe;
  font-family: system-ui, sans-serif;
}

.content { box-sizing: content-box; } /* 250px à l’écran */
.border  { box-sizing: border-box; }  /* 200px à l’écran */

.defilement {
  max-width: 300px;
  max-height: 80px;
  overflow: auto;
  border: 1px solid #cbd5e1;
  padding: 8px;
}', '[["  width: 200px;","Même largeur déclarée pour les deux boîtes."],[".content { box-sizing: content-box; }","Comportement par défaut : 200 + 40 + 10 = 250px visibles."],[".border  { box-sizing: border-box; }","Padding et bordure inclus : 200px visibles."],["  max-height: 80px;","Hauteur plafonnée…"],["  overflow: auto;","…et défilement si le contenu dépasse."]]', '[["width / height","Dimensions."],["min-width / max-width","Bornes de largeur."],["min-height / max-height","Bornes de hauteur."],["box-sizing","`content-box` (défaut) ou `border-box`."],["overflow","Gestion du contenu qui dépasse."],["aspect-ratio","Proportions d’une boîte : `aspect-ratio: 16 / 9;`."]]', '["Fixer une `height` sur un bloc de texte.","Utiliser `width` fixe en pixels au lieu de `max-width` pour un conteneur.","Oublier `box-sizing: border-box` et accumuler les débordements.","Masquer un débordement avec `overflow: hidden` au lieu d’en corriger la cause."]', '["Commencer chaque feuille de style par la règle `box-sizing: border-box` globale.","Préférer `max-width` à `width` pour les conteneurs.","Préférer `min-height` à `height`.","`img { max-width: 100%; height: auto; }` dans tous les projets."]', 'Les « reset CSS » modernes (fichiers de base utilisés en début de projet) contiennent presque tous ces trois lignes : `box-sizing: border-box` global, `body { margin: 0 }` et `img { max-width: 100%; display: block; }`.', '["`box-sizing: border-box` : la largeur inclut padding et bordure.","`max-width` et `min-height` rendent les boîtes souples.","`overflow` gère le contenu qui dépasse."]', 'Créez trois colonnes de `width: 33.333%` avec padding et bordure, côte à côte (`display: inline-block` ou `float`), qui tiennent sur une ligne grâce à `border-box`.', 1, 4),
(29, 11, 'La balise img et le texte alternatif', 'la-balise-img', 14, 'Une image vaut mille mots… sauf pour ceux qui ne peuvent pas la voir : personnes aveugles utilisant un lecteur d’écran, connexion trop lente, moteur de recherche. Pour eux, seul compte le **texte alternatif**. Apprendre à insérer une image, c’est donc aussi apprendre à la décrire.', '["Insérer une image avec `<img>`","Rédiger un attribut `alt` pertinent","Gérer les images décoratives","Comprendre les chemins d’images"]', '["Liens relatifs, absolus, ancres"]', '## La syntaxe

```html
<img src="images/chat.jpg" alt="Chat roux endormi sur un coussin bleu">
```

- `<img>` est un **élément vide** : pas de balise fermante ;
- `src` (*source*) : le chemin de l’image (relatif ou absolu, comme pour les liens) ;
- `alt` (*alternative*) : le texte qui **remplace** l’image quand elle n’est pas vue.

## Pourquoi `alt` est indispensable

1. Les **lecteurs d’écran** lisent le `alt` à la place de l’image.
2. Si l’image ne se charge pas, le `alt` s’affiche à sa place.
3. Les **moteurs de recherche** l’utilisent pour comprendre et indexer l’image.

L’attribut `alt` est **obligatoire** en HTML valide.

## Rédiger un bon `alt`

Demandez-vous : « Si je décrivais cette page au téléphone, que dirais-je de cette image ? »

| Image | ❌ Mauvais alt | ✅ Bon alt |
|---|---|---|
| Photo produit | `alt="image1.jpg"` | `alt="Baskets blanches en cuir, semelle gomme"` |
| Graphique | `alt="graphique"` | `alt="Ventes 2025 : hausse de 30 % au second semestre"` |
| Logo cliquable vers l’accueil | `alt="logo"` | `alt="Boulangerie Dupain — accueil"` |

Inutile de commencer par « Image de… » : le lecteur d’écran annonce déjà qu’il s’agit d’une image.

## Les images décoratives

Si une image est purement décorative (un ornement, une illustration d’ambiance qui n’apporte aucune information), on laisse un **`alt` vide** :

```html
<img src="decor-vague.svg" alt="">
```

Le lecteur d’écran l’ignore alors. Ne supprimez pas l’attribut : sans `alt`, certains lecteurs d’écran lisent le nom du fichier !

## `title` n’est pas `alt`

`title` affiche une info-bulle au survol de la souris ; il n’est pas fiable pour l’accessibilité et ne remplace jamais `alt`.', '<img src="chemin/image.jpg" alt="Description de l’image">', NULL, NULL, '<h1>Notre boulangerie</h1>
<img src="https://placehold.co/400x250/png?text=Vitrine" alt="Vitrine de la boulangerie avec baguettes et croissants alignés" width="400" height="250">
<p>
  <img src="https://placehold.co/24x24/png" alt="">
  Pains cuits sur place chaque matin.
</p>
<a href="#">
  <img src="https://placehold.co/120x40/png?text=Logo" alt="Boulangerie Dupain — retour à l’accueil" width="120" height="40">
</a>', NULL, '[["<img src=\\"…\\" alt=\\"Vitrine de la boulangerie…\\"","Image informative : le `alt` décrit ce qu’elle montre."],["width=\\"400\\" height=\\"250\\">","Dimensions réelles : le navigateur réserve la place avant le chargement."],["<img src=\\"…\\" alt=\\"\\">","Icône décorative : `alt` vide, ignorée par les lecteurs d’écran."],["<a href=\\"#\\"><img … alt=\\"Boulangerie Dupain — retour à l’accueil\\"","Image-lien : le `alt` décrit la destination du lien."]]', '[["<img>","Élément vide d’image."],["src","Chemin de l’image."],["alt","Texte alternatif (obligatoire ; vide si décorative)."],["width / height","Dimensions intrinsèques en pixels (sans unité)."]]', '["Oublier l’attribut `alt`.","Mettre le nom du fichier ou « image » dans le `alt`.","Décrire une image décorative (bruit inutile pour le lecteur d’écran).","Mauvais chemin : majuscules/minuscules différentes (`Chat.JPG` ≠ `chat.jpg` sur un serveur).","Écrire `</img>`."]', '["Un `alt` concis (une phrase) qui transmet l’information utile.","`alt=\\"\\"` pour les images décoratives.","Toujours indiquer `width` et `height`.","Noms de fichiers descriptifs : `vitrine-boulangerie.jpg`."]', 'Sur un site e-commerce, le `alt` des photos produit améliore le référencement dans Google Images et rend la boutique utilisable par les clients aveugles. Les CMS comme WordPress proposent un champ « Texte alternatif » pour chaque image importée.', '["`<img src=\\"…\\" alt=\\"…\\">`, élément vide.","Le `alt` remplace l’image pour ceux qui ne la voient pas.","Image décorative → `alt=\\"\\"`.","Indiquez `width` et `height`."]', 'Choisissez trois images d’un site que vous aimez et rédigez pour chacune un `alt` pertinent. Vérifiez ensuite le `alt` réel avec les outils de développement.', 1, 1),
(30, 11, 'Formats, figure, lazy loading et images responsives', 'images-formats-figure-performance', 16, 'Les images représentent souvent plus de la moitié du poids d’une page. Une photo mal optimisée peut ralentir un site de plusieurs secondes sur mobile. Dans cette leçon : choisir le bon format, légender une image, différer son chargement et servir la bonne taille à chaque écran.', '["Choisir entre JPEG, PNG, WebP, AVIF et SVG","Légender une image avec `<figure>` et `<figcaption>`","Utiliser `loading=\\"lazy\\"`","Découvrir `srcset` et `<picture>`"]', '["La balise img et le texte alternatif"]', '## Les formats d’image

| Format | Idéal pour | Remarques |
|---|---|---|
| JPEG | Photos | Compression avec perte, pas de transparence |
| PNG | Captures d’écran, transparence | Fichiers lourds pour les photos |
| WebP | Photos et transparence | 25–35 % plus léger que JPEG, très bien supporté |
| AVIF | Photos | Encore plus léger, support récent |
| SVG | Logos, icônes, illustrations | Vectoriel : net à toutes les tailles, très léger |
| GIF | (À éviter) | Préférez une vidéo courte pour les animations |

## `<figure>` et `<figcaption>`

Pour une image accompagnée d’une **légende** (photo d’article, schéma, graphique) :

```html
<figure>
  <img src="tour-eiffel.jpg" alt="La tour Eiffel illuminée de nuit">
  <figcaption>La tour Eiffel, construite pour l’Exposition universelle de 1889.</figcaption>
</figure>
```

La légende est liée sémantiquement à l’image. `<figure>` peut aussi contenir un extrait de code, une citation ou un tableau.

## Le chargement différé : `loading="lazy"`

```html
<img src="photo.jpg" alt="…" loading="lazy" width="800" height="600">
```

L’image n’est téléchargée que lorsqu’elle approche de la zone visible. Gain énorme sur les pages longues. **N’utilisez pas** `lazy` pour l’image principale en haut de page : elle doit s’afficher immédiatement.

## Images responsives : `srcset` et `sizes`

Inutile d’envoyer une image de 2000px à un téléphone de 400px. `srcset` propose plusieurs tailles, le navigateur choisit :

```html
<img
  src="paysage-800.jpg"
  srcset="paysage-400.jpg 400w, paysage-800.jpg 800w, paysage-1600.jpg 1600w"
  sizes="(max-width: 600px) 100vw, 800px"
  alt="Lac de montagne au lever du soleil">
```

## `<picture>` : plusieurs formats

```html
<picture>
  <source srcset="photo.avif" type="image/avif">
  <source srcset="photo.webp" type="image/webp">
  <img src="photo.jpg" alt="…">
</picture>
```

Le navigateur prend le premier format qu’il sait lire ; `<img>` sert de solution de repli (et porte le `alt`).

> [!TIP] Compressez toujours vos images avant de les publier (outils gratuits : Squoosh, TinyPNG). Une photo de 4 Mo sortie d’un appareil peut souvent descendre à 150 Ko sans différence visible.', '<figure>
  <img src="…" alt="…" loading="lazy">
  <figcaption>Légende</figcaption>
</figure>', NULL, NULL, '<article>
  <h1>Voyage en Islande</h1>
  <figure>
    <img src="https://placehold.co/600x350/png?text=Cascade" alt="Cascade de Skógafoss entourée de falaises verdoyantes" width="600" height="350">
    <figcaption>Skógafoss, l’une des plus grandes cascades d’Islande (60 m).</figcaption>
  </figure>
  <p>Le lendemain, direction les plages de sable noir…</p>
  <figure>
    <img src="https://placehold.co/600x350/png?text=Plage+noire" alt="Plage de sable noir de Reynisfjara sous un ciel gris" width="600" height="350" loading="lazy">
    <figcaption>Reynisfjara et ses colonnes de basalte.</figcaption>
  </figure>
</article>', NULL, '[["<figure>","Conteneur qui associe l’image à sa légende."],["<img … width=\\"600\\" height=\\"350\\">","Première image : chargée immédiatement (pas de lazy)."],["<figcaption>…</figcaption>","Légende visible, liée à l’image."],["… loading=\\"lazy\\">","Image plus bas dans la page : chargement différé."]]', '[["<figure>","Contenu illustratif autonome (image, schéma, code)."],["<figcaption>","Légende d’une figure."],["loading=\\"lazy\\"","Chargement différé."],["srcset / sizes","Plusieurs tailles d’image au choix du navigateur."],["<picture> / <source>","Plusieurs formats ou cadrages."]]', '["Publier des photos de plusieurs Mo non compressées.","Utiliser PNG pour des photos.","Mettre `loading=\\"lazy\\"` sur l’image principale en haut de page.","Répéter la légende mot pour mot dans le `alt`.","Oublier `<img>` dans `<picture>`."]', '["WebP/AVIF pour les photos, SVG pour logos et icônes.","`loading=\\"lazy\\"` sous la ligne de flottaison.","Toujours `width` et `height` pour éviter les sauts de mise en page.","Compresser et redimensionner avant publication."]', 'Google mesure la vitesse de chargement (Core Web Vitals) et en tient compte dans le classement. Les images mal dimensionnées sont la première cause de lenteur ; `srcset`, `loading="lazy"` et WebP règlent l’essentiel du problème.', '["Photo → JPEG/WebP/AVIF ; logo/icône → SVG.","`<figure>` + `<figcaption>` pour une image légendée.","`loading=\\"lazy\\"` pour les images hors écran.","`srcset` et `<picture>` adaptent l’image à l’appareil."]', 'Créez une galerie de 6 photos légendées avec `<figure>`, dont les 4 dernières en `loading="lazy"`.', 1, 2);

INSERT INTO `lessons` (`id`, `module_id`, `title`, `slug`, `duration_minutes`, `introduction`, `objectives`, `prerequisites`, `theory`, `syntax_code`, `simple_html`, `simple_css`, `example_html`, `example_css`, `line_by_line`, `reference_items`, `common_mistakes`, `best_practices`, `practical`, `summary_points`, `challenge`, `is_published`, `sort_order`) VALUES
(31, 12, 'Listes à puces et listes numérotées', 'listes-ordonnees-et-non-ordonnees', 12, 'Ingrédients d’une recette, étapes d’un tutoriel, menu de navigation, liste de fonctionnalités : les listes sont partout sur le Web, parfois là où on ne les voit pas. Les coder correctement aide les lecteurs d’écran à annoncer « liste de 5 éléments » — une information précieuse.', '["Créer une liste non ordonnée `<ul>`","Créer une liste ordonnée `<ol>`","Utiliser les attributs `start`, `reversed`, `type`"]', '["Les paragraphes"]', '## Liste non ordonnée : `<ul>`

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

Un menu de navigation est sémantiquement une liste de liens. On le code en `<ul>`, puis on retire les puces en CSS (`list-style: none`). La sémantique reste, l’apparence change.', '<ul>
  <li>Élément</li>
</ul>
<ol>
  <li>Étape 1</li>
</ol>', NULL, NULL, '<h1>Crêpes faciles</h1>
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
</ol>', NULL, '[["<ul>","Liste non ordonnée : l’ordre des ingrédients n’a pas d’importance."],["  <li>250 g de farine</li>","Chaque élément dans un `<li>`."],["<ol>","Liste ordonnée : les étapes doivent être suivies dans l’ordre."],["  <li>Laissez reposer <strong>1 heure</strong>.</li>","Un `<li>` peut contenir des éléments en ligne."],["<ol reversed>","Numérotation décroissante : 3, 2, 1."]]', '[["<ul>","Liste non ordonnée."],["<ol>","Liste ordonnée."],["<li>","Élément de liste."],["start / reversed / type","Attributs de numérotation de `<ol>`."]]', '["Écrire les puces à la main (`- Farine<br>`).","Placer du texte ou un `<p>` directement dans `<ul>` sans `<li>`.","Numéroter manuellement dans une `<ol>` (« 1. Mélanger »).","Choisir `<ol>` pour son apparence et non pour le sens."]', '["Choisir `<ul>` ou `<ol>` selon que l’ordre a un sens.","Styler les puces en CSS (`list-style`).","Coder les menus comme des listes de liens."]', 'Presque tous les menus de navigation du Web sont codés `<nav><ul><li><a>…</a></li></ul></nav>`. Les lecteurs d’écran annoncent alors « navigation, liste de 5 éléments ».', '["`<ul>` : ordre sans importance ; `<ol>` : ordre significatif.","Seuls des `<li>` dans une liste.","La numérotation de `<ol>` est automatique."]', 'Codez le classement de vos 5 films préférés du 5e au 1er avec `reversed`.', 1, 1),
(32, 12, 'Listes imbriquées et listes de définitions', 'listes-imbriquees-et-definitions', 12, 'Un sommaire à plusieurs niveaux, un menu avec sous-menus, un glossaire, une FAQ… Ces structures reposent sur deux techniques : **imbriquer** des listes, et utiliser la liste de **définitions** `<dl>`, souvent méconnue mais très utile.', '["Imbriquer une liste dans un élément de liste","Créer une liste de définitions `<dl>`, `<dt>`, `<dd>`"]', '["Listes à puces et listes numérotées"]', '## Imbriquer des listes

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

Glossaires, fiches techniques (« Poids : 1,2 kg »), métadonnées (« Auteur : … », « Date : … »), FAQ simples.', '<li>Parent
  <ul><li>Enfant</li></ul>
</li>
<dl><dt>Terme</dt><dd>Définition</dd></dl>', NULL, NULL, '<h2>Sommaire</h2>
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
</dl>', NULL, '[["  <li>Les bases","Le `<li>` parent contient son texte…"],["    <ol>","…puis la sous-liste, toujours à l’intérieur du `<li>`."],["  </li>","Le `<li>` parent se ferme après la sous-liste."],["<dl>","Liste de définitions pour une fiche technique."],["  <dt>Poids</dt>","Le terme."],["  <dd>1,2 kg</dd>","Sa description."],["  <dd>Noir</dd> <dd>Argent</dd>","Un terme peut avoir plusieurs descriptions."]]', '[["<dl>","Liste de définitions."],["<dt>","Terme."],["<dd>","Description du terme."]]', '["Placer la sous-liste entre deux `<li>` au lieu de dedans.","Oublier de fermer le `<li>` parent après la sous-liste.","Utiliser un tableau pour de simples paires terme/valeur."]', '["Indenter soigneusement les listes imbriquées.","Limiter l’imbrication à 2 ou 3 niveaux.","Utiliser `<dl>` pour les paires clé/valeur."]', 'Les « méga-menus » des grands sites e-commerce sont des listes imbriquées : Catégorie > Sous-catégorie > Produit. Les fiches produits utilisent souvent `<dl>` pour les caractéristiques.', '["Une sous-liste se place dans un `<li>`.","`<dl>` / `<dt>` / `<dd>` pour les paires terme/description."]', 'Codez le plan d’un site : Accueil, Services (avec 3 sous-pages), Blog (avec 2 catégories contenant chacune 2 articles), Contact.', 1, 2),
(33, 13, 'Structure d’un tableau', 'structure-d-un-tableau', 14, 'Horaires d’ouverture, grille tarifaire, résultats sportifs, comparatif de produits : dès que des données se lisent **en lignes et en colonnes**, le tableau HTML est l’outil adapté. À condition de bien déclarer les en-têtes, sans quoi un lecteur d’écran ne peut pas savoir à quoi correspond une cellule.', '["Construire un tableau avec `<table>`, `<tr>`, `<td>`","Déclarer des en-têtes avec `<th>` et `scope`","Ajouter une légende avec `<caption>`"]', '["Les listes"]', '## La structure de base

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

> [!TIP] Test simple : les cellules ont-elles un sens si on lit « en-tête de ligne + en-tête de colonne » ? Si oui, c’est un vrai tableau.', '<table>
  <caption>Titre</caption>
  <tr><th scope="col">En-tête</th></tr>
  <tr><td>Donnée</td></tr>
</table>', NULL, NULL, '<table>
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
</table>', 'table {
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
}', '[["<caption>Horaires d’ouverture</caption>","Titre du tableau, juste après `<table>`."],["<th scope=\\"col\\">Jour</th>","En-tête de colonne."],["<th scope=\\"row\\">Lundi</th>","En-tête de ligne : il décrit toutes les cellules de sa ligne."],["<td>Fermé</td>","Cellule de données."],["border-collapse: collapse;","(CSS) Fusionne les bordures doubles entre cellules."]]', '[["<table>","Tableau."],["<tr>","Ligne."],["<th>","Cellule d’en-tête (`scope=\\"col\\"` ou `\\"row\\"`)."],["<td>","Cellule de données."],["<caption>","Légende / titre du tableau."]]', '["Utiliser un tableau pour la mise en page.","Mettre les en-têtes dans des `<td>` en gras au lieu de `<th>`.","Oublier `<caption>`.","Des lignes avec un nombre de cellules différent.","Styler le tableau avec les attributs obsolètes `border`, `cellpadding`."]', '["Toujours des `<th>` avec `scope`.","Une `<caption>` descriptive.","Le style en CSS (`border-collapse`, padding)."]', 'Les grilles tarifaires (« Formule / Prix / Engagement »), les calendriers de matchs ou les comparatifs techniques sont de vrais tableaux. Sur mobile, on les place dans un conteneur `overflow-x: auto` pour qu’ils défilent horizontalement.', '["`<table>` > `<tr>` > `<th>`/`<td>`.","`<th scope>` associe les en-têtes aux données.","`<caption>` titre le tableau.","Tableau = données, jamais mise en page."]', 'Créez votre emploi du temps de la semaine (jours en colonnes, créneaux en lignes) avec en-têtes et légende.', 1, 1),
(34, 13, 'thead, tbody, tfoot et fusion de cellules', 'tableaux-avances', 14, 'Un relevé bancaire a un en-tête, des lignes d’opérations et une ligne de total. Un planning a des cellules qui couvrent plusieurs créneaux. HTML sait représenter tout cela : groupes de lignes et cellules fusionnées.', '["Structurer un tableau avec `<thead>`, `<tbody>`, `<tfoot>`","Fusionner des cellules avec `colspan` et `rowspan`"]', '["Structure d’un tableau"]', '## Les groupes de lignes

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

> [!WARN] Les fusions complexes rendent un tableau difficile à comprendre avec un lecteur d’écran. Utilisez-les avec parcimonie, ou scindez le tableau en plusieurs tableaux plus simples.', '<thead>…</thead><tbody>…</tbody><tfoot>…</tfoot>
<td colspan="2">…</td>
<td rowspan="2">…</td>', NULL, NULL, '<table>
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
</table>', 'table { border-collapse: collapse; font-family: system-ui, sans-serif; }
th, td { border: 1px solid #cbd5e1; padding: 8px 12px; }
thead th { background: #1e3a8a; color: white; }
tfoot { font-weight: bold; background: #f1f5f9; }
tbody tr:nth-child(even) { background: #f8fafc; }', '[["<thead>","Groupe des lignes d’en-tête."],["<tbody>","Corps du tableau."],["<td colspan=\\"2\\">Livraison offerte</td>","Cellule fusionnée sur 2 colonnes : la ligne n’a que 2 cellules."],["<tfoot>","Pied du tableau pour le total."],["<th scope=\\"row\\" colspan=\\"2\\">Total</th>","En-tête de ligne fusionné sur 2 colonnes."]]', '[["<thead> / <tbody> / <tfoot>","Groupes de lignes."],["colspan","Nombre de colonnes couvertes."],["rowspan","Nombre de lignes couvertes."]]', '["Oublier de supprimer les cellules recouvertes par une fusion.","Placer des `<td>` directement dans `<table>` en mélangeant avec `<tbody>`.","Multiplier les fusions au point de rendre le tableau illisible."]', '["Toujours `<thead>` et `<tbody>` pour les tableaux de données.","Un `<tfoot>` pour les totaux.","Des fusions simples et rares."]', 'Les factures, relevés et paniers de commande en ligne sont des tableaux avec `<tfoot>` pour les sous-totaux, taxes et total. Le style « zébré » (`nth-child(even)`) améliore la lecture des longues listes.', '["`<thead>`, `<tbody>`, `<tfoot>` structurent le tableau.","`colspan` / `rowspan` fusionnent des cellules.","Retirez les cellules recouvertes par une fusion."]', 'Créez un planning hebdomadaire où une réunion de 2 heures occupe deux lignes grâce à `rowspan`.', 1, 2),
(35, 14, 'L’élément form et les champs de saisie', 'form-et-input', 15, 'Inscription, connexion, recherche, commande, contact : les formulaires sont le principal moyen d’**interaction** entre un site et ses visiteurs. Un formulaire mal conçu fait perdre des clients ; un formulaire bien construit est rapide à remplir, accessible et fiable.', '["Créer un formulaire avec `<form>`","Comprendre `action`, `method` et `name`","Créer des champs `<input>`","Associer un `<label>` à chaque champ"]', '["Les tableaux","Les liens"]', '## L’élément `<form>`

```html
<form action="/inscription" method="post">
  …champs…
</form>
```

- `action` : l’adresse (un script côté serveur, par exemple en PHP) qui **reçoit** les données ;
- `method` : comment les envoyer :
  - `get` : les données sont ajoutées à l’URL (`?q=chat`). Pour les **recherches** et filtres ;
  - `post` : les données sont envoyées dans le corps de la requête. Pour tout ce qui **modifie** des données ou contient des informations sensibles (mot de passe).

> [!INFO] HTML ne traite pas les données : il les envoie. Le traitement (enregistrement en base, envoi d’e-mail) est le rôle d’un langage serveur comme PHP.

## Le champ `<input>`

```html
<input type="text" id="prenom" name="prenom">
```

- `type` : le type de champ (texte, e-mail, mot de passe… voir leçon suivante) ;
- `name` : le **nom de la donnée** envoyée au serveur (`prenom=Léa`). **Sans `name`, le champ n’est pas envoyé !**
- `id` : identifiant unique, utilisé par le label ;
- `value` : valeur par défaut ;
- `placeholder` : texte d’exemple affiché dans le champ vide.

## Le `<label>` : indispensable

Chaque champ doit avoir une **étiquette visible** reliée au champ :

```html
<label for="email">Adresse e-mail</label>
<input type="email" id="email" name="email">
```

L’attribut `for` du label reprend l’`id` du champ. Bénéfices :

- le lecteur d’écran annonce « Adresse e-mail, champ de saisie » ;
- cliquer sur le texte du label place le curseur dans le champ (zone de clic plus grande, précieuse sur mobile et pour les cases à cocher).

> [!WARN] Le `placeholder` ne remplace **jamais** un label : il disparaît dès que l’on tape, il est souvent peu contrasté et mal lu par certaines technologies d’assistance.

## Le bouton d’envoi

```html
<button type="submit">S’inscrire</button>
```', '<form action="…" method="post">
  <label for="id">Libellé</label>
  <input type="text" id="id" name="nom">
  <button type="submit">Envoyer</button>
</form>', NULL, NULL, '<form action="/newsletter" method="post">
  <h2>Inscription à la newsletter</h2>

  <label for="prenom">Prénom</label>
  <input type="text" id="prenom" name="prenom" autocomplete="given-name">

  <label for="email">Adresse e-mail</label>
  <input type="email" id="email" name="email" placeholder="exemple@domaine.fr" autocomplete="email">

  <button type="submit">Je m’inscris</button>
</form>', 'form {
  display: flex;
  flex-direction: column;
  gap: 6px;
  max-width: 320px;
  font-family: system-ui, sans-serif;
}

input {
  padding: 8px;
  border: 1px solid #94a3b8;
  border-radius: 6px;
  margin-bottom: 8px;
}

button {
  padding: 10px;
  border: 0;
  border-radius: 6px;
  background: #4f46e5;
  color: white;
  font-weight: bold;
}', '[["<form action=\\"/newsletter\\" method=\\"post\\">","Les données seront envoyées en POST à l’adresse /newsletter."],["<label for=\\"prenom\\">Prénom</label>","Étiquette reliée au champ d’`id=\\"prenom\\"`."],["<input type=\\"text\\" id=\\"prenom\\" name=\\"prenom\\" …>","`name` = nom de la donnée envoyée ; `autocomplete` aide le navigateur à préremplir."],["<input type=\\"email\\" … placeholder=\\"…\\">","Le placeholder montre un exemple, en complément du label."],["<button type=\\"submit\\">","Bouton qui envoie le formulaire."]]', '[["<form>","Formulaire. Attributs `action` et `method`."],["<input>","Champ de saisie (élément vide)."],["name","Nom de la donnée envoyée au serveur."],["<label for=\\"…\\">","Étiquette associée à un champ."],["placeholder","Exemple affiché dans le champ vide."],["autocomplete","Aide au remplissage automatique."]]', '["Oublier `name` : la donnée n’est pas envoyée.","Utiliser un placeholder comme seul libellé.","Un `for` qui ne correspond à aucun `id`.","Envoyer un mot de passe en `method=\\"get\\"` (il apparaît dans l’URL et l’historique)."]', '["Un label visible pour chaque champ.","`method=\\"post\\"` pour les données sensibles ou modifiantes.","Des attributs `autocomplete` pour faciliter la saisie.","Demander uniquement les informations nécessaires."]', 'Sur cette plateforme, la page d’inscription est un `<form method="post">` : chaque champ a un `<label>`, un `name` et un `autocomplete`. Côté serveur, PHP lit `$_POST[''email'']`, valide la valeur et crée le compte.', '["`<form action method>` envoie les données.","`name` est indispensable pour l’envoi.","Chaque champ a un `<label for>` relié à son `id`.","GET pour chercher, POST pour modifier."]', 'Créez un formulaire de recherche en `method="get"` avec un champ `name="q"`. Soumettez-le et observez l’URL.', 1, 1),
(36, 14, 'Les types de champs', 'types-de-champs', 16, 'Sur mobile, un champ `type="email"` affiche un clavier avec le « @ », un champ `type="tel"` un pavé numérique. Choisir le bon type, c’est offrir la bonne interface **gratuitement** et bénéficier de la validation du navigateur.', '["Utiliser les types email, password, number, tel, url, date, search","Créer des cases à cocher et des boutons radio","Grouper des champs avec `<fieldset>` et `<legend>`"]', '["L’élément form et les champs de saisie"]', '## Les principaux types

| Type | Usage | Bonus |
|---|---|---|
| `text` | Texte court | — |
| `email` | Adresse e-mail | Clavier @, vérification du format |
| `password` | Mot de passe | Caractères masqués |
| `number` | Nombre | Flèches, `min`, `max`, `step` |
| `tel` | Téléphone | Pavé numérique mobile |
| `url` | Adresse web | Vérification du format |
| `date`, `time` | Date, heure | Sélecteur natif |
| `search` | Recherche | Bouton d’effacement |
| `range` | Curseur | `min`, `max` |
| `color` | Couleur | Sélecteur de couleur |
| `file` | Fichier | Explorateur de fichiers |

## Cases à cocher : `checkbox`

Pour des choix **indépendants** (zéro, un ou plusieurs) :

```html
<input type="checkbox" id="news" name="newsletter" value="oui">
<label for="news">Recevoir la newsletter</label>
```

`checked` coche la case par défaut.

## Boutons radio : `radio`

Pour **un seul choix** parmi plusieurs. Les boutons d’un même groupe partagent le **même `name`** :

```html
<input type="radio" id="petit" name="taille" value="S">
<label for="petit">Petit</label>
<input type="radio" id="moyen" name="taille" value="M">
<label for="moyen">Moyen</label>
```

`value` est la donnée envoyée (`taille=M`).

## Grouper : `<fieldset>` et `<legend>`

Un groupe de radios ou de cases doit être entouré d’un `<fieldset>` avec une `<legend>` qui pose la question :

```html
<fieldset>
  <legend>Taille du café</legend>
  …boutons radio…
</fieldset>
```

Le lecteur d’écran annonce alors « Taille du café, groupe — Petit, bouton radio ».', '<input type="email" …>
<input type="checkbox" …>
<fieldset><legend>Question</legend> radios… </fieldset>', NULL, NULL, '<form action="/commande" method="post">
  <label for="mail">E-mail</label>
  <input type="email" id="mail" name="email">

  <label for="nb">Nombre de cafés</label>
  <input type="number" id="nb" name="quantite" min="1" max="10" value="1">

  <label for="retrait">Heure de retrait</label>
  <input type="time" id="retrait" name="heure">

  <fieldset>
    <legend>Taille</legend>
    <input type="radio" id="t-s" name="taille" value="S" checked>
    <label for="t-s">Petit</label>
    <input type="radio" id="t-l" name="taille" value="L">
    <label for="t-l">Grand</label>
  </fieldset>

  <input type="checkbox" id="sucre" name="sucre" value="1">
  <label for="sucre">Avec sucre</label>

  <button type="submit">Commander</button>
</form>', NULL, '[["<input type=\\"email\\" …>","Clavier adapté sur mobile et vérification du format."],["<input type=\\"number\\" … min=\\"1\\" max=\\"10\\" value=\\"1\\">","Nombre entre 1 et 10, valeur par défaut 1."],["<input type=\\"time\\" …>","Sélecteur d’heure natif."],["<fieldset><legend>Taille</legend>","Groupe de boutons radio avec sa question."],["<input type=\\"radio\\" … name=\\"taille\\" value=\\"S\\" checked>","Même `name` pour le groupe ; `checked` = choix par défaut."],["<input type=\\"checkbox\\" …>","Choix indépendant (oui/non)."]]', '[["type=\\"email|password|number|tel|url\\"","Types de saisie spécialisés."],["type=\\"date|time\\"","Sélecteurs de date et d’heure."],["type=\\"checkbox\\"","Case à cocher."],["type=\\"radio\\"","Choix unique dans un groupe (même `name`)."],["checked","Coché par défaut."],["<fieldset> / <legend>","Groupe de champs et son intitulé."]]', '["Des radios d’un même groupe avec des `name` différents (on peut tout cocher).","Oublier `value` sur les radios et checkboxes.","Utiliser `type=\\"number\\"` pour un code postal ou un numéro de carte (zéros initiaux perdus) : préférez `text` + `inputmode=\\"numeric\\"`.","Des radios sans `<fieldset>`/`<legend>`."]', '["Choisir le type le plus précis.","Grouper radios et cases avec `<fieldset>`.","Placer le label après la case à cocher / le radio."]', 'Les tunnels de commande utilisent tous ces types : `email` pour le contact, `tel` pour la livraison, `radio` pour le mode de livraison, `checkbox` pour les conditions générales. Chaque bon choix de type réduit les erreurs de saisie.', '["Le type adapte clavier, interface et validation.","Checkbox = choix indépendants ; radio = choix unique (même `name`).","`<fieldset>` + `<legend>` pour grouper."]', 'Créez un formulaire de réservation d’hôtel : dates d’arrivée et de départ, nombre de personnes (1 à 6), type de chambre (radio), options (checkbox).', 1, 2),
(37, 14, 'Listes déroulantes, zones de texte et boutons', 'select-textarea-button', 13, 'Choisir son pays dans une liste, écrire un long message, envoyer ou réinitialiser un formulaire : trois nouveaux éléments complètent votre boîte à outils — `<select>`, `<textarea>` et `<button>`.', '["Créer une liste déroulante avec `<select>` et `<option>`","Créer une zone de texte multiligne","Connaître les types de boutons"]', '["Les types de champs"]', '## `<select>` : la liste déroulante

```html
<label for="pays">Pays</label>
<select id="pays" name="pays">
  <option value="">— Choisissez —</option>
  <option value="fr">France</option>
  <option value="be" selected>Belgique</option>
  <option value="ca">Canada</option>
</select>
```

- `value` : la donnée envoyée ; le texte de l’option est ce que voit l’utilisateur ;
- `selected` : option choisie par défaut ;
- `<optgroup label="…">` regroupe des options ;
- `multiple` permet plusieurs choix (peu ergonomique : préférez des cases à cocher).

Quand l’utiliser ? Pour **plus de 5 ou 6 choix**. En dessous, des boutons radio sont plus rapides (tout est visible en un coup d’œil).

## `<textarea>` : texte long

```html
<label for="msg">Votre message</label>
<textarea id="msg" name="message" rows="5"></textarea>
```

Contrairement à `<input>`, `<textarea>` a une balise fermante ; la valeur par défaut s’écrit **entre** les balises. `rows` règle la hauteur initiale ; `maxlength` limite le nombre de caractères.

## `<button>` : trois types

| Type | Effet |
|---|---|
| `submit` | Envoie le formulaire (par défaut dans un form) |
| `reset` | Remet les valeurs initiales (rarement utile, souvent frustrant) |
| `button` | Ne fait rien par défaut (utilisé avec JavaScript) |

> [!TIP] Précisez toujours le `type` d’un bouton. Un `<button>` sans type dans un formulaire est un bouton d’envoi : un bouton « Afficher le mot de passe » mal typé enverrait le formulaire !

## Le texte du bouton

Préférez une action précise à « Envoyer » : « Créer mon compte », « Réserver ma table », « Recevoir le devis ».', '<select name="…"><option value="…">…</option></select>
<textarea name="…" rows="5"></textarea>
<button type="submit">…</button>', NULL, NULL, '<form action="/contact" method="post">
  <label for="sujet">Sujet</label>
  <select id="sujet" name="sujet">
    <option value="">— Choisissez un sujet —</option>
    <optgroup label="Commandes">
      <option value="suivi">Suivi de commande</option>
      <option value="retour">Retour produit</option>
    </optgroup>
    <option value="autre">Autre demande</option>
  </select>

  <label for="message">Message</label>
  <textarea id="message" name="message" rows="5" maxlength="1000"></textarea>

  <button type="submit">Envoyer ma demande</button>
</form>', NULL, '[["<select id=\\"sujet\\" name=\\"sujet\\">","Liste déroulante, reliée à son label."],["<option value=\\"\\">— Choisissez un sujet —</option>","Option vide : oblige à faire un choix conscient."],["<optgroup label=\\"Commandes\\">","Groupe d’options avec un intitulé."],["<textarea … rows=\\"5\\" maxlength=\\"1000\\"></textarea>","Zone multiligne, 5 lignes visibles, 1000 caractères maximum."],["<button type=\\"submit\\">Envoyer ma demande</button>","Bouton d’envoi avec un texte précis."]]', '[["<select>","Liste déroulante."],["<option value selected>","Option (valeur envoyée, sélection par défaut)."],["<optgroup label>","Groupe d’options."],["<textarea rows maxlength>","Zone de texte multiligne."],["<button type>","`submit`, `reset` ou `button`."]]', '["Écrire `<textarea value=\\"…\\">` : la valeur se place entre les balises.","Laisser des espaces ou retours à la ligne entre `<textarea>` et `</textarea>` (ils deviennent du contenu).","Un `<select>` pour 2 ou 3 choix.","Oublier le `type` des boutons."]', '["Radios pour peu de choix, select au-delà de 6.","Une option vide par défaut dans un select obligatoire.","Des textes de boutons orientés action."]', 'Les formulaires de contact d’entreprise combinent presque toujours ces trois éléments. Côté serveur, le script vérifie que la valeur du `<select>` fait bien partie des options autorisées : on ne fait jamais confiance aux données envoyées.', '["`<select>` + `<option value>` pour les longues listes.","`<textarea>` pour le texte long, valeur entre les balises.","Toujours préciser `type` sur `<button>`."]', 'Créez un formulaire « Signaler un bug » : page concernée (select avec optgroup), gravité (radio), description (textarea), capture (file), bouton d’envoi.', 1, 3),
(38, 14, 'La validation native des formulaires', 'validation-native-formulaires', 14, 'Le navigateur sait vérifier un formulaire **avant** son envoi : champ obligatoire vide, e-mail mal formé, nombre hors limites… Quelques attributs suffisent. Mais attention : cette validation est un confort pour l’utilisateur, **jamais une sécurité**.', '["Utiliser `required`, `minlength`, `maxlength`, `min`, `max`, `pattern`","Comprendre les limites de la validation côté client","Aider l’utilisateur avec des messages clairs"]', '["Listes déroulantes, zones de texte et boutons"]', '## Les attributs de validation

| Attribut | Rôle | Exemple |
|---|---|---|
| `required` | Champ obligatoire | `<input required>` |
| `minlength` / `maxlength` | Longueur du texte | `minlength="8"` |
| `min` / `max` / `step` | Bornes numériques ou de date | `min="18"` |
| `pattern` | Expression régulière | `pattern="[0-9]{5}"` |
| `type` | Format (email, url…) | `type="email"` |

Si une règle n’est pas respectée, le navigateur **bloque l’envoi** et affiche un message près du champ.

```html
<label for="cp">Code postal (5 chiffres)</label>
<input id="cp" name="cp" required pattern="[0-9]{5}" inputmode="numeric">
```

## Indiquer les champs obligatoires

Signalez-les **visuellement et textuellement** : « (obligatoire) » ou un astérisque expliqué en haut du formulaire (« Les champs marqués * sont obligatoires »). La couleur seule ne suffit pas.

## Donner des instructions à l’avance

Les contraintes (« 8 caractères minimum, dont un chiffre ») doivent être visibles **avant** la saisie, par exemple dans un texte d’aide relié au champ par `aria-describedby`.

## Validation client ≠ sécurité

N’importe qui peut désactiver la validation (outils de développement, attribut `novalidate`, requête envoyée directement). Le serveur doit **toujours revérifier** toutes les données. Sur cette plateforme, par exemple, PHP valide chaque champ de l’inscription même si le navigateur l’a déjà fait.

> [!WARN] La validation HTML sert l’expérience utilisateur. La validation serveur sert la sécurité et l’intégrité des données. Il faut les deux.', '<input type="email" required>
<input type="password" minlength="8" required>
<input type="number" min="1" max="99">
<input pattern="[0-9]{5}">', NULL, NULL, '<form action="/inscription" method="post">
  <p>Tous les champs sont obligatoires.</p>

  <label for="pseudo">Pseudo (3 à 20 caractères)</label>
  <input id="pseudo" name="pseudo" required minlength="3" maxlength="20">

  <label for="courriel">E-mail</label>
  <input type="email" id="courriel" name="email" required>

  <label for="age">Âge</label>
  <input type="number" id="age" name="age" required min="16" max="120">

  <label for="mdp">Mot de passe</label>
  <input type="password" id="mdp" name="password" required minlength="8" aria-describedby="mdp-aide">
  <small id="mdp-aide">8 caractères minimum.</small>

  <button type="submit">Créer mon compte</button>
</form>', NULL, '[["<p>Tous les champs sont obligatoires.</p>","Information donnée avant la saisie."],["<input … required minlength=\\"3\\" maxlength=\\"20\\">","Obligatoire, entre 3 et 20 caractères."],["<input type=\\"email\\" … required>","Format e-mail vérifié par le navigateur."],["<input type=\\"number\\" … min=\\"16\\" max=\\"120\\">","Âge borné."],["aria-describedby=\\"mdp-aide\\"","Relie le champ à son texte d’aide (lu par les lecteurs d’écran)."]]', '[["required","Champ obligatoire."],["minlength / maxlength","Longueur minimale / maximale."],["min / max / step","Bornes numériques."],["pattern","Expression régulière à respecter."],["novalidate","Sur `<form>` : désactive la validation native."],["aria-describedby","Relie un champ à un texte d’aide."]]', '["Compter uniquement sur la validation HTML pour la sécurité.","Des contraintes non expliquées (l’utilisateur découvre la règle après l’erreur).","Signaler les champs obligatoires uniquement par la couleur rouge.","Un `pattern` trop strict qui refuse des valeurs valides (noms composés, numéros internationaux)."]', '["Expliquer les contraintes avant la saisie.","Toujours revalider côté serveur.","Garder des règles raisonnables."]', 'Les formulaires professionnels combinent la validation native (réaction immédiate), un peu de JavaScript (messages personnalisés en français) et une validation serveur (sécurité). C’est l’approche utilisée sur cette plateforme.', '["`required`, `minlength`, `min`, `pattern`… bloquent un envoi invalide.","Expliquez les contraintes à l’avance.","La validation côté client n’est jamais une sécurité : le serveur revérifie tout."]', 'Créez un formulaire de réservation avec validation : nom obligatoire, e-mail, nombre de personnes de 1 à 8, date minimale aujourd’hui (attribut `min` sur `type="date"`).', 1, 4),
(39, 15, 'Classes et identifiants en HTML', 'classes-et-identifiants', 12, 'Vous avez utilisé `class` et `id` en CSS. Côté HTML, ils sont bien plus qu’un crochet pour le style : l’`id` sert aux ancres, aux labels et à l’accessibilité ; la `class` décrit des familles d’éléments. Bien les nommer rend un projet compréhensible par toute une équipe.', '["Appliquer une ou plusieurs classes","Respecter l’unicité des id","Nommer classes et identifiants de façon cohérente","Découvrir la convention BEM"]', '["Sélecteurs de type, de classe et d’identifiant (CSS)"]', '## `class` : des familles d’éléments

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
- **JavaScript** : `document.getElementById(''menu'')`.

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

On sait immédiatement à quoi sert chaque classe et où se trouve son style.', '<div class="bloc bloc--variante" id="unique">…</div>', NULL, NULL, '<section id="offres">
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
<p><a href="#offres">Revoir les offres</a></p>', '.offre {
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
}', '[["<section id=\\"offres\\">","Identifiant unique : cible de l’ancre en bas de page."],["<article class=\\"offre\\">","Bloc « offre » réutilisé."],["<h3 class=\\"offre__titre\\">","Élément du bloc (convention BEM)."],["<article class=\\"offre offre--populaire\\">","Deux classes : le bloc + sa variante."],["<a href=\\"#offres\\">","Lien vers l’`id`."]]', '[["class","Une ou plusieurs classes, séparées par des espaces."],["id","Identifiant unique dans la page."],["bloc__element","BEM : élément d’un bloc."],["bloc--modificateur","BEM : variante d’un bloc."]]', '["Deux attributs `class` sur le même élément.","Le même `id` utilisé plusieurs fois.","Des noms avec espaces ou accents : `class=\\"carte produit\\"` crée deux classes.","Des noms basés sur l’apparence."]', '["Des noms en minuscules avec tirets.","Des noms selon le rôle.","Une convention (comme BEM) appliquée dans tout le projet."]', 'Dans une équipe, un développeur qui lit `class="panier__ligne panier__ligne--vide"` comprend instantanément la structure, sans ouvrir le CSS. C’est l’intérêt d’une convention partagée.', '["`class` : plusieurs, réutilisables ; `id` : unique.","Noms en minuscules, tirets, selon le rôle.","BEM : `bloc__element--modificateur`."]', 'Codez trois cartes de profil en BEM (`profil`, `profil__nom`, `profil__role`, `profil--admin`).', 1, 1),
(40, 15, 'Attributs globaux, div et span', 'attributs-globaux', 13, 'Certains attributs fonctionnent sur **tous** les éléments : `title`, `lang`, `hidden`, `tabindex`, `data-*`… Et deux éléments n’ont **aucun sens** particulier : `<div>` et `<span>`. Savoir quand les utiliser — et surtout quand ne pas le faire — distingue un HTML propre d’une « soupe de div ».', '["Utiliser les attributs globaux courants","Stocker des données avec `data-*`","Choisir entre `<div>`, `<span>` et une balise sémantique"]', '["Classes et identifiants en HTML"]', '## Les attributs globaux utiles

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

> [!TIP] Réflexe : avant d’écrire `<div>`, demandez-vous « existe-t-il une balise qui décrit ce contenu ? ». Si oui, utilisez-la.', '<div class="…">bloc neutre</div>
<span class="…">texte en ligne neutre</span>
<li data-id="42">…</li>', NULL, NULL, '<div class="catalogue">
  <p>Prix du jour : <span class="prix">3,20 €</span> le kilo.</p>
  <ul>
    <li data-categorie="fruits">Pommes</li>
    <li data-categorie="legumes">Carottes</li>
    <li data-categorie="fruits">Poires</li>
  </ul>
  <p lang="en" title="Citation de John Lennon">Life is what happens while you are busy making other plans.</p>
  <p hidden>Ce paragraphe est masqué.</p>
</div>', '.catalogue {
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
}', '[["<div class=\\"catalogue\\">","Conteneur neutre utilisé pour le style (fond, marges)."],["<span class=\\"prix\\">3,20 €</span>","Conteneur en ligne neutre : on veut juste styler le prix."],["<li data-categorie=\\"fruits\\">","Donnée personnalisée, exploitée par le CSS."],["<p lang=\\"en\\" title=\\"…\\">","Langue locale et info-bulle."],["<p hidden>","Élément masqué pour tous."]]', '[["title","Info-bulle."],["lang / dir","Langue et sens d’écriture."],["hidden","Masque l’élément."],["tabindex","Participation à la navigation clavier."],["data-*","Données personnalisées."],["<div> / <span>","Conteneurs neutres bloc / en ligne."]]', '["Utiliser des `<div>` partout au lieu de balises sémantiques.","Utiliser `<div>` à l’intérieur d’un `<p>` (bloc dans un paragraphe).","Mettre des informations essentielles uniquement dans `title`.","Utiliser `tabindex` avec des valeurs positives (1, 2, 3…) qui brouillent l’ordre naturel."]', '["Une balise sémantique dès qu’elle existe ; div/span en dernier recours.","`data-*` pour les données destinées aux scripts.","`tabindex` limité à `0` et `-1`."]', 'Les filtres des boutiques (« Afficher : fruits / légumes ») utilisent souvent `data-*` : JavaScript lit `data-categorie` pour masquer ou afficher les produits, sans toucher aux classes de style.', '["Les attributs globaux s’appliquent à tous les éléments.","`data-*` stocke des données personnalisées.","`<div>`/`<span>` n’ont aucun sens : à utiliser en dernier recours."]', 'Reprenez une page existante et remplacez chaque `<div>` qui pourrait être une balise plus précise (titre, liste, paragraphe…).', 1, 2);

INSERT INTO `lessons` (`id`, `module_id`, `title`, `slug`, `duration_minutes`, `introduction`, `objectives`, `prerequisites`, `theory`, `syntax_code`, `simple_html`, `simple_css`, `example_html`, `example_css`, `line_by_line`, `reference_items`, `common_mistakes`, `best_practices`, `practical`, `summary_points`, `challenge`, `is_published`, `sort_order`) VALUES
(41, 16, 'block, inline et inline-block', 'block-inline-inline-block', 14, 'Pourquoi deux paragraphes s’empilent-ils alors que deux liens se suivent sur la même ligne ? Pourquoi `width` n’a-t-il aucun effet sur un lien ? Tout est question de **type d’affichage**. La propriété `display` est la clé de toute mise en page CSS.', '["Distinguer éléments bloc et en ligne","Utiliser `inline-block`","Changer le type d’affichage d’un élément"]', '["Le modèle de boîte"]', '## Le flux normal

Sans CSS de mise en page, les éléments se placent dans le **flux normal** : de haut en bas pour les blocs, de gauche à droite pour le contenu en ligne.

## `display: block`

Exemples par défaut : `<div>`, `<p>`, `<h1>`, `<ul>`, `<section>`.

- commence sur une **nouvelle ligne** ;
- occupe **toute la largeur** disponible ;
- accepte `width`, `height`, `margin` et `padding` dans toutes les directions.

## `display: inline`

Exemples par défaut : `<a>`, `<span>`, `<strong>`, `<em>`.

- se place **dans la ligne**, à la suite du texte ;
- sa largeur = celle de son contenu ;
- **ignore** `width` et `height` ;
- les marges verticales n’écartent pas les lignes.

## `display: inline-block`

Le meilleur des deux : l’élément reste **dans la ligne**, mais accepte `width`, `height`, `padding` et `margin` comme un bloc. Idéal pour un **bouton** créé à partir d’un lien :

```css
.btn {
  display: inline-block;
  padding: 10px 20px;
}
```

## Changer le type

N’importe quel élément peut changer de type d’affichage **sans perdre son sens HTML** :

```css
nav li { display: inline-block; } /* menu horizontal */
img { display: block; }             /* supprime l’espace sous l’image */
```

> [!INFO] Les images sont `inline` par défaut : c’est pourquoi un petit espace apparaît parfois sous elles (réservé aux lettres descendantes comme « g » ou « p »). `display: block` le supprime.

## Et après ?

`display` accepte aussi `flex` et `grid`, les deux systèmes de mise en page modernes que vous verrez dans les modules suivants.', 'display: block;
display: inline;
display: inline-block;', NULL, NULL, '<p>Un paragraphe est un bloc.</p>
<p>Voici des <a class="lien" href="#">liens</a> <a class="lien" href="#">en ligne</a>.</p>
<a class="btn" href="#">Bouton inline-block</a>
<a class="btn" href="#">Autre bouton</a>
<span class="bloc">Un span transformé en bloc</span>', 'p {
  background: #e0f2fe;
}

.lien {
  width: 300px;  /* ignoré : élément inline */
  background: #fde68a;
}

.btn {
  display: inline-block;
  width: 180px;
  padding: 10px;
  margin: 8px 4px;
  text-align: center;
  background: #1d4ed8;
  color: white;
  text-decoration: none;
}

.bloc {
  display: block;
  margin-top: 12px;
  padding: 8px;
  background: #dcfce7;
}', '[["p { background: #e0f2fe; }","Le fond couvre toute la largeur : le paragraphe est un bloc."],["  width: 300px;  /* ignoré */","Un élément inline ignore `width`."],["  display: inline-block;","Le lien reste dans la ligne mais accepte largeur et marges."],["  width: 180px;","Pris en compte grâce à inline-block."],["  display: block;","Le span prend toute la largeur et passe à la ligne."]]', '[["display: block","Nouvelle ligne, toute la largeur, dimensions acceptées."],["display: inline","Dans la ligne, taille du contenu, width/height ignorés."],["display: inline-block","Dans la ligne, dimensions acceptées."]]', '["Donner `width` ou `margin-top` à un lien inline et ne pas comprendre pourquoi rien ne change.","Changer une balise HTML pour obtenir un comportement d’affichage (au lieu de `display`).","Oublier l’espace créé entre des éléments inline-block par les espaces du code HTML."]', '["Garder la balise HTML pour le sens, régler l’affichage en CSS.","Utiliser `inline-block` pour des boutons, Flexbox pour aligner des séries d’éléments.","`img { display: block; }` dans le reset."]', 'Les boutons des sites sont très souvent des liens `<a>` en `display: inline-block` avec du padding. Et avant Flexbox, les menus horizontaux étaient faits avec des `<li>` en `inline-block`.', '["block : nouvelle ligne, pleine largeur.","inline : dans le texte, sans dimensions.","inline-block : dans la ligne, avec dimensions.","`display` change l’affichage sans changer le sens."]', 'Transformez une liste `<ul>` de 4 liens en menu horizontal avec `display: inline-block` sur les `<li>`, sans puces.', 1, 1),
(42, 16, 'Masquer des éléments : none, visibility, opacity', 'display-none-visibility-overflow', 12, 'Menu mobile fermé, message affiché après une action, texte réservé aux lecteurs d’écran… Il existe plusieurs façons de masquer un élément en CSS, et elles n’ont **pas du tout** les mêmes effets, notamment sur l’accessibilité.', '["Distinguer `display: none`, `visibility: hidden` et `opacity: 0`","Masquer visuellement un texte tout en le laissant aux lecteurs d’écran"]', '["block, inline et inline-block"]', '## Trois façons de masquer

| Méthode | Place occupée | Visible | Lecteur d’écran | Cliquable |
|---|---|---|---|---|
| `display: none` | Non | Non | Non | Non |
| `visibility: hidden` | **Oui** | Non | Non | Non |
| `opacity: 0` | **Oui** | Non | **Oui** | **Oui** |

- `display: none` : l’élément disparaît complètement, comme s’il n’existait pas. Utilisé pour les menus fermés, les onglets inactifs.
- `visibility: hidden` : l’emplacement reste réservé (un trou dans la page).
- `opacity: 0` : invisible mais toujours présent et interactif — attention aux pièges (un bouton invisible mais cliquable !). Utile pour les animations d’apparition.

## Masquer visuellement, garder pour l’accessibilité

Parfois, on veut un texte **lu par les lecteurs d’écran mais pas affiché** (par exemple « Ouvrir le menu » sur un bouton icône). On utilise une classe utilitaire classique :

```css
.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  overflow: hidden;
  clip: rect(0 0 0 0);
  white-space: nowrap;
}
```

Cette plateforme l’utilise sur ses boutons icônes.

> [!WARN] Ne masquez jamais un contenu important uniquement pour gagner de la place : sur mobile, réorganisez plutôt la mise en page.', 'display: none;
visibility: hidden;
opacity: 0;', NULL, NULL, '<div class="ligne">
  <span class="case">A</span>
  <span class="case cache-none">B</span>
  <span class="case">C</span>
</div>
<div class="ligne">
  <span class="case">A</span>
  <span class="case cache-visibility">B</span>
  <span class="case">C</span>
</div>
<button type="button"><span aria-hidden="true">☰</span><span class="sr-only">Ouvrir le menu</span></button>', '.case {
  display: inline-block;
  width: 60px;
  padding: 12px 0;
  margin: 4px;
  text-align: center;
  background: #c7d2fe;
}

.cache-none { display: none; }            /* C se décale vers la gauche */
.cache-visibility { visibility: hidden; } /* un trou reste à la place de B */

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  overflow: hidden;
  clip: rect(0 0 0 0);
  white-space: nowrap;
}', '[[".cache-none { display: none; }","B disparaît totalement : C prend sa place."],[".cache-visibility { visibility: hidden; }","B est invisible mais sa place reste réservée."],["<span aria-hidden=\\"true\\">☰</span>","L’icône est ignorée par les lecteurs d’écran."],["<span class=\\"sr-only\\">Ouvrir le menu</span>","Texte invisible à l’écran mais lu par les lecteurs d’écran."]]', '[["display: none","Retire l’élément de la mise en page et de l’accessibilité."],["visibility: hidden","Invisible, place conservée."],["opacity: 0","Transparent, toujours présent et interactif."],[".sr-only","Masque visuellement en gardant l’accessibilité."]]', '["Utiliser `opacity: 0` pour masquer un bouton : il reste cliquable.","Masquer un label avec `display: none` : le champ perd son nom accessible.","Masquer du contenu important sur mobile."]', '["`display: none` pour ce qui ne doit pas exister à ce moment (menu fermé).","La classe `.sr-only` pour les textes réservés aux lecteurs d’écran.","Tester avec un lecteur d’écran ou l’inspecteur d’accessibilité."]', 'Un menu « burger » sur mobile est souvent en `display: none` tant qu’il est fermé, et passe en `display: block` (ou flex) quand l’utilisateur l’ouvre — c’est le cas du menu de cette plateforme.', '["`display: none` : disparaît complètement.","`visibility: hidden` : invisible, place gardée.","`opacity: 0` : invisible mais présent.","`.sr-only` : caché à l’écran, lu par les lecteurs d’écran."]', 'Créez un bouton-icône « panier » dont le texte « Voir le panier (3 articles) » est réservé aux lecteurs d’écran.', 1, 2),
(43, 17, 'position : relative et absolute', 'position-relative-absolute', 16, 'Un badge « -20 % » dans le coin d’une photo, une icône à l’intérieur d’un champ, une bulle de notification sur une cloche : ces éléments « flottent » à un endroit précis. C’est le travail de `position: absolute`… à condition de comprendre son partenaire indispensable, `position: relative`.', '["Comprendre `static` et `relative`","Positionner un élément en `absolute` par rapport à son parent","Utiliser `top`, `right`, `bottom`, `left` et `inset`"]', '["La propriété display"]', '## `static` (par défaut)

L’élément suit le flux normal. Les propriétés `top`, `left`… n’ont aucun effet.

## `relative`

L’élément reste dans le flux (sa place est conservée), mais on peut le **décaler** par rapport à sa position normale :

```css
.decale { position: relative; top: 10px; left: 20px; }
```

Son usage principal n’est pas là : `position: relative` sert surtout de **repère** pour ses enfants en `absolute`.

## `absolute`

L’élément **sort du flux** : les autres éléments se comportent comme s’il n’existait pas. Il se positionne par rapport à son **ancêtre positionné** le plus proche (un parent en `relative`, `absolute`, `fixed` ou `sticky`). S’il n’y en a aucun, c’est la page entière.

```css
.carte { position: relative; }      /* le repère */
.badge {
  position: absolute;
  top: 12px;
  right: 12px;                       /* coin supérieur droit de la carte */
}
```

C’est le duo classique : **parent `relative`, enfant `absolute`**.

## Les propriétés de décalage

`top`, `right`, `bottom`, `left` indiquent la distance au bord correspondant du repère. `inset: 0;` équivaut à `top: 0; right: 0; bottom: 0; left: 0;` (l’élément couvre tout le parent — utile pour un voile sur une image).

## Centrer un élément absolu

```css
.centre {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
```

> [!WARN] N’utilisez pas `absolute` pour construire toute une mise en page : les éléments ne tiennent plus compte les uns des autres et tout se chevauche dès que le contenu change. Flexbox et Grid sont faits pour ça.', '.parent { position: relative; }
.enfant { position: absolute; top: 0; right: 0; }', NULL, NULL, '<article class="produit">
  <img src="https://placehold.co/280x180/png?text=Casque" alt="Casque audio sans fil noir" width="280" height="180">
  <span class="badge">-20 %</span>
  <h3>Casque sans fil</h3>
  <p><del>99 €</del> 79 €</p>
</article>', '.produit {
  position: relative;
  width: 280px;
  font-family: system-ui, sans-serif;
  border: 1px solid #e5e7eb;
  border-radius: 12px;
  overflow: hidden;
}

.produit img {
  display: block;
}

.badge {
  position: absolute;
  top: 12px;
  right: 12px;
  padding: 4px 10px;
  border-radius: 999px;
  background: #dc2626;
  color: white;
  font-weight: bold;
}

.produit h3,
.produit p {
  margin: 8px 12px;
}', '[["  position: relative;","La carte devient le repère de positionnement."],["  position: absolute;","Le badge sort du flux…"],["  top: 12px;","…et se place à 12px du haut de la carte…"],["  right: 12px;","…et à 12px de son bord droit."],["  overflow: hidden;","Les coins arrondis s’appliquent aussi à l’image."]]', '[["position: static","Flux normal (défaut)."],["position: relative","Décalage relatif, place conservée ; repère pour les enfants absolus."],["position: absolute","Hors flux, positionné par rapport à l’ancêtre positionné."],["top / right / bottom / left","Décalages depuis les bords."],["inset","Raccourci des quatre décalages."]]', '["Oublier `position: relative` sur le parent : l’élément se place par rapport à toute la page.","Construire une mise en page entière en `absolute`.","Définir à la fois `left` et `right` avec une largeur fixe et s’étonner du résultat."]', '["Duo parent `relative` / enfant `absolute` pour les éléments décoratifs ou superposés.","Réserver `absolute` aux petits éléments (badges, icônes, voiles)."]', 'Les vignettes de vidéos (durée en bas à droite), les pastilles de notification, les boutons « fermer » en haut à droite des fenêtres modales : tous utilisent ce duo relative/absolute.', '["`relative` : décalage léger, sert surtout de repère.","`absolute` : hors flux, placé par rapport à l’ancêtre positionné.","Duo : parent `relative`, enfant `absolute`."]', 'Créez une icône de cloche avec une pastille rouge « 3 » positionnée en haut à droite.', 1, 1),
(44, 17, 'fixed, sticky et z-index', 'fixed-sticky-z-index', 14, 'Un en-tête qui reste visible pendant le défilement, un bouton « retour en haut » toujours accessible, des en-têtes de tableau qui suivent le lecteur… Et quand des éléments se superposent, qui passe devant ? Place à `fixed`, `sticky` et `z-index`.', '["Fixer un élément à l’écran avec `fixed`","Créer un élément collant avec `sticky`","Gérer la superposition avec `z-index`"]', '["position : relative et absolute"]', '## `position: fixed`

L’élément est positionné par rapport à la **fenêtre** et **ne bouge plus** pendant le défilement. Il sort du flux.

```css
.retour-haut {
  position: fixed;
  right: 20px;
  bottom: 20px;
}
```

Attention : un en-tête fixe **recouvre** le haut du contenu. Il faut compenser (par exemple `padding-top` sur le body).

## `position: sticky`

Hybride : l’élément se comporte comme `relative`… jusqu’à atteindre le seuil défini (`top: 0`), puis il « colle » tant que son parent est visible.

```css
.en-tete {
  position: sticky;
  top: 0;
}
```

Sans `top` (ou `bottom`), `sticky` ne fait rien. Il ne fonctionne pas si un ancêtre a `overflow: hidden`.

L’en-tête de cette plateforme utilise `sticky`.

## `z-index` : l’ordre de superposition

Quand des éléments positionnés se chevauchent, `z-index` décide qui est **devant** : la valeur la plus élevée passe au-dessus.

```css
.modale { position: fixed; z-index: 100; }
.en-tete { position: sticky; z-index: 10; }
```

- `z-index` ne fonctionne que sur les éléments **positionnés** (ou les enfants de flex/grid) ;
- il s’applique à l’intérieur d’un **contexte d’empilement** : un enfant avec `z-index: 9999` ne peut pas passer devant un élément extérieur si son parent est lui-même derrière.

> [!TIP] Définissez une échelle de z-index pour tout le projet (10 en-tête, 50 menus déroulants, 100 modales, 500 notifications) au lieu d’empiler des `9999`.', 'position: fixed; bottom: 20px; right: 20px;
position: sticky; top: 0;
z-index: 10;', NULL, NULL, '<header class="barre">En-tête collant (sticky)</header>
<main class="contenu">
  <p>Faites défiler l’aperçu : l’en-tête reste en haut.</p>
  <p>Ligne 2</p><p>Ligne 3</p><p>Ligne 4</p><p>Ligne 5</p>
  <p>Ligne 6</p><p>Ligne 7</p><p>Ligne 8</p><p>Ligne 9</p>
  <p>Ligne 10</p><p>Ligne 11</p><p>Ligne 12</p>
</main>
<a class="retour" href="#">↑ Haut</a>', 'body {
  margin: 0;
  font-family: system-ui, sans-serif;
}

.barre {
  position: sticky;
  top: 0;
  z-index: 10;
  padding: 12px 16px;
  background: #0f172a;
  color: white;
}

.contenu {
  padding: 0 16px;
}

.retour {
  position: fixed;
  right: 16px;
  bottom: 16px;
  z-index: 20;
  padding: 8px 12px;
  border-radius: 999px;
  background: #f59e0b;
  color: #111;
  text-decoration: none;
}', '[["  position: sticky;","L’en-tête défile normalement…"],["  top: 0;","…puis colle au haut de l’écran."],["  z-index: 10;","Il passe devant le contenu qui défile dessous."],["  position: fixed;","Le bouton est fixé par rapport à la fenêtre."],["  right: 16px; bottom: 16px;","Toujours en bas à droite."]]', '[["position: fixed","Fixé par rapport à la fenêtre."],["position: sticky","Collant à partir d’un seuil (`top`)."],["z-index","Ordre de superposition des éléments positionnés."]]', '["Oublier `top: 0` avec `sticky`.","Un parent en `overflow: hidden` qui bloque `sticky`.","Un en-tête `fixed` qui masque le début du contenu.","Des `z-index: 99999` en escalade.","Utiliser `z-index` sur un élément non positionné."]', '["Préférer `sticky` à `fixed` pour les en-têtes (pas de compensation nécessaire).","Une échelle de z-index documentée.","Vérifier que les éléments fixes ne masquent rien sur mobile."]', 'Les bannières de cookies, les boutons de chat en bas à droite et les barres de navigation mobiles en bas d’écran sont des éléments `fixed` avec un `z-index` élevé.', '["`fixed` : collé à la fenêtre.","`sticky` + `top` : collant pendant le défilement.","`z-index` : qui passe devant (éléments positionnés)."]', 'Créez une longue page avec un sommaire latéral en `position: sticky` qui reste visible pendant la lecture.', 1, 2),
(45, 18, 'Flexbox : le conteneur et les axes', 'flexbox-le-conteneur', 16, 'Aligner des éléments côte à côte, les espacer régulièrement, centrer verticalement : pendant des années, ces tâches demandaient des astuces compliquées. **Flexbox** les rend simples. C’est l’outil de mise en page que vous utiliserez le plus souvent, pour les menus, les barres d’outils, les cartes, les formulaires…', '["Créer un conteneur flex","Comprendre l’axe principal et l’axe secondaire","Changer la direction avec `flex-direction`","Espacer les éléments avec `gap`"]', '["La propriété display","Le modèle de boîte"]', '## Le principe

Flexbox agit sur **deux niveaux** :

- le **conteneur** (le parent), auquel on applique `display: flex` ;
- les **éléments flexibles** (ses enfants directs), qui s’organisent automatiquement.

```css
.menu { display: flex; }
```

Instantanément, les enfants de `.menu` se placent **côte à côte**, sur une ligne.

## Les deux axes

- l’**axe principal** (*main axis*) : la direction dans laquelle les éléments s’enchaînent. Par défaut, horizontal (de gauche à droite) ;
- l’**axe secondaire** (*cross axis*) : perpendiculaire au premier.

Toutes les propriétés d’alignement de Flexbox font référence à ces deux axes, **pas** à « horizontal » et « vertical ».

## `flex-direction`

Change l’axe principal :

| Valeur | Axe principal |
|---|---|
| `row` (défaut) | Horizontal, de gauche à droite |
| `row-reverse` | Horizontal, de droite à gauche |
| `column` | Vertical, de haut en bas |
| `column-reverse` | Vertical, de bas en haut |

Avec `column`, l’axe principal devient **vertical** : les propriétés d’alignement « tournent » avec lui.

## `gap` : l’espacement

```css
.menu { display: flex; gap: 16px; }
```

`gap` crée un espace **entre** les éléments (pas avant le premier ni après le dernier). Fini les marges à retirer sur le dernier élément !

> [!INFO] Seuls les **enfants directs** du conteneur deviennent des éléments flexibles. Les petits-enfants suivent le flux normal, sauf si leur propre parent est aussi en `display: flex`.', '.conteneur {
  display: flex;
  flex-direction: row;
  gap: 16px;
}', NULL, NULL, '<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#">Cours</a>
  <a href="#">Projets</a>
  <a href="#">Contact</a>
</nav>
<div class="pile">
  <div class="bloc">1</div>
  <div class="bloc">2</div>
  <div class="bloc">3</div>
</div>', '.menu {
  display: flex;
  gap: 20px;
  padding: 12px 16px;
  background: #111827;
  font-family: system-ui, sans-serif;
}

.menu a {
  color: white;
  text-decoration: none;
}

.pile {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-top: 16px;
  width: 120px;
}

.bloc {
  padding: 12px;
  background: #a5b4fc;
  text-align: center;
}', '[["  display: flex;","Le nav devient un conteneur flex : ses liens s’alignent en ligne."],["  gap: 20px;","Espace régulier entre les liens."],["  flex-direction: column;","Axe principal vertical : les blocs s’empilent."],["  gap: 8px;","L’espacement suit l’axe principal (vertical ici)."]]', '[["display: flex","Crée un conteneur flex."],["flex-direction","`row`, `row-reverse`, `column`, `column-reverse`."],["gap","Espacement entre les éléments (aussi `row-gap`, `column-gap`)."],["display: inline-flex","Conteneur flex qui se comporte comme un élément en ligne."]]', '["Appliquer `display: flex` sur les enfants au lieu du parent.","Penser « horizontal/vertical » au lieu d’« axe principal/secondaire ».","Utiliser des marges sur chaque élément au lieu de `gap`."]', '["Flexbox pour les alignements sur une dimension (une ligne OU une colonne).","`gap` pour les espacements entre éléments.","Garder le HTML dans l’ordre logique de lecture."]', 'L’en-tête de cette plateforme est un conteneur flex : le logo, le menu et les boutons de compte sont alignés sur une ligne, avec des espaces gérés par `gap`.', '["`display: flex` sur le parent.","Axe principal (défini par `flex-direction`) et axe secondaire.","`gap` espace les éléments."]', 'Créez une barre d’outils avec 5 boutons alignés en ligne, puis passez-la en colonne en changeant une seule propriété.', 1, 1),
(46, 18, 'Flexbox : aligner et centrer', 'flexbox-alignements', 16, '« Comment centrer une div ? » a longtemps été la question la plus posée par les développeurs web. Avec Flexbox, la réponse tient en trois lignes. Cette leçon vous apprend à placer les éléments exactement où vous le souhaitez, sur les deux axes.', '["Aligner sur l’axe principal avec `justify-content`","Aligner sur l’axe secondaire avec `align-items`","Centrer parfaitement un élément","Aligner un élément isolé avec `align-self` et `margin-left: auto`"]', '["Flexbox : le conteneur et les axes"]', '## `justify-content` : l’axe principal

| Valeur | Effet |
|---|---|
| `flex-start` | Au début (défaut) |
| `flex-end` | À la fin |
| `center` | Au centre |
| `space-between` | Premier et dernier aux extrémités, espace réparti entre |
| `space-around` | Espace autour de chaque élément |
| `space-evenly` | Espaces strictement égaux |

`space-between` est parfait pour un en-tête : logo à gauche, menu à droite.

## `align-items` : l’axe secondaire

| Valeur | Effet |
|---|---|
| `stretch` | Étire les éléments sur toute la hauteur (défaut) |
| `flex-start` | En haut |
| `flex-end` | En bas |
| `center` | Centrés |
| `baseline` | Alignés sur la ligne de base du texte |

## Centrer parfaitement

```css
.parent {
  display: flex;
  justify-content: center; /* axe principal */
  align-items: center;     /* axe secondaire */
  min-height: 300px;
}
```

Pour voir le centrage vertical, le conteneur doit être **plus haut** que son contenu.

## Aligner un seul élément

- `align-self` sur un enfant remplace `align-items` pour lui seul ;
- `margin-left: auto` sur un enfant **pousse** cet élément (et les suivants) vers la droite : très pratique pour un bouton « Connexion » à droite d’un menu.

> [!TIP] Si `flex-direction: column`, les rôles tournent : `justify-content` agit verticalement et `align-items` horizontalement.', 'justify-content: space-between;
align-items: center;', NULL, NULL, '<header class="entete">
  <strong class="logo">Studio</strong>
  <nav class="liens">
    <a href="#">Projets</a>
    <a href="#">Équipe</a>
  </nav>
  <a class="connexion" href="#">Connexion</a>
</header>
<section class="hero">
  <p class="centre">Je suis parfaitement centré</p>
</section>', '.entete {
  display: flex;
  align-items: center;
  gap: 24px;
  padding: 12px 20px;
  background: #0f172a;
  font-family: system-ui, sans-serif;
}

.entete a, .logo { color: white; text-decoration: none; }
.liens { display: flex; gap: 16px; }

.connexion {
  margin-left: auto;
  padding: 6px 14px;
  border: 1px solid white;
  border-radius: 6px;
}

.hero {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 220px;
  background: #ecfeff;
}

.centre {
  padding: 16px 24px;
  background: white;
  border-radius: 8px;
}', '[["  align-items: center;","Logo, menu et bouton centrés verticalement dans la barre."],[".liens { display: flex; gap: 16px; }","Un conteneur flex peut en contenir un autre."],["  margin-left: auto;","Pousse le bouton de connexion tout à droite."],["  justify-content: center;","Centrage sur l’axe principal (horizontal)…"],["  align-items: center;","…et sur l’axe secondaire (vertical)."],["  min-height: 220px;","Hauteur suffisante pour voir le centrage vertical."]]', '[["justify-content","Alignement sur l’axe principal."],["align-items","Alignement sur l’axe secondaire."],["align-self","Alignement d’un seul élément."],["margin-left: auto","Pousse un élément à l’extrémité."]]', '["Confondre `justify-content` et `align-items`.","Vouloir centrer verticalement dans un conteneur sans hauteur.","Oublier que les axes s’inversent en `column`."]', '["`space-between` pour logo + navigation.","`align-items: center` pour aligner icônes et textes.","`margin-left: auto` pour isoler un élément à droite."]', 'La combinaison `display: flex; align-items: center; gap: …` est probablement la ligne de CSS la plus écrite au monde : bouton avec icône, avatar + nom, logo + titre…', '["`justify-content` = axe principal.","`align-items` = axe secondaire.","Centrer : `justify-content: center` + `align-items: center`.","`margin-left: auto` pousse un élément."]', 'Créez une carte de profil : avatar à gauche, nom et métier à côté (centrés verticalement), bouton « Suivre » poussé à droite.', 1, 2),
(47, 18, 'Flexbox : wrap, flex-grow, flex-shrink et flex-basis', 'flexbox-elements-flexibles', 17, 'Jusqu’ici, les éléments gardaient leur taille. Mais Flexbox porte bien son nom : les éléments peuvent **grandir**, **rétrécir** et **passer à la ligne** pour occuper l’espace intelligemment. C’est ce qui permet de créer des grilles de cartes qui s’adaptent à la largeur de l’écran.', '["Autoriser le retour à la ligne avec `flex-wrap`","Comprendre `flex-grow`, `flex-shrink`, `flex-basis`","Utiliser le raccourci `flex`","Réordonner avec `order`"]', '["Flexbox : aligner et centrer"]', '## `flex-wrap`

Par défaut (`nowrap`), tous les éléments restent sur **une seule ligne**, quitte à rétrécir ou déborder. Avec `flex-wrap: wrap`, ils passent à la ligne quand la place manque.

## Les trois propriétés des éléments

- `flex-basis` : la **taille de départ** de l’élément sur l’axe principal (`200px`, `30%`, `auto`) ;
- `flex-grow` : la part de l’**espace restant** que l’élément peut prendre (`0` = ne grandit pas, `1` = grandit) ;
- `flex-shrink` : la capacité à **rétrécir** quand la place manque (`1` = oui par défaut, `0` = jamais).

Exemple : trois éléments avec `flex-grow: 1` se partagent l’espace libre à parts égales. Si l’un a `flex-grow: 2`, il reçoit deux parts.

## Le raccourci `flex`

```css
.item { flex: 1; }          /* flex: 1 1 0 : grandit, rétrécit, base 0 → parts égales */
.item { flex: 1 1 250px; }  /* base 250px, puis grandit/rétrécit */
.item { flex: none; }       /* taille fixe */
```

## La grille de cartes responsive

```css
.cartes { display: flex; flex-wrap: wrap; gap: 16px; }
.carte  { flex: 1 1 250px; }
```

Chaque carte vise 250px ; il y en a autant que possible par ligne, et elles s’étirent pour remplir la ligne. **Sans aucune media query !**

## `order`

Change l’ordre d’**affichage** d’un élément (défaut `0`). À utiliser avec prudence : l’ordre de lecture au clavier et par les lecteurs d’écran reste celui du HTML.

> [!TIP] Pour une grille à deux dimensions stricte (lignes ET colonnes alignées), CSS Grid est souvent plus adapté. Flexbox excelle pour les alignements sur une dimension.', '.conteneur { display: flex; flex-wrap: wrap; }
.element { flex: 1 1 250px; }', NULL, NULL, '<div class="barre">
  <input class="recherche" type="search" placeholder="Rechercher…" aria-label="Rechercher">
  <button type="button">OK</button>
</div>
<div class="cartes">
  <article class="carte">Carte 1</article>
  <article class="carte">Carte 2</article>
  <article class="carte">Carte 3</article>
  <article class="carte">Carte 4</article>
  <article class="carte">Carte 5</article>
</div>', '.barre {
  display: flex;
  gap: 8px;
  margin-bottom: 16px;
}

.recherche {
  flex: 1;        /* prend toute la place disponible */
  padding: 8px;
}

.cartes {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.carte {
  flex: 1 1 180px;
  padding: 24px;
  border-radius: 12px;
  background: #ddd6fe;
  font-family: system-ui, sans-serif;
  text-align: center;
}', '[["  flex: 1;        /* prend toute la place */","Le champ grandit ; le bouton garde sa taille naturelle."],["  flex-wrap: wrap;","Les cartes passent à la ligne quand la place manque."],["  flex: 1 1 180px;","Base 180px, puis chaque carte grandit pour remplir la ligne."]]', '[["flex-wrap","`nowrap` (défaut), `wrap`."],["flex-grow","Capacité à grandir (proportion de l’espace libre)."],["flex-shrink","Capacité à rétrécir."],["flex-basis","Taille de départ."],["flex","Raccourci grow shrink basis."],["order","Ordre d’affichage."]]', '["Oublier `flex-wrap: wrap` et voir les éléments s’écraser.","Utiliser `order` pour réorganiser tout le contenu (l’ordre de tabulation devient incohérent).","Confondre `flex-basis` et `width` quand les deux sont définis."]', '["`flex: 1` pour l’élément qui doit occuper l’espace restant (champ de recherche).","`flex-wrap` + `flex: 1 1 <base>` pour des grilles souples.","Garder l’ordre HTML logique."]', 'Les barres de recherche (champ extensible + bouton), les pieds de page multi-colonnes et les listes de fonctionnalités qui passent de 3 à 1 colonne sur mobile utilisent exactement ces propriétés.', '["`flex-wrap: wrap` autorise le retour à la ligne.","`flex: grow shrink basis`.","`flex: 1` = occupe l’espace disponible.","`flex: 1 1 250px` + wrap = grille responsive sans media query."]', 'Créez un pied de page avec 4 colonnes (`flex: 1 1 200px`) qui passent sur 2 puis 1 colonne quand l’aperçu rétrécit.', 1, 3),
(48, 19, 'Grid : colonnes, lignes et unité fr', 'grid-les-bases', 16, 'Flexbox aligne sur **une** dimension. **CSS Grid** travaille sur **deux** : lignes ET colonnes à la fois. C’est l’outil idéal pour les galeries, les tableaux de bord et la structure générale d’une page.', '["Créer une grille avec `display: grid`","Définir des colonnes avec `grid-template-columns`","Utiliser l’unité `fr` et `repeat()`","Espacer avec `gap`"]', '["Flexbox"]', '## Créer une grille

```css
.galerie {
  display: grid;
  grid-template-columns: 200px 200px 200px;
  gap: 16px;
}
```

Les enfants directs se placent automatiquement dans les cases, de gauche à droite, puis ligne suivante.

## L’unité `fr`

`fr` (*fraction*) partage l’**espace disponible** :

```css
grid-template-columns: 1fr 1fr 1fr;  /* 3 colonnes égales */
grid-template-columns: 2fr 1fr;      /* la 1re colonne est deux fois plus large */
grid-template-columns: 250px 1fr;    /* barre latérale fixe + contenu flexible */
```

## `repeat()`

```css
grid-template-columns: repeat(4, 1fr); /* = 1fr 1fr 1fr 1fr */
```

## Les lignes

- `grid-template-rows` définit la hauteur des lignes : `grid-template-rows: auto 1fr auto;` ;
- les lignes supplémentaires créées automatiquement suivent `grid-auto-rows`.

## `gap`

Comme en Flexbox : `gap: 16px;` ou `row-gap` / `column-gap`.

## Aligner le contenu des cases

- `justify-items` / `align-items` : alignement du contenu dans chaque case ;
- `place-items: center;` : raccourci pour centrer sur les deux axes.

> [!INFO] Flexbox ou Grid ? Flexbox : le **contenu** dicte la taille (une ligne d’éléments de tailles variables). Grid : la **structure** dicte la place (des colonnes alignées). On les combine souvent : Grid pour la page, Flexbox dans les composants.', '.grille {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}', NULL, NULL, '<div class="tableau">
  <div class="tuile">Visiteurs<br><strong>12 480</strong></div>
  <div class="tuile">Inscriptions<br><strong>342</strong></div>
  <div class="tuile">Ventes<br><strong>58</strong></div>
  <div class="tuile large">Graphique d’activité</div>
  <div class="tuile">Tâches</div>
</div>', '.tableau {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-auto-rows: minmax(90px, auto);
  gap: 12px;
  font-family: system-ui, sans-serif;
}

.tuile {
  padding: 16px;
  border-radius: 12px;
  background: #e0e7ff;
}

.large {
  grid-column: span 2;
  background: #c7d2fe;
}', '[["  display: grid;","Le conteneur devient une grille."],["  grid-template-columns: repeat(3, 1fr);","Trois colonnes de largeur égale."],["  grid-auto-rows: minmax(90px, auto);","Chaque ligne mesure au moins 90px et grandit si nécessaire."],["  gap: 12px;","Espace entre lignes et colonnes."],["  grid-column: span 2;","Cette tuile occupe deux colonnes (détaillé à la leçon suivante)."]]', '[["display: grid","Crée une grille."],["grid-template-columns","Définit les colonnes."],["grid-template-rows / grid-auto-rows","Définit les lignes."],["fr","Fraction de l’espace disponible."],["repeat(n, taille)","Répète une définition de piste."],["gap","Espacement entre les cases."]]', '["Écrire `grid-template-columns: 3;` (il faut définir chaque colonne ou utiliser `repeat`).","Utiliser des `%` et `gap` ensemble et déborder (préférez `fr`).","Appliquer `display: grid` aux enfants au lieu du parent."]', '["`fr` plutôt que `%` pour partager l’espace.","`repeat()` pour les colonnes identiques.","Grid pour la structure, Flexbox pour les alignements internes."]', 'Les tableaux de bord (comme l’espace administrateur de cette plateforme) sont construits avec Grid : une grille de 12 colonnes dans laquelle chaque carte occupe 4, 6 ou 12 colonnes.', '["`display: grid` + `grid-template-columns`.","`fr` partage l’espace disponible.","`repeat(3, 1fr)` = 3 colonnes égales.","`gap` espace les cases."]', 'Créez une mise en page « barre latérale de 240px + contenu flexible » avec Grid.', 1, 1),
(49, 19, 'Grid : placement et zones nommées', 'grid-placement-et-zones', 16, 'Un en-tête sur toute la largeur, une barre latérale à gauche, le contenu au centre, un pied de page en bas : avec `grid-template-areas`, vous **dessinez** cette structure directement dans le CSS, avec des mots.', '["Placer un élément avec `grid-column` et `grid-row`","Faire couvrir plusieurs cases avec `span`","Nommer des zones avec `grid-template-areas`"]', '["Grid : colonnes, lignes et unité fr"]', '## Les lignes de grille

Une grille de 3 colonnes possède **4 lignes verticales**, numérotées de 1 à 4. On place un élément en indiquant ses lignes de début et de fin :

```css
.titre { grid-column: 1 / 4; }  /* de la ligne 1 à la ligne 4 : toute la largeur */
.titre { grid-column: 1 / -1; } /* -1 = dernière ligne, quelle que soit la grille */
```

## `span`

```css
.grande { grid-column: span 2; } /* couvre 2 colonnes */
.haute  { grid-row: span 2; }    /* couvre 2 lignes */
```

## Les zones nommées

On dessine la mise en page dans le conteneur :

```css
.page {
  display: grid;
  grid-template-columns: 220px 1fr;
  grid-template-areas:
    "entete entete"
    "menu   contenu"
    "pied   pied";
}
```

Puis on affecte chaque enfant à sa zone :

```css
.entete  { grid-area: entete; }
.menu    { grid-area: menu; }
.contenu { grid-area: contenu; }
.pied    { grid-area: pied; }
```

Chaque chaîne de caractères représente une **ligne** ; chaque mot, une **colonne**. Un point `.` représente une case vide. Les zones doivent être **rectangulaires**.

> [!TIP] Pour une version mobile, il suffit de redéfinir `grid-template-areas` dans une media query (une seule colonne) : le HTML ne change pas.', 'grid-template-areas:
  "entete entete"
  "menu contenu";
.entete { grid-area: entete; }', NULL, NULL, '<div class="page">
  <header class="entete">En-tête</header>
  <nav class="menu">Menu</nav>
  <main class="contenu">Contenu principal</main>
  <aside class="pub">Encart</aside>
  <footer class="pied">Pied de page</footer>
</div>', '.page {
  display: grid;
  grid-template-columns: 140px 1fr 140px;
  grid-template-rows: auto 1fr auto;
  grid-template-areas:
    "entete  entete  entete"
    "menu    contenu pub"
    "pied    pied    pied";
  gap: 8px;
  min-height: 320px;
  font-family: system-ui, sans-serif;
}

.page > * { padding: 12px; border-radius: 8px; }
.entete  { grid-area: entete;  background: #fde68a; }
.menu    { grid-area: menu;    background: #bfdbfe; }
.contenu { grid-area: contenu; background: #e2e8f0; }
.pub     { grid-area: pub;     background: #fbcfe8; }
.pied    { grid-area: pied;    background: #bbf7d0; }', '[["  grid-template-columns: 140px 1fr 140px;","Deux colonnes latérales fixes, une centrale flexible."],["  grid-template-rows: auto 1fr auto;","L’en-tête et le pied s’adaptent au contenu, le milieu prend le reste."],["    \\"entete  entete  entete\\"","Première ligne : l’en-tête couvre les trois colonnes."],["    \\"menu    contenu pub\\"","Deuxième ligne : trois zones distinctes."],[".entete  { grid-area: entete; … }","L’élément est affecté à sa zone nommée."]]', '[["grid-column / grid-row","Lignes de début / fin : `1 / 3`, `span 2`."],["grid-template-areas","Dessin des zones de la grille."],["grid-area","Zone occupée par un élément."],["-1","Dernière ligne de grille."]]', '["Des zones non rectangulaires (en L) : la déclaration est ignorée.","Un nombre de colonnes différent d’une chaîne à l’autre.","Oublier les guillemets dans `grid-template-areas`.","Des fautes de frappe entre le nom dans les zones et dans `grid-area`."]', '["Des noms de zones explicites.","Aligner visuellement les chaînes dans le code.","Redéfinir les zones dans les media queries pour le responsive."]', 'La structure « en-tête / menu latéral / contenu / pied » des applications web et des sites de documentation se code en quelques lignes avec `grid-template-areas`, et devient une colonne unique sur mobile en redéfinissant uniquement les zones.', '["`grid-column: 1 / -1` : toute la largeur.","`span n` : couvrir plusieurs cases.","`grid-template-areas` dessine la page, `grid-area` place les éléments."]', 'Réalisez une page magazine : un grand article occupant 2 colonnes et 2 lignes, entouré de 4 petits articles.', 1, 2),
(50, 19, 'Grilles adaptatives : auto-fit et minmax', 'grid-adaptative', 14, 'Voici l’une des lignes de CSS les plus puissantes jamais écrites : une grille qui passe toute seule de 4 colonnes sur grand écran à 1 colonne sur téléphone, **sans aucune media query**. Elle combine `repeat()`, `auto-fit` et `minmax()`.', '["Comprendre `minmax()`","Utiliser `auto-fit` et `auto-fill`","Créer une grille responsive sans media query"]', '["Grid : placement et zones nommées"]', '## `minmax(min, max)`

Définit une taille **comprise entre** un minimum et un maximum :

```css
grid-template-columns: minmax(200px, 1fr) 2fr;
```

La première colonne ne descend jamais sous 200px, mais peut grandir jusqu’à 1fr.

## `auto-fit` : autant de colonnes que possible

```css
.cartes {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px;
}
```

Lecture : « crée **autant de colonnes que possible**, chacune d’au moins **220px**, puis étire-les pour **remplir** la ligne ».

- sur 1000px : 4 colonnes ;
- sur 600px : 2 colonnes ;
- sur 360px : 1 colonne.

## `auto-fit` ou `auto-fill` ?

Les deux créent le maximum de colonnes. La différence apparaît quand il y a **peu d’éléments** :

- `auto-fit` : les colonnes vides sont **supprimées**, les éléments s’étirent pour remplir la ligne ;
- `auto-fill` : les colonnes vides sont **conservées**, les éléments gardent leur largeur.

## Éviter le débordement sur très petit écran

Si l’écran est plus étroit que le minimum (220px), la grille déborde. Astuce robuste :

```css
grid-template-columns: repeat(auto-fit, minmax(min(100%, 220px), 1fr));
```

`min(100%, 220px)` prend la plus petite des deux valeurs. C’est la technique utilisée sur cette plateforme pour ses grilles de cartes.', 'grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));', NULL, NULL, '<section class="cartes">
  <article class="carte"><h3>HTML</h3><p>Structure</p></article>
  <article class="carte"><h3>CSS</h3><p>Style</p></article>
  <article class="carte"><h3>Flexbox</h3><p>Alignement</p></article>
  <article class="carte"><h3>Grid</h3><p>Mise en page</p></article>
  <article class="carte"><h3>Responsive</h3><p>Adaptation</p></article>
</section>', '.cartes {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(100%, 160px), 1fr));
  gap: 12px;
  font-family: system-ui, sans-serif;
}

.carte {
  padding: 16px;
  border-radius: 12px;
  background: #0f172a;
  color: white;
}

.carte h3 { margin: 0 0 4px; }
.carte p { margin: 0; color: #94a3b8; }', '[["  grid-template-columns: repeat(auto-fit, …);","Autant de colonnes que la largeur le permet."],["minmax(min(100%, 160px), 1fr)","Chaque colonne : au moins 160px (ou 100 % si l’écran est plus petit), au plus 1fr."],["  gap: 12px;","Espacement constant quel que soit le nombre de colonnes."]]', '[["minmax(min, max)","Taille bornée."],["auto-fit","Crée le maximum de colonnes, supprime les vides."],["auto-fill","Crée le maximum de colonnes, garde les vides."],["min() / max()","Plus petite / plus grande de plusieurs valeurs."]]', '["Écrire `repeat(auto-fit, 1fr)` sans taille minimale (une seule colonne).","Un minimum trop grand qui provoque un débordement sur mobile.","Confondre `auto-fit` et `auto-fill` quand il y a peu d’éléments."]', '["La formule `repeat(auto-fit, minmax(min(100%, X), 1fr))` pour les grilles de cartes.","Choisir le minimum selon le contenu (lisibilité d’une carte)."]', 'Les grilles de produits, d’articles de blog ou de membres d’équipe utilisent cette formule : le contenu s’adapte à tous les écrans sans écrire une seule media query.', '["`minmax()` borne une taille.","`repeat(auto-fit, minmax(220px, 1fr))` = grille responsive automatique.","`min(100%, 220px)` évite le débordement."]', 'Créez une galerie de 12 images qui affiche 6 colonnes sur grand écran et 2 sur mobile, uniquement avec `auto-fit`.', 1, 3);

INSERT INTO `lessons` (`id`, `module_id`, `title`, `slug`, `duration_minutes`, `introduction`, `objectives`, `prerequisites`, `theory`, `syntax_code`, `simple_html`, `simple_css`, `example_html`, `example_css`, `line_by_line`, `reference_items`, `common_mistakes`, `best_practices`, `practical`, `summary_points`, `challenge`, `is_published`, `sort_order`) VALUES
(51, 20, 'Les pseudo-classes', 'pseudo-classes', 16, 'Un bouton qui change de couleur au survol, un champ qui s’entoure de bleu quand on clique dedans, une ligne de tableau sur deux en gris : ces effets reposent sur les **pseudo-classes**. Elles ciblent un élément selon son **état** ou sa **position**, sans rien ajouter au HTML.', '["Styler les états `:hover`, `:focus`, `:active`, `:visited`","Rendre le focus clavier visible avec `:focus-visible`","Cibler par position avec `:first-child`, `:nth-child()`","Découvrir `:not()` et les états de formulaire"]', '["Cascade, spécificité et héritage","Les formulaires"]', '## Syntaxe

Une pseudo-classe s’écrit avec **un seul deux-points**, collée au sélecteur :

```css
a:hover { color: crimson; }
```

## Les états d’interaction

| Pseudo-classe | Quand ? |
|---|---|
| `:hover` | La souris survole l’élément |
| `:focus` | L’élément a le focus (clic dans un champ, touche Tab) |
| `:focus-visible` | Focus obtenu au clavier (idéal pour les contours) |
| `:active` | Pendant le clic |
| `:visited` | Lien déjà visité |

Ordre recommandé pour les liens : `:link`, `:visited`, `:hover`, `:active` (moyen mnémotechnique : **LoVe HAte**).

## Le focus : un enjeu d’accessibilité

Les personnes qui naviguent au clavier voient **où** elles se trouvent grâce au contour de focus. Ne le supprimez **jamais** sans le remplacer :

```css
/* ❌ */ button:focus { outline: none; }
/* ✅ */ button:focus-visible { outline: 3px solid #2563eb; outline-offset: 2px; }
```

> [!INFO] Sur mobile, il n’y a pas de survol : n’enfermez jamais une information importante dans un `:hover`.

## Les pseudo-classes structurelles

| Sélecteur | Cible |
|---|---|
| `:first-child` / `:last-child` | Premier / dernier enfant |
| `:nth-child(2)` | Le 2e enfant |
| `:nth-child(odd)` / `(even)` | Enfants impairs / pairs |
| `:nth-child(3n)` | Un enfant sur trois |
| `:not(.actif)` | Tout sauf ce qui correspond |

```css
tr:nth-child(even) { background: #f8fafc; }  /* tableau zébré */
li:not(:last-child) { border-bottom: 1px solid #e5e7eb; }
```

## États de formulaire

`:checked` (case cochée), `:disabled`, `:required`, `:invalid`, `:placeholder-shown`…

```css
input:invalid:not(:placeholder-shown) { border-color: crimson; }
```', 'a:hover { … }
button:focus-visible { … }
li:nth-child(odd) { … }
li:not(:last-child) { … }', NULL, NULL, '<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#" class="actif">Cours</a>
  <a href="#">Contact</a>
</nav>
<ul class="liste">
  <li>Ligne 1</li>
  <li>Ligne 2</li>
  <li>Ligne 3</li>
  <li>Ligne 4</li>
</ul>
<button class="btn" type="button">Survolez et tabulez</button>', 'body { font-family: system-ui, sans-serif; }

.menu a {
  padding: 6px 10px;
  color: #334155;
  text-decoration: none;
  border-radius: 6px;
}

.menu a:hover { background: #e2e8f0; }
.menu a.actif { background: #1e293b; color: white; }

.liste { list-style: none; padding: 0; max-width: 240px; }
.liste li { padding: 8px; }
.liste li:nth-child(even) { background: #f1f5f9; }
.liste li:not(:last-child) { border-bottom: 1px solid #e2e8f0; }

.btn {
  padding: 10px 18px;
  border: 0;
  border-radius: 8px;
  background: #2563eb;
  color: white;
}

.btn:hover { background: #1d4ed8; }
.btn:active { transform: scale(0.97); }
.btn:focus-visible { outline: 3px solid #f59e0b; outline-offset: 3px; }', '[[".menu a:hover { background: #e2e8f0; }","Fond gris au survol."],[".liste li:nth-child(even)","Une ligne sur deux (les paires) : liste zébrée."],[".liste li:not(:last-child)","Une bordure sous chaque ligne sauf la dernière."],[".btn:active { transform: scale(0.97); }","Légère compression pendant le clic : retour tactile."],[".btn:focus-visible { outline: … }","Contour bien visible pour la navigation au clavier."]]', '[[":hover / :active","Survol / clic."],[":focus / :focus-visible","Focus / focus clavier."],[":first-child / :last-child","Premier / dernier enfant."],[":nth-child(n)","Enfant selon une formule."],[":not(sélecteur)","Négation."],[":checked / :disabled / :invalid","États de formulaire."]]', '["Supprimer le contour de focus (`outline: none`) sans alternative.","Mettre un espace avant les deux-points : `a :hover` cible les descendants survolés.","Réserver une information au survol (inaccessible au tactile).","Confondre `:nth-child` (tous types) et `:nth-of-type` (même type)."]', '["Un style `:focus-visible` pour chaque élément interactif.","Des états `:hover` et `:active` pour les boutons.","`:not(:last-child)` plutôt que d’annuler une bordure après coup."]', 'Sur cette plateforme, les liens de navigation changent de fond au survol, les options de quiz s’encadrent quand elles sont cochées (`:has(input:checked)`) et tous les éléments interactifs ont un contour de focus menthe.', '["Pseudo-classe = un `:`, cible un état ou une position.","`:hover`, `:focus-visible`, `:active` pour l’interaction.","`:nth-child()`, `:first-child`, `:not()` pour la structure.","Ne jamais supprimer le focus sans le remplacer."]', 'Créez un tableau zébré dont la ligne survolée se surligne, et un bouton avec des états hover, active et focus-visible distincts.', 1, 1),
(52, 20, 'Les pseudo-éléments ::before et ::after', 'pseudo-elements', 14, 'Ajouter une icône avant chaque lien externe, des guillemets décoratifs autour d’une citation, un soulignement animé sous un menu… sans toucher au HTML. Les **pseudo-éléments** créent des éléments virtuels que seul le CSS connaît.', '["Créer du contenu avec `::before` et `::after`","Comprendre la propriété `content`","Styler `::first-letter`, `::first-line`, `::placeholder`, `::selection`","Connaître les limites d’accessibilité"]', '["Les pseudo-classes"]', '## Syntaxe

Un pseudo-élément s’écrit avec **deux deux-points** :

```css
.lien-externe::after {
  content: " ↗";
}
```

- `::before` insère un élément virtuel **au début** du contenu de l’élément ;
- `::after` l’insère **à la fin**.

## `content` est obligatoire

Sans la propriété `content`, le pseudo-élément n’existe pas. Pour un élément purement décoratif (forme, ligne), on utilise une chaîne vide :

```css
.titre::after {
  content: "";
  display: block;
  width: 60px;
  height: 4px;
  background: #6366f1;
}
```

`content` peut aussi afficher la valeur d’un attribut : `content: attr(data-label);`.

## Pseudo-éléments typographiques

| Pseudo-élément | Cible |
|---|---|
| `::first-letter` | Première lettre (lettrine) |
| `::first-line` | Première ligne |
| `::placeholder` | Texte d’exemple d’un champ |
| `::selection` | Texte sélectionné par l’utilisateur |
| `::marker` | Puce ou numéro d’une liste |

## Accessibilité

Le contenu généré par CSS n’est pas sélectionnable et il est **inconstamment lu** par les lecteurs d’écran. Règle : les pseudo-éléments servent à la **décoration**. Une information importante doit figurer dans le HTML.

> [!TIP] Le célèbre effet « soulignement animé au survol » : un `::after` de largeur 0 qui passe à 100 % avec une transition (vous saurez l’animer au niveau 3).', '.el::before { content: "…"; }
.el::after { content: ""; display: block; }', NULL, NULL, '<h2 class="titre">Nos valeurs</h2>
<p class="intro">Liberté, curiosité et partage guident chacun de nos projets depuis dix ans.</p>
<blockquote class="citation">Le design est l’âme de chaque création humaine.</blockquote>
<p><a class="externe" href="https://developer.mozilla.org">Documentation MDN</a></p>', 'body { font-family: Georgia, serif; }

.titre::after {
  content: "";
  display: block;
  width: 60px;
  height: 4px;
  margin-top: 8px;
  border-radius: 2px;
  background: #6366f1;
}

.intro::first-letter {
  float: left;
  font-size: 3em;
  line-height: 1;
  margin-right: 6px;
  color: #6366f1;
}

.citation {
  position: relative;
  padding-left: 32px;
  font-style: italic;
}

.citation::before {
  content: "“";
  position: absolute;
  left: 0;
  top: -12px;
  font-size: 3em;
  color: #a5b4fc;
}

.externe::after {
  content: " ↗";
}

::selection {
  background: #fde68a;
}', '[[".titre::after { content: \\"\\"; display: block; … }","Une barre décorative sous le titre, sans HTML supplémentaire."],[".intro::first-letter { float: left; font-size: 3em; }","Lettrine façon magazine."],[".citation::before { content: \\"“\\"; position: absolute; }","Guillemet décoratif positionné par rapport à la citation."],[".externe::after { content: \\" ↗\\"; }","Flèche ajoutée après le texte du lien."],["::selection { background: #fde68a; }","Couleur du texte sélectionné."]]', '[["::before / ::after","Contenu généré au début / à la fin."],["content","Obligatoire : texte, `\\"\\"`, `attr()`."],["::first-letter / ::first-line","Première lettre / ligne."],["::placeholder","Texte d’exemple des champs."],["::selection","Sélection de l’utilisateur."],["::marker","Puces et numéros de liste."]]', '["Oublier `content` : rien ne s’affiche.","Utiliser `::before` sur un `<img>` ou un `<input>` (éléments sans contenu : ça ne fonctionne pas).","Placer une information essentielle dans `content`.","Confondre `:` (pseudo-classe) et `::` (pseudo-élément)."]', '["Pseudo-éléments pour la décoration uniquement.","`content: \\"\\"` + `display: block` pour les formes.","Parent en `position: relative` pour positionner un pseudo-élément."]', 'Les petites flèches des menus déroulants, les icônes « lien externe », les lignes décoratives sous les titres de section et les bulles de dialogue (triangle en `::after`) sont presque toujours des pseudo-éléments.', '["`::before` / `::after` + `content` créent des éléments virtuels.","`content: \\"\\"` pour une forme décorative.","Typographie : `::first-letter`, `::selection`, `::placeholder`.","Décoration uniquement : l’information va dans le HTML."]', 'Créez une bulle de dialogue avec un petit triangle en bas à gauche réalisé avec `::after` et des bordures.', 1, 2),
(53, 21, 'Pourquoi le HTML sémantique ?', 'pourquoi-la-semantique', 12, 'Deux pages peuvent avoir exactement le même rendu à l’écran, l’une construite avec des dizaines de `<div>`, l’autre avec des balises sémantiques. Pour un humain qui regarde, aucune différence. Pour un moteur de recherche, un lecteur d’écran ou un développeur qui reprend le code, c’est le jour et la nuit.', '["Comprendre ce qu’est la sémantique","Mesurer ses bénéfices : accessibilité, SEO, maintenance","Repérer une « soupe de div »"]', '["Attributs globaux, div et span"]', '## Qu’est-ce que la sémantique ?

La **sémantique**, c’est le **sens**. Une balise sémantique décrit la **nature** de son contenu : `<nav>` dit « ceci est une navigation », `<article>` dit « ceci est un contenu autonome ». Un `<div>`, lui, ne dit rien.

## Comparaison

```html
<!-- Non sémantique -->
<div class="header">
  <div class="menu">…</div>
</div>
<div class="content">…</div>
<div class="footer">…</div>
```

```html
<!-- Sémantique -->
<header>
  <nav>…</nav>
</header>
<main>…</main>
<footer>…</footer>
```

## Les bénéfices

### 1. Accessibilité

Les lecteurs d’écran créent des **repères** (*landmarks*) à partir de ces balises. L’utilisateur peut sauter directement au contenu principal ou à la navigation, au lieu d’écouter toute la page.

### 2. Référencement (SEO)

Les moteurs de recherche comprennent mieux quelle partie est le contenu principal, quelle partie est une navigation répétée sur chaque page, quel bloc est un article.

### 3. Maintenance

Le code se lit comme un plan. Un collègue comprend la structure en quelques secondes.

### 4. Fonctionnalités gratuites

Le mode lecture des navigateurs, les extensions, les assistants vocaux exploitent cette structure.

## Les balises de structure

| Balise | Rôle |
|---|---|
| `<header>` | En-tête (de la page ou d’une section) |
| `<nav>` | Bloc de navigation principal |
| `<main>` | Contenu principal (un seul par page) |
| `<section>` | Section thématique avec un titre |
| `<article>` | Contenu autonome (article, carte produit, commentaire) |
| `<aside>` | Contenu complémentaire (encadré, barre latérale) |
| `<footer>` | Pied (de la page ou d’une section) |

> [!TIP] Désactivez le CSS d’une page (dans Firefox : Affichage > Style de page > Aucun style). Une page sémantique reste parfaitement compréhensible.', '<header>…</header>
<nav>…</nav>
<main>…</main>
<footer>…</footer>', NULL, NULL, '<header>
  <p><strong>Le Petit Journal</strong></p>
  <nav>
    <a href="#">Accueil</a> · <a href="#">Sports</a> · <a href="#">Culture</a>
  </nav>
</header>
<main>
  <article>
    <h1>Un nouveau musée ouvre ses portes</h1>
    <p>Le musée d’art moderne accueille ses premiers visiteurs ce week-end.</p>
  </article>
  <aside>
    <h2>À lire aussi</h2>
    <p>Les expositions à ne pas manquer cet été.</p>
  </aside>
</main>
<footer>
  <p>© Le Petit Journal</p>
</footer>', NULL, '[["<header>","En-tête du site : logo, navigation."],["<nav>","Navigation principale : un repère pour les lecteurs d’écran."],["<main>","Le contenu principal, unique dans la page."],["<article>","Un contenu autonome : l’article de presse."],["<aside>","Contenu lié mais secondaire."],["<footer>","Pied de page : mentions, copyright."]]', '[["<header>","En-tête."],["<nav>","Navigation."],["<main>","Contenu principal."],["<footer>","Pied."]]', '["Construire toute la page avec des `<div class=\\"header\\">`, `<div class=\\"nav\\">`…","Choisir une balise sémantique pour son apparence (elle n’en a aucune par défaut).","Penser que la sémantique est « optionnelle » parce que l’écran ne change pas."]', '["Commencer par la structure sémantique, styler ensuite.","Réserver `<div>` au regroupement purement visuel.","Vérifier la structure avec l’arbre d’accessibilité des outils de développement."]', 'Les audits d’accessibilité (obligatoires pour de nombreux sites publics et, depuis 2025, pour beaucoup d’entreprises en Europe) vérifient la présence des repères `header`, `nav`, `main` et `footer`.', '["Sémantique = sens du contenu.","Bénéfices : accessibilité, SEO, maintenance.","Remplacez les div de structure par header, nav, main, footer…"]', 'Prenez une page de votre choix, affichez son code source et comptez les balises sémantiques. Pourriez-vous en ajouter ?', 1, 1),
(54, 21, 'header, nav, main et footer', 'header-nav-main-footer', 13, 'Ces quatre balises forment le **squelette** de presque toutes les pages web. Chacune a des règles d’usage précises : combien peut-il y en avoir ? où les placer ? que peuvent-elles contenir ?', '["Utiliser correctement header, nav, main et footer","Connaître leurs règles (nombre, emplacement)","Ajouter un lien d’évitement vers le contenu"]', '["Pourquoi le HTML sémantique ?"]', '## `<header>`

Contenu d’introduction : logo, titre du site, navigation, recherche. Il peut y en avoir **plusieurs** : un pour la page, un en haut d’un `<article>` (titre, auteur, date).

## `<nav>`

Réservé aux **blocs de navigation majeurs** : menu principal, fil d’Ariane, sommaire, pagination. Les liens isolés dans un paragraphe n’ont pas besoin de `<nav>`.

Si une page contient plusieurs `<nav>`, distinguez-les avec `aria-label` :

```html
<nav aria-label="Navigation principale">…</nav>
<nav aria-label="Fil d’Ariane">…</nav>
```

## `<main>`

Le **contenu principal et unique** de la page — ce qui la différencie des autres pages du site.

- **un seul** `<main>` visible par page ;
- il ne doit pas être placé dans `<header>`, `<nav>`, `<article>`, `<aside>` ou `<footer>`.

## `<footer>`

Informations de fin : copyright, liens légaux, contact, réseaux sociaux. Comme `<header>`, il peut aussi terminer un `<article>` ou une `<section>`.

## Le lien d’évitement

Les utilisateurs du clavier doivent traverser tout le menu avant d’atteindre le contenu. Un lien d’évitement, visible au focus, leur permet de sauter directement au `<main>` :

```html
<a class="skip-link" href="#contenu">Aller au contenu</a>
…
<main id="contenu">…</main>
```

Cette plateforme en possède un : appuyez sur `Tab` en arrivant sur une page.', '<header><nav aria-label="…">…</nav></header>
<main id="contenu">…</main>
<footer>…</footer>', NULL, NULL, '<a class="skip" href="#contenu">Aller au contenu</a>
<header class="site">
  <strong>Atelier Bois</strong>
  <nav aria-label="Navigation principale">
    <ul>
      <li><a href="#">Accueil</a></li>
      <li><a href="#">Créations</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>
</header>
<main id="contenu">
  <h1>Meubles artisanaux en chêne massif</h1>
  <p>Chaque pièce est fabriquée à la main dans notre atelier.</p>
</main>
<footer class="site">
  <p>© Atelier Bois — <a href="#">Mentions légales</a></p>
</footer>', 'body { margin: 0; font-family: system-ui, sans-serif; }
.skip { position: absolute; left: -999px; }
.skip:focus { left: 8px; top: 8px; background: #fde68a; padding: 8px; }
header.site { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; background: #78350f; color: white; }
header.site ul { display: flex; gap: 16px; list-style: none; margin: 0; padding: 0; }
header.site a { color: white; }
main { padding: 20px; }
footer.site { padding: 12px 20px; background: #fef3c7; }', '[["<a class=\\"skip\\" href=\\"#contenu\\">","Lien d’évitement, masqué jusqu’à ce qu’il reçoive le focus."],["<nav aria-label=\\"Navigation principale\\">","Navigation nommée pour les lecteurs d’écran."],["<ul>","Les liens de navigation forment une liste."],["<main id=\\"contenu\\">","Contenu principal, cible du lien d’évitement."],["<footer class=\\"site\\">","Pied de page du site."]]', '[["<header>","Introduction (plusieurs possibles)."],["<nav aria-label>","Navigation majeure, nommée si plusieurs."],["<main>","Contenu principal, un seul."],["<footer>","Pied (plusieurs possibles)."]]', '["Plusieurs `<main>` dans la page.","Mettre `<main>` à l’intérieur de `<header>` ou `<article>`.","Entourer chaque petit groupe de liens d’un `<nav>`.","Plusieurs `<nav>` sans `aria-label`."]', '["Un lien d’évitement vers `<main>`.","Nommer les `<nav>` multiples.","Menu principal en liste `<ul>`."]', 'Les frameworks de sites (WordPress, gabarits Laravel…) génèrent presque toujours ce squelette : un `header` et un `footer` communs à toutes les pages, et un `main` dont le contenu change.', '["`header`/`footer` : plusieurs possibles.","`nav` : navigations majeures, nommées si multiples.","`main` : unique, contenu principal.","Lien d’évitement vers `main`."]', 'Ajoutez à une page un fil d’Ariane dans un second `<nav aria-label="Fil d’Ariane">` contenant une liste ordonnée.', 1, 2),
(55, 21, 'section, article et aside', 'section-article-aside', 14, '`<section>` ou `<article>` ? C’est une des questions les plus débattues du HTML. La règle est pourtant simple : un article a du sens **tout seul**, une section est une **partie** d’un tout. Et `<aside>` accueille ce qui est lié, mais secondaire.', '["Choisir entre `<section>` et `<article>`","Utiliser `<aside>` à bon escient","Savoir quand un `<div>` reste le bon choix"]', '["header, nav, main et footer"]', '## `<article>` : un contenu autonome

Question à se poser : **ce contenu aurait-il du sens s’il était publié seul**, ailleurs (flux RSS, partage) ?

Exemples : article de blog, fiche produit dans une liste, commentaire, carte d’un événement, message d’un forum.

## `<section>` : une partie thématique

Un regroupement **thématique** d’une page, qui a en général **un titre** (`<h2>`, `<h3>`) :

```html
<main>
  <section>
    <h2>Nos services</h2>…
  </section>
  <section>
    <h2>Témoignages</h2>…
  </section>
</main>
```

Si vous ne pouvez pas donner de titre à votre section, c’est probablement un `<div>`.

## Imbrication

Les deux s’imbriquent librement : une `<section>` « Derniers articles » contient plusieurs `<article>` ; un long `<article>` peut être découpé en `<section>`.

## `<aside>` : le contenu complémentaire

Contenu **lié** au contenu principal mais **pas indispensable** à sa compréhension : encadré « Le saviez-vous ? », biographie de l’auteur, liens connexes, publicité, barre latérale.

## L’arbre de décision

1. Le contenu est-il autonome ? → `<article>`
2. Est-il secondaire / annexe ? → `<aside>`
3. Est-ce une partie thématique avec un titre ? → `<section>`
4. Sinon (regroupement visuel) → `<div>`', '<section><h2>…</h2> <article>…</article> </section>
<aside>…</aside>', NULL, NULL, '<main>
  <section>
    <h2>Derniers articles</h2>
    <article>
      <h3>Débuter en photographie</h3>
      <p>Les réglages essentiels pour vos premières photos.</p>
    </article>
    <article>
      <h3>La règle des tiers</h3>
      <p>Composer une image équilibrée en un coup d’œil.</p>
    </article>
  </section>
  <aside>
    <h2>Le saviez-vous ?</h2>
    <p>La première photographie date de 1826.</p>
  </aside>
</main>', NULL, '[["<section>","Partie thématique de la page, avec son titre."],["<h2>Derniers articles</h2>","Le titre qui justifie la section."],["<article>","Chaque résumé est autonome : il pourrait être partagé seul."],["<aside>","Anecdote liée au thème mais non indispensable."]]', '[["<article>","Contenu autonome."],["<section>","Partie thématique, avec un titre."],["<aside>","Contenu complémentaire."]]', '["Remplacer tous les `<div>` par des `<section>`.","Une `<section>` sans titre.","Placer le contenu principal dans `<aside>`."]', '["Une section = un titre.","Un article = compréhensible seul.","Garder `<div>` pour la mise en page pure."]', 'Sur une page d’accueil de site vitrine, chaque bloc (« Services », « Réalisations », « Contact ») est une `<section>` avec son `<h2>` ; les cartes de réalisations à l’intérieur sont des `<article>`.', '["`<article>` : autonome.","`<section>` : partie thématique avec titre.","`<aside>` : complémentaire.","Aucun des trois ? `<div>`."]', 'Structurez la page d’un restaurant : sections « La carte » (plats en articles), « Horaires », « Avis clients » (avis en articles), et un aside « Offre du jour ».', 1, 3),
(56, 22, 'Les éléments audio et video', 'audio-et-video', 15, 'Avant HTML5, lire une vidéo sur le Web nécessitait un plugin (Flash). Aujourd’hui, `<audio>` et `<video>` sont natifs : lecteur intégré, contrôles clavier, sous-titres. Il reste à les utiliser **avec respect** pour les visiteurs : pas de son qui démarre tout seul, des sous-titres, un poids maîtrisé.', '["Intégrer un son avec `<audio>`","Intégrer une vidéo avec `<video>`","Proposer plusieurs formats avec `<source>`","Ajouter des sous-titres avec `<track>`"]', '["Les images"]', '## `<audio>`

```html
<audio controls src="podcast.mp3">
  Votre navigateur ne lit pas l’audio. <a href="podcast.mp3">Télécharger le fichier</a>.
</audio>
```

L’attribut `controls` affiche le lecteur (lecture, volume, progression). Sans lui, rien n’est visible !

## `<video>`

```html
<video controls width="640" poster="miniature.jpg">
  <source src="film.webm" type="video/webm">
  <source src="film.mp4" type="video/mp4">
  <track src="sous-titres-fr.vtt" kind="captions" srclang="fr" label="Français" default>
  Votre navigateur ne lit pas la vidéo.
</video>
```

| Attribut | Rôle |
|---|---|
| `controls` | Affiche les contrôles |
| `poster` | Image affichée avant la lecture |
| `autoplay` | Lecture automatique (bloquée par les navigateurs si le son est actif) |
| `muted` | Son coupé |
| `loop` | Lecture en boucle |
| `playsinline` | Lecture dans la page sur iPhone |
| `preload` | `none`, `metadata`, `auto` : ce qui est préchargé |

## Plusieurs formats : `<source>`

Le navigateur lit le **premier** format qu’il supporte. MP4 (H.264) est universel ; WebM est plus léger.

## Sous-titres : `<track>`

Fichier au format **WebVTT** (`.vtt`) :

```text
WEBVTT

00:00:01.000 --> 00:00:04.000
Bienvenue dans ce tutoriel.
```

`kind="captions"` : sous-titres pour personnes sourdes (incluant les sons) ; `kind="subtitles"` : traduction.

## Bonnes pratiques d’usage

- **Jamais de son en lecture automatique** : c’est intrusif et déroutant pour les utilisateurs de lecteurs d’écran.
- Une vidéo décorative d’arrière-plan : `autoplay muted loop playsinline`, et un moyen de la mettre en pause.
- Fournissez une **transcription** textuelle pour les contenus audio (podcasts).

> [!INFO] Pour les vidéos longues ou nombreuses, un hébergement spécialisé (YouTube, Vimeo, PeerTube) gère la compression et la bande passante : on l’intègre alors avec `<iframe>` (leçon suivante).', '<video controls poster="…">
  <source src="…" type="video/mp4">
  <track kind="captions" src="…" srclang="fr">
</video>', NULL, NULL, '<h2>Tutoriel vidéo</h2>
<video controls width="480" preload="metadata" poster="https://placehold.co/480x270/png?text=Vid%C3%A9o">
  <source src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.webm" type="video/webm">
  <source src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4" type="video/mp4">
  Votre navigateur ne lit pas la vidéo.
</video>

<h2>Podcast</h2>
<audio controls preload="none" src="https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3">
  <a href="https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3">Télécharger l’audio</a>
</audio>
<p><a href="#">Lire la transcription de l’épisode</a></p>', NULL, '[["<video controls width=\\"480\\" preload=\\"metadata\\" poster=\\"…\\">","Lecteur avec contrôles, seules les métadonnées sont préchargées, image d’attente."],["<source … type=\\"video/webm\\">","Premier format proposé (plus léger)."],["<source … type=\\"video/mp4\\">","Format de repli universel."],["Votre navigateur ne lit pas la vidéo.","Contenu de secours pour les navigateurs très anciens."],["<audio controls preload=\\"none\\" …>","Rien n’est téléchargé tant que l’utilisateur ne lance pas la lecture."],["<a href=\\"#\\">Lire la transcription…</a>","Alternative textuelle au contenu audio."]]', '[["<audio> / <video>","Lecteurs natifs."],["controls","Affiche les contrôles."],["<source src type>","Fichier et format alternatifs."],["<track kind srclang label>","Sous-titres / légendes."],["poster","Image d’aperçu de la vidéo."],["muted / autoplay / loop","Son coupé / lecture auto / boucle."]]', '["Oublier `controls` : le lecteur est invisible.","Lancer un son automatiquement.","Des vidéos sans sous-titres.","Héberger des vidéos lourdes non compressées sur son propre serveur."]', '["Toujours `controls` (sauf vidéo décorative muette).","Sous-titres et transcriptions.","`preload=\\"metadata\\"` ou `\\"none\\"` pour économiser la bande passante."]', 'Les sites de formation en ligne proposent systématiquement sous-titres et transcriptions : c’est une exigence d’accessibilité, et un gain pour tous (visionnage sans son dans les transports, référencement du texte).', '["`<audio controls>` et `<video controls>`.","`<source>` pour plusieurs formats.","`<track>` pour les sous-titres.","Pas de son en lecture automatique."]', 'Créez une vidéo d’arrière-plan muette en boucle derrière un titre, avec un bouton (HTML uniquement) prévu pour la mettre en pause.', 1, 1),
(57, 22, 'iframe : intégrer des contenus externes', 'iframe-contenus-integres', 12, 'Une carte interactive, une vidéo YouTube, un calendrier partagé, un formulaire de paiement : tous ces contenus viennent d’un **autre site** et s’affichent dans le vôtre grâce à `<iframe>`. Un outil puissant… qui exige quelques précautions de sécurité et de performance.', '["Intégrer une page externe avec `<iframe>`","Rendre une iframe accessible avec `title`","Sécuriser une iframe avec `sandbox`","Améliorer les performances avec `loading=\\"lazy\\"`"]', '["Les éléments audio et video"]', '## La syntaxe

```html
<iframe
  src="https://www.openstreetmap.org/export/embed.html?bbox=4.82,45.75,4.85,45.77"
  title="Carte du quartier de la boutique"
  width="600" height="400"
  loading="lazy">
</iframe>
```

- `src` : l’adresse du contenu à afficher ;
- `title` : **obligatoire pour l’accessibilité** — il décrit le contenu de la fenêtre intégrée ;
- `loading="lazy"` : ne charge l’iframe que lorsqu’elle approche de l’écran (une iframe peut peser plusieurs Mo !).

## Les codes d’intégration

YouTube, Google Maps, Vimeo… proposent un bouton « Partager > Intégrer » qui fournit le code `<iframe>` prêt à l’emploi. Pensez à y ajouter un `title` pertinent.

## La sécurité : `sandbox`

Une iframe exécute le code d’un autre site. L’attribut `sandbox` la place dans un **bac à sable** où presque tout est interdit (scripts, formulaires, popups…). On réautorise ensuite uniquement le nécessaire :

```html
<iframe src="…" sandbox="allow-scripts allow-same-origin"></iframe>
```

> [!INFO] L’aperçu de l’éditeur de cette plateforme est une iframe `sandbox` sans aucune autorisation : votre HTML et votre CSS s’affichent, mais aucun script ne peut s’exécuter.

## Être intégré… ou pas

Un site peut **refuser** d’être affiché dans une iframe (en-têtes `X-Frame-Options` ou `Content-Security-Policy: frame-ancestors`). C’est une protection contre le *clickjacking* : c’est pourquoi certains sites affichent une page blanche dans une iframe.

## Vie privée

Une vidéo YouTube intégrée dépose des cookies dès le chargement. Préférez le domaine `youtube-nocookie.com`, ou une image cliquable qui ne charge la vidéo qu’après consentement.', '<iframe src="https://…" title="Description" loading="lazy"></iframe>', NULL, NULL, '<h2>Nous trouver</h2>
<iframe
  src="https://www.openstreetmap.org/export/embed.html?bbox=2.29%2C48.85%2C2.30%2C48.86&amp;layer=mapnik"
  title="Carte OpenStreetMap autour de la tour Eiffel"
  width="480"
  height="300"
  loading="lazy">
</iframe>
<p><a href="https://www.openstreetmap.org/#map=17/48.8584/2.2945">Afficher la carte en plein écran</a></p>', 'iframe {
  display: block;
  max-width: 100%;
  border: 0;
  border-radius: 12px;
}', '[["<iframe","Fenêtre intégrée affichant une page externe."],["  src=\\"https://www.openstreetmap.org/…\\"","Adresse du contenu intégré (`&amp;` = `&` dans une URL)."],["  title=\\"Carte OpenStreetMap…\\"","Nom accessible de l’iframe."],["  loading=\\"lazy\\">","Chargement différé."],["<a href=\\"…\\">Afficher la carte en plein écran</a>","Alternative : lien direct vers le contenu."]]', '[["<iframe src title>","Contenu externe intégré."],["loading=\\"lazy\\"","Chargement différé."],["sandbox","Restreint les capacités du contenu intégré."],["allow","Autorise des fonctionnalités (plein écran, autoplay…)."],["referrerpolicy","Contrôle l’information de provenance envoyée."]]', '["Oublier `title`.","Intégrer des iframes lourdes en haut de page sans `lazy`.","Intégrer un contenu non fiable sans `sandbox`.","Largeur fixe qui déborde sur mobile (utilisez `max-width: 100%` ou `aspect-ratio`)."]', '["Un `title` descriptif sur chaque iframe.","`loading=\\"lazy\\"` sauf si l’iframe est en haut de page.","`sandbox` pour les contenus tiers non maîtrisés.","Proposer un lien alternatif."]', 'La page « Contact » de la plupart des commerces intègre une carte en iframe ; les passerelles de paiement intègrent parfois leur formulaire de carte bancaire en iframe, pour que les numéros ne transitent jamais par le site du marchand.', '["`<iframe src title>` intègre une page externe.","`title` pour l’accessibilité, `loading=\\"lazy\\"` pour la performance.","`sandbox` pour la sécurité."]', 'Intégrez une vidéo YouTube via `youtube-nocookie.com`, rendez-la responsive avec `aspect-ratio: 16 / 9` et donnez-lui un titre accessible.', 1, 2),
(58, 23, 'Les balises meta et le head complet', 'les-balises-meta', 15, 'Quand vous partagez un lien sur une messagerie, une carte apparaît avec un titre, un résumé et une image. D’où viennent ces informations ? Du `<head>` de la page. Les **métadonnées** sont la carte de visite de votre page auprès des navigateurs, moteurs de recherche et réseaux sociaux.', '["Écrire une meta description efficace","Ajouter les balises Open Graph pour le partage","Déclarer une favicon et la couleur du thème","Contrôler l’indexation avec robots et canonical"]', '["Les sections head et body"]', '## La meta description

```html
<meta name="description" content="Pains au levain et viennoiseries pur beurre, faits maison à Lyon depuis 1987.">
```

Elle est souvent affichée sous le titre dans les résultats de recherche. Elle n’améliore pas directement le classement, mais une bonne description **donne envie de cliquer**. Visez **120 à 160 caractères**, unique pour chaque page.

## Open Graph : le partage sur les réseaux

```html
<meta property="og:title" content="Boulangerie Dupain">
<meta property="og:description" content="Pains au levain faits maison à Lyon.">
<meta property="og:image" content="https://www.dupain.fr/images/partage.jpg">
<meta property="og:url" content="https://www.dupain.fr/">
<meta property="og:type" content="website">
```

Ces balises (protocole créé par Facebook, repris partout) définissent la carte affichée lors d’un partage. L’image doit utiliser une **URL absolue** (idéalement 1200×630px). Twitter/X utilise en plus `<meta name="twitter:card" content="summary_large_image">`.

## La favicon

```html
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
```

## Autres métadonnées utiles

| Balise | Rôle |
|---|---|
| `<meta name="theme-color" content="#0b0f17">` | Couleur de l’interface du navigateur mobile |
| `<link rel="canonical" href="…">` | Adresse de référence d’une page accessible par plusieurs URL |
| `<meta name="robots" content="noindex">` | Demande aux moteurs de ne pas indexer la page |

> [!INFO] Les pages privées (tableau de bord, profil) de cette plateforme utilisent `noindex` : elles n’ont aucun intérêt dans les résultats de recherche.

## L’ordre recommandé du `<head>`

1. `<meta charset>` (en premier) ;
2. `<meta name="viewport">` ;
3. `<title>` ;
4. `<meta name="description">`, canonical, Open Graph ;
5. favicon, feuilles de style.', '<meta name="description" content="…">
<meta property="og:title" content="…">
<link rel="icon" href="…">', NULL, NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Atelier céramique — Cours de poterie à Nantes</title>
  <meta name="description" content="Cours de poterie pour débutants et confirmés à Nantes : tournage, modelage et émaillage en petits groupes.">
  <link rel="canonical" href="https://www.atelier-ceramique.fr/">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Atelier céramique — Cours de poterie à Nantes">
  <meta property="og:description" content="Tournage, modelage et émaillage en petits groupes.">
  <meta property="og:image" content="https://www.atelier-ceramique.fr/img/partage.jpg">
  <meta name="theme-color" content="#9a3412">
  <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>
<body>
  <h1>Atelier céramique</h1>
  <p>Cours de poterie à Nantes.</p>
</body>
</html>', NULL, '[["<title>Atelier céramique — Cours de poterie à Nantes</title>","Titre descriptif : activité + lieu."],["<meta name=\\"description\\" content=\\"…\\">","Résumé de ~150 caractères pour les résultats de recherche."],["<link rel=\\"canonical\\" href=\\"…\\">","Adresse de référence de la page."],["<meta property=\\"og:title\\" …>","Titre de la carte de partage."],["<meta property=\\"og:image\\" content=\\"https://…\\">","Image de partage, en URL absolue."],["<meta name=\\"theme-color\\" …>","Couleur de la barre du navigateur mobile."]]', '[["meta description","Résumé pour les moteurs de recherche."],["og:title / og:description / og:image / og:url","Carte de partage (Open Graph)."],["link rel=\\"canonical\\"","URL de référence."],["meta robots","Instructions d’indexation (`noindex`, `nofollow`)."],["link rel=\\"icon\\"","Favicon."],["meta theme-color","Couleur de l’interface mobile."]]', '["La même description sur toutes les pages.","Une image Open Graph en chemin relatif.","Oublier de retirer `noindex` à la mise en ligne (le site disparaît de Google).","Utiliser la balise obsolète `meta keywords` en pensant améliorer le classement."]', '["Titre et description uniques et descriptifs pour chaque page.","Tester le partage avec les outils de débogage des réseaux sociaux.","`noindex` sur les pages privées ou sans intérêt de recherche."]', 'Les CMS proposent des extensions SEO qui remplissent ces balises pour chaque page. Comprendre ce qu’elles génèrent vous permet de vérifier leur travail et de corriger une carte de partage qui affiche la mauvaise image.', '["`meta description` : incite au clic.","Open Graph : carte de partage (image en URL absolue).","Canonical, robots, favicon, theme-color complètent le head."]', 'Rédigez le `<head>` complet de la page « Contact » d’un site fictif, avec toutes les balises de cette leçon.', 1, 1),
(59, 23, 'Le référencement naturel (SEO) de base', 'seo-de-base', 16, 'Le référencement naturel (*SEO, Search Engine Optimization*) regroupe tout ce qui aide une page à apparaître dans les résultats des moteurs de recherche. Pas de formule magique : un bon SEO commence par un **HTML propre**, un **contenu utile** et une **page rapide**. Bonne nouvelle : vous savez déjà faire l’essentiel.', '["Connaître les facteurs SEO liés au HTML","Structurer titres et contenus pour le référencement","Comprendre sitemap.xml, robots.txt et données structurées","Comprendre le lien entre performance, accessibilité et SEO"]', '["Les balises meta et le head complet","Le HTML sémantique"]', '## Comment fonctionne un moteur de recherche

1. **Exploration** : des robots suivent les liens de page en page.
2. **Indexation** : ils analysent le contenu et le rangent.
3. **Classement** : pour chaque recherche, ils sélectionnent les pages les plus pertinentes et fiables.

## Les leviers HTML

| Élément | Bonne pratique |
|---|---|
| `<title>` | Unique, 50–60 caractères, mot-clé principal au début |
| `<h1>` | Un seul, clair, proche du title |
| Hiérarchie `h2`/`h3` | Structure logique du contenu |
| URL | Courte et lisible : `/cours/flexbox` plutôt que `/page.php?id=87` |
| Liens | Textes de liens descriptifs, liens internes entre pages proches |
| Images | `alt` descriptifs, noms de fichiers parlants, poids optimisé |
| Sémantique | `main`, `article`, `nav` aident à identifier le contenu principal |
| `lang` | Bonne langue déclarée |

## Le contenu d’abord

Les moteurs cherchent à satisfaire l’utilisateur. Un contenu **original, complet et qui répond à une vraie question** reste le premier facteur. Répéter un mot-clé 50 fois (*keyword stuffing*) est contre-productif et pénalisé.

## Les fichiers d’aide aux robots

- `robots.txt` (à la racine) : indique les zones à ne pas explorer (`Disallow: /admin/`) et l’adresse du sitemap ;
- `sitemap.xml` : la liste des pages à indexer, avec leur date de mise à jour.

Cette plateforme génère son `sitemap.xml` automatiquement à partir des leçons publiées.

## Les données structurées

Un bloc JSON-LD décrit précisément le contenu (cours, recette, produit, FAQ…) et peut produire des **résultats enrichis** (étoiles, prix, questions dépliables) :

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "Apprendre Flexbox",
  "description": "Maîtriser la mise en page flexible en CSS."
}
</script>
```

## Performance et accessibilité

Les moteurs mesurent la **vitesse** et la **stabilité** d’affichage (Core Web Vitals) et l’ergonomie mobile. Un site accessible et rapide est mieux classé : les bonnes pratiques vues dans ce parcours sont aussi des bonnes pratiques SEO.', '<title>Mot-clé principal — Marque</title>
<h1>Titre clair</h1>
<a href="/cours/flexbox">Cours sur Flexbox</a>', NULL, NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Recette de la tarte Tatin — Cuisine facile</title>
  <meta name="description" content="La vraie recette de la tarte Tatin en 5 étapes, avec les astuces pour un caramel réussi.">
  <script type="application/ld+json">
  {"@context": "https://schema.org", "@type": "Recipe", "name": "Tarte Tatin", "totalTime": "PT1H15M"}
  </script>
</head>
<body>
  <main>
    <article>
      <h1>Recette de la tarte Tatin</h1>
      <p>Une tarte aux pommes renversée, caramélisée et fondante.</p>
      <h2>Ingrédients</h2>
      <ul><li>6 pommes</li><li>150 g de sucre</li><li>1 pâte feuilletée</li></ul>
      <h2>Préparation</h2>
      <ol><li>Préparer le caramel.</li><li>Disposer les pommes.</li><li>Couvrir de pâte et cuire 40 min.</li></ol>
      <img src="https://placehold.co/400x250/png?text=Tatin" alt="Tarte Tatin dorée démoulée sur une assiette" width="400" height="250">
      <p>Voir aussi : <a href="#">notre recette de pâte feuilletée maison</a>.</p>
    </article>
  </main>
</body>
</html>', NULL, '[["<title>Recette de la tarte Tatin — Cuisine facile</title>","Mot-clé principal en tête du titre."],["<meta name=\\"description\\" …>","Résumé qui donne envie de cliquer."],["<script type=\\"application/ld+json\\">","Données structurées de type Recipe."],["<h1>Recette de la tarte Tatin</h1>","Un seul h1, cohérent avec le title."],["<h2>Ingrédients</h2> / <h2>Préparation</h2>","Structure logique du contenu."],["<img … alt=\\"Tarte Tatin dorée…\\">","Texte alternatif descriptif."],["<a href=\\"#\\">notre recette de pâte feuilletée maison</a>","Lien interne avec un texte descriptif."]]', '[["<title> / <h1>","Signaux principaux du sujet de la page."],["robots.txt","Règles d’exploration pour les robots."],["sitemap.xml","Liste des pages à indexer."],["JSON-LD","Données structurées (schema.org)."],["Core Web Vitals","Indicateurs de performance mesurés par Google."]]', '["Bourrer la page de mots-clés.","Des titres et descriptions dupliqués.","Du texte important dans des images.","Des URL illisibles.","Des pages lentes (images non optimisées)."]', '["Écrire pour les humains d’abord.","Un HTML sémantique et valide.","Des liens internes entre contenus liés.","Mesurer avec Google Search Console et Lighthouse."]', 'Cette plateforme applique ces règles : titres uniques par leçon, descriptions générées depuis l’introduction, URL propres (`/lecon/flexbox-le-conteneur`), sitemap automatique, données structurées `Course` et `LearningResource`.', '["Title, h1, structure, alt et liens sont les leviers HTML du SEO.","Contenu utile avant tout.","robots.txt, sitemap.xml et JSON-LD aident les moteurs.","Performance et accessibilité comptent aussi."]', 'Lancez un audit Lighthouse (onglet dans les outils de développement de Chrome) sur une page de votre choix et corrigez deux problèmes SEO signalés.', 1, 2),
(60, 24, 'Les principes de l’accessibilité', 'principes-accessibilite', 15, 'Plus d’une personne sur cinq vit avec un handicap, permanent ou temporaire : déficience visuelle, auditive, motrice, cognitive… sans compter le bras cassé, le soleil sur l’écran ou la connexion lente. L’**accessibilité numérique**, c’est concevoir des sites utilisables par **tous**. C’est une obligation légale pour de nombreux sites, et avant tout une question de respect.', '["Connaître les quatre principes WCAG","Identifier les technologies d’assistance","Appliquer les bonnes pratiques HTML déjà vues sous l’angle de l’accessibilité"]', '["Le HTML sémantique","Les formulaires"]', '## Qui est concerné ?

- **Déficience visuelle** : cécité (lecteur d’écran comme NVDA, VoiceOver), malvoyance (zoom, contrastes), daltonisme ;
- **Déficience auditive** : besoin de sous-titres et transcriptions ;
- **Déficience motrice** : navigation au clavier seul, commande vocale, contacteur ;
- **Troubles cognitifs** : besoin de clarté, de simplicité, de cohérence.

## Les règles WCAG

Les *Web Content Accessibility Guidelines* du W3C sont la référence internationale (le RGAA en France s’en inspire). Elles reposent sur quatre principes — **POUR** :

| Principe | Signification | Exemples |
|---|---|---|
| **Perceptible** | L’information peut être perçue | `alt` sur les images, sous-titres, contrastes suffisants |
| **Opérable** | L’interface est utilisable | Tout fonctionne au clavier, pas de piège, temps suffisant |
| **Compréhensible** | Le contenu est clair | Langue déclarée, labels, messages d’erreur explicites |
| **Robuste** | Compatible avec les technologies d’assistance | HTML valide et sémantique |

Trois niveaux de conformité : A, **AA** (le niveau généralement exigé), AAA.

## Ce que vous savez déjà faire

Une bonne partie de l’accessibilité repose sur le HTML vu dans ce parcours :

- `lang` sur `<html>` ;
- un `alt` pertinent sur chaque image ;
- une hiérarchie de titres logique ;
- des `<label>` associés à chaque champ ;
- des balises sémantiques (`nav`, `main`, `button`…) ;
- des textes de liens explicites ;
- des contrastes suffisants (4,5:1) ;
- ne jamais transmettre une information **par la couleur seule**.

> [!TIP] La meilleure règle d’accessibilité : **utiliser le bon élément HTML**. Un `<button>` est nativement focusable, activable avec Entrée et Espace, et annoncé comme bouton. Un `<div>` cliquable ne fait rien de tout ça.

## Tester

- naviguer sur sa page **uniquement au clavier** (Tab, Maj+Tab, Entrée, Espace, flèches) ;
- zoomer à 200 % ;
- utiliser un lecteur d’écran (NVDA gratuit sous Windows, VoiceOver intégré sur Mac et iPhone) ;
- lancer un audit automatique (Lighthouse, WAVE, axe) — ils ne détectent qu’environ 30 % des problèmes.', '<button type="button">Action</button>   <!-- et non <div onclick> -->
<img src="…" alt="…">
<label for="…">…</label>', NULL, NULL, '<main>
  <h1>Inscription à l’atelier</h1>
  <p>Les champs marqués d’un astérisque (*) sont obligatoires.</p>
  <form>
    <label for="nom">Nom *</label>
    <input id="nom" name="nom" required autocomplete="name">

    <label for="mail">E-mail *</label>
    <input id="mail" name="mail" type="email" required aria-describedby="mail-aide">
    <p id="mail-aide">Nous vous enverrons la confirmation à cette adresse.</p>

    <button type="submit">Je m’inscris</button>
  </form>
  <p class="erreur" role="alert">⚠ Erreur : l’adresse e-mail est invalide.</p>
</main>', 'body { font-family: system-ui, sans-serif; line-height: 1.5; }
form { display: grid; gap: 6px; max-width: 320px; }
input { padding: 8px; border: 2px solid #475569; border-radius: 6px; }
input:focus-visible, button:focus-visible { outline: 3px solid #2563eb; outline-offset: 2px; }
button { padding: 10px; border: 0; border-radius: 6px; background: #1d4ed8; color: white; }
.erreur { color: #b91c1c; font-weight: bold; }', '[["<p>Les champs marqués d’un astérisque (*) sont obligatoires.</p>","L’astérisque est expliqué en texte."],["<label for=\\"nom\\">Nom *</label>","Label visible et associé."],["aria-describedby=\\"mail-aide\\"","Le texte d’aide est lu avec le champ."],["<button type=\\"submit\\">","Un vrai bouton : clavier et lecteurs d’écran le gèrent nativement."],["<p class=\\"erreur\\" role=\\"alert\\">⚠ Erreur : …","Message annoncé immédiatement ; l’erreur est signalée par une icône ET du texte, pas seulement la couleur."],["outline: 3px solid #2563eb;","(CSS) Focus clavier très visible."]]', '[["WCAG","Règles internationales d’accessibilité (niveaux A, AA, AAA)."],["RGAA","Référentiel français, basé sur les WCAG."],["Lecteur d’écran","Logiciel qui lit la page à voix haute ou en braille."],["role=\\"alert\\"","Annonce immédiatement un message important."]]', '["Des `<div>` ou `<span>` cliquables à la place de boutons ou liens.","Supprimer le contour de focus.","Une information transmise uniquement par la couleur.","Des contrastes insuffisants.","Des champs sans label."]', '["Le bon élément HTML natif avant tout.","Tester au clavier à chaque nouvelle fonctionnalité.","Combiner tests automatiques et tests manuels."]', 'En Europe, l’Acte européen sur l’accessibilité (applicable depuis juin 2025) impose l’accessibilité à de nombreux services en ligne : e-commerce, banques, transports. Les compétences de cette leçon sont désormais recherchées par les recruteurs.', '["Accessibilité = utilisable par tous.","WCAG : Perceptible, Opérable, Compréhensible, Robuste.","Le HTML sémantique fait l’essentiel du travail.","Tester au clavier et avec un lecteur d’écran."]', 'Parcourez un site que vous utilisez souvent uniquement au clavier. Notez trois obstacles rencontrés.', 1, 1);

INSERT INTO `lessons` (`id`, `module_id`, `title`, `slug`, `duration_minutes`, `introduction`, `objectives`, `prerequisites`, `theory`, `syntax_code`, `simple_html`, `simple_css`, `example_html`, `example_css`, `line_by_line`, `reference_items`, `common_mistakes`, `best_practices`, `practical`, `summary_points`, `challenge`, `is_published`, `sort_order`) VALUES
(61, 24, 'ARIA et navigation au clavier', 'aria-et-navigation-clavier', 16, 'Quand le HTML natif ne suffit pas — un bouton qui n’affiche qu’une icône, un menu qui s’ouvre, une zone qui se met à jour — les attributs **ARIA** complètent l’information transmise aux technologies d’assistance. Utilisés avec parcimonie et justesse, ils rendent accessibles des interfaces riches.', '["Comprendre la règle n°1 d’ARIA","Nommer un élément avec `aria-label` et `aria-labelledby`","Décrire un état avec `aria-expanded`, `aria-current`, `aria-hidden`","Garantir un ordre de tabulation logique"]', '["Les principes de l’accessibilité"]', '## La règle n°1 d’ARIA

> « Si vous pouvez utiliser un élément HTML natif ayant déjà la sémantique et le comportement souhaités, faites-le. »

ARIA (*Accessible Rich Internet Applications*) ne change **ni l’apparence ni le comportement** : il modifie seulement ce qui est **annoncé**. Un mauvais ARIA est pire que pas d’ARIA.

## Nommer un élément

- `aria-label` : nom accessible **invisible** :

```html
<button type="button" aria-label="Fermer la fenêtre">✕</button>
```

- `aria-labelledby` : le nom provient d’un autre élément visible (par son `id`) ;
- `aria-describedby` : une description complémentaire (aide, format attendu).

## Décrire un état

| Attribut | Usage |
|---|---|
| `aria-expanded="true/false"` | Un bouton qui ouvre/ferme un menu ou un panneau |
| `aria-current="page"` | Le lien de la page actuelle dans un menu |
| `aria-hidden="true"` | Cache un élément décoratif aux lecteurs d’écran (icône) |
| `aria-live="polite"` | Annonce les mises à jour d’une zone (résultat, notification) |
| `aria-invalid="true"` | Champ en erreur |

## Les rôles

`role` précise la nature d’un élément quand aucune balise native n’existe : `role="alert"`, `role="dialog"`, `role="tablist"`… Ne réécrivez jamais un rôle natif (`<button role="button">` est inutile ; `<h2 role="button">` est une mauvaise idée).

## La navigation au clavier

- **Tab** / **Maj + Tab** : passer d’un élément interactif à l’autre ;
- **Entrée** : activer un lien ou un bouton ; **Espace** : activer un bouton, cocher une case ;
- **Flèches** : naviguer dans les boutons radio, les listes déroulantes ;
- **Échap** : fermer un menu ou une fenêtre.

Règles :

1. tout ce qui est cliquable doit être atteignable et activable au clavier ;
2. l’ordre de tabulation suit l’ordre **logique** du HTML (évitez `tabindex` positif) ;
3. le focus doit toujours être **visible** ;
4. aucun **piège** : on doit pouvoir sortir de chaque composant (dans l’éditeur de cette plateforme, Échap quitte la zone de code où Tab sert à indenter).', '<button aria-label="Fermer" aria-expanded="false">…</button>
<a href="…" aria-current="page">…</a>
<svg aria-hidden="true">…</svg>
<div aria-live="polite">…</div>', NULL, NULL, '<header class="barre">
  <button type="button" class="burger" aria-expanded="false" aria-controls="menu" aria-label="Ouvrir le menu">
    <span aria-hidden="true">☰</span>
  </button>
  <nav id="menu" aria-label="Navigation principale">
    <a href="#" aria-current="page">Accueil</a>
    <a href="#">Boutique</a>
    <a href="#">Contact</a>
  </nav>
</header>
<p>Panier : <span aria-live="polite">2 articles</span></p>
<button type="button" aria-label="Supprimer l’article Chaussettes">🗑</button>', 'body { font-family: system-ui, sans-serif; }
.barre { display: flex; gap: 12px; align-items: center; }
.burger { font-size: 20px; padding: 6px 10px; }
nav a { margin-right: 10px; }
[aria-current="page"] { font-weight: bold; text-decoration: underline; }', '[["aria-expanded=\\"false\\"","Indique que le menu contrôlé est fermé (JavaScript passera la valeur à true)."],["aria-controls=\\"menu\\"","Précise quel élément le bouton contrôle."],["aria-label=\\"Ouvrir le menu\\"","Nom accessible d’un bouton qui n’affiche qu’une icône."],["<span aria-hidden=\\"true\\">☰</span>","L’icône n’est pas lue (« trois barres horizontales » n’aurait aucun sens)."],["aria-current=\\"page\\"","Lien de la page actuelle ; utilisé aussi pour le style."],["<span aria-live=\\"polite\\">","Les changements du panier seront annoncés."]]', '[["aria-label / aria-labelledby","Nom accessible."],["aria-describedby","Description complémentaire."],["aria-expanded","État ouvert/fermé."],["aria-current","Élément courant dans un ensemble."],["aria-hidden","Masque aux technologies d’assistance."],["aria-live","Zone dont les mises à jour sont annoncées."]]', '["Ajouter de l’ARIA partout « au cas où ».","Mettre `aria-hidden=\\"true\\"` sur un élément focusable.","Un bouton icône sans nom accessible.","Des `tabindex` positifs qui désorganisent la navigation.","Un composant où le focus reste bloqué."]', '["HTML natif d’abord, ARIA en complément.","Nommer tous les boutons icônes.","Mettre à jour les états ARIA en même temps que l’interface.","Tester chaque composant au clavier."]', 'Le menu utilisateur de cette plateforme utilise `aria-expanded` et `aria-haspopup`, les icônes ont `aria-hidden="true"`, et le lien de la page active porte `aria-current="page"`. Inspectez-les avec les outils de développement !', '["Règle n°1 : HTML natif d’abord.","ARIA nomme (`aria-label`), décrit des états (`aria-expanded`, `aria-current`) et masque (`aria-hidden`).","Tout doit fonctionner au clavier, avec un focus visible et sans piège."]', 'Créez un bouton « Afficher la réponse » d’une FAQ avec `aria-expanded` et `aria-controls` pointant vers la réponse.', 1, 2),
(62, 25, 'Écrire un HTML propre et professionnel', 'ecrire-un-html-propre', 13, 'Vous connaissez maintenant l’essentiel des balises HTML. Ce qui distingue un code professionnel d’un code qui « marche », ce sont les **conventions** : un code cohérent, lisible, bien organisé, que n’importe quel développeur peut reprendre. Cette leçon rassemble les règles d’or.', '["Appliquer les conventions d’écriture","Organiser les fichiers d’un projet","Relire son code avec une check-list"]', '["Accessibilité"]', '## Les conventions d’écriture

1. **Minuscules** pour les balises et attributs.
2. **Guillemets doubles** autour des valeurs d’attributs.
3. **Indentation** cohérente (2 espaces).
4. **Fermer** toutes les balises non vides.
5. Une **seule** façon de faire dans tout le projet (même ordre d’attributs : `class`, `id`, `href`/`src`, puis le reste).
6. Pas de **style en ligne**, pas d’attributs de présentation obsolètes (`align`, `bgcolor`, `<font>`, `<center>`).

## L’organisation des fichiers

```text
mon-projet/
├── index.html
├── a-propos.html
├── contact.html
├── css/
│   └── style.css
├── js/
│   └── main.js
└── images/
    ├── logo.svg
    └── equipe/
        └── lea.webp
```

- noms en **minuscules**, sans espace ni accent, mots séparés par des tirets ;
- `index.html` : la page d’accueil (le serveur l’affiche par défaut dans un dossier).

## La check-list avant publication

- [ ] DOCTYPE, `lang`, `charset`, `viewport`, `title`, `description`
- [ ] Un seul `<h1>`, titres hiérarchisés
- [ ] Structure sémantique (`header`, `nav`, `main`, `footer`)
- [ ] `alt` sur toutes les images
- [ ] Labels sur tous les champs
- [ ] Liens explicites, `rel="noopener"` avec `target="_blank"`
- [ ] Code validé sans erreur
- [ ] Navigation au clavier testée
- [ ] Commentaires de débogage et code mort supprimés

> [!TIP] Un code propre n’est pas un luxe : c’est ce qui permet de modifier un site dans six mois sans tout casser.', '<a class="btn" href="/contact" title="…">Contact</a>', NULL, NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact — Atelier Bois</title>
  <meta name="description" content="Contactez l’Atelier Bois pour un devis de meuble sur mesure.">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <nav aria-label="Navigation principale">
      <ul>
        <li><a href="index.html">Accueil</a></li>
        <li><a href="contact.html" aria-current="page">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Nous contacter</h1>
    <form action="/contact" method="post">
      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" required>
      <button type="submit">Demander un devis</button>
    </form>
  </main>

  <footer>
    <p>© Atelier Bois</p>
  </footer>
</body>
</html>', NULL, '[["<!DOCTYPE html>","Squelette complet : doctype, langue, charset, viewport, title, description."],["<link rel=\\"stylesheet\\" href=\\"css/style.css\\">","Style dans un fichier externe, rangé dans css/."],["<nav aria-label=\\"Navigation principale\\">","Structure sémantique et accessible."],["aria-current=\\"page\\"","Page courante signalée."],["<label for=\\"email\\">E-mail</label>","Formulaire accessible."],["  <main>","Indentation cohérente de 2 espaces, lignes vides entre les grandes zones."]]', '[["Conventions","Minuscules, guillemets doubles, indentation, balises fermées."],["index.html","Page par défaut d’un dossier."],["Balises obsolètes","`<font>`, `<center>`, `<marquee>`, attributs `align`, `bgcolor`…"]]', '["Des noms de fichiers avec espaces ou majuscules (`Mon Image.JPG`).","Des balises obsolètes copiées d’anciens tutoriels.","Un code mort commenté laissé en production.","Une indentation incohérente."]', '["Utiliser un formateur automatique (Prettier).","Suivre une check-list avant chaque mise en ligne.","Garder une arborescence claire."]', 'Dans les équipes, ces règles sont écrites dans un **guide de style** et vérifiées automatiquement à chaque modification (outils de lint dans l’intégration continue). Une pull request qui ne les respecte pas est refusée.', '["Minuscules, guillemets, indentation, balises fermées.","Fichiers bien nommés et rangés.","Une check-list avant chaque publication."]', 'Reprenez votre projet « Ma première page personnelle » et appliquez-lui la check-list complète.', 1, 1),
(63, 25, 'Valider et déboguer son HTML', 'valider-et-deboguer', 13, 'Le navigateur corrige silencieusement vos erreurs HTML… chacun à sa manière. Une page peut donc sembler correcte dans votre navigateur et se casser ailleurs, ou perturber les lecteurs d’écran. Le **validateur** et les **outils de développement** vous montrent la réalité.', '["Utiliser le validateur du W3C","Lire et corriger les messages d’erreur","Inspecter le DOM réel avec les outils de développement"]', '["Écrire un HTML propre et professionnel"]', '## Le validateur du W3C

Le service gratuit [validator.w3.org](https://validator.w3.org/) vérifie votre code par URL, par fichier ou par copier-coller. Il renvoie :

- des **erreurs** (code invalide) ;
- des **avertissements** (code valide mais douteux).

## Lire un message d’erreur

```text
Error: Element h2 not allowed as child of element p in this context.
From line 12, column 4
```

Le message indique **quoi** (un `h2` dans un `p`) et **où** (ligne 12). Corrigez les erreurs **de haut en bas** : une seule balise mal fermée peut provoquer des dizaines d’erreurs en cascade.

## Les erreurs les plus fréquentes

| Erreur | Cause |
|---|---|
| `End tag … seen, but there were open elements` | Balise mal fermée ou mal imbriquée |
| `Duplicate ID` | Un même `id` utilisé deux fois |
| `An img element must have an alt attribute` | `alt` manquant |
| `Element … not allowed as child of …` | Élément interdit à cet endroit (bloc dans un `p`, `div` dans un `ul`…) |
| `Bad value … for attribute href` | Espace ou caractère invalide dans une URL |

## Le DOM réel : les outils de développement

L’onglet **Éléments** (`F12`) montre le DOM **après** correction par le navigateur. Comparez-le avec votre code : si un élément se retrouve à un endroit inattendu (un `<h2>` sorti de votre `<p>`, un `<p>` vide en trop), c’est le signe d’une erreur de structure.

L’onglet **Accessibilité** affiche l’arbre tel que le perçoit un lecteur d’écran : noms, rôles, états.

## La démarche de débogage

1. Isoler le problème (commenter une partie du code) ;
2. Valider le HTML ;
3. Inspecter le DOM et les styles appliqués ;
4. Corriger une erreur à la fois, puis revérifier.', 'https://validator.w3.org/#validate_by_input', NULL, NULL, '<!-- Version corrigée d’un code qui contenait 4 erreurs -->
<main>
  <h1>Nos produits</h1>
  <h2>Nouveautés</h2>
  <p>Découvrez la <strong>collection</strong> d’automne.</p>
  <ul>
    <li>Pull en laine</li>
    <li>Écharpe</li>
  </ul>
  <img src="https://placehold.co/200x120/png" alt="Pull en laine beige plié" width="200" height="120">
  <p id="promo">Livraison offerte.</p>
</main>', NULL, '[["<h2>Nouveautés</h2>","Erreur corrigée : le h2 était placé dans un paragraphe."],["<strong>collection</strong>","Erreur corrigée : `</p>` était fermé avant `</strong>`."],["  <li>Écharpe</li>","Erreur corrigée : un `<div>` était placé directement dans le `<ul>`."],["… alt=\\"Pull en laine beige plié\\"","Erreur corrigée : `alt` manquant."],["<p id=\\"promo\\">","L’`id` est unique dans la page."]]', '[["validator.w3.org","Validateur officiel HTML."],["F12 > Éléments","DOM réel et styles appliqués."],["F12 > Accessibilité","Arbre d’accessibilité."],["Lighthouse","Audit performance, accessibilité, SEO, bonnes pratiques."]]', '["Corriger les erreurs dans le désordre (cascade d’erreurs).","Ignorer les erreurs parce que « ça s’affiche bien ».","Confondre le code source et le DOM corrigé par le navigateur."]', '["Valider chaque page avant publication.","Corriger de haut en bas, une erreur à la fois.","Intégrer la validation dans l’éditeur (extensions VS Code)."]', 'Une balise non fermée dans le gabarit commun d’un site peut casser la mise en page de toutes les pages. Les équipes valident automatiquement le HTML généré à chaque déploiement pour éviter ce genre d’incident.', '["Le validateur W3C révèle les erreurs invisibles.","Corriger de haut en bas.","Les outils de développement montrent le DOM réel et l’arbre d’accessibilité."]', 'Validez la page d’accueil de trois sites connus sur validator.w3.org. Qu’en concluez-vous ?', 1, 2),
(64, 26, 'Les principes du responsive design', 'principes-responsive', 13, 'Plus de la moitié du trafic web mondial vient des smartphones. Un site doit donc s’afficher correctement sur un écran de 320 pixels comme sur un moniteur de 2560 pixels. Le **responsive design** n’est pas une technique unique, mais une façon de penser la mise en page.', '["Comprendre les principes du responsive design","Adopter l’approche mobile first","Utiliser des mises en page fluides","Tester sur différentes tailles d’écran"]', '["Flexbox","CSS Grid","Les unités CSS"]', '## Trois ingrédients

Le responsive design (Ethan Marcotte, 2010) repose sur :

1. une **grille fluide** : des largeurs relatives (`%`, `fr`, `max-width`) plutôt que fixes ;
2. des **médias flexibles** : des images qui ne dépassent jamais leur conteneur ;
3. des **media queries** : des règles CSS appliquées selon la taille de l’écran.

## Le prérequis : la balise viewport

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

Sans elle, le mobile simule un écran de 980px et réduit la page : aucune de vos règles responsive ne fonctionnera comme prévu.

## Mobile first

On écrit d’abord le CSS pour **les petits écrans** (souvent une seule colonne, plus simple), puis on **enrichit** la mise en page pour les écrans plus larges avec des media queries `min-width`.

Avantages :

- le CSS de base est léger, idéal pour les mobiles (souvent sur des connexions plus lentes) ;
- on se concentre sur l’essentiel du contenu ;
- les ajouts pour grand écran sont progressifs.

## Les règles de base

```css
img, video { max-width: 100%; height: auto; }
.conteneur { width: min(100% - 32px, 1200px); margin-inline: auto; }
```

- **jamais** de largeur fixe supérieure à l’écran ;
- pas de **défilement horizontal** ;
- des zones cliquables d’au moins **44×44px** sur mobile ;
- un texte lisible **sans zoom** (16px minimum).

## Tester

Les outils de développement proposent un **mode appareil** (`Ctrl + Maj + M`) : testez au minimum 320, 375, 414, 768, 1024 et 1440 pixels. Rien ne remplace toutefois un test sur un vrai téléphone.

> [!TIP] Commencez par redimensionner lentement la fenêtre de votre navigateur de très large à très étroit : les points où la mise en page « casse » vous indiquent où placer vos media queries.', 'img { max-width: 100%; height: auto; }
.conteneur { max-width: 1200px; margin: 0 auto; }', NULL, NULL, '<div class="conteneur">
  <h1>Page fluide</h1>
  <img src="https://placehold.co/1200x400/png?text=Image+large" alt="Bannière de démonstration" width="1200" height="400">
  <p>Réduisez la largeur de l’aperçu : l’image et le texte s’adaptent sans jamais provoquer de défilement horizontal.</p>
  <a class="btn" href="#">Bouton tactile confortable</a>
</div>', '*, *::before, *::after { box-sizing: border-box; }

body {
  margin: 0;
  font-family: system-ui, sans-serif;
  font-size: 1rem;
  line-height: 1.6;
}

.conteneur {
  width: min(100% - 32px, 900px);
  margin-inline: auto;
}

img {
  max-width: 100%;
  height: auto;
  display: block;
  border-radius: 12px;
}

.btn {
  display: inline-block;
  min-height: 44px;
  padding: 12px 20px;
  border-radius: 8px;
  background: #0f766e;
  color: white;
  text-decoration: none;
}', '[["  width: min(100% - 32px, 900px);","Largeur fluide : la plus petite entre « écran moins 32px » et 900px."],["  margin-inline: auto;","Centré horizontalement."],["  max-width: 100%;","L’image ne dépasse jamais son conteneur…"],["  height: auto;","…et garde ses proportions."],["  min-height: 44px;","Zone tactile confortable."]]', '[["meta viewport","Indispensable au responsive."],["Mobile first","CSS de base pour mobile, enrichi avec `min-width`."],["max-width: 100%","Médias flexibles."],["min(), max(), clamp()","Fonctions de dimensionnement fluide."]]', '["Oublier la balise viewport.","Des largeurs fixes (`width: 1000px`) qui provoquent un défilement horizontal.","Des boutons minuscules sur mobile.","Tester uniquement sur son propre écran."]', '["Penser mobile first.","Largeurs relatives et `max-width`.","Tester aux tailles clés et sur un vrai appareil."]', 'Google indexe en priorité la version mobile des sites (*mobile-first indexing*). Un site mal adapté au mobile est donc pénalisé dans les résultats de recherche, même pour les recherches faites sur ordinateur.', '["Grille fluide + médias flexibles + media queries.","Viewport obligatoire.","Mobile first : le petit écran d’abord.","Pas de défilement horizontal, zones tactiles de 44px."]', 'Ouvrez le mode appareil de votre navigateur sur trois sites connus et observez comment leur navigation change entre mobile et ordinateur.', 1, 1),
(65, 26, 'Les media queries', 'media-queries', 16, 'Une colonne sur mobile, deux sur tablette, trois sur ordinateur ; un menu burger sur petit écran, une barre de navigation complète sur grand écran : les **media queries** permettent d’appliquer des règles CSS seulement lorsque certaines conditions sont réunies.', '["Écrire une media query `min-width`","Choisir ses points de rupture","Utiliser les requêtes de préférences (`prefers-color-scheme`, `prefers-reduced-motion`)"]', '["Les principes du responsive design"]', '## La syntaxe

```css
/* Styles de base : mobile */
.grille { display: grid; gap: 16px; }

/* À partir de 768px de large */
@media (min-width: 768px) {
  .grille { grid-template-columns: 1fr 1fr; }
}

/* À partir de 1024px */
@media (min-width: 1024px) {
  .grille { grid-template-columns: repeat(3, 1fr); }
}
```

Les règles à l’intérieur de `@media` ne s’appliquent que si la condition est vraie. Elles s’ajoutent aux règles de base (la cascade s’applique normalement : placez les media queries **après** les styles de base).

## `min-width` ou `max-width` ?

- `min-width` : « à partir de » → approche **mobile first** (recommandée) ;
- `max-width` : « jusqu’à » → approche desktop first.

## Choisir les points de rupture

Ne ciblez pas des appareils précis (ils changent chaque année). Placez un point de rupture **là où votre contenu en a besoin**. Des valeurs courantes servent de repères : **480px, 768px, 1024px, 1280px**.

## Combiner des conditions

```css
@media (min-width: 768px) and (max-width: 1023px) { … } /* tablettes uniquement */
@media (orientation: landscape) { … }
@media print { … }                                     /* impression */
```

## Les préférences de l’utilisateur

```css
@media (prefers-color-scheme: dark) {
  body { background: #0f172a; color: #e2e8f0; }
}

@media (prefers-reduced-motion: reduce) {
  * { animation: none !important; transition: none !important; }
}
```

Ces requêtes respectent les réglages du système : thème sombre, réduction des animations (important pour les personnes sujettes aux vertiges ou aux crises d’épilepsie).

> [!INFO] Cette plateforme respecte `prefers-reduced-motion` et propose en plus un interrupteur « Réduire les animations » dans le pied de page.', '@media (min-width: 768px) {
  .selecteur { … }
}', NULL, NULL, '<header class="entete">
  <strong>Mon site</strong>
  <nav class="nav"><a href="#">Accueil</a><a href="#">Blog</a><a href="#">Contact</a></nav>
</header>
<main class="grille">
  <article class="carte">Article 1</article>
  <article class="carte">Article 2</article>
  <article class="carte">Article 3</article>
</main>', 'body { margin: 0; font-family: system-ui, sans-serif; }

/* Mobile : tout est empilé */
.entete { display: flex; flex-direction: column; gap: 8px; padding: 12px; background: #1e293b; color: white; }
.nav { display: flex; gap: 12px; }
.nav a { color: #cbd5e1; }
.grille { display: grid; gap: 12px; padding: 12px; }
.carte { padding: 24px; border-radius: 10px; background: #e0e7ff; }

/* Tablette */
@media (min-width: 600px) {
  .entete { flex-direction: row; justify-content: space-between; align-items: center; }
  .grille { grid-template-columns: 1fr 1fr; }
}

/* Ordinateur */
@media (min-width: 900px) {
  .grille { grid-template-columns: repeat(3, 1fr); }
}

@media (prefers-color-scheme: dark) {
  .carte { background: #312e81; color: white; }
}', '[["/* Mobile : tout est empilé */","Les styles de base concernent les petits écrans."],["@media (min-width: 600px) {","À partir de 600px…"],["  .entete { flex-direction: row; … }","…l’en-tête passe sur une ligne."],["  .grille { grid-template-columns: 1fr 1fr; }","…et la grille passe à 2 colonnes."],["@media (min-width: 900px) {","À partir de 900px : 3 colonnes."],["@media (prefers-color-scheme: dark) {","Cartes adaptées au thème sombre du système."]]', '[["@media (min-width: …)","À partir d’une largeur."],["@media (max-width: …)","Jusqu’à une largeur."],["and","Combine des conditions."],["print","Styles d’impression."],["prefers-color-scheme","Thème clair/sombre du système."],["prefers-reduced-motion","Préférence de réduction des animations."]]', '["Placer les media queries avant les styles de base (elles sont écrasées).","Multiplier les points de rupture pour chaque modèle de téléphone.","Oublier les parenthèses : `@media min-width: 768px`.","Mélanger `min-width` et `max-width` sans logique."]', '["Mobile first avec `min-width`.","Des points de rupture dictés par le contenu.","Respecter `prefers-reduced-motion`."]', 'Le menu de cette plateforme devient un menu plein écran activé par un bouton burger sous 900px : c’est une media query qui change son `position`, sa `transform` et l’affichage du bouton.', '["`@media (min-width: X) { … }` applique des règles à partir de X.","Mobile first + points de rupture selon le contenu.","Respectez les préférences système (thème, animations)."]', 'Créez une galerie qui affiche 1, 2, 3 puis 4 colonnes selon la largeur, et une feuille d’impression qui masque la navigation.', 1, 2),
(66, 26, 'Typographie fluide et images responsives', 'typographie-et-images-fluides', 14, 'Un titre de 48px est magnifique sur ordinateur… et écrase tout sur un téléphone. Plutôt que d’ajouter une media query pour chaque taille, la fonction `clamp()` crée une typographie qui **s’adapte en continu**. Et `object-fit` règle le cadrage des images dans des zones de taille variable.', '["Utiliser `clamp()` pour une typographie fluide","Cadrer une image avec `object-fit` et `aspect-ratio`","Combiner ces techniques"]', '["Les media queries"]', '## `clamp(minimum, idéal, maximum)`

```css
h1 { font-size: clamp(1.75rem, 1rem + 3vw, 3.5rem); }
```

- la taille ne descend jamais sous **1.75rem** ;
- elle vaut idéalement **1rem + 3vw** (elle grandit avec la largeur de l’écran) ;
- elle ne dépasse jamais **3.5rem**.

Le mélange `rem + vw` conserve un lien avec la taille de police de l’utilisateur (accessibilité) tout en suivant l’écran. `clamp()` fonctionne aussi pour les espacements :

```css
.section { padding-block: clamp(2rem, 5vw, 6rem); }
```

## `aspect-ratio`

Fixe les proportions d’une boîte, quelle que soit sa largeur :

```css
.video { aspect-ratio: 16 / 9; width: 100%; }
.avatar { aspect-ratio: 1; }
```

## `object-fit`

Quand une image doit remplir une zone aux proportions différentes des siennes :

| Valeur | Effet |
|---|---|
| `fill` | Déformée pour remplir (défaut) |
| `cover` | Remplit la zone, rognée si besoin |
| `contain` | Entièrement visible, bandes vides possibles |

```css
.vignette img {
  width: 100%;
  aspect-ratio: 4 / 3;
  object-fit: cover;
}
```

`object-position: top;` choisit la partie conservée lors du rognage (utile pour les portraits).

> [!TIP] Des vignettes aux dimensions **identiques** rendent une grille de cartes bien plus harmonieuse, même si les photos d’origine ont des formats variés.', 'font-size: clamp(1.5rem, 1rem + 2vw, 3rem);
aspect-ratio: 16 / 9;
object-fit: cover;', NULL, NULL, '<section class="hero">
  <h1>Typographie fluide</h1>
  <p>Redimensionnez l’aperçu : le titre grandit et rétrécit en douceur.</p>
</section>
<div class="galerie">
  <img src="https://placehold.co/600x900/png?text=Portrait" alt="Photo portrait recadrée">
  <img src="https://placehold.co/900x500/png?text=Paysage" alt="Photo paysage recadrée">
  <img src="https://placehold.co/500x500/png?text=Carr%C3%A9" alt="Photo carrée">
</div>', 'body { margin: 0; font-family: system-ui, sans-serif; }

.hero {
  padding: clamp(1.5rem, 5vw, 4rem);
  background: #ecfccb;
}

.hero h1 {
  margin: 0;
  font-size: clamp(1.75rem, 1rem + 4vw, 4rem);
  line-height: 1.1;
}

.galerie {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
  gap: 8px;
  padding: 8px;
}

.galerie img {
  width: 100%;
  aspect-ratio: 4 / 3;
  object-fit: cover;
  border-radius: 8px;
}', '[["  padding: clamp(1.5rem, 5vw, 4rem);","Espacement fluide, borné."],["  font-size: clamp(1.75rem, 1rem + 4vw, 4rem);","Titre fluide entre 1.75rem et 4rem."],["  aspect-ratio: 4 / 3;","Toutes les vignettes ont les mêmes proportions…"],["  object-fit: cover;","…et les images les remplissent sans déformation."]]', '[["clamp(min, idéal, max)","Valeur fluide bornée."],["aspect-ratio","Proportions d’une boîte."],["object-fit","Ajustement d’une image dans sa boîte."],["object-position","Partie de l’image conservée."]]', '["Utiliser uniquement `vw` pour la taille du texte (ignore le zoom de l’utilisateur).","Oublier les bornes : un texte trop grand sur écran géant.","Déformer des images avec `width` et `height` fixes sans `object-fit`."]', '["`clamp()` avec `rem + vw` pour les titres.","`aspect-ratio` + `object-fit: cover` pour les vignettes.","Tester le zoom navigateur à 200 %."]', 'Les titres de la page d’accueil de cette plateforme utilisent `clamp()` : ils passent en douceur de 2.2rem sur mobile à 4rem sur grand écran, sans aucune media query.', '["`clamp()` : typographie et espacements fluides.","`aspect-ratio` fixe les proportions.","`object-fit: cover` remplit sans déformer."]', 'Créez une grille de profils d’équipe avec des photos de formats variés, toutes affichées en carré parfait avec le visage conservé (`object-position: top`).', 1, 3),
(67, 27, 'Les transitions', 'les-transitions', 13, 'Quand un bouton change de couleur au survol, le changement est instantané… et un peu brutal. Une **transition** de 200 millisecondes suffit à rendre l’interface fluide et agréable. C’est la première technique d’animation à maîtriser, et souvent la seule nécessaire.', '["Créer une transition entre deux états","Régler durée, propriété, courbe et délai","Choisir des propriétés performantes à animer"]', '["Les pseudo-classes"]', '## Le principe

Une transition anime le passage d’une valeur à une autre quand une propriété **change** (au survol, au focus, à l’ajout d’une classe) :

```css
.btn {
  background: #2563eb;
  transition: background-color 0.2s ease;
}
.btn:hover {
  background: #1d4ed8;
}
```

On déclare la transition sur l’**état de repos** : elle s’applique ainsi dans les deux sens (entrée et sortie du survol).

## Les quatre paramètres

| Propriété | Rôle | Exemple |
|---|---|---|
| `transition-property` | Ce qui est animé | `background-color`, `transform`, `all` |
| `transition-duration` | Durée | `0.2s`, `300ms` |
| `transition-timing-function` | Courbe de vitesse | `ease`, `linear`, `ease-in-out`, `cubic-bezier(…)` |
| `transition-delay` | Délai avant le départ | `0.1s` |

Raccourci : `transition: transform 0.3s ease-out 0s;` — plusieurs transitions séparées par des virgules.

## Quelle durée ?

- micro-interactions (survol, focus) : **150 à 250ms** ;
- ouverture de panneaux : **250 à 400ms** ;
- au-delà de 500ms, l’interface semble lente.

## Quelles propriétés animer ?

Les navigateurs animent très efficacement **`transform`** et **`opacity`** (calculés par la carte graphique). Animer `width`, `height`, `top` ou `margin` oblige le navigateur à recalculer la mise en page à chaque image : risque de saccades.

> [!WARN] Évitez `transition: all` : vous animeriez aussi des propriétés inattendues et coûteuses. Listez précisément ce qui doit être animé.', 'transition: propriété durée courbe délai;', NULL, NULL, '<a class="btn" href="#">Survolez-moi</a>
<div class="carte">Carte qui se soulève au survol</div>
<a class="lien" href="#">Lien avec soulignement animé</a>', 'body { font-family: system-ui, sans-serif; display: grid; gap: 24px; justify-items: start; padding: 16px; }

.btn {
  padding: 12px 22px;
  border-radius: 8px;
  background: #2563eb;
  color: white;
  text-decoration: none;
  transition: background-color 0.2s ease, transform 0.2s ease;
}
.btn:hover { background: #1d4ed8; transform: translateY(-2px); }

.carte {
  padding: 24px;
  border-radius: 12px;
  background: white;
  box-shadow: 0 2px 6px rgb(0 0 0 / 10%);
  transition: transform 0.25s ease-out, box-shadow 0.25s ease-out;
}
.carte:hover { transform: translateY(-4px); box-shadow: 0 12px 24px rgb(0 0 0 / 15%); }

.lien {
  color: #7c3aed;
  text-decoration: none;
  background: linear-gradient(currentColor, currentColor) left bottom / 0 2px no-repeat;
  transition: background-size 0.3s ease;
}
.lien:hover { background-size: 100% 2px; }', '[["  transition: background-color 0.2s ease, transform 0.2s ease;","Deux propriétés animées, déclarées sur l’état de repos."],[".btn:hover { … transform: translateY(-2px); }","Le bouton monte de 2px en douceur."],["  transition: transform 0.25s ease-out, box-shadow 0.25s ease-out;","La carte se soulève et son ombre grandit."],["  background: linear-gradient(…) left bottom / 0 2px no-repeat;","Un soulignement dessiné par un dégradé de largeur 0…"],[".lien:hover { background-size: 100% 2px; }","…qui s’étend à 100 % au survol."]]', '[["transition","Raccourci : propriété durée courbe délai."],["ease / ease-in / ease-out / linear","Courbes de vitesse."],["cubic-bezier()","Courbe personnalisée."]]', '["Déclarer la transition uniquement sur `:hover` (pas d’animation au retour).","Des durées trop longues.","`transition: all` systématique.","Animer `width` ou `top` au lieu de `transform`."]', '["Transitions courtes (150–300ms).","Animer `transform` et `opacity` en priorité.","Lister les propriétés animées."]', 'Presque tous les éléments interactifs de cette plateforme (boutons, cartes, liens, barres de progression) utilisent des transitions de 150 à 300ms sur `transform`, `opacity` ou les couleurs.', '["`transition` anime un changement d’état.","Déclarée sur l’état de repos.","150–300ms pour les micro-interactions.","Préférer `transform` et `opacity`."]', 'Créez un menu dont les liens changent de couleur et affichent un soulignement qui s’étend depuis le centre au survol.', 1, 1),
(68, 27, 'Les transformations : transform', 'transform', 13, 'Déplacer, agrandir, faire pivoter, incliner : la propriété `transform` modifie l’apparence d’un élément **sans perturber la mise en page** autour de lui. Associée aux transitions, elle est à la base de la plupart des effets modernes.', '["Utiliser `translate`, `scale`, `rotate`, `skew`","Combiner plusieurs transformations","Changer le point d’origine avec `transform-origin`"]', '["Les transitions"]', '## Les fonctions de transformation

| Fonction | Effet | Exemple |
|---|---|---|
| `translate(x, y)` | Déplacement | `translate(10px, -5px)`, `translateY(-4px)` |
| `scale(n)` | Mise à l’échelle | `scale(1.05)`, `scale(0.9)` |
| `rotate(angle)` | Rotation | `rotate(45deg)`, `rotate(-0.5turn)` |
| `skew(angle)` | Inclinaison | `skewX(-10deg)` |

## Ce qui ne bouge pas

Un élément transformé garde sa **place d’origine** dans la mise en page : les voisins ne bougent pas. C’est ce qui rend `transform` idéal pour les animations.

## Combiner

Les fonctions s’enchaînent, séparées par des espaces, et s’appliquent **de droite à gauche** (l’ordre compte) :

```css
.icone:hover { transform: translateY(-2px) rotate(8deg) scale(1.1); }
```

Les propriétés individuelles `translate`, `rotate` et `scale` existent aussi et peuvent être animées séparément :

```css
.el { rotate: 15deg; scale: 1.1; }
```

## `transform-origin`

Par défaut, les transformations se font autour du **centre**. On peut changer ce point :

```css
.aiguille { transform-origin: bottom center; transform: rotate(30deg); }
```

## Le centrage absolu classique

```css
.centre {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
```

Les pourcentages de `translate` sont relatifs à **l’élément lui-même** : on le recule de la moitié de sa propre taille.', 'transform: translate(10px, 0) rotate(15deg) scale(1.1);
transform-origin: center;', NULL, NULL, '<div class="demo">
  <div class="boite deplace">translate</div>
  <div class="boite agrandit">scale</div>
  <div class="boite tourne">rotate</div>
  <div class="boite incline">skew</div>
</div>
<p>Survolez chaque boîte.</p>', '.demo {
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  padding: 24px;
  font-family: system-ui, sans-serif;
}

.boite {
  width: 90px;
  height: 90px;
  display: grid;
  place-items: center;
  border-radius: 12px;
  background: #a78bfa;
  color: white;
  transition: transform 0.3s ease;
}

.deplace:hover  { transform: translate(8px, -8px); }
.agrandit:hover { transform: scale(1.2); }
.tourne:hover   { transform: rotate(20deg); }
.incline:hover  { transform: skewX(-12deg); }', '[["  transition: transform 0.3s ease;","Toutes les transformations sont animées."],[".deplace:hover  { transform: translate(8px, -8px); }","Déplacement de 8px à droite et 8px vers le haut."],[".agrandit:hover { transform: scale(1.2); }","Agrandissement de 20 % autour du centre."],[".tourne:hover   { transform: rotate(20deg); }","Rotation de 20 degrés."],[".incline:hover  { transform: skewX(-12deg); }","Inclinaison horizontale."]]', '[["translate()","Déplacement."],["scale()","Mise à l’échelle."],["rotate()","Rotation (deg, turn)."],["skew()","Inclinaison."],["transform-origin","Point d’origine."]]', '["Écrire deux déclarations `transform` : la seconde remplace la première.","Oublier que l’ordre des fonctions change le résultat.","Agrandir fortement du texte (flou, débordements)."]', '["De petites valeurs pour des effets subtils (`scale(1.03)`, `translateY(-2px)`).","Combiner les fonctions dans une seule déclaration.","Toujours associer une transition."]', 'Les cartes qui « se soulèvent » au survol (`translateY(-4px)`), les boutons qui se « compriment » au clic (`scale(0.97)`) et les flèches qui pivotent quand un accordéon s’ouvre (`rotate(180deg)`) sont des transformations.', '["`transform` : translate, scale, rotate, skew.","La mise en page n’est pas affectée.","Combiner dans une seule déclaration ; l’ordre compte.","`transform-origin` change le pivot."]', 'Créez une icône de flèche dans un bouton d’accordéon qui pivote de 180° quand le bouton est survolé.', 1, 2),
(69, 27, 'Les animations @keyframes', 'animations-keyframes', 16, 'Les transitions animent le passage entre **deux** états déclenché par une interaction. Les **animations** vont plus loin : plusieurs étapes, démarrage automatique, répétition. Un indicateur de chargement, une apparition en fondu, un badge qui « pop » : place à `@keyframes`.', '["Définir des étapes avec `@keyframes`","Appliquer une animation avec `animation`","Contrôler répétition, direction et état final","Respecter `prefers-reduced-motion`"]', '["Les transformations : transform"]', '## Définir l’animation

```css
@keyframes apparition {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}
```

`from` = 0 %, `to` = 100 %. On peut ajouter des étapes intermédiaires :

```css
@keyframes rebond {
  0%, 100% { transform: translateY(0); }
  50%      { transform: translateY(-12px); }
}
```

## L’appliquer

```css
.titre {
  animation: apparition 0.6s ease-out both;
}
```

| Propriété | Rôle | Exemples |
|---|---|---|
| `animation-name` | Nom des keyframes | `apparition` |
| `animation-duration` | Durée | `0.6s` |
| `animation-timing-function` | Courbe | `ease-out` |
| `animation-delay` | Délai | `0.2s` |
| `animation-iteration-count` | Répétitions | `3`, `infinite` |
| `animation-direction` | Sens | `normal`, `alternate` |
| `animation-fill-mode` | État avant/après | `forwards`, `both` |
| `animation-play-state` | Pause | `paused` |

`fill-mode: both` : l’élément prend l’état de la première image pendant le délai, et garde l’état final après l’animation.

## Respecter les utilisateurs

Les animations peuvent provoquer nausées et vertiges chez certaines personnes (troubles vestibulaires). La règle :

```css
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
```

Autres principes : pas de clignotement rapide (plus de 3 fois par seconde), des animations **au service du sens** (attirer l’attention sur un changement, guider), jamais gratuites ni interminables.

> [!TIP] Les badges de cette plateforme « pop » avec une animation `@keyframes` quand vous les débloquez — sauf si vous avez activé la réduction des animations.', '@keyframes nom { from { … } to { … } }
.el { animation: nom 1s ease-in-out infinite; }', NULL, NULL, '<h2 class="titre">Bienvenue !</h2>
<div class="loader" role="status" aria-label="Chargement en cours"></div>
<span class="badge">Nouveau</span>', 'body { font-family: system-ui, sans-serif; display: grid; gap: 24px; justify-items: start; padding: 24px; }

@keyframes apparition {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: none; }
}

@keyframes rotation {
  to { transform: rotate(360deg); }
}

@keyframes pulsation {
  0%, 100% { transform: scale(1); }
  50%      { transform: scale(1.12); }
}

.titre { animation: apparition 0.7s ease-out both; }

.loader {
  width: 36px;
  height: 36px;
  border: 4px solid #e2e8f0;
  border-top-color: #6366f1;
  border-radius: 50%;
  animation: rotation 0.8s linear infinite;
}

.badge {
  padding: 4px 12px;
  border-radius: 999px;
  background: #f43f5e;
  color: white;
  animation: pulsation 1.5s ease-in-out 3;
}

@media (prefers-reduced-motion: reduce) {
  * { animation-duration: 0.01ms !important; animation-iteration-count: 1 !important; }
}', '[["@keyframes apparition {","Définition d’une animation nommée."],["  from { opacity: 0; transform: translateY(20px); }","Départ : invisible et décalé vers le bas."],[".titre { animation: apparition 0.7s ease-out both; }","Le titre apparaît en fondu au chargement."],["  animation: rotation 0.8s linear infinite;","Rotation continue à vitesse constante : indicateur de chargement."],["  animation: pulsation 1.5s ease-in-out 3;","Trois pulsations, puis arrêt (pas d’animation infinie inutile)."],["@media (prefers-reduced-motion: reduce) {","Neutralise les animations pour les utilisateurs qui le demandent."]]', '[["@keyframes","Définit les étapes."],["animation","Raccourci : nom durée courbe délai répétitions direction remplissage."],["infinite","Répétition sans fin."],["alternate","Aller-retour."],["forwards / both","Conserve l’état final."]]', '["Oublier `animation-duration` (valeur par défaut 0s : rien ne se passe).","Des animations infinies qui distraient de la lecture.","Ignorer `prefers-reduced-motion`.","Animer des propriétés coûteuses (`width`, `left`)."]', '["Des animations courtes et utiles.","`transform` et `opacity` en priorité.","Toujours prévoir `prefers-reduced-motion`."]', 'Les indicateurs de chargement, les « squelettes » de contenu qui scintillent pendant le chargement, les notifications qui glissent depuis le bord de l’écran utilisent `@keyframes`.', '["`@keyframes` définit les étapes, `animation` les applique.","Contrôle : durée, répétitions, direction, état final.","Animations utiles, courtes, et désactivables."]', 'Créez trois points de chargement qui rebondissent l’un après l’autre grâce à des `animation-delay` différents.', 1, 3),
(70, 28, 'Les ombres : box-shadow et text-shadow', 'les-ombres', 13, 'Les ombres donnent de la **profondeur** : une carte qui semble posée sur la page, un bouton qui se soulève, une fenêtre qui flotte au-dessus du contenu. Bien dosées, elles guident le regard ; trop marquées, elles alourdissent l’interface.', '["Maîtriser la syntaxe de `box-shadow`","Superposer plusieurs ombres","Créer une ombre intérieure","Utiliser `text-shadow` avec modération"]', '["Les couleurs en CSS"]', '## `box-shadow`

```css
box-shadow: décalage-x décalage-y flou étendue couleur;
box-shadow: 0 4px 12px 0 rgb(0 0 0 / 15%);
```

| Valeur | Rôle |
|---|---|
| décalage x | Horizontal (positif = vers la droite) |
| décalage y | Vertical (positif = vers le bas) |
| flou | Plus il est grand, plus l’ombre est douce |
| étendue (*spread*) | Agrandit (ou réduit si négatif) l’ombre |
| couleur | Presque toujours un noir **semi-transparent** |

## Des ombres réalistes

La lumière vient du haut : les ombres descendent (`y` positif). Une ombre douce est large, peu opaque, décalée vers le bas. Les designers superposent souvent **deux ombres** : une petite et nette (contact), une grande et diffuse (ambiance).

```css
.carte {
  box-shadow:
    0 1px 2px rgb(0 0 0 / 8%),
    0 8px 24px rgb(0 0 0 / 10%);
}
```

## Ombre intérieure et contour

- `inset` place l’ombre **à l’intérieur** : `box-shadow: inset 0 2px 4px rgb(0 0 0 / 10%);` (champ enfoncé) ;
- une ombre sans flou avec étendue crée un **contour** qui n’occupe pas de place : `box-shadow: 0 0 0 3px #93c5fd;` (anneau de focus).

## `text-shadow`

```css
h1 { text-shadow: 0 2px 4px rgb(0 0 0 / 40%); }
```

Même syntaxe, sans étendue ni `inset`. Utile pour améliorer la lisibilité d’un texte blanc sur une photo ; à éviter sur le texte courant.

> [!TIP] Sur un fond sombre (comme cette plateforme), les ombres se voient peu : on crée plutôt la profondeur avec des surfaces légèrement plus claires et des bordures subtiles.', 'box-shadow: 0 4px 12px rgb(0 0 0 / 15%);
text-shadow: 0 1px 2px rgb(0 0 0 / 50%);', NULL, NULL, '<div class="scene">
  <div class="carte">Ombre douce</div>
  <div class="carte elevee">Ombre en couches</div>
  <input class="champ" placeholder="Ombre intérieure" aria-label="Exemple">
  <button class="btn" type="button">Anneau de focus</button>
</div>', '.scene {
  display: flex;
  flex-wrap: wrap;
  gap: 24px;
  padding: 24px;
  background: #f1f5f9;
  font-family: system-ui, sans-serif;
}

.carte {
  padding: 24px;
  border-radius: 12px;
  background: white;
  box-shadow: 0 4px 12px rgb(0 0 0 / 10%);
}

.elevee {
  box-shadow:
    0 1px 2px rgb(0 0 0 / 8%),
    0 16px 32px rgb(0 0 0 / 14%);
}

.champ {
  padding: 10px;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  box-shadow: inset 0 2px 4px rgb(0 0 0 / 8%);
}

.btn {
  padding: 10px 16px;
  border: 0;
  border-radius: 8px;
  background: #2563eb;
  color: white;
  box-shadow: 0 0 0 4px #bfdbfe;
}', '[["  box-shadow: 0 4px 12px rgb(0 0 0 / 10%);","Ombre douce décalée vers le bas."],["    0 1px 2px rgb(0 0 0 / 8%),","Première couche : ombre de contact nette."],["    0 16px 32px rgb(0 0 0 / 14%);","Seconde couche : ombre d’ambiance diffuse."],["  box-shadow: inset 0 2px 4px …;","Ombre intérieure : le champ semble creusé."],["  box-shadow: 0 0 0 4px #bfdbfe;","Sans flou, avec étendue : un anneau qui n’occupe pas de place."]]', '[["box-shadow","x y flou étendue couleur (et `inset`)."],["text-shadow","x y flou couleur."],["inset","Ombre intérieure."]]', '["Des ombres noires opaques (`#000`) très dures.","Des ombres vers le haut ou à gauche incohérentes.","Du `text-shadow` sur des paragraphes (lisibilité dégradée)."]', '["Couleurs d’ombre semi-transparentes.","Une échelle de 3 ou 4 niveaux d’élévation dans le projet.","Animer l’ombre au survol pour suggérer le soulèvement."]', 'Les systèmes de design (Material Design, par exemple) définissent des niveaux d’« élévation » : chaque niveau correspond à une ombre précise, utilisée de façon cohérente pour les cartes, menus et fenêtres modales.', '["`box-shadow: x y flou étendue couleur`.","Ombres douces, semi-transparentes, superposables.","`inset` pour l’intérieur ; étendue sans flou pour un anneau."]', 'Créez trois cartes avec trois niveaux d’élévation, et une animation de l’ombre au survol.', 1, 1);

INSERT INTO `lessons` (`id`, `module_id`, `title`, `slug`, `duration_minutes`, `introduction`, `objectives`, `prerequisites`, `theory`, `syntax_code`, `simple_html`, `simple_css`, `example_html`, `example_css`, `line_by_line`, `reference_items`, `common_mistakes`, `best_practices`, `practical`, `summary_points`, `challenge`, `is_published`, `sort_order`) VALUES
(71, 28, 'Les dégradés', 'les-degrades', 14, 'Des fonds vibrants, des boutons lumineux, un texte multicolore, des motifs sans aucun fichier image : les **dégradés CSS** sont des images générées par le navigateur. Ils sont légers, nets à toutes les tailles et faciles à modifier.', '["Créer des dégradés linéaires, radiaux et coniques","Contrôler direction et arrêts de couleur","Créer un texte en dégradé","Superposer dégradés et images"]', '["Les arrière-plans","Les ombres"]', '## Un dégradé est une image

Il s’utilise partout où une image est acceptée : `background-image` (ou `background`), `border-image`, `mask`…

## `linear-gradient()`

```css
background: linear-gradient(135deg, #4f46e5, #0ea5e9);
```

- **direction** : un angle (`90deg` = vers la droite) ou des mots-clés (`to right`, `to bottom right`) ;
- **arrêts de couleur** : autant de couleurs que souhaité, avec une position facultative :

```css
background: linear-gradient(to right, #f97316 0%, #facc15 50%, #22c55e 100%);
```

Deux couleurs à la **même position** créent une transition **nette** (rayures) :

```css
background: linear-gradient(to right, #1e3a8a 50%, #dc2626 50%);
```

## `radial-gradient()`

Part du centre (ou d’un point choisi) vers l’extérieur :

```css
background: radial-gradient(circle at top left, #fde68a, transparent 60%);
```

## `conic-gradient()`

Tourne autour d’un point : idéal pour les diagrammes circulaires et les anneaux de progression.

```css
background: conic-gradient(#22c55e 0 70%, #e5e7eb 70% 100%);
```

## Texte en dégradé

```css
.titre {
  background: linear-gradient(90deg, #f97316, #db2777);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}
```

Le titre principal de la page d’accueil de cette plateforme utilise cette technique.

## Superposer

```css
background:
  linear-gradient(rgb(0 0 0 / 50%), rgb(0 0 0 / 50%)),
  url("photo.jpg") center / cover;
```

> [!WARN] Vérifiez le contraste du texte sur **toutes** les zones du dégradé, pas seulement sur la plus favorable.', 'background: linear-gradient(135deg, #4f46e5, #0ea5e9);
background: radial-gradient(circle, #fff, #000);
background: conic-gradient(red, blue);', NULL, NULL, '<div class="demo">
  <div class="tuile lineaire">linéaire</div>
  <div class="tuile radial">radial</div>
  <div class="tuile conique" role="img" aria-label="Progression : 70 %">70 %</div>
  <div class="tuile rayures">rayures</div>
</div>
<h1 class="titre">Texte en dégradé</h1>', 'body { font-family: system-ui, sans-serif; padding: 16px; }
.demo { display: flex; flex-wrap: wrap; gap: 16px; }

.tuile {
  width: 120px;
  height: 120px;
  display: grid;
  place-items: center;
  border-radius: 16px;
  color: white;
  font-weight: bold;
}

.lineaire { background: linear-gradient(135deg, #4f46e5, #0ea5e9); }
.radial   { background: radial-gradient(circle at 30% 30%, #f472b6, #7c3aed); }
.conique  { border-radius: 50%; background: conic-gradient(#22c55e 0 70%, #cbd5e1 70% 100%); color: #14532d; }
.rayures  { background: repeating-linear-gradient(45deg, #0f172a 0 10px, #334155 10px 20px); }

.titre {
  font-size: 2.5rem;
  background: linear-gradient(90deg, #f97316, #db2777, #7c3aed);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}', '[[".lineaire { background: linear-gradient(135deg, …); }","Dégradé en diagonale."],[".radial { … radial-gradient(circle at 30% 30%, …) }","Cercle lumineux décentré."],[".conique { … conic-gradient(#22c55e 0 70%, #cbd5e1 70% 100%) }","Anneau de progression à 70 % (arrêts nets)."],["repeating-linear-gradient(45deg, …)","Motif de rayures répété."],["  background-clip: text; color: transparent;","Le dégradé n’est visible qu’à travers les lettres."]]', '[["linear-gradient()","Dégradé linéaire (angle ou `to …`)."],["radial-gradient()","Dégradé circulaire ou elliptique."],["conic-gradient()","Dégradé autour d’un point."],["repeating-*-gradient()","Motifs répétés."],["background-clip: text","Dégradé dans le texte."]]', '["Utiliser `background-color` pour un dégradé (il faut `background` ou `background-image`).","Des dégradés trop contrastés qui nuisent à la lisibilité du texte.","Oublier la version préfixée `-webkit-background-clip` pour le texte."]', '["Des dégradés entre couleurs proches pour un rendu élégant.","Une couleur de fond de secours.","Vérifier le contraste sur tout le dégradé."]', 'Les boutons d’appel à l’action des sites de produits numériques, les fonds de sections « héro » et les graphiques en anneau des tableaux de bord utilisent des dégradés CSS : aucun fichier image à charger.', '["Linéaire, radial, conique : des images générées.","Direction + arrêts de couleur.","Arrêts identiques = transition nette.","`background-clip: text` pour un texte en dégradé."]', 'Créez un bouton dont le dégradé change d’angle au survol, et un fond de page avec deux halos radiaux colorés.', 1, 2),
(72, 29, 'Les variables CSS', 'variables-css', 15, 'Votre couleur principale apparaît 40 fois dans la feuille de style. Le client veut la changer. Avec les **variables CSS** (propriétés personnalisées), il suffit de modifier **une ligne**. Elles permettent aussi de créer un thème sombre, des variantes de composants et des designs systems cohérents.', '["Déclarer et utiliser une variable","Comprendre leur portée et leur héritage","Prévoir une valeur de repli","Créer un thème clair/sombre"]', '["Cascade, spécificité et héritage","Les media queries"]', '## Déclarer et utiliser

```css
:root {
  --couleur-primaire: #4f46e5;
  --rayon: 12px;
  --espace: 1.5rem;
}

.btn {
  background: var(--couleur-primaire);
  border-radius: var(--rayon);
  padding: calc(var(--espace) / 2) var(--espace);
}
```

- le nom commence par **deux tirets** `--` ;
- `:root` désigne l’élément racine (`<html>`) : les variables y sont disponibles **partout** ;
- `var(--nom)` lit la valeur.

## Valeur de repli

```css
color: var(--couleur-texte, #111);
```

Si `--couleur-texte` n’est pas définie, `#111` est utilisée.

## Portée et héritage

Les variables suivent la **cascade** : on peut les redéfinir sur un élément, et ses descendants hériteront de la nouvelle valeur.

```css
.btn { background: var(--btn-fond, #4f46e5); }
.btn--danger { --btn-fond: #dc2626; }
```

C’est la technique idéale pour les **variantes** de composants : on ne réécrit que la variable.

## Un thème sombre en quelques lignes

```css
:root {
  --fond: #ffffff;
  --texte: #0f172a;
}

@media (prefers-color-scheme: dark) {
  :root {
    --fond: #0f172a;
    --texte: #e2e8f0;
  }
}

body { background: var(--fond); color: var(--texte); }
```

## Calculer avec `calc()`

```css
.carte { padding: calc(var(--espace) * 2); }
```

> [!INFO] Variables CSS et variables Sass (`$couleur`) sont différentes : les variables Sass disparaissent à la compilation, les variables CSS existent **dans le navigateur** et peuvent changer selon le contexte (media query, classe, JavaScript).

Toute la charte graphique de cette plateforme est définie en variables sur `:root` : `--bg`, `--surface`, `--primary`, `--html`, `--css`…', ':root { --nom: valeur; }
.el { propriété: var(--nom, repli); }', NULL, NULL, '<div class="carte">
  <h2>Offre Découverte</h2>
  <p>Tous les cours pendant 30 jours.</p>
  <a class="btn" href="#">Essayer</a>
  <a class="btn btn--secondaire" href="#">En savoir plus</a>
</div>
<div class="carte theme-sombre">
  <h2>Même composant, thème sombre</h2>
  <p>Seules les variables changent.</p>
  <a class="btn" href="#">Essayer</a>
</div>', ':root {
  --primaire: #4f46e5;
  --fond: #ffffff;
  --texte: #1e293b;
  --rayon: 12px;
  --espace: 1rem;
}

.theme-sombre {
  --fond: #0f172a;
  --texte: #e2e8f0;
  --primaire: #818cf8;
}

body { font-family: system-ui, sans-serif; display: grid; gap: var(--espace); padding: var(--espace); }

.carte {
  padding: calc(var(--espace) * 1.5);
  border-radius: var(--rayon);
  background: var(--fond);
  color: var(--texte);
  border: 1px solid #cbd5e1;
}

.btn {
  display: inline-block;
  padding: calc(var(--espace) / 2) var(--espace);
  border-radius: calc(var(--rayon) / 2);
  background: var(--btn-fond, var(--primaire));
  color: white;
  text-decoration: none;
}

.btn--secondaire { --btn-fond: #64748b; }', '[[":root {","Variables globales, disponibles partout."],["  --primaire: #4f46e5;","Déclaration : deux tirets + nom."],[".theme-sombre { --fond: #0f172a; … }","Redéfinition locale : les descendants héritent des nouvelles valeurs."],["  padding: calc(var(--espace) * 1.5);","Calcul à partir d’une variable."],["  background: var(--btn-fond, var(--primaire));","Variable avec valeur de repli (elle-même une variable)."],[".btn--secondaire { --btn-fond: #64748b; }","Variante : on change seulement la variable."]]', '[["--nom: valeur","Déclaration d’une variable."],["var(--nom, repli)","Utilisation avec valeur de repli."],[":root","Élément racine : portée globale."],["calc()","Calculs avec unités et variables."]]', '["Oublier les deux tirets : `-couleur` ou `couleur`.","Oublier `var()` : `color: --primaire;`.","Déclarer une variable dans un sélecteur trop spécifique et ne pas y avoir accès ailleurs.","Des noms trop liés à la valeur (`--bleu`) plutôt qu’au rôle (`--primaire`)."]', '["Définir couleurs, espacements, rayons et typographies en variables sur `:root`.","Nommer selon le rôle.","Utiliser des variables locales pour les variantes de composants."]', 'Changer le thème d’une application (clair/sombre, couleurs d’une marque cliente) se résume souvent à redéfinir une dizaine de variables : c’est la base des systèmes de thèmes modernes.', '["`--nom: valeur` pour déclarer, `var(--nom)` pour utiliser.","Portée et héritage suivent la cascade.","Idéal pour thèmes et variantes."]', 'Créez un thème sombre complet pour une page existante uniquement en redéfinissant des variables dans `@media (prefers-color-scheme: dark)`.', 1, 1),
(73, 29, 'Organiser une feuille de style', 'organiser-une-feuille-css', 14, 'Une feuille CSS de 50 lignes se lit facilement. À 3 000 lignes, sans organisation, elle devient un cauchemar : styles en double, règles qui s’écrasent, peur de supprimer quoi que ce soit. Quelques principes d’**architecture CSS** gardent un projet maintenable.', '["Structurer une feuille en sections logiques","Appliquer une convention de nommage (BEM)","Maintenir une spécificité faible","Découvrir le découpage en fichiers"]', '["Les variables CSS"]', '## Du général au particulier

Organisez la feuille par couches, du plus global au plus spécifique :

1. **Variables** (`:root`) : couleurs, espacements, typographies ;
2. **Reset / base** : `box-sizing`, marges, styles des balises (`body`, `h1`, `a`, `img`) ;
3. **Mise en page** : conteneurs, grilles, en-tête, pied de page ;
4. **Composants** : boutons, cartes, formulaires, badges ;
5. **Utilitaires** : petites classes à usage unique (`.sr-only`, `.text-center`) ;
6. **Media queries** : à la fin de chaque composant, ou regroupées.

C’est exactement la structure de la feuille `main.css` de cette plateforme, avec une table des matières en commentaire.

## Nommer : BEM

```css
.carte { }                   /* bloc */
.carte__titre { }            /* élément */
.carte--promo { }            /* modificateur */
```

Avantages : les classes sont uniques, explicites, et chaque sélecteur a la même spécificité faible (une classe).

## Garder une spécificité faible

- stylez avec des **classes**, pas des id ;
- évitez les sélecteurs imbriqués profonds (`.page .contenu .article .texte p`) ;
- n’utilisez pas `!important` (sauf utilitaires).

## Découper en fichiers

Sur un gros projet, on sépare : `variables.css`, `base.css`, `layout.css`, `components/button.css`… Ils sont ensuite regroupés en un seul fichier pour la production (par un outil de build ou avec `@import` / `@layer`).

## Éviter la duplication

Avant d’écrire une nouvelle règle, cherchez si un composant ou une variable existe déjà. Préférez composer des classes (`class="btn btn--large"`) plutôt que de dupliquer un bloc de 15 déclarations.

## L’ordre des propriétés

Une convention courante regroupe les propriétés par famille : positionnement, modèle de boîte, typographie, apparence, animation. L’important : que toute l’équipe suive la même.', '/* 1. Variables */ :root { … }
/* 2. Base */ body { … }
/* 3. Layout */ .container { … }
/* 4. Composants */ .btn { … }
/* 5. Utilitaires */ .sr-only { … }', NULL, NULL, '<main class="container">
  <article class="carte carte--promo">
    <h2 class="carte__titre">Offre spéciale</h2>
    <p class="carte__texte">-30 % sur l’abonnement annuel.</p>
    <a class="btn btn--large" href="#">J’en profite</a>
  </article>
</main>', '/* ========== 1. Variables ========== */
:root {
  --c-primaire: #7c3aed;
  --c-promo: #f59e0b;
  --rayon: 12px;
  --espace: 1rem;
}

/* ========== 2. Base ========== */
*, *::before, *::after { box-sizing: border-box; }
body { margin: 0; font-family: system-ui, sans-serif; line-height: 1.6; }

/* ========== 3. Layout ========== */
.container { width: min(100% - 2rem, 720px); margin: 2rem auto; }

/* ========== 4. Composants ========== */
/* Carte */
.carte { padding: calc(var(--espace) * 1.5); border-radius: var(--rayon); border: 1px solid #e2e8f0; }
.carte--promo { border-color: var(--c-promo); background: #fffbeb; }
.carte__titre { margin-top: 0; }

/* Bouton */
.btn { display: inline-block; padding: 0.5em 1em; border-radius: calc(var(--rayon) / 2); background: var(--c-primaire); color: white; text-decoration: none; }
.btn--large { font-size: 1.125rem; padding: 0.75em 1.5em; }

/* ========== 5. Utilitaires ========== */
.sr-only { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); }', '[["/* ========== 1. Variables ========== */","Sections clairement délimitées par des commentaires."],["*, *::before, *::after { box-sizing: border-box; }","Base : réglages globaux."],[".container { … }","Mise en page."],[".carte--promo { … }","Modificateur BEM : variante de la carte."],[".carte__titre { … }","Élément BEM du bloc carte."],[".btn--large { … }","Composition : `class=\\"btn btn--large\\"`."]]', '[["Couches","Variables > base > layout > composants > utilitaires."],["BEM","`bloc__element--modificateur`."],["@layer","Ordonne explicitement des couches de cascade (CSS moderne)."],["@import","Importe une autre feuille de style."]]', '["Ajouter systématiquement les nouvelles règles à la fin du fichier.","Dupliquer des blocs de styles.","Des sélecteurs longs et imbriqués.","Des noms de classes incohérents (`.btnRouge`, `.bouton-bleu`, `.Button`)."]', '["Une table des matières en tête de fichier.","Une convention de nommage unique.","Des composants réutilisables et composables."]', 'Les grandes équipes documentent leurs composants dans une bibliothèque vivante (comme Storybook) : chaque composant a sa feuille de style isolée, ses variantes et ses exemples d’utilisation.', '["Du général au particulier : variables, base, layout, composants, utilitaires.","BEM pour des noms clairs et une spécificité faible.","Réutiliser avant d’écrire."]', 'Réorganisez la feuille CSS de votre projet « landing page » selon les cinq couches, avec une table des matières.', 1, 2),
(74, 30, 'Créer un composant carte complet', 'creer-un-composant-carte', 18, 'La **carte** est le composant roi des interfaces modernes : produit, article, profil, offre tarifaire… Construire une carte de A à Z mobilise presque tout ce que vous avez appris : HTML sémantique, box model, Flexbox, variables, ombres, transitions, responsive et accessibilité. C’est le moment de tout assembler.', '["Concevoir la structure HTML d’un composant","Styler un composant réutilisable avec variables et BEM","Rendre toute la carte cliquable de façon accessible","Ajouter des états interactifs soignés"]', '["Toutes les leçons CSS précédentes"]', '## 1. La structure HTML

```html
<article class="carte">
  <img class="carte__image" src="…" alt="…">
  <div class="carte__corps">
    <p class="carte__categorie">Tutoriel</p>
    <h3 class="carte__titre"><a href="…">Maîtriser Flexbox</a></h3>
    <p class="carte__resume">…</p>
    <p class="carte__meta">12 min de lecture</p>
  </div>
</article>
```

- `<article>` : la carte est un contenu autonome ;
- le lien est placé **sur le titre** (un texte explicite) plutôt qu’autour de toute la carte.

## 2. Toute la carte cliquable… proprement

On étend la zone cliquable du lien à toute la carte avec un pseudo-élément :

```css
.carte { position: relative; }
.carte__titre a::after {
  content: "";
  position: absolute;
  inset: 0;
}
```

Le lecteur d’écran annonce un seul lien au texte clair, et la souris peut cliquer n’importe où.

## 3. Mise en page interne

Flexbox en colonne, et `margin-top: auto` sur la méta pour la coller en bas, même si les résumés ont des longueurs différentes :

```css
.carte { display: flex; flex-direction: column; }
.carte__corps { display: flex; flex-direction: column; flex: 1; }
.carte__meta { margin-top: auto; }
```

## 4. Les états

- survol : légère élévation (`transform` + `box-shadow`) ;
- focus clavier : `.carte:focus-within` affiche un contour quand le lien a le focus.

## 5. Les images

`aspect-ratio` + `object-fit: cover` : toutes les cartes ont la même hauteur d’image.

## 6. La grille

```css
.grille { display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 260px), 1fr)); gap: 1.5rem; }
```

> [!TIP] Un composant bien conçu fonctionne **quel que soit son contenu** : titre très long, pas d’image, résumé vide. Testez ces cas limites.', '.carte { position: relative; display: flex; flex-direction: column; }
.carte__titre a::after { content: ""; position: absolute; inset: 0; }
.carte:focus-within { outline: 3px solid …; }', NULL, NULL, '<section class="grille">
  <article class="carte">
    <img class="carte__image" src="https://placehold.co/600x400/png?text=Flexbox" alt="">
    <div class="carte__corps">
      <p class="carte__categorie">Tutoriel</p>
      <h3 class="carte__titre"><a href="#">Maîtriser Flexbox en 10 exemples</a></h3>
      <p class="carte__resume">Alignements, espacements et grilles souples expliqués pas à pas.</p>
      <p class="carte__meta">12 min de lecture</p>
    </div>
  </article>
  <article class="carte">
    <img class="carte__image" src="https://placehold.co/600x400/png?text=Grid" alt="">
    <div class="carte__corps">
      <p class="carte__categorie">Guide</p>
      <h3 class="carte__titre"><a href="#">CSS Grid : le guide complet</a></h3>
      <p class="carte__resume">Des zones nommées aux grilles adaptatives.</p>
      <p class="carte__meta">20 min de lecture</p>
    </div>
  </article>
</section>', ':root {
  --c-accent: #7c3aed;
  --rayon: 16px;
}

body { font-family: system-ui, sans-serif; background: #f8fafc; padding: 16px; }

.grille {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr));
  gap: 1.5rem;
}

.carte {
  position: relative;
  display: flex;
  flex-direction: column;
  overflow: hidden;
  border-radius: var(--rayon);
  background: white;
  box-shadow: 0 2px 8px rgb(15 23 42 / 8%);
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.carte:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 28px rgb(15 23 42 / 14%);
}

.carte:focus-within {
  outline: 3px solid var(--c-accent);
  outline-offset: 2px;
}

.carte__image {
  width: 100%;
  aspect-ratio: 3 / 2;
  object-fit: cover;
}

.carte__corps {
  display: flex;
  flex-direction: column;
  flex: 1;
  gap: 0.4rem;
  padding: 1.25rem;
}

.carte__corps p { margin: 0; }
.carte__categorie { color: var(--c-accent); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; }
.carte__titre { margin: 0; font-size: 1.15rem; }
.carte__titre a { color: #0f172a; text-decoration: none; }
.carte__titre a:focus { outline: none; }
.carte__titre a::after { content: ""; position: absolute; inset: 0; }
.carte__resume { color: #475569; }
.carte__meta { margin-top: auto !important; padding-top: 0.5rem; color: #94a3b8; font-size: 0.85rem; }

@media (prefers-reduced-motion: reduce) {
  .carte { transition: none; }
}', '[["  position: relative;","Repère pour le pseudo-élément qui étend le lien."],["  display: flex; flex-direction: column;","Contenu empilé verticalement."],[".carte:focus-within {","Contour visible quand le lien interne a le focus clavier."],["  aspect-ratio: 3 / 2; object-fit: cover;","Images homogènes quelles que soient leurs proportions."],[".carte__titre a::after { content: \\"\\"; position: absolute; inset: 0; }","La zone cliquable du lien couvre toute la carte."],[".carte__meta { margin-top: auto … }","La méta est poussée en bas de la carte."],["@media (prefers-reduced-motion: reduce)","Pas d’animation pour ceux qui ne le souhaitent pas."]]', '[[":focus-within","L’élément ou un de ses descendants a le focus."],["inset: 0","Couvre tout le parent positionné."],["margin-top: auto","Pousse un élément flex vers le bas."]]', '["Envelopper toute la carte dans un `<a>` contenant titres et paragraphes : le lecteur d’écran lit tout le contenu comme nom du lien.","Plusieurs liens vers la même destination dans une carte (image, titre, bouton « Lire »).","Des cartes de hauteurs différentes à cause des images.","Oublier l’état de focus."]', '["Un seul lien par carte, étendu avec `::after`.","Variables pour les couleurs et arrondis.","Tester les cas limites de contenu."]', 'Les cartes de cours de cette plateforme suivent ce modèle : un lien principal, un contenu empilé en Flexbox, une élévation au survol et un contour au focus.', '["HTML sémantique d’abord (`article`, titre, lien explicite).","Lien étendu à toute la carte avec `::after`.","Flexbox + `margin-top: auto`, images homogènes, états hover et focus."]', 'Créez une carte tarifaire « Pro » mise en avant (badge, bordure colorée, bouton) et deux cartes standard, alignées dans une grille responsive.', 1, 1),
(75, 30, 'Bonnes pratiques CSS et performance', 'bonnes-pratiques-css-performance', 14, 'Vous voici à la dernière leçon du parcours ! Pour conclure, voici les réflexes des intégrateurs professionnels : un CSS **performant**, **accessible**, **compatible** et **maintenable**. C’est cette check-list qui fait la différence dans un vrai projet.', '["Optimiser le chargement du CSS","Vérifier la compatibilité des propriétés","Appliquer une check-list qualité complète"]', '["Créer un composant carte complet"]', '## Performance

- **Une ou deux feuilles** pour tout le site, **minifiées** (espaces et commentaires retirés) et **compressées** (gzip/brotli) par le serveur ;
- un **cache** long grâce à un numéro de version dans l’URL (`style.css?v=123`) : cette plateforme ajoute automatiquement la date de modification du fichier ;
- des **polices** limitées, au format WOFF2, avec `font-display: swap` pour que le texte reste visible pendant leur chargement ;
- animer `transform` et `opacity` plutôt que les dimensions ;
- supprimer le CSS inutilisé (les outils de développement ont un onglet *Coverage*).

## Compatibilité

Le site [caniuse.com](https://caniuse.com) indique quels navigateurs supportent chaque propriété. Pour une propriété récente, prévoyez une **solution de repli** :

```css
.carte {
  background: #4f46e5;                                  /* repli */
  background: color-mix(in srgb, #4f46e5 80%, white);   /* moderne */
}
```

`@supports` teste le support d’une fonctionnalité :

```css
@supports (display: grid) { … }
```

## Accessibilité

- contrastes de 4,5:1 minimum ;
- focus visible sur tous les éléments interactifs ;
- `prefers-reduced-motion` respecté ;
- pas de texte en `px` fixe trop petit, zoom à 200 % fonctionnel ;
- pas d’information transmise uniquement par la couleur.

## Maintenabilité

- variables pour la charte graphique ;
- convention de nommage (BEM) ;
- spécificité faible, pas de `!important` ;
- feuille organisée et commentée.

## La check-list finale

- [ ] Aucun défilement horizontal de 320px à 1440px
- [ ] Focus visible partout, navigation clavier testée
- [ ] Contrastes vérifiés
- [ ] Animations désactivables
- [ ] Images fluides
- [ ] CSS validé ([validateur CSS du W3C](https://jigsaw.w3.org/css-validator/))
- [ ] Audit Lighthouse > 90 en performance et accessibilité

> [!TIP] Félicitations : en validant cette leçon, vous avez parcouru l’ensemble du programme. Terminez les projets pratiques, puis obtenez votre certificat depuis votre tableau de bord !', '@supports (propriété: valeur) { … }
@font-face { font-display: swap; }', NULL, NULL, '<main class="page">
  <h1>Check-list qualité</h1>
  <ul class="checklist">
    <li class="ok">Responsive de 320 à 1440px</li>
    <li class="ok">Focus visible</li>
    <li class="ok">Contrastes vérifiés</li>
    <li>Audit Lighthouse</li>
  </ul>
</main>', ':root { --ok: #15803d; --a-faire: #b45309; }

.page { width: min(100% - 2rem, 640px); margin: 2rem auto; font-family: system-ui, sans-serif; }

.checklist { list-style: none; padding: 0; display: grid; gap: 0.5rem; }

.checklist li {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  padding: 0.75rem 1rem;
  border-radius: 10px;
  background: #fffbeb;
  color: var(--a-faire);
}

/* L’état est porté par le texte ET une icône, pas seulement la couleur */
.checklist li::before { content: "○"; font-weight: bold; }
.checklist li.ok { background: #f0fdf4; color: var(--ok); }
.checklist li.ok::before { content: "✓"; }

@supports (background: color-mix(in srgb, red 50%, white)) {
  .checklist li.ok { background: color-mix(in srgb, var(--ok) 8%, white); }
}', '[[":root { --ok: …; --a-faire: …; }","Couleurs d’état centralisées."],[".checklist li::before { content: \\"○\\"; }","L’état est aussi indiqué par un symbole, pas seulement la couleur."],[".checklist li.ok::before { content: \\"✓\\"; }","Symbole différent pour les éléments validés."],["@supports (background: color-mix(…)) {","Amélioration appliquée seulement si le navigateur la supporte."]]', '[["@supports","Teste le support d’une fonctionnalité."],["font-display: swap","Texte visible pendant le chargement de la police."],["caniuse.com","Compatibilité des fonctionnalités."],["Minification","Suppression des caractères inutiles pour la production."]]', '["Charger plusieurs feuilles CSS volumineuses inutilisées.","Utiliser une propriété récente sans repli pour un public large.","Négliger l’accessibilité « parce que ça s’affiche bien »."]', '["Mesurer avec Lighthouse avant et après les modifications.","Amélioration progressive : une base qui fonctionne partout, des enrichissements modernes.","Suivre une check-list avant chaque mise en ligne."]', 'Les agences livrent un site avec un rapport Lighthouse et un audit d’accessibilité. Maîtriser cette check-list vous permet de livrer un travail professionnel dès vos premiers projets.', '["Performance : peu de fichiers, minifiés, mis en cache ; animations légères.","Compatibilité : caniuse, replis, `@supports`.","Accessibilité et maintenabilité jusqu’au bout."]', 'Passez l’audit Lighthouse sur votre projet final et atteignez un score d’au moins 90 en Performance et 100 en Accessibilité.', 1, 2);

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
(9, 6, 'Les commentaires sont-ils secrets ?', 'commentaires-et-indentation-ex2', 'truefalse', 1, 'Vrai ou faux ?', NULL, NULL, NULL, NULL, NULL, NULL, 'Faux : le code source (commentaires compris) est accessible à n’importe qui via « Afficher le code source ».', 10, 2),
(10, 7, 'Construire un plan', 'les-titres-h1-h6-ex1', 'code', 1, 'Créez un plan de page : un `<h1>` **Mes voyages**, puis deux `<h2>` : **Europe** et **Asie**. Sous « Europe », ajoutez un `<h3>` **Italie**.', NULL, NULL, '<h1>Mes voyages</h1>
<h2>Europe</h2>
<h3>Italie</h3>
<h2>Asie</h2>', NULL, '[{"t":"el","sel":"h1","count":1,"text":"Mes voyages","msg":"Un unique <h1> « Mes voyages »"},{"t":"el","sel":"h2","text":"Europe","msg":"Un <h2> « Europe »"},{"t":"el","sel":"h2","text":"Asie","msg":"Un <h2> « Asie »"},{"t":"el","sel":"h3","text":"Italie","msg":"Un <h3> « Italie »"},{"t":"match","re":"Europe\\\\s*</h2>\\\\s*<h3[^>]*>\\\\s*Italie","msg":"Le <h3> « Italie » est placé juste après « Europe »"}]', 'L’ordre du code est important : le `<h3>` doit suivre le `<h2>` dont il dépend.', 'Le `<h3>` « Italie » dépend du `<h2>` « Europe » qui le précède ; « Asie » ouvre ensuite une nouvelle section de niveau 2.', 15, 1),
(11, 7, 'Hiérarchie des titres', 'les-titres-h1-h6-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'On descend d’un seul niveau à la fois : une sous-partie d’un `h2` est un `h3`.', 10, 2),
(12, 8, 'Deux paragraphes', 'les-paragraphes-ex1', 'code', 1, 'Sous le titre, écrivez **deux paragraphes** distincts. Le premier doit contenir le mot **HTML**, le second le mot **CSS**.', '<h1>Mes premiers pas</h1>', NULL, '<h1>Mes premiers pas</h1>
<p>J’apprends le HTML pour structurer mes pages.</p>
<p>Ensuite, j’apprendrai le CSS pour les mettre en forme.</p>', NULL, '[{"t":"el","sel":"p","min":2,"msg":"Au moins deux paragraphes <p>"},{"t":"el","sel":"p","contains":"HTML","msg":"Un paragraphe contient « HTML »"},{"t":"el","sel":"p","contains":"CSS","msg":"Un paragraphe contient « CSS »"}]', 'Chaque paragraphe a sa propre paire `<p>` … `</p>`.', 'Deux idées distinctes forment deux paragraphes : on ferme le premier `</p>` avant d’ouvrir le second.', 15, 1),
(13, 8, 'Un titre dans un paragraphe ?', 'les-paragraphes-ex2', 'fix', 2, 'Ce code place un titre à l’intérieur d’un paragraphe, ce qui est invalide. Corrigez-le : le `<h2>` doit être placé **avant** le paragraphe, pas dedans.', '<p><h2>Horaires</h2>Ouvert tous les jours de 9 h à 18 h.</p>', NULL, '<h2>Horaires</h2>
<p>Ouvert tous les jours de 9 h à 18 h.</p>', NULL, '[{"t":"match","re":"</h2>\\\\s*<p","msg":"Le paragraphe commence après le titre"},{"t":"el","sel":"p","contains":"Ouvert tous les jours","msg":"Le texte des horaires est dans un paragraphe"},{"t":"absent","s":"<p><h2>","msg":"Le titre n’est plus dans le paragraphe"}]', 'Écrivez d’abord `<h2>Horaires</h2>`, puis `<p>…</p>`.', 'Un paragraphe ne peut contenir que des éléments en ligne ; un titre est un élément bloc indépendant.', 10, 2),
(14, 9, 'Une adresse postale', 'sauts-de-ligne-et-separateurs-ex1', 'code', 1, 'Dans **un seul paragraphe**, écrivez une adresse sur trois lignes (nom, rue, ville) en utilisant **deux** balises `<br>`.', NULL, NULL, '<p>
  Marie Curie<br>
  11 rue Pierre et Marie Curie<br>
  75005 Paris
</p>', NULL, '[{"t":"el","sel":"p","count":1,"msg":"Un seul paragraphe"},{"t":"el","sel":"p br","min":2,"msg":"Au moins deux <br> dans le paragraphe"},{"t":"absent","s":"</br>","msg":"Pas de balise fermante </br> (élément vide)"}]', 'Écrivez `<br>` à la fin de la première et de la deuxième ligne.', 'Une adresse est un seul bloc d’information : un paragraphe avec des sauts de ligne `<br>`.', 15, 1),
(15, 10, 'Signaler une information importante', 'strong-et-em-ex1', 'code', 1, 'Dans le paragraphe, entourez le mot **Attention** avec la balise d’importance, et le mot **jamais** avec la balise d’emphase.', '<p>Attention : ne laissez jamais un enfant seul près de l’eau.</p>', NULL, '<p><strong>Attention</strong> : ne laissez <em>jamais</em> un enfant seul près de l’eau.</p>', NULL, '[{"t":"el","sel":"p strong","text":"Attention","msg":"« Attention » est dans <strong>"},{"t":"el","sel":"p em","text":"jamais","msg":"« jamais » est dans <em>"},{"t":"noel","sel":"b, i","msg":"Pas de <b> ni de <i> (on veut un sens, pas seulement un style)"}]', '`<strong>` pour l’importance, `<em>` pour l’emphase.', 'L’avertissement est important (`strong`) et le mot « jamais » porte l’accentuation de la phrase (`em`).', 15, 1),
(16, 11, 'Formule et abréviation', 'autres-balises-de-texte-ex1', 'code', 2, 'Écrivez un paragraphe contenant la formule du dioxyde de carbone **CO₂** avec le 2 en indice (`<sub>`), puis l’abréviation **ONU** avec sa forme longue **Organisation des Nations unies** dans l’attribut `title`.', '<p></p>', NULL, '<p>Le CO<sub>2</sub> est un sujet majeur pour l’<abbr title="Organisation des Nations unies">ONU</abbr>.</p>', NULL, '[{"t":"el","sel":"p sub","text":"2","msg":"Le chiffre 2 est en indice avec <sub>"},{"t":"match","re":"CO<sub>2</sub>","msg":"La formule s’écrit CO<sub>2</sub>"},{"t":"el","sel":"abbr","text":"ONU","msg":"Une abréviation <abbr> contient « ONU »"},{"t":"attr","sel":"abbr","attr":"title","value":"Organisation des Nations unies","msg":"Le title donne la forme longue"}]', '`CO<sub>2</sub>` et `<abbr title="…">ONU</abbr>`.', '`<sub>` place le texte en indice ; `<abbr>` associe une abréviation à sa signification via `title`.', 15, 1),
(17, 11, 'Afficher une balise comme du texte', 'autres-balises-de-texte-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'Les entités `&lt;` et `&gt;` sont affichées comme `<` et `>` sans être interprétées comme une balise.', 10, 2),
(18, 12, 'Votre premier lien', 'creer-un-lien-ex1', 'code', 1, 'Créez un lien vers `https://www.wikipedia.org` dont le texte est **Wikipédia**.', '<p>Mon encyclopédie préférée : </p>', NULL, '<p>Mon encyclopédie préférée : <a href="https://www.wikipedia.org">Wikipédia</a></p>', NULL, '[{"t":"el","sel":"a","msg":"La page contient un lien <a>"},{"t":"attr","sel":"a","attr":"href","value":"https://www.wikipedia.org","msg":"Le href vaut https://www.wikipedia.org"},{"t":"el","sel":"a","text":"Wikipédia","msg":"Le texte du lien est « Wikipédia »"}]', '`<a href="adresse">texte</a>`', 'L’attribut `href` contient la destination ; le contenu de `<a>` est le texte cliquable.', 15, 1),
(19, 12, 'Un texte de lien accessible', 'creer-un-lien-ex2', 'fix', 2, 'Le texte « cliquez ici » n’est pas accessible. Réécrivez la phrase pour que le **texte du lien** soit **nos horaires d’ouverture** (le lien doit toujours pointer vers `horaires.html`).', '<p>Pour connaître nos horaires d’ouverture, <a href="horaires.html">cliquez ici</a>.</p>', NULL, '<p>Consultez <a href="horaires.html">nos horaires d’ouverture</a>.</p>', NULL, '[{"t":"el","sel":"a","text":"nos horaires d’ouverture","msg":"Le texte du lien est « nos horaires d’ouverture »"},{"t":"attr","sel":"a","attr":"href","value":"horaires.html","msg":"Le lien pointe toujours vers horaires.html"},{"t":"absent","s":"cliquez ici","ci":true,"msg":"L’expression « cliquez ici » a disparu"}]', 'Déplacez les balises `<a>` et `</a>` autour des mots qui décrivent la destination.', 'Un texte de lien doit être compréhensible hors contexte : « nos horaires d’ouverture » indique clairement où mène le lien.', 10, 2),
(20, 13, 'Un sommaire avec ancre', 'liens-relatifs-absolus-ancres-ex1', 'code', 2, 'Ajoutez l’identifiant `tarifs` au titre **Nos tarifs**, puis créez en haut de page un lien **Voir les tarifs** qui mène à ce titre.', '<h1>Salon de coiffure</h1>
<p>Bienvenue dans notre salon.</p>
<h2>Nos tarifs</h2>
<p>Coupe : 25 €</p>', NULL, '<h1>Salon de coiffure</h1>
<p><a href="#tarifs">Voir les tarifs</a></p>
<p>Bienvenue dans notre salon.</p>
<h2 id="tarifs">Nos tarifs</h2>
<p>Coupe : 25 €</p>', NULL, '[{"t":"attr","sel":"h2","attr":"id","value":"tarifs","msg":"Le titre « Nos tarifs » a l’id « tarifs »"},{"t":"attr","sel":"a","attr":"href","value":"#tarifs","msg":"Un lien pointe vers #tarifs"},{"t":"el","sel":"a","text":"Voir les tarifs","msg":"Le texte du lien est « Voir les tarifs »"}]', 'La cible : `<h2 id="tarifs">`. Le lien : `<a href="#tarifs">`.', 'Une ancre relie `href="#tarifs"` à l’élément portant `id="tarifs"` (sans le dièse).', 15, 1),
(21, 13, 'Nouvel onglet sécurisé', 'liens-relatifs-absolus-ancres-ex2', 'fill', 2, 'Complétez les deux `______` pour que le lien s’ouvre dans un **nouvel onglet** de façon **sécurisée**.', '<a href="https://www.w3.org" target="______" rel="______">Site du W3C (nouvel onglet)</a>', NULL, '<a href="https://www.w3.org" target="_blank" rel="noopener noreferrer">Site du W3C (nouvel onglet)</a>', NULL, '[{"t":"absent","s":"______","msg":"Tous les « ______ » sont remplacés"},{"t":"attr","sel":"a","attr":"target","value":"_blank","msg":"target vaut _blank"},{"t":"attr","sel":"a","attr":"rel","contains":"noopener","msg":"rel contient noopener"}]', '`target="_blank"` et `rel="noopener noreferrer"`.', '`_blank` ouvre un nouvel onglet ; `noopener` empêche la nouvelle page de contrôler la vôtre.', 10, 2),
(22, 13, 'Chemin relatif', 'liens-relatifs-absolus-ancres-ex3', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, '`../` remonte d’un niveau, du dossier `blog/` vers la racine.', 10, 3),
(23, 14, 'Colorer un titre', 'qu-est-ce-que-css-ex1', 'code', 1, 'Écrivez une règle CSS qui donne la couleur `red` (propriété `color`) à tous les titres `h1`.', '<h1>Mon premier style</h1>
<p>Le titre doit devenir rouge.</p>', NULL, NULL, 'h1 {
  color: red;
}', '[{"t":"css","sel":"h1","prop":"color","in":["red","#f00","#ff0000","rgb(255, 0, 0)"],"msg":"Les h1 ont la couleur red"}]', '`h1 { color: red; }`', 'Le sélecteur `h1` cible tous les titres de niveau 1 ; la déclaration `color: red;` change la couleur de leur texte.', 15, 1),
(24, 15, 'Relier une feuille de style', 'integrer-le-css-ex1', 'code', 1, 'Dans le `<head>`, ajoutez la balise qui relie la feuille de style externe `css/style.css`.', '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
</head>
<body>
  <h1>Accueil</h1>
</body>
</html>', NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Accueil</h1>
</body>
</html>', NULL, '[{"t":"el","sel":"head link","msg":"Une balise <link> est présente dans le head"},{"t":"attr","sel":"link","attr":"rel","value":"stylesheet","msg":"rel vaut stylesheet"},{"t":"attr","sel":"link","attr":"href","value":"css/style.css","msg":"href vaut css/style.css"}]', '`<link rel="stylesheet" href="css/style.css">`', '`<link>` relie une ressource externe ; `rel="stylesheet"` indique qu’il s’agit d’une feuille de style.', 15, 1),
(25, 16, 'Réparer une règle cassée', 'syntaxe-css-ex1', 'fix', 2, 'Cette règle contient trois erreurs de syntaxe. Corrigez-la pour que les paragraphes soient **bleus** (`blue`) avec une taille de **20px**.', '<p>Je devrais être bleu et plus grand.</p>', 'p {
  color = blue
  font-size: 20px', NULL, 'p {
  color: blue;
  font-size: 20px;
}', '[{"t":"css","sel":"p","prop":"color","value":"blue","msg":"color: blue; est valide"},{"t":"css","sel":"p","prop":"font-size","value":"20px","msg":"font-size: 20px; est valide"},{"t":"contains","s":"}","in":"css","msg":"L’accolade fermante est présente"},{"t":"absent","s":"=","in":"css","msg":"Plus de signe = dans le CSS"}]', 'Remplacez `=` par `:`, ajoutez les `;` et fermez l’accolade.', 'Une déclaration s’écrit `propriété: valeur;` et le bloc se ferme avec `}`.', 10, 1);

INSERT INTO `exercises` (`id`, `lesson_id`, `title`, `slug`, `type`, `difficulty`, `instructions`, `starter_html`, `starter_css`, `solution_html`, `solution_css`, `validation_rules`, `hint`, `explanation`, `points`, `sort_order`) VALUES
(26, 16, 'Grouper des sélecteurs', 'syntaxe-css-ex2', 'code', 1, 'Avec **une seule règle** utilisant des sélecteurs groupés, donnez la couleur `purple` aux `h1` et aux `h2`.', '<h1>Titre</h1>
<h2>Sous-titre</h2>', NULL, NULL, 'h1, h2 {
  color: purple;
}', '[{"t":"css","sel":"h1","prop":"color","value":"purple","msg":"Les h1 sont violets"},{"t":"css","sel":"h2","prop":"color","value":"purple","msg":"Les h2 sont violets"},{"t":"match","re":"h1\\\\s*,\\\\s*h2|h2\\\\s*,\\\\s*h1","in":"css","msg":"Les sélecteurs sont groupés avec une virgule"}]', '`h1, h2 { … }`', 'La virgule permet d’appliquer une même règle à plusieurs sélecteurs.', 15, 2),
(27, 17, 'Styler une classe', 'selecteurs-de-base-ex1', 'code', 1, 'Le second paragraphe possède la classe `important`. Écrivez une règle qui lui donne la couleur `darkred` **sans** modifier le premier paragraphe.', '<p>Paragraphe normal.</p>
<p class="important">Paragraphe important.</p>', NULL, NULL, '.important {
  color: darkred;
}', '[{"t":"css","sel":".important|p.important","prop":"color","value":"darkred","msg":"La classe .important est colorée en darkred"},{"t":"noel","sel":"p[style]","msg":"Pas de style en ligne dans le HTML"}]', 'Le sélecteur de classe commence par un point.', '`.important` cible uniquement les éléments ayant `class="important"`.', 15, 1),
(28, 17, 'Ajouter une classe', 'selecteurs-de-base-ex2', 'fill', 1, 'Le CSS est déjà écrit. Complétez le HTML en remplaçant `______` pour que le lien reçoive le style `.bouton`.', '<a href="#" ______>Commander</a>', '.bouton {
  background: #16a34a;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
}', '<a href="#" class="bouton">Commander</a>', '.bouton {
  background: #16a34a;
  color: white;
  padding: 10px 20px;
  text-decoration: none;
}', '[{"t":"absent","s":"______","msg":"Le « ______ » est remplacé"},{"t":"el","sel":"a.bouton","msg":"Le lien possède la classe bouton"},{"t":"absent","s":"class=\\".","msg":"Pas de point dans l’attribut class"}]', 'Dans le HTML, on écrit `class="bouton"` sans point.', 'Le point sert uniquement dans le sélecteur CSS ; dans le HTML, on écrit le nom de la classe seul.', 10, 2),
(29, 18, 'Uniquement les liens du menu', 'combinateurs-et-groupement-ex1', 'code', 2, 'Avec un sélecteur **descendant**, donnez la couleur `orange` uniquement aux liens situés dans l’élément `.menu`. Le lien du paragraphe ne doit pas être concerné.', '<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#">Contact</a>
</nav>
<p>Un <a href="#">lien normal</a> dans le texte.</p>', NULL, NULL, '.menu a {
  color: orange;
}', '[{"t":"css","sel":".menu a|nav.menu a|.menu > a|nav a","prop":"color","value":"orange","msg":"Les liens de .menu sont orange"},{"t":"noel","sel":"[style]","msg":"Aucun style en ligne"}]', 'Écrivez le parent, un espace, puis l’élément ciblé : `.menu a`.', 'Le sélecteur descendant `.menu a` ne cible que les liens contenus dans `.menu`.', 15, 1),
(30, 18, 'Le premier paragraphe', 'combinateurs-et-groupement-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, '`+` est le combinateur de frère adjacent.', 10, 2),
(31, 19, 'Gagner la cascade sans !important', 'cascade-specificite-heritage-ex1', 'code', 2, 'Le paragraphe `.promo` reste bleu à cause de la règle `section p`. **Sans utiliser `!important`** et sans modifier le HTML, ajoutez une règle plus spécifique pour qu’il devienne `green`.', '<section>
  <p>Paragraphe normal.</p>
  <p class="promo">Promotion du jour !</p>
</section>', 'section p {
  color: blue;
}', NULL, 'section p {
  color: blue;
}

section .promo {
  color: green;
}', '[{"t":"css","sel":"section .promo|section p.promo|p.promo|.promo","prop":"color","value":"green","msg":"Une règle ciblant .promo donne la couleur green"},{"t":"absent","s":"!important","in":"css","msg":"Pas de !important"},{"t":"css","sel":"section p","prop":"color","value":"blue","msg":"La règle d’origine est conservée"}]', '`.promo` seul a une spécificité de 0,1,0, supérieure à `section p` (0,0,2).', 'Une classe a une spécificité supérieure à n’importe quel nombre de balises : `.promo` ou `section .promo` l’emporte.', 15, 1),
(32, 20, 'Un bandeau d’alerte', 'les-couleurs-css-ex1', 'code', 1, 'Stylisez `.alerte` : fond `#fee2e2` (propriété `background-color`) et texte `#991b1b` (propriété `color`).', '<p class="alerte">Votre session va bientôt expirer.</p>', NULL, NULL, '.alerte {
  background-color: #fee2e2;
  color: #991b1b;
}', '[{"t":"css","sel":".alerte|p.alerte","prop":"background-color|background","value":"#fee2e2","msg":"Le fond vaut #fee2e2"},{"t":"css","sel":".alerte|p.alerte","prop":"color","value":"#991b1b","msg":"Le texte vaut #991b1b"}]', 'Deux déclarations dans la même règle `.alerte { … }`.', '`background-color` colore le fond, `color` le texte : ce couple rouge clair / rouge foncé offre un bon contraste.', 15, 1),
(33, 20, 'Fond semi-transparent', 'les-couleurs-css-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'Le canal alpha de la couleur de fond ne touche que le fond ; `opacity` rend tout l’élément transparent.', 10, 2),
(34, 21, 'Une bannière avec image', 'arriere-plans-ex1', 'code', 2, 'Stylisez `.hero` : une image de fond `url("https://placehold.co/800x300/png")`, qui **couvre** toute la zone (`background-size`), **centrée** (`background-position`) et **sans répétition**.', '<section class="hero">
  <h1>Bienvenue</h1>
</section>', '.hero {
  padding: 80px 20px;
  color: white;
}', NULL, '.hero {
  padding: 80px 20px;
  color: white;
  background-image: url("https://placehold.co/800x300/png");
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}', '[{"t":"match","re":"background(-image)?\\\\s*:[^;]*url\\\\(","in":"css","msg":"Une image de fond est définie avec url()"},{"t":"match","re":"(background-size\\\\s*:\\\\s*cover)|(/\\\\s*cover)","in":"css","msg":"L’image couvre la zone (cover)"},{"t":"match","re":"(background-position\\\\s*:\\\\s*center)|(center\\\\s*/)","in":"css","msg":"L’image est centrée"},{"t":"match","re":"no-repeat","in":"css","msg":"L’image ne se répète pas"}]', 'Quatre propriétés : `background-image`, `background-size`, `background-position`, `background-repeat`.', '`cover` remplit la zone, `center` garde le centre visible, `no-repeat` empêche la répétition.', 15, 1),
(35, 22, 'Une typographie lisible', 'polices-et-tailles-ex1', 'code', 1, 'Sur le sélecteur `body`, définissez : `font-family` avec `Arial` puis la famille générique `sans-serif`, une `font-size` de `18px` et un `line-height` de `1.6`.', '<h1>Mon blog</h1>
<p>Un paragraphe agréable à lire, avec une taille et un interligne confortables.</p>', NULL, NULL, 'body {
  font-family: Arial, sans-serif;
  font-size: 18px;
  line-height: 1.6;
}', '[{"t":"css","sel":"body","prop":"font-family","contains":"sans-serif","msg":"La pile se termine par sans-serif"},{"t":"css","sel":"body","prop":"font-family","contains":"arial","msg":"Arial est dans la pile de polices"},{"t":"css","sel":"body","prop":"font-size","value":"18px","msg":"font-size vaut 18px"},{"t":"css","sel":"body","prop":"line-height","value":"1.6","msg":"line-height vaut 1.6"}]', 'Trois déclarations dans `body { … }`.', 'Définies sur `body`, ces propriétés de texte sont héritées par tout le document.', 15, 1),
(36, 23, 'Une étiquette en capitales', 'mise-en-forme-du-texte-css-ex1', 'code', 1, 'Stylisez `.badge` : texte en majuscules avec `text-transform`, `letter-spacing` de `0.1em`, et centrez le titre `h1` avec `text-align`.', '<p class="badge">promotion</p>
<h1>Soldes d’été</h1>', NULL, NULL, '.badge {
  text-transform: uppercase;
  letter-spacing: 0.1em;
}

h1 {
  text-align: center;
}', '[{"t":"css","sel":".badge|p.badge","prop":"text-transform","value":"uppercase","msg":".badge est en majuscules"},{"t":"css","sel":".badge|p.badge","prop":"letter-spacing","value":"0.1em","msg":"letter-spacing vaut 0.1em"},{"t":"css","sel":"h1","prop":"text-align","value":"center","msg":"Le h1 est centré"},{"t":"el","sel":".badge","text":"promotion","msg":"Le texte HTML reste en minuscules"}]', 'Deux règles : `.badge { … }` et `h1 { … }`.', '`text-transform` change la casse à l’affichage sans modifier le contenu HTML.', 15, 1),
(37, 24, 'Passer aux unités relatives', 'unites-css-ex1', 'fix', 2, 'Remplacez les tailles en pixels par des unités relatives : le `h1` doit mesurer `2rem` et le paragraphe `1.125rem`. Le `.btn` doit avoir un padding de `0.5em 1em`.', '<h1>Titre</h1>
<p>Paragraphe.</p>
<a class="btn" href="#">Bouton</a>', 'h1 { font-size: 32px; }
p { font-size: 18px; }
.btn { padding: 8px 16px; }', NULL, 'h1 { font-size: 2rem; }
p { font-size: 1.125rem; }
.btn { padding: 0.5em 1em; }', '[{"t":"css","sel":"h1","prop":"font-size","value":"2rem","msg":"Le h1 mesure 2rem"},{"t":"css","sel":"p","prop":"font-size","value":"1.125rem","msg":"Le paragraphe mesure 1.125rem"},{"t":"css","sel":".btn|a.btn","prop":"padding","value":"0.5em 1em","msg":"Le bouton a un padding de 0.5em 1em"},{"t":"absent","s":"px","in":"css","msg":"Plus aucune valeur en px"}]', '32 px = 2 × 16 px = `2rem` ; 18 px = `1.125rem`.', 'Avec une racine de 16 px, on divise la taille en pixels par 16 pour obtenir des `rem`.', 10, 1),
(38, 24, 'Que vaut 1rem ?', 'unites-css-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, '1rem = 16px par défaut, donc 1.5rem = 24px.', 10, 2),
(39, 25, 'Une carte aérée', 'le-modele-de-boite-ex1', 'code', 1, 'Stylisez `.carte` : un `padding` de `20px`, une `border` de `1px solid #d1d5db` et une `margin` de `16px`.', '<div class="carte">
  <h2>Carte</h2>
  <p>Mon contenu respire grâce au padding.</p>
</div>', NULL, NULL, '.carte {
  padding: 20px;
  border: 1px solid #d1d5db;
  margin: 16px;
}', '[{"t":"css","sel":".carte|div.carte","prop":"padding","value":"20px","msg":"padding: 20px"},{"t":"css","sel":".carte|div.carte","prop":"border","value":"1px solid #d1d5db","msg":"border: 1px solid #d1d5db"},{"t":"css","sel":".carte|div.carte","prop":"margin","value":"16px","msg":"margin: 16px"}]', 'Trois déclarations dans `.carte`.', 'Padding à l’intérieur, bordure autour, margin à l’extérieur.', 15, 1),
(40, 25, 'Calcul de largeur', 'le-modele-de-boite-ex2', 'qcm', 1, 'Choisissez la bonne réponse (box-sizing par défaut).', NULL, NULL, NULL, NULL, NULL, NULL, '200 + 10 × 2 (padding) + 5 × 2 (bordure) = 230px.', 10, 2),
(41, 26, 'Centrer un conteneur', 'margin-et-padding-ex1', 'code', 2, 'Centrez horizontalement `.conteneur` : donnez-lui un `max-width` de `600px` et des marges `0 auto`. Ajoutez un `padding` de `16px 24px` (16px vertical, 24px horizontal).', '<div class="conteneur">
  <p>Je veux être centré dans la page.</p>
</div>', '.conteneur {
  background: #e0f2fe;
}', NULL, '.conteneur {
  background: #e0f2fe;
  max-width: 600px;
  margin: 0 auto;
  padding: 16px 24px;
}', '[{"t":"css","sel":".conteneur|div.conteneur","prop":"max-width|width","value":"600px","msg":"Largeur maximale de 600px"},{"t":"css","sel":".conteneur|div.conteneur","prop":"margin","in":["0 auto","0px auto","auto"],"msg":"Marges latérales automatiques (0 auto)"},{"t":"css","sel":".conteneur|div.conteneur","prop":"padding","value":"16px 24px","msg":"padding: 16px 24px"}]', '`margin: 0 auto;` = 0 en haut/bas, auto à gauche/droite.', 'Avec une largeur limitée, les marges automatiques se partagent l’espace libre : le bloc est centré.', 15, 1),
(42, 26, 'Lire un raccourci', 'margin-et-padding-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'Ordre : haut (5), droite (10), bas (15), gauche (20).', 10, 2),
(43, 27, 'Un avatar rond', 'bordures-et-coins-arrondis-ex1', 'code', 1, 'Rendez l’image `.avatar` parfaitement ronde avec `border-radius: 50%`, et ajoutez-lui une bordure `4px solid #22c55e`.', '<img class="avatar" src="https://placehold.co/120x120/png" alt="Avatar de Nina" width="120" height="120">', NULL, NULL, '.avatar {
  border-radius: 50%;
  border: 4px solid #22c55e;
}', '[{"t":"css","sel":".avatar|img.avatar","prop":"border-radius","value":"50%","msg":"border-radius: 50%"},{"t":"css","sel":".avatar|img.avatar","prop":"border","value":"4px solid #22c55e","msg":"Bordure de 4px verte"}]', 'Une image carrée avec 50 % d’arrondi devient un cercle.', 'Avec `border-radius: 50%`, chaque coin est arrondi à la moitié de la taille : un carré devient un cercle.', 15, 1),
(44, 27, 'Une bordure invisible', 'bordures-et-coins-arrondis-ex2', 'fix', 1, 'La bordure de `.citation` ne s’affiche pas. Corrigez la déclaration pour obtenir une bordure gauche **pleine** (`solid`) de 4px couleur `#6366f1`.', '<blockquote class="citation">Le savoir est la seule richesse qui s’accroît quand on la partage.</blockquote>', '.citation {
  border-left: 4px #6366f1;
  padding-left: 12px;
}', NULL, '.citation {
  border-left: 4px solid #6366f1;
  padding-left: 12px;
}', '[{"t":"css","sel":".citation|blockquote.citation","prop":"border-left","value":"4px solid #6366f1","msg":"border-left: 4px solid #6366f1"}]', 'Il manque le style de la bordure.', 'Sans style (`solid`, `dashed`…), une bordure n’est pas dessinée.', 10, 2),
(45, 28, 'Le reset box-sizing', 'dimensions-et-box-sizing-ex1', 'code', 1, 'Ajoutez en haut du CSS la règle universelle qui applique `box-sizing: border-box` à tous les éléments (sélecteur `*`). La boîte `.panneau` ne doit plus déborder de son parent.', '<div class="parent">
  <div class="panneau">Je fais 100 % de mon parent, padding compris.</div>
</div>', '.parent {
  width: 300px;
  border: 2px dashed #94a3b8;
}

.panneau {
  width: 100%;
  padding: 20px;
  background: #fde68a;
}', NULL, '*, *::before, *::after {
  box-sizing: border-box;
}

.parent {
  width: 300px;
  border: 2px dashed #94a3b8;
}

.panneau {
  width: 100%;
  padding: 20px;
  background: #fde68a;
}', '[{"t":"css","sel":"*|*, *::before, *::after|*::before|.panneau","prop":"box-sizing","value":"border-box","msg":"box-sizing: border-box est appliqué"},{"t":"match","re":"\\\\*[^{]*\\\\{[^}]*box-sizing\\\\s*:\\\\s*border-box","in":"css","msg":"La règle utilise le sélecteur universel *"},{"t":"css","sel":".panneau","prop":"width","value":"100%","msg":"Le panneau garde width: 100%"}]', '`*, *::before, *::after { box-sizing: border-box; }`', 'Avec `border-box`, les 100 % incluent le padding : la boîte ne dépasse plus.', 15, 1),
(46, 29, 'Insérer une image accessible', 'la-balise-img-ex1', 'code', 1, 'Insérez l’image `https://placehold.co/300x200/png` avec un texte alternatif **non vide** qui la décrit, et les attributs `width="300"` et `height="200"`.', '<h1>Ma photo de vacances</h1>', NULL, '<h1>Ma photo de vacances</h1>
<img src="https://placehold.co/300x200/png" alt="Plage de sable blanc au coucher du soleil" width="300" height="200">', NULL, '[{"t":"attr","sel":"img","attr":"src","value":"https://placehold.co/300x200/png","msg":"L’image a la bonne source"},{"t":"attr","sel":"img","attr":"alt","nonempty":true,"msg":"Un texte alternatif non vide est présent"},{"t":"attr","sel":"img","attr":"width","value":"300","msg":"width=\\"300\\""},{"t":"attr","sel":"img","attr":"height","value":"200","msg":"height=\\"200\\""},{"t":"absent","s":"</img>","msg":"Pas de balise fermante </img>"}]', '`<img src="…" alt="…" width="300" height="200">`', 'Une image informative a toujours un `alt` qui la décrit, et ses dimensions évitent les décalages au chargement.', 15, 1),
(47, 29, 'Image décorative', 'la-balise-img-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'Un `alt` vide indique aux lecteurs d’écran d’ignorer l’image.', 10, 2),
(48, 30, 'Une image légendée', 'images-formats-figure-performance-ex1', 'code', 2, 'Placez l’image dans un élément `<figure>` et ajoutez une légende `<figcaption>` contenant le texte **Le Mont-Saint-Michel**. Ajoutez aussi `loading="lazy"` à l’image.', '<img src="https://placehold.co/500x300/png" alt="Le Mont-Saint-Michel à marée haute" width="500" height="300">', NULL, '<figure>
  <img src="https://placehold.co/500x300/png" alt="Le Mont-Saint-Michel à marée haute" width="500" height="300" loading="lazy">
  <figcaption>Le Mont-Saint-Michel</figcaption>
</figure>', NULL, '[{"t":"el","sel":"figure img","msg":"L’image est dans un <figure>"},{"t":"el","sel":"figure figcaption","text":"Le Mont-Saint-Michel","msg":"Une <figcaption> « Le Mont-Saint-Michel »"},{"t":"attr","sel":"img","attr":"loading","value":"lazy","msg":"loading=\\"lazy\\" sur l’image"},{"t":"attr","sel":"img","attr":"alt","nonempty":true,"msg":"Le texte alternatif est conservé"}]', '`<figure>` entoure l’image et la légende.', '`<figure>` regroupe l’image et sa `<figcaption>`, qui la légende.', 15, 1),
(49, 31, 'Liste de courses', 'listes-ordonnees-et-non-ordonnees-ex1', 'code', 1, 'Créez une liste **non ordonnée** contenant trois éléments : **Pain**, **Beurre**, **Confiture**.', '<h2>Courses</h2>', NULL, '<h2>Courses</h2>
<ul>
  <li>Pain</li>
  <li>Beurre</li>
  <li>Confiture</li>
</ul>', NULL, '[{"t":"el","sel":"ul","msg":"Une liste <ul> est présente"},{"t":"el","sel":"ul > li","count":3,"msg":"La liste contient 3 éléments <li>"},{"t":"el","sel":"li","text":"Pain","msg":"« Pain » est dans la liste"},{"t":"el","sel":"li","text":"Confiture","msg":"« Confiture » est dans la liste"}]', '`<ul>` puis un `<li>` par élément.', 'L’ordre des courses n’a pas d’importance : liste non ordonnée.', 15, 1),
(50, 31, 'Des étapes numérotées', 'listes-ordonnees-et-non-ordonnees-ex2', 'fix', 1, 'Ces étapes sont numérotées à la main dans des paragraphes. Transformez-les en **liste ordonnée** `<ol>` (sans les numéros écrits à la main).', '<p>1. Ouvrir l’éditeur</p>
<p>2. Écrire le code</p>
<p>3. Enregistrer le fichier</p>', NULL, '<ol>
  <li>Ouvrir l’éditeur</li>
  <li>Écrire le code</li>
  <li>Enregistrer le fichier</li>
</ol>', NULL, '[{"t":"el","sel":"ol > li","count":3,"msg":"Une <ol> contient 3 <li>"},{"t":"el","sel":"li","text":"Ouvrir l’éditeur","msg":"Le premier élément est « Ouvrir l’éditeur » (sans numéro)"},{"t":"noel","sel":"p","msg":"Plus de paragraphes"}]', 'La numérotation est automatique dans une `<ol>`.', 'Des étapes dont l’ordre compte forment une liste ordonnée ; le navigateur numérote tout seul.', 10, 2);

INSERT INTO `exercises` (`id`, `lesson_id`, `title`, `slug`, `type`, `difficulty`, `instructions`, `starter_html`, `starter_css`, `solution_html`, `solution_css`, `validation_rules`, `hint`, `explanation`, `points`, `sort_order`) VALUES
(51, 32, 'Une sous-liste', 'listes-imbriquees-et-definitions-ex1', 'code', 2, 'Dans l’élément **Fruits**, ajoutez une sous-liste `<ul>` contenant **Pomme** et **Banane**.', '<ul>
  <li>Fruits</li>
  <li>Légumes</li>
</ul>', NULL, '<ul>
  <li>Fruits
    <ul>
      <li>Pomme</li>
      <li>Banane</li>
    </ul>
  </li>
  <li>Légumes</li>
</ul>', NULL, '[{"t":"el","sel":"ul > li > ul > li","count":2,"msg":"Une sous-liste de 2 éléments est dans un <li>"},{"t":"el","sel":"li li","text":"Pomme","msg":"« Pomme » est dans la sous-liste"},{"t":"el","sel":"li li","text":"Banane","msg":"« Banane » est dans la sous-liste"},{"t":"el","sel":"ul > li","min":4,"msg":"« Légumes » est toujours présent"}]', 'Le `</li>` de « Fruits » doit venir après le `</ul>` de la sous-liste.', 'La sous-liste appartient à l’élément « Fruits » : elle se place à l’intérieur de son `<li>`.', 15, 1),
(52, 32, 'Un glossaire', 'listes-imbriquees-et-definitions-ex2', 'code', 1, 'Créez une liste de définitions `<dl>` avec le terme **URL** et sa définition **Adresse d’une ressource sur le Web**.', NULL, NULL, '<dl>
  <dt>URL</dt>
  <dd>Adresse d’une ressource sur le Web</dd>
</dl>', NULL, '[{"t":"el","sel":"dl dt","text":"URL","msg":"Un terme <dt> « URL »"},{"t":"el","sel":"dl dd","contains":"Adresse d’une ressource","msg":"Une définition <dd>"}]', '`<dl><dt>…</dt><dd>…</dd></dl>`', '`<dt>` contient le terme, `<dd>` sa description.', 15, 2),
(53, 33, 'Un tableau de prix', 'structure-d-un-tableau-ex1', 'code', 2, 'Créez un tableau avec une `<caption>` **Tarifs**, une ligne d’en-têtes (`<th scope="col">`) **Produit** et **Prix**, puis deux lignes de données : **Café / 2 €** et **Thé / 2,50 €**.', NULL, NULL, '<table>
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
</table>', NULL, '[{"t":"el","sel":"table caption","text":"Tarifs","msg":"La légende est « Tarifs »"},{"t":"el","sel":"th[scope=col]","count":2,"msg":"Deux en-têtes de colonne avec scope=\\"col\\""},{"t":"el","sel":"td","min":4,"msg":"Au moins 4 cellules de données"},{"t":"el","sel":"td","text":"Thé","msg":"Une cellule « Thé »"},{"t":"el","sel":"tr","count":3,"msg":"Trois lignes au total"}]', 'Une ligne `<tr>` d’en-têtes, puis une `<tr>` par produit.', 'Les en-têtes de colonnes en `<th scope="col">` donnent leur sens aux cellules de données.', 15, 1),
(54, 34, 'Ajouter un pied de tableau', 'tableaux-avances-ex1', 'code', 2, 'Ajoutez un `<tfoot>` au tableau contenant une ligne : une cellule `<th scope="row">` **Total** et une cellule `<td>` **30 €**.', '<table>
  <thead>
    <tr><th scope="col">Article</th><th scope="col">Prix</th></tr>
  </thead>
  <tbody>
    <tr><td>Livre</td><td>18 €</td></tr>
    <tr><td>Magazine</td><td>12 €</td></tr>
  </tbody>
</table>', NULL, '<table>
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
</table>', NULL, '[{"t":"el","sel":"table tfoot","msg":"Le tableau contient un <tfoot>"},{"t":"el","sel":"tfoot th[scope=row]","text":"Total","msg":"Un en-tête de ligne « Total »"},{"t":"el","sel":"tfoot td","text":"30 €","msg":"Une cellule « 30 € »"}]', 'Le `<tfoot>` se place après le `</tbody>`.', '`<tfoot>` regroupe les lignes de synthèse comme les totaux.', 15, 1),
(55, 34, 'Fusion de colonnes', 'tableaux-avances-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'La cellule fusionnée occupe 2 colonnes : il en reste 1.', 10, 2),
(56, 35, 'Un champ bien étiqueté', 'form-et-input-ex1', 'code', 1, 'Dans le formulaire, ajoutez un `<label>` **Ville** relié (avec `for`) à un champ texte d’`id` `ville` et de `name` `ville`.', '<form action="/meteo" method="get">

  <button type="submit">Voir la météo</button>
</form>', NULL, '<form action="/meteo" method="get">
  <label for="ville">Ville</label>
  <input type="text" id="ville" name="ville">
  <button type="submit">Voir la météo</button>
</form>', NULL, '[{"t":"el","sel":"form label[for=ville]","text":"Ville","msg":"Un label « Ville » avec for=\\"ville\\""},{"t":"el","sel":"form input#ville","msg":"Un champ avec id=\\"ville\\""},{"t":"attr","sel":"input#ville","attr":"name","value":"ville","msg":"Le champ a name=\\"ville\\""}]', 'Le `for` du label et l’`id` du champ doivent être identiques.', 'Le label relié par `for`/`id` rend le champ accessible ; `name` permet l’envoi de la donnée.', 15, 1),
(57, 35, 'GET ou POST ?', 'form-et-input-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'POST : le mot de passe ne doit pas apparaître dans l’URL.', 10, 2),
(58, 36, 'Un groupe de boutons radio', 'types-de-champs-ex1', 'code', 2, 'Créez un `<fieldset>` avec la `<legend>` **Mode de livraison** contenant deux boutons radio de même `name` `livraison` : **Domicile** (`value="domicile"`) et **Point relais** (`value="relais"`), chacun avec son `<label>`.', '<form action="/commande" method="post">

</form>', NULL, '<form action="/commande" method="post">
  <fieldset>
    <legend>Mode de livraison</legend>
    <input type="radio" id="domicile" name="livraison" value="domicile">
    <label for="domicile">Domicile</label>
    <input type="radio" id="relais" name="livraison" value="relais">
    <label for="relais">Point relais</label>
  </fieldset>
</form>', NULL, '[{"t":"el","sel":"fieldset legend","text":"Mode de livraison","msg":"Une légende « Mode de livraison »"},{"t":"el","sel":"fieldset input[type=radio][name=livraison]","count":2,"msg":"Deux radios avec name=\\"livraison\\""},{"t":"el","sel":"input[value=domicile]","msg":"Une option value=\\"domicile\\""},{"t":"el","sel":"input[value=relais]","msg":"Une option value=\\"relais\\""},{"t":"el","sel":"label[for]","count":2,"msg":"Chaque radio a son label"}]', 'Même `name` pour les deux radios, `value` différentes, `id` différents.', 'Le `name` commun fait des radios un groupe à choix unique ; `fieldset`/`legend` donnent le contexte.', 15, 1),
(59, 37, 'Formulaire de contact', 'select-textarea-button-ex1', 'code', 2, 'Complétez le formulaire : une liste `<select>` de `name` `service` avec au moins **3 options**, une zone `<textarea>` de `name` `message`, et un `<button type="submit">`. Chaque champ doit avoir un label.', '<form action="/contact" method="post">

</form>', NULL, '<form action="/contact" method="post">
  <label for="service">Service</label>
  <select id="service" name="service">
    <option value="">— Choisissez —</option>
    <option value="vente">Ventes</option>
    <option value="support">Support</option>
  </select>
  <label for="message">Message</label>
  <textarea id="message" name="message" rows="4"></textarea>
  <button type="submit">Envoyer mon message</button>
</form>', NULL, '[{"t":"el","sel":"select[name=service] option","min":3,"msg":"Un select name=\\"service\\" avec 3 options"},{"t":"el","sel":"textarea[name=message]","msg":"Une textarea name=\\"message\\""},{"t":"el","sel":"button[type=submit]","msg":"Un bouton type=\\"submit\\""},{"t":"el","sel":"label[for]","min":2,"msg":"Les champs ont des labels"}]', '`<select name="service">` avec des `<option>`, puis `<textarea name="message"></textarea>`.', 'Chaque élément de formulaire a un rôle : choix dans une liste, texte libre et envoi.', 15, 1),
(60, 38, 'Rendre des champs obligatoires', 'validation-native-formulaires-ex1', 'code', 1, 'Ajoutez `required` aux deux champs, et `minlength="8"` au mot de passe.', '<form action="/connexion" method="post">
  <label for="email">E-mail</label>
  <input type="email" id="email" name="email">
  <label for="mdp">Mot de passe</label>
  <input type="password" id="mdp" name="password">
  <button type="submit">Se connecter</button>
</form>', NULL, '<form action="/connexion" method="post">
  <label for="email">E-mail</label>
  <input type="email" id="email" name="email" required>
  <label for="mdp">Mot de passe</label>
  <input type="password" id="mdp" name="password" required minlength="8">
  <button type="submit">Se connecter</button>
</form>', NULL, '[{"t":"el","sel":"input#email[required]","msg":"Le champ e-mail est obligatoire"},{"t":"el","sel":"input#mdp[required]","msg":"Le mot de passe est obligatoire"},{"t":"attr","sel":"input#mdp","attr":"minlength","value":"8","msg":"minlength=\\"8\\" sur le mot de passe"}]', '`required` est un attribut booléen : il s’écrit sans valeur.', 'Le navigateur bloquera l’envoi si un champ est vide ou si le mot de passe fait moins de 8 caractères.', 15, 1),
(61, 38, 'Sécurité et validation', 'validation-native-formulaires-ex2', 'truefalse', 1, 'Vrai ou faux ?', NULL, NULL, NULL, NULL, NULL, NULL, 'Faux : la validation côté client se contourne facilement. Le serveur doit toujours revalider.', 10, 2),
(62, 39, 'Deux classes sur un élément', 'classes-et-identifiants-ex1', 'code', 1, 'Donnez au bouton **les deux classes** `btn` et `btn--danger` (dans un seul attribut `class`).', '<button type="button">Supprimer</button>', '.btn { padding: 8px 16px; border: 0; border-radius: 6px; }
.btn--danger { background: #dc2626; color: white; }', '<button type="button" class="btn btn--danger">Supprimer</button>', '.btn { padding: 8px 16px; border: 0; border-radius: 6px; }
.btn--danger { background: #dc2626; color: white; }', '[{"t":"el","sel":"button.btn.btn--danger","msg":"Le bouton a les classes btn et btn--danger"},{"t":"match","re":"<button[^>]*class=\\"[^\\"]*\\"[^>]*>","msg":"Un seul attribut class"},{"t":"absent","s":"class=\\"btn\\" class","msg":"Pas d’attribut class dupliqué"}]', '`class="btn btn--danger"`', 'Plusieurs classes s’écrivent dans le même attribut, séparées par un espace.', 15, 1),
(63, 40, 'Mettre un mot en valeur avec span', 'attributs-globaux-ex1', 'code', 1, 'Entourez **19,90 €** avec un `<span>` de classe `prix`, et ajoutez à l’élément `<li>` l’attribut `data-stock` avec la valeur `12`.', '<ul>
  <li>T-shirt bio — 19,90 €</li>
</ul>', '.prix { color: #15803d; font-weight: bold; }', '<ul>
  <li data-stock="12">T-shirt bio — <span class="prix">19,90 €</span></li>
</ul>', '.prix { color: #15803d; font-weight: bold; }', '[{"t":"el","sel":"li span.prix","text":"19,90 €","msg":"Le prix est dans un span.prix"},{"t":"attr","sel":"li","attr":"data-stock","value":"12","msg":"Le li a data-stock=\\"12\\""}]', '`<li data-stock="12">… <span class="prix">19,90 €</span></li>`', '`<span>` permet de styler un morceau de texte sans lui donner de sens ; `data-stock` stocke une donnée personnalisée.', 15, 1),
(64, 41, 'Un lien bouton', 'block-inline-inline-block-ex1', 'code', 1, 'Le lien `.btn` ignore son `width`. Ajoutez `display: inline-block` pour que la largeur de `200px` et le padding s’appliquent.', '<a class="btn" href="#">S’inscrire</a>', '.btn {
  width: 200px;
  padding: 12px;
  text-align: center;
  background: #0f766e;
  color: white;
  text-decoration: none;
}', NULL, '.btn {
  display: inline-block;
  width: 200px;
  padding: 12px;
  text-align: center;
  background: #0f766e;
  color: white;
  text-decoration: none;
}', '[{"t":"css","sel":".btn|a.btn","prop":"display","in":["inline-block","block"],"msg":"Le lien a display: inline-block"},{"t":"css","sel":".btn|a.btn","prop":"width","value":"200px","msg":"width: 200px est conservé"}]', 'Une seule déclaration à ajouter.', 'Un élément inline ignore `width` ; en `inline-block`, il accepte des dimensions tout en restant dans la ligne.', 15, 1),
(65, 42, 'Masquer complètement', 'display-none-visibility-overflow-ex1', 'code', 1, 'Masquez complètement le paragraphe `.promo-expiree` pour qu’il ne prenne **plus aucune place** dans la page.', '<p>Bienvenue !</p>
<p class="promo-expiree">Promotion terminée.</p>
<p>Découvrez nos nouveautés.</p>', NULL, NULL, '.promo-expiree {
  display: none;
}', '[{"t":"css","sel":".promo-expiree|p.promo-expiree","prop":"display","value":"none","msg":".promo-expiree a display: none"}]', 'Une seule propriété retire l’élément de la mise en page.', '`display: none` retire l’élément de la mise en page ; `visibility: hidden` laisserait un vide.', 15, 1),
(66, 43, 'Un badge dans le coin', 'position-relative-absolute-ex1', 'code', 2, 'Placez `.badge` dans le **coin supérieur gauche** de `.carte` : la carte doit être le repère (`position: relative`) et le badge `position: absolute` avec `top: 8px` et `left: 8px`.', '<div class="carte">
  <span class="badge">Nouveau</span>
  <p>Contenu de la carte, avec assez de texte pour voir le badge par-dessus.</p>
</div>', '.carte {
  width: 260px;
  padding: 40px 16px 16px;
  background: #f1f5f9;
}

.badge {
  background: #16a34a;
  color: white;
  padding: 2px 8px;
}', NULL, '.carte {
  position: relative;
  width: 260px;
  padding: 40px 16px 16px;
  background: #f1f5f9;
}

.badge {
  position: absolute;
  top: 8px;
  left: 8px;
  background: #16a34a;
  color: white;
  padding: 2px 8px;
}', '[{"t":"css","sel":".carte|div.carte","prop":"position","value":"relative","msg":"La carte est en position: relative"},{"t":"css","sel":".badge|span.badge|.carte .badge","prop":"position","value":"absolute","msg":"Le badge est en position: absolute"},{"t":"css","sel":".badge|span.badge|.carte .badge","prop":"top","value":"8px","msg":"top: 8px"},{"t":"css","sel":".badge|span.badge|.carte .badge","prop":"left","value":"8px","msg":"left: 8px"}]', 'Le parent sert de repère grâce à `position: relative`.', 'Un élément absolu se place par rapport à son ancêtre positionné le plus proche : ici la carte.', 15, 1),
(67, 44, 'Un en-tête collant', 'fixed-sticky-z-index-ex1', 'code', 2, 'Rendez `.entete` collant en haut de l’écran : `position: sticky`, `top: 0` et un `z-index` de `10`.', '<header class="entete">Mon site</header>
<p>Contenu 1</p><p>Contenu 2</p><p>Contenu 3</p><p>Contenu 4</p><p>Contenu 5</p><p>Contenu 6</p><p>Contenu 7</p><p>Contenu 8</p><p>Contenu 9</p><p>Contenu 10</p>', '.entete {
  padding: 12px;
  background: #1e40af;
  color: white;
}', NULL, '.entete {
  position: sticky;
  top: 0;
  z-index: 10;
  padding: 12px;
  background: #1e40af;
  color: white;
}', '[{"t":"css","sel":".entete|header.entete","prop":"position","value":"sticky","msg":"position: sticky"},{"t":"css","sel":".entete|header.entete","prop":"top","in":["0","0px"],"msg":"top: 0"},{"t":"css","sel":".entete|header.entete","prop":"z-index","value":"10","msg":"z-index: 10"}]', 'Sans `top`, `sticky` n’a aucun effet.', '`sticky` + `top: 0` colle l’en-tête en haut ; `z-index` le fait passer devant le contenu.', 15, 1),
(68, 45, 'Un menu horizontal', 'flexbox-le-conteneur-ex1', 'code', 1, 'Transformez `.menu` en conteneur flex (`display: flex`) avec un espacement `gap` de `24px`.', '<nav class="menu">
  <a href="#">Accueil</a>
  <a href="#">Services</a>
  <a href="#">Contact</a>
</nav>', '.menu a {
  display: block;
  padding: 8px;
  background: #e0e7ff;
}', NULL, '.menu {
  display: flex;
  gap: 24px;
}

.menu a {
  display: block;
  padding: 8px;
  background: #e0e7ff;
}', '[{"t":"css","sel":".menu|nav.menu|nav","prop":"display","value":"flex","msg":".menu est en display: flex"},{"t":"css","sel":".menu|nav.menu|nav","prop":"gap","value":"24px","msg":"gap: 24px"}]', 'Les propriétés s’appliquent au parent `.menu`, pas aux liens.', '`display: flex` place les enfants côte à côte ; `gap` les espace régulièrement.', 15, 1),
(69, 45, 'Changer de direction', 'flexbox-le-conteneur-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, '`column` rend l’axe principal vertical.', 10, 2),
(70, 46, 'Centrer une boîte', 'flexbox-alignements-ex1', 'code', 2, 'Centrez `.message` horizontalement ET verticalement dans `.ecran` avec Flexbox (`display: flex`, `justify-content` et `align-items`).', '<div class="ecran">
  <p class="message">Au centre !</p>
</div>', '.ecran {
  min-height: 250px;
  background: #fef3c7;
}

.message {
  padding: 12px 20px;
  background: white;
}', NULL, '.ecran {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 250px;
  background: #fef3c7;
}

.message {
  padding: 12px 20px;
  background: white;
}', '[{"t":"css","sel":".ecran|div.ecran","prop":"display","value":"flex","msg":".ecran est un conteneur flex"},{"t":"css","sel":".ecran|div.ecran","prop":"justify-content","value":"center","msg":"justify-content: center"},{"t":"css","sel":".ecran|div.ecran","prop":"align-items","value":"center","msg":"align-items: center"}]', 'Tout se passe sur le parent `.ecran`.', '`justify-content` centre sur l’axe principal, `align-items` sur l’axe secondaire.', 15, 1),
(71, 46, 'Logo à gauche, menu à droite', 'flexbox-alignements-ex2', 'fill', 1, 'Remplacez `______` par la valeur de `justify-content` qui place le logo tout à gauche et le menu tout à droite.', '<header class="barre"><strong>Logo</strong><nav>Menu</nav></header>', '.barre {
  display: flex;
  justify-content: ______;
  padding: 12px;
  background: #e2e8f0;
}', NULL, '.barre {
  display: flex;
  justify-content: space-between;
  padding: 12px;
  background: #e2e8f0;
}', '[{"t":"absent","s":"______","in":"css","msg":"Le « ______ » est remplacé"},{"t":"css","sel":".barre|header.barre","prop":"justify-content","value":"space-between","msg":"justify-content: space-between"}]', 'L’espace est réparti « entre » les éléments.', '`space-between` colle le premier et le dernier élément aux extrémités.', 10, 2),
(72, 47, 'Une grille de cartes souple', 'flexbox-elements-flexibles-ex1', 'code', 2, 'Faites passer les cartes à la ligne (`flex-wrap: wrap` sur `.grille`) et donnez à `.carte` la propriété `flex: 1 1 200px`.', '<div class="grille">
  <div class="carte">A</div>
  <div class="carte">B</div>
  <div class="carte">C</div>
  <div class="carte">D</div>
</div>', '.grille {
  display: flex;
  gap: 12px;
}

.carte {
  padding: 30px;
  background: #bbf7d0;
}', NULL, '.grille {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
}

.carte {
  flex: 1 1 200px;
  padding: 30px;
  background: #bbf7d0;
}', '[{"t":"css","sel":".grille|div.grille","prop":"flex-wrap","value":"wrap","msg":"flex-wrap: wrap sur .grille"},{"t":"css","sel":".carte|div.carte|.grille .carte","prop":"flex","value":"1 1 200px","msg":"flex: 1 1 200px sur .carte"}]', 'Une propriété sur le parent, une sur les enfants.', 'Le retour à la ligne est autorisé par le conteneur ; chaque carte part de 200px puis s’étire.', 15, 1),
(73, 48, 'Une galerie en 3 colonnes', 'grid-les-bases-ex1', 'code', 1, 'Transformez `.galerie` en grille de **3 colonnes égales** (`repeat(3, 1fr)`) avec un `gap` de `10px`.', '<div class="galerie">
  <div class="photo">1</div><div class="photo">2</div><div class="photo">3</div>
  <div class="photo">4</div><div class="photo">5</div><div class="photo">6</div>
</div>', '.photo {
  padding: 40px 0;
  text-align: center;
  background: #fecdd3;
}', NULL, '.galerie {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}

.photo {
  padding: 40px 0;
  text-align: center;
  background: #fecdd3;
}', '[{"t":"css","sel":".galerie|div.galerie","prop":"display","value":"grid","msg":"display: grid"},{"t":"css","sel":".galerie|div.galerie","prop":"grid-template-columns","in":["repeat(3, 1fr)","1fr 1fr 1fr"],"msg":"Trois colonnes égales"},{"t":"css","sel":".galerie|div.galerie","prop":"gap","value":"10px","msg":"gap: 10px"}]', '`grid-template-columns: repeat(3, 1fr);`', 'Trois fractions égales de l’espace disponible forment trois colonnes identiques.', 15, 1),
(74, 48, 'L’unité fr', 'grid-les-bases-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, '4 parts au total : 800 ÷ 4 = 200px par part, donc 3 × 200 = 600px.', 10, 2),
(75, 49, 'Une mise en page par zones', 'grid-placement-et-zones-ex1', 'code', 3, 'Complétez `.page` avec `grid-template-areas` : première ligne **"haut haut"**, seconde ligne **"cote principal"**. Affectez ensuite `.haut`, `.cote` et `.principal` à leurs zones avec `grid-area`.', '<div class="page">
  <header class="haut">Haut</header>
  <aside class="cote">Côté</aside>
  <main class="principal">Principal</main>
</div>', '.page {
  display: grid;
  grid-template-columns: 150px 1fr;
  gap: 8px;
}

.page > * {
  padding: 16px;
  background: #e0f2fe;
}', NULL, '.page {
  display: grid;
  grid-template-columns: 150px 1fr;
  grid-template-areas:
    "haut haut"
    "cote principal";
  gap: 8px;
}

.page > * {
  padding: 16px;
  background: #e0f2fe;
}

.haut { grid-area: haut; }
.cote { grid-area: cote; }
.principal { grid-area: principal; }', '[{"t":"match","re":"grid-template-areas\\\\s*:\\\\s*\\"haut\\\\s+haut\\"\\\\s*\\"cote\\\\s+principal\\"","in":"css","msg":"Les zones \\"haut haut\\" / \\"cote principal\\" sont définies"},{"t":"css","sel":".haut|header.haut","prop":"grid-area","value":"haut","msg":".haut occupe la zone haut"},{"t":"css","sel":".cote|aside.cote","prop":"grid-area","value":"cote","msg":".cote occupe la zone cote"},{"t":"css","sel":".principal|main.principal","prop":"grid-area","value":"principal","msg":".principal occupe la zone principal"}]', 'Chaque ligne de la grille est une chaîne entre guillemets.', 'On dessine la grille avec des noms, puis chaque élément rejoint sa zone avec `grid-area`.', 15, 1);

INSERT INTO `exercises` (`id`, `lesson_id`, `title`, `slug`, `type`, `difficulty`, `instructions`, `starter_html`, `starter_css`, `solution_html`, `solution_css`, `validation_rules`, `hint`, `explanation`, `points`, `sort_order`) VALUES
(76, 50, 'Une grille responsive automatique', 'grid-adaptative-ex1', 'code', 2, 'Faites de `.produits` une grille avec `grid-template-columns: repeat(auto-fit, minmax(150px, 1fr))` et un `gap` de `16px`.', '<div class="produits">
  <div class="produit">Produit 1</div>
  <div class="produit">Produit 2</div>
  <div class="produit">Produit 3</div>
  <div class="produit">Produit 4</div>
</div>', '.produit {
  padding: 24px;
  background: #fef9c3;
  text-align: center;
}', NULL, '.produits {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 16px;
}

.produit {
  padding: 24px;
  background: #fef9c3;
  text-align: center;
}', '[{"t":"css","sel":".produits|div.produits","prop":"display","value":"grid","msg":"display: grid"},{"t":"css","sel":".produits|div.produits","prop":"grid-template-columns","in":["repeat(auto-fit, minmax(150px, 1fr))","repeat(auto-fill, minmax(150px, 1fr))"],"msg":"repeat(auto-fit, minmax(150px, 1fr))"},{"t":"css","sel":".produits|div.produits","prop":"gap","value":"16px","msg":"gap: 16px"}]', 'Recopiez exactement la formule : `repeat(auto-fit, minmax(150px, 1fr))`.', 'La grille crée autant de colonnes de 150px minimum que possible, puis les étire.', 15, 1),
(77, 51, 'Un bouton interactif', 'pseudo-classes-ex1', 'code', 1, 'Ajoutez un état `:hover` à `.btn` qui change le `background` en `#15803d`, et un état `:focus-visible` avec `outline: 3px solid #f59e0b`.', '<button class="btn" type="button">Valider</button>', '.btn {
  padding: 10px 20px;
  border: 0;
  background: #16a34a;
  color: white;
}', NULL, '.btn {
  padding: 10px 20px;
  border: 0;
  background: #16a34a;
  color: white;
}

.btn:hover {
  background: #15803d;
}

.btn:focus-visible {
  outline: 3px solid #f59e0b;
}', '[{"t":"css","sel":".btn:hover|button.btn:hover|button:hover","prop":"background|background-color","value":"#15803d","msg":"Au survol, le fond devient #15803d"},{"t":"css","sel":".btn:focus-visible|button.btn:focus-visible|button:focus-visible","prop":"outline","value":"3px solid #f59e0b","msg":"Un contour de focus visible"}]', 'Deux nouvelles règles : `.btn:hover { … }` et `.btn:focus-visible { … }`.', 'Le survol donne un retour visuel à la souris, le focus-visible guide les utilisateurs du clavier.', 15, 1),
(78, 51, 'Une liste zébrée', 'pseudo-classes-ex2', 'code', 2, 'Avec `:nth-child`, donnez un fond `#f1f5f9` aux éléments **pairs** (`even`) de la liste `.taches`.', '<ul class="taches">
  <li>Acheter du pain</li>
  <li>Réviser le CSS</li>
  <li>Appeler Sam</li>
  <li>Arroser les plantes</li>
</ul>', NULL, NULL, '.taches li:nth-child(even) {
  background: #f1f5f9;
}', '[{"t":"css","sel":".taches li:nth-child(even)|li:nth-child(even)|.taches li:nth-child(2n)|li:nth-child(2n)","prop":"background|background-color","value":"#f1f5f9","msg":"Les éléments pairs ont un fond #f1f5f9"}]', '`li:nth-child(even)`', '`:nth-child(even)` cible le 2e, 4e, 6e… enfant.', 15, 2),
(79, 52, 'Une barre sous le titre', 'pseudo-elements-ex1', 'code', 2, 'Avec `::after` sur `.titre`, créez une barre décorative : `content: ""`, `display: block`, `width: 50px`, `height: 3px` et `background: #ec4899`.', '<h2 class="titre">À propos</h2>', NULL, NULL, '.titre::after {
  content: "";
  display: block;
  width: 50px;
  height: 3px;
  background: #ec4899;
}', '[{"t":"css","sel":".titre::after|h2.titre::after|h2::after","prop":"content","in":["\\"\\"","''''"],"msg":"content: \\"\\" est défini"},{"t":"css","sel":".titre::after|h2.titre::after|h2::after","prop":"display","value":"block","msg":"display: block"},{"t":"css","sel":".titre::after|h2.titre::after|h2::after","prop":"width","value":"50px","msg":"width: 50px"},{"t":"css","sel":".titre::after|h2.titre::after|h2::after","prop":"height","value":"3px","msg":"height: 3px"},{"t":"css","sel":".titre::after|h2.titre::after|h2::after","prop":"background|background-color","value":"#ec4899","msg":"Fond rose #ec4899"}]', 'Sans `content`, le pseudo-élément n’existe pas.', 'Un `::after` vide transformé en bloc devient une forme décorative sous le titre.', 15, 1),
(80, 53, 'Remplacer la soupe de div', 'pourquoi-la-semantique-ex1', 'fix', 2, 'Remplacez les `<div>` par les balises sémantiques adaptées : `.header` → `<header>`, `.nav` → `<nav>`, `.content` → `<main>`, `.footer` → `<footer>`.', '<div class="header">
  <div class="nav"><a href="#">Accueil</a> <a href="#">Blog</a></div>
</div>
<div class="content">
  <h1>Bienvenue</h1>
</div>
<div class="footer">© 2026</div>', NULL, '<header>
  <nav><a href="#">Accueil</a> <a href="#">Blog</a></nav>
</header>
<main>
  <h1>Bienvenue</h1>
</main>
<footer>© 2026</footer>', NULL, '[{"t":"el","sel":"header nav","msg":"Un <nav> dans un <header>"},{"t":"el","sel":"main h1","msg":"Le titre est dans <main>"},{"t":"el","sel":"footer","msg":"Un <footer> est présent"},{"t":"noel","sel":"div","msg":"Plus aucune <div>"}]', 'Remplacez aussi les balises fermantes `</div>`.', 'Chaque zone a désormais une balise qui décrit son rôle.', 10, 1),
(81, 54, 'Le squelette sémantique', 'header-nav-main-footer-ex1', 'code', 2, 'Construisez le squelette : un `<header>` contenant un `<nav>` avec `aria-label="Principale"` et au moins 2 liens, un unique `<main>` contenant un `<h1>`, puis un `<footer>`.', NULL, NULL, '<header>
  <nav aria-label="Principale">
    <a href="#">Accueil</a>
    <a href="#">Contact</a>
  </nav>
</header>
<main>
  <h1>Mon site</h1>
</main>
<footer>
  <p>© 2026</p>
</footer>', NULL, '[{"t":"el","sel":"header nav a","min":2,"msg":"Un nav avec 2 liens dans le header"},{"t":"attr","sel":"nav","attr":"aria-label","value":"Principale","msg":"Le nav a aria-label=\\"Principale\\""},{"t":"el","sel":"main","count":1,"msg":"Un seul <main>"},{"t":"el","sel":"main h1","msg":"Un h1 dans le main"},{"t":"el","sel":"footer","msg":"Un <footer>"}]', 'L’ordre : header (avec nav), main, footer.', 'Ce squelette crée les repères essentiels de la page.', 15, 1),
(82, 55, 'Une section d’articles', 'section-article-aside-ex1', 'code', 2, 'Créez une `<section>` avec un `<h2>` **Actualités**, contenant **deux** `<article>` ayant chacun un `<h3>`. Ajoutez ensuite un `<aside>` contenant un paragraphe.', NULL, NULL, '<section>
  <h2>Actualités</h2>
  <article>
    <h3>Nouvelle recette</h3>
    <p>La tarte aux pommes revisitée.</p>
  </article>
  <article>
    <h3>Atelier du samedi</h3>
    <p>Apprenez à faire votre pain.</p>
  </article>
</section>
<aside>
  <p>Inscrivez-vous à la newsletter !</p>
</aside>', NULL, '[{"t":"el","sel":"section > h2","text":"Actualités","msg":"La section a un h2 « Actualités »"},{"t":"el","sel":"section article","min":2,"msg":"Deux articles dans la section"},{"t":"el","sel":"article h3","min":2,"msg":"Chaque article a un h3"},{"t":"el","sel":"aside p","msg":"Un aside avec un paragraphe"}]', 'section > h2 + article + article, puis aside.', 'La section thématique regroupe des articles autonomes ; l’aside apporte un complément.', 15, 1),
(83, 55, 'Article ou section ?', 'section-article-aside-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'Un commentaire est un contenu autonome : `<article>`.', 10, 2),
(84, 56, 'Une vidéo accessible', 'audio-et-video-ex1', 'code', 2, 'Créez un élément `<video>` avec l’attribut `controls`, contenant une `<source>` de type `video/mp4` (src : `film.mp4`) et une piste `<track>` de `kind="captions"` avec `srclang="fr"` (src : `film-fr.vtt`).', NULL, NULL, '<video controls width="480">
  <source src="film.mp4" type="video/mp4">
  <track src="film-fr.vtt" kind="captions" srclang="fr" label="Français">
</video>', NULL, '[{"t":"el","sel":"video[controls]","msg":"La vidéo a l’attribut controls"},{"t":"attr","sel":"video source","attr":"type","value":"video/mp4","msg":"Une source de type video/mp4"},{"t":"attr","sel":"video source","attr":"src","value":"film.mp4","msg":"La source est film.mp4"},{"t":"attr","sel":"video track","attr":"kind","value":"captions","msg":"Une piste de sous-titres kind=\\"captions\\""},{"t":"attr","sel":"video track","attr":"srclang","value":"fr","msg":"srclang=\\"fr\\""}]', '`<source>` et `<track>` se placent à l’intérieur de `<video>`.', '`controls` affiche le lecteur, `<source>` fournit le fichier et `<track>` les sous-titres.', 15, 1),
(85, 57, 'Une carte intégrée accessible', 'iframe-contenus-integres-ex1', 'code', 1, 'Ajoutez les attributs manquants à l’iframe : un `title` non vide et `loading="lazy"`.', '<iframe src="https://www.openstreetmap.org/export/embed.html" width="400" height="250"></iframe>', NULL, '<iframe src="https://www.openstreetmap.org/export/embed.html" width="400" height="250" title="Carte du quartier" loading="lazy"></iframe>', NULL, '[{"t":"attr","sel":"iframe","attr":"title","nonempty":true,"msg":"L’iframe a un title"},{"t":"attr","sel":"iframe","attr":"loading","value":"lazy","msg":"loading=\\"lazy\\""}]', 'Deux attributs à ajouter dans la balise ouvrante.', 'Le `title` nomme l’iframe pour les lecteurs d’écran ; `lazy` diffère son chargement.', 15, 1),
(86, 58, 'Compléter le head', 'les-balises-meta-ex1', 'code', 2, 'Ajoutez dans le `<head>` une `meta description` non vide et une balise `og:title` (attribut `property`) avec un `content` non vide.', '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Studio Yoga Zen — Cours à Bordeaux</title>
</head>
<body>
  <h1>Studio Yoga Zen</h1>
</body>
</html>', NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Studio Yoga Zen — Cours à Bordeaux</title>
  <meta name="description" content="Cours de yoga pour tous niveaux au cœur de Bordeaux, en petits groupes.">
  <meta property="og:title" content="Studio Yoga Zen — Cours à Bordeaux">
</head>
<body>
  <h1>Studio Yoga Zen</h1>
</body>
</html>', NULL, '[{"t":"attr","sel":"meta[name=description]","attr":"content","nonempty":true,"msg":"Une meta description non vide"},{"t":"attr","sel":"meta[property=\\"og:title\\"]","attr":"content","nonempty":true,"msg":"Une balise og:title non vide"}]', '`<meta name="description" content="…">` et `<meta property="og:title" content="…">`.', 'La description sert aux moteurs de recherche, `og:title` au partage sur les réseaux.', 15, 1),
(87, 59, 'Optimiser une page', 'seo-de-base-ex1', 'fix', 2, 'Cette page a trois problèmes SEO : le `<title>` est « Page 1 », il y a deux `<h1>`, et l’image n’a pas de `alt`. Corrigez-les : un title contenant **Randonnée**, un seul `<h1>` (transformez le second en `<h2>`), et un `alt` descriptif.', '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Page 1</title>
</head>
<body>
  <h1>Randonnée au lac Blanc</h1>
  <h1>Itinéraire</h1>
  <img src="https://placehold.co/300x200/png" width="300" height="200">
</body>
</html>', NULL, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Randonnée au lac Blanc — Itinéraire et conseils</title>
</head>
<body>
  <h1>Randonnée au lac Blanc</h1>
  <h2>Itinéraire</h2>
  <img src="https://placehold.co/300x200/png" width="300" height="200" alt="Lac Blanc entouré de montagnes enneigées">
</body>
</html>', NULL, '[{"t":"el","sel":"title","contains":"Randonnée","msg":"Le title contient « Randonnée »"},{"t":"el","sel":"h1","count":1,"msg":"Un seul h1"},{"t":"el","sel":"h2","text":"Itinéraire","msg":"« Itinéraire » est un h2"},{"t":"attr","sel":"img","attr":"alt","nonempty":true,"msg":"L’image a un alt descriptif"}]', 'Trois modifications indépendantes.', 'Un title descriptif, une hiérarchie de titres propre et des alt pertinents sont les bases du SEO on-page.', 10, 1),
(88, 60, 'Remplacer une div cliquable', 'principes-accessibilite-ex1', 'fix', 2, 'Ce « faux » bouton est une `<div>` : inaccessible au clavier. Remplacez-la par un vrai `<button type="button">` en conservant la classe `btn` et le texte.', '<div class="btn">Ajouter au panier</div>', '.btn { display: inline-block; padding: 10px 16px; background: #0f766e; color: white; border: 0; border-radius: 6px; }', '<button type="button" class="btn">Ajouter au panier</button>', '.btn { display: inline-block; padding: 10px 16px; background: #0f766e; color: white; border: 0; border-radius: 6px; }', '[{"t":"el","sel":"button.btn","text":"Ajouter au panier","msg":"Un <button class=\\"btn\\"> « Ajouter au panier »"},{"t":"attr","sel":"button","attr":"type","value":"button","msg":"type=\\"button\\" est précisé"},{"t":"noel","sel":"div","msg":"Plus de <div>"}]', 'Remplacez `div` par `button` dans les deux balises.', 'Un `<button>` est focusable, activable au clavier et annoncé comme bouton, sans aucun code supplémentaire.', 10, 1),
(89, 60, 'Information et couleur', 'principes-accessibilite-ex2', 'truefalse', 1, 'Vrai ou faux ?', NULL, NULL, NULL, NULL, NULL, NULL, 'Faux : les personnes daltoniennes ou aveugles ne perçoivent pas la couleur. Il faut aussi un texte (et idéalement une icône).', 10, 2),
(90, 61, 'Un bouton icône accessible', 'aria-et-navigation-clavier-ex1', 'code', 2, 'Ce bouton n’affiche qu’une icône. Ajoutez-lui `aria-label="Rechercher"` et masquez l’icône aux lecteurs d’écran avec `aria-hidden="true"` sur le `<span>`.', '<button type="button">
  <span>🔍</span>
</button>', NULL, '<button type="button" aria-label="Rechercher">
  <span aria-hidden="true">🔍</span>
</button>', NULL, '[{"t":"attr","sel":"button","attr":"aria-label","value":"Rechercher","msg":"Le bouton a aria-label=\\"Rechercher\\""},{"t":"attr","sel":"button span","attr":"aria-hidden","value":"true","msg":"L’icône a aria-hidden=\\"true\\""}]', 'Le nom va sur le bouton, `aria-hidden` sur l’icône.', 'Le lecteur d’écran annoncera « Rechercher, bouton » au lieu du nom de l’emoji.', 15, 1),
(91, 62, 'Moderniser du code obsolète', 'ecrire-un-html-propre-ex1', 'fix', 2, 'Ce code utilise des balises obsolètes. Remplacez `<center>` par un simple paragraphe `<p>` (le centrage se fera en CSS), et `<font color="red">` par `<strong>`.', '<center>Bienvenue sur mon site, <font color="red">très</font> heureux de vous voir !</center>', NULL, '<p>Bienvenue sur mon site, <strong>très</strong> heureux de vous voir !</p>', NULL, '[{"t":"noel","sel":"center","msg":"Plus de balise <center>"},{"t":"noel","sel":"font","msg":"Plus de balise <font>"},{"t":"el","sel":"p strong","text":"très","msg":"« très » est dans un <strong> à l’intérieur d’un paragraphe"}]', 'La présentation (centrage, couleur) relève du CSS.', '`<center>` et `<font>` sont obsolètes : le HTML décrit le sens, le CSS l’apparence.', 10, 1),
(92, 63, 'Corriger quatre erreurs', 'valider-et-deboguer-ex1', 'fix', 3, 'Ce code contient 4 erreurs de validation : un `<h2>` dans un `<p>`, une imbrication incorrecte de `<strong>`, un `id` en double (`info`) et une image sans `alt`. Corrigez-les toutes.', '<p><h2>Horaires</h2></p>
<p>Ouvert <strong>tous les jours</p></strong>
<p id="info">Parking gratuit.</p>
<p id="info">Accès handicapés.</p>
<img src="https://placehold.co/100x100/png" width="100" height="100">', NULL, '<h2>Horaires</h2>
<p>Ouvert <strong>tous les jours</strong></p>
<p id="info-parking">Parking gratuit.</p>
<p id="info-acces">Accès handicapés.</p>
<img src="https://placehold.co/100x100/png" width="100" height="100" alt="Façade du magasin">', NULL, '[{"t":"absent","s":"<p><h2>","msg":"Le h2 n’est plus dans un paragraphe"},{"t":"contains","s":"</strong></p>","msg":"</strong> est fermé avant </p>"},{"t":"el","sel":"#info","max":1,"min":0,"msg":"L’id « info » n’est plus dupliqué"},{"t":"match","re":"^(?![\\\\s\\\\S]*id=\\"([^\\"]+)\\"[\\\\s\\\\S]*id=\\"\\\\1\\")","msg":"Tous les id sont uniques"},{"t":"attr","sel":"img","attr":"alt","nonempty":true,"msg":"L’image a un alt"}]', 'Donnez deux identifiants différents aux paragraphes.', 'Chaque erreur corrigée rend la page plus robuste et plus accessible.', 10, 1),
(93, 64, 'Une image fluide', 'principes-responsive-ex1', 'code', 1, 'L’image déborde de son conteneur. Ajoutez une règle `img` avec `max-width: 100%` et `height: auto`.', '<div class="boite">
  <img src="https://placehold.co/900x300/png" alt="Paysage" width="900" height="300">
</div>', '.boite {
  width: 300px;
  border: 2px solid #94a3b8;
}', NULL, '.boite {
  width: 300px;
  border: 2px solid #94a3b8;
}

img {
  max-width: 100%;
  height: auto;
}', '[{"t":"css","sel":"img|.boite img","prop":"max-width","value":"100%","msg":"img a max-width: 100%"},{"t":"css","sel":"img|.boite img","prop":"height","value":"auto","msg":"img a height: auto"}]', 'Une nouvelle règle ciblant `img`.', '`max-width: 100%` empêche le débordement et `height: auto` conserve les proportions.', 15, 1),
(94, 65, 'Deux colonnes sur grand écran', 'media-queries-ex1', 'code', 2, 'La grille `.colonnes` affiche une colonne. Ajoutez une media query `(min-width: 700px)` qui lui donne `grid-template-columns: 1fr 1fr`.', '<div class="colonnes">
  <div class="bloc">Gauche</div>
  <div class="bloc">Droite</div>
</div>', '.colonnes {
  display: grid;
  gap: 12px;
}

.bloc {
  padding: 24px;
  background: #fce7f3;
}', NULL, '.colonnes {
  display: grid;
  gap: 12px;
}

.bloc {
  padding: 24px;
  background: #fce7f3;
}

@media (min-width: 700px) {
  .colonnes {
    grid-template-columns: 1fr 1fr;
  }
}', '[{"t":"match","re":"@media\\\\s*\\\\(\\\\s*min-width\\\\s*:\\\\s*700px\\\\s*\\\\)","in":"css","msg":"Une media query (min-width: 700px)"},{"t":"match","re":"@media[^{]*\\\\{\\\\s*\\\\.colonnes\\\\s*\\\\{[^}]*grid-template-columns\\\\s*:\\\\s*(1fr 1fr|repeat\\\\(2,\\\\s*1fr\\\\))","in":"css","msg":".colonnes passe à 2 colonnes dans la media query"}]', '`@media (min-width: 700px) { .colonnes { … } }`', 'La règle n’est appliquée qu’à partir de 700px : sur mobile, la grille reste en une colonne.', 15, 1),
(95, 65, 'Respecter les préférences', 'media-queries-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, '`prefers-reduced-motion: reduce`.', 10, 2),
(96, 66, 'Un titre fluide', 'typographie-et-images-fluides-ex1', 'code', 2, 'Donnez au `h1` une taille fluide : `font-size: clamp(2rem, 5vw, 4rem)`.', '<h1>Titre adaptable</h1>', NULL, NULL, 'h1 {
  font-size: clamp(2rem, 5vw, 4rem);
}', '[{"t":"css","sel":"h1","prop":"font-size","value":"clamp(2rem, 5vw, 4rem)","msg":"font-size: clamp(2rem, 5vw, 4rem)"}]', 'Recopiez la fonction avec ses trois valeurs séparées par des virgules.', 'Le titre suit la largeur de l’écran (5vw) sans descendre sous 2rem ni dépasser 4rem.', 15, 1),
(97, 66, 'Des vignettes sans déformation', 'typographie-et-images-fluides-ex2', 'code', 2, 'Les images sont déformées. Ajoutez `object-fit: cover` à `.vignette`.', '<img class="vignette" src="https://placehold.co/800x400/png" alt="Vignette">', '.vignette {
  width: 200px;
  height: 200px;
}', NULL, '.vignette {
  width: 200px;
  height: 200px;
  object-fit: cover;
}', '[{"t":"css","sel":".vignette|img.vignette","prop":"object-fit","value":"cover","msg":"object-fit: cover"}]', 'Une seule propriété.', '`cover` remplit le carré en rognant l’image au lieu de la déformer.', 15, 2),
(98, 67, 'Un survol en douceur', 'les-transitions-ex1', 'code', 1, 'Ajoutez à `.btn` une transition sur `background-color` de `0.3s` avec la courbe `ease`.', '<button class="btn" type="button">Survolez-moi</button>', '.btn {
  padding: 10px 20px;
  border: 0;
  background: #f97316;
  color: white;
}

.btn:hover {
  background: #c2410c;
}', NULL, '.btn {
  padding: 10px 20px;
  border: 0;
  background: #f97316;
  color: white;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background: #c2410c;
}', '[{"t":"css","sel":".btn|button.btn","prop":"transition","in":["background-color 0.3s ease","background 0.3s ease","background-color .3s ease","background-color 300ms ease"],"msg":"transition: background-color 0.3s ease sur .btn"}]', 'La transition se déclare sur `.btn`, pas sur `.btn:hover`.', 'Déclarée sur l’état de repos, la transition fonctionne à l’entrée comme à la sortie du survol.', 15, 1),
(99, 68, 'Une carte qui se soulève', 'transform-ex1', 'code', 2, 'Au survol de `.carte`, appliquez `transform: translateY(-6px)`. Ajoutez sur `.carte` une `transition` sur `transform` de `0.25s`.', '<div class="carte">Survolez-moi</div>', '.carte {
  width: 200px;
  padding: 30px;
  background: #fef3c7;
  border-radius: 12px;
}', NULL, '.carte {
  width: 200px;
  padding: 30px;
  background: #fef3c7;
  border-radius: 12px;
  transition: transform 0.25s;
}

.carte:hover {
  transform: translateY(-6px);
}', '[{"t":"css","sel":".carte:hover|div.carte:hover","prop":"transform","value":"translateY(-6px)","msg":"Au survol : transform: translateY(-6px)"},{"t":"css","sel":".carte|div.carte","prop":"transition","contains":"transform","msg":"Une transition sur transform est déclarée sur .carte"}]', 'Deux règles : `.carte` (transition) et `.carte:hover` (transform).', '`translateY` négatif déplace vers le haut ; la transition rend le mouvement fluide.', 15, 1),
(100, 69, 'Un fondu d’apparition', 'animations-keyframes-ex1', 'code', 2, 'Créez une animation `@keyframes fondu` qui passe de `opacity: 0` à `opacity: 1`, puis appliquez-la à `.message` avec une durée de `1s`.', '<p class="message">Je vais apparaître en douceur.</p>', NULL, NULL, '@keyframes fondu {
  from { opacity: 0; }
  to { opacity: 1; }
}

.message {
  animation: fondu 1s ease-out;
}', '[{"t":"match","re":"@keyframes\\\\s+fondu\\\\s*\\\\{","in":"css","msg":"Des keyframes nommées « fondu »"},{"t":"match","re":"(from|0%)\\\\s*\\\\{\\\\s*opacity\\\\s*:\\\\s*0\\\\s*;?\\\\s*\\\\}","in":"css","msg":"Départ à opacity: 0"},{"t":"match","re":"(to|100%)\\\\s*\\\\{\\\\s*opacity\\\\s*:\\\\s*1\\\\s*;?\\\\s*\\\\}","in":"css","msg":"Arrivée à opacity: 1"},{"t":"css","sel":".message|p.message","prop":"animation|animation-name","contains":"fondu","msg":"L’animation fondu est appliquée à .message"},{"t":"css","sel":".message|p.message","prop":"animation|animation-duration","contains":"1s","msg":"Durée de 1s"}]', '`@keyframes fondu { from { … } to { … } }` puis `animation: fondu 1s;`', 'Les keyframes décrivent les états, la propriété `animation` les joue sur l’élément.', 15, 1);

INSERT INTO `exercises` (`id`, `lesson_id`, `title`, `slug`, `type`, `difficulty`, `instructions`, `starter_html`, `starter_css`, `solution_html`, `solution_css`, `validation_rules`, `hint`, `explanation`, `points`, `sort_order`) VALUES
(101, 70, 'Une carte en relief', 'les-ombres-ex1', 'code', 1, 'Ajoutez à `.carte` l’ombre `box-shadow: 0 8px 20px rgb(0 0 0 / 15%)`.', '<div class="carte">Je flotte au-dessus de la page</div>', '.carte {
  width: 240px;
  padding: 24px;
  border-radius: 12px;
  background: white;
}', NULL, '.carte {
  width: 240px;
  padding: 24px;
  border-radius: 12px;
  background: white;
  box-shadow: 0 8px 20px rgb(0 0 0 / 15%);
}', '[{"t":"css","sel":".carte|div.carte","prop":"box-shadow","in":["0 8px 20px rgb(0 0 0 / 15%)","0 8px 20px rgba(0, 0, 0, 0.15)","0 8px 20px rgba(0, 0, 0, .15)","0px 8px 20px rgb(0 0 0 / 15%)"],"msg":"box-shadow: 0 8px 20px rgb(0 0 0 / 15%)"}]', 'Décalage x, décalage y, flou, couleur.', 'Une ombre décalée vers le bas, floue et semi-transparente donne un effet de relief naturel.', 15, 1),
(102, 71, 'Un bandeau en dégradé', 'les-degrades-ex1', 'code', 1, 'Donnez à `.bandeau` un fond `linear-gradient(90deg, #06b6d4, #3b82f6)`.', '<header class="bandeau">Soldes d’hiver</header>', '.bandeau {
  padding: 32px;
  color: white;
  font-size: 1.5rem;
}', NULL, '.bandeau {
  padding: 32px;
  color: white;
  font-size: 1.5rem;
  background: linear-gradient(90deg, #06b6d4, #3b82f6);
}', '[{"t":"css","sel":".bandeau|header.bandeau","prop":"background|background-image","value":"linear-gradient(90deg, #06b6d4, #3b82f6)","msg":"Fond en linear-gradient(90deg, #06b6d4, #3b82f6)"}]', 'Utilisez `background` (pas `background-color`).', 'Un dégradé est une image : il se place dans `background` ou `background-image`.', 15, 1),
(103, 72, 'Centraliser une couleur', 'variables-css-ex1', 'code', 2, 'Déclarez dans `:root` la variable `--marque` valant `#e11d48`, puis utilisez-la avec `var(--marque)` pour le `color` du `h1` ET le `background` du `.btn`.', '<h1>Ma marque</h1>
<a class="btn" href="#">Acheter</a>', '.btn {
  display: inline-block;
  padding: 10px 18px;
  color: white;
  text-decoration: none;
}', NULL, ':root {
  --marque: #e11d48;
}

h1 {
  color: var(--marque);
}

.btn {
  display: inline-block;
  padding: 10px 18px;
  color: white;
  text-decoration: none;
  background: var(--marque);
}', '[{"t":"css","sel":":root|html","prop":"--marque","value":"#e11d48","msg":"--marque: #e11d48 est déclarée dans :root"},{"t":"css","sel":"h1","prop":"color","value":"var(--marque)","msg":"Le h1 utilise var(--marque)"},{"t":"css","sel":".btn|a.btn","prop":"background|background-color","value":"var(--marque)","msg":"Le .btn utilise var(--marque)"},{"t":"match","re":"^(?![\\\\s\\\\S]*#e11d48[\\\\s\\\\S]*#e11d48)","in":"css","msg":"La couleur #e11d48 n’est écrite qu’une seule fois"}]', '`:root { --marque: #e11d48; }` puis `var(--marque)`.', 'La couleur est définie une seule fois : pour la changer, une seule ligne suffit.', 15, 1),
(104, 72, 'Valeur de repli', 'variables-css-ex2', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'La seconde valeur de `var()` sert de repli.', 10, 2),
(105, 73, 'Classes BEM', 'organiser-une-feuille-css-ex1', 'qcm', 1, 'Choisissez la bonne réponse.', NULL, NULL, NULL, NULL, NULL, NULL, 'Deux tirets `--` pour un modificateur (variante) ; deux underscores `__` pour un élément.', 10, 1),
(106, 73, 'Réduire la spécificité', 'organiser-une-feuille-css-ex2', 'fix', 2, 'Remplacez le sélecteur trop long `body main .zone div p.note` par une simple classe `.note` (le résultat visuel doit rester le même).', '<main><div class="zone"><div><p class="note">Pensez à sauvegarder.</p></div></div></main>', 'body main .zone div p.note {
  color: #92400e;
  background: #fef3c7;
  padding: 8px;
}', NULL, '.note {
  color: #92400e;
  background: #fef3c7;
  padding: 8px;
}', '[{"t":"css","sel":".note","prop":"color","value":"#92400e","msg":"La règle utilise le sélecteur .note"},{"t":"absent","s":"body main","in":"css","msg":"Le sélecteur long a disparu"}]', 'Gardez les déclarations, changez seulement le sélecteur.', 'Une classe unique suffit : le style est plus simple à surcharger et ne dépend plus de la structure HTML.', 10, 2),
(107, 74, 'Étendre la zone cliquable', 'creer-un-composant-carte-ex1', 'code', 3, 'Rendez toute la carte cliquable : `.carte` doit être en `position: relative`, et `.carte a::after` doit avoir `content: ""`, `position: absolute` et `inset: 0`.', '<article class="carte">
  <h3><a href="#">Découvrir Grid</a></h3>
  <p>Cliquez n’importe où sur la carte.</p>
</article>', '.carte {
  padding: 20px;
  border: 1px solid #cbd5e1;
  border-radius: 12px;
  max-width: 280px;
}', NULL, '.carte {
  position: relative;
  padding: 20px;
  border: 1px solid #cbd5e1;
  border-radius: 12px;
  max-width: 280px;
}

.carte a::after {
  content: "";
  position: absolute;
  inset: 0;
}', '[{"t":"css","sel":".carte|article.carte","prop":"position","value":"relative","msg":".carte est en position: relative"},{"t":"css","sel":".carte a::after|.carte h3 a::after|a::after","prop":"content","in":["\\"\\"","''''"],"msg":"Le ::after du lien a content: \\"\\""},{"t":"css","sel":".carte a::after|.carte h3 a::after|a::after","prop":"position","value":"absolute","msg":"Le ::after est en position: absolute"},{"t":"css","sel":".carte a::after|.carte h3 a::after|a::after","prop":"inset","in":["0","0px"],"msg":"Le ::after couvre la carte (inset: 0)"}]', 'Le pseudo-élément du lien se positionne par rapport à la carte.', 'Le `::after` absolu du lien couvre toute la carte (repère relatif) : un seul lien, une grande zone cliquable.', 15, 1),
(108, 75, 'Amélioration progressive', 'bonnes-pratiques-css-performance-ex1', 'code', 2, 'Ajoutez un bloc `@supports (display: grid)` qui applique `display: grid` et `grid-template-columns: 1fr 1fr` à `.duo`. Sans support, les blocs restent empilés.', '<div class="duo">
  <div class="bloc">Un</div>
  <div class="bloc">Deux</div>
</div>', '.bloc {
  padding: 20px;
  margin-bottom: 8px;
  background: #e0e7ff;
}', NULL, '.bloc {
  padding: 20px;
  margin-bottom: 8px;
  background: #e0e7ff;
}

@supports (display: grid) {
  .duo {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
  }
}', '[{"t":"match","re":"@supports\\\\s*\\\\(\\\\s*display\\\\s*:\\\\s*grid\\\\s*\\\\)","in":"css","msg":"Un bloc @supports (display: grid)"},{"t":"css","sel":".duo|div.duo","prop":"display","value":"grid","msg":".duo passe en grid"},{"t":"css","sel":".duo|div.duo","prop":"grid-template-columns","in":["1fr 1fr","repeat(2, 1fr)"],"msg":"Deux colonnes"}]', '`@supports (display: grid) { .duo { … } }`', 'Le contenu fonctionne partout ; la mise en page en grille s’ajoute là où elle est supportée.', 15, 1);

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
(23, 6, NULL, 'Que se passe-t-il si on oublie `-->` ?', 'single', NULL, 'Sans fermeture, tout ce qui suit est traité comme un commentaire et disparaît.', 2),
(24, NULL, 11, 'Après un `<h2>`, quel titre utiliser pour une sous-partie ?', 'single', NULL, NULL, 0),
(25, 7, NULL, 'Combien de `<h1>` une page devrait-elle contenir ?', 'single', NULL, 'Un seul `<h1>` décrit le sujet principal de la page.', 0),
(26, 7, NULL, 'On choisit le niveau d’un titre en fonction de sa taille d’affichage.', 'truefalse', NULL, 'Faux : le niveau reflète la hiérarchie du contenu ; la taille se règle en CSS.', 1),
(27, 7, NULL, 'Qui utilise les titres pour naviguer dans une page ?', 'single', NULL, 'Tout le monde en profite : humains, technologies d’assistance et robots.', 2),
(28, 8, NULL, 'Comment le navigateur affiche-t-il 5 espaces consécutifs dans un paragraphe ?', 'single', NULL, 'Les espaces blancs consécutifs sont fusionnés en un seul.', 0),
(29, 8, NULL, 'Quel élément peut être placé dans un `<p>` ?', 'single', NULL, '`<strong>` est un élément en ligne ; les autres sont des éléments blocs.', 1),
(30, 8, NULL, 'Un paragraphe est un élément de type bloc.', 'truefalse', NULL, 'Vrai : il occupe toute la largeur et commence sur une nouvelle ligne.', 2),
(31, 9, NULL, 'Quelle balise marque un changement de sujet ?', 'single', NULL, '`<hr>` représente une rupture thématique.', 0),
(32, 9, NULL, 'Quelle est la bonne façon d’espacer deux paragraphes ?', 'single', NULL, 'L’espacement est une question de présentation : on utilise le CSS.', 1),
(33, 9, NULL, '`<br>` possède une balise fermante `</br>`.', 'truefalse', NULL, 'Faux : `<br>` est un élément vide.', 2),
(34, 10, NULL, 'Quelle balise exprime une forte importance ?', 'single', NULL, '`<strong>` porte le sens d’importance ; `<b>` n’est qu’une mise en évidence.', 0),
(35, 10, NULL, 'Quelle balise convient pour un mot étranger ?', 'single', NULL, '`<i>` représente un texte dans un ton différent, comme un terme étranger.', 1),
(36, 10, NULL, 'Pour mettre tous les liens du menu en gras, il faut utiliser `<strong>`.', 'truefalse', NULL, 'Faux : c’est un choix de présentation, on utilise le CSS.', 2),
(37, NULL, 17, 'Comment afficher littéralement le texte `<p>` dans une page ?', 'single', NULL, NULL, 0),
(38, 11, NULL, 'Quelle balise pour une citation longue ?', 'single', NULL, '`<blockquote>` est destiné aux citations longues en bloc.', 0),
(39, 11, NULL, 'Comment écrire « 1er » avec l’exposant ?', 'single', NULL, 'L’exposant s’écrit avec `<sup>`.', 1),
(40, 11, NULL, 'À quoi sert l’attribut `title` de `<abbr>` ?', 'single', NULL, 'Il indique la signification complète de l’abréviation.', 2),
(41, 11, NULL, '`<kbd>` sert à représenter une touche du clavier.', 'truefalse', NULL, 'Vrai : par exemple `<kbd>Entrée</kbd>`.', 3),
(42, 12, NULL, 'Quel attribut contient la destination d’un lien ?', 'single', NULL, '`href` (hypertext reference) contient l’adresse de destination.', 0),
(43, 12, NULL, 'Quel texte de lien est le plus accessible ?', 'single', NULL, 'Il décrit précisément la destination et le format.', 1),
(44, 12, NULL, 'Pour envoyer un formulaire, on utilise un lien `<a>`.', 'truefalse', NULL, 'Faux : une action se déclenche avec un `<button>`.', 2),
(45, NULL, 22, 'Depuis `blog/article.html`, quel chemin mène à `index.html` situé à la racine du site ?', 'single', NULL, NULL, 0),
(46, 13, NULL, 'Quel lien mène à l’élément `<section id="equipe">` ?', 'single', NULL, 'Une ancre s’écrit avec `#` suivi de l’`id` ciblé.', 0),
(47, 13, NULL, 'Quel attribut accompagne toujours `target="_blank"` ?', 'single', NULL, '`rel="noopener"` protège contre le tabnabbing.', 1),
(48, 13, NULL, 'Que signifie `../` dans un chemin ?', 'single', NULL, '`../` désigne le dossier parent.', 2),
(49, 13, NULL, 'Un lien `tel:` permet de lancer un appel sur mobile.', 'truefalse', NULL, 'Vrai : par exemple `href="tel:+33412345678"`.', 3),
(50, 14, NULL, 'Que signifie CSS ?', 'single', NULL, 'CSS = Cascading Style Sheets, feuilles de style en cascade.', 0),
(51, 14, NULL, 'Quel est le principal avantage de séparer HTML et CSS ?', 'single', NULL, 'Le style centralisé se modifie une seule fois pour toutes les pages.', 1),
(52, 14, NULL, 'Dans `h1 { color: navy; }`, `color` est…', 'single', NULL, '`h1` est le sélecteur, `color` la propriété et `navy` la valeur.', 2),
(53, 15, NULL, 'Quelle méthode est recommandée pour un site de plusieurs pages ?', 'single', NULL, 'Une feuille externe est partagée par toutes les pages et mise en cache.', 0),
(54, 15, NULL, 'Où place-t-on la balise `<link>` ?', 'single', NULL, 'Les feuilles de style se relient dans le `<head>`.', 1),
(55, 15, NULL, 'Un style en ligne l’emporte généralement sur une règle de la feuille externe.', 'truefalse', NULL, 'Vrai : sa priorité est très élevée, c’est pourquoi on l’évite.', 2),
(56, 16, NULL, 'Quel caractère sépare une propriété de sa valeur ?', 'single', NULL, 'On écrit `propriété: valeur;`.', 0),
(57, 16, NULL, 'Comment écrit-on un commentaire en CSS ?', 'single', NULL, 'Les commentaires CSS s’écrivent entre `/*` et `*/`.', 1),
(58, 16, NULL, 'Une propriété mal orthographiée provoque un message d’erreur à l’écran.', 'truefalse', NULL, 'Faux : le navigateur l’ignore silencieusement.', 2),
(59, 17, NULL, 'Quel sélecteur cible les éléments `class="menu"` ?', 'single', NULL, 'Le point désigne une classe.', 0),
(60, 17, NULL, 'Un même `id` peut être utilisé sur plusieurs éléments d’une page.', 'truefalse', NULL, 'Faux : un identifiant doit être unique dans la page.', 1),
(61, 17, NULL, 'Que cible `p.note` ?', 'single', NULL, 'Sans espace, le sélecteur combine les conditions sur le même élément.', 2),
(62, 17, NULL, 'Quel nom de classe est le meilleur ?', 'single', NULL, 'Il décrit le rôle de l’élément, pas son apparence.', 3),
(63, NULL, 30, 'Quel sélecteur cible uniquement le paragraphe placé **juste après** un `<h2>` ?', 'single', NULL, NULL, 0),
(64, 18, NULL, 'Que cible `ul > li` ?', 'single', NULL, '`>` limite aux enfants directs.', 0),
(65, 18, NULL, 'Quel sélecteur cible les liens vers des fichiers PDF ?', 'single', NULL, '`$=` signifie « se termine par ».', 1),
(66, 18, NULL, '`nav a` cible aussi un lien situé dans une liste à l’intérieur du nav.', 'truefalse', NULL, 'Vrai : le combinateur descendant fonctionne à toute profondeur.', 2),
(67, 19, NULL, 'Quel sélecteur est le plus spécifique ?', 'single', NULL, 'Une classe (0,1,0) bat trois balises (0,0,3).', 0),
(68, 19, NULL, 'À spécificité égale, quelle règle gagne ?', 'single', NULL, 'L’ordre d’apparition départage : la dernière gagne.', 1),
(69, 19, NULL, 'Quelle propriété est héritée par les enfants ?', 'single', NULL, 'Les propriétés de texte comme `color` sont héritées.', 2),
(70, 19, NULL, 'Utiliser `!important` est une bonne pratique pour éviter les conflits.', 'truefalse', NULL, 'Faux : il crée des conflits encore plus difficiles à résoudre.', 3),
(71, NULL, 33, 'Comment rendre **uniquement le fond** d’un élément semi-transparent, sans affecter son texte ?', 'single', NULL, NULL, 0),
(72, 20, NULL, 'Que représente `#000000` ?', 'single', NULL, 'Toutes les composantes à 0 : noir.', 0),
(73, 20, NULL, 'Dans `hsl(120 100% 50%)`, que vaut la teinte 120 ?', 'single', NULL, '0 = rouge, 120 = vert, 240 = bleu.', 1),
(74, 20, NULL, 'Quel ratio de contraste minimum est recommandé pour du texte courant ?', 'single', NULL, 'WCAG niveau AA : 4,5:1 pour le texte courant.', 2),
(75, 20, NULL, '`opacity: 0.5` rend aussi le texte de l’élément transparent.', 'truefalse', NULL, 'Vrai : `opacity` s’applique à tout l’élément et à ses enfants.', 3),
(76, 21, NULL, 'Quelle valeur de `background-size` remplit toute la zone quitte à rogner l’image ?', 'single', NULL, '`cover` couvre toute la zone.', 0),
(77, 21, NULL, 'Une photo de produit dans une boutique doit être…', 'single', NULL, 'C’est un contenu : `<img>` avec un texte alternatif.', 1),
(78, 21, NULL, 'Avec plusieurs images de fond, la première listée est affichée au-dessus.', 'truefalse', NULL, 'Vrai : c’est pourquoi le voile dégradé est écrit avant la photo.', 2),
(79, 22, NULL, 'Pourquoi terminer `font-family` par `sans-serif` ?', 'single', NULL, 'La famille générique garantit un affichage correct si aucune police listée n’est disponible.', 0),
(80, 22, NULL, 'Quelle valeur de `line-height` convient à un paragraphe ?', 'single', NULL, 'Entre 1.5 et 1.7 pour le texte courant.', 1),
(81, 22, NULL, '`font-weight: 700` équivaut à `bold`.', 'truefalse', NULL, 'Vrai : 400 = normal, 700 = bold.', 2),
(82, 23, NULL, 'Quelle propriété retire le soulignement d’un lien ?', 'single', NULL, '`text-decoration: none` supprime le soulignement.', 0),
(83, 23, NULL, 'Quelle valeur de `text-transform` met la première lettre de chaque mot en majuscule ?', 'single', NULL, '`capitalize`.', 1),
(84, 23, NULL, '`text-align: center` centre une boîte dans la page.', 'truefalse', NULL, 'Faux : il centre le contenu en ligne (le texte) à l’intérieur du bloc.', 2),
(85, NULL, 38, 'Par défaut (sans réglage de l’utilisateur), combien vaut `1.5rem` ?', 'single', NULL, NULL, 0),
(86, 24, NULL, '`rem` est relatif à…', 'single', NULL, '`rem` = root em : la taille de police de la racine.', 0),
(87, 24, NULL, 'Quelle unité correspond à 1 % de la largeur de la fenêtre ?', 'single', NULL, '`vw` = viewport width.', 1),
(88, 24, NULL, 'Pourquoi préférer `rem` à `px` pour les textes ?', 'single', NULL, 'Les `rem` suivent le réglage de taille de police du navigateur.', 2),
(89, 24, NULL, 'On peut écrire `margin: 0;` sans unité.', 'truefalse', NULL, 'Vrai : zéro est zéro, quelle que soit l’unité.', 3),
(90, NULL, 40, 'Quelle est la largeur visible de : `width: 200px; padding: 10px; border: 5px solid;` ?', 'single', '.boite { width: 200px; padding: 10px; border: 5px solid; }', NULL, 0),
(91, 25, NULL, 'Quelle zone prend la couleur de fond de l’élément ?', 'single', NULL, 'Le fond couvre le contenu ET le padding (jusqu’à la bordure).', 0),
(92, 25, NULL, 'Pour éloigner une carte de sa voisine, on utilise…', 'single', NULL, 'La marge extérieure crée l’espace entre les éléments.', 1),
(93, 25, NULL, '`outline` occupe de la place dans la mise en page.', 'truefalse', NULL, 'Faux : contrairement à `border`, il ne modifie pas les dimensions.', 2),
(94, NULL, 42, 'Avec `padding: 5px 10px 15px 20px;`, quel est le padding **gauche** ?', 'single', NULL, NULL, 0),
(95, 26, NULL, '`margin: 10px 20px;` signifie…', 'single', NULL, 'Deux valeurs : vertical puis horizontal.', 0),
(96, 26, NULL, 'Deux blocs voisins ont `margin-bottom: 40px` et `margin-top: 25px`. Quel est l’écart ?', 'single', NULL, 'Les marges verticales fusionnent : la plus grande l’emporte.', 1),
(97, 26, NULL, 'Le padding peut avoir une valeur négative.', 'truefalse', NULL, 'Faux : seule la margin accepte des valeurs négatives.', 2),
(98, 27, NULL, 'Quelle déclaration affiche bien une bordure ?', 'single', NULL, 'Le style (`solid`) est indispensable : sans lui, aucune bordure n’est dessinée.', 0),
(99, 27, NULL, 'Comment obtenir un cercle à partir d’une image carrée ?', 'single', NULL, '50 % d’arrondi sur un carré = cercle.', 1),
(100, 27, NULL, 'Une bordure augmente la taille visible de la boîte avec box-sizing: content-box.', 'truefalse', NULL, 'Vrai : elle s’ajoute à la largeur et à la hauteur.', 2);

INSERT INTO `questions` (`id`, `lesson_id`, `exercise_id`, `question`, `type`, `code_snippet`, `explanation`, `sort_order`) VALUES
(101, 28, NULL, 'Avec `box-sizing: border-box`, `width: 300px; padding: 20px;` mesure…', 'single', NULL, 'La largeur déclarée inclut le padding : 300px.', 0),
(102, 28, NULL, 'Quelle propriété empêche une image de dépasser de son conteneur ?', 'single', NULL, '`max-width: 100%` la limite à la largeur disponible.', 1),
(103, 28, NULL, 'Quelle valeur d’`overflow` affiche une barre de défilement seulement si nécessaire ?', 'single', NULL, '`auto` n’ajoute la barre que si le contenu dépasse.', 2),
(104, 28, NULL, 'Fixer une `height` sur un paragraphe est une bonne pratique.', 'truefalse', NULL, 'Faux : le contenu risque de déborder ; préférez `min-height`.', 3),
(105, NULL, 47, 'Comment coder une image purement décorative (un ornement) ?', 'single', NULL, NULL, 0),
(106, 29, NULL, 'Quel attribut contient le chemin de l’image ?', 'single', NULL, '`src` = source de l’image.', 0),
(107, 29, NULL, 'Qui utilise l’attribut `alt` ?', 'single', NULL, 'Le texte alternatif sert à tous ces cas.', 1),
(108, 29, NULL, 'L’attribut `title` peut remplacer `alt`.', 'truefalse', NULL, 'Faux : `title` n’est qu’une info-bulle, peu fiable pour l’accessibilité.', 2),
(109, 30, NULL, 'Quel format pour un logo qui doit rester net à toutes les tailles ?', 'single', NULL, 'Le SVG est vectoriel.', 0),
(110, 30, NULL, 'Que fait `loading="lazy"` ?', 'single', NULL, 'Le chargement est différé.', 1),
(111, 30, NULL, 'Quel élément contient la légende d’une figure ?', 'single', NULL, '`<figcaption>`.', 2),
(112, 30, NULL, 'Dans `<picture>`, la balise `<img>` est facultative.', 'truefalse', NULL, 'Faux : elle est obligatoire et sert de repli.', 3),
(113, 31, NULL, 'Quelle balise pour les étapes d’une recette ?', 'single', NULL, 'L’ordre des étapes compte : `<ol>`.', 0),
(114, 31, NULL, 'Quel est le seul enfant direct autorisé dans un `<ul>` ?', 'single', NULL, 'Seuls des `<li>` (et éventuellement des scripts/templates).', 1),
(115, 31, NULL, 'Un menu de navigation se code généralement avec une liste.', 'truefalse', NULL, 'Vrai : c’est une liste de liens.', 2),
(116, 32, NULL, 'Où place-t-on une sous-liste ?', 'single', NULL, 'Elle appartient à un élément : dans son `<li>`.', 0),
(117, 32, NULL, 'Quelle balise contient le terme d’une liste de définitions ?', 'single', NULL, '`<dt>` = description term.', 1),
(118, 32, NULL, 'Un `<dt>` peut avoir plusieurs `<dd>`.', 'truefalse', NULL, 'Vrai : plusieurs descriptions pour un même terme.', 2),
(119, 33, NULL, 'Quelle balise crée une ligne de tableau ?', 'single', NULL, '`<tr>` = table row.', 0),
(120, 33, NULL, 'À quoi sert `scope="row"` sur un `<th>` ?', 'single', NULL, 'Il associe l’en-tête aux cellules de sa ligne.', 1),
(121, 33, NULL, 'Les tableaux sont recommandés pour la mise en page d’un site.', 'truefalse', NULL, 'Faux : la mise en page se fait en CSS.', 2),
(122, NULL, 55, 'Dans un tableau de 3 colonnes, une ligne contient `<td colspan="2">`. Combien d’autres `<td>` faut-il dans cette ligne ?', 'single', NULL, NULL, 0),
(123, 34, NULL, 'Quel élément contient la ligne des totaux ?', 'single', NULL, '`<tfoot>` est le pied du tableau.', 0),
(124, 34, NULL, 'Quel attribut fusionne une cellule sur plusieurs lignes ?', 'single', NULL, '`rowspan` couvre plusieurs lignes.', 1),
(125, 34, NULL, 'Un tableau peut contenir plusieurs `<tbody>`.', 'truefalse', NULL, 'Vrai : pour grouper des séries de lignes.', 2),
(126, NULL, 57, 'Quelle méthode pour un formulaire de connexion (e-mail + mot de passe) ?', 'single', NULL, NULL, 0),
(127, 35, NULL, 'Quel attribut détermine le nom de la donnée envoyée ?', 'single', NULL, '`name` : sans lui, le champ n’est pas envoyé.', 0),
(128, 35, NULL, 'Comment relier un label à un champ ?', 'single', NULL, 'L’attribut `for` reprend l’`id` du champ.', 1),
(129, 35, NULL, 'Le placeholder peut remplacer le label.', 'truefalse', NULL, 'Faux : il disparaît à la saisie et n’est pas fiable pour l’accessibilité.', 2),
(130, 36, NULL, 'Quel type affiche un clavier avec « @ » sur mobile ?', 'single', NULL, '`type="email"`.', 0),
(131, 36, NULL, 'Qu’ont en commun les boutons radio d’un même groupe ?', 'single', NULL, 'Le même `name` crée le groupe.', 1),
(132, 36, NULL, 'Pour un code postal, `type="number"` est idéal.', 'truefalse', NULL, 'Faux : les zéros initiaux posent problème ; préférez `text` + `inputmode="numeric"`.', 2),
(133, 37, NULL, 'Où s’écrit la valeur par défaut d’une `<textarea>` ?', 'single', NULL, 'Le contenu entre `<textarea>` et `</textarea>`.', 0),
(134, 37, NULL, 'Quel type de bouton n’envoie pas le formulaire ?', 'single', NULL, '`type="button"` n’a pas d’action par défaut.', 1),
(135, 37, NULL, 'Pour 3 choix exclusifs, des boutons radio sont plus rapides qu’un select.', 'truefalse', NULL, 'Vrai : toutes les options sont visibles d’un coup.', 2),
(136, NULL, 61, 'Grâce à `required` et `pattern`, le serveur n’a plus besoin de vérifier les données reçues.', 'truefalse', NULL, NULL, 0),
(137, 38, NULL, 'Quel attribut rend un champ obligatoire ?', 'single', NULL, '`required`.', 0),
(138, 38, NULL, 'Quel attribut impose un format par expression régulière ?', 'single', NULL, '`pattern`.', 1),
(139, 38, NULL, 'Pourquoi revalider côté serveur ?', 'single', NULL, 'Les données peuvent être envoyées sans passer par le formulaire.', 2),
(140, 39, NULL, 'Combien de fois un même `id` peut-il apparaître dans une page ?', 'single', NULL, 'Un identifiant est unique.', 0),
(141, 39, NULL, 'Que crée `class="carte produit"` ?', 'single', NULL, 'L’espace sépare deux classes.', 1),
(142, 39, NULL, 'En BEM, `menu__lien` désigne…', 'single', NULL, 'Deux underscores = élément du bloc.', 2),
(143, 40, NULL, 'Quelle est la différence entre `<div>` et `<span>` ?', 'single', NULL, 'Tous deux sont neutres ; l’un est bloc, l’autre en ligne.', 0),
(144, 40, NULL, 'Quel attribut stocke une donnée personnalisée ?', 'single', NULL, 'Les attributs `data-*`.', 1),
(145, 40, NULL, 'L’attribut `hidden` masque aussi l’élément pour les lecteurs d’écran.', 'truefalse', NULL, 'Vrai : il est masqué pour tout le monde.', 2),
(146, 41, NULL, 'Quel est le type d’affichage par défaut d’un `<a>` ?', 'single', NULL, 'Les liens sont des éléments en ligne.', 0),
(147, 41, NULL, 'Quel type accepte `width` tout en restant dans la ligne ?', 'single', NULL, '`inline-block`.', 1),
(148, 41, NULL, 'Changer `display` modifie le sens sémantique de l’élément.', 'truefalse', NULL, 'Faux : seul l’affichage change.', 2),
(149, 42, NULL, 'Quelle méthode conserve la place de l’élément masqué ?', 'single', NULL, '`visibility: hidden` réserve l’espace.', 0),
(150, 42, NULL, 'Un élément en `opacity: 0` est-il encore cliquable ?', 'single', NULL, 'Oui : il est seulement transparent.', 1),
(151, 42, NULL, '`display: none` masque aussi l’élément pour les lecteurs d’écran.', 'truefalse', NULL, 'Vrai.', 2),
(152, 43, NULL, 'Par rapport à quoi se positionne un élément `absolute` ?', 'single', NULL, 'Le premier ancêtre avec une position autre que static.', 0),
(153, 43, NULL, 'Un élément `relative` conserve-t-il sa place dans le flux ?', 'single', NULL, 'Oui, contrairement à `absolute`.', 1),
(154, 43, NULL, '`inset: 0` équivaut à `top: 0; right: 0; bottom: 0; left: 0`.', 'truefalse', NULL, 'Vrai.', 2),
(155, 44, NULL, 'Par rapport à quoi un élément `fixed` est-il positionné ?', 'single', NULL, 'La fenêtre (viewport).', 0),
(156, 44, NULL, 'Que faut-il obligatoirement ajouter à `position: sticky` ?', 'single', NULL, 'Un seuil (`top`, `bottom`…).', 1),
(157, 44, NULL, 'Un élément avec `z-index: 2` passe devant un élément avec `z-index: 1` (même contexte).', 'truefalse', NULL, 'Vrai.', 2),
(158, NULL, 69, 'Quelle déclaration empile les éléments flexibles verticalement ?', 'single', NULL, NULL, 0),
(159, 45, NULL, 'Sur quel élément applique-t-on `display: flex` ?', 'single', NULL, 'Sur le parent, qui devient conteneur flex.', 0),
(160, 45, NULL, 'Quel est l’axe principal par défaut ?', 'single', NULL, '`flex-direction: row` par défaut.', 1),
(161, 45, NULL, '`gap` ajoute aussi un espace avant le premier élément.', 'truefalse', NULL, 'Faux : seulement entre les éléments.', 2),
(162, 46, NULL, 'Quelle propriété aligne les éléments sur l’axe secondaire ?', 'single', NULL, '`align-items`.', 0),
(163, 46, NULL, 'Quelle valeur met les éléments aux extrémités avec l’espace réparti entre eux ?', 'single', NULL, '`space-between`.', 1),
(164, 46, NULL, 'En `flex-direction: column`, `justify-content` agit verticalement.', 'truefalse', NULL, 'Vrai : l’axe principal est devenu vertical.', 2),
(165, 47, NULL, 'Que signifie `flex: 1` ?', 'single', NULL, '`flex: 1` = `1 1 0` : il partage l’espace libre.', 0),
(166, 47, NULL, 'Quelle propriété autorise le retour à la ligne ?', 'single', NULL, '`flex-wrap: wrap`.', 1),
(167, 47, NULL, '`order` modifie aussi l’ordre de lecture par les lecteurs d’écran.', 'truefalse', NULL, 'Faux : seul l’affichage change, d’où le risque d’incohérence.', 2),
(168, NULL, 74, 'Avec `grid-template-columns: 1fr 3fr;` dans un conteneur de 800px (sans gap), quelle est la largeur de la 2e colonne ?', 'single', NULL, NULL, 0),
(169, 48, NULL, 'Que signifie l’unité `fr` ?', 'single', NULL, '`fr` = fraction.', 0),
(170, 48, NULL, 'Quelle écriture équivaut à `1fr 1fr 1fr 1fr` ?', 'single', NULL, '`repeat(nombre, taille)`.', 1),
(171, 48, NULL, 'Grid permet de contrôler lignes et colonnes en même temps.', 'truefalse', NULL, 'Vrai : c’est un système à deux dimensions.', 2),
(172, 49, NULL, 'Que fait `grid-column: 1 / -1` ?', 'single', NULL, 'De la première à la dernière ligne verticale.', 0),
(173, 49, NULL, 'Que représente un point `.` dans `grid-template-areas` ?', 'single', NULL, 'Une case sans zone.', 1),
(174, 49, NULL, 'Une zone nommée peut avoir une forme en L.', 'truefalse', NULL, 'Faux : les zones doivent être rectangulaires.', 2),
(175, 50, NULL, 'Que fait `minmax(200px, 1fr)` ?', 'single', NULL, 'Elle est bornée entre 200px et 1fr.', 0),
(176, 50, NULL, 'Quel mot-clé supprime les colonnes vides ?', 'single', NULL, '`auto-fit`.', 1),
(177, 50, NULL, 'Cette technique nécessite obligatoirement des media queries.', 'truefalse', NULL, 'Faux : c’est justement son intérêt.', 2),
(178, 51, NULL, 'Quelle pseudo-classe cible un lien survolé ?', 'single', NULL, '`:hover`.', 0),
(179, 51, NULL, 'Que cible `li:nth-child(odd)` ?', 'single', NULL, '`odd` = impairs (1, 3, 5…).', 1),
(180, 51, NULL, 'Supprimer le contour de focus sans le remplacer nuit à l’accessibilité.', 'truefalse', NULL, 'Vrai : les utilisateurs du clavier ne savent plus où ils sont.', 2),
(181, 52, NULL, 'Quelle propriété est obligatoire pour afficher un `::before` ?', 'single', NULL, '`content`.', 0),
(182, 52, NULL, 'Combien de deux-points pour un pseudo-élément ?', 'single', NULL, '`::before`, `::after`…', 1),
(183, 52, NULL, 'Un pseudo-élément peut contenir une information essentielle au contenu.', 'truefalse', NULL, 'Faux : il n’est pas fiable pour les lecteurs d’écran.', 2),
(184, 53, NULL, 'Que signifie « sémantique » en HTML ?', 'single', NULL, 'La sémantique décrit la nature du contenu.', 0),
(185, 53, NULL, 'Qui profite directement des balises sémantiques ?', 'single', NULL, 'Accessibilité, SEO et maintenance.', 1),
(186, 53, NULL, 'Les balises sémantiques ont une apparence spéciale par défaut.', 'truefalse', NULL, 'Faux : elles s’affichent comme des blocs neutres ; le sens est invisible.', 2),
(187, 54, NULL, 'Combien de `<main>` visibles par page ?', 'single', NULL, 'Un seul contenu principal.', 0),
(188, 54, NULL, 'Comment distinguer deux `<nav>` ?', 'single', NULL, '`aria-label` leur donne un nom accessible.', 1),
(189, 54, NULL, 'Un `<article>` peut avoir son propre `<header>`.', 'truefalse', NULL, 'Vrai : titre, auteur, date de l’article.', 2),
(190, NULL, 83, 'Quel élément pour un commentaire laissé par un lecteur sous un article ?', 'single', NULL, NULL, 0),
(191, 55, NULL, 'Un `<article>` est un contenu…', 'single', NULL, 'Il a du sens tout seul.', 0),
(192, 55, NULL, 'Que doit généralement contenir une `<section>` ?', 'single', NULL, 'Une section thématique a un titre.', 1),
(193, 55, NULL, 'Une biographie d’auteur en marge d’un article peut être un `<aside>`.', 'truefalse', NULL, 'Vrai : complémentaire au contenu principal.', 2),
(194, 56, NULL, 'Quel attribut affiche les boutons de lecture ?', 'single', NULL, '`controls`.', 0),
(195, 56, NULL, 'Quel élément ajoute des sous-titres ?', 'single', NULL, '`<track>` avec un fichier WebVTT.', 1),
(196, 56, NULL, 'Lancer automatiquement un son à l’ouverture de la page est une bonne pratique.', 'truefalse', NULL, 'Faux : c’est intrusif et gênant pour l’accessibilité.', 2),
(197, 57, NULL, 'Quel attribut est indispensable pour l’accessibilité d’une iframe ?', 'single', NULL, '`title` décrit le contenu intégré.', 0),
(198, 57, NULL, 'À quoi sert `sandbox` ?', 'single', NULL, 'C’est une mesure de sécurité.', 1),
(199, 57, NULL, 'Tous les sites peuvent être affichés dans une iframe.', 'truefalse', NULL, 'Faux : beaucoup l’interdisent pour se protéger du clickjacking.', 2),
(200, 58, NULL, 'Quelle longueur viser pour une meta description ?', 'single', NULL, 'Au-delà, elle est tronquée dans les résultats.', 0);

INSERT INTO `questions` (`id`, `lesson_id`, `exercise_id`, `question`, `type`, `code_snippet`, `explanation`, `sort_order`) VALUES
(201, 58, NULL, 'À quoi servent les balises Open Graph ?', 'single', NULL, 'Elles contrôlent la carte de partage.', 1),
(202, 58, NULL, '`<meta name="robots" content="noindex">` demande aux moteurs de ne pas indexer la page.', 'truefalse', NULL, 'Vrai.', 2),
(203, 59, NULL, 'Quel est le premier facteur de référencement ?', 'single', NULL, 'Les moteurs cherchent à satisfaire l’utilisateur.', 0),
(204, 59, NULL, 'Quel fichier liste les pages à indexer ?', 'single', NULL, '`sitemap.xml`.', 1),
(205, 59, NULL, 'Un site accessible et rapide est généralement mieux référencé.', 'truefalse', NULL, 'Vrai : ce sont des signaux de qualité.', 2),
(206, NULL, 89, 'Indiquer les champs en erreur uniquement par une bordure rouge est suffisant pour l’accessibilité.', 'truefalse', NULL, NULL, 0),
(207, 60, NULL, 'Que signifie le « P » des principes WCAG ?', 'single', NULL, 'Perceptible, Opérable, Compréhensible, Robuste.', 0),
(208, 60, NULL, 'Quel niveau WCAG est généralement exigé ?', 'single', NULL, 'Le niveau AA.', 1),
(209, 60, NULL, 'Les outils d’audit automatiques détectent tous les problèmes d’accessibilité.', 'truefalse', NULL, 'Faux : environ 30 % seulement ; les tests manuels restent indispensables.', 2),
(210, 61, NULL, 'Quelle est la règle n°1 d’ARIA ?', 'single', NULL, 'Le HTML natif apporte sémantique et comportement.', 0),
(211, 61, NULL, 'Quel attribut indique qu’un menu est ouvert ?', 'single', NULL, '`aria-expanded`.', 1),
(212, 61, NULL, '`aria-hidden="true"` peut être placé sur un bouton focusable sans problème.', 'truefalse', NULL, 'Faux : l’élément reste atteignable au clavier mais devient muet.', 2),
(213, 62, NULL, 'Quel nom de fichier est le meilleur ?', 'single', NULL, 'Minuscules, sans espace.', 0),
(214, 62, NULL, 'La balise `<center>` est…', 'single', NULL, 'Le centrage se fait en CSS.', 1),
(215, 62, NULL, 'Un formateur automatique aide à garder une indentation cohérente.', 'truefalse', NULL, 'Vrai.', 2),
(216, 63, NULL, 'Dans quel ordre corriger les erreurs de validation ?', 'single', NULL, 'Une erreur en haut peut en provoquer d’autres plus bas.', 0),
(217, 63, NULL, 'L’onglet Éléments des outils de développement affiche…', 'single', NULL, 'Le DOM réel, éventuellement corrigé.', 1),
(218, 63, NULL, 'Si la page s’affiche correctement, le HTML est forcément valide.', 'truefalse', NULL, 'Faux : le navigateur masque de nombreuses erreurs.', 2),
(219, 64, NULL, 'Que signifie « mobile first » ?', 'single', NULL, 'Le CSS de base cible le mobile, les media queries `min-width` enrichissent.', 0),
(220, 64, NULL, 'Quelle taille minimale recommandée pour une zone tactile ?', 'single', NULL, '44×44 pixels.', 1),
(221, 64, NULL, 'Sans balise viewport, les media queries ne se comportent pas comme prévu sur mobile.', 'truefalse', NULL, 'Vrai : le mobile simule un écran large.', 2),
(222, NULL, 95, 'Quelle media query détecte que l’utilisateur souhaite moins d’animations ?', 'single', NULL, NULL, 0),
(223, 65, NULL, 'Quelle media query correspond à l’approche mobile first ?', 'single', NULL, '`min-width` enrichit progressivement.', 0),
(224, 65, NULL, 'Où placer les media queries dans la feuille de style ?', 'single', NULL, 'Après, pour surcharger les styles de base grâce à la cascade.', 1),
(225, 65, NULL, 'Les points de rupture doivent correspondre exactement aux modèles de téléphones récents.', 'truefalse', NULL, 'Faux : ils dépendent du contenu.', 2),
(226, 66, NULL, 'Dans `clamp(1rem, 3vw, 2rem)`, que vaut le maximum ?', 'single', NULL, 'Le troisième argument est le maximum.', 0),
(227, 66, NULL, 'Quelle valeur d’`object-fit` remplit la zone en rognant l’image ?', 'single', NULL, '`cover`.', 1),
(228, 66, NULL, '`aspect-ratio: 16 / 9` garde les proportions quelle que soit la largeur.', 'truefalse', NULL, 'Vrai.', 2),
(229, 67, NULL, 'Où déclarer la transition pour qu’elle joue dans les deux sens ?', 'single', NULL, 'Sur l’état de base de l’élément.', 0),
(230, 67, NULL, 'Quelles propriétés sont les plus performantes à animer ?', 'single', NULL, 'Elles ne provoquent pas de recalcul de mise en page.', 1),
(231, 67, NULL, 'Une transition de 2 secondes est idéale pour un survol de bouton.', 'truefalse', NULL, 'Faux : 150 à 300ms.', 2),
(232, 68, NULL, 'Quelle fonction agrandit un élément ?', 'single', NULL, '`scale()`.', 0),
(233, 68, NULL, 'Un élément transformé pousse-t-il ses voisins ?', 'single', NULL, 'Non : il garde sa place d’origine dans la mise en page.', 1),
(234, 68, NULL, 'Dans `translate(-50%, -50%)`, les pourcentages sont relatifs à l’élément lui-même.', 'truefalse', NULL, 'Vrai.', 2),
(235, 69, NULL, 'Quelle valeur répète une animation sans fin ?', 'single', NULL, '`animation-iteration-count: infinite`.', 0),
(236, 69, NULL, 'Que fait `animation-fill-mode: forwards` ?', 'single', NULL, 'L’élément garde les styles de la dernière étape.', 1),
(237, 69, NULL, 'Il faut respecter la préférence `prefers-reduced-motion`.', 'truefalse', NULL, 'Vrai : c’est une question d’accessibilité.', 2),
(238, 70, NULL, 'Dans `box-shadow: 0 4px 12px black`, que vaut le flou ?', 'single', NULL, 'Troisième valeur : le rayon de flou.', 0),
(239, 70, NULL, 'Quel mot-clé crée une ombre intérieure ?', 'single', NULL, '`inset`.', 1),
(240, 70, NULL, 'On peut superposer plusieurs ombres séparées par des virgules.', 'truefalse', NULL, 'Vrai.', 2),
(241, 71, NULL, 'Quelle propriété n’accepte PAS de dégradé ?', 'single', NULL, 'Un dégradé est une image, pas une couleur.', 0),
(242, 71, NULL, 'Quel dégradé convient à un graphique en camembert ?', 'single', NULL, '`conic-gradient` tourne autour d’un point.', 1),
(243, 71, NULL, 'Deux couleurs à la même position créent une transition nette.', 'truefalse', NULL, 'Vrai : c’est la technique des rayures.', 2),
(244, NULL, 104, 'Que vaut `color: var(--accent, orange);` si `--accent` n’est définie nulle part ?', 'single', NULL, NULL, 0),
(245, 72, NULL, 'Comment commence le nom d’une variable CSS ?', 'single', NULL, 'Deux tirets.', 0),
(246, 72, NULL, 'Que désigne `:root` ?', 'single', NULL, '`<html>`.', 1),
(247, 72, NULL, 'Une variable redéfinie sur un élément s’applique à ses descendants.', 'truefalse', NULL, 'Vrai : elle suit l’héritage.', 2),
(248, NULL, 105, 'Selon BEM, quelle classe désigne une variante « désactivée » du bloc `bouton` ?', 'single', NULL, NULL, 0),
(249, 73, NULL, 'Dans quel ordre organiser une feuille de style ?', 'single', NULL, 'Du général au particulier.', 0),
(250, 73, NULL, 'Pourquoi éviter les sélecteurs longs ?', 'single', NULL, 'Forte spécificité et dépendance à la structure HTML.', 1),
(251, 73, NULL, 'En BEM, `.menu__lien` est un élément du bloc `menu`.', 'truefalse', NULL, 'Vrai.', 2),
(252, 74, NULL, 'Pourquoi éviter d’envelopper toute la carte dans un `<a>` ?', 'single', NULL, 'Le nom du lien devient interminable.', 0),
(253, 74, NULL, 'Quelle pseudo-classe cible une carte dont un descendant a le focus ?', 'single', NULL, '`:focus-within`.', 1),
(254, 74, NULL, '`margin-top: auto` dans un conteneur flex en colonne pousse l’élément vers le bas.', 'truefalse', NULL, 'Vrai.', 2),
(255, 75, NULL, 'Quel site indique la compatibilité des propriétés CSS ?', 'single', NULL, 'caniuse.com.', 0),
(256, 75, NULL, 'À quoi sert `font-display: swap` ?', 'single', NULL, 'Le texte reste lisible pendant le chargement de la police web.', 1),
(257, 75, NULL, 'La minification réduit le poids des fichiers CSS.', 'truefalse', NULL, 'Vrai.', 2);

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
(78, 23, 'Une erreur s’affiche à l’écran', 0, 3),
(79, 24, '`<h1>`', 0, 0),
(80, 24, '`<h3>`', 1, 1),
(81, 24, '`<h4>`', 0, 2),
(82, 24, '`<h6>`', 0, 3),
(83, 25, 'Aucun', 0, 0),
(84, 25, 'Un seul', 1, 1),
(85, 25, 'Deux', 0, 2),
(86, 25, 'Autant qu’on veut', 0, 3),
(87, 26, 'Vrai', 0, 0),
(88, 26, 'Faux', 1, 1),
(89, 27, 'Uniquement les moteurs de recherche', 0, 0),
(90, 27, 'Uniquement les lecteurs d’écran', 0, 1),
(91, 27, 'Les lecteurs, les lecteurs d’écran et les moteurs de recherche', 1, 2),
(92, 27, 'Personne', 0, 3),
(93, 28, '5 espaces', 0, 0),
(94, 28, 'Un seul espace', 1, 1),
(95, 28, 'Un retour à la ligne', 0, 2),
(96, 28, 'Aucun espace', 0, 3),
(97, 29, '`<h2>`', 0, 0),
(98, 29, '`<ul>`', 0, 1),
(99, 29, '`<strong>`', 1, 2),
(100, 29, '`<p>`', 0, 3),
(101, 30, 'Vrai', 1, 0),
(102, 30, 'Faux', 0, 1),
(103, 31, '`<br>`', 0, 0),
(104, 31, '`<hr>`', 1, 1),
(105, 31, '`<pre>`', 0, 2),
(106, 31, '`<line>`', 0, 3),
(107, 32, '`<br><br>`', 0, 0),
(108, 32, 'Des `<p></p>` vides', 0, 1),
(109, 32, 'La propriété CSS `margin`', 1, 2),
(110, 32, 'Des espaces', 0, 3),
(111, 33, 'Vrai', 0, 0),
(112, 33, 'Faux', 1, 1),
(113, 34, '`<b>`', 0, 0),
(114, 34, '`<strong>`', 1, 1),
(115, 34, '`<em>`', 0, 2),
(116, 34, '`<i>`', 0, 3),
(117, 35, '`<em>`', 0, 0),
(118, 35, '`<strong>`', 0, 1),
(119, 35, '`<i>`', 1, 2),
(120, 35, '`<mark>`', 0, 3),
(121, 36, 'Vrai', 0, 0),
(122, 36, 'Faux', 1, 1),
(123, 37, '`<code><p></code>`', 0, 0),
(124, 37, '`<code>&lt;p&gt;</code>`', 1, 1),
(125, 37, '`<pre><p></pre>`', 0, 2),
(126, 37, '`<q><p></q>`', 0, 3),
(127, 38, '`<q>`', 0, 0),
(128, 38, '`<cite>`', 0, 1),
(129, 38, '`<blockquote>`', 1, 2),
(130, 38, '`<quote>`', 0, 3),
(131, 39, '`1<sub>er</sub>`', 0, 0),
(132, 39, '`1<sup>er</sup>`', 1, 1),
(133, 39, '`1<small>er</small>`', 0, 2),
(134, 39, '`<sup>1er</sup>`', 0, 3),
(135, 40, 'À changer la couleur', 0, 0),
(136, 40, 'À donner la forme développée', 1, 1),
(137, 40, 'À créer un lien', 0, 2),
(138, 40, 'À rien', 0, 3),
(139, 41, 'Vrai', 1, 0),
(140, 41, 'Faux', 0, 1),
(141, 42, '`src`', 0, 0),
(142, 42, '`link`', 0, 1),
(143, 42, '`href`', 1, 2),
(144, 42, '`url`', 0, 3),
(145, 43, '« Cliquez ici »', 0, 0),
(146, 43, '« Lire la suite »', 0, 1),
(147, 43, '« Télécharger le guide de montage (PDF) »', 1, 2),
(148, 43, '« Ici »', 0, 3),
(149, 44, 'Vrai', 0, 0),
(150, 44, 'Faux', 1, 1),
(151, 45, '`index.html`', 0, 0),
(152, 45, '`blog/index.html`', 0, 1),
(153, 45, '`../index.html`', 1, 2),
(154, 45, '`./blog/index.html`', 0, 3),
(155, 46, '`<a href="equipe">`', 0, 0),
(156, 46, '`<a href="#equipe">`', 1, 1),
(157, 46, '`<a id="#equipe">`', 0, 2),
(158, 46, '`<a href=".equipe">`', 0, 3),
(159, 47, '`rel="noopener"`', 1, 0),
(160, 47, '`title`', 0, 1),
(161, 47, '`download`', 0, 2),
(162, 47, '`lang`', 0, 3),
(163, 48, 'Le dossier courant', 0, 0),
(164, 48, 'Remonter d’un dossier', 1, 1),
(165, 48, 'La racine du disque', 0, 2),
(166, 48, 'Un dossier caché', 0, 3),
(167, 49, 'Vrai', 1, 0),
(168, 49, 'Faux', 0, 1),
(169, 50, 'Computer Style System', 0, 0),
(170, 50, 'Cascading Style Sheets', 1, 1),
(171, 50, 'Creative Styling Syntax', 0, 2),
(172, 50, 'Colored Sheet Styles', 0, 3),
(173, 51, 'Le site est plus sécurisé', 0, 0),
(174, 51, 'On peut changer l’apparence de tout un site depuis un seul fichier', 1, 1),
(175, 51, 'Le HTML devient inutile', 0, 2),
(176, 51, 'Les images chargent plus vite', 0, 3),
(177, 52, 'un sélecteur', 0, 0),
(178, 52, 'une propriété', 1, 1),
(179, 52, 'une valeur', 0, 2),
(180, 52, 'une balise', 0, 3),
(181, 53, 'L’attribut style', 0, 0),
(182, 53, 'La balise style', 0, 1),
(183, 53, 'Une feuille de style externe', 1, 2),
(184, 53, 'Aucune', 0, 3),
(185, 54, 'Dans `<body>`', 0, 0),
(186, 54, 'Dans `<head>`', 1, 1),
(187, 54, 'Après `</html>`', 0, 2),
(188, 54, 'Dans le fichier CSS', 0, 3),
(189, 55, 'Vrai', 1, 0),
(190, 55, 'Faux', 0, 1),
(191, 56, '`=`', 0, 0),
(192, 56, '`:`', 1, 1),
(193, 56, '`;`', 0, 2),
(194, 56, '`,`', 0, 3),
(195, 57, '`<!-- -->`', 0, 0),
(196, 57, '`//`', 0, 1),
(197, 57, '`/* */`', 1, 2),
(198, 57, '`#`', 0, 3),
(199, 58, 'Vrai', 0, 0),
(200, 58, 'Faux', 1, 1);

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`, `sort_order`) VALUES
(201, 59, '`menu`', 0, 0),
(202, 59, '`#menu`', 0, 1),
(203, 59, '`.menu`', 1, 2),
(204, 59, '`*menu`', 0, 3),
(205, 60, 'Vrai', 0, 0),
(206, 60, 'Faux', 1, 1),
(207, 61, 'Tous les p et tous les .note', 0, 0),
(208, 61, 'Les p qui ont la classe note', 1, 1),
(209, 61, 'Les .note à l’intérieur d’un p', 0, 2),
(210, 61, 'Rien', 0, 3),
(211, 62, '`.bleu-gras`', 0, 0),
(212, 62, '`.gauche`', 0, 1),
(213, 62, '`.message-erreur`', 1, 2),
(214, 62, '`.div2`', 0, 3),
(215, 63, '`h2 p`', 0, 0),
(216, 63, '`h2 > p`', 0, 1),
(217, 63, '`h2 + p`', 1, 2),
(218, 63, '`h2 ~ p`', 0, 3),
(219, 64, 'Tous les li de la page', 0, 0),
(220, 64, 'Les li enfants directs d’un ul', 1, 1),
(221, 64, 'Les ul dans un li', 0, 2),
(222, 64, 'Le premier li', 0, 3),
(223, 65, '`a[href^=".pdf"]`', 0, 0),
(224, 65, '`a[href$=".pdf"]`', 1, 1),
(225, 65, '`a.pdf`', 0, 2),
(226, 65, '`a > pdf`', 0, 3),
(227, 66, 'Vrai', 1, 0),
(228, 66, 'Faux', 0, 1),
(229, 67, '`div p span`', 0, 0),
(230, 67, '`.texte`', 1, 1),
(231, 67, '`body article p`', 0, 2),
(232, 67, '`p`', 0, 3),
(233, 68, 'La première écrite', 0, 0),
(234, 68, 'La dernière écrite', 1, 1),
(235, 68, 'La plus longue', 0, 2),
(236, 68, 'Aucune', 0, 3),
(237, 69, '`margin`', 0, 0),
(238, 69, '`border`', 0, 1),
(239, 69, '`color`', 1, 2),
(240, 69, '`padding`', 0, 3),
(241, 70, 'Vrai', 0, 0),
(242, 70, 'Faux', 1, 1),
(243, 71, '`opacity: 0.5;`', 0, 0),
(244, 71, '`background-color: rgb(0 0 0 / 50%);`', 1, 1),
(245, 71, '`color: transparent;`', 0, 2),
(246, 71, '`visibility: 50%;`', 0, 3),
(247, 72, 'Blanc', 0, 0),
(248, 72, 'Noir', 1, 1),
(249, 72, 'Rouge', 0, 2),
(250, 72, 'Transparent', 0, 3),
(251, 73, 'Rouge', 0, 0),
(252, 73, 'Vert', 1, 1),
(253, 73, 'Bleu', 0, 2),
(254, 73, 'Jaune', 0, 3),
(255, 74, '1:1', 0, 0),
(256, 74, '2:1', 0, 1),
(257, 74, '4,5:1', 1, 2),
(258, 74, '21:1', 0, 3),
(259, 75, 'Vrai', 1, 0),
(260, 75, 'Faux', 0, 1),
(261, 76, '`contain`', 0, 0),
(262, 76, '`cover`', 1, 1),
(263, 76, '`auto`', 0, 2),
(264, 76, '`fill`', 0, 3),
(265, 77, 'une image de fond', 0, 0),
(266, 77, 'une balise `<img>` avec alt', 1, 1),
(267, 77, 'un dégradé', 0, 2),
(268, 77, 'un commentaire', 0, 3),
(269, 78, 'Vrai', 1, 0),
(270, 78, 'Faux', 0, 1),
(271, 79, 'C’est obligatoire syntaxiquement', 0, 0),
(272, 79, 'Pour avoir une police de secours si les autres manquent', 1, 1),
(273, 79, 'Pour mettre en gras', 0, 2),
(274, 79, 'Pour accélérer le site', 0, 3),
(275, 80, '`0.8`', 0, 0),
(276, 80, '`1`', 0, 1),
(277, 80, '`1.6`', 1, 2),
(278, 80, '`4`', 0, 3),
(279, 81, 'Vrai', 1, 0),
(280, 81, 'Faux', 0, 1),
(281, 82, '`text-style: none`', 0, 0),
(282, 82, '`text-decoration: none`', 1, 1),
(283, 82, '`font-decoration: none`', 0, 2),
(284, 82, '`underline: false`', 0, 3),
(285, 83, '`uppercase`', 0, 0),
(286, 83, '`capitalize`', 1, 1),
(287, 83, '`title`', 0, 2),
(288, 83, '`first`', 0, 3),
(289, 84, 'Vrai', 0, 0),
(290, 84, 'Faux', 1, 1),
(291, 85, '15px', 0, 0),
(292, 85, '16px', 0, 1),
(293, 85, '24px', 1, 2),
(294, 85, '150%', 0, 3),
(295, 86, 'la taille de police du parent', 0, 0),
(296, 86, 'la taille de police de l’élément `<html>`', 1, 1),
(297, 86, 'la largeur de l’écran', 0, 2),
(298, 86, 'la hauteur de l’écran', 0, 3),
(299, 87, '`%`', 0, 0),
(300, 87, '`vh`', 0, 1),
(301, 87, '`vw`', 1, 2),
(302, 87, '`ch`', 0, 3),
(303, 88, 'C’est plus court', 0, 0),
(304, 88, 'Cela respecte la taille de police choisie par l’utilisateur', 1, 1),
(305, 88, 'C’est plus rapide', 0, 2),
(306, 88, 'Les px sont interdits', 0, 3),
(307, 89, 'Vrai', 1, 0),
(308, 89, 'Faux', 0, 1),
(309, 90, '200px', 0, 0),
(310, 90, '210px', 0, 1),
(311, 90, '220px', 0, 2),
(312, 90, '230px', 1, 3),
(313, 91, 'La margin', 0, 0),
(314, 91, 'Le padding', 1, 1),
(315, 91, 'Aucune', 0, 2),
(316, 91, 'Seulement le contenu', 0, 3),
(317, 92, '`padding`', 0, 0),
(318, 92, '`margin`', 1, 1),
(319, 92, '`width`', 0, 2),
(320, 92, '`outline`', 0, 3),
(321, 93, 'Vrai', 0, 0),
(322, 93, 'Faux', 1, 1),
(323, 94, '5px', 0, 0),
(324, 94, '10px', 0, 1),
(325, 94, '15px', 0, 2),
(326, 94, '20px', 1, 3),
(327, 95, '10px à gauche, 20px à droite', 0, 0),
(328, 95, '10px en haut/bas, 20px à gauche/droite', 1, 1),
(329, 95, '10px en haut, 20px en bas', 0, 2),
(330, 95, '10px partout puis 20px', 0, 3),
(331, 96, '25px', 0, 0),
(332, 96, '40px', 1, 1),
(333, 96, '65px', 0, 2),
(334, 96, '15px', 0, 3),
(335, 97, 'Vrai', 0, 0),
(336, 97, 'Faux', 1, 1),
(337, 98, '`border: 2px red;`', 0, 0),
(338, 98, '`border: 2px;`', 0, 1),
(339, 98, '`border: 2px solid red;`', 1, 2),
(340, 98, '`border: red 2px;`', 0, 3),
(341, 99, '`border-radius: 100px`', 0, 0),
(342, 99, '`border-radius: 50%`', 1, 1),
(343, 99, '`border: circle`', 0, 2),
(344, 99, '`shape: round`', 0, 3),
(345, 100, 'Vrai', 1, 0),
(346, 100, 'Faux', 0, 1),
(347, 101, '260px', 0, 0),
(348, 101, '300px', 1, 1),
(349, 101, '320px', 0, 2),
(350, 101, '340px', 0, 3),
(351, 102, '`width: auto`', 0, 0),
(352, 102, '`max-width: 100%`', 1, 1),
(353, 102, '`overflow: scroll`', 0, 2),
(354, 102, '`min-width: 100%`', 0, 3),
(355, 103, '`visible`', 0, 0),
(356, 103, '`hidden`', 0, 1),
(357, 103, '`auto`', 1, 2),
(358, 103, '`scroll`', 0, 3),
(359, 104, 'Vrai', 0, 0),
(360, 104, 'Faux', 1, 1),
(361, 105, 'Sans attribut alt', 0, 0),
(362, 105, '`alt="image décorative"`', 0, 1),
(363, 105, '`alt=""`', 1, 2),
(364, 105, '`alt="ornement.png"`', 0, 3),
(365, 106, '`href`', 0, 0),
(366, 106, '`src`', 1, 1),
(367, 106, '`alt`', 0, 2),
(368, 106, '`link`', 0, 3),
(369, 107, 'Les lecteurs d’écran', 0, 0),
(370, 107, 'Les moteurs de recherche', 0, 1),
(371, 107, 'Le navigateur si l’image ne charge pas', 0, 2),
(372, 107, 'Tous les trois', 1, 3),
(373, 108, 'Vrai', 0, 0),
(374, 108, 'Faux', 1, 1),
(375, 109, 'JPEG', 0, 0),
(376, 109, 'PNG', 0, 1),
(377, 109, 'SVG', 1, 2),
(378, 109, 'GIF', 0, 3),
(379, 110, 'Compresse l’image', 0, 0),
(380, 110, 'Retarde le téléchargement jusqu’à ce que l’image approche de l’écran', 1, 1),
(381, 110, 'Floute l’image', 0, 2),
(382, 110, 'Masque l’image', 0, 3),
(383, 111, '`<caption>`', 0, 0),
(384, 111, '`<legend>`', 0, 1),
(385, 111, '`<figcaption>`', 1, 2),
(386, 111, '`<label>`', 0, 3),
(387, 112, 'Vrai', 0, 0),
(388, 112, 'Faux', 1, 1),
(389, 113, '`<ul>`', 0, 0),
(390, 113, '`<ol>`', 1, 1),
(391, 113, '`<dl>`', 0, 2),
(392, 113, '`<list>`', 0, 3),
(393, 114, '`<p>`', 0, 0),
(394, 114, '`<li>`', 1, 1),
(395, 114, '`<a>`', 0, 2),
(396, 114, '`<div>`', 0, 3),
(397, 115, 'Vrai', 1, 0),
(398, 115, 'Faux', 0, 1),
(399, 116, 'Entre deux `<li>`', 0, 0),
(400, 116, 'Dans un `<li>`', 1, 1);

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`, `sort_order`) VALUES
(401, 116, 'Après `</ul>`', 0, 2),
(402, 116, 'Dans un `<dt>`', 0, 3),
(403, 117, '`<dd>`', 0, 0),
(404, 117, '`<dt>`', 1, 1),
(405, 117, '`<li>`', 0, 2),
(406, 117, '`<term>`', 0, 3),
(407, 118, 'Vrai', 1, 0),
(408, 118, 'Faux', 0, 1),
(409, 119, '`<td>`', 0, 0),
(410, 119, '`<tr>`', 1, 1),
(411, 119, '`<th>`', 0, 2),
(412, 119, '`<row>`', 0, 3),
(413, 120, 'À fusionner des lignes', 0, 0),
(414, 120, 'À indiquer que l’en-tête décrit sa ligne', 1, 1),
(415, 120, 'À changer la couleur', 0, 2),
(416, 120, 'À trier la ligne', 0, 3),
(417, 121, 'Vrai', 0, 0),
(418, 121, 'Faux', 1, 1),
(419, 122, '0', 0, 0),
(420, 122, '1', 1, 1),
(421, 122, '2', 0, 2),
(422, 122, '3', 0, 3),
(423, 123, '`<thead>`', 0, 0),
(424, 123, '`<tbody>`', 0, 1),
(425, 123, '`<tfoot>`', 1, 2),
(426, 123, '`<caption>`', 0, 3),
(427, 124, '`colspan`', 0, 0),
(428, 124, '`rowspan`', 1, 1),
(429, 124, '`merge`', 0, 2),
(430, 124, '`span`', 0, 3),
(431, 125, 'Vrai', 1, 0),
(432, 125, 'Faux', 0, 1),
(433, 126, '`get`', 0, 0),
(434, 126, '`post`', 1, 1),
(435, 126, 'Peu importe', 0, 2),
(436, 126, '`put`', 0, 3),
(437, 127, '`id`', 0, 0),
(438, 127, '`name`', 1, 1),
(439, 127, '`value`', 0, 2),
(440, 127, '`label`', 0, 3),
(441, 128, '`for` du label = `name` du champ', 0, 0),
(442, 128, '`for` du label = `id` du champ', 1, 1),
(443, 128, '`id` du label = `id` du champ', 0, 2),
(444, 128, 'Ce n’est pas possible', 0, 3),
(445, 129, 'Vrai', 0, 0),
(446, 129, 'Faux', 1, 1),
(447, 130, '`text`', 0, 0),
(448, 130, '`email`', 1, 1),
(449, 130, '`url`', 0, 2),
(450, 130, '`tel`', 0, 3),
(451, 131, 'Le même `id`', 0, 0),
(452, 131, 'Le même `name`', 1, 1),
(453, 131, 'La même `value`', 0, 2),
(454, 131, 'Rien', 0, 3),
(455, 132, 'Vrai', 0, 0),
(456, 132, 'Faux', 1, 1),
(457, 133, 'Dans `value`', 0, 0),
(458, 133, 'Entre les balises ouvrante et fermante', 1, 1),
(459, 133, 'Dans `placeholder`', 0, 2),
(460, 133, 'Dans `default`', 0, 3),
(461, 134, '`submit`', 0, 0),
(462, 134, '`button`', 1, 1),
(463, 134, 'Sans type', 0, 2),
(464, 134, 'Tous l’envoient', 0, 3),
(465, 135, 'Vrai', 1, 0),
(466, 135, 'Faux', 0, 1),
(467, 136, 'Vrai', 1, 0),
(468, 136, 'Faux', 0, 1),
(469, 137, '`mandatory`', 0, 0),
(470, 137, '`required`', 1, 1),
(471, 137, '`needed`', 0, 2),
(472, 137, '`validate`', 0, 3),
(473, 138, '`format`', 0, 0),
(474, 138, '`regex`', 0, 1),
(475, 138, '`pattern`', 1, 2),
(476, 138, '`match`', 0, 3),
(477, 139, 'Pour la performance', 0, 0),
(478, 139, 'Parce que la validation du navigateur peut être contournée', 1, 1),
(479, 139, 'Pour le SEO', 0, 2),
(480, 139, 'Ce n’est pas utile', 0, 3),
(481, 140, 'Une fois', 1, 0),
(482, 140, 'Deux fois', 0, 1),
(483, 140, 'Illimité', 0, 2),
(484, 140, 'Une fois par section', 0, 3),
(485, 141, 'Une classe « carte produit »', 0, 0),
(486, 141, 'Deux classes : carte et produit', 1, 1),
(487, 141, 'Une erreur', 0, 2),
(488, 141, 'Un id', 0, 3),
(489, 142, 'une variante du menu', 0, 0),
(490, 142, 'un élément du bloc menu', 1, 1),
(491, 142, 'un id', 0, 2),
(492, 142, 'un sélecteur CSS invalide', 0, 3),
(493, 143, 'Aucune', 0, 0),
(494, 143, '`<div>` est un bloc, `<span>` est en ligne', 1, 1),
(495, 143, '`<span>` est obsolète', 0, 2),
(496, 143, '`<div>` est sémantique', 0, 3),
(497, 144, '`custom`', 0, 0),
(498, 144, '`data-*`', 1, 1),
(499, 144, '`value`', 0, 2),
(500, 144, '`info`', 0, 3),
(501, 145, 'Vrai', 1, 0),
(502, 145, 'Faux', 0, 1),
(503, 146, 'block', 0, 0),
(504, 146, 'inline', 1, 1),
(505, 146, 'inline-block', 0, 2),
(506, 146, 'flex', 0, 3),
(507, 147, '`inline`', 0, 0),
(508, 147, '`block`', 0, 1),
(509, 147, '`inline-block`', 1, 2),
(510, 147, '`none`', 0, 3),
(511, 148, 'Vrai', 0, 0),
(512, 148, 'Faux', 1, 1),
(513, 149, '`display: none`', 0, 0),
(514, 149, '`visibility: hidden`', 1, 1),
(515, 149, 'Aucune', 0, 2),
(516, 149, '`hidden` en HTML', 0, 3),
(517, 150, 'Oui', 1, 0),
(518, 150, 'Non', 0, 1),
(519, 151, 'Vrai', 1, 0),
(520, 151, 'Faux', 0, 1),
(521, 152, 'Toujours la page', 0, 0),
(522, 152, 'Son parent direct, quel qu’il soit', 0, 1),
(523, 152, 'Son ancêtre positionné le plus proche', 1, 2),
(524, 152, 'L’élément précédent', 0, 3),
(525, 153, 'Oui', 1, 0),
(526, 153, 'Non', 0, 1),
(527, 154, 'Vrai', 1, 0),
(528, 154, 'Faux', 0, 1),
(529, 155, 'Son parent', 0, 0),
(530, 155, 'La fenêtre du navigateur', 1, 1),
(531, 155, 'Le body', 0, 2),
(532, 155, 'L’élément précédent', 0, 3),
(533, 156, '`z-index`', 0, 0),
(534, 156, 'Un seuil comme `top: 0`', 1, 1),
(535, 156, '`display: block`', 0, 2),
(536, 156, '`overflow: hidden`', 0, 3),
(537, 157, 'Vrai', 1, 0),
(538, 157, 'Faux', 0, 1),
(539, 158, '`flex-direction: row;`', 0, 0),
(540, 158, '`flex-direction: column;`', 1, 1),
(541, 158, '`flex-wrap: wrap;`', 0, 2),
(542, 158, '`display: block;`', 0, 3),
(543, 159, 'Sur chaque enfant', 0, 0),
(544, 159, 'Sur le conteneur parent', 1, 1),
(545, 159, 'Sur le body uniquement', 0, 2),
(546, 159, 'Sur les petits-enfants', 0, 3),
(547, 160, 'Vertical', 0, 0),
(548, 160, 'Horizontal', 1, 1),
(549, 160, 'Diagonal', 0, 2),
(550, 160, 'Aucun', 0, 3),
(551, 161, 'Vrai', 0, 0),
(552, 161, 'Faux', 1, 1),
(553, 162, '`justify-content`', 0, 0),
(554, 162, '`align-items`', 1, 1),
(555, 162, '`flex-direction`', 0, 2),
(556, 162, '`gap`', 0, 3),
(557, 163, '`center`', 0, 0),
(558, 163, '`space-around`', 0, 1),
(559, 163, '`space-between`', 1, 2),
(560, 163, '`stretch`', 0, 3),
(561, 164, 'Vrai', 1, 0),
(562, 164, 'Faux', 0, 1),
(563, 165, 'Largeur de 1px', 0, 0),
(564, 165, 'L’élément grandit pour occuper l’espace disponible', 1, 1),
(565, 165, 'L’élément ne grandit jamais', 0, 2),
(566, 165, 'Il passe en premier', 0, 3),
(567, 166, '`flex-direction`', 0, 0),
(568, 166, '`flex-wrap`', 1, 1),
(569, 166, '`flex-flow-line`', 0, 2),
(570, 166, '`wrap-items`', 0, 3),
(571, 167, 'Vrai', 0, 0),
(572, 167, 'Faux', 1, 1),
(573, 168, '200px', 0, 0),
(574, 168, '400px', 0, 1),
(575, 168, '600px', 1, 2),
(576, 168, '800px', 0, 3),
(577, 169, 'Frame', 0, 0),
(578, 169, 'Fraction de l’espace disponible', 1, 1),
(579, 169, 'Fixed row', 0, 2),
(580, 169, 'Font ratio', 0, 3),
(581, 170, '`repeat(1fr, 4)`', 0, 0),
(582, 170, '`repeat(4, 1fr)`', 1, 1),
(583, 170, '`4fr`', 0, 2),
(584, 170, '`grid(4)`', 0, 3),
(585, 171, 'Vrai', 1, 0),
(586, 171, 'Faux', 0, 1),
(587, 172, 'Supprime la colonne', 0, 0),
(588, 172, 'L’élément couvre toute la largeur de la grille', 1, 1),
(589, 172, 'Place l’élément en dernier', 0, 2),
(590, 172, 'Rien', 0, 3),
(591, 173, 'Une erreur', 0, 0),
(592, 173, 'Une case vide', 1, 1),
(593, 173, 'Une zone nommée « point »', 0, 2),
(594, 173, 'La fin de la ligne', 0, 3),
(595, 174, 'Vrai', 0, 0),
(596, 174, 'Faux', 1, 1),
(597, 175, 'Une colonne de 200px exactement', 0, 0),
(598, 175, 'Une colonne d’au moins 200px pouvant grandir jusqu’à 1fr', 1, 1),
(599, 175, 'Une colonne de 1fr maximum 200px', 0, 2),
(600, 175, 'Rien', 0, 3);

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`, `sort_order`) VALUES
(601, 176, '`auto-fill`', 0, 0),
(602, 176, '`auto-fit`', 1, 1),
(603, 176, '`fit-content`', 0, 2),
(604, 176, '`auto`', 0, 3),
(605, 177, 'Vrai', 0, 0),
(606, 177, 'Faux', 1, 1),
(607, 178, '`:active`', 0, 0),
(608, 178, '`:hover`', 1, 1),
(609, 178, '`:focus`', 0, 2),
(610, 178, '`:over`', 0, 3),
(611, 179, 'Les li pairs', 0, 0),
(612, 179, 'Les li impairs', 1, 1),
(613, 179, 'Le dernier li', 0, 2),
(614, 179, 'Aucun', 0, 3),
(615, 180, 'Vrai', 1, 0),
(616, 180, 'Faux', 0, 1),
(617, 181, '`display`', 0, 0),
(618, 181, '`content`', 1, 1),
(619, 181, '`position`', 0, 2),
(620, 181, '`width`', 0, 3),
(621, 182, 'Un', 0, 0),
(622, 182, 'Deux', 1, 1),
(623, 182, 'Trois', 0, 2),
(624, 182, 'Aucun', 0, 3),
(625, 183, 'Vrai', 0, 0),
(626, 183, 'Faux', 1, 1),
(627, 184, 'L’apparence', 0, 0),
(628, 184, 'Le sens du contenu', 1, 1),
(629, 184, 'La vitesse', 0, 2),
(630, 184, 'La couleur', 0, 3),
(631, 185, 'Les lecteurs d’écran', 0, 0),
(632, 185, 'Les moteurs de recherche', 0, 1),
(633, 185, 'Les développeurs', 0, 2),
(634, 185, 'Tous', 1, 3),
(635, 186, 'Vrai', 0, 0),
(636, 186, 'Faux', 1, 1),
(637, 187, 'Zéro', 0, 0),
(638, 187, 'Un', 1, 1),
(639, 187, 'Deux', 0, 2),
(640, 187, 'Illimité', 0, 3),
(641, 188, 'Avec des classes', 0, 0),
(642, 188, 'Avec `aria-label`', 1, 1),
(643, 188, 'Avec `id` uniquement', 0, 2),
(644, 188, 'On ne peut pas', 0, 3),
(645, 189, 'Vrai', 1, 0),
(646, 189, 'Faux', 0, 1),
(647, 190, '`<section>`', 0, 0),
(648, 190, '`<article>`', 1, 1),
(649, 190, '`<aside>`', 0, 2),
(650, 190, '`<footer>`', 0, 3),
(651, 191, 'décoratif', 0, 0),
(652, 191, 'autonome', 1, 1),
(653, 191, 'de navigation', 0, 2),
(654, 191, 'invisible', 0, 3),
(655, 192, 'Une image', 0, 0),
(656, 192, 'Un titre', 1, 1),
(657, 192, 'Un formulaire', 0, 2),
(658, 192, 'Un lien', 0, 3),
(659, 193, 'Vrai', 1, 0),
(660, 193, 'Faux', 0, 1),
(661, 194, '`player`', 0, 0),
(662, 194, '`controls`', 1, 1),
(663, 194, '`buttons`', 0, 2),
(664, 194, '`play`', 0, 3),
(665, 195, '`<caption>`', 0, 0),
(666, 195, '`<subtitle>`', 0, 1),
(667, 195, '`<track>`', 1, 2),
(668, 195, '`<text>`', 0, 3),
(669, 196, 'Vrai', 0, 0),
(670, 196, 'Faux', 1, 1),
(671, 197, '`name`', 0, 0),
(672, 197, '`title`', 1, 1),
(673, 197, '`alt`', 0, 2),
(674, 197, '`label`', 0, 3),
(675, 198, 'À agrandir l’iframe', 0, 0),
(676, 198, 'À restreindre ce que le contenu intégré peut faire', 1, 1),
(677, 198, 'À accélérer le chargement', 0, 2),
(678, 198, 'À ajouter une bordure', 0, 3),
(679, 199, 'Vrai', 0, 0),
(680, 199, 'Faux', 1, 1),
(681, 200, '20 caractères', 0, 0),
(682, 200, '120 à 160 caractères', 1, 1),
(683, 200, '500 caractères', 0, 2),
(684, 200, 'Pas de limite', 0, 3),
(685, 201, 'À accélérer la page', 0, 0),
(686, 201, 'À définir l’aperçu lors d’un partage', 1, 1),
(687, 201, 'À ajouter des cookies', 0, 2),
(688, 201, 'À valider le HTML', 0, 3),
(689, 202, 'Vrai', 1, 0),
(690, 202, 'Faux', 0, 1),
(691, 203, 'Le nombre de mots-clés', 0, 0),
(692, 203, 'Un contenu utile et de qualité', 1, 1),
(693, 203, 'La couleur du site', 0, 2),
(694, 203, 'La meta keywords', 0, 3),
(695, 204, '`robots.txt`', 0, 0),
(696, 204, '`sitemap.xml`', 1, 1),
(697, 204, '`index.html`', 0, 2),
(698, 204, '`seo.json`', 0, 3),
(699, 205, 'Vrai', 1, 0),
(700, 205, 'Faux', 0, 1),
(701, 206, 'Vrai', 1, 0),
(702, 206, 'Faux', 0, 1),
(703, 207, 'Performant', 0, 0),
(704, 207, 'Perceptible', 1, 1),
(705, 207, 'Prioritaire', 0, 2),
(706, 207, 'Public', 0, 3),
(707, 208, 'A', 0, 0),
(708, 208, 'AA', 1, 1),
(709, 208, 'AAA', 0, 2),
(710, 208, 'Aucun', 0, 3),
(711, 209, 'Vrai', 0, 0),
(712, 209, 'Faux', 1, 1),
(713, 210, 'Mettre ARIA partout', 0, 0),
(714, 210, 'Utiliser un élément HTML natif quand il existe', 1, 1),
(715, 210, 'Toujours ajouter un role', 0, 2),
(716, 210, 'Remplacer les labels', 0, 3),
(717, 211, '`aria-open`', 0, 0),
(718, 211, '`aria-expanded="true"`', 1, 1),
(719, 211, '`aria-visible`', 0, 2),
(720, 211, '`aria-live`', 0, 3),
(721, 212, 'Vrai', 0, 0),
(722, 212, 'Faux', 1, 1),
(723, 213, '`Page Contact.html`', 0, 0),
(724, 213, '`page_Contact.HTML`', 0, 1),
(725, 213, '`contact.html`', 1, 2),
(726, 213, '`CONTACT.html`', 0, 3),
(727, 214, 'recommandée', 0, 0),
(728, 214, 'obsolète', 1, 1),
(729, 214, 'obligatoire', 0, 2),
(730, 214, 'sémantique', 0, 3),
(731, 215, 'Vrai', 1, 0),
(732, 215, 'Faux', 0, 1),
(733, 216, 'De bas en haut', 0, 0),
(734, 216, 'De haut en bas', 1, 1),
(735, 216, 'Au hasard', 0, 2),
(736, 216, 'Les avertissements d’abord', 0, 3),
(737, 217, 'le code source exact', 0, 0),
(738, 217, 'le DOM après interprétation par le navigateur', 1, 1),
(739, 217, 'le CSS uniquement', 0, 2),
(740, 217, 'les cookies', 0, 3),
(741, 218, 'Vrai', 0, 0),
(742, 218, 'Faux', 1, 1),
(743, 219, 'Créer uniquement une version mobile', 0, 0),
(744, 219, 'Écrire d’abord le CSS pour petits écrans puis l’enrichir', 1, 1),
(745, 219, 'Tester sur mobile en premier', 0, 2),
(746, 219, 'Utiliser des applications mobiles', 0, 3),
(747, 220, '16×16px', 0, 0),
(748, 220, '24×24px', 0, 1),
(749, 220, '44×44px', 1, 2),
(750, 220, '100×100px', 0, 3),
(751, 221, 'Vrai', 1, 0),
(752, 221, 'Faux', 0, 1),
(753, 222, '`@media (no-animation)`', 0, 0),
(754, 222, '`@media (prefers-reduced-motion: reduce)`', 1, 1),
(755, 222, '`@media (motion: off)`', 0, 2),
(756, 222, '`@media (reduced)`', 0, 3),
(757, 223, '`max-width`', 0, 0),
(758, 223, '`min-width`', 1, 1),
(759, 223, '`orientation`', 0, 2),
(760, 223, '`print`', 0, 3),
(761, 224, 'Avant les styles de base', 0, 0),
(762, 224, 'Après les styles de base', 1, 1),
(763, 224, 'Dans le HTML', 0, 2),
(764, 224, 'Peu importe', 0, 3),
(765, 225, 'Vrai', 0, 0),
(766, 225, 'Faux', 1, 1),
(767, 226, '1rem', 0, 0),
(768, 226, '3vw', 0, 1),
(769, 226, '2rem', 1, 2),
(770, 226, 'Aucun', 0, 3),
(771, 227, '`fill`', 0, 0),
(772, 227, '`contain`', 0, 1),
(773, 227, '`cover`', 1, 2),
(774, 227, '`none`', 0, 3),
(775, 228, 'Vrai', 1, 0),
(776, 228, 'Faux', 0, 1),
(777, 229, 'Sur `:hover`', 0, 0),
(778, 229, 'Sur l’état de repos', 1, 1),
(779, 229, 'Dans une media query', 0, 2),
(780, 229, 'Dans le HTML', 0, 3),
(781, 230, '`width` et `height`', 0, 0),
(782, 230, '`top` et `left`', 0, 1),
(783, 230, '`transform` et `opacity`', 1, 2),
(784, 230, '`margin` et `padding`', 0, 3),
(785, 231, 'Vrai', 0, 0),
(786, 231, 'Faux', 1, 1),
(787, 232, '`translate`', 0, 0),
(788, 232, '`scale`', 1, 1),
(789, 232, '`rotate`', 0, 2),
(790, 232, '`grow`', 0, 3),
(791, 233, 'Oui', 0, 0),
(792, 233, 'Non', 1, 1),
(793, 234, 'Vrai', 1, 0),
(794, 234, 'Faux', 0, 1),
(795, 235, '`forever`', 0, 0),
(796, 235, '`infinite`', 1, 1),
(797, 235, '`loop`', 0, 2),
(798, 235, '`always`', 0, 3),
(799, 236, 'Accélère l’animation', 0, 0),
(800, 236, 'Conserve l’état final après l’animation', 1, 1);

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `is_correct`, `sort_order`) VALUES
(801, 236, 'Joue l’animation à l’envers', 0, 2),
(802, 236, 'Rien', 0, 3),
(803, 237, 'Vrai', 1, 0),
(804, 237, 'Faux', 0, 1),
(805, 238, '0', 0, 0),
(806, 238, '4px', 0, 1),
(807, 238, '12px', 1, 2),
(808, 238, 'black', 0, 3),
(809, 239, '`inner`', 0, 0),
(810, 239, '`inset`', 1, 1),
(811, 239, '`inside`', 0, 2),
(812, 239, '`internal`', 0, 3),
(813, 240, 'Vrai', 1, 0),
(814, 240, 'Faux', 0, 1),
(815, 241, '`background`', 0, 0),
(816, 241, '`background-image`', 0, 1),
(817, 241, '`background-color`', 1, 2),
(818, 241, '`border-image`', 0, 3),
(819, 242, '`linear-gradient`', 0, 0),
(820, 242, '`radial-gradient`', 0, 1),
(821, 242, '`conic-gradient`', 1, 2),
(822, 242, 'Aucun', 0, 3),
(823, 243, 'Vrai', 1, 0),
(824, 243, 'Faux', 0, 1),
(825, 244, 'Rien (erreur)', 0, 0),
(826, 244, '`orange`', 1, 1),
(827, 244, 'noir', 0, 2),
(828, 244, 'la couleur du parent', 0, 3),
(829, 245, '`$`', 0, 0),
(830, 245, '`@`', 0, 1),
(831, 245, '`--`', 1, 2),
(832, 245, '`#`', 0, 3),
(833, 246, 'Le body', 0, 0),
(834, 246, 'L’élément racine html', 1, 1),
(835, 246, 'Le premier élément', 0, 2),
(836, 246, 'Le head', 0, 3),
(837, 247, 'Vrai', 1, 0),
(838, 247, 'Faux', 0, 1),
(839, 248, '`.bouton__desactive`', 0, 0),
(840, 248, '`.bouton--desactive`', 1, 1),
(841, 248, '`.bouton-desactive`', 0, 2),
(842, 248, '`.desactive .bouton`', 0, 3),
(843, 249, 'Composants, variables, base', 0, 0),
(844, 249, 'Variables, base, layout, composants, utilitaires', 1, 1),
(845, 249, 'Au hasard', 0, 2),
(846, 249, 'Alphabétique', 0, 3),
(847, 250, 'Ils sont interdits', 0, 0),
(848, 250, 'Ils sont fragiles et difficiles à surcharger', 1, 1),
(849, 250, 'Ils sont plus lents à écrire', 0, 2),
(850, 250, 'Ils ne fonctionnent pas', 0, 3),
(851, 251, 'Vrai', 1, 0),
(852, 251, 'Faux', 0, 1),
(853, 252, 'C’est invalide', 0, 0),
(854, 252, 'Le lecteur d’écran annonce tout le contenu comme texte du lien', 1, 1),
(855, 252, 'Le lien ne fonctionne pas', 0, 2),
(856, 252, 'Le CSS ne s’applique plus', 0, 3),
(857, 253, '`:focus`', 0, 0),
(858, 253, '`:focus-within`', 1, 1),
(859, 253, '`:active`', 0, 2),
(860, 253, '`:has-focus`', 0, 3),
(861, 254, 'Vrai', 1, 0),
(862, 254, 'Faux', 0, 1),
(863, 255, 'caniuse.com', 1, 0),
(864, 255, 'github.com', 0, 1),
(865, 255, 'css.fr', 0, 2),
(866, 255, 'w3schools.com', 0, 3),
(867, 256, 'À changer de police au survol', 0, 0),
(868, 256, 'À afficher le texte avec une police de secours pendant le chargement', 1, 1),
(869, 256, 'À réduire la taille du texte', 0, 2),
(870, 256, 'Rien', 0, 3),
(871, 257, 'Vrai', 1, 0),
(872, 257, 'Faux', 0, 1);

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
(7, 2, 7, 'completed', '2026-09-22 19:30:00', '2026-09-22 19:30:00'),
(8, 2, 8, 'completed', '2026-09-23 20:35:00', '2026-09-23 20:35:00'),
(9, 2, 9, 'completed', '2026-09-24 17:40:00', '2026-09-24 17:40:00'),
(10, 3, 1, 'completed', '2026-09-22 17:00:00', '2026-09-22 17:00:00'),
(11, 3, 2, 'completed', '2026-09-23 18:05:00', '2026-09-23 18:05:00'),
(12, 3, 3, 'completed', '2026-09-24 19:10:00', '2026-09-24 19:10:00'),
(13, 3, 4, 'completed', '2026-09-25 20:15:00', '2026-09-25 20:15:00'),
(14, 3, 5, 'completed', '2026-09-26 17:20:00', '2026-09-26 17:20:00'),
(15, 4, 1, 'completed', '2026-09-10 17:00:00', '2026-09-10 17:00:00'),
(16, 4, 2, 'completed', '2026-09-11 18:05:00', '2026-09-11 18:05:00'),
(17, 4, 3, 'completed', '2026-09-12 19:10:00', '2026-09-12 19:10:00'),
(18, 4, 4, 'completed', '2026-09-13 20:15:00', '2026-09-13 20:15:00'),
(19, 4, 5, 'completed', '2026-09-14 17:20:00', '2026-09-14 17:20:00'),
(20, 4, 6, 'completed', '2026-09-15 18:25:00', '2026-09-15 18:25:00'),
(21, 4, 7, 'completed', '2026-09-16 19:30:00', '2026-09-16 19:30:00'),
(22, 4, 8, 'completed', '2026-09-17 20:35:00', '2026-09-17 20:35:00'),
(23, 4, 9, 'completed', '2026-09-18 17:40:00', '2026-09-18 17:40:00'),
(24, 4, 10, 'completed', '2026-09-19 18:45:00', '2026-09-19 18:45:00'),
(25, 4, 11, 'completed', '2026-09-20 19:50:00', '2026-09-20 19:50:00'),
(26, 4, 12, 'completed', '2026-09-21 20:55:00', '2026-09-21 20:55:00'),
(27, 4, 13, 'completed', '2026-09-22 17:00:00', '2026-09-22 17:00:00'),
(28, 4, 14, 'completed', '2026-09-23 18:05:00', '2026-09-23 18:05:00'),
(29, 4, 15, 'completed', '2026-09-24 19:10:00', '2026-09-24 19:10:00'),
(30, 4, 16, 'completed', '2026-09-25 20:15:00', '2026-09-25 20:15:00'),
(31, 5, 1, 'completed', '2026-09-23 17:00:00', '2026-09-23 17:00:00'),
(32, 5, 2, 'completed', '2026-09-24 18:05:00', '2026-09-24 18:05:00'),
(33, 2, 10, 'started', NULL, '2026-09-26 18:00:00');

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
(9, 2, 10, '<h1>Mes voyages</h1>
<h2>Europe</h2>
<h3>Italie</h3>
<h2>Asie</h2>', NULL, 1, 100, '2026-09-22 19:30:00'),
(10, 2, 11, NULL, NULL, 1, 100, '2026-09-22 19:30:00'),
(11, 2, 12, '<h1>Mes premiers pas</h1>
<p>J’apprends le HTML pour structurer mes pages.</p>
<p>Ensuite, j’apprendrai le CSS pour les mettre en forme.</p>', NULL, 1, 100, '2026-09-23 20:35:00'),
(12, 2, 14, '<p>
  Marie Curie<br>
  11 rue Pierre et Marie Curie<br>
  75005 Paris
</p>', NULL, 1, 100, '2026-09-24 17:40:00'),
(13, 3, 1, '<h1>Bienvenue</h1>', NULL, 1, 100, '2026-09-22 17:00:00'),
(14, 3, 3, '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>', NULL, 1, 100, '2026-09-23 18:05:00'),
(15, 3, 4, '<p title="Mon info-bulle">Survolez-moi !</p>', NULL, 1, 100, '2026-09-24 19:10:00'),
(16, 3, 6, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>', NULL, 1, 100, '2026-09-25 20:15:00'),
(17, 3, 7, '<!DOCTYPE html>
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
(18, 4, 1, '<h1>Bienvenue</h1>', NULL, 1, 100, '2026-09-10 17:00:00'),
(19, 4, 2, NULL, NULL, 1, 100, '2026-09-10 17:00:00'),
(20, 4, 3, '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>', NULL, 1, 100, '2026-09-11 18:05:00'),
(21, 4, 4, '<p title="Mon info-bulle">Survolez-moi !</p>', NULL, 1, 100, '2026-09-12 19:10:00'),
(22, 4, 5, '<p>HTML est <strong>vraiment simple</strong></p>', NULL, 1, 100, '2026-09-12 19:10:00'),
(23, 4, 6, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Exercice</title>
</head>
<body>
  <p>Bonjour !</p>
</body>
</html>', NULL, 1, 100, '2026-09-13 20:15:00'),
(24, 4, 7, '<!DOCTYPE html>
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
(25, 4, 8, '<p>Ce paragraphe doit rester visible.</p>
<!-- <p>Ce paragraphe doit disparaître.</p> -->', NULL, 1, 100, '2026-09-15 18:25:00'),
(26, 4, 10, '<h1>Mes voyages</h1>
<h2>Europe</h2>
<h3>Italie</h3>
<h2>Asie</h2>', NULL, 1, 100, '2026-09-16 19:30:00'),
(27, 4, 11, NULL, NULL, 1, 100, '2026-09-16 19:30:00'),
(28, 4, 12, '<h1>Mes premiers pas</h1>
<p>J’apprends le HTML pour structurer mes pages.</p>
<p>Ensuite, j’apprendrai le CSS pour les mettre en forme.</p>', NULL, 1, 100, '2026-09-17 20:35:00'),
(29, 4, 14, '<p>
  Marie Curie<br>
  11 rue Pierre et Marie Curie<br>
  75005 Paris
</p>', NULL, 1, 100, '2026-09-18 17:40:00'),
(30, 4, 15, '<p><strong>Attention</strong> : ne laissez <em>jamais</em> un enfant seul près de l’eau.</p>', NULL, 1, 100, '2026-09-19 18:45:00'),
(31, 4, 16, '<p>Le CO<sub>2</sub> est un sujet majeur pour l’<abbr title="Organisation des Nations unies">ONU</abbr>.</p>', NULL, 1, 100, '2026-09-20 19:50:00'),
(32, 4, 17, NULL, NULL, 1, 100, '2026-09-20 19:50:00'),
(33, 4, 18, '<p>Mon encyclopédie préférée : <a href="https://www.wikipedia.org">Wikipédia</a></p>', NULL, 1, 100, '2026-09-21 20:55:00'),
(34, 4, 20, '<h1>Salon de coiffure</h1>
<p><a href="#tarifs">Voir les tarifs</a></p>
<p>Bienvenue dans notre salon.</p>
<h2 id="tarifs">Nos tarifs</h2>
<p>Coupe : 25 €</p>', NULL, 1, 100, '2026-09-22 17:00:00'),
(35, 4, 21, '<a href="https://www.w3.org" target="_blank" rel="noopener noreferrer">Site du W3C (nouvel onglet)</a>', NULL, 1, 100, '2026-09-22 17:00:00'),
(36, 4, 22, NULL, NULL, 1, 100, '2026-09-22 17:00:00'),
(37, 4, 23, NULL, 'h1 {
  color: red;
}', 1, 100, '2026-09-23 18:05:00'),
(38, 4, 24, '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Accueil</h1>
</body>
</html>', NULL, 1, 100, '2026-09-24 19:10:00'),
(39, 4, 25, NULL, 'p {
  color: blue;
  font-size: 20px;
}', 1, 100, '2026-09-25 20:15:00'),
(40, 5, 1, '<h1>Bienvenue</h1>', NULL, 1, 100, '2026-09-23 17:00:00'),
(41, 5, 3, '<p>Étape 1 : je saisis une URL.</p>
<p>Étape 2 : le serveur envoie le fichier HTML.</p>
<p>Étape 3 : le navigateur affiche la page.</p>', NULL, 1, 100, '2026-09-24 18:05:00'),
(42, 5, 1, '<p>Bienvenue</p>', NULL, 0, 0, '2026-09-21 10:00:00');

INSERT INTO `quiz_results` (`id`, `user_id`, `lesson_id`, `score`, `total`, `percentage`, `passed`, `answers_json`, `created_at`) VALUES
(1, 2, 1, 4, 4, 100, 1, NULL, '2026-09-16 17:00:00'),
(2, 2, 2, 2, 3, 67, 0, NULL, '2026-09-17 18:05:00'),
(3, 2, 3, 4, 4, 100, 1, NULL, '2026-09-18 19:10:00'),
(4, 2, 4, 3, 3, 100, 1, NULL, '2026-09-19 20:15:00'),
(5, 2, 5, 3, 4, 75, 1, NULL, '2026-09-20 17:20:00'),
(6, 2, 6, 3, 3, 100, 1, NULL, '2026-09-21 18:25:00'),
(7, 2, 7, 3, 3, 100, 1, NULL, '2026-09-22 19:30:00'),
(8, 2, 8, 2, 3, 67, 0, NULL, '2026-09-23 20:35:00'),
(9, 2, 9, 3, 3, 100, 1, NULL, '2026-09-24 17:40:00'),
(10, 3, 1, 3, 4, 75, 1, NULL, '2026-09-22 17:00:00'),
(11, 3, 2, 3, 3, 100, 1, NULL, '2026-09-23 18:05:00'),
(12, 3, 3, 4, 4, 100, 1, NULL, '2026-09-24 19:10:00'),
(13, 3, 4, 2, 3, 67, 0, NULL, '2026-09-25 20:15:00'),
(14, 3, 5, 4, 4, 100, 1, NULL, '2026-09-26 17:20:00'),
(15, 4, 1, 4, 4, 100, 1, NULL, '2026-09-10 17:00:00'),
(16, 4, 2, 3, 3, 100, 1, NULL, '2026-09-11 18:05:00'),
(17, 4, 3, 3, 4, 75, 1, NULL, '2026-09-12 19:10:00'),
(18, 4, 4, 3, 3, 100, 1, NULL, '2026-09-13 20:15:00'),
(19, 4, 5, 4, 4, 100, 1, NULL, '2026-09-14 17:20:00'),
(20, 4, 6, 2, 3, 67, 0, NULL, '2026-09-15 18:25:00'),
(21, 4, 7, 3, 3, 100, 1, NULL, '2026-09-16 19:30:00'),
(22, 4, 8, 3, 3, 100, 1, NULL, '2026-09-17 20:35:00'),
(23, 4, 9, 2, 3, 67, 0, NULL, '2026-09-18 17:40:00'),
(24, 4, 10, 3, 3, 100, 1, NULL, '2026-09-19 18:45:00'),
(25, 4, 11, 4, 4, 100, 1, NULL, '2026-09-20 19:50:00'),
(26, 4, 12, 2, 3, 67, 0, NULL, '2026-09-21 20:55:00'),
(27, 4, 13, 4, 4, 100, 1, NULL, '2026-09-22 17:00:00'),
(28, 4, 14, 3, 3, 100, 1, NULL, '2026-09-23 18:05:00'),
(29, 4, 15, 2, 3, 67, 0, NULL, '2026-09-24 19:10:00'),
(30, 4, 16, 3, 3, 100, 1, NULL, '2026-09-25 20:15:00'),
(31, 5, 1, 4, 4, 100, 1, NULL, '2026-09-23 17:00:00'),
(32, 5, 2, 2, 3, 67, 0, NULL, '2026-09-24 18:05:00');

INSERT INTO `user_badges` (`id`, `user_id`, `badge_id`, `awarded_at`) VALUES
(1, 2, 1, '2026-09-26 10:00:00'),
(2, 2, 2, '2026-09-26 10:00:00'),
(3, 2, 3, '2026-09-26 10:00:00'),
(4, 2, 12, '2026-09-26 10:00:00'),
(5, 3, 1, '2026-09-26 10:00:00'),
(6, 3, 2, '2026-09-26 10:00:00'),
(7, 3, 3, '2026-09-26 10:00:00'),
(8, 4, 1, '2026-09-26 10:00:00'),
(9, 4, 2, '2026-09-26 10:00:00'),
(10, 4, 3, '2026-09-26 10:00:00'),
(11, 4, 12, '2026-09-26 10:00:00'),
(12, 5, 1, '2026-09-26 10:00:00'),
(13, 5, 2, '2026-09-26 10:00:00');

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
(22, 2, 'exercise_passed', 'Construire un plan', '2026-09-22 19:30:00'),
(23, 2, 'exercise_passed', 'Hiérarchie des titres', '2026-09-22 19:30:00'),
(24, 2, 'quiz_passed', 'Les titres de h1 à h6 (100 %)', '2026-09-22 19:30:00'),
(25, 2, 'lesson_completed', 'Les titres de h1 à h6', '2026-09-22 19:30:00'),
(26, 2, 'exercise_passed', 'Deux paragraphes', '2026-09-23 20:35:00'),
(27, 2, 'quiz_passed', 'Les paragraphes (67 %)', '2026-09-23 20:35:00'),
(28, 2, 'lesson_completed', 'Les paragraphes', '2026-09-23 20:35:00'),
(29, 2, 'exercise_passed', 'Une adresse postale', '2026-09-24 17:40:00'),
(30, 2, 'quiz_passed', 'Sauts de ligne et séparateurs (100 %)', '2026-09-24 17:40:00'),
(31, 2, 'lesson_completed', 'Sauts de ligne et séparateurs', '2026-09-24 17:40:00'),
(32, 2, 'badge_awarded', 'Premier cours terminé', '2026-09-26 10:00:00'),
(33, 2, 'badge_awarded', 'Premier exercice', '2026-09-26 10:00:00'),
(34, 2, 'badge_awarded', '5 exercices réussis', '2026-09-26 10:00:00'),
(35, 2, 'badge_awarded', 'Sans faute', '2026-09-26 10:00:00'),
(36, 3, 'register', 'Création du compte', '2026-08-30 10:00:00'),
(37, 3, 'exercise_passed', 'Votre premier titre', '2026-09-22 17:00:00'),
(38, 3, 'quiz_passed', 'Qu’est-ce que le HTML ? (75 %)', '2026-09-22 17:00:00'),
(39, 3, 'lesson_completed', 'Qu’est-ce que le HTML ?', '2026-09-22 17:00:00'),
(40, 3, 'exercise_passed', 'L’ordre des éléments', '2026-09-23 18:05:00'),
(41, 3, 'quiz_passed', 'Comment fonctionne une page web (100 %)', '2026-09-23 18:05:00'),
(42, 3, 'lesson_completed', 'Comment fonctionne une page web', '2026-09-23 18:05:00'),
(43, 3, 'exercise_passed', 'Ajouter un attribut', '2026-09-24 19:10:00'),
(44, 3, 'quiz_passed', 'Balises, éléments et attributs (100 %)', '2026-09-24 19:10:00'),
(45, 3, 'lesson_completed', 'Balises, éléments et attributs', '2026-09-24 19:10:00'),
(46, 3, 'exercise_passed', 'Déclarer le document', '2026-09-25 20:15:00'),
(47, 3, 'quiz_passed', 'Le DOCTYPE et l’élément html (67 %)', '2026-09-25 20:15:00'),
(48, 3, 'lesson_completed', 'Le DOCTYPE et l’élément html', '2026-09-25 20:15:00'),
(49, 3, 'exercise_passed', 'Ranger le head et le body', '2026-09-26 17:20:00'),
(50, 3, 'quiz_passed', 'Les sections head et body (100 %)', '2026-09-26 17:20:00'),
(51, 3, 'lesson_completed', 'Les sections head et body', '2026-09-26 17:20:00'),
(52, 3, 'badge_awarded', 'Premier cours terminé', '2026-09-26 10:00:00'),
(53, 3, 'badge_awarded', 'Premier exercice', '2026-09-26 10:00:00'),
(54, 3, 'badge_awarded', '5 exercices réussis', '2026-09-26 10:00:00'),
(55, 4, 'register', 'Création du compte', '2026-08-23 10:00:00'),
(56, 4, 'exercise_passed', 'Votre premier titre', '2026-09-10 17:00:00'),
(57, 4, 'exercise_passed', 'Le rôle de chaque langage', '2026-09-10 17:00:00'),
(58, 4, 'quiz_passed', 'Qu’est-ce que le HTML ? (100 %)', '2026-09-10 17:00:00'),
(59, 4, 'lesson_completed', 'Qu’est-ce que le HTML ?', '2026-09-10 17:00:00'),
(60, 4, 'exercise_passed', 'L’ordre des éléments', '2026-09-11 18:05:00'),
(61, 4, 'quiz_passed', 'Comment fonctionne une page web (100 %)', '2026-09-11 18:05:00'),
(62, 4, 'lesson_completed', 'Comment fonctionne une page web', '2026-09-11 18:05:00'),
(63, 4, 'exercise_passed', 'Ajouter un attribut', '2026-09-12 19:10:00'),
(64, 4, 'exercise_passed', 'Réparer une imbrication', '2026-09-12 19:10:00'),
(65, 4, 'quiz_passed', 'Balises, éléments et attributs (75 %)', '2026-09-12 19:10:00'),
(66, 4, 'lesson_completed', 'Balises, éléments et attributs', '2026-09-12 19:10:00'),
(67, 4, 'exercise_passed', 'Déclarer le document', '2026-09-13 20:15:00'),
(68, 4, 'quiz_passed', 'Le DOCTYPE et l’élément html (100 %)', '2026-09-13 20:15:00'),
(69, 4, 'lesson_completed', 'Le DOCTYPE et l’élément html', '2026-09-13 20:15:00'),
(70, 4, 'exercise_passed', 'Ranger le head et le body', '2026-09-14 17:20:00'),
(71, 4, 'quiz_passed', 'Les sections head et body (100 %)', '2026-09-14 17:20:00'),
(72, 4, 'lesson_completed', 'Les sections head et body', '2026-09-14 17:20:00'),
(73, 4, 'exercise_passed', 'Désactiver un paragraphe', '2026-09-15 18:25:00'),
(74, 4, 'quiz_passed', 'Commentaires et indentation (67 %)', '2026-09-15 18:25:00'),
(75, 4, 'lesson_completed', 'Commentaires et indentation', '2026-09-15 18:25:00'),
(76, 4, 'exercise_passed', 'Construire un plan', '2026-09-16 19:30:00'),
(77, 4, 'exercise_passed', 'Hiérarchie des titres', '2026-09-16 19:30:00'),
(78, 4, 'quiz_passed', 'Les titres de h1 à h6 (100 %)', '2026-09-16 19:30:00'),
(79, 4, 'lesson_completed', 'Les titres de h1 à h6', '2026-09-16 19:30:00'),
(80, 4, 'exercise_passed', 'Deux paragraphes', '2026-09-17 20:35:00'),
(81, 4, 'quiz_passed', 'Les paragraphes (100 %)', '2026-09-17 20:35:00'),
(82, 4, 'lesson_completed', 'Les paragraphes', '2026-09-17 20:35:00'),
(83, 4, 'exercise_passed', 'Une adresse postale', '2026-09-18 17:40:00'),
(84, 4, 'quiz_passed', 'Sauts de ligne et séparateurs (67 %)', '2026-09-18 17:40:00'),
(85, 4, 'lesson_completed', 'Sauts de ligne et séparateurs', '2026-09-18 17:40:00'),
(86, 4, 'exercise_passed', 'Signaler une information importante', '2026-09-19 18:45:00'),
(87, 4, 'quiz_passed', 'Importance et emphase : strong et em (100 %)', '2026-09-19 18:45:00'),
(88, 4, 'lesson_completed', 'Importance et emphase : strong et em', '2026-09-19 18:45:00'),
(89, 4, 'exercise_passed', 'Formule et abréviation', '2026-09-20 19:50:00'),
(90, 4, 'exercise_passed', 'Afficher une balise comme du texte', '2026-09-20 19:50:00'),
(91, 4, 'quiz_passed', 'Citations, code et autres balises de texte (100 %)', '2026-09-20 19:50:00'),
(92, 4, 'lesson_completed', 'Citations, code et autres balises de texte', '2026-09-20 19:50:00'),
(93, 4, 'exercise_passed', 'Votre premier lien', '2026-09-21 20:55:00'),
(94, 4, 'quiz_passed', 'Créer un lien (67 %)', '2026-09-21 20:55:00'),
(95, 4, 'lesson_completed', 'Créer un lien', '2026-09-21 20:55:00'),
(96, 4, 'exercise_passed', 'Un sommaire avec ancre', '2026-09-22 17:00:00'),
(97, 4, 'exercise_passed', 'Nouvel onglet sécurisé', '2026-09-22 17:00:00'),
(98, 4, 'exercise_passed', 'Chemin relatif', '2026-09-22 17:00:00'),
(99, 4, 'quiz_passed', 'Liens relatifs, absolus, ancres et nouveaux onglets (100 %)', '2026-09-22 17:00:00'),
(100, 4, 'lesson_completed', 'Liens relatifs, absolus, ancres et nouveaux onglets', '2026-09-22 17:00:00'),
(101, 4, 'exercise_passed', 'Colorer un titre', '2026-09-23 18:05:00'),
(102, 4, 'quiz_passed', 'Qu’est-ce que le CSS ? (100 %)', '2026-09-23 18:05:00'),
(103, 4, 'lesson_completed', 'Qu’est-ce que le CSS ?', '2026-09-23 18:05:00'),
(104, 4, 'exercise_passed', 'Relier une feuille de style', '2026-09-24 19:10:00'),
(105, 4, 'quiz_passed', 'Intégrer le CSS à une page (67 %)', '2026-09-24 19:10:00'),
(106, 4, 'lesson_completed', 'Intégrer le CSS à une page', '2026-09-24 19:10:00'),
(107, 4, 'exercise_passed', 'Réparer une règle cassée', '2026-09-25 20:15:00'),
(108, 4, 'quiz_passed', 'La syntaxe d’une règle CSS (100 %)', '2026-09-25 20:15:00'),
(109, 4, 'lesson_completed', 'La syntaxe d’une règle CSS', '2026-09-25 20:15:00'),
(110, 4, 'badge_awarded', 'Premier cours terminé', '2026-09-26 10:00:00'),
(111, 4, 'badge_awarded', 'Premier exercice', '2026-09-26 10:00:00'),
(112, 4, 'badge_awarded', '5 exercices réussis', '2026-09-26 10:00:00'),
(113, 4, 'badge_awarded', 'Sans faute', '2026-09-26 10:00:00'),
(114, 5, 'register', 'Création du compte', '2026-09-18 10:00:00'),
(115, 5, 'exercise_passed', 'Votre premier titre', '2026-09-23 17:00:00'),
(116, 5, 'quiz_passed', 'Qu’est-ce que le HTML ? (100 %)', '2026-09-23 17:00:00'),
(117, 5, 'lesson_completed', 'Qu’est-ce que le HTML ?', '2026-09-23 17:00:00'),
(118, 5, 'exercise_passed', 'L’ordre des éléments', '2026-09-24 18:05:00'),
(119, 5, 'quiz_passed', 'Comment fonctionne une page web (67 %)', '2026-09-24 18:05:00'),
(120, 5, 'lesson_completed', 'Comment fonctionne une page web', '2026-09-24 18:05:00'),
(121, 5, 'badge_awarded', 'Premier cours terminé', '2026-09-26 10:00:00'),
(122, 5, 'badge_awarded', 'Premier exercice', '2026-09-26 10:00:00');

SET FOREIGN_KEY_CHECKS = 1;
