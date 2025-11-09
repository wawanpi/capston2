<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute; // <-- TAMBAH: Untuk computed attribute

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

    // --- Relasi yang sudah Anda miliki ---
    public function pesananDetails(): HasMany
    {
        return $this->hasMany(PesananDetail::class);
    }
    
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    // --- AKHIR Relasi ---


    // === FUNGSI BARU UNTUK RATING DI DASHBOARD ===

    /**
     * Computed Attribute: Menghitung rata-rata rating (average_rating)
     */
    protected function averageRating(): Attribute
    {
        return Attribute::make(
            get: fn () => round($this->reviews->avg('rating'), 1)
        );
    }

    /**
     * Computed Attribute: Menghitung jumlah total ulasan (ratings_count)
     */
    protected function ratingsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->reviews->count()
        );
    }
}