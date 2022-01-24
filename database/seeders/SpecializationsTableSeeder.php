<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\Group;
use App\Models\Discipline;
use Illuminate\Database\Seeder;

class SpecializationsTableSeeder extends Seeder
{
    private const GROUPS_FOR_SPECIALIZATIONS = [
        'Информационные системы и технологии' => ['1ИС', '2ИС', '3ИС', '4ИС'],
        'Повар, кондитер' => ['1ПК', '2ПК', '3ПК', '4ПК'],
        'Мастер по ремонту и обслуживанию автомобилей' => ['1МР', '2МР', '3МР'],
        'Преподавание в начальных классах' => ['1НК', '2НК', '3НК', '4НК'],
        'Дошкольное образование' => ['1ДО', '2ДО', '3ДО', '4ДО'],
        'Физическая культура' => ['1Ф', '2Ф', '3Ф', '4Ф']
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $iterationsCount = 0;
        $disciplines = Discipline::all();
        foreach(self::GROUPS_FOR_SPECIALIZATIONS as $specializationName => $groups) 
        {
            $specializations = Specialization::factory()
                ->count(1)
                ->createSpecializationByName($specializationName)
                ->create();
            $specialization = $specializations[0];
            
            foreach($groups as $group)
            {
                $groupModel = Group::factory()
                    ->count(1)
                    ->createGroupByName($group, $specialization, $disciplines[$iterationsCount])
                    ->create();

                $iterationsCount++;
                if($iterationsCount == count($disciplines))
                {
                    $iterationsCount = 1;
                }
            }
        }
    }
}
