<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan dashboard untuk user biasa.
     */
    public function dashboard()
    {
        return view('user.bpjs-ketenagakerjaan');
    }
}
