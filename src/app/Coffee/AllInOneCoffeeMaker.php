<?php

namespace App\Coffee;

class AllInOneCoffeeMaker extends CoffeeMaker
{
    use CappuccinoTrait {
        // Solution 1 to conflict where CappuccinoTrait and LatteTrait are used in the same class
        CappuccinoTrait::makeLatte insteadof LatteTrait;
        // Change the visibility of makeCappuccino method
        CappuccinoTrait::makeCappuccino as public;
    }

    // Solution 2 to conflict where CappuccinoTrait and LatteTrait are used in the same class
    use LatteTrait {
        LatteTrait::makeLatte as makeOriginalLatte;
    }

    // Overriding the makeCappuccino method from CappuccinoTrait
    public function makeCappuccino()
    {
        echo static::class . ' is making a cappuccino!' . PHP_EOL;
    }
}
