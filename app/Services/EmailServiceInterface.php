<?php

namespace App\Services;

interface EmailServiceInterface
{
    public function send(array $customer, string $content): bool;

    public function sendQueuedEmails(): void;
}
