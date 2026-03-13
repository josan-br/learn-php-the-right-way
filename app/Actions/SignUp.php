<?php

declare(strict_types=1);

namespace App\Actions;

use App\DB;
use App\Models\Invoice;
use App\Models\User;

final class SignUp
{
    public function __construct(
        protected DB $db,
        protected User $userModel,
        protected Invoice $invoiceModel
    ) {}

    public function handle(string $email, string $name, float $amount): int
    {
        try {
            $this->db->beginTransaction();

            $userId = $this->userModel->create($email, $name);
            $invoiceId = $this->invoiceModel->create($userId, $amount);

            $this->db->commit();
        } catch (\Throwable $th) {
            $this->db->rollBack();

            throw $th;
        }

        return $invoiceId;
    }
}
