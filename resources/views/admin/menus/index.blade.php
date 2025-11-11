<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Tambah Menu
                </a>
                <form method="GET" action="{{ route('admin.menus.index') }}">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Cari nama menu..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ request('search') }}">
                        <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Menu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rating</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Kapasitas Harian</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Jumlah Hari Ini</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($menus as $menu)
                                    <tr>
                                        {{-- TAMPILKAN GAMBAR --}}
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($menu->gambar)
                                                <img src="{{ asset($menu->gambar) }}" 
                                                    alt="{{ $menu->namaMenu }}" 
                                                    class="w-16 h-16 object-cover rounded"
                                                    onerror="this.src='https://placehold.co/64x64/e2e8f0/e2e8f0?text=IMG'">
                                            @else
                                                <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center">
                                                    <span class="text-xs text-gray-400">No Image</span>
                                                </div>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $menu->namaMenu }}</td>
                                        
                                        {{-- KOLOM KATEGORI --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($menu->kategori == 'makanan')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Makanan</span>
                                            @elseif($menu->kategori == 'minuman')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Minuman</span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                        
                                        {{-- KOLOM RATING --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center">
                                                <span class="font-bold text-yellow-500 mr-1">{{ number_format($menu->average_rating, 1) }}</span>
                                                <span class="text-xs text-gray-500"> ({{ $menu->ratings_count }} ulasan)</span>
                                            </div>
                                        </td>
                                        
                                        {{-- KAPASITAS HARIAN --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            {{ $menu->kapasitas }}
                                        </td>
                                        
                                        {{-- JUMLAH HARI INI (RIIL) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            @php
                                                $jumlahRiil = $menu->jumlah_saat_ini;
                                                $isLow = $jumlahRiil < 10 && $jumlahRiil > 0;
                                                $isHabis = $jumlahRiil <= 0;
                                            @endphp
                                            
                                            @if($isHabis)
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-red-600 text-white shadow-md">
                                                    HABIS
                                                </span>
                                            @elseif($isLow)
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                                                    {{ $jumlahRiil }} (Jumlah Rendah)
                                                </span>
                                            @else
                                                <span class="text-gray-900 font-semibold">
                                                    {{ $jumlahRiil }}
                                                </span>
                                            @endif
                                        </td>
                                        
                                        {{-- PERBAIKAN: KOLOM AKSI (TOMBOL ULASAN DITAMBAHKAN KEMBALI) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2 items-center">
                                            
                                            <a href="{{ route('admin.menus.show', $menu->id) }}" class="text-blue-600 hover:text-blue-900 border p-1 rounded-md text-xs font-semibold">
                                                Ulasan
                                            </a>
                                            
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-indigo-600 hover:text-indigo-900 border p-1 rounded-md text-xs font-semibold">
                                                Edit
                                            </a>
                                            
                                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 border p-1 rounded-md text-xs font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada menu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $menus->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>