<?php

namespace App\Debits;

interface DebitCollector
{
    public function collect(float $owedAmount): float;
}