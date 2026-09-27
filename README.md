# HTML & CSS Academy

Plateforme e-learning complète pour apprendre **HTML et CSS** de zéro jusqu’à un niveau avancé : cours structurés, éditeur de code interactif, exercices corrigés automatiquement, quiz, projets pratiques, badges, classement, certificat et espace d’administration.

Stack : **HTML5, CSS3, JavaScript vanilla, PHP 8.1+ (PDO), MySQL / MariaDB**. Aucun framework (ni React, ni Laravel, ni Bootstrap, ni Tailwind), aucune dépendance à installer.

---

## Sommaire

1. [Fonctionnalités](#fonctionnalités)
2. [Contenu pédagogique](#contenu-pédagogique)
3. [Architecture du projet](#architecture-du-projet)
4. [Installation pas à pas](#installation-pas-à-pas)
5. [Comptes de démonstration](#comptes-de-démonstration)
6. [Configuration](#configuration)
7. [Gérer le contenu](#gérer-le-contenu)
8. [Règles de correction automatique](#règles-de-correction-automatique)
9. [Sécurité](#sécurité)
10. [Tests](#tests)
11. [Mise en production](#mise-en-production)
12. [Dépannage](#dépannage)

---

## Fonctionnalités

**Apprenant**

- Inscription, connexion (« rester connecté »), déconnexion, mot de passe oublié / réinitialisation.
- Catalogue de 6 cours sur 3 niveaux (Débutant, Intermédiaire, Avancé), recherche de leçons.
- Leçons en 16 sections : introduction, objectifs et prérequis, théorie, exemple simple, exemple détaillé **modifiable en direct**, explication ligne par ligne, balises/propriétés expliquées, erreurs fréquentes, bonnes pratiques, exemple pratique, exercice, quiz, correction, résumé, challenge final, validation du chapitre.
- **Éditeur HTML/CSS** : coloration syntaxique, numéros de ligne, indentation au clavier, aperçu live dans une iframe sandboxée, boutons Exécuter / Réinitialiser / Copier / Agrandir / Afficher-Masquer l’aperçu, brouillon sauvegardé dans le navigateur.
- 5 types d’exercices : pratique, compléter le code, corriger le code, QCM, vrai/faux — **corrigés côté serveur** avec un retour critère par critère.
- Quiz de fin de leçon (70 % requis pour valider le chapitre) avec explication de chaque réponse.
- Tableau de bord : progression globale/HTML/CSS, cours terminés, exercices et quiz réussis, score moyen, badges, activité récente, prochain cours recommandé.
- 4 projets pratiques (page personnelle, landing page, portfolio, site professionnel responsive) avec consignes, étapes, ressources, critères, vérification automatique, solution débloquée après validation et challenge bonus.
- 13 badges attribués automatiquement, classement des apprenants.
- **Certificat** « Parcours HTML & CSS terminé » (nom, date, niveau, identifiant unique, score final) vérifiable publiquement : `/certificate.php?id=XXXX` ou `/certificat/XXXX`, imprimable en PDF.
- Terrain de jeu libre (`/editeur`).

**Administrateur**

- Dashboard : utilisateurs, cours, cours terminés, exercices réalisés, taux de réussite, activité récente, projets à relire.
- CRUD complet : cours, modules, leçons (toutes les sections), exercices (règles JSON, QCM), questions de quiz, projets, badges.
- Gestion des utilisateurs (recherche, rôle, désactivation, suppression) et consultation de la progression de chaque apprenant.
- Revue des projets soumis (aperçu sandboxé, approbation, retour écrit).
- Statistiques (inscriptions et leçons terminées sur 30 jours, progression par leçon, exercices les plus difficiles, badges).
- Paramètres (nom du site, description SEO, navigation libre ou progressive, affichage des comptes de démo).

**Transverse** : design sombre original, responsive (320 px → 1440 px+), animations respectant `prefers-reduced-motion` + interrupteur « Réduire les animations », accessibilité (sémantique, labels, focus visible, lien d’évitement, ARIA), SEO (title/description/Open Graph par page, URLs propres, `sitemap.xml` dynamique, `robots.txt`, données structurées JSON-LD).

## Contenu pédagogique

| | Modules | Leçons | Exercices | Questions de quiz |
|---|---|---|---|---|
| HTML | 15 | 36 | 53 | 114 |
| CSS | 15 | 39 | 55 | 122 |
| **Total** | **30** | **75** | **108** | **236** |

Les 108 exercices comprennent 21 QCM / Vrai-Faux, soit 257 questions au total.

- **Niveau 1** — *HTML : les fondations* (découvrir le HTML, structure d’une page, titres et paragraphes, mise en forme du texte, liens) et *CSS : les fondations* (découvrir le CSS, sélecteurs et cascade, couleurs et arrière-plans, typographie et unités, box model).
- **Niveau 2** — *HTML : contenus et formulaires* (images, listes, tableaux, formulaires, attributs/classes/id) et *CSS : mise en page* (display, positionnement, Flexbox, Grid, pseudo-classes et pseudo-éléments).
- **Niveau 3** — *HTML : sémantique, médias et qualité* (sémantique, audio/vidéo/iframe, métadonnées et SEO, accessibilité, bonnes pratiques et validation) et *CSS : responsive, animations, architecture* (responsive et media queries, transitions/transform/keyframes, ombres et dégradés, variables et organisation, composants et performance).

## Architecture du projet

```text
/
├── index.php                 Page d’accueil (landing)
├── parcours.php              Parcours en 3 niveaux
├── leaderboard.php           Classement
├── playground.php            Éditeur libre
├── certificate.php           Certificat (?id=XXXX)
├── sitemap.php               sitemap.xml dynamique
├── 404.php  robots.txt  .htaccess  router.php (serveur PHP intégré)
├── admin/                    Dashboard, users, courses, lessons, exercises, quizzes,
│                             projects, badges, statistics, settings
├── api/                      progress.php, exercises.php, quiz.php (JSON + CSRF)
├── assets/
│   ├── css/                  main.css (design system), admin.css
│   ├── js/                   app.js, editor.js, lesson.js, exercise.js, project.js, admin.js
│   ├── icons/sprite.svg      Icônes SVG
│   └── images/               favicon, image Open Graph
├── auth/                     login, register, logout, forgot-password, reset-password
├── config/                   config.php, database.php, local.example.php
├── courses/                  index.php (catalogue), course.php, lesson.php
├── dashboard/                index.php, progress.php, badges.php, profile.php
├── database/
│   ├── database.sql          Schéma (21 tables, clés étrangères, index, contraintes)
│   ├── seed.sql              Données (généré)
│   ├── build-seed.php        Générateur de seed.sql + contrôle qualité des exercices
│   ├── create-admin.php      Création d’un administrateur en ligne de commande
│   └── content/              Contenu pédagogique (1 fichier par module)
├── exercises/                index.php, exercise.php, submit.php (sans JavaScript)
├── includes/
│   ├── bootstrap.php         Point d’entrée commun (config, session, erreurs, autoload)
│   ├── functions.php  security.php  auth.php  admin.php
│   ├── header.php  navbar.php  footer.php  error-page.php
│   ├── partials/             editor, exercise-widget, field, progress-bar, dash-nav
│   └── classes/              Database (PDO), modèles (User, Course, Lesson, Exercise,
│                             Quiz, Progress, Project, Certificate, Stats, Setting,
│                             Activity), BadgeService, CodeChecker, Markdown,
│                             Validator, Mailer, Logger
├── projects/                 index.php, project.php, submit.php
├── storage/logs/             app.log, mail.log (non publics)
└── tests/e2e.sh              Tests de bout en bout
```

Principes : toute la logique SQL est dans les classes de `includes/classes/` (aucune requête dispersée dans les pages), les pages ne font qu’orchestrer et afficher, tout affichage passe par `e()` (échappement), toutes les requêtes sont préparées.

## Installation pas à pas

### 1. Installer PHP (8.1 minimum, 8.3+ recommandé)

Extensions nécessaires : `pdo_mysql`, `mbstring`, `dom` (libxml), `intl` recommandé.

- **Windows** : installer [XAMPP](https://www.apachefriends.org/) (Apache + PHP + MariaDB) ou [Laragon](https://laragon.org/).
- **macOS** : `brew install php`.
- **Debian/Ubuntu** : `sudo apt install php php-mysql php-mbstring php-xml php-intl`.

Vérifier : `php -v` et `php -m | grep -E "pdo_mysql|mbstring|dom"`.

### 2. Installer MySQL ou MariaDB

MySQL 8.0+ ou MariaDB 10.4+ (inclus dans XAMPP/Laragon). Sous Linux : `sudo apt install mariadb-server`.

### 3. Créer la base de données et un utilisateur dédié

```sql
CREATE DATABASE html_css_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'academy'@'localhost' IDENTIFIED BY 'un-mot-de-passe-solide';
GRANT ALL PRIVILEGES ON html_css_academy.* TO 'academy'@'localhost';
FLUSH PRIVILEGES;
```

### 4. Importer le schéma

```bash
mysql -u root -p < database/database.sql
```

> ⚠️ `database.sql` supprime puis recrée les tables : ne le relancez pas sur une base de production contenant des données.

(Avec phpMyAdmin : onglet *Importer* → `database/database.sql`.)

### 5. Importer les données initiales

```bash
mysql -u root -p < database/seed.sql
```

Le seed contient le parcours complet, les badges, les projets, les paramètres et des comptes de démonstration.

### 6. Configurer la connexion (`config/database.php`)

Ne modifiez pas les fichiers versionnés : copiez l’exemple local, **ignoré par Git**.

```bash
cp config/local.example.php config/local.php
```

puis renseignez la section `database` (hôte, port, nom, utilisateur, mot de passe) et `app.url`. Alternative : variables d’environnement `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`, `DB_SOCKET`, `APP_URL`, `APP_ENV`, `APP_DEBUG`.

### 7. Configurer Apache

- Activer `mod_rewrite` (et idéalement `mod_headers`, `mod_deflate`, `mod_expires`) : `sudo a2enmod rewrite headers deflate expires`.
- Autoriser le `.htaccess` fourni : `AllowOverride All` sur le dossier du projet.

```apache
<VirtualHost *:80>
    ServerName academy.local
    DocumentRoot /var/www/html-css-academy
    <Directory /var/www/html-css-academy>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

- Si le projet est dans un **sous-dossier** (ex. `http://localhost/html-css-academy/`), décommentez `RewriteBase` dans `.htaccess` ; le chemin de base est détecté automatiquement (sinon, réglez `app.base_path`).
- Sans `mod_rewrite` : mettez `'pretty_urls' => false` dans `config/local.php` (les liens pointeront directement vers les fichiers PHP).
- Nginx : reproduisez les règles de `.htaccess` (voir `router.php`) et interdisez `config/`, `includes/`, `database/`, `storage/`.

Le dossier `storage/logs/` doit être accessible en écriture par le serveur web.

### 8. Lancer le projet

- Avec Apache : ouvrez `http://academy.local` (ou `http://localhost/html-css-academy/`).
- Sans Apache, avec le serveur intégré de PHP (développement) :

```bash
php -S localhost:8000 router.php
```

puis ouvrez <http://localhost:8000>.

### 9. Créer le compte administrateur

Le seed fournit un administrateur **de démonstration**. Pour créer votre propre administrateur (le mot de passe est demandé en ligne de commande, jamais stocké en clair) :

```bash
php database/create-admin.php
```

Un administrateur peut aussi promouvoir un utilisateur existant depuis **Admin → Utilisateurs → Rendre admin**.

### 10. Configuration de production

Voir [Mise en production](#mise-en-production).

## Comptes de démonstration

| Rôle | E-mail | Mot de passe |
|---|---|---|
| Administrateur | `admin@academy.test` | `Admin@2026!` |
| Apprenante (9 leçons, badges) | `demo@academy.test` | `Demo@2026!` |
| Autres apprenants | `karim@`, `sofia@`, `tom@academy.test` | `Demo@2026!` |

Ces mots de passe n’existent **que sous forme de hash** dans `seed.sql`. Ils sont publics : **supprimez ces comptes avant toute mise en ligne** (voir ci-dessous) et désactivez « Afficher les comptes de démonstration » dans *Admin → Paramètres*.

## Configuration

Principales options (`config/config.php`, surchargées par `config/local.php` ou l’environnement) :

| Clé | Rôle | Défaut |
|---|---|---|
| `app.env` / `APP_ENV` | `development` ou `production` | `production` |
| `app.debug` / `APP_DEBUG` | Affiche le détail des erreurs (jamais en production) | `false` |
| `app.url` / `APP_URL` | URL absolue (sitemap, e-mails, Open Graph) | auto |
| `app.base_path` | Sous-dossier d’installation | auto |
| `app.pretty_urls` | URLs propres (`/lecon/…`) | `true` |
| `security.login_max_attempts` / `login_window_minutes` | Anti brute-force | 5 / 15 min |
| `security.remember_days` | Durée « rester connecté » | 30 |
| `mail.driver` | `log` (écrit dans `storage/logs/mail.log`) ou `mail` (fonction `mail()`) | `log` |
| `learning.quiz_pass_percentage` | Seuil de réussite des quiz | 70 |

**E-mails** : la classe `includes/classes/Mailer.php` isole l’envoi. Pour un fournisseur SMTP ou une API transactionnelle, ajoutez un cas dans `Mailer::send()`. En développement (`driver=log`), le lien de réinitialisation est aussi affiché à l’écran.

## Gérer le contenu

Deux façons complémentaires :

1. **Depuis l’administration** (recommandé pour les modifications) : chaque section d’une leçon a son champ. Les listes s’écrivent « un élément par ligne », les explications ligne par ligne « `code ||| explication` ». Les textes acceptent un Markdown restreint et **sûr** (tout HTML saisi est échappé) : `## titre`, `**gras**`, `*italique*`, `` `code` ``, listes, blocs ```` ```html ````, encadrés `> [!TIP]` / `> [!WARN]` / `> [!INFO]`, tableaux `| a | b |`.
2. **Depuis les fichiers** `database/content/` (idéal pour versionner un parcours complet) : un fichier PHP par module, déclaré dans `catalog.php`. Puis :

```bash
php database/build-seed.php     # régénère database/seed.sql
```

Le générateur **vérifie chaque exercice** : la solution doit valider toutes ses règles, sinon la génération échoue ; un avertissement est affiché si le code de départ les valide déjà.

## Règles de correction automatique

Les exercices de code et les projets sont corrigés côté serveur par `CodeChecker` (analyse DOM du HTML + analyse du CSS, y compris dans les `<style>` et les `@media`). Les règles sont un tableau JSON :

| Type | Vérifie | Options |
|---|---|---|
| `el` | un élément correspond au sélecteur | `sel`, `text` (exact), `contains`, `min`, `max`, `count` |
| `noel` | aucun élément ne correspond | `sel` |
| `attr` | un attribut | `sel`, `attr`, `value`, `contains`, `nonempty` |
| `css` | une déclaration CSS | `sel` (facultatif), `prop`, `value` / `in` / `contains` (`|` pour des alternatives) |
| `contains` / `absent` | présence / absence d’un texte dans le code | `s`, `in` (`html`/`css`), `ci` |
| `match` | expression régulière sur le code | `re`, `in` |

Chaque règle peut avoir un `msg` affiché à l’apprenant. Exemple :

```json
[
  {"t": "el", "sel": "h1", "text": "Bienvenue", "msg": "Un titre h1 contient « Bienvenue »"},
  {"t": "attr", "sel": "img", "attr": "alt", "nonempty": true},
  {"t": "css", "sel": ".btn", "prop": "border-radius"}
]
```

Sélecteurs supportés : balise, `.classe`, `#id`, `[attr]`, `[attr=val]`, `[attr^=val]`, `[attr*=val]`, descendant, `>`, `:first-child`, `:last-child`, listes `a, b`.

## Sécurité

- **SQL** : PDO, requêtes préparées exclusivement, `ATTR_EMULATE_PREPARES=false`, noms de colonnes jamais issus de l’utilisateur.
- **Mots de passe** : `password_hash()` / `password_verify()` (re-hash automatique), règles de robustesse, temps de réponse constant sur les e-mails inconnus.
- **CSRF** : jeton de session sur tous les formulaires POST et en-tête `X-CSRF-Token` sur l’API ; déconnexion uniquement en POST.
- **XSS** : échappement systématique `e()`, Markdown qui échappe avant de formater, en-tête **Content-Security-Policy** (`script-src 'self'`, aucun script inline), aperçus de code dans des iframes `sandbox` sans scripts.
- **Sessions** : cookies `HttpOnly`, `SameSite=Lax`, `Secure` en HTTPS, `use_strict_mode`, `session_regenerate_id()` à la connexion et périodiquement, expiration après inactivité.
- **« Rester connecté »** : jetons *selector/validator* (seul le hash est stocké), rotation à chaque usage, révocation au changement de mot de passe.
- **Réinitialisation** : jeton aléatoire hashé, usage unique, expiration 60 min, message identique que le compte existe ou non.
- **Brute-force** : 5 échecs / 15 min par e-mail (et plafond par IP), limitation des soumissions d’exercices, quiz, inscriptions.
- **Accès** : contrôle des rôles (`require_admin()`), protection IDOR (identifiant de l’utilisateur toujours pris dans la session, réponses de quiz vérifiées par question, questions d’admin rattachées à leur leçon), un administrateur ne peut pas se rétrograder ni se supprimer.
- **Erreurs** : jamais d’erreur SQL affichée ; journalisation dans `storage/logs/app.log`, page d’erreur générique.
- **Serveur** : `config/`, `includes/`, `database/`, `storage/` interdits par `.htaccess`, en-têtes `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`, `Permissions-Policy`, HSTS en HTTPS, redirections internes uniquement.

## Tests

`tests/e2e.sh` exécute 60 vérifications de bout en bout (inscription, validation, XSS, CSRF, API, quiz, exercices, badges, projets, déconnexion, limitation des tentatives, droits admin, réinitialisation de mot de passe, certificat, CRUD d’administration). **Il modifie la base : à lancer uniquement en développement**, puis réimporter le seed.

```bash
php -S localhost:8000 router.php &
BASE=http://localhost:8000 DB="mysql -uroot html_css_academy" bash tests/e2e.sh
mysql -uroot < database/database.sql && mysql -uroot < database/seed.sql
```

Vérifications réalisées pendant le développement : les ≈200 pages publiques répondent sans erreur ni avertissement PHP, aucun défilement horizontal de 320 à 1440 px, aucune erreur JavaScript, éditeur/exercices/quiz testés dans Chromium.

## Mise en production

1. **HTTPS** obligatoire (Let’s Encrypt) ; les cookies passent automatiquement en `Secure`.
2. `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://votre-domaine.fr`.
3. Utilisateur MySQL dédié avec un mot de passe fort (jamais `root`), identifiants dans l’environnement ou `config/local.php` (droits de lecture restreints).
4. Supprimer les comptes de démonstration puis créer votre administrateur :
   ```sql
   DELETE FROM users WHERE email LIKE '%@academy.test';
   ```
   ```bash
   php database/create-admin.php
   ```
5. *Admin → Paramètres* : décocher « Afficher les comptes de démonstration », renseigner nom et description du site.
6. Mettre l’URL absolue du sitemap dans `robots.txt` (`Sitemap: https://votre-domaine.fr/sitemap.xml`).
7. Configurer un vrai envoi d’e-mails (`MAIL_DRIVER=mail` ou driver SMTP ajouté dans `Mailer`).
8. Vérifier que `storage/logs/` est inscriptible et non accessible depuis le Web ; mettre en place la rotation des journaux.
9. Sauvegardes régulières de la base (`mysqldump`).
10. Supprimer `router.php` et `tests/` du serveur (inutiles en production).

## Dépannage

| Symptôme | Solution |
|---|---|
| Page « Une erreur est survenue » | Consulter `storage/logs/app.log` ; activer temporairement `APP_DEBUG=true` en local. |
| Erreur 404 sur `/cours`, `/lecon/…` | `mod_rewrite` inactif ou `AllowOverride None` → l’activer, ou `pretty_urls => false`. |
| Styles absents dans un sous-dossier | Vérifier `RewriteBase` et `app.base_path`. |
| « could not find driver » | Installer/activer l’extension `pdo_mysql`. |
| Accents mal affichés | Base et tables en `utf8mb4` (créées ainsi par `database.sql`). |
| E-mails non reçus | Driver `log` par défaut : voir `storage/logs/mail.log`. |
| Trop de tentatives de connexion | Attendre 15 minutes ou vider la table `login_attempts`. |

---

Projet pédagogique. Les exemples de code des leçons sont libres de réutilisation.
