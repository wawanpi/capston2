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
            <?php echo e(__('Detail Pesanan #')); ?><?php echo e($pesanan->id); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <?php if($message = Session::get('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e($message); ?></span>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                         <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h3>
                            <p><strong>Pelanggan:</strong> <?php echo e($pesanan->user->name); ?></p>
                            <p><strong>Email:</strong> <?php echo e($pesanan->user->email); ?></p>
                            <p><strong>Tanggal Pesan:</strong> <?php echo e($pesanan->created_at->format('d M Y, H:i')); ?></p>
                            <p><strong>Total Bayar:</strong> <span class="font-bold">Rp <?php echo e(number_format($pesanan->total_bayar, 0, ',', '.')); ?></span></p>
                            <p><strong>Status Saat Ini:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php if($pesanan->status == 'pending'): ?> bg-yellow-100 text-yellow-800 <?php endif; ?>
                                    <?php if($pesanan->status == 'processing'): ?> bg-blue-100 text-blue-800 <?php endif; ?>
                                    <?php if($pesanan->status == 'completed'): ?> bg-green-100 text-green-800 <?php endif; ?>
                                    <?php if($pesanan->status == 'cancelled'): ?> bg-red-100 text-red-800 <?php endif; ?>
                                "><?php echo e(ucfirst($pesanan->status)); ?></span>
                            </p>
                        </div>
                        <div class="p-6">
                             <h3 class="text-lg font-semibold mb-4">Ubah Status Pesanan</h3>
                             <form action="<?php echo e(route('admin.pesanan.updateStatus', $pesanan->id)); ?>" method="POST">
                                 <?php echo csrf_field(); ?>
                                 <?php echo method_field('PUT'); ?>
                                 <div class="flex items-center">
                                     <select name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                         <option value="pending" <?php echo e($pesanan->status == 'pending' ? 'selected' : ''); ?>>Pending (Menunggu diproses)</option>
                                         <option value="processing" <?php echo e($pesanan->status == 'processing' ? 'selected' : ''); ?>>Processing (Sedang dibuat)</option>
                                         <option value="completed" <?php echo e($pesanan->status == 'completed' ? 'selected' : ''); ?>>Completed (Siap diambil)</option>
                                         <option value="cancelled" <?php echo e($pesanan->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled (Dibatalkan)</option>
                                     </select>
                                     <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'ml-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'ml-4']); ?>Update <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                                 </div>
                             </form>
                        </div>
                    </div>
                </div>

                
                <div class="md:col-span-1">
                     <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Item yang Dipesan</h3>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex justify-between items-start border-b pb-2">
                                        <div>
                                            <p class="font-semibold"><?php echo e($item->menu->namaMenu); ?></p>
                                            <p class="text-sm text-gray-600"><?php echo e($item->jumlah); ?> x Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></p>
                                        </div>
                                        <p class="text-sm font-semibold text-gray-800">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="mt-6">
                <a href="<?php echo e(route('admin.pesanan.index')); ?>" class="text-indigo-600 hover:text-indigo-900">&larr; Kembali ke Daftar Pesanan</a>
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
<?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/admin/pesanan/show.blade.php ENDPATH**/ ?>