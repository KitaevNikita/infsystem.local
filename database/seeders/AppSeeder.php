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
use App\Models\Mark;

class AppSeeder extends Seeder
{
    // Минимальное и максимальное количество студентов в группе (для рандомной генерации).
    private const MIN_STUDENTS_PER_GROUP = 4;
    private const MAX_STUDENTS_PER_GROUP = 10;

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
    private const MR_1 = '1 МР';
    private const MR_2 = '2 МР';
    private const MR_3 = '3 МР';
    // НК
    private const NK_1 = '1 НК';
    private const NK_2 = '2 НК';
    private const NK_3 = '3 НК';
    private const NK_4 = '4 НК';
    // ДО
    private const DO_1 = '1 ДО';
    private const DO_2 = '2 ДО';
    private const DO_3 = '3 ДО';
    private const DO_4 = '4 ДО';
    // Ф
    private const F_1 = '1 Ф';
    private const F_2 = '2 Ф';
    private const F_3 = '3 Ф';
    private const F_4 = '4 Ф';

    /*
     * Массив связей специальностей и групп
     */
    private const GROUPS_FOR_SPECIALIZATIONS = [
        self::SPECIALIZATION_IS => [self::IS_1, self::IS_2, self::IS_3, self::IS_4],
        self::SPECIALIZATION_PC => [self::PC_1, self::PC_2, self::PC_3, self::PC_4],
        self::SPECIALIZATION_MR => [self::MR_1, self::MR_2, self::MR_3],
        self::SPECIALIZATION_NK => [self::NK_1, self::NK_2, self::NK_3, self::NK_4],
        self::SPECIALIZATION_DO => [self::DO_1, self::DO_2, self::DO_3, self::DO_4],
        self::SPECIALIZATION_F => [self::F_1, self::F_2, self::F_3, self::F_4]
    ];

    /*
     * Константы дисциплин
     */
    private const DISCIPLINE_PiRIP = 'Проектирование и разработка интерфейсов пользователя';
    private const DISCIPLINE_OPP = 'Объектно-ориентированное программирование';
    private const DISCIPLINE_RL = 'Русский язык';
    private const DISCIPLINE_OPD = 'Обеспечение проектной детельности';
    private const DISCIPLINE_PL = 'Языки программирования';
    private const DISCIPLINE_ML = 'Марийский язык';
    private const DISCIPLINE_H = 'История';
    private const DISCIPLINE_DM = 'Дискретная математика';
    private const DISCIPLINE_RKIS = 'Разработка кода информационных система';
    private const DISCIPLINE_OAiP = 'Основы алгоритмизации и программирования';
    private const DISCIPLINE_M = 'Математика';
    private const DISCIPLINE_IKT = 'Информатика и ИКТ';
    private const DISCIPLINE_PC = 'Физическая культура';
    private const DISCIPLINE_PSO = 'Психология сетевого общения';
    private const DISCIPLINE_EL = 'Английский язык';
    private const DISCIPLINE_O = 'Обществование';
    private const DISCIPLINE_L = 'Литература';
    private const DISCIPLINE_GDiM = 'Графический дизайн и мультимедиа';
    private const DISCIPLINE_F = 'Физика';
    private const DISCIPLINE_IT = 'Информационные технологии';
    private const DISCIPLINE_EHM = 'Элементы высшей математики  ';
    private const DISCIPLINE_FLS = 'Основы безопасности жизнедеятельности';
    private const DISCIPLINE_T = 'Черчение';
    private const DISCIPLINE_C = 'Химия';
    private const DISCIPLINE_RA = 'Ремонт автомобилей';
    private const DISCIPLINE_BNVFSDG = 'БНВФСД Гимнастива';
    private const DISCIPLINE_BNVFSDLS = 'БНВФСД Лыжный спорт';
    private const DISCIPLINE_BNVFSDT = 'БНВФСД Туризм';
    private const DISCIPLINE_BNVFSDLA = 'БНВФСД Легкая атлетика';
    private const DISCIPLINE_IVS = 'Избранный вид спорта';

