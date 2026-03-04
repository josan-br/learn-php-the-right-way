<?php

namespace App\Coffee;

class CoffeeMaker
{
    public static string $foo = 'foo';

    public function makeCoffee(): void
    {
        echo static::class . ' is making a coffee!' . PHP_EOL;
    }
}
