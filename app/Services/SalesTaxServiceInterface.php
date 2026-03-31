<?php

namespace App\Services;

interface SalesTaxServiceInterface
{
    public function calculate(float $amount, array $customer): float;
}
