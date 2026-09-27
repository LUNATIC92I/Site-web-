<?php
return [
    'slug' => 'css-display',
    'title' => 'La propriété display',
    'description' => 'Bloc, en ligne, inline-block, none : comprendre comment les éléments s’enchaînent dans le flux.',
    'lessons' => [
        [
            'slug' => 'block-inline-inline-block',
            'title' => 'block, inline et inline-block',
            'duration' => 14,
            'intro' => <<<'MD'
Pourquoi deux paragraphes s’empilent-ils alors que deux liens se suivent sur la même ligne ? Pourquoi `width` n’a-t-il aucun effet sur un lien ? Tout est question de **type d’affichage**. La propriété `display` est la clé de toute mise en page CSS.
MD,
            'objectives' => ['Distinguer éléments bloc et en ligne', 'Utiliser `inline-block`', 'Changer le type d’affichage d’un élément'],
            'prerequisites' => ['Le modèle de boîte'],
            'theory' => <<<'MD'
## Le flux normal

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

`display` accepte aussi `flex` et `grid`, les deux systèmes de mise en page modernes que vous verrez dans les modules suivants.
MD,
            'syntax' => 'display: block;
display: inline;
display: inline-block;',
            'example_html' => <<<'HTML'
<p>Un paragraphe est un bloc.</p>
<p>Voici des <a class="lien" href="#">liens</a> <a class="lien" href="#">en ligne</a>.</p>
<a class="btn" href="#">Bouton inline-block</a>
<a class="btn" href="#">Autre bouton</a>
<span class="bloc">Un span transformé en bloc</span>
HTML,
            'example_css' => <<<'CSS'
p {
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
}
CSS,
            'lines' => [
                ['p { background: #e0f2fe; }', 'Le fond couvre toute la largeur : le paragraphe est un bloc.'],
                ['  width: 300px;  /* ignoré */', 'Un élément inline ignore `width`.'],
                ['  display: inline-block;', 'Le lien reste dans la ligne mais accepte largeur et marges.'],
                ['  width: 180px;', 'Pris en compte grâce à inline-block.'],
                ['  display: block;', 'Le span prend toute la largeur et passe à la ligne.'],
            ],
            'reference' => [
                ['display: block', 'Nouvelle ligne, toute la largeur, dimensions acceptées.'],
                ['display: inline', 'Dans la ligne, taille du contenu, width/height ignorés.'],
                ['display: inline-block', 'Dans la ligne, dimensions acceptées.'],
            ],
            'mistakes' => [
                'Donner `width` ou `margin-top` à un lien inline et ne pas comprendre pourquoi rien ne change.',
                'Changer une balise HTML pour obtenir un comportement d’affichage (au lieu de `display`).',
                'Oublier l’espace créé entre des éléments inline-block par les espaces du code HTML.',
            ],
            'practices' => [
                'Garder la balise HTML pour le sens, régler l’affichage en CSS.',
                'Utiliser `inline-block` pour des boutons, Flexbox pour aligner des séries d’éléments.',
                '`img { display: block; }` dans le reset.',
            ],
            'practical' => 'Les boutons des sites sont très souvent des liens `<a>` en `display: inline-block` avec du padding. Et avant Flexbox, les menus horizontaux étaient faits avec des `<li>` en `inline-block`.',
            'summary' => ['block : nouvelle ligne, pleine largeur.', 'inline : dans le texte, sans dimensions.', 'inline-block : dans la ligne, avec dimensions.', '`display` change l’affichage sans changer le sens.'],
            'challenge' => 'Transformez une liste `<ul>` de 4 liens en menu horizontal avec `display: inline-block` sur les `<li>`, sans puces.',
            'exercises' => [
                [
                    'title' => 'Un lien bouton',
                    'difficulty' => 1,
                    'instructions' => 'Le lien `.btn` ignore son `width`. Ajoutez `display: inline-block` pour que la largeur de `200px` et le padding s’appliquent.',
                    'starter_html' => '<a class="btn" href="#">S’inscrire</a>',
                    'starter_css' => '.btn {
  width: 200px;
  padding: 12px;
  text-align: center;
  background: #0f766e;
  color: white;
  text-decoration: none;
}',
                    'solution_css' => '.btn {
  display: inline-block;
  width: 200px;
  padding: 12px;
  text-align: center;
  background: #0f766e;
  color: white;
  text-decoration: none;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.btn|a.btn', 'prop' => 'display', 'in' => ['inline-block', 'block'], 'msg' => 'Le lien a display: inline-block'],
                        ['t' => 'css', 'sel' => '.btn|a.btn', 'prop' => 'width', 'value' => '200px', 'msg' => 'width: 200px est conservé'],
                    ],
                    'hint' => 'Une seule déclaration à ajouter.',
                    'explanation' => 'Un élément inline ignore `width` ; en `inline-block`, il accepte des dimensions tout en restant dans la ligne.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel est le type d’affichage par défaut d’un `<a>` ?', 'a' => ['block', 'inline', 'inline-block', 'flex'], 'c' => 1, 'e' => 'Les liens sont des éléments en ligne.'],
                ['q' => 'Quel type accepte `width` tout en restant dans la ligne ?', 'a' => ['`inline`', '`block`', '`inline-block`', '`none`'], 'c' => 2, 'e' => '`inline-block`.'],
                ['q' => 'Changer `display` modifie le sens sémantique de l’élément.', 'tf' => true, 'c' => false, 'e' => 'Faux : seul l’affichage change.'],
            ],
        ],
        [
            'slug' => 'display-none-visibility-overflow',
            'title' => 'Masquer des éléments : none, visibility, opacity',
            'duration' => 12,
            'intro' => <<<'MD'
Menu mobile fermé, message affiché après une action, texte réservé aux lecteurs d’écran… Il existe plusieurs façons de masquer un élément en CSS, et elles n’ont **pas du tout** les mêmes effets, notamment sur l’accessibilité.
MD,
            'objectives' => ['Distinguer `display: none`, `visibility: hidden` et `opacity: 0`', 'Masquer visuellement un texte tout en le laissant aux lecteurs d’écran'],
            'prerequisites' => ['block, inline et inline-block'],
            'theory' => <<<'MD'
## Trois façons de masquer

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

> [!WARN] Ne masquez jamais un contenu important uniquement pour gagner de la place : sur mobile, réorganisez plutôt la mise en page.
MD,
            'syntax' => 'display: none;
visibility: hidden;
opacity: 0;',
            'example_html' => <<<'HTML'
<div class="ligne">
  <span class="case">A</span>
  <span class="case cache-none">B</span>
  <span class="case">C</span>
</div>
<div class="ligne">
  <span class="case">A</span>
  <span class="case cache-visibility">B</span>
  <span class="case">C</span>
</div>
<button type="button"><span aria-hidden="true">☰</span><span class="sr-only">Ouvrir le menu</span></button>
HTML,
            'example_css' => <<<'CSS'
.case {
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
}
CSS,
            'lines' => [
                ['.cache-none { display: none; }', 'B disparaît totalement : C prend sa place.'],
                ['.cache-visibility { visibility: hidden; }', 'B est invisible mais sa place reste réservée.'],
                ['<span aria-hidden="true">☰</span>', 'L’icône est ignorée par les lecteurs d’écran.'],
                ['<span class="sr-only">Ouvrir le menu</span>', 'Texte invisible à l’écran mais lu par les lecteurs d’écran.'],
            ],
            'reference' => [
                ['display: none', 'Retire l’élément de la mise en page et de l’accessibilité.'],
                ['visibility: hidden', 'Invisible, place conservée.'],
                ['opacity: 0', 'Transparent, toujours présent et interactif.'],
                ['.sr-only', 'Masque visuellement en gardant l’accessibilité.'],
            ],
            'mistakes' => [
                'Utiliser `opacity: 0` pour masquer un bouton : il reste cliquable.',
                'Masquer un label avec `display: none` : le champ perd son nom accessible.',
                'Masquer du contenu important sur mobile.',
            ],
            'practices' => [
                '`display: none` pour ce qui ne doit pas exister à ce moment (menu fermé).',
                'La classe `.sr-only` pour les textes réservés aux lecteurs d’écran.',
                'Tester avec un lecteur d’écran ou l’inspecteur d’accessibilité.',
            ],
            'practical' => 'Un menu « burger » sur mobile est souvent en `display: none` tant qu’il est fermé, et passe en `display: block` (ou flex) quand l’utilisateur l’ouvre — c’est le cas du menu de cette plateforme.',
            'summary' => ['`display: none` : disparaît complètement.', '`visibility: hidden` : invisible, place gardée.', '`opacity: 0` : invisible mais présent.', '`.sr-only` : caché à l’écran, lu par les lecteurs d’écran.'],
            'challenge' => 'Créez un bouton-icône « panier » dont le texte « Voir le panier (3 articles) » est réservé aux lecteurs d’écran.',
            'exercises' => [
                [
                    'title' => 'Masquer complètement',
                    'difficulty' => 1,
                    'instructions' => 'Masquez complètement le paragraphe `.promo-expiree` pour qu’il ne prenne **plus aucune place** dans la page.',
                    'starter_html' => '<p>Bienvenue !</p>
<p class="promo-expiree">Promotion terminée.</p>
<p>Découvrez nos nouveautés.</p>',
                    'solution_css' => '.promo-expiree {
  display: none;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.promo-expiree|p.promo-expiree', 'prop' => 'display', 'value' => 'none', 'msg' => '.promo-expiree a display: none'],
                    ],
                    'hint' => 'Une seule propriété retire l’élément de la mise en page.',
                    'explanation' => '`display: none` retire l’élément de la mise en page ; `visibility: hidden` laisserait un vide.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle méthode conserve la place de l’élément masqué ?', 'a' => ['`display: none`', '`visibility: hidden`', 'Aucune', '`hidden` en HTML'], 'c' => 1, 'e' => '`visibility: hidden` réserve l’espace.'],
                ['q' => 'Un élément en `opacity: 0` est-il encore cliquable ?', 'a' => ['Oui', 'Non'], 'c' => 0, 'e' => 'Oui : il est seulement transparent.'],
                ['q' => '`display: none` masque aussi l’élément pour les lecteurs d’écran.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
    ],
];
