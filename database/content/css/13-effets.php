<?php
return [
    'slug' => 'css-effets-visuels',
    'title' => 'Effets visuels',
    'description' => 'Ombres portées, ombres de texte, dégradés linéaires, radiaux et coniques, filtres.',
    'lessons' => [
        [
            'slug' => 'les-ombres',
            'title' => 'Les ombres : box-shadow et text-shadow',
            'duration' => 13,
            'intro' => <<<'MD'
Les ombres donnent de la **profondeur** : une carte qui semble posée sur la page, un bouton qui se soulève, une fenêtre qui flotte au-dessus du contenu. Bien dosées, elles guident le regard ; trop marquées, elles alourdissent l’interface.
MD,
            'objectives' => ['Maîtriser la syntaxe de `box-shadow`', 'Superposer plusieurs ombres', 'Créer une ombre intérieure', 'Utiliser `text-shadow` avec modération'],
            'prerequisites' => ['Les couleurs en CSS'],
            'theory' => <<<'MD'
## `box-shadow`

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

> [!TIP] Sur un fond sombre (comme cette plateforme), les ombres se voient peu : on crée plutôt la profondeur avec des surfaces légèrement plus claires et des bordures subtiles.
MD,
            'syntax' => 'box-shadow: 0 4px 12px rgb(0 0 0 / 15%);
text-shadow: 0 1px 2px rgb(0 0 0 / 50%);',
            'example_html' => <<<'HTML'
<div class="scene">
  <div class="carte">Ombre douce</div>
  <div class="carte elevee">Ombre en couches</div>
  <input class="champ" placeholder="Ombre intérieure" aria-label="Exemple">
  <button class="btn" type="button">Anneau de focus</button>
</div>
HTML,
            'example_css' => <<<'CSS'
.scene {
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
}
CSS,
            'lines' => [
                ['  box-shadow: 0 4px 12px rgb(0 0 0 / 10%);', 'Ombre douce décalée vers le bas.'],
                ['    0 1px 2px rgb(0 0 0 / 8%),', 'Première couche : ombre de contact nette.'],
                ['    0 16px 32px rgb(0 0 0 / 14%);', 'Seconde couche : ombre d’ambiance diffuse.'],
                ['  box-shadow: inset 0 2px 4px …;', 'Ombre intérieure : le champ semble creusé.'],
                ['  box-shadow: 0 0 0 4px #bfdbfe;', 'Sans flou, avec étendue : un anneau qui n’occupe pas de place.'],
            ],
            'reference' => [
                ['box-shadow', 'x y flou étendue couleur (et `inset`).'],
                ['text-shadow', 'x y flou couleur.'],
                ['inset', 'Ombre intérieure.'],
            ],
            'mistakes' => [
                'Des ombres noires opaques (`#000`) très dures.',
                'Des ombres vers le haut ou à gauche incohérentes.',
                'Du `text-shadow` sur des paragraphes (lisibilité dégradée).',
            ],
            'practices' => [
                'Couleurs d’ombre semi-transparentes.',
                'Une échelle de 3 ou 4 niveaux d’élévation dans le projet.',
                'Animer l’ombre au survol pour suggérer le soulèvement.',
            ],
            'practical' => 'Les systèmes de design (Material Design, par exemple) définissent des niveaux d’« élévation » : chaque niveau correspond à une ombre précise, utilisée de façon cohérente pour les cartes, menus et fenêtres modales.',
            'summary' => ['`box-shadow: x y flou étendue couleur`.', 'Ombres douces, semi-transparentes, superposables.', '`inset` pour l’intérieur ; étendue sans flou pour un anneau.'],
            'challenge' => 'Créez trois cartes avec trois niveaux d’élévation, et une animation de l’ombre au survol.',
            'exercises' => [
                [
                    'title' => 'Une carte en relief',
                    'difficulty' => 1,
                    'instructions' => 'Ajoutez à `.carte` l’ombre `box-shadow: 0 8px 20px rgb(0 0 0 / 15%)`.',
                    'starter_html' => '<div class="carte">Je flotte au-dessus de la page</div>',
                    'starter_css' => '.carte {
  width: 240px;
  padding: 24px;
  border-radius: 12px;
  background: white;
}',
                    'solution_css' => '.carte {
  width: 240px;
  padding: 24px;
  border-radius: 12px;
  background: white;
  box-shadow: 0 8px 20px rgb(0 0 0 / 15%);
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.carte|div.carte', 'prop' => 'box-shadow', 'in' => ['0 8px 20px rgb(0 0 0 / 15%)', '0 8px 20px rgba(0, 0, 0, 0.15)', '0 8px 20px rgba(0, 0, 0, .15)', '0px 8px 20px rgb(0 0 0 / 15%)'], 'msg' => 'box-shadow: 0 8px 20px rgb(0 0 0 / 15%)'],
                    ],
                    'hint' => 'Décalage x, décalage y, flou, couleur.',
                    'explanation' => 'Une ombre décalée vers le bas, floue et semi-transparente donne un effet de relief naturel.',
                ],
            ],
            'quiz' => [
                ['q' => 'Dans `box-shadow: 0 4px 12px black`, que vaut le flou ?', 'a' => ['0', '4px', '12px', 'black'], 'c' => 2, 'e' => 'Troisième valeur : le rayon de flou.'],
                ['q' => 'Quel mot-clé crée une ombre intérieure ?', 'a' => ['`inner`', '`inset`', '`inside`', '`internal`'], 'c' => 1, 'e' => '`inset`.'],
                ['q' => 'On peut superposer plusieurs ombres séparées par des virgules.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
        [
            'slug' => 'les-degrades',
            'title' => 'Les dégradés',
            'duration' => 14,
            'intro' => <<<'MD'
Des fonds vibrants, des boutons lumineux, un texte multicolore, des motifs sans aucun fichier image : les **dégradés CSS** sont des images générées par le navigateur. Ils sont légers, nets à toutes les tailles et faciles à modifier.
MD,
            'objectives' => ['Créer des dégradés linéaires, radiaux et coniques', 'Contrôler direction et arrêts de couleur', 'Créer un texte en dégradé', 'Superposer dégradés et images'],
            'prerequisites' => ['Les arrière-plans', 'Les ombres'],
            'theory' => <<<'MD'
## Un dégradé est une image

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

> [!WARN] Vérifiez le contraste du texte sur **toutes** les zones du dégradé, pas seulement sur la plus favorable.
MD,
            'syntax' => 'background: linear-gradient(135deg, #4f46e5, #0ea5e9);
background: radial-gradient(circle, #fff, #000);
background: conic-gradient(red, blue);',
            'example_html' => <<<'HTML'
<div class="demo">
  <div class="tuile lineaire">linéaire</div>
  <div class="tuile radial">radial</div>
  <div class="tuile conique" role="img" aria-label="Progression : 70 %">70 %</div>
  <div class="tuile rayures">rayures</div>
</div>
<h1 class="titre">Texte en dégradé</h1>
HTML,
            'example_css' => <<<'CSS'
body { font-family: system-ui, sans-serif; padding: 16px; }
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
}
CSS,
            'lines' => [
                ['.lineaire { background: linear-gradient(135deg, …); }', 'Dégradé en diagonale.'],
                ['.radial { … radial-gradient(circle at 30% 30%, …) }', 'Cercle lumineux décentré.'],
                ['.conique { … conic-gradient(#22c55e 0 70%, #cbd5e1 70% 100%) }', 'Anneau de progression à 70 % (arrêts nets).'],
                ['repeating-linear-gradient(45deg, …)', 'Motif de rayures répété.'],
                ['  background-clip: text; color: transparent;', 'Le dégradé n’est visible qu’à travers les lettres.'],
            ],
            'reference' => [
                ['linear-gradient()', 'Dégradé linéaire (angle ou `to …`).'],
                ['radial-gradient()', 'Dégradé circulaire ou elliptique.'],
                ['conic-gradient()', 'Dégradé autour d’un point.'],
                ['repeating-*-gradient()', 'Motifs répétés.'],
                ['background-clip: text', 'Dégradé dans le texte.'],
            ],
            'mistakes' => [
                'Utiliser `background-color` pour un dégradé (il faut `background` ou `background-image`).',
                'Des dégradés trop contrastés qui nuisent à la lisibilité du texte.',
                'Oublier la version préfixée `-webkit-background-clip` pour le texte.',
            ],
            'practices' => [
                'Des dégradés entre couleurs proches pour un rendu élégant.',
                'Une couleur de fond de secours.',
                'Vérifier le contraste sur tout le dégradé.',
            ],
            'practical' => 'Les boutons d’appel à l’action des sites de produits numériques, les fonds de sections « héro » et les graphiques en anneau des tableaux de bord utilisent des dégradés CSS : aucun fichier image à charger.',
            'summary' => ['Linéaire, radial, conique : des images générées.', 'Direction + arrêts de couleur.', 'Arrêts identiques = transition nette.', '`background-clip: text` pour un texte en dégradé.'],
            'challenge' => 'Créez un bouton dont le dégradé change d’angle au survol, et un fond de page avec deux halos radiaux colorés.',
            'exercises' => [
                [
                    'title' => 'Un bandeau en dégradé',
                    'difficulty' => 1,
                    'instructions' => 'Donnez à `.bandeau` un fond `linear-gradient(90deg, #06b6d4, #3b82f6)`.',
                    'starter_html' => '<header class="bandeau">Soldes d’hiver</header>',
                    'starter_css' => '.bandeau {
  padding: 32px;
  color: white;
  font-size: 1.5rem;
}',
                    'solution_css' => '.bandeau {
  padding: 32px;
  color: white;
  font-size: 1.5rem;
  background: linear-gradient(90deg, #06b6d4, #3b82f6);
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.bandeau|header.bandeau', 'prop' => 'background|background-image', 'value' => 'linear-gradient(90deg, #06b6d4, #3b82f6)', 'msg' => 'Fond en linear-gradient(90deg, #06b6d4, #3b82f6)'],
                    ],
                    'hint' => 'Utilisez `background` (pas `background-color`).',
                    'explanation' => 'Un dégradé est une image : il se place dans `background` ou `background-image`.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle propriété n’accepte PAS de dégradé ?', 'a' => ['`background`', '`background-image`', '`background-color`', '`border-image`'], 'c' => 2, 'e' => 'Un dégradé est une image, pas une couleur.'],
                ['q' => 'Quel dégradé convient à un graphique en camembert ?', 'a' => ['`linear-gradient`', '`radial-gradient`', '`conic-gradient`', 'Aucun'], 'c' => 2, 'e' => '`conic-gradient` tourne autour d’un point.'],
                ['q' => 'Deux couleurs à la même position créent une transition nette.', 'tf' => true, 'c' => true, 'e' => 'Vrai : c’est la technique des rayures.'],
            ],
        ],
    ],
];
