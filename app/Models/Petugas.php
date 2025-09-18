<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'petugas'; // Ganti dengan nama tabel Anda di database

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        // tambahkan semua nama kolom yang bisa diisi di sini
    ];

    // Jika Anda memiliki kolom `created_at` dan `updated_at`,
    // Anda tidak perlu menulis apa-apa, karena Laravel secara otomatis mengurusnya.
    // Jika tidak ada, Anda bisa menonaktifkannya dengan:
    // public $timestamps = false;

    // Jika primary key Anda bukan 'id' atau bukan integer, Anda bisa menentukannya:
    // protected $primaryKey = 'kolom_primary_key';
    // public $incrementing = false;

    // Tambahkan relasi atau fungsi-fungsi lain yang terkait dengan model di sini.
    // Contoh: relasi dengan model lain
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}