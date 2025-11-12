<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Menu; 
use App\Models\PesananDetail; 
use App\Models\DailyKetersediaan; // <-- DITAMBAHKAN
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Carbon; // <-- DITAMBAHKAN

class PesananController extends Controller
{
/**
     * Menampilkan halaman daftar semua pesanan.
     */
    public function index()
    {
        // PERBAIKAN: Tambahkan 'details.menu' ke eager loading
        // Ini akan mengambil data pesanan, user, detail pesanan, dan menu terkait
        // dalam query yang efisien.
        $pesanans = Pesanan::with(['user', 'details.menu'])->latest()->paginate(10);
        
        return view('admin.pesanan.index', compact('pesanans'));
    }

    /**
     * Menampilkan halaman detail untuk satu pesanan.
     * (Fungsi ini sudah benar)
     */
    public function show(Pesanan $pesanan)
    {
        // Mengambil relasi yang dibutuhkan
        $pesanan->load(['user', 'details.menu']);
        
        // Ambil semua menu untuk ditampilkan di dropdown "Tambah Item"
        $menus = Menu::orderBy('namaMenu')->get();
        
        // Mengirim data pesanan tunggal DAN daftar menu ke view detail
        return view('admin.pesanan.show', compact('pesanan', 'menus')); 
    }

    /**
     * Mengupdate status dari sebuah pesanan.
     * (Fungsi ini sudah benar)
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        // Update kolom status
        $pesanan->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.pesanan.show', $pesanan)
                         ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * === METHOD DIPERBARUI UNTUK TAMBAH ITEM ===
     * Menambahkan item baru ke pesanan yang sudah ada.
     * PERBAIKAN: Menggunakan sistem ketersediaan harian.
     */
    public function addItem(Request $request, Pesanan $pesanan)
    {
        // 1. Validasi input dari form "Tambah Item"
        $validated = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($validated['menu_id']);
        $jumlah = (int)$validated['jumlah'];

        // 2. PERBAIKAN: Cek ketersediaan harian
        // $menu->jumlah_saat_ini adalah accessor yg memuat relasi ketersediaanHariIni
        if ($menu->jumlah_saat_ini < $jumlah) {
            // PERBAIKAN: Pesan error diubah
            return redirect()->back()->with('error', 'Jumlah tidak mencukupi untuk ' . $menu->namaMenu . ' (sisa ' . $menu->jumlah_saat_ini . ').');
        }

        // 3. Hitung subtotal item baru
        $subtotal = $menu->harga * $jumlah;

        // 4. Gunakan DB Transaction agar aman
        try {
            DB::beginTransaction();

            // 5. Buat entri baru di 'pesanan_details'
            // Cek dulu apakah item ini sudah ada di pesanan?
            $existingDetail = $pesanan->details()->where('menu_id', $menu->id)->first();
            
            if ($existingDetail) {
                // Jika sudah ada, UPDATE jumlah dan subtotal
                $existingDetail->increment('jumlah', $jumlah);
                $existingDetail->increment('subtotal', $subtotal);
            } else {
                // Jika belum ada, CREATE baru
                PesananDetail::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $menu->id,
                    'jumlah' => $jumlah,
                    'harga_satuan' => $menu->harga,
                    'subtotal' => $subtotal,
                ]);
            }

            // 6. Update 'total_bayar' di pesanan utama (tabel 'pesanans')
            $pesanan->increment('total_bayar', $subtotal);

            // 7. PERBAIKAN: Kurangi jumlah harian (bukan $menu->decrement)
            // Kita panggil relasi ketersediaanHariIni (yang sudah di-load oleh accessor)
            $ketersediaanHariIni = $menu->ketersediaanHariIni;
            
            // Lakukan decrement pada kolom 'jumlah_saat_ini' di tabel 'daily_ketersediaan'
            $ketersediaanHariIni->decrement('jumlah_saat_ini', $jumlah);

            // 8. Jika semua berhasil, simpan perubahan
            DB::commit();

            return redirect()->back()->with('success', $jumlah . 'x ' . $menu->namaMenu . ' berhasil ditambahkan ke pesanan.');

        } catch (\Exception $e) {
            // 9. Jika ada error, batalkan semua perubahan
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan. Item gagal ditambahkan. Pesan: ' . $e->getMessage());
        }
    }
}