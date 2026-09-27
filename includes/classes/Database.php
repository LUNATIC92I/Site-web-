<?php
declare(strict_types=1);

/**
 * Accès PDO unique à la base de données + petits helpers de requêtes.
 * Toutes les requêtes passent par des requêtes préparées.
 */
final class Database
{
    private static ?PDO $pdo = null;

    public static function connection(): PDO
    {
        if (self::$pdo === null) {
            $cfg = require ROOT_PATH . '/config/database.php';
            $dsn = $cfg['socket'] !== ''
                ? sprintf('mysql:unix_socket=%s;dbname=%s;charset=%s', $cfg['socket'], $cfg['name'], $cfg['charset'])
                : sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s', $cfg['host'], $cfg['port'], $cfg['name'], $cfg['charset']);

            self::$pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_STRINGIFY_FETCHES  => false,
            ]);
            self::$pdo->exec("SET time_zone = '" . (new DateTime())->format('P') . "'");
        }
        return self::$pdo;
    }

    /** Exécute une requête préparée et retourne le statement. */
    public static function run(string $sql, array $params = []): PDOStatement
    {
        $stmt = self::connection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public static function fetch(string $sql, array $params = []): ?array
    {
        $row = self::run($sql, $params)->fetch();
        return $row === false ? null : $row;
    }

    public static function fetchAll(string $sql, array $params = []): array
    {
        return self::run($sql, $params)->fetchAll();
    }

    /** Retourne la première colonne de la première ligne. */
    public static function value(string $sql, array $params = [])
    {
        $v = self::run($sql, $params)->fetchColumn();
        return $v === false ? null : $v;
    }

    public static function column(string $sql, array $params = []): array
    {
        return self::run($sql, $params)->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * INSERT à partir d'un tableau associatif. Les noms de colonnes proviennent
     * toujours du code (listes blanches des modèles), jamais de l'utilisateur.
     */
    public static function insert(string $table, array $data): int
    {
        $cols = array_keys($data);
        $sql = sprintf(
            'INSERT INTO `%s` (%s) VALUES (%s)',
            $table,
            implode(', ', array_map(static fn ($c) => "`$c`", $cols)),
            implode(', ', array_map(static fn ($c) => ":$c", $cols))
        );
        self::run($sql, $data);
        return (int) self::connection()->lastInsertId();
    }

    public static function update(string $table, array $data, int $id): void
    {
        $set = implode(', ', array_map(static fn ($c) => "`$c` = :$c", array_keys($data)));
        $data['__id'] = $id;
        self::run("UPDATE `$table` SET $set WHERE id = :__id", $data);
    }

    public static function delete(string $table, int $id): void
    {
        self::run("DELETE FROM `$table` WHERE id = ?", [$id]);
    }

    public static function transaction(callable $fn)
    {
        $pdo = self::connection();
        $pdo->beginTransaction();
        try {
            $result = $fn();
            $pdo->commit();
            return $result;
        } catch (Throwable $e) {
            $pdo->rollBack();
            throw $e;
        }
    }
}
