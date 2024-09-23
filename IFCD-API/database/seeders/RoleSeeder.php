<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => "super_admin",
            'add' => true,
            'edit' => true,
            'remove' => true,
            'setting' => true,
        ]);

        DB::table('roles')->insert([
            'name' => "admin",
            'add' => true,
            'edit' => true,
            'remove' => true,
            'setting' => false,
        ]);

        DB::table('roles')->insert([
            'name' => "author",
            'add' => true,
            'edit' => true,
            'remove' => true,
            'setting' => false,
        ]);
    }
}
