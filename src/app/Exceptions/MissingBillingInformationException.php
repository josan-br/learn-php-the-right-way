<?php

namespace App\Exceptions;

final class MissingBillingInformationException extends \Exception
{
    protected $message = 'Missing billing information.';
}
