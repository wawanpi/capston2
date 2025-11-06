<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

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
            <h2 class="text-3xl font-extrabold text-gray-900 mb-6 uppercase">Hungry today? Let’s order</h2>
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

        <!-- 5. MENU TERLARIS (Best Seller) -->
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-3 h-10 bg-kfc-red"></span>
                        <span class="w-3 h-10 bg-kfc-red"></span>
                        <span class="w-3 h-10 bg-kfc-red"></span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-gray-900 uppercase">Best Seller</h3>
                </div>
                
            </div>
            
            <?php if(!isset($bestSellers) || $bestSellers->isEmpty()): ?>
                <p class="text-gray-500">Saat ini belum ada menu terlaris.</p>
            <?php else: ?>
                <div class="flex space-x-6 overflow-x-auto pb-4 no-scrollbar">
                    <?php $__currentLoopData = $bestSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white border rounded-lg overflow-hidden shadow-lg flex-shrink-0 w-80">
                            <img class="w-full h-48 object-cover" 
                                 src="<?php echo e(asset($menu->gambar)); ?>" 
                                 alt="<?php echo e($menu->namaMenu); ?>"
                                 onerror="this.src='https://placehold.co/320x192/e2e8f0/e2e8f0?text=IMG'">
                            
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
        
        <!-- 6. SEMUA MAKANAN -->
        <section class="mb-12">
             <div class="flex justify-between items-center mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-3 h-10 bg-kfc-red"></span>
                        <span class="w-3 h-10 bg-kfc-red"></span>
                        <span class="w-3 h-10 bg-kfc-red"></span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-gray-900 uppercase">Semua Makanan</h3>
                </div>
                
            </div>
            
            <?php if(!isset($allFood) || $allFood->isEmpty()): ?>
                <p class="text-gray-500">Saat ini belum ada menu makanan.</p>
            <?php else: ?>
                <div class="flex space-x-6 overflow-x-auto pb-4 no-scrollbar">
                    <?php $__currentLoopData = $allFood; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white border rounded-lg overflow-hidden shadow-lg flex-shrink-0 w-80">
                            <img class="w-full h-48 object-cover" 
                                 src="<?php echo e(asset($menu->gambar)); ?>" 
                                 alt="<?php echo e($menu->namaMenu); ?>"
                                 onerror="this.src='https://placehold.co/320x192/e2e8f0/e2e8f0?text=IMG'">
                            
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

        <!-- 7. SEMUA MINUMAN (BAGIAN BARU) -->
        <section class="mb-12">
             <div class="flex justify-between items-center mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-3 h-10 bg-kfc-red"></span>
                        <span class="w-3 h-10 bg-kfc-red"></span>
                        <span class="w-3 h-10 bg-kfc-red"></span>
                    </div>
                    <h3 class="text-3xl font-extrabold text-gray-900 uppercase">Semua Minuman</h3>
                </div>
                 
            </div>
            
            <?php if(!isset($allDrinks) || $allDrinks->isEmpty()): ?>
                <p class="text-gray-500">Saat ini belum ada menu minuman.</p>
            <?php else: ?>
                <div class="flex space-x-6 overflow-x-auto pb-4 no-scrollbar">
                    <?php $__currentLoopData = $allDrinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white border rounded-lg overflow-hidden shadow-lg flex-shrink-0 w-80">
                            <img class="w-full h-48 object-cover" 
                                 src="<?php echo e(asset($menu->gambar)); ?>" 
                                 alt="<?php echo e($menu->namaMenu); ?>"
                                 onerror="this.src='https://placehold.co/320x192/e2e8f0/e2e8f0?text=IMG'">
                            
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

        <!-- 8. APP DOWNLOAD SECTION (sebelumnya section 7) -->
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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/dashboard.blade.php ENDPATH**/ ?>