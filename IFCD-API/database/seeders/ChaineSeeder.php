<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chaines = [
            ['name' => 'Maïs'],
            ['name' => 'Soja'],
            ['name' => 'Huile rouge'],
            ['name' => 'Arachide'],
            ['name' => 'Piment'],
            ['name' => 'Manioc'],
            ['name' => 'Poisson'],
            ['name' => 'Maraîchage'],
            ['name' => 'Vollailes'],
            ['name' => 'Petits ruminants']
        ];

        DB::table('chaines')->insert($chaines);
    }
}
