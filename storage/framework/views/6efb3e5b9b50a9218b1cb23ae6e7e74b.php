<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .bg-kfc-red { background-color: #E3002B; }
        .text-kfc-red { color: #E3002B; }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="bg-gray-50 font-sans flex flex-col min-h-screen" x-data="{ sidebarOpen: false, profileOpen: false }">

    
    <div class="no-print">
        <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <main class="pt-20 flex-grow <?php echo e(Auth::check() && Auth::user()->hasRole('admin') ? 'lg:pl-64' : ''); ?> transition-all duration-300"> 
        <?php echo e($slot); ?>

    </main>
    
    
    
    
    <footer class="bg-gray-900 text-gray-300 py-6 mt-auto no-print <?php echo e(Auth::check() && Auth::user()->hasRole('admin') ? 'lg:pl-64' : ''); ?> transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                
                <div>
                    <h4 class="text-sm font-bold text-white mb-3">BURJO MINANG</h4>
                    <p class="text-xs leading-relaxed mb-2">Jl. Bunga, Geblagan, Tamantirto, Kec. Kasihan, Kab. Bantul, DIY 55184</p>
                    <p class="text-xs leading-relaxed">Open: 08.00 - 20.00 (Weekday)<br>10.00 - 19.00 (Weekend)</p>
                </div>

                
                <div>
                    <h4 class="text-sm font-bold text-white mb-3">SERVICES</h4>
                    <ul class="space-y-1 text-xs">
                        <li><a href="#" class="hover:text-white">Dine-In</a></li>
                        <li><a href="#" class="hover:text-white">Take Away</a></li>
                        <li><a href="#" class="hover:text-white">Delivery</a></li>
                    </ul>
                </div>

                
                <div>
                    <h4 class="text-sm font-bold text-white mb-3">INFO</h4>
                    <ul class="space-y-1 text-xs">
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                    </ul>
                </div>

                
                <div>
                    <h4 class="text-sm font-bold text-white mb-3">AVAILABLE ON</h4>
                    <div class="flex flex-col gap-2">
                        <a href="#" class="opacity-90 hover:opacity-100 transition-opacity">
                            <img src="<?php echo e(asset('img/google-play.png')); ?>" alt="Get it on Google Play" class="h-10 w-auto object-contain">
                        </a>
                        <a href="#" class="opacity-90 hover:opacity-100 transition-opacity">
                            <img src="<?php echo e(asset('img/app-store.png')); ?>" alt="Download on the App Store" class="h-9 w-auto object-contain">
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p class="mb-4 md:mb-0">&copy; <?php echo e(date('Y')); ?> Burjo Minang. All rights reserved.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                    <a href="https://www.instagram.com/burjominang/" class="hover:text-white"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                    <a href="#" class="hover:text-white"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <?php if(auth()->guard()->check()): ?>
        <?php if(!Auth::user()->hasRole('admin')): ?>
            <a href="<?php echo e(route('cart.list')); ?>" class="fixed bottom-16 right-4 z-30 bg-kfc-red p-4 rounded-full shadow-lg group no-print hover:scale-105 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.023.828l1.25 5.001A2.25 2.25 0 0 0 6.095 12H17.25a2.25 2.25 0 0 0 2.22-1.87l.46-4.885A1.125 1.125 0 0 0 18.72 4.125H5.111M7.5 18a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm10.5 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
                <?php if(\Cart::getTotalQuantity() > 0): ?>
                    <span class="absolute -top-2 -right-2 bg-white text-kfc-red text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center"><?php echo e(\Cart::getTotalQuantity()); ?></span>
                <?php endif; ?>
            </a>
            <button class="fixed bottom-4 right-4 z-30 no-print hover:scale-105 transition-transform">
                <img src="https://kfcindonesia.com/static/media/bucket-list-icon.1139e8c3.png" alt="Prize" class="w-16 h-16">
            </button>
        <?php endif; ?>
    <?php endif; ?>
    
    <script>
        lucide.createIcons();
    </script>
    <?php echo e($scripts ?? ''); ?>


</body>
</html><?php /**PATH C:\Users\PREDATOR\Documents\KULIAH\semester 7\capston2\resources\views/layouts/app.blade.php ENDPATH**/ ?>