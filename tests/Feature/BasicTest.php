<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Artisan;

class BasicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //執行route，localhost
        $response = $this->get('/');

        //測試localhost的status code是否為200
        $response->assertStatus(200);
    }

    public function test_console_command()
    {
        //測試訊息
        Artisan::command('question', function () {
            $name = $this->ask('What is your name?');
        
            $language = $this->choice('Which language do you prefer?', [
                'PHP',
                'Ruby',
                'Python',
            ]);
        
            $this->line('Your name is '.$name.' and you prefer '.$language.'.');
        });

        $this->artisan('question')
            ->expectsQuestion('What is your name?', 'Taylor Otwell')
            ->expectsQuestion('Which language do you prefer?', 'PHP')
            ->expectsOutput('Your name is Taylor Otwell and you prefer PHP.')
            ->doesntExpectOutput('Your name is Taylor Otwell and you prefer Ruby.')
            ->assertExitCode(0);
    }

    public function test_interacting_with_cookies()
    {
        //測試localhost的cookies參數，color的值為blue和name的值為Taylor
        $response = $this->withCookies([
            'color' => 'blue',
            'name' => 'Taylor',
        ])->get('/');
    }

    public function test_basic_test()
    {
        //測試localhost
        $response = $this->get('/');

        //顯示localhost的Header物件內容
        //$response->dumpHeaders();

        //顯示localhost的session物件內容
        //$response->dumpSession();

        //response->dump();
    }

    public function test_plus(){
        $a = 1;
        $b = 2;
        $response = $this->call('POST', '/plus', ['test1' => $a, 'test2' => $b]);

        $this->assertEquals(200, $response->status());
    }

    public function test_toSubtract(){
        $a = 5;
        $b = 2;
        $response = $this->call('POST', '/toSubtract', ['test1' => $a, 'test2' => $b]);

        $this->assertEquals(200, $response->status());
    }

    public function test_multiply(){
        $a = 4;
        $b = 3;
        $response = $this->call('POST', '/multiply', ['test1' => $a, 'test2' => $b]);

        $this->assertEquals(200, $response->status());
    }

    public function test_divided(){
        $a = 10;
        $b = 2;
        $response = $this->call('POST', '/divided', ['test1' => $a, 'test2' => $b]);

        $this->assertEquals(200, $response->status());
    }
}
