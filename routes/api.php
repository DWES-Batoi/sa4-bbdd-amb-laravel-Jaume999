<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JugadoraController;
use App\Http\Controllers\Api\EquipController; // Importante añadir el nuevo controlador
use Illuminate\Support\Facades\Route;

// --- AUTH ---
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// --- RUTAS PROTEGIDAS (Requieren Token) ---
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Escritura de Jugadoras
    Route::apiResource('jugadores', JugadoraController::class)
        ->parameters(['jugadores' => 'jugadora'])
        ->except(['index', 'show']);

    // Escritura de Equipos
    Route::apiResource('equipos', EquipController::class)
        ->parameters(['equipos' => 'equip'])
        ->except(['index', 'show']);
});

// --- RUTAS PÚBLICAS (Lectura) ---
// Lectura de Jugadoras
Route::apiResource('jugadores', JugadoraController::class)
    ->parameters(['jugadores' => 'jugadora'])
    ->only(['index', 'show']);

// Lectura de Equipos
Route::apiResource('equipos', EquipController::class)
    ->parameters(['equipos' => 'equip'])
    ->only(['index', 'show']);