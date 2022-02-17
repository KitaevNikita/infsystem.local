<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;
use App\Models\Group;
use App\Models\Discipline;
use App\Models\Student;
use App\Models\Summarylist;
use App\Models\lesson;
use App\Models\Rate;
use App\Models\Academic;

class AppSeeder extends Seeder
{
    // Минимальное и максимальное количество студентов в группе
    private const MIN_STUDENTS_PER_GROUP = 3;
    private const MAX_STUDENTS_PER_GROUP = 15;

    /*
     * Константы для специализаций
     */
    private const SPECIALIZATION_IS = 'Информационные системы и технологии';
    private const SPECIALIZATION_PC = 'Повар, кондитер';
    private const SPECIALIZATION_MR = 'Мастер по ремонту и обслуживанию автомобилей';
    private const SPECIALIZATION_NK = 'Преподавание в начальных классах';
    private const SPECIALIZATION_DO = 'Дошкольное образование';
    private const SPECIALIZATION_F = 'Физическая культура';

    /*
     * Константы для групп
     */
    // ИС
    private const IS_1 = '1 ИС';
    private const IS_2 = '2 ИС';
    private const IS_3 = '3 ИС';
    private const IS_4 = '4 ИС';
    // ПК
    private const PC_1 = '1 ПК';
    private const PC_2 = '2 ПК';
    private const PC_3 = '3 ПК';
    private const PC_4 = '4 ПК';

    /*
     * Массив связей специальностей и групп
     */
    private const GROUPS_FOR_SPECIALIZATIONS = [
        self::SPECIALIZATION_IS => [self::IS_1, self::IS_2, self::IS_3, self::IS_4],
        self::SPECIALIZATION_PC => [self::PC_1, self::PC_2, self::PC_3, self::PC_4],
        // self::SPECIALIZATION_MR => ['1МР', '2МР', '3МР'],
        // self::SPECIALIZATION_NK => ['1НК', '2НК', '3НК', '4НК'],
        // self::SPECIALIZATION_DO => ['1ДО', '2ДО', '3ДО', '4ДО'],
        // self::SPECIALIZATION_F => ['1Ф', '2Ф', '3Ф', '4Ф']
    ];

    /*
     * Константы дисциплин
     */
    private const DISCIPLINE_PiRIP = 'Проектирование и разработка интерфейсов пользователя';
    private const DISCIPLINE_OPP = 'Объектно-ориентированное программирование';

    /*
     * Массив связей групп и дисциплин
     */
    private const DISCIPLINES_FOR_GROUPS = [
        self::IS_1 => [self::DISCIPLINE_PiRIP, self::DISCIPLINE_OPP]
    ];

    /*
     * Массив связей дисциплин и лекций
     */
    private const LESSONS_FOR_DISCIPLINES = [
        self::DISCIPLINE_PiRIP => ['HTML', 'CSS', 'Верстка'],
        self::DISCIPLINE_OPP => ['Классы и объекты', 'Наследование']
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Создаем специализации
        foreach(self::GROUPS_FOR_SPECIALIZATIONS as $specializationName => $groupNames) 
        {
            // Создаем специализацию
            $specializationModel = Specialization::factory()
                ->count(1)
                ->createSpecializationByName($specializationName)
                ->create()[0];
            
            // Создаем группы для специализации
            foreach($groupNames as $groupName)
            {
                // Создаем группу
                $groupModel = Group::factory()
                    ->count(1)
                    ->createGroupByName($groupName, $specializationModel)
                    ->create()[0];
                
                // Создаем студентов для группы
                $studentModels = Student::factory()
                    ->count(rand(self::MIN_STUDENTS_PER_GROUP, self::MAX_STUDENTS_PER_GROUP))
                    ->createStudentForGroup($groupModel)
                    ->create();

                // Создаем дисциплины для группы
                $disciplineModels = [];
                if(isset(self::DISCIPLINES_FOR_GROUPS[$groupName]))
                {
                    $disciplineNames = self::DISCIPLINES_FOR_GROUPS[$groupName];
                    foreach($disciplineNames as $disciplineName)
                    {
                        array_push(
                            $disciplineModels,
                            Discipline::factory()
                                ->count(1)
                                ->createDisciplineByName($disciplineName, $groupModel)
                                ->create()[0]
                        );
                    }
                }

                // Создаем summarylists (все дисциплины группы для каждого студента группы)
                if(count($disciplineModels) > 0)
                {
                    foreach($studentModels as $student)
                    {
                        foreach($disciplineModels as $discipline)
                        {
                            Summarylist::factory()
                                ->count(1)
                                ->for($student)
                                ->for($discipline)
                                ->create();
                        }
                    }
                }

                // Создаем лекции для всех дисциплин группы, добавляем им студентов группы.
                foreach($disciplineModels as $disciplineModel)
                {
                    if(self::LESSONS_FOR_DISCIPLINES[$disciplineModel->name_of_the_discipline])
                    {
                        $lessonTopics = self::LESSONS_FOR_DISCIPLINES[$disciplineModel->name_of_the_discipline];
                        foreach($lessonTopics as $lessonTopic)
                        {
                            // Создаем лекцию
                            $lessonModel = Lesson::factory()
                                ->count(1)
                                ->createLessonByTopic($lessonTopic, $disciplineModel)
                                ->hasAttached($studentModels)
                                ->create()[0];

                            // Создаем rate и acamedic для каждой связи студент - лекция (многие ко многим).
                            foreach($studentModels as $studentModel)
                            {
                                Rate::factory()
                                    ->count(1)
                                    ->for($studentModel)
                                    ->for($lessonModel)
                                    ->create();

                                Academic::factory()
                                    ->count(1)
                                    ->for($studentModel)
                                    ->for($lessonModel)
                                    ->create();
                            }
                        }                      
                    }
                }
            }
        }
    }
}
