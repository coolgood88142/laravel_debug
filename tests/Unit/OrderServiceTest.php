<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Services\InvoiceService;
use App\Service;
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
        //     ->once();

        // $test = $mock->invoice();

        // $this->instance(
        //     InvoiceService::class,
        //     Mockery::mock(InvoiceService::class, function (MockInterface $mock) {
        //         $mock->shouldReceive('invoice')->once();
        //     })
        // );

        $InvoiceService = new InvoiceService();

        $mock = $this->mock(InvoiceService::class, function (MockInterface $mock) {
            $mock->shouldReceive('invoice')->once();
        });

        // $mock = $this->partialMock(InvoiceService::class, function (MockInterface $mock) {
        //     $mock->shouldReceive('invoice');
        // });

        // $test = $mock->invoice();

        // dd($test);

        // $this->assertEquals('testInvoice', $mock->invoice());


    }
}
