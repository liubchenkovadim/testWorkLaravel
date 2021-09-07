<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
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
                'name' => 'programmer',
            ],
            [
                'name' => 'designer',
            ],
            [
                'name' => 'tester',
            ],
            [
                'name' => 'manager',
            ],

        ];
        foreach ($data as $item){
            DB::table('employee')->insert([
                'name' => $item['name'],
            ]);
        }

    }
}
