<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kabupaten',
    ];

    /**
     * Get the kecamatans for the kabupaten.
     */
    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class);
    }
}