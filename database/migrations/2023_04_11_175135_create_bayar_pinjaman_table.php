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
        Schema::create('bayar_pinjamen', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->timestamp('tanggal');
            $table->integer('jumlah');
            $table->integer('jumlah_lebih');
            $table->string('keterangan', 500);
            $table->string('pembayaran')->nullable();
            $table->foreignId('pengeluaran_id')->references('id')->on('pengeluarans');
            $table->foreignId('data_warga_id')->references('id')->on('data_wargas');
            $table->foreignId('pengaju_id')->references('id')->on('data_wargas');
            $table->foreignId('pengurus_id')->references('id')->on('data_wargas');
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bayar_pinjamen');
    }
};
