<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin.
     */
    public function dashboard()
    {
        // Logika untuk mengambil data yang hanya dapat diakses oleh admin
        $users = \App\Models\User::all(); // Contoh: Mengambil semua data user
        
        return view('dashboard', compact('users'));
    }
}
