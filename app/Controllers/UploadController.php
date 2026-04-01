<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Foundation\Router\Attributes\Get;
use App\Foundation\Router\Attributes\Post;
use App\Foundation\View;
use App\Responses\RedirectResponse;

class UploadController
{
    #[Get('/upload')]
    public function create(): View
    {
        return View::make('upload', [
            'title' => 'Upload a receipt',
        ]);
    }

    #[Post('/upload')]
    public function store(): RedirectResponse
    {
        $filePath = STORAGE_PATH . "/{$_FILES['receipt']['name']}";

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);

        return new RedirectResponse('/');
    }
}
