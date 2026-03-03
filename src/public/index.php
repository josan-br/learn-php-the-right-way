<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/Notification/Email.php';
require_once __DIR__ . '/../app/PaymentGateway/Paddle/CustomerProfile.php';
require_once __DIR__ . '/../app/PaymentGateway/Paddle/Transaction.php';
require_once __DIR__ . '/../app/PaymentGateway/Stripe/Transaction.php';

use App\PaymentGateway\Paddle\Transaction;

$paddleTransaction = new Transaction();

var_dump($paddleTransaction);
