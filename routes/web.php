<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Tambahkan "use" untuk semua Controller yang digunakan
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderController; // <-- TAMBAHKAN INI

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

    // === RUTE BARU UNTUK RIWAYAT PESANAN ===
    Route::get('/riwayat-pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/riwayat-pesanan/{pesanan}', [OrderController::class, 'show'])->name('orders.show');
    // ======================================
});


// Grup Rute KHUSUS ADMIN
Route::middleware(['auth', 'verified', 'role.admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');
        
        Route::resource('users', UserController::class);
        Route::resource('menus', MenuController::class);

        Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::get('pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
        Route::put('pesanan/{pesanan}', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
});


// Rute Autentikasi
require __DIR__.'/auth.php';

