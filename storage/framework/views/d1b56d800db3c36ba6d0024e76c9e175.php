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
    <div class="container mx-auto px-4 py-8 lg:py-12 max-w-3xl">
        
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-gray-900 uppercase tracking-wide mb-2">
                Beri <span class="text-[#E3002B]">Ulasan</span>
            </h1>
            <p class="text-gray-500">Bagaimana pengalaman makanmu? Ceritakan kepada kami!</p>
            <div class="mt-2 inline-block bg-gray-100 px-3 py-1 rounded-full text-xs font-bold text-gray-600">
                Order #<?php echo e($pesanan->id); ?>

            </div>
        </div>

        
        <?php if($errors->any()): ?>
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r shadow-sm flex items-start gap-3 animate-fade-in-down">
                <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5 shrink-0"></i>
                <div>
                    <strong class="font-bold block mb-1">Ups! Ada yang belum lengkap.</strong>
                    <ul class="list-disc list-inside text-sm">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('reviews.store', $pesanan->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="space-y-6">
                <?php $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300"
                         x-data="{ 
                            rating: <?php echo e(old('reviews.' . $detail->menu_id . '.rating', 0)); ?>,
                            hoverRating: 0
                         }">
                        
                        <div class="flex flex-col sm:flex-row gap-6">
                            
                            <div class="shrink-0 flex justify-center sm:justify-start">
                                <img src="<?php echo e(asset($detail->menu->gambar)); ?>" 
                                     alt="<?php echo e($detail->menu->namaMenu); ?>" 
                                     class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-xl shadow-sm border border-gray-100">
                            </div>

                            
                            <div class="flex-grow w-full">
                                <div class="mb-4 text-center sm:text-left">
                                    <h3 class="text-xl font-bold text-gray-900 leading-tight"><?php echo e($detail->menu->namaMenu); ?></h3>
                                    <p class="text-sm text-gray-500 mt-1"><?php echo e($detail->jumlah); ?> porsi • <?php echo e($detail->menu->kategori); ?></p>
                                </div>

                                
                                <div class="mb-6 flex flex-col items-center sm:items-start">
                                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Rating Kamu</label>
                                    <div class="flex items-center gap-1" @mouseleave="hoverRating = 0">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <button type="button" 
                                                    @click="rating = <?php echo e($i); ?>" 
                                                    @mouseenter="hoverRating = <?php echo e($i); ?>"
                                                    class="focus:outline-none transition-transform active:scale-90"
                                                    title="Beri <?php echo e($i); ?> Bintang">
                                                <i data-lucide="star" 
                                                   class="w-8 h-8 sm:w-9 sm:h-9 transition-colors duration-200"
                                                   :class="(hoverRating >= <?php echo e($i); ?> || (hoverRating === 0 && rating >= <?php echo e($i); ?>)) 
                                                        ? 'fill-yellow-400 text-yellow-400 drop-shadow-sm' 
                                                        : 'text-gray-200 fill-gray-100'">
                                                </i>
                                            </button>
                                        <?php endfor; ?>
                                    </div>
                                    <input type="hidden" name="reviews[<?php echo e($detail->menu_id); ?>][menu_id]" value="<?php echo e($detail->menu_id); ?>">
                                    <input type="hidden" name="reviews[<?php echo e($detail->menu_id); ?>][rating]" :value="rating">
                                    
                                    <div x-show="rating > 0" class="mt-2 text-sm font-medium text-yellow-600 animate-fade-in">
                                        <span x-text="rating === 5 ? 'Sempurna! 😍' : (rating >= 4 ? 'Suka banget! 😄' : (rating >= 3 ? 'Lumayan 🙂' : 'Kurang 😔'))"></span>
                                    </div>

                                    <?php $__errorArgs = ['reviews.' . $detail->menu_id . '.rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-500 text-xs mt-2 flex items-center gap-1 font-bold">
                                            <i data-lucide="alert-circle" class="w-3 h-3"></i> Wajib diisi
                                        </p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                
                                <div>
                                    <label for="komentar_<?php echo e($detail->menu_id); ?>" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Komentar (Opsional)</label>
                                    <textarea id="komentar_<?php echo e($detail->menu_id); ?>" 
                                              name="reviews[<?php echo e($detail->menu_id); ?>][komentar]" 
                                              rows="3" 
                                              class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50 text-sm placeholder-gray-400 transition-all resize-none"
                                              placeholder="Ceritakan rasanya, porsinya, atau sarannya..."><?php echo e(old('reviews.' . $detail->menu_id . '.komentar')); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 p-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] z-40 sm:static sm:bg-transparent sm:border-0 sm:shadow-none sm:p-0 sm:mt-10">
                <div class="container mx-auto max-w-3xl flex flex-col sm:flex-row items-center justify-between gap-4">
                    <a href="<?php echo e(route('orders.index')); ?>" class="text-gray-500 hover:text-gray-900 font-medium text-sm hidden sm:block transition">
                        Batal, kembali ke Riwayat
                    </a>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-[#E3002B] hover:bg-red-700 text-white font-bold rounded-full shadow-lg shadow-red-200 transition-all transform active:scale-95 flex items-center justify-center gap-2">
                        <span>Kirim Semua Ulasan</span>
                        <i data-lucide="send" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
            
            
            <div class="h-24 sm:hidden"></div>

        </form>
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