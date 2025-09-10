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
   
    // Baris Excel dari mana data dimulai (contoh: baris ke-3)
    private $startRow = 3;

    // Normalisasi nama kolom
    private function normalizeName($name)
    {
        return strtolower(trim(preg_replace('/[\s_]+/', '', $name)));
    }
    /**
     * Re-number ulang kolom A supaya selalu urut dari 1
     */
    private function renumberRows($sheet)
    {
        $rowNumber = 1;
        $highestRow = $sheet->getHighestRow();

        for ($row = $this->startRow; $row <= $highestRow; $row++) {
            $nama = $sheet->getCell('B' . $row)->getValue();
            if (!empty($nama)) {
                $sheet->setCellValue('A' . $row, $rowNumber);
                $rowNumber++;
            } else {
                $sheet->setCellValue('A' . $row, null); // Kosongkan ID
            }
        }
    }

    /**
     * Helper: Terapkan warna baris sesuai selisih tanggal
     */
    private function applyRowColor($sheet, $rowIndex)
    {
        $tglRekam = $sheet->getCell('F' . $rowIndex)->getValue();
        $tglMeninggal = $sheet->getCell('H' . $rowIndex)->getValue();
        $status = strtolower(trim($sheet->getCell('G' . $rowIndex)->getValue())); // Ambil status dan normalisasi

        // Jika status diterima → warna hijau
        if ($status === 'diterima') {
            $sheet->getStyle("A{$rowIndex}:K{$rowIndex}")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('32CD32');
            return;
        }

        // Skip jika tanggal kosong
        if (!$tglRekam || !$tglMeninggal) {
            return;
        }

        // Konversi tanggal rekam
        if (is_numeric($tglRekam)) {
            $dateRekam = ExcelDate::excelToDateTimeObject($tglRekam);
        } else {
            $dateRekam = new \DateTime($tglRekam);
        }

        // Konversi tanggal meninggal
        if (is_numeric($tglMeninggal)) {
            $dateMeninggal = ExcelDate::excelToDateTimeObject($tglMeninggal);
        } else {
            $dateMeninggal = new \DateTime($tglMeninggal);
        }

        // Hitung selisih bulan
        $diff = $dateRekam->diff($dateMeninggal);
        $months = $diff->m + ($diff->y * 12);

        if ($months > 6) {
            // Lebih dari 6 bulan → warna merah tua
            $sheet->getStyle("A{$rowIndex}:K{$rowIndex}")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('CC0000'); // Merah tua
        } else {
            // 6 bulan ke bawah → warna kuning
            $sheet->getStyle("A{$rowIndex}:K{$rowIndex}")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('FFFF00'); // Kuning
        }
    }

    public function index()
    {
        $path = storage_path('app/public/dataJKM.xlsx');

        if (!file_exists($path)) {
            return view('user.dashboard', ['error' => 'File Excel tidak ditemukan.']);
        }

        try {
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();

            // Ambil header dan buang kolom pertama (A/No)
            $header = array_shift($data);
            $header = array_slice($header, 1);
            array_unshift($header, 'ID');

            // Buang baris sebelum startRow
            for ($i = 2; $i < $this->startRow; $i++) {
                array_shift($data);
            }

            $rows = [];
            $rowColors = [];
            $idMapping = [];

            foreach ($data as $index => $row) {
                $rowIndexInExcel = $index + $this->startRow;
                $idForTabledit = $index + 1;

                $cleanRow = array_merge([$idForTabledit], array_slice($row, 1));
                $rows[] = $cleanRow;
                $idMapping[$idForTabledit] = $rowIndexInExcel;

                // Ambil warna dari kolom H
                $cellCoordinate = 'B' . $rowIndexInExcel;
                $cellStyle = $sheet->getStyle($cellCoordinate);
                $fillColor = $cellStyle->getFill()->getStartColor()->getRGB();

                $rowColors[] = $fillColor ?: 'FFFFFF';
            }

            // Re-index rows dengan urutan yang benar
            $reindexedRows = [];
            $reindexedColors = [];
            $newIdMapping = [];

            foreach ($rows as $i => $row) {
                $newId = $i + 1;
                $row[0] = $newId; // Update ID di kolom pertama
                $reindexedRows[] = $row;
                $reindexedColors[] = $rowColors[$i];
                $newIdMapping[$newId] = $idMapping[$row[0]];
            }

            session(['idMapping' => $newIdMapping]);

            return view('user.dashboard', [
                'header' => $header,
                'rows' => $rows,
                'rowColors' => $rowColors,
            ]);
        } catch (\Exception $e) {
            Log::error("Error loading Excel file: " . $e->getMessage());
            return view('user.dashboard', ['error' => 'Terjadi kesalahan saat memuat file Excel.']);
        }
    }

}
