<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JuridiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $juridiques = [
            ['name' => 'Simplifiée'],
            ['name' => 'Coopérative avec CA']
        ];

        DB::table('juridiques')->insert($juridiques);
    }
}
