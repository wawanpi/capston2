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
            <?php echo e(__('Manajemen Menu')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <a href="<?php echo e(route('admin.menus.create')); ?>" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Tambah Menu
                </a>
                <form method="GET" action="<?php echo e(route('admin.menus.index')); ?>">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Cari nama menu..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="<?php echo e(request('search')); ?>">
                        <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            <?php if($message = Session::get('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e($message); ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Menu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php if($menu->gambar): ?>
                                            
                                            <img src="<?php echo e(asset($menu->gambar)); ?>" alt="<?php echo e($menu->namaMenu); ?>" class="w-16 h-16 object-cover rounded">
                                        <?php else: ?>
                                            <span class="text-xs text-gray-400">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($menu->namaMenu); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp <?php echo e(number_format($menu->harga, 2, ',', '.')); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($menu->stok); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="<?php echo e(route('admin.menus.edit', $menu->id)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="<?php echo e(route('admin.menus.destroy', $menu->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada menu.</td>
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>

<?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views\admin\menus\index.blade.php ENDPATH**/ ?>