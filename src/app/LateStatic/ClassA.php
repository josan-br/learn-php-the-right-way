<?php

namespace App\LateStatic;

class ClassA
{
    protected string $name = 'A';

    public function getName(): string
    {
        return $this->name;
    }
}