    /*
     * Массив связей групп и дисциплин
     */
    private const DISCIPLINES_FOR_GROUPS = [
        self::IS_1 => [self::DISCIPLINE_PiRIP, self::DISCIPLINE_OPP],
        self::IS_2 => [self::DISCIPLINE_OPD, self::DISCIPLINE_OAiP],
        self::IS_3 => [self::DISCIPLINE_FLS, self::DISCIPLINE_IT],
        self::IS_4 => [self::DISCIPLINE_RKIS, self::DISCIPLINE_EHM],
        self::PC_1 => [self::DISCIPLINE_M, self::DISCIPLINE_FLS],
        self::PC_2 => [self::DISCIPLINE_RL, self::DISCIPLINE_O],
        self::PC_3 => [self::DISCIPLINE_H, self::DISCIPLINE_IKT],
        self::PC_4 => [self::DISCIPLINE_F, self::DISCIPLINE_L],
        self::MR_1 => [self::DISCIPLINE_RA, self::DISCIPLINE_M],
        self::MR_2 => [self::DISCIPLINE_RL, self::DISCIPLINE_T],
        self::MR_3 => [self::DISCIPLINE_F, self::DISCIPLINE_EL],
        self::NK_1 => [self::DISCIPLINE_ML, self::DISCIPLINE_PC],
        self::NK_2 => [self::DISCIPLINE_PSO, self::DISCIPLINE_L],
        self::NK_3 => [self::DISCIPLINE_RL, self::DISCIPLINE_O],
        self::NK_4 => [self::DISCIPLINE_PL, self::DISCIPLINE_IKT],
        self::DO_1 => [self::DISCIPLINE_PC, self::DISCIPLINE_ML],
        self::DO_2 => [self::DISCIPLINE_PSO, self::DISCIPLINE_L],
        self::DO_3 => [self::DISCIPLINE_RL, self::DISCIPLINE_O],
        self::DO_4 => [self::DISCIPLINE_EHM, self::DISCIPLINE_IKT],
        self::F_1 => [self::DISCIPLINE_IKT, self::DISCIPLINE_RL],
        self::F_2 => [self::DISCIPLINE_IVS, self::DISCIPLINE_C],
        self::F_3 => [self::DISCIPLINE_BNVFSDT, self::DISCIPLINE_BNVFSDLA],
        self::F_4 => [self::DISCIPLINE_BNVFSDG, self::DISCIPLINE_BNVFSDLS]
    ];

