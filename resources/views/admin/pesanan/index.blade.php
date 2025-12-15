<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pesanan') }} 📋
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    
                    {{-- Filter & Search Section --}}
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <div class="flex gap-2 w-full md:w-1/2">
                            <form method="GET" action="{{ route('admin.pesanan.index') }}" class="flex gap-2 w-full">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID Pesanan atau Nama Pelanggan..." class="w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm text-sm">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors">Cari</button>
                                @if(request('search'))
                                    <a href="{{ route('admin.pesanan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition-colors">Reset</a>
                                @endif
                            </form>
                        </div>

                        <div class="flex items-center gap-4">
                            {{-- TOMBOL PESANAN OFFLINE --}}
                            <button onclick="document.getElementById('modalOffline').classList.remove('hidden')" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition-colors shadow-sm whitespace-nowrap">
                                + Pesanan Baru (Offline)
                            </button>

                            <div class="hidden md:flex gap-4 text-xs md:text-sm text-gray-600 border-l pl-4 border-gray-300">
                                <div class="flex items-center"><span class="w-3 h-3 bg-yellow-100 border border-yellow-400 rounded-full mr-1.5"></span> Pending</div>
                                <div class="flex items-center"><span class="w-3 h-3 bg-blue-100 border border-blue-400 rounded-full mr-1.5"></span> Processing</div>
                            </div>
                        </div>
                    </div>

                    {{-- Table Section --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Layanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Bukti</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pesanans as $pesanan)
                                    <tr class="{{ $pesanan->status == 'pending' ? 'bg-yellow-50' : ($pesanan->status == 'processing' ? 'bg-blue-50' : 'hover:bg-gray-50') }} transition-colors duration-150">
                                        {{-- ID --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            #{{ $pesanan->id }}
                                        </td>

                                        {{-- Pelanggan (MODIFIED) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            @if(str_contains($pesanan->catatan_pelanggan, 'OFFLINE'))
                                                {{-- KONDISI 1: PESANAN OFFLINE --}}
                                                {{-- Ambil nama dari catatan, hilangkan kata 'OFFLINE - ' --}}
                                                <div class="font-bold text-blue-700">
                                                    {{ str_replace('OFFLINE - ', '', $pesanan->catatan_pelanggan) }}
                                                </div>
                                                <div class="text-xs text-gray-400">
                                                    <span class="bg-blue-100 text-blue-800 px-1 py-0.5 rounded text-[10px]">OFFLINE</span>
                                                    via Kasir
                                                </div>
                                            @else
                                                {{-- KONDISI 2: PESANAN ONLINE (User Asli) --}}
                                                <div class="font-medium text-gray-900">{{ $pesanan->user->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $pesanan->created_at->diffForHumans() }}</div>
                                            @endif
                                        </td>
                                        
                                        {{-- Total --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="font-bold">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</div>
                                            <div class="text-xs text-gray-500">{{ $pesanan->details->count() }} Menu</div>
                                        </td>
                                        
                                        {{-- Layanan --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($pesanan->tipe_layanan == 'Dine-in')
                                                <div class="flex flex-col items-start gap-1">
                                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-800 text-white border border-gray-600 shadow-sm">
                                                        🍽️ Dine-in
                                                    </span>
                                                    <div class="flex items-center text-xs font-semibold text-gray-700 ml-0.5">
                                                        {{ $pesanan->jumlah_tamu }} Orang
                                                    </div>
                                                </div>
                                            @else
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-white text-gray-600 border border-gray-300 shadow-sm">
                                                    🥡 Take Away
                                                </span>
                                            @endif
                                        </td>
                                        
                                        {{-- Status --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full shadow-sm
                                                @if($pesanan->status == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-400
                                                @elseif($pesanan->status == 'processing') bg-blue-100 text-blue-800 border border-blue-400
                                                @elseif($pesanan->status == 'completed') bg-green-100 text-green-800 border border-green-400
                                                @elseif($pesanan->status == 'cancelled') bg-red-100 text-red-800 border border-red-400
                                                @endif">
                                                {{ strtoupper($pesanan->status) }}
                                            </span>
                                        </td>

                                        {{-- Bukti Bayar --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($pesanan->bukti_bayar)
                                                <a href="{{ asset($pesanan->bukti_bayar) }}" target="_blank" class="group relative block w-10 h-10">
                                                    <img src="{{ asset($pesanan->bukti_bayar) }}" 
                                                         alt="Bukti" 
                                                         class="w-full h-full object-cover rounded-md border border-gray-300 shadow-sm group-hover:scale-150 transition-transform duration-200 z-10 relative">
                                                </a>
                                            @else
                                                <span class="text-xs text-gray-400 italic">No File</span>
                                            @endif
                                        </td>

                                        {{-- Pembayaran --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($pesanan->transaksi)
                                                {{-- KONDISI 1: SUDAH DIVERIFIKASI (LUNAS) --}}
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-300">
                                                    LUNAS ✅
                                                </span>
                                                <div class="text-xs text-gray-500 mt-0.5">{{ $pesanan->transaksi->metode_pembayaran }}</div>
                                            @else
                                                {{-- KONDISI 2: BELUM DIVERIFIKASI --}}
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-orange-100 text-orange-800 border border-orange-300 whitespace-nowrap">
                                                    PERLU VERIFIKASI ⏳
                                                </span>
                                                
                                                {{-- Tampilkan Info Metode Pilihan User --}}
                                                @if($pesanan->metode_pembayaran)
                                                    <div class="mt-1">
                                                        <span class="text-[10px] font-semibold text-gray-600 bg-gray-100 px-2 py-0.5 rounded border border-gray-200 inline-block">
                                                            Via: {{ $pesanan->metode_pembayaran }}
                                                        </span>
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                        
                                        {{-- Aksi --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="inline-flex items-center px-3 py-1 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                                <p class="text-lg font-medium">Belum ada pesanan masuk.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <div class="mt-4">
                            {{ $pesanans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PESANAN OFFLINE --}}
    <div id="modalOffline" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            {{-- Background overlay --}}
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('modalOffline').classList.add('hidden')"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('admin.pesanan.storeOffline') }}" method="POST">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Buat Pesanan Offline</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 mb-4">
                                        Masukkan nama pelanggan (opsional) untuk memulai pesanan baru di tempat.
                                    </p>
                                    
                                    <div class="mb-4">
                                        <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan / Nomor Meja</label>
                                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="shadow-sm focus:ring-red-500 focus:border-red-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Contoh: Budi (Meja 5)">
                                    </div>

                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Layanan</label>
                                        <div class="flex gap-6">
                                            <div class="flex items-center">
                                                <input id="offline_dine_in" name="tipe_layanan" type="radio" value="Dine-in" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300" checked>
                                                <label for="offline_dine_in" class="ml-2 block text-sm text-gray-700">Makan di Tempat</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="offline_take_away" name="tipe_layanan" type="radio" value="Take Away" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300">
                                                <label for="offline_take_away" class="ml-2 block text-sm text-gray-700">Bungkus</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Buat Pesanan
                        </button>
                        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="document.getElementById('modalOffline').classList.add('hidden')">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>