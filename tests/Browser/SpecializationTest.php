<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Helpers\AuthHelper;

class SpecializationTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testUserViewAny()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/specializations')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список специальностей')
                    ->assertSee('Добавить');
        });
    }
}
