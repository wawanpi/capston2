<x-app-layout>
    <x-slot name="header">
        {{-- Tipografi Header: Dibuat lebih tebal dan tegas --}}
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Detail Menu: ') }}{{ $menu->namaMenu }}
        </h2>
    </x-slot>

    {{-- Latar belakang abu-abu agar kartu putih menonjol --}}
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Kolom Kiri: Detail Menu & Gambar --}}
                <div class="md:col-span-1">
                    {{-- Kontainer Kartu: Diberi border agar rapi (konsisten) --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Menu</h3>
                            
                            @if($menu->gambar)
                                <img src="{{ asset($menu->gambar) }}" 
                                     alt="{{ $menu->namaMenu }}" 
                                     class="w-full h-48 object-cover rounded mb-4"
                                     onerror="this.src='https://placehold.co/400x300/e2e8f0/e2e8f0?text=No+Image'">
                            @endif

                            <div class="space-y-2 text-sm text-gray-700">
                                <p><strong>Kategori:</strong> 
                                    {{-- Kategori: Diubah dari Hijau/Biru menjadi Monokrom (Hitam/Abu-abu) --}}
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $menu->kategori == 'makanan' ? 'bg-gray-800 text-white' : 'bg-gray-200 text-gray-800' }}">
                                        {{ ucfirst($menu->kategori) }}
                                    </span>
                                </p>
                                <p><strong>Harga:</strong> <span class="font-semibold text-gray-900">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span></p>
                                
                                <p><strong>Jumlah Hari Ini:</strong> 
                                    @php
                                        $jumlahRiil = $menu->jumlah_saat_ini;
                                        $isLow = $jumlahRiil <= 10;
                                    @endphp
                                    {{-- Jumlah: Diubah dari Hijau (Aman) menjadi Hitam (Netral) --}}
                                    <span class="font-bold {{ $isLow ? 'text-red-600' : 'text-gray-900' }}">
                                        {{ $jumlahRiil }}
                                        @if($isLow && $jumlahRiil > 0) (Hampir Habis) @elseif ($jumlahRiil <= 0) (Habis) @endif
                                    </span>
                                </p>
                            </div>
                            
                            <p class="mt-4 text-sm text-gray-700"><strong>Deskripsi:</strong> <br>{{ $menu->deskripsi ?? 'Tidak ada deskripsi.' }}</p>

                            <div class="mt-6 flex justify-between items-center">
                                {{-- Tombol Edit: Diubah dari Indigo menjadi Tombol Merah (Primary Action) --}}
                                <a href="{{ route('admin.menus.edit', $menu->id) }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                    Edit Menu
                                </a>
                                {{-- Tombol Kembali: Tetap Netral (Abu-abu) --}}
                                <a href="{{ route('admin.menus.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Kolom Kanan: Ulasan dan Rating --}}
                <div class="md:col-span-2">
                    {{-- Kontainer Kartu: Diberi border agar rapi (konsisten) --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 mb-6">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Analitik Ulasan</h3>
                            
                            {{-- Ringkasan Rating: Diubah dari Kuning menjadi Merah (Warna Aksen Brand) --}}
                            <div class="flex items-center mb-4">
                                <p class="text-4xl font-bold text-red-600">{{ $menu->average_rating ?? '0.0' }}</p>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500">Rata-rata dari</p>
                                    <p class="text-xl font-semibold text-gray-800">{{ $menu->ratings_count ?? 0 }} Ulasan</p>
                                </div>
                            </div>

                            <h4 class="font-semibold text-gray-800 mt-6 mb-3">Semua Ulasan Pelanggan:</h4>
                            
                            {{-- Daftar Ulasan --}}
                            <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                                @forelse($menu->reviews as $review)
                                    <div class="border-b pb-3">
                                        <p class="font-semibold text-gray-800">{{ $review->user->name }}</p>
                                        {{-- Bintang Rating: Diubah dari Kuning menjadi Merah (Warna Aksen Brand) --}}
                                        <div class="flex items-center text-sm text-red-600 my-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4" fill="{{ $review->rating >= $i ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 7.91-.01L12 2z"/>
                                                </svg>
                                            @endfor
                                            <span class="ml-2 text-xs text-gray-500">({{ $review->created_at->diffForHumans() }})</span>
                                        </div>
                                        <p class="text-gray-700 text-sm italic">"{{ $review->komentar ?? 'Tidak ada komentar.' }}"</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500">Menu ini belum memiliki ulasan.</p>
                                @endforelse
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>