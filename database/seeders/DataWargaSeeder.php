<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataWargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_wargas')->insert([
            'nama' => 'Aldi Wahyudi',
            'jenis_kelamin' => 'Laki-Laki',
            'tempat_lahir' => 'Gaarut',
            'tanggal_lahir' => date('Y-m-d H:i:s'),
            'alamat' => 'Cihanja',
            'no_hp' => '09876',
            'agama' => 'Islam',
            'status_pernikahan' => 'Belum Menikah',
            'status' => 'Tidak Bekerja',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
