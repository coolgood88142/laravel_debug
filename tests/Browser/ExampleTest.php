<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }

    // public function test_basic_example()
    // {
    //     $user = User::factory()->create([
    //         'email' => 'taylor@laravel.com',
    //     ]);

    //     $this->browse(function ($browser) use ($user) {
    //         $browser->visit('/login')
    //                 ->type('email', $user->email)
    //                 ->type('password', 'password')
    //                 ->press('Login')
    //                 ->assertPathIs('/home');
    //     });

    //     $browser->visit('/login');

    //     $this->browse(function ($first, $second) {
    //         $first->loginAs(User::find(1))
    //               ->visit('/home')
    //               ->waitForText('Message');
        
    //         $second->loginAs(User::find(2))
    //                ->visit('/home')
    //                ->waitForText('Message')
    //                ->type('message', 'Hey Taylor')
    //                ->press('Send');
        
    //         $first->waitForText('Hey Taylor')
    //               ->assertSee('Jeffrey Way');
    //     });
    // }
}
