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
            
            <!-- Card 1: Ringkasan Status & Total -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Ringkasan Pesanan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">ID Pesanan</p>
                            <p class="font-semibold text-lg">#<?php echo e($pesanan->id); ?></p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Pesan</p>
                            <p class="font-semibold text-lg"><?php echo e($pesanan->created_at->format('d M Y, H:i')); ?></p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status Pesanan</p>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                <?php if($pesanan->status == 'pending'): ?> bg-yellow-100 text-yellow-800 <?php endif; ?>
                                <?php if($pesanan->status == 'processing'): ?> bg-blue-100 text-blue-800 <?php endif; ?>
                                <?php if($pesanan->status == 'completed'): ?> bg-green-100 text-green-800 <?php endif; ?>
                                <?php if($pesanan->status == 'cancelled'): ?> bg-red-100 text-red-800 <?php endif; ?>
                            ">
                                <?php echo e(ucfirst($pesanan->status)); ?>

                            </span>
                        </div>
                         <div>
                            <p class="text-sm font-medium text-gray-500">Total Pembayaran</p>
                            <p class="font-semibold text-lg text-kfc-red">Rp <?php echo e(number_format($pesanan->total_bayar, 0, ',', '.')); ?></p>
                        </div>
                    </div>
                     <?php if($pesanan->catatan_pelanggan): ?>
                        <div class="mt-4 pt-4 border-t">
                            <p class="text-sm font-medium text-gray-500">Catatan Anda:</p>
                            <p class="text-gray-700 italic">"<?php echo e($pesanan->catatan_pelanggan); ?>"</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Card 2: Rincian Item -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Item yang Dipesan</h3>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex justify-between items-center border-b pb-3">
                                <div class="flex items-center">
                                    <img src="<?php echo e(asset($item->menu->gambar)); ?>" alt="<?php echo e($item->menu->namaMenu); ?>" class="w-16 h-16 object-cover rounded mr-4">
                                    <div>
                                        <p class="font-semibold"><?php echo e($item->menu->namaMenu); ?></p>
                                        <p class="text-sm text-gray-600"><?php echo e($item->jumlah); ?> x Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></p>
                                    </div>
                                </div>
                                <p class="text-md font-semibold text-gray-800">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="<?php echo e(route('orders.index')); ?>" class="text-indigo-600 hover:text-indigo-900">&larr; Kembali ke Riwayat Pesanan</a>
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

<?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/order-detail.blade.php ENDPATH**/ ?>