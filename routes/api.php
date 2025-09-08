<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controladores API
use App\Http\Controllers\Api\CamioneroController;
use App\Http\Controllers\Api\CamionController;
use App\Http\Controllers\Api\PaqueteController;
use App\Http\Controllers\Api\DetallePaqueteController;
use App\Http\Controllers\Api\EstadoPaqueteController;
use App\Http\Controllers\Api\TipoMercanciaController;

// Rutas abiertas de prueba (sin autenticar)
Route::apiResource('camioneros', CamioneroController::class);
Route::apiResource('camiones', CamionController::class);
Route::apiResource('paquetes', PaqueteController::class);
Route::apiResource('detalles-paquetes', DetallePaqueteController::class);
Route::apiResource('estados-paquetes', EstadoPaqueteController::class);
Route::apiResource('tipos-mercancia', TipoMercanciaController::class);

// Rutas de prueba de usuario autenticado (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // Aquí podrías duplicar las rutas apiResource para protegerlas
    // Ejemplo:
    // Route::apiResource('camioneros', CamioneroController::class);
});
