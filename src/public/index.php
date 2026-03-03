<?php

declare(strict_types=1);

require_once __DIR__ . '/../Notification/Email.php';
require_once __DIR__ . '/../PaymentGateway/Paddle/CustomerProfile.php';
require_once __DIR__ . '/../PaymentGateway/Paddle/Transaction.php';
require_once __DIR__ . '/../PaymentGateway/Stripe/Transaction.php';

// use PaymentGateway\Paddle;
use PaymentGateway\Paddle\Transaction;
// use PaymentGateway\Paddle\{Transaction, CustomerProfile};
use PaymentGateway\Stripe\Transaction as StripeTransaction;

$paddleTransaction = new Transaction();
$stripeTransaction = new StripeTransaction();

var_dump($paddleTransaction, $stripeTransaction);
