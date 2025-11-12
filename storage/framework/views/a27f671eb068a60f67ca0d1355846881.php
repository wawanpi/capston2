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
            <?php echo e(__('Kelola Pesanan')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                    
                                    
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Dipesan</th>
                                    
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe Layanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Tamu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__empty_1 = true; $__currentLoopData = $pesanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo e($pesanan->id); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($pesanan->user->name); ?></td>
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            
                                            <?php if($pesanan->relationLoaded('details')): ?>
                                                <ul class="list-disc list-inside">
                                                    <?php $__currentLoopData = $pesanan->details->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <?php echo e($detail->menu->namaMenu ?? 'Menu Dihapus'); ?> 
                                                            <span class="font-semibold"> (x<?php echo e($detail->jumlah); ?>)</span>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($pesanan->details->count() > 2): ?>
                                                        <li class="italic text-xs text-gray-400">+ <?php echo e($pesanan->details->count() - 2); ?> item lainnya...</li>
                                                    <?php endif; ?>
                                                </ul>
                                            <?php else: ?>
                                                <span class="text-red-500 text-xs italic">(Error: Relasi 'details' belum di-load)</span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php if($pesanan->tipe_layanan == 'Dine-in'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                    Dine-in
                                                </span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Take Away
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php if($pesanan->tipe_layanan == 'Dine-in'): ?>
                                                <?php echo e($pesanan->jumlah_tamu); ?> orang
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                <?php if($pesanan->status == 'pending'): ?> bg-yellow-100 text-yellow-800 <?php endif; ?>
                                                <?php if($pesanan->status == 'processing'): ?> bg-blue-100 text-blue-800 <?php endif; ?>
                                                <?php if($pesanan->status == 'completed'): ?> bg-green-100 text-green-800 <?php endif; ?>
                                                <?php if($pesanan->status == 'cancelled'): ?> bg-red-100 text-red-800 <?php endif; ?>
                                            "><?php echo e($pesanan->status); ?></span>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="<?php echo e(route('admin.pesanan.show', $pesanan->id)); ?>" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada pesanan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="mt-4">
                            <?php echo e($pesanans->links()); ?>

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
<?php endif; ?><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/admin/pesanan/index.blade.php ENDPATH**/ ?>