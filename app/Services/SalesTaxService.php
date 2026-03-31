<?php

namespace App\Services;

class SalesTaxService implements SalesTaxServiceInterface
{
    public function calculate(float $amount, array $customer): float
    {
        // sleep(1);

        return $amount * 6.5 / 100;
    }
}
