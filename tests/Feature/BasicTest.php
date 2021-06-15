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
        $response = $this->get('/');

        $response->assertStatus(200);
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

    public function test_interacting_with_cookies()
    {
        $response = $this->withCookies([
            'color' => 'blue',
            'name' => 'Taylor',
        ])->get('/');
    }

    public function test_basic_test()
    {
        $response = $this->get('/');

        //$response->dumpHeaders();

        //$response->dumpSession();

        //response->dump();
    }
}
