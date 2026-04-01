<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: int
{
    case Pending = 0;
    case Paid = 1;
    case Void = 2;
    case Failed = 3;

    public function color(): InvoiceStatusColor
    {
        return match ($this) {
            self::Paid => InvoiceStatusColor::Green,
            self::Void => InvoiceStatusColor::Gray,
            self::Failed => InvoiceStatusColor::Red,
            default => InvoiceStatusColor::Yellow,
        };
    }

    public function display(): string
    {
        return match ($this) {
            self::Paid => 'Paid',
            self::Void => 'Void',
            self::Failed => 'Declined',
            default => 'Pending',
        };
    }
}
