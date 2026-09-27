<?php
return [
    'slug' => 'html-bonnes-pratiques',
    'title' => 'Bonnes pratiques et validation',
    'description' => 'Écrire un HTML professionnel : conventions, organisation des fichiers, validation W3C et débogage.',
    'lessons' => [
        [
            'slug' => 'ecrire-un-html-propre',
            'title' => 'Écrire un HTML propre et professionnel',
            'duration' => 13,
            'intro' => <<<'MD'
Vous connaissez maintenant l’essentiel des balises HTML. Ce qui distingue un code professionnel d’un code qui « marche », ce sont les **conventions** : un code cohérent, lisible, bien organisé, que n’importe quel développeur peut reprendre. Cette leçon rassemble les règles d’or.
MD,
            'objectives' => ['Appliquer les conventions d’écriture', 'Organiser les fichiers d’un projet', 'Relire son code avec une check-list'],
            'prerequisites' => ['Accessibilité'],
            'theory' => <<<'MD'
## Les conventions d’écriture

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

> [!TIP] Un code propre n’est pas un luxe : c’est ce qui permet de modifier un site dans six mois sans tout casser.
MD,
            'syntax' => '<a class="btn" href="/contact" title="…">Contact</a>',
            'example_html' => <<<'HTML'
<!DOCTYPE html>
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
</html>
HTML,
            'lines' => [
                ['<!DOCTYPE html>', 'Squelette complet : doctype, langue, charset, viewport, title, description.'],
                ['<link rel="stylesheet" href="css/style.css">', 'Style dans un fichier externe, rangé dans css/.'],
                ['<nav aria-label="Navigation principale">', 'Structure sémantique et accessible.'],
                ['aria-current="page"', 'Page courante signalée.'],
                ['<label for="email">E-mail</label>', 'Formulaire accessible.'],
                ['  <main>', 'Indentation cohérente de 2 espaces, lignes vides entre les grandes zones.'],
            ],
            'reference' => [
                ['Conventions', 'Minuscules, guillemets doubles, indentation, balises fermées.'],
                ['index.html', 'Page par défaut d’un dossier.'],
                ['Balises obsolètes', '`<font>`, `<center>`, `<marquee>`, attributs `align`, `bgcolor`…'],
            ],
            'mistakes' => [
                'Des noms de fichiers avec espaces ou majuscules (`Mon Image.JPG`).',
                'Des balises obsolètes copiées d’anciens tutoriels.',
                'Un code mort commenté laissé en production.',
                'Une indentation incohérente.',
            ],
            'practices' => [
                'Utiliser un formateur automatique (Prettier).',
                'Suivre une check-list avant chaque mise en ligne.',
                'Garder une arborescence claire.',
            ],
            'practical' => 'Dans les équipes, ces règles sont écrites dans un **guide de style** et vérifiées automatiquement à chaque modification (outils de lint dans l’intégration continue). Une pull request qui ne les respecte pas est refusée.',
            'summary' => ['Minuscules, guillemets, indentation, balises fermées.', 'Fichiers bien nommés et rangés.', 'Une check-list avant chaque publication.'],
            'challenge' => 'Reprenez votre projet « Ma première page personnelle » et appliquez-lui la check-list complète.',
            'exercises' => [
                [
                    'title' => 'Moderniser du code obsolète',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Ce code utilise des balises obsolètes. Remplacez `<center>` par un simple paragraphe `<p>` (le centrage se fera en CSS), et `<font color="red">` par `<strong>`.',
                    'starter_html' => '<center>Bienvenue sur mon site, <font color="red">très</font> heureux de vous voir !</center>',
                    'solution_html' => '<p>Bienvenue sur mon site, <strong>très</strong> heureux de vous voir !</p>',
                    'rules' => [
                        ['t' => 'noel', 'sel' => 'center', 'msg' => 'Plus de balise <center>'],
                        ['t' => 'noel', 'sel' => 'font', 'msg' => 'Plus de balise <font>'],
                        ['t' => 'el', 'sel' => 'p strong', 'text' => 'très', 'msg' => '« très » est dans un <strong> à l’intérieur d’un paragraphe'],
                    ],
                    'hint' => 'La présentation (centrage, couleur) relève du CSS.',
                    'explanation' => '`<center>` et `<font>` sont obsolètes : le HTML décrit le sens, le CSS l’apparence.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel nom de fichier est le meilleur ?', 'a' => ['`Page Contact.html`', '`page_Contact.HTML`', '`contact.html`', '`CONTACT.html`'], 'c' => 2, 'e' => 'Minuscules, sans espace.'],
                ['q' => 'La balise `<center>` est…', 'a' => ['recommandée', 'obsolète', 'obligatoire', 'sémantique'], 'c' => 1, 'e' => 'Le centrage se fait en CSS.'],
                ['q' => 'Un formateur automatique aide à garder une indentation cohérente.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
        [
            'slug' => 'valider-et-deboguer',
            'title' => 'Valider et déboguer son HTML',
            'duration' => 13,
            'intro' => <<<'MD'
Le navigateur corrige silencieusement vos erreurs HTML… chacun à sa manière. Une page peut donc sembler correcte dans votre navigateur et se casser ailleurs, ou perturber les lecteurs d’écran. Le **validateur** et les **outils de développement** vous montrent la réalité.
MD,
            'objectives' => ['Utiliser le validateur du W3C', 'Lire et corriger les messages d’erreur', 'Inspecter le DOM réel avec les outils de développement'],
            'prerequisites' => ['Écrire un HTML propre et professionnel'],
            'theory' => <<<'MD'
## Le validateur du W3C

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
4. Corriger une erreur à la fois, puis revérifier.
MD,
            'syntax' => 'https://validator.w3.org/#validate_by_input',
            'example_html' => <<<'HTML'
<!-- Version corrigée d’un code qui contenait 4 erreurs -->
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
</main>
HTML,
            'lines' => [
                ['<h2>Nouveautés</h2>', 'Erreur corrigée : le h2 était placé dans un paragraphe.'],
                ['<strong>collection</strong>', 'Erreur corrigée : `</p>` était fermé avant `</strong>`.'],
                ['  <li>Écharpe</li>', 'Erreur corrigée : un `<div>` était placé directement dans le `<ul>`.'],
                ['… alt="Pull en laine beige plié"', 'Erreur corrigée : `alt` manquant.'],
                ['<p id="promo">', 'L’`id` est unique dans la page.'],
            ],
            'reference' => [
                ['validator.w3.org', 'Validateur officiel HTML.'],
                ['F12 > Éléments', 'DOM réel et styles appliqués.'],
                ['F12 > Accessibilité', 'Arbre d’accessibilité.'],
                ['Lighthouse', 'Audit performance, accessibilité, SEO, bonnes pratiques.'],
            ],
            'mistakes' => [
                'Corriger les erreurs dans le désordre (cascade d’erreurs).',
                'Ignorer les erreurs parce que « ça s’affiche bien ».',
                'Confondre le code source et le DOM corrigé par le navigateur.',
            ],
            'practices' => [
                'Valider chaque page avant publication.',
                'Corriger de haut en bas, une erreur à la fois.',
                'Intégrer la validation dans l’éditeur (extensions VS Code).',
            ],
            'practical' => 'Une balise non fermée dans le gabarit commun d’un site peut casser la mise en page de toutes les pages. Les équipes valident automatiquement le HTML généré à chaque déploiement pour éviter ce genre d’incident.',
            'summary' => ['Le validateur W3C révèle les erreurs invisibles.', 'Corriger de haut en bas.', 'Les outils de développement montrent le DOM réel et l’arbre d’accessibilité.'],
            'challenge' => 'Validez la page d’accueil de trois sites connus sur validator.w3.org. Qu’en concluez-vous ?',
            'exercises' => [
                [
                    'title' => 'Corriger quatre erreurs',
                    'type' => 'fix',
                    'difficulty' => 3,
                    'instructions' => 'Ce code contient 4 erreurs de validation : un `<h2>` dans un `<p>`, une imbrication incorrecte de `<strong>`, un `id` en double (`info`) et une image sans `alt`. Corrigez-les toutes.',
                    'starter_html' => '<p><h2>Horaires</h2></p>
<p>Ouvert <strong>tous les jours</p></strong>
<p id="info">Parking gratuit.</p>
<p id="info">Accès handicapés.</p>
<img src="https://placehold.co/100x100/png" width="100" height="100">',
                    'solution_html' => '<h2>Horaires</h2>
<p>Ouvert <strong>tous les jours</strong></p>
<p id="info-parking">Parking gratuit.</p>
<p id="info-acces">Accès handicapés.</p>
<img src="https://placehold.co/100x100/png" width="100" height="100" alt="Façade du magasin">',
                    'rules' => [
                        ['t' => 'absent', 's' => '<p><h2>', 'msg' => 'Le h2 n’est plus dans un paragraphe'],
                        ['t' => 'contains', 's' => '</strong></p>', 'msg' => '</strong> est fermé avant </p>'],
                        ['t' => 'el', 'sel' => '#info', 'max' => 1, 'min' => 0, 'msg' => 'L’id « info » n’est plus dupliqué'],
                        ['t' => 'match', 're' => '^(?![\s\S]*id="([^"]+)"[\s\S]*id="\1")', 'msg' => 'Tous les id sont uniques'],
                        ['t' => 'attr', 'sel' => 'img', 'attr' => 'alt', 'nonempty' => true, 'msg' => 'L’image a un alt'],
                    ],
                    'hint' => 'Donnez deux identifiants différents aux paragraphes.',
                    'explanation' => 'Chaque erreur corrigée rend la page plus robuste et plus accessible.',
                ],
            ],
            'quiz' => [
                ['q' => 'Dans quel ordre corriger les erreurs de validation ?', 'a' => ['De bas en haut', 'De haut en bas', 'Au hasard', 'Les avertissements d’abord'], 'c' => 1, 'e' => 'Une erreur en haut peut en provoquer d’autres plus bas.'],
                ['q' => 'L’onglet Éléments des outils de développement affiche…', 'a' => ['le code source exact', 'le DOM après interprétation par le navigateur', 'le CSS uniquement', 'les cookies'], 'c' => 1, 'e' => 'Le DOM réel, éventuellement corrigé.'],
                ['q' => 'Si la page s’affiche correctement, le HTML est forcément valide.', 'tf' => true, 'c' => false, 'e' => 'Faux : le navigateur masque de nombreuses erreurs.'],
            ],
        ],
    ],
];
