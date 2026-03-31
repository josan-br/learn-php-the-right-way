<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Foundation\View;
use App\Services\InvoiceService;

class HomeController
{
    public function __construct(
        protected InvoiceService $invoiceService
    ) {}

    public function index(): View
    {
        $this->invoiceService->process([], 20);

        return View::make('index', ['title' => 'Home']);
    }
}
