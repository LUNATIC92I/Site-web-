<?php
return [
    'slug' => 'css-decouvrir',
    'title' => 'Découvrir le CSS',
    'description' => 'Ce qu’est le CSS, les trois façons de l’intégrer et la syntaxe d’une règle.',
    'lessons' => [
        [
            'slug' => 'qu-est-ce-que-css',
            'title' => 'Qu’est-ce que le CSS ?',
            'duration' => 12,
            'intro' => <<<'MD'
Votre HTML décrit parfaitement le contenu… mais il est austère : texte noir, fond blanc, police par défaut. Le **CSS** va transformer cette structure en interface. Et surtout, il permet de changer l’apparence d’un site entier sans toucher à une seule ligne de HTML.
MD,
            'objectives' => ['Comprendre le rôle du CSS', 'Comprendre la séparation contenu / présentation', 'Lire une première règle CSS'],
            'prerequisites' => ['Cours « HTML — Les fondations »'],
            'theory' => <<<'MD'
## Qu’est-ce que c’est ?

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

Pour **toute** question d’apparence. Si vous vous demandez « à quoi ça ressemble ? », c’est du CSS. Si c’est « qu’est-ce que c’est ? », c’est du HTML.
MD,
            'syntax' => 'sélecteur {
  propriété: valeur;
}',
            'simple_html' => '<h1>Mon titre</h1>',
            'simple_css' => 'h1 {
  color: navy;
}',
            'example_html' => <<<'HTML'
<h1>Café des Arts</h1>
<p>Un lieu chaleureux au cœur de la ville.</p>
<p>Concerts tous les vendredis soir.</p>
HTML,
            'example_css' => <<<'CSS'
body {
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
}
CSS,
            'lines' => [
                ['body {', 'Sélecteur : la règle s’applique à l’élément `body` (toute la page).'],
                ['  background-color: #fdf6ec;', 'Couleur de fond crème.'],
                ['  font-family: Georgia, serif;', 'Police utilisée ; `serif` en solution de repli.'],
                ['h1 {', 'Nouvelle règle pour tous les titres `h1`.'],
                ['  color: #7c2d12;', 'Couleur du texte : brun foncé.'],
                ['  font-size: 40px;', 'Taille du texte : 40 pixels.'],
                ['p {', 'Règle pour tous les paragraphes.'],
            ],
            'reference' => [
                ['color', 'Couleur du texte.'],
                ['background-color', 'Couleur de fond.'],
                ['font-family', 'Police de caractères.'],
                ['font-size', 'Taille du texte.'],
            ],
            'mistakes' => [
                'Écrire du CSS dans le HTML sans balise `<style>` ni fichier : il s’affiche comme du texte.',
                'Oublier le point-virgule à la fin d’une déclaration.',
                'Vouloir choisir des balises HTML pour leur apparence au lieu d’utiliser le CSS.',
            ],
            'practices' => [
                'Garder le HTML pour le sens et le CSS pour l’apparence.',
                'Une propriété par ligne, indentée.',
                'Utiliser une feuille de style commune à tout le site.',
            ],
            'practical' => 'Les grandes entreprises maintiennent un **design system** : une bibliothèque de styles CSS (couleurs, typographies, composants) partagée par tous leurs sites. Changer la couleur de marque se fait en un seul endroit.',
            'summary' => ['CSS = apparence ; HTML = structure.', 'Une règle : sélecteur + déclarations `propriété: valeur;`.', 'Le style centralisé se modifie en un seul endroit.'],
            'challenge' => 'Dans l’éditeur libre, reprenez votre page de présentation HTML et donnez-lui une couleur de fond, une police et une couleur de titre.',
            'exercises' => [
                [
                    'title' => 'Colorer un titre',
                    'difficulty' => 1,
                    'instructions' => 'Écrivez une règle CSS qui donne la couleur `red` (propriété `color`) à tous les titres `h1`.',
                    'starter_html' => '<h1>Mon premier style</h1>
<p>Le titre doit devenir rouge.</p>',
                    'starter_css' => '',
                    'solution_css' => 'h1 {
  color: red;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => 'h1', 'prop' => 'color', 'in' => ['red', '#f00', '#ff0000', 'rgb(255, 0, 0)'], 'msg' => 'Les h1 ont la couleur red'],
                    ],
                    'hint' => '`h1 { color: red; }`',
                    'explanation' => 'Le sélecteur `h1` cible tous les titres de niveau 1 ; la déclaration `color: red;` change la couleur de leur texte.',
                ],
            ],
            'quiz' => [
                ['q' => 'Que signifie CSS ?', 'a' => ['Computer Style System', 'Cascading Style Sheets', 'Creative Styling Syntax', 'Colored Sheet Styles'], 'c' => 1, 'e' => 'CSS = Cascading Style Sheets, feuilles de style en cascade.'],
                ['q' => 'Quel est le principal avantage de séparer HTML et CSS ?', 'a' => ['Le site est plus sécurisé', 'On peut changer l’apparence de tout un site depuis un seul fichier', 'Le HTML devient inutile', 'Les images chargent plus vite'], 'c' => 1, 'e' => 'Le style centralisé se modifie une seule fois pour toutes les pages.'],
                ['q' => 'Dans `h1 { color: navy; }`, `color` est…', 'a' => ['un sélecteur', 'une propriété', 'une valeur', 'une balise'], 'c' => 1, 'e' => '`h1` est le sélecteur, `color` la propriété et `navy` la valeur.'],
            ],
        ],
        [
            'slug' => 'integrer-le-css',
            'title' => 'Intégrer le CSS à une page',
            'duration' => 12,
            'intro' => <<<'MD'
Il existe trois façons d’ajouter du CSS à une page HTML. Toutes fonctionnent, mais une seule est recommandée pour un vrai site. Comprendre les trois vous permettra de lire n’importe quel code… et de choisir la bonne méthode.
MD,
            'objectives' => ['Connaître le style en ligne, la balise `<style>` et le fichier externe', 'Relier une feuille de style avec `<link>`', 'Choisir la méthode adaptée'],
            'prerequisites' => ['Qu’est-ce que le CSS ?', 'Head et body'],
            'theory' => <<<'MD'
## 1. Le style en ligne (attribut `style`)

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
2. sinon, entre `<style>` et `<link>`, c’est la règle **déclarée en dernier** qui gagne (à spécificité égale).
MD,
            'syntax' => '<link rel="stylesheet" href="style.css">',
            'example_html' => <<<'HTML'
<!DOCTYPE html>
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
</html>
HTML,
            'lines' => [
                ['<style>', 'Début des styles internes, dans le head.'],
                ['  h1 { color: darkgreen; }', 'Règle écrite sur une ligne (acceptable pour une règle courte).'],
                ['</style>', 'Fin des styles internes.'],
                ['<p style="color: crimson;">', 'Style en ligne : il l’emporte sur la règle `p` du head.'],
            ],
            'reference' => [
                ['style="…"', 'Attribut de style en ligne (à éviter).'],
                ['<style>', 'Balise de styles internes, dans le head.'],
                ['<link rel="stylesheet" href="…">', 'Relie une feuille de style externe (recommandé).'],
            ],
            'mistakes' => [
                'Oublier `rel="stylesheet"` : le fichier n’est pas appliqué.',
                'Se tromper de chemin dans `href` (dossier `css/` oublié).',
                'Mettre des balises `<style>` dans le `<body>` ou du HTML dans le fichier `.css`.',
                'Multiplier les styles en ligne.',
            ],
            'practices' => [
                'Utiliser une feuille externe pour tout vrai site.',
                'Ranger les fichiers CSS dans un dossier `css/` ou `assets/css/`.',
                'Réserver les styles en ligne aux cas exceptionnels (e-mails HTML).',
            ],
            'practical' => 'La plupart des sites chargent une ou deux feuilles externes dans le `<head>`. Les newsletters HTML, elles, sont une exception : de nombreux logiciels de messagerie ignorent les feuilles externes, d’où l’usage massif du style en ligne dans les e-mails.',
            'summary' => ['Trois méthodes : attribut `style`, balise `<style>`, fichier externe.', 'Recommandé : `<link rel="stylesheet" href="…">` dans le head.', 'Le style en ligne est prioritaire mais difficile à maintenir.'],
            'challenge' => 'Créez un squelette HTML complet qui relie un fichier `css/style.css` et un second fichier `css/print.css` avec l’attribut `media="print"`.',
            'exercises' => [
                [
                    'title' => 'Relier une feuille de style',
                    'difficulty' => 1,
                    'instructions' => 'Dans le `<head>`, ajoutez la balise qui relie la feuille de style externe `css/style.css`.',
                    'starter_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
</head>
<body>
  <h1>Accueil</h1>
</body>
</html>',
                    'solution_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Mon site</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Accueil</h1>
</body>
</html>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'head link', 'msg' => 'Une balise <link> est présente dans le head'],
                        ['t' => 'attr', 'sel' => 'link', 'attr' => 'rel', 'value' => 'stylesheet', 'msg' => 'rel vaut stylesheet'],
                        ['t' => 'attr', 'sel' => 'link', 'attr' => 'href', 'value' => 'css/style.css', 'msg' => 'href vaut css/style.css'],
                    ],
                    'hint' => '`<link rel="stylesheet" href="css/style.css">`',
                    'explanation' => '`<link>` relie une ressource externe ; `rel="stylesheet"` indique qu’il s’agit d’une feuille de style.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle méthode est recommandée pour un site de plusieurs pages ?', 'a' => ['L’attribut style', 'La balise style', 'Une feuille de style externe', 'Aucune'], 'c' => 2, 'e' => 'Une feuille externe est partagée par toutes les pages et mise en cache.'],
                ['q' => 'Où place-t-on la balise `<link>` ?', 'a' => ['Dans `<body>`', 'Dans `<head>`', 'Après `</html>`', 'Dans le fichier CSS'], 'c' => 1, 'e' => 'Les feuilles de style se relient dans le `<head>`.'],
                ['q' => 'Un style en ligne l’emporte généralement sur une règle de la feuille externe.', 'tf' => true, 'c' => true, 'e' => 'Vrai : sa priorité est très élevée, c’est pourquoi on l’évite.'],
            ],
        ],
        [
            'slug' => 'syntaxe-css',
            'title' => 'La syntaxe d’une règle CSS',
            'duration' => 12,
            'intro' => <<<'MD'
Le CSS a une syntaxe simple mais stricte : une accolade oubliée ou un point-virgule manquant, et la règle — voire toute la suite du fichier — est ignorée, **sans message d’erreur**. Connaître précisément chaque partie d’une règle vous évitera de longues séances de débogage.
MD,
            'objectives' => ['Nommer chaque partie d’une règle', 'Écrire des déclarations valides', 'Commenter du CSS', 'Comprendre comment le navigateur gère les erreurs'],
            'prerequisites' => ['Intégrer le CSS à une page'],
            'theory' => <<<'MD'
## Anatomie d’une règle

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

Les propriétés et la plupart des valeurs ne sont pas sensibles à la casse, mais la convention est de tout écrire en **minuscules**. Les espaces et retours à la ligne sont libres : on indente pour la lisibilité.
MD,
            'syntax' => 'sélecteur {
  propriété: valeur;
  propriété: valeur;
}',
            'example_html' => <<<'HTML'
