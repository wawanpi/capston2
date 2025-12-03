<x-app-layout>
    {{-- Header (Tidak dicetak) --}}
    <x-slot name="header">
        <div class="no-print">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pesanan #') }}{{ $pesanan->id }}
            </h2>
        </div>
    </x-slot>

    {{-- Konten Utama --}}
    <div class="py-12 no-print">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 1. Notifikasi --}}
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif
            @if ($message = Session::get('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Perhatian!</strong> <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Gagal!</strong> <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops! Ada input yang salah:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- === KOLOM KIRI: Info & Aksi === --}}
                <div class="md:col-span-2">
                    
                    {{-- Card Ringkasan --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                         <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                            <div class="text-sm space-y-2">
                                <p><strong>Pelanggan:</strong> {{ $pesanan->user->name }}</p>
                                <p><strong>Email:</strong> {{ $pesanan->user->email }}</p>
                                <p><strong>Tanggal Pesan:</strong> {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
                                <p><strong>Tipe Layanan:</strong> {{ $pesanan->tipe_layanan }}</p>
                                @if($pesanan->tipe_layanan == 'Dine-in')
                                    <p><strong>Jumlah Tamu:</strong> {{ $pesanan->jumlah_tamu }} orang</p>
                                @endif
                                <p class="text-lg mt-4 border-t pt-2"><strong>Total Bayar:</strong> <span class="font-bold text-gray-900 text-xl">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span></p>
                                <div class="mt-4">
                                    <p class="text-sm font-semibold mb-1">Status Saat Ini:</p>
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-800 text-white">
                                        {{ ucfirst($pesanan->status) }}
                                    </span>
                                </div>
                            </div>
                         </div>
                        
                        {{-- Form Ubah Status --}}
                        @if($pesanan->status == 'pending' || $pesanan->status == 'processing')
                         <div class="p-6 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-sm font-bold text-gray-800 mb-2">Ubah Status Pesanan</h3>
                                <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST" class="flex gap-3 items-center">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm flex-1 text-sm">
                                        <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                        <option value="processing" {{ $pesanan->status == 'processing' ? 'selected' : '' }}>Processing (Diproses)</option>
                                        <option value="completed" {{ $pesanan->status == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                                        <option value="cancelled" {{ $pesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled (Batal)</option>
                                    </select>
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-xs font-bold hover:bg-gray-900 transition-colors">UPDATE</button>
                                </form>
                         </div>
                         @endif
                    </div>

                    {{-- [BARU] CARD BUKTI TRANSFER --}}
                    {{-- Ditambahkan di sini agar Admin mengecek gambar DULU sebelum Verifikasi --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Bukti Transfer</h3>
                            
                            @if($pesanan->bukti_bayar)
                                <div class="flex flex-col items-start">
                                    {{-- Container Gambar --}}
                                    <div class="border rounded p-2 bg-gray-50 inline-block mb-3">
                                        <img src="{{ asset($pesanan->bukti_bayar) }}" 
                                             alt="Bukti Transfer" 
                                             class="max-h-80 w-auto object-contain rounded-md shadow-sm">
                                    </div>
                                    
                                    {{-- Tombol Lihat Full --}}
                                    <a href="{{ asset($pesanan->bukti_bayar) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 underline text-sm font-semibold">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Lihat Gambar Ukuran Penuh
                                    </a>
                                </div>
                            @else
                                <div class="flex items-center justify-center p-6 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300">
                                    <p class="text-gray-500 italic flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        Bukti transfer belum diupload oleh pelanggan.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- [AKHIR BARU] --}}

                    {{-- Bagian Tindakan Pembayaran --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                         <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Verifikasi Pembayaran</h3>
                            
                            @if($pesanan->transaksi)
                                <div class="p-4 bg-green-100 text-green-800 rounded-lg font-semibold flex items-center border border-green-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Pesanan ini sudah LUNAS.
                                </div>
                            @else
                                <form action="{{ route('admin.transaksi.verifikasi', $pesanan->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                                        <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                            <option value="Transfer Bank">Transfer Bank (BCA)</option>
                                            <option value="QRIS">QRIS</option>
                                            <option value="Tunai di Tempat">Tunai di Tempat</option>
                                        </select>
                                    </div>
                                    
                                    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
                                        <div class="flex">
                                            <div class="ml-3">
                                                <p class="text-sm text-blue-700">
                                                    Pastikan Anda sudah mengecek <strong>Bukti Transfer</strong> di atas sebelum melakukan verifikasi.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition-colors">
                                        Verifikasi Pembayaran Valid
                                    </button>
                                </form>
                            @endif
                         </div>
                    </div>

                </div>

                {{-- === KOLOM KANAN: Item & Tambah Item === --}}
                <div class="md:col-span-1 space-y-6">
                        
                    {{-- Card Daftar Item --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Item yang Dipesan</h3>
                            <div class="space-y-4">
                                @forelse($pesanan->details as $item)
                                    <div class="flex justify-between items-start border-b border-gray-100 pb-3 last:border-0">
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $item->menu->namaMenu ?? 'Menu Dihapus' }}</p>
                                            <p class="text-xs text-gray-500">{{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="text-sm font-bold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 italic">Belum ada item dalam pesanan ini.</p>
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
                                    <div>
                                        <label for="menu_id" class="block text-sm font-medium text-gray-700">Pilih Menu</label>
                                        <select name="menu_id" id="menu_id" class="mt-1 block w-full text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                            <option value="">-- Pilih Menu --</option>
                                            @foreach ($menus as $menu)
                                                <option value="{{ $menu->id }}" {{ $menu->jumlah_saat_ini <= 0 ? 'disabled' : '' }}>
                                                    {{ $menu->namaMenu }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="mt-1 block w-full text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                                            TAMBAH ITEM
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                    
                    {{-- Tombol Cetak & Kembali --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6 flex flex-col gap-3">
                             <button onclick="window.print()" class="w-full justify-center inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors shadow-sm">
                                🖨️ CETAK NOTA
                            </button>
                            <a href="{{ route('admin.pesanan.index') }}" class="text-center text-sm text-gray-600 hover:text-gray-900 underline">&larr; Kembali ke Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- === LAYOUT CETAK NOTA (Hanya muncul saat print) === --}}
    <div class="print-this" aria-hidden="true" style="display: none;">
        {{-- (Isi nota sama seperti sebelumnya) --}}
        <div class="nota-wrapper" style="font-family: monospace; width: 300px; margin: 0 auto; padding: 10px;">
            <div class="nota-header" style="text-align: center; margin-bottom: 15px;">
                <h2 style="font-size: 16px; font-weight: bold; margin: 0;">BURMIN - Jagonya Warmindo</h2>
                <p style="font-size: 10px; margin: 2px 0;">Jl. Bunga, Geblagan, Tamantirto, Bantul, DIY</p>
                <p style="font-size: 10px; margin: 2px 0;">Telp: (0274) 123456</p>
            </div>
            <div style="border-bottom: 1px dashed #000; margin-bottom: 10px;"></div>
            <div class="nota-details" style="font-size: 11px; margin-bottom: 10px;">
                <p style="margin: 2px 0;">No: #{{ $pesanan->id }}</p>
                <p style="margin: 2px 0;">Kasir: {{ Auth::user()->name }}</p> 
                <p style="margin: 2px 0;">Pelanggan: {{ $pesanan->user->name }}</p>
                <p style="margin: 2px 0;">Tgl: {{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
                <p style="margin: 2px 0;">Tipe: {{ $pesanan->tipe_layanan }}</p>
            </div>
            <div style="border-bottom: 1px dashed #000; margin-bottom: 10px;"></div>
            <div class="nota-items">
                <table style="width: 100%; font-size: 11px;">
                    <tbody>
                        @foreach($pesanan->details as $item)
                        <tr>
                            <td style="padding-bottom: 5px;">
                                {{ $item->menu->namaMenu ?? 'Menu Dihapus' }} <br>
                                <span style="font-size: 9px;">{{ $item->jumlah }} x {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                            </td>
                            <td style="text-align: right; vertical-align: top;">
                                {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="border-bottom: 1px dashed #000; margin: 10px 0;"></div>
            <div class="nota-total" style="font-size: 12px;">
                <table style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="font-weight: bold;">TOTAL</td>
                            <td style="text-align: right; font-weight: bold;">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                        @if($pesanan->transaksi)
                        <tr>
                            <td style="font-size: 10px; padding-top: 5px;">Pembayaran</td>
                            <td style="text-align: right; font-size: 10px; padding-top: 5px;">{{ strtoupper($pesanan->transaksi->metode_pembayaran) }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 10px;">Status</td>
                            <td style="text-align: right; font-size: 10px;">LUNAS</td>
                        </tr>
                        @else
                        <tr>
                            <td style="font-size: 10px; padding-top: 5px;">Status</td>
                            <td style="text-align: right; font-size: 10px;">BELUM LUNAS</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div style="border-bottom: 1px dashed #000; margin: 15px 0;"></div>
            <div class="nota-footer" style="text-align: center; font-size: 10px;">
                <p>Terima Kasih Atas Kunjungan Anda!</p>
                <p>Selamat Menikmati 🍜</p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * { visibility: hidden; }
            .no-print { display: none !important; }
            .print-this, .print-this * { visibility: visible; display: block !important; }
            .print-this { position: absolute; left: 0; top: 0; width: 100%; }
        }
    </style>    
</x-app-layout>