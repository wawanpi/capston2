<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Menu; // <-- DITAMBAHKAN
use App\Models\PesananDetail; // <-- DITAMBAHKAN
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- DITAMBAHKAN

class PesananController extends Controller
{
    /**
     * Menampilkan halaman daftar semua pesanan.
     * Method ini mengambil semua pesanan dari database dan menampilkannya dalam tabel.
     */
    public function index()
    {
        // Mengambil data pesanan, diurutkan dari yang paling baru
        // with('user') digunakan untuk mengambil data user yang memesan (menghindari N+1 query)
        $pesanans = Pesanan::with('user')->latest()->paginate(10);
        
        // Mengirim data pesanan ke view
        return view('admin.pesanan.index', compact('pesanans'));
    }

    /**
     * Menampilkan halaman detail untuk satu pesanan.
     * @param Pesanan $pesanan -> Laravel secara otomatis akan mencari pesanan berdasarkan ID dari URL.
     */
    public function show(Pesanan $pesanan)
    {
        // Mengambil relasi yang dibutuhkan: user pemesan, dan detail pesanan beserta info menunya.
        $pesanan->load(['user', 'details.menu']);
        
        // === BARIS INI DITAMBAHKAN ===
        // Ambil semua menu untuk ditampilkan di dropdown "Tambah Item"
        $menus = Menu::orderBy('namaMenu')->get();
        
        // Mengirim data pesanan tunggal DAN daftar menu ke view detail
        return view('admin.pesanan.show', compact('pesanan', 'menus')); // <-- 'menus' DITAMBAHKAN
    }

    /**
     * Mengupdate status dari sebuah pesanan.
     * @param Request $request
     * @param Pesanan $pesanan
     */
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        // Validasi input, pastikan status yang dikirim adalah salah satu dari pilihan yang ada.
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        // Update kolom status pada pesanan yang dipilih
        $pesanan->update([
            'status' => $request->status
        ]);

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('admin.pesanan.show', $pesanan)
                         ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * === METHOD BARU UNTUK TAMBAH ITEM ===
     * Menambahkan item baru ke pesanan yang sudah ada.
     * @param Request $request
     * @param Pesanan $pesanan
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

        // 2. Cek ketersediaan stok
        if ($menu->stok < $jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk ' . $menu->namaMenu . ' (sisa ' . $menu->stok . ').');
        }

        // 3. Hitung subtotal item baru
        $subtotal = $menu->harga * $jumlah;

        // 4. Gunakan DB Transaction agar aman (jika satu gagal, semua dibatalkan)
        try {
            DB::beginTransaction();

            // 5. Buat entri baru di 'pesanan_details'
            PesananDetail::create([
                'pesanan_id' => $pesanan->id,
                'menu_id' => $menu->id,
                'jumlah' => $jumlah,
                'harga_satuan' => $menu->harga,
                'subtotal' => $subtotal,
            ]);

            // 6. Update 'total_bayar' di pesanan utama (tabel 'pesanans')
            //    Menggunakan increment() lebih aman untuk mencegah race condition
            $pesanan->increment('total_bayar', $subtotal);

            // 7. Kurangi stok menu
            $menu->decrement('stok', $jumlah);

            // 8. Jika semua berhasil, simpan perubahan
            DB::commit();

            return redirect()->back()->with('success', $jumlah . 'x ' . $menu->namaMenu . ' berhasil ditambahkan ke pesanan.');

        } catch (\Exception $e) {
            // 9. Jika ada error, batalkan semua perubahan
            DB::rollBack();
            // Optional: Catat error
            // Log::error('Gagal tambah item: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan. Item gagal ditambahkan.');
        }
    }
}