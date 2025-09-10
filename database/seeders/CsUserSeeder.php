<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 💡 Perbaikan: Tambahkan pengecekan untuk menghindari duplikasi
        // Ini memastikan user hanya dibuat jika email 'cs123@gmail.com' belum ada.
        if (!User::where('email', 'cs123@gmail.com')->exists()) {
            User::create([
                'name' => 'CS',
                'email' => 'cs123@gmail.com',
                'password' => Hash::make('csbpjs123'), // Ganti dengan password yang aman
                'role' => 'cs',
            ]);
        }
    }
}
