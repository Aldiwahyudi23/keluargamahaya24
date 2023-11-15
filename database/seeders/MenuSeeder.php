<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            'nama' => 'Master Data',
            'icon' => 'fas',
            'route_url_id' => 1,
            'deskripsi' => 'a',
        ]);
        DB::table('menus')->insert([
            'nama' => 'Setting Access',
            'icon' => 'fas',
            'route_url_id' => 1,
            'deskripsi' => 'a',
        ]);
    }
}
