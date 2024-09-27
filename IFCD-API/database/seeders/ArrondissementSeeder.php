<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArrondissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrondissements = [
            // Banikoara
            ['name' => 'Banikoara', 'commune_id' => 1],
            ['name' => 'Founougo', 'commune_id' => 1],
            ['name' => 'Gomparou', 'commune_id' => 1],
            ['name' => 'Kokey', 'commune_id' => 1],
            ['name' => 'Ounet', 'commune_id' => 1],
            ['name' => 'Sompega', 'commune_id' => 1],

            // Gogounou
            ['name' => 'Gogounou', 'commune_id' => 2],
            ['name' => 'Bagou', 'commune_id' => 2],
            ['name' => 'Gounarou', 'commune_id' => 2],
            ['name' => 'Ouara', 'commune_id' => 2],
            ['name' => 'Sori', 'commune_id' => 2],
            ['name' => 'Zougou-Pantrossi', 'commune_id' => 2],

            // Kandi
            ['name' => 'Angaradébou', 'commune_id' => 3],
            ['name' => 'Bensékou', 'commune_id' => 3],
            ['name' => 'Donwari', 'commune_id' => 3],
            ['name' => 'Gansosso', 'commune_id' => 3],
            ['name' => 'Kandi I', 'commune_id' => 3],
            ['name' => 'Kandi II', 'commune_id' => 3],
            ['name' => 'Kandi III', 'commune_id' => 3],

            // Karimama
            ['name' => 'Karimama', 'commune_id' => 4],
            ['name' => 'Birni-Lafia', 'commune_id' => 4],
            ['name' => 'Kompa', 'commune_id' => 4],

            // Malanville
            ['name' => 'Garou', 'commune_id' => 5],
            ['name' => 'Guénè', 'commune_id' => 5],
            ['name' => 'Malanville', 'commune_id' => 5],

            // Segbana
            ['name' => 'Libantè', 'commune_id' => 6],
            ['name' => 'Segbana', 'commune_id' => 6],
            ['name' => 'Sérékali', 'commune_id' => 6],

            // Boukoumbé
            ['name' => 'Boukoumbé', 'commune_id' => 7],
            ['name' => 'Dipoli', 'commune_id' => 7],
            ['name' => 'Korontière', 'commune_id' => 7],
            ['name' => 'Kossoucoingou', 'commune_id' => 7],
            ['name' => 'Tabota', 'commune_id' => 7],

            // Natitingou
            ['name' => 'Natitingou I', 'commune_id' => 8],
            ['name' => 'Natitingou II', 'commune_id' => 8],
            ['name' => 'Natitingou III', 'commune_id' => 8],
            ['name' => 'Perma', 'commune_id' => 8],
            ['name' => 'Kotopounga', 'commune_id' => 8],

            // Abomey-Calavi
            ['name' => 'Abomey-Calavi', 'commune_id' => 9],
            ['name' => 'Akassato', 'commune_id' => 9],
            ['name' => 'Godomey', 'commune_id' => 9],
            ['name' => 'Ouèdo', 'commune_id' => 9],
            ['name' => 'Togba', 'commune_id' => 9],

            // Porto-Novo
            ['name' => 'Porto-Novo I', 'commune_id' => 10],
            ['name' => 'Porto-Novo II', 'commune_id' => 10],
            ['name' => 'Porto-Novo III', 'commune_id' => 10],
            ['name' => 'Porto-Novo IV', 'commune_id' => 10],

            // Parakou
            ['name' => 'Parakou I', 'commune_id' => 11],
            ['name' => 'Parakou II', 'commune_id' => 11],
            ['name' => 'Parakou III', 'commune_id' => 11],

            // Cotonou
            ['name' => 'Cotonou I', 'commune_id' => 12],
            ['name' => 'Cotonou II', 'commune_id' => 12],
            ['name' => 'Cotonou III', 'commune_id' => 12],
            ['name' => 'Cotonou IV', 'commune_id' => 12],
            ['name' => 'Cotonou V', 'commune_id' => 12],
            ['name' => 'Cotonou VI', 'commune_id' => 12],
            ['name' => 'Cotonou VII', 'commune_id' => 12],
            ['name' => 'Cotonou VIII', 'commune_id' => 12],
            ['name' => 'Cotonou IX', 'commune_id' => 12],
            ['name' => 'Cotonou X', 'commune_id' => 12],
            ['name' => 'Cotonou XI', 'commune_id' => 12],
            ['name' => 'Cotonou XII', 'commune_id' => 12],
            ['name' => 'Cotonou XIII', 'commune_id' => 12],

        ];

        DB::table('arrondissements')->insert($arrondissements);
    }
}
