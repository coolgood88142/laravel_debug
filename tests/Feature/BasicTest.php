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
        //執行route localhost
        $response = $this->get('/');

        //測試localhost的status code是否為200
        $response->assertStatus(200);
    }

    public function test_console_command()
    {
        //測試訊息名稱為question
        Artisan::command('question', function () {

            //建立問題What is your name?(你叫什麼名字?)
            $name = $this->ask('What is your name?');
        

            //建立問題Which language do you prefer?(你喜歡哪種程式語言?)
            //PHP、Ruby、Python
            $language = $this->choice('Which language do you prefer?', [
                'PHP',
                'Ruby',
                'Python',
            ]);
        
            $this->line('Your name is '.$name.' and you prefer '.$language.'.');
        });

        //測試訊息名稱為question
        $this->artisan('question')
            //建立問題What is your name?(你叫什麼名字?)，答：Taylor Otwell
            ->expectsQuestion('What is your name?', 'Taylor Otwell')
            //建立問題Which language do you prefer?(你喜歡哪種程式語言?)，答：PHP
            ->expectsQuestion('Which language do you prefer?', 'PHP')
            //顯示你要的訊息Your name is Taylor Otwell and you prefer PHP
            ->expectsOutput('Your name is Taylor Otwell and you prefer PHP.')
            //顯示測試訊息Your name is Taylor Otwell and you prefer Ruby.
            ->doesntExpectOutput('Your name is Taylor Otwell and you prefer Ruby.')
            //結束
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
        //執行route localhost
        $response = $this->get('/');

        //顯示localhost的Header物件內容
        //$response->dumpHeaders();

        //顯示localhost的session物件內容
        //$response->dumpSession();

        //整個顯示localhost的response物件
        //response->dump();
    }

    

    public function test_plus(){
        $a = 1;
        $b = 2;
        
        //呼叫route plus，使用POST，帶test1與test2參數
        $response = $this->call('POST', '/plus', ['test1' => $a, 'test2' => $b]);

        //測試上一句的route plus，status code是否為200
        $this->assertEquals(200, $response->status());
    }

    public function test_toSubtract(){
        $a = 5;
        $b = 2;

        //呼叫route toSubtract，使用POST，帶test1與test2參數
        $response = $this->call('POST', '/toSubtract', ['test1' => $a, 'test2' => $b]);

        //測試上一句的route plus，status code是否為200
        $this->assertEquals(200, $response->status());
    }

    public function test_multiply(){
        $a = 4;
        $b = 3;

        //呼叫route multiply，使用POST，帶test1與test2參數
        $response = $this->call('POST', '/multiply', ['test1' => $a, 'test2' => $b]);

        //測試上一句的route plus，status code是否為200
        $this->assertEquals(200, $response->status());
    }

    public function test_divided(){
        $a = 10;
        $b = 2;

        //呼叫route divided，使用POST，帶test1與test2參數
        $response = $this->call('POST', '/divided', ['test1' => $a, 'test2' => $b]);

        //測試上一句的route plus，status code是否為200
        $this->assertEquals(200, $response->status());
    }
}
