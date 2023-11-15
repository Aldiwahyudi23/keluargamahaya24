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
        Schema::create('menu_footers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('icon')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('route_url_id')->references('id')->on('all_route_urls');
            $table->foreignId('program_id');
            $table->enum('is_active', ['1', '0']);
            $table->enum('kategori', ['1', '0']);
            $table->longtext('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_footers');
    }
};
