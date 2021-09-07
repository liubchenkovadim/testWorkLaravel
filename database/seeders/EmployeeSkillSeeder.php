<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'employee_id' => '1',
                'skill_id' => "1"
            ],
            [
                'employee_id' => '1',
                'skill_id' => "2"
            ],
            [
                'employee_id' => '1',
                'skill_id' => "3"
            ],
            [
                'employee_id' => '2',
                'skill_id' => "3"
            ],
            [
                'employee_id' => '2',
                'skill_id' => "4"
            ],
            [
                'employee_id' => '3',
                'skill_id' => "2"
            ],
            [
                'employee_id' => '3',
                'skill_id' => "3"
            ],
            [
                'employee_id' => '3',
                'skill_id' => "5"
            ],
            [
                'employee_id' => '4',
                'skill_id' => "5"
            ],

        ];
        foreach ($data as $item){
            DB::table('employee_skill')->insert([
                'employee_id' => $item['employee_id'],
                'skill_id' => $item['skill_id'],
            ]);
        }
    }
}
