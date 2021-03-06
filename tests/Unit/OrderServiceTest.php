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

        //模擬Invoice class去呼叫testInvoice()，只有執行一次，設定回傳test
        //目的：為了確保不會更改到資料
        $mock = $this->instance(
            Invoice::class,
            Mockery::mock(Invoice::class, function (MockInterface $mock) {
                $mock->shouldReceive('testInvoice')->once()->andReturn('test');
            })
        );

        //新增InvoiceService物件，含有模擬Invoice class的mock物件
        //目的：
        $invoiceService = new \App\Services\InvoiceService($mock);

        //invoiceService執行invoice class的testInvoice()
        //目的：
        $test = $invoiceService->invoice->testInvoice();

        // $invoice = new \App\Models\Invoice;
        // $invoiceService1 = new \App\Services\InvoiceService($invoice);
        // $test = $invoiceService1->invoice->testInvoice();

        //dd($test);

        //模擬InvoiceService class去呼叫testInvoice()，只有執行一次
        // $mock = $this->mock(InvoiceService::class, function (MockInterface $mock) {
        //     $mock->shouldReceive('testInvoice')->once()->andReturn('testInvoice');
        // });

        //invoiceService執行invoice class的testInvoice()
        // $mock->testInvoice();

    }
}
