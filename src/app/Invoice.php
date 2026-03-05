<?php

namespace App;

use App\Exceptions\MissingBillingInformationException;

class Invoice
{
    public function __construct(
        public Customer $customer,
    ) {}

    public function process(float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero.');
        }

        if (empty($this->customer->getBillingInfo())) {
            throw new MissingBillingInformationException();
        }

        echo "Processing \${$amount} invoice - ";

        sleep(1);

        echo 'OK' . PHP_EOL;
    }
}
