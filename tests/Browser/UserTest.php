<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testOpenApplication()
    {
        $user = User::where('role', 'training')->get()[0];

        $this->browse(function (Browser $browser) {
            $browser->loginAs($user)
                ->visit('/admin/users/index')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список пользователей')
                    ->assertSee('Добавить')
                    ->assertSee('Просмотреть')
                    ->assertSee('Редактировать')
                    ->assertSee('Удалить');
        });
    }
}
