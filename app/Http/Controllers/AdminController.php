<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin.
     */
    public function dashboard()
    {
        // Mengambil semua data user, ini bisa disesuaikan
        $users = User::all();
        
        // Mengarahkan ke view dashboard admin
        return view('bpjs.ketenagakerjaan', compact('users'));
    }
}
