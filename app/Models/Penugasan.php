<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
  // app/Models/Penugasan.php

protected $fillable = [
    'nama_karyawan',
    'kecamatan_id',
    'alamat_lengkap',
    'deskripsi',    // <-- TAMBAHKAN INI
    'photo_path',   // <-- TAMBAHKAN INI JUGA
];

    /**
     * Get the kecamatan that owns the penugasan.
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}