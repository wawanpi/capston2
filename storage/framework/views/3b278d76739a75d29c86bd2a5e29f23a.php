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
            <?php echo e(__('Edit Menu: ')); ?> <?php echo e($menu->namaMenu); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <?php if($errors->any()): ?>
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                             <strong class="font-bold">Error!</strong>
                             <ul class="mt-2 list-disc list-inside text-sm">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    
                    <form method="POST" action="<?php echo e(route('admin.menus.update', $menu->id)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="space-y-4">
                            <div>
                                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'namaMenu','value' => __('Nama Menu')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'namaMenu','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Nama Menu'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'namaMenu','class' => 'block mt-1 w-full','type' => 'text','name' => 'namaMenu','value' => old('namaMenu', $menu->namaMenu),'required' => true,'autofocus' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'namaMenu','class' => 'block mt-1 w-full','type' => 'text','name' => 'namaMenu','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('namaMenu', $menu->namaMenu)),'required' => true,'autofocus' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                            </div>
                            <div>
                                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'harga','value' => __('Harga')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'harga','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Harga'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'harga','class' => 'block mt-1 w-full','type' => 'number','name' => 'harga','value' => old('harga', $menu->harga),'required' => true,'step' => '0.01']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'harga','class' => 'block mt-1 w-full','type' => 'number','name' => 'harga','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('harga', $menu->harga)),'required' => true,'step' => '0.01']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                            </div>
                            <div>
                                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'deskripsi','value' => __('Deskripsi')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'deskripsi','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Deskripsi'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"><?php echo e(old('deskripsi', $menu->deskripsi)); ?></textarea>
                            </div>
                            <div>
                                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'stok','value' => __('Stok')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'stok','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Stok'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'stok','class' => 'block mt-1 w-full','type' => 'number','name' => 'stok','value' => old('stok', $menu->stok),'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'stok','class' => 'block mt-1 w-full','type' => 'number','name' => 'stok','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('stok', $menu->stok)),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                            </div>
                            
                            
                            <div>
                                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'gambar','value' => __('Gambar Baru (Kosongkan jika tidak ingin diubah)')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'gambar','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Gambar Baru (Kosongkan jika tidak ingin diubah)'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                                <input id="gambar" name="gambar" type="file" class="block mt-1 w-full">
                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('gambar'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('gambar')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                            </div>

                            
                            <?php if($menu->gambar): ?>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Gambar Saat Ini:</p>
                                    <img src="<?php echo e(Storage::url($menu->gambar)); ?>" alt="<?php echo e($menu->namaMenu); ?>" class="mt-1 w-32 h-32 object-cover rounded">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                             <a href="<?php echo e(route('admin.menus.index')); ?>" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md mr-4"> Batal </a>
                            <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo e(__('Update Menu')); ?>  <?php echo $__env->renderComponent(); ?>
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

<?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views\admin\menus\edit.blade.php ENDPATH**/ ?>