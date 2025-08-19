   <?php
   use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Jalankan migrasi.
         */
        public function up(): void
        {
            Schema::table('users', function (Blueprint $table) {
                // Menambahkan kolom 'avatar' setelah kolom 'email'
                $table->string('avatar')->nullable()->after('email');
            });
        }

        /**
         * Batalkan migrasi.
         */
        public function down(): void
        {
            Schema::table('users', function (Blueprint $table) {
                // Menghapus kolom 'avatar' jika migrasi di-rollback
                $table->dropColumn('avatar');
            });
        }
    };
    