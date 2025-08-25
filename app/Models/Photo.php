<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * Properti yang dapat diisi secara massal (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'user_id',
        'description', // Perbaikan: Menambahkan 'description' ke properti fillable
    ];

    /**
     * Mendefinisikan relasi dengan model User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}