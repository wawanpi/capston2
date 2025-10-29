<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // <-- PENTING: Impor model Menu

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }

    /**
     * Menambahkan item ke keranjang dengan aman.
     */
    public function addToCart(Request $request)
    {
        // 1. Validasi input dasar
        $request->validate([
            'id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // 2. Ambil data produk dari DATABASE (bukan dari request) untuk keamanan
        $menu = Menu::findOrFail($request->id);

        // 3. Cek ketersediaan stok
        if ($menu->stok < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk ' . $menu->namaMenu);
        }

        // 4. Tambahkan ke keranjang menggunakan data dari database
        \Cart::add([
            'id' => $menu->id,
            'name' => $menu->namaMenu,
            'price' => $menu->harga,
            'quantity' => $request->quantity,
            'attributes' => [
                'image' => $menu->gambar, // Ambil gambar dari database
            ]
        ]);

        session()->flash('success', 'Menu berhasil ditambahkan ke keranjang!');

        return redirect()->route('cart.list');
    }

    /**
     * Mengupdate jumlah item di keranjang dengan pengecekan stok.
     */
    public function updateCart(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($request->id);

        // Cek stok sebelum update
        if ($menu->stok < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk ' . $menu->namaMenu);
        }

        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Keranjang berhasil diperbarui!');

        return redirect()->route('cart.list');
    }

    /**
     * Menghapus satu item dari keranjang.
     */
    public function removeCart(Request $request)
    {
        $request->validate(['id' => 'required']);
        \Cart::remove($request->id);
        session()->flash('success', 'Item berhasil dihapus dari keranjang!');

        return redirect()->route('cart.list');
    }

    /**
     * Menghapus semua item dari keranjang.
     */
    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', 'Semua item berhasil dihapus dari keranjang!');

        return redirect()->route('cart.list');
    }
}

