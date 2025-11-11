<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\DailyKetersediaan; // <-- Import model ketersediaan harian
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- Import DB Facade untuk Transaksi
use Cart; // <-- Import Cart
use Illuminate\Support\Carbon; // <-- Import Carbon untuk tanggal

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi checkout.
     * (Tidak ada perubahan di sini, sudah benar)
     */
    public function index()
    {
        $cartItems = Cart::getContent();
        $total = Cart::getTotal();

        if ($cartItems->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Keranjang Anda kosong. Silakan pilih menu terlebih dahulu.');
        }

        return view('checkout', compact('cartItems', 'total'));
    }

    /**
     * Menyimpan pesanan ke database.
     * PERBAIKAN: Menggunakan sistem ketersediaan harian.
     */
    public function store(Request $request)
    {
        $cartItems = Cart::getContent();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'Keranjang Anda kosong.');
        }

        // --- Validasi Data dari Form (Sudah benar) ---
        $validatedData = $request->validate([
            'tipe_layanan' => 'required|in:Take Away,Dine-in', 
            'catatan_pelanggan' => 'nullable|string|max:255',
            'jumlah_tamu' => 'required_if:tipe_layanan,Dine-in|nullable|numeric|min:1',
        ]);
        // ---------------------------------

        // Kita gunakan DB Transaction
        try {
            DB::beginTransaction();

            // 1. Simpan "kepala" pesanan ke tabel 'pesanans'
            $pesanan = Pesanan::create([
                'user_id' => Auth::id(),
                'total_bayar' => Cart::getTotal(),
                'status' => 'pending', // Status awal pesanan
                'catatan_pelanggan' => $validatedData['catatan_pelanggan'],
                'tipe_layanan' => $validatedData['tipe_layanan'],
                'jumlah_tamu' => $validatedData['jumlah_tamu'] ?? 1, 
            ]);

            // 2. Loop semua item di keranjang
            foreach ($cartItems as $item) {
                // Cari menu di database
                $menu = Menu::findOrFail($item->id);

                // --- PERBAIKAN LOGIKA KETERSEDIAAN ---

                // Cek ketersediaan sekali lagi (keamanan)
                // $menu->jumlah_saat_ini adalah accessor yg memuat relasi ketersediaanHariIni
                if ($menu->jumlah_saat_ini < $item->quantity) {
                    // Jika jumlah tidak cukup, batalkan transaksi dan beri pesan error
                    // PERBAIKAN: Pesan error diubah
                    throw new \Exception('Jumlah untuk menu ' . $menu->namaMenu . ' tidak mencukupi (sisa ' . $menu->jumlah_saat_ini . ').');
                }

                // 3. Simpan setiap item ke 'pesanan_details'
                PesananDetail::create([
                    'pesanan_id' => $pesanan->id,
                    'menu_id' => $item->id,
                    'jumlah' => $item->quantity,
                    'harga_satuan' => $item->price,
                    'subtotal' => $item->getPriceSum()
                ]);

                // 4. Kurangi jumlah harian (bukan $menu->decrement)
                // Kita panggil relasi ketersediaanHariIni (yang sudah di-load oleh accessor)
                $ketersediaanHariIni = $menu->ketersediaanHariIni;
                
                // Lakukan decrement pada kolom 'jumlah_saat_ini' di tabel 'daily_ketersediaan'
                $ketersediaanHariIni->decrement('jumlah_saat_ini', $item->quantity);
                
                // --- AKHIR PERBAIKAN ---
            }

            // 5. Jika semua berhasil, kosongkan keranjang belanja
            Cart::clear();

            // 6. Konfirmasi transaksi database (simpan permanen)
            DB::commit();

            // Arahkan ke halaman riwayat pesanan
            return redirect()->route('orders.index')->with('success', 'Pesanan Anda (#'.$pesanan->id.') berhasil dibuat dan sedang diproses!');

        } catch (\Exception $e) {
            // 7. Jika ada kegagalan (misal jumlah habis), batalkan semua
            DB::rollBack();

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return redirect()->back()->withErrors($e->errors())->withInput();
            }

            // Jika error-nya karena jumlah habis atau lainnya
            return redirect()->route('cart.list')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}