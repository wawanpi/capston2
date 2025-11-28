{{-- 
    === SIDEBAR MOBILE (OFF-CANVAS) === 
    Z-Index: 50 (Paling Atas)
--}}

{{-- 1. Backdrop Gelap (z-45) --}}
<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/60 z-[45]"
    x-cloak
></div>

{{-- 2. Panel Sidebar Putih (z-50) --}}
<div 
    x-show="sidebarOpen"
    x-transition:enter="transform ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transform ease-in duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed top-0 left-0 h-full w-80 bg-white z-50 shadow-2xl flex flex-col"
    x-cloak
>
    {{-- Sidebar Header --}}
    <div class="flex justify-between items-center p-4 border-b h-20 bg-white">
        <div class="text-2xl font-bold tracking-wider uppercase text-kfc-red">
            BURMIN
        </div>
        <button @click="sidebarOpen = false" class="p-2 hover:bg-gray-100 rounded-full">
            <i data-lucide="x" class="w-6 h-6 text-gray-700"></i>
        </button>
    </div>

    {{-- User Info --}}
    <div class="p-6 border-b bg-white">
        @auth
            <div class="flex items-center gap-4">
                {{-- Avatar Circle --}}
                <div class="w-12 h-12 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center">
                    <i data-lucide="user" class="w-6 h-6"></i>
                </div>
                {{-- Nama User --}}
                <div>
                    <p class="font-bold text-gray-900 text-lg">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Member Setia</p>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="block w-full text-center bg-kfc-red text-white py-3 rounded-lg font-bold shadow-md hover:bg-red-700 transition">Login / Register</a>
        @endauth
    </div>

    {{-- Menu List (Sesuai Gambar) --}}
    <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
        
        {{-- 1. Menu Makanan --}}
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 rounded-lg font-semibold transition-colors {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-kfc-red' : 'text-gray-700 hover:bg-gray-50' }}">
            <span>Menu Makanan</span>
        </a>
        
        @auth
            {{-- 2. Keranjang Saya --}}
            <a href="{{ route('cart.list') }}" class="flex items-center justify-between p-3 rounded-lg font-semibold transition-colors {{ request()->routeIs('cart.list') ? 'bg-gray-100 text-kfc-red' : 'text-gray-700 hover:bg-gray-50' }}">
                <span>Keranjang Saya</span>
                @if(\Cart::getTotalQuantity() > 0)
                    <span class="bg-kfc-red text-white text-xs px-2 py-0.5 rounded-full">{{ \Cart::getTotalQuantity() }}</span>
                @endif
            </a>

            {{-- 3. Riwayat Pesanan (DITAMBAHKAN) --}}
            {{-- Pastikan route 'orders.index' ada di web.php Anda --}}
            <a href="{{ route('orders.index') }}" class="flex items-center gap-3 p-3 rounded-lg font-semibold transition-colors {{ request()->routeIs('orders.*') ? 'bg-gray-100 text-kfc-red' : 'text-gray-700 hover:bg-gray-50' }}">
                <span>Riwayat Pesanan</span>
            </a>

            {{-- 4. Profil Saya (DITAMBAHKAN) --}}
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 rounded-lg font-semibold transition-colors {{ request()->routeIs('profile.edit') ? 'bg-gray-100 text-kfc-red' : 'text-gray-700 hover:bg-gray-50' }}">
                <span>Profil Saya</span>
            </a>
            
            {{-- Separator Tipis --}}
            <div class="border-t border-gray-100 my-2"></div>

            {{-- 5. Logout (Merah & Ikon Keluar) --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 p-3 rounded-lg text-red-600 hover:bg-red-50 font-bold transition-colors mt-2">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span>Logout</span>
                </button>
            </form>
        @endauth
    </nav>
</div>


{{-- 
    === MAIN HEADER (FIXED) === 
    Z-Index: 40 (Tetap sama seperti sebelumnya)
--}}
<header class="bg-kfc-red text-white shadow-lg fixed w-full top-0 left-0 z-40 h-20 transition-all duration-300">
    <div class="container mx-auto px-4 h-full flex justify-between items-center">
        
        {{-- Kiri: Hamburger & Logo --}}
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = true" class="p-2 hover:bg-white/20 rounded-lg transition">
                <i data-lucide="menu" class="w-7 h-7"></i>
            </button>
            <a href="{{ route('dashboard') }}" class="flex flex-col leading-none">
                <span class="text-2xl font-black tracking-wider uppercase italic">BURMIN</span>
                <span class="text-[10px] font-medium tracking-wide opacity-90">Jagonya Warmindo</span>
            </a>
        </div>

        {{-- Kanan: Profile / Cart Icon Desktop --}}
        <div class="flex items-center gap-4">
            
            @auth
            {{-- Cart Icon (Desktop Only) --}}
            <a href="{{ route('cart.list') }}" class="hidden md:flex relative p-2 hover:bg-white/20 rounded-full">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                @if(\Cart::getTotalQuantity() > 0)
                    <span class="absolute top-0 right-0 bg-white text-kfc-red text-[10px] font-bold h-4 w-4 rounded-full flex items-center justify-center border border-kfc-red">
                        {{ \Cart::getTotalQuantity() }}
                    </span>
                @endif
            </a>
            @endauth

            {{-- Profile Dropdown (Versi Desktop) --}}
            <div class="relative">
                <button @click="profileOpen = !profileOpen" class="w-10 h-10 bg-white text-kfc-red rounded-full flex items-center justify-center shadow-md hover:bg-gray-100 transition">
                    <i data-lucide="user" class="w-5 h-5"></i>
                </button>

                <div 
                    x-show="profileOpen"
                    @click.outside="profileOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 top-12 z-50 w-64 bg-white rounded-lg shadow-xl border border-gray-100 text-gray-800 overflow-hidden"
                    x-cloak
                >
                    @auth
                        <div class="p-4 border-b bg-gray-50">
                            <p class="font-bold truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="p-2">
                            {{-- Menu Dropdown Desktop --}}
                            <a href="{{ route('orders.index') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded text-sm">
                                <i data-lucide="package" class="w-4 h-4"></i> Riwayat Pesanan
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded text-sm">
                                <i data-lucide="settings" class="w-4 h-4"></i> Profil Saya
                            </a>
                            <div class="border-t my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 hover:bg-red-50 text-red-600 rounded text-sm text-left">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="p-2">
                            <a href="{{ route('login') }}" class="block text-center px-4 py-2 bg-kfc-red text-white rounded font-bold text-sm">Login Sekarang</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>