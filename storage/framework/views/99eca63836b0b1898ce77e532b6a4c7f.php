<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>  <?php $__env->slot('header', null, []); ?>   <h2 class="font-bold text-xl text-gray-800 leading-tight"> <?php echo e(__('Riwayat Transaksi')); ?> </h2>  <?php $__env->endSlot(); ?>     <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-4 text-gray-900" x-data="{
                            range: '<?php echo e(request('range', 'daily')); ?>',
                            startDate: '<?php echo e(request('start_date')); ?>',
                            endDate: '<?php echo e(request('end_date')); ?>',
                            updateFilter() {
                                if (this.range !== 'custom') {
                                    this.$refs.filterForm.submit();
                                } else if (this.startDate && this.endDate) {
                                    this.$refs.filterForm.submit();
                                }
                            }
                        }">
                            <h3 class="text-md font-bold text-gray-800 mb-3">Filter Laporan</h3>

                            <form x-ref="filterForm" action="<?php echo e(route('admin.transaksi.index')); ?>" method="GET">
                                <div class="space-y-3">
                                    
                                    <div class="space-y-2">
                                        
                                        <label class="flex items-center justify-between cursor-pointer group hover:bg-gray-50 p-2 rounded-md transition-colors">
                                            <span class="text-gray-700 text-sm font-medium group-hover:text-gray-900">Hari Ini</span>
                                            <input type="radio" name="range" value="daily" x-model="range" @change="updateFilter()"
                                                class="text-red-600 focus:ring-red-500 border-gray-300">
                                        </label>
                                        <hr class="border-gray-100">

                                        
                                        <label class="flex items-center justify-between cursor-pointer group hover:bg-gray-50 p-2 rounded-md transition-colors">
                                            <span class="text-gray-700 text-sm font-medium group-hover:text-gray-900">1 Minggu</span>
                                            <input type="radio" name="range" value="weekly" x-model="range" @change="updateFilter()"
                                                class="text-red-600 focus:ring-red-500 border-gray-300">
                                        </label>
                                        <hr class="border-gray-100">

                                        
                                        <label class="flex items-center justify-between cursor-pointer group hover:bg-gray-50 p-2 rounded-md transition-colors">
                                            <span class="text-gray-700 text-sm font-medium group-hover:text-gray-900">1 Bulan</span>
                                            <input type="radio" name="range" value="monthly" x-model="range" @change="updateFilter()"
                                                class="text-red-600 focus:ring-red-500 border-gray-300">
                                        </label>
                                        <hr class="border-gray-100">

                                        
                                        <div>
                                            <label class="flex items-center justify-between cursor-pointer group hover:bg-gray-50 p-2 rounded-md transition-colors mb-2">
                                                <span class="text-gray-700 text-sm font-medium group-hover:text-gray-900">Pilih Tanggal</span>
                                                <input type="radio" name="range" value="custom" x-model="range" @change="updateFilter()"
                                                    class="text-red-600 focus:ring-red-500 border-gray-300">
                                            </label>

                                            
                                            <div x-show="range === 'custom'" x-transition class="px-2 pb-2">
                                                <div class="space-y-3">
                                                    
                                                    <div>
                                                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1 font-semibold">Dari</p>
                                                        <div class="relative">
                                                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                                                <svg class="h-3.5 w-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                </svg>
                                                            </div>
                                                            <input type="date" name="start_date" id="start_date" x-model="startDate" @change="updateFilter()"
                                                                class="pl-7 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm text-xs text-gray-700 py-1.5">
                                                        </div>
                                                    </div>

                                                    
                                                    <div>
                                                        <p class="text-[10px] uppercase tracking-wider text-gray-400 mb-1 font-semibold">Sampai</p>
                                                        <div class="relative">
                                                            <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                                                <svg class="h-3.5 w-3.5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                </svg>
                                                            </div>
                                                            <input type="date" name="end_date" id="end_date" x-model="endDate" @change="updateFilter()"
                                                                class="pl-7 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm text-xs text-gray-700 py-1.5">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-3 border-t border-gray-100">
                                        
                                        <a href="<?php echo e(route('admin.transaksi.cetak', request()->query())); ?>" target="_blank"
                                            class="flex w-full justify-center items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            Cetak Laporan
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
                <div class="lg:col-span-3 space-y-6">
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-gray-800">
                        <div class="p-6 text-gray-900 flex justify-between items-center">
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 mb-1">Total Pendapatan</h3>
                                <p class="text-3xl font-bold text-gray-800">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></p>
                            </div>
                            <div class="text-right">
                                <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-0.5 rounded border border-gray-200 uppercase tracking-wide">
                                    <?php echo e($filterLabel); ?>

                                </span>
                            </div>
                        </div>
                    </div>

                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Transaksi</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID Transaksi</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tgl. Transaksi</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Bayar</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php $__empty_1 = true; $__currentLoopData = $transaksis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaksi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <a href="<?php echo e(route('admin.pesanan.show', $transaksi->pesanan_id)); ?>" class="text-red-600 hover:text-red-800 font-bold hover:underline">
                                                    #<?php echo e($transaksi->id); ?>

                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?php echo e($transaksi->pesanan->user->name ?? 'N/A'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e(\Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y')); ?> <span class="text-xs text-gray-400"><?php echo e(\Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('H:i')); ?></span></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Rp <?php echo e(number_format($transaksi->total_bayar, 0, ',', '.')); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <?php if($transaksi->status_pembayaran == 'paid'): ?>
                                                    <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-50 text-green-700 border border-green-200">
                                                        Lunas
                                                    </span>
                                                <?php else: ?>
                                                    <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-50 text-red-700 border border-red-200">
                                                        <?php echo e(ucfirst($transaksi->status_pembayaran)); ?>

                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                                <div class="flex flex-col items-center justify-center">
                                                    <svg class="h-10 w-10 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <p class="text-sm">Tidak ada transaksi untuk periode ini.</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                <?php echo e($transaksis->withQueryString()->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\PREDATOR\Documents\KULIAH\semester 7\capston2\resources\views/admin/transaksi/index.blade.php ENDPATH**/ ?>