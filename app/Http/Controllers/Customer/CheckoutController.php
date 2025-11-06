<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- Import DB Facade untuk Transaksi
use Cart; // <-- Import Cart

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi checkout.
     * Method 'index' ini dipanggil oleh rute checkout.index (GET /checkout)
     */
    public function index()
    {
        $cartItems = Cart::getContent();
        $total = Cart::getTotal();

        // Jika keranjang kosong, jangan biarkan user ke halaman checkout
        if ($cartItems->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Keranjang Anda kosong. Silakan pilih menu terlebih dahulu.');
        }

        // Tampilkan view checkout.blade.php dan kirim data keranjang
        return view('checkout', compact('cartItems', 'total'));
    }

    /**
     * Menyimpan pesanan ke database.
     * Method 'store' ini dipanggil oleh rute checkout.store (POST /checkout)
     */
    public function store(Request $request)
    {
        $cartItems = Cart::getContent();
        
        // Cek lagi jika keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Keranjang Anda kosong.');
        }

        // --- Validasi Data dari Form ---
        $validatedData = $request->validate([
            // Pastikan nilai 'in' (Take Away,Dine-in) SAMA PERSIS dengan database Anda
            'tipe_layanan' => 'required|in:Take Away,Dine-in', 
            'catatan_pelanggan' => 'nullable|string|max:255',
            'jumlah_tamu' => 'required_if:tipe_layanan,Dine-in|nullable|numeric|min:1',
        ]);
        // ---------------------------------

        // Kita gunakan DB Transaction, jika ada 1 proses gagal, semua akan dibatalkan.
        try {
            DB::beginTransaction();

            // 1. Simpan "kepala" pesanan ke tabel 'pesanans'
            $pesanan = Pesanan::create([
                'user_id' => Auth::id(), // Ambil ID user yang sedang login
                'total_bayar' => Cart::getTotal(),
                'status' => 'pending', // Status awal pesanan
                'catatan_pelanggan' => $validatedData['catatan_pelanggan'], // <-- Diubah
                'tipe_layanan' => $validatedData['tipe_layanan'], // <-- Diubah
                'jumlah_tamu' => $validatedData['jumlah_tamu'] ?? 1,   // <-- Ditambah (Gunakan 1 jika null)
            ]);

            // 2. Loop semua item di keranjang
            foreach ($cartItems as $item) {
                // Cari menu di database untuk cek stok
                $menu = Menu::findOrFail($item->id);

                // Cek stok sekali lagi (keamanan)
                if ($menu->stok < $item->quantity) {
                    // Jika stok tidak cukup, batalkan transaksi dan beri pesan error
                    throw new \Exception('Stok untuk menu ' . $menu->namaMenu . ' tidak mencukupi (sisa ' . $menu->stok . ').');
                }

                // 3. Simpan setiap item ke 'pesanan_details'
                PesananDetail::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $item->id,
                    'jumlah' => $item->quantity,
                    'harga_satuan' => $item->price,
                    'subtotal' => $item->getPriceSum()
                ]);

                // 4. Kurangi stok menu
                $menu->decrement('stok', $item->quantity);
            }

            // 5. Jika semua berhasil, kosongkan keranjang belanja
            Cart::clear();

            // 6. Konfirmasi transaksi database (simpan permanen)
            DB::commit();

            // Sesuai PDF, arahkan ke halaman sukses (kita arahkan ke riwayat pesanan)
            return redirect()->route('orders.index')->with('success', 'Pesanan Anda (#'.$pesanan->id.') berhasil dibuat dan sedang diproses!');

        } catch (\Exception $e) {
            // 7. Jika ada kegagalan (misal stok habis), batalkan semua yang sudah disimpan
            DB::rollBack();

            // Jika error-nya karena validasi, kembalikan ke form
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return redirect()->back()->withErrors($e->errors())->withInput();
            }

            // Jika error-nya karena stok atau lainnya
            return redirect()->route('cart.list')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}