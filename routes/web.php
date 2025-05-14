<?php

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
});
