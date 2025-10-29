<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk user yang sudah login.
     */
    public function index()
    {
        // Redirect admin jika tidak sengaja mengakses halaman ini
        if (auth()->user() && auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // Ambil semua menu yang stoknya lebih dari 0, urutkan dari yang terbaru
        $menus = Menu::where('stok', '>', 0)->latest()->get();

        // Kirim data menu ke view 'dashboard'
        return view('dashboard', compact('menus'));
    }
}

