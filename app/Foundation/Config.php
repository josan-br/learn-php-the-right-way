<?php

namespace App\Foundation;

/**
 * @property-read array{host:string, username:string, password:string, database:string, driver:string}|null $database
 */
final class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'database' => [
                'host' => $env['DB_HOST'],
                'username' => $env['DB_USERNAME'],
                'password' => $env['DB_PASSWORD'],
                'database' => $env['DB_DATABASE'],
                'driver' => $env['DB_DRIVER'] ?? 'mysql',
            ]
        ];
    }

    public function __get($name)
    {
        return $this->config[$name] ?? null;
    }
}
