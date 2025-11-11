<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\DailyKetersediaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Carbon;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('namaMenu', 'like', '%' . $request->search . '%');
        }

        // Gunakan with('ketersediaanHariIni') untuk eager load relasi jumlah/ketersediaan
        $menus = $query->latest()->with('ketersediaanHariIni', 'reviews')->paginate(10); 

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     * (Metode store Anda sudah benar)
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'namaMenu' => 'required|string|max:255|unique:menus,namaMenu',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'kapasitas' => 'required|integer|min:0', 
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori' => 'required|string|in:makanan,minuman',
        ]);

        // Logika upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('menu-images'), $filename);
            
            $validatedData['gambar'] = 'menu-images/' . $filename;
        }

        // 2. Buat Menu Baru
        $menu = Menu::create($validatedData);

        // 3. SET KETERSEDIAAN HARI INI SECARA MANUAL
        DailyKetersediaan::create([
            'menu_id' => $menu->id,
            'tanggal' => Carbon::today(),
            'jumlah_awal_hari' => $menu->kapasitas,
            'jumlah_saat_ini' => $menu->kapasitas,
        ]);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu baru berhasil ditambahkan dan jumlah harian diset.');
    }

    /**
     * Display the specified resource (Halaman Detail/Ulasan).
     * @param Menu $menu
     */
    public function show(Menu $menu)
    {
        $menu->load('reviews.user');
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     * (Metode edit Anda sudah benar)
     */
    public function edit(Menu $menu)
    {
        // Mengambil data ketersediaan riil hari ini (jika ada)
        $ketersediaanHariIni = $menu->ketersediaanHariIni;
        
        return view('admin.menus.edit', compact('menu', 'ketersediaanHariIni'));
    }

    /**
     * Update the specified resource in storage.
     * PERBAIKAN LOGIKA:
     * Logika ini menghitung penjualan yang sudah terjadi hari ini
     * agar data penjualan tidak hilang saat kapasitas di-update.
     */
    public function update(Request $request, Menu $menu)
    {
        // 1. Validasi Input (kapasitas baru)
        $validatedData = $request->validate([
            'namaMenu' => 'required|string|max:255|unique:menus,namaMenu,' . $menu->id,
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'kapasitas' => 'required|integer|min:0', // Ini adalah KAPASITAS BARU
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'kategori' => 'required|string|in:makanan,minuman', 
        ]);
        
        // Logika update gambar (tetap sama)
        if ($request->hasFile('gambar')) {
            if ($menu->gambar && File::exists(public_path($menu->gambar))) {
                File::delete(public_path($menu->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('menu-images'), $filename);
            $validatedData['gambar'] = 'menu-images/' . $filename;
        }

        // 2. Update Menu (Simpan kapasitas baru ke tabel menu)
        $menu->update($validatedData);

        // 3. LOGIKA UPDATE KETERSEDIAAN HARI INI (Logika "Digabung" yang Benar)
        
        // Cari entri hari ini, ATAU Buat baru jika belum ada (misal menu baru diedit di hari yg sama)
        $ketersediaanHariIni = $menu->ketersediaanHariIni()->firstOrCreate(
            [
                'tanggal' => Carbon::today(), // Cari berdasarkan tanggal hari ini
            ],
            [
                'jumlah_awal_hari' => 0, // Default jika baru dibuat hari ini (akan diupdate di bawah)
                'jumlah_saat_ini' => 0,
            ]
        );

        // Hitung penjualan yang SUDAH terjadi hari ini
        // (Misal: Awal 100, Sisa 70 -> Terjual 30)
        $jumlahTerjual = $ketersediaanHariIni->jumlah_awal_hari - $ketersediaanHariIni->jumlah_saat_ini;

        // Hitung sisa baru berdasarkan kapasitas baru
        // (Misal: Kapasitas baru 120 -> Sisa baru 120 - 30 = 90)
        $jumlahSaatIniBaru = $menu->kapasitas - $jumlahTerjual;

        // Update ketersediaan hari ini dengan data yang sudah dihitung ulang
        $ketersediaanHariIni->update([
            'jumlah_awal_hari' => $menu->kapasitas, // Set kapasitas baru
            // Pastikan sisa tidak negatif (jika kapasitas baru < jumlah terjual)
            'jumlah_saat_ini' => max(0, $jumlahSaatIniBaru), 
        ]);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil diperbarui, dan jumlah harian disesuaikan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        if ($menu->gambar && File::exists(public_path($menu->gambar))) {
            File::delete(public_path($menu->gambar));
        }
        
        $menu->delete();

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil dihapus.');
    }
}