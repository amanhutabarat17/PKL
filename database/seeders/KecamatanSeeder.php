<?php
namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID dari tabel kabupaten
        // Kabupaten
        $asahanId = DB::table('kabupatens')->where('nama_kabupaten', 'Asahan ')->value('id');
        $batubaraId = DB::table('kabupatens')->where('nama_kabupaten', 'Batu Bara ')->value('id');
        $dairiId = DB::table('kabupatens')->where('nama_kabupaten', 'Dairi ')->value('id');
        $deliSerdangId = DB::table('kabupatens')->where('nama_kabupaten', 'Deli Serdang')->value('id');
        $humbanghasundutanId = DB::table('kabupatens')->where('nama_kabupaten', 'Humbang Hasundutan ')->value('id');
        $karoId = DB::table('kabupatens')->where('nama_kabupaten', 'Karo ')->value('id');
        $labuhanbatuId = DB::table('kabupatens')->where('nama_kabupaten', 'Labuhan Batu ')->value('id');
        $labuselId = DB::table('kabupatens')->where('nama_kabupaten', 'Labuhan Batu Selatan ')->value('id');
        $labuhanbatuutaraId = DB::table('kabupatens')->where('nama_kabupaten', 'Labuhan Batu Utara ')->value('id');
        $langkatId = DB::table('kabupatens')->where('nama_kabupaten', 'Langkat')->value('id');
        $mandailingnatalId = DB::table('kabupatens')->where('nama_kabupaten', 'Mandailing Natal')->value('id');
        $niasId = DB::table('kabupatens')->where('nama_kabupaten', 'Nias')->value('id');
        $niasbaratId = DB::table('kabupatens')->where('nama_kabupaten', 'Nias Barat')->value('id');
        $niasselatanId = DB::table('kabupatens')->where('nama_kabupaten', 'Nias Selatan')->value('id');
        $niasutaraId = DB::table('kabupatens')->where('nama_kabupaten', 'Nias Utara')->value('id');
        $padangLawasId = DB::table('kabupatens')->where('nama_kabupaten', 'Padang Lawas')->value('id');
        $padangLawasutaraId = DB::table('kabupatens')->where('nama_kabupaten', 'Padang Lawas Utara')->value('id');
        $phakpakBaratId = DB::table('kabupatens')->where('nama_kabupaten', 'Phakpak Barat ')->value('id');
        $samosirId = DB::table('kabupatens')->where('nama_kabupaten', 'Samosir')->value('id');
        $serdangBerdagaiId = DB::table('kabupatens')->where('nama_kabupaten', 'Serdang Berdagai')->value('id');
        $simalungunId = DB::table('kabupatens')->where('nama_kabupaten', 'Simalungun ')->value('id');
        $tapselId = DB::table('kabupatens')->where('nama_kabupaten', 'Tapanuli Selatan')->value('id');
        $taptengId = DB::table('kabupatens')->where('nama_kabupaten', 'Tapanuli Tengah')->value('id');
        $taput = DB::table('kabupatens')->where('nama_kabupaten', 'Tapanuli Utara')->value('id');
        $tobaId = DB::table('kabupatens')->where('nama_kabupaten', 'Toba ')->value('id');


        //Kota 
        $binjaiId = DB::table('kabupatens')->where('nama_kabupaten', 'Binjai')->value('id');
        $gunungsitoliId = DB::table('kabupatens')->where('nama_kabupaten', 'GunungSitoli')->value('id');
        $medanId = DB::table('kabupatens')->where('nama_kabupaten', 'Medan')->value('id');
        $padangsidempuanId = DB::table('kabupatens')->where('nama_kabupaten', 'Padang Sidempuan')->value('id');
        $kotapematangsiantarId = DB::table('kabupatens')->where('nama_kabupaten', 'Kota Pematang Siantar')->value('id');
        $sibolgaId = DB::table('kabupatens')->where('nama_kabupaten', 'Sibolga')->value('id');
        $tanjungbalaiId = DB::table('kabupatens')->where('nama_kabupaten', 'Tanjung Balai')->value('id');
        $tebingtinggiId = DB::table('kabupatens')->where('nama_kabupaten', 'Tebing Tinggi')->value('id');


        DB::table('kecamatans')->insert([
             // 1.Kecamatan untuk Asahan
            ['nama_kecamatan' => 'Bandar Pasir Mandoge', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Bandar Pulau', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Aek Songsongan', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Rahuning', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Pulau Rakyat', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Aek Kuasan', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Aek Ledong', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Sei Kepayang', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Sei Kepayang Barat', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Sei Kepayang Timur', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Tanjung Balai', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Simpang Empat', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Teluk Dalam', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Air Batu', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Sei Dadap', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Buntu Pane', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Tinggi Raja', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Setia Janji', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Meranti', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Pulo Branding', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Rawang Panca Arga', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Air Joman', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Silau Laut', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Kota Kisaran Barat', 'kabupaten_id' => $asahanId],
            ['nama_kecamatan' => 'Kota Kisaran Timur', 'kabupaten_id' => $asahanId],

            //2.Kecamatan Batubara
            ['nama_kecamatan' => 'Air Putih', 'kabupaten_id' => $batubaraId],
            ['nama_kecamatan' => 'Lima Puluh', 'kabupaten_id' => $batubaraId],
            ['nama_kecamatan' => 'Medang Beras', 'kabupaten_id' => $batubaraId],
            ['nama_kecamatan' => 'Sei Balai', 'kabupaten_id' => $batubaraId],
            ['nama_kecamatan' => 'Sei Suka', 'kabupaten_id' => $batubaraId],
            ['nama_kecamatan' => 'Talawi', 'kabupaten_id' => $batubaraId],
            ['nama_kecamatan' => 'Tanjung Tirum', 'kabupaten_id' => $batubaraId],

            // 3.Kecamatan untuk Dairi
            ['nama_kecamatan' => 'Berampu', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Gunung Sitember', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Lae Parira', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Parbuluan', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Pegagan Hilir', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Sidikalang', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Siempat Nempu', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Siempat Nempu Hilir', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Siempat Nempu Hulu', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Silahi Sabungan', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Silima Pungga-Pungga', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Sitinjo', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Sumbul', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'Tanah Pinem', 'kabupaten_id' => $dairiId],
            ['nama_kecamatan' => 'TigaLingga', 'kabupaten_id' => $dairiId],

            //4.Kecamatan untuk Deli Serdang
            ['nama_kecamatan' => 'Lubuk Pakam', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Tanjung Morawa', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Bangun Purba', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Batang Kuis ', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Beringin', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Biru-Biru', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Deli Tua', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Gunung Meriah', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Galang', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Hamparan Perak', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Kutalimbaru', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Labuhan Deli', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Lubuk Pakam', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Namorambe', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Pagar Membau', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Pancur Batu', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Pantai Labu', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Patumbak', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Percut Sei tuan', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Sibolangit', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'STM Hilir ', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'STM Hulu', 'kabupaten_id' => $deliSerdangId],
            ['nama_kecamatan' => 'Sunggal', 'kabupaten_id' => $deliSerdangId],
                    
            //5.Kecamatan Humbang Hasundutan
            ['nama_kecamatan' => 'Pakkat', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Onan Ganjang', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Sijamapolang', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Lintongnihuta', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Paranginan    ', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Dolok Sanggul', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Pollung', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Parlilitan', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Tarabintang', 'kabupaten_id' => $humbanghasundutanId],
            ['nama_kecamatan' => 'Baktiraja', 'kabupaten_id' => $humbanghasundutanId],

            //6.Kecamatan Untuk Karo
            ['nama_kecamatan' => 'Kabanjahe', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Berastagi ', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Barus Jahe ', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Tiga Panah', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Merek', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Munte', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Kutabuluh', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Payung', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Juhar', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Mardingding', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Merdeka', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Dolat Rayat', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Lau Baleng', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Simpang Empat', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Tiga Binanga', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Tiga Nderker', 'kabupaten_id' => $karoId],
            ['nama_kecamatan' => 'Naman Teran', 'kabupaten_id' => $karoId],


            //7.Kecamatan Untuk Labuhan Batu
            ['nama_kecamatan' => 'Bilah Barat', 'kabupaten_id' => $labuhanbatuId],
            ['nama_kecamatan' => 'Bilah Hilir', 'kabupaten_id' => $labuhanbatuId],
            ['nama_kecamatan' => 'Bilah Hulu', 'kabupaten_id' => $labuhanbatuId],
            ['nama_kecamatan' => 'Panai Hulu', 'kabupaten_id' => $labuhanbatuId],
            ['nama_kecamatan' => 'Panai Tengah', 'kabupaten_id' => $labuhanbatuId],
            ['nama_kecamatan' => 'Pangkatan', 'kabupaten_id' => $labuhanbatuId],
            ['nama_kecamatan' => 'Rantau Selatan', 'kabupaten_id' => $labuhanbatuId],
            ['nama_kecamatan' => 'Rantau Utara', 'kabupaten_id' => $labuhanbatuId],

            //8.Kecamatan Untuk Labuhan Batu Selatan
            ['nama_kecamatan' => 'Kota Pinang', 'kabupaten_id' => $labuselId],
            ['nama_kecamatan' => 'Kampung Rakyat', 'kabupaten_id' => $labuselId],
            ['nama_kecamatan' => 'Torgamba', 'kabupaten_id' => $labuselId],
            ['nama_kecamatan' => 'Sungai Kanan', 'kabupaten_id' => $labuselId],
            ['nama_kecamatan' => 'Silang Kitang', 'kabupaten_id' => $labuselId],

            //9.Kecamatan Untuk Labuhan Batu Utara
            ['nama_kecamatan' => 'Aek Kuo', 'kabupaten_id' => $labuhanbatuutaraId],
            ['nama_kecamatan' => 'Aek Natas', 'kabupaten_id' => $labuhanbatuutaraId],
            ['nama_kecamatan' => 'Kualuh Hilir', 'kabupaten_id' => $labuhanbatuutaraId],
            ['nama_kecamatan' => 'Kualuh hulu', 'kabupaten_id' => $labuhanbatuutaraId],
            ['nama_kecamatan' => 'Kualuh Leidong', 'kabupaten_id' => $labuhanbatuutaraId],
            ['nama_kecamatan' => 'Kualuh Selatan', 'kabupaten_id' => $labuhanbatuutaraId],
            ['nama_kecamatan' => 'Marbau', 'kabupaten_id' => $labuhanbatuutaraId],
            ['nama_kecamatan' => 'Na IX-X', 'kabupaten_id' => $labuhanbatuutaraId],

            //10.Kecamatan untuk Langkat
            ['nama_kecamatan' => 'Babalan', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Bahorok', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Batang Serangan', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Brandan Barat', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Besitang', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Binjai', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Gebang', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Hinai', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Kuala', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Kutambaru', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Padang Tualang', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Pangkalan Susu', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Pematang Jaya', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Salapian', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Sawit seberang', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Secanggang', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Sei Bingai', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Sei Lepan', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Selesai', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Sirapit', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Stabat', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Tanjung Pura', 'kabupaten_id' => $langkatId],
            ['nama_kecamatan' => 'Wampu', 'kabupaten_id' => $langkatId],

            //11.Kecamatan Untuk Mandailing Natal
            ['nama_kecamatan' => 'Batahan', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Batang Natal', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Bukit Malintang', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Huta Bargot', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Kotanopan', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Lembah Sorik Marapi', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Lingga Bayu', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Muara Batang Gadis', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Muara Sipongi', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Naga Juang', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Natal', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Pakantan', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Panyabungan Barat', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Panyabungan Kota', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Panyabungan Selatan', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Panyabungan Timur', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Panyabungan Utara', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Puncak Sorik Marapi', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Ranto Baek', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Siabu', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Sinunukan', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Tambangan', 'kabupaten_id' => $mandailingnatalId],
            ['nama_kecamatan' => 'Ulu Pungkut', 'kabupaten_id' => $mandailingnatalId],

            //12.Kecamatan Untuk Nias
            ['nama_kecamatan' => 'bawolato', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'batomuzui', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'buntulia', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'gido ', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'hiliduho ', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'hili serangkai ', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'idanogawi ', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'mau"u', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'sogae"adu ', 'kabupaten_id' => $niasId],
            ['nama_kecamatan' => 'somolo molo ', 'kabupaten_id' => $niasId],

            //13.Kecamatan Untuk Nias Barat
            ['nama_kecamatan' => 'Lahomi', 'kabupaten_id' => $niasbaratId],
            ['nama_kecamatan' => 'Lolofitu Moi', 'kabupaten_id' => $niasbaratId],
            ['nama_kecamatan' => 'Mandrehe', 'kabupaten_id' => $niasbaratId],
            ['nama_kecamatan' => 'Mandrehe Barat', 'kabupaten_id' => $niasbaratId],
            ['nama_kecamatan' => 'Mandrehe Utara', 'kabupaten_id' => $niasbaratId],
            ['nama_kecamatan' => 'Moro"o', 'kabupaten_id' => $niasbaratId],
            ['nama_kecamatan' => 'Sirombu', 'kabupaten_id' => $niasbaratId],
            ['nama_kecamatan' => 'Afulu', 'kabupaten_id' => $niasbaratId],


            //14.Kecamatan Untuk Nias Selatan
            ['nama_kecamatan' => 'Amandraya', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Aramo', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Boronadu', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Fanayama', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Gomo', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Hibala', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Hilimegai', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Hilisalawa"ahe', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Huruna', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Idanotae', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Lahusa', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Lolomatua', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Lolowau', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Luahagundre Maniamolo', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Maniamolo', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Mazino', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Mazo', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'o"o"u', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Onohazumba', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Onolalu', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Pulau pulau Batu', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Pulau pulau Batu Barat ', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Pulau pulau Batu Timur', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Pulau pulau Batu Utara', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Sidua"ori', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Simuk', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Somambawa', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Susua', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Tanah Masa', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Teluk Dalam', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Toma ', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Ulunoyo ', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Ulu Idanotae', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Umbunasi', 'kabupaten_id' => $niasselatanId],
            ['nama_kecamatan' => 'Ulu susua', 'kabupaten_id' => $niasselatanId],

            //15.Kecamatan Untuk Nias Utara
            ['nama_kecamatan' => 'Afulu', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'Alasa', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'Alasa Talumuzoi', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'Lahewa', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'Lahewa Timur', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'lotu', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'NamoHalu Esiwa', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'Sawo', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'Sitolu Ori', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'Tugala Oyo', 'kabupaten_id' => $niasutaraId],
            ['nama_kecamatan' => 'Tuhemberua', 'kabupaten_id' => $niasutaraId],


            //16.Kecamatan Untuk Padang Lawas
            ['nama_kecamatan' => 'Aek Nabara Barumun', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Barumun', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Barumun Barat', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Barumun Baru', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Barumun Selatan', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Barumun Tengah', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Batang Lubu Sutam', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Huristak', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Huta Raja Tinggi', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Lubuk Barumun', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Sihapas Barumun', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Sosa', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Sosa Julu', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Sosa Timur', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Sosopan', 'kabupaten_id' => $padangLawasId], 
            ['nama_kecamatan' => 'Ulu Barumun', 'kabupaten_id' => $padangLawasId],
            ['nama_kecamatan' => 'Ulu Sosa', 'kabupaten_id' => $padangLawasId],


            //17.Kecamatan Untuk Padang Lawas Utara
            ['nama_kecamatan' => 'Batang Onang', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Dolok', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Dolok Sigompulon', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Halogonan', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Halogonan Timur', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Hulu Sihapas', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Padang Bolak', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Padang Bolak Julu', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Padang Bolak Tenggara', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Portibi', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Simagambat', 'kabupaten_id' => $padangLawasutaraId],
            ['nama_kecamatan' => 'Ujung Batu', 'kabupaten_id' => $padangLawasutaraId],


            //18.Kecamatan Untuk Phakpak Barat
            ['nama_kecamatan' => 'Kerajaan', 'kabupaten_id' => $phakpakBaratId],
            ['nama_kecamatan' => 'Pangindar', 'kabupaten_id' => $phakpakBaratId],
            ['nama_kecamatan' => 'Pergetteng Getteng Sengkut', 'kabupaten_id' => $phakpakBaratId],
            ['nama_kecamatan' => 'Salak', 'kabupaten_id' => $phakpakBaratId],
            ['nama_kecamatan' => 'Siempat Rube ', 'kabupaten_id' => $phakpakBaratId],
            ['nama_kecamatan' => 'Sitellu Tali Urang Jehe', 'kabupaten_id' => $phakpakBaratId],
            ['nama_kecamatan' => 'Sitellu Tali Urang Juhu', 'kabupaten_id' => $phakpakBaratId],
            ['nama_kecamatan' => 'Tinada', 'kabupaten_id' => $phakpakBaratId],

            //19.Kecamatan Untuk Samosir
            ['nama_kecamatan' => 'Harian', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Nainggolan', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Pangururan', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Onan Runggu', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Palipi', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Ronggur Ni Huta', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Sianjur Mula-Mula', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Simanindo', 'kabupaten_id' => $samosirId],
            ['nama_kecamatan' => 'Sitiotio', 'kabupaten_id' => $samosirId],

            //20.Kecamatan Untuk Serdang Bedagai
            ['nama_kecamatan' => 'Bandar Khalipah', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Bintang Kayu', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Dolok Masihul', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Kotarih', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Silinda', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Sei Bamban', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Sei Rampah', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Serba Jadi', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Perbaungan', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Tanjung Beringin', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Tebing Syahbandar', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Sipispis', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Baja Ronggi', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Pertambatan', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Bandarawan', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Banjaran Godang', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Lubuk Saban ', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Pengajahan', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Pulau Tagor', 'kabupaten_id' => $serdangBerdagaiId],
            ['nama_kecamatan' => 'Kotarih Pekan', 'kabupaten_id' => $serdangBerdagaiId],


            //21.Kecamatan Untuk Simalungun
            ['nama_kecamatan' => 'Bandar', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Bandar Huluan', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Bandar Masilam', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Bosar Maligas', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Dolog Masagal', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => '	Dolok Batu Nanggar', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Dolok Panribuan', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Dolok Pardamean', 'kabupaten_id' => $simalungunId],  
            ['nama_kecamatan' => 'Dolok Silau', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Girsang Sipangan Bolon', 'kabupaten_id' => $simalungunId],     
            ['nama_kecamatan' => 'Gunung Malea', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Gunung Maligas', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Harangaol Horison', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Hatonduhan', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Huta Bayu Raja', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan ' => 'Jawa Maraja Bah jambi', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Jorlang Mataram', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Panei', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Pamatang Silima Huta', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Panombeian Panei', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Pematang Bandar', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Pematang Sidamanik', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Purba', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Raya', 'kabupaten_id' => $simalungunId], 
            ['nama_kecamatan' => 'Raya Kahean', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Siantar', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Sidamanik', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Silimakuta', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Silau Kahean', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Tanah Jawa', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Tapian Dolok', 'kabupaten_id' => $simalungunId],
            ['nama_kecamatan' => 'Ujung Padang', 'kabupaten_id' => $simalungunId],
                                           

            //22.Kecamatan Untuk Tapanuli Selatan
            ['nama_kecamatan' => 'Aek Bilah', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Angkola Barat', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Angkola Muara Tais', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Ankola Sangkunur', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Angkola Selatan', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Angkola Timur', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Arse', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Batang Angkola', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Batang Toru', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Marancar', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Muara Batang Toru', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Saipar Dolok Hole', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Sayur Matinggi', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Sipirok', 'kabupaten_id' => $tapselId],
            ['nama_kecamatan' => 'Tano Tombangan Angkola', 'kabupaten_id' => $tapselId],


            //23.Kecamatan Untuk Tapanuli Tengah
            ['nama_kecamatan' => 'Andam Dewi', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Badiri', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Barus', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Barus Utara', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Kolang', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Lumut', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Maduamas', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Pandan', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Pasaribu Tobing', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Pinangsori', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Sarudik', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Sibabangun', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Sirandorung ', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Sitahuis', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Sosor Gadong', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Sorkam', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Sorkam Barat', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Sukabangun', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Tapian Nauli', 'kabupaten_id' => $taptengId],
            ['nama_kecamatan' => 'Tukka', 'kabupaten_id' => $taptengId],

            //24.Kecamatan Untuk Tapanuli Utara
            ['nama_kecamatan' => 'Adian Koting', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Siborong Borong', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Garoga', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Muara', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Pagaran', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Pahae Jae', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Pahae Julu', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Pangaribuan', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Parmonangan', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Purba Tua', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Siatas Barita', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Simangumban', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Sipahutar', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Sipoholon', 'kabupaten_id' => $taput],
            ['nama_kecamatan' => 'Tarutung', 'kabupaten_id' => $taput],

            //25.Kecamatan Untuk Toba 
            ['nama_kecamatan' => 'Ajibata', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Balige', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Bonatua Lunasi', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Borbor', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Habinsaran', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Lagu Boti', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Lumban Julu', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Nassau', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Permaksian', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Pintu Pohan', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Porsea', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Siantar Narumonda', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Sigumpar', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Silaen', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Tampahan', 'kabupaten_id' => $tobaId],
            ['nama_kecamatan' => 'Uluan', 'kabupaten_id' => $tobaId],




            //1.Kota Untuk Binjai
            ['nama_kecamatan' => 'Binjai Barat', 'kabupaten_id' => $binjaiId],
            ['nama_kecamatan' => 'Binjai Kota', 'kabupaten_id' => $binjaiId],
            ['nama_kecamatan' => 'Binjai Selatan', 'kabupaten_id' => $binjaiId],
            ['nama_kecamatan' => 'Binjai Timur', 'kabupaten_id' => $binjaiId],
            ['nama_kecamatan' => 'Binjai Utara', 'kabupaten_id' => $binjaiId],

            //2.Kota Gunung Sitoli

            ['nama_kecamatan' => 'Gunungsitoli', 'kabupaten_id' => $gunungsitoliId],
            ['nama_kecamatan' => 'Gunungsitoli Alo"oa', 'kabupaten_id' => $gunungsitoliId],
            ['nama_kecamatan' => 'Gunungsitoli Barat', 'kabupaten_id' => $gunungsitoliId],
            ['nama_kecamatan' => 'Gunungsitoli Idanoi', 'kabupaten_id' => $gunungsitoliId],
            ['nama_kecamatan' => 'Gunungsitoli Selatan', 'kabupaten_id' => $gunungsitoliId],
            ['nama_kecamatan' => 'Gunungsitoli Utara', 'kabupaten_id' => $gunungsitoliId],


            //3.Kota Medan
            ['nama_kecamatan' => 'Medan Kota', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Amplas', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Are', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Amplas', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Barat', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Deli', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Timur', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Utara', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Polonia', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Tuntungan', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Johor', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Marelan', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Perjuangan', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Selayang', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Sunggetia', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Petial', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Helvsah', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Baru', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Tembung', 'kabupaten_id' => $medanId], 
            ['nama_kecamatan' => 'Medan Maimun', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Belawang', 'kabupaten_id' => $medanId],
            ['nama_kecamatan' => 'Medan Jambu', 'kabupaten_id' => $medanId],

            //4.Kota Padangsidimpuan
            ['nama_kecamatan' => 'Padangsidimpuan Angkola Julu', 'kabupaten_id' => $padangsidempuanId],
            ['nama_kecamatan' => 'Padangsidimpuan Batunadua', 'kabupaten_id' => $padangsidempuanId],
            ['nama_kecamatan' => 'Padangsidimpuan Hutaimbaru', 'kabupaten_id' => $padangsidempuanId],
            ['nama_kecamatan' => 'Padangsidimpuan Selatan', 'kabupaten_id' => $padangsidempuanId],
            ['nama_kecamatan' => 'Padangsidimpuan Tenggara', 'kabupaten_id' => $padangsidempuanId],
            ['nama_kecamatan' => 'Padangsidimpuan Utara', 'kabupaten_id' => $padangsidempuanId],


            //5.Kota Pematang Siantar
            ['nama_kecamatan' => 'Siantar Barat', 'kabupaten_id' => $kotapematangsiantarId],
            ['nama_kecamatan' => 'Siantar Marihat', 'kabupaten_id' => $kotapematangsiantarId],
            ['nama_kecamatan' => 'Siantar Marimun', 'kabupaten_id' => $kotapematangsiantarId],
            ['nama_kecamatan' => 'Siantar Martoba', 'kabupaten_id' => $kotapematangsiantarId],
            ['nama_kecamatan' => 'Siantar Selatan', 'kabupaten_id' => $kotapematangsiantarId],
            ['nama_kecamatan' => 'Siantar Sitalasari', 'kabupaten_id' => $kotapematangsiantarId],
            ['nama_kecamatan' => 'Siantar Timur ', 'kabupaten_id' => $kotapematangsiantarId],
            ['nama_kecamatan' => 'Siantar Utara', 'kabupaten_id' => $kotapematangsiantarId],


            //6.Kota Sibolga
            ['nama_kecamatan' => 'Sibolga Utara', 'kabupaten_id' => $sibolgaId],
            ['nama_kecamatan' => 'Sibolga Kota', 'kabupaten_id' => $sibolgaId],
            ['nama_kecamatan' => 'Sibolga Selatan', 'kabupaten_id' => $sibolgaId],
            ['nama_kecamatan' => 'Sibolga Sambas', 'kabupaten_id' => $sibolgaId],


            //7.Kota Tanjung Balai
            ['nama_kecamatan' => 'Datuk Bandar', 'kabupaten_id' => $tanjungbalaiId],
            ['nama_kecamatan' => 'Datuk Bandar Timur', 'kabupaten_id' => $tanjungbalaiId],
            ['nama_kecamatan' => 'Sei Tualang Raso', 'kabupaten_id' => $tanjungbalaiId],
            ['nama_kecamatan' => 'Tanjung Balai Selatan', 'kabupaten_id' => $tanjungbalaiId],
            ['nama_kecamatan' => 'Tanjung Balai Utara', 'kabupaten_id' => $tanjungbalaiId],
            ['nama_kecamatan' => 'Teluk Nibung', 'kabupaten_id' => $tanjungbalaiId],

            
            //8.Kota Tebing Tinggi
            ['nama_kecamatan' => 'Bajenis', 'kabupaten_id' => $tebingtinggiId],
            ['nama_kecamatan' => 'Padang Hilir', 'kabupaten_id' => $tebingtinggiId],
            ['nama_kecamatan' => 'Padang Hulu', 'kabupaten_id' => $tebingtinggiId],
            ['nama_kecamatan' => 'Rambutan', 'kabupaten_id' => $tebingtinggiId],
            ['nama_kecamatan' => 'Tebing Tinggi Kota ', 'kabupaten_id' => $tebingtinggiId],



        ]);
    }
}