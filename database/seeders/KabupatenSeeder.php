<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kabupatens')->insert([
            ['nama_kabupaten' => 'Deli Serdang'],
            ['nama_kabupaten' => 'Medan'],
            ['nama_kabupaten' => 'Karo'],
            ['nama_kabupaten' => 'Simalungun'],
            ['nama_kabupaten' => 'Dairi'],
            ['nama_kabupaten' => 'Nias'],
            ['nama_kabupaten' => 'Samosir'],
            ['nama_kabupaten' => 'Langkat'],
            ['nama_kabupaten' => 'Tapanuli Utara'],
            ['nama_kabupaten' => 'Tapanuli Tengah']
            // Tambahkan kabupaten lain jika perlu
        ]);
    }
}