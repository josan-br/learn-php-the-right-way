<?php

namespace App\Coffee;

class CappuccinoMaker extends CoffeeMaker
{
    use CappuccinoTrait {
        // Change the visibility of makeCappuccino method
        CappuccinoTrait::makeCappuccino as public;
    }
}
