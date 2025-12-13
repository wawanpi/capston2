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
    
    <?php
        $categories = [];
        if(isset($bestSellers) && $bestSellers->isNotEmpty()) {
            $categories[] = ['id' => 'best-seller', 'name' => 'Paling Laris', 'items' => $bestSellers];
        }
        if(isset($allFood) && $allFood->isNotEmpty()) {
            $categories[] = ['id' => 'makanan', 'name' => 'Makanan', 'items' => $allFood];
        }
        if(isset($allDrinks) && $allDrinks->isNotEmpty()) {
            $categories[] = ['id' => 'minuman', 'name' => 'Minuman', 'items' => $allDrinks];
        }
    ?>

    
    <div x-data="{ 
            activeSection: '<?php echo e($categories[0]['id'] ?? ''); ?>', 
            searchQuery: '',
            
            // --- MODAL STATE ---
            modalOpen: false,
            isLoading: false,
            // Tambahkan property rating ke object state
            selectedItem: { id: null, name: '', price: 0, image: '', desc: '', stok: 0, rating: 0 },
            quantity: 1,
            totalPrice: 0,

            // --- MODAL FUNCTIONS ---
            openModal(item) {
                this.selectedItem = item;
                this.quantity = 1;
                this.totalPrice = item.price;
                this.modalOpen = true;
                this.isLoading = true;
                
                setTimeout(() => { this.isLoading = false; }, 500);
            },
            closeModal() {
                this.modalOpen = false;
            },
            increment() {
                if (this.quantity < this.selectedItem.stok) {
                    this.quantity++;
                    this.updateTotal();
                }
            },
            decrement() {
                if (this.quantity > 1) {
                    this.quantity--;
                    this.updateTotal();
                }
            },
            updateTotal() {
                this.totalPrice = this.selectedItem.price * this.quantity;
            },
            formatPrice(value) {
                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
            }
         }" 
         x-init="
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) activeSection = entry.target.id;
                });
            }, { rootMargin: '-20% 0px -70% 0px' });
            document.querySelectorAll('.menu-section').forEach(section => observer.observe(section));
         "
         class="bg-gray-50 min-h-screen pb-32 relative">

        
        <div class="bg-white border-b border-gray-200 pt-6 pb-4">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h1 class="text-3xl font-black italic tracking-tighter text-gray-900 uppercase">MENU ORDER</h1>
                            <div class="flex items-center space-x-2 bg-green-50 border border-green-200 rounded-full px-3 py-1">
                                <span class="relative flex h-2 w-2">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                <span class="text-[10px] font-bold text-green-700 uppercase">Open</span>
                            </div>
                        </div>
                        <p class="text-gray-500 text-sm">Pilih menu favoritmu sekarang</p>
                    </div>
                    <div class="w-full md:w-72 relative">
                        <input type="text" x-model="searchQuery" placeholder="Cari menu..." class="w-full pl-10 pr-4 py-2 bg-gray-100 border-transparent focus:bg-white focus:border-red-500 focus:ring-red-500 rounded-xl text-sm transition-all shadow-sm">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </div>
                        <button x-show="searchQuery.length > 0" @click="searchQuery = ''" class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500" x-transition>
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="sticky top-20 z-30 bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto">
                <nav class="flex overflow-x-auto no-scrollbar py-3 px-4 gap-3 sm:gap-6 snap-x scroll-pl-4">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#<?php echo e($cat['id']); ?>" 
                           @click.prevent="document.getElementById('<?php echo e($cat['id']); ?>').scrollIntoView({behavior: 'smooth'})"
                           class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-bold transition-all duration-300 snap-start border"
                           :class="activeSection === '<?php echo e($cat['id']); ?>' ? 'bg-black text-white border-black shadow-md scale-105' : 'bg-gray-50 text-gray-500 border-gray-200 hover:bg-gray-100'">
                            <?php echo e($cat['name']); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </nav>
            </div>
        </div>

        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-16">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <section id="<?php echo e($category['id']); ?>" class="menu-section scroll-mt-40 transition-all duration-500">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="hidden sm:flex space-x-1 h-8">
                            <div class="w-2 bg-red-600 rounded-sm"></div>
                            <div class="w-2 bg-red-600 rounded-sm opacity-60"></div>
                            <div class="w-2 bg-red-600 rounded-sm opacity-30"></div>
                        </div>
                        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-wide border-l-4 border-red-600 sm:border-0 pl-3 sm:pl-0">
                            <?php echo e($category['name']); ?>

                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php $__currentLoopData = $category['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $stokSaatIni = $item->ketersediaanHariIni->jumlah_saat_ini ?? 0;
                                // Menyiapkan data JSON untuk Alpine
                                $itemData = [
                                    'id' => $item->id,
                                    'name' => $item->namaMenu,
                                    'price' => $item->harga,
                                    'image' => asset($item->gambar),
                                    'desc' => $item->deskripsi,
                                    'stok' => $stokSaatIni,
                                    'rating' => round($item->reviews_avg_rating ?? 0, 1) // Add Rating
                                ];
                            ?>

                            
                            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-row sm:flex-col h-36 sm:h-auto cursor-pointer"
                                 x-show="!searchQuery || '<?php echo e(strtolower($item->namaMenu)); ?>'.includes(searchQuery.toLowerCase())"
                                 x-transition
                                 @click="openModal(<?php echo e(json_encode($itemData)); ?>)"> 
                                
                                
                                <div class="w-1/3 sm:w-full sm:h-52 relative bg-gray-100 overflow-hidden">
                                    <img src="<?php echo e(asset($item->gambar)); ?>" alt="<?php echo e($item->namaMenu); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.src='https://placehold.co/400x300/f3f4f6/a3a3a3?text=No+Image'">
                                    
                                    
                                    <?php if($stokSaatIni <= 0): ?>
                                        <div class="absolute inset-0 bg-black/60 flex items-center justify-center z-10">
                                            <span class="text-white font-black text-sm sm:text-lg border-2 border-white px-2 py-1 rounded -rotate-12 tracking-widest opacity-90">HABIS</span>
                                        </div>
                                    <?php elseif($stokSaatIni < 10): ?>
                                        <div class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-sm z-10">Sisa <?php echo e($stokSaatIni); ?></div>
                                    <?php endif; ?>
                                    
                                    
                                    <div class="absolute bottom-2 left-2 bg-white/90 backdrop-blur-sm px-1.5 py-0.5 rounded-md flex items-center gap-1 shadow-sm z-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-orange-400 fill-orange-400" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        <span class="text-[10px] font-bold text-gray-800"><?php echo e(number_format($item->reviews_avg_rating ?? 0, 1)); ?></span>
                                    </div>
                                </div>

                                
                                <div class="w-2/3 sm:w-full p-4 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg leading-tight mb-1 line-clamp-1 <?php echo e($stokSaatIni <= 0 ? 'text-gray-400' : ''); ?>"><?php echo e($item->namaMenu); ?></h3>
                                        <p class="text-xs text-gray-500 line-clamp-2 mb-2 hidden sm:block"><?php echo e($item->deskripsi); ?></p>
                                    </div>
                                    <div class="flex items-end justify-between mt-auto">
                                        <span class="font-black text-gray-900 text-lg <?php echo e($stokSaatIni <= 0 ? 'text-gray-400' : ''); ?>">Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></span>
                                        
                                        
                                        <button class="<?php echo e($stokSaatIni <= 0 ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-red-600 text-gray-900 hover:text-white'); ?> rounded-full w-10 h-10 flex items-center justify-center transition-all shadow-sm active:scale-95"
                                                <?php echo e($stokSaatIni <= 0 ? 'disabled' : ''); ?>>
                                            <i data-lucide="plus" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <?php if(auth()->guard()->check()): ?>
        <?php if(\Cart::getTotalQuantity() > 0): ?>
        <div class="fixed bottom-0 left-0 w-full bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] z-40 border-t border-gray-100"
             x-transition:enter="transform transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0">
            
            <div class="container mx-auto px-4 py-3">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0">
                    <div class="hidden sm:flex items-center bg-gray-50 rounded-lg px-3 py-2 border border-gray-200 w-full sm:w-auto">
                        <div class="bg-green-100 p-1 rounded-full mr-3">
                            <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-gray-800">Order Anda Siap!</span>
                            <span class="text-[10px] text-gray-500">Silakan lanjutkan ke pembayaran</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between w-full sm:w-auto gap-6">
                        <div class="flex flex-col text-right">
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Total Pembayaran</span>
                            <span class="text-xl font-black text-gray-900">Rp <?php echo e(number_format(\Cart::getTotal(), 0, ',', '.')); ?></span>
                        </div>
                        <a href="<?php echo e(route('cart.list')); ?>" class="flex items-center gap-3 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-full font-bold shadow-lg shadow-red-200 transition-all active:scale-95">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                            <span>Checkout</span>
                            <span class="bg-white text-red-600 text-xs font-bold px-2 py-0.5 rounded-full ml-1"><?php echo e(\Cart::getTotalQuantity()); ?> item(s)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        
        <template x-teleport="body">
            <div x-show="modalOpen" style="display: none;" class="fixed inset-0 z-50 flex items-end sm:items-center justify-center sm:px-4">
                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     @click="closeModal()" class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

                <div x-show="modalOpen"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-4 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-full sm:translate-y-4 sm:scale-95"
                     class="relative bg-white w-full max-w-2xl max-h-[90vh] flex flex-col rounded-t-2xl sm:rounded-2xl shadow-2xl overflow-hidden">
                    
                    
                    <div class="flex justify-between items-center p-4 border-b border-gray-100 bg-white z-10">
                        <h3 class="text-lg font-black italic uppercase text-gray-800">Menu Detail</h3>
                        <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </div>

                    
                    <div class="flex-1 overflow-y-auto">
                        <div class="flex flex-col sm:flex-row h-full">
                            
                            <div class="w-full sm:w-5/12 bg-gray-50 relative min-h-[200px] sm:min-h-full">
                                <img :src="selectedItem.image" :alt="selectedItem.name" class="absolute inset-0 w-full h-full object-cover" onerror="this.src='https://placehold.co/400x300/f3f4f6/a3a3a3?text=No+Image'">
                                
                                
                                <div x-show="selectedItem.stok <= 0" class="absolute inset-0 bg-black/60 flex items-center justify-center z-10">
                                    <span class="text-white font-black text-xl border-2 border-white px-3 py-1 rounded -rotate-12 tracking-widest opacity-90">HABIS</span>
                                </div>
                            </div>

                            
                            <div class="w-full sm:w-7/12 p-5 sm:p-6 flex flex-col">
                                <h2 class="text-2xl font-black text-gray-900 mb-1 leading-tight" x-text="selectedItem.name"></h2>
                                
                                
                                <div class="flex items-center gap-1 mb-3">
                                    <div class="flex text-orange-400">
                                        <template x-for="i in 5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" :class="i <= Math.round(selectedItem.rating) ? 'fill-orange-400' : 'text-gray-300'" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                        </template>
                                    </div>
                                    <span class="text-sm font-bold text-gray-600" x-text="selectedItem.rating + ' / 5.0'"></span>
                                </div>

                                <p class="text-gray-500 text-sm leading-relaxed mb-4" x-text="selectedItem.desc"></p>

                                <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-3 mb-6">
                                    <div class="flex items-start gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-yellow-600 mt-0.5 shrink-0"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                                        <span class="text-xs text-yellow-800 font-medium">Makanan dimasak dadakan (fresh). Mohon menunggu sebentar setelah memesan.</span>
                                    </div>
                                </div>

                                <div class="mt-auto pt-4 border-t border-dashed border-gray-200">
                                    <span class="text-xs text-gray-400 uppercase font-bold tracking-wider">Harga Satuan</span>
                                    <div class="text-3xl font-black text-gray-900 mt-1" x-text="formatPrice(selectedItem.price)"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="p-4 sm:p-5 border-t border-gray-100 bg-white">
                        <form action="<?php echo e(route('cart.store')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" :value="selectedItem.id">
                            <input type="hidden" name="quantity" :value="quantity">

                            <div class="flex items-center gap-4">
                                
                                <div class="flex items-center justify-between border border-gray-300 rounded-full px-1 w-36 h-12 bg-white shrink-0" :class="selectedItem.stok <= 0 ? 'opacity-50 pointer-events-none' : ''">
                                    <button type="button" @click="decrement()" class="w-10 h-10 flex items-center justify-center rounded-full text-gray-400 hover:text-red-600 hover:bg-gray-50 transition" :disabled="quantity <= 1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/></svg>
                                    </button>
                                    <span class="font-bold text-lg text-gray-900 w-8 text-center select-none" x-text="quantity"></span>
                                    <button type="button" @click="increment()" class="w-10 h-10 flex items-center justify-center rounded-full text-red-600 hover:text-red-700 hover:bg-red-50 transition" :disabled="quantity >= selectedItem.stok">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                    </button>
                                </div>

                                
                                <button type="submit" 
                                        :disabled="selectedItem.stok <= 0"
                                        :class="selectedItem.stok <= 0 ? 'bg-gray-300 cursor-not-allowed shadow-none' : 'bg-red-600 hover:bg-red-700 shadow-red-200 active:scale-95'"
                                        class="flex-1 text-white h-12 rounded-full px-6 font-bold shadow-lg transition-all flex items-center justify-between">
                                    
                                    <span class="text-sm sm:text-base" x-text="selectedItem.stok <= 0 ? 'Stok Habis' : 'Add to Cart'"></span>
                                    <span class="bg-black/10 px-3 py-1 rounded-full text-sm font-black" x-show="selectedItem.stok > 0" x-text="formatPrice(totalPrice)"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
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