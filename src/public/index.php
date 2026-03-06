<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

session_start();

define('STORAGE_PATH', __DIR__ . '/../storage');

$router = new App\Router();

$router->get('/', [\App\Controllers\HomeController::class, 'index'])
    ->get('/invoices', [\App\Controllers\InvoiceController::class, 'index'])
    ->get('/invoices/create', [\App\Controllers\InvoiceController::class, 'create'])
    ->post('/invoices', [\App\Controllers\InvoiceController::class, 'store'])
    //
    ->get('/upload', [\App\Controllers\UploadController::class, 'create'])
    ->post('/upload', [\App\Controllers\UploadController::class, 'store'])
;

echo $router->resolve(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);
