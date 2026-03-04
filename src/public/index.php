<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\LateStatic\ClassA;
use App\LateStatic\ClassB;

// $classA = new ClassA();
// $classB = new ClassB();

// echo $classA->getName() . PHP_EOL;
// echo $classB->getName() . PHP_EOL;

// echo ClassA::getName() . PHP_EOL; // Output: A
// echo ClassB::getName() . PHP_EOL; // Output: A, because self:: in ClassA::getName() refers to ClassA, not ClassB.

echo ClassA::getStaticName() . PHP_EOL; // Output: A, because static:: in ClassA::getStaticName() refers to the class that was called, which is ClassA.
echo ClassB::getStaticName() . PHP_EOL; // Output: B, because static:: in ClassA::getStaticName() refers to the class that was called, which is ClassB. This is the key difference between self:: and static:: in PHP.
