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
        'kecamatan_id',
        'alamat_lengkap',
        'deskripsi',
        'photo_path',
        'data_row_id', 
    ];
    
    // PERBAIKAN KRUSIAL: Pastikan created_at dan updated_at di-cast sebagai datetime
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    /**
     * Get the kecamatan that owns the penugasan.
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}