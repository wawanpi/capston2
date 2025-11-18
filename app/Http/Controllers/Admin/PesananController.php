<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Menu;
use App\Models\PesananDetail;
use App\Models\DailyKetersediaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PesananController extends Controller
{
    /**
     * Menampilkan halaman daftar semua pesanan dengan PRIORITAS KERJA.
     * Urutan: Pending -> Processing -> Completed -> Cancelled.
     */
public function index(Request $request)
    {
        // Ambil input pencarian dari URL (?search=...)
        $search = $request->input('search');

        $pesanans = Pesanan::with(['user', 'details.menu', 'transaksi'])
            // LOGIKA PENCARIAN (Tambahan)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    // Cari berdasarkan ID Pesanan
                    $q->where('id', 'like', "%{$search}%")
                      // ATAU Cari berdasarkan Nama User (Relasi)
                      ->orWhereHas('user', function ($subQ) use ($search) {
                          $subQ->where('name', 'like', "%{$search}%");
                      });
                });
            })
            
            // Sorting Prioritas (Tetap sama)
            ->orderByRaw("FIELD(status, 'pending', 'processing', 'completed', 'cancelled')")
            ->latest()
            
            // Pagination dengan withQueryString agar parameter search tidak hilang saat pindah halaman
            ->paginate(10)
            ->withQueryString();
        
        return view('admin.pesanan.index', compact('pesanans'));
    }

    /**
     * Menampilkan halaman detail untuk satu pesanan.
     */
    public function show(Pesanan $pesanan)
    {
        // Mengambil relasi yang dibutuhkan termasuk data transaksi untuk cek pembayaran
        $pesanan->load(['user', 'details.menu', 'transaksi']); 
        
        // Ambil semua menu untuk dropdown "Tambah Item"
        $menus = Menu::orderBy('namaMenu')->get();
        
        return view('admin.pesanan.show', compact('pesanan', 'menus'));
    }

    /**
     * Mengupdate status dari sebuah pesanan.
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $pesanan->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.pesanan.show', $pesanan)
                         ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * === METHOD REVISI: TAMBAH ITEM + RESET PEMBAYARAN ===
     * Menambahkan item baru ke pesanan & Reset status lunas jika ada.
     */
    public function addItem(Request $request, Pesanan $pesanan)
    {
        // [VALIDASI STATUS] Mencegah perubahan pada pesanan yang sudah selesai atau dibatalkan
        // Admin hanya boleh edit pesanan yang masih Pending atau Sedang Dibuat
        if (!in_array($pesanan->status, ['pending', 'processing'])) {
            return redirect()->back()->with('error', 'Item tidak dapat ditambahkan karena pesanan sudah ' . $pesanan->status . '.');
        }

        // 1. Validasi input
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($validated['menu_id']);
        $jumlah = (int)$validated['jumlah'];

        // 2. Cek Ketersediaan Harian
        // Menggunakan accessor 'jumlah_saat_ini' dari Model Menu (relasi DailyKetersediaan)
        if ($menu->jumlah_saat_ini < $jumlah) {
            return redirect()->back()->with('error', 'Stok tidak cukup untuk ' . $menu->namaMenu . ' (Sisa: ' . $menu->jumlah_saat_ini . ').');
        }

        // 3. Hitung harga subtotal
        $subtotal = $menu->harga * $jumlah;

        // 4. Mulai Transaksi Database (Agar data konsisten)
        try {
            DB::beginTransaction();

            // 5. Cek apakah item ini sudah ada di detail pesanan?
            $existingDetail = $pesanan->details()->where('menu_id', $menu->id)->first();
            
            if ($existingDetail) {
                // Jika menu sudah ada, tambahkan jumlahnya
                $existingDetail->increment('jumlah', $jumlah);
                $existingDetail->increment('subtotal', $subtotal);
            } else {
                // Jika belum ada, buat baris detail baru
                PesananDetail::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $menu->id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $menu->harga,
                    'subtotal' => $subtotal,
                ]);
            }

            // 6. Update Total Bayar di Pesanan Utama
            $pesanan->increment('total_bayar', $subtotal);

            // 7. Kurangi Stok Harian di tabel DailyKetersediaan
            $menu->ketersediaanHariIni->decrement('jumlah_saat_ini', $jumlah);

            // === LOGIKA PENTING: RESET STATUS LUNAS ===
            // Jika pesanan ini sebelumnya sudah dibayar (ada data di tabel transaksi),
            // kita hapus data transaksinya. Ini akan membuat tombol "Verifikasi Pembayaran"
            // muncul kembali di halaman detail, memaksa kasir menagih kekurangan bayar.
            if ($pesanan->transaksi) {
                $pesanan->transaksi()->delete();
                
                // Kirim pesan WARNING (Kuning) agar kasir sadar status berubah
                session()->flash('warning', 'Item berhasil ditambahkan. Status pembayaran DI-RESET menjadi BELUM LUNAS karena total harga berubah. Silakan tagih kekurangan dan verifikasi ulang.');
            } else {
                // Jika belum bayar, kirim pesan SUKSES biasa (Hijau)
                session()->flash('success', $jumlah . 'x ' . $menu->namaMenu . ' berhasil ditambahkan.');
            }

            // 8. Commit perubahan ke database
            DB::commit();

            return redirect()->back();

        } catch (\Exception $e) {
            // 9. Rollback jika ada error sistem
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan item: ' . $e->getMessage());
        }
    }
}