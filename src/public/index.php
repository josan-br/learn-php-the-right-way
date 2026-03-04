<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Coffee\AllInOneCoffeeMaker;
use App\Coffee\CappuccinoMaker;
use App\Coffee\CoffeeMaker;
use App\Coffee\LatteMaker;

// $coffeeMaker = new CoffeeMaker();
// $coffeeMaker->makeCoffee();

// $cappuccinoMaker = new CappuccinoMaker();
// $cappuccinoMaker->makeCoffee();
// $cappuccinoMaker->makeCappuccino();

// $latteMaker = new LatteMaker();
// $latteMaker->makeCoffee();
// $latteMaker->makeLatte();

// $allInOneCoffeeMaker = new AllInOneCoffeeMaker();
// $allInOneCoffeeMaker->makeCoffee();
// $allInOneCoffeeMaker->makeLatte();
// $allInOneCoffeeMaker->makeOriginalLatte();
// $allInOneCoffeeMaker->makeCappuccino();

// LatteMaker::foo();

CoffeeMaker::$foo = 'foo';
LatteMaker::$foo = 'bar';

echo CoffeeMaker::$foo . ' ' . LatteMaker::$foo . PHP_EOL;
