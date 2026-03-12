<?php

namespace App;

final class App
{
    public function __construct(
        private Router $router,
        private Request $request,
        private Config $config,
    ) {
        $this->startSession();
        $this->registerExceptionHandler();
    }

    public function run(): void
    {
        echo $this->router->resolve(
            $this->request->getUri(),
            $this->request->getMethod()
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
