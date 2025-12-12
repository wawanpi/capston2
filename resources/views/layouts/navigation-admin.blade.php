{{-- Overlay untuk Mobile (Klik di luar sidebar untuk menutup) --}}
<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/60 z-40 lg:hidden"
    x-cloak
></div>

{{-- SIDEBAR UTAMA --}}
<div 
    class="fixed top-0 left-0 z-50 h-screen w-64 bg-white shadow-xl transition-transform duration-300 border-r border-gray-100 flex flex-col font-sans"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
>
    {{-- 1. HEADER SIDEBAR (Logo & Close Button) --}}
    <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100 shrink-0">
        <div class="flex flex-col justify-center">
            <span class="text-2xl font-extrabold text-[#E3002B] tracking-wider uppercase leading-none">
                BURJO MINANG
            </span>
            <span class="text-[10px] font-medium text-gray-500 tracking-wide mt-1">
                Jagonya Warmindo
            </span>
        </div>
        {{-- Tombol Close (Hanya di Mobile) --}}
        <button @click="sidebarOpen = false" class="lg:hidden p-1 rounded-md hover:bg-red-50 text-gray-500 hover:text-[#E3002B] transition-colors">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    {{-- 2. PROFIL ADMIN --}}
    <div class="px-6 py-6 shrink-0">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-white border border-gray-100 shadow-sm">
            <div class="w-10 h-10 shrink-0 rounded-full bg-red-100 flex items-center justify-center text-[#E3002B]">
                <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <div class="overflow-hidden">
                @auth
                    <p class="text-sm font-bold text-gray-800 truncate leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mt-0.5">Administrator</p>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-800 hover:text-[#E3002B]">Login</a>
                @endauth
            </div>
        </div>
    </div>

    {{-- 3. NAVIGASI MENU --}}
    <nav class="flex-grow px-4 space-y-1 overflow-y-auto custom-scrollbar">
        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           {{ request()->routeIs('admin.dashboard') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' 
           }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Dashboard</span>
        </a>
        
        {{-- Manajemen Menu --}}
        <a href="{{ route('admin.menus.index') }}" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           {{ request()->routeIs('admin.menus.*') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' 
           }}">
            <i data-lucide="utensils-crossed" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Manajemen Menu</span>
        </a>

        {{-- Kelola Pesanan --}}
        <a href="{{ route('admin.pesanan.index') }}" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           {{ request()->routeIs('admin.pesanan.*') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' 
           }}">
            <i data-lucide="shopping-bag" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Kelola Pesanan</span>
        </a>

        {{-- Kelola Transaksi --}}
        <a href="{{ route('admin.transaksi.index') }}" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           {{ request()->routeIs('admin.transaksi.*') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' 
           }}">
            <i data-lucide="receipt" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Kelola Transaksi</span>
        </a>

        {{-- Manajemen User --}}
        <a href="{{ route('admin.users.index') }}" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           {{ request()->routeIs('admin.users.*') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' 
           }}">
            <i data-lucide="users" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Manajemen User</span>
        </a>
    </nav>

    {{-- 4. TOMBOL LOGOUT --}}
    <div class="px-4 pt-2 pb-2">
        <div class="border-t border-gray-100 pt-2">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <a href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); this.closest('form').submit();" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 w-full transition-all duration-200 group">
                    <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="font-semibold">Logout</span>
                </a>
            </form>
        </div>
    </div>

    {{-- 5. FOOTER SIDEBAR (Download App) --}}
    <div class="p-4 border-t border-gray-100 bg-gray-50/50 shrink-0">
        <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 mb-3 uppercase text-center tracking-widest">Available On</p>
            <div class="flex flex-col gap-2">
                <a href="#" class="opacity-80 hover:opacity-100 hover:scale-[1.02] transition-all duration-300">
                    <img src="{{ asset('img/google-play.png') }}" alt="Get it on Google Play" class="h-10 w-auto mx-auto object-contain">
                </a>
                <a href="#" class="opacity-80 hover:opacity-100 hover:scale-[1.02] transition-all duration-300">
                    <img src="{{ asset('img/app-store.png') }}" alt="Download on the App Store" class="h-9 w-auto mx-auto object-contain">
                </a>
            </div>
        </div>
    </div>
</div>

{{-- TOPBAR HEADER --}}
{{-- 
    Catatan: Karena Sidebar sekarang memiliki Logo sendiri dan index z-50,
    header ini akan bergeser di desktop (pl-64) atau logo di header disembunyikan saat desktop.
--}}
<header class="bg-[#E3002B] text-white shadow-lg fixed w-full top-0 z-40 transition-all duration-300 h-16 lg:pl-64">
    <div class="container mx-auto px-4 h-full flex justify-between items-center">
        
        <div class="flex items-center gap-4">
            {{-- Tombol Hamburger (Hanya Mobile) --}}
            <button @click="sidebarOpen = true" class="lg:hidden focus:outline-none p-1 rounded hover:bg-white/10 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            {{-- Logo di Header (Hanya tampil di Mobile, di Desktop sudah ada di Sidebar) --}}
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col lg:hidden">
                <span class="text-xl font-bold tracking-wider uppercase leading-none">BURMIN</span>
            </a>
            
            {{-- Judul Halaman (Dinamis sesuai halaman yang dibuka) --}}
            <h1 class="hidden lg:block text-lg font-semibold opacity-90">
                @if(request()->routeIs('admin.dashboard'))
                    Dashboard
                @elseif(request()->routeIs('admin.menus.*'))
                    Manajemen Menu
                @elseif(request()->routeIs('admin.pesanan.*'))
                    Kelola Pesanan
                @elseif(request()->routeIs('admin.transaksi.*'))
                    Kelola Transaksi
                @elseif(request()->routeIs('admin.users.*'))
                    Manajemen User
                @else
                    Admin Portal
                @endif
            </h1>
        </div>

        <div class="flex items-center gap-4 md:gap-6">
            <div class="relative hidden md:block">
                <button class="flex items-center gap-1 font-medium text-sm opacity-80 hover:opacity-100 transition">
                    ID <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </button>
            </div>
            
            <div class="relative">
                <button @click="profileOpen = !profileOpen" class="w-9 h-9 bg-white text-[#E3002B] rounded-full flex items-center justify-center shadow-md hover:bg-gray-100 transition-transform active:scale-95">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </button>

                {{-- Dropdown Profil --}}
                <div 
                    x-show="profileOpen"
                    @click.outside="profileOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                    class="absolute right-0 top-12 z-50 w-64 bg-white rounded-xl shadow-xl border border-gray-100 text-gray-800 ring-1 ring-black/5"
                    x-cloak
                >
                    <div class="p-4 border-b border-gray-100 bg-gray-50 rounded-t-xl">
                        <p class="font-bold text-gray-800 text-sm">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Administrator</p>
                    </div>
                    
                    <nav class="p-2 text-gray-700 text-sm">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                            <i data-lucide="settings" class="w-4 h-4 text-gray-400"></i> Pengaturan Akun
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>