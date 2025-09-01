<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /**
     * Tampilkan formulir permintaan lupa kata sandi.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirimkan kode OTP ke email pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validasi input email
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Temukan pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Buat dan simpan kode OTP baru
        $otpCode = rand(100000, 999999);
        $user->otp_code = $otpCode;
        $user->otp_created_at = Carbon::now();
        $user->save();

        // Kirim email berisi kode OTP
        try {
            Mail::to($user->email)->send(new \App\Mail\OtpMail($otpCode));
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email OTP. Mohon coba lagi nanti.'])->withInput();
        }

        // Arahkan ke halaman reset password
        return redirect()->route('password.reset', ['email' => $user->email])
                         ->with('status', 'Kode OTP telah dikirim ke email Anda. Periksa kotak masuk atau spam.');
    }
}