<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Stok Harian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex items-center mb-6">
                        <!-- Tampilkan Gambar Menu -->
                        <img src="{{ asset($menu->gambar) }}" 
                             alt="{{ $menu->namaMenu }}" 
                             class="w-20 h-20 object-cover rounded-lg border border-gray-200 mr-4"
                             onerror="this.src='https://placehold.co/80x80?text=No+Img'">
                        
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $menu->namaMenu }}</h3>
                            <p class="text-sm text-gray-500">{{ $menu->kategori }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-100">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-600">Sisa Porsi Saat Ini:</span>
                            <span class="text-2xl font-bold {{ $ketersediaan->jumlah_saat_ini <= 5 ? 'text-red-600' : 'text-gray-800' }}">
                                {{ $ketersediaan->jumlah_saat_ini }} Porsi
                            </span>
                        </div>
                    </div>

                    <form action="{{ route('admin.menus.updateKuota', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="tambahan_kuota" class="block text-sm font-medium text-gray-700 mb-1">
                                Tambah Berapa Porsi?
                            </label>
                            <input type="number" 
                                   name="tambahan_kuota" 
                                   id="tambahan_kuota" 
                                   min="1" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                   placeholder="Contoh: 10" 
                                   required 
                                   autofocus>
                            @error('tambahan_kuota')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-2">
                                * Porsi akan langsung bertambah di Dashboard .
                            </p>
                        </div>

                        <div class="flex justify-end space-x-2 mt-6">
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-300 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-bold hover:bg-red-700 transition shadow-md">
                                Simpan Stok
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>