<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\ComputerService;
use App\Models\Computer;
use Mockery\MockInterface;
use Mockery;

class ComputerServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    //要測試計算機的加法，驗證結果是否是對的
    public function test_plus()
    {
        //Arrange
        $a = 3;
        $b = 5;

        //新增ComputerService物件
        $service = new \App\Services\ComputerService();
        
        //Act
        //ComputerService物件執行plus()，帶a、b兩個參數，並且回傳計算值
        $result = $service->plus($a, $b);
        
        //Assert
        $test = 8;
        //確認計算值是否為8
        $this->assertEquals($test, $result);
    }

    public function test_toSubtract()
    {
        //Arrange
        $a = 5;
        $b = 2;

        //新增ComputerService物件
        $service = new \App\Services\ComputerService();

        //Act
        //ComputerService物件執行toSubtract()，帶a、b兩個參數，並且回傳計算值
        $result = $service->toSubtract($a, $b);
        

        //Assert
        $test = 3;
        //確認計算值是否為3
        $this->assertEquals($test, $result);
    }

    public function test_multiply()
    {
        //Arrange
        $a = 4;
        $b = 3;

        //新增ComputerService物件
        $service = new \App\Services\ComputerService();

        //Act
        //ComputerService物件執行multiply()，帶a、b兩個參數，並且回傳計算值
        $result = $service->multiply($a, $b);
        
        //Assert
        $test = 12;
        //確認計算值是否為12
        $this->assertEquals($test, $result);
    }

    public function test_divided()
    {
        //Arrange
        $a = 10;
        $b = 2;

        //新增ComputerService物件
        $service = new \App\Services\ComputerService();

        //Act
        //ComputerService物件執行divided()，帶a、b兩個參數，並且回傳計算值
        $result = $service->divided($a, $b);
        
        //Assert
        $test = 5;
        //確認計算值是否為5
        $this->assertEquals($test, $result);
    }

    //要測試結果是否新增到DB
    public function test_add_data()
    {
        //Arrange
        //模擬ComputerService，呼叫addData()，只執行一次，並且帶result參數，設定回傳success
        $result = 15;
        $mock = $this->initMock(ComputerService::class);
        $mock->shouldReceive('addData')
            ->once()
            ->with($result)
            ->andReturn('success');

        //Act
        //將mock執行addData()
        $test = $mock->addData($result);

        //Assert
        //確認回傳資料是否為success
        $this->assertEquals('success', $test);
    }
    
}
