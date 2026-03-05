<?php

namespace App;

class Customer
{
    public function __construct(
        public array $billingInfo = [],
    ) {}

    public function getBillingInfo(): array
    {
        return $this->billingInfo;
    }
}
