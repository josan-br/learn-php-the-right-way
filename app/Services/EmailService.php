<?php

namespace App\Services;

class EmailService
{
    public function send(array $customer, string $content): bool
    {
        sleep(1);

        return true;
    }
}
