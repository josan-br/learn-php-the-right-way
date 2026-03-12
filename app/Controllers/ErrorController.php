<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class ErrorController
{
    private string $layout = VIEW_PATH . '/layouts/error.php';

    public function error404(): View
    {
        http_response_code(404);

        return View::make('errors/404', [
            'title' => 'Page not found',
        ])->withLayout($this->layout);
    }

    public function error500(): View
    {
        http_response_code(500);

        return View::make('errors/500', [
            'title' => 'Something went wrong',
        ])->withLayout($this->layout);
    }
}
