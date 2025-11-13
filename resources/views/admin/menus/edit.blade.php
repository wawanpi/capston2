<x-app-layout>
    <x-slot name="header">
        {{-- Tipografi Header: Dibuat lebih tebal dan tegas --}}
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu: ') }} {{ $menu->namaMenu }}
        </h2>
    </x-slot>

    {{-- Latar belakang abu-abu agar kartu putih menonjol --}}
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Kontainer Form: Diberi border agar rapi (konsisten dengan tabel index) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    
                    {{-- Notifikasi Error: Sudah Merah (On-Brand) --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong class="font-bold">Error!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.menus.update', $menu->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">

                            {{-- === 1. KATEGORI (Fokus diubah ke Merah) === --}}
                            <div>
                                <x-input-label for="kategori" :value="__('Kategori')" />
                                <select id="kategori" name="kategori" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="makanan" {{ old('kategori', $menu->kategori) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                    <option value="minuman" {{ old('kategori', $menu->kategori) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                </select>
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>

                            {{-- === 2. NAMA MENU (Fokus diubah ke Merah) === --}}
                            <div>
                                <x-input-label for="namaMenu" :value="__('Nama Menu')" />
                                {{-- Menambahkan class focus Merah, menggantikan class default --}}
                                <x-text-input id="namaMenu" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" type="text" name="namaMenu" :value="old('namaMenu', $menu->namaMenu)" required autofocus />
                                <x-input-error :messages="$errors->get('namaMenu')" class="mt-2" />
                            </div>

                            {{-- === 3. DESKRIPSI (Fokus diubah ke Merah) === --}}
                            <div>
                                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                                <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                            </div>

                            {{-- === 4. HARGA (Fokus diubah ke Merah) === --}}
                            <div>
                                <x-input-label for="harga" :value="__('Harga')" />
                                <x-text-input id="harga" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" type="number" name="harga" :value="old('harga', $menu->harga)" required />
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                            </div>

                            {{-- === 5. KAPASITAS (Fokus diubah ke Merah) === --}}
                            <div>
                                <x-input-label for="kapasitas" :value="__('Kapasitas Harian')" />
                                <x-text-input id="kapasitas" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" type="number" name="kapasitas" :value="old('kapasitas', $menu->kapasitas)" required />
                                <x-input-error :messages="$errors->get('kapasitas')" class="mt-2" />
                            </div>
                            
                            {{-- === 6. INPUT GAMBAR (Style diubah ke Merah) === --}}
                            <div>
                                <x-input-label for="gambar" :value="__('Gambar Baru (Kosongkan jika tidak ingin diubah)')" />
                                {{-- Menambahkan style file input Merah (konsisten dengan form Tambah) --}}
                                <input id="gambar" name="gambar" type="file" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:font-semibold file:bg-red-50 file:text-red-700
                                    hover:file:bg-red-100">
                                <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                            </div>

                            {{-- TAMPILKAN GAMBAR SAAT INI --}}
                            @if ($menu->gambar)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Gambar Saat Ini:</p>
                                    <img src="{{ asset($menu->gambar) }}" 
                                         alt="{{ $menu->namaMenu }}" 
                                         class="mt-1 w-32 h-32 object-cover rounded"
                                         onerror="this.src='https://placehold.co/128x128/e2e8f0/e2e8f0?text=IMG'">
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            {{-- Tombol Batal: Netral (Abu-abu) --}}
                            <a href="{{ route('admin.menus.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md mr-4"> Batal </a>
                            
                            {{-- Tombol Update: Diubah dari <x-primary-button> menjadi <button> agar style Merah (bg-red-600) & Hover Hitam (hover:bg-gray-900) konsisten --}}
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                {{ __('Update Menu') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>