<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;

// Cambiar Idioma
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'es', 'ca'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', function () { return view('welcome'); });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- GESTIÓN DE RECURSOS ---
// Importante: No dividas el resource si no es estrictamente necesario. 
// Laravel gestionará internamente que 'create' vaya antes que '{id}'.
Route::resource('equips', EquipController::class);
Route::resource('estadis', EstadiController::class);
Route::resource('jugadoras', JugadoraController::class);
Route::resource('partits', PartitController::class);

// --- RUTAS PROTEGIDAS (Perfil) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';