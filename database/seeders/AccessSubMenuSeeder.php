<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessSubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('access_sub_menus')->insert([
            'id' => 1,
            'user_id' => 1,
            'menu_id' => 1,
            'sub_menu_id' => 1,
        ]);
        DB::table('access_sub_menus')->insert([
            'id' => 2,
            'user_id' => 1,
            'menu_id' => 1,
            'sub_menu_id' => 2,
        ]);
        DB::table('access_sub_menus')->insert([
            'id' => 3,
            'user_id' => 1,
            'menu_id' => 2,
            'sub_menu_id' => 3,
        ]);
        DB::table('access_sub_menus')->insert([
            'id' => 4,
            'user_id' => 1,
            'menu_id' => 2,
            'sub_menu_id' => 4,
        ]);
    }
}
