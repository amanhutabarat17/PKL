<?php
// Class: LoginController
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->status === 'unverified') {
            Auth::logout();
            return redirect()->route('verification.otp.show')->with('status', 'Silakan verifikasi akun Anda dengan kode OTP yang kami kirimkan.');
        }

        return redirect()->intended($this->redirectPath());
    }
}
