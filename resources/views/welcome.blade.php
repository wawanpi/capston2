<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BURJO MINANG</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js CDN (Defer agar dimuat setelah HTML) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Konfigurasi Kustom Tailwind --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'kfc-red': '#E4002B',
                    }
                }
            }
        }
    </script>

    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        @media (min-width: 1024px) {
            .hero-lg-height {
                height: calc(100vh - 68px); /* Tinggi header ~68px */
            }
        }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: #ccc; border-radius: 4px; }
        [x-cloak] { display: none !important; } /* Hide elements managed by Alpine until it loads */
    </style>
</head>
<body class="bg-white" x-data="{ open: false }">

    {{-- Header --}}
    <header class="sticky top-0 z-40 bg-white shadow-md">
        <nav class="container mx-auto px-4 py-2 flex justify-between items-center h-[68px]">
            {{-- Kiri: Tombol Menu Mobile --}}
            <div class="lg:hidden">
                <button @click="open = true" class="text-gray-700 focus:outline-none" aria-label="Open menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7"> <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /> </svg>
                </button>
            </div>

            {{-- Tengah: Logo --}}
            <div class="flex-grow flex justify-center lg:flex-grow-0 lg:justify-start items-center">
                 <a href="/" class="flex items-center" aria-label="Homepage">
                     <img src="{{ asset('menu-images/Burmin_logo.jpg') }}" alt="BURJO MINANG" class="h-16 lg:h-18">
                 </a>
            </div>

            {{-- Tengah: Menu Navigasi (Hanya Desktop) --}}
            <div class="hidden lg:flex flex-grow justify-center items-center space-x-6">
                <a href="#" class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200">Menu</a>
                <a href="#" class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200">Kids</a>
                <a href="#" class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200">Automotive</a>
                <div class="relative group">
                     <button class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200 flex items-center"> Corporate <svg class="w-4 h-4 ml-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg> </button>
                     <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200 invisible group-hover:visible z-50">
                         <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">About Us</a>
                         <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Investor Relations</a>
                     </div>
                </div>
                <a href="#" class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200">Event</a>
                <a href="#" class="text-gray-700 font-semibold uppercase text-sm hover:text-kfc-red transition duration-200">Karir</a>
            </div>

            {{-- Kanan: Tombol Aksi --}}
            <div class="flex items-center space-x-3 flex-shrink-0">
                {{-- Tombol Sign Up (Hanya Desktop) --}}
                <a href="{{ route('register') }}" class="hidden lg:inline-block bg-white text-kfc-red border border-kfc-red px-5 py-[7px] rounded-full font-semibold text-sm hover:bg-red-50 transition duration-300 shadow-sm">
                    Sign Up
                </a>
                {{-- Tombol Sign In (Hanya Desktop) --}}
                <a href="{{ route('login') }}" class="hidden lg:inline-block bg-kfc-red text-white px-5 py-2 rounded-full font-semibold text-sm hover:bg-red-700 transition duration-300 shadow-sm">
                    Sign In
                </a>
                {{-- Tombol Contact Us (Desktop & Mobile) --}}
                 <a href="tel:14022" class="lg:hidden flex items-center bg-kfc-red text-white px-3 py-1.5 rounded-full font-semibold text-xs shadow-sm" aria-label="Contact Us 14022">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 mr-1"> <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.63 C11.26 15.22 8.78 12.74 7.043 10.014l1.293-.97c.362-.271.527-.734.417-1.173L7.353 3.602a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /> </svg>
                    <span class="font-bold">14022</span>
                 </a>
            </div>
        </nav>
    </header>

    {{-- Sidebar Menu --}}
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" x-show="open" x-cloak>
        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full">
                    <div class="pointer-events-auto w-screen transform transition ease-in-out duration-300"
                         x-show="open"
                         x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                         x-transition:leave="transform transition ease-in-out duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                        <div class="flex h-full flex-col overflow-y-auto bg-white shadow-xl sidebar-scroll">
                            {{-- Sidebar Header --}}
                            <div class="flex items-center justify-between p-4 border-b">
                                <div class="flex space-x-1"> <span class="w-1.5 h-6 bg-kfc-red"></span> <span class="w-1.5 h-6 bg-kfc-red"></span> <span class="w-1.5 h-6 bg-kfc-red"></span> </div>
                                <button type="button" class="relative rounded-md text-gray-500 hover:text-gray-700 focus:outline-none" @click="open = false" aria-label="Close menu">
                                    <span class="absolute -inset-2.5"></span> <span class="sr-only">Close panel</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true"> <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /> </svg>
                                </button>
                            </div>

                            {{-- Sidebar Content --}}
                            <div class="relative flex-1">
                                {{-- Tombol Sign In & Sign Up --}}
                                <div class="px-4 py-6 space-y-3">
                                    <a href="{{ route('login') }}" class="block w-full text-center bg-kfc-red text-white px-5 py-3 rounded-md font-semibold hover:bg-red-700 transition duration-300 shadow-sm">
                                        Sign In
                                    </a>
                                    {{-- Tombol Sign Up Baru --}}
                                     <a href="{{ route('register') }}" class="block w-full text-center bg-white text-kfc-red border border-kfc-red px-5 py-[11px] rounded-md font-semibold hover:bg-red-50 transition duration-300 shadow-sm">
                                        Sign Up
                                    </a>
                                </div>

                                {{-- Menu List --}}
                                <nav class="flex flex-col text-gray-800 font-semibold uppercase text-sm">
                                    <a href="#" class="px-4 py-3 border-t hover:bg-gray-100 transition duration-200">Menu</a>
                                    <a href="#" class="px-4 py-3 border-t hover:bg-gray-100 transition duration-200">Kids</a>
                                    <div class="border-t">
                                        <div class="px-4 py-3 font-bold">Automotive</div>
                                        <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> Sean Gelael <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                        <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> WEC <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                         <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> News <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                    </div>
                                     <div class="border-t">
                                        <div class="px-4 py-3 font-bold">Corporate</div>
                                        <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> Profile <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                         <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> Annual Report <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                         <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> Financial Report <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                        <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> Press Release <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                         <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> Franchise <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                         <a href="#" class="flex justify-between items-center px-4 py-3 pl-8 hover:bg-gray-100 transition duration-200 text-gray-600 normal-case font-medium"> News <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-gray-400"> <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" /> </svg> </a>
                                    </div>
                                    <a href="#" class="px-4 py-3 border-t hover:bg-gray-100 transition duration-200">Event</a>
                                    <a href="#" class="px-4 py-3 border-t hover:bg-gray-100 transition duration-200">Karir</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sisa Konten Halaman Utama --}}
    <main>
        {{-- Hero Section --}}
        <section class="relative w-full h-[50vh] md:h-[60vh] lg:h-[75vh] hero-lg-height bg-cover bg-center" style="background-image: url('https://kfcku.com/static/media/home_banner_desktop_4.e8838d22.webp');">
             <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent flex items-center">
                 <div class="container mx-auto px-4 lg:px-12 text-left">
                      <h1 class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold uppercase tracking-tight max-w-lg"> Jagonya <br> Rasa Original </h1>
                      <p class="text-white text-base sm:text-lg md:text-xl mt-3 font-semibold"> Jaminan Kualitas </p>
                 </div>
             </div>
        </section>

        {{-- Content Section (Video & News) --}}
        <section class="container mx-auto my-12 md:my-16 px-4">
             <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
                <div class="lg:col-span-2">
                    <h2 class="text-xl md:text-2xl font-bold mb-5 uppercase text-gray-800 tracking-wide">Video Commercial</h2>
                    <div class="relative aspect-video bg-gray-200 rounded-lg overflow-hidden shadow-lg group cursor-pointer">
                        <img src="https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg" alt="Video Thumbnail" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30 group-hover:bg-opacity-10 transition-opacity duration-300">
                            <div class="bg-white bg-opacity-80 rounded-full p-4 md:p-6 shadow-xl transform transition-transform duration-300 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 md:w-12 md:h-12 text-kfc-red"> <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" /> </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-1">
                     <div class="flex justify-between items-center mb-5">
                        <h2 class="text-xl md:text-2xl font-bold uppercase text-gray-800 tracking-wide">News and Article</h2>
                         <a href="#" class="text-sm text-kfc-red font-semibold hover:underline"> See more </a>
                    </div>
                    <div class="space-y-5">
                        <a href="#" class="flex items-start space-x-4 group p-2 rounded-md hover:bg-gray-100 transition duration-200"> <img src="https://kfcku.com/uploads/media/thumb-rapat-umum-pemegang-saham-luar-biasa-rup-slb-pt-fast-food-indonesia-tbk_1716954378776.jpg" alt="News 1" class="w-24 h-16 object-cover rounded-md shadow-sm flex-shrink-0 mt-1"> <div> <h3 class="font-semibold text-gray-800 group-hover:text-kfc-red leading-tight text-base"> RAPAT UMUM PEMEGANG SAHAM... </h3> </div> </a>
                        <a href="#" class="flex items-start space-x-4 group p-2 rounded-md hover:bg-gray-100 transition duration-200"> <img src="https://kfcku.com/uploads/media/thumb-astra-otopower-hadir-di-kfc-mt-haryono_1716954203774.jpg" alt="News 2" class="w-24 h-16 object-cover rounded-md shadow-sm flex-shrink-0 mt-1"> <div> <h3 class="font-semibold text-gray-800 group-hover:text-kfc-red leading-tight text-base"> Astra Otopower Hadir di BURMIN MT Haryono </h3> </div> </a>
                        <a href="#" class="flex items-start space-x-4 group p-2 rounded-md hover:bg-gray-100 transition duration-200"> <img src="https://kfcku.com/uploads/media/thumb-banjir-hadiah-di-lucky-draw-door-prize-gathering-nasional-komunitas-driver-grab-2023_1716954044719.jpg" alt="News 3" class="w-24 h-16 object-cover rounded-md shadow-sm flex-shrink-0 mt-1"> <div> <h3 class="font-semibold text-gray-800 group-hover:text-kfc-red leading-tight text-base"> Banjir Hadiah di 'Lucky Draw Door Prize &... </h3> </div> </a>
                        <a href="#" class="flex items-start space-x-4 group p-2 rounded-md hover:bg-gray-100 transition duration-200"> <img src="https://kfcku.com/uploads/media/thumb-launching-the-new-kfcku-app-inovasi-terbaru-dari-kfc-indonesia_1716953942004.jpg" alt="News 4" class="w-24 h-16 object-cover rounded-md shadow-sm flex-shrink-0 mt-1"> <div> <h3 class="font-semibold text-gray-800 group-hover:text-kfc-red leading-tight text-base"> Launching 'The New KFCKu App', Inovasi... </h3> </div> </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Section Tambahan (Ikon-ikon) --}}
        <section class="bg-gray-100 py-12 px-4">
             <div class="container mx-auto grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 text-center">
                 <div class="flex flex-col items-center"> <div class="bg-red-100 rounded-full p-4 mb-3 inline-block"> <img src="https://kfcindonesia.com/static/media/promo.dfda1076.png" alt="Promo" class="h-10 w-10"> </div> <h4 class="font-bold text-gray-800 mb-1 text-sm uppercase">Everyday Saver Deals</h4> <p class="text-xs text-gray-600 mb-2 px-2">Find interesting promos and vouchers only at KFC.</p> <a href="#" class="border border-kfc-red text-kfc-red px-4 py-1 rounded-full text-xs font-semibold hover:bg-red-50 transition duration-200">See more</a> </div>
                  <div class="flex flex-col items-center"> <div class="bg-red-100 rounded-full p-4 mb-3 inline-block"> <img src="https://kfcindonesia.com/static/media/menu.42a4ca90.png" alt="Menu" class="h-10 w-10"> </div> <h4 class="font-bold text-gray-800 mb-1 text-sm uppercase">See Our Variety of Menu</h4> <p class="text-xs text-gray-600 mb-2 px-2">See our variety of menu. And order to enjoy it.</p> <a href="#" class="border border-kfc-red text-kfc-red px-4 py-1 rounded-full text-xs font-semibold hover:bg-red-50 transition duration-200">See more</a> </div>
                  <div class="flex flex-col items-center"> <div class="bg-red-100 rounded-full p-4 mb-3 inline-block"> <img src="https://kfcindonesia.com/static/media/location.46a74b1e.png" alt="Location" class="h-10 w-10"> </div> <h4 class="font-bold text-gray-800 mb-1 text-sm uppercase">Find Our Outlet Near You</h4> <p class="text-xs text-gray-600 mb-2 px-2">Find our nearest shop and outlet in your location.</p> <a href="#" class="border border-kfc-red text-kfc-red px-4 py-1 rounded-full text-xs font-semibold hover:bg-red-50 transition duration-200">See more</a> </div>
                  <div class="flex flex-col items-center"> <div class="bg-red-100 rounded-full p-4 mb-3 inline-block"> <img src="https://kfcindonesia.com/static/media/birthday.89f18002.png" alt="Birthday" class="h-10 w-10"> </div> <h4 class="font-bold text-gray-800 mb-1 text-sm uppercase">Kids Celeberation Offers</h4> <p class="text-xs text-gray-600 mb-2 px-2">See our offers for kids celebration</p> <a href="#" class="border border-kfc-red text-kfc-red px-4 py-1 rounded-full text-xs font-semibold hover:bg-red-50 transition duration-200">See more</a> </div>
                  <div class="flex flex-col items-center col-span-2 md:col-span-1"> <div class="bg-red-100 rounded-full p-4 mb-3 inline-block"> <img src="https://kfcindonesia.com/static/media/chat.504c5e3f.png" alt="Chat" class="h-10 w-10"> </div> <h4 class="font-bold text-gray-800 mb-1 text-sm uppercase">Let's Connect With Us</h4> <p class="text-xs text-gray-600 mb-2 px-2">Feedbacks or contact us for further discussion.</p> <a href="#" class="border border-kfc-red text-kfc-red px-4 py-1 rounded-full text-xs font-semibold hover:bg-red-50 transition duration-200">See more</a> </div>
             </div>
        </section>
    </main>

    {{-- Tombol Order Now Melayang --}}
     <a href="#" class="fixed bottom-4 right-4 z-50 group">
        <div class="md:hidden flex flex-col items-center"> <div class="bg-kfc-red text-white rounded-full shadow-lg p-3 flex items-center justify-center transform transition-transform duration-300 group-hover:scale-110 mb-1"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"> <path d="M4.5 7.5a.75.75 0 0 1 .75-.75h13.5a.75.75 0 0 1 .75.75v9a3 3 0 0 1-3 3H7.5a3 3 0 0 1-3-3v-9Z" /> <path fill-rule="evenodd" d="M12.553 4.887a.75.75 0 0 1 .84 0l1.761 1.016a.75.75 0 0 1 .36.643V8.25a.75.75 0 0 1-1.5 0V7.207l-.761-.439a.75.75 0 0 1-.36-.643V4.887ZM8.553 4.887a.75.75 0 0 1 .84 0l1.761 1.016a.75.75 0 0 1 .36.643V8.25a.75.75 0 0 1-1.5 0V7.207l-.761-.439a.75.75 0 0 1-.36-.643V4.887Z" clip-rule="evenodd" /> </svg> </div> <span class="text-kfc-red text-xs font-bold bg-white px-2 py-0.5 rounded shadow">Order Now!</span> </div>
        <div class="hidden md:flex bg-kfc-red text-white font-bold rounded-full shadow-lg p-4 items-center justify-center space-x-2 transform transition-transform duration-300 group-hover:scale-110"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"> <path d="M4.5 7.5a.75.75 0 0 1 .75-.75h13.5a.75.75 0 0 1 .75.75v9a3 3 0 0 1-3 3H7.5a3 3 0 0 1-3-3v-9Z" /> <path fill-rule="evenodd" d="M12.553 4.887a.75.75 0 0 1 .84 0l1.761 1.016a.75.75 0 0 1 .36.643V8.25a.75.75 0 0 1-1.5 0V7.207l-.761-.439a.75.75 0 0 1-.36-.643V4.887ZM8.553 4.887a.75.75 0 0 1 .84 0l1.761 1.016a.75.75 0 0 1 .36.643V8.25a.75.75 0 0 1-1.5 0V7.207l-.761-.439a.75.75 0 0 1-.36-.643V4.887Z" clip-rule="evenodd" /> </svg> <span class="pr-2">Order Now!</span> </div>
    </a>

    {{-- Footer --}}
    <footer class="bg-[#1C1C1C] text-gray-400 py-10 px-4 mt-16">
         <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-sm">
             <div class="md:col-span-1"> <h4 class="font-bold text-white mb-3 uppercase">Alamat : </h4><p>Jl. Bunga, Geblagan, Tamantirto, Kec. Kasihan, Kabupaten Bantul,<br> Daerah Istimewa Yogyakarta 55184, Indonesia</p> <p class="mt-2">Operating hours:<br> Weekday : 08:00 - 20:00<br> Weekend : 10:00 - 19:00</p> <p class="mt-2">Telephone: <span class="font-semibold">14022</span></p> <p>E-mail: info@kfcindonesia.com</p> </div>
             <div class="md:col-span-1"> <h4 class="font-bold text-white mb-3 uppercase">Layanan</h4> <ul class="space-y-1"><li><a href="#" class="hover:text-white">Dine in</a></li> <li><a href="#" class="hover:text-white">Take Away</a></li> <li><a href="#" class="hover:text-white">Catering</a></li> <li><a href="#" class="hover:text-white">Drive Thru</a></li> </ul> </div>
              <div class="md:col-span-1"> <h4 class="font-bold text-white mb-3 uppercase">Karir</h4> <ul class="space-y-1"> <li><a href="#" class="hover:text-white">Karir</a></li> </ul> <h4 class="font-bold text-white mb-3 mt-4 uppercase">Info</h4> <ul class="space-y-1"> <li><a href="#" class="hover:text-white">Terms & Conditions</a></li> <li><a href="#" class="hover:text-white">Privacy Policy</a></li> <li><a href="#" class="hover:text-white">Contact Us</a></li> <li><a href="#" class="hover:text-white">About Us</a></li> <li><a href="#" class="hover:text-white">FAQ</a></li> <li><a href="#" class="hover:text-white">Allergen Info</a></li> </ul> </div>
            <div class="md:col-span-1">
                <h4 class="font-bold text-white mb-3 uppercase">Download App</h4>
                <div class="flex flex-col space-y-3 items-start">
                    <a href="#"><img src="https://kfcindonesia.com/static/media/google_play.d51c76c0.png" alt="Google Play" class="h-10"></a>
                    <a href="#"><img src="https://kfcindonesia.com/static/media/app_store.e23d24be.png" alt="App Store" class="h-10"></a>
                </div>
                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg></a>
                    <a href="https://www.instagram.com/burjominang/" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.067-.06-1.407-.06-4.123v-.08c0-2.643.012-2.987.06-4.043.049 1.064.218 1.791.465 2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.245 2 11.875 2h.08zm0 2.163c-2.403 0-2.729.01-3.692.052-1.287.059-1.835.218-2.213.364-.475.182-.818.399-1.15.732-.332.332-.55.675-.732 1.15-.146.378-.305.926-.364 2.213-.042 1.09-.052 1.379-.052 3.807v.487c0 2.427.01 2.716.052 3.807.059 1.287.218 1.835.364 2.213.182.475.399.818.732 1.15.332.332.675.55 1.15.732.378.146.926.305 2.213.364 1.09.042 1.379.052 3.807.052h.487c2.427 0 2.716-.01 3.807-.052 1.287-.059 1.835-.218 2.213-.364.475-.182.818-.399 1.15-.732.332.332.55-.675.732-1.15.146-.378.305-.926-.364-2.213.042-1.09.052-1.379.052-3.807v-.487c0-2.427-.01-2.716-.052-3.807-.059-1.287-.218-1.835-.364-2.213-.182-.475-.399-.818-.732-1.15-.332-.332-.675-.55-1.15-.732-.378-.146-.926-.305-2.213-.364-.963-.042-1.29-.052-3.692-.052h-.487zm0 3.882a6 6 0 100 12 6 6 0 000-12zm0 2.162a3.84 3.84 0 110 7.68 3.84 3.84 0 010-7.68z" clip-rule="evenodd" /></svg></a>
                </div>
            </div>
         </div>
         <div class="container mx-auto mt-8 pt-8 border-t border-gray-700 text-center text-xs">
             © {{ date('Y') }} KFCPKU.COM by PT FASTFOOD Indonesia Tbk. | All rights reserved.
         </div>
    </footer>

</body>
</html>