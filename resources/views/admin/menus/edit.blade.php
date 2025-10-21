<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu: ') }} {{ $menu->namaMenu }}
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
                    <form method="POST" action="{{ route('admin.menus.update', $menu->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="namaMenu" :value="__('Nama Menu')" />
                                <x-text-input id="namaMenu" class="block mt-1 w-full" type="text" name="namaMenu" :value="old('namaMenu', $menu->namaMenu)" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="harga" :value="__('Harga')" />
                                <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga', $menu->harga)" required step="0.01" />
                            </div>
                            <div>
                                <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                                <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="stok" :value="__('Stok')" />
                                <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok', $menu->stok)" required />
                            </div>
                            
                            {{-- INPUT UNTUK GAMBAR BARU --}}
                            <div>
                                <x-input-label for="gambar" :value="__('Gambar Baru (Kosongkan jika tidak ingin diubah)')" />
                                <input id="gambar" name="gambar" type="file" class="block mt-1 w-full">
                                <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                            </div>

                            {{-- TAMPILKAN GAMBAR SAAT INI --}}
                            @if ($menu->gambar)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Gambar Saat Ini:</p>
                                    <img src="{{ Storage::url($menu->gambar) }}" alt="{{ $menu->namaMenu }}" class="mt-1 w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-6">
                             <a href="{{ route('admin.menus.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md mr-4"> Batal </a>
                            <x-primary-button> {{ __('Update Menu') }} </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

