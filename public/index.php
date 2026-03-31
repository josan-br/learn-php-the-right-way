<?php

declare(strict_types=1);

define("BASE_PATH", dirname(__DIR__));
define("STORAGE_PATH", BASE_PATH . "/storage");
define("VIEW_PATH", BASE_PATH . "/views");

require BASE_PATH . "/vendor/autoload.php";

\Dotenv\Dotenv::createImmutable(BASE_PATH)->load();

$container = new App\Foundation\Container();

$container->set(\App\Services\EmailServiceInterface::class, \App\Services\EmailService::class);
$container->set(\App\Services\PaymentGatewayInterface::class, \App\Services\StripePayment::class);
$container->set(\App\Services\SalesTaxServiceInterface::class, \App\Services\SalesTaxService::class);

$router = new App\Foundation\Router($container);

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

(new \App\App(
    $container,
    $router,
    new \App\Foundation\Request($_SERVER),
    new \App\Foundation\Config($_ENV)
))->run();
