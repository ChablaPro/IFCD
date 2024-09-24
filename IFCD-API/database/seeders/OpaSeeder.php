<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $opas = [
            ['name' => 'Coopérative'],
            ['name' => 'Association'],
            ['name' => "Groupe d'Intérêt Economique (GIE)"],
            ['name' => 'Union Communale']
        ];

        DB::table('type_o_p_a_s')->insert($opas);
    }
}
