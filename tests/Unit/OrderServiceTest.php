<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Services\InvoiceService;


class OrderServiceTest extends TestCase
{


    public function test_something_can_be_mocked()
    {

        $mock = $this->partialMock(InvoiceService::class, function (MockInterface $mock) {
            $data = [
                "invoice1", "invoice2"
            ];

            $mock->shouldReceive('newInvoice')
                ->once()
                ->with($data);
        });

        // $this->instance(
        //     OrderService::class,
        //     Mockery::mock(OrderService::class, function (MockInterface $mock) {
        //         $mock->shouldReceive('newInvoice')
        //             ->once()
        //             ->with($order)
        //             ->andReturn($invoiceReturn);
        //     })
        // );
    }
}
