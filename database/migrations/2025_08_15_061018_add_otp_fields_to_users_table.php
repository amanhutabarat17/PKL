<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtpFieldsToUsersTable extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom 'otp' jika belum ada
            if (!Schema::hasColumn('users', 'otp')) {
                $table->string('otp')->nullable()->after('password');
            }
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Hapus kolom 'otp' jika ada
            if (Schema::hasColumn('users', 'otp')) {
                $table->dropColumn('otp');
            }
        });
    }
}
