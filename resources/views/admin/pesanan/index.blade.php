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
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                    
                                    {{-- === PERBAIKAN: Ganti Tanggal menjadi Item === --}}
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item Dipesan</th>
                                    
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe Layanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Tamu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pesanans as $pesanan)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $pesanan->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pesanan->user->name }}</td>
                                        
                                        {{-- === PERBAIKAN: Tampilkan daftar item (dibatasi 2 item pertama) === --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{-- Pastikan relasi 'details' sudah di-load dari controller --}}
                                            @if ($pesanan->relationLoaded('details'))
                                                <ul class="list-disc list-inside">
                                                    @foreach ($pesanan->details->take(2) as $detail)
                                                        <li>
                                                            {{ $detail->menu->namaMenu ?? 'Menu Dihapus' }} 
                                                            <span class="font-semibold"> (x{{ $detail->jumlah }})</span>
                                                        </li>
                                                    @endforeach
                                                    @if ($pesanan->details->count() > 2)
                                                        <li class="italic text-xs text-gray-400">+ {{ $pesanan->details->count() - 2 }} item lainnya...</li>
                                                    @endif
                                                </ul>
                                            @else
                                                <span class="text-red-500 text-xs italic">(Error: Relasi 'details' belum di-load)</span>
                                            @endif
                                        </td>
                                        
                                        {{-- Menampilkan Tipe Layanan --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($pesanan->tipe_layanan == 'Dine-in')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                    Dine-in
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Take Away
                                                </span>
                                            @endif
                                        </td>
                                        
                                        {{-- Menampilkan Jumlah Tamu --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($pesanan->tipe_layanan == 'Dine-in')
                                                {{ $pesanan->jumlah_tamu }} orang
                                            @else
                                                -
                                            @endif
                                        </td>
                                        
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
                                        {{-- Colspan 7 sudah benar --}}
                                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada pesanan.</td>
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
    </div>
</x-app-layout>