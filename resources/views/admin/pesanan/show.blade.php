<x-app-layout>
    {{-- Header (Tidak dicetak) --}}
    <x-slot name="header">
        <div class="flex items-center justify-between no-print">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pesanan.index') }}" class="p-2 bg-white rounded-full text-gray-500 hover:text-gray-900 shadow-sm border border-gray-100 transition">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <div>
                    <h2 class="font-black text-xl text-gray-800 leading-tight flex items-center gap-2">
                        Pesanan #{{ $pesanan->id }}
                        @if($pesanan->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full border border-yellow-200">Pending</span>
                        @elseif($pesanan->status == 'processing')
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full border border-blue-200">Diproses</span>
                        @elseif($pesanan->status == 'completed')
                            <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full border border-green-200">Selesai</span>
                        @elseif($pesanan->status == 'cancelled')
                            <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded-full border border-red-200">Dibatalkan</span>
                        @endif
                    </h2>
                    <p class="text-sm text-gray-500">{{ $pesanan->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>
            
            <div class="flex items-center gap-2">
                <button onclick="window.print()" class="hidden sm:flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-bold shadow-md hover:bg-black transition">
                    <i data-lucide="printer" class="w-4 h-4"></i> Cetak Nota
                </button>
            </div>
        </div>
    </x-slot>

    {{-- Konten Utama --}}
    <div class="py-8 bg-gray-50 min-h-screen no-print">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Notifikasi --}}
            @if ($message = Session::get('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r shadow-sm mb-6 flex items-center gap-2" role="alert">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span>{{ $message }}</span>
                </div>
            @endif
            @if ($message = Session::get('error'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r shadow-sm mb-6 flex items-center gap-2" role="alert">
                    <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    <span>{{ $message }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- === KOLOM KIRI: WORKFLOW ADMIN === --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- 1. CEK BUKTI PEMBAYARAN --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-sm">1</div>
                            <h3 class="font-bold text-gray-800">Verifikasi Pembayaran</h3>
                        </div>
                        
                        <div class="p-6">
                            @if($pesanan->bukti_bayar)
                                {{-- Ada Bukti Transfer --}}
                                <div class="flex flex-col sm:flex-row gap-6">
                                    <div class="w-full sm:w-1/3">
                                        <a href="{{ asset($pesanan->bukti_bayar) }}" target="_blank" class="block relative group rounded-xl overflow-hidden border border-gray-200 shadow-sm">
                                            <img src="{{ asset($pesanan->bukti_bayar) }}" alt="Bukti Transfer" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500">
                                            <div class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                <i data-lucide="zoom-in" class="w-8 h-8 text-white"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800 mb-2">Bukti Terlampir</h4>
                                        <p class="text-sm text-gray-600 mb-4">Silakan cek nominal dan keaslian bukti transfer di samping.</p>
                                        <div class="p-3 bg-blue-50 rounded-lg text-blue-800 text-sm border border-blue-100 flex items-start gap-2">
                                            <i data-lucide="info" class="w-4 h-4 mt-0.5 shrink-0"></i>
                                            <span>Pastikan dana sudah masuk ke rekening sebelum memverifikasi.</span>
                                        </div>
                                    </div>
                                </div>

                            @elseif(str_contains($pesanan->catatan_pelanggan, 'OFFLINE'))
                                {{-- Pesanan Offline --}}
                                <div class="flex flex-col items-center justify-center p-8 bg-blue-50 rounded-2xl border-2 border-dashed border-blue-200 text-center">
                                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm text-blue-600">
                                        <i data-lucide="store" class="w-8 h-8"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-gray-900">Pesanan Offline (Tatap Muka)</h4>
                                    <p class="text-sm text-gray-600 mt-1 max-w-md">
                                        Pelanggan memesan langsung di kasir. Silakan terima pembayaran tunai atau cek aplikasi pembayaran di tempat.
                                    </p>
                                </div>

                            @else
                                {{-- Belum Upload --}}
                                <div class="flex flex-col items-center justify-center p-8 bg-red-50 rounded-2xl border-2 border-dashed border-red-200 text-center">
                                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mb-3 shadow-sm text-red-500">
                                        <i data-lucide="image-off" class="w-6 h-6"></i>
                                    </div>
                                    <p class="text-red-600 font-medium">Belum ada bukti pembayaran.</p>
                                    <p class="text-xs text-red-400 mt-1">Tunggu pelanggan mengupload bukti bayar.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 2. TINDAKAN (VERIFIKASI) --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-sm">2</div>
                            <h3 class="font-bold text-gray-800">Tindakan Admin</h3>
                        </div>

                        <div class="p-6">
                            @if($pesanan->transaksi)
                                <div class="p-4 bg-green-50 text-green-800 rounded-xl font-bold flex items-center border border-green-100 shadow-sm">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3 text-green-600">
                                        <i data-lucide="check" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        LUNAS & TERVERIFIKASI
                                        <p class="text-xs font-normal mt-0.5 text-green-700">Metode: {{ $pesanan->transaksi->metode_pembayaran }}</p>
                                    </div>
                                </div>
                            @else
                                <form action="{{ route('admin.transaksi.verifikasi', $pesanan->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Metode Pembayaran</label>
                                        @if($pesanan->metode_pembayaran)
                                            <div class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl p-3 font-bold flex items-center gap-2">
                                                <i data-lucide="credit-card" class="w-4 h-4 text-gray-500"></i>
                                                {{ $pesanan->metode_pembayaran }}
                                            </div>
                                            <input type="hidden" name="metode_pembayaran" value="{{ $pesanan->metode_pembayaran }}">
                                        @else
                                            <div class="relative">
                                                <select name="metode_pembayaran" class="block w-full pl-10 pr-4 py-3 border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-xl shadow-sm appearance-none" required>
                                                    <option value="Tunai di Tempat">Tunai di Tempat</option>
                                                    <option value="Transfer Bank">Transfer Bank (BCA)</option>
                                                    <option value="QRIS">QRIS</option>
                                                </select>
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                                    <i data-lucide="wallet" class="w-5 h-5"></i>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-4 bg-green-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-green-700 transition-all shadow-lg hover:shadow-green-200 hover:-translate-y-0.5 transform gap-2">
                                        <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                                        Verifikasi Pembayaran Valid
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- 3. UPDATE STATUS MANUAL --}}
                    @if($pesanan->status != 'completed' && $pesanan->status != 'cancelled')
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="text-sm font-bold text-gray-800">Opsi Lainnya</h3>
                            </div>
                            <div class="p-6">
                                <p class="text-xs text-gray-500 mb-3">
                                    Gunakan ini jika pesanan batal atau perlu update status tanpa verifikasi pembayaran.
                                </p>
                                <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST" class="flex gap-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="relative flex-1">
                                        <select name="status" class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-lg shadow-sm">
                                            <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $pesanan->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $pesanan->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $pesanan->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg text-xs font-bold hover:bg-black transition-colors">UPDATE</button>
                                </form>
                            </div>
                        </div>
                    @endif

                </div>

                {{-- === KOLOM KANAN: RINGKASAN === --}}
                <div class="lg:col-span-1 space-y-6">
                    
                    {{-- Detail Pelanggan --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Informasi Pelanggan</h3>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-lg font-bold text-gray-600">
                                {{ substr($pesanan->user->name ?? 'G', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900 text-lg">{{ $pesanan->user->name ?? 'Guest' }}</p>
                                <p class="text-xs text-gray-500">ID: #USR-{{ $pesanan->user->id ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Layanan</span>
                                <span class="font-semibold">{{ $pesanan->tipe_layanan }}</span>
                            </div>
                            {{-- MENAMPILKAN JUMLAH TAMU --}}
                            @if($pesanan->jumlah_tamu > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Jumlah Orang</span>
                                <span class="font-semibold">{{ $pesanan->jumlah_tamu }} Orang</span>
                            </div>
                            @endif
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Meja/Info</span>
                                <span class="font-semibold">{{ $pesanan->catatan_pelanggan ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Daftar Item --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Rincian Pesanan</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            @forelse($pesanan->details as $item)
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">{{ $item->menu->namaMenu ?? 'Menu Dihapus' }}</p>
                                        <p class="text-xs text-gray-500">{{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                    </div>
                                    <p class="text-sm font-bold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400 italic text-center py-4">Belum ada item.</p>
                            @endforelse
                        </div>
                        
                        {{-- Total --}}
                        <div class="p-6 bg-gray-900 text-white">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-gray-400">Total Tagihan</span>
                                <span class="text-2xl font-black">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Tambah Item (Jika Pending) --}}
                    @if($pesanan->status == 'pending' || $pesanan->status == 'processing')
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Tambah Item Manual</h3>
                            <form action="{{ route('admin.pesanan.addItem', $pesanan->id) }}" method="POST" class="space-y-3">
                                @csrf
                                <select name="menu_id" class="block w-full text-sm border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" required>
                                    <option value="">-- Pilih Menu --</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ $menu->jumlah_saat_ini <= 0 ? 'disabled' : '' }}>
                                            {{ $menu->namaMenu }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="flex gap-2">
                                    <input type="number" name="jumlah" value="1" min="1" class="w-20 text-sm border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" placeholder="Qty">
                                    <button type="submit" class="flex-1 bg-red-100 text-[#D40000] font-bold text-xs rounded-lg hover:bg-red-200 transition-colors">
                                        + TAMBAH
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                    {{-- Tombol Cetak Mobile --}}
                    <button onclick="window.print()" class="w-full sm:hidden py-4 bg-gray-900 text-white rounded-2xl font-bold shadow-lg">
                        Cetak Nota
                    </button>

                </div>
            </div>
        </div>
    </div>
    
    {{-- === LAYOUT CETAK NOTA (Thermal Style) === --}}
    <div class="print-this hidden">
        <div class="w-[300px] mx-auto p-2 font-mono text-black">
            <div class="text-center mb-4">
                <h2 class="text-xl font-bold uppercase">BURMIN</h2>
                <p class="text-[10px]">Jagonya Warmindo</p>
                <p class="text-[10px] mt-1">Jl. Bunga, Geblagan, Bantul</p>
            </div>
            
            <div class="border-b-2 border-dashed border-black my-2"></div>
            
            <div class="text-[11px] mb-2">
                <div class="flex justify-between"><span>No:</span> <span>#{{ $pesanan->id }}</span></div>
                <div class="flex justify-between"><span>Tgl:</span> <span>{{ $pesanan->created_at->format('d/m/y H:i') }}</span></div>
                <div class="flex justify-between"><span>Cust:</span> <span>{{ substr($pesanan->user->name, 0, 15) }}</span></div>
                <div class="flex justify-between"><span>Tipe:</span> <span>{{ $pesanan->tipe_layanan }}</span></div>
                {{-- JUMLAH TAMU DI NOTA --}}
                @if($pesanan->jumlah_tamu > 0)
                    <div class="flex justify-between"><span>Jml:</span> <span>{{ $pesanan->jumlah_tamu }} Org</span></div>
                @endif
            </div>

            <div class="border-b-2 border-dashed border-black my-2"></div>

            <div class="text-[11px]">
                @foreach($pesanan->details as $item)
                    <div class="mb-1">
                        <div>{{ $item->menu->namaMenu }}</div>
                        <div class="flex justify-between">
                            <span>{{ $item->jumlah }} x {{ number_format($item->harga_satuan, 0, ',', '.') }}</span>
                            <span>{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="border-b-2 border-dashed border-black my-2"></div>

            <div class="text-[12px] font-bold flex justify-between">
                <span>TOTAL</span>
                <span>Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</span>
            </div>

            <div class="text-[10px] text-center mt-4">
                <p>Terima Kasih!</p>
                <p>Selamat Menikmati</p>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * { visibility: hidden; }
            .no-print { display: none !important; }
            .print-this, .print-this * { visibility: visible; display: block !important; }
            .print-this { position: absolute; left: 0; top: 0; width: 100%; margin: 0; padding: 0; }
            @page { margin: 0; size: auto; }
        }
    </style>    
</x-app-layout>