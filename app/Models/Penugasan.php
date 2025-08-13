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
    protected $fillable = [
        'nama_karyawan',
        'alamat_lengkap',
        'kecamatan_id',
    ];

    /**
     * Get the kecamatan that owns the penugasan.
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}