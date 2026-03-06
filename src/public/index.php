<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new App\Router();

$router->get('/', [\App\Controllers\HomeController::class, 'index'])
    ->get('/invoices', [\App\Controllers\InvoiceController::class, 'index'])
    ->get('/invoices/create', [\App\Controllers\InvoiceController::class, 'create'])
    ->post('/invoices', [\App\Controllers\InvoiceController::class, 'store'])
;

echo $router->resolve(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);
