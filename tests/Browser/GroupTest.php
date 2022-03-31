<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Helpers\AuthHelper;

class GroupTest extends DuskTestCase
{
    /**
     * Тестори открытия приложения.
     *
     * @return void
     */
    public function testViewAny()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/groups')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список групп')
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
                    ->visit('/groups/create')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Добавить группу')
                    ->assertSee('Название группы')
                    ->assertSee('Специальность')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('namegroup')
                    ->assertEnabled('specialization_id');
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
                    ->visit('/groups/1')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Детали группы')
                    ->assertSee('Название группы')
                    ->assertSee('Дата создания')
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
                    ->visit('/groups/1/edit')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Редактировать группу')
                    ->assertSee('Название группы')
                    ->assertSee('Специальность')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('namegroup')
                    ->assertEnabled('specialization_id');
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
                    ->visit('/groups')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список групп')
                    ->assertSee('Добавить')
                    ->assertDontSee('6ПК');
        });
    }
}
