<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Tests\Browser\Helpers\AuthHelper;

class LessonTest extends DuskTestCase
{
    /**
     * Тестори открытия приложения.
     *
     * @return void
     */
    public function testViewAny()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('teacher'))
                    ->visit('/disciplines')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Список учебных дисциплин')
                    ->assertSee('Провести');
        });
    }

    /**
     * Тест проведения занятия.
     *
     * @return void
     */
    public function testView()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('teacher'))
                    ->visit('/disciplines/1')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Проектирование и разработка интерфейсов пользователя')
                    ->assertSee('Ф.И.О. преподавателя')
                    ->assertSee('Количество часов')
                    ->assertSee('Промежуточная аттестация')
                    ->assertSee('Редактировать')
                    ->assertSee('На главную')
                    ->assertSee('Занятия')
                    ->assertSee('Добавить');
        });
    }

    /**
     * Тест просмотра.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(AuthHelper::getUserWithRole('teacher'))
                    ->visit('/disciplines/1/lessons/create')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Проектирование и разработка интерфейсов пользователя')
                    ->assertSee('Ф.И.О. преподавателя')
                    ->assertSee('Количество часов')
                    ->assertSee('Промежуточная аттестация')
                    ->assertSee('Редактировать')
                    ->assertSee('На главную')
                    ->assertSee('Занятия')
                    ->assertSee('Добавить')
                    ->assertSee('Тема')
                    ->assertSee('Тип')
                    ->assertSee('Количество часов')
                    ->assertSee('Дата проведения')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('topic')
                    ->assertEnabled('type')
                    ->assertEnabled('number_of_hours')
                    ->assertEnabled('date');
                    
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
            $browser->loginAs(AuthHelper::getUserWithRole('teacher'))
                    ->visit('/disciplines/1/lessons/1/edit')
                    ->assertTitle('Электронный журнал')
                    ->assertSee('Проектирование и разработка интерфейсов пользователя')
                    ->assertSee('Ф.И.О. преподавателя')
                    ->assertSee('Количество часов')
                    ->assertSee('Промежуточная аттестация')
                    ->assertSee('Редактировать')
                    ->assertSee('На главную')
                    ->assertSee('Занятия')
                    ->assertSee('Добавить')
                    ->assertSee('Тема')
                    ->assertSee('Тип')
                    ->assertSee('Количество часов')
                    ->assertSee('Дата проведения')
                    ->assertSee('Сохранить')
                    ->assertSee('На главную')
                    ->assertEnabled('topic')
                    ->assertEnabled('type')
                    ->assertEnabled('number_of_hours')
                    ->assertEnabled('date');
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
            $browser->loginAs(AuthHelper::getUserWithRole('teacher'))
                ->visit('/disciplines')
                ->assertTitle('Электронный журнал')
                ->assertSee('Список учебных дисциплин')
                ->assertSee('Провести')
                ->assertDontSee('Основы HTML');
        });
    }
}
