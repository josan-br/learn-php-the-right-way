<?php

declare(strict_types=1);

namespace App\Models;

class User extends Model
{
    public function create(string $email, string $name, bool $isActive = true): int
    {
        $query = <<<'SQL'
        INSERT INTO `users` (`email`, `full_name`, `is_active`, `created_at`)
        VALUES (:email, :name, :is_active, NOW())
        SQL;

        $this->db->prepare($query)->execute([
            'email' => $email,
            'name' => $name,
            'is_active' => $isActive
        ]);

        return (int) $this->db->lastInsertId();
    }
}
