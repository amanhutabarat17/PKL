<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAssignmentNotification;
use Illuminate\Support\Facades\Log;

class PetugasController extends Controller
{
    /**
     * Memproses penugasan petugas dan mengirim notifikasi email.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignPetugas(Request $request)
    {
        try {
            // Data petugas statis
            $staticPetugas = [
                1 => 'Ahmad',
                2 => 'Dewi',
                3 => 'Budi',
                4 => 'Siti',
            ];

            // Validasi input, termasuk deskripsi yang bersifat opsional
            $request->validate([
                'petugas_id' => 'required|array',
                'petugas_id.*' => 'in:1,2,3,4', // Pastikan ID petugas valid
                'penugasan_id' => 'required|integer',
                'deskripsi' => 'nullable|string|max:1000', // Tambahkan validasi untuk deskripsi
            ]);
            
            $petugasIds = $request->input('petugas_id');
            $penugasanId = $request->input('penugasan_id');
            $penugasanData = json_decode($request->input('penugasan_data'), true);
            $deskripsi = $request->input('deskripsi'); // Ambil nilai deskripsi dari request

            $namaPetugasTerkirim = [];
            foreach ($petugasIds as $petugasId) {
                if (isset($staticPetugas[$petugasId])) {
                    $namaPetugasTerkirim[] = $staticPetugas[$petugasId];
                }
            }

            // Dapatkan semua user yang akan menerima notifikasi
            $users = User::all();

            // Kirim email ke semua user
            foreach ($users as $user) {
                // Pastikan email user tidak kosong
                if ($user->email) {
                    // Teruskan variabel $deskripsi ke Mailable
                    Mail::to($user->email)->send(new NewAssignmentNotification($namaPetugasTerkirim, $penugasanId, $penugasanData, $deskripsi));
                }
            }
            
            // Catat log
            Log::info("Email notifikasi penugasan berhasil dikirim untuk penugasan ID: " . $penugasanId . " kepada petugas: " . implode(', ', $namaPetugasTerkirim));

            return response()->json([
                'success' => true,
                'message' => "Petugas " . implode(', ', $namaPetugasTerkirim) . " berhasil ditugaskan dan notifikasi email berhasil dikirim!",
            ]);

        } catch (\Exception $e) {
            // Tangani error
            Log::error("Error saat menugaskan petugas: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}