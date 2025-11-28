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
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    <?php echo e(__('Dashboard Admin')); ?>

                </h2>
                <p class="text-sm text-gray-600 mt-1">Ringkasan performa bisnis hari ini</p>
            </div>
            <div class="text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-200">
                <?php echo e(now()->format('l, d F Y')); ?>

            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-red-600 p-5 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pendapatan Hari Ini</h3>
                            <p class="text-2xl font-bold text-gray-900 mt-2">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></p>
                        </div>
                        <div class="p-2 bg-red-50 rounded-lg text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block">Total transaksi lunas</span>
                </div>

                <div class="bg-white rounded-xl shadow-sm border-l-4 border-gray-800 p-5 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pesanan Baru</h3>
                            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($jumlahPesananBaru); ?></p>
                        </div>
                        <div class="p-2 bg-gray-100 rounded-lg text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block">Menunggu konfirmasi</span>
                </div>

                <div class="bg-white rounded-xl shadow-sm border-l-4 border-red-600 p-5 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Unit Terjual</h3>
                            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($totalUnitTerjual); ?></p>
                        </div>
                        <div class="p-2 bg-red-50 rounded-lg text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block">Porsi menu terjual hari ini</span>
                </div>

                <div class="bg-white rounded-xl shadow-sm border-l-4 border-gray-800 p-5 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pengguna Baru</h3>
                            <p class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($jumlahPenggunaBaru); ?></p>
                        </div>
                        <div class="p-2 bg-gray-100 rounded-lg text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block">Registrasi hari ini</span>
                </div>
            </div>
            
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800 border-l-4 border-red-600 pl-3">Monitoring Ketersediaan Harian</h3>
                        <div class="flex items-center bg-red-50 px-3 py-1 rounded-full border border-red-100">
                            <div class="w-2 h-2 rounded-full bg-red-600 animate-pulse mr-2"></div>
                            <span class="text-xs font-bold text-red-700">Hampir Habis</span>
                        </div>
                    </div>
                    <div class="relative h-72">
                        <canvas id="jumlahChart"></canvas>
                    </div>
                </div>

                <!-- <div class="space-y-6">
                     
                    <?php if(session('success')): ?>
                        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm">
                            <p class="font-bold">Sukses!</p>
                            <p class="text-sm"><?php echo e(session('success')); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Notifikasi</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-2 h-2 bg-red-600 rounded-full shadow-[0_0_8px_rgba(220,38,38,0.5)]"></div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-gray-800">Kuota Menipis</p>
                                    <p class="text-xs text-gray-500 mt-0.5"><?php echo e(count($menuHampirHabis)); ?> menu sisa porsi sedikit</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-gray-800">Pesanan Masuk</p>
                                    <p class="text-xs text-gray-500 mt-0.5"><?php echo e($jumlahPesananBaru); ?> pesanan baru</p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                <!-- </div> -->
            </div>
            
            
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Menu Segera Habis</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-900 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nama Menu</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Sisa Porsi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $menuHampirHabis->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-red-50 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($item->menu->namaMenu); ?></td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500"><?php echo e($item->menu->kategori ?? '-'); ?></td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-800"><?php echo e($item->jumlah_saat_ini); ?></td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    <?php if($item->jumlah_saat_ini <= 5): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">Kritis</span>
                                    <?php elseif($item->jumlah_saat_ini <= 10): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">Sedikit</span>
                                    <?php else: ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">Aman</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                    
                                    <a href="<?php echo e(route('admin.menus.editKuota', $item->menu->id)); ?>" 
                                       class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                       </svg>
                                       Tambah Kuota
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">Ketersediaan menu aman</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

     <?php $__env->slot('scripts', null, []); ?> 
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chartData = <?php echo json_encode($menuHampirHabis, 15, 512) ?>;
                const labels = chartData.length 
                    ? chartData.map(item => item.menu ? item.menu.namaMenu : 'Item Terhapus') 
                    : ['Belum ada data'];
                
                const data = chartData.length 
                    ? chartData.map(item => item.jumlah_saat_ini) 
                    : [0];
                
                const backgroundColors = data.map(val => {
                    if (val <= 5) return '#DC2626'; 
                    if (val <= 10) return '#EAB308';
                    return '#4B5563';
                });

                const ctx = document.getElementById('jumlahChart').getContext('2d');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels, 
                        datasets: [{
                            label: 'Sisa Porsi',
                            data: data, 
                            backgroundColor: backgroundColors,
                            borderRadius: 4,
                            barThickness: chartData.length < 3 ? 50 : 'flex',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: 10,
                                ticks: { stepSize: 1, precision: 0 },
                                grid: { drawBorder: false }
                            },
                            x: { grid: { display: false } }
                        },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#111827',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                padding: 10,
                                cornerRadius: 6
                            }
                        }
                    }
                });
            });
        </script>
     <?php $__env->endSlot(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>