<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class DashboardController extends Controller
{
    // Baris Excel dari mana data dimulai (contoh: baris ke-3)
    private $startRow = 3;

    // Normalisasi nama kolom
    private function normalizeName($name)
    {
        return strtolower(trim(preg_replace('/[\s_]+/', '', $name)));
    }

    /**
     * Helper: Terapkan warna baris sesuai selisih tanggal
     */
    private function applyRowColor($sheet, $rowIndex)
    {
        $tglRekam = $sheet->getCell('F' . $rowIndex)->getValue();
        $tglMeninggal = $sheet->getCell('H' . $rowIndex)->getValue();

        if (!$tglRekam || !$tglMeninggal) {
            return; // skip kalau salah satu kosong
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
            // Lebih dari 6 bulan → baris merah tua
            $sheet->getStyle("A{$rowIndex}:K{$rowIndex}")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('FFFF00'); // DarkRed
        } else {
            // 6 bulan ke bawah → baris kuning
            $sheet->getStyle("A{$rowIndex}:K{$rowIndex}")
                ->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('CC0000'); // Yellow
        }
    }

    public function index()
    {
        $path = storage_path('app/public/DataPenjualanKosmetik.xlsx');

        if (!file_exists($path)) {
            return view('dashboard', ['error' => 'File Excel tidak ditemukan.']);
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

            session(['idMapping' => $idMapping]);

            return view('dashboard', [
                'header' => $header,
                'rows' => $rows,
                'rowColors' => $rowColors,
            ]);
        } catch (\Exception $e) {
            Log::error("Error loading Excel file: " . $e->getMessage());
            return view('dashboard', ['error' => 'Terjadi kesalahan saat memuat file Excel.']);
        }
    }

    public function update(Request $request)
    {
        try {
            $path = storage_path('app/public/DataPenjualanKosmetik.xlsx');
            Log::info("Path Excel: " . $path);

            if (!file_exists($path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File Excel tidak ditemukan di: ' . $path
                ]);
            }

            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();

            $id = (int) $request->input('ID');
            $idMapping = session('idMapping', []);
            $rowIndex = $idMapping[$id] ?? null;

            if (!$rowIndex) {
                return response()->json(['success' => false, 'message' => "ID $id tidak ditemukan"]);
            }

            // Ambil header
            $headers = $sheet->rangeToArray('A1:' . $sheet->getHighestColumn() . '1')[0];
            $headerMapping = [];
            foreach ($headers as $index => $headerName) {
                if (!is_null($headerName) && trim($headerName) !== '') {
                    $headerMapping[$this->normalizeName($headerName)] = $index + 1;
                }
            }

            $updatedFields = [];
            foreach ($request->except(['ID', 'action']) as $field => $value) {
                $searchField = $this->normalizeName($field);
                $colIndex = $headerMapping[$searchField] ?? null;

                if ($colIndex) {
                    $isDateField = stripos($searchField, 'tgl') !== false ||
                        stripos($searchField, 'tanggal') !== false ||
                        stripos($searchField, 'date') !== false;

                    if ($isDateField) {
                        $dateObj = null;
                        $formats = ['Y-m-d', 'd/m/Y', 'd-m-Y', 'm/d/Y', 'Y/m/d'];
                        foreach ($formats as $format) {
                            $dateObj = \DateTime::createFromFormat($format, $value);
                            if ($dateObj !== false)
                                break;
                        }
                        if (!$dateObj) {
                            $dateObj = date_create($value);
                        }

                        if ($dateObj) {
                            $excelDate = ExcelDate::PHPToExcel($dateObj);
                            $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $excelDate);
                            $sheet->getStyleByColumnAndRow($colIndex, $rowIndex)
                                ->getNumberFormat()
                                ->setFormatCode('yyyy-mm-dd');
                        } else {
                            $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $value);
                        }
                    } else {
                        $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $value);
                    }

                    $updatedFields[$field] = [
                        'value' => $value,
                        'colIndex' => $colIndex,
                        'rowIndex' => $rowIndex
                    ];
                } else {
                    Log::warning("Kolom tidak ditemukan: $field");
                }
            }
            // Terapkan warna setelah update
            $this->applyRowColor($sheet, $rowIndex);

            // Ambil warna terbaru dari baris Excel
            $fillColor = $sheet->getStyle("B{$rowIndex}")
                ->getFill()
                ->getStartColor()
                ->getRGB();

            $writer = new Xlsx($spreadsheet);
            $writer->save($path);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'updated' => $updatedFields,
                'rowColor' => $fillColor,
                 'ID' => $id 
            ]);


        } catch (\Exception $e) {
            Log::error("Error updating Excel: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $path = storage_path('app/public/DataPenjualanKosmetik.xlsx');
            Log::info("Path Excel: " . $path);

            if (!file_exists($path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File Excel tidak ditemukan di: ' . $path
                ]);
            }

            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();

            // Cari baris terakhir dengan nomor di kolom A
            $highestRow = $sheet->getHighestRow();
            $lastRow = 1;
            for ($row = $highestRow; $row >= 1; $row--) {
                $val = $sheet->getCell('A' . $row)->getValue();
                if (!empty($val) && is_numeric($val)) {
                    $lastRow = $row;
                    break;
                }
            }

            $lastNo = (int) $sheet->getCell('A' . $lastRow)->getValue();
            $newNo = $lastNo + 1;

            $sheet->fromArray([
                $newNo,
                $request->Nama,
                $request->KPJ,
                $request->input('Jenis_Klaim'),
                $request->input('Tanggal_Terima'),
                $request->input('Tanggal_Rekam'),
                $request->Status,
                $request->input('Tanggal_Meninggal'),
                $request->Keterangan,
                $request->Alamat,
                $request->Petugas,
            ], null, 'A' . ($lastRow + 1));

            $rowIndex = $lastRow + 1;

            // Terapkan warna setelah insert
            $this->applyRowColor($sheet, $rowIndex);

            $writer = new Xlsx($spreadsheet);
            $writer->save($path);

            Log::info("Data berhasil disimpan!");
            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            Log::error("Gagal Store: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $path = storage_path('app/public/DataPenjualanKosmetik.xlsx');
            if (!file_exists($path)) {
                return response()->json(['success' => false, 'message' => 'File tidak ditemukan']);
            }

            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();

            $id = (int) $request->input('ID');
            $idMapping = session('idMapping', []);
            $rowIndex = $idMapping[$id] ?? null;

            if (!$rowIndex) {
                return response()->json(['success' => false, 'message' => "ID $id tidak ditemukan"]);
            }

            $sheet->removeRow($rowIndex, 1);

            $writer = new Xlsx($spreadsheet);
            $writer->save($path);

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus', 'action' => 'delete']);
        } catch (\Exception $e) {
            Log::error("Error deleting row: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
