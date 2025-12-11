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
            selectedItem: { id: null, name: '', price: 0, image: '', desc: '', stok: 0 },
            quantity: 1,
            totalPrice: 0,

            // --- MODAL FUNCTIONS ---
            openModal(item) {
                this.selectedItem = item;
                this.quantity = 1;
                this.totalPrice = item.price; // Set harga awal
                this.modalOpen = true;
                this.isLoading = true;
                
                // Simulasi Skeleton Loading (0.8 detik)
                setTimeout(() => { this.isLoading = false; }, 800);
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
                            <div class="w-2 bg-kfc-red rounded-sm"></div>
                            <div class="w-2 bg-kfc-red rounded-sm opacity-60"></div>
                            <div class="w-2 bg-kfc-red rounded-sm opacity-30"></div>
                        </div>
                        <h2 class="text-2xl font-black text-gray-900 uppercase tracking-wide border-l-4 border-kfc-red sm:border-0 pl-3 sm:pl-0">
                            <?php echo e($category['name']); ?>

                        </h2>
                    </div>

                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        <?php $__currentLoopData = $category['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                // Menyiapkan object data untuk dikirim ke JS
                                $itemData = [
                                    'id' => $item->id,
                                    'name' => $item->namaMenu,
                                    'price' => $item->harga,
                                    'image' => asset($item->gambar),
                                    'desc' => $item->deskripsi,
                                    'stok' => $item->ketersediaanHariIni->jumlah_saat_ini ?? 0
                                ];
                            ?>

                            
                            <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-row sm:flex-col h-36 sm:h-auto cursor-pointer"
                                 x-show="!searchQuery || '<?php echo e(strtolower($item->namaMenu)); ?>'.includes(searchQuery.toLowerCase())"
                                 x-transition
                                 @click="openModal(<?php echo e(json_encode($itemData)); ?>)"> 
                                
                                <div class="w-1/3 sm:w-full sm:h-52 relative bg-gray-100 overflow-hidden">
                                    <img src="<?php echo e(asset($item->gambar)); ?>" alt="<?php echo e($item->namaMenu); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.src='https://placehold.co/400x300/f3f4f6/a3a3a3?text=No+Image'">
                                    <?php if(($item->ketersediaanHariIni->jumlah_saat_ini ?? 0) < 10): ?>
                                        <div class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-sm">Sisa <?php echo e($item->ketersediaanHariIni->jumlah_saat_ini ?? 0); ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="w-2/3 sm:w-full p-4 flex flex-col justify-between">
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg leading-tight mb-1 line-clamp-1"><?php echo e($item->namaMenu); ?></h3>
                                        <p class="text-xs text-gray-500 line-clamp-2 mb-2 hidden sm:block"><?php echo e($item->deskripsi); ?></p>
                                    </div>
                                    <div class="flex items-end justify-between mt-auto">
                                        <span class="font-black text-gray-900 text-lg">Rp <?php echo e(number_format($item->harga, 0, ',', '.')); ?></span>
                                        <button class="bg-gray-100 hover:bg-kfc-red text-gray-900 hover:text-white rounded-full w-10 h-10 flex items-center justify-center transition-all shadow-sm active:scale-95">
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

                        <a href="<?php echo e(route('cart.list')); ?>" class="flex items-center gap-3 bg-kfc-red hover:bg-red-700 text-white px-6 py-3 rounded-full font-bold shadow-lg shadow-red-200 transition-all active:scale-95">
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                            <span>Checkout</span>
                            <span class="bg-white text-kfc-red text-xs font-bold px-2 py-0.5 rounded-full ml-1"><?php echo e(\Cart::getTotalQuantity()); ?> item(s)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>

        
        <template x-teleport="body">
            <div 
                x-show="modalOpen" 
                style="display: none;" 
                class="fixed inset-0 z-50 flex items-center justify-center px-4 sm:px-0"
            >
                
                <div 
                    x-show="modalOpen"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click="closeModal()"
                    class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"
                ></div>

                
                <div 
                    x-show="modalOpen"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative bg-white rounded-t-2xl sm:rounded-2xl overflow-hidden shadow-2xl transform transition-all w-full max-w-2xl max-h-[90vh] flex flex-col"
                >
                    
                    <div class="flex justify-between items-center p-4 border-b border-gray-100">
                        <h3 class="text-lg font-black italic uppercase text-gray-800">MENU DETAILS</h3>
                        <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100 transition">
                            <i data-lucide="x" class="w-6 h-6"></i>
                        </button>
                    </div>

                    
                    <div class="flex-1 overflow-y-auto p-0 sm:p-6">
                        <div class="flex flex-col sm:flex-row gap-6">
                            
                            <div class="w-full sm:w-1/2 bg-gray-50 flex items-center justify-center p-4 sm:rounded-xl">
                                <img :src="selectedItem.image" :alt="selectedItem.name" class="w-full max-w-[200px] sm:max-w-full object-cover rounded-lg shadow-sm">
                            </div>

                            
                            <div class="w-full sm:w-1/2 px-4 sm:px-0">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2" x-text="selectedItem.name"></h2>
                                <p class="text-gray-500 text-sm leading-relaxed mb-6" x-text="selectedItem.desc"></p>

                                
                                <div x-show="isLoading" class="space-y-3">
                                    <div class="h-4 bg-gray-200 rounded animate-pulse w-3/4"></div>
                                    <div class="h-4 bg-gray-200 rounded animate-pulse w-1/2"></div>
                                    <div class="h-4 bg-gray-200 rounded animate-pulse w-full"></div>
                                </div>

                                
                                <div x-show="!isLoading">
                                    <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-3 mb-4">
                                        <span class="text-xs text-yellow-800 font-semibold flex items-center gap-2">
                                            <i data-lucide="info" class="w-4 h-4"></i>
                                            Note: Makanan dimasak dadakan (fresh).
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-2xl font-black text-gray-900" x-text="formatPrice(totalPrice)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="p-4 border-t border-gray-100 bg-white flex flex-col sm:flex-row items-center gap-4">
                        
                        <div class="flex items-center justify-between w-full sm:w-auto gap-4 border border-gray-300 rounded-full px-4 py-2">
                            <button @click="decrement()" class="text-gray-500 hover:text-red-600 disabled:opacity-50 transition" :disabled="quantity <= 1">
                                <i data-lucide="minus" class="w-5 h-5"></i>
                            </button>
                            <span class="font-bold text-lg w-8 text-center" x-text="quantity"></span>
                            <button @click="increment()" class="text-red-600 hover:text-red-800 disabled:opacity-50 transition" :disabled="quantity >= selectedItem.stok">
                                <i data-lucide="plus" class="w-5 h-5"></i>
                            </button>
                        </div>

                        
                        <form action="<?php echo e(route('cart.store')); ?>" method="POST" class="w-full">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" :value="selectedItem.id">
                            <input type="hidden" name="quantity" :value="quantity">
                            
                            <button type="submit" 
                                    class="w-full bg-kfc-red hover:bg-red-700 text-white font-bold py-3 px-6 rounded-full shadow-lg shadow-red-200 transition-all active:scale-95 flex justify-between items-center"
                                    :disabled="selectedItem.stok <= 0">
                                <span>Add to Cart</span>
                                <span x-text="formatPrice(totalPrice)"></span>
                            </button>
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
<?php endif; ?><?php /**PATH D:\Capstone\capstone 2\capston2\resources\views/dashboard.blade.php ENDPATH**/ ?>