<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- 1. INI DITAMBAHKAN

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaMenu',
        'harga',
        'deskripsi',
        'kategori',
        'stok',
        'gambar',
    ];

    // --- Ini adalah fungsi yang sudah Anda miliki ---
    /**
     * Mendefinisikan relasi: Satu Menu bisa ada di banyak Detail Pesanan.
     */
    public function pesananDetails(): HasMany
    {
        return $this->hasMany(PesananDetail::class);
    }
    
    // --- 2. INI METHOD BARU UNTUK RATING ---
    /**
     * Mendefinisikan relasi bahwa satu Menu bisa memiliki banyak Review.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}