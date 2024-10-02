<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chaines = [
            ['name' => 'Domaine de Résultats 1'],
            ['name' => 'Domaine de Résultats 2'],
            ['name' => 'Domaine de Résultats 3'],
            ['name' => 'Communication'],
            ['name' => 'Suivi & Evaluation']
        ];

        DB::table('domaines')->insert($chaines);
    }
}
