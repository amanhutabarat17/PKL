<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class PenugasanController extends Controller
{
    /**
     * Tampilkan daftar penugasan.
     */
    public function index()
    {
        $penugasans = Penugasan::with('kecamatan')->get();
        return view('penugasan.index', compact('penugasans'));
    }

    /**
     * Tampilkan formulir untuk membuat penugasan baru.
     */
    public function create()
    {
        $kabupatens = Kabupaten::all();
        return view('penugasan.create', compact('kabupatens'));
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
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Proses penyimpanan file foto
        $path = $request->file('photo')->store('photos', 'public');

        // Baris dd() sudah dihapus, sekarang data akan disimpan
        Penugasan::create([
            'nama_karyawan' => $validatedData['nama_karyawan'],
            'kecamatan_id' => $validatedData['kecamatan_id'],
            'deskripsi' => $validatedData['deskripsi'],
            'alamat_lengkap' => $validatedData['alamat_lengkap'],
            'photo_path' => $path, // Simpan path foto ke kolom photo_path
        ]);
        
        return redirect()->route('penugasan.index')->with('success', 'Penugasan baru berhasil ditambahkan.');

    }

    /**
     * Tampilkan formulir untuk mengedit penugasan yang spesifik.
     */
    public function edit(Penugasan $penugasan)
    {
        $kabupatens = Kabupaten::all();
        $kecamatans = Kecamatan::where('kabupaten_id', $penugasan->kecamatan->kabupaten_id)->get();
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
            // Tambahkan validasi untuk foto jika ingin bisa diubah saat edit
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($penugasan->photo_path) {
                Storage::disk('public')->delete($penugasan->photo_path);
            }
            // Simpan foto baru
            $data['photo_path'] = $request->file('photo')->store('photos', 'public');
        }

        $penugasan->update($data);

        return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil diperbarui.');
    }

    /**
     * Hapus penugasan dari database.
     */
    public function destroy(Penugasan $penugasan)
    {
        // Hapus file foto dari storage sebelum menghapus data dari database
        if ($penugasan->photo_path) {
            Storage::disk('public')->delete($penugasan->photo_path);
        }

        $penugasan->delete();

        return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil dihapus.');
    }

    /**
     * Dapatkan daftar kecamatan berdasarkan kabupaten.
     */
    public function getKecamatan($kabupaten_id)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
        return response()->json($kecamatans);
    }
}
