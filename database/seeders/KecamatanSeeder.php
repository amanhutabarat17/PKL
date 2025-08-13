<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari tabel kabupaten
        $deliSerdangId = DB::table('kabupatens')->where('nama_kabupaten', 'Deli Serdang')->value('id');
        $medanId = DB::table('kabupatens')->where('nama_kabupaten', 'Medan')->value('id');
        $niasId = DB::table('kabupatens')->where('nama_kabupaten', 'Nias')->value('id');
        $samosirId = DB::table('kabupatens')->where('nama_kabupaten', 'Samosir')->value('id');

        DB::table('kecamatans')->insert([
            // Kecamatan untuk Deli Serdang
            ['nama_kecamatan' => 'Lubuk Pakam', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Tanjung Morawa', 'kabupaten_id' => $deliSerdangId],
            // Kecamatan untuk Medan
            ['nama_kecamatan' => 'Medan Kota', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Amplas', 'kabupaten_id' => $medanId],
            
              ['nama_kecamatan' => 'Balolo', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'Belalo', 'kabupaten_id' => $niasId],

              ['nama_kecamatan' => 'Tarutung', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Siborong Borong', 'kabupaten_id' => $samosirId],
        ]);
    }
}