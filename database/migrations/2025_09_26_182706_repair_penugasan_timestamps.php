<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('penugasans')) {
            // PERBAIKAN FATAL ERROR: Menggunakan sintaks yang paling sederhana dan aman untuk SQLite.
            
            // Perbaikan created_at: Mengganti NULL/kosong dengan waktu saat ini (DATETIME('now'))
            DB::statement("
                UPDATE penugasans 
                SET created_at = DATETIME('now') 
                WHERE created_at IS NULL OR created_at = '' 
            ");

            // Perbaikan updated_at
            DB::statement("
                UPDATE penugasans 
                SET updated_at = DATETIME('now') 
                WHERE updated_at IS NULL OR updated_at = '' 
            ");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Tidak ada perubahan yang diperlukan pada fungsi down() untuk perbaikan data.
    }
};