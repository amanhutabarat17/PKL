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
        Schema::table('penugasans', function (Blueprint $table) {
            // 🌟 Kolom yang hilang: unsignedBigInteger dan nullable (sesuai controller)
            $table->unsignedBigInteger('data_row_id')->nullable()->after('photo_path'); 
            
            // Opsional: Jika Anda menggunakan ID data master di tabel lain:
            // $table->foreign('data_row_id')->references('id')->on('nama_tabel_master');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penugasans', function (Blueprint $table) {
            // $table->dropForeign(['data_row_id']); // Jika foreign key ditambahkan
            $table->dropColumn('data_row_id');
        });
    }
};
