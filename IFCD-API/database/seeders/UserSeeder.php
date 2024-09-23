<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "SUPER ADMIN",
            'email' => "SuperAdmin@ifcd.com",
            'password' => bcrypt('ifcdSuperAdmin@2024'),
            'role_id' => 1
        ]);

        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "Admin@ifcd.com",
            'password' => bcrypt('ifcdAdmin@2024'),
            'role_id' => 2
        ]);

        DB::table('users')->insert([
            'name' => "Author",
            'email' => "info@ifcd.com",
            'password' => bcrypt('ifcdAuthor@2024'),
            'role_id' => 3
        ]);
    }
}