    /*
     * Массив связей дисциплин и лекций
     */
    private const LESSONS_FOR_DISCIPLINES = [
        self::DISCIPLINE_PiRIP => ['HTML', 'CSS', 'Верстка'],
        self::DISCIPLINE_OPP => ['Классы и объекты', 'Наследование'],
        self::DISCIPLINE_RL => ['Сложноподчинённое предложение с несколькими придаточными', 'Грамматический состав предложения', 'Однородные и неоднородные определения и приложения'],
        self::DISCIPLINE_OPD => ['Функциональные требования к информационной системе', 'Разработка рабочего прототипа информационной системы', 'Разработка инфологической модели предметной области'],
        self::DISCIPLINE_PL => ['Наследование, виртуальные функции, полиморфизм', 'Шаблоны С++', 'Знакомство с ООП'],
        self::DISCIPLINE_ML => ['Графика и орфография', 'Литературный язык – основа разных стилей', 'Место диалекта в языке'],
        self::DISCIPLINE_H => ['Россия и страны Дальнего Зарубежья', 'Отставка Б. Ельцина', 'Финансовый кризис 1998 г.'],
        self::DISCIPLINE_DM => ['Множества и функции', 'Мощность множеств', 'Перечислительная комбинаторика'],
        self::DISCIPLINE_RKIS => ['Сервисно - ориентированные архитектуры', 'Настройка среды разработки', 'Разработка и модификация информационных систем'],
        self::DISCIPLINE_OAiP => ['Основы алгоритмизации', 'Операторы цикла для реализации циклических алгоритмов', 'Операторы передачи управления для реализации разветвляющихся алгоритмов'],
        self::DISCIPLINE_M => ['Перпендикулярность прямой и плоскости в пространстве', 'Корни, степени, логарифмы', 'Арифметические действия над числами'],
        self::DISCIPLINE_IKT => ['Информация и информационные процессы', 'Технологии создания и преобразования информационных объектов', 'Средства ИКТ'],
        self::DISCIPLINE_PC => ['Граница интенсивности физической нагрузки', 'Средства и методы развития физических качеств', 'Физическая культура – часть общечеловеческой культуры'],
        self::DISCIPLINE_PSO => ['Цели и задачи информационных технологий', 'Информатизация образования', 'Личное пространство'],
        self::DISCIPLINE_EL => ['Студенческая жизнь', 'Ориентация в незнакомой местности. Знаки. Вывески', 'Английский язык в моей жизни'],
        self::DISCIPLINE_O => ['Современная цивилизация и политическая жизнь', 'Трудовая деятельность человека', 'Общество и общественные отношения'],
        self::DISCIPLINE_L => ['Александр Блок', 'Серебряный век русской литературы', 'Культура в России начала ХХ века.'],
        self::DISCIPLINE_GDiM => ['Компьютерная графика как область графического дизайна', 'Дизайн текстовых форм и илюстрирование', 'Оформление печатных изданий'],
        self::DISCIPLINE_F => ['Основы квантовой физики', 'Электродинамика', 'Законы механики Ньютона'],
        self::DISCIPLINE_IT => ['Программное обеспечение компьютера', 'Хранение информации. Передача информации', 'Информационные процессы. Общая характеристика'],
        self::DISCIPLINE_EHM => ['Произведение векторов', 'Функции нескольких переменных', 'Производные и дифференциалы высших порядков'],
        self::DISCIPLINE_FLS => ['Основы медицинских знаний', 'Основы обороны государства и воинская обязанность', 'Обеспечение личной безопасности и сохранение здоровья'],
        self::DISCIPLINE_T => ['Построение трех проекций по аксонометрии', 'Тела вращения. Проекции цилиндра', 'Инструменты, материалы и принадлежности для черчения'],
        self::DISCIPLINE_C => ['Закон объемных отношений газов', 'Закон Авогадро', 'Закон постоянства состава веществ.'],
        self::DISCIPLINE_RA => ['Виды, методы и система ремонта автомобилей', 'Основы организации КР автомобилей', 'Общие положения по ремонту автомобилей'],
        self::DISCIPLINE_BNVFSDG => ['Гимнастическая терминология', 'История развития гимнастики', 'Виды гимнастики и ее методические особенности'],
        self::DISCIPLINE_BNVFSDLS => ['История', 'Стили передвижения', 'Программа и правила'],
        self::DISCIPLINE_BNVFSDT => ['Классификация видов туризма', 'Проблемы сезонности в международном туризме', 'Туризм и туристские ресурсы стран Северной и Латинской Америки'],
        self::DISCIPLINE_BNVFSDLA => ['Основы подготовки легкоатлетов', 'Анализ техники бега на короткие, средние и длинные дистанции', 'Основы техники прыжков'],
        self::DISCIPLINE_IVS => ['Методика обучения технике нападения в баскетболе', 'Принципы, средства и методы обучения технике игры в баскетбол', 'История и развитие баскетбола'],
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

                // Создаем mark для каждой связи "Cтудент - Лекция" (многие ко многим).
                foreach($students as $student)
                {
                    $this->createMark($student, $lesson);
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
     * Создает экземпляр App\Models\Mark. 
     *
     * @param App\Models\Student $student
     * @param App\Models\Lesson $lesson
     *
     * @return void
     */
    private function createMark(Student $student, Lesson $lesson) : void
    {
        for ($i=0; $i < $lesson->number_of_hours; $i++) { 
            Mark::factory()
            ->count(1)
            ->for($student)
            ->for($lesson)
            ->create();
        }
    }
}
