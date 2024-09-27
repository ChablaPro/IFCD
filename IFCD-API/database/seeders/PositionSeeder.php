<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            ['name' => 'Maïs'],
            ['name' => 'Soja'],
            ['name' => 'Huile rouge'],
            ['name' => 'Arachide'],
            ['name' => 'Piment'],
            ['name' => 'Manioc'],
            ['name' => 'Poisson'],
            ['name' => 'Maraîchage'],
            ['name' => 'Volaïlles'],
            ['name' => 'Petits ruminants']
        ];

        DB::table('positions')->insert($positions);
    }
}
