<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Menu Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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

                    {{-- TAMBAHKAN enctype UNTUK UPLOAD FILE --}}
                    <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">

                            {{-- === 1. BLOK KATEGORI (PINDAH KE ATAS) === --}}
                            <div>
                                <x-input-label for="kategori" :value="__('Kategori')" />
                                <select id="kategori" name="kategori" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    {{-- 'old' helper untuk mengingat pilihan jika validasi gagal --}}
                                    <option value="makanan" {{ old('kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                    <option value="minuman" {{ old('kategori') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                </select>
                                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                            </div>

                            {{-- === 2. NAMA MENU === --}}
                            <div>
                                <x-input-label for="namaMenu" :value="__('Nama Menu')" />
                                <x-text-input id="namaMenu" class="block mt-1 w-full" type="text" name="namaMenu" :value="old('namaMenu')" required autofocus />
                                <x-input-error :messages="$errors->get('namaMenu')" class="mt-2" />
                            </div>

                            {{-- === 3. DESKRIPSI === --}}
                            <div>
                                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                                <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi') }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                            </div>
                            
                            {{-- === 4. HARGA === --}}
                            <div>
                                <x-input-label for="harga" :value="__('Harga')" />
                                <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga')" required />
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                            </div>

                            {{-- === 5. PERBAIKAN: STOK MENJADI KAPASITAS === --}}
                            <div>
                                {{-- Label diubah dari 'Stok' menjadi 'Kapasitas Harian' --}}
                                <x-input-label for="kapasitas" :value="__('Kapasitas Harian')" />
                                {{-- ID dan Name diubah dari 'stok' menjadi 'kapasitas' --}}
                                <x-text-input id="kapasitas" class="block mt-1 w-full" type="number" name="kapasitas" :value="old('kapasitas', 0)" required />
                                {{-- Error message diubah dari 'stok' menjadi 'kapasitas' --}}
                                <x-input-error :messages="$errors->get('kapasitas')" class="mt-2" />
                            </div>
                            
                            {{-- === 6. INPUT GAMBAR === --}}
                            <div>
                                <x-input-label for="gambar" :value="__('Gambar Menu')" />
                                <input id="gambar" name="gambar" type="file" class="block mt-1 w-full" required>
                                <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-6">
                             <a href="{{ route('admin.menus.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md mr-4"> Batal </a>
                            <x-primary-button> {{ __('Simpan Menu') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>