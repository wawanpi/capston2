<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Tambahkan "use" untuk Controller di bagian atas
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MenuController; // <-- TAMBAHKAN INI

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web". Buat sesuatu yang hebat!
|
*/

// Rute Publik (Bisa diakses siapa saja)
Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard untuk USER BIASA (dan admin jika dia akses langsung)
// Middleware 'auth' & 'verified' memastikan hanya user terautentikasi yang bisa masuk
Route::get('/dashboard', function () {
    // TIPS: Redirect admin ke dashboard-nya sendiri jika dia tidak sengaja mengakses ini
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Profil (untuk semua user yang terautentikasi)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==========================================================
// ==          GRUP RUTE BARU UNTUK ADMIN SAJA             ==
// ==========================================================
Route::middleware(['auth', 'verified', 'role.admin']) // Middleware untuk memastikan login, terverifikasi, dan role-nya adalah 'admin'
    ->prefix('admin')                           // Semua URL akan diawali dengan /admin/...
    ->name('admin.')                            // Semua nama route akan diawali dengan admin....
    ->group(function () {

    // Contoh rute dashboard admin
    // URL: your-app.com/admin/dashboard
    // Nama Route: admin.dashboard
    Route::get('/dashboard', function () {
        // Buat file view ini: resources/views/admin/dashboard.blade.php
        return view('admin.dashboard');
    })->name('dashboard');

    // Rute resource untuk user
    Route::resource('users', UserController::class);

    // 2. TAMBAHKAN RUTE RESOURCE UNTUK MENU DI SINI
    Route::resource('menus', MenuController::class);

});
// ==========================================================


// Rute Autentikasi (login, register, dll.)
require __DIR__.'/auth.php';

