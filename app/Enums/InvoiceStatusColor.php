<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatusColor: string
{
    case Gray = 'gray';
    case Green = 'green';
    case Red = 'red';
    case Yellow = 'yellow';

    public function cssClass(): string
    {
        return "color-{$this->value}";
    }
}
