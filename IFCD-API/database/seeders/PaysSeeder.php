<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chaines = [
            ['name' => 'Bénin'],
            ['name' => 'Togo'],
            ['name' => 'Ghana']
        ];

        DB::table('pays')->insert($chaines);
    }
}
