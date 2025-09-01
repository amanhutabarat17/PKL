<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardUserController extends Controller
{
    /**
     * Menampilkan dashboard pengguna dengan data yang diambil dari file Excel.
     */
    public function index()
    {
        $path = storage_path('app/public/dataJKM.xlsx');

        // Pastikan file Excel ada
        if (!file_exists($path)) {
            Log::error("File Excel tidak ditemukan di: " . $path);
            return view('user.Dashboard', [
                'error' => 'File data tidak ditemukan.'
            ]);
        }

        try {
            // Muat file Excel
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            // Ambil header dari baris pertama
            $header = array_shift($data);
            
            // Filter baris kosong
            $filteredData = array_filter($data, function($row) {
                return array_filter($row);
            });

            if (empty($filteredData)) {
                return view('user.Dashboard', [
                    'header' => [],
                    'rows' => []
                ]);
            }

            // Siapkan array untuk data baris dan warna
            $rows = [];
            $rowColors = [];

            // Proses setiap baris data yang sudah difilter
            foreach ($filteredData as $row) {
                // Pastikan baris memiliki data yang cukup
                if (count($row) < 6) {
                    continue; 
                }

                // Kolom Tanggal Rekam (asumsi kolom ke-6, index 5)
                $tanggalRekam = $row[5]; 
                
                // Konversi tanggal rekam
                try {
                    if (is_numeric($tanggalRekam)) {
                        $dateRekam = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggalRekam);
                    } else {
                        $dateRekam = new \DateTime($tanggalRekam);
                    }
                    $diffMonths = (new Carbon($dateRekam))->diffInMonths(Carbon::now());
                } catch (\Exception $e) {
                    $diffMonths = 0; // Atur ke 0 jika gagal konversi tanggal
                }

                // Tentukan warna baris
                // PERBAIKAN: Tukar kondisi if-else untuk mencocokkan logika yang diinginkan
                if ($diffMonths <= 6) {
                    $rowColors[] = 'CC0000'; // Merah
                } elseif ($diffMonths > 6) {
                    $rowColors[] = 'FFFF00'; // Kuning
                } else {
                    $rowColors[] = 'FFFFFF'; // Putih
                }

                $rows[] = $row;
            }

            return view('user.Dashboard', compact('header', 'rows', 'rowColors'));
            
        } catch (\Exception $e) {
            Log::error("Error saat memuat Excel: " . $e->getMessage());
            return view('user.Dashboard', [
                'error' => 'Terjadi kesalahan saat memuat data.'
            ]);
        }
    }
}
