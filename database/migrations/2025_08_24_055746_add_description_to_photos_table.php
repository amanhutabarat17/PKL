<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kelas ini mendefinisikan migrasi untuk menambahkan kolom 'description' ke tabel 'photos'.
 * Migrasi digunakan untuk mengelola skema database secara terprogram.
 */
return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Metode 'up' digunakan untuk menambahkan kolom atau tabel baru ke database.
     *
     * @return void
     */
    public function up(): void
    {
        // Menggunakan Schema::table untuk memodifikasi tabel yang sudah ada.
        Schema::table('photos', function (Blueprint $table) {
            // Menambahkan kolom 'description' sebagai string, dan membuatnya bisa bernilai null.
            // Kolom ini akan ditambahkan 'after' (setelah) kolom 'path' untuk penempatan yang logis.
            $table->string('description')->nullable()->after('path');
        });
    }

    /**
     * Kembalikan migrasi.
     * Metode 'down' digunakan untuk membatalkan perubahan yang dibuat oleh metode 'up'.
     * Ini penting untuk rollback.
     *
     * @return void
     */
    public function down(): void
    {
        // Menggunakan Schema::table untuk memodifikasi tabel yang sudah ada.
        Schema::table('photos', function (Blueprint $table) {
            // Menghapus kolom 'description' jika rollback (dikembalikan).
            $table->dropColumn('description');
        });
    }
};
