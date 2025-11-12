<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-gray-600">Halaman ini berisi daftar semua pesanan yang telah lunas dibayar.</p>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl. Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode Pembayaran</th>
                                    {{-- === KOLOM BARU DITAMBAHKAN === --}}
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
                                        
                                        {{-- === KOLOM BARU DITAMBAHKAN === --}}
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
                                        {{-- PERBAIKAN: Colspan diubah menjadi 6 --}}
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada transaksi yang lunas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-4">
                        {{ $transaksis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>