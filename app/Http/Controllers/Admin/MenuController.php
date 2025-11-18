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
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('namaMenu', 'like', '%' . $request->search . '%');
        }

        $menus = $query->latest()->with('ketersediaanHariIni', 'reviews')->paginate(10); 

        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // --- 1. DEFINISI ATURAN VALIDASI ---
        $rules = [
            'namaMenu' => 'required|string|max:255|unique:menus,namaMenu',
            'harga'    => 'required|numeric|min:1', // Minimal 1, tidak boleh 0/negatif
            'deskripsi'=> 'nullable|string',
            'kapasitas'=> 'required|integer|min:1', // Minimal 1
            'gambar'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori' => 'required|string|in:makanan,minuman',
        ];

        // --- 2. PESAN ERROR BAHASA INDONESIA (CUSTOM) ---
        $messages = [
            'required' => ':attribute wajib diisi.',
            'string'   => ':attribute harus berupa teks.',
            'numeric'  => ':attribute harus berupa angka.',
            'integer'  => ':attribute harus berupa bilangan bulat.',
            'min'      => ':attribute tidak boleh kurang dari :min.',
            'unique'   => ':attribute sudah terdaftar, gunakan nama lain.',
            'image'    => ':attribute harus berupa gambar.',
            'mimes'    => 'Format :attribute harus: jpeg, png, jpg, gif, atau svg.',
            'max'      => 'Ukuran :attribute maksimal :max KB.',
            'in'       => ':attribute yang dipilih tidak valid.',
        ];

        // Custom Attribute Names agar pesan lebih enak dibaca
        $customAttributes = [
            'namaMenu' => 'Nama Menu',
            'harga'    => 'Harga',
            'kapasitas'=> 'Kapasitas Harian',
            'gambar'   => 'Gambar Menu',
            'kategori' => 'Kategori',
        ];

        // --- 3. JALANKAN VALIDASI ---
        $validatedData = $request->validate($rules, $messages, $customAttributes);

        // Logika upload gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('menu-images'), $filename);
            
            $validatedData['gambar'] = 'menu-images/' . $filename;
        }

        // 4. Buat Menu Baru
        $menu = Menu::create($validatedData);

        // 5. Set Ketersediaan Hari Ini
        DailyKetersediaan::create([
            'menu_id' => $menu->id,
            'tanggal' => Carbon::today(),
            'jumlah_awal_hari' => $menu->kapasitas,
            'jumlah_saat_ini' => $menu->kapasitas,
        ]);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu baru berhasil ditambahkan!');
    }

    // ... (Method show, edit, update, destroy biarkan seperti kode lama Anda atau minta update terpisah jika perlu)
    
    public function show(Menu $menu)
    {
        $menu->load('reviews.user');
        return view('admin.menus.show', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        $ketersediaanHariIni = $menu->ketersediaanHariIni;
        return view('admin.menus.edit', compact('menu', 'ketersediaanHariIni'));
    }

    public function update(Request $request, Menu $menu)
    {
        // Validasi Update juga perlu disesuaikan bahasanya jika mau konsisten
        // Untuk sekarang saya gunakan logic default Anda yang sudah ada di chat sebelumnya
        // tapi disarankan menerapkan $messages seperti di method store()
        
        $validatedData = $request->validate([
            'namaMenu' => 'required|string|max:255|unique:menus,namaMenu,' . $menu->id,
            'harga' => 'required|numeric|min:1',
            'deskripsi' => 'nullable|string',
            'kapasitas' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'kategori' => 'required|string|in:makanan,minuman', 
        ]);
        
        if ($request->hasFile('gambar')) {
            if ($menu->gambar && File::exists(public_path($menu->gambar))) {
                File::delete(public_path($menu->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('menu-images'), $filename);
            $validatedData['gambar'] = 'menu-images/' . $filename;
        }

        $menu->update($validatedData);

        $ketersediaanHariIni = $menu->ketersediaanHariIni()->firstOrCreate(
            ['tanggal' => Carbon::today()],
            ['jumlah_awal_hari' => 0, 'jumlah_saat_ini' => 0]
        );

        $jumlahTerjual = $ketersediaanHariIni->jumlah_awal_hari - $ketersediaanHariIni->jumlah_saat_ini;
        $jumlahSaatIniBaru = $menu->kapasitas - $jumlahTerjual;

        $ketersediaanHariIni->update([
            'jumlah_awal_hari' => $menu->kapasitas,
            'jumlah_saat_ini' => max(0, $jumlahSaatIniBaru), 
        ]);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil diperbarui.');
    }

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