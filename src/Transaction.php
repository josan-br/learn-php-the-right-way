<?php

declare(strict_types=1);

class Transaction
{
    public function __construct(
        private float $amount = 0.0,
        private string $description = '',
    ) {}

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function addTax(float $rate): self
    {
        $this->amount += $this->amount * $rate / 100;

        return $this;
    }

    public function applyDiscount(float $rate): self
    {
        $this->amount -= $this->amount * $rate / 100;

        return $this;
    }

    public function __destruct()
    {
        echo "Destruct {$this->description}\n";
    }
}
