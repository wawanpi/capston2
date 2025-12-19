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
        // Ambil parameter range, default ke 'daily'
        $range = $request->query('range', 'daily'); 
        
        // Ambil tanggal dari request
        $reqStartDate = $request->query('start_date');
        $reqEndDate = $request->query('end_date');

        // LOGIKA PERBAIKAN:
        // Jika range BUKAN custom, kita abaikan start_date/end_date dari URL
        // Ini mencegah filter 'stuck' di tanggal kustom
        if ($range !== 'custom') {
            $reqStartDate = null;
            $reqEndDate = null;
        }

        $filterLabel = "Hari Ini";
        $query = Transaksi::query();

        // Kondisi 1: Filter Custom Tanggal (Hanya jika range == custom DAN tanggal diisi)
        if ($range == 'custom' && $reqStartDate && $reqEndDate) {
            $startDate = Carbon::parse($reqStartDate)->startOfDay();
            $endDate = Carbon::parse($reqEndDate)->endOfDay();
            $filterLabel = "Periode " . $startDate->format('d M Y') . " - " . $endDate->format('d M Y');
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        } 
        // Kondisi 2: Filter Preset (Daily, Weekly, Monthly)
        else {
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
        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|in:Tunai di Tempat,QRIS,Transfer Bank,Transfer Bank (BCA)'
        ]);

        if ($pesanan->transaksi) {
            return redirect()->route('admin.pesanan.show', $pesanan)->with('error', 'Pesanan ini sudah dibayar.');
        }

        try {
            DB::beginTransaction();

            Transaksi::create([
                'pesanan_id' => $pesanan->id,
                'total_bayar' => $pesanan->total_bayar,
                'status_pembayaran' => 'paid',
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_transaksi' => now(),
            ]);

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
        // Terapkan logika perbaikan yang SAMA untuk fungsi cetak
        $range = $request->query('range', 'daily');
        $reqStartDate = $request->query('start_date');
        $reqEndDate = $request->query('end_date');

        if ($range !== 'custom') {
            $reqStartDate = null;
            $reqEndDate = null;
        }

        $filterLabel = "Hari Ini";
        $startDateObj = null; // Variabel objek Carbon untuk view
        $endDateObj = null;

        $query = Transaksi::query();

        if ($range == 'custom' && $reqStartDate && $reqEndDate) {
            $startDateObj = Carbon::parse($reqStartDate)->startOfDay();
            $endDateObj = Carbon::parse($reqEndDate)->endOfDay();
            $filterLabel = "Periode " . $startDateObj->format('d M Y') . " - " . $endDateObj->format('d M Y');
            $query->whereBetween('tanggal_transaksi', [$startDateObj, $endDateObj]);
        } else {
            if ($range == 'weekly') {
                $startDateObj = Carbon::now()->startOfWeek();
                $endDateObj = Carbon::now()->endOfWeek();
                $filterLabel = "Minggu Ini";
            } elseif ($range == 'monthly') {
                $startDateObj = Carbon::now()->startOfMonth();
                $endDateObj = Carbon::now()->endOfMonth();
                $filterLabel = "Bulan Ini";
            } else {
                $startDateObj = Carbon::now()->startOfDay();
                $endDateObj = Carbon::now()->endOfDay();
                $filterLabel = "Hari Ini";
            }
            $query->whereBetween('tanggal_transaksi', [$startDateObj, $endDateObj]);
        }

        $totalQuery = clone $query;
        $totalPendapatan = $totalQuery->sum('total_bayar');

        $transaksis = $query->with('pesanan.user')
                            ->latest()
                            ->get();

        // Mengirim variable dengan nama yang konsisten ke view (startDate & endDate)
        return view('admin.transaksi.cetak', [
            'transaksis' => $transaksis,
            'totalPendapatan' => $totalPendapatan,
            'filterLabel' => $filterLabel,
            'startDate' => $startDateObj, 
            'endDate' => $endDateObj
        ]);
    }
}