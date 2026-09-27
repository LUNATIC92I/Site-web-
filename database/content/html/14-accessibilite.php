<?php
return [
    'slug' => 'html-accessibilite',
    'title' => 'Accessibilité',
    'description' => 'Concevoir des pages utilisables par tous : principes WCAG, navigation clavier, ARIA et tests.',
    'lessons' => [
        [
            'slug' => 'principes-accessibilite',
            'title' => 'Les principes de l’accessibilité',
            'duration' => 15,
            'intro' => <<<'MD'
Plus d’une personne sur cinq vit avec un handicap, permanent ou temporaire : déficience visuelle, auditive, motrice, cognitive… sans compter le bras cassé, le soleil sur l’écran ou la connexion lente. L’**accessibilité numérique**, c’est concevoir des sites utilisables par **tous**. C’est une obligation légale pour de nombreux sites, et avant tout une question de respect.
MD,
            'objectives' => ['Connaître les quatre principes WCAG', 'Identifier les technologies d’assistance', 'Appliquer les bonnes pratiques HTML déjà vues sous l’angle de l’accessibilité'],
            'prerequisites' => ['Le HTML sémantique', 'Les formulaires'],
            'theory' => <<<'MD'
## Qui est concerné ?

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
- lancer un audit automatique (Lighthouse, WAVE, axe) — ils ne détectent qu’environ 30 % des problèmes.
MD,
            'syntax' => '<button type="button">Action</button>   <!-- et non <div onclick> -->
<img src="…" alt="…">
<label for="…">…</label>',
            'example_html' => <<<'HTML'
<main>
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
</main>
HTML,
            'example_css' => <<<'CSS'
body { font-family: system-ui, sans-serif; line-height: 1.5; }
form { display: grid; gap: 6px; max-width: 320px; }
input { padding: 8px; border: 2px solid #475569; border-radius: 6px; }
input:focus-visible, button:focus-visible { outline: 3px solid #2563eb; outline-offset: 2px; }
button { padding: 10px; border: 0; border-radius: 6px; background: #1d4ed8; color: white; }
.erreur { color: #b91c1c; font-weight: bold; }
CSS,
            'lines' => [
                ['<p>Les champs marqués d’un astérisque (*) sont obligatoires.</p>', 'L’astérisque est expliqué en texte.'],
                ['<label for="nom">Nom *</label>', 'Label visible et associé.'],
                ['aria-describedby="mail-aide"', 'Le texte d’aide est lu avec le champ.'],
                ['<button type="submit">', 'Un vrai bouton : clavier et lecteurs d’écran le gèrent nativement.'],
                ['<p class="erreur" role="alert">⚠ Erreur : …', 'Message annoncé immédiatement ; l’erreur est signalée par une icône ET du texte, pas seulement la couleur.'],
                ['outline: 3px solid #2563eb;', '(CSS) Focus clavier très visible.'],
            ],
            'reference' => [
                ['WCAG', 'Règles internationales d’accessibilité (niveaux A, AA, AAA).'],
                ['RGAA', 'Référentiel français, basé sur les WCAG.'],
                ['Lecteur d’écran', 'Logiciel qui lit la page à voix haute ou en braille.'],
                ['role="alert"', 'Annonce immédiatement un message important.'],
            ],
            'mistakes' => [
                'Des `<div>` ou `<span>` cliquables à la place de boutons ou liens.',
                'Supprimer le contour de focus.',
                'Une information transmise uniquement par la couleur.',
                'Des contrastes insuffisants.',
                'Des champs sans label.',
            ],
            'practices' => [
                'Le bon élément HTML natif avant tout.',
                'Tester au clavier à chaque nouvelle fonctionnalité.',
                'Combiner tests automatiques et tests manuels.',
            ],
            'practical' => 'En Europe, l’Acte européen sur l’accessibilité (applicable depuis juin 2025) impose l’accessibilité à de nombreux services en ligne : e-commerce, banques, transports. Les compétences de cette leçon sont désormais recherchées par les recruteurs.',
            'summary' => ['Accessibilité = utilisable par tous.', 'WCAG : Perceptible, Opérable, Compréhensible, Robuste.', 'Le HTML sémantique fait l’essentiel du travail.', 'Tester au clavier et avec un lecteur d’écran.'],
            'challenge' => 'Parcourez un site que vous utilisez souvent uniquement au clavier. Notez trois obstacles rencontrés.',
            'exercises' => [
                [
                    'title' => 'Remplacer une div cliquable',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Ce « faux » bouton est une `<div>` : inaccessible au clavier. Remplacez-la par un vrai `<button type="button">` en conservant la classe `btn` et le texte.',
                    'starter_html' => '<div class="btn">Ajouter au panier</div>',
                    'starter_css' => '.btn { display: inline-block; padding: 10px 16px; background: #0f766e; color: white; border: 0; border-radius: 6px; }',
                    'solution_html' => '<button type="button" class="btn">Ajouter au panier</button>',
                    'solution_css' => '.btn { display: inline-block; padding: 10px 16px; background: #0f766e; color: white; border: 0; border-radius: 6px; }',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'button.btn', 'text' => 'Ajouter au panier', 'msg' => 'Un <button class="btn"> « Ajouter au panier »'],
                        ['t' => 'attr', 'sel' => 'button', 'attr' => 'type', 'value' => 'button', 'msg' => 'type="button" est précisé'],
                        ['t' => 'noel', 'sel' => 'div', 'msg' => 'Plus de <div>'],
                    ],
                    'hint' => 'Remplacez `div` par `button` dans les deux balises.',
                    'explanation' => 'Un `<button>` est focusable, activable au clavier et annoncé comme bouton, sans aucun code supplémentaire.',
                ],
                [
                    'title' => 'Information et couleur',
                    'type' => 'truefalse',
                    'instructions' => 'Vrai ou faux ?',
                    'question' => 'Indiquer les champs en erreur uniquement par une bordure rouge est suffisant pour l’accessibilité.',
                    'correct' => 1,
                    'explanation' => 'Faux : les personnes daltoniennes ou aveugles ne perçoivent pas la couleur. Il faut aussi un texte (et idéalement une icône).',
                ],
            ],
            'quiz' => [
                ['q' => 'Que signifie le « P » des principes WCAG ?', 'a' => ['Performant', 'Perceptible', 'Prioritaire', 'Public'], 'c' => 1, 'e' => 'Perceptible, Opérable, Compréhensible, Robuste.'],
                ['q' => 'Quel niveau WCAG est généralement exigé ?', 'a' => ['A', 'AA', 'AAA', 'Aucun'], 'c' => 1, 'e' => 'Le niveau AA.'],
                ['q' => 'Les outils d’audit automatiques détectent tous les problèmes d’accessibilité.', 'tf' => true, 'c' => false, 'e' => 'Faux : environ 30 % seulement ; les tests manuels restent indispensables.'],
            ],
        ],
        [
            'slug' => 'aria-et-navigation-clavier',
            'title' => 'ARIA et navigation au clavier',
            'duration' => 16,
            'intro' => <<<'MD'
Quand le HTML natif ne suffit pas — un bouton qui n’affiche qu’une icône, un menu qui s’ouvre, une zone qui se met à jour — les attributs **ARIA** complètent l’information transmise aux technologies d’assistance. Utilisés avec parcimonie et justesse, ils rendent accessibles des interfaces riches.
MD,
            'objectives' => ['Comprendre la règle n°1 d’ARIA', 'Nommer un élément avec `aria-label` et `aria-labelledby`', 'Décrire un état avec `aria-expanded`, `aria-current`, `aria-hidden`', 'Garantir un ordre de tabulation logique'],
            'prerequisites' => ['Les principes de l’accessibilité'],
            'theory' => <<<'MD'
## La règle n°1 d’ARIA

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
4. aucun **piège** : on doit pouvoir sortir de chaque composant (dans l’éditeur de cette plateforme, Échap quitte la zone de code où Tab sert à indenter).
MD,
            'syntax' => '<button aria-label="Fermer" aria-expanded="false">…</button>
<a href="…" aria-current="page">…</a>
<svg aria-hidden="true">…</svg>
<div aria-live="polite">…</div>',
            'example_html' => <<<'HTML'
<header class="barre">
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
<button type="button" aria-label="Supprimer l’article Chaussettes">🗑</button>
HTML,
            'example_css' => <<<'CSS'
body { font-family: system-ui, sans-serif; }
.barre { display: flex; gap: 12px; align-items: center; }
.burger { font-size: 20px; padding: 6px 10px; }
nav a { margin-right: 10px; }
[aria-current="page"] { font-weight: bold; text-decoration: underline; }
CSS,
            'lines' => [
                ['aria-expanded="false"', 'Indique que le menu contrôlé est fermé (JavaScript passera la valeur à true).'],
                ['aria-controls="menu"', 'Précise quel élément le bouton contrôle.'],
                ['aria-label="Ouvrir le menu"', 'Nom accessible d’un bouton qui n’affiche qu’une icône.'],
                ['<span aria-hidden="true">☰</span>', 'L’icône n’est pas lue (« trois barres horizontales » n’aurait aucun sens).'],
                ['aria-current="page"', 'Lien de la page actuelle ; utilisé aussi pour le style.'],
                ['<span aria-live="polite">', 'Les changements du panier seront annoncés.'],
            ],
            'reference' => [
                ['aria-label / aria-labelledby', 'Nom accessible.'],
                ['aria-describedby', 'Description complémentaire.'],
                ['aria-expanded', 'État ouvert/fermé.'],
                ['aria-current', 'Élément courant dans un ensemble.'],
                ['aria-hidden', 'Masque aux technologies d’assistance.'],
                ['aria-live', 'Zone dont les mises à jour sont annoncées.'],
            ],
            'mistakes' => [
                'Ajouter de l’ARIA partout « au cas où ».',
                'Mettre `aria-hidden="true"` sur un élément focusable.',
                'Un bouton icône sans nom accessible.',
                'Des `tabindex` positifs qui désorganisent la navigation.',
                'Un composant où le focus reste bloqué.',
            ],
            'practices' => [
                'HTML natif d’abord, ARIA en complément.',
                'Nommer tous les boutons icônes.',
                'Mettre à jour les états ARIA en même temps que l’interface.',
                'Tester chaque composant au clavier.',
            ],
            'practical' => 'Le menu utilisateur de cette plateforme utilise `aria-expanded` et `aria-haspopup`, les icônes ont `aria-hidden="true"`, et le lien de la page active porte `aria-current="page"`. Inspectez-les avec les outils de développement !',
            'summary' => ['Règle n°1 : HTML natif d’abord.', 'ARIA nomme (`aria-label`), décrit des états (`aria-expanded`, `aria-current`) et masque (`aria-hidden`).', 'Tout doit fonctionner au clavier, avec un focus visible et sans piège.'],
            'challenge' => 'Créez un bouton « Afficher la réponse » d’une FAQ avec `aria-expanded` et `aria-controls` pointant vers la réponse.',
            'exercises' => [
                [
                    'title' => 'Un bouton icône accessible',
                    'difficulty' => 2,
                    'instructions' => 'Ce bouton n’affiche qu’une icône. Ajoutez-lui `aria-label="Rechercher"` et masquez l’icône aux lecteurs d’écran avec `aria-hidden="true"` sur le `<span>`.',
                    'starter_html' => '<button type="button">
  <span>🔍</span>
</button>',
                    'solution_html' => '<button type="button" aria-label="Rechercher">
  <span aria-hidden="true">🔍</span>
</button>',
                    'rules' => [
                        ['t' => 'attr', 'sel' => 'button', 'attr' => 'aria-label', 'value' => 'Rechercher', 'msg' => 'Le bouton a aria-label="Rechercher"'],
                        ['t' => 'attr', 'sel' => 'button span', 'attr' => 'aria-hidden', 'value' => 'true', 'msg' => 'L’icône a aria-hidden="true"'],
                    ],
                    'hint' => 'Le nom va sur le bouton, `aria-hidden` sur l’icône.',
                    'explanation' => 'Le lecteur d’écran annoncera « Rechercher, bouton » au lieu du nom de l’emoji.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle est la règle n°1 d’ARIA ?', 'a' => ['Mettre ARIA partout', 'Utiliser un élément HTML natif quand il existe', 'Toujours ajouter un role', 'Remplacer les labels'], 'c' => 1, 'e' => 'Le HTML natif apporte sémantique et comportement.'],
                ['q' => 'Quel attribut indique qu’un menu est ouvert ?', 'a' => ['`aria-open`', '`aria-expanded="true"`', '`aria-visible`', '`aria-live`'], 'c' => 1, 'e' => '`aria-expanded`.'],
                ['q' => '`aria-hidden="true"` peut être placé sur un bouton focusable sans problème.', 'tf' => true, 'c' => false, 'e' => 'Faux : l’élément reste atteignable au clavier mais devient muet.'],
            ],
        ],
    ],
];
