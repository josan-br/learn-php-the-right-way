<?php

declare(strict_types=1);

namespace App\Models;

class Invoice extends Model
{
    public function create(int $userId, float $amount): int
    {
        $query = <<<'SQL'
        INSERT INTO invoices (`user_id`, `amount`) VALUES (:user_id, :amount)
        SQL;

        $this->db->prepare($query)->execute([
            'user_id' => $userId,
            'amount' => $amount,
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function find(int $id): array
    {
        $query = <<<'SQL'
        SELECT `invoices`.`id`, `invoices`.`amount`, `users`.`full_name`
        FROM `invoices`
        LEFT JOIN `users` ON `users`.`id` = `invoices`.`user_id`
        WHERE `invoices`.`id` = :id
        SQL;

        $stmt = $this->db->prepare($query);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch() ?: [];
    }
}
