<?php

declare(strict_types=1);

namespace App\Foundation;

use PDO;
use PDOException;

/**
 * @method bool beginTransaction()
 * @method bool commit()
 * @method ?string errorCode()
 * @method array errorInfo()
 * @method int|false exec(string $statement)
 * @method mixed getAttribute(int $attribute)
 * @method bool inTransaction()
 * @method string|false lastInsertId(?string $name = null)
 * @method \PDOStatement|false prepare(string $query, array $options = [])
 * @method \PDOStatement|false query(string $query, ?int $fetchMode = null)
 * @method \PDOStatement|false query(string $query, ?int $fetchMode = PDO::FETCH_COLUMN, int $colno)
 * @method \PDOStatement|false query(string $query, ?int $fetchMode = PDO::FETCH_CLASS, string $classname, array $constructorArgs)
 * @method \PDOStatement|false query(string $query, ?int $fetchMode = PDO::FETCH_INTO, object $object)
 * @method string|false quote(string $string, int $type = PDO::PARAM_STR)
 * @method bool rollBack()
 * @method bool setAttribute(int $attribute, mixed $value)
 */
final class DB
{
    private PDO $pdo;

    private const DEFAULT_OPTIONS = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    private const UNCALLBLED_METHODS = ['connect', 'getAvailableDrivers'];

    public function __construct(protected array $config)
    {
        try {
            $driver = $this->config['driver'];
            $host = $this->config['host'];
            $database = $this->config['database'];

            $this->pdo = new PDO(
                "{$driver}:host={$host};dbname={$database}",
                $this->config['username'],
                $this->config['password'],
                $this->config['options'] ?? static::DEFAULT_OPTIONS
            );
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    public function __call(string $method, array $arguments): mixed
    {
        if (in_array($method, static::UNCALLBLED_METHODS, true)) {
            throw new \BadMethodCallException("The {$method} does not exists.");
        }

        return call_user_func_array([$this->pdo, $method], $arguments);
    }

    public function rollBack(): bool
    {
        return $this->pdo->inTransaction() ? $this->pdo->rollBack() : true;
    }
}
