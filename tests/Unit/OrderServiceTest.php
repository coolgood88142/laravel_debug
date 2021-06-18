<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Services\InvoiceService;
use App\Models\Invoice;
use Mockery;


class OrderServiceTest extends TestCase
{

    public function testNewOrder()
    {
        $invoiceReturn = [
            'invoice_number' => '1'
        ];

        $data = [
            "invoice1", "invoice2"
        ];

        // $mock = $this->initMock(InvoiceService::class);
        // $mock->shouldReceive('invoice')
        //      ->once();

        // $test = $mock->invoice();


        //模擬Invoice class去呼叫testInvoice()，只有執行一次
        $mock = $this->instance(
            Invoice::class,
            Mockery::mock(Invoice::class, function (MockInterface $mock) {
                $mock->shouldReceive('testInvoice')->once();
            })
        );

        //建立已經模擬的Invoice class，去執行testInvoice()
        $invoiceService = new \App\Services\InvoiceService($mock);
        $test = $invoiceService->invoice->testInvoice();



        // $mock = $this->mock(InvoiceService::class, function (MockInterface $mock) {
        //     $mock->shouldReceive('invoice')->once();
        // });

        // $mock = $this->partialMock(InvoiceService::class, function (MockInterface $mock) {
        //     $mock->shouldReceive('invoice');
        // });

        // $test = $mock->invoice();

        // dd($test);

        // $this->assertEquals('testInvoice', $mock->invoice());


    }
}
