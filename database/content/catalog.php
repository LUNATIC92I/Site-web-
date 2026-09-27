<?php
/**
 * Plan du parcours : catégories, cours (par niveau) et liste ordonnée des modules.
 * Chaque module est décrit dans son propre fichier (database/content/html|css/*.php).
 */

return [
    'categories' => [
        ['slug' => 'html', 'name' => 'HTML', 'color' => '#ff8a4c', 'description' => 'Le langage de structure des pages web.'],
        ['slug' => 'css', 'name' => 'CSS', 'color' => '#5aa9ff', 'description' => 'Le langage de mise en forme et de mise en page.'],
    ],
    'courses' => [
        [
            'slug' => 'html-fondations', 'category' => 'html', 'level' => 1,
            'title' => 'HTML — Les fondations',
            'summary' => 'Comprendre le Web, structurer une page, écrire des titres, des paragraphes, mettre en forme du texte et créer des liens.',
            'description' => "Ce premier cours part de zéro. Vous découvrirez ce qu’est réellement une page web, comment le navigateur l’interprète, puis vous écrirez vos premières balises.\n\nÀ la fin du cours, vous saurez créer une page HTML complète et valide, avec du texte structuré et des liens.",
            'modules' => ['html/01-decouvrir', 'html/02-structure', 'html/03-titres-paragraphes', 'html/04-texte', 'html/05-liens'],
        ],
        [
            'slug' => 'css-fondations', 'category' => 'css', 'level' => 1,
            'title' => 'CSS — Les fondations',
            'summary' => 'Syntaxe, sélecteurs, cascade, couleurs, typographie, unités et modèle de boîte : les bases indispensables du style.',
            'description' => "Une fois la structure HTML maîtrisée, place à l’apparence. Ce cours explique comment le navigateur applique les styles, comment cibler précisément les éléments et comment chaque élément occupe l’espace grâce au modèle de boîte.",
            'modules' => ['css/01-decouvrir', 'css/02-selecteurs', 'css/03-couleurs', 'css/04-typographie', 'css/05-box-model'],
        ],
        [
            'slug' => 'html-contenus-formulaires', 'category' => 'html', 'level' => 2,
            'title' => 'HTML — Contenus et formulaires',
            'summary' => 'Images, listes, tableaux, formulaires complets, attributs globaux, classes et identifiants.',
            'description' => "Ce cours vous apprend à intégrer tous les types de contenus d’une vraie interface : images optimisées, listes, tableaux de données et formulaires accessibles avec validation native.",
            'modules' => ['html/06-images', 'html/07-listes', 'html/08-tableaux', 'html/09-formulaires', 'html/10-attributs'],
        ],
        [
            'slug' => 'css-mise-en-page', 'category' => 'css', 'level' => 2,
            'title' => 'CSS — Mise en page et interfaces',
            'summary' => 'Display, positionnement, Flexbox, Grid, pseudo-classes et pseudo-éléments pour construire de vraies interfaces.',
            'description' => "Place à la mise en page moderne. Vous apprendrez à placer les éléments exactement où vous le souhaitez avec Flexbox et Grid, et à rendre vos interfaces interactives avec les pseudo-classes.",
            'modules' => ['css/06-display', 'css/07-position', 'css/08-flexbox', 'css/09-grid', 'css/10-pseudo'],
        ],
        [
            'slug' => 'html-semantique-qualite', 'category' => 'html', 'level' => 3,
            'title' => 'HTML — Sémantique, médias et qualité',
            'summary' => 'HTML sémantique, audio, vidéo, iframe, métadonnées, SEO, accessibilité et bonnes pratiques professionnelles.',
            'description' => "Le niveau avancé transforme vos pages en documents professionnels : bien structurés pour les moteurs de recherche, accessibles à tous et faciles à maintenir.",
            'modules' => ['html/11-semantique', 'html/12-medias', 'html/13-seo', 'html/14-accessibilite', 'html/15-bonnes-pratiques'],
        ],
        [
            'slug' => 'css-responsive-animations', 'category' => 'css', 'level' => 3,
            'title' => 'CSS — Responsive, animations et architecture',
            'summary' => 'Responsive design, media queries, transitions, animations, effets visuels, variables CSS et architecture.',
            'description' => "Le dernier cours vous donne les outils des intégrateurs professionnels : des interfaces qui s’adaptent à tous les écrans, des animations soignées et une feuille de style organisée pour durer.",
            'modules' => ['css/11-responsive', 'css/12-animations', 'css/13-effets', 'css/14-variables', 'css/15-interfaces'],
        ],
    ],
];
