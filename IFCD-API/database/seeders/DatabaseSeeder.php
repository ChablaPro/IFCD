<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                RoleSeeder::class,
                UserSeeder::class,


                DepartmentSeeder::class,
                CommuneSeeder::class,
                ArrondissementSeeder::class,
                JuridiqueSeeder::class,
                MaillonSeeder::class,
                OpaSeeder::class,
                PositionSeeder::class,
                VillageSeeder::class,
                ChaineSeeder::class,
                DomaineSeeder::class,
                EventNameSeeder::class,
                PaysSeeder::class

            ]
        );
    }
}
