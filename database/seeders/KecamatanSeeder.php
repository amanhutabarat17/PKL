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
        $asahan_id = DB::table('kabupatens')->where('nama_kabupaten', 'Asahan')->value('id');
        $batubara_id = DB::table('kabupatens')->where('nama_kabupaten', 'Batu Bara')->value('id');
        $dairi_id = DB::table('kabupatens')->where('nama_kabupaten', 'Dairi')->value('id');
        $deliSerdang_id = DB::table('kabupatens')->where('nama_kabupaten', 'Deli Serdang')->value('id');
        $humbanghasundutan_id = DB::table('kabupatens')->where('nama_kabupaten', 'Humbang Hasundutan')->value('id');
        $karo_id = DB::table('kabupatens')->where('nama_kabupaten', 'Karo')->value('id');
        $labuhanbatu_id = DB::table('kabupatens')->where('nama_kabupaten', 'Labuhan Batu')->value('id');
        $labusel_id = DB::table('kabupatens')->where('nama_kabupaten', 'Labuhan Batu Selatan')->value('id');
        $labuhanbatuutara_id = DB::table('kabupatens')->where('nama_kabupaten', 'Labuhan Batu Utara')->value('id');
        $langkat_id = DB::table('kabupatens')->where('nama_kabupaten', 'Langkat')->value('id');
        $mandailingnatal_id = DB::table('kabupatens')->where('nama_kabupaten', 'Mandailing Natal')->value('id');
        $nias_id = DB::table('kabupatens')->where('nama_kabupaten', 'Nias')->value('id');
        $niasbarat_id = DB::table('kabupatens')->where('nama_kabupaten', 'Nias Barat')->value('id');
        $niasselatan_id = DB::table('kabupatens')->where('nama_kabupaten', 'Nias Selatan')->value('id');
        $niasutara_id = DB::table('kabupatens')->where('nama_kabupaten', 'Nias Utara')->value('id');
        $padangLawas_id = DB::table('kabupatens')->where('nama_kabupaten', 'Padang Lawas')->value('id');
        $padangLawasutara_id = DB::table('kabupatens')->where('nama_kabupaten', 'Padang Lawas Utara')->value('id');
        $phakpakBarat_id = DB::table('kabupatens')->where('nama_kabupaten', 'Phakpak Barat')->value('id');
        $samosir_id = DB::table('kabupatens')->where('nama_kabupaten', 'Samosir')->value('id');
        $serdangBerdagai_id = DB::table('kabupatens')->where('nama_kabupaten', 'Serdang Berdagai')->value('id');
        $simalungun_id = DB::table('kabupatens')->where('nama_kabupaten', 'Simalungun')->value('id');
        $tapsel_id = DB::table('kabupatens')->where('nama_kabupaten', 'Tapanuli Selatan')->value('id');
        $tapteng_id = DB::table('kabupatens')->where('nama_kabupaten', 'Tapanuli Tengah')->value('id');
        $taput_id = DB::table('kabupatens')->where('nama_kabupaten', 'Tapanuli Utara')->value('id');
        $toba_id = DB::table('kabupatens')->where('nama_kabupaten', 'Toba ')->value('id');


        //Kota 
        $binjai_id = DB::table('kabupatens')->where('nama_kabupaten', 'Binjai')->value('id');
        $gunungsitoli_id = DB::table('kabupatens')->where('nama_kabupaten', 'GunungSitoli')->value('id');
        $medan_id = DB::table('kabupatens')->where('nama_kabupaten', 'Medan')->value('id');
        $padangsidempuan_id = DB::table('kabupatens')->where('nama_kabupaten', 'Padang Sidempuan')->value('id');
        $kotapematangsiantar_id = DB::table('kabupatens')->where('nama_kabupaten', 'Kota Pematang Siantar')->value('id');
        $sibolga_id = DB::table('kabupatens')->where('nama_kabupaten', 'Sibolga')->value('id');
        $tanjungbalai_id = DB::table('kabupatens')->where('nama_kabupaten', 'Tanjung Balai')->value('id');
        $tebingtinggi_id = DB::table('kabupatens')->where('nama_kabupaten', 'Tebing Tinggi')->value('id');


        DB::table('kecamatans')->insert([
             // 1.Kecamatan untuk Asahan
            ['nama_kecamatan' => 'Bandar Pasir Mandoge', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Bandar Pulau', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Aek Songsongan', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Rahuning', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Pulau Rakyat', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Aek Kuasan', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Aek Ledong', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Sei Kepayang', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Sei Kepayang Barat', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Sei Kepayang Timur', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Tanjung Balai', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Simpang Empat', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Teluk Dalam', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Air Batu', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Sei Dadap', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Buntu Pane', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Tinggi Raja', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Setia Janji', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Meranti', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Pulo Branding', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Rawang Panca Arga', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Air Joman', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Silau Laut', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Kota Kisaran Barat', 'kabupaten_id' => $asahan_id],
            ['nama_kecamatan' => 'Kota Kisaran Timur', 'kabupaten_id' => $asahan_id],

            //2.Kecamatan Batubara
            ['nama_kecamatan' => 'Air Putih', 'kabupaten_id' => $batubara_id],
            ['nama_kecamatan' => 'Lima Puluh', 'kabupaten_id' => $batubara_id],
            ['nama_kecamatan' => 'Medang Beras', 'kabupaten_id' => $batubara_id],
            ['nama_kecamatan' => 'Sei Balai', 'kabupaten_id' => $batubara_id],
            ['nama_kecamatan' => 'Sei Suka', 'kabupaten_id' => $batubara_id],
            ['nama_kecamatan' => 'Talawi', 'kabupaten_id' => $batubara_id],
            ['nama_kecamatan' => 'Tanjung Tirum', 'kabupaten_id' => $batubara_id],

            // 3.Kecamatan untuk Dairi
            ['nama_kecamatan' => 'Berampu', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Gunung Sitember', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Lae Parira', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Parbuluan', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Pegagan Hilir', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Sidikalang', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Siempat Nempu', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Siempat Nempu Hilir', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Siempat Nempu Hulu', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Silahi Sabungan', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Silima Pungga-Pungga', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Sitinjo', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Sumbul', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'Tanah Pinem', 'kabupaten_id' => $dairi_id],
            ['nama_kecamatan' => 'TigaLingga', 'kabupaten_id' => $dairi_id],

            //4.Kecamatan untuk Deli Serdang
            ['nama_kecamatan' => 'Lubuk Pakam', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Tanjung Morawa', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Bangun Purba', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Batang Kuis ', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Beringin', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Biru-Biru', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Deli Tua', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Gunung Meriah', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Galang', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Hamparan Perak', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Kutalimbaru', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Labuhan Deli', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Lubuk Pakam', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Namorambe', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Pagar Membau', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Pancur Batu', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Pantai Labu', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Patumbak', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Percut Sei tuan', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Sibolangit', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'STM Hilir ', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'STM Hulu', 'kabupaten_id' => $deliSerdang_id],
            ['nama_kecamatan' => 'Sunggal', 'kabupaten_id' => $deliSerdang_id],
                    
            //5.Kecamatan Humbang Hasundutan
            ['nama_kecamatan' => 'Pakkat', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Onan Ganjang', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Sijamapolang', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Lintongnihuta', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Paranginan ', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Dolok Sanggul', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Pollung', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Parlilitan', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Tarabintang', 'kabupaten_id' => $humbanghasundutan_id],
            ['nama_kecamatan' => 'Baktiraja', 'kabupaten_id' => $humbanghasundutan_id],

            //6.Kecamatan Untuk Karo
            ['nama_kecamatan' => 'Kabanjahe', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Berastagi ', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Barus Jahe ', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Tiga Panah', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Merek', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Munte', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Kutabuluh', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Payung', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Juhar', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Mardingding', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Merdeka', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Dolat Rayat', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Lau Baleng', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Simpang Empat', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Tiga Binanga', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Tiga Nderker', 'kabupaten_id' => $karo_id],
            ['nama_kecamatan' => 'Naman Teran', 'kabupaten_id' => $karo_id],


            //7.Kecamatan Untuk Labuhan Batu
            ['nama_kecamatan' => 'Bilah Barat', 'kabupaten_id' => $labuhanbatu_id],
            ['nama_kecamatan' => 'Bilah Hilir', 'kabupaten_id' => $labuhanbatu_id],
            ['nama_kecamatan' => 'Bilah Hulu', 'kabupaten_id' => $labuhanbatu_id],
            ['nama_kecamatan' => 'Panai Hulu', 'kabupaten_id' => $labuhanbatu_id],
            ['nama_kecamatan' => 'Panai Tengah', 'kabupaten_id' => $labuhanbatu_id],
            ['nama_kecamatan' => 'Pangkatan', 'kabupaten_id' => $labuhanbatu_id],
            ['nama_kecamatan' => 'Rantau Selatan', 'kabupaten_id' => $labuhanbatu_id],
            ['nama_kecamatan' => 'Rantau Utara', 'kabupaten_id' => $labuhanbatu_id],

            //8.Kecamatan Untuk Labuhan Batu Selatan
            ['nama_kecamatan' => 'Kota Pinang', 'kabupaten_id' => $labusel_id],
            ['nama_kecamatan' => 'Kampung Rakyat', 'kabupaten_id' => $labusel_id],
            ['nama_kecamatan' => 'Torgamba', 'kabupaten_id' => $labusel_id],
            ['nama_kecamatan' => 'Sungai Kanan', 'kabupaten_id' => $labusel_id],
            ['nama_kecamatan' => 'Silang Kitang', 'kabupaten_id' => $labusel_id],

            //9.Kecamatan Untuk Labuhan Batu Utara
            ['nama_kecamatan' => 'Aek Kuo', 'kabupaten_id' => $labuhanbatuutara_id],
            ['nama_kecamatan' => 'Aek Natas', 'kabupaten_id' => $labuhanbatuutara_id],
            ['nama_kecamatan' => 'Kualuh Hilir', 'kabupaten_id' => $labuhanbatuutara_id],
            ['nama_kecamatan' => 'Kualuh hulu', 'kabupaten_id' => $labuhanbatuutara_id],
            ['nama_kecamatan' => 'Kualuh Leidong', 'kabupaten_id' => $labuhanbatuutara_id],
            ['nama_kecamatan' => 'Kualuh Selatan', 'kabupaten_id' => $labuhanbatuutara_id],
            ['nama_kecamatan' => 'Marbau', 'kabupaten_id' => $labuhanbatuutara_id],
            ['nama_kecamatan' => 'Na IX-X', 'kabupaten_id' => $labuhanbatuutara_id],

            //10.Kecamatan untuk Langkat
            ['nama_kecamatan' => 'Babalan', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Bahorok', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Batang Serangan', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Brandan Barat', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Besitang', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Binjai', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Gebang', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Hinai', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Kuala', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Kutambaru', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Padang Tualang', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Pangkalan Susu', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Pematang Jaya', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Salapian', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Sawit seberang', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Secanggang', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Sei Bingai', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Sei Lepan', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Selesai', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Sirapit', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Stabat', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Tanjung Pura', 'kabupaten_id' => $langkat_id],
            ['nama_kecamatan' => 'Wampu', 'kabupaten_id' => $langkat_id],

            
            //11.Kecamatan Untuk Mandailing Natal
            ['nama_kecamatan' => 'Batahan', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Batang Natal', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Bukit Malintang', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Huta Bargot', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Kotanopan', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Lembah Sorik Marapi', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Lingga Bayu', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Muara Batang Gadis', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Muara Sipongi', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Naga Juang', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Natal', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Pakantan', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Panyabungan Barat', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Panyabungan Kota', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Panyabungan Selatan', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Panyabungan Timur', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Panyabungan Utara', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Puncak Sorik Marapi', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Ranto Baek', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Siabu', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Sinunukan', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Tambangan', 'kabupaten_id' => $mandailingnatal_id],
            ['nama_kecamatan' => 'Ulu Pungkut', 'kabupaten_id' => $mandailingnatal_id],

            //12.Kecamatan Untuk Nias
            ['nama_kecamatan' => 'bawolato', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'batomuzui', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'buntulia', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'gido ', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'hiliduho ', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'hili serangkai ', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'idanogawi ', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'mau"u', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'sogae"adu ', 'kabupaten_id' => $nias_id],
            ['nama_kecamatan' => 'somolo molo ', 'kabupaten_id' => $nias_id],

            //13.Kecamatan Untuk Nias Barat
            ['nama_kecamatan' => 'Lahomi', 'kabupaten_id' => $niasbarat_id],
            ['nama_kecamatan' => 'Lolofitu Moi', 'kabupaten_id' => $niasbarat_id],
            ['nama_kecamatan' => 'Mandrehe', 'kabupaten_id' => $niasbarat_id],
            ['nama_kecamatan' => 'Mandrehe Barat', 'kabupaten_id' => $niasbarat_id],
            ['nama_kecamatan' => 'Mandrehe Utara', 'kabupaten_id' => $niasbarat_id],
            ['nama_kecamatan' => 'Moro"o', 'kabupaten_id' => $niasbarat_id],
            ['nama_kecamatan' => 'Sirombu', 'kabupaten_id' => $niasbarat_id],
            ['nama_kecamatan' => 'Afulu', 'kabupaten_id' => $niasbarat_id],


            //14.Kecamatan Untuk Nias Selatan
            ['nama_kecamatan' => 'Amandraya', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Aramo', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Boronadu', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Fanayama', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Gomo', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Hibala', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Hilimegai', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Hilisalawa"ahe', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Huruna', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Idanotae', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Lahusa', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Lolomatua', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Lolowau', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Luahagundre Maniamolo', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Maniamolo', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Mazino', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Mazo', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'o"o"u', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Onohazumba', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Onolalu', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Pulau pulau Batu', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Pulau pulau Batu Barat ', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Pulau pulau Batu Timur', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Pulau pulau Batu Utara', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Sidua"ori', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Simuk', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Somambawa', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Susua', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Tanah Masa', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Teluk Dalam', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Toma ', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Ulunoyo ', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Ulu Idanotae', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Umbunasi', 'kabupaten_id' => $niasselatan_id],
            ['nama_kecamatan' => 'Ulu susua', 'kabupaten_id' => $niasselatan_id],

            //15.Kecamatan Untuk Nias Utara
            ['nama_kecamatan' => 'Afulu', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'Alasa', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'Alasa Talumuzoi', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'Lahewa', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'Lahewa Timur', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'lotu', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'NamoHalu Esiwa', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'Sawo', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'Sitolu Ori', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'Tugala Oyo', 'kabupaten_id' => $niasutara_id],
            ['nama_kecamatan' => 'Tuhemberua', 'kabupaten_id' => $niasutara_id],


            //16.Kecamatan Untuk Padang Lawas
            ['nama_kecamatan' => 'Aek Nabara Barumun', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Barumun', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Barumun Barat', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Barumun Baru', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Barumun Selatan', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Barumun Tengah', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Batang Lubu Sutam', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Huristak', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Huta Raja Tinggi', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Lubuk Barumun', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Sihapas Barumun', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Sosa', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Sosa Julu', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Sosa Timur', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Sosopan', 'kabupaten_id' => $padangLawas_id], 
            ['nama_kecamatan' => 'Ulu Barumun', 'kabupaten_id' => $padangLawas_id],
            ['nama_kecamatan' => 'Ulu Sosa', 'kabupaten_id' => $padangLawas_id],


            //17.Kecamatan Untuk Padang Lawas Utara
            ['nama_kecamatan' => 'Batang Onang', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Dolok', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Dolok Sigompulon', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Halogonan', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Halogonan Timur', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Hulu Sihapas', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Padang Bolak', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Padang Bolak Julu', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Padang Bolak Tenggara', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Portibi', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Simagambat', 'kabupaten_id' => $padangLawasutara_id],
            ['nama_kecamatan' => 'Ujung Batu', 'kabupaten_id' => $padangLawasutara_id],


            //18.Kecamatan Untuk Phakpak Barat
            ['nama_kecamatan' => 'Kerajaan', 'kabupaten_id' => $phakpakBarat_id],
            ['nama_kecamatan' => 'Pangindar', 'kabupaten_id' => $phakpakBarat_id],
            ['nama_kecamatan' => 'Pergetteng Getteng Sengkut', 'kabupaten_id' => $phakpakBarat_id],
            ['nama_kecamatan' => 'Salak', 'kabupaten_id' => $phakpakBarat_id],
            ['nama_kecamatan' => 'Siempat Rube ', 'kabupaten_id' => $phakpakBarat_id],
            ['nama_kecamatan' => 'Sitellu Tali Urang Jehe', 'kabupaten_id' => $phakpakBarat_id],
            ['nama_kecamatan' => 'Sitellu Tali Urang Juhu', 'kabupaten_id' => $phakpakBarat_id],
            ['nama_kecamatan' => 'Tinada', 'kabupaten_id' => $phakpakBarat_id],

            //19.Kecamatan Untuk Samosir
            ['nama_kecamatan' => 'Harian', 'kabupaten_id' => $samosir_id],
            ['nama_kecamatan' => 'Nainggolan', 'kabupaten_id' => $samosir_id],
            ['nama_kecamatan' => 'Pangururan', 'kabupaten_id' => $samosir_id],
            ['nama_kecamatan' => 'Onan Runggu', 'kabupaten_id' => $samosir_id],
            ['nama_kecamatan' => 'Palipi', 'kabupaten_id' => $samosir_id],
            ['nama_kecamatan' => 'Ronggur Ni Huta', 'kabupaten_id' => $samosir_id],
            ['nama_kecamatan' => 'Sianjur Mula-Mula', 'kabupaten_id' => $samosir_id],
            ['nama_kecamatan' => 'Simanindo', 'kabupaten_id' => $samosir_id],
            ['nama_kecamatan' => 'Sitiotio', 'kabupaten_id' => $samosir_id],

            //20.Kecamatan Untuk Serdang Bedagai
            ['nama_kecamatan' => 'Bandar Khalipah', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Bintang Kayu', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Dolok Masihul', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Kotarih', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Silinda', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Sei Bamban', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Sei Rampah', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Serba Jadi', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Perbaungan', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Tanjung Beringin', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Tebing Syahbandar', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Sipispis', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Baja Ronggi', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Pertambatan', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Bandarawan', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Banjaran Godang', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Lubuk Saban ', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Pengajahan', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Pulau Tagor', 'kabupaten_id' => $serdangBerdagai_id],
            ['nama_kecamatan' => 'Kotarih Pekan', 'kabupaten_id' => $serdangBerdagai_id],


            //21.Kecamatan Untuk Simalungun
            ['nama_kecamatan' => 'Bandar', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Bandar Huluan', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Bandar Masilam', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Bosar Maligas', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Dolog Masagal', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => '	Dolok Batu Nanggar', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Dolok Panribuan', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Dolok Pardamean', 'kabupaten_id' => $simalungun_id],  
            ['nama_kecamatan' => 'Dolok Silau', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Girsang Sipangan Bolon', 'kabupaten_id' => $simalungun_id],     
            ['nama_kecamatan' => 'Gunung Malea', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Gunung Maligas', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Harangaol Horison', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Hatonduhan', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Huta Bayu Raja', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan ' => 'Jawa Maraja Bah jambi', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Jorlang Mataram', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Panei', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Pamatang Silima Huta', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Panombeian Panei', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Pematang Bandar', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Pematang Sidamanik', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Purba', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Raya', 'kabupaten_id' => $simalungun_id], 
            ['nama_kecamatan' => 'Raya Kahean', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Siantar', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Sidamanik', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Silimakuta', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Silau Kahean', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Tanah Jawa', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Tapian Dolok', 'kabupaten_id' => $simalungun_id],
            ['nama_kecamatan' => 'Ujung Padang', 'kabupaten_id' => $simalungun_id],
                                           

            //22.Kecamatan Untuk Tapanuli Selatan
            ['nama_kecamatan' => 'Aek Bilah', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Angkola Barat', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Angkola Muara Tais', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Ankola Sangkunur', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Angkola Selatan', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Angkola Timur', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Arse', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Batang Angkola', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Batang Toru', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Marancar', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Muara Batang Toru', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Saipar Dolok Hole', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Sayur Matinggi', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Sipirok', 'kabupaten_id' => $tapsel_id],
            ['nama_kecamatan' => 'Tano Tombangan Angkola', 'kabupaten_id' => $tapsel_id],


            //23.Kecamatan Untuk Tapanuli Tengah
            ['nama_kecamatan' => 'Andam Dewi', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Badiri', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Barus', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Barus Utara', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Kolang', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Lumut', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Maduamas', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Pandan', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Pasaribu Tobing', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Pinangsori', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Sarudik', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Sibabangun', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Sirandorung ', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Sitahuis', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Sosor Gadong', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Sorkam', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Sorkam Barat', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Sukabangun', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Tapian Nauli', 'kabupaten_id' => $tapteng_id],
            ['nama_kecamatan' => 'Tukka', 'kabupaten_id' => $tapteng_id],

            //24.Kecamatan Untuk Tapanuli Utara
            ['nama_kecamatan' => 'Adian Koting', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Siborong Borong', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Garoga', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Muara', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Pagaran', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Pahae Jae', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Pahae Julu', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Pangaribuan', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Parmonangan', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Purba Tua', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Siatas Barita', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Simangumban', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Sipahutar', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Sipoholon', 'kabupaten_id' => $taput_id],
            ['nama_kecamatan' => 'Tarutung', 'kabupaten_id' => $taput_id],

            //25.Kecamatan Untuk Toba 
            ['nama_kecamatan' => 'Ajibata', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Balige', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Bonatua Lunasi', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Borbor', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Habinsaran', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Lagu Boti', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Lumban Julu', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Nassau', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Permaksian', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Pintu Pohan', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Porsea', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Siantar Narumonda', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Sigumpar', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Silaen', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Tampahan', 'kabupaten_id' => $toba_id],
            ['nama_kecamatan' => 'Uluan', 'kabupaten_id' => $toba_id],




            //1.Kota Untuk Binjai
            ['nama_kecamatan' => 'Binjai Barat', 'kabupaten_id' => $binjai_id],
            ['nama_kecamatan' => 'Binjai Kota', 'kabupaten_id' => $binjai_id],
            ['nama_kecamatan' => 'Binjai Selatan', 'kabupaten_id' => $binjai_id],
            ['nama_kecamatan' => 'Binjai Timur', 'kabupaten_id' => $binjai_id],
            ['nama_kecamatan' => 'Binjai Utara', 'kabupaten_id' => $binjai_id],

            //2.Kota Gunung Sitoli

            ['nama_kecamatan' => 'Gunungsitoli', 'kabupaten_id' => $gunungsitoli_id],
            ['nama_kecamatan' => 'Gunungsitoli Alo"oa', 'kabupaten_id' => $gunungsitoli_id],
            ['nama_kecamatan' => 'Gunungsitoli Barat', 'kabupaten_id' => $gunungsitoli_id],
            ['nama_kecamatan' => 'Gunungsitoli Idanoi', 'kabupaten_id' => $gunungsitoli_id],
            ['nama_kecamatan' => 'Gunungsitoli Selatan', 'kabupaten_id' => $gunungsitoli_id],
            ['nama_kecamatan' => 'Gunungsitoli Utara', 'kabupaten_id' => $gunungsitoli_id],


            //3.Kota Medan
            ['nama_kecamatan' => 'Medan Kota', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Amplas', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Are', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Amplas', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Barat', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Deli', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Timur', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Utara', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Polonia', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Tuntungan', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Johor', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Marelan', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Perjuangan', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Selayang', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Sunggetia', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Petial', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Helvsah', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Baru', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Tembung', 'kabupaten_id' => $medan_id], 
            ['nama_kecamatan' => 'Medan Maimun', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Belawang', 'kabupaten_id' => $medan_id],
            ['nama_kecamatan' => 'Medan Jambu', 'kabupaten_id' => $medan_id],

            //4.Kota Padangsidimpuan
            ['nama_kecamatan' => 'Padangsidimpuan Angkola Julu', 'kabupaten_id' => $padangsidempuan_id],
            ['nama_kecamatan' => 'Padangsidimpuan Batunadua', 'kabupaten_id' => $padangsidempuan_id],
            ['nama_kecamatan' => 'Padangsidimpuan Hutaimbaru', 'kabupaten_id' => $padangsidempuan_id],
            ['nama_kecamatan' => 'Padangsidimpuan Selatan', 'kabupaten_id' => $padangsidempuan_id],
            ['nama_kecamatan' => 'Padangsidimpuan Tenggara', 'kabupaten_id' => $padangsidempuan_id],
            ['nama_kecamatan' => 'Padangsidimpuan Utara', 'kabupaten_id' => $padangsidempuan_id],


            //5.Kota Pematang Siantar
            ['nama_kecamatan' => 'Siantar Barat', 'kabupaten_id' => $kotapematangsiantar_id],
            ['nama_kecamatan' => 'Siantar Marihat', 'kabupaten_id' => $kotapematangsiantar_id],
            ['nama_kecamatan' => 'Siantar Marimun', 'kabupaten_id' => $kotapematangsiantar_id],
            ['nama_kecamatan' => 'Siantar Martoba', 'kabupaten_id' => $kotapematangsiantar_id],
            ['nama_kecamatan' => 'Siantar Selatan', 'kabupaten_id' => $kotapematangsiantar_id],
            ['nama_kecamatan' => 'Siantar Sitalasari', 'kabupaten_id' => $kotapematangsiantar_id],
            ['nama_kecamatan' => 'Siantar Timur ', 'kabupaten_id' => $kotapematangsiantar_id],
            ['nama_kecamatan' => 'Siantar Utara', 'kabupaten_id' => $kotapematangsiantar_id],


            //6.Kota Sibolga
            ['nama_kecamatan' => 'Sibolga Utara', 'kabupaten_id' => $sibolga_id],
            ['nama_kecamatan' => 'Sibolga Kota', 'kabupaten_id' => $sibolga_id],
            ['nama_kecamatan' => 'Sibolga Selatan', 'kabupaten_id' => $sibolga_id],
            ['nama_kecamatan' => 'Sibolga Sambas', 'kabupaten_id' => $sibolga_id],


            //7.Kota Tanjung Balai
            ['nama_kecamatan' => 'Datuk Bandar', 'kabupaten_id' => $tanjungbalai_id],
            ['nama_kecamatan' => 'Datuk Bandar Timur', 'kabupaten_id' => $tanjungbalai_id],
            ['nama_kecamatan' => 'Sei Tualang Raso', 'kabupaten_id' => $tanjungbalai_id],
            ['nama_kecamatan' => 'Tanjung Balai Selatan', 'kabupaten_id' => $tanjungbalai_id],
            ['nama_kecamatan' => 'Tanjung Balai Utara', 'kabupaten_id' => $tanjungbalai_id],
            ['nama_kecamatan' => 'Teluk Nibung', 'kabupaten_id' => $tanjungbalai_id],

            
            //8.Kota Tebing Tinggi
            ['nama_kecamatan' => 'Bajenis', 'kabupaten_id' => $tebingtinggi_id],
            ['nama_kecamatan' => 'Padang Hilir', 'kabupaten_id' => $tebingtinggi_id],
            ['nama_kecamatan' => 'Padang Hulu', 'kabupaten_id' => $tebingtinggi_id],
            ['nama_kecamatan' => 'Rambutan', 'kabupaten_id' => $tebingtinggi_id],
            ['nama_kecamatan' => 'Tebing Tinggi Kota ', 'kabupaten_id' => $tebingtinggi_id],



        ]);
    }
}