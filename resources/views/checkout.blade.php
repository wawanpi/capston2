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

                    <!-- Kolom Kiri: Detail Item -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h3>
                            <div class="space-y-4">
                                @foreach ($cartItems as $item)
                                <div class="flex justify-between items-start border-b pb-2">
                                    <div class="flex items-center">
                                        <img src="{{ asset($item->attributes->image) }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded mr-4">
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

                    <!-- Kolom Kanan: Tipe Layanan, Catatan & Tombol Bayar -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6 text-gray-900">
                            
                            {{-- === BAGIAN BARU (LANGKAH 2) === --}}
                            <h3 class="text-xl font-semibold mb-4">Pilih Tipe Layanan</h3>
                            <div class="flex space-x-4 mb-6">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer flex-1">
                                    <input type="radio" name="tipe_layanan" value="Take Away" class="mr-2 text-kfc-red focus:ring-kfc-red" checked>
                                    <span class="font-semibold">Ambil di Tempat (Take Away)</span>
                                </label>
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer flex-1">
                                    <input type="radio" name="tipe_layanan" value="Dine-in" class="mr-2 text-kfc-red focus:ring-kfc-red">
                                    <span class="font-semibold">Makan di Tempat (Dine-in)</span>
                                </label>
                            </div>
                            {{-- === AKHIR BAGIAN BARU === --}}

                             <h3 class="text-xl font-semibold mb-4">Detail Tambahan</h3>
                            
                            {{-- Catatan Pelanggan --}}
                            <div>
                                <label for="catatan_pelanggan" class="block text-sm font-medium text-gray-700">Catatan untuk Penjual (Opsional)</label>
                                <textarea name="catatan_pelanggan" id="catatan_pelanggan" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: Nasi ayamnya tolong yang pedas..."></textarea>
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
</x-app-layout>