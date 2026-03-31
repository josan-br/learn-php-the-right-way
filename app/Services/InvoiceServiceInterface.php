<?php

namespace App\Services;

interface InvoiceServiceInterface
{
    public function process(array $customer, float $amount): bool;
}
