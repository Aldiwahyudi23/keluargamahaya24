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
        Schema::create('profile_apps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('logo');
            $table->string('foto');
            $table->string('footer');
            $table->string('logo_login');
            $table->string('foto_login');
            $table->string('background_login');
            $table->string('footer_login');
            $table->enum('lupa_password', ['1', '0']);
            $table->string('title_login');
            $table->string('info_login');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_apps');
    }
};
