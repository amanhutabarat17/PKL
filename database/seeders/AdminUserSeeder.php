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
        DB::table('users')->updateOrInsert(
            ['email' => 'admin123@gmail.com'], // cek berdasarkan email
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('admin'), // password default
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
