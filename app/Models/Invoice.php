<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;

class Invoice extends Model
{
    public function all(?InvoiceStatus $status = null): array
    {
        $binds = [];
        $query = "SELECT * FROM `invoices`";

        if ($status !== null) {
            $query .= " WHERE `invoices`.`status` = :status";
            $binds['status'] = $status->value;
        }

        $stmt = $this->db->prepare($query);

        $stmt->execute($binds);

        return $stmt->fetch() ?: [];
    }

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
