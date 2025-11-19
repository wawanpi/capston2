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

<div 
    class="fixed top-0 left-0 z-40 h-screen w-64 bg-white shadow-lg transition-transform duration-300 border-r border-gray-200 pt-20 flex flex-col"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
>
    <div class="flex justify-between items-center px-4 pb-4 border-b lg:hidden">
        <div class="text-xl font-bold tracking-wider uppercase text-burmin-red">
            MENU
        </div>
        <button @click="sidebarOpen = false">
            <i data-lucide="x" class="w-6 h-6 text-gray-700"></i>
        </button>
    </div>

    <div class="p-4 flex items-center gap-3 border-b bg-gray-50">
        <div class="w-10 h-10 bg-red-100 text-kfc-red rounded-full flex items-center justify-center">
            <i data-lucide="shield-check" class="w-5 h-5"></i>
        </div>
        <div class="overflow-hidden">
            <?php if(auth()->guard()->check()): ?>
                <span class="font-semibold text-gray-800 text-sm block truncate"><?php echo e(Auth::user()->name); ?></span>
                <span class="text-xs text-gray-500 block">Administrator</span>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="font-semibold text-gray-800 text-sm">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <nav class="flex-grow p-4 space-y-2 overflow-y-auto">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 p-3 rounded-lg font-semibold hover:bg-red-50 hover:text-kfc-red transition-colors <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-red-50 text-kfc-red border-r-4 border-kfc-red' : 'text-gray-600'); ?>">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="<?php echo e(route('admin.menus.index')); ?>" class="flex items-center gap-3 p-3 rounded-lg font-semibold hover:bg-red-50 hover:text-kfc-red transition-colors <?php echo e(request()->routeIs('admin.menus.*') ? 'bg-red-50 text-kfc-red border-r-4 border-kfc-red' : 'text-gray-600'); ?>">
            <i data-lucide="utensils-crossed" class="w-5 h-5"></i>
            <span>Manajemen Menu</span>
        </a>

        <a href="<?php echo e(route('admin.pesanan.index')); ?>" class="flex items-center gap-3 p-3 rounded-lg font-semibold hover:bg-red-50 hover:text-kfc-red transition-colors <?php echo e(request()->routeIs('admin.pesanan.*') ? 'bg-red-50 text-kfc-red border-r-4 border-kfc-red' : 'text-gray-600'); ?>">
            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
            <span>Kelola Pesanan</span>
        </a>

        <a href="<?php echo e(route('admin.transaksi.index')); ?>" class="flex items-center gap-3 p-3 rounded-lg font-semibold hover:bg-red-50 hover:text-kfc-red transition-colors <?php echo e(request()->routeIs('admin.transaksi.*') ? 'bg-red-50 text-kfc-red border-r-4 border-kfc-red' : 'text-gray-600'); ?>">
            <i data-lucide="receipt" class="w-5 h-5"></i>
            <span>Kelola Transaksi</span>
        </a>

        <a href="<?php echo e(route('admin.users.index')); ?>" class="flex items-center gap-3 p-3 rounded-lg font-semibold hover:bg-red-50 hover:text-kfc-red transition-colors <?php echo e(request()->routeIs('admin.users.*') ? 'bg-red-50 text-kfc-red border-r-4 border-kfc-red' : 'text-gray-600'); ?>">
            <i data-lucide="users" class="w-5 h-5"></i>
            <span>Manajemen User</span>
        </a>

        <div class="border-t pt-4 mt-2">
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                <?php echo csrf_field(); ?>
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 p-3 rounded-lg text-red-600 hover:bg-red-50 w-full transition-colors">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span class="font-semibold">Logout</span>
                </a>
            </form>
        </div>
    </nav>

    <div class="p-4 bg-gray-50 border-t">
        <p class="text-xs font-bold text-gray-400 mb-2 uppercase text-center">Download App</p>
        <div class="flex justify-center gap-2">
            <a href="#"><img src="https://kfcindonesia.com/static/media/app_store.e23d24be.png" alt="App Store" class="h-8 w-auto grayscale hover:grayscale-0 transition"></a>
            <a href="#"><img src="https://kfcindonesia.com/static/media/google_play.d51c76c0.png" alt="Google Play" class="h-8 w-auto grayscale hover:grayscale-0 transition"></a>
        </div>
    </div>
</div>


<header class="bg-kfc-red text-white shadow-md fixed w-full top-0 z-50 transition-all duration-300 h-16">
    <div class="container mx-auto px-4 h-full flex justify-between items-center">
        
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = true" class="lg:hidden focus:outline-none">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex flex-col">
                <span class="text-2xl font-bold tracking-wider uppercase leading-none">BURMIN</span>
                <span class="text-[10px] font-normal capitalize opacity-90">Jagonya Warmindo</span>
            </a>
        </div>

        <div class="flex items-center gap-3 md:gap-5">
            <div class="relative">
                <button class="flex items-center gap-1 font-semibold text-sm opacity-90 hover:opacity-100">
                    ID <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </button>
            </div>
            
            <div class="relative">
                <button @click="profileOpen = !profileOpen" class="w-9 h-9 bg-white text-kfc-red rounded-full flex items-center justify-center shadow-sm hover:bg-gray-100 transition">
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
                    class="absolute right-0 top-12 z-50 w-64 bg-white rounded-lg shadow-lg border border-gray-100 text-gray-800"
                    x-cloak
                >
                    <div class="p-4 border-b bg-gray-50 rounded-t-lg">
                        <p class="font-bold text-gray-800"><?php echo e(Auth::user()->name ?? 'Admin'); ?></p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    
                    <nav class="p-2 text-gray-700 text-sm">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-100">
                            <i data-lucide="settings" class="w-4 h-4"></i> Pengaturan Akun
                        </a>
                        <div class="border-t my-1"></div>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="flex w-full items-center gap-3 px-3 py-2 rounded text-red-600 hover:bg-red-50">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/layouts/navigation-admin.blade.php ENDPATH**/ ?>