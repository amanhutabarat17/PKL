<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon; // Pastikan Anda mengimpor Carbon

class OtpVerificationController extends Controller
{
    /**
     * Tampilkan form verifikasi OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showVerificationForm(Request $request)
    {
        $email = $request->session()->get('email');
        if (!$email) {
            return redirect()->route('login');
        }
        return view('auth.otp_verification', compact('email'));
    }

    /**
     * Tangani permintaan verifikasi OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada, kode OTP cocok, dan kode belum kedaluwarsa (10 menit)
        if ($user && $user->otp_code === $request->otp_code) {
            // Periksa apakah OTP sudah kedaluwarsa
            if (Carbon::parse($user->otp_created_at)->addMinutes(10)->isPast()) {
                return back()->withErrors(['otp_code' => 'Kode OTP telah kedaluwarsa. Silakan minta kode baru.']);
            }

            // Jika kode benar dan belum kedaluwarsa, tandai email terverifikasi
            $user->email_verified_at = now();
            $user->otp_code = null;
            $user->otp_created_at = null;
            $user->save();

            // Login user secara otomatis setelah verifikasi berhasil
            auth()->login($user);

            return redirect()->route('/user/bpjs-ketenagakerjaan')->with('status', 'Pendaftaran berhasil! Anda dapat masuk sekarang.');
        }

        // Jika kode OTP tidak cocok
        return back()->withErrors(['otp_code' => 'Kode OTP tidak valid.']);
    }
}
