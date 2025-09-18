<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function index()
    {
        $path = 'C:/Users/HP/OneDrive/Folder2/dataJKM.xlsx';
        $rows = Excel::toArray([], $path)[0];

        return view('dashboard', compact('rows'));
    }
}



