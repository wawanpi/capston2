<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Tambahkan ini

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaMenu',
        'harga',
        'deskripsi',
        'stok',
        'gambar',
    ];

    // --- TAMBAHKAN FUNGSI DI BAWAH INI ---
    /**
     * Mendefinisikan relasi: Satu Menu bisa ada di banyak Detail Pesanan.
     */
    public function pesananDetails(): HasMany
    {
        return $this->hasMany(PesananDetail::class);
    }
    // ------------------------------------
}
