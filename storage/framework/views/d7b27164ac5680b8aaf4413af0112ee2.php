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
            <?php echo e(__('Konfirmasi Checkout')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <form action="<?php echo e(route('checkout.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Kolom Kiri: Detail Item -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h3>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex justify-between items-start border-b pb-2">
                                    <div class="flex items-center">
                                        <img src="<?php echo e(asset($item->attributes->image)); ?>" alt="<?php echo e($item->name); ?>" class="w-16 h-16 object-cover rounded mr-4">
                                        <div>
                                            <p class="font-semibold"><?php echo e($item->name); ?></p>
                                            <p class="text-sm text-gray-600"><?php echo e($item->quantity); ?> x Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></p>
                                        </div>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-800">Rp <?php echo e(number_format($item->getPriceSum(), 0, ',', '.')); ?></p>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="mt-6 pt-4 border-t">
                                <div class="flex justify-between items-center text-lg font-bold">
                                    <span>Total Bayar:</span>
                                    <span>Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Tipe Layanan, Catatan & Tombol Bayar -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6 text-gray-900">
                            
                            
                            <h3 class="text-xl font-semibold mb-4">Pilih Tipe Layanan</h3>
                            <div class="flex space-x-4 mb-6">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer flex-1">
                                    <input type="radio" name="tipe_layanan" value="Take Away" class="mr-2 text-kfc-red focus:ring-kfc-red" checked>
                                    <span class="font-semibold">Ambil di Tempat (Take Away)</span>
                                </label>
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer flex-1">
                                    <input type="radio" name="tipe_layanan" value="Dine-in" class="mr-2 text-kfc-red focus:ring-kfc-red">
                                    <span class="font-semibold">Makan di Tempat (Dine-in)</span>
                                </label>
                            </div>
                            

                             <h3 class="text-xl font-semibold mb-4">Detail Tambahan</h3>
                            
                            
                            <div>
                                <label for="catatan_pelanggan" class="block text-sm font-medium text-gray-700">Catatan untuk Penjual (Opsional)</label>
                                <textarea name="catatan_pelanggan" id="catatan_pelanggan" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: Nasi ayamnya tolong yang pedas..."></textarea>
                            </div>

                            
                            <div class="mt-6">
                                <h4 class="text-lg font-semibold">Metode Pembayaran</h4>
                                <div class="mt-2 p-4 bg-gray-100 rounded-lg">
                                    <p class="font-semibold">Pembayaran di Tempat</p>
                                    <p class="text-sm text-gray-600">Sistem ini hanya untuk booking. Silakan lakukan pembayaran di kasir saat mengambil pesanan Anda.</p>
                                </div>
                            </div>

                            
                            <div class="mt-6">
                                <button type="submit" class="w-full inline-flex justify-center px-6 py-3 bg-kfc-red border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-700">
                                    Konfirmasi & Buat Pesanan
                                </button>
                                 <a href="<?php echo e(route('cart.list')); ?>" class="w-full inline-block text-center mt-3 px-6 py-3 text-sm text-gray-600 hover:text-gray-900">
                                    Kembali ke Keranjang
                                </a>
                            </div>
                         </div>
                    </div>

                </div>
            </form>
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
<?php endif; ?><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/checkout.blade.php ENDPATH**/ ?>