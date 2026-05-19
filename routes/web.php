<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Livewire\Volt\Volt;

// ==========================================
// 1. RUTAS PÚBLICAS Y DE INFRAESTRUCTURA (ZONA SEGURA)
// ==========================================

Route::redirect('/', 'login')->name('home');

Route::get('/inicializar-sistema-bienes', function () {
    try {
        // Ejecuta DIRECTAMENTE solo el seeder de clasificaciones
        Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'ClassificationSeeder',
            '--force' => true
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => '¡Tablas de clasificaciones pobladas exitosamente en tiempo real!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});


// ==========================================
// 2. RUTAS PROTEGIDAS Y DE AUTENTICACIÓN
// ==========================================

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