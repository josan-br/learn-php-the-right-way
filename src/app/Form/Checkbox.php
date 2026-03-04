<?php

declare(strict_types=1);

namespace App\Form;

class Checkbox extends Boolean
{
    public function render(): string
    {
        return <<<HTML
        <input type="checkbox" name="{$this->name}" />
        HTML;
    }
}
