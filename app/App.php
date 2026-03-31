<?php

namespace App;

final class App
{
    private static DB $db;
    private static Container $container;

    public function __construct(
        Container $container,
        private Router $router,
        private Request $request,
        private Config $config,
    ) {
        $this->startSession();
        $this->registerExceptionHandler();

        static::$container = $container;
        static::$db = new DB($config->database ?? []);
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
}
