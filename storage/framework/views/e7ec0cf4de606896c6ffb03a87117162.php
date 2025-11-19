
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
    class="fixed top-0 left-0 z-50 h-screen w-64 bg-white shadow-xl transition-transform duration-300 border-r border-gray-100 flex flex-col font-sans"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
>
    
    <div class="h-20 flex items-center justify-between px-6 border-b border-gray-100 shrink-0">
        <div class="flex flex-col justify-center">
            <span class="text-2xl font-extrabold text-[#E3002B] tracking-wider uppercase leading-none">
                BURMIN
            </span>
            <span class="text-[10px] font-medium text-gray-500 tracking-wide mt-1">
                Jagonya Warmindo
            </span>
        </div>
        
        <button @click="sidebarOpen = false" class="lg:hidden p-1 rounded-md hover:bg-red-50 text-gray-500 hover:text-[#E3002B] transition-colors">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    
    <div class="px-6 py-6 shrink-0">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-white border border-gray-100 shadow-sm">
            <div class="w-10 h-10 shrink-0 rounded-full bg-red-100 flex items-center justify-center text-[#E3002B]">
                <i data-lucide="user" class="w-5 h-5"></i>
            </div>
            <div class="overflow-hidden">
                <?php if(auth()->guard()->check()): ?>
                    <p class="text-sm font-bold text-gray-800 truncate leading-tight"><?php echo e(Auth::user()->name); ?></p>
                    <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wide mt-0.5">Administrator</p>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-sm font-bold text-gray-800 hover:text-[#E3002B]">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <nav class="flex-grow px-4 space-y-1 overflow-y-auto custom-scrollbar">
        
        <a href="<?php echo e(route('admin.dashboard')); ?>" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           <?php echo e(request()->routeIs('admin.dashboard') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
            <i data-lucide="layout-dashboard" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Dashboard</span>
        </a>
        
        
        <a href="<?php echo e(route('admin.menus.index')); ?>" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           <?php echo e(request()->routeIs('admin.menus.*') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
            <i data-lucide="utensils-crossed" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Manajemen Menu</span>
        </a>

        
        <a href="<?php echo e(route('admin.pesanan.index')); ?>" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           <?php echo e(request()->routeIs('admin.pesanan.*') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
            <i data-lucide="shopping-bag" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Kelola Pesanan</span>
        </a>

        
        <a href="<?php echo e(route('admin.transaksi.index')); ?>" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           <?php echo e(request()->routeIs('admin.transaksi.*') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
            <i data-lucide="receipt" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Kelola Transaksi</span>
        </a>

        
        <a href="<?php echo e(route('admin.users.index')); ?>" 
           class="group relative flex items-center gap-3 px-4 py-3 rounded-l-lg text-sm font-medium transition-all duration-200
           <?php echo e(request()->routeIs('admin.users.*') 
              ? 'bg-red-50 text-[#E3002B] border-r-4 border-[#E3002B]' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
            <i data-lucide="users" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
            <span>Manajemen User</span>
        </a>
    </nav>

    
    <div class="px-4 pt-2 pb-2">
        <div class="border-t border-gray-100 pt-2">
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                <?php echo csrf_field(); ?>
                <a href="<?php echo e(route('logout')); ?>" 
                   onclick="event.preventDefault(); this.closest('form').submit();" 
                   class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 w-full transition-all duration-200 group">
                    <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="font-semibold">Logout</span>
                </a>
            </form>
        </div>
    </div>

    
    <div class="p-6 bg-gray-50 border-t border-gray-200 shrink-0">
        <p class="text-[10px] font-bold text-gray-400 mb-3 uppercase text-center tracking-widest">Download App</p>
        <div class="flex justify-center gap-3">
            <a href="#" class="opacity-60 hover:opacity-100 hover:scale-105 transition-all duration-300">
                <img src="https://kfcindonesia.com/static/media/app_store.e23d24be.png" alt="App Store" class="h-7 w-auto grayscale hover:grayscale-0">
            </a>
            <a href="#" class="opacity-60 hover:opacity-100 hover:scale-105 transition-all duration-300">
                <img src="https://kfcindonesia.com/static/media/google_play.d51c76c0.png" alt="Google Play" class="h-7 w-auto grayscale hover:grayscale-0">
            </a>
        </div>
    </div>
</div>



<header class="bg-[#E3002B] text-white shadow-lg fixed w-full top-0 z-40 transition-all duration-300 h-16 lg:pl-64">
    <div class="container mx-auto px-4 h-full flex justify-between items-center">
        
        <div class="flex items-center gap-4">
            
            <button @click="sidebarOpen = true" class="lg:hidden focus:outline-none p-1 rounded hover:bg-white/10 transition">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex flex-col lg:hidden">
                <span class="text-xl font-bold tracking-wider uppercase leading-none">BURMIN</span>
            </a>
            
            
            <h1 class="hidden lg:block text-lg font-semibold opacity-90">
                <?php if(request()->routeIs('admin.dashboard')): ?>
                    Dashboard
                <?php elseif(request()->routeIs('admin.menus.*')): ?>
                    Manajemen Menu
                <?php elseif(request()->routeIs('admin.pesanan.*')): ?>
                    Kelola Pesanan
                <?php elseif(request()->routeIs('admin.transaksi.*')): ?>
                    Kelola Transaksi
                <?php elseif(request()->routeIs('admin.users.*')): ?>
                    Manajemen User
                <?php else: ?>
                    Admin Portal
                <?php endif; ?>
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
                        <p class="font-bold text-gray-800 text-sm"><?php echo e(Auth::user()->name ?? 'Admin'); ?></p>
                        <p class="text-xs text-gray-500 mt-0.5">Administrator</p>
                    </div>
                    
                    <nav class="p-2 text-gray-700 text-sm">
                        <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                            <i data-lucide="settings" class="w-4 h-4 text-gray-400"></i> Pengaturan Akun
                        </a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="flex w-full items-center gap-3 px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                                <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH D:\Kuliah\S7\capstonne\CapstoneProject\resources\views/layouts/navigation-admin.blade.php ENDPATH**/ ?>