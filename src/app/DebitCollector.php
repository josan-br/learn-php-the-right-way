<?php

namespace App;

interface DebitCollector
{
    public function collect(float $owedAmount): float;
}