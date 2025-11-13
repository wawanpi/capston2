<x-app-layout>
    <x-slot name="header">
        {{-- Tipografi Header: Dibuat lebih tebal dan tegas --}}
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    {{-- Latar belakang abu-abu agar kartu putih menonjol --}}
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- === BLOK FILTER WAKTU (Style Disesuaikan) === --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Filter Laporan</h3>
                    
                    {{-- Filter Cepat: Tombol Aktif diubah dari Biru ke Merah (Brand) --}}
                    <div class="flex space-x-2 mb-4">
                        <a href="{{ route('admin.transaksi.index', ['range' => 'daily']) }}" class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request('range', 'daily') == 'daily' && !request('start_date') ? 'bg-red-600 text-white hover:bg-red-700' : 'text-gray-700 bg-gray-100 hover:bg-gray-200' }}">
                            Hari Ini
                        </a>
                        <a href="{{ route('admin.transaksi.index', ['range' => 'weekly']) }}" class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request('range') == 'weekly' ? 'bg-red-600 text-white hover:bg-red-700' : 'text-gray-700 bg-gray-100 hover:bg-gray-200' }}">
                            Minggu Ini
                        </a>
                        <a href="{{ route('admin.transaksi.index', ['range' => 'monthly']) }}" class="px-4 py-2 text-sm font-medium rounded-md transition-colors {{ request('range') == 'monthly' ? 'bg-red-600 text-white hover:bg-red-700' : 'text-gray-700 bg-gray-100 hover:bg-gray-200' }}">
                            Bulan Ini
                        </a>
                    </div>
                    
                    {{-- Filter Kustom: Input Fokus diubah ke Merah, Tombol diubah ke Merah --}}
                    <form action="{{ route('admin.transaksi.index') }}" method="GET">
                        <div class="flex flex-col md:flex-row md:items-end space-y-2 md:space-y-0 md:space-x-4">
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                            </div>
                            
                            {{-- Tombol Terapkan: Diubah dari <x-primary-button> ke <button> Merah --}}
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- === BLOK TOTAL PENDAPATAN (Style Disesuaikan) === --}}
            {{-- Kartu Stat: Diberi Aksen Hitam (Monokrom), Warna Teks Hijau dihilangkan --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-gray-800">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Total Pendapatan ({{ $filterLabel }})</h3>
                    <p class="text-4xl font-bold text-gray-800">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            {{-- === TABEL RIWAYAT TRANSAKSI (Style Disesuaikan) === --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-gray-600">Daftar transaksi lunas untuk periode: {{ $filterLabel }}</p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            {{-- Header Tabel: Diubah menjadi Hitam (Sesuai Footer) --}}
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
                                @forelse ($transaksis as $transaksi)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{-- Link: Diubah dari Indigo menjadi Merah (Brand) --}}
                                            <a href="{{ route('admin.pesanan.show', $transaksi->pesanan_id) }}" class="text-red-600 hover:text-red-800 font-semibold hover:underline">
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
                                                {{-- Status Lunas: Diubah dari Hijau ke Monokrom (Netral) --}}
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-white text-gray-700 border border-gray-300">
                                                    Lunas (Paid)
                                                </span>
                                            @else
                                                {{-- Status Gagal: Sudah Merah (On-Brand) --}}
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
                        {{-- Paginasi (Sudah konsisten) --}}
                        {{ $transaksis->withQueryString()->links() }}
                   </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>