<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">
                        {{ __("Selamat datang di Halaman Admin!") }}
                    </p>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Manajemen User
                        </a>
                        
                        {{-- TOMBOL MANAJEMEN MENU BARU --}}
                        <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700">
                            Manajemen Menu
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
