<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_apps')->insert([
            'nama' => 'Keluarga_Ma_Haya',
            'logo' => 'img/profile_app/logo.jpg',
            'foto' => 'img/profile_app/lembur.png',
            'logo_login' => 'img/profile_app/logo.jpg',
            'foto_login' => 'img/profile_app/lembur.png',
            'background_login' => 'img/profile_app/lembur.png',
            'footer' => 'KELUARGA BESAR Alm. MA HAYA &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;Copyright &copy; 2023 <a href="https://wa.me/6283825740395">Aldi Wahyudi</a>',
            'footer_login' => 'KELUARGA BESAR Alm. MA HAYA &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;Copyright &copy; 2023 <a href="https://wa.me/6283825740395">Aldi Wahyudi</a>',
            'info_login' => 'KELUARGA BESAR Alm. MA HAYA &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;Copyright &copy; 2023 <a href="https://wa.me/6283825740395">Aldi Wahyudi</a>',
            'title_login' => 'KELUARGA BESAR Alm. MA HAYA &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;Copyright &copy; 2023 <a href="https://wa.me/6283825740395">Aldi Wahyudi</a>',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
