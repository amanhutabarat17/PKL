<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterOtpController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $otpCode = Str::random(6);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp_code' => $otpCode,
            'otp_created_at' => now(),
        ]);

        // Kirim email OTP
        Mail::to($user->email)->send(new \App\Mail\OtpMail($otpCode));

        // Ubah redirect untuk meneruskan alamat email
        return redirect()->route('verification.otp.form')->with('success', 'Kode OTP telah dikirim ke email Anda.')->with('email', $user->email);
    }
}
