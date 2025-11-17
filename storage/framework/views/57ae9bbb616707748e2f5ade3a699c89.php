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
        
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Riwayat Transaksi')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Filter Laporan</h3>
                    
                    
                    <div class="flex space-x-2 mb-4">
                        <a href="<?php echo e(route('admin.transaksi.index', ['range' => 'daily'])); ?>" class="px-4 py-2 text-sm font-medium rounded-md transition-colors <?php echo e(request('range', 'daily') == 'daily' && !request('start_date') ? 'bg-red-600 text-white hover:bg-red-700' : 'text-gray-700 bg-gray-100 hover:bg-gray-200'); ?>">
                            Hari Ini
                        </a>
                        <a href="<?php echo e(route('admin.transaksi.index', ['range' => 'weekly'])); ?>" class="px-4 py-2 text-sm font-medium rounded-md transition-colors <?php echo e(request('range') == 'weekly' ? 'bg-red-600 text-white hover:bg-red-700' : 'text-gray-700 bg-gray-100 hover:bg-gray-200'); ?>">
                            Minggu Ini
                        </a>
                        <a href="<?php echo e(route('admin.transaksi.index', ['range' => 'monthly'])); ?>" class="px-4 py-2 text-sm font-medium rounded-md transition-colors <?php echo e(request('range') == 'monthly' ? 'bg-red-600 text-white hover:bg-red-700' : 'text-gray-700 bg-gray-100 hover:bg-gray-200'); ?>">
                            Bulan Ini
                        </a>
                    </div>
                    
                    
                    <form action="<?php echo e(route('admin.transaksi.index')); ?>" method="GET">
                        <div class="flex flex-col md:flex-row md:items-end space-y-2 md:space-y-0 md:space-x-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" value="<?php echo e(request('start_date')); ?>" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="end_date" value="<?php echo e(request('end_date')); ?>" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                            </div>
                            
                            
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                Terapkan Filter
                            </button>

                            
                            
                            <a href="<?php echo e(route('admin.transaksi.cetak', request()->query())); ?>" target="_blank" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors">
                                Cetak Laporan
                            </a>
                            
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-gray-800">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Total Pendapatan (<?php echo e($filterLabel); ?>)</h3>
                    <p class="text-4xl font-bold text-gray-800">
                        Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?>

                    </p>
                </div>
            </div>

            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-gray-600">Daftar transaksi lunas untuk periode: <?php echo e($filterLabel); ?></p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">ID Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Tgl. Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Metode Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Total Bayar</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php $__empty_1 = true; $__currentLoopData = $transaksis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaksi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            
                                            <a href="<?php echo e(route('admin.pesanan.show', $transaksi->pesanan_id)); ?>" class="text-red-600 hover:text-red-800 font-semibold hover:underline">
                                                #TRX-<?php echo e($transaksi->id); ?>

                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($transaksi->pesanan->user->name ?? 'N/A'); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e(\Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i')); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo e($transaksi->metode_pembayaran); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                            Rp <?php echo e(number_format($transaksi->total_bayar, 0, ',', '.')); ?>

                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <?php if($transaksi->status_pembayaran == 'paid'): ?>
                                                
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-white text-gray-700 border border-gray-300">
                                                    Lunas (Paid)
                                                </span>
                                            <?php else: ?>
                                                
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Gagal
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            Belum ada transaksi yang lunas untuk periode ini.
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/admin/transaksi/index.blade.php ENDPATH**/ ?>