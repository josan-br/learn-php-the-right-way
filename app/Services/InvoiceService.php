<?php

namespace App\Services;

class InvoiceService implements InvoiceServiceInterface
{
    public function __construct(
        protected SalesTaxServiceInterface $salesTaxService,
        protected PaymentGatewayInterface $gatewayService,
        protected EmailServiceInterface $emailService,
    ) {}

    public function process(array $customer, float $amount): bool
    {
        $tax = $this->salesTaxService->calculate($amount, $customer);

        if (! $this->gatewayService->charge($customer, $amount, $tax)) {
            return false;
        }

        $this->emailService->send($customer, 'receipt');

        echo 'Invoice has been processed<br />';

        return true;
    }
}
