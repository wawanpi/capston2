<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                {{-- Judul --}}
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard Admin') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Ringkasan performa bisnis hari ini</p>
            </div>
            {{-- Tanggal --}}
            <div class="text-sm font-medium text-gray-500 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-200">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- BAGIAN 1: STAT CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                
                {{-- Pendapatan (Menggunakan $totalPendapatan dari Controller) --}}
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-red-600 p-5 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pendapatan Hari Ini</h3>
                            <p class="text-2xl font-bold text-gray-900 mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-2 bg-red-50 rounded-lg text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block">Total transaksi lunas</span>
                </div>

                {{-- Pesanan Baru (Menggunakan $jumlahPesananBaru dari Controller) --}}
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-gray-800 p-5 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pesanan Baru</h3>
                            <p class="text-2xl font-bold text-gray-900 mt-2">{{ $jumlahPesananBaru }}</p>
                        </div>
                        <div class="p-2 bg-gray-100 rounded-lg text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block">Menunggu konfirmasi</span>
                </div>

                {{-- Unit Terjual (Menggunakan $totalUnitTerjual dari Controller) --}}
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-red-600 p-5 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            {{-- Label disesuaikan: Unit Terjual --}}
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Unit Terjual</h3>
                            <p class="text-2xl font-bold text-gray-900 mt-2">{{ $totalUnitTerjual }}</p>
                        </div>
                        <div class="p-2 bg-red-50 rounded-lg text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block">Porsi menu terjual hari ini</span>
                </div>

                {{-- Pengguna Baru (Menggunakan $jumlahPenggunaBaru dari Controller) --}}
                <div class="bg-white rounded-xl shadow-sm border-l-4 border-gray-800 p-5 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Pengguna Baru</h3>
                            <p class="text-2xl font-bold text-gray-900 mt-2">{{ $jumlahPenggunaBaru }}</p>
                        </div>
                        <div class="p-2 bg-gray-100 rounded-lg text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                    </div>
                    <span class="text-xs text-gray-400 mt-2 block">Registrasi hari ini</span>
                </div>
            </div>
            
            {{-- BAGIAN 2: CHART & QUICK ACTIONS --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Grafik Ketersediaan (Menggunakan data DailyKetersediaan) --}}
                <div class="lg:col-span-2 bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <div class="flex justify-between items-center mb-6">
                        {{-- Ubah Label "Stok" menjadi "Ketersediaan Harian" --}}
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

                {{-- Kolom Kanan: Navigasi & Notifikasi --}}
                <div class="space-y-6">
                    {{-- Notifikasi --}}
                    <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Notifikasi</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-2 h-2 bg-red-600 rounded-full shadow-[0_0_8px_rgba(220,38,38,0.5)]"></div>
                                </div>
                                <div class="ml-3">
                                    {{-- Ubah istilah "Stok Menipis" --}}
                                    <p class="text-sm font-bold text-gray-800">Kuota Menipis</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ count($menuHampirHabis) }} menu sisa porsi sedikit</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-gray-800">Pesanan Masuk</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $jumlahPesananBaru }} pesanan baru</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- BAGIAN 3: TABEL --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    {{-- Ubah istilah "Prioritas Restok" --}}
                    <h3 class="text-lg font-bold text-gray-800">Menu Segera Habis</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-900 text-white">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nama Menu</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Kategori</th>
                                {{-- Ubah "Sisa Stok" jadi "Sisa Porsi" --}}
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Sisa Porsi</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($menuHampirHabis->take(5) as $item)
                            <tr class="hover:bg-red-50 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->menu->namaMenu }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{ $item->menu->kategori ?? '-' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-gray-800">{{ $item->jumlah_saat_ini }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($item->jumlah_saat_ini <= 5)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">Kritis</span>
                                    @elseif($item->jumlah_saat_ini <= 10)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">Sedikit</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">Aman</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                    {{-- Mengarahkan ke route yang benar untuk update availability --}}
                                    <a href="{{ route('admin.menus.edit', $item->menu->id) }}" class="text-red-600 hover:text-red-900 font-semibold">Tambah Kuota</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-sm text-gray-500">Ketersediaan menu aman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- Script JS: GANTI SELURUH BAGIAN INI --}}
    <x-slot name="scripts">
        {{-- 1. WAJIB ADA: Library Chart.js --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chartData = @json($menuHampirHabis);
                
                // Debugging: Cek data di console browser (tekan F12 -> Console)
                console.log("Data Grafik:", chartData);

                // Siapkan Label & Data
                const labels = chartData.length 
                    ? chartData.map(item => item.menu ? item.menu.namaMenu : 'Item Terhapus') 
                    : ['Belum ada data'];
                
                const data = chartData.length 
                    ? chartData.map(item => item.jumlah_saat_ini) 
                    : [0];
                
                // 2. PERBAIKAN WARNA: Tambah warna Kuning agar sesuai Tabel
                const backgroundColors = data.map(val => {
                    if (val <= 5) return '#DC2626';  // Merah (Kritis)
                    if (val <= 10) return '#EAB308'; // Kuning (Sedikit - Untuk stok 6 s/d 10)
                    return '#4B5563';                // Abu-abu (Aman)
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
                            barThickness: chartData.length < 3 ? 50 : 'flex', // Biar batang tidak kegemukan kalau data sedikit
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: 10, // Agar grafik tetap proporsional walau angka kecil
                                ticks: {
                                    stepSize: 1,   // Memaksa angka bulat (1, 2, 3)
                                    precision: 0   // Hapus desimal (0,1 hilang)
                                },
                                grid: { drawBorder: false }
                            },
                            x: {
                                grid: { display: false }
                            }
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
    </x-slot>
</x-app-layout>