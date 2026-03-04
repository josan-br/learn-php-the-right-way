<?php

namespace App\LateStatic;

class ClassA
{
    protected static string $name = 'A';

    public static function getName(): string
    {
        return self::$name;
    }
    
    public static function getStaticName(): string
    {
        return static::$name;
    }
}
