<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan; // <-- Impor model Pesanan
use Illuminate\Support\Facades\Auth; // <-- Impor Auth untuk mendapatkan user ID

class OrderController extends Controller
{
    /**
     * Menampilkan daftar riwayat pesanan milik user yang sedang login.
     * Dipanggil oleh Rute: route('orders.index')
     */
    public function index()
    {
        // 1. Ambil ID user yang sedang login
        $userId = Auth::id();

        // 2. Ambil semua pesanan dari database HANYA untuk user ini
        //    'with('details')' -> Eager load detailnya agar efisien
        //    'latest()' -> Urutkan dari yang paling baru
        $pesanans = Pesanan::where('user_id', $userId)
                            ->with('details') 
                            ->latest()
                            ->paginate(10); // Tampilkan 10 pesanan per halaman

        // 3. Tampilkan view 'my-orders.blade.php' dan kirim data pesanan
        return view('my-orders', compact('pesanans'));
    }

    /**
     * Menampilkan detail satu pesanan spesifik.
     * Dipanggil oleh Rute: route('orders.show', $pesanan)
     */
    public function show(Pesanan $pesanan) // Laravel otomatis mencari pesanan berdasarkan ID di URL
    {
        // === PENTING: Cek Keamanan ===
        // Pastikan user yang sedang login adalah pemilik pesanan ini.
        if (Auth::id() !== $pesanan->user_id) {
            abort(403, 'ANDA TIDAK BERHAK MENGAKSES PESANAN INI.');
        }

        // Jika lolos cek keamanan, ambil semua data yang berhubungan:
        // 'user' -> Info pemesan
        // 'details.menu' -> Rincian item dan data menu-nya
        $pesanan->load(['user', 'details.menu']);

        // Tampilkan view 'order-detail.blade.php'
        return view('order-detail', compact('pesanan'));
    }
}

