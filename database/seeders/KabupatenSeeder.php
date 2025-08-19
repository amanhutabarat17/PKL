<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kabupatens')->insert([
            ['nama_kabupaten' => 'Asahan'],
            ['nama_kabupaten' => 'Batu Bara'],
            ['nama_kabupaten' => 'Dairi'],  
            ['nama_kabupaten' => 'Deli Serdang'],
            ['nama_kabupaten' => 'Humbang Hasundutan'],
            ['nama_kabupaten' => 'Karo'],
            ['nama_kabupaten' => 'Labuhan Batu'],
            ['nama_kabupaten' => 'Labuhan Batu Selatan'],
            ['nama_kabupaten' => 'Labuhan Batu Utara'],
            ['nama_kabupaten' => 'Langkat'],
            ['nama_kabupaten' => 'Mandailing Natal'],
            ['nama_kabupaten' => 'Nias'],
            ['nama_kabupaten' => 'Nias Barat'],
            ['nama_kabupaten' => 'Nias Selatan'],
            ['nama_kabupaten' => 'Nias Utara'],
            ['nama_kabupaten' => 'Padang Lawas'],
            ['nama_kabupaten' => 'Padang Lawas Utara'],
            ['nama_kabupaten' => 'Phakpak Barat'],
            ['nama_kabupaten' => 'Samosir'],
            ['nama_kabupaten' => 'Serdang Berdagai '],
            ['nama_kabupaten' => 'Simalungun'],
            ['nama_kabupaten' => 'Tapanuli Selatan'],
            ['nama_kabupaten' => 'Tapanuli Tengah'],
            ['nama_kabupaten' => 'Tapanuli Utara'],
            ['nama_kabupaten' => 'Toba'],

            
            ['nama_kabupaten' => 'Kota Binjai'],
            ['nama_kabupaten' => 'Kota Gunung Sitoli'],
            ['nama_kabupaten' => 'Medan'],
            ['nama_kabupaten' => 'Padang Sidempuan'],
            ['nama_kabupaten' => 'Kota Pematang Siantar '],
            ['nama_kabupaten' => 'Sibolga'],
            ['nama_kabupaten' => 'Tanjung Balai'],
            ['nama_kabupaten' => 'Tebing Tinggi']
            // Tambahkan kabupaten lain jika perlu
        ]);
    }
}