<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request; // <-- Pastikan Request di-import
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon; // <-- Import Carbon untuk tanggal

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar transaksi (harian/mingguan/bulanan) dan menghitung total.
     */
    public function index(Request $request)
    {
        // Tentukan rentang waktu berdasarkan input filter
        $range = $request->query('range', 'daily'); // Default 'daily' (Harian)
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $filterLabel = "Hari Ini";

        $query = Transaksi::query();

        if ($startDate && $endDate) {
            // 1. Logika Filter Kustom (Jika start_date dan end_date diisi)
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $filterLabel = "Periode " . $startDate->format('d M Y') . " - " . $endDate->format('d M Y');
            
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);

        } else {
            // 2. Logika Filter Cepat (Harian, Mingguan, Bulanan)
            if ($range == 'weekly') {
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $filterLabel = "Minggu Ini";
            } elseif ($range == 'monthly') {
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                $filterLabel = "Bulan Ini";
            } else { // Default 'daily'
                $startDate = Carbon::now()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $filterLabel = "Hari Ini";
            }
            
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }

        // Hitung Total Pendapatan HANYA dari query yang sudah difilter
        // Kita clone query agar kalkulasi SUM tidak mengganggu paginasi
        $totalQuery = clone $query;
        $totalPendapatan = $totalQuery->sum('total_bayar');

        // Ambil daftar transaksi yang sudah difilter untuk ditampilkan di tabel
        $transaksis = $query->with('pesanan.user') // Ambil data relasi
                            ->latest()
                            ->paginate(10)
                            ->withQueryString(); // <-- Penting agar filter tetap ada saat ganti halaman

        // Kirim semua data (termasuk total) ke view
        return view('admin.transaksi.index', compact('transaksis', 'totalPendapatan', 'filterLabel'));
    }

    /**
     * Memverifikasi pembayaran dan membuat data transaksi.
     * (Fungsi ini sudah benar, tidak perlu diubah)
     */
    public function verifikasi(Request $request, Pesanan $pesanan)
    {
        // 1. Validasi request (termasuk metode pembayaran dari dropdown)
        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|in:Tunai di Tempat,QRIS'
        ]);
        // 2. Cek apakah pesanan ini sudah punya transaksi
        if ($pesanan->transaksi) {
            return redirect()->route('admin.pesanan.show', $pesanan)->with('error', 'Pesanan ini sudah dibayar.');
        }

        try {
            DB::beginTransaction();

            // 2. Buat data transaksi baru
            Transaksi::create([
                'pesanan_id' => $pesanan->id,
                'total_bayar' => $pesanan->total_bayar,
                'status_pembayaran' => 'paid',
                // [BENAR] AMBIL DARI REQUEST DROPDOWN:
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_transaksi' => now(),
            ]);

            // 3. Update status pesanan menjadi 'processing' (sedang dibuat)
            $pesanan->update(['status' => 'processing']);

            DB::commit();
            return redirect()->route('admin.pesanan.show', $pesanan)->with('success', 'Pembayaran berhasil diverifikasi. Pesanan sedang diproses.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.pesanan.show', $pesanan)->with('error', 'Gagal memverifikasi pembayaran: ' . $e->getMessage());
        }
    }
    public function cetakLaporan(Request $request)
    {
        // 1. (KODE DISALIN DARI FUNGSI INDEX) Tentukan rentang waktu
        $range = $request->query('range', 'daily');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $filterLabel = "Hari Ini";
        $query = Transaksi::query();

        if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
            $filterLabel = "Periode " . $startDate->format('d M Y') . " - " . $endDate->format('d M Y');
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        } else {
            if ($range == 'weekly') {
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $filterLabel = "Minggu Ini";
            } elseif ($range == 'monthly') {
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                $filterLabel = "Bulan Ini";
            } else {
                $startDate = Carbon::now()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $filterLabel = "Hari Ini";
            }
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }

        // 2. (KODE DISALIN DARI FUNGSI INDEX) Hitung Total
        $totalQuery = clone $query;
        $totalPendapatan = $totalQuery->sum('total_bayar');

        // 3. PERBEDAAN UTAMA: Ambil SEMUA data (tanpa paginate)
        $transaksis = $query->with('pesanan.user')
                            ->latest()
                            ->get(); // <-- Gunakan get() BUKAN paginate()

        // 4. Kembalikan view cetak (BUKAN view index)
        return view('admin.transaksi.cetak', compact('transaksis', 'totalPendapatan', 'filterLabel', 'startDate', 'endDate'));
    }
}