<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$fields = [
    new \App\Form\Field('baseField'),
    new \App\Form\Text('textField'),
    new \App\Form\Boolean('booleanField'),
    new \App\Form\Checkbox('checkboxField'),
    new \App\Form\Radio('radioField'),
];

foreach ($fields as $field) {
    echo $field->render() . '<br/ >';
}
