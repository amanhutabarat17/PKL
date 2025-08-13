<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard utama.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mendapatkan data user yang sedang login
        $user = Auth::user();

        // Di sini Anda bisa mengambil data lain dari database
        // Misalnya, data penugasan yang terkait dengan user ini
        // $penugasan = Penugasan::where('user_id', $user->id)->get();

        // Kembalikan tampilan dashboard dan kirimkan data (jika ada)
        return view('dashboard', [
            'user' => $user,
            // 'penugasan' => $penugasan,
        ]);
    }
}
