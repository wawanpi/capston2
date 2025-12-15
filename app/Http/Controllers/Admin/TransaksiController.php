<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon; 

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar transaksi (harian/mingguan/bulanan) dan menghitung total.
     */
    public function index(Request $request)
    {
        // ... (Kode index sama persis, tidak perlu diubah) ...
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
            } else { // Default 'daily'
                $startDate = Carbon::now()->startOfDay();
                $endDate = Carbon::now()->endOfDay();
                $filterLabel = "Hari Ini";
            }
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }

        $totalQuery = clone $query;
        $totalPendapatan = $totalQuery->sum('total_bayar');

        $transaksis = $query->with('pesanan.user')
                            ->latest()
                            ->paginate(10)
                            ->withQueryString(); 

        return view('admin.transaksi.index', compact('transaksis', 'totalPendapatan', 'filterLabel'));
    }

    /**
     * Memverifikasi pembayaran dan membuat data transaksi.
     */
    public function verifikasi(Request $request, Pesanan $pesanan)
    {
        // 1. Validasi request
        // [UPDATE] Menambahkan 'Transfer Bank' ke dalam daftar validasi agar sesuai dengan select option di View
        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|in:Tunai di Tempat,QRIS,Transfer Bank,Transfer Bank (BCA)'
        ]);

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
                'metode_pembayaran' => $request->metode_pembayaran, // Simpan sesuai yang dipilih Admin
                'tanggal_transaksi' => now(),
            ]);

            // 3. Update status pesanan menjadi 'processing'
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
        // ... (Kode cetakLaporan sama persis, tidak perlu diubah) ...
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

        $totalQuery = clone $query;
        $totalPendapatan = $totalQuery->sum('total_bayar');

        $transaksis = $query->with('pesanan.user')
                            ->latest()
                            ->get();

        return view('admin.transaksi.cetak', compact('transaksis', 'totalPendapatan', 'filterLabel', 'startDate', 'endDate'));
    }
}