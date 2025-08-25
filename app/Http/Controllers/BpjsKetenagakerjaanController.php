<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BpjsKetenagakerjaanController extends Controller
{
    /**
     * Tampilkan halaman BPJS Ketenagakerjaan dengan foto-foto yang sudah diunggah.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua foto dari database untuk ditampilkan di galeri
        $photos = Photo::orderBy('created_at', 'desc')->get(); // Mengambil foto terbaru lebih dulu
        
        return view('bpjs-ketenagakerjaan', compact('photos'));
    }

    /**
     * Simpan foto yang diunggah ke storage dan database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input, termasuk 'description'
        $request->validate([
            'photo' => 'required|image|max:2048', // Maksimal 2MB
            'description' => 'nullable|string', // Kolom deskripsi bisa kosong
        ]);

        // Simpan foto ke direktori 'storage/app/public/photos'
        $path = $request->file('photo')->store('photos', 'public');

        // Simpan data foto ke database, termasuk deskripsi
        Photo::create([
            'path' => $path,
            'description' => $request->description, // Menyimpan deskripsi
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('bpjs.ketenagakerjaan')
            ->with('success', 'Foto berhasil diunggah!');
    }

    /**
     * Hapus foto dari storage dan database.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Photo $photo)
    {
        // Pastikan hanya pemilik foto yang bisa menghapusnya
        if (Auth::id() !== $photo->user_id) {
            return redirect()->route('bpjs.ketenagakerjaan')
                ->with('error', 'Anda tidak diizinkan menghapus foto ini.');
        }

        // Hapus file foto dari storage
        Storage::disk('public')->delete($photo->path);

        // Hapus data foto dari database
        $photo->delete();

        return redirect()->route('bpjs.ketenagakerjaan')
            ->with('success', 'Foto berhasil dihapus.');
    }
}
