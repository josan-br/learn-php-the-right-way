<?php

declare(strict_types=1);

namespace App\PaymentGateway\Stripe;

class Transaction
{
    private static int $count = 0;

    public function __construct(
        public float $amount = 0.0,
        public string $description = '',
    ) {
        self::$count++;
    }

    public  static function getCount(): int
    {
        return self::$count;
    }
}
