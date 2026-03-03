<?php

declare(strict_types=1);

require_once __DIR__ . '/../Transaction.php';

// Classes & Objects
$transaction = (new Transaction(100, 'Transaction 1'))
    ->addTax(8)
    ->applyDiscount(10);

$amount = $transaction->getAmount();

$transaction = null;

var_dump($amount);
