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
                    
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        
                        <form method="GET" action="{{ route('admin.pesanan.index') }}" class="w-full md:w-1/2 flex gap-2">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}" 
                                   placeholder="Cari ID Pesanan atau Nama Pelanggan..." 
                                   class="w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm text-sm"
                            >
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition-colors">
                                Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ route('admin.pesanan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition-colors">
                                    Reset
                                </a>
                            @endif
                        </form>

                        <div class="flex gap-4 text-xs md:text-sm text-gray-600">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-yellow-100 border border-yellow-400 rounded-full mr-1.5"></span> 
                                Pending
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-blue-100 border border-blue-400 rounded-full mr-1.5"></span> 
                                Processing
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Pelanggan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Layanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pesanans as $pesanan)
                                    <tr class="{{ $pesanan->status == 'pending' ? 'bg-yellow-50' : ($pesanan->status == 'processing' ? 'bg-blue-50' : 'hover:bg-gray-50') }} transition-colors duration-150">
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            #{{ $pesanan->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            <div class="font-medium text-gray-900">{{ $pesanan->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $pesanan->created_at->diffForHumans() }}</div>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="font-bold">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</div>
                                            <div class="text-xs text-gray-500">{{ $pesanan->details->count() }} Menu</div>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($pesanan->tipe_layanan == 'Dine-in')
                                                <div class="flex flex-col items-start gap-1">
                                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-800 text-white border border-gray-600 shadow-sm">
                                                        🍽️ Dine-in
                                                    </span>
                                                    <div class="flex items-center text-xs font-semibold text-gray-700 ml-0.5">
                                                        <svg class="w-3 h-3 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                                                        {{ $pesanan->jumlah_tamu }} Orang
                                                    </div>
                                                </div>
                                            @else
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-white text-gray-600 border border-gray-300 shadow-sm">
                                                    🥡 Take Away
                                                </span>
                                            @endif
                                        </td>
                                        
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

                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($pesanan->transaksi)
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-300">
                                                    LUNAS ✅
                                                </span>
                                                <div class="text-xs text-gray-500 mt-0.5">{{ $pesanan->transaksi->metode_pembayaran }}</div>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800 border border-red-300">
                                                    BELUM BAYAR
                                                </span>
                                            @endif
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="inline-flex items-center px-3 py-1 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                                <p class="text-lg font-medium">Belum ada pesanan masuk.</p>
                                                <p class="text-sm">Pesanan pelanggan akan muncul di sini.</p>
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
</x-app-layout>