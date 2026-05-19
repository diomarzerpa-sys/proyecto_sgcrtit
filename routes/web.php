<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Livewire\Volt\Volt;

Route::redirect('/','login')
        ->name('home');

/*Route::get('/', function () {
    return view('welcome');
})->name('home');*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::get('/inicializar-sistema-bienes', function () {
    try {
        // Ejecuta el seeder general de manera asíncrona sin bloquear la petición HTTP
        Artisan::queue('db:seed', ['--force' => true]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'El sembrado de datos ha sido encolado y se está ejecutando en segundo plano en el servidor. Revisa DBeaver en unos instantes.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Falló al intentar encolar los seeders: ' . $e->getMessage()
        ], 500);
    }
});