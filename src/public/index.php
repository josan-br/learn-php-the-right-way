<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Invoice;
use App\Customer;

function foo(): void
{
    echo 'Foo' . PHP_EOL;
}

function process()
{
    try {
        $customer = new Customer(['name' => 'John Doe']);

        $invoice = new Invoice($customer);

        $invoice->process(-25.0);

        return true;
    } catch (\Throwable $th) {
        echo $th->getMessage() . PHP_EOL;

        return foo();
    } finally {
        echo 'Finally block executed.' . PHP_EOL;

        return -1;
    }
}

var_dump(process());
