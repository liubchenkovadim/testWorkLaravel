<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
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
                'name' => 'code writing',
                'key' => "writeCode"
            ],
            [
                'name' => 'code testing',
                'key' => "testingCode"
            ],
            [
                'name' => 'communication with manager',
                'key' => "communicationManager"
            ],
            [
                'name' => 'draw',
                'key' => "draw"
            ],
            [
                'name' => 'set tasks',
                'key' => "setTasks"
            ],

        ];
        foreach ($data as $item){
            DB::table('skill')->insert([
                'name' => $item['name'],
                'key' => $item['key'],
            ]);
        }
    }
}
