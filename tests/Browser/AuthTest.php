<?php
 
namespace Tests\Browser;
 
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
 
class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;
 
    public function testLoginAsTraining()
    {
        $this->loginAsRoleName('training');
    }

    public function testLoginAsTeacher()
    {
        $this->loginAsRoleName('teacher');
    }

    private function loginAsRoleName(string $roleName)
    {
        $users = User::where('role', $roleName)->get();
        $user;
        if(count($users) < 0)
        {
            if($roleName == 'training')
            {
                $user = User::factory()
                    ->count(1)
                    ->training()
                    ->create();
            }
            else if($roleName == 'teacher')
            {
                $user = User::factory()
                    ->count(1)
                    ->teacher()
                    ->create();
            }
        }
        else
        {
            $user = $users[0];
        }
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Войти')
                    ->assertPathIs('/home');
        });
    }
}