<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /**
     * Tampilkan formulir reset kata sandi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showResetForm(Request $request)
    {
        // Pastikan parameter email ada di URL
        if (!$request->has('email')) {
            return redirect()->route('login')->withErrors(['email' => 'Permintaan tidak valid.']);
        }

        return view('auth.password-reset')->with(['email' => $request->email]);
    }

    /**
     * Reset kata sandi pengguna setelah verifikasi OTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        // Validasi input dari formulir
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'otp_code' => 'required|string',
        ]);

        // Temukan pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Alamat email tidak ditemukan.'])->withInput();
        }

        // Validasi kode OTP dan waktu kadaluarsa
        $otpExpired = $user->otp_created_at->addMinutes(10);
        if ($user->otp_code !== $request->otp_code || Carbon::now()->greaterThan($otpExpired)) {
            return back()->withErrors(['otp_code' => 'Kode OTP tidak valid atau telah kadaluarsa.'])->withInput();
        }

        // Jika OTP valid, ubah kata sandi dan hapus data OTP
        $user->password = Hash::make($request->password);
        $user->otp_code = null;
        $user->otp_created_at = null;
        // Baris $user->otp_verified = true; telah dihapus untuk menghindari error
        $user->save();

        // Arahkan ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('status', 'Kata sandi Anda berhasil diubah! Silakan masuk dengan kata sandi baru Anda.');
    }
}