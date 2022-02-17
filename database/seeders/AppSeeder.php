<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
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
    // Минимальное и максимальное количество студентов в группе (для рандомной генерации).
    private const MIN_STUDENTS_PER_GROUP = 6;
    private const MAX_STUDENTS_PER_GROUP = 20;

    /*
     * Константы специализаций
     */
    private const SPECIALIZATION_IS = 'Информационные системы и технологии';
    private const SPECIALIZATION_PC = 'Повар, кондитер';
    private const SPECIALIZATION_MR = 'Мастер по ремонту и обслуживанию автомобилей';
    private const SPECIALIZATION_NK = 'Преподавание в начальных классах';
    private const SPECIALIZATION_DO = 'Дошкольное образование';
    private const SPECIALIZATION_F = 'Физическая культура';

    /*
     * Константы групп
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
    // МР
    // НК
    // ...

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
        // Создаем специализации.
        foreach(self::GROUPS_FOR_SPECIALIZATIONS as $specializationName => $groupNames) 
        {
            // Создаем специализацию.
            $specializationModel = $this->createSpecialization($specializationName);
            
            // Создаем группы для специализации.
            foreach($groupNames as $groupName)
            {
                // Создаем группу.
                $groupModel = $this->createGroup($groupName, $specializationModel);
                
                // Создаем студентов для группы.
                $studentModels = $this->createStudentsForGroup($groupModel);

                // Создаем дисциплины для группы.
                $disciplineModels = $this->createDisciplinesForGroup($groupModel);

                if(count($disciplineModels) > 0)
                {
                    // Создаем summarylists (все дисциплины группы для каждого студента группы).
                    foreach($studentModels as $studentModel)
                    {
                        foreach($disciplineModels as $disciplineModel)
                        {
                            $this->createSummarylist($studentModel, $disciplineModel);
                        }
                    }

                    // Создаем лекции для всех дисциплин группы, добавляем им студентов группы.
                    foreach($disciplineModels as $disciplineModel)
                    {
                        $this->createLessonsForDiscipline($disciplineModel, $studentModels);
                    }
                }
            }
        }
    }

    /*
     * Создает и возвращает экземпляр App\Models\Specialization. 
     *
     * @param string $specializationName | Название специализации
     *
     * @return App\Models\Specialization | Специализация
     */
    private function createSpecialization(string $specializationName) : Specialization
    {
        return Specialization::factory()
            ->count(1)
            ->createSpecializationByName($specializationName)
            ->create()[0];
    }

    /*
     * Создает и возвращает экземпляр App\Models\Group. 
     *
     * @param string $groupName | Название группы
     * @param App\Models\Specialization $specilization
     *
     * @return App\Models\Group | Группа
     */
    private function createGroup(string $groupName, Specialization $specialization) : Group
    {
        return Group::factory()
            ->count(1)
            ->createGroupByName($groupName)
            ->for($specialization)
            ->create()[0];
    }

    /*
     * Создает студентов для группы. 
     *
     * @param App\Models\Group $group
     *
     * @return Illuminate\Support\Collection
     */
    private function createStudentsForGroup(Group $group) : Collection
    {
        return Student::factory()
            ->count(rand(self::MIN_STUDENTS_PER_GROUP, self::MAX_STUDENTS_PER_GROUP))
            ->for($group)
            ->create();
    }

    /*
     * Создает дисциплины для группы.
     *
     * @param App\Models\Group $group
     *
     * @return Illuminate\Support\Collection
     */
    private function createDisciplinesForGroup(Group $group) : Collection
    {
        $disciplinesForGroup = new Collection();
        if(isset(self::DISCIPLINES_FOR_GROUPS[$group->namegroup]))
        {
            $disciplineNames = self::DISCIPLINES_FOR_GROUPS[$group->namegroup];
            foreach($disciplineNames as $disciplineName)
            {
                $disciplinesForGroup->push(
                    Discipline::factory()
                        ->count(1)
                        ->createDisciplineByName($disciplineName)
                        ->for($group)
                        ->create()[0]
                );
            }
        }
        return $disciplinesForGroup;
    }

    /*
     * Создает экземпляр App\Models\Summarylist. 
     *
     * @param App\Models\Student $student
     * @param App\Models\Discipline $discipline
     *
     * @return void
     */
    private function createSummarylist(Student $student, Discipline $discipline) : void
    {
        Summarylist::factory()
            ->count(1)
            ->for($student)
            ->for($discipline)
            ->create();
    }

    /*
     * Создает лекции для дисциплины. 
     *
     * @param App\Models\Discipline $discipline
     * @param Illuminate\Support\Collection $students | Студенты, связанные с дисциплиной
     *
     * @return void
     */
    private function createLessonsForDiscipline(Discipline $discipline, Collection $students) : void
    {
        if(self::LESSONS_FOR_DISCIPLINES[$discipline->name_of_the_discipline])
        {
            $lessonTopics = self::LESSONS_FOR_DISCIPLINES[$discipline->name_of_the_discipline];
            foreach($lessonTopics as $lessonTopic)
            {
                // Создаем лекцию
                $lesson = $this->createLesson($lessonTopic, $discipline, $students);

                // Создаем rate и acamedic для каждой связи "Cтудент - Лекция" (многие ко многим).
                foreach($students as $student)
                {
                    $this->createRate($student, $lesson);
                    $this->createAcademic($student, $lesson);
                }
            }                      
        }
    }

    /*
     * Создает и возвращает экземпляр App\Models\Lesson. 
     *
     * @param string $lessonTopic | Тема лекции
     * @param App\Models\Discipline $discipline
     * @param Illuminate\Support\Collection $students | Студенты, связанные с лекцией
     *
     * @return App\Models\Lesson | Лекция
     */
    private function createLesson(string $lessonTopic, Discipline $discipline, Collection $students) : lesson
    {
        return Lesson::factory()
            ->count(1)
            ->createLessonByTopic($lessonTopic)
            ->for($discipline)
            ->hasAttached($students)
            ->create()[0];
    }

    /*
     * Создает экземпляр App\Models\Rate. 
     *
     * @param App\Models\Student $student
     * @param App\Models\Lesson $lesson
     *
     * @return void
     */
    private function createRate(Student $student, Lesson $lesson) : void
    {
        Rate::factory()
            ->count(1)
            ->for($student)
            ->for($lesson)
            ->create();
    }

    /*
     * Создает экземпляр App\Models\Academic.
     *
     * @param App\Models\Student $student
     * @param App\Models\Lesson $lesson
     *
     * @return void
     */
    private function createAcademic(Student $student, Lesson $lesson) : void
    {
        Academic::factory()
            ->count(1)
            ->for($student)
            ->for($lesson)
            ->create();
    }
}
