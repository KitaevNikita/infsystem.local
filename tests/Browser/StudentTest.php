<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Helpers\AuthHelper;

class StudentTest extends DuskTestCase
{
    /**
     * Тест открытия приложения.
     *
     * @return void
     */
    public function testViewAny()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('training'))
                    ->visit('/students')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список студентов')
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
                    ->visit('/students/create')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Добавить студента')
                    ->assertSee('Фамилия')
                    ->assertSee('Имя')
                    ->assertSee('Отчество')
                    ->assertSee('E-mail')
                    ->assertSee('Пароль')
                    ->assertSee('Роль')
                    ->assertSee('Номер студенческого')
                    ->assertSee('Группа')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('name')
                    ->assertEnabled('surname')
                    ->assertEnabled('patronymic')
                    ->assertEnabled('email')
                    ->assertEnabled('password')
                    ->assertEnabled('role')
                    ->assertEnabled('number')
                    ->assertEnabled('group_id');
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
                    ->visit('/students/1')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Детали студента')
                    ->assertSee('Фамилия')
                    ->assertSee('Имя')
                    ->assertSee('Отчество')
                    ->assertSee('Номер студенческого')
                    ->assertSee('Группа')
                    ->assertSee('Дата создания')
                    ->assertSee('Дата редактирования')
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
                    ->visit('/students/1/edit')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Редактировать студента')
                    ->assertSee('Фамилия')
                    ->assertSee('Имя')
                    ->assertSee('Отчество')
                    ->assertSee('E-mail')
                    ->assertSee('Пароль')
                    ->assertSee('Роль')
                    ->assertSee('Номер студенческого')
                    ->assertSee('Группа')
                    ->assertEnabled('name')
                    ->assertEnabled('surname')
                    ->assertEnabled('patronymic')
                    ->assertEnabled('email')
                    ->assertEnabled('password')
                    ->assertEnabled('role')
                    ->assertEnabled('number')
                    ->assertEnabled('group_id')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную');
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
                    ->visit('/students')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список студентов')
                    ->assertSee('Добавить')
                    ->assertDontSee('Назар');
        });
    }
}
