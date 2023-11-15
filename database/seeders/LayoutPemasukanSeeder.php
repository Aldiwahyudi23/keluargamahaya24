<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutPemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layout__pemasukans')->insert(
            [
                'id' => 1,
                'tittle' => 'Pemasukan',
                'info_proses' => 'Proses',
                'gambar' => 'Pemasukan',

            ]
        );
    }
}
