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
        Schema::create('hubungan_wargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->references('id')->on('data_wargas');
            $table->foreignId('data_warga_id')->references('id')->on('data_wargas');
            $table->enum('hubungan', ['Anak', 'Ayah', 'Ibu', 'Suami', 'Istri', 'Anak Tiri']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hubungan_wargas');
    }
};
