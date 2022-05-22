<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Helpers\AuthHelper;

class DisciplineTest extends DuskTestCase
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
                    ->visit('/disciplines')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список учебных дисциплин')
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
                    ->visit('/disciplines/create')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Добавить дисциплину')
                    ->assertSee('Название дисциплины')
                    ->assertSee('Ф.И.О.')
                    ->assertSee('Количество часов')
                    ->assertSee('Промежуточная аттестация')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('name_of_the_discipline')
                    ->assertEnabled('teacher')
                    ->assertEnabled('number_hours')
                    ->assertEnabled('certification');
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
                    ->visit('/disciplines/1')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Проектирование и разработка интерфейсов пользователя (Никифороваа Олеся Борисовна)')
                    ->assertSee('Группа')
                    ->assertSee('Количество часов')
                    ->assertSee('Промежуточная аттестация')
                    ->assertSee('Редактировать')
                    ->assertSee('Отчет')
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
                    ->visit('/disciplines/1/edit')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Редактировать дисциплину')
                    ->assertSee('Название дисциплины')
                    ->assertSee('Ф.И.О.')
                    ->assertSee('Количество часов')
                    ->assertSee('Промежуточная аттестация')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('name_of_the_discipline')
                    ->assertEnabled('teacher')
                    ->assertEnabled('number_hours')
                    ->assertEnabled('certification');
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
                    ->visit('/disciplines')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список учебных дисциплин')
                    ->assertSee('Добавить')
                    ->assertDontSee('Основы HTML');
        });
    }
}
