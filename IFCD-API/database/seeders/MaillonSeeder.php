<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaillonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maillons = [
            ['name' => 'Production végétale'],
            ['name' => 'Transformation'],
            ['name' => 'Commercialisation'],
            ['name' => 'Production animale'],
            ['name' => 'Fourniture de biens et services'],
            ['name' => 'Acteurs Publics'],
            ['name' => 'ATDA4'],
            ['name' => 'CCIC'],
            ['name' => 'GIC'],
            ['name' => 'INRAB'],
            ['name' => 'Transporteur'],
            ['name' => 'mPME'],
        ];

        DB::table('maillons')->insert($maillons);
    }
}
