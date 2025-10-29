<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

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
        
        // Mengirim data pesanan tunggal ke view detail
        return view('admin.pesanan.show', compact('pesanan'));
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
}
