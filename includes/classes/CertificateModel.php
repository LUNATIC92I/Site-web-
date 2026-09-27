<?php
declare(strict_types=1);

/** Certification de fin de parcours. */
final class CertificateModel
{
    public static function forUser(int $userId): ?array
    {
        return Database::fetch('SELECT * FROM certificates WHERE user_id = ?', [$userId]);
    }

    public static function findByCode(string $code): ?array
    {
        if (!preg_match('/^[A-Z0-9]{16}$/', $code)) {
            return null;
        }
        return Database::fetch('SELECT * FROM certificates WHERE certificate_code = ?', [$code]);
    }

    /** Le parcours complet (toutes les leçons publiées) est-il terminé ? */
    public static function eligible(int $userId): bool
    {
        return ProgressModel::pathCompleted($userId);
    }

    /** Délivre (une seule fois) le certificat de l'apprenant. */
    public static function issue(array $user): ?array
    {
        $userId = (int) $user['id'];
        if ($existing = self::forUser($userId)) {
            return $existing;
        }
        if (!self::eligible($userId)) {
            return null;
        }
        $stats = ProgressModel::stats($userId);
        $score = $stats['average_score'] ?? 0;
        $level = $score >= 90 ? 'Avancé — mention excellence' : ($score >= 75 ? 'Avancé — mention bien' : 'Avancé');

        do {
            $code = strtoupper(substr(bin2hex(random_bytes(10)), 0, 16));
        } while (Database::value('SELECT 1 FROM certificates WHERE certificate_code = ?', [$code]));

        Database::insert('certificates', [
            'user_id'          => $userId,
            'certificate_code' => $code,
            'full_name'        => $user['first_name'] . ' ' . $user['last_name'],
            'level_label'      => $level,
            'final_score'      => $score,
        ]);
        ActivityModel::log($userId, 'certificate', 'Parcours HTML & CSS terminé');
        BadgeService::evaluate($userId);
        return self::forUser($userId);
    }

    public static function all(): array
    {
        return Database::fetchAll('SELECT * FROM certificates ORDER BY issued_at DESC');
    }
}
