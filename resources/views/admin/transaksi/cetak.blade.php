<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan - {{ $filterLabel }}</title>
    {{-- Kita pakai CDN Tailwind agar cepat --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Sembunyikan tombol cetak saat mencetak */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                -webkit-print-color-adjust: exact; /* Memaksa print warna background */
                print-color-adjust: exact;
            }
        }
    </style>
</head>
{{-- Tambahkan window.print() agar dialog cetak otomatis muncul --}}
<body onload="window.print()">
    <div class="max-w-4xl mx-auto p-8 bg-white">

        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold">Laporan Pendapatan</h1>
            <h2 class="text-xl font-semibold">BURMIN - Jagonya Warmindo</h2>
            <p class="text-sm text-gray-600">{{ $filterLabel }}</e<p>
            {{-- Tampilkan tanggal jika pakai filter kustom --}}
            @if(request('start_date') && request('end_date'))
                <p class="text-sm text-gray-600">{{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
            @endif
        </div>

        {{-- Tombol Cetak (jika dialog ditutup) --}}
        <div class="mb-4 no-print">
            <button onclick="window.print()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                Cetak Laporan
            </button>
            <a href="{{ route('admin.transaksi.index', request()->query()) }}" class="px-4 py-2 text-gray-700 border rounded-md hover:bg-gray-100">
                Kembali
            </a>
        </div>

        {{-- Ringkasan Total Pendapatan --}}
        <div class="bg-gray-800 text-white p-6 rounded-lg mb-6">
            <h3 class="text-lg font-semibold uppercase">Total Pendapatan ({{ $filterLabel }})</h3>
            <p class="text-4xl font-bold">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </p>
        </div>

        {{-- Tabel Rincian Transaksi --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">ID TRX</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Tgl. Transaksi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Metode</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-200 uppercase tracking-wider">Total Bayar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($transaksis as $transaksi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#TRX-{{ $transaksi->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaksi->pesanan->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaksi->metode_pembayaran }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-700">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Tidak ada transaksi yang lunas untuk periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>