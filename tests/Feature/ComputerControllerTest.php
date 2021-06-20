<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use App\Models\User;
use Artisan;

class ComputerControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_computer_plus()
    {
        //Arrange
        $type = 1;
        $a = 5;
        $b = 3;
        $test = 8;

        //模擬ComputerController，呼叫computer()，只執行一次，並且帶type、a、b三個參數，設定回傳值為8
        $mock = $this->initMock(ComputerController::class);
        $mock->shouldReceive('computer')
            ->once()
            ->with($type, $a, $b)
            ->andReturn($test);

        //Act
        //將mock執行computer()
        $result = $mock->computer($type, $a, $b);

        //Assert
        //確認mock回傳的值是否為8
        $this->assertEquals($test, $result);
    }

    public function test_computer_toSubtract()
    {
        //Arrange
        $type = 2;
        $a = 5;
        $b = 2;
        $test = 3;

         //模擬ComputerController，呼叫computer()，只執行一次，並且帶type、a、b三個參數，設定回傳值為3
        $mock = $this->initMock(ComputerController::class);
        $mock->shouldReceive('computer')
            ->once()
            ->with($type, $a, $b)
            ->andReturn($test);
        
        //Act
        //將mock執行computer()
        $result = $mock->computer($type, $a, $b);

        //Assert
        //確認mock回傳的值是否為3
        $this->assertEquals($test, $result);
    }

    public function test_computer_multiply()
    {
        //Arrange
        $type = 3;
        $a = 4;
        $b = 3;
        $test = 12;

        //模擬ComputerController，呼叫computer()，只執行一次，並且帶type、a、b三個參數，設定回傳值為12
        $mock = $this->initMock(ComputerController::class);
        $mock->shouldReceive('computer')
            ->once()
            ->with($type, $a, $b)
            ->andReturn($test);

        //Act
        //將mock執行computer()
        $result = $mock->computer($type, $a, $b);

        //Assert
        //確認mock回傳的值是否為12
        $this->assertEquals($test, $result);
    }

    public function test_computer_divided()
    {
        //Arrange
        $type = 4;
        $a = 10;
        $b = 2;
        $test = 5;

        //模擬ComputerController，呼叫computer()，只執行一次，並且帶type、a、b三個參數，設定回傳值為5
        $mock = $this->initMock(ComputerController::class);
        $mock->shouldReceive('computer')
            ->once()
            ->with($type, $a, $b)
            ->andReturn($test);
        
        //Act
         //將mock執行computer()
        $result = $mock->computer($type, $a, $b);

        //Assert
        //確認mock回傳的值是否為5
        $this->assertEquals($test, $result); 

    }
}
