<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan #') }}{{ $pesanan->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Notifikasi Sukses/Error --}}
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif
             @if ($message = Session::get('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif

            {{-- Tampilkan Error Validasi Form Tambah Item --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops! Ada kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Kolom Kiri: Detail Pesanan, Update Status, Verifikasi Bayar --}}
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                         <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold mb-4">Ringkasan Pesanan</h3>
                            <p><strong>Pelanggan:</strong> {{ $pesanan->user->name }}</p>
                            <p><strong>Email:</strong> {{ $pesanan->user->email }}</p>
                            <p><strong>Tanggal Pesan:</strong> {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
                            <p><strong>Tipe Layanan:</strong> {{ $pesanan->tipe_layanan }}</p>

                            @if($pesanan->tipe_layanan == 'Dine-in')
                                <p><strong>Jumlah Tamu:</strong> <span class="font-bold text-kfc-red">{{ $pesanan->jumlah_tamu }} orang</span></p>
                            @endif

                            <p class="mt-2 text-xl"><strong>Total Bayar:</strong> <span class="font-bold text-gray-900">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span></p>
                            <p><strong>Status Saat Ini:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($pesanan->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                    @if($pesanan->status == 'processing') bg-blue-100 text-blue-800 @endif
                                    @if($pesanan->status == 'completed') bg-green-100 text-green-800 @endif
                                    @if($pesanan->status == 'cancelled') bg-red-100 text-red-800 @endif
                                ">{{ ucfirst($pesanan->status) }}</span>
                            </p>
                         </div>
                        
                        {{-- Form Ubah Status --}}
                        {{-- Hanya tampilkan jika status belum selesai atau batal --}}
                        @if($pesanan->status == 'pending' || $pesanan->status == 'processing')
                         <div class="p-6 border-b border-gray-200">
                               <h3 class="text-lg font-semibold mb-4">Ubah Status Pesanan</h3>
                               <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST">
                                   @csrf
                                   @method('PUT')
                                   <div class="flex items-center">
                                       <select name="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                           <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu diproses)</option>
                                           <option value="processing" {{ $pesanan->status == 'processing' ? 'selected' : '' }}>Processing (Sedang dibuat)</option>
                                           <option value="completed" {{ $pesanan->status == 'completed' ? 'selected' : '' }}>Completed (Siap diambil)</option>
                                           <option value="cancelled" {{ $pesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                                       </select>
                                       <x-primary-button class="ml-4">Update</x-primary-button>
                                   </div>
                               </form>
                         </div>
                         @endif

                        {{-- Tindakan Pembayaran --}}
                         <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Tindakan Pembayaran</h3>
                            {{-- Cek apakah pesanan sudah punya transaksi (sudah lunas) --}}
                            @if($pesanan->transaksi)
                                <div class="p-4 bg-green-100 rounded-lg text-green-700 font-semibold">
                                    Pesanan ini sudah lunas dibayar.
                                </div>
                            @else
                                {{-- Jika belum lunas, tampilkan tombol verifikasi --}}
                                <form action="{{ route('admin.transaksi.verifikasi', $pesanan->id) }}" method="POST">
                                    @csrf
                                    <p class="text-sm text-gray-600 mb-2">Klik tombol ini untuk mengonfirmasi bahwa pembayaran tunai telah diterima di kasir.</p>
                                    <x-primary-button class="bg-green-600 hover:bg-green-700">
                                        Verifikasi Pembayaran
                                    </x-primary-button>
                                </form>
                            @endif
                         </div>

                    </div>
                </div>

                {{-- Kolom Kanan: Item yang Dipesan & Form Tambah Item --}}
                <div class="md:col-span-1 space-y-6">
                       
                       {{-- Card Item yang Dipesan --}}
                       <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Item yang Dipesan</h3>
                                <div class="space-y-4">
                                    @forelse($pesanan->details as $item)
                                        <div class="flex justify-between items-start border-b pb-2">
                                            <div>
                                                <p class="font-semibold">{{ $item->menu->namaMenu }}</p>
                                                <p class="text-sm text-gray-600">{{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                            </div>
                                            <p class="text-sm font-semibold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500">Belum ada item.</p>
                                    @endforelse
                                </div>
                            </div>
                       </div>

                        {{-- === CARD BARU UNTUK TAMBAH ITEM === --}}
                        {{-- Hanya tampilkan jika status masih 'pending' atau 'processing' --}}
                        @if($pesanan->status == 'pending' || $pesanan->status == 'processing')
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold mb-4">Tambah Item ke Pesanan</h3>
                                <form action="{{ route('admin.pesanan.addItem', $pesanan->id) }}" method="POST">
                                    @csrf
                                    <div class="space-y-4">
                                        {{-- Dropdown Menu --}}
                                        <div>
                                            <label for="menu_id" class="block text-sm font-medium text-gray-700">Pilih Menu</label>
                                            <select name="menu_id" id="menu_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                                <option value="">-- Pilih Menu --</option>
                                                @foreach ($menus as $menu)
                                                    {{-- Tampilkan stok yang tersisa --}}
                                                    <option value="{{ $menu->id }}">
                                                        {{ $menu->namaMenu }} (Stok: {{ $menu->stok }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- Input Jumlah --}}
                                        <div>
                                            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        </div>

                                        {{-- Tombol Submit --}}
                                        <div>
                                            <x-primary-button class="w-full justify-center">
                                                Tambah Item
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        {{-- === AKHIR CARD BARU === --}}

                </div>
            </div>
             <div class="mt-6">
                <a href="{{ route('admin.pesanan.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Kembali ke Daftar Pesanan</a>
             </div>
        </div>
    </div>
</x-app-layout>