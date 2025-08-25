<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        // Buat tabel 'photos' dengan kolom yang diperlukan
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            // Menambahkan kolom user_id sebagai foreign key
            // Ini akan membuat relasi ke tabel 'users'
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('path'); // Kolom untuk menyimpan path file
            $table->timestamps();
        });
    }

    /**
     * Balikkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
