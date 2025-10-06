<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CamioneroController;
use App\Http\Controllers\Api\CamionController;
use App\Http\Controllers\Api\PaqueteController;
use App\Http\Controllers\Api\DetallePaqueteController;
use App\Http\Controllers\Api\EstadoPaqueteController;
use App\Http\Controllers\Api\TipoMercanciaController;


Route::get('/', function () {
    return response()->json([
        'application' => 'Transporte API',
        'version' => '1.0.0',
        'status' => 'Running OK',
        'documentation' => url('/api/documentation'),
        'resources' => [
            'Camioneros' => url('/api/camioneros'),
            'Camiones' => url('/api/camiones'),
            'Detalles de Paquetes' => url('/api/detalles-paquetes'),
            'Estados' => url('/api/estados'),
            'Paquetes' => url('/api/paquetes'),
            'Tipo de Mercancía' => url('/api/tipo-mercancia'),
            'register' => url('/api/register'),
            'login' => url('/api/login'),
            'me' => url('/api/me'),
            'logout' => url('/api/logout'),
        ],
        'developer' => [
            'name' => 'Kevin Quintero',
            'email' => 'kevin.stiven.quintero.yepes@gmail.com',
        ],
    ]);
});

// 👤 Rutas públicas (sin token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 🔒 Rutas protegidas (requieren token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('camioneros', CamioneroController::class);
    Route::apiResource('camiones', CamionController::class)->parameters(['camiones' => 'camion']);
    Route::apiResource('paquetes', PaqueteController::class)->parameters(['paquetes' => 'paquete']);
    Route::apiResource('detalles-paquetes', DetallePaqueteController::class)->parameters(['detalles-paquetes' => 'detalle_paquete']);
    Route::apiResource('estados-paquetes', EstadoPaqueteController::class);
    Route::apiResource('tipos-mercancia', TipoMercanciaController::class)->parameters(['tipos-mercancia' => 'tipo_mercancia']);
});
