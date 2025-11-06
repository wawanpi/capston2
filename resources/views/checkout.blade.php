<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Form ini akan mengirim data ke CheckoutController@store --}}
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h3>
                            <div class="space-y-4">
                                @foreach ($cartItems as $item)
                                <div class="flex justify-between items-start border-b pb-2">
                                    <div class="flex items-center">
                                        {{-- Menambahkan gambar placeholder jika tidak ada gambar --}}
                                        <img src="{{ $item->attributes->image ? asset($item->attributes->image) : 'https://placehold.co/64x64/e2e8f0/e2e8f0?text=IMG' }}" 
                                             alt="{{ $item->name }}" 
                                             class="w-16 h-16 object-cover rounded mr-4"
                                             onerror="this.src='https://placehold.co/64x64/e2e8f0/e2e8f0?text=IMG'">
                                        <div>
                                            <p class="font-semibold">{{ $item->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-800">Rp {{ number_format($item->getPriceSum(), 0, ',', '.') }}</p>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-6 pt-4 border-t">
                                <div class="flex justify-between items-center text-lg font-bold">
                                    <span>Total Bayar:</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6 text-gray-900">
                            
                            {{-- Pilihan Tipe Layanan --}}
                            <h3 class="text-xl font-semibold mb-4">Pilih Tipe Layanan</h3>
                            <div class="flex space-x-4 mb-2">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer flex-1">
                                    {{-- Menambahkan 'id' untuk JavaScript dan helper 'old' --}}
                                    <input type="radio" id="tipe_take_away" name="tipe_layanan" value="Take Away" class="mr-2 text-kfc-red focus:ring-kfc-red" {{ old('tipe_layanan', 'Take Away') == 'Take Away' ? 'checked' : '' }}>
                                    <span class="font-semibold">Ambil di Tempat (Take Away)</span>
                                </label>
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer flex-1">
                                    {{-- Menambahkan 'id' untuk JavaScript dan helper 'old' --}}
                                    <input type="radio" id="tipe_dine_in" name="tipe_layanan" value="Dine-in" class="mr-2 text-kfc-red focus:ring-kfc-red" {{ old('tipe_layanan') == 'Dine-in' ? 'checked' : '' }}>
                                    <span class="font-semibold">Makan di Tempat (Dine-in)</span>
                                </label>
                            </div>
                            {{-- Menampilkan error validasi untuk tipe_layanan --}}
                            @error('tipe_layanan')
                                <p class="text-red-500 text-sm mb-6">{{ $message }}</p>
                            @enderror


                            {{-- Detail Tambahan --}}
                            <h3 class="text-xl font-semibold mb-4 mt-6">Detail Tambahan</h3>
                            
                            {{-- === BLOK BARU UNTUK JUMLAH TAMU (AWALNYA HIDDEN) === --}}
                            <div id="jumlah_tamu_wrapper" style="display: {{ old('tipe_layanan') == 'Dine-in' ? 'block' : 'none' }};">
                                <label for="jumlah_tamu" class="block text-sm font-medium text-gray-700">Jumlah Orang</label>
                                <input type="number" name="jumlah_tamu" id="jumlah_tamu" value="{{ old('jumlah_tamu', '1') }}" min="1" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                {{-- Menampilkan error validasi untuk jumlah_tamu --}}
                                @error('jumlah_tamu')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- === AKHIR BLOK BARU === --}}

                            {{-- Catatan Pelanggan --}}
                            <div class="mt-4">
                                <label for="catatan_pelanggan" class="block text-sm font-medium text-gray-700">Catatan untuk Penjual (Opsional)</label>
                                <textarea name="catatan_pelanggan" id="catatan_pelanggan" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: Nasi ayamnya tolong yang pedas...">{{ old('catatan_pelanggan') }}</textarea>
                                @error('catatan_pelanggan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Info Pembayaran (Sesuai PDF Anda, sistem booking) --}}
                            <div class="mt-6">
                                <h4 class="text-lg font-semibold">Metode Pembayaran</h4>
                                <div class="mt-2 p-4 bg-gray-100 rounded-lg">
                                    <p class="font-semibold">Pembayaran di Tempat</p>
                                    <p class="text-sm text-gray-600">Sistem ini hanya untuk booking. Silakan lakukan pembayaran di kasir saat mengambil pesanan Anda.</p>
                                </div>
                            </div>

                            {{-- Tombol Konfirmasi --}}
                            <div class="mt-6">
                                <button type="submit" class="w-full inline-flex justify-center px-6 py-3 bg-kfc-red border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-700">
                                    Konfirmasi & Buat Pesanan
                                </button>
                                 <a href="{{ route('cart.list') }}" class="w-full inline-block text-center mt-3 px-6 py-3 text-sm text-gray-600 hover:text-gray-900">
                                    Kembali ke Keranjang
                                 </a>
                            </div>
                         </div>
                    </div>

                </div>
            </form>
        </div>
    </div>


    {{-- === BLOK SCRIPT JAVASCRIPT BARU === --}}
    {{-- Letakkan ini di paling bawah, sebelum penutup layout --}}
    <script>
        // Jalankan kode ini setelah halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            
            // Ambil elemen-elemen yang kita butuhkan
            const radioDineIn = document.getElementById('tipe_dine_in');
            const radioTakeAway = document.getElementById('tipe_take_away');
            const jumlahTamuWrapper = document.getElementById('jumlah_tamu_wrapper');

            // Fungsi untuk menampilkan/menyembunyikan input jumlah tamu
            function toggleJumlahTamu() {
                if (radioDineIn.checked) {
                    // Jika Dine-in dipilih, tampilkan input
                    jumlahTamuWrapper.style.display = 'block';
                } else {
                    // Jika Take Away dipilih, sembunyikan input
                    jumlahTamuWrapper.style.display = 'none';
                }
            }

            // Tambahkan event listener ke kedua radio button
            radioDineIn.addEventListener('change', toggleJumlahTamu);
            radioTakeAway.addEventListener('change', toggleJumlahTamu);
            
        });
    </script>
    {{-- === AKHIR BLOK SCRIPT === --}}

</x-app-layout>
