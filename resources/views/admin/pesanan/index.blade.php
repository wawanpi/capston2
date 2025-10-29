<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Bayar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($pesanans as $pesanan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $pesanan->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pesanan->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pesanan->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($pesanan->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                            @if($pesanan->status == 'processing') bg-blue-100 text-blue-800 @endif
                                            @if($pesanan->status == 'completed') bg-green-100 text-green-800 @endif
                                            @if($pesanan->status == 'cancelled') bg-red-100 text-red-800 @endif
                                        ">{{ $pesanan->status }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                     <div class="mt-4">
                        {{ $pesanans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
