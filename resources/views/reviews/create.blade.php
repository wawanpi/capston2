<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beri Ulasan Pesanan #') }}{{ $pesanan->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Menampilkan Error Validasi Global --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong class="font-bold">Ulasan Gagal Disimpan!</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('reviews.store', $pesanan->id) }}" method="POST">
                        @csrf

                        <p class="text-lg font-semibold mb-6">Silakan beri bintang dan ulasan untuk setiap item dalam pesanan Anda.</p>

                        <div class="space-y-8">
                            
                            {{-- LOOP UNTUK SETIAP ITEM DI PESANAN --}}
                            @foreach ($pesanan->details as $index => $detail)
                                {{-- x-data untuk mengelola state rating Alpine.js --}}
                                <div class="border p-4 rounded-lg bg-gray-50" x-data="{ currentRating: {{ old('reviews.' . $detail->menu_id . '.rating', 0) }} }">
                                    <div class="flex items-center space-x-4 mb-4">
                                        {{-- Gambar Menu --}}
                                        <img src="{{ asset($detail->menu->gambar) }}" 
                                             alt="{{ $detail->menu->namaMenu }}" 
                                             class="w-16 h-16 object-cover rounded-full"
                                             onerror="this.src='https://placehold.co/64x64/e2e8f0/e2e8f0?text=IMG'">
                                        
                                        <div>
                                            <h4 class="font-bold text-lg">{{ $detail->menu->namaMenu }}</h4>
                                            <p class="text-sm text-gray-600">{{ $detail->jumlah }} porsi ({{ $detail->menu->kategori }})</p>
                                        </div>
                                    </div>

                                    {{-- Kolom Rating Bintang --}}
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Beri Bintang:</label>
                                        <div class="flex space-x-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <button type="button" 
                                                        @click="currentRating = {{ $i }}" 
                                                        @mouseenter="tempRating = {{ $i }}" 
                                                        @mouseleave="tempRating = currentRating" 
                                                        class="text-gray-300 hover:text-yellow-400 transition-colors duration-150">
                                                    
                                                    {{-- Ikon Bintang --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                                         class="w-8 h-8" 
                                                         :class="{ 'text-yellow-400': currentRating >= {{ $i }} }"
                                                         viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                                    </svg>
                                                </button>
                                            @endfor
                                        </div>
                                        
                                        {{-- Input Tersembunyi untuk menyimpan nilai rating --}}
                                        <input type="hidden" name="reviews[{{ $detail->menu_id }}][menu_id]" value="{{ $detail->menu_id }}">
                                        <input type="hidden" 
                                               name="reviews[{{ $detail->menu_id }}][rating]" 
                                               :value="currentRating" 
                                               required>
                                        
                                        {{-- Menampilkan error spesifik untuk rating ini --}}
                                        @error('reviews.' . $detail->menu_id . '.rating')
                                            <p class="text-red-500 text-xs mt-1">Rating wajib diisi.</p>
                                        @enderror
                                    </div>

                                    {{-- Kolom Komentar --}}
                                    <div>
                                        <label for="komentar_{{ $detail->menu_id }}" class="block text-sm font-medium text-gray-700 mb-1">Komentar (Opsional):</label>
                                        <textarea id="komentar_{{ $detail->menu_id }}" 
                                                  name="reviews[{{ $detail->menu_id }}][komentar]" 
                                                  rows="2" 
                                                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('reviews.' . $detail->menu_id . '.komentar') }}</textarea>
                                        @error('reviews.' . $detail->menu_id . '.komentar')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('orders.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md mr-4"> Kembali </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-kfc-red border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                Kirimkan Ulasan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>