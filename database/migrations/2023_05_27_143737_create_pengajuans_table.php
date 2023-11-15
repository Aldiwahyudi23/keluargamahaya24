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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->timestamp('tanggal')->nullable();
            $table->integer('jumlah');
            $table->text('keterangan');
            $table->string('pembayaran')->nullable();
            $table->foreignId('kategori_id')->references('id')->on('kategori_anggaran_programs');
            $table->text('sekertaris')->nullable();
            $table->text('bendahara')->nullable();
            $table->text('ketua')->nullable();
            $table->text('status')->nullable();
            $table->string('foto')->nullable();
            $table->string('pengeluaran_id')->nullable();
            $table->foreignId('data_warga_id')->references('id')->on('data_wargas')->nullable();
            $table->foreignId('pengaju_id')->references('id')->on('data_wargas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
