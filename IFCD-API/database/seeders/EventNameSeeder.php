<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chaines = [
            ['name' => '1) Atelier diagnostic, restitution, planification, bilan, etc'],
            ['name' => '2) Rencontre entre vendeur acheteurs/fournisseurs de biens et services'],
            ['name' => '3) Evènement pour sensibilisation des bénéficiaires']
        ];

        DB::table('event_names')->insert($chaines);
    }
}
