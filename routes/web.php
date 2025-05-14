<?php

use App\Http\Controllers\GedungController;
use App\Http\Controllers\KategoriFasilitasController;
use App\Http\Controllers\PeriodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::prefix('periode')->group(function () {
    Route::get('/', [PeriodeController::class, 'index']);
    Route::get('/create', [PeriodeController::class, 'create']);
    Route::post('/store', [PeriodeController::class, 'storePeriode']);
    Route::get('/{id}/show', [PeriodeController::class, 'show']);
    Route::get('/{id}/edit', [PeriodeController::class, 'edit']);
    Route::put('/{id}/update', [PeriodeController::class, 'update']);
    Route::get('/{id}/confirm', [PeriodeController::class, 'confirm']);
    Route::delete('/{id}/delete', [PeriodeController::class, 'delete']);
});

Route::prefix('gedung')->group(function () {
    Route::get('/', [GedungController::class, 'index']);
    Route::get('/create', [GedungController::class, 'create']);
    Route::post('/store', [GedungController::class, 'storeGedung']);
    Route::get('/{id}/show', [GedungController::class, 'show']);
    Route::get('/{id}/edit', [GedungController::class, 'edit']);
    Route::put('/{id}/update', [GedungController::class, 'update']);
    Route::get('/{id}/confirm', [GedungController::class, 'confirm']);
    Route::delete('/{id}/delete', [GedungController::class, 'delete']);
});

Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriFasilitasController::class, 'index']);
    Route::get('/create', [KategoriFasilitasController::class, 'create']);
    Route::post('/store', [KategoriFasilitasController::class, 'storeKategori']);
    Route::get('/{id}/show', [KategoriFasilitasController::class, 'show']);
    Route::get('/{id}/edit', [KategoriFasilitasController::class, 'edit']);
    Route::put('/{id}/update', [KategoriFasilitasController::class, 'update']);
    Route::get('/{id}/confirm', [KategoriFasilitasController::class, 'confirm']);
    Route::delete('/{id}/delete', [KategoriFasilitasController::class, 'delete']);
});