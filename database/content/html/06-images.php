<?php
return [
    'slug' => 'html-images',
    'title' => 'Les images',
    'description' => 'Intégrer des images accessibles et performantes : alt, dimensions, formats, figure, lazy loading et images responsives.',
    'lessons' => [
        [
            'slug' => 'la-balise-img',
            'title' => 'La balise img et le texte alternatif',
            'duration' => 14,
            'intro' => <<<'MD'
Une image vaut mille mots… sauf pour ceux qui ne peuvent pas la voir : personnes aveugles utilisant un lecteur d’écran, connexion trop lente, moteur de recherche. Pour eux, seul compte le **texte alternatif**. Apprendre à insérer une image, c’est donc aussi apprendre à la décrire.
MD,
            'objectives' => ['Insérer une image avec `<img>`', 'Rédiger un attribut `alt` pertinent', 'Gérer les images décoratives', 'Comprendre les chemins d’images'],
            'prerequisites' => ['Liens relatifs, absolus, ancres'],
            'theory' => <<<'MD'
## La syntaxe

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

`title` affiche une info-bulle au survol de la souris ; il n’est pas fiable pour l’accessibilité et ne remplace jamais `alt`.
MD,
            'syntax' => '<img src="chemin/image.jpg" alt="Description de l’image">',
            'example_html' => <<<'HTML'
<h1>Notre boulangerie</h1>
<img src="https://placehold.co/400x250/png?text=Vitrine" alt="Vitrine de la boulangerie avec baguettes et croissants alignés" width="400" height="250">
<p>
  <img src="https://placehold.co/24x24/png" alt="">
  Pains cuits sur place chaque matin.
</p>
<a href="#">
  <img src="https://placehold.co/120x40/png?text=Logo" alt="Boulangerie Dupain — retour à l’accueil" width="120" height="40">
</a>
HTML,
            'lines' => [
                ['<img src="…" alt="Vitrine de la boulangerie…"', 'Image informative : le `alt` décrit ce qu’elle montre.'],
                ['width="400" height="250">', 'Dimensions réelles : le navigateur réserve la place avant le chargement.'],
                ['<img src="…" alt="">', 'Icône décorative : `alt` vide, ignorée par les lecteurs d’écran.'],
                ['<a href="#"><img … alt="Boulangerie Dupain — retour à l’accueil"', 'Image-lien : le `alt` décrit la destination du lien.'],
            ],
            'reference' => [
                ['<img>', 'Élément vide d’image.'],
                ['src', 'Chemin de l’image.'],
                ['alt', 'Texte alternatif (obligatoire ; vide si décorative).'],
                ['width / height', 'Dimensions intrinsèques en pixels (sans unité).'],
            ],
            'mistakes' => [
                'Oublier l’attribut `alt`.',
                'Mettre le nom du fichier ou « image » dans le `alt`.',
                'Décrire une image décorative (bruit inutile pour le lecteur d’écran).',
                'Mauvais chemin : majuscules/minuscules différentes (`Chat.JPG` ≠ `chat.jpg` sur un serveur).',
                'Écrire `</img>`.',
            ],
            'practices' => [
                'Un `alt` concis (une phrase) qui transmet l’information utile.',
                '`alt=""` pour les images décoratives.',
                'Toujours indiquer `width` et `height`.',
                'Noms de fichiers descriptifs : `vitrine-boulangerie.jpg`.',
            ],
            'practical' => 'Sur un site e-commerce, le `alt` des photos produit améliore le référencement dans Google Images et rend la boutique utilisable par les clients aveugles. Les CMS comme WordPress proposent un champ « Texte alternatif » pour chaque image importée.',
            'summary' => ['`<img src="…" alt="…">`, élément vide.', 'Le `alt` remplace l’image pour ceux qui ne la voient pas.', 'Image décorative → `alt=""`.', 'Indiquez `width` et `height`.'],
            'challenge' => 'Choisissez trois images d’un site que vous aimez et rédigez pour chacune un `alt` pertinent. Vérifiez ensuite le `alt` réel avec les outils de développement.',
            'exercises' => [
                [
                    'title' => 'Insérer une image accessible',
                    'difficulty' => 1,
                    'instructions' => 'Insérez l’image `https://placehold.co/300x200/png` avec un texte alternatif **non vide** qui la décrit, et les attributs `width="300"` et `height="200"`.',
                    'starter_html' => '<h1>Ma photo de vacances</h1>
',
                    'solution_html' => '<h1>Ma photo de vacances</h1>
<img src="https://placehold.co/300x200/png" alt="Plage de sable blanc au coucher du soleil" width="300" height="200">',
                    'rules' => [
                        ['t' => 'attr', 'sel' => 'img', 'attr' => 'src', 'value' => 'https://placehold.co/300x200/png', 'msg' => 'L’image a la bonne source'],
                        ['t' => 'attr', 'sel' => 'img', 'attr' => 'alt', 'nonempty' => true, 'msg' => 'Un texte alternatif non vide est présent'],
                        ['t' => 'attr', 'sel' => 'img', 'attr' => 'width', 'value' => '300', 'msg' => 'width="300"'],
                        ['t' => 'attr', 'sel' => 'img', 'attr' => 'height', 'value' => '200', 'msg' => 'height="200"'],
                        ['t' => 'absent', 's' => '</img>', 'msg' => 'Pas de balise fermante </img>'],
                    ],
                    'hint' => '`<img src="…" alt="…" width="300" height="200">`',
                    'explanation' => 'Une image informative a toujours un `alt` qui la décrit, et ses dimensions évitent les décalages au chargement.',
                ],
                [
                    'title' => 'Image décorative',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Comment coder une image purement décorative (un ornement) ?',
                    'answers' => ['Sans attribut alt', '`alt="image décorative"`', '`alt=""`', '`alt="ornement.png"`'],
                    'correct' => 2,
                    'explanation' => 'Un `alt` vide indique aux lecteurs d’écran d’ignorer l’image.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel attribut contient le chemin de l’image ?', 'a' => ['`href`', '`src`', '`alt`', '`link`'], 'c' => 1, 'e' => '`src` = source de l’image.'],
                ['q' => 'Qui utilise l’attribut `alt` ?', 'a' => ['Les lecteurs d’écran', 'Les moteurs de recherche', 'Le navigateur si l’image ne charge pas', 'Tous les trois'], 'c' => 3, 'e' => 'Le texte alternatif sert à tous ces cas.'],
                ['q' => 'L’attribut `title` peut remplacer `alt`.', 'tf' => true, 'c' => false, 'e' => 'Faux : `title` n’est qu’une info-bulle, peu fiable pour l’accessibilité.'],
            ],
        ],
        [
            'slug' => 'images-formats-figure-performance',
            'title' => 'Formats, figure, lazy loading et images responsives',
            'duration' => 16,
            'intro' => <<<'MD'
Les images représentent souvent plus de la moitié du poids d’une page. Une photo mal optimisée peut ralentir un site de plusieurs secondes sur mobile. Dans cette leçon : choisir le bon format, légender une image, différer son chargement et servir la bonne taille à chaque écran.
MD,
            'objectives' => ['Choisir entre JPEG, PNG, WebP, AVIF et SVG', 'Légender une image avec `<figure>` et `<figcaption>`', 'Utiliser `loading="lazy"`', 'Découvrir `srcset` et `<picture>`'],
            'prerequisites' => ['La balise img et le texte alternatif'],
            'theory' => <<<'MD'
## Les formats d’image

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

> [!TIP] Compressez toujours vos images avant de les publier (outils gratuits : Squoosh, TinyPNG). Une photo de 4 Mo sortie d’un appareil peut souvent descendre à 150 Ko sans différence visible.
MD,
            'syntax' => '<figure>
  <img src="…" alt="…" loading="lazy">
  <figcaption>Légende</figcaption>
</figure>',
            'example_html' => <<<'HTML'
<article>
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
</article>
HTML,
            'lines' => [
                ['<figure>', 'Conteneur qui associe l’image à sa légende.'],
                ['<img … width="600" height="350">', 'Première image : chargée immédiatement (pas de lazy).'],
                ['<figcaption>…</figcaption>', 'Légende visible, liée à l’image.'],
                ['… loading="lazy">', 'Image plus bas dans la page : chargement différé.'],
            ],
            'reference' => [
                ['<figure>', 'Contenu illustratif autonome (image, schéma, code).'],
                ['<figcaption>', 'Légende d’une figure.'],
                ['loading="lazy"', 'Chargement différé.'],
                ['srcset / sizes', 'Plusieurs tailles d’image au choix du navigateur.'],
                ['<picture> / <source>', 'Plusieurs formats ou cadrages.'],
            ],
            'mistakes' => [
                'Publier des photos de plusieurs Mo non compressées.',
                'Utiliser PNG pour des photos.',
                'Mettre `loading="lazy"` sur l’image principale en haut de page.',
                'Répéter la légende mot pour mot dans le `alt`.',
                'Oublier `<img>` dans `<picture>`.',
            ],
            'practices' => [
                'WebP/AVIF pour les photos, SVG pour logos et icônes.',
                '`loading="lazy"` sous la ligne de flottaison.',
                'Toujours `width` et `height` pour éviter les sauts de mise en page.',
                'Compresser et redimensionner avant publication.',
            ],
            'practical' => 'Google mesure la vitesse de chargement (Core Web Vitals) et en tient compte dans le classement. Les images mal dimensionnées sont la première cause de lenteur ; `srcset`, `loading="lazy"` et WebP règlent l’essentiel du problème.',
            'summary' => ['Photo → JPEG/WebP/AVIF ; logo/icône → SVG.', '`<figure>` + `<figcaption>` pour une image légendée.', '`loading="lazy"` pour les images hors écran.', '`srcset` et `<picture>` adaptent l’image à l’appareil.'],
            'challenge' => 'Créez une galerie de 6 photos légendées avec `<figure>`, dont les 4 dernières en `loading="lazy"`.',
            'exercises' => [
                [
                    'title' => 'Une image légendée',
                    'difficulty' => 2,
                    'instructions' => 'Placez l’image dans un élément `<figure>` et ajoutez une légende `<figcaption>` contenant le texte **Le Mont-Saint-Michel**. Ajoutez aussi `loading="lazy"` à l’image.',
                    'starter_html' => '<img src="https://placehold.co/500x300/png" alt="Le Mont-Saint-Michel à marée haute" width="500" height="300">',
                    'solution_html' => '<figure>
  <img src="https://placehold.co/500x300/png" alt="Le Mont-Saint-Michel à marée haute" width="500" height="300" loading="lazy">
  <figcaption>Le Mont-Saint-Michel</figcaption>
</figure>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'figure img', 'msg' => 'L’image est dans un <figure>'],
                        ['t' => 'el', 'sel' => 'figure figcaption', 'text' => 'Le Mont-Saint-Michel', 'msg' => 'Une <figcaption> « Le Mont-Saint-Michel »'],
                        ['t' => 'attr', 'sel' => 'img', 'attr' => 'loading', 'value' => 'lazy', 'msg' => 'loading="lazy" sur l’image'],
                        ['t' => 'attr', 'sel' => 'img', 'attr' => 'alt', 'nonempty' => true, 'msg' => 'Le texte alternatif est conservé'],
                    ],
                    'hint' => '`<figure>` entoure l’image et la légende.',
                    'explanation' => '`<figure>` regroupe l’image et sa `<figcaption>`, qui la légende.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel format pour un logo qui doit rester net à toutes les tailles ?', 'a' => ['JPEG', 'PNG', 'SVG', 'GIF'], 'c' => 2, 'e' => 'Le SVG est vectoriel.'],
                ['q' => 'Que fait `loading="lazy"` ?', 'a' => ['Compresse l’image', 'Retarde le téléchargement jusqu’à ce que l’image approche de l’écran', 'Floute l’image', 'Masque l’image'], 'c' => 1, 'e' => 'Le chargement est différé.'],
                ['q' => 'Quel élément contient la légende d’une figure ?', 'a' => ['`<caption>`', '`<legend>`', '`<figcaption>`', '`<label>`'], 'c' => 2, 'e' => '`<figcaption>`.'],
                ['q' => 'Dans `<picture>`, la balise `<img>` est facultative.', 'tf' => true, 'c' => false, 'e' => 'Faux : elle est obligatoire et sert de repli.'],
            ],
        ],
    ],
];
