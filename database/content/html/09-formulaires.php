<?php
return [
    'slug' => 'html-formulaires',
    'title' => 'Les formulaires',
    'description' => 'Recueillir des informations : form, input, types de champs, labels, listes, zones de texte, boutons et validation native.',
    'lessons' => [
        [
            'slug' => 'form-et-input',
            'title' => 'L’élément form et les champs de saisie',
            'duration' => 15,
            'intro' => <<<'MD'
Inscription, connexion, recherche, commande, contact : les formulaires sont le principal moyen d’**interaction** entre un site et ses visiteurs. Un formulaire mal conçu fait perdre des clients ; un formulaire bien construit est rapide à remplir, accessible et fiable.
MD,
            'objectives' => ['Créer un formulaire avec `<form>`', 'Comprendre `action`, `method` et `name`', 'Créer des champs `<input>`', 'Associer un `<label>` à chaque champ'],
            'prerequisites' => ['Les tableaux', 'Les liens'],
            'theory' => <<<'MD'
## L’élément `<form>`

```html
<form action="/inscription" method="post">
  …champs…
</form>
```

- `action` : l’adresse (un script côté serveur, par exemple en PHP) qui **reçoit** les données ;
- `method` : comment les envoyer :
  - `get` : les données sont ajoutées à l’URL (`?q=chat`). Pour les **recherches** et filtres ;
  - `post` : les données sont envoyées dans le corps de la requête. Pour tout ce qui **modifie** des données ou contient des informations sensibles (mot de passe).

> [!INFO] HTML ne traite pas les données : il les envoie. Le traitement (enregistrement en base, envoi d’e-mail) est le rôle d’un langage serveur comme PHP.

## Le champ `<input>`

```html
<input type="text" id="prenom" name="prenom">
```

- `type` : le type de champ (texte, e-mail, mot de passe… voir leçon suivante) ;
- `name` : le **nom de la donnée** envoyée au serveur (`prenom=Léa`). **Sans `name`, le champ n’est pas envoyé !**
- `id` : identifiant unique, utilisé par le label ;
- `value` : valeur par défaut ;
- `placeholder` : texte d’exemple affiché dans le champ vide.

## Le `<label>` : indispensable

Chaque champ doit avoir une **étiquette visible** reliée au champ :

```html
<label for="email">Adresse e-mail</label>
<input type="email" id="email" name="email">
```

L’attribut `for` du label reprend l’`id` du champ. Bénéfices :

- le lecteur d’écran annonce « Adresse e-mail, champ de saisie » ;
- cliquer sur le texte du label place le curseur dans le champ (zone de clic plus grande, précieuse sur mobile et pour les cases à cocher).

> [!WARN] Le `placeholder` ne remplace **jamais** un label : il disparaît dès que l’on tape, il est souvent peu contrasté et mal lu par certaines technologies d’assistance.

## Le bouton d’envoi

```html
<button type="submit">S’inscrire</button>
```
MD,
            'syntax' => '<form action="…" method="post">
  <label for="id">Libellé</label>
  <input type="text" id="id" name="nom">
  <button type="submit">Envoyer</button>
</form>',
            'example_html' => <<<'HTML'
<form action="/newsletter" method="post">
  <h2>Inscription à la newsletter</h2>

  <label for="prenom">Prénom</label>
  <input type="text" id="prenom" name="prenom" autocomplete="given-name">

  <label for="email">Adresse e-mail</label>
  <input type="email" id="email" name="email" placeholder="exemple@domaine.fr" autocomplete="email">

  <button type="submit">Je m’inscris</button>
</form>
HTML,
            'example_css' => <<<'CSS'
form {
  display: flex;
  flex-direction: column;
  gap: 6px;
  max-width: 320px;
  font-family: system-ui, sans-serif;
}

input {
  padding: 8px;
  border: 1px solid #94a3b8;
  border-radius: 6px;
  margin-bottom: 8px;
}

button {
  padding: 10px;
  border: 0;
  border-radius: 6px;
  background: #4f46e5;
  color: white;
  font-weight: bold;
}
CSS,
            'lines' => [
                ['<form action="/newsletter" method="post">', 'Les données seront envoyées en POST à l’adresse /newsletter.'],
                ['<label for="prenom">Prénom</label>', 'Étiquette reliée au champ d’`id="prenom"`.'],
                ['<input type="text" id="prenom" name="prenom" …>', '`name` = nom de la donnée envoyée ; `autocomplete` aide le navigateur à préremplir.'],
                ['<input type="email" … placeholder="…">', 'Le placeholder montre un exemple, en complément du label.'],
                ['<button type="submit">', 'Bouton qui envoie le formulaire.'],
            ],
            'reference' => [
                ['<form>', 'Formulaire. Attributs `action` et `method`.'],
                ['<input>', 'Champ de saisie (élément vide).'],
                ['name', 'Nom de la donnée envoyée au serveur.'],
                ['<label for="…">', 'Étiquette associée à un champ.'],
                ['placeholder', 'Exemple affiché dans le champ vide.'],
                ['autocomplete', 'Aide au remplissage automatique.'],
            ],
            'mistakes' => [
                'Oublier `name` : la donnée n’est pas envoyée.',
                'Utiliser un placeholder comme seul libellé.',
                'Un `for` qui ne correspond à aucun `id`.',
                'Envoyer un mot de passe en `method="get"` (il apparaît dans l’URL et l’historique).',
            ],
            'practices' => [
                'Un label visible pour chaque champ.',
                '`method="post"` pour les données sensibles ou modifiantes.',
                'Des attributs `autocomplete` pour faciliter la saisie.',
                'Demander uniquement les informations nécessaires.',
            ],
            'practical' => 'Sur cette plateforme, la page d’inscription est un `<form method="post">` : chaque champ a un `<label>`, un `name` et un `autocomplete`. Côté serveur, PHP lit `$_POST[\'email\']`, valide la valeur et crée le compte.',
            'summary' => ['`<form action method>` envoie les données.', '`name` est indispensable pour l’envoi.', 'Chaque champ a un `<label for>` relié à son `id`.', 'GET pour chercher, POST pour modifier.'],
            'challenge' => 'Créez un formulaire de recherche en `method="get"` avec un champ `name="q"`. Soumettez-le et observez l’URL.',
            'exercises' => [
                [
                    'title' => 'Un champ bien étiqueté',
                    'difficulty' => 1,
                    'instructions' => 'Dans le formulaire, ajoutez un `<label>` **Ville** relié (avec `for`) à un champ texte d’`id` `ville` et de `name` `ville`.',
                    'starter_html' => '<form action="/meteo" method="get">

  <button type="submit">Voir la météo</button>
</form>',
                    'solution_html' => '<form action="/meteo" method="get">
  <label for="ville">Ville</label>
  <input type="text" id="ville" name="ville">
  <button type="submit">Voir la météo</button>
</form>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'form label[for=ville]', 'text' => 'Ville', 'msg' => 'Un label « Ville » avec for="ville"'],
                        ['t' => 'el', 'sel' => 'form input#ville', 'msg' => 'Un champ avec id="ville"'],
                        ['t' => 'attr', 'sel' => 'input#ville', 'attr' => 'name', 'value' => 'ville', 'msg' => 'Le champ a name="ville"'],
                    ],
                    'hint' => 'Le `for` du label et l’`id` du champ doivent être identiques.',
                    'explanation' => 'Le label relié par `for`/`id` rend le champ accessible ; `name` permet l’envoi de la donnée.',
                ],
                [
                    'title' => 'GET ou POST ?',
                    'type' => 'qcm',
                    'instructions' => 'Choisissez la bonne réponse.',
                    'question' => 'Quelle méthode pour un formulaire de connexion (e-mail + mot de passe) ?',
                    'answers' => ['`get`', '`post`', 'Peu importe', '`put`'],
                    'correct' => 1,
                    'explanation' => 'POST : le mot de passe ne doit pas apparaître dans l’URL.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel attribut détermine le nom de la donnée envoyée ?', 'a' => ['`id`', '`name`', '`value`', '`label`'], 'c' => 1, 'e' => '`name` : sans lui, le champ n’est pas envoyé.'],
                ['q' => 'Comment relier un label à un champ ?', 'a' => ['`for` du label = `name` du champ', '`for` du label = `id` du champ', '`id` du label = `id` du champ', 'Ce n’est pas possible'], 'c' => 1, 'e' => 'L’attribut `for` reprend l’`id` du champ.'],
                ['q' => 'Le placeholder peut remplacer le label.', 'tf' => true, 'c' => false, 'e' => 'Faux : il disparaît à la saisie et n’est pas fiable pour l’accessibilité.'],
            ],
        ],
        [
            'slug' => 'types-de-champs',
            'title' => 'Les types de champs',
            'duration' => 16,
            'intro' => <<<'MD'
Sur mobile, un champ `type="email"` affiche un clavier avec le « @ », un champ `type="tel"` un pavé numérique. Choisir le bon type, c’est offrir la bonne interface **gratuitement** et bénéficier de la validation du navigateur.
MD,
            'objectives' => ['Utiliser les types email, password, number, tel, url, date, search', 'Créer des cases à cocher et des boutons radio', 'Grouper des champs avec `<fieldset>` et `<legend>`'],
            'prerequisites' => ['L’élément form et les champs de saisie'],
            'theory' => <<<'MD'
## Les principaux types

| Type | Usage | Bonus |
|---|---|---|
| `text` | Texte court | — |
| `email` | Adresse e-mail | Clavier @, vérification du format |
| `password` | Mot de passe | Caractères masqués |
| `number` | Nombre | Flèches, `min`, `max`, `step` |
| `tel` | Téléphone | Pavé numérique mobile |
| `url` | Adresse web | Vérification du format |
| `date`, `time` | Date, heure | Sélecteur natif |
| `search` | Recherche | Bouton d’effacement |
| `range` | Curseur | `min`, `max` |
| `color` | Couleur | Sélecteur de couleur |
| `file` | Fichier | Explorateur de fichiers |

## Cases à cocher : `checkbox`

Pour des choix **indépendants** (zéro, un ou plusieurs) :

```html
<input type="checkbox" id="news" name="newsletter" value="oui">
<label for="news">Recevoir la newsletter</label>
```

`checked` coche la case par défaut.

## Boutons radio : `radio`

Pour **un seul choix** parmi plusieurs. Les boutons d’un même groupe partagent le **même `name`** :

```html
<input type="radio" id="petit" name="taille" value="S">
<label for="petit">Petit</label>
<input type="radio" id="moyen" name="taille" value="M">
<label for="moyen">Moyen</label>
```

`value` est la donnée envoyée (`taille=M`).

## Grouper : `<fieldset>` et `<legend>`

Un groupe de radios ou de cases doit être entouré d’un `<fieldset>` avec une `<legend>` qui pose la question :

```html
<fieldset>
  <legend>Taille du café</legend>
  …boutons radio…
</fieldset>
```

Le lecteur d’écran annonce alors « Taille du café, groupe — Petit, bouton radio ».
MD,
            'syntax' => '<input type="email" …>
<input type="checkbox" …>
<fieldset><legend>Question</legend> radios… </fieldset>',
            'example_html' => <<<'HTML'
<form action="/commande" method="post">
  <label for="mail">E-mail</label>
  <input type="email" id="mail" name="email">

  <label for="nb">Nombre de cafés</label>
  <input type="number" id="nb" name="quantite" min="1" max="10" value="1">

  <label for="retrait">Heure de retrait</label>
  <input type="time" id="retrait" name="heure">

  <fieldset>
    <legend>Taille</legend>
    <input type="radio" id="t-s" name="taille" value="S" checked>
    <label for="t-s">Petit</label>
    <input type="radio" id="t-l" name="taille" value="L">
    <label for="t-l">Grand</label>
  </fieldset>

  <input type="checkbox" id="sucre" name="sucre" value="1">
  <label for="sucre">Avec sucre</label>

  <button type="submit">Commander</button>
</form>
HTML,
            'lines' => [
                ['<input type="email" …>', 'Clavier adapté sur mobile et vérification du format.'],
                ['<input type="number" … min="1" max="10" value="1">', 'Nombre entre 1 et 10, valeur par défaut 1.'],
                ['<input type="time" …>', 'Sélecteur d’heure natif.'],
                ['<fieldset><legend>Taille</legend>', 'Groupe de boutons radio avec sa question.'],
                ['<input type="radio" … name="taille" value="S" checked>', 'Même `name` pour le groupe ; `checked` = choix par défaut.'],
                ['<input type="checkbox" …>', 'Choix indépendant (oui/non).'],
            ],
            'reference' => [
                ['type="email|password|number|tel|url"', 'Types de saisie spécialisés.'],
                ['type="date|time"', 'Sélecteurs de date et d’heure.'],
                ['type="checkbox"', 'Case à cocher.'],
                ['type="radio"', 'Choix unique dans un groupe (même `name`).'],
                ['checked', 'Coché par défaut.'],
                ['<fieldset> / <legend>', 'Groupe de champs et son intitulé.'],
            ],
            'mistakes' => [
                'Des radios d’un même groupe avec des `name` différents (on peut tout cocher).',
                'Oublier `value` sur les radios et checkboxes.',
                'Utiliser `type="number"` pour un code postal ou un numéro de carte (zéros initiaux perdus) : préférez `text` + `inputmode="numeric"`.',
                'Des radios sans `<fieldset>`/`<legend>`.',
            ],
            'practices' => [
                'Choisir le type le plus précis.',
                'Grouper radios et cases avec `<fieldset>`.',
                'Placer le label après la case à cocher / le radio.',
            ],
            'practical' => 'Les tunnels de commande utilisent tous ces types : `email` pour le contact, `tel` pour la livraison, `radio` pour le mode de livraison, `checkbox` pour les conditions générales. Chaque bon choix de type réduit les erreurs de saisie.',
            'summary' => ['Le type adapte clavier, interface et validation.', 'Checkbox = choix indépendants ; radio = choix unique (même `name`).', '`<fieldset>` + `<legend>` pour grouper.'],
            'challenge' => 'Créez un formulaire de réservation d’hôtel : dates d’arrivée et de départ, nombre de personnes (1 à 6), type de chambre (radio), options (checkbox).',
            'exercises' => [
                [
                    'title' => 'Un groupe de boutons radio',
                    'difficulty' => 2,
                    'instructions' => 'Créez un `<fieldset>` avec la `<legend>` **Mode de livraison** contenant deux boutons radio de même `name` `livraison` : **Domicile** (`value="domicile"`) et **Point relais** (`value="relais"`), chacun avec son `<label>`.',
                    'starter_html' => '<form action="/commande" method="post">

</form>',
                    'solution_html' => '<form action="/commande" method="post">
  <fieldset>
    <legend>Mode de livraison</legend>
    <input type="radio" id="domicile" name="livraison" value="domicile">
    <label for="domicile">Domicile</label>
    <input type="radio" id="relais" name="livraison" value="relais">
    <label for="relais">Point relais</label>
  </fieldset>
</form>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'fieldset legend', 'text' => 'Mode de livraison', 'msg' => 'Une légende « Mode de livraison »'],
                        ['t' => 'el', 'sel' => 'fieldset input[type=radio][name=livraison]', 'count' => 2, 'msg' => 'Deux radios avec name="livraison"'],
                        ['t' => 'el', 'sel' => 'input[value=domicile]', 'msg' => 'Une option value="domicile"'],
                        ['t' => 'el', 'sel' => 'input[value=relais]', 'msg' => 'Une option value="relais"'],
                        ['t' => 'el', 'sel' => 'label[for]', 'count' => 2, 'msg' => 'Chaque radio a son label'],
                    ],
                    'hint' => 'Même `name` pour les deux radios, `value` différentes, `id` différents.',
                    'explanation' => 'Le `name` commun fait des radios un groupe à choix unique ; `fieldset`/`legend` donnent le contexte.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel type affiche un clavier avec « @ » sur mobile ?', 'a' => ['`text`', '`email`', '`url`', '`tel`'], 'c' => 1, 'e' => '`type="email"`.'],
                ['q' => 'Qu’ont en commun les boutons radio d’un même groupe ?', 'a' => ['Le même `id`', 'Le même `name`', 'La même `value`', 'Rien'], 'c' => 1, 'e' => 'Le même `name` crée le groupe.'],
                ['q' => 'Pour un code postal, `type="number"` est idéal.', 'tf' => true, 'c' => false, 'e' => 'Faux : les zéros initiaux posent problème ; préférez `text` + `inputmode="numeric"`.'],
            ],
        ],
        [
            'slug' => 'select-textarea-button',
            'title' => 'Listes déroulantes, zones de texte et boutons',
            'duration' => 13,
            'intro' => <<<'MD'
Choisir son pays dans une liste, écrire un long message, envoyer ou réinitialiser un formulaire : trois nouveaux éléments complètent votre boîte à outils — `<select>`, `<textarea>` et `<button>`.
MD,
            'objectives' => ['Créer une liste déroulante avec `<select>` et `<option>`', 'Créer une zone de texte multiligne', 'Connaître les types de boutons'],
            'prerequisites' => ['Les types de champs'],
            'theory' => <<<'MD'
## `<select>` : la liste déroulante

```html
<label for="pays">Pays</label>
<select id="pays" name="pays">
  <option value="">— Choisissez —</option>
  <option value="fr">France</option>
  <option value="be" selected>Belgique</option>
  <option value="ca">Canada</option>
</select>
```

- `value` : la donnée envoyée ; le texte de l’option est ce que voit l’utilisateur ;
- `selected` : option choisie par défaut ;
- `<optgroup label="…">` regroupe des options ;
- `multiple` permet plusieurs choix (peu ergonomique : préférez des cases à cocher).

Quand l’utiliser ? Pour **plus de 5 ou 6 choix**. En dessous, des boutons radio sont plus rapides (tout est visible en un coup d’œil).

## `<textarea>` : texte long

```html
<label for="msg">Votre message</label>
<textarea id="msg" name="message" rows="5"></textarea>
```

Contrairement à `<input>`, `<textarea>` a une balise fermante ; la valeur par défaut s’écrit **entre** les balises. `rows` règle la hauteur initiale ; `maxlength` limite le nombre de caractères.

## `<button>` : trois types

| Type | Effet |
|---|---|
| `submit` | Envoie le formulaire (par défaut dans un form) |
| `reset` | Remet les valeurs initiales (rarement utile, souvent frustrant) |
| `button` | Ne fait rien par défaut (utilisé avec JavaScript) |

> [!TIP] Précisez toujours le `type` d’un bouton. Un `<button>` sans type dans un formulaire est un bouton d’envoi : un bouton « Afficher le mot de passe » mal typé enverrait le formulaire !

## Le texte du bouton

Préférez une action précise à « Envoyer » : « Créer mon compte », « Réserver ma table », « Recevoir le devis ».
MD,
            'syntax' => '<select name="…"><option value="…">…</option></select>
<textarea name="…" rows="5"></textarea>
<button type="submit">…</button>',
            'example_html' => <<<'HTML'
<form action="/contact" method="post">
  <label for="sujet">Sujet</label>
  <select id="sujet" name="sujet">
    <option value="">— Choisissez un sujet —</option>
    <optgroup label="Commandes">
      <option value="suivi">Suivi de commande</option>
      <option value="retour">Retour produit</option>
    </optgroup>
    <option value="autre">Autre demande</option>
  </select>

  <label for="message">Message</label>
  <textarea id="message" name="message" rows="5" maxlength="1000"></textarea>

  <button type="submit">Envoyer ma demande</button>
</form>
HTML,
            'lines' => [
                ['<select id="sujet" name="sujet">', 'Liste déroulante, reliée à son label.'],
                ['<option value="">— Choisissez un sujet —</option>', 'Option vide : oblige à faire un choix conscient.'],
                ['<optgroup label="Commandes">', 'Groupe d’options avec un intitulé.'],
                ['<textarea … rows="5" maxlength="1000"></textarea>', 'Zone multiligne, 5 lignes visibles, 1000 caractères maximum.'],
                ['<button type="submit">Envoyer ma demande</button>', 'Bouton d’envoi avec un texte précis.'],
            ],
            'reference' => [
                ['<select>', 'Liste déroulante.'],
                ['<option value selected>', 'Option (valeur envoyée, sélection par défaut).'],
                ['<optgroup label>', 'Groupe d’options.'],
                ['<textarea rows maxlength>', 'Zone de texte multiligne.'],
                ['<button type>', '`submit`, `reset` ou `button`.'],
            ],
            'mistakes' => [
                'Écrire `<textarea value="…">` : la valeur se place entre les balises.',
                'Laisser des espaces ou retours à la ligne entre `<textarea>` et `</textarea>` (ils deviennent du contenu).',
                'Un `<select>` pour 2 ou 3 choix.',
                'Oublier le `type` des boutons.',
            ],
            'practices' => [
                'Radios pour peu de choix, select au-delà de 6.',
                'Une option vide par défaut dans un select obligatoire.',
                'Des textes de boutons orientés action.',
            ],
            'practical' => 'Les formulaires de contact d’entreprise combinent presque toujours ces trois éléments. Côté serveur, le script vérifie que la valeur du `<select>` fait bien partie des options autorisées : on ne fait jamais confiance aux données envoyées.',
            'summary' => ['`<select>` + `<option value>` pour les longues listes.', '`<textarea>` pour le texte long, valeur entre les balises.', 'Toujours préciser `type` sur `<button>`.'],
            'challenge' => 'Créez un formulaire « Signaler un bug » : page concernée (select avec optgroup), gravité (radio), description (textarea), capture (file), bouton d’envoi.',
            'exercises' => [
                [
                    'title' => 'Formulaire de contact',
                    'difficulty' => 2,
                    'instructions' => 'Complétez le formulaire : une liste `<select>` de `name` `service` avec au moins **3 options**, une zone `<textarea>` de `name` `message`, et un `<button type="submit">`. Chaque champ doit avoir un label.',
                    'starter_html' => '<form action="/contact" method="post">

</form>',
                    'solution_html' => '<form action="/contact" method="post">
  <label for="service">Service</label>
  <select id="service" name="service">
    <option value="">— Choisissez —</option>
    <option value="vente">Ventes</option>
    <option value="support">Support</option>
  </select>
  <label for="message">Message</label>
  <textarea id="message" name="message" rows="4"></textarea>
  <button type="submit">Envoyer mon message</button>
</form>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'select[name=service] option', 'min' => 3, 'msg' => 'Un select name="service" avec 3 options'],
                        ['t' => 'el', 'sel' => 'textarea[name=message]', 'msg' => 'Une textarea name="message"'],
                        ['t' => 'el', 'sel' => 'button[type=submit]', 'msg' => 'Un bouton type="submit"'],
                        ['t' => 'el', 'sel' => 'label[for]', 'min' => 2, 'msg' => 'Les champs ont des labels'],
                    ],
                    'hint' => '`<select name="service">` avec des `<option>`, puis `<textarea name="message"></textarea>`.',
                    'explanation' => 'Chaque élément de formulaire a un rôle : choix dans une liste, texte libre et envoi.',
                ],
            ],
            'quiz' => [
                ['q' => 'Où s’écrit la valeur par défaut d’une `<textarea>` ?', 'a' => ['Dans `value`', 'Entre les balises ouvrante et fermante', 'Dans `placeholder`', 'Dans `default`'], 'c' => 1, 'e' => 'Le contenu entre `<textarea>` et `</textarea>`.'],
                ['q' => 'Quel type de bouton n’envoie pas le formulaire ?', 'a' => ['`submit`', '`button`', 'Sans type', 'Tous l’envoient'], 'c' => 1, 'e' => '`type="button"` n’a pas d’action par défaut.'],
                ['q' => 'Pour 3 choix exclusifs, des boutons radio sont plus rapides qu’un select.', 'tf' => true, 'c' => true, 'e' => 'Vrai : toutes les options sont visibles d’un coup.'],
            ],
        ],
        [
            'slug' => 'validation-native-formulaires',
            'title' => 'La validation native des formulaires',
            'duration' => 14,
            'intro' => <<<'MD'
Le navigateur sait vérifier un formulaire **avant** son envoi : champ obligatoire vide, e-mail mal formé, nombre hors limites… Quelques attributs suffisent. Mais attention : cette validation est un confort pour l’utilisateur, **jamais une sécurité**.
MD,
            'objectives' => ['Utiliser `required`, `minlength`, `maxlength`, `min`, `max`, `pattern`', 'Comprendre les limites de la validation côté client', 'Aider l’utilisateur avec des messages clairs'],
            'prerequisites' => ['Listes déroulantes, zones de texte et boutons'],
            'theory' => <<<'MD'
## Les attributs de validation

| Attribut | Rôle | Exemple |
|---|---|---|
| `required` | Champ obligatoire | `<input required>` |
| `minlength` / `maxlength` | Longueur du texte | `minlength="8"` |
| `min` / `max` / `step` | Bornes numériques ou de date | `min="18"` |
| `pattern` | Expression régulière | `pattern="[0-9]{5}"` |
| `type` | Format (email, url…) | `type="email"` |

Si une règle n’est pas respectée, le navigateur **bloque l’envoi** et affiche un message près du champ.

```html
<label for="cp">Code postal (5 chiffres)</label>
<input id="cp" name="cp" required pattern="[0-9]{5}" inputmode="numeric">
```

## Indiquer les champs obligatoires

Signalez-les **visuellement et textuellement** : « (obligatoire) » ou un astérisque expliqué en haut du formulaire (« Les champs marqués * sont obligatoires »). La couleur seule ne suffit pas.

## Donner des instructions à l’avance

Les contraintes (« 8 caractères minimum, dont un chiffre ») doivent être visibles **avant** la saisie, par exemple dans un texte d’aide relié au champ par `aria-describedby`.

## Validation client ≠ sécurité

N’importe qui peut désactiver la validation (outils de développement, attribut `novalidate`, requête envoyée directement). Le serveur doit **toujours revérifier** toutes les données. Sur cette plateforme, par exemple, PHP valide chaque champ de l’inscription même si le navigateur l’a déjà fait.

> [!WARN] La validation HTML sert l’expérience utilisateur. La validation serveur sert la sécurité et l’intégrité des données. Il faut les deux.
MD,
            'syntax' => '<input type="email" required>
<input type="password" minlength="8" required>
<input type="number" min="1" max="99">
<input pattern="[0-9]{5}">',
            'example_html' => <<<'HTML'
<form action="/inscription" method="post">
  <p>Tous les champs sont obligatoires.</p>

  <label for="pseudo">Pseudo (3 à 20 caractères)</label>
  <input id="pseudo" name="pseudo" required minlength="3" maxlength="20">

  <label for="courriel">E-mail</label>
  <input type="email" id="courriel" name="email" required>

  <label for="age">Âge</label>
  <input type="number" id="age" name="age" required min="16" max="120">

  <label for="mdp">Mot de passe</label>
  <input type="password" id="mdp" name="password" required minlength="8" aria-describedby="mdp-aide">
  <small id="mdp-aide">8 caractères minimum.</small>

  <button type="submit">Créer mon compte</button>
</form>
HTML,
            'lines' => [
                ['<p>Tous les champs sont obligatoires.</p>', 'Information donnée avant la saisie.'],
                ['<input … required minlength="3" maxlength="20">', 'Obligatoire, entre 3 et 20 caractères.'],
                ['<input type="email" … required>', 'Format e-mail vérifié par le navigateur.'],
                ['<input type="number" … min="16" max="120">', 'Âge borné.'],
                ['aria-describedby="mdp-aide"', 'Relie le champ à son texte d’aide (lu par les lecteurs d’écran).'],
            ],
            'reference' => [
                ['required', 'Champ obligatoire.'],
                ['minlength / maxlength', 'Longueur minimale / maximale.'],
                ['min / max / step', 'Bornes numériques.'],
                ['pattern', 'Expression régulière à respecter.'],
                ['novalidate', 'Sur `<form>` : désactive la validation native.'],
                ['aria-describedby', 'Relie un champ à un texte d’aide.'],
            ],
            'mistakes' => [
                'Compter uniquement sur la validation HTML pour la sécurité.',
                'Des contraintes non expliquées (l’utilisateur découvre la règle après l’erreur).',
                'Signaler les champs obligatoires uniquement par la couleur rouge.',
                'Un `pattern` trop strict qui refuse des valeurs valides (noms composés, numéros internationaux).',
            ],
            'practices' => [
                'Expliquer les contraintes avant la saisie.',
                'Toujours revalider côté serveur.',
                'Garder des règles raisonnables.',
            ],
            'practical' => 'Les formulaires professionnels combinent la validation native (réaction immédiate), un peu de JavaScript (messages personnalisés en français) et une validation serveur (sécurité). C’est l’approche utilisée sur cette plateforme.',
            'summary' => ['`required`, `minlength`, `min`, `pattern`… bloquent un envoi invalide.', 'Expliquez les contraintes à l’avance.', 'La validation côté client n’est jamais une sécurité : le serveur revérifie tout.'],
            'challenge' => 'Créez un formulaire de réservation avec validation : nom obligatoire, e-mail, nombre de personnes de 1 à 8, date minimale aujourd’hui (attribut `min` sur `type="date"`).',
            'exercises' => [
                [
                    'title' => 'Rendre des champs obligatoires',
                    'difficulty' => 1,
                    'instructions' => 'Ajoutez `required` aux deux champs, et `minlength="8"` au mot de passe.',
                    'starter_html' => '<form action="/connexion" method="post">
  <label for="email">E-mail</label>
  <input type="email" id="email" name="email">
  <label for="mdp">Mot de passe</label>
  <input type="password" id="mdp" name="password">
  <button type="submit">Se connecter</button>
</form>',
                    'solution_html' => '<form action="/connexion" method="post">
  <label for="email">E-mail</label>
  <input type="email" id="email" name="email" required>
  <label for="mdp">Mot de passe</label>
  <input type="password" id="mdp" name="password" required minlength="8">
  <button type="submit">Se connecter</button>
</form>',
                    'rules' => [
                        ['t' => 'el', 'sel' => 'input#email[required]', 'msg' => 'Le champ e-mail est obligatoire'],
                        ['t' => 'el', 'sel' => 'input#mdp[required]', 'msg' => 'Le mot de passe est obligatoire'],
                        ['t' => 'attr', 'sel' => 'input#mdp', 'attr' => 'minlength', 'value' => '8', 'msg' => 'minlength="8" sur le mot de passe'],
                    ],
                    'hint' => '`required` est un attribut booléen : il s’écrit sans valeur.',
                    'explanation' => 'Le navigateur bloquera l’envoi si un champ est vide ou si le mot de passe fait moins de 8 caractères.',
                ],
                [
                    'title' => 'Sécurité et validation',
                    'type' => 'truefalse',
                    'instructions' => 'Vrai ou faux ?',
                    'question' => 'Grâce à `required` et `pattern`, le serveur n’a plus besoin de vérifier les données reçues.',
                    'correct' => 1,
                    'explanation' => 'Faux : la validation côté client se contourne facilement. Le serveur doit toujours revalider.',
                ],
            ],
            'quiz' => [
                ['q' => 'Quel attribut rend un champ obligatoire ?', 'a' => ['`mandatory`', '`required`', '`needed`', '`validate`'], 'c' => 1, 'e' => '`required`.'],
                ['q' => 'Quel attribut impose un format par expression régulière ?', 'a' => ['`format`', '`regex`', '`pattern`', '`match`'], 'c' => 2, 'e' => '`pattern`.'],
                ['q' => 'Pourquoi revalider côté serveur ?', 'a' => ['Pour la performance', 'Parce que la validation du navigateur peut être contournée', 'Pour le SEO', 'Ce n’est pas utile'], 'c' => 1, 'e' => 'Les données peuvent être envoyées sans passer par le formulaire.'],
            ],
        ],
    ],
];
