<?php

namespace App\Console\Commands;

use App\Models\Menu;
use App\Models\DailyKetersediaan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon; // Pastikan Carbon diimport

class ResetDailyKetersediaan extends Command
{
    /**
     * Nama dan signature dari command console.
     * @var string
     */
    protected $signature = 'ketersediaan:reset';

    /**
     * Deskripsi command console.
     * @var string
     */
    protected $description = 'Menyalin jumlah default menu ke ketersediaan harian untuk hari ini.';

    /**
     * Jalankan command console.
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $menus = Menu::all();
        $records = [];
        $count = 0;

        $this->info("Memulai proses reset ketersediaan untuk tanggal: " . $today->toDateString());

        // 1. Loop melalui semua menu yang ada di database
        foreach ($menus as $menu) {
            
            // 2. Cek apakah entri ketersediaan untuk menu ini hari ini sudah ada
            $existing = DailyKetersediaan::where('menu_id', $menu->id)
                                         ->whereDate('tanggal', $today)
                                         ->first();

            // Hanya buat entri baru jika belum ada DAN jika jumlah_default > 0
            if (!$existing && $menu->jumlah_default > 0) {
                
                $records[] = [
                    'menu_id' => $menu->id,
                    'tanggal' => $today,
                    'jumlah_awal_hari' => $menu->jumlah_default,
                    'jumlah_saat_ini' => $menu->jumlah_default, // Stok riil di set sama dengan default
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $count++;
            }
        }

        // 3. Masukkan data ke database secara massal (mass insert)
        if (!empty($records)) {
            DB::table('daily_ketersediaan')->insert($records);
            $this->info("✅ Berhasil: " . $count . " menu baru berhasil di-reset untuk ketersediaan harian.");
        } else {
            $this->comment('ℹ️ Tidak ada menu baru yang perlu di-reset hari ini, atau sudah di-reset sebelumnya.');
        }

        return 0;
    }
}