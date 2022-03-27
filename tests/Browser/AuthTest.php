<?php
 
namespace Tests\Browser;
 
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
 
class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;
 
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLoginAsTraining()
    {
        $user = User::where('role', 'training')->get();
        dd($user);
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Войти')
                    ->assertPathIs('/home');
        });
    }
}