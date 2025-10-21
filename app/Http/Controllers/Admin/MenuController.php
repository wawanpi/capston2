<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // <-- Impor File facade

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

        $menus = $query->latest()->paginate(10); // Urutkan dari yang terbaru

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
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaMenu' => 'required|string|max:255|unique:menus,namaMenu',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->except('gambar');

        // PERUBAHAN LOGIKA UPLOAD
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('menu-images'), $filename); // Pindahkan langsung ke public/menu-images
            $input['gambar'] = 'menu-images/' . $filename; // Simpan path relatif terhadap public
        }

        Menu::create($input);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        // Biasanya tidak digunakan di panel admin, redirect saja ke index
        return redirect()->route('admin.menus.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'namaMenu' => 'required|string|max:255|unique:menus,namaMenu,' . $menu->id,
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->except('gambar');

        // PERUBAHAN LOGIKA UPDATE GAMBAR
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari folder public
            if ($menu->gambar && File::exists(public_path($menu->gambar))) {
                File::delete(public_path($menu->gambar));
            }
            // Pindahkan gambar baru ke folder public
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('menu-images'), $filename);
            $input['gambar'] = 'menu-images/' . $filename;
        }

        $menu->update($input);

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // PERUBAHAN LOGIKA HAPUS GAMBAR
        if ($menu->gambar && File::exists(public_path($menu->gambar))) {
            File::delete(public_path($menu->gambar));
        }
        
        $menu->delete();

        return redirect()->route('admin.menus.index')
                         ->with('success', 'Menu berhasil dihapus.');
    }
}

