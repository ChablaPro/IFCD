<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Liste des villages associés à chaque arrondissement
        $villages = [
            // Alibori
            // Arrondissement de Banikoara (id 1)
            ['name' => 'Kokey', 'arrondissement_id' => 1],
            ['name' => 'Gansosso', 'arrondissement_id' => 1],
            ['name' => 'Sori', 'arrondissement_id' => 1],
            ['name' => 'Gourou', 'arrondissement_id' => 1],

            // Arrondissement de Gogounou (id 2)
            ['name' => 'Gounarou', 'arrondissement_id' => 2],
            ['name' => 'Gogounou-Centre', 'arrondissement_id' => 2],
            ['name' => 'Bagou', 'arrondissement_id' => 2],
            
            // Borgou
            // Arrondissement de Parakou (id 3)
            ['name' => 'Wansirou', 'arrondissement_id' => 3],
            ['name' => 'Lafia', 'arrondissement_id' => 3],
            ['name' => 'Titirou', 'arrondissement_id' => 3],

            // Donga
            // Arrondissement de Djougou (id 4)
            ['name' => 'Bare', 'arrondissement_id' => 4],
            ['name' => 'Gah', 'arrondissement_id' => 4],
            ['name' => 'Kpérou', 'arrondissement_id' => 4],

            // Atlantique
            // Arrondissement de Abomey-Calavi (id 5)
            ['name' => 'Godomey', 'arrondissement_id' => 5],
            ['name' => 'Zinvié', 'arrondissement_id' => 5],
            ['name' => 'Akassato', 'arrondissement_id' => 5],
            
            // Littoral
            // Arrondissement de Cotonou (id 6)
            ['name' => 'Cadjèhoun', 'arrondissement_id' => 6],
            ['name' => 'Vêdoko', 'arrondissement_id' => 6],
            ['name' => 'Sainte-Rita', 'arrondissement_id' => 6],

            // Ajoutez d'autres villages en respectant la structure
            // ['name' => 'Nom du village', 'arrondissement_id' => ID de l'arrondissement],
        ];

        // Insérer les villages dans la table 'villages'
        DB::table('villages')->insert($villages);
    }
}
