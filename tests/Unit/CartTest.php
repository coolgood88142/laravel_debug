<?php

namespace Tests\Unit;

use Mockery as m;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Store;
use PHPUnit\Framework\TestCase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class CartTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @test */
    public function putItem()
    {
        $item = $this->createItem('商品01', 100, 1);

        $store = m::mock(Store::class);

        $store->shouldReceive('put')->with($item)->once();

        $cart = new Cart($store);
        $cart->put($item);
    }

    /** @test */
    public function sum()
    {
        $store = m::mock(Store::class);
        $store->shouldReceive('items')->once()->andReturnUsing(function () {
            return [
                $this->createItem('商品01', 100, 2),
                $this->createItem('商品02', 200, 1),
            ];
        });

        $cart = new Cart($store);

        $this->assertEquals(400, $cart->total());
    }

    /** @test */
    public function remove()
    {
        $item = $this->createItem('商品01', 100, 2);

        $store = m::mock(Store::class);
        $store->shouldReceive('remove')->once()->with($item);

        $cart = new Cart($store);

        $cart->remove($item);
    }

    private function createItem($name, $price, $qty)
    {
        return new Item([
            'name' => $name,
            'price' => $price,
            'quantity' => $qty,
        ]);
    }
}