<?php

declare(strict_types=1);

namespace App\Controllers;

class InvoiceController
{
    public function index(): string
    {
        return 'Invoices';
    }

    public function create(): string
    {
        return <<<HTML
        <form action="/invoices" method="post">
            <input type="text" name="customer_name" placeholder="Customer Name">
            <input type="number" name="amount" placeholder="Amount">
            <button type="submit">Create Invoice</button>
        </form>
        HTML;
    }

    public function store()
    {
        echo 'Invoice created with the following data: ';
        var_dump($_POST);
    }
}
