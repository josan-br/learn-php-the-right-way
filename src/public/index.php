<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

set_exception_handler(function ($exception) {
    echo 'Uncaught exception: ' . $exception->getMessage() . PHP_EOL;
});

use App\Invoice;
use App\Customer;

$customer = new Customer(['name' => 'John Doe']);

$invoice = new Invoice($customer);

$invoice->process(-25.0);
