<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Middleware Admin yang sudah Anda buat
use App\Http\Middleware\AdminMiddleware; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // --- DAFTARKAN ALIAS ANDA DI SINI ---
        $middleware->alias([
            'role.admin' => AdminMiddleware::class, 
            // Tambahkan alias lain jika perlu
            // 'nama.alias.lain' => \App\Http\Middleware\MiddlewareLain::class,
        ]);

        // Anda juga bisa menambahkan middleware global, grup, dll di sini
        // $middleware->web(append: [ ... ]);
        // $middleware->api(prepend: [ ... ]);

    }) // <-- Pastikan kurung tutupnya benar
    ->withExceptions(function (Exceptions $exceptions) {
        // ...
    })->create();