<?php

namespace App\Coffee;

trait CappuccinoTrait
{
    private function makeCappuccino(): void
    {
        echo 'Making cappuccino...' . PHP_EOL;
        // echo static::class . ' is making a cappuccino!' . PHP_EOL;
    }

    // Overriding the makeCoffee method from CoffeeMaker
    // public function makeCoffee(): void
    // {
    //     echo 'Making a coffee...' . PHP_EOL;
    // }

    // Make conflict where CappuccinoTrait and LatteTrait are used in the same class
    public function makeLatte(): void
    {
        echo 'Making latte from cappuccino trait...' . PHP_EOL;
    }
}
