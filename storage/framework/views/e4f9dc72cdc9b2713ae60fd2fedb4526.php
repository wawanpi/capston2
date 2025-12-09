<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BURJO MINANG</title>

    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'kfc-red': '#E4002B',
                    }
                }
            }
        }
    </script>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #ccc; border-radius: 4px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white" x-data="{ open: false }">

    
    <header class="sticky top-0 z-40 bg-white shadow-md">
        <nav class="container mx-auto px-4 py-2 flex justify-between items-center h-[68px]">
            
            <div class="lg:hidden">
                <button @click="open = true" class="text-gray-700 focus:outline-none" aria-label="Open menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7"> <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /> </svg>
                </button>
            </div>

            
            <div class="flex-grow flex justify-center lg:flex-grow-0 lg:justify-start items-center">
                 <a href="/" class="flex items-center" aria-label="Homepage">
                     <img src="<?php echo e(asset('menu-images/Burmin_logo.jpg')); ?>" alt="BURJO MINANG" class="h-16 lg:h-18">
                 </a>
            </div>

            
            <div class="hidden lg:flex flex-grow justify-center items-center space-x-6">                
                <a href="#" class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200">Home</a>
                <a href="#menu" class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200">Menu</a>
                <a href="#" class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200">About</a>
            </div>

            
            <div class="flex items-center space-x-3 flex-shrink-0">
                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="hidden lg:inline-block bg-kfc-red text-white px-5 py-2 rounded-full font-semibold text-sm hover:bg-red-700 transition duration-300 shadow-sm">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="hidden lg:inline-block bg-white text-kfc-red border border-kfc-red px-5 py-[7px] rounded-full font-semibold text-sm hover:bg-red-50 transition duration-300 shadow-sm">
                            Sign Up
                        </a>
                        <a href="<?php echo e(route('login')); ?>" class="hidden lg:inline-block bg-kfc-red text-white px-5 py-2 rounded-full font-semibold text-sm hover:bg-red-700 transition duration-300 shadow-sm">
                            Sign In
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
                
                 <a href="tel:14022" class="lg:hidden flex items-center bg-kfc-red text-white px-3 py-1.5 rounded-full font-semibold text-xs shadow-sm">
                    <span class="font-bold">Call Us</span>
                 </a>
            </div>
        </nav>
    </header>

    
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="open" x-cloak>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full">
                    <div class="pointer-events-auto w-screen transform transition ease-in-out duration-300"
                         x-show="open"
                         x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                         x-transition:leave="transform transition ease-in-out duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                        <div class="flex h-full flex-col overflow-y-auto bg-white shadow-xl sidebar-scroll">
                            <div class="flex items-center justify-between p-4 border-b">
                                <div class="flex space-x-1"> <span class="w-1.5 h-6 bg-kfc-red"></span> <span class="w-1.5 h-6 bg-kfc-red"></span> <span class="w-1.5 h-6 bg-kfc-red"></span> </div>
                                <button type="button" class="relative rounded-md text-gray-500 hover:text-gray-700 focus:outline-none" @click="open = false">
                                    <span class="absolute -inset-2.5"></span> <span class="sr-only">Close panel</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /> </svg>
                                </button>
                            </div>

                            <div class="relative flex-1">
                                <div class="px-4 py-6 space-y-3">
                                    <?php if(auth()->guard()->check()): ?>
                                        <a href="<?php echo e(route('dashboard')); ?>" class="block w-full text-center bg-kfc-red text-white px-5 py-3 rounded-md font-semibold hover:bg-red-700 transition duration-300 shadow-sm">
                                            Dashboard
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login')); ?>" class="block w-full text-center bg-kfc-red text-white px-5 py-3 rounded-md font-semibold hover:bg-red-700 transition duration-300 shadow-sm">
                                            Sign In
                                        </a>
                                        <a href="<?php echo e(route('register')); ?>" class="block w-full text-center bg-white text-kfc-red border border-kfc-red px-5 py-[11px] rounded-md font-semibold hover:bg-red-50 transition duration-300 shadow-sm">
                                            Sign Up
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <nav class="flex flex-col text-gray-800 font-semibold uppercase text-sm">
                                    <a href="#menu" @click="open = false" class="px-4 py-3 border-t hover:bg-gray-100 transition duration-200">Menu Pilihan</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <main>
      
        <section class="relative w-full h-[60vh] md:h-[70vh] lg:h-[85vh] bg-cover bg-center" 
                style="background-image: url('<?php echo e(asset('menu-images/ikanbakar.jpg')); ?>');">
            
            <div class="absolute inset-0 bg-gradient-to-r from-red-900/80 via-red-700/60 to-yellow-600/50"></div>
            
            <div class="relative h-full flex items-center">
                <div class="container mx-auto px-6 lg:px-16">
                    <div class="max-w-2xl">
                        <h1 class="text-white text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold uppercase tracking-tight leading-tight">
                            Jagonya<br>
                            <span class="text-yellow-400">Rasa Original</span>
                        </h1>
                        <p class="text-white text-xl md:text-2xl mt-4 font-bold">Jaminan Kualitas</p>
                        <p class="text-white/90 text-base md:text-lg mt-4 max-w-xl">
                            Nikmati hidangan lezat dengan sistem booking yang mudah. Pesan sekarang, ambil di tempat tanpa antri!
                        </p>
                        <div class="flex flex-wrap gap-4 mt-8">
                            <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-2 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-bold text-lg rounded-full shadow-xl transition transform hover:scale-105">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                Order Now!
                            </a>
                            <a href="#menu" class="inline-flex items-center gap-2 px-8 py-4 bg-white/20 backdrop-blur-sm text-white font-bold text-lg rounded-full border-2 border-white shadow-xl transition transform hover:scale-105">
                                Lihat Menu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="bg-gray-100 py-12 px-4">
            <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center justify-items-center">
                <div class="flex flex-col items-center max-w-xs">
                    <div class="bg-red-100 rounded-full p-4 mb-3 inline-block w-20 h-20 flex items-center justify-center">
                        <i class="fas fa-clock text-4xl text-red-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1 text-sm uppercase">Booking Mudah</h4>
                    <p class="text-xs text-gray-600 mb-2 px-2">Pesan sekarang, ambil nanti sesuai jadwal Anda.</p>
                </div>
                <div class="flex flex-col items-center max-w-xs">
                    <div class="bg-yellow-100 rounded-full p-4 mb-3 inline-block w-20 h-20 flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-4xl text-yellow-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1 text-sm uppercase">Ambil di Tempat</h4>
                    <p class="text-xs text-gray-600 mb-2 px-2">Langsung ambil pesanan tanpa antri lama.</p>
                </div>
                <div class="flex flex-col items-center max-w-xs">
                    <div class="bg-green-100 rounded-full p-4 mb-3 inline-block w-20 h-20 flex items-center justify-center">
                        <i class="fas fa-check-circle text-4xl text-green-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 mb-1 text-sm uppercase">Kualitas Terjamin</h4>
                    <p class="text-xs text-gray-600 mb-2 px-2">Makanan fresh dan berkualitas.</p>
                </div>
            </div>
        </section>

        
        <section id="menu" class="py-16 bg-white">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-3">Menu Pilihan</h2>
                    <p class="text-gray-600 text-lg">Hidangan lezat dengan cita rasa original</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-red-600 via-yellow-500 to-red-600 mx-auto mt-4"></div>
                </div>

                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all transform hover:-translate-y-2 group flex flex-col h-full">
                            
                            <div class="relative overflow-hidden h-56 flex-shrink-0">
                                <img src="<?php echo e(asset($menu->gambar)); ?>" alt="<?php echo e($menu->namaMenu); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                
                                
                                <div class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold capitalize">
                                    <?php echo e($menu->kategori); ?>

                                </div>
                            </div>

                            
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-xl font-bold text-gray-800 mb-1"><?php echo e($menu->namaMenu); ?></h3>
                                
                                
                                <?php if($menu->reviews->count() > 0): ?>
                                    <div class="flex items-center gap-1 mb-2">
                                        <i class="fas fa-star text-yellow-500 text-sm"></i>
                                        <span class="text-sm font-semibold text-gray-700">
                                            <?php echo e(number_format($menu->reviews->avg('rating'), 1)); ?>

                                        </span>
                                        <span class="text-xs text-gray-500">(<?php echo e($menu->reviews->count()); ?>)</span>
                                    </div>
                                <?php endif; ?>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow">
                                    <?php echo e($menu->deskripsi); ?>

                                </p>
                                
                                <div class="flex items-center justify-between mt-auto">
                                    <span class="text-2xl font-bold text-red-600">
                                        Rp <?php echo e(number_format($menu->harga, 0, ',', '.')); ?>

                                    </span>
                                    <a href="<?php echo e(route('dashboard')); ?>" class="px-4 py-2 bg-red-600 text-white rounded-full font-semibold hover:bg-red-700 transition flex items-center gap-2">
                                        <i class="fas fa-shopping-bag"></i> Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-span-full text-center py-10">
                            <div class="inline-block p-4 rounded-full bg-gray-100 text-gray-400 mb-3">
                                <i class="fas fa-utensils text-4xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-600">Belum ada menu tersedia saat ini.</h3>
                            <p class="text-gray-500">Silakan kunjungi kami lagi nanti!</p>
                        </div>
                    <?php endif; ?>

                </div>

                
                <div class="text-center mt-12">
                    <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-red-600 to-yellow-500 text-white font-bold text-lg rounded-full shadow-xl hover:shadow-2xl transition transform hover:scale-105">
                        Lihat Semua Menu & Pesan
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    </main>

    
    <a href="<?php echo e(route('dashboard')); ?>" class="fixed bottom-4 right-4 z-50 group">
        <div class="md:hidden flex flex-col items-center"> 
            <div class="bg-kfc-red text-white rounded-full shadow-lg p-3 flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 mb-1"> 
                <i class="fas fa-shopping-cart"></i>
            </div> 
            <span class="text-kfc-red text-xs font-bold bg-white px-2 py-0.5 rounded shadow">Order</span> 
        </div>
        <div class="hidden md:flex bg-kfc-red text-white font-bold rounded-full shadow-lg p-4 items-center justify-center space-x-2 transform transition-transform duration-300 group-hover:scale-110"> 
            <i class="fas fa-shopping-cart text-xl"></i>
            <span class="pr-2">Order Now!</span> 
        </div>
    </a>

    
    <footer class="bg-[#1C1C1C] text-gray-400 py-10 px-4 mt-16">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-sm">
            <div class="md:col-span-1"> 
                <h4 class="font-bold text-white mb-3 uppercase">Alamat</h4>
                <p>Jl. Bunga, Geblagan, Tamantirto, Kec. Kasihan, Kabupaten Bantul,<br> Daerah Istimewa Yogyakarta 55184, Indonesia</p> 
                <p class="mt-2">Operating hours:<br> Weekday : 08:00 - 20:00<br> Weekend : 10:00 - 19:00</p> 
                <p class="mt-2">Telephone: <span class="font-semibold">14022</span></p> 
                <p>E-mail: info@burjominang.com</p> 
            </div>
            <div class="md:col-span-1"> 
                <h4 class="font-bold text-white mb-3 uppercase">Layanan</h4> 
                <ul class="space-y-1">
                    <li><a href="#" class="hover:text-white">Dine in</a></li> 
                    <li><a href="#" class="hover:text-white">Take Away</a></li> 
                </ul> 
            </div>
            <div class="md:col-span-1"> 
                <h4 class="font-bold text-white mb-3 uppercase">Info</h4> 
                <ul class="space-y-1"> 
                    <li><a href="#" class="hover:text-white">Contact Us</a></li> 
                    <li><a href="#" class="hover:text-white">About Us</a></li> 
                </ul> 
            </div>
            <div class="md:col-span-1">
                <h4 class="font-bold text-white mb-3 uppercase">Sosial Media</h4>
                <div class="flex space-x-4 mt-2">
                    <a href="https://www.instagram.com/burjominang/" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook text-2xl"></i></a>
                </div>
            </div>
        </div>
        <div class="container mx-auto mt-8 pt-8 border-t border-gray-700 text-center text-xs">
            © <?php echo e(date('Y')); ?> Burjo Minang | All rights reserved.
        </div>
    </footer>

</body>
</html><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/welcome.blade.php ENDPATH**/ ?>