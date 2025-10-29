<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan #') }}{{ $pesanan->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> {{-- Dibuat lebih ramping --}}
            
            <!-- Card 1: Ringkasan Status & Total -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4 border-b pb-2">Ringkasan Pesanan</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm font-medium text-gray-500">ID Pesanan</p>
                            <p class="font-semibold text-lg">#{{ $pesanan->id }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Pesan</p>
                            <p class="font-semibold text-lg">{{ $pesanan->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Status Pesanan</p>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                @if($pesanan->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                @if($pesanan->status == 'processing') bg-blue-100 text-blue-800 @endif
                                @if($pesanan->status == 'completed') bg-green-100 text-green-800 @endif
                                @if($pesanan->status == 'cancelled') bg-red-100 text-red-800 @endif
                            ">
                                {{ ucfirst($pesanan->status) }}
                            </span>
                        </div>
                         <div>
                            <p class="text-sm font-medium text-gray-500">Total Pembayaran</p>
                            <p class="font-semibold text-lg text-kfc-red">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</p>
                        </div>
                    </div>
                     @if($pesanan->catatan_pelanggan)
                        <div class="mt-4 pt-4 border-t">
                            <p class="text-sm font-medium text-gray-500">Catatan Anda:</p>
                            <p class="text-gray-700 italic">"{{ $pesanan->catatan_pelanggan }}"</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Card 2: Rincian Item -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Item yang Dipesan</h3>
                    <div class="space-y-4">
                        @foreach($pesanan->details as $item)
                            <div class="flex justify-between items-center border-b pb-3">
                                <div class="flex items-center">
                                    <img src="{{ asset($item->menu->gambar) }}" alt="{{ $item->menu->namaMenu }}" class="w-16 h-16 object-cover rounded mr-4">
                                    <div>
                                        <p class="font-semibold">{{ $item->menu->namaMenu }}</p>
                                        <p class="text-sm text-gray-600">{{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <p class="text-md font-semibold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Kembali ke Riwayat Pesanan</a>
            </div>

        </div>
    </div>
</x-app-layout>

