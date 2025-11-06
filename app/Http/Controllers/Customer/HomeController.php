<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- DITAMBAHKAN

class HomeController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk user yang sudah login.
     * (DIUPDATE: Mengambil 3 daftar: Best Sellers, Semua Makanan, Semua Minuman)
     */
    public function index()
    {
        // Redirect admin jika tidak sengaja mengakses halaman ini
        if (auth()->user() && auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // === Query 1: Best Seller (Semua Kategori) ===
        $bestSellers = Menu::select('menus.*', DB::raw('SUM(pesanan_details.jumlah) as total_terjual'))
            ->join('pesanan_details', 'menus.id', '=', 'pesanan_details.menu_id')
            ->join('pesanans', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
            ->where('pesanans.status', 'completed')
            // Tidak ada filter kategori, jadi semua menu terlaris akan muncul
            ->groupBy('menus.id')
            ->orderByDesc('total_terjual')
            ->take(8)
            ->get();
        
        // Fallback jika tidak ada penjualan (ambil 8 menu acak)
        if ($bestSellers->isEmpty()) {
            $bestSellers = Menu::where('stok', '>', 0)->inRandomOrder()->take(8)->get();
        }

        // === Query 2: Semua Makanan ===
        $allFood = Menu::where('kategori', 'makanan')
                         ->where('stok', '>', 0)
                         ->latest()
                         ->get();

        // === Query 3: Semua Minuman ===
        $allDrinks = Menu::where('kategori', 'minuman')
                           ->where('stok', '>', 0)
                           ->latest()
                           ->get();

        // Kirim 3 variabel terpisah ke view
        return view('dashboard', compact('bestSellers', 'allFood', 'allDrinks'));
    }
}