<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Layout_Pemasukan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(DataWargaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AllRouteUrlSeeder::class);
        $this->call(ProfileAppSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SubMenuSeeder::class);
        $this->call(AccessMenuSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(LayoutAppUserSeeder::class);
        $this->call(AccessSubMenuSeeder::class);
        $this->call(LayoutPemasukanSeeder::class);
        $this->call(LayoutPengeluaranSeeder::class);
    }
}
