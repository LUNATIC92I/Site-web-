<?php
declare(strict_types=1);

/**
 * Envoi d'e-mails avec un système de "drivers".
 *  - log  : écrit le message dans storage/logs/mail.log (développement)
 *  - mail : fonction mail() de PHP
 * Pour brancher un fournisseur SMTP (PHPMailer, API transactionnelle...),
 * ajoutez simplement un cas dans send().
 */
final class Mailer
{
    public static function send(string $to, string $subject, string $textBody): bool
    {
        $cfg = config('mail');
        $from = sprintf('%s <%s>', $cfg['from_name'], $cfg['from']);

        switch ($cfg['driver']) {
            case 'mail':
                $headers = [
                    'From: ' . $from,
                    'MIME-Version: 1.0',
                    'Content-Type: text/plain; charset=UTF-8',
                ];
                return mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $textBody, implode("\r\n", $headers));

            case 'log':
            default:
                $entry = sprintf(
                    "[%s]\nFrom: %s\nTo: %s\nSubject: %s\n\n%s\n%s\n",
                    date('c'), $from, $to, $subject, $textBody, str_repeat('-', 60)
                );
                return file_put_contents(ROOT_PATH . '/storage/logs/mail.log', $entry, FILE_APPEND | LOCK_EX) !== false;
        }
    }
}
