<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\PaymentGateway\Stripe\Transaction;

$transactions = [];

for ($i = 0; $i < 5; $i++) {
    $transactions[] = new Transaction(100, "Transaction {$i}");
}

var_dump(Transaction::getCount());
