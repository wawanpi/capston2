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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Detail Menu: ')); ?><?php echo e($menu->namaMenu); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informasi Menu</h3>
                            
                            <?php if($menu->gambar): ?>
                                <img src="<?php echo e(asset($menu->gambar)); ?>" 
                                     alt="<?php echo e($menu->namaMenu); ?>" 
                                     class="w-full h-48 object-cover rounded mb-4"
                                     onerror="this.src='https://placehold.co/400x300/e2e8f0/e2e8f0?text=No+Image'">
                            <?php endif; ?>

                            <p><strong>Kategori:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php echo e($menu->kategori == 'makanan' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'); ?>">
                                    <?php echo e(ucfirst($menu->kategori)); ?>

                                </span>
                            </p>
                            <p><strong>Harga:</strong> Rp <?php echo e(number_format($menu->harga, 0, ',', '.')); ?></p>
                            <p><strong>Stok Saat Ini:</strong> 
                                <span class="font-bold <?php echo e($menu->stok <= 10 ? 'text-red-500' : 'text-green-500'); ?>"><?php echo e($menu->stok); ?></span>
                            </p>
                            <p class="mt-4"><strong>Deskripsi:</strong> <br><?php echo e($menu->deskripsi); ?></p>

                            <div class="mt-6 flex justify-between">
                                <a href="<?php echo e(route('admin.menus.edit', $menu->id)); ?>" class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit Menu</a>
                                <a href="<?php echo e(route('admin.menus.index')); ?>" class="text-gray-600 hover:text-gray-900">&larr; Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Analitik Ulasan</h3>
                            
                            
                            <div class="flex items-center mb-4">
                                <p class="text-4xl font-bold text-yellow-500"><?php echo e($menu->average_rating ?? '0.0'); ?></p>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500">Rata-rata dari</p>
                                    <p class="text-xl font-semibold"><?php echo e($menu->ratings_count ?? 0); ?> Ulasan</p>
                                </div>
                            </div>

                            <h4 class="font-semibold mt-6 mb-3">Semua Ulasan Pelanggan:</h4>
                            
                            
                            <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                                <?php $__empty_1 = true; $__currentLoopData = $menu->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="border-b pb-3">
                                        <p class="font-semibold text-gray-800"><?php echo e($review->user->name); ?></p>
                                        <div class="flex items-center text-sm text-yellow-500 my-1">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <svg class="w-4 h-4" fill="<?php echo e($review->rating >= $i ? 'currentColor' : 'none'); ?>" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 7.91-.01L12 2z"/>
                                                </svg>
                                            <?php endfor; ?>
                                            <span class="ml-2 text-xs text-gray-500">(<?php echo e($review->created_at->diffForHumans()); ?>)</span>
                                        </div>
                                        <p class="text-gray-700 text-sm italic">"<?php echo e($review->komentar ?? 'Tidak ada komentar.'); ?>"</p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-gray-500">Menu ini belum memiliki ulasan.</p>
                                <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
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
<?php endif; ?><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/admin/menus/show.blade.php ENDPATH**/ ?>