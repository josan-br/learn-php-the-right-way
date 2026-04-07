<?php

namespace App;

use App\Foundation\Config;
use App\Foundation\Container;
use App\Foundation\DB;
use App\Foundation\Request;
use App\Foundation\Router\Router;

final class App
{
    private static DB $db;
    private static Container $container;

    private Config $config;
    private Router $router;
    private Request $request;

    public function __construct()
    {
        \Dotenv\Dotenv::createImmutable(BASE_PATH)->load();

        $this->registerExceptionHandler();

        static::$container = new Container();
    }

    public function boot(): static
    {
        $this->startSession();

        $this->config = new \App\Foundation\Config($_ENV);
        $this->request = new \App\Foundation\Request($_SERVER);
        $this->router = new \App\Foundation\Router\Router(static::$container);

        $this->registerBinds();
        $this->registerRoutes();

        static::$db = new DB($this->config->database ?? []);

        return $this;
    }

    public function bootCommand(): static
    {
        $this->config = new \App\Foundation\Config($_ENV);

        $this->registerBinds();

        static::$db = new DB($this->config->database ?? []);

        return $this;
    }

    public function run(): void
    {
        echo $this->router->resolve(
            $this->request->getUri(),
            $this->request->getMethod()
        );
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public static function make(string $abstract)
    {
        return static::$container->get($abstract);
    }

    private function startSession(): void
    {
        session_start();
    }

    private function registerExceptionHandler(): void
    {
        set_exception_handler(function (\Throwable $th) {
            if ($th instanceof \App\Exceptions\RouteNotFoundException) {
                return new \App\Responses\RedirectResponse('/error/404');
            }

            if ($th instanceof \App\Exceptions\ViewNotFoundException) {
                return new \App\Responses\RedirectResponse('/error/500');
            }

            throw $th;
        });
    }

    private function registerBinds(): void
    {
        static::$container
            ->set(\App\Services\EmailServiceInterface::class, \App\Services\EmailService::class)
            ->set(\App\Services\PaymentGatewayInterface::class, \App\Services\StripePayment::class)
            ->set(\App\Services\SalesTaxServiceInterface::class, \App\Services\SalesTaxService::class)
            ->set(
                \Symfony\Component\Mailer\MailerInterface::class,
                fn() => new \App\Services\CustomMailer($this->config->mailer['dsn'])
            );
    }

    private function registerRoutes(): void
    {
        $this->router->registerRoutesFromControllerAttributes([
            \App\Controllers\ErrorController::class,
            \App\Controllers\HomeController::class,
            \App\Controllers\InvoiceController::class,
            \App\Controllers\UploadController::class,
            \App\Controllers\UserController::class,
        ]);
    }
}
