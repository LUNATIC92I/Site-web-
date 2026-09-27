<?php
return [
    'slug' => 'css-positionnement',
    'title' => 'Le positionnement',
    'description' => 'position static, relative, absolute, fixed, sticky et gestion de la superposition avec z-index.',
    'lessons' => [
        [
            'slug' => 'position-relative-absolute',
            'title' => 'position : relative et absolute',
            'duration' => 16,
            'intro' => <<<'MD'
Un badge « -20 % » dans le coin d’une photo, une icône à l’intérieur d’un champ, une bulle de notification sur une cloche : ces éléments « flottent » à un endroit précis. C’est le travail de `position: absolute`… à condition de comprendre son partenaire indispensable, `position: relative`.
MD,
            'objectives' => ['Comprendre `static` et `relative`', 'Positionner un élément en `absolute` par rapport à son parent', 'Utiliser `top`, `right`, `bottom`, `left` et `inset`'],
            'prerequisites' => ['La propriété display'],
            'theory' => <<<'MD'
## `static` (par défaut)

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

> [!WARN] N’utilisez pas `absolute` pour construire toute une mise en page : les éléments ne tiennent plus compte les uns des autres et tout se chevauche dès que le contenu change. Flexbox et Grid sont faits pour ça.
MD,
            'syntax' => '.parent { position: relative; }
.enfant { position: absolute; top: 0; right: 0; }',
            'example_html' => <<<'HTML'
<article class="produit">
  <img src="https://placehold.co/280x180/png?text=Casque" alt="Casque audio sans fil noir" width="280" height="180">
  <span class="badge">-20 %</span>
  <h3>Casque sans fil</h3>
  <p><del>99 €</del> 79 €</p>
</article>
HTML,
            'example_css' => <<<'CSS'
.produit {
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
}
CSS,
            'lines' => [
                ['  position: relative;', 'La carte devient le repère de positionnement.'],
                ['  position: absolute;', 'Le badge sort du flux…'],
                ['  top: 12px;', '…et se place à 12px du haut de la carte…'],
                ['  right: 12px;', '…et à 12px de son bord droit.'],
                ['  overflow: hidden;', 'Les coins arrondis s’appliquent aussi à l’image.'],
            ],
            'reference' => [
                ['position: static', 'Flux normal (défaut).'],
                ['position: relative', 'Décalage relatif, place conservée ; repère pour les enfants absolus.'],
                ['position: absolute', 'Hors flux, positionné par rapport à l’ancêtre positionné.'],
                ['top / right / bottom / left', 'Décalages depuis les bords.'],
                ['inset', 'Raccourci des quatre décalages.'],
            ],
            'mistakes' => [
                'Oublier `position: relative` sur le parent : l’élément se place par rapport à toute la page.',
                'Construire une mise en page entière en `absolute`.',
                'Définir à la fois `left` et `right` avec une largeur fixe et s’étonner du résultat.',
            ],
            'practices' => [
                'Duo parent `relative` / enfant `absolute` pour les éléments décoratifs ou superposés.',
                'Réserver `absolute` aux petits éléments (badges, icônes, voiles).',
            ],
            'practical' => 'Les vignettes de vidéos (durée en bas à droite), les pastilles de notification, les boutons « fermer » en haut à droite des fenêtres modales : tous utilisent ce duo relative/absolute.',
            'summary' => ['`relative` : décalage léger, sert surtout de repère.', '`absolute` : hors flux, placé par rapport à l’ancêtre positionné.', 'Duo : parent `relative`, enfant `absolute`.'],
            'challenge' => 'Créez une icône de cloche avec une pastille rouge « 3 » positionnée en haut à droite.',
            'exercises' => [
                [
                    'title' => 'Un badge dans le coin',
                    'difficulty' => 2,
                    'instructions' => 'Placez `.badge` dans le **coin supérieur gauche** de `.carte` : la carte doit être le repère (`position: relative`) et le badge `position: absolute` avec `top: 8px` et `left: 8px`.',
                    'starter_html' => '<div class="carte">
  <span class="badge">Nouveau</span>
  <p>Contenu de la carte, avec assez de texte pour voir le badge par-dessus.</p>
</div>',
                    'starter_css' => '.carte {
  width: 260px;
  padding: 40px 16px 16px;
  background: #f1f5f9;
}

.badge {
  background: #16a34a;
  color: white;
  padding: 2px 8px;
}',
                    'solution_css' => '.carte {
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
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.carte|div.carte', 'prop' => 'position', 'value' => 'relative', 'msg' => 'La carte est en position: relative'],
                        ['t' => 'css', 'sel' => '.badge|span.badge|.carte .badge', 'prop' => 'position', 'value' => 'absolute', 'msg' => 'Le badge est en position: absolute'],
                        ['t' => 'css', 'sel' => '.badge|span.badge|.carte .badge', 'prop' => 'top', 'value' => '8px', 'msg' => 'top: 8px'],
                        ['t' => 'css', 'sel' => '.badge|span.badge|.carte .badge', 'prop' => 'left', 'value' => '8px', 'msg' => 'left: 8px'],
                    ],
                    'hint' => 'Le parent sert de repère grâce à `position: relative`.',
                    'explanation' => 'Un élément absolu se place par rapport à son ancêtre positionné le plus proche : ici la carte.',
                ],
            ],
            'quiz' => [
                ['q' => 'Par rapport à quoi se positionne un élément `absolute` ?', 'a' => ['Toujours la page', 'Son parent direct, quel qu’il soit', 'Son ancêtre positionné le plus proche', 'L’élément précédent'], 'c' => 2, 'e' => 'Le premier ancêtre avec une position autre que static.'],
                ['q' => 'Un élément `relative` conserve-t-il sa place dans le flux ?', 'a' => ['Oui', 'Non'], 'c' => 0, 'e' => 'Oui, contrairement à `absolute`.'],
                ['q' => '`inset: 0` équivaut à `top: 0; right: 0; bottom: 0; left: 0`.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
        [
            'slug' => 'fixed-sticky-z-index',
            'title' => 'fixed, sticky et z-index',
            'duration' => 14,
            'intro' => <<<'MD'
Un en-tête qui reste visible pendant le défilement, un bouton « retour en haut » toujours accessible, des en-têtes de tableau qui suivent le lecteur… Et quand des éléments se superposent, qui passe devant ? Place à `fixed`, `sticky` et `z-index`.
MD,
            'objectives' => ['Fixer un élément à l’écran avec `fixed`', 'Créer un élément collant avec `sticky`', 'Gérer la superposition avec `z-index`'],
            'prerequisites' => ['position : relative et absolute'],
            'theory' => <<<'MD'
## `position: fixed`

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

> [!TIP] Définissez une échelle de z-index pour tout le projet (10 en-tête, 50 menus déroulants, 100 modales, 500 notifications) au lieu d’empiler des `9999`.
MD,
            'syntax' => 'position: fixed; bottom: 20px; right: 20px;
position: sticky; top: 0;
z-index: 10;',
            'example_html' => <<<'HTML'
<header class="barre">En-tête collant (sticky)</header>
<main class="contenu">
  <p>Faites défiler l’aperçu : l’en-tête reste en haut.</p>
  <p>Ligne 2</p><p>Ligne 3</p><p>Ligne 4</p><p>Ligne 5</p>
  <p>Ligne 6</p><p>Ligne 7</p><p>Ligne 8</p><p>Ligne 9</p>
  <p>Ligne 10</p><p>Ligne 11</p><p>Ligne 12</p>
</main>
<a class="retour" href="#">↑ Haut</a>
HTML,
            'example_css' => <<<'CSS'
body {
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
}
CSS,
            'lines' => [
                ['  position: sticky;', 'L’en-tête défile normalement…'],
                ['  top: 0;', '…puis colle au haut de l’écran.'],
                ['  z-index: 10;', 'Il passe devant le contenu qui défile dessous.'],
                ['  position: fixed;', 'Le bouton est fixé par rapport à la fenêtre.'],
                ['  right: 16px; bottom: 16px;', 'Toujours en bas à droite.'],
            ],
            'reference' => [
                ['position: fixed', 'Fixé par rapport à la fenêtre.'],
                ['position: sticky', 'Collant à partir d’un seuil (`top`).'],
                ['z-index', 'Ordre de superposition des éléments positionnés.'],
            ],
            'mistakes' => [
                'Oublier `top: 0` avec `sticky`.',
                'Un parent en `overflow: hidden` qui bloque `sticky`.',
                'Un en-tête `fixed` qui masque le début du contenu.',
                'Des `z-index: 99999` en escalade.',
                'Utiliser `z-index` sur un élément non positionné.',
            ],
            'practices' => [
                'Préférer `sticky` à `fixed` pour les en-têtes (pas de compensation nécessaire).',
                'Une échelle de z-index documentée.',
                'Vérifier que les éléments fixes ne masquent rien sur mobile.',
            ],
            'practical' => 'Les bannières de cookies, les boutons de chat en bas à droite et les barres de navigation mobiles en bas d’écran sont des éléments `fixed` avec un `z-index` élevé.',
            'summary' => ['`fixed` : collé à la fenêtre.', '`sticky` + `top` : collant pendant le défilement.', '`z-index` : qui passe devant (éléments positionnés).'],
            'challenge' => 'Créez une longue page avec un sommaire latéral en `position: sticky` qui reste visible pendant la lecture.',
            'exercises' => [
                [
                    'title' => 'Un en-tête collant',
                    'difficulty' => 2,
                    'instructions' => 'Rendez `.entete` collant en haut de l’écran : `position: sticky`, `top: 0` et un `z-index` de `10`.',
                    'starter_html' => '<header class="entete">Mon site</header>
<p>Contenu 1</p><p>Contenu 2</p><p>Contenu 3</p><p>Contenu 4</p><p>Contenu 5</p><p>Contenu 6</p><p>Contenu 7</p><p>Contenu 8</p><p>Contenu 9</p><p>Contenu 10</p>',
                    'starter_css' => '.entete {
  padding: 12px;
  background: #1e40af;
  color: white;
}',
                    'solution_css' => '.entete {
  position: sticky;
  top: 0;
  z-index: 10;
  padding: 12px;
  background: #1e40af;
  color: white;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.entete|header.entete', 'prop' => 'position', 'value' => 'sticky', 'msg' => 'position: sticky'],
                        ['t' => 'css', 'sel' => '.entete|header.entete', 'prop' => 'top', 'in' => ['0', '0px'], 'msg' => 'top: 0'],
                        ['t' => 'css', 'sel' => '.entete|header.entete', 'prop' => 'z-index', 'value' => '10', 'msg' => 'z-index: 10'],
                    ],
                    'hint' => 'Sans `top`, `sticky` n’a aucun effet.',
                    'explanation' => '`sticky` + `top: 0` colle l’en-tête en haut ; `z-index` le fait passer devant le contenu.',
                ],
            ],
            'quiz' => [
                ['q' => 'Par rapport à quoi un élément `fixed` est-il positionné ?', 'a' => ['Son parent', 'La fenêtre du navigateur', 'Le body', 'L’élément précédent'], 'c' => 1, 'e' => 'La fenêtre (viewport).'],
                ['q' => 'Que faut-il obligatoirement ajouter à `position: sticky` ?', 'a' => ['`z-index`', 'Un seuil comme `top: 0`', '`display: block`', '`overflow: hidden`'], 'c' => 1, 'e' => 'Un seuil (`top`, `bottom`…).'],
                ['q' => 'Un élément avec `z-index: 2` passe devant un élément avec `z-index: 1` (même contexte).', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
    ],
];
