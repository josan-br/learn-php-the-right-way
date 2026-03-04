<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\PaymentGateway\Paddle\Transaction;
use App\PaymentGateway\Paddle\TransactionStatus;

$transaction = new Transaction();

$transaction->setStatus(TransactionStatus::PAID);

var_dump($transaction);
