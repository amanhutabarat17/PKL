<?php

namespace Database\Seeders;

// Gunakan use statement di sini untuk memanggil seeder lain
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Panggil seeder lain dari sini
        // Pastikan urutannya benar: Kabupaten dulu, baru Kecamatan,
        // karena Kecamatan butuh data dari Kabupaten.
        $this->call([
            AdminUserSeeder::class, // Tambahkan baris ini untuk membuat akun admin
            CsUserSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            // Anda bisa menambahkan seeder lain di sini jika ada
        ]);
    }
}
