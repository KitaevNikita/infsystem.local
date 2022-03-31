<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Helpers\AuthHelper;

class UserTest extends DuskTestCase
{
    /**
     * Тестори открытия приложения.
     *
     * @return void
     */
    public function testUserViewAny()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/users')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список пользователей')
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
                    ->visit('/users/create')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Добавить пользователя')
                    ->assertSee('Фамилия')
                    ->assertSee('Имя')
                    ->assertSee('Отчество')
                    ->assertSee('E-mail')
                    ->assertSee('Пароль')
                    ->assertSee('Роль')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('surname')
                    ->assertEnabled('name')
                    ->assertEnabled('patronymic')
                    ->assertEnabled('email')
                    ->assertEnabled('password')
                    ->assertEnabled('role');
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
                    ->visit('/users/1')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Хохлов Антонин Алексеевич')
                    ->assertSee('E-mail')
                    ->assertSee('Роль')
                    ->assertSee('Дата добавления')
                    ->assertSee('Дата последнего обновления')
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
                    ->visit('/users/1/edit')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Редактировать пользователя')
                    ->assertSee('Фамилия')
                    ->assertSee('Имя')
                    ->assertSee('Отчество')
                    ->assertSee('E-mail')
                    ->assertSee('Пароль')
                    ->assertSee('Роль')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('surname')
                    ->assertEnabled('name')
                    ->assertEnabled('patronymic')
                    ->assertEnabled('email')
                    ->assertEnabled('password')
                    ->assertEnabled('role');
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
                    ->visit('/users')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список пользователей')
                    ->assertSee('Добавить')
                    ->assertDontSee('Токарев');
        });
    }
}
