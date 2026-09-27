<?php
declare(strict_types=1);

/** Paramètres modifiables depuis l'administration (table settings). */
final class SettingModel
{
    private static ?array $cache = null;

    public static function all(): array
    {
        if (self::$cache === null) {
            self::$cache = [];
            try {
                foreach (Database::fetchAll('SELECT setting_key, setting_value, label FROM settings ORDER BY id') as $row) {
                    self::$cache[$row['setting_key']] = $row;
                }
            } catch (Throwable $e) {
                Logger::error('Settings unavailable: ' . $e->getMessage());
            }
        }
        return self::$cache;
    }

    public static function get(string $key, string $default = ''): string
    {
        return (string) (self::all()[$key]['setting_value'] ?? $default);
    }

    public static function set(string $key, string $value): void
    {
        Database::run('UPDATE settings SET setting_value = ? WHERE setting_key = ?', [$value, $key]);
        self::$cache = null;
    }
}
