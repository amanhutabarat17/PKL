<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpVerificationController extends Controller
{
    /**
     * Tampilkan form verifikasi OTP.
     */
    public function show(Request $request)
    {
        // Jika user sudah login dan terverifikasi, alihkan ke dashboard.
        if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Tampilkan view verifikasi OTP.
        return view('auth.verify-otp');
    }

    /**
     * Tangani verifikasi OTP.
     */
    public function verify(Request $request)
    {
        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Validasi OTP
        if (!$user || $user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Kode OTP salah.']);
        }

        // Tandai email sebagai terverifikasi dan hapus OTP
        $user->forceFill([
            'email_verified_at' => now(),
            'otp' => null,
        ])->save();

        // Login user
        Auth::login($user);

        // Alihkan ke dashboard setelah berhasil
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
