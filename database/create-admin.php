<?php
/**
 * Création (ou promotion) d'un compte administrateur en ligne de commande.
 *
 *   php database/create-admin.php
 *
 * Le mot de passe est saisi de façon masquée et n'est jamais écrit ailleurs
 * que sous forme de hash dans la base de données.
 */

declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    exit("À exécuter en ligne de commande.\n");
}

require __DIR__ . '/../includes/bootstrap.php';

function ask(string $label, bool $hidden = false): string
{
    echo $label;
    if ($hidden && DIRECTORY_SEPARATOR === '/' && function_exists('shell_exec') && stream_isatty(STDIN)) {
        shell_exec('stty -echo');
        $value = trim((string) fgets(STDIN));
        shell_exec('stty echo');
        echo "\n";
        return $value;
    }
    return trim((string) fgets(STDIN));
}

echo "=== Création d'un administrateur — " . config('app.name') . " ===\n";
$first = ask('Prénom : ');
$last = ask('Nom : ');
$email = mb_strtolower(ask('E-mail : '));
$password = ask('Mot de passe (12 caractères minimum conseillés) : ', true);
$confirm = ask('Confirmation : ', true);

$v = new Validator(['first_name' => $first, 'last_name' => $last, 'email' => $email, 'password' => $password, 'password_confirm' => $confirm]);
$v->required('first_name', 'Prénom')->name('first_name', 'Le prénom')
  ->required('last_name', 'Nom')->name('last_name', 'Le nom')
  ->required('email', 'E-mail')->email('email')
  ->password('password', max(10, (int) config('security.password_min_length')))
  ->same('password', 'password_confirm', 'Les mots de passe ne correspondent pas.');

if ($v->fails()) {
    foreach ($v->errors() as $error) {
        fwrite(STDERR, "✗ $error\n");
    }
    exit(1);
}

$existing = UserModel::findForAuth($email);
if ($existing) {
    UserModel::setRole((int) $existing['id'], 'admin');
    UserModel::updatePassword((int) $existing['id'], $password);
    UserModel::setActive((int) $existing['id'], true);
    echo "✓ Le compte existant $email est maintenant administrateur (mot de passe mis à jour).\n";
} else {
    UserModel::create($first, $last, $email, $password, 'admin');
    echo "✓ Administrateur $email créé.\n";
}
