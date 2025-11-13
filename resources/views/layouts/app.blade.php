<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ... (Script CDN Anda: Tailwind, Lucide, Alpine) ... -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- GANTI BLOK STYLE LAMA ANDA DENGAN YANG INI --}}
    <style>
        /* Style kustom Anda (TETAP ADA) */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .bg-kfc-red { background-color: #E3002B; }
        .text-kfc-red { color: #E3002B; }
        .focus\:ring-kfc-red:focus {
            --tw-ring-color: #E3002B;
        }
        .text-burmin-red { color: #E3002B; }
        [x-cloak] { display: none !important; }

        /* === CSS BARU UNTUK CETAK NOTA === */
        
        /* 1. Sembunyikan nota di tampilan layar biasa */
        .print-this {
            display: none;
        }

        @media print {
            /* 2. Sembunyikan semua elemen yang punya kelas .no-print */
            .no-print {
                display: none !important;
            }
            
            /* 3. Sembunyikan semua elemen di body */
            body * {
                visibility: hidden;
            }
            
            /* 4. Tampilkan HANYA .print-this dan semua anaknya */
            .print-this, .print-this * {
                visibility: visible !important;
            }

            /* 5. Atur area cetak ke atas halaman */
            .print-this {
                display: block !important;
                position: absolute;
                top: 10px;
                left: 10px;
                right: 10px;
            }

            /* 6. Terapkan style nota kasir */
            .nota-wrapper {
                font-family: 'Courier New', Courier, monospace; /* Font ala kasir */
                color: #000;
                max-width: 320px; /* Lebar kertas thermal 80mm */
                margin: 0 auto;
                padding: 5px;
            }
            .nota-header, .nota-footer {
                text-align: center;
            }
            .nota-header h2 {
                font-size: 1.1rem;
                font-weight: bold;
                margin: 0;
            }
            .nota-header p {
                font-size: 0.8rem;
                margin: 2px 0;
            }
            .nota-separator {
                border-top: 1px dashed #000;
                margin: 8px 0;
            }
            .nota-details, .nota-items, .nota-total {
                font-size: 0.85rem;
                margin-bottom: 8px;
            }
            .nota-details p {
                margin: 2px 0;
                display: flex;
                justify-content: space-between;
            }
            .nota-items table, .nota-total table {
                width: 100%;
            }
            .nota-items th {
                text-align: left;
                border-bottom: 1px solid #000;
            }
            .nota-items td:last-child, .nota-total td:last-child {
                text-align: right;
            }
            .nota-footer p {
                font-size: 0.8rem;
                margin-top: 5px;
            }
        }
        /* === AKHIR BLOK CETAK NOTA === */
    </style>
</head>

<body class="bg-gray-50 font-sans" x-data="{ sidebarOpen: false, profileOpen: false }">

    {{-- TAMBAHKAN .no-print AGAR NAVIGASI TIDAK IKUT TERCETAK --}}
    <div class="no-print">
        @include('layouts.navigation')
    </div>

    <!-- Page Content -->
    <main class="pt-20"> 
        {{ $slot }}
    </main>
    
    {{-- TAMBAHKAN .no-print AGAR FOOTER TIDAK IKUT TERCETAK --}}
    <footer class="bg-gray-900 text-gray-300 pt-16 pb-8 no-print">
        {{-- ... (Isi footer Anda) ... --}}
        <div class="container mx-auto px-4">
             <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">PT FAST FOOD INDONESIA TBK</h4>
                    <p class="text-sm mb-2">Address: Jl. Bunga, Geblagan, Tamantirto, Kec. Kasihan, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55184</p>
                    <p class="text-sm mb-2">Operating hours: <br> Weekday: 08.00 - 20.00 <br> Weekend: 10.00 - 19.00</p>
                    <p class="text-sm mb-2">Telephone: 14022</p>
                    <p class="text-sm">E-mail: info@kfcindonesia.com</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">SERVICES</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Dine-In</a></li>
                        <li><a href="#" class="hover:text-white">Take Away</a></li>
                        <li><a href="#" class="hover:text-white">Delivery</a></li>
                        <li><a href="#" class="hover:text-white">Drive-Thru</a></li>
                        <li><a href="#" class="hover:text-white">Catering</a></li>
                        <li><a href="#" class="hover:text-white">B'day Party</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">INFO</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                        <li><a href="#" class="hover:text-white">Allergen Information</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">DOWNLOAD APP</h4>
                    <div class="flex flex-col gap-4">
                        <a href="#"><img src="https://kfcindonesia.com/static/media/app_store.e23d24be.png" alt="App Store" class="h-12"></a>
                        <a href="#"><img src="https://kfcindonesia.com/static/media/google_play.d51c76c0.png" alt="Google Play" class="h-12"></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p class="mb-4 md:mb-0">&copy; {{ date('Y') }} kfc.com by PT FASTFOOD INDONESIA Tbk. | All rights reserved.</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-white"><i data-lucide="facebook" class="w-5 h-5"></i></a>
                    <a href="https://www.instagram.com/burjominang/" class="hover:text-white"><i data-lucide="instagram" class="w-5 h-5"></i></a>
                    <a href="#" class="hover:text-white"><i data-lucide="twitter" class="w-5 h-5"></i></a>
                    <a href="#" class="hover:text-white"><i data-lucide="youtube" class="w-5 h-5"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- === TOMBOL MELAYANG (Tambahkan no-print) === -->
    @auth
        @if(!Auth::user()->hasRole('admin'))
            <a href="{{ route('cart.list') }}" class="fixed bottom-16 right-4 z-30 bg-kfc-red p-4 rounded-full shadow-lg group no-print">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.023.828l1.25 5.001A2.25 2.25 0 0 0 6.095 12H17.25a2.25 2.25 0 0 0 2.22-1.87l.46-4.885A1.125 1.125 0 0 0 18.72 4.125H5.111M7.5 18a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm10.5 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
                @if (\Cart::getTotalQuantity() > 0)
                    <span class="absolute -top-2 -right-2 bg-white text-kfc-red text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ \Cart::getTotalQuantity() }}</span>
                @endif
            </a>
            <button class="fixed bottom-4 right-4 z-30 no-print">
                <img src="https://kfcindonesia.com/static/media/bucket-list-icon.1139e8c3.png" alt="Prize" class="w-16 h-16">
            </button>
        @endif
    @endauth
    
    <script>
        lucide.createIcons();
    </script>
    {{ $scripts ?? '' }}

</body>
</html>