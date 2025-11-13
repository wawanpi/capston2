<x-app-layout>
    <x-slot name="header">
        {{-- Tipografi Header: Dibuat lebih tebal dan tegas --}}
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Menu') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50"> {{-- Latar belakang abu-abu agar kartu putih menonjol --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                
                {{-- Tombol Aksi Utama: Diubah dari Hijau menjadi Merah (Warna Brand Utama) --}}
                <a href="{{ route('admin.menus.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                    Tambah Menu
                </a>
                
                <form method="GET" action="{{ route('admin.menus.index') }}">
                    <div class="flex">
                        {{-- Input Search: Fokus diubah ke Merah --}}
                        <input type="text" name="search" placeholder="Cari nama menu..." 
                               class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                               value="{{ request('search') }}">
                        
                        {{-- Tombol Aksi Sekunder: Diubah dari Biru menjadi Hitam (Warna Brand Sekunder) --}}
                        <button type="submit" 
                                class="ml-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            {{-- Notifikasi Sukses: Diubah dari Hijau menjadi Merah muda (Sesuai Brand) --}}
            @if ($message = Session::get('success'))
                <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif

            {{-- Kontainer Tabel: Diberi border agar rapi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            {{-- Header Tabel: Diubah menjadi Hitam (Sesuai Footer) --}}
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Gambar</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Nama Menu</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Rating</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-200 uppercase tracking-wider">Kapasitas Harian</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-200 uppercase tracking-wider">Jumlah Hari Ini</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-200 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($menus as $menu)
                                    <tr class="hover:bg-gray-50">
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
                                        
                                        {{-- Tag Kategori: Dibuat Monokrom (Hitam & Abu-abu) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($menu->kategori == 'makanan')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-800 text-white">Makanan</span>
                                            @elseif($menu->kategori == 'minuman')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-200 text-gray-800">Minuman</span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                        
                                        {{-- Rating: Diubah dari Kuning menjadi Merah (Warna Aksen Brand) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center">
                                                <span class="font-bold text-red-600 mr-1">{{ number_format($menu->average_rating, 1) }}</span>
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
                                                {{-- Status Habis: Sudah Merah (On-Brand) --}}
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-red-600 text-white shadow-md">
                                                    HABIS
                                                </span>
                                            @elseif($isLow)
                                                {{-- Status Rendah: Diubah dari Kuning ke Abu-abu (Monokrom) --}}
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-200 text-gray-800 border border-gray-300">
                                                    {{ $jumlahRiil }} (Jumlah Rendah)
                                                </span>
                                            @else
                                                <span class="text-gray-900 font-semibold">
                                                    {{ $jumlahRiil }}
                                                </span>
                                            @endif
                                        </td>
                                        
                                        {{-- KOLOM AKSI: Warna diseragamkan (Monokrom + Merah untuk Aksi Penting) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2 items-center justify-center">
                                            
                                            {{-- Ulasan: Netral (Abu-abu) --}}
                                            <a href="{{ route('admin.menus.show', $menu->id) }}" class="text-gray-600 hover:text-gray-900 border border-gray-300 p-1 rounded-md text-xs font-semibold">
                                                Ulasan
                                            </a>
                                            
                                            {{-- Edit: Aksi Utama (Merah) --}}
                                            <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-red-600 hover:text-red-800 border border-gray-300 p-1 rounded-md text-xs font-semibold">
                                                Edit
                                            </a>
                                            
                                            {{-- PERBAIKAN: Tambahkan class "m-0" untuk mereset margin default browser pada form --}}
                                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                {{-- Hapus: Aksi Berbahaya (Netral -> Merah saat hover) --}}
                                                <button type="submit" class="text-gray-600 hover:text-red-600 border border-gray-300 p-1 rounded-md text-xs font-semibold">Hapus</button>
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