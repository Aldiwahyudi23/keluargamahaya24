<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutPengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layout_pengeluarans')->insert(
            [
                'id' => 1,
                'tittle' => 'Pengeluaran',
                'nominal_min' => '50000',
                'gambar' => 'Pemasukan',
                'info_proses' => 'proses',
                'info_full' => 'full',
                'info_nunggak' => 'nunggak',
                'info_saldo' => 'saldo',
                'tempt_keterangan' => 'tempt_keterangan',

            ]
        );
    }
}
