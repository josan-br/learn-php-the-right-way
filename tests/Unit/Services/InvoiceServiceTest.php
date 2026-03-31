<?php

namespace Tests\Unit\Services;

use App\Services\EmailServiceInterface;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayInterface;
use App\Services\SalesTaxServiceInterface;
use Tests\TestCase;

class InvoiceServiceTest extends TestCase
{
    public function test_it_processes_invoice(): void
    {
        $salesTaxService = $this->createMock(SalesTaxServiceInterface::class);
        $gatewayService = $this->createMock(PaymentGatewayInterface::class);
        $emailService = $this->createMock(EmailServiceInterface::class);

        $gatewayService->method('charge')->willReturn(true);

        $invoiceService = new InvoiceService(
            $salesTaxService,
            $gatewayService,
            $emailService,
        );

        $result = $invoiceService->process(['name' => 'John'], 150);

        $this->assertTrue($result);
    }

    public function test_sends_receipt_email_when_invoices_is_processed(): void
    {
        $customer = ['name' => 'John'];

        $salesTaxService = $this->createMock(SalesTaxServiceInterface::class);
        $gatewayService = $this->createMock(PaymentGatewayInterface::class);
        $emailService = $this->createMock(EmailServiceInterface::class);

        $gatewayService->method('charge')->willReturn(true);

        $emailService->expects($this->once())
            ->method('send')
            ->with($customer, 'receipt');

        $invoiceService = new InvoiceService(
            $salesTaxService,
            $gatewayService,
            $emailService,
        );

        $result = $invoiceService->process($customer, 150);

        $this->assertTrue($result);
    }
}
