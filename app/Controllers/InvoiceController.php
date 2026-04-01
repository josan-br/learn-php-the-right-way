<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Foundation\Router\Attributes\Get;
use App\Foundation\Router\Attributes\Post;
use App\Foundation\View;
use App\Responses\RedirectResponse;

class InvoiceController
{
    #[Get("/invoices")]
    public function index(): View
    {
        return View::make('invoices/index', ['title' => 'Invoices']);
    }

    #[Get("/invoices/create")]
    public function create(): View
    {
        return View::make('invoices/create', ['title' => 'Create Invoice']);
    }

    #[Post("/invoices")]
    public function store(): RedirectResponse
    {
        echo 'Invoice created with the following data: ';

        var_dump($_POST);

        return new RedirectResponse('/invoices');
    }
}
