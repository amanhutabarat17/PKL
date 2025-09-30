<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk menggunakan query DB

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // PENTING: Gunakan raw SQL atau COALESCE jika kolom sudah ada dan berisi NULL,
        // karena Laravel DB query builder mungkin bermasalah dengan `->change()` setelah `update()`.

        if (Schema::hasTable('penugasans')) {
            // 1. ISI DATA LAMA YANG NULL DENGAN NILAI DEFAULT
            // COALESCE akan mengisi kolom jika nilainya adalah NULL
            DB::statement("
                UPDATE penugasans
                SET 
                    deskripsi = COALESCE(deskripsi, 'Data deskripsi lama tidak tersedia'),
                    alamat_lengkap = COALESCE(alamat_lengkap, 'Data alamat lama tidak tersedia')
            ");
        }
        
        // 2. Terapkan perubahan skema (membuat NOT NULL)
        Schema::table('penugasans', function (Blueprint $table) {
            // Gunakan ->text() atau tipe data yang lebih besar jika isinya panjang
            $table->string('deskripsi', 500)->nullable(false)->change(); 
            $table->string('alamat_lengkap', 500)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penugasans', function (Blueprint $table) {
            // Mengembalikan ke nullable jika diperlukan (optional)
            $table->string('deskripsi', 500)->nullable()->change();
            $table->string('alamat_lengkap', 500)->nullable()->change();
        });
    }
};
