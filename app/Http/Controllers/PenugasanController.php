<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
// PENTING: Ganti 'DataKlaim' dengan nama Model yang sesuai untuk data utama Anda.
use App\Models\DataKlaim; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log;

class PenugasanController extends Controller
{
    /**
     * Tampilkan daftar penugasan.
     */
    public function index()
    {
        $penugasans = Penugasan::with('kecamatan')->get();
        // Ganti 'penugasan.index' dengan nama view Anda jika berbeda
        return view('penugasan.index', compact('penugasans')); 
    }

    /**
     * Tampilkan formulir untuk membuat penugasan baru.
     */
    public function create(Request $request)
    {
        // Ambil ID dari data master yang sedang ditugaskan (dilewatkan dari URL)
        $dataId = $request->query('id');

        $kabupatens = Kabupaten::all();
        // Ganti 'penugasan.create' dengan nama view Anda jika berbeda
        return view('penugasan.create', compact('kabupatens', 'dataId'));
    }

    /**
     * Simpan penugasan baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua data yang masuk dari form
        $validatedData = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'deskripsi' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:20048',
            // Pastikan ini cocok dengan kolom foreign key di tabel penugasans Anda
            'data_row_id' => 'nullable|integer', 
        ]);

        // 2. Proses penyimpanan file foto
        $path = $request->file('photo')->store('photos', 'public');

        // 3. Siapkan data untuk model
        $penugasanData = [
            'nama_karyawan' => $validatedData['nama_karyawan'],
            'kecamatan_id' => $validatedData['kecamatan_id'],
            'deskripsi' => $validatedData['deskripsi'],
            'alamat_lengkap' => $validatedData['alamat_lengkap'],
            'photo_path' => $path, // Kolom path file di database Anda
            'data_row_id' => $validatedData['data_row_id'], 
        ];

        Penugasan::create($penugasanData); 
        
        // PERUBAHAN: Mengarahkan kembali ke halaman sebelumnya (dashboard pengguna)
        return redirect()->back()->with('success', 'Penugasan baru berhasil diunggah.');
    }

    /**
     * Tampilkan formulir untuk mengedit penugasan yang spesifik.
     */
    public function edit(Penugasan $penugasan)
    {
        $kabupatens = Kabupaten::all();
        // Memuat kecamatan terkait dengan kabupaten yang sama
        $kecamatans = Kecamatan::where('kabupaten_id', $penugasan->kecamatan->kabupaten_id ?? null)->get();
        // Ganti 'penugasan.edit' dengan nama view Anda jika berbeda
        return view('penugasan.edit', compact('penugasan', 'kabupatens', 'kecamatans'));
    }

    /**
     * Perbarui penugasan yang spesifik di database.
     */
    public function update(Request $request, Penugasan $penugasan)
    {
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'alamat_lengkap' => 'required|string',
            'deskripsi' => 'required|string', // Pastikan deskripsi divalidasi juga
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:20048',
        ]);

        $data = $request->only(['nama_karyawan', 'kecamatan_id', 'alamat_lengkap', 'deskripsi']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($penugasan->photo_path) {
                Storage::disk('public')->delete($penugasan->photo_path);
            }
            // Simpan foto baru
            $data['photo_path'] = $request->file('photo')->store('photos', 'public');
        }

        $penugasan->update($data);

        // Sesuaikan route redirect jika berbeda
        return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil diperbarui.');
    }

    /**
     * Hapus penugasan dari database.
     */
    public function destroy(Penugasan $penugasan)
    {
        // 1. Hapus file foto dari storage sebelum menghapus data dari database
        if ($penugasan->photo_path) {
            Storage::disk('public')->delete($penugasan->photo_path);
        }

        // 2. Hapus Model dari database
        $penugasan->delete();

        // 3. Redirect kembali ke daftar penugasan (penugasan.index) dengan pesan sukses.
        return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil dihapus.');
    }

    /**
     * Dapatkan daftar kecamatan berdasarkan kabupaten (Untuk AJAX di form).
     */
    public function getKecamatan($kabupaten_id)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
        return response()->json($kecamatans);
    }
    
    // --- FUNGSI UTAMA UNTUK TOMBOL MATA (MELIHAT) ---

    /**
     * Mengambil daftar penugasan yang telah diunggah berdasarkan ID data master.
     */
    public function getPenugasansByDataId($dataRowId)
    {
        try {
            $penugasans = Penugasan::where('data_row_id', $dataRowId) 
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($penugasan) {
                    return [
                        'nama_petugas'     => $penugasan->nama_karyawan ?? 'N/A',
                        'tanggal_unggah'   => $penugasan->created_at ? $penugasan->created_at->format('Y-m-d H:i:s') : 'N/A',
                        'deskripsi'        => $penugasan->deskripsi ?? 'DATA DESKRIPSI HILANG', 
                        'alamat_lengkap'   => $penugasan->alamat_lengkap ?? 'ALAMAT LENGKAP HILANG', 
                        'kabupaten'        => null, 
                        'kecamatan'        => null, 
                        'file_path'        => $penugasan->photo_path ?? null,
                    ];
                });

            if ($penugasans->isEmpty()) {
                 return response()->json([
                     'success' => true,
                     'message' => 'Tidak ada penugasan yang ditemukan.',
                     'penugasans' => []
                 ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Data penugasan berhasil dimuat.',
                'penugasans' => $penugasans
            ]);
            
        } catch (\Exception $e) {
            Log::error("Error fetching penugasans for data ID {$dataRowId}: " . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data penugasan. Terjadi kesalahan server.',
                'penugasans' => []
            ], 500); 
        }
    }

    // --- [BARU] FUNGSI UNTUK UPDATE STATUS DARI DASHBOARD ---
    /**
     * Memperbarui status baris data dari panggilan AJAX di dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        // 1. Validasi data yang masuk
        $validated = $request->validate([
            'ID' => 'required|integer',
            'Status' => 'required|string|in:Pending,Sedang Diproses,Diterima,Ditolak'
        ]);

        try {
            // 2. Cari data berdasarkan ID. 
            // GANTI 'DataKlaim' dengan nama Model Anda yang sebenarnya.
            // Asumsi: Tabelnya `data_klaims` dan primary key-nya `id`.
            $dataRow = DataKlaim::findOrFail($validated['ID']);
            
            // 3. Update kolom 'Status'.
            // GANTI 'Status' jika nama kolom di database Anda berbeda.
            $dataRow->Status = $validated['Status'];
            $dataRow->save();

            // 4. Kirim respons sukses kembali ke JavaScript
            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui.'
            ]);

        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error("Gagal update status untuk ID {$validated['ID']}: " . $e->getMessage());

            // Kirim respons error kembali ke JavaScript
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status di server.'
            ], 500);
        }
    }
}

