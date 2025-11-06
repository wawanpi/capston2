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
                
                <!-- Card Total Pendapatan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pendapatan</h3>
                        <p class="text-3xl font-semibold text-green-600 mt-2">Rp <?php echo e(number_format($totalPendapatan, 0, ',', '.')); ?></p>
                        <span class="text-xs text-gray-500">(Dari pesanan 'completed')</span>
                    </div>
                </div>

                <!-- Card Pesanan Baru -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pesanan Baru (Pending)</h3>
                        <p class="text-3xl font-semibold text-yellow-600 mt-2"><?php echo e($jumlahPesananBaru); ?></p>
                        <span class="text-xs text-gray-500">Pesanan perlu diproses</span>
                    </div>
                </div>

                <!-- Card Jumlah Pengguna -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Jumlah Pengguna</h3>
                        <p class="text-3xl font-semibold text-blue-600 mt-2"><?php echo e($jumlahPengguna); ?></p>
                        <span class="text-xs text-gray-500">(Pelanggan terdaftar)</span>
                    </div>
                </div>

                <!-- Card Jumlah Menu -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Jumlah Menu</h3>
                        <p class="text-3xl font-semibold text-indigo-600 mt-2"><?php echo e($jumlahProduk); ?></p>
                        <span class="text-xs text-gray-500">(Total item dijual)</span>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Kolom Kiri: Grafik Stok Habis -->
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Grafik Stok Hampir Habis</h3>
                        <div class="relative h-72">
                            
                            <canvas id="stokChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Link Navigasi Cepat -->
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
        <!-- 1. Memuat library Chart.js dari CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- 2. Script untuk inisialisasi chart -->
        <script>
            // Ambil data stok dari controller yang dikirim sebagai JSON
            const stokData = <?php echo json_encode($stokHampirHabis, 15, 512) ?>;

            // Siapkan label (nama menu) dan data (jumlah stok)
            const labels = stokData.map(item => item.namaMenu);
            const data = stokData.map(item => item.stok);

            // Ambil elemen canvas
            const ctx = document.getElementById('stokChart').getContext('2d');

            // Buat chart baru
            new Chart(ctx, {
                type: 'bar', // Tipe chart: bar (batang)
                data: {
                    labels: labels, // Nama menu di sumbu X
                    datasets: [{
                        label: 'Sisa Stok',
                        data: data, // Jumlah stok di sumbu Y
                        backgroundColor: 'rgba(227, 0, 43, 0.6)', // Warna merah (bg-kfc-red)
                        borderColor: 'rgba(227, 0, 43, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true, // Chart akan menyesuaikan ukuran
                    maintainAspectRatio: false, // Izinkan chart mengisi tinggi 'div'
                    scales: {
                        y: {
                            beginAtZero: true, // Mulai sumbu Y dari 0
                            ticks: {
                                // Pastikan hanya angka bulat (tidak ada 1.5 stok)
                                precision: 0 
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Sembunyikan legenda "Sisa Stok"
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