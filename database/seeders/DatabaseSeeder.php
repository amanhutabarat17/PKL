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
   public function run()
{
    $this->call([
        KabupatenSeeder::class,
        KecamatanSeeder::class,
    ]);
}
}
