<?php

namespace App\Debits;

class Rock implements DebitCollector
{
    public function collect(float $owedAmount): float
    {
        return $owedAmount * 0.65;
    }
}
