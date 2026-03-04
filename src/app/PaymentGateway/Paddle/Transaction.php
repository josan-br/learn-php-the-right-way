<?php

declare(strict_types=1);

namespace App\PaymentGateway\Paddle;

class Transaction
{
    private string $status;

    public function __construct()
    {
        $this->setStatus(TransactionStatus::PENDING);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        if (!in_array($status, TransactionStatus::ALL)) {
            throw new \InvalidArgumentException("Invalid transaction status: {$status}");
        }

        $this->status = $status;

        return $this;
    }
}
