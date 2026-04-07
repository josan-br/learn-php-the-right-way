<?php

declare(strict_types=1);

define("BASE_PATH", dirname(__DIR__));
define("STORAGE_PATH", BASE_PATH . "/storage");
define("VIEW_PATH", BASE_PATH . "/views");

require BASE_PATH . "/vendor/autoload.php";

\Dotenv\Dotenv::createImmutable(BASE_PATH)->load();

$config = new \App\Foundation\Config($_ENV);
$request = new \App\Foundation\Request($_SERVER);

$container = new App\Foundation\Container();

$container->set(\App\Services\EmailServiceInterface::class, \App\Services\EmailService::class);
$container->set(\App\Services\PaymentGatewayInterface::class, \App\Services\StripePayment::class);
$container->set(\App\Services\SalesTaxServiceInterface::class, \App\Services\SalesTaxService::class);
$container->set(
    \Symfony\Component\Mailer\MailerInterface::class,
    fn() => new \App\Services\CustomMailer($config->mailer['dsn'])
);

$router = new \App\Foundation\Router\Router($container);

$router->registerRoutesFromControllerAttributes([
    \App\Controllers\ErrorController::class,
    \App\Controllers\HomeController::class,
    \App\Controllers\InvoiceController::class,
    \App\Controllers\UploadController::class,
    \App\Controllers\UserController::class,
]);

(new \App\App($container, $router, $request, $config))->run();
