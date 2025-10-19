<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <-- PENTING: Tambahkan ini

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User Admin terlebih dahulu
        // Menggunakan firstOrCreate agar tidak error jika admin sudah ada
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Cari user dengan email ini
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'), // Ganti 'password' dengan password yang aman
                'email_verified_at' => now(),
            ]
        );

        // 2. Buat User Biasa (seperti kode Anda)
        // User ini akan mendapat ID=2 jika database kosong
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        
        // (Opsional) Buat 10 user acak lainnya jika perlu
        // User::factory(10)->create();

        // 3. Panggil Seeder untuk membuat dan menetapkan Roles
        // Ini akan membuat role 'admin' & 'user', lalu menetapkan 'admin' ke user ID 1
        $this->call(RolesAndPermissionsSeeder::class);
    }
}