<x-app-layout> {{-- Sesuaikan dengan layout admin Anda jika berbeda --}}
    <x-slot name="header">
        {{-- Tipografi Header: Dibuat lebih tebal dan tegas --}}
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen User') }}
        </h2>
    </x-slot>

    {{-- Latar belakang abu-abu agar kartu putih menonjol --}}
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tombol Tambah User: Diubah dari Hijau ke Merah (Primary Action) --}}
            <div class="mb-4">
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 transition-colors">
                    Tambah User Baru
                </a>
            </div>

            {{-- Pesan Sukses: Diubah dari Hijau ke Merah-muda (Brand) --}}
            @if ($message = Session::get('success'))
                <div class="bg-red-50 border-l-4 border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif
             {{-- Pesan Error: Sudah Merah (On-Brand) --}}
             @if ($message = Session::get('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            @endif

            {{-- Tabel User: Kontainer diberi border agar konsisten --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            {{-- Header Tabel: Diubah menjadi Hitam (Sesuai Footer) --}}
                            <thead class="bg-gray-800">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-200 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($users as $key => $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $users->firstItem() + $key }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $roleName)
                                                    {{-- Tag Role: Diubah dari Biru ke Monokrom (Hitam/Abu-abu) --}}
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($roleName == 'admin') bg-gray-800 text-white 
                                                        @else bg-gray-200 text-gray-800 @endif">
                                                        {{ $roleName }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        {{-- Aksi: Dirapikan dengan flex dan style tombol disamakan dengan halaman Menu --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2 items-center justify-center">
                                            {{-- Tombol Edit: Diubah dari link Indigo ke tombol Merah (Primary Action) --}}
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="text-red-600 hover:text-red-800 border border-gray-300 p-1 rounded-md text-xs font-semibold">Edit</a>
                                            
                                            {{-- Tombol Hapus: Style dirapikan (dihapus display:inline) dan diberi class m-0 --}}
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                {{-- Tombol Hapus: Dibuat Netral (Abu-abu -> Merah) konsisten dengan halaman Menu --}}
                                                <button type="submit" class="text-gray-600 hover:text-red-600 border border-gray-300 p-1 rounded-md text-xs font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada user.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     {{-- Pagination --}}
                     <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>