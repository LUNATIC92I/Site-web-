<?php
return [
    'slug' => 'css-transitions-animations',
    'title' => 'Transitions, transformations et animations',
    'description' => 'Donner vie aux interfaces avec transition, transform et @keyframes, dans le respect des utilisateurs.',
    'lessons' => [
        [
            'slug' => 'les-transitions',
            'title' => 'Les transitions',
            'duration' => 13,
            'intro' => <<<'MD'
Quand un bouton change de couleur au survol, le changement est instantané… et un peu brutal. Une **transition** de 200 millisecondes suffit à rendre l’interface fluide et agréable. C’est la première technique d’animation à maîtriser, et souvent la seule nécessaire.
MD,
            'objectives' => ['Créer une transition entre deux états', 'Régler durée, propriété, courbe et délai', 'Choisir des propriétés performantes à animer'],
            'prerequisites' => ['Les pseudo-classes'],
            'theory' => <<<'MD'
## Le principe

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

> [!WARN] Évitez `transition: all` : vous animeriez aussi des propriétés inattendues et coûteuses. Listez précisément ce qui doit être animé.
MD,
            'syntax' => 'transition: propriété durée courbe délai;',
            'example_html' => <<<'HTML'
<a class="btn" href="#">Survolez-moi</a>
<div class="carte">Carte qui se soulève au survol</div>
<a class="lien" href="#">Lien avec soulignement animé</a>
HTML,
            'example_css' => <<<'CSS'
body { font-family: system-ui, sans-serif; display: grid; gap: 24px; justify-items: start; padding: 16px; }

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
.lien:hover { background-size: 100% 2px; }
CSS,
            'lines' => [
                ['  transition: background-color 0.2s ease, transform 0.2s ease;', 'Deux propriétés animées, déclarées sur l’état de repos.'],
                ['.btn:hover { … transform: translateY(-2px); }', 'Le bouton monte de 2px en douceur.'],
                ['  transition: transform 0.25s ease-out, box-shadow 0.25s ease-out;', 'La carte se soulève et son ombre grandit.'],
                ['  background: linear-gradient(…) left bottom / 0 2px no-repeat;', 'Un soulignement dessiné par un dégradé de largeur 0…'],
                ['.lien:hover { background-size: 100% 2px; }', '…qui s’étend à 100 % au survol.'],
            ],
            'reference' => [
                ['transition', 'Raccourci : propriété durée courbe délai.'],
                ['ease / ease-in / ease-out / linear', 'Courbes de vitesse.'],
                ['cubic-bezier()', 'Courbe personnalisée.'],
            ],
            'mistakes' => [
                'Déclarer la transition uniquement sur `:hover` (pas d’animation au retour).',
                'Des durées trop longues.',
                '`transition: all` systématique.',
                'Animer `width` ou `top` au lieu de `transform`.',
            ],
            'practices' => [
                'Transitions courtes (150–300ms).',
                'Animer `transform` et `opacity` en priorité.',
                'Lister les propriétés animées.',
            ],
            'practical' => 'Presque tous les éléments interactifs de cette plateforme (boutons, cartes, liens, barres de progression) utilisent des transitions de 150 à 300ms sur `transform`, `opacity` ou les couleurs.',
            'summary' => ['`transition` anime un changement d’état.', 'Déclarée sur l’état de repos.', '150–300ms pour les micro-interactions.', 'Préférer `transform` et `opacity`.'],
            'challenge' => 'Créez un menu dont les liens changent de couleur et affichent un soulignement qui s’étend depuis le centre au survol.',
            'exercises' => [
                [
                    'title' => 'Un survol en douceur',
                    'difficulty' => 1,
                    'instructions' => 'Ajoutez à `.btn` une transition sur `background-color` de `0.3s` avec la courbe `ease`.',
                    'starter_html' => '<button class="btn" type="button">Survolez-moi</button>',
                    'starter_css' => '.btn {
  padding: 10px 20px;
  border: 0;
  background: #f97316;
  color: white;
}

.btn:hover {
  background: #c2410c;
}',
                    'solution_css' => '.btn {
  padding: 10px 20px;
  border: 0;
  background: #f97316;
  color: white;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background: #c2410c;
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.btn|button.btn', 'prop' => 'transition', 'in' => ['background-color 0.3s ease', 'background 0.3s ease', 'background-color .3s ease', 'background-color 300ms ease'], 'msg' => 'transition: background-color 0.3s ease sur .btn'],
                    ],
                    'hint' => 'La transition se déclare sur `.btn`, pas sur `.btn:hover`.',
                    'explanation' => 'Déclarée sur l’état de repos, la transition fonctionne à l’entrée comme à la sortie du survol.',
                ],
            ],
            'quiz' => [
                ['q' => 'Où déclarer la transition pour qu’elle joue dans les deux sens ?', 'a' => ['Sur `:hover`', 'Sur l’état de repos', 'Dans une media query', 'Dans le HTML'], 'c' => 1, 'e' => 'Sur l’état de base de l’élément.'],
                ['q' => 'Quelles propriétés sont les plus performantes à animer ?', 'a' => ['`width` et `height`', '`top` et `left`', '`transform` et `opacity`', '`margin` et `padding`'], 'c' => 2, 'e' => 'Elles ne provoquent pas de recalcul de mise en page.'],
                ['q' => 'Une transition de 2 secondes est idéale pour un survol de bouton.', 'tf' => true, 'c' => false, 'e' => 'Faux : 150 à 300ms.'],
            ],
        ],
        [
            'slug' => 'transform',
            'title' => 'Les transformations : transform',
            'duration' => 13,
            'intro' => <<<'MD'
Déplacer, agrandir, faire pivoter, incliner : la propriété `transform` modifie l’apparence d’un élément **sans perturber la mise en page** autour de lui. Associée aux transitions, elle est à la base de la plupart des effets modernes.
MD,
            'objectives' => ['Utiliser `translate`, `scale`, `rotate`, `skew`', 'Combiner plusieurs transformations', 'Changer le point d’origine avec `transform-origin`'],
            'prerequisites' => ['Les transitions'],
            'theory' => <<<'MD'
## Les fonctions de transformation

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

Les pourcentages de `translate` sont relatifs à **l’élément lui-même** : on le recule de la moitié de sa propre taille.
MD,
            'syntax' => 'transform: translate(10px, 0) rotate(15deg) scale(1.1);
transform-origin: center;',
            'example_html' => <<<'HTML'
<div class="demo">
  <div class="boite deplace">translate</div>
  <div class="boite agrandit">scale</div>
  <div class="boite tourne">rotate</div>
  <div class="boite incline">skew</div>
</div>
<p>Survolez chaque boîte.</p>
HTML,
            'example_css' => <<<'CSS'
.demo {
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
.incline:hover  { transform: skewX(-12deg); }
CSS,
            'lines' => [
                ['  transition: transform 0.3s ease;', 'Toutes les transformations sont animées.'],
                ['.deplace:hover  { transform: translate(8px, -8px); }', 'Déplacement de 8px à droite et 8px vers le haut.'],
                ['.agrandit:hover { transform: scale(1.2); }', 'Agrandissement de 20 % autour du centre.'],
                ['.tourne:hover   { transform: rotate(20deg); }', 'Rotation de 20 degrés.'],
                ['.incline:hover  { transform: skewX(-12deg); }', 'Inclinaison horizontale.'],
            ],
            'reference' => [
                ['translate()', 'Déplacement.'],
                ['scale()', 'Mise à l’échelle.'],
                ['rotate()', 'Rotation (deg, turn).'],
                ['skew()', 'Inclinaison.'],
                ['transform-origin', 'Point d’origine.'],
            ],
            'mistakes' => [
                'Écrire deux déclarations `transform` : la seconde remplace la première.',
                'Oublier que l’ordre des fonctions change le résultat.',
                'Agrandir fortement du texte (flou, débordements).',
            ],
            'practices' => [
                'De petites valeurs pour des effets subtils (`scale(1.03)`, `translateY(-2px)`).',
                'Combiner les fonctions dans une seule déclaration.',
                'Toujours associer une transition.',
            ],
            'practical' => 'Les cartes qui « se soulèvent » au survol (`translateY(-4px)`), les boutons qui se « compriment » au clic (`scale(0.97)`) et les flèches qui pivotent quand un accordéon s’ouvre (`rotate(180deg)`) sont des transformations.',
            'summary' => ['`transform` : translate, scale, rotate, skew.', 'La mise en page n’est pas affectée.', 'Combiner dans une seule déclaration ; l’ordre compte.', '`transform-origin` change le pivot.'],
            'challenge' => 'Créez une icône de flèche dans un bouton d’accordéon qui pivote de 180° quand le bouton est survolé.',
            'exercises' => [
                [
                    'title' => 'Une carte qui se soulève',
                    'difficulty' => 2,
                    'instructions' => 'Au survol de `.carte`, appliquez `transform: translateY(-6px)`. Ajoutez sur `.carte` une `transition` sur `transform` de `0.25s`.',
                    'starter_html' => '<div class="carte">Survolez-moi</div>',
                    'starter_css' => '.carte {
  width: 200px;
  padding: 30px;
  background: #fef3c7;
  border-radius: 12px;
}',
                    'solution_css' => '.carte {
  width: 200px;
  padding: 30px;
  background: #fef3c7;
  border-radius: 12px;
  transition: transform 0.25s;
}

.carte:hover {
  transform: translateY(-6px);
}',
                    'rules' => [
                        ['t' => 'css', 'sel' => '.carte:hover|div.carte:hover', 'prop' => 'transform', 'value' => 'translateY(-6px)', 'msg' => 'Au survol : transform: translateY(-6px)'],
                        ['t' => 'css', 'sel' => '.carte|div.carte', 'prop' => 'transition', 'contains' => 'transform', 'msg' => 'Une transition sur transform est déclarée sur .carte'],
                    ],
                    'hint' => 'Deux règles : `.carte` (transition) et `.carte:hover` (transform).',
                    'explanation' => '`translateY` négatif déplace vers le haut ; la transition rend le mouvement fluide.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle fonction agrandit un élément ?', 'a' => ['`translate`', '`scale`', '`rotate`', '`grow`'], 'c' => 1, 'e' => '`scale()`.'],
                ['q' => 'Un élément transformé pousse-t-il ses voisins ?', 'a' => ['Oui', 'Non'], 'c' => 1, 'e' => 'Non : il garde sa place d’origine dans la mise en page.'],
                ['q' => 'Dans `translate(-50%, -50%)`, les pourcentages sont relatifs à l’élément lui-même.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
        [
            'slug' => 'animations-keyframes',
            'title' => 'Les animations @keyframes',
            'duration' => 16,
            'intro' => <<<'MD'
Les transitions animent le passage entre **deux** états déclenché par une interaction. Les **animations** vont plus loin : plusieurs étapes, démarrage automatique, répétition. Un indicateur de chargement, une apparition en fondu, un badge qui « pop » : place à `@keyframes`.
MD,
            'objectives' => ['Définir des étapes avec `@keyframes`', 'Appliquer une animation avec `animation`', 'Contrôler répétition, direction et état final', 'Respecter `prefers-reduced-motion`'],
            'prerequisites' => ['Les transformations : transform'],
            'theory' => <<<'MD'
## Définir l’animation

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

> [!TIP] Les badges de cette plateforme « pop » avec une animation `@keyframes` quand vous les débloquez — sauf si vous avez activé la réduction des animations.
MD,
            'syntax' => '@keyframes nom { from { … } to { … } }
.el { animation: nom 1s ease-in-out infinite; }',
            'example_html' => <<<'HTML'
<h2 class="titre">Bienvenue !</h2>
<div class="loader" role="status" aria-label="Chargement en cours"></div>
<span class="badge">Nouveau</span>
HTML,
            'example_css' => <<<'CSS'
body { font-family: system-ui, sans-serif; display: grid; gap: 24px; justify-items: start; padding: 24px; }

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
}
CSS,
            'lines' => [
                ['@keyframes apparition {', 'Définition d’une animation nommée.'],
                ['  from { opacity: 0; transform: translateY(20px); }', 'Départ : invisible et décalé vers le bas.'],
                ['.titre { animation: apparition 0.7s ease-out both; }', 'Le titre apparaît en fondu au chargement.'],
                ['  animation: rotation 0.8s linear infinite;', 'Rotation continue à vitesse constante : indicateur de chargement.'],
                ['  animation: pulsation 1.5s ease-in-out 3;', 'Trois pulsations, puis arrêt (pas d’animation infinie inutile).'],
                ['@media (prefers-reduced-motion: reduce) {', 'Neutralise les animations pour les utilisateurs qui le demandent.'],
            ],
            'reference' => [
                ['@keyframes', 'Définit les étapes.'],
                ['animation', 'Raccourci : nom durée courbe délai répétitions direction remplissage.'],
                ['infinite', 'Répétition sans fin.'],
                ['alternate', 'Aller-retour.'],
                ['forwards / both', 'Conserve l’état final.'],
            ],
            'mistakes' => [
                'Oublier `animation-duration` (valeur par défaut 0s : rien ne se passe).',
                'Des animations infinies qui distraient de la lecture.',
                'Ignorer `prefers-reduced-motion`.',
                'Animer des propriétés coûteuses (`width`, `left`).',
            ],
            'practices' => [
                'Des animations courtes et utiles.',
                '`transform` et `opacity` en priorité.',
                'Toujours prévoir `prefers-reduced-motion`.',
            ],
            'practical' => 'Les indicateurs de chargement, les « squelettes » de contenu qui scintillent pendant le chargement, les notifications qui glissent depuis le bord de l’écran utilisent `@keyframes`.',
            'summary' => ['`@keyframes` définit les étapes, `animation` les applique.', 'Contrôle : durée, répétitions, direction, état final.', 'Animations utiles, courtes, et désactivables.'],
            'challenge' => 'Créez trois points de chargement qui rebondissent l’un après l’autre grâce à des `animation-delay` différents.',
            'exercises' => [
                [
                    'title' => 'Un fondu d’apparition',
                    'difficulty' => 2,
                    'instructions' => 'Créez une animation `@keyframes fondu` qui passe de `opacity: 0` à `opacity: 1`, puis appliquez-la à `.message` avec une durée de `1s`.',
                    'starter_html' => '<p class="message">Je vais apparaître en douceur.</p>',
                    'solution_css' => '@keyframes fondu {
  from { opacity: 0; }
  to { opacity: 1; }
}

.message {
  animation: fondu 1s ease-out;
}',
                    'rules' => [
                        ['t' => 'match', 're' => '@keyframes\s+fondu\s*\{', 'in' => 'css', 'msg' => 'Des keyframes nommées « fondu »'],
                        ['t' => 'match', 're' => '(from|0%)\s*\{\s*opacity\s*:\s*0\s*;?\s*\}', 'in' => 'css', 'msg' => 'Départ à opacity: 0'],
                        ['t' => 'match', 're' => '(to|100%)\s*\{\s*opacity\s*:\s*1\s*;?\s*\}', 'in' => 'css', 'msg' => 'Arrivée à opacity: 1'],
                        ['t' => 'css', 'sel' => '.message|p.message', 'prop' => 'animation|animation-name', 'contains' => 'fondu', 'msg' => 'L’animation fondu est appliquée à .message'],
                        ['t' => 'css', 'sel' => '.message|p.message', 'prop' => 'animation|animation-duration', 'contains' => '1s', 'msg' => 'Durée de 1s'],
                    ],
                    'hint' => '`@keyframes fondu { from { … } to { … } }` puis `animation: fondu 1s;`',
                    'explanation' => 'Les keyframes décrivent les états, la propriété `animation` les joue sur l’élément.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle valeur répète une animation sans fin ?', 'a' => ['`forever`', '`infinite`', '`loop`', '`always`'], 'c' => 1, 'e' => '`animation-iteration-count: infinite`.'],
                ['q' => 'Que fait `animation-fill-mode: forwards` ?', 'a' => ['Accélère l’animation', 'Conserve l’état final après l’animation', 'Joue l’animation à l’envers', 'Rien'], 'c' => 1, 'e' => 'L’élément garde les styles de la dernière étape.'],
                ['q' => 'Il faut respecter la préférence `prefers-reduced-motion`.', 'tf' => true, 'c' => true, 'e' => 'Vrai : c’est une question d’accessibilité.'],
            ],
        ],
    ],
];
