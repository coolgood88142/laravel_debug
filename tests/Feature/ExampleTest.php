<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use App\Models\User;
use Artisan;

class ExampleTest extends TestCase
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

    public function test_interacting_with_headers()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->get('/');

        $response->assertStatus(200);
    }

    //瀏覽器中必須要cookie參數
    public function test_interacting_with_cookies()
    {
        // $response = $this->withCookie('color', 'blue')->get('/');

        $response = $this->withCookies([
            'color' => 'blue',
            'name' => 'Taylor',
        ])->get('/');
    }

    public function test_interacting_with_the_session()
    {
        $response = $this->withSession(['banned' => false])->get('/');
    }

    public function test_console_command()
    {
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

    public function tedt_console_table(){
        $this->artisan('users:all')
            ->expectsTable([
                'ID',
                'Email',
            ], [
                [1, 'taylor@example.com'],
                [2, 'abigail@example.com'],
            ]);
    }

    public function test_basic_test()
    {
        $response = $this->get('/');

        //$response->dumpHeaders();

        //$response->dumpSession();

        //$response->dump();
    }

    public function test_models_can_be_instantiated()
    {
        $user = User::factory()->count(3)->make();

        // Use model in tests...
        
        $user = User::factory()->make([
            'name' => 'Abigail Otwell',
        ])->make();
    }
}
