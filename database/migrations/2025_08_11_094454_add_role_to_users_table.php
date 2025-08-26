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
        // Gunakan Schema::table untuk memodifikasi tabel 'users'
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom 'role' dengan tipe string
            // Nilai default-nya adalah 'user'
            // Letakkan kolom ini setelah kolom 'email'
            $table->string('role')->default('user')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ini adalah kebalikan dari fungsi 'up'
        // Jika migrasi di-rollback, kolom 'role' akan dihapus
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
