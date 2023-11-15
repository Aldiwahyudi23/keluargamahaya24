<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('access_menus')->insert([
            'Menu_id' => 1,
            'role_id' => 1,
        ]);
        DB::table('access_menus')->insert([
            'Menu_id' => 2,
            'role_id' => 1,
        ]);
    }
}
