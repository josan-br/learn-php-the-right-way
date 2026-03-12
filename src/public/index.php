<?php

declare(strict_types=1);

define("APP_PATH", __DIR__ . "/../");
define("STORAGE_PATH", APP_PATH . "storage");
define("VIEW_PATH", APP_PATH . "views");

require APP_PATH . "vendor/autoload.php";

$router = new App\Router();

$router
    ->get("/", [\App\Controllers\HomeController::class, "index"])
    ->get("/invoices", [\App\Controllers\InvoiceController::class, "index"])
    ->get("/invoices/create", [
        \App\Controllers\InvoiceController::class,
        "create",
    ])
    ->post("/invoices", [\App\Controllers\InvoiceController::class, "store"])
    //
    ->get("/upload", [\App\Controllers\UploadController::class, "create"])
    ->post("/upload", [\App\Controllers\UploadController::class, "store"])
    //
    ->get("/error/404", [\App\Controllers\ErrorController::class, "error404"])
    ->get("/error/500", [\App\Controllers\ErrorController::class, "error500"])
;

echo (new \App\Bootstrap($router))->resolveRequest();
