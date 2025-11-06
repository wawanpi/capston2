<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Jangan lupa import DB

class DashboardController extends Controller
{
    /**
     * Menampilkan data statistik untuk dashboard admin.
     * Method ini akan dipanggil oleh rute 'admin.dashboard'.
     */
    public function index()
    {
        // 1. Total Pendapatan (Hanya dari pesanan yang 'completed')
        $totalPendapatan = Pesanan::where('status', 'completed')->sum('total_bayar');

        // 2. Jumlah Pesanan (Contoh: Pesanan baru/pending hari ini)
        $jumlahPesananBaru = Pesanan::where('status', 'pending')->count();
        
        // 3. Jumlah Produk (Total semua menu)
        $jumlahProduk = Menu::count();

        // 4. Jumlah Pengguna (Hanya user dengan role 'pelanggan'/'user')
        // Kita asumsikan admin memiliki role 'admin' dan pelanggan tidak.
        // Ini adalah cara aman untuk menghitung non-admin.
        $jumlahPengguna = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();

        // 5. Data untuk Grafik "Stok Hampir Habis"
        // Ambil 5 menu dengan stok terendah (misalnya di bawah 10)
        $stokHampirHabis = Menu::where('stok', '<=', 10)
                                 ->orderBy('stok', 'asc') // Urutkan dari yang paling sedikit
                                 ->take(5) // Ambil 5 saja untuk grafik
                                 ->get();

        // Kirim semua data ini ke view 'admin.dashboard'
        return view('admin.dashboard', [
            'totalPendapatan' => $totalPendapatan,
            'jumlahPesananBaru' => $jumlahPesananBaru,
            'jumlahProduk' => $jumlahProduk,
            'jumlahPengguna' => $jumlahPengguna,
            'stokHampirHabis' => $stokHampirHabis, // Kirim data ini untuk Chart.js
        ]);
    }
}