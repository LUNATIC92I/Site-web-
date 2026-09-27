<?php
return [
    'slug' => 'html-medias',
    'title' => 'Audio, vidéo et contenus intégrés',
    'description' => 'Intégrer du son et de la vidéo accessibles, et des contenus externes avec iframe.',
    'lessons' => [
        [
            'slug' => 'audio-et-video',
            'title' => 'Les éléments audio et video',
            'duration' => 15,
            'intro' => <<<'MD'
Avant HTML5, lire une vidéo sur le Web nécessitait un plugin (Flash). Aujourd’hui, `<audio>` et `<video>` sont natifs : lecteur intégré, contrôles clavier, sous-titres. Il reste à les utiliser **avec respect** pour les visiteurs : pas de son qui démarre tout seul, des sous-titres, un poids maîtrisé.
MD,
            'objectives' => ['Intégrer un son avec `<audio>`', 'Intégrer une vidéo avec `<video>`', 'Proposer plusieurs formats avec `<source>`', 'Ajouter des sous-titres avec `<track>`'],
            'prerequisites' => ['Les images'],
            'theory' => <<<'MD'
## `<audio>`

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

> [!INFO] Pour les vidéos longues ou nombreuses, un hébergement spécialisé (YouTube, Vimeo, PeerTube) gère la compression et la bande passante : on l’intègre alors avec `<iframe>` (leçon suivante).
MD,
            'syntax' => '<video controls poster="…">
  <source src="…" type="video/mp4">
  <track kind="captions" src="…" srclang="fr">
</video>',
            'example_html' => <<<'HTML'
<h2>Tutoriel vidéo</h2>
<video controls width="480" preload="metadata" poster="https://placehold.co/480x270/png?text=Vid%C3%A9o">
  <source src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.webm" type="video/webm">
  <source src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4" type="video/mp4">
  Votre navigateur ne lit pas la vidéo.
</video>

<h2>Podcast</h2>
<audio controls preload="none" src="https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3">
  <a href="https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3">Télécharger l’audio</a>
</audio>
<p><a href="#">Lire la transcription de l’épisode</a></p>
HTML,
            'lines' => [
                ['<video controls width="480" preload="metadata" poster="…">', 'Lecteur avec contrôles, seules les métadonnées sont préchargées, image d’attente.'],
                ['<source … type="video/webm">', 'Premier format proposé (plus léger).'],
                ['<source … type="video/mp4">', 'Format de repli universel.'],
                ['Votre navigateur ne lit pas la vidéo.', 'Contenu de secours pour les navigateurs très anciens.'],
                ['<audio controls preload="none" …>', 'Rien n’est téléchargé tant que l’utilisateur ne lance pas la lecture.'],
                ['<a href="#">Lire la transcription…</a>', 'Alternative textuelle au contenu audio.'],
            ],
            'reference' => [
                ['<audio> / <video>', 'Lecteurs natifs.'],
                ['controls', 'Affiche les contrôles.'],
                ['<source src type>', 'Fichier et format alternatifs.'],
                ['<track kind srclang label>', 'Sous-titres / légendes.'],
                ['poster', 'Image d’aperçu de la vidéo.'],
                ['muted / autoplay / loop', 'Son coupé / lecture auto / boucle.'],
            ],
            'mistakes' => [
                'Oublier `controls` : le lecteur est invisible.',
                'Lancer un son automatiquement.',
                'Des vidéos sans sous-titres.',
                'Héberger des vidéos lourdes non compressées sur son propre serveur.',
            ],
            'practices' => [
                'Toujours `controls` (sauf vidéo décorative muette).',
                'Sous-titres et transcriptions.',
                '`preload="metadata"` ou `"none"` pour économiser la bande passante.',
            ],
            'practical' => 'Les sites de formation en ligne proposent systématiquement sous-titres et transcriptions : c’est une exigence d’accessibilité, et un gain pour tous (visionnage sans son dans les transports, référencement du texte).',
            'summary' => ['`<audio controls>` et `<video controls>`.', '`<source>` pour plusieurs formats.', '`<track>` pour les sous-titres.', 'Pas de son en lecture automatique.'],
            'challenge' => 'Créez une vidéo d’arrière-plan muette en boucle derrière un titre, avec un bouton (HTML uniquement) prévu pour la mettre en pause.',
            'exercises' => [
                [
                    'title' => 'Une vidéo accessible',
                    'difficulty' => 2,
                    'instructions' => 'Créez un élément `<video>` avec l’attribut `controls`, contenant une `<source>` de type `video/mp4` (src : `film.mp4`) et une piste `<track>` de `kind="captions"` avec `srclang="fr"` (src : `film-fr.vtt`).',
                    'starter_html' => '',
                    'solution_html' => '<video controls width="480">
  <source src="film.mp4" type="video/mp4">
  <track src="film-fr.vtt" kind="captions" srclang="fr" label="Français">
</video>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'video[controls]', 'msg' => 'La vidéo a l’attribut controls'],
                        ['t' => 'attr', 'sel' => 'video source', 'attr' => 'type', 'value' => 'video/mp4', 'msg' => 'Une source de type video/mp4'],
                        ['t' => 'attr', 'sel' => 'video source', 'attr' => 'src', 'value' => 'film.mp4', 'msg' => 'La source est film.mp4'],
                        ['t' => 'attr', 'sel' => 'video track', 'attr' => 'kind', 'value' => 'captions', 'msg' => 'Une piste de sous-titres kind="captions"'],
                        ['t' => 'attr', 'sel' => 'video track', 'attr' => 'srclang', 'value' => 'fr', 'msg' => 'srclang="fr"'],
                    ],
                    'hint' => '`<source>` et `<track>` se placent à l’intérieur de `<video>`.',
                    'explanation' => '`controls` affiche le lecteur, `<source>` fournit le fichier et `<track>` les sous-titres.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel attribut affiche les boutons de lecture ?', 'a' => ['`player`', '`controls`', '`buttons`', '`play`'], 'c' => 1, 'e' => '`controls`.'],
                ['q' => 'Quel élément ajoute des sous-titres ?', 'a' => ['`<caption>`', '`<subtitle>`', '`<track>`', '`<text>`'], 'c' => 2, 'e' => '`<track>` avec un fichier WebVTT.'],
                ['q' => 'Lancer automatiquement un son à l’ouverture de la page est une bonne pratique.', 'tf' => true, 'c' => false, 'e' => 'Faux : c’est intrusif et gênant pour l’accessibilité.'],
            ],
        ],
        [
            'slug' => 'iframe-contenus-integres',
            'title' => 'iframe : intégrer des contenus externes',
            'duration' => 12,
            'intro' => <<<'MD'
Une carte interactive, une vidéo YouTube, un calendrier partagé, un formulaire de paiement : tous ces contenus viennent d’un **autre site** et s’affichent dans le vôtre grâce à `<iframe>`. Un outil puissant… qui exige quelques précautions de sécurité et de performance.
MD,
            'objectives' => ['Intégrer une page externe avec `<iframe>`', 'Rendre une iframe accessible avec `title`', 'Sécuriser une iframe avec `sandbox`', 'Améliorer les performances avec `loading="lazy"`'],
            'prerequisites' => ['Les éléments audio et video'],
            'theory' => <<<'MD'
## La syntaxe

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

Une vidéo YouTube intégrée dépose des cookies dès le chargement. Préférez le domaine `youtube-nocookie.com`, ou une image cliquable qui ne charge la vidéo qu’après consentement.
MD,
            'syntax' => '<iframe src="https://…" title="Description" loading="lazy"></iframe>',
            'example_html' => <<<'HTML'
<h2>Nous trouver</h2>
<iframe
  src="https://www.openstreetmap.org/export/embed.html?bbox=2.29%2C48.85%2C2.30%2C48.86&amp;layer=mapnik"
  title="Carte OpenStreetMap autour de la tour Eiffel"
  width="480"
  height="300"
  loading="lazy">
</iframe>
<p><a href="https://www.openstreetmap.org/#map=17/48.8584/2.2945">Afficher la carte en plein écran</a></p>
HTML,
            'example_css' => <<<'CSS'
iframe {
  display: block;
  max-width: 100%;
  border: 0;
  border-radius: 12px;
}
CSS,
            'lines' => [
                ['<iframe', 'Fenêtre intégrée affichant une page externe.'],
                ['  src="https://www.openstreetmap.org/…"', 'Adresse du contenu intégré (`&amp;` = `&` dans une URL).'],
                ['  title="Carte OpenStreetMap…"', 'Nom accessible de l’iframe.'],
                ['  loading="lazy">', 'Chargement différé.'],
                ['<a href="…">Afficher la carte en plein écran</a>', 'Alternative : lien direct vers le contenu.'],
            ],
            'reference' => [
                ['<iframe src title>', 'Contenu externe intégré.'],
                ['loading="lazy"', 'Chargement différé.'],
                ['sandbox', 'Restreint les capacités du contenu intégré.'],
                ['allow', 'Autorise des fonctionnalités (plein écran, autoplay…).'],
                ['referrerpolicy', 'Contrôle l’information de provenance envoyée.'],
            ],
            'mistakes' => [
                'Oublier `title`.',
                'Intégrer des iframes lourdes en haut de page sans `lazy`.',
                'Intégrer un contenu non fiable sans `sandbox`.',
                'Largeur fixe qui déborde sur mobile (utilisez `max-width: 100%` ou `aspect-ratio`).',
            ],
            'practices' => [
                'Un `title` descriptif sur chaque iframe.',
                '`loading="lazy"` sauf si l’iframe est en haut de page.',
                '`sandbox` pour les contenus tiers non maîtrisés.',
                'Proposer un lien alternatif.',
            ],
            'practical' => 'La page « Contact » de la plupart des commerces intègre une carte en iframe ; les passerelles de paiement intègrent parfois leur formulaire de carte bancaire en iframe, pour que les numéros ne transitent jamais par le site du marchand.',
            'summary' => ['`<iframe src title>` intègre une page externe.', '`title` pour l’accessibilité, `loading="lazy"` pour la performance.', '`sandbox` pour la sécurité.'],
            'challenge' => 'Intégrez une vidéo YouTube via `youtube-nocookie.com`, rendez-la responsive avec `aspect-ratio: 16 / 9` et donnez-lui un titre accessible.',
            'exercises' => [
                [
                    'title' => 'Une carte intégrée accessible',
                    'difficulty' => 1,
                    'instructions' => 'Ajoutez les attributs manquants à l’iframe : un `title` non vide et `loading="lazy"`.',
                    'starter_html' => '<iframe src="https://www.openstreetmap.org/export/embed.html" width="400" height="250"></iframe>',
                    'solution_html' => '<iframe src="https://www.openstreetmap.org/export/embed.html" width="400" height="250" title="Carte du quartier" loading="lazy"></iframe>',
                    'rules' => [
                        ['t' => 'attr', 'sel' => 'iframe', 'attr' => 'title', 'nonempty' => true, 'msg' => 'L’iframe a un title'],
                        ['t' => 'attr', 'sel' => 'iframe', 'attr' => 'loading', 'value' => 'lazy', 'msg' => 'loading="lazy"'],
                    ],
                    'hint' => 'Deux attributs à ajouter dans la balise ouvrante.',
                    'explanation' => 'Le `title` nomme l’iframe pour les lecteurs d’écran ; `lazy` diffère son chargement.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel attribut est indispensable pour l’accessibilité d’une iframe ?', 'a' => ['`name`', '`title`', '`alt`', '`label`'], 'c' => 1, 'e' => '`title` décrit le contenu intégré.'],
                ['q' => 'À quoi sert `sandbox` ?', 'a' => ['À agrandir l’iframe', 'À restreindre ce que le contenu intégré peut faire', 'À accélérer le chargement', 'À ajouter une bordure'], 'c' => 1, 'e' => 'C’est une mesure de sécurité.'],
                ['q' => 'Tous les sites peuvent être affichés dans une iframe.', 'tf' => true, 'c' => false, 'e' => 'Faux : beaucoup l’interdisent pour se protéger du clickjacking.'],
            ],
        ],
    ],
];
