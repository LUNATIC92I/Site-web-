<?php
return [
    'slug' => 'html-metadonnees-seo',
    'title' => 'Métadonnées et SEO',
    'description' => 'Les balises meta, Open Graph, favicon, et les fondamentaux du référencement naturel en HTML.',
    'lessons' => [
        [
            'slug' => 'les-balises-meta',
            'title' => 'Les balises meta et le head complet',
            'duration' => 15,
            'intro' => <<<'MD'
Quand vous partagez un lien sur une messagerie, une carte apparaît avec un titre, un résumé et une image. D’où viennent ces informations ? Du `<head>` de la page. Les **métadonnées** sont la carte de visite de votre page auprès des navigateurs, moteurs de recherche et réseaux sociaux.
MD,
            'objectives' => ['Écrire une meta description efficace', 'Ajouter les balises Open Graph pour le partage', 'Déclarer une favicon et la couleur du thème', 'Contrôler l’indexation avec robots et canonical'],
            'prerequisites' => ['Les sections head et body'],
            'theory' => <<<'MD'
## La meta description

```html
<meta name="description" content="Pains au levain et viennoiseries pur beurre, faits maison à Lyon depuis 1987.">
```

Elle est souvent affichée sous le titre dans les résultats de recherche. Elle n’améliore pas directement le classement, mais une bonne description **donne envie de cliquer**. Visez **120 à 160 caractères**, unique pour chaque page.

## Open Graph : le partage sur les réseaux

```html
<meta property="og:title" content="Boulangerie Dupain">
<meta property="og:description" content="Pains au levain faits maison à Lyon.">
<meta property="og:image" content="https://www.dupain.fr/images/partage.jpg">
<meta property="og:url" content="https://www.dupain.fr/">
<meta property="og:type" content="website">
```

Ces balises (protocole créé par Facebook, repris partout) définissent la carte affichée lors d’un partage. L’image doit utiliser une **URL absolue** (idéalement 1200×630px). Twitter/X utilise en plus `<meta name="twitter:card" content="summary_large_image">`.

## La favicon

```html
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
```

## Autres métadonnées utiles

| Balise | Rôle |
|---|---|
| `<meta name="theme-color" content="#0b0f17">` | Couleur de l’interface du navigateur mobile |
| `<link rel="canonical" href="…">` | Adresse de référence d’une page accessible par plusieurs URL |
| `<meta name="robots" content="noindex">` | Demande aux moteurs de ne pas indexer la page |

> [!INFO] Les pages privées (tableau de bord, profil) de cette plateforme utilisent `noindex` : elles n’ont aucun intérêt dans les résultats de recherche.

## L’ordre recommandé du `<head>`

1. `<meta charset>` (en premier) ;
2. `<meta name="viewport">` ;
3. `<title>` ;
4. `<meta name="description">`, canonical, Open Graph ;
5. favicon, feuilles de style.
MD,
            'syntax' => '<meta name="description" content="…">
<meta property="og:title" content="…">
<link rel="icon" href="…">',
            'example_html' => <<<'HTML'
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Atelier céramique — Cours de poterie à Nantes</title>
  <meta name="description" content="Cours de poterie pour débutants et confirmés à Nantes : tournage, modelage et émaillage en petits groupes.">
  <link rel="canonical" href="https://www.atelier-ceramique.fr/">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Atelier céramique — Cours de poterie à Nantes">
  <meta property="og:description" content="Tournage, modelage et émaillage en petits groupes.">
  <meta property="og:image" content="https://www.atelier-ceramique.fr/img/partage.jpg">
  <meta name="theme-color" content="#9a3412">
  <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>
<body>
  <h1>Atelier céramique</h1>
  <p>Cours de poterie à Nantes.</p>
</body>
</html>
HTML,
            'lines' => [
                ['<title>Atelier céramique — Cours de poterie à Nantes</title>', 'Titre descriptif : activité + lieu.'],
                ['<meta name="description" content="…">', 'Résumé de ~150 caractères pour les résultats de recherche.'],
                ['<link rel="canonical" href="…">', 'Adresse de référence de la page.'],
                ['<meta property="og:title" …>', 'Titre de la carte de partage.'],
                ['<meta property="og:image" content="https://…">', 'Image de partage, en URL absolue.'],
                ['<meta name="theme-color" …>', 'Couleur de la barre du navigateur mobile.'],
            ],
            'reference' => [
                ['meta description', 'Résumé pour les moteurs de recherche.'],
                ['og:title / og:description / og:image / og:url', 'Carte de partage (Open Graph).'],
                ['link rel="canonical"', 'URL de référence.'],
                ['meta robots', 'Instructions d’indexation (`noindex`, `nofollow`).'],
                ['link rel="icon"', 'Favicon.'],
                ['meta theme-color', 'Couleur de l’interface mobile.'],
            ],
            'mistakes' => [
                'La même description sur toutes les pages.',
                'Une image Open Graph en chemin relatif.',
                'Oublier de retirer `noindex` à la mise en ligne (le site disparaît de Google).',
                'Utiliser la balise obsolète `meta keywords` en pensant améliorer le classement.',
            ],
            'practices' => [
                'Titre et description uniques et descriptifs pour chaque page.',
                'Tester le partage avec les outils de débogage des réseaux sociaux.',
                '`noindex` sur les pages privées ou sans intérêt de recherche.',
            ],
            'practical' => 'Les CMS proposent des extensions SEO qui remplissent ces balises pour chaque page. Comprendre ce qu’elles génèrent vous permet de vérifier leur travail et de corriger une carte de partage qui affiche la mauvaise image.',
            'summary' => ['`meta description` : incite au clic.', 'Open Graph : carte de partage (image en URL absolue).', 'Canonical, robots, favicon, theme-color complètent le head.'],
            'challenge' => 'Rédigez le `<head>` complet de la page « Contact » d’un site fictif, avec toutes les balises de cette leçon.',
            'exercises' => [
                [
                    'title' => 'Compléter le head',
                    'difficulty' => 2,
                    'instructions' => 'Ajoutez dans le `<head>` une `meta description` non vide et une balise `og:title` (attribut `property`) avec un `content` non vide.',
                    'starter_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Studio Yoga Zen — Cours à Bordeaux</title>
</head>
<body>
  <h1>Studio Yoga Zen</h1>
</body>
</html>',
                    'solution_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Studio Yoga Zen — Cours à Bordeaux</title>
  <meta name="description" content="Cours de yoga pour tous niveaux au cœur de Bordeaux, en petits groupes.">
  <meta property="og:title" content="Studio Yoga Zen — Cours à Bordeaux">
</head>
<body>
  <h1>Studio Yoga Zen</h1>
</body>
</html>',
                    'rules' => [
                        ['t' => 'attr', 'sel' => 'meta[name=description]', 'attr' => 'content', 'nonempty' => true, 'msg' => 'Une meta description non vide'],
                        ['t' => 'attr', 'sel' => 'meta[property="og:title"]', 'attr' => 'content', 'nonempty' => true, 'msg' => 'Une balise og:title non vide'],
                    ],
                    'hint' => '`<meta name="description" content="…">` et `<meta property="og:title" content="…">`.',
                    'explanation' => 'La description sert aux moteurs de recherche, `og:title` au partage sur les réseaux.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quelle longueur viser pour une meta description ?', 'a' => ['20 caractères', '120 à 160 caractères', '500 caractères', 'Pas de limite'], 'c' => 1, 'e' => 'Au-delà, elle est tronquée dans les résultats.'],
                ['q' => 'À quoi servent les balises Open Graph ?', 'a' => ['À accélérer la page', 'À définir l’aperçu lors d’un partage', 'À ajouter des cookies', 'À valider le HTML'], 'c' => 1, 'e' => 'Elles contrôlent la carte de partage.'],
                ['q' => '`<meta name="robots" content="noindex">` demande aux moteurs de ne pas indexer la page.', 'tf' => true, 'c' => true, 'e' => 'Vrai.'],
            ],
        ],
        [
            'slug' => 'seo-de-base',
            'title' => 'Le référencement naturel (SEO) de base',
            'duration' => 16,
            'intro' => <<<'MD'
Le référencement naturel (*SEO, Search Engine Optimization*) regroupe tout ce qui aide une page à apparaître dans les résultats des moteurs de recherche. Pas de formule magique : un bon SEO commence par un **HTML propre**, un **contenu utile** et une **page rapide**. Bonne nouvelle : vous savez déjà faire l’essentiel.
MD,
            'objectives' => ['Connaître les facteurs SEO liés au HTML', 'Structurer titres et contenus pour le référencement', 'Comprendre sitemap.xml, robots.txt et données structurées', 'Comprendre le lien entre performance, accessibilité et SEO'],
            'prerequisites' => ['Les balises meta et le head complet', 'Le HTML sémantique'],
            'theory' => <<<'MD'
## Comment fonctionne un moteur de recherche

1. **Exploration** : des robots suivent les liens de page en page.
2. **Indexation** : ils analysent le contenu et le rangent.
3. **Classement** : pour chaque recherche, ils sélectionnent les pages les plus pertinentes et fiables.

## Les leviers HTML

| Élément | Bonne pratique |
|---|---|
| `<title>` | Unique, 50–60 caractères, mot-clé principal au début |
| `<h1>` | Un seul, clair, proche du title |
| Hiérarchie `h2`/`h3` | Structure logique du contenu |
| URL | Courte et lisible : `/cours/flexbox` plutôt que `/page.php?id=87` |
| Liens | Textes de liens descriptifs, liens internes entre pages proches |
| Images | `alt` descriptifs, noms de fichiers parlants, poids optimisé |
| Sémantique | `main`, `article`, `nav` aident à identifier le contenu principal |
| `lang` | Bonne langue déclarée |

## Le contenu d’abord

Les moteurs cherchent à satisfaire l’utilisateur. Un contenu **original, complet et qui répond à une vraie question** reste le premier facteur. Répéter un mot-clé 50 fois (*keyword stuffing*) est contre-productif et pénalisé.

## Les fichiers d’aide aux robots

- `robots.txt` (à la racine) : indique les zones à ne pas explorer (`Disallow: /admin/`) et l’adresse du sitemap ;
- `sitemap.xml` : la liste des pages à indexer, avec leur date de mise à jour.

Cette plateforme génère son `sitemap.xml` automatiquement à partir des leçons publiées.

## Les données structurées

Un bloc JSON-LD décrit précisément le contenu (cours, recette, produit, FAQ…) et peut produire des **résultats enrichis** (étoiles, prix, questions dépliables) :

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "Apprendre Flexbox",
  "description": "Maîtriser la mise en page flexible en CSS."
}
</script>
```

## Performance et accessibilité

Les moteurs mesurent la **vitesse** et la **stabilité** d’affichage (Core Web Vitals) et l’ergonomie mobile. Un site accessible et rapide est mieux classé : les bonnes pratiques vues dans ce parcours sont aussi des bonnes pratiques SEO.
MD,
            'syntax' => '<title>Mot-clé principal — Marque</title>
<h1>Titre clair</h1>
<a href="/cours/flexbox">Cours sur Flexbox</a>',
            'example_html' => <<<'HTML'
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Recette de la tarte Tatin — Cuisine facile</title>
  <meta name="description" content="La vraie recette de la tarte Tatin en 5 étapes, avec les astuces pour un caramel réussi.">
  <script type="application/ld+json">
  {"@context": "https://schema.org", "@type": "Recipe", "name": "Tarte Tatin", "totalTime": "PT1H15M"}
  </script>
</head>
<body>
  <main>
    <article>
      <h1>Recette de la tarte Tatin</h1>
      <p>Une tarte aux pommes renversée, caramélisée et fondante.</p>
      <h2>Ingrédients</h2>
      <ul><li>6 pommes</li><li>150 g de sucre</li><li>1 pâte feuilletée</li></ul>
      <h2>Préparation</h2>
      <ol><li>Préparer le caramel.</li><li>Disposer les pommes.</li><li>Couvrir de pâte et cuire 40 min.</li></ol>
      <img src="https://placehold.co/400x250/png?text=Tatin" alt="Tarte Tatin dorée démoulée sur une assiette" width="400" height="250">
      <p>Voir aussi : <a href="#">notre recette de pâte feuilletée maison</a>.</p>
    </article>
  </main>
</body>
</html>
HTML,
            'lines' => [
                ['<title>Recette de la tarte Tatin — Cuisine facile</title>', 'Mot-clé principal en tête du titre.'],
                ['<meta name="description" …>', 'Résumé qui donne envie de cliquer.'],
                ['<script type="application/ld+json">', 'Données structurées de type Recipe.'],
                ['<h1>Recette de la tarte Tatin</h1>', 'Un seul h1, cohérent avec le title.'],
                ['<h2>Ingrédients</h2> / <h2>Préparation</h2>', 'Structure logique du contenu.'],
                ['<img … alt="Tarte Tatin dorée…">', 'Texte alternatif descriptif.'],
                ['<a href="#">notre recette de pâte feuilletée maison</a>', 'Lien interne avec un texte descriptif.'],
            ],
            'reference' => [
                ['<title> / <h1>', 'Signaux principaux du sujet de la page.'],
                ['robots.txt', 'Règles d’exploration pour les robots.'],
                ['sitemap.xml', 'Liste des pages à indexer.'],
                ['JSON-LD', 'Données structurées (schema.org).'],
                ['Core Web Vitals', 'Indicateurs de performance mesurés par Google.'],
            ],
            'mistakes' => [
                'Bourrer la page de mots-clés.',
                'Des titres et descriptions dupliqués.',
                'Du texte important dans des images.',
                'Des URL illisibles.',
                'Des pages lentes (images non optimisées).',
            ],
            'practices' => [
                'Écrire pour les humains d’abord.',
                'Un HTML sémantique et valide.',
                'Des liens internes entre contenus liés.',
                'Mesurer avec Google Search Console et Lighthouse.',
            ],
            'practical' => 'Cette plateforme applique ces règles : titres uniques par leçon, descriptions générées depuis l’introduction, URL propres (`/lecon/flexbox-le-conteneur`), sitemap automatique, données structurées `Course` et `LearningResource`.',
            'summary' => ['Title, h1, structure, alt et liens sont les leviers HTML du SEO.', 'Contenu utile avant tout.', 'robots.txt, sitemap.xml et JSON-LD aident les moteurs.', 'Performance et accessibilité comptent aussi.'],
            'challenge' => 'Lancez un audit Lighthouse (onglet dans les outils de développement de Chrome) sur une page de votre choix et corrigez deux problèmes SEO signalés.',
            'exercises' => [
                [
                    'title' => 'Optimiser une page',
                    'type' => 'fix',
                    'difficulty' => 2,
                    'instructions' => 'Cette page a trois problèmes SEO : le `<title>` est « Page 1 », il y a deux `<h1>`, et l’image n’a pas de `alt`. Corrigez-les : un title contenant **Randonnée**, un seul `<h1>` (transformez le second en `<h2>`), et un `alt` descriptif.',
                    'starter_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Page 1</title>
</head>
<body>
  <h1>Randonnée au lac Blanc</h1>
  <h1>Itinéraire</h1>
  <img src="https://placehold.co/300x200/png" width="300" height="200">
</body>
</html>',
                    'solution_html' => '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Randonnée au lac Blanc — Itinéraire et conseils</title>
</head>
<body>
  <h1>Randonnée au lac Blanc</h1>
  <h2>Itinéraire</h2>
  <img src="https://placehold.co/300x200/png" width="300" height="200" alt="Lac Blanc entouré de montagnes enneigées">
</body>
</html>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'title', 'contains' => 'Randonnée', 'msg' => 'Le title contient « Randonnée »'],
                        ['t' => 'el', 'sel' => 'h1', 'count' => 1, 'msg' => 'Un seul h1'],
                        ['t' => 'el', 'sel' => 'h2', 'text' => 'Itinéraire', 'msg' => '« Itinéraire » est un h2'],
                        ['t' => 'attr', 'sel' => 'img', 'attr' => 'alt', 'nonempty' => true, 'msg' => 'L’image a un alt descriptif'],
                    ],
                    'hint' => 'Trois modifications indépendantes.',
                    'explanation' => 'Un title descriptif, une hiérarchie de titres propre et des alt pertinents sont les bases du SEO on-page.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel est le premier facteur de référencement ?', 'a' => ['Le nombre de mots-clés', 'Un contenu utile et de qualité', 'La couleur du site', 'La meta keywords'], 'c' => 1, 'e' => 'Les moteurs cherchent à satisfaire l’utilisateur.'],
                ['q' => 'Quel fichier liste les pages à indexer ?', 'a' => ['`robots.txt`', '`sitemap.xml`', '`index.html`', '`seo.json`'], 'c' => 1, 'e' => '`sitemap.xml`.'],
                ['q' => 'Un site accessible et rapide est généralement mieux référencé.', 'tf' => true, 'c' => true, 'e' => 'Vrai : ce sont des signaux de qualité.'],
            ],
        ],
    ],
];
