<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Tangani verifikasi OTP.
     */
    public function __invoke(Request $request)
    {
        // Cari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika pengguna tidak ditemukan atau OTP tidak cocok
        if (!$user || $user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // Tandai email sebagai terverifikasi dan hapus OTP dari database
        $user->forceFill([
            'email_verified_at' => now(),
            'otp' => null,
        ])->save();

        // Login pengguna
        Auth::login($user);

        // Alihkan ke dashboard setelah berhasil
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
