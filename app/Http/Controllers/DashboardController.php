<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard utama.
     *
     * @return \Illuminate\View\View
     */

public function index()
{
    $user = Auth::user();
    $path = storage_path('app/public/DataPenjualanKosmetik.xlsx');

    $rows = Excel::toArray(new class implements ToArray {
        public function array(array $array)
        {
            return $array;
        }
    }, $path)[0];

    return view('dashboard', [
        'user' => $user,
        'rows' => $rows,
    ]);
}
}
