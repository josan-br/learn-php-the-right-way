<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Foundation\Router\Attributes\Get;
use App\Foundation\View;

class ErrorController
{
    private string $layout = VIEW_PATH . '/layouts/error.php';

    #[Get("/error/404")]
    public function error404(): View
    {
        http_response_code(404);

        return View::make('errors/404', [
            'title' => 'Page not found',
        ])->withLayout($this->layout);
    }

    #[Get("/error/500")]
    public function error500(): View
    {
        http_response_code(500);

        return View::make('errors/500', [
            'title' => 'Something went wrong',
        ])->withLayout($this->layout);
    }
}
