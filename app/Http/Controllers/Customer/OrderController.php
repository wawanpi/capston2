<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan; // <-- Impor model Pesanan
use Illuminate\Support\Facades\Auth; // <-- Impor Auth untuk mendapatkan user ID
use App\Models\Menu; // <-- DITAMBAHKAN: Untuk cek stok & harga baru
use Cart; // <-- DITAMBAHKAN: Untuk memasukkan item ke keranjang

class OrderController extends Controller
{
    /**
     * Menampilkan daftar riwayat pesanan milik user yang sedang login.
     * Dipanggil oleh Rute: route('orders.index')
     */
    public function index()
    {
        // 1. Ambil ID user yang sedang login
        $userId = Auth::id();

        // 2. Ambil semua pesanan dari database HANYA untuk user ini
        //    'with('details')' -> Eager load detailnya agar efisien
        //    'latest()' -> Urutkan dari yang paling baru
        $pesanans = Pesanan::where('user_id', $userId)
                             ->with('details') 
                             ->latest()
                             ->paginate(10); // Tampilkan 10 pesanan per halaman

        // 3. Tampilkan view 'my-orders.blade.php' dan kirim data pesanan
        //    (Ini adalah file view yang akan kita edit di langkah selanjutnya)
        return view('my-orders', compact('pesanans'));
    }

    /**
     * Menampilkan detail satu pesanan spesifik.
     * Dipanggil oleh Rute: route('orders.show', $pesanan)
     */
    public function show(Pesanan $pesanan) // Laravel otomatis mencari pesanan berdasarkan ID di URL
    {
        // === PENTING: Cek Keamanan ===
        // Pastikan user yang sedang login adalah pemilik pesanan ini.
        if (Auth::id() !== $pesanan->user_id) {
            abort(403, 'ANDA TIDAK BERHAK MENGAKSES PESANAN INI.');
        }

        // Jika lolos cek keamanan, ambil semua data yang berhubungan:
        // 'user' -> Info pemesan
        // 'details.menu' -> Rincian item dan data menu-nya
        $pesanan->load(['user', 'details.menu']);

        // Tampilkan view 'order-detail.blade.php'
        return view('order-detail', compact('pesanan'));
    }


    // === METHOD BARU DITAMBAHKAN DI SINI ===

    /**
     * Memproses "Pesan Lagi" dari pesanan lama.
     * Dipanggil oleh Rute: route('orders.reorder', $id)
     *
     * @param int $id ID dari pesanan LAMA
     */
    public function reorder($id)
    {
        // 1. Cari pesanan lama, beserta 'details' dan 'menu'
        $pesananLama = Pesanan::with('details.menu')->find($id);

        // 2. Keamanan: Pastikan pesanan ada dan milik user yang login
        if (!$pesananLama || $pesananLama->user_id != Auth::id()) {
            return redirect()->route('orders.index')->with('error', 'Pesanan tidak ditemukan.');
        }

        $itemsAdded = 0;
        $itemsSkipped = 0;
        $skippedItemNames = [];

        // 3. Loop setiap item detail di pesanan lama
        foreach ($pesananLama->details as $item) {
            
            // Cek apakah menu dari pesanan lama ini masih ada
            if (!isset($item->menu)) {
                $itemsSkipped++;
                continue; // Lompati item ini jika menu-nya sudah dihapus
            }

            $menu = $item->menu;

            // 4. Cek Stok: Pastikan menu masih ada, stoknya ada, dan stok cukup
            if ($menu->stok > 0 && $menu->stok >= $item->jumlah) {
                
                // 5. Masukkan ke keranjang baru (menggunakan library Cart)
                Cart::add([
                    'id' => $menu->id,
                    'name' => $menu->namaMenu,
                    'price' => $menu->harga, // Ambil harga TERBARU dari tabel menu
                    'quantity' => $item->jumlah,
                    'attributes' => [
                        // Sesuaikan 'gambar' dengan nama kolom di tabel Menu Anda
                        'image' => $menu->gambar ?? 'images/default.jpg' 
                    ]
                ]);
                $itemsAdded++;

            } else {
                // Jika stok habis atau menu sudah tidak ada
                $itemsSkipped++;
                $skippedItemNames[] = $menu->namaMenu;
            }
        }

        // 6. Siapkan pesan notifikasi untuk pelanggan
        if ($itemsAdded == 0) {
            // Tidak ada item yang berhasil ditambahkan (mungkin semua stok habis)
            return redirect()->route('orders.index')->with('error', 'Semua item dari pesanan ini sedang habis stok atau tidak tersedia.');
        }
        
        // Buat pesan sukses
        $message = "Berhasil menambahkan $itemsAdded item ke keranjang.";
        
        // Jika ada item yang dilewati, tambahkan info peringatan
        if ($itemsSkipped > 0) {
            $message .= " " . $itemsSkipped . " item dilewati karena stok habis (" . implode(', ', $skippedItemNames) . ").";
        }

        // 7. Arahkan ke halaman keranjang
        return redirect()->route('cart.list')->with('success', $message);
    }
}