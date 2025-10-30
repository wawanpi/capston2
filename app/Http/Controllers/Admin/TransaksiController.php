<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Menampilkan daftar transaksi yang sudah berhasil (lunas).
     */
    public function index()
    {
        $transaksis = Transaksi::with('pesanan.user') // Ambil data relasi
                                ->latest()
                                ->paginate(10);
        return view('admin.transaksi.index', compact('transaksis'));
    }

    /**
     * Memverifikasi pembayaran dan membuat data transaksi.
     * Ini juga akan mengubah status pesanan.
     */
    public function verifikasi(Request $request, Pesanan $pesanan)
    {
        // 1. Cek apakah pesanan ini sudah punya transaksi
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
                'metode_pembayaran' => 'Tunai di Tempat', // Sesuai alur
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
}
