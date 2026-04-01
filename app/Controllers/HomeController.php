<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Foundation\Router\Attributes\Get;
use App\Foundation\View;
use App\Services\InvoiceService;

class HomeController
{
    public function __construct(
        protected InvoiceService $invoiceService
    ) {}

    #[Get('/')]
    #[Get('/home')]
    public function index(): View
    {
        $this->invoiceService->process([], 20);

        return View::make('index', ['title' => 'Home']);
    }
}
