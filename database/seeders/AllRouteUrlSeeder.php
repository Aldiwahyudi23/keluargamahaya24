<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllRouteUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('all_route_urls')->insert([
            'nama' => 'Home',
            'route_name' => 'home',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Menu Index',
            'route_name' => 'menu.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Sub Menu Index',
            'route_name' => 'sub-menu.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Route Index',
            'route_name' => 'route-url.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Role Index',
            'route_name' => 'role.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Access Menu Index',
            'route_name' => 'access-menu.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Access Menu Index',
            'route_name' => 'access-sub-menu.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Menu Sampah',
            'route_name' => 'menu.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Sub Menu Sampah',
            'route_name' => 'sub-menu.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Route Sampah',
            'route_name' => 'route-urls.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([
            'nama' => 'Role Sampah',
            'route_name' => 'role.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Access Menu Sampah',
            'route_name' => 'access-menu.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Profile App',
            'route_name' => 'profile-app.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Layout Login',
            'route_name' => 'profile-app-login',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Data Warga Index',
            'route_name' => 'data-warga.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Data Mneu Footer',
            'route_name' => 'menu_footer.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Access Program User Index',
            'route_name' => 'access-program.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Program Index',
            'route_name' => 'program.index',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Halaman Mobile Setting',
            'route_name' => 'set',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Profile Edit Data',
            'route_name' => 'profile.edit.data',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Sampah Data Warga',
            'route_name' => 'data-warga.trash',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Profile Index',
            'route_name' => 'profile-user.index',
            'deskripsi' => 'a',
        ]);


        DB::table('all_route_urls')->insert([

            'nama' => 'Edit Email Index',
            'route_name' => 'pengaturan.email',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Edit Password Index',
            'route_name' => 'pengaturan.password',
            'deskripsi' => 'a',
        ]);
        DB::table('all_route_urls')->insert([

            'nama' => 'Program Pilih Index',
            'route_name' => 'program.pilih',
            'deskripsi' => 'a',
        ]);
    }
}
