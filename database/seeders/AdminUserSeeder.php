<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat akun admin default.
     */
    public function run(): void
    {
        // Menggunakan updateOrInsert untuk menghindari duplikasi jika seeder dijalankan lebih dari sekali
        DB::table('users')->updateOrInsert(
            ['email' => 'admin123@gmail.com'], // Kondisi untuk mencari baris yang sudah ada
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('admin'), // Menggunakan Hash::make() untuk mengenkripsi password
                'role' => 'admin', // Menetapkan peran 'admin'
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
