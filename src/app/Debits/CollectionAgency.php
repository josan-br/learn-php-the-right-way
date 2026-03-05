<?php

namespace App\Debits;

class CollectionAgency implements DebitCollector
{
    public function collect(float $owedAmount): float
    {
        return mt_rand($owedAmount * 0.5, $owedAmount);
    }
}
