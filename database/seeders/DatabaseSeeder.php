<?php

namespace Database\Seeders;

// Tambahkan use statement untuk KabupatenSeeder dan KecamatanSeeder
use Database\Seeders\KabupatenSeeder;
use Database\Seeders\KecamatanSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Panggil seeder yang sudah Anda buat di sini
        $this->call([
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            // Jika Anda memiliki seeder lain, tambahkan di sini
        ]);
    }
}
