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
        // Hapus spasi dan underscore, lalu lowercase
        return strtolower(trim(preg_replace('/[\s_]+/', '', $name)));
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

        // Ambil header dan buang kolom pertama (A/No) dari Excel
        $header = array_shift($data);
        $header = array_slice($header, 1); // Skip Kolom A (No)
        array_unshift($header, 'ID'); // Tambahkan ID baru dari controller

        // Buang baris sebelum $startRow
        for ($i = 2; $i < $this->startRow; $i++) {
            array_shift($data);
        }

        $rows = [];
        $idMapping = [];

        // Tambahkan ID sesuai urutan data (1,2,3,...)
        foreach ($data as $index => $row) {
            $rowIndexInExcel = $index + $this->startRow;
            $idForTabledit = $index + 1;

            // Skip Kolom A (No) dari Excel, lalu gabung dengan ID baru
            $rows[] = array_merge([$idForTabledit], array_slice($row, 1));

            // Simpan mapping ID -> baris Excel
            $idMapping[$idForTabledit] = $rowIndexInExcel;
        }

        session(['idMapping' => $idMapping]);

        return view('dashboard', [
            'header' => $header, // Header tetap bisa menampilkan 'ID' (opsional: silakan hapus jika tidak perlu)
            'rows'   => $rows,   // Rows sudah tidak menyertakan Kolom A (No)
        ]);

    } catch (\Exception $e) {
        Log::error("Error loading Excel file: " . $e->getMessage());
        return view('dashboard', ['error' => 'Terjadi kesalahan saat memuat file Excel.']);
    }
}


    public function update(Request $request)
    {
       try {
        $path = storage_path('app/public/DataPenjualanKosmetik.xlsx'); // <-- disamakan
        Log::info("Path Excel: " . $path);

        if (!file_exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'File Excel tidak ditemukan di: ' . $path
            ]);
        }

            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();

            $id = (int)$request->input('ID'); // ID urut dari tabel
            $idMapping = session('idMapping', []);
            $rowIndex = $idMapping[$id] ?? null; // baris asli di Excel

            if (!$rowIndex) {
                return response()->json(['success' => false, 'message' => "ID $id tidak ditemukan"]);
            }

            // Ambil header dari baris pertama
            $headers = $sheet->rangeToArray('A1:' . $sheet->getHighestColumn() . '1')[0];

            // Mapping header ke index kolom
            $headerMapping = [];
            foreach ($headers as $index => $headerName) {
                if (!is_null($headerName) && trim($headerName) !== '') {
                    $headerMapping[$this->normalizeName($headerName)] = $index + 1; // +1 = kolom Excel mulai dari 1
                }
            }

            $updatedFields = [];

            foreach ($request->except(['ID', 'action']) as $field => $value) {
                $searchField = $this->normalizeName($field);
                $colIndex = $headerMapping[$searchField] ?? null;

                if ($colIndex) {
                    // Cek apakah field ini tanggal
                    $isDateField = stripos($searchField, 'tgl') !== false || 
                                  stripos($searchField, 'tanggal') !== false ||
                                  stripos($searchField, 'date') !== false;

                    if ($isDateField) {
                        $dateObj = null;
                        $formats = ['Y-m-d', 'd/m/Y', 'd-m-Y', 'm/d/Y', 'Y/m/d'];

                        foreach ($formats as $format) {
                            $dateObj = \DateTime::createFromFormat($format, $value);
                            if ($dateObj !== false) break;
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
                        // Field biasa
                        $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $value);
                    }

                    $updatedFields[$field] = [
                        'value'    => $value,
                        'colIndex' => $colIndex,
                        'rowIndex' => $rowIndex
                    ];
                } else {
                    Log::warning("Kolom tidak ditemukan: $field");
                }
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save($path);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate',
                'updated' => $updatedFields
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
        $path = storage_path('app/public/DataPenjualanKosmetik.xlsx'); // pastikan sama dengan index/update/delete
        Log::info("Path Excel: " . $path);

        if (!file_exists($path)) {
            return response()->json([
                'success' => false,
                'message' => 'File Excel tidak ditemukan di: ' . $path
            ]);
        }

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        // Cari baris terakhir yang benar-benar ada nomor di kolom A
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

        Log::info("LastRow (real): {$lastRow}, LastNo: {$lastNo}, NewNo: {$newNo}");

        // Tambahkan data baru tepat di bawah lastRow
        $sheet->fromArray([
            $newNo,
            $request->Nama,
            $request->KPJ,
            $request->input('Tanggal Terima'),
            $request->input('Tanggal Rekam'),
            $request->Status,
            $request->input('Tanggal Meninggal'),
            $request->Keterangan,
            $request->Alamat,
            $request->Petugas,
        ], null, 'A' . ($lastRow + 1));

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

        $id = (int)$request->input('ID');
        $idMapping = session('idMapping', []);
        $rowIndex = $idMapping[$id] ?? null;

        if (!$rowIndex) {
            return response()->json(['success' => false, 'message' => "ID $id tidak ditemukan"]);
        }

        // Hapus baris
        $sheet->removeRow($rowIndex, 1);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($path);

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus', 'action' => 'delete']);
    } catch (\Exception $e) {
        Log::error("Error deleting row: " . $e->getMessage());
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}
}