<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Tangani permintaan login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek apakah user ada dan kredensial cocok
        if ($user && Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek role pengguna dan arahkan ke dashboard yang sesuai
            if ($user->role === 'admin') {
                return redirect()->intended(route('bpjs.ketenagakerjaan'));
            }

            // Tambahkan logika untuk role 'cs'
            if ($user->role === 'cs') {
                return redirect()->intended(route('bpjs.ketenagakerjaancs'));
            }
            
            // Logika untuk user biasa
            return redirect()->intended(route('bpjs.ketenagakerjaanuser'));
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami atau email Anda belum diverifikasi.',
        ]);
    }

    /**
     * Tangani permintaan logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
