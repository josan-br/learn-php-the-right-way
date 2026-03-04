<?php

namespace App\Coffee;

trait LatteTrait
{
    public static string $foo = 'foo';

    private string $milkType = 'whole milk';

    public function makeLatte(): void
    {
        echo __CLASS__ . " is making a latte with {$this->milkType}!" . PHP_EOL;
    }

    public function setMilkType(string $milkType): static
    {
        $this->milkType = $milkType;

        return $this;
    }

    public  static function foo(): void
    {
        echo 'Foo Bar' . PHP_EOL;
    }
}
