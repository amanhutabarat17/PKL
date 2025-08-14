<?php

namespace App\Http\Controllers;

use App\Models\Penugasan;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenugasanController extends Controller
{
    /**
     * Tampilkan daftar penugasan karyawan.
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
        $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'alamat_lengkap' => 'required|string',
        ]);

        // Perbaikan: Hanya simpan data yang valid
        Penugasan::create([
            'nama_karyawan' => $request->nama_karyawan,
            'kecamatan_id' => $request->kecamatan_id,
            'alamat_lengkap' => $request->alamat_lengkap,
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
        ]);

        $penugasan->update($request->all());

        return redirect()->route('penugasan.index')->with('success', 'Penugasan berhasil diperbarui.');
    }

    /**
     * Hapus penugasan dari database.
     */
    public function destroy(Penugasan $penugasan)
    {
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
