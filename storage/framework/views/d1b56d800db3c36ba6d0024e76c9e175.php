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
            <?php echo e(__('Beri Ulasan Pesanan #')); ?><?php echo e($pesanan->id); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            
            <?php if($errors->any()): ?>
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong class="font-bold">Ulasan Gagal Disimpan!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="<?php echo e(route('reviews.store', $pesanan->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <p class="text-lg font-semibold mb-6">Silakan beri bintang dan ulasan untuk setiap item dalam pesanan Anda.</p>

                        <div class="space-y-8">
                            
                            
                            <?php $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <div class="border p-4 rounded-lg bg-gray-50" x-data="{ currentRating: <?php echo e(old('reviews.' . $detail->menu_id . '.rating', 0)); ?> }">
                                    <div class="flex items-center space-x-4 mb-4">
                                        
                                        <img src="<?php echo e(asset($detail->menu->gambar)); ?>" 
                                             alt="<?php echo e($detail->menu->namaMenu); ?>" 
                                             class="w-16 h-16 object-cover rounded-full"
                                             onerror="this.src='https://placehold.co/64x64/e2e8f0/e2e8f0?text=IMG'">
                                        
                                        <div>
                                            <h4 class="font-bold text-lg"><?php echo e($detail->menu->namaMenu); ?></h4>
                                            <p class="text-sm text-gray-600"><?php echo e($detail->jumlah); ?> porsi (<?php echo e($detail->menu->kategori); ?>)</p>
                                        </div>
                                    </div>

                                    
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Beri Bintang:</label>
                                        <div class="flex space-x-1">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <button type="button" 
                                                        @click="currentRating = <?php echo e($i); ?>" 
                                                        @mouseenter="tempRating = <?php echo e($i); ?>" 
                                                        @mouseleave="tempRating = currentRating" 
                                                        class="text-gray-300 hover:text-yellow-400 transition-colors duration-150">
                                                    
                                                    
                                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                                         class="w-8 h-8" 
                                                         :class="{ 'text-yellow-400': currentRating >= <?php echo e($i); ?> }"
                                                         viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                                    </svg>
                                                </button>
                                            <?php endfor; ?>
                                        </div>
                                        
                                        
                                        <input type="hidden" name="reviews[<?php echo e($detail->menu_id); ?>][menu_id]" value="<?php echo e($detail->menu_id); ?>">
                                        <input type="hidden" 
                                               name="reviews[<?php echo e($detail->menu_id); ?>][rating]" 
                                               :value="currentRating" 
                                               required>
                                        
                                        
                                        <?php $__errorArgs = ['reviews.' . $detail->menu_id . '.rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-red-500 text-xs mt-1">Rating wajib diisi.</p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    
                                    <div>
                                        <label for="komentar_<?php echo e($detail->menu_id); ?>" class="block text-sm font-medium text-gray-700 mb-1">Komentar (Opsional):</label>
                                        <textarea id="komentar_<?php echo e($detail->menu_id); ?>" 
                                                  name="reviews[<?php echo e($detail->menu_id); ?>][komentar]" 
                                                  rows="2" 
                                                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"><?php echo e(old('reviews.' . $detail->menu_id . '.komentar')); ?></textarea>
                                        <?php $__errorArgs = ['reviews.' . $detail->menu_id . '.komentar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="<?php echo e(route('orders.index')); ?>" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md mr-4"> Kembali </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-kfc-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                Kirimkan Ulasan
                            </button>
                        </div>
                    </form>

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
<?php endif; ?><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/reviews/create.blade.php ENDPATH**/ ?>