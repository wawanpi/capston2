<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-red-700 leading-tight">
            {{ __('Tambah Menu Baru') }} 🍚
        </h2>
    </x-slot>

    <div class="py-12 bg-yellow-50/50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border-2 border-red-300">
                <div class="p-6 text-gray-900">
                    
                    {{-- Notifikasi Error --}}
                    @if ($errors->any())
                        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 font-semibold">
                            <strong class="font-bold">Gagal Menyimpan!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">

                            {{-- 1. KATEGORI --}}
                            <div>
                                <x-input-label for="kategori" :value="__('Kategori')" />
                                <select id="kategori" name="kategori" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="makanan" {{ old('kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                    <option value="minuman" {{ old('kategori') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                </select>
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>

                            {{-- 2. NAMA MENU --}}
                            <div>
                                <x-input-label for="namaMenu" :value="__('Nama Menu')" />
                                <x-text-input id="namaMenu" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" type="text" name="namaMenu" :value="old('namaMenu')" required autofocus />
                                <x-input-error :messages="$errors->get('namaMenu')" class="mt-2" />
                            </div>

                            {{-- 3. DESKRIPSI --}}
                            <div>
                                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                                <textarea id="deskripsi" name="deskripsi" rows="3" class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                            </div>
                            
                            {{-- 4. HARGA (ANTI KOMA & TITIK) --}}
                            <div>
                                <x-input-label for="harga" :value="__('Harga (Rupiah)')" />
                                <x-text-input 
                                    id="harga" 
                                    class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                                    type="number" 
                                    name="harga" 
                                    :value="old('harga')" 
                                    required 
                                    min="1" 
                                    placeholder="Contoh: 15000"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');" 
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                />
                                <p class="text-xs text-gray-500 mt-1">*Masukkan angka saja, tanpa titik atau koma.</p>
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                            </div>

                            {{-- 5. KAPASITAS (ANTI KOMA & TITIK) --}}
                            <div>
                                <x-input-label for="kapasitas" :value="__('Kapasitas Harian (Stok Awal)')" />
                                <x-text-input 
                                    id="kapasitas" 
                                    class="block mt-1 w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" 
                                    type="number" 
                                    name="kapasitas" 
                                    :value="old('kapasitas')" 
                                    required 
                                    min="1" 
                                    placeholder="Minimal 1 porsi"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                />
                                <p class="text-xs text-gray-500 mt-1">*Masukkan angka bulat saja.</p>
                                <x-input-error :messages="$errors->get('kapasitas')" class="mt-2" />
                            </div>
                            
                            {{-- 6. INPUT GAMBAR --}}
                            <div>
                                <x-input-label for="gambar" :value="__('Gambar Menu')" />
                                <input id="gambar" name="gambar" type="file" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:font-semibold file:bg-red-50 file:text-red-700
                                    hover:file:bg-red-100" required>
                                <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.menus.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md mr-4"> Batal </a>
                            
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors shadow-md">
                                <i class="fas fa-plus mr-1"></i> {{ __('Simpan Menu') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>