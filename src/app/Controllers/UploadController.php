<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Responses\RedirectResponse;
use App\View;

class UploadController
{
    public function create(): View
    {
        return View::make('upload', [
            'title' => 'Upload a receipt',
        ]);
    }

    public function store(): RedirectResponse
    {
        $filePath = STORAGE_PATH . "/{$_FILES['receipt']['name']}";

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);

        return new RedirectResponse('/');
    }
}
