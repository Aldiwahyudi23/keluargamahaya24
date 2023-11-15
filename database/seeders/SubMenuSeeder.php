<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_menus')->insert([
            'id' => 1,
            'nama' => 'Data Menu',
            'icon' => 'fas',
            'route_url_id' => 2,
            'menu_id' => 1,
            'is_active' => 1,
            'deskripsi' => 'a'
        ]);
        DB::table('sub_menus')->insert([
            'id' => 2,
            'nama' => 'Data Sub Menu',
            'icon' => 'fas',
            'route_url_id' => 3,
            'menu_id' => 1,
            'is_active' => 1,
            'deskripsi' => 'a'
        ]);
        DB::table('sub_menus')->insert([
            'id' => 3,
            'nama' => 'Access Menu',
            'icon' => 'fas',
            'route_url_id' => 6,
            'menu_id' => 1,
            'is_active' => 1,
            'deskripsi' => 'a'
        ]);
        DB::table('sub_menus')->insert([
            'id' => 4,
            'nama' => 'Access Sub Menu',
            'icon' => 'fas',
            'route_url_id' => 7,
            'menu_id' => 1,
            'is_active' => 1,
            'deskripsi' => 'a'
        ]);
    }
}