<h1>Menu du jour</h1>
<h2>Entrée</h2>
<p>Velouté de potiron.</p>
<h2>Plat</h2>
<p>Risotto aux champignons.</p>
HTML,
            'example_css' => <<<'CSS'
/* Titres : même police pour h1 et h2 */
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
}
CSS,
            'lines' => [
                ['/* Titres : même police pour h1 et h2 */', 'Commentaire CSS : ignoré par le navigateur.'],
                ['h1, h2 {', 'Sélecteurs groupés : la règle s’applique aux h1 ET aux h2.'],
                ['  font-family: "Trebuchet MS", sans-serif;', 'Les noms de police contenant des espaces se mettent entre guillemets.'],
                ['h1 {', 'Règle spécifique aux h1, en plus de la règle groupée.'],
                ['  font-size: 36px;', 'Déclaration : propriété `font-size`, valeur `36px`.'],
            ],
            'reference' => [
                ['{ }', 'Délimitent le bloc de déclarations.'],
                [':', 'Sépare la propriété de sa valeur.'],
                [';', 'Termine une déclaration.'],
                [',', 'Sépare des sélecteurs groupés.'],
                ['/* … */', 'Commentaire CSS.'],
            ],
            'mistakes' => [
                'Oublier le point-virgule : `color: red font-size: 20px;` est invalide.',
                'Utiliser `=` au lieu de `:` : `color = red;`.',
                'Oublier l’accolade fermante.',
                'Écrire un commentaire HTML `<!-- -->` dans un fichier CSS.',
                'Faute de frappe dans une propriété : `backgroud-color`.',
            ],
            'practices' => [
                'Une déclaration par ligne, indentée de 2 espaces.',
                'Toujours terminer par un point-virgule.',
                'Grouper les sélecteurs qui partagent les mêmes styles.',
                'Commenter les grandes sections de la feuille.',
            ],
            'practical' => 'Les équipes utilisent des outils comme **Stylelint** qui signalent automatiquement les propriétés inconnues, les points-virgules manquants ou les doublons avant même que le code soit publié.',
            'summary' => ['Règle = sélecteur + `{ propriété: valeur; }`.', 'Sélecteurs groupés avec des virgules.', 'Commentaires : `/* … */`.', 'Une erreur est ignorée silencieusement : vérifiez avec `F12`.'],
            'challenge' => 'Écrivez une feuille de style de 5 règles pour une page de recette, avec un commentaire au-dessus de chaque règle et au moins un groupe de sélecteurs.',
            'exercises' => [
                [
                    'title' => 'Réparer une règle cassée',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Cette règle contient trois erreurs de syntaxe. Corrigez-la pour que les paragraphes soient **bleus** (`blue`) avec une taille de **20px**.',
                    'starter_html' => '<p>Je devrais être bleu et plus grand.</p>',
                    'starter_css' => 'p {
  color = blue
  font-size: 20px
',
                    'solution_css' => 'p {
  color: blue;
  font-size: 20px;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => 'p', 'prop' => 'color', 'value' => 'blue', 'msg' => 'color: blue; est valide'],
                        ['t' => 'css', 'sel' => 'p', 'prop' => 'font-size', 'value' => '20px', 'msg' => 'font-size: 20px; est valide'],
                        ['t' => 'contains', 's' => '}', 'in' => 'css', 'msg' => 'L’accolade fermante est présente'],
                        ['t' => 'absent', 's' => '=', 'in' => 'css', 'msg' => 'Plus de signe = dans le CSS'],
                    ],
                    'hint' => 'Remplacez `=` par `:`, ajoutez les `;` et fermez l’accolade.',
                    'explanation' => 'Une déclaration s’écrit `propriété: valeur;` et le bloc se ferme avec `}`.',
                ],
                [
                    'title' => 'Grouper des sélecteurs',
                    'difficulty' => 1,
                    'instructions' => 'Avec **une seule règle** utilisant des sélecteurs groupés, donnez la couleur `purple` aux `h1` et aux `h2`.',
                    'starter_html' => '<h1>Titre</h1>
<h2>Sous-titre</h2>',
                    'solution_css' => 'h1, h2 {
  color: purple;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => 'h1', 'prop' => 'color', 'value' => 'purple', 'msg' => 'Les h1 sont violets'],
                        ['t' => 'css', 'sel' => 'h2', 'prop' => 'color', 'value' => 'purple', 'msg' => 'Les h2 sont violets'],
                        ['t' => 'match', 're' => 'h1\s*,\s*h2|h2\s*,\s*h1', 'in' => 'css', 'msg' => 'Les sélecteurs sont groupés avec une virgule'],
                    ],
                    'hint' => '`h1, h2 { … }`',
                    'explanation' => 'La virgule permet d’appliquer une même règle à plusieurs sélecteurs.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel caractère sépare une propriété de sa valeur ?', 'a' => ['`=`', '`:`', '`;`', '`,`'], 'c' => 1, 'e' => 'On écrit `propriété: valeur;`.'],
                ['q' => 'Comment écrit-on un commentaire en CSS ?', 'a' => ['`<!-- -->`', '`//`', '`/* */`', '`#`'], 'c' => 2, 'e' => 'Les commentaires CSS s’écrivent entre `/*` et `*/`.'],
                ['q' => 'Une propriété mal orthographiée provoque un message d’erreur à l’écran.', 'tf' => true, 'c' => false, 'e' => 'Faux : le navigateur l’ignore silencieusement.'],
            ],
        ],
    ],
];
