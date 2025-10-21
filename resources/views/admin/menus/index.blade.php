<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('admin.menus.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Tambah Menu
                </a>
                <form method="GET" action="{{ route('admin.menus.index') }}">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Cari nama menu..." class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ request('search') }}">
                        <button type="submit" class="ml-2 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            @if ($message = Session::get('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Gambar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Menu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stok</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($menus as $menu)
                                <tr>
                                    {{-- TAMPILKAN GAMBAR DI SINI --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($menu->gambar)
                                            {{-- PERUBAHAN PENTING: Gunakan asset() langsung tanpa 'storage/' --}}
                                            <img src="{{ asset($menu->gambar) }}" alt="{{ $menu->namaMenu }}" class="w-16 h-16 object-cover rounded">
                                        @else
                                            <span class="text-xs text-gray-400">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $menu->namaMenu }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($menu->harga, 2, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $menu->stok }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.menus.edit', $menu->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada menu.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                     <div class="mt-4">
                        {{ $menus->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

