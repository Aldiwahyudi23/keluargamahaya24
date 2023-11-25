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
        Schema::create('kredits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_warga_id')->references('id')->on('data_wargas');
            $table->timestamp('tanggal');
            $table->string('kode');
            $table->string('jenis_barang');
            $table->string('qty');
            $table->string('harga_pokok');
            $table->string('dp');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
