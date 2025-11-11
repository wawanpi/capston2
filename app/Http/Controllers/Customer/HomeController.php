<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk user yang sudah login.
     * (DIUPDATE: Menggunakan sistem ketersediaan harian, bukan 'stok')
     */
    public function index()
    {
        // Redirect admin jika tidak sengaja mengakses halaman ini
        if (auth()->user() && auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // === Query 1: Best Seller (Semua Kategori) ===
        // Query ini OK karena berdasarkan data penjualan (pesanans), bukan stok
        $bestSellers = Menu::select('menus.*', DB::raw('SUM(pesanan_details.jumlah) as total_terjual'))
            ->join('pesanan_details', 'menus.id', '=', 'pesanan_details.menu_id')
            ->join('pesanans', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
            // ->where('pesanans.status', 'completed') // Asumsi status 'completed'
            ->groupBy('menus.id')
            ->orderByDesc('total_terjual')
            ->take(8)
            ->with('ketersediaanHariIni') // Eager load ketersediaan
            ->get();
        
        // Fallback jika tidak ada penjualan
        if ($bestSellers->isEmpty()) {
            // PERBAIKAN: Mengganti where('stok', '>', 0) dengan whereHas
            $bestSellers = Menu::whereHas('ketersediaanHariIni', function ($query) {
                                    $query->where('jumlah_saat_ini', '>', 0);
                                })
                                ->with('ketersediaanHariIni') // Eager load ketersediaan
                                ->inRandomOrder()
                                ->take(8)
                                ->get();
        }

        // === Query 2: Semua Makanan ===
        // PERBAIKAN: Mengganti where('stok', '>', 0) dengan whereHas
        $allFood = Menu::where('kategori', 'makanan')
                        ->whereHas('ketersediaanHariIni', function ($query) {
                            $query->where('jumlah_saat_ini', '>', 0);
                        })
                        ->with('ketersediaanHariIni') // Eager load ketersediaan
                        ->latest()
                        ->get();

        // === Query 3: Semua Minuman ===
        // PERBAIKAN: Mengganti where('stok', '>', 0) dengan whereHas
        $allDrinks = Menu::where('kategori', 'minuman')
                            ->whereHas('ketersediaanHariIni', function ($query) {
                                $query->where('jumlah_saat_ini', '>', 0);
                            })
                            ->with('ketersediaanHariIni') // Eager load ketersediaan
                            ->latest()
                            ->get();

        // Kirim 3 variabel terpisah ke view
        return view('dashboard', compact('bestSellers', 'allFood', 'allDrinks'));
    }
}