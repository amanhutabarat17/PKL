<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kecamatan',
        'kabupaten_id',
    ];

    /**
     * Get the kabupaten that owns the kecamatan.
     */
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    /**
     * Get the penugasans for the kecamatan.
     */
    public function penugasans()
    {
        return $this->hasMany(Penugasan::class);
    }
}