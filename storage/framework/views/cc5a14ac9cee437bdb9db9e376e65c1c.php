<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan BURMIN Online </title>
    
    <!-- Memuat Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Memuat Lucide Icons (untuk ikon user, dll.) -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Memuat Alpine.js untuk logika buka/tutup menu -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        /* Style kustom untuk scrollbar, warna, dan x-cloak */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .bg-kfc-red { background-color: #E3002B; }
        .text-kfc-red { color: #E3002B; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<!-- Inisialisasi Alpine.js dengan 'sidebarOpen' dan 'profileOpen' -->
<body class="bg-gray-50 font-sans" x-data="{ sidebarOpen: false, profileOpen: false }">

    <!-- === SIDEBAR MENU UTAMA (Drawer) === -->

    <!-- Backdrop Overlay (Latar belakang gelap) -->
    <div 
        x-show="sidebarOpen" 
        @click="sidebarOpen = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/60 z-40"
        x-cloak
    ></div>

    <!-- Panel Sidebar -->
    <div 
        x-show="sidebarOpen"
        x-transition:enter="transform ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 h-full w-80 bg-white z-50 shadow-lg flex flex-col"
        x-cloak
    >
        <!-- 1. Header Sidebar -->
        <div class="flex justify-between items-center p-4 border-b">
            <div class="text-2xl font-bold tracking-wider uppercase text-burmin-red">
                BURMIN
                <span class="block text-xs font-normal capitalize">Jagonya Ayam</span>
            </div>
            <button @click="sidebarOpen = false">
                <i data-lucide="x" class="w-6 h-6 text-gray-700"></i>
            </button>
        </div>

        <!-- 2. Profil Pengguna Sidebar -->
        <div class="p-4 flex items-center gap-3 border-b">
            <?php if(auth()->guard()->check()): ?>
                <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="font-semibold text-gray-800"><?php echo e(Auth::user()->name ?? 'Wawan'); ?></span>
                </div>
            <?php else: ?>
                <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6"></i>
                </div>
                <div>
                    <a href="<?php echo e(route('login')); ?>" class="font-semibold text-gray-800">Login / Daftar</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- 3. Link Navigasi Sidebar -->
        <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
            <a href="#" class="flex items-center justify-between p-3 rounded-lg text-gray-700 font-semibold hover:bg-gray-100">
                <span>HOME</span>
            </a>
            <a href="#" class="flex items-center justify-between p-3 rounded-lg text-gray-700 font-semibold hover:bg-gray-100">
                <span>ORDER</span>
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </a>
            <a href="#" class="flex items-center justify-between p-3 rounded-lg text-gray-700 font-semibold hover:bg-gray-100">
                <span>KIDS</span>
            </a>
            <a href="#" class="flex items-center justify-between p-3 rounded-lg text-gray-700 font-semibold hover:bg-gray-100">
                <span>AUTOMOTIVE</span>
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </a>
            <a href="#" class="flex items-center justify-between p-3 rounded-lg text-gray-700 font-semibold hover:bg-gray-100">
                <span>CORPORATE</span>
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </a>
            <a href="#" class="flex items-center justify-between p-3 rounded-lg text-gray-700 font-semibold hover:bg-gray-100">
                <span>EVENT</span>
            </a>
            <a href="#" class="flex items-center justify-between p-3 rounded-lg text-gray-700 font-semibold hover:bg-gray-100">
                <span>STORE</span>
            </a>
            <a href="#" class="flex items-center justify-between p-3 rounded-lg text-gray-700 font-semibold hover:bg-gray-100">
                <span>INFO</span>
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </a>

            <!-- Tombol Logout 1 (di dalam Sidebar) -->
            <?php if(auth()->guard()->check()): ?>
                <div class="border-t pt-2 mt-2">
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                        <?php echo csrf_field(); ?>
                        <a href="<?php echo e(route('logout')); ?>" 
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="flex items-center gap-3 p-3 rounded-lg text-red-600 hover:bg-red-50 w-full">
                            <i data-lucide="log-out" class="w-5 h-5"></i>
                            <span class="font-semibold">Logout</span>
                        </a>
                    </form>
                </div>
            <?php endif; ?>
        </nav>

        <!-- 4. Footer Sidebar (Download App) -->
        <div class="mt-auto p-4 bg-gray-800 text-white">
            <h4 class="font-bold mb-3 uppercase">DOWNLOAD APP</h4>
            <div class="flex flex-col gap-3">
                <a href="#"><img src="https://kfcindonesia.com/static/media/app_store.e23d24be.png" alt="App Store" class="h-12 w-auto"></a>
                <a href="#"><img src="https://kfcindonesia.com/static/media/google_play.d51c76c0.png" alt="Google Play" class="h-12 w-auto"></a>
            </div>
        </div>
    </div>
    <!-- === AKHIR SIDEBAR MENU UTAMA === -->


    <!-- === 1. HEADER (Top Navigation) === -->
    <header class="bg-kfc-red text-white shadow-lg sticky top-0 z-30">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Sisi Kiri: Menu & Logo -->
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <div class="text-2xl font-bold tracking-wider uppercase">
                    BURMIN
                    <span class="block text-xs font-normal capitalize">Jagonya Ayam</span>
                </div>
            </div>

            <!-- Sisi Kanan: Kupon, Bahasa, User -->
            <div class="flex items-center gap-3 md:gap-5">
                <div class="relative">
                    <button class="flex items-center gap-1 font-semibold text-sm">
                        EN <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
                </div>
                
                <!-- === DROPDOWN PROFIL === -->
                <div class="relative">
                    <!-- Tombol Ikon User -->
                    <button @click="profileOpen = !profileOpen" class="w-10 h-10 bg-white text-kfc-red rounded-full flex items-center justify-center">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </button>

                    <!-- Panel Dropdown Profile -->
                    <div 
                        x-show="profileOpen"
                        @click.outside="profileOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 top-12 z-50 w-80 bg-white rounded-lg shadow-lg border text-gray-800"
                        x-cloak
                    >
                        <!-- 1. User Info -->
                        <div class="p-4 border-b">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">
                                    <i data-lucide="user" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <?php if(auth()->guard()->check()): ?>
                                        <span class="font-semibold text-gray-800"><?php echo e(Auth::user()->name ?? 'Wawan'); ?></span>
                                        <a href="#" class="text-sm text-red-600 block">Complete your profile</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login')); ?>" class="font-semibold text-gray-800">Login / Daftar</a>
                                        <p class="text-sm text-gray-500">Login untuk melihat profil</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 2. Poin/Voucher Card -->
                        <div class="p-4 bg-gray-50">
                            <div class="bg-gradient-to-r from-gray-200 to-gray-100 p-4 rounded-lg shadow-inner">
                                <div class="flex justify-between text-center">
                                    <div>
                                        <span class="text-xl font-bold text-gray-800">0</span>
                                        <span class="text-sm text-gray-600 block">Point</span>
                                    </div>
                                    <div>
                                        <span class="text-xl font-bold text-gray-800">3</span>
                                        <span class="text-sm text-gray-600 block">Voucher</span>
                                    </div>
                                    <div>
                                        <span class="text-xl font-bold text-gray-800">0</span>
                                        <span class="text-sm text-gray-600 block">Referral</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Menu Navigasi Profil -->
                        <nav class="p-2 text-gray-700">
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                                <i data-lucide="award" class="w-5 h-5"></i>
                                <span class="font-semibold">Reward</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                                <i data-lucide="package" class="w-5 h-5"></i>
                                <span class="font-semibold">My Order</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                                <i data-lucide="ticket" class="w-5 h-5"></i>
                                <span class="font-semibold">My Voucher</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-gray-100 text-kfc-red"> <!-- Contoh state aktif -->
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                                <span class="font-semibold">My Address</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                                <i data-lucide="credit-card" class="w-5 h-5"></i>
                                <span class="font-semibold">My Payment</span>
                            </a>
                        </nav>

                        <!-- 4. Separator & Link Bawah -->
                        <div class="border-t mx-2"></div>
                        <nav class="p-2 text-gray-700">
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                                <i data-lucide="shield" class="w-5 h-5"></i>
                                <span class="font-semibold">Privacy Policy</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                                <span class="font-semibold">Terms & Conditions</span>
                            </a>

                            <!-- Tombol Logout 2 (di dalam Dropdown Profil) -->
                            <?php if(auth()->guard()->check()): ?>
                                <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                                    <?php echo csrf_field(); ?>
                                    <a href="<?php echo e(route('logout')); ?>" 
                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                       class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 w-full">
                                        <i data-lucide="log-out" class="w-5 h-5"></i>
                                        <span class="font-semibold">Logout</span>
                                    </a>
                                </form>
                            <?php endif; ?>
                        </nav>
                    </div>
                </div>
                <!-- === AKHIR DROPDOWN PROFIL === -->

            </div>
        </div>
    </header>

    <!-- === 2. CATEGORY NAVIGATION === -->
    <nav class="bg-white shadow-md sticky top-[68px] z-20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-8 overflow-x-auto py-4 no-scrollbar">
                <a href="#" class="flex flex-col items-center text-gray-700 hover:text-kfc-red whitespace-nowrap">
                    <img src="https://kfcindonesia.com/static/media/Special.f22033c0.png" alt="Special" class="h-8 w-8">
                    <span class="mt-1 text-sm font-semibold">Special</span>
                </a>
                <a href="#" class="flex flex-col items-center text-gray-700 hover:text-kfc-red whitespace-nowrap">
                    <img src="https://kfcindonesia.com/static/media/Combo.73501720.png" alt="Combo" class="h-8 w-8">
                    <span class="mt-1 text-sm font-semibold">Combo</span>
                </a>
                <a href="#" class="flex flex-col items-center text-gray-700 hover:text-kfc-red whitespace-nowrap">
                    <img src="https://kfcindonesia.com/static/media/AlaCarte.d51f2469.png" alt="Ala Carte" class="h-8 w-8">
                    <span class="mt-1 text-sm font-semibold">Ala Carte</span>
                </a>
                <a href="#" class="flex flex-col items-center text-gray-700 hover:text-kfc-red whitespace-nowrap">
                    <img src="https://kfcindonesia.com/static/media/Drinks.b3b55c4d.png" alt="Drinks" class="h-8 w-8">
                    <span class="mt-1 text-sm font-semibold">Drinks</span>
                </a>
                <!-- Anda bisa tambahkan kategori lain di sini -->
            </div>
        </div>
    </nav>

    <!-- === MAIN CONTENT WRAPPER === -->
    <main>

        <!-- 3. HERO BANNER (Carousel) -->
        <section class="relative w-full h-[50vh] bg-cover bg-center" style="background-image: url('https://kfcindonesia.com/static/media/monday-deal-web-1.b0f20952.jpg');">
            <!-- Tombol Navigasi Slider -->
            <button class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-md">
                <i data-lucide="chevron-left" class="text-gray-800"></i>
            </button>
            <button class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full p-2 shadow-md">
                <i data-lucide="chevron-right" class="text-gray-800"></i>
            </button>
        </section>

        <!-- Wrapper Konten (memberi padding) -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Pesan Sukses/Error (dari kode Anda) -->
            <div class="mb-4">
                <?php if(session('success')): ?>
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 4. ORDER TYPE (Tipe Pesanan) -->
            <section class="mb-12">
                <div class="flex items-center gap-2 mb-6">
                    <span class="w-3 h-10 bg-kfc-red"></span>
                    <span class="w-3 h-10 bg-kfc-red"></span>
                    <span class="w-3 h-10 bg-kfc-red"></span>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-6 uppercase">HUNGRY TODAY? LET'S ORDER</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="#" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="https://kfcindonesia.com/static/media/Dine-in.0135d1f8.png" alt="Dine-In" class="h-16 w-16">
                        <span class="mt-2 font-bold text-lg text-gray-800">Dine-In</span>
                    </a>
                    <a href="#" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="https://kfcindonesia.com/static/media/Take-away.299c8f00.png" alt="Take Away" class="h-16 w-16">
                        <span class="mt-2 font-bold text-lg text-gray-800">Take Away</span>
                    </a>
                    <a href="#" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="https://kfcindonesia.com/static/media/Delivery.b1b75356.png" alt="Delivery" class="h-16 w-16">
                        <span class="mt-2 font-bold text-lg text-gray-800">Delivery</span>
                    </a>
                    <a href="#" class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <img src="https://kfcindonesia.com/static/media/Drive-thru.6a1b2496.png" alt="Drive-Thru" class="h-16 w-16">
                        <span class="mt-2 font-bold text-lg text-gray-800">Drive-Thru</span>
                    </a>
                </div>
            </section>

            <!-- 5. HOT DEALS (Menu Loop) -->
            <section class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-3 h-10 bg-kfc-red"></span>
                            <span class="w-3 h-10 bg-kfc-red"></span>
                            <span class="w-3 h-10 bg-kfc-red"></span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-gray-900 uppercase">Hot Deals</h3>
                    </div>
                    <a href="#" class="text-sm font-semibold text-kfc-red hover:text-red-700">See All &rarr;</a>
                </div>
                
                <?php if(!isset($menus) || $menus->isEmpty()): ?>
                    <p class="text-gray-500">Saat ini belum ada menu yang tersedia.</p>
                <?php else: ?>
                    <div class="flex space-x-6 overflow-x-auto pb-4 no-scrollbar">
                        <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white border rounded-lg overflow-hidden shadow-lg flex-shrink-0 w-80">
                                <img class="w-full h-48 object-cover" src="<?php echo e(asset($menu->gambar)); ?>" alt="<?php echo e($menu->namaMenu); ?>">
                                
                                <div class="p-4 flex flex-col" style="height: 200px;">
                                    <h4 class="font-bold text-lg mb-1"><?php echo e($menu->namaMenu); ?></h4>
                                    <p class="text-gray-700 text-lg font-semibold mb-2">Rp <?php echo e(number_format($menu->harga, 0, ',', '.')); ?></p>
                                    <p class="text-sm text-gray-600 mb-4 flex-grow"><?php echo e(Str::limit($menu->deskripsi, 50)); ?></p>

                                    <form action="<?php echo e(route('cart.store')); ?>" method="POST" class="mt-auto">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" value="<?php echo e($menu->id); ?>" name="id">
                                        <input type="hidden" value="1" name="quantity">
                                        
                                        <?php if($menu->stok > 0): ?>
                                            <button class="w-full px-4 py-2 text-sm text-white bg-kfc-red rounded-md hover:bg-red-700 transition duration-200">Tambah ke Keranjang</button>
                                        <?php else: ?>
                                            <button class="w-full px-4 py-2 text-sm text-white bg-gray-400 rounded-md cursor-not-allowed" disabled>Stok Habis</button>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </section>
            
            <!-- 6. EXCLUSIVE KFCKU APP -->
            <section class="mb-12">
                 <div class="flex justify-between items-center mb-6">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-3 h-10 bg-kfc-red"></span>
                            <span class="w-3 h-10 bg-kfc-red"></span>
                            <span class="w-3 h-10 bg-kfc-red"></span>
                        </div>
                        <h3 class="text-3xl font-extrabold text-gray-900 uppercase">EXCLUSIVE KFCKU APP</h3>
                    </div>
                    <a href="#" class="text-sm font-semibold text-kfc-red hover:text-red-700">See All &rarr;</a>
                </div>
                <div class="flex space-x-6 overflow-x-auto pb-4 no-scrollbar">
                    <div class="border rounded-lg overflow-hidden shadow-lg flex-shrink-0 w-80">
                        <img class="w-full h-48 object-cover" src="https://kfcindonesia.com/static/media/mobile-midweek-spaylater-10-percent-landscape-thumbnail.0441065e.jpg" alt="Promo 1">
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-1">Potongan Harga 10%...</h4>
                            <p class="text-sm text-gray-600 mb-4">Save 10% on your favorite BURMIN menu with ShopeePayLater!</p>
                            <a href="#" class="font-bold text-kfc-red">See Detail</a>
                        </div>
                    </div>
                    <div class="border rounded-lg overflow-hidden shadow-lg flex-shrink-0 w-80">
                        <img class="w-full h-48 object-cover" src="https://kfcindonesia.com/static/media/mobile-midweek-1-pc-landscape-thumbnail.69637c35.jpg" alt="Promo 2">
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-1">MidWeek 1 Pc Chicken + 1...</h4>
                            <p class="text-sm text-gray-600 mb-4">Enjoy 1 Pc Chicken + Rice for only Rp15,000</p>
                            <a href="#" class="font-bold text-kfc-red">See Detail</a>
                        </div>
                    </div>
                    <div class="border rounded-lg overflow-hidden shadow-lg flex-shrink-0 w-80">
                        <img class="w-full h-48 object-cover" src="https://kfcindonesia.com/static/media/mobile-midweek-4-pc-landscape-thumbnail.c41b893f.jpg" alt="Promo 3">
                        <div class="p-4">
                            <h4 class="font-bold text-lg mb-1">MIDWEEK CRUNCH</h4>
                            <p class="text-sm text-gray-600 mb-4">Midweek Crunch 4 Pc Chicken</p>
                            <a href="#" class="font-bold text-kfc-red">See Detail</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 7. APP DOWNLOAD SECTION -->
            <section class="my-16 bg-white p-8 rounded-xl shadow-lg grid md:grid-cols-2 gap-8 items-center">
                <div class="text-center md:text-left">
                    <div class="flex justify-center md:justify-start items-center gap-2 mb-4">
                        <span class="w-3 h-10 bg-kfc-red"></span>
                        <span class="w-3 h-10 bg-kfc-red"></span>
                        <span class="w-3 h-10 bg-kfc-red"></span>
                    </div>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4 uppercase">Unlock More Finger Lickin' Good Benefits</h2>
                    <p class="text-gray-600 mb-8">
                        Create an account to get access to exclusive promos and rewards,
                        and reorder your favorites.
                    </p>
                    <div class="flex justify-center md:justify-start gap-4">
                        <a href="#"><img src="https://kfcindonesia.com/static/media/app_store.e23d24be.png" alt="App Store" class="h-12"></a>
                        <a href="#"><img src="https://kfcindonesia.com/static/media/google_play.d51c76c0.png" alt="Google Play" class="h-12"></a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="https://kfcindonesia.com/static/media/KFC-App-Landscape.a9e0364c.png" alt="BURMIN App" class="max-w-md w-full mx-auto">
                </div>
            </section>

        </div> <!-- Penutup Wrapper Konten -->
    </main>
    
    <!-- === 8. FOOTER === -->
    <footer class="bg-gray-900 text-gray-300 pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">PT FAST FOOD INDONESIA TBK</h4>
                    <p class="text-sm mb-2">Address: Jl. Bunga, Geblagan, Tamantirto, Kec. Kasihan, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55184</p>
                    <p class="text-sm mb-2">Operating hours: <br> Weekday: 08.00 - 20.00 <br> Weekend: 10.00 - 19.00</p>
                    <p class="text-sm mb-2">Telephone: 14022</p>
                    <p class="text-sm">E-mail: info@kfcindonesia.com</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">SERVICES</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Dine-In</a></li>
                        <li><a href="#" class="hover:text-white">Take Away</a></li>
                        <li><a href="#" class="hover:text-white">Delivery</a></li>
                        <li><a href="#" class="hover:text-white">Drive-Thru</a></li>
                        <li><a href="#" class="hover:text-white">Catering</a></li>
                        <li><a href="#" class="hover:text-white">B'day Party</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">INFO</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Allergen Information</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">DOWNLOAD APP</h4>
                    <div class="flex flex-col gap-4">
                        <a href="#"><img src="https://kfcindonesia.com/static/media/app_store.e23d24be.png" alt="App Store" class="h-12"></a>
                        <a href="#"><img src="https://kfcindonesia.com/static/media/google_play.d51c76c0.png" alt="Google Play" class="h-12"></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p class="mb-4 md:mb-0">&copy; <?php echo e(date('Y')); ?> kfc.com by PT FASTFOOD INDONESIA Tbk. | All rights reserved.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                    <a href="https://www.instagram.com/burjominang/" class="hover:text-white"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                    <a href="#" class="hover:text-white"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                    <a href="#" class="hover:text-white"><i data-lucide="youtube" class="w-5 h-5"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- === TOMBOL MELAYANG === -->
    
    <!-- Tombol Keranjang Melayang -->
    <a href="<?php echo e(route('cart.list')); ?>" class="fixed bottom-16 right-4 z-30 bg-kfc-red p-4 rounded-full shadow-lg group">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.023.828l1.25 5.001A2.25 2.25 0 0 0 6.095 12H17.25a2.25 2.25 0 0 0 2.22-1.87l.46-4.885A1.125 1.125 0 0 0 18.72 4.125H5.111M7.5 18a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm10.5 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
        </svg>
        <?php if(\Cart::getTotalQuantity() > 0): ?>
            <span class="absolute -top-2 -right-2 bg-white text-kfc-red text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"><?php echo e(\Cart::getTotalQuantity()); ?></span>
        <?php endif; ?>
    </a>
    
    <!-- Tombol Hadiah Melayang -->
    <button class="fixed bottom-4 right-4 z-30">
        <img src="https://kfcindonesia.com/static/media/bucket-list-icon.1139e8c3.png" alt="Prize" class="w-16 h-16">
    </button>

    <!-- Inisialisasi Ikon Lucide (HARUS ada di akhir body) -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>

 <?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/dashboard.blade.php ENDPATH**/ ?>