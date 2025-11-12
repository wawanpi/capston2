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
            <?php echo e(__('Dashboard Admin')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan (Hari Ini)</h3>
                        <p class="text-3xl font-semibold text-green-600 mt-2">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></p>
                        <span class="text-xs text-gray-500">(Dari transaksi lunas hari ini)</span>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pesanan Baru (Hari Ini)</h3>
                        <p class="text-3xl font-semibold text-yellow-600 mt-2"><?php echo e($jumlahPesananBaru); ?></p>
                        <span class="text-xs text-gray-500">(Status 'pending' hari ini)</span>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Unit Terjual (Hari Ini)</h3>
                        
                        <p class="text-3xl font-semibold text-blue-600 mt-2"><?php echo e($totalUnitTerjual); ?></p>
                        <span class="text-xs text-gray-500">(Dari pesanan berhasil hari ini)</span>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pengguna Baru (Hari Ini)</h3>
                        
                        <p class="text-3xl font-semibold text-indigo-600 mt-2"><?php echo e($jumlahPenggunaBaru); ?></p>
                        <span class="text-xs text-gray-500">(Pelanggan baru mendaftar)</span>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Grafik Jumlah Menu Hampir Habis (Hari Ini)</h3>
                        <div class="relative h-72">
                            <canvas id="jumlahChart"></canvas> 
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Navigasi Cepat</h3>
                        <div class="space-y-3">
                            <a href="<?php echo e(route('admin.menus.create')); ?>" class="flex items-center justify-center w-full px-4 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-700">
                                Tambah Menu Baru
                            </a>
                            <a href="<?php echo e(route('admin.pesanan.index')); ?>" class="flex items-center justify-center w-full px-4 py-3 bg-yellow-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-yellow-700">
                                Kelola Pesanan
                            </a>
                            <a href="<?php echo e(route('admin.menus.index')); ?>" class="flex items-center justify-center w-full px-4 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700">
                                Lihat Semua Menu
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    
     <?php $__env->slot('scripts', null, []); ?> 
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            // Ambil data dari '$menuHampirHabis' (sesuai Controller)
            const chartData = <?php echo json_encode($menuHampirHabis, 15, 512) ?>;

            // Akses nama menu melalui relasi (item.menu.namaMenu)
            const labels = chartData.map(item => item.menu.namaMenu);
            // Akses jumlah dari 'jumlah_saat_ini'
            const data = chartData.map(item => item.jumlah_saat_ini);

            const ctx = document.getElementById('jumlahChart').getContext('2d'); // Pastikan ID ini 'jumlahChart'

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, 
                    datasets: [{
                        label: 'Sisa Jumlah Hari Ini',
                        data: data, 
                        backgroundColor: 'rgba(227, 0, 43, 0.6)', // Warna merah
                        borderColor: 'rgba(227, 0, 43, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0 
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false 
                        }
                    }
                }
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