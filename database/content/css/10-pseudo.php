<?php
return [
    'slug' => 'css-pseudo-classes-elements',
    'title' => 'Pseudo-classes et pseudo-éléments',
    'description' => 'Réagir aux interactions (:hover, :focus), cibler selon la position (:nth-child) et générer du contenu (::before, ::after).',
    'lessons' => [
        [
            'slug' => 'pseudo-classes',
            'title' => 'Les pseudo-classes',
            'duration' => 16,
            'intro' => <<<'MD'
Un bouton qui change de couleur au survol, un champ qui s’entoure de bleu quand on clique dedans, une ligne de tableau sur deux en gris : ces effets reposent sur les **pseudo-classes**. Elles ciblent un élément selon son **état** ou sa **position**, sans rien ajouter au HTML.
MD,
            'objectives' => ['Styler les états `:hover`, `:focus`, `:active`, `:visited`', 'Rendre le focus clavier visible avec `:focus-visible`', 'Cibler par position avec `:first-child`, `:nth-child()`', 'Découvrir `:not()` et les états de formulaire'],
            'prerequisites' => ['Cascade, spécificité et héritage', 'Les formulaires'],
            'theory' => <<<'MD'
## Syntaxe

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
```
MD,
            'syntax' => 'a:hover { … }
button:focus-visible { … }
li:nth-child(odd) { … }
li:not(:last-child) { … }',
            'example_html' => <<<'HTML'
<nav class="menu">
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
<button class="btn" type="button">Survolez et tabulez</button>
HTML,
            'example_css' => <<<'CSS'
body { font-family: system-ui, sans-serif; }

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
.btn:focus-visible { outline: 3px solid #f59e0b; outline-offset: 3px; }
CSS,
            'lines' => [
                ['.menu a:hover { background: #e2e8f0; }', 'Fond gris au survol.'],
                ['.liste li:nth-child(even)', 'Une ligne sur deux (les paires) : liste zébrée.'],
                ['.liste li:not(:last-child)', 'Une bordure sous chaque ligne sauf la dernière.'],
                ['.btn:active { transform: scale(0.97); }', 'Légère compression pendant le clic : retour tactile.'],
                ['.btn:focus-visible { outline: … }', 'Contour bien visible pour la navigation au clavier.'],
            ],
            'reference' => [
                [':hover / :active', 'Survol / clic.'],
                [':focus / :focus-visible', 'Focus / focus clavier.'],
                [':first-child / :last-child', 'Premier / dernier enfant.'],
                [':nth-child(n)', 'Enfant selon une formule.'],
                [':not(sélecteur)', 'Négation.'],
                [':checked / :disabled / :invalid', 'États de formulaire.'],
            ],
            'mistakes' => [
                'Supprimer le contour de focus (`outline: none`) sans alternative.',
                'Mettre un espace avant les deux-points : `a :hover` cible les descendants survolés.',
                'Réserver une information au survol (inaccessible au tactile).',
                'Confondre `:nth-child` (tous types) et `:nth-of-type` (même type).',
            ],
            'practices' => [
                'Un style `:focus-visible` pour chaque élément interactif.',
                'Des états `:hover` et `:active` pour les boutons.',
                '`:not(:last-child)` plutôt que d’annuler une bordure après coup.',
            ],
            'practical' => 'Sur cette plateforme, les liens de navigation changent de fond au survol, les options de quiz s’encadrent quand elles sont cochées (`:has(input:checked)`) et tous les éléments interactifs ont un contour de focus menthe.',
            'summary' => ['Pseudo-classe = un `:`, cible un état ou une position.', '`:hover`, `:focus-visible`, `:active` pour l’interaction.', '`:nth-child()`, `:first-child`, `:not()` pour la structure.', 'Ne jamais supprimer le focus sans le remplacer.'],
            'challenge' => 'Créez un tableau zébré dont la ligne survolée se surligne, et un bouton avec des états hover, active et focus-visible distincts.',
            'exercises' => [
                [
                    'title' => 'Un bouton interactif',
                    'difficulty' => 1,
                    'instructions' => 'Ajoutez un état `:hover` à `.btn` qui change le `background` en `#15803d`, et un état `:focus-visible` avec `outline: 3px solid #f59e0b`.',
                    'starter_html' => '<button class="btn" type="button">Valider</button>',
                    'starter_css' => '.btn {
  padding: 10px 20px;
  border: 0;
  background: #16a34a;
  color: white;
}',
                    'solution_css' => '.btn {
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
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.btn:hover|button.btn:hover|button:hover', 'prop' => 'background|background-color', 'value' => '#15803d', 'msg' => 'Au survol, le fond devient #15803d'],
                        ['t' => 'css', 'sel' => '.btn:focus-visible|button.btn:focus-visible|button:focus-visible', 'prop' => 'outline', 'value' => '3px solid #f59e0b', 'msg' => 'Un contour de focus visible'],
                    ],
                    'hint' => 'Deux nouvelles règles : `.btn:hover { … }` et `.btn:focus-visible { … }`.',
                    'explanation' => 'Le survol donne un retour visuel à la souris, le focus-visible guide les utilisateurs du clavier.',
                ],
                [
                    'title' => 'Une liste zébrée',
                    'difficulty' => 2,
                    'instructions' => 'Avec `:nth-child`, donnez un fond `#f1f5f9` aux éléments **pairs** (`even`) de la liste `.taches`.',
                    'starter_html' => '<ul class="taches">
  <li>Acheter du pain</li>
  <li>Réviser le CSS</li>
  <li>Appeler Sam</li>
  <li>Arroser les plantes</li>
</ul>',
                    'solution_css' => '.taches li:nth-child(even) {
  background: #f1f5f9;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.taches li:nth-child(even)|li:nth-child(even)|.taches li:nth-child(2n)|li:nth-child(2n)', 'prop' => 'background|background-color', 'value' => '#f1f5f9', 'msg' => 'Les éléments pairs ont un fond #f1f5f9'],
                    ],
                    'hint' => '`li:nth-child(even)`',
                    'explanation' => '`:nth-child(even)` cible le 2e, 4e, 6e… enfant.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle pseudo-classe cible un lien survolé ?', 'a' => ['`:active`', '`:hover`', '`:focus`', '`:over`'], 'c' => 1, 'e' => '`:hover`.'],
                ['q' => 'Que cible `li:nth-child(odd)` ?', 'a' => ['Les li pairs', 'Les li impairs', 'Le dernier li', 'Aucun'], 'c' => 1, 'e' => '`odd` = impairs (1, 3, 5…).'],
                ['q' => 'Supprimer le contour de focus sans le remplacer nuit à l’accessibilité.', 'tf' => true, 'c' => true, 'e' => 'Vrai : les utilisateurs du clavier ne savent plus où ils sont.'],
            ],
        ],
        [
            'slug' => 'pseudo-elements',
            'title' => 'Les pseudo-éléments ::before et ::after',
            'duration' => 14,
            'intro' => <<<'MD'
Ajouter une icône avant chaque lien externe, des guillemets décoratifs autour d’une citation, un soulignement animé sous un menu… sans toucher au HTML. Les **pseudo-éléments** créent des éléments virtuels que seul le CSS connaît.
MD,
            'objectives' => ['Créer du contenu avec `::before` et `::after`', 'Comprendre la propriété `content`', 'Styler `::first-letter`, `::first-line`, `::placeholder`, `::selection`', 'Connaître les limites d’accessibilité'],
            'prerequisites' => ['Les pseudo-classes'],
            'theory' => <<<'MD'
## Syntaxe

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

> [!TIP] Le célèbre effet « soulignement animé au survol » : un `::after` de largeur 0 qui passe à 100 % avec une transition (vous saurez l’animer au niveau 3).
MD,
            'syntax' => '.el::before { content: "…"; }
.el::after { content: ""; display: block; }',
            'example_html' => <<<'HTML'
<h2 class="titre">Nos valeurs</h2>
<p class="intro">Liberté, curiosité et partage guident chacun de nos projets depuis dix ans.</p>
<blockquote class="citation">Le design est l’âme de chaque création humaine.</blockquote>
<p><a class="externe" href="https://developer.mozilla.org">Documentation MDN</a></p>
HTML,
            'example_css' => <<<'CSS'
body { font-family: Georgia, serif; }

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
}
CSS,
            'lines' => [
                ['.titre::after { content: ""; display: block; … }', 'Une barre décorative sous le titre, sans HTML supplémentaire.'],
                ['.intro::first-letter { float: left; font-size: 3em; }', 'Lettrine façon magazine.'],
                ['.citation::before { content: "“"; position: absolute; }', 'Guillemet décoratif positionné par rapport à la citation.'],
                ['.externe::after { content: " ↗"; }', 'Flèche ajoutée après le texte du lien.'],
                ['::selection { background: #fde68a; }', 'Couleur du texte sélectionné.'],
            ],
            'reference' => [
                ['::before / ::after', 'Contenu généré au début / à la fin.'],
                ['content', 'Obligatoire : texte, `""`, `attr()`.'],
                ['::first-letter / ::first-line', 'Première lettre / ligne.'],
                ['::placeholder', 'Texte d’exemple des champs.'],
                ['::selection', 'Sélection de l’utilisateur.'],
                ['::marker', 'Puces et numéros de liste.'],
            ],
            'mistakes' => [
                'Oublier `content` : rien ne s’affiche.',
                'Utiliser `::before` sur un `<img>` ou un `<input>` (éléments sans contenu : ça ne fonctionne pas).',
                'Placer une information essentielle dans `content`.',
                'Confondre `:` (pseudo-classe) et `::` (pseudo-élément).',
            ],
            'practices' => [
                'Pseudo-éléments pour la décoration uniquement.',
                '`content: ""` + `display: block` pour les formes.',
                'Parent en `position: relative` pour positionner un pseudo-élément.',
            ],
            'practical' => 'Les petites flèches des menus déroulants, les icônes « lien externe », les lignes décoratives sous les titres de section et les bulles de dialogue (triangle en `::after`) sont presque toujours des pseudo-éléments.',
            'summary' => ['`::before` / `::after` + `content` créent des éléments virtuels.', '`content: ""` pour une forme décorative.', 'Typographie : `::first-letter`, `::selection`, `::placeholder`.', 'Décoration uniquement : l’information va dans le HTML.'],
            'challenge' => 'Créez une bulle de dialogue avec un petit triangle en bas à gauche réalisé avec `::after` et des bordures.',
            'exercises' => [
                [
                    'title' => 'Une barre sous le titre',
                    'difficulty' => 2,
                    'instructions' => 'Avec `::after` sur `.titre`, créez une barre décorative : `content: ""`, `display: block`, `width: 50px`, `height: 3px` et `background: #ec4899`.',
                    'starter_html' => '<h2 class="titre">À propos</h2>',
                    'solution_css' => '.titre::after {
  content: "";
  display: block;
  width: 50px;
  height: 3px;
  background: #ec4899;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.titre::after|h2.titre::after|h2::after', 'prop' => 'content', 'in' => ['""', "''"], 'msg' => 'content: "" est défini'],
                        ['t' => 'css', 'sel' => '.titre::after|h2.titre::after|h2::after', 'prop' => 'display', 'value' => 'block', 'msg' => 'display: block'],
                        ['t' => 'css', 'sel' => '.titre::after|h2.titre::after|h2::after', 'prop' => 'width', 'value' => '50px', 'msg' => 'width: 50px'],
                        ['t' => 'css', 'sel' => '.titre::after|h2.titre::after|h2::after', 'prop' => 'height', 'value' => '3px', 'msg' => 'height: 3px'],
                        ['t' => 'css', 'sel' => '.titre::after|h2.titre::after|h2::after', 'prop' => 'background|background-color', 'value' => '#ec4899', 'msg' => 'Fond rose #ec4899'],
                    ],
                    'hint' => 'Sans `content`, le pseudo-élément n’existe pas.',
                    'explanation' => 'Un `::after` vide transformé en bloc devient une forme décorative sous le titre.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle propriété est obligatoire pour afficher un `::before` ?', 'a' => ['`display`', '`content`', '`position`', '`width`'], 'c' => 1, 'e' => '`content`.'],
                ['q' => 'Combien de deux-points pour un pseudo-élément ?', 'a' => ['Un', 'Deux', 'Trois', 'Aucun'], 'c' => 1, 'e' => '`::before`, `::after`…'],
                ['q' => 'Un pseudo-élément peut contenir une information essentielle au contenu.', 'tf' => true, 'c' => false, 'e' => 'Faux : il n’est pas fiable pour les lecteurs d’écran.'],
            ],
        ],
    ],
];
