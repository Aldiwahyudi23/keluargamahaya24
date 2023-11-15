<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layout_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->string('tittle');
            $table->string('nominal_min');
            $table->string('gambar');
            $table->longText('info_proses');
            $table->longText('info_full');
            $table->longText('info_nunggak');
            $table->longText('info_saldo');
            $table->longText('temp_keterangan');
            $table->longText('info_proses_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layout_pengeluarans');
    }
};
