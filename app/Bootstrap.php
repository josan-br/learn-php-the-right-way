<?php

namespace App;

final class Bootstrap
{
    public function __construct(
        private Router $router
    ) {
        $this->startSession();
        $this->registerExceptionHandler();
    }

    public function resolveRequest(): mixed
    {
        return $this->router->resolve(
            $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_METHOD']
        );
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
