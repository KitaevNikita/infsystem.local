<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Helpers\AuthHelper;

class SpecializationTest extends DuskTestCase
{
    /**
     * Тестори открытия приложения
     *
     * @return void
     */
    public function testViewAny()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/specializations')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список специальностей')
                    ->assertSee('Добавить');
        });
    }

    /**
     * Тест добавления.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/specializations/create')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Добавить специальность')
                    ->assertSee('Название специальности')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('namespec');
        });
    }

    /**
     * Тест просмотра.
     *
     * @return void
     */
    public function testShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/specializations/1')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Детали специальности')
                    ->assertSee('Название специальности')
                    ->assertSee('Редактировать')
                    ->assertSee('На главную');
        });
    }

    /**
     * Тест редактирования.
     *
     * @return void
     */
    public function testEdit()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/specializations/1/edit')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Редактировать специальность')
                    ->assertSee('Название специальности')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('namespec');
        });
    }

    /**
     * Тест удаления.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/specializations')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список специальностей')
                    ->assertSee('Добавить')
                    ->assertDontSee('Прикладная информатика');
        });
    }
}
