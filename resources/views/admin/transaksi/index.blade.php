<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- === BLOK BARU: FILTER WAKTU === --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Filter Laporan</h3>
                    
                    {{-- Filter Cepat --}}
                    <div class="flex space-x-2 mb-4">
                        {{-- Logika 'class' akan menandai tombol yang aktif --}}
                        <a href="{{ route('admin.transaksi.index', ['range' => 'daily']) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 {{ request('range', 'daily') == 'daily' && !request('start_date') ? 'bg-blue-600 text-white hover:bg-blue-700' : '' }}">
                            Hari Ini
                        </a>
                        <a href="{{ route('admin.transaksi.index', ['range' => 'weekly']) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 {{ request('range') == 'weekly' ? 'bg-blue-600 text-white hover:bg-blue-700' : '' }}">
                            Minggu Ini
                        </a>
                        <a href="{{ route('admin.transaksi.index', ['range' => 'monthly']) }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 {{ request('range') == 'monthly' ? 'bg-blue-600 text-white hover:bg-blue-700' : '' }}">
                            Bulan Ini
                        </a>
                    </div>
                    
                    {{-- Filter Kustom --}}
                    <form action="{{ route('admin.transaksi.index') }}" method="GET">
                        <div class="flex flex-col md:flex-row md:items-end space-y-2 md:space-y-0 md:space-x-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <x-primary-button type="submit">
                                Terapkan Filter
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- === BLOK BARU: TOTAL PENDAPATAN === --}}
            {{-- Variabel $totalPendapatan dan $filterLabel dikirim dari Controller --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Total Pendapatan ({{ $filterLabel }})</h3>
                    <p class="text-4xl font-bold text-green-600">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            {{-- === TABEL ANDA YANG SEBELUMNYA === --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-gray-600">Daftar transaksi lunas untuk periode: {{ $filterLabel }}</p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl. Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Bayar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($transaksis as $transaksi)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="{{ route('admin.pesanan.show', $transaksi->pesanan_id) }}" class="text-indigo-600 hover:underline">
                                                #TRX-{{ $transaksi->id }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaksi->pesanan->user->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $transaksi->metode_pembayaran }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">
                                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($transaksi->status_pembayaran == 'paid')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Lunas (Paid)
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Gagal
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            Belum ada transaksi yang lunas untuk periode ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-4">
                        {{-- withQueryString() penting agar filter tidak hilang saat ganti halaman --}}
                        {{ $transaksis->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>