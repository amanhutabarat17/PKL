<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Otp;
use App\Mail\OtpMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RegisterOtpController extends Controller
{
    /**
     * Tampilkan formulir pendaftaran.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Tangani permintaan pendaftaran yang masuk dan kirim OTP.
     */
    public function register(Request $request)
    {
        // Validasi input pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru dengan status belum terverifikasi
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => null, // Tandai belum terverifikasi
        ]);

        // Hapus kode OTP lama jika ada untuk email ini
        Otp::where('email', $request->email)->delete();

        // Buat kode OTP acak (6 digit)
        $otpCode = rand(100000, 999999);

        // Simpan kode OTP ke dalam tabel 'otps'
        Otp::create([
            'email' => $request->email,
            'code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(5), // OTP kedaluwarsa dalam 5 menit
        ]);

        // Kirim email yang berisi kode OTP ke pengguna
        try {
            Mail::to($request->email)->send(new OtpMail($otpCode));
        } catch (\Exception $e) {
            // Jika gagal, hapus user dan OTP yang baru dibuat
            $user->delete();
            Otp::where('email', $request->email)->delete();
            // Kembalikan pesan error ke pengguna
            return back()->withErrors(['email' => 'Gagal mengirim email verifikasi. Silakan coba lagi.']);
        }

        // Redirect ke halaman verifikasi OTP
        return redirect()->route('otp.show', ['email' => $request->email])
                         ->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    // ... method lainnya, seperti showOtpVerificationForm dan verifyOtp ...
}
