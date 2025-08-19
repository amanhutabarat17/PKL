<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Ambil semua ID kabupaten dalam satu kali query untuk efisiensi.
        // Hasilnya akan menjadi array seperti ['Asahan' => 1, 'Batu Bara' => 2, ...]
        $kabupatens = DB::table('kabupatens')->pluck('id', 'nama_kabupaten');

        // Definisikan semua data kecamatan dalam satu array besar.
        // Ini lebih mudah dibaca, dikelola, dan diperbaiki jika ada typo.
        $kecamatanData = [
            // 1. Asahan
            ['nama_kecamatan' => 'Bandar Pasir Mandoge', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Bandar Pulau', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Aek Songsongan', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Rahuning', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Pulau Rakyat', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Aek Kuasan', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Aek Ledong', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Sei Kepayang', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Sei Kepayang Barat', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Sei Kepayang Timur', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Tanjung Balai', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Simpang Empat', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Teluk Dalam', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Air Batu', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Sei Dadap', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Buntu Pane', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Tinggi Raja', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Setia Janji', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Meranti', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Pulo Bandring', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Rawang Panca Arga', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Air Joman', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Silau Laut', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Kota Kisaran Barat', 'kabupaten' => 'Asahan'],
            ['nama_kecamatan' => 'Kota Kisaran Timur', 'kabupaten' => 'Asahan'],

            // 2. Batu Bara
            ['nama_kecamatan' => 'Air Putih', 'kabupaten' => 'Batu Bara'],
            ['nama_kecamatan' => 'Lima Puluh', 'kabupaten' => 'Batu Bara'],
            ['nama_kecamatan' => 'Medang Deras', 'kabupaten' => 'Batu Bara'],
            ['nama_kecamatan' => 'Sei Balai', 'kabupaten' => 'Batu Bara'],
            ['nama_kecamatan' => 'Sei Suka', 'kabupaten' => 'Batu Bara'],
            ['nama_kecamatan' => 'Talawi', 'kabupaten' => 'Batu Bara'],
            ['nama_kecamatan' => 'Tanjung Tiram', 'kabupaten' => 'Batu Bara'],

            // 3. Dairi
            ['nama_kecamatan' => 'Berampu', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Gunung Sitember', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Lae Parira', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Parbuluan', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Pegagan Hilir', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Sidikalang', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Siempat Nempu', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Siempat Nempu Hilir', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Siempat Nempu Hulu', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Silahi Sabungan', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Silima Pungga-Pungga', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Sitinjo', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Sumbul', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Tanah Pinem', 'kabupaten' => 'Dairi'],
            ['nama_kecamatan' => 'Tigalingga', 'kabupaten' => 'Dairi'],

            // 4. Deli Serdang
            ['nama_kecamatan' => 'Tanjung Morawa', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Bangun Purba', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Batang Kuis', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Beringin', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Biru-Biru', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Deli Tua', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Gunung Meriah', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Galang', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Hamparan Perak', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Kutalimbaru', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Labuhan Deli', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Lubuk Pakam', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Namorambe', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Pagar Merbau', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Pancur Batu', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Pantai Labu', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Patumbak', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Percut Sei Tuan', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Sibolangit', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'STM Hilir', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'STM Hulu', 'kabupaten' => 'Deli Serdang'],
            ['nama_kecamatan' => 'Sunggal', 'kabupaten' => 'Deli Serdang'],

            // 5. Humbang Hasundutan
            ['nama_kecamatan' => 'Pakkat', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Onan Ganjang', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Sijamapolang', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Lintongnihuta', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Paranginan', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Dolok Sanggul', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Pollung', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Parlilitan', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Tarabintang', 'kabupaten' => 'Humbang Hasundutan'],
            ['nama_kecamatan' => 'Baktiraja', 'kabupaten' => 'Humbang Hasundutan'],

            // 6. Karo
            ['nama_kecamatan' => 'Kabanjahe', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Berastagi', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Barusjahe', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Tigapanah', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Merek', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Munte', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Kutabuluh', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Payung', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Juhar', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Mardingding', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Merdeka', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Dolat Rayat', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Laubaleng', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Simpang Empat', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Tigabinanga', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Tiganderket', 'kabupaten' => 'Karo'],
            ['nama_kecamatan' => 'Naman Teran', 'kabupaten' => 'Karo'],

            // 7. Labuhan Batu
            ['nama_kecamatan' => 'Bilah Barat', 'kabupaten' => 'Labuhan Batu'],
            ['nama_kecamatan' => 'Bilah Hilir', 'kabupaten' => 'Labuhan Batu'],
            ['nama_kecamatan' => 'Bilah Hulu', 'kabupaten' => 'Labuhan Batu'],
            ['nama_kecamatan' => 'Panai Hulu', 'kabupaten' => 'Labuhan Batu'],
            ['nama_kecamatan' => 'Panai Tengah', 'kabupaten' => 'Labuhan Batu'],
            ['nama_kecamatan' => 'Pangkatan', 'kabupaten' => 'Labuhan Batu'],
            ['nama_kecamatan' => 'Rantau Selatan', 'kabupaten' => 'Labuhan Batu'],
            ['nama_kecamatan' => 'Rantau Utara', 'kabupaten' => 'Labuhan Batu'],

            // 8. Labuhan Batu Selatan
            ['nama_kecamatan' => 'Kota Pinang', 'kabupaten' => 'Labuhan Batu Selatan'],
            ['nama_kecamatan' => 'Kampung Rakyat', 'kabupaten' => 'Labuhan Batu Selatan'],
            ['nama_kecamatan' => 'Torgamba', 'kabupaten' => 'Labuhan Batu Selatan'],
            ['nama_kecamatan' => 'Sungai Kanan', 'kabupaten' => 'Labuhan Batu Selatan'],
            ['nama_kecamatan' => 'Silang Kitang', 'kabupaten' => 'Labuhan Batu Selatan'],

            // 9. Labuhan Batu Utara
            ['nama_kecamatan' => 'Aek Kuo', 'kabupaten' => 'Labuhan Batu Utara'],
            ['nama_kecamatan' => 'Aek Natas', 'kabupaten' => 'Labuhan Batu Utara'],
            ['nama_kecamatan' => 'Kualuh Hilir', 'kabupaten' => 'Labuhan Batu Utara'],
            ['nama_kecamatan' => 'Kualuh Hulu', 'kabupaten' => 'Labuhan Batu Utara'],
            ['nama_kecamatan' => 'Kualuh Leidong', 'kabupaten' => 'Labuhan Batu Utara'],
            ['nama_kecamatan' => 'Kualuh Selatan', 'kabupaten' => 'Labuhan Batu Utara'],
            ['nama_kecamatan' => 'Marbau', 'kabupaten' => 'Labuhan Batu Utara'],
            ['nama_kecamatan' => 'Na IX-X', 'kabupaten' => 'Labuhan Batu Utara'],

            // 10. Langkat
            ['nama_kecamatan' => 'Babalan', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Bahorok', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Batang Serangan', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Brandan Barat', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Besitang', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Binjai', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Gebang', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Hinai', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Kuala', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Kutambaru', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Padang Tualang', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Pangkalan Susu', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Pematang Jaya', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Salapian', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Sawit Seberang', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Secanggang', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Sei Bingai', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Sei Lepan', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Selesai', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Sirapit', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Stabat', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Tanjung Pura', 'kabupaten' => 'Langkat'],
            ['nama_kecamatan' => 'Wampu', 'kabupaten' => 'Langkat'],

            // 11. Mandailing Natal
            ['nama_kecamatan' => 'Batahan', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Batang Natal', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Bukit Malintang', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Huta Bargot', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Kotanopan', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Lembah Sorik Marapi', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Lingga Bayu', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Muara Batang Gadis', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Muara Sipongi', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Naga Juang', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Natal', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Pakantan', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Panyabungan Barat', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Panyabungan Kota', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Panyabungan Selatan', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Panyabungan Timur', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Panyabungan Utara', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Puncak Sorik Marapi', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Ranto Baek', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Siabu', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Sinunukan', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Tambangan', 'kabupaten' => 'Mandailing Natal'],
            ['nama_kecamatan' => 'Ulu Pungkut', 'kabupaten' => 'Mandailing Natal'],

            // 12. Nias
            ['nama_kecamatan' => 'Bawolato', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Botomuzoi', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Bontulia', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Gido', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Hiliduho', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Hili Serangkai', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Idanogawo', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Ma\'u', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Sogaeadu', 'kabupaten' => 'Nias'],
            ['nama_kecamatan' => 'Somolo-molo', 'kabupaten' => 'Nias'],

            // 13. Nias Barat
            ['nama_kecamatan' => 'Lahomi', 'kabupaten' => 'Nias Barat'],
            ['nama_kecamatan' => 'Lolofitu Moi', 'kabupaten' => 'Nias Barat'],
            ['nama_kecamatan' => 'Mandrehe', 'kabupaten' => 'Nias Barat'],
            ['nama_kecamatan' => 'Mandrehe Barat', 'kabupaten' => 'Nias Barat'],
            ['nama_kecamatan' => 'Mandrehe Utara', 'kabupaten' => 'Nias Barat'],
            ['nama_kecamatan' => 'Moro\'o', 'kabupaten' => 'Nias Barat'],
            ['nama_kecamatan' => 'Sirombu', 'kabupaten' => 'Nias Barat'],
            ['nama_kecamatan' => 'Ulu Moro\'o', 'kabupaten' => 'Nias Barat'],

            // 14. Nias Selatan
            ['nama_kecamatan' => 'Amandraya', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Aramo', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Boronadu', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Fanayama', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Gomo', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Hibala', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Hilimegai', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Hilisalawa\'ahe', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Huruna', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Idanotae', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Lahusa', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Lolomatua', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Lolowau', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Luahagundre Maniamolo', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Maniamolo', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Mazino', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Mazo', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'O\'o\'u', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Onohazumba', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Onolalu', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Pulau-Pulau Batu', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Pulau-Pulau Batu Barat', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Pulau-Pulau Batu Timur', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Pulau-Pulau Batu Utara', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Sidua\'ori', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Simuk', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Somambawa', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Susua', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Tanah Masa', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Teluk Dalam', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Toma', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Ulunoyo', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Ulu Idanotae', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Umbunasi', 'kabupaten' => 'Nias Selatan'],
            ['nama_kecamatan' => 'Ulu Susua', 'kabupaten' => 'Nias Selatan'],

            // 15. Nias Utara
            ['nama_kecamatan' => 'Afulu', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Alasa', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Alasa Talumuzoi', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Lahewa', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Lahewa Timur', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Lotu', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Namohalu Esiwa', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Sawo', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Sitolu Ori', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Tugala Oyo', 'kabupaten' => 'Nias Utara'],
            ['nama_kecamatan' => 'Tuhemberua', 'kabupaten' => 'Nias Utara'],

            // 16. Padang Lawas
            ['nama_kecamatan' => 'Aek Nabara Barumun', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Barumun', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Barumun Barat', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Barumun Baru', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Barumun Selatan', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Barumun Tengah', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Batang Lubu Sutam', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Huristak', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Huta Raja Tinggi', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Lubuk Barumun', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Sihapas Barumun', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Sosa', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Sosa Julu', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Sosa Timur', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Sosopan', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Ulu Barumun', 'kabupaten' => 'Padang Lawas'],
            ['nama_kecamatan' => 'Ulu Sosa', 'kabupaten' => 'Padang Lawas'],

            // 17. Padang Lawas Utara
            ['nama_kecamatan' => 'Batang Onang', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Dolok', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Dolok Sigompulon', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Halongonan', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Halongonan Timur', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Hulu Sihapas', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Padang Bolak', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Padang Bolak Julu', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Padang Bolak Tenggara', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Portibi', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Simangambat', 'kabupaten' => 'Padang Lawas Utara'],
            ['nama_kecamatan' => 'Ujung Batu', 'kabupaten' => 'Padang Lawas Utara'],

            // 18. Pakpak Bharat
            ['nama_kecamatan' => 'Kerajaan', 'kabupaten' => 'Pakpak Bharat'],
            ['nama_kecamatan' => 'Pagindar', 'kabupaten' => 'Pakpak Bharat'],
            ['nama_kecamatan' => 'Pergetteng-getteng Sengkut', 'kabupaten' => 'Pakpak Bharat'],
            ['nama_kecamatan' => 'Salak', 'kabupaten' => 'Pakpak Bharat'],
            ['nama_kecamatan' => 'Siempat Rube', 'kabupaten' => 'Pakpak Bharat'],
            ['nama_kecamatan' => 'Sitellu Tali Urang Jehe', 'kabupaten' => 'Pakpak Bharat'],
            ['nama_kecamatan' => 'Sitellu Tali Urang Julu', 'kabupaten' => 'Pakpak Bharat'],
            ['nama_kecamatan' => 'Tinada', 'kabupaten' => 'Pakpak Bharat'],

            // 19. Samosir
            ['nama_kecamatan' => 'Harian', 'kabupaten' => 'Samosir'],
            ['nama_kecamatan' => 'Nainggolan', 'kabupaten' => 'Samosir'],
            ['nama_kecamatan' => 'Pangururan', 'kabupaten' => 'Samosir'],
            ['nama_kecamatan' => 'Onan Runggu', 'kabupaten' => 'Samosir'],
            ['nama_kecamatan' => 'Palipi', 'kabupaten' => 'Samosir'],
            ['nama_kecamatan' => 'Ronggur Nihuta', 'kabupaten' => 'Samosir'],
            ['nama_kecamatan' => 'Sianjur Mula-Mula', 'kabupaten' => 'Samosir'],
            ['nama_kecamatan' => 'Simanindo', 'kabupaten' => 'Samosir'],
            ['nama_kecamatan' => 'Sitiotio', 'kabupaten' => 'Samosir'],

            // 20. Serdang Bedagai
            ['nama_kecamatan' => 'Bandar Khalipah', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Bintang Bayu', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Dolok Masihul', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Kotarih', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Silinda', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Sei Bamban', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Sei Rampah', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Serba Jadi', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Perbaungan', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Tanjung Beringin', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Tebing Syahbandar', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Sipispis', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Dolok Merawan', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Pantai Cermin', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Pegajahan', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Teluk Mengkudu', 'kabupaten' => 'Serdang Bedagai'],
            ['nama_kecamatan' => 'Tebing Tinggi', 'kabupaten' => 'Serdang Bedagai'],

            // 21. Simalungun
            ['nama_kecamatan' => 'Bandar', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Bandar Huluan', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Bandar Masilam', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Bosar Maligas', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Dolog Masagal', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Dolok Batunanggar', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Dolok Panribuan', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Dolok Pardamean', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Dolok Silau', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Girsang Sipangan Bolon', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Gunung Malela', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Gunung Maligas', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Haranggaol Horison', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Hatonduhan', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Huta Bayu Raja', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Jawa Maraja Bah Jambi', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Jorlang Hataran', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Panei', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Pamatang Silimahuta', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Panombeian Panei', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Pematang Bandar', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Pematang Sidamanik', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Purba', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Raya', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Raya Kahean', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Siantar', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Sidamanik', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Silimakuta', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Silou Kahean', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Tanah Jawa', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Tapian Dolok', 'kabupaten' => 'Simalungun'],
            ['nama_kecamatan' => 'Ujung Padang', 'kabupaten' => 'Simalungun'],

            // 22. Tapanuli Selatan
            ['nama_kecamatan' => 'Aek Bilah', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Angkola Barat', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Angkola Muara Tais', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Angkola Sangkunur', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Angkola Selatan', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Angkola Timur', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Arse', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Batang Angkola', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Batang Toru', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Marancar', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Muara Batang Toru', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Saipar Dolok Hole', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Sayur Matinggi', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Sipirok', 'kabupaten' => 'Tapanuli Selatan'],
            ['nama_kecamatan' => 'Tano Tombangan Angkola', 'kabupaten' => 'Tapanuli Selatan'],

            // 23. Tapanuli Tengah
            ['nama_kecamatan' => 'Andam Dewi', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Badiri', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Barus', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Barus Utara', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Kolang', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Lumut', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Manduamas', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Pandan', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Pasaribu Tobing', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Pinangsori', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Sarudik', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Sibabangun', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Sirandorung', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Sitahuis', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Sosor Gadong', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Sorkam', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Sorkam Barat', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Sukabangun', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Tapian Nauli', 'kabupaten' => 'Tapanuli Tengah'],
            ['nama_kecamatan' => 'Tukka', 'kabupaten' => 'Tapanuli Tengah'],

            // 24. Tapanuli Utara
            ['nama_kecamatan' => 'Adian Koting', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Siborong-Borong', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Garoga', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Muara', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Pagaran', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Pahae Jae', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Pahae Julu', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Pangaribuan', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Parmonangan', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Purbatua', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Siatas Barita', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Simangumban', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Sipahutar', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Sipoholon', 'kabupaten' => 'Tapanuli Utara'],
            ['nama_kecamatan' => 'Tarutung', 'kabupaten' => 'Tapanuli Utara'],

            // 25. Toba
            ['nama_kecamatan' => 'Ajibata', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Balige', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Bonatua Lunasi', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Borbor', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Habinsaran', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Laguboti', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Lumban Julu', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Nassau', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Parmaksian', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Pintu Pohan Meranti', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Porsea', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Siantar Narumonda', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Sigumpar', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Silaen', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Tampahan', 'kabupaten' => 'Toba'],
            ['nama_kecamatan' => 'Uluan', 'kabupaten' => 'Toba'],

            // KOTA-KOTA
            // 1. Binjai
            ['nama_kecamatan' => 'Binjai Barat', 'kabupaten' => 'Binjai'],
            ['nama_kecamatan' => 'Binjai Kota', 'kabupaten' => 'Binjai'],
            ['nama_kecamatan' => 'Binjai Selatan', 'kabupaten' => 'Binjai'],
            ['nama_kecamatan' => 'Binjai Timur', 'kabupaten' => 'Binjai'],
            ['nama_kecamatan' => 'Binjai Utara', 'kabupaten' => 'Binjai'],

            // 2. Gunung Sitoli
            ['nama_kecamatan' => 'Gunungsitoli', 'kabupaten' => 'Gunung Sitoli'],
            ['nama_kecamatan' => 'Gunungsitoli Alo\'oa', 'kabupaten' => 'Gunung Sitoli'],
            ['nama_kecamatan' => 'Gunungsitoli Barat', 'kabupaten' => 'Gunung Sitoli'],
            ['nama_kecamatan' => 'Gunungsitoli Idanoi', 'kabupaten' => 'Gunung Sitoli'],
            ['nama_kecamatan' => 'Gunungsitoli Selatan', 'kabupaten' => 'Gunung Sitoli'],
            ['nama_kecamatan' => 'Gunungsitoli Utara', 'kabupaten' => 'Gunung Sitoli'],

            // 3. Medan
            ['nama_kecamatan' => 'Medan Kota', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Amplas', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Area', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Barat', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Deli', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Timur', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Labuhan', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Polonia', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Tuntungan', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Johor', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Marelan', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Perjuangan', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Selayang', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Sunggal', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Petisah', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Helvetia', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Baru', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Tembung', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Maimun', 'kabupaten' => 'Medan'],
            ['nama_kecamatan' => 'Medan Belawan', 'kabupaten' => 'Medan'],

            // 4. Padang Sidempuan
            ['nama_kecamatan' => 'Padangsidimpuan Angkola Julu', 'kabupaten' => 'Padang Sidempuan'],
            ['nama_kecamatan' => 'Padangsidimpuan Batunadua', 'kabupaten' => 'Padang Sidempuan'],
            ['nama_kecamatan' => 'Padangsidimpuan Hutaimbaru', 'kabupaten' => 'Padang Sidempuan'],
            ['nama_kecamatan' => 'Padangsidimpuan Selatan', 'kabupaten' => 'Padang Sidempuan'],
            ['nama_kecamatan' => 'Padangsidimpuan Tenggara', 'kabupaten' => 'Padang Sidempuan'],
            ['nama_kecamatan' => 'Padangsidimpuan Utara', 'kabupaten' => 'Padang Sidempuan'],

            // 5. Pematang Siantar
            ['nama_kecamatan' => 'Siantar Barat', 'kabupaten' => 'Pematang Siantar'],
            ['nama_kecamatan' => 'Siantar Marihat', 'kabupaten' => 'Pematang Siantar'],
            ['nama_kecamatan' => 'Siantar Marimbun', 'kabupaten' => 'Pematang Siantar'],
            ['nama_kecamatan' => 'Siantar Martoba', 'kabupaten' => 'Pematang Siantar'],
            ['nama_kecamatan' => 'Siantar Selatan', 'kabupaten' => 'Pematang Siantar'],
            ['nama_kecamatan' => 'Siantar Sitalasari', 'kabupaten' => 'Pematang Siantar'],
            ['nama_kecamatan' => 'Siantar Timur', 'kabupaten' => 'Pematang Siantar'],
            ['nama_kecamatan' => 'Siantar Utara', 'kabupaten' => 'Pematang Siantar'],

            // 6. Sibolga
            ['nama_kecamatan' => 'Sibolga Utara', 'kabupaten' => 'Sibolga'],
            ['nama_kecamatan' => 'Sibolga Kota', 'kabupaten' => 'Sibolga'],
            ['nama_kecamatan' => 'Sibolga Selatan', 'kabupaten' => 'Sibolga'],
            ['nama_kecamatan' => 'Sibolga Sambas', 'kabupaten' => 'Sibolga'],

            // 7. Tanjung Balai
            ['nama_kecamatan' => 'Datuk Bandar', 'kabupaten' => 'Tanjung Balai'],
            ['nama_kecamatan' => 'Datuk Bandar Timur', 'kabupaten' => 'Tanjung Balai'],
            ['nama_kecamatan' => 'Sei Tualang Raso', 'kabupaten' => 'Tanjung Balai'],
            ['nama_kecamatan' => 'Tanjungbalai Selatan', 'kabupaten' => 'Tanjung Balai'],
            ['nama_kecamatan' => 'Tanjungbalai Utara', 'kabupaten' => 'Tanjung Balai'],
            ['nama_kecamatan' => 'Teluk Nibung', 'kabupaten' => 'Tanjung Balai'],

            // 8. Tebing Tinggi
            ['nama_kecamatan' => 'Bajenis', 'kabupaten' => 'Tebing Tinggi'],
            ['nama_kecamatan' => 'Padang Hilir', 'kabupaten' => 'Tebing Tinggi'],
            ['nama_kecamatan' => 'Padang Hulu', 'kabupaten' => 'Tebing Tinggi'],
            ['nama_kecamatan' => 'Rambutan', 'kabupaten' => 'Tebing Tinggi'],
            ['nama_kecamatan' => 'Tebing Tinggi Kota', 'kabupaten' => 'Tebing Tinggi'],
        ];
        
        // Siapkan array untuk di-insert ke database
        $dataToInsert = [];
        foreach ($kecamatanData as $data) {
            // Cek apakah nama kabupaten ada di dalam data yang kita ambil dari DB
            if (isset($kabupatens[$data['kabupaten']])) {
                $dataToInsert[] = [
                    'nama_kecamatan' => $data['nama_kecamatan'],
                    'kabupaten_id'   => $kabupatens[$data['kabupaten']],
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }
            // Jika tidak ada, data akan dilewati, mencegah error.
        }

        // Hapus data lama untuk menghindari duplikasi saat seeder dijalankan ulang
        DB::table('kecamatans')->delete();

        // Insert semua data sekaligus dalam potongan-potongan (chunk) agar lebih efisien
        // Ini penting jika datanya sangat banyak (ribuan)
        foreach (array_chunk($dataToInsert, 500) as $chunk) {
            DB::table('kecamatans')->insert($chunk);
        }
    }
}
