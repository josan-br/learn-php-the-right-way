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

$router = new \App\Foundation\Router\Router($container);

$router->registerRoutesFromControllerAttributes([
    \App\Controllers\ErrorController::class,
    \App\Controllers\HomeController::class,
    \App\Controllers\InvoiceController::class,
    \App\Controllers\UploadController::class,
]);

(new \App\App(
    $container,
    $router,
    new \App\Foundation\Request($_SERVER),
    new \App\Foundation\Config($_ENV)
))->run();
