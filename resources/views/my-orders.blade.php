<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- === BLOK NOTIFIKASI === --}}
                    @if (session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- === AKHIR BLOK NOTIFIKASI === --}}

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Bayar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pesanans as $pesanan)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $pesanan->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pesanan->created_at->format('d M Y, H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            {{-- Logika untuk warna status --}}
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($pesanan->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                                @if($pesanan->status == 'processing') bg-blue-100 text-blue-800 @endif
                                                @if($pesanan->status == 'completed') bg-green-100 text-green-800 @endif
                                                @if($pesanan->status == 'cancelled') bg-red-100 text-red-800 @endif
                                            ">
                                                {{ ucfirst($pesanan->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('orders.show', $pesanan->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>

                                            {{-- === TOMBOL "BERI ULASAN" BARU === --}}
                                            {{-- Tampilkan tombol HANYA jika status COMPLETED DAN pesanan belum punya review --}}
                                            @if($pesanan->status == 'completed' && $pesanan->reviews->isEmpty())
                                                <a href="{{ route('reviews.create', $pesanan->id) }}" class="text-yellow-600 hover:text-yellow-900 ml-4">
                                                    Beri Ulasan
                                                </a>
                                            @elseif($pesanan->status == 'completed' && $pesanan->reviews->isNotEmpty())
                                                <span class="ml-4 text-gray-500 text-xs">(Sudah Diulas)</span>
                                            @endif
                                            {{-- =================================== --}}
                                            
                                            {{-- === TOMBOL "PESAN LAGI" DITAMBAHKAN DI SINI === --}}
                                            @if($pesanan->status == 'completed' || $pesanan->status == 'cancelled')
                                                <form action="{{ route('orders.reorder', $pesanan->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="ml-4 text-green-600 hover:text-green-900">
                                                        Pesan Lagi
                                                    </button>
                                                </form>
                                            @endif
                                            {{-- === AKHIR TOMBOL "PESAN LAGI" === --}}
                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Anda belum memiliki riwayat pesanan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Link Pagination --}}
                    <div class="mt-4">
                        {{ $pesanans->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>