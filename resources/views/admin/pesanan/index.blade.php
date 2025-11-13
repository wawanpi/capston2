<x-app-layout>
    <x-slot name="header">
        {{-- Tipografi Header: Dibuat lebih tebal dan tegas --}}
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pesanan') }}
        </h2>
    </x-slot>

    {{-- Latar belakang abu-abu agar kartu putih menonjol --}}
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer Tabel: Diberi border agar rapi (konsisten) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            {{-- Header Tabel: Diubah menjadi Hitam (Sesuai Footer) --}}
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">ID Pesanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Item Dipesan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Tipe Layanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Jumlah Tamu</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pesanans as $pesanan)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $pesanan->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $pesanan->user->name }}</td>
                                        
                                        {{-- Kolom Item Dipesan (Logic PHP tidak berubah) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                                        
                                        {{-- Tipe Layanan: Diubah ke Monokrom (Hitam/Abu-abu) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($pesanan->tipe_layanan == 'Dine-in')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-800 text-white">
                                                    Dine-in
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">
                                                    Take Away
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($pesanan->tipe_layanan == 'Dine-in')
                                                {{ $pesanan->jumlah_tamu }} orang
                                            @else
                                                -
                                            @endif
                                        </td>
                                        
                                        {{-- Status Pesanan: Diubah ke Monokrom (Kecuali Merah/Cancelled) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($pesanan->status == 'pending') bg-gray-200 text-gray-800 @endif
                                                @if($pesanan->status == 'processing') bg-gray-800 text-white @endif
                                                @if($pesanan->status == 'completed') bg-white text-gray-500 border border-gray-300 @endif
                                                @if($pesanan->status == 'cancelled') bg-red-100 text-red-800 @endif
                                            ">{{ $pesanan->status }}</span>
                                        </td>
                                        
                                        {{-- Tombol Aksi: Diubah dari Indigo menjadi Merah (Bordered style) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="text-red-600 hover:text-red-800 border border-gray-300 p-1 rounded-md text-xs font-semibold">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 whitespace-nowNrap text-sm text-gray-500 text-center">Belum ada pesanan.</td>
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