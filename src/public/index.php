<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$classA = new App\LateStatic\ClassA();
$classB = new App\LateStatic\ClassB();

echo $classA->getName() . PHP_EOL;
echo $classB->getName() . PHP_EOL;
