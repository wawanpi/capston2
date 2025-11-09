<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Tambahkan "use" untuk semua Controller yang digunakan
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\DashboardController; 
use App\Http\Controllers\CartController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController; 
use App\Http\Controllers\Customer\ReviewController; // <-- DITAMBAHKAN

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Landing Page (untuk tamu)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Rute untuk semua user yang SUDAH LOGIN
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Rute Dashboard (Menampilkan Menu)
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Rute Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Keranjang Belanja
    Route::get('/cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/remove-cart', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('/clear-cart', [CartController::class, 'clearAllCart'])->name('cart.clear');

    // Rute Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Rute Riwayat Pesanan
    Route::get('/riwayat-pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/riwayat-pesanan/{pesanan}', [OrderController::class, 'show'])->name('orders.show');

    // Rute "Pesan Lagi" (Pelanggan)
    Route::post('/riwayat-pesanan/{pesanan}/reorder', [OrderController::class, 'reorder'])->name('orders.reorder');

    // === RUTE BARU UNTUK REVIEW/ULASAN ===
    Route::get('/riwayat-pesanan/{pesanan}/review/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/riwayat-pesanan/{pesanan}/review', [ReviewController::class, 'store'])->name('reviews.store');
    // =====================================
});


// Grup Rute KHUSUS ADMIN
Route::middleware(['auth', 'verified', 'role.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // --- BARIS INI DIUBAH ---
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // -----------------------
        
        Route::resource('users', UserController::class);
        Route::resource('menus', MenuController::class);

        // Rute Kelola Pesanan
        Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::get('pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
        Route::put('pesanan/{pesanan}', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

        // Rute untuk Admin menambah item ke pesanan yang ada
        Route::post('pesanan/{pesanan}/tambah-item', [PesananController::class, 'addItem'])->name('pesanan.addItem');

        // Rute Kelola Transaksi
        Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::post('transaksi/verifikasi/{pesanan}', [TransaksiController::class, 'verifikasi'])->name('transaksi.verifikasi');
});


// Rute Autentikasi
require __DIR__.'/auth.php';