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
        <div class="no-print">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Detail Pesanan #')); ?><?php echo e($pesanan->id); ?>

            </h2>
        </div>
     <?php $__env->endSlot(); ?>

    
    <div class="py-12 no-print">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            
            <?php if($message = Session::get('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert"><span class="block sm:inline"><?php echo e($message); ?></span></div>
            <?php endif; ?>
            <?php if($message = Session::get('warning')): ?>
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded relative mb-4" role="alert"><strong class="font-bold">Perhatian!</strong> <span class="block sm:inline"><?php echo e($message); ?></span></div>
            <?php endif; ?>
            <?php if($message = Session::get('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert"><strong class="font-bold">Gagal!</strong> <span class="block sm:inline"><?php echo e($message); ?></span></div>
            <?php endif; ?>
            <?php if($errors->any()): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops! Ada input yang salah:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                
                <div class="md:col-span-2 space-y-6">
                    
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <span class="bg-gray-800 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs mr-2">1</span>
                                Cek Bukti Pembayaran
                            </h3>
                            
                            <?php if($pesanan->bukti_bayar): ?>
                                
                                <div class="flex flex-col items-start">
                                    <div class="border rounded p-2 bg-gray-50 inline-block mb-3">
                                        <img src="<?php echo e(asset($pesanan->bukti_bayar)); ?>" alt="Bukti Transfer" class="max-h-80 w-auto object-contain rounded-md shadow-sm">
                                    </div>
                                    <a href="<?php echo e(asset($pesanan->bukti_bayar)); ?>" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 underline text-sm font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Lihat Gambar Ukuran Penuh
                                    </a>
                                </div>

                            <?php elseif(str_contains($pesanan->catatan_pelanggan, 'OFFLINE')): ?>
                                
                                <div class="flex items-center justify-center p-8 bg-blue-50 rounded-lg border-2 border-dashed border-blue-200 text-center">
                                    <div>
                                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mb-3">
                                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-bold text-gray-900">Verifikasi Visual (Tatap Muka)</h4>
                                        <p class="text-sm text-gray-600 mt-1 max-w-xs mx-auto">
                                            Ini adalah pesanan <strong>Offline</strong>. Terima uang tunai atau cek HP pelanggan langsung.
                                        </p>
                                    </div>
                                </div>

                            <?php else: ?>
                                
                                <div class="flex items-center justify-center p-6 bg-red-50 rounded-lg border-2 border-dashed border-red-200">
                                    <p class="text-red-500 italic flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Pelanggan belum mengupload bukti bayar.
                                    </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                         <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <span class="bg-gray-800 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs mr-2">2</span>
                                Tindakan Pembayaran
                            </h3>
                            
                            <?php if($pesanan->transaksi): ?>
                                <div class="p-4 bg-green-100 text-green-800 rounded-lg font-semibold flex items-center border border-green-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Pesanan ini sudah LUNAS via <?php echo e($pesanan->transaksi->metode_pembayaran); ?>.
                                </div>
                            <?php else: ?>
                                <form action="<?php echo e(route('admin.transaksi.verifikasi', $pesanan->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>

                                        <?php if($pesanan->metode_pembayaran): ?>
                                            <div class="w-full bg-gray-100 border border-gray-300 text-gray-800 text-sm rounded-md shadow-sm p-2.5 font-bold flex items-center gap-2">
                                                <?php echo e($pesanan->metode_pembayaran); ?>

                                            </div>
                                            <input type="hidden" name="metode_pembayaran" value="<?php echo e($pesanan->metode_pembayaran); ?>">
                                        <?php else: ?>
                                            <select name="metode_pembayaran" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                                <option value="Tunai di Tempat">Tunai di Tempat</option>
                                                <option value="Transfer Bank">Transfer Bank (BCA)</option>
                                                <option value="QRIS">QRIS</option>
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-green-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-green-700 transition-colors shadow-lg shadow-green-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        BUKTI VALID - VERIFIKASI SEKARANG
                                    </button>
                                </form>
                            <?php endif; ?>
                         </div>
                    </div>

                    
                    <?php if($pesanan->status == 'pending' || $pesanan->status == 'processing'): ?>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                         <div class="p-6 bg-gray-50">
                                <h3 class="text-sm font-bold text-gray-800 mb-2 flex items-center">
                                    <span class="bg-gray-800 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs mr-2">3</span>
                                    Ubah Status Manual (Jika Perlu)
                                </h3>
                                <p class="text-xs text-gray-500 mb-3">
                                    Jika bukti pembayaran <strong>TIDAK VALID</strong> atau palsu, silakan ubah status menjadi <strong>Cancelled</strong> di sini.
                                </p>
                                <form action="<?php echo e(route('admin.pesanan.updateStatus', $pesanan->id)); ?>" method="POST" class="flex gap-3 items-center">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <select name="status" class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm flex-1 text-sm">
                                        <option value="pending" <?php echo e($pesanan->status == 'pending' ? 'selected' : ''); ?>>Pending (Menunggu)</option>
                                        <option value="processing" <?php echo e($pesanan->status == 'processing' ? 'selected' : ''); ?>>Processing (Diproses)</option>
                                        <option value="completed" <?php echo e($pesanan->status == 'completed' ? 'selected' : ''); ?>>Completed (Selesai)</option>
                                        <option value="cancelled" <?php echo e($pesanan->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled (Batalkan Pesanan)</option>
                                    </select>
                                    <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md text-xs font-bold hover:bg-gray-900 transition-colors">UPDATE</button>
                                </form>
                         </div>
                    </div>
                    <?php endif; ?>

                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                         <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Pesanan</h3>
                            <div class="text-sm space-y-2">
                                <p><strong>Pelanggan:</strong> <?php echo e($pesanan->user->name); ?></p>
                                <p><strong>Tipe Layanan:</strong> <?php echo e($pesanan->tipe_layanan); ?></p>
                                
                                <p><strong>Metode Pilihan:</strong> 
                                    <?php if($pesanan->metode_pembayaran): ?>
                                        <span class="font-semibold text-blue-600"><?php echo e($pesanan->metode_pembayaran); ?></span>
                                    <?php else: ?>
                                        <span class="text-gray-400 italic">-</span>
                                    <?php endif; ?>
                                </p>

                                <p class="text-lg mt-4 border-t pt-2"><strong>Total Tagihan:</strong> <span class="font-bold text-gray-900 text-xl">Rp <?php echo e(number_format($pesanan->total_bayar, 0, ',', '.')); ?></span></p>
                            </div>
                         </div>
                    </div>

                </div>

                
                <div class="md:col-span-1 space-y-6">
                    
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Item yang Dipesan</h3>
                            <div class="space-y-4">
                                <?php $__empty_1 = true; $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="flex justify-between items-start border-b border-gray-100 pb-3 last:border-0">
                                        <div>
                                            <p class="font-semibold text-gray-800"><?php echo e($item->menu->namaMenu ?? 'Menu Dihapus'); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo e($item->jumlah); ?> x Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></p>
                                        </div>
                                        <p class="text-sm font-bold text-gray-800">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-sm text-gray-500 italic">Belum ada item.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    
                    <?php if($pesanan->status == 'pending' || $pesanan->status == 'processing'): ?>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Item</h3>
                            <form action="<?php echo e(route('admin.pesanan.addItem', $pesanan->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <div class="space-y-4">
                                    <div>
                                        <label for="menu_id" class="block text-sm font-medium text-gray-700">Pilih Menu</label>
                                        <select name="menu_id" id="menu_id" class="mt-1 block w-full text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                            <option value="">-- Pilih Menu --</option>
                                            <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($menu->id); ?>" <?php echo e($menu->jumlah_saat_ini <= 0 ? 'disabled' : ''); ?>>
                                                    <?php echo e($menu->namaMenu); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="mt-1 block w-full text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                    </div>
                                    <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">TAMBAH</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6 flex flex-col gap-3">
                             <button onclick="window.print()" class="w-full justify-center inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors shadow-sm">
                                🖨️ CETAK NOTA
                            </button>
                            <a href="<?php echo e(route('admin.pesanan.index')); ?>" class="text-center text-sm text-gray-600 hover:text-gray-900 underline">&larr; Kembali ke Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="print-this" aria-hidden="true" style="display: none;">
        <div class="nota-wrapper" style="font-family: monospace; width: 300px; margin: 0 auto; padding: 10px;">
            <div class="nota-header" style="text-align: center; margin-bottom: 15px;">
                <h2 style="font-size: 16px; font-weight: bold; margin: 0;">BURMIN - Jagonya Warmindo</h2>
                <p style="font-size: 10px; margin: 2px 0;">Jl. Bunga, Geblagan, Tamantirto, Bantul, DIY</p>
                <p style="font-size: 10px; margin: 2px 0;">Telp: (0274) 123456</p>
            </div>
            <div style="border-bottom: 1px dashed #000; margin-bottom: 10px;"></div>
            <div class="nota-details" style="font-size: 11px; margin-bottom: 10px;">
                <p style="margin: 2px 0;">No: #<?php echo e($pesanan->id); ?></p>
                <p style="margin: 2px 0;">Kasir: <?php echo e(Auth::user()->name); ?></p> 
                
                <p style="margin: 2px 0;">Pelanggan: 
                    <?php if(str_contains($pesanan->catatan_pelanggan, 'OFFLINE')): ?>
                        <?php echo e(str_replace('OFFLINE - ', '', $pesanan->catatan_pelanggan)); ?>

                    <?php else: ?>
                        <?php echo e($pesanan->user->name); ?>

                    <?php endif; ?>
                </p>
                <p style="margin: 2px 0;">Tgl: <?php echo e($pesanan->created_at->format('d/m/Y H:i')); ?></p>
                <p style="margin: 2px 0;">Tipe: <?php echo e($pesanan->tipe_layanan); ?></p>
            </div>
            <div style="border-bottom: 1px dashed #000; margin-bottom: 10px;"></div>
            <div class="nota-items">
                <table style="width: 100%; font-size: 11px;">
                    <tbody>
                        <?php $__currentLoopData = $pesanan->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="padding-bottom: 5px;">
                                <?php echo e($item->menu->namaMenu ?? 'Menu Dihapus'); ?> <br>
                                <span style="font-size: 9px;"><?php echo e($item->jumlah); ?> x <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></span>
                            </td>
                            <td style="text-align: right; vertical-align: top;">
                                <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div style="border-bottom: 1px dashed #000; margin: 10px 0;"></div>
            <div class="nota-total" style="font-size: 12px;">
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="font-weight: bold;">TOTAL</td>
                            <td style="text-align: right; font-weight: bold;">Rp <?php echo e(number_format($pesanan->total_bayar, 0, ',', '.')); ?></td>
                        </tr>
                        <?php if($pesanan->transaksi): ?>
                        <tr>
                            <td style="font-size: 10px; padding-top: 5px;">Pembayaran</td>
                            <td style="text-align: right; font-size: 10px; padding-top: 5px;"><?php echo e(strtoupper($pesanan->transaksi->metode_pembayaran)); ?></td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;">Status</td>
                            <td style="text-align: right; font-size: 10px;">LUNAS</td>
                        </tr>
                        <?php else: ?>
                        <tr>
                            <td style="font-size: 10px; padding-top: 5px;">Status</td>
                            <td style="text-align: right; font-size: 10px;">BELUM LUNAS</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div style="border-bottom: 1px dashed #000; margin: 15px 0;"></div>
            <div class="nota-footer" style="text-align: center; font-size: 10px;">
                <p>Terima Kasih Atas Kunjungan Anda!</p>
                <p>Selamat Menikmati 🍜</p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * { visibility: hidden; }
            .no-print { display: none !important; }
            .print-this, .print-this * { visibility: visible; display: block !important; }
            .print-this { position: absolute; left: 0; top: 0; width: 100%; }
        }
    </style>    
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