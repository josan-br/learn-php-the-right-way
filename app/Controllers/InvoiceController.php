<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Foundation\View;
use App\Responses\RedirectResponse;

class InvoiceController
{
    public function index(): View
    {
        return View::make('invoices/index', ['title' => 'Invoices']);
    }

    public function create(): View
    {
        return View::make('invoices/create', ['title' => 'Create Invoice']);
    }

    public function store(): RedirectResponse
    {
        echo 'Invoice created with the following data: ';

        var_dump($_POST);

        return new RedirectResponse('/invoices');
    }
}
