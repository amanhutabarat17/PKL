<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Hapus data lama untuk menghindari duplikasi jika seeder dijalankan ulang
        DB::table('kabupatens')->delete();

        // Masukkan data kabupaten/kota yang sudah dibersihkan dan dikonsistensikan
        DB::table('kabupatens')->insert([
            // Daftar Kabupaten
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
            ['nama_kabupaten' => 'Pakpak Bharat'], // Typo diperbaiki dari 'Phakpak'
            ['nama_kabupaten' => 'Samosir'],
            ['nama_kabupaten' => 'Serdang Bedagai'], // Spasi ekstra di akhir dihapus
            ['nama_kabupaten' => 'Simalungun'],
            ['nama_kabupaten' => 'Tapanuli Selatan'],
            ['nama_kabupaten' => 'Tapanuli Tengah'],
            ['nama_kabupaten' => 'Tapanuli Utara'],
            ['nama_kabupaten' => 'Toba'],

            // Daftar Kota (nama dibuat konsisten tanpa awalan "Kota")
            ['nama_kabupaten' => 'Binjai'],
            ['nama_kabupaten' => 'Gunung Sitoli'],
            ['nama_kabupaten' => 'Medan'],
            ['nama_kabupaten' => 'Padang Sidempuan'],
            ['nama_kabupaten' => 'Pematang Siantar'], // Awalan "Kota" dan spasi ekstra dihapus
            ['nama_kabupaten' => 'Sibolga'],
            ['nama_kabupaten' => 'Tanjung Balai'],
            ['nama_kabupaten' => 'Tebing Tinggi']
        ]);
    }
}
