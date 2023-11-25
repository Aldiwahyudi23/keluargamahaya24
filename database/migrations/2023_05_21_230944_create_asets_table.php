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
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->references('id')->on('programs');
            $table->string('kode');
            $table->string('nama_aset');
            $table->timestamp('tanggal');
            $table->text('deskripsi');
            $table->string('qty');
            $table->string('persen')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('foto', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
