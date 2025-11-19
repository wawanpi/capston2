<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-black/60 z-40"
    x-cloak
></div>

<div 
    x-show="sidebarOpen"
    x-transition:enter="transform ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transform ease-in duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed top-0 left-0 h-full w-80 bg-white z-50 shadow-lg flex flex-col"
    x-cloak
>
    <div class="flex justify-between items-center p-4 border-b">
        <div class="text-2xl font-bold tracking-wider uppercase text-burmin-red">
            BURMIN
            <span class="block text-xs font-normal capitalize text-gray-600">Jagonya Warmindo</span>
        </div>
        <button @click="sidebarOpen = false">
            <i data-lucide="x" class="w-6 h-6 text-gray-700"></i>
        </button>
    </div>

    <div class="p-4 flex items-center gap-3 border-b">
        <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">
            <i data-lucide="user" class="w-6 h-6"></i>
        </div>
        <div>
            @auth
                <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-800 hover:text-kfc-red">Login / Daftar</a>
            @endauth
        </div>
    </div>

    <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-between p-3 rounded-lg font-semibold hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-100 text-kfc-red' : 'text-gray-700' }}">
            <span>Menu Makanan</span>
        </a>
        
        @auth
            <a href="{{ route('cart.list') }}" class="flex items-center justify-between p-3 rounded-lg font-semibold hover:bg-gray-100 {{ request()->routeIs('cart.list') ? 'bg-gray-100 text-kfc-red' : 'text-gray-700' }}">
                <span>Keranjang Saya</span>
                @if (\Cart::getTotalQuantity() > 0)
                    <span class="px-2 py-0.5 text-xs font-bold text-white bg-kfc-red rounded-full">{{ \Cart::getTotalQuantity() }}</span>
                @endif
            </a>
            <a href="{{ route('orders.index') }}" class="flex items-center justify-between p-3 rounded-lg font-semibold hover:bg-gray-100 {{ request()->routeIs('orders.*') ? 'bg-gray-100 text-kfc-red' : 'text-gray-700' }}">
                <span>Riwayat Pesanan</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="flex items-center justify-between p-3 rounded-lg font-semibold hover:bg-gray-100 {{ request()->routeIs('profile.edit') ? 'bg-gray-100 text-kfc-red' : 'text-gray-700' }}">
                <span>Profil Saya</span>
            </a>

            <div class="border-t pt-2 mt-2">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 p-3 rounded-lg text-red-600 hover:bg-red-50 w-full">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span class="font-semibold">Logout</span>
                    </a>
                </form>
            </div>
        @endauth
    </nav>

    <div class="mt-auto p-4 bg-gray-800 text-white">
        <h4 class="font-bold mb-3 uppercase">DOWNLOAD APP</h4>
        <div class="flex flex-col gap-3">
            <a href="#"><img src="https://kfcindonesia.com/static/media/app_store.e23d24be.png" alt="App Store" class="h-12 w-auto"></a>
            <a href="#"><img src="https://kfcindonesia.com/static/media/google_play.d51c76c0.png" alt="Google Play" class="h-12 w-auto"></a>
        </div>
    </div>
</div>


<header class="bg-kfc-red text-white shadow-lg fixed w-full top-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = true">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold tracking-wider uppercase">
                BURMIN <span class="block text-xs font-normal capitalize">Jagonya Warmindo</span>
            </a>
        </div>

        <div class="flex items-center gap-3 md:gap-5">
            <div class="relative">
                <button class="flex items-center gap-1 font-semibold text-sm">
                    ID <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </button>
            </div>
            
            <div class="relative">
                <button @click="profileOpen = !profileOpen" class="w-10 h-10 bg-white text-kfc-red rounded-full flex items-center justify-center">
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
                    class="absolute right-0 top-12 z-50 w-80 bg-white rounded-lg shadow-lg border text-gray-800"
                    x-cloak
                >
                    <div class="p-4 border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gray-200 text-gray-500 rounded-full flex items-center justify-center">
                                <i data-lucide="user" class="w-6 h-6"></i>
                            </div>
                            <div>
                                @auth
                                    <span class="font-semibold text-gray-800">{{ Auth::user()->name }}</span>
                                    <a href="{{ route('profile.edit') }}" class="text-sm text-red-600 block">Lihat Profil</a>
                                @else
                                    <a href="{{ route('login') }}" class="font-semibold text-gray-800">Login / Daftar</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    
                    @auth
                    <nav class="p-2 text-gray-700">
                        <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                            <i data-lucide="package" class="w-5 h-5"></i> <span class="font-semibold">Riwayat Pesanan</span>
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100">
                            <i data-lucide="settings-2" class="w-5 h-5"></i> <span class="font-semibold">Pengaturan Akun</span>
                        </a>
                        <div class="border-t mx-2 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50">
                                <i data-lucide="log-out" class="w-5 h-5"></i> <span class="font-semibold">Logout</span>
                            </button>
                        </form>
                    </nav>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>