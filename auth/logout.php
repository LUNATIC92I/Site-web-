<?php
declare(strict_types=1);
require __DIR__ . '/../includes/bootstrap.php';

// La déconnexion se fait uniquement en POST avec jeton CSRF (évite les déconnexions forcées par un lien)
if (!is_post()) {
    redirect(url(''));
}
verify_csrf();
logout_user();

start_secure_session();
flash('success', 'Vous êtes déconnecté. À bientôt !');
redirect(url(''));
