<?php

namespace App\Exceptions;

class InvoiceException extends \Exception
{
    public  static function invalidAmount():static
    {
        return new static('Amount must be greater than zero.');
    }

    public  static function missingBillingInfo(): static
    {
        return new static('Missing billing information.');
    }
}
