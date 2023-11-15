<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutAppUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layout_app_users')->insert([
            'user_id' => 1,
            'navbar' => '#fffff',
            'sider' => '#fffff',
            'menu' => '#fffff',
        ]);
    }
}
