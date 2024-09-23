<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $communes = [
            // Alibori
            ['name' => 'Banikoara', 'department_id' => 1],
            ['name' => 'Gogounou', 'department_id' => 1],
            ['name' => 'Kandi', 'department_id' => 1],
            ['name' => 'Karimama', 'department_id' => 1],
            ['name' => 'Malanville', 'department_id' => 1],
            ['name' => 'Segbana', 'department_id' => 1],

            // Atacora
            ['name' => 'Boukoumbé', 'department_id' => 2],
            ['name' => 'Cobly', 'department_id' => 2],
            ['name' => 'Kérou', 'department_id' => 2],
            ['name' => 'Kouandé', 'department_id' => 2],
            ['name' => 'Matéri', 'department_id' => 2],
            ['name' => 'Natitingou', 'department_id' => 2],
            ['name' => 'Péhunco', 'department_id' => 2],
            ['name' => 'Tanguiéta', 'department_id' => 2],
            ['name' => 'Toucountouna', 'department_id' => 2],

            // Atlantique
            ['name' => 'Abomey-Calavi', 'department_id' => 3],
            ['name' => 'Allada', 'department_id' => 3],
            ['name' => 'Kpomassè', 'department_id' => 3],
            ['name' => 'Ouidah', 'department_id' => 3],
            ['name' => 'Sô-Ava', 'department_id' => 3],
            ['name' => 'Toffo', 'department_id' => 3],
            ['name' => 'Tori-Bossito', 'department_id' => 3],
            ['name' => 'Zè', 'department_id' => 3],

            // Borgou
            ['name' => 'Bembèrèkè', 'department_id' => 4],
            ['name' => 'Kalalé', 'department_id' => 4],
            ['name' => 'N\'Dali', 'department_id' => 4],
            ['name' => 'Nikki', 'department_id' => 4],
            ['name' => 'Parakou', 'department_id' => 4],
            ['name' => 'Pèrèrè', 'department_id' => 4],
            ['name' => 'Sinendé', 'department_id' => 4],
            ['name' => 'Tchaourou', 'department_id' => 4],

            // Collines
            ['name' => 'Bantè', 'department_id' => 5],
            ['name' => 'Dassa-Zoumè', 'department_id' => 5],
            ['name' => 'Glazoué', 'department_id' => 5],
            ['name' => 'Ouèssè', 'department_id' => 5],
            ['name' => 'Savalou', 'department_id' => 5],
            ['name' => 'Savè', 'department_id' => 5],

            // Couffo
            ['name' => 'Aplahoué', 'department_id' => 6],
            ['name' => 'Djakotomey', 'department_id' => 6],
            ['name' => 'Dogbo', 'department_id' => 6],
            ['name' => 'Klouékanmè', 'department_id' => 6],
            ['name' => 'Lalo', 'department_id' => 6],
            ['name' => 'Toviklin', 'department_id' => 6],

            // Donga
            ['name' => 'Bassila', 'department_id' => 7],
            ['name' => 'Copargo', 'department_id' => 7],
            ['name' => 'Djougou', 'department_id' => 7],
            ['name' => 'Ouaké', 'department_id' => 7],

            // Littoral
            ['name' => 'Cotonou', 'department_id' => 8],

            // Mono
            ['name' => 'Athiémé', 'department_id' => 9],
            ['name' => 'Bopa', 'department_id' => 9],
            ['name' => 'Comè', 'department_id' => 9],
            ['name' => 'Grand-Popo', 'department_id' => 9],
            ['name' => 'Houéyogbé', 'department_id' => 9],
            ['name' => 'Lokossa', 'department_id' => 9],

            // Ouémé
            ['name' => 'Adjarra', 'department_id' => 10],
            ['name' => 'Adjohoun', 'department_id' => 10],
            ['name' => 'Aguégués', 'department_id' => 10],
            ['name' => 'Akpro-Missérété', 'department_id' => 10],
            ['name' => 'Avrankou', 'department_id' => 10],
            ['name' => 'Bonou', 'department_id' => 10],
            ['name' => 'Dangbo', 'department_id' => 10],
            ['name' => 'Porto-Novo', 'department_id' => 10],
            ['name' => 'Sèmè-Podji', 'department_id' => 10],

            // Plateau
            ['name' => 'Ifangni', 'department_id' => 11],
            ['name' => 'Kétou', 'department_id' => 11],
            ['name' => 'Pobè', 'department_id' => 11],
            ['name' => 'Sakété', 'department_id' => 11],
            ['name' => 'Adja-Ouèrè', 'department_id' => 11],

            // Zou
            ['name' => 'Abomey', 'department_id' => 12],
            ['name' => 'Agbangnizoun', 'department_id' => 12],
            ['name' => 'Bohicon', 'department_id' => 12],
            ['name' => 'Covè', 'department_id' => 12],
            ['name' => 'Djidja', 'department_id' => 12],
            ['name' => 'Ouinhi', 'department_id' => 12],
            ['name' => 'Za-Kpota', 'department_id' => 12],
            ['name' => 'Zagnanado', 'department_id' => 12],
            ['name' => 'Zogbodomey', 'department_id' => 12],
        ];

        DB::table('communes')->insert($communes);
    }
}
