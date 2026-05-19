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
    // Aumentamos el límite de tiempo local por si acaso
    set_time_limit(60);

    // 1. Instanciamos tu seeder para acceder a los datos
    $seeder = new Database\Seeders\National_AssetsSeeder();
    
    // Usamos reflexión para leer la propiedad protegida o privada $datas si es necesario,
    // pero como en Laravel las propiedades de datos suelen ser accesibles o podemos extraerlas,
    // una forma limpia es leer el array. Si tu propiedad $datas es privada/protegida en el archivo,
    // podemos usar Reflexión de PHP para extraerla de forma segura en producción:
    $reflector = new ReflectionClass($seeder);
    if ($reflector->hasProperty('datas')) {
        $property = $reflector->getProperty('datas');
        $property->setAccessible(true);
        $allDatas = $property->getValue($seeder);
    } else {
        // En caso de que no se pueda leer, un respaldo defensivo
        return response()->json(['status' => 'error', 'message' => 'No se pudo acceder al array de datos del Seeder.'], 500);
    }

    $totalRegistros = count($allDatas);
    
    // 2. Control del lote actual mediante la URL (Paginación interna)
    $offset = request('offset', 0);
    $limit = 20; // Procesamos de 20 en 20 para que sea instantáneo
    
    // Cortamos solo el pedazo de datos que toca procesar en este ciclo
    $loteActual = array_slice($allDatas, $offset, $limit);

    if (empty($loteActual)) {
        return response()->json([
            'status' => 'success',
            'message' => "¡Proceso finalizado! Se insertaron exitosamente los $totalRegistros registros sin caídas de servidor."
        ]);
    }

    // 3. Mantenemos el estado de las variables de control usando la sesión de Laravel
    // Esto asegura que 'Sin_Bien_1', 'Sin_Bien_2', etc., continúen su conteo correctamente entre recargas.
    $controlA = session('seeder_control_A', 1);
    $controlB = session('seeder_control_B', 1);
    $seedcontrol = session('seeder_seedcontrol', []);

    // 4. Ejecutamos exactamente TU lógica original del archivo sobre el lote actual
    foreach ($loteActual as $data) {
        
        if ($data['code'] == 'NO TIENE') {
            $data['code'] = 'Sin_Bien_' . $controlA;
            App\Models\NationalAsset::create($data);
            $controlA++;
        } elseif ($data['code'] != 'NO TIENE') {
            if (in_array($data['code'], $seedcontrol)) {
                $data['observations'] = $data['observations'] . ' //Fue registrado con un bien duplicado, SINCERAR, antiguo bien: ' . $data['code'];
                $data['code'] = 'Duplicate_' . $controlB;
                App\Models\NationalAsset::create($data);
                $controlB++;
            } else {
                $seedcontrol[] = $data['code'];
                App\Models\NationalAsset::create($data);
            }
        }
    }

    // Guardamos el progreso en la sesión para la siguiente petición
    session(['seeder_control_A' => $controlA]);
    session(['seeder_control_B' => $controlB]);
    session(['seeder_seedcontrol' => $seedcontrol]);

    // 5. Calculamos el siguiente lote
    $siguienteOffset = $offset + $limit;
    $porcentaje = min(100, round(($siguienteOffset / $totalRegistros) * 100));

    // Generamos el HTML de redirección automática instantánea
    $siguienteUrl = url("/inicializar-sistema-bienes?offset={$siguienteOffset}");
    
    return response("
        <html>
        <head>
            <meta http-equiv='refresh' content='1;url={$siguienteUrl}'>
            <style>
                body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #f4f6f9; margin: 0; }
                .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; max-width: 400px; width: 100%; }
                .progress-bar { background: #e0e0e0; border-radius: 4px; height: 20px; width: 100%; margin-top: 15px; overflow: hidden; }
                .progress { background: #3b82f6; height: 100%; width: {$porcentaje}%; transition: width 0.3s; }
            </style>
        </head>
        <body>
            <div class='card'>
                <h2>Procesando Bienes Nacionales</h2>
                <p>Insertados registros del <b>{$offset}</b> al <b>" . min($totalRegistros, $siguienteOffset) . "</b> (Total: {$totalRegistros})</p>
                <div class='progress-bar'><div class='progress'></div></div>
                <p style='color: #666; font-size: 14px;'>Redireccionando al siguiente lote para evitar Timeout...</p>
            </div>
        </body>
        </html>
    ");
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