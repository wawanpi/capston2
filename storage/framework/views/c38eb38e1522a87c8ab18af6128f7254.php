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
    
     <?php $__env->slot('header', null, ['class' => 'no-print']); ?> 
        
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Detail Pesanan #')); ?><?php echo e($pesanan->id); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    
    
    <div class="py-12 bg-gray-50 no-print">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            
            <?php if($message = Session::get('success')): ?>
                <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e($message); ?></span>
                </div>
            <?php endif; ?>
             
             <?php if($message = Session::get('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e($message); ?></span>
                </div>
            <?php endif; ?>

            
            <?php if($errors->any()): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops! Ada kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 print-area">
                
                <div class="md:col-span-2 print-col">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                         <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                            <p><strong>Pelanggan:</strong> <?php echo e($pesanan->user->name); ?></p>
                            <p><strong>Email:</strong> <?php echo e($pesanan->user->email); ?></p>
                            <p><strong>Tanggal Pesan:</strong> <?php echo e($pesanan->created_at->format('d M Y, H:i')); ?></p>
                            <p><strong>Tipe Layanan:</strong> <?php echo e($pesanan->tipe_layanan); ?></p>

                            <?php if($pesanan->tipe_layanan == 'Dine-in'): ?>
                                
                                <p><strong>Jumlah Tamu:</strong> <span class="font-bold text-red-600"><?php echo e($pesanan->jumlah_tamu); ?> orang</span></p>
                            <?php endif; ?>

                            <p class="mt-2 text-xl"><strong>Total Bayar:</strong> <span class="font-bold text-gray-900">Rp <?php echo e(number_format($pesanan->total_bayar, 0, ',', '.')); ?></span></p>
                            
                            <p><strong>Status Saat Ini:</strong> 
                                
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    <?php if($pesanan->status == 'pending'): ?> bg-gray-200 text-gray-800 <?php endif; ?>
                                    <?php if($pesanan->status == 'processing'): ?> bg-gray-800 text-white <?php endif; ?>
                                    <?php if($pesanan->status == 'completed'): ?> bg-white text-gray-500 border border-gray-300 <?php endif; ?>
                                    <?php if($pesanan->status == 'cancelled'): ?> bg-red-100 text-red-800 <?php endif; ?>
                                "><?php echo e(ucfirst($pesanan->status)); ?></span>
                            </p>
                         </div>
                        
                        
                        <?php if($pesanan->status == 'pending' || $pesanan->status == 'processing'): ?>
                         <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Ubah Status Pesanan</h3>
                                <form action="<?php echo e(route('admin.pesanan.updateStatus', $pesanan->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="flex items-center">
                                        
                                        <select name="status" class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                                            <option value="pending" <?php echo e($pesanan->status == 'pending' ? 'selected' : ''); ?>>Pending (Menunggu diproses)</option>
                                            <option value="processing" <?php echo e($pesanan->status == 'processing' ? 'selected' : ''); ?>>Processing (Sedang dibuat)</option>
                                            <option value="completed" <?php echo e($pesanan->status == 'completed' ? 'selected' : ''); ?>>Completed (Siap diambil)</option>
                                            <option value="cancelled" <?php echo e($pesanan->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled (Dibatalkan)</option>
                                        </select>
                                        
                                        <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                            Update
                                        </button>
                                    </div>
                                </form>
                         </div>
                         <?php endif; ?>

                        
                         <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Tindakan Pembayaran</h3>
                            <?php if($pesanan->transaksi): ?>
                                
                                <div class="p-4 bg-gray-100 rounded-lg text-gray-800 font-semibold">
                                    Pesanan ini sudah lunas dibayar.
                                </div>
                            <?php else: ?>
                                <form action="<?php echo e(route('admin.transaksi.verifikasi', $pesanan->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <p class="text-sm text-gray-600 mb-2">Klik tombol ini untuk mengonfirmasi bahwa pembayaran tunai telah diterima di kasir.</p>
                                    
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                        Verifikasi Pembayaran
                                    </button>
                                </form>
                            <?php endif; ?>
                         </div>

                    </div>
                </div>

                
                <div class="md:col-span-1 space-y-6 print-col">
                        
                        
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Item yang Dipesan</h3>
                                <div class="space-y-4">
                                    <?php $__empty_1 = true; $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="flex justify-between items-start border-b pb-2">
                                            <div>
                                                <p class="font-semibold"><?php echo e($item->menu->namaMenu ?? 'Menu Dihapus'); ?></p>
                                                <p class="text-sm text-gray-600"><?php echo e($item->jumlah); ?> x Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></p>
                                            </div>
                                            <p class="text-sm font-semibold text-gray-800">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <p class="text-sm text-gray-500">Belum ada item.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                       </div>

                        
                        <?php if($pesanan->status == 'pending' || $pesanan->status == 'processing'): ?>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Item ke Pesanan</h3>
                                <form action="<?php echo e(route('admin.pesanan.addItem', $pesanan->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="space-y-4">
                                        
                                        <div>
                                            <label for="menu_id" class="block text-sm font-medium text-gray-700">Pilih Menu</label>
                                            <select name="menu_id" id="menu_id" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                                <option value="">-- Pilih Menu --</option>
                                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($menu->id); ?>">
                                                        <?php echo e($menu->namaMenu); ?> (Sisa: <?php echo e($menu->jumlah_saat_ini); ?>)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        
                                        
                                        <div>
                                            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                        </div>

                                        
                                        <div>
                                            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                                Tambah Item
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php endif; ?>
                        

                </div>
            </div>
             <div class="mt-6 flex justify-between">
                
                <a href="<?php echo e(route('admin.pesanan.index')); ?>" class="text-sm text-gray-600 hover:text-gray-900 no-print">&larr; Kembali ke Daftar Pesanan</a>
                
                
                <?php if($pesanan->transaksi): ?>
                    <button onclick="window.print()" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 no-print">
                        Cetak Nota
                    </button>
                <?php endif; ?>
             </div>
        </div>
    </div>

    
    
    
    
    <div class="print-this" aria-hidden="true">
        <div class="nota-wrapper">
            <div class="nota-header">
                <h2>BURMIN - Jagonya Warmindo</h2>
                <p>Jl. Bunga, Geblagan, Tamantirto, Bantul, DIY</p>
                <p>Telp: (0274) 123456</p>
            </div>

            <div class="nota-separator"></div>

            <div class="nota-details">
                <p><span>No. Pesanan:</span> <strong>#<?php echo e($pesanan->id); ?></strong></p>
                <p><span>Kasir:</span> <strong><?php echo e(Auth::user()->name); ?></strong></p> 
                <p><span>Pelanggan:</span> <strong><?php echo e($pesanan->user->name); ?></strong></p>
                <p><span>Tanggal:</span> <strong><?php echo e($pesanan->created_at->format('d/m/Y H:i')); ?></strong></p>
                <p><span>Layanan:</span> <strong><?php echo e($pesanan->tipe_layanan); ?></strong></p>
            </div>

            <div class="nota-separator"></div>

            <div class="nota-items">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Jml</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($item->menu->namaMenu ?? 'Menu Dihapus'); ?>

                                <br>
                                <small>(@ Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?>)</small>
                            </td>
                            <td>x<?php echo e($item->jumlah); ?></td>
                            <td>Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="nota-separator"></div>
            
            <div class="nota-total">
                <table>
                    <tbody>
                        <tr>
                            <td><strong>Total Bayar</strong></td>
                            <td><strong>Rp <?php echo e(number_format($pesanan->total_bayar, 0, ',', '.')); ?></strong></td>
                        </tr>
                        <?php if($pesanan->transaksi): ?>
                        <tr>
                            <td>Status</td>
                            <td>LUNAS (<?php echo e($pesanan->transaksi->metode_pembayaran); ?>)</td>
                        </tr>
                        <?php else: ?>
                        <tr>
                            <td>Status</td>
                            <td>BELUM LUNAS</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="nota-footer">
                <p>Terima Kasih Atas Kunjungan Anda!</p>
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
<?php endif; ?><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/admin/pesanan/show.blade.php ENDPATH**/ ?>