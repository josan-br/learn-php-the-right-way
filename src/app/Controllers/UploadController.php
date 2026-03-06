<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class UploadController
{
    public function create(): View
    {
        return View::make('upload', [
            'title' => 'Upload a receipt',
        ]);
    }

    public function store()
    {
        $filePath = STORAGE_PATH . "/{$_FILES['receipt']['name']}";

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);

        echo '<pre>';
        var_dump(pathinfo($filePath));
        echo '</pre>';
    }
}
