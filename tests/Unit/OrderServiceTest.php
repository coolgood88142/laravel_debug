<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Services\InvoiceService;


class OrderServiceTest extends TestCase
{

    public function testNewOrder()
    {
        $data = [
            "invoice1", "invoice2"
        ];

        $mock = $this->initMock(InvoiceService::class);
        $mock->shouldReceive('newInvoice')
            ->once()
            ->with($data)
            ->andReturn('成功');

        $test = $mock->newInvoice($data);
    }
}
