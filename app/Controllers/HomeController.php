<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;

use App\Models\Invoice;
use App\Models\User;

use App\View;

class HomeController
{
    public function index(): View
    {
        $db = App::db();

        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new \App\Actions\SignUp($db, $userModel, $invoiceModel))
            ->handle('fulano2@doe.com', 'Jawdwada Doe', 25);

        return View::make('index', [
            'title' => 'Home',
            'invoice' => $invoiceModel->find($invoiceId)
        ]);
    }
}
