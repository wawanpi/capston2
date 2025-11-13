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
            <?php echo e(__('Keranjang Belanja Anda')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <?php if($message = Session::get('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline"><?php echo e($message); ?></span>
                        </div>
                    <?php endif; ?>
                     <?php if($message = Session::get('error')): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline"><?php echo e($message); ?></span>
                        </div>
                    <?php endif; ?>

                    <h3 class="text-2xl font-semibold mb-4">Total Item: <?php echo e(Cart::getTotalQuantity()); ?></h3>

                    <?php if(!Cart::isEmpty()): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 mb-6">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-16">
                                                <?php if($item->attributes->image): ?>
                                                    
                                                    <img class="h-16 w-16 rounded-md object-cover" src="<?php echo e(asset($item->attributes->image)); ?>" alt="<?php echo e($item->name); ?>">
                                                <?php else: ?>
                                                    <div class="h-16 w-16 rounded-md bg-gray-200 flex items-center justify-center">
                                                        <span class="text-xs text-gray-500">No Img</span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900"><?php echo e($item->name); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="<?php echo e(route('cart.update')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($item->id); ?>" >
                                            <div class="flex items-center">
                                                <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" class="w-20 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" min="1"/>
                                                <button type="submit" class="ml-2 inline-flex items-center px-3 py-1 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600">Update</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">
                                        Rp <?php echo e(number_format($item->getPriceSum(), 0, ',', '.')); ?>

                                    </td>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="<?php echo e(route('cart.remove')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" value="<?php echo e($item->id); ?>" name="id">
                                            <button class="px-3 py-1 text-xs text-white bg-red-600 rounded-md hover:bg-red-700">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center mt-6">
                        <div class="mb-4 sm:mb-0">
                             <form action="<?php echo e(route('cart.clear')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button class="px-6 py-2 text-sm text-red-600 border border-red-300 rounded-md hover:bg-red-100 transition duration-150 ease-in-out">Kosongkan Keranjang</button>
                            </form>
                        </div>
                        <div class="text-right">
                            <p class="text-lg">Total Belanja:</p>
                            <p class="font-bold text-2xl text-gray-900">Rp <?php echo e(number_format(Cart::getTotal(), 0, ',', '.')); ?></p>
                            
                            <a href="<?php echo e(route('checkout.index')); ?>" class="mt-4 inline-block w-full sm:w-auto text-center px-8 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-700">
                                Lanjut ke Checkout
                            </a>
                        </div>
                    </div>

                    <?php else: ?>
                        <p class="text-gray-500">Keranjang belanja Anda masih kosong.</p>
                        <a href="<?php echo e(route('dashboard')); ?>" class="mt-4 inline-block text-indigo-600 hover:text-indigo-900">&larr; Kembali belanja</a>
                    <?php endif; ?>
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

<?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/cart.blade.php ENDPATH**/ ?>