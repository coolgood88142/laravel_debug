<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ComputerService;
use App\Models\Computer;

class ComputerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_run()
    {
        $a = 3;
        $b = 5;

        //模擬執行一次ComputerService呼叫plus，帶兩個參數，設定回傳值回成功
        $mock = $this->initMock(ComputerService::class);
        $mock->shouldReceive('plus')
            ->once()
            ->with($a, $b)
            ->andReturn('成功');
        
        $test = $mock->plus($a, $b);
    }

    //執行ComputerService的test_plus()，確認回傳的是否為字串
    public function testComputer()
    {
        self::assertIsString(
            (new ComputerService())->test_plus(2, 3)
        );
    }

}
