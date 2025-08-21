<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Tampilkan formulir edit profil pengguna.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Perbarui informasi profil pengguna dan gambar avatar.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Menyimpan file avatar jika ada
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan file baru ke folder public/avatars.
            // Laravel akan otomatis membuat nama file unik.
            $path = $request->file('avatar')->store('avatars', 'public');
            
            // Perbarui kolom 'avatar' dengan path penyimpanan lokal.
            $user->avatar = $path;
            
            // Perbarui kolom 'profile_photo_url' dengan URL yang bisa diakses publik.
            // Ini akan menyelesaikan masalah "no such column" setelah Anda menjalankan migrasi.
            $user->profile_photo_url = Storage::url($path);
        }

        // Isi data dari request yang sudah divalidasi.
        $user->fill($request->validated());

        // Jika email berubah, kirim ulang verifikasi email.
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Simpan semua perubahan, termasuk path avatar baru dan URL-nya.
        $user->save();

        // Redirect kembali ke halaman edit profil dengan pesan sukses.
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        auth()->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
