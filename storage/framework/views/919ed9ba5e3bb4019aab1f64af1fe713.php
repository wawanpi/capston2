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
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Manajemen Menu')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                
                
                <a href="<?php echo e(route('admin.menus.create')); ?>" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                    Tambah Menu
                </a>
                
                
                <form method="GET" action="<?php echo e(route('admin.menus.index')); ?>" id="searchForm">
                    <div class="flex">
                        <input 
                            type="text"
                            name="search"
                            placeholder="Cari nama menu..."
                            class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm"
                            value="<?php echo e(request('search')); ?>"
                            id="searchInput"
                        >
                    </div>
                    </div>
                </form>
            </div>



            
            <?php if($message = Session::get('success')): ?>
                <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e($message); ?></span>
                </div>
            <?php endif; ?>

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Gambar</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Nama Menu</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Rating</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-200 uppercase tracking-wider">Kapasitas Harian</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-200 uppercase tracking-wider">Jumlah Hari Ini</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-200 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-gray-50">
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if($menu->gambar): ?>
                                                <img src="<?php echo e(asset($menu->gambar)); ?>" 
                                                     alt="<?php echo e($menu->namaMenu); ?>" 
                                                     class="w-16 h-16 object-cover rounded"
                                                     onerror="this.src='https://placehold.co/64x64/e2e8f0/e2e8f0?text=IMG'">
                                            <?php else: ?>
                                                <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center">
                                                    <span class="text-xs text-gray-400">No Image</span>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($menu->namaMenu); ?></td>
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <?php if($menu->kategori == 'makanan'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-800 text-white">Makanan</span>
                                            <?php elseif($menu->kategori == 'minuman'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">Minuman</span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp <?php echo e(number_format($menu->harga, 0, ',', '.')); ?></td>
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center">
                                                <span class="font-bold text-red-600 mr-1"><?php echo e(number_format($menu->average_rating, 1)); ?></span>
                                                <span class="text-xs text-gray-500"> (<?php echo e($menu->ratings_count); ?> ulasan)</span>
                                            </div>
                                        </td>
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            <?php echo e($menu->kapasitas); ?>

                                        </td>
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <?php
                                                $jumlahRiil = $menu->jumlah_saat_ini;
                                                $isLow = $jumlahRiil < 10 && $jumlahRiil > 0;
                                                $isHabis = $jumlahRiil <= 0;
                                            ?>
                                            
                                            <?php if($isHabis): ?>
                                                
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-red-600 text-white shadow-md">
                                                    HABIS
                                                </span>
                                            <?php elseif($isLow): ?>
                                                
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-200 text-gray-800 border border-gray-300">
                                                    <?php echo e($jumlahRiil); ?> (Jumlah Rendah)
                                                </span>
                                            <?php else: ?>
                                                <span class="text-gray-900 font-semibold">
                                                    <?php echo e($jumlahRiil); ?>

                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2 items-center justify-center">
                                            
                                            
                                            <a href="<?php echo e(route('admin.menus.show', $menu->id)); ?>" class="text-gray-600 hover:text-gray-900 border border-gray-300 p-1 rounded-md text-xs font-semibold">
                                                Ulasan
                                            </a>
                                            
                                            
                                            <a href="<?php echo e(route('admin.menus.edit', $menu->id)); ?>" class="text-red-600 hover:text-red-800 border border-gray-300 p-1 rounded-md text-xs font-semibold">
                                                Edit
                                            </a>
                                            
                                            
                                            <form action="<?php echo e(route('admin.menus.destroy', $menu->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" class="m-0">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                
                                                <button type="submit" class="text-gray-600 hover:text-red-600 border border-gray-300 p-1 rounded-md text-xs font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada menu.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <?php echo e($menus->withQueryString()->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        document.getElementById('searchForm').submit();
    });
</script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\Capstone\capstone 2\capston2\resources\views/admin/menus/index.blade.php ENDPATH**/ ?>