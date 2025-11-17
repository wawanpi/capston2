<x-app-layout>
    {{-- PERBAIKAN: Tambahkan class no-print ke header --}}
    <x-slot name="header" class="no-print">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pesanan #') }}{{ $pesanan->id }}
        </h2>
    </x-slot>

    {{-- BUNGKUS SEMUA KONTEN YANG TERLIHAT DI LAYAR DENGAN .no-print --}}
    <div class="py-12 no-print">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi Sukses/Error (Tambahkan no-print) --}}
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 no-print" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif
             @if ($message = Session::get('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 no-print" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif

            {{-- Tampilkan Error Validasi (Tambahkan no-print) --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 no-print" role="alert">
                    <strong class="font-bold">Oops! Ada kesalahan:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 print-area">
                {{-- Kolom Kiri: Detail Pesanan, Update Status, Verifikasi Bayar --}}
                <div class="md:col-span-2 print-col">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                         <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                            <p><strong>Pelanggan:</strong> {{ $pesanan->user->name }}</p>
                            <p><strong>Email:</strong> {{ $pesanan->user->email }}</p>
                            <p><strong>Tanggal Pesan:</strong> {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
                            <p><strong>Tipe Layanan:</strong> {{ $pesanan->tipe_layanan }}</p>

                            @if($pesanan->tipe_layanan == 'Dine-in')
                                <p><strong>Jumlah Tamu:</strong> <span class="font-bold text-red-600">{{ $pesanan->jumlah_tamu }} orang</span></p>
                            @endif

                            <p class="mt-2 text-xl"><strong>Total Bayar:</strong> <span class="font-bold text-gray-900">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span></p>
                            
                            <p><strong>Status Saat Ini:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($pesanan->status == 'pending') bg-gray-200 text-gray-800 @endif
                                    @if($pesanan->status == 'processing') bg-gray-800 text-white @endif
                                    @if($pesanan->status == 'completed') bg-white text-gray-500 border border-gray-300 @endif
                                    @if($pesanan->status == 'cancelled') bg-red-100 text-red-800 @endif
                                ">{{ ucfirst($pesanan->status) }}</span>
                            </p>
                         </div>
                        
                        {{-- Form Ubah Status --}}
                        @if($pesanan->status == 'pending' || $pesanan->status == 'processing')
                         <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Ubah Status Pesanan</h3>
                                <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex items-center">
                                        <select name="status" class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                                            <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu diproses)</option>
                                            <option value="processing" {{ $pesanan->status == 'processing' ? 'selected' : '' }}>Processing (Sedang dibuat)</option>
                                            <option value="completed" {{ $pesanan->status == 'completed' ? 'selected' : '' }}>Completed (Siap diambil)</option>
                                            <option value="cancelled" {{ $pesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                                        </select>
                                        <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                            Update
                                        </button>
                                    </div>
                                </form>
                         </div>
                         @endif

                        {{-- Tindakan Pembayaran --}}
                         <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Tindakan Pembayaran</h3>
                            @if($pesanan->transaksi)
                                <div class="p-4 bg-gray-100 rounded-lg text-gray-800 font-semibold">
                                    Pesanan ini sudah lunas dibayar.
                                </div>
                            @else
                                {{-- === PERBAIKAN: FORM VERIFIKASI DENGAN DROPDOWN === --}}
                                <form action="{{ route('admin.transaksi.verifikasi', $pesanan->id) }}" method="POST">
                                    @csrf
                                    
                                    {{-- Dropdown Metode Pembayaran --}}
                                    <div class="mb-4">
                                        <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                                        <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                            <option value="Tunai di Tempat">Tunai di Tempat</option>
                                            <option value="QRIS">QRIS</option>
                                        </select>
                                        @error('metode_pembayaran')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 mb-2">Klik tombol ini untuk mengonfirmasi bahwa pembayaran telah diterima.</p>
                                    
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                        Verifikasi Pembayaran
                                    </button>
                                </form>
                            @endif
                         </div>

                    </div>
                </div>

                {{-- Kolom Kanan: Item yang Dipesan & Form Tambah Item --}}
                <div class="md:col-span-1 space-y-6 print-col">
                        
                        {{-- Card Item yang Dipesan --}}
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Item yang Dipesan</h3>
                                <div class="space-y-4">
                                    @forelse($pesanan->details as $item)
                                        <div class="flex justify-between items-start border-b pb-2">
                                            <div>
                                                <p class="font-semibold">{{ $item->menu->namaMenu ?? 'Menu Dihapus' }}</p>
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

                        {{-- Card Tambah Item --}}
                        @if($pesanan->status == 'pending' || $pesanan->status == 'processing')
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Tambah Item ke Pesanan</h3>
                                <form action="{{ route('admin.pesanan.addItem', $pesanan->id) }}" method="POST">
                                    @csrf
                                    <div class="space-y-4">
                                        {{-- Dropdown Menu --}}
                                        <div>
                                            <label for="menu_id" class="block text-sm font-medium text-gray-700">Pilih Menu</label>
                                            <select name="menu_id" id="menu_id" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                                <option value="">-- Pilih Menu --</option>
                                                @foreach ($menus as $menu)
                                                    <option value="{{ $menu->id }}">
                                                        {{ $menu->namaMenu }} (Sisa: {{ $menu->jumlah_saat_ini }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        {{-- Input Jumlah --}}
                                        <div>
                                            <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                        </div>

                                        {{-- Tombol Submit --}}
                                        <div>
                                            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                                Tambah Item
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
             <div class="mt-6 flex justify-between">
                <a href="{{ route('admin.pesanan.index') }}" class="text-sm text-gray-600 hover:text-gray-900 no-print">&larr; Kembali ke Daftar Pesanan</a>
                
                @if($pesanan->transaksi)
                    <button onclick="window.print()" class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 no-print">
                        Cetak Nota
                    </button>
                @endif
             </div>
        </div>
    </div>

    
    {{-- NOTA CETAK (TETAP SAMA, TAPI SEKARANG BISA MENAMPILKAN METODE BAYAR YANG BENAR) --}}
    <div class="print-this" aria-hidden="true">
        <div class="nota-wrapper">
            <div class="nota-header">
                <h2>BURMIN - Jagonya Warmindo</h2>
                <p>Jl. Bunga, Geblagan, Tamantirto, Bantul, DIY</p>
                <p>Telp: (0274) 123456</p>
            </div>

            <div class="nota-separator"></div>

            <div class="nota-details">
                <p><span>No. Pesanan:</span> <strong>#{{ $pesanan->id }}</strong></p>
                <p><span>Kasir:</span> <strong>{{ Auth::user()->name }}</strong></p> 
                <p><span>Pelanggan:</span> <strong>{{ $pesanan->user->name }}</strong></p>
                <p><span>Tanggal:</span> <strong>{{ $pesanan->created_at->format('d/m/Y H:i') }}</strong></p>
                <p><span>Layanan:</span> <strong>{{ $pesanan->tipe_layanan }}</strong></p>
            </div>

            <div class="nota-separator"></div>

            <div class="nota-items">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Jml</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->details as $item)
                        <tr>
                            <td>
                                {{ $item->menu->namaMenu ?? 'Menu Dihapus' }}
                                <br>
                                <small>(@ Rp {{ number_format($item->harga_satuan, 0, ',', '.') }})</small>
                            </td>
                            <td>x{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="nota-separator"></div>
            
            <div class="nota-total">
                <table>
                    <tbody>
                        <tr>
                            <td><strong>Total Bayar</strong></td>
                            <td><strong>Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</strong></td>
                        </tr>
                        @if($pesanan->transaksi)
                        <tr>
                            <td>Status</td>
                            {{-- PERBAIKAN: Ini sekarang akan menampilkan 'QRIS' atau 'Tunai' --}}
                            <td>LUNAS ({{ $pesanan->transaksi->metode_pembayaran }})</td>
                        </tr>
                        @else
                        <tr>
                            <td>Status</td>
                            <td>BELUM LUNAS</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="nota-footer">
                <p>Terima Kasih Atas Kunjungan Anda!</p>
            </div>
        </div>
    </div>

</x-app-layout>