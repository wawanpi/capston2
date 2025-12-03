<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- === KOLOM KIRI: Ringkasan Pesanan (TIDAK BERUBAH) === --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-fit">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-xl font-semibold mb-4">Ringkasan Pesanan</h3>
                            <div class="space-y-4">
                                @foreach ($cartItems as $item)
                                <div class="flex justify-between items-start border-b pb-2">
                                    <div class="flex items-center">
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

                    {{-- === KOLOM KANAN: Form Input === --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6 text-gray-900">
                            
                            {{-- Pilihan Tipe Layanan --}}
                            <h3 class="text-xl font-semibold mb-4">Pilih Tipe Layanan</h3>
                            <div class="flex space-x-4 mb-2">
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer flex-1">
                                    <input type="radio" id="tipe_take_away" name="tipe_layanan" value="Take Away" class="mr-2 text-kfc-red focus:ring-kfc-red" {{ old('tipe_layanan', 'Take Away') == 'Take Away' ? 'checked' : '' }}>
                                    <span class="font-semibold">Ambil di Tempat</span>
                                </label>
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer flex-1">
                                    <input type="radio" id="tipe_dine_in" name="tipe_layanan" value="Dine-in" class="mr-2 text-kfc-red focus:ring-kfc-red" {{ old('tipe_layanan') == 'Dine-in' ? 'checked' : '' }}>
                                    <span class="font-semibold">Makan di Tempat</span>
                                </label>
                            </div>
                            @error('tipe_layanan')
                                <p class="text-red-500 text-sm mb-6">{{ $message }}</p>
                            @enderror

                            {{-- Detail Tambahan --}}
                            <h3 class="text-xl font-semibold mb-4 mt-6">Detail Tambahan</h3>
                            
                            {{-- Input Jumlah Tamu --}}
                            <div id="jumlah_tamu_wrapper" style="display: {{ old('tipe_layanan') == 'Dine-in' ? 'block' : 'none' }};">
                                <label for="jumlah_tamu" class="block text-sm font-medium text-gray-700">Jumlah Orang</label>
                                <input type="number" name="jumlah_tamu" id="jumlah_tamu" value="{{ old('jumlah_tamu', '1') }}" min="1" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @error('jumlah_tamu')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Catatan Pelanggan --}}
                            <div class="mt-4">
                                <label for="catatan_pelanggan" class="block text-sm font-medium text-gray-700">Catatan untuk Penjual (Opsional)</label>
                                <textarea name="catatan_pelanggan" id="catatan_pelanggan" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: Nasi ayamnya tolong yang pedas...">{{ old('catatan_pelanggan') }}</textarea>
                                @error('catatan_pelanggan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Bagian Pembayaran & Upload Bukti --}}
                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-xl font-semibold mb-4">Pembayaran</h3>
                                
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                    <p class="text-sm text-blue-800 font-semibold mb-3">Silakan pilih metode transfer:</p>
                                    
                                    <div class="grid grid-cols-1 gap-6">
                                        {{-- Opsi 1: Bank Transfer --}}
                                        <div>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Transfer Bank</p>
                                            <p class="text-lg font-bold text-gray-900 mt-1">BCA 1234567890</p>
                                            <p class="text-sm text-gray-700">a.n Burmin</p>
                                        </div>

                                        <div class="border-t border-blue-200"></div>

                                        {{-- Opsi 2: QRIS --}}
                                        <div>
                                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Scan QRIS (DANA/Gopay/OVO)</p>
                                            
                                            {{-- [MODIFIKASI] Wrapper agar bisa diklik --}}
                                            <div class="group relative inline-block cursor-pointer" onclick="openModal('qrisModal')">
                                                <div class="bg-white p-2 rounded-lg border border-gray-200 shadow-sm transition group-hover:shadow-md">
                                                    {{-- Gambar Thumbnail --}}
                                                    <img src="{{ asset('menu-images/qris.jpg') }}" alt="QRIS Code" class="w-48 h-auto rounded">
                                                </div>
                                                {{-- Overlay Text pada Hover --}}
                                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200">
                                                    <span class="bg-black bg-opacity-75 text-white text-xs px-2 py-1 rounded">Klik untuk Perbesar 🔍</span>
                                                </div>
                                            </div>

                                            <p class="text-xs text-blue-600 mt-2">Klik gambar QRIS untuk memperbesar.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 pt-3 border-t border-blue-200">
                                        <p class="text-sm text-blue-800">Total Transfer: <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></p>
                                    </div>
                                </div>

                                {{-- Input Upload File --}}
                                <label for="bukti_bayar" class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti Transfer <span class="text-red-500">*</span></label>
                                <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/*" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-indigo-50 file:text-indigo-700
                                    hover:file:bg-indigo-100
                                    border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2
                                " required>
                                <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG. Max: 2MB.</p>
                                @error('bukti_bayar')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
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

    {{-- === [TAMBAHAN BARU] MODAL QRIS FULL SIZE === --}}
    <div id="qrisModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" onclick="closeModal('qrisModal')"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900 text-center mb-4" id="modal-title">Scan QRIS</h3>
                            <div class="mt-2 flex justify-center">
                                {{-- Gambar Full Size --}}
                                <img src="{{ asset('menu-images/qris.jpg') }}" alt="QRIS Full" class="w-full h-auto max-w-sm rounded-lg border border-gray-200">
                            </div>
                            <p class="text-sm text-gray-500 mt-4 text-center">Silakan scan kode di atas menggunakan aplikasi E-Wallet Anda.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" onclick="closeModal('qrisModal')">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- === AKHIR MODAL === --}}

    {{-- Script JavaScript --}}
    <script>
        // Fungsi Buka Tutup Modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Logika Toggle Jumlah Tamu (Kode Lama)
            const radioDineIn = document.getElementById('tipe_dine_in');
            const radioTakeAway = document.getElementById('tipe_take_away');
            const jumlahTamuWrapper = document.getElementById('jumlah_tamu_wrapper');

            function toggleJumlahTamu() {
                if (radioDineIn.checked) {
                    jumlahTamuWrapper.style.display = 'block';
                } else {
                    jumlahTamuWrapper.style.display = 'none';
                }
            }

            if(radioDineIn && radioTakeAway){
                radioDineIn.addEventListener('change', toggleJumlahTamu);
                radioTakeAway.addEventListener('change', toggleJumlahTamu);
            }
        });
    </script>
</x-app-layout>