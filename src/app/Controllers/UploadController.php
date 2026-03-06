<?php

declare(strict_types=1);

namespace App\Controllers;

class UploadController
{
    public function create()
    {
        return <<<HTML
        <form action="/upload" method="post" enctype="multipart/form-data">
            <input type="file" name="receipt">
            <button type="submit">Upload</button>
        </form>
        HTML;
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
