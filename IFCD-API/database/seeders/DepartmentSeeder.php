<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['name' => 'Alibori'],
            ['name' => 'Atacora'],
            ['name' => 'Atlantique'],
            ['name' => 'Borgou'],
            ['name' => 'Collines'],
            ['name' => 'Couffo'],
            ['name' => 'Donga'],
            ['name' => 'Littoral'],
            ['name' => 'Mono'],
            ['name' => 'Ouémé'],
            ['name' => 'Plateau'],
            ['name' => 'Zou'],
        ];

        DB::table('departments')->insert($departments);
    }
}
