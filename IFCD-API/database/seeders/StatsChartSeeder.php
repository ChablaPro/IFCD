<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatsChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stat_charts')->insert([
            'mois' => "Janvier",
        ]);
        DB::table('stat_charts')->insert([
            'mois' => "Février",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Mars",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Avril",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Mai",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Juin",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Juillet",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Août",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Septembre",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Octobre",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Novembre",
        ]);

        DB::table('stat_charts')->insert([
            'mois' => "Décembre",
        ]);
    }
}
