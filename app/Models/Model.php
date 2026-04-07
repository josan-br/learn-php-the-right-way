<?php


declare(strict_types=1);

namespace App\Models;

abstract class Model
{
    protected \App\Foundation\DB $db;

    public function __construct()
    {
        $this->db = \App\App::db();
    }

    protected function lazyFetch(\PDOStatement $statment): \Generator
    {
        foreach ($statment as $record) {
            yield $record;
        }
    }
}
