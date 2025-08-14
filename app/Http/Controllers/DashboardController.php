<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $path = storage_path('app/public/DataPenjualanKosmetik.xlsx');

        // Load file Excel
        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();
        $highestCol = $sheet->getHighestColumn();

        $rows = [];
        $header = [];

        // Daftar kolom yang memang tanggal (nama sesuai header di Excel)
        $kolomTanggal = ['Tanggal Terima', 'Tanggal Rekam', 'Tanggal meninggal'];

        for ($row = 1; $row <= $highestRow; $row++) {
            $rowData = [];
            $rowColors = [];

            for ($col = 'A'; $col <= $highestCol; $col++) {
                $cell = $sheet->getCell($col . $row);
                $value = $cell->getValue();

                if ($row === 1) {
                    // Baris pertama = header
                    $rowData[] = $value;
                } else {
                    // Cek nama kolom dari baris header
                    $headerName = $sheet->getCell($col . '1')->getValue();

                    if (in_array($headerName, $kolomTanggal)) {
                        // Konversi hanya jika kolom ini memang kolom tanggal
                        if (is_numeric($value) && ExcelDate::isDateTime($cell)) {
                            $value = ExcelDate::excelToDateTimeObject($value)->format('d/m/Y');
                        } elseif (!empty($value)) {
                            try {
                                $value = Carbon::parse($value)->format('d/m/Y');
                            } catch (\Exception $e) {
                                // bukan tanggal
                            }
                        }
                    }
                    $rowData[] = $value;
                }

                // Ambil warna background cell
                $fill = $sheet->getStyle($col . $row)->getFill();
                $color = $fill->getStartColor()->getRGB();
                $rowColors[] = ($color && strtoupper($color) !== 'FFFFFF') ? '#' . $color : '';
            }

            if ($row === 1) {
                $header = $rowData;
            } else {
                $rows[] = [
                    'data' => $rowData,
                    'colors' => $rowColors
                ];
            }
        }

        return view('dashboard', [
            'user'   => $user,
            'header' => $header,
            'rows'   => $rows
        ]);
    }
}
