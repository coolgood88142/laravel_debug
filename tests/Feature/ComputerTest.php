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
        $this->mock = $this->initMock(ComputerService::class);
        $this->mock->shouldReceive('plus')
            ->once()
            ->with($a , $b);
    }
}
