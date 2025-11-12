<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\DailyKetersediaan;
use App\Models\PesananDetail; // <-- DITAMBAHKAN
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan data statistik untuk dashboard admin.
     * PERBAIKAN: Semua data difokuskan untuk HARI INI.
     */
    public function index()
    {
        $today = Carbon::today();

        // 1. Total Pendapatan HARI INI (Sudah Benar)
        $totalPendapatan = Transaksi::whereDate('tanggal_transaksi', $today)->sum('total_bayar');

        // 2. Jumlah Pesanan Baru HARI INI (Sudah Benar)
        $jumlahPesananBaru = Pesanan::where('status', 'pending')
                                    ->whereDate('created_at', $today)
                                    ->count();
        
        // 3. PERBAIKAN: Total Unit Terjual HARI INI (Menggantikan Total Menu)
        // (Ini adalah "jumlah menu khusus harian" yang Anda minta)
        $totalUnitTerjual = PesananDetail::whereHas('pesanan', function ($query) use ($today) {
                $query->whereDate('created_at', $today)
                      ->where('status', '!=', 'cancelled'); // Hanya hitung pesanan yg tidak batal
            })->sum('jumlah'); // Asumsi kolom 'jumlah' di tabel pesanan_details

        // 4. PERBAIKAN: Pengguna Baru HARI INI (Menggantikan Total Pengguna)
        $jumlahPenggunaBaru = User::whereDoesntHave('roles', function ($query) {
                                        $query->where('name', 'admin');
                                    })
                                    ->whereDate('created_at', $today)
                                    ->count();

        // 5. Grafik (Sudah Benar, data HARI INI)
        $menuHampirHabis = DailyKetersediaan::whereDate('tanggal', $today)
                                ->where('jumlah_saat_ini', '<=', 10)
                                ->where('jumlah_saat_ini', '>', 0)
                                ->with('menu')
                                ->orderBy('jumlah_saat_ini', 'asc')
                                ->take(5)
                                ->get();

        // Kirim semua data HARI INI ke view
        return view('admin.dashboard', [
            'totalPendapatan' => $totalPendapatan,
            'jumlahPesananBaru' => $jumlahPesananBaru,
            'totalUnitTerjual' => $totalUnitTerjual,   // <-- Variabel baru
            'jumlahPenggunaBaru' => $jumlahPenggunaBaru, // <-- Variabel baru
            'menuHampirHabis' => $menuHampirHabis,
        ]);
    }
}