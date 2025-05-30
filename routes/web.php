<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\KategoriFasilitasController;
use App\Http\Controllers\KategoriGedungController;
use App\Http\Controllers\LaporanPeriodeController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PendukungLaporanController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/proses_login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
	Route::get('/', [DashboardController::class, 'index']);

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
		Route::post('/data', [GedungController::class, 'getAll']);
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
		Route::get('/data', [KategoriFasilitasController::class, 'getAll']);
		Route::get('/create', [KategoriFasilitasController::class, 'create']);
		Route::post('/store', [KategoriFasilitasController::class, 'storeKategori']);
		Route::get('/{id}/show', [KategoriFasilitasController::class, 'show']);
		Route::get('/{id}/edit', [KategoriFasilitasController::class, 'edit']);
		Route::put('/{id}/update', [KategoriFasilitasController::class, 'update']);
		Route::get('/{id}/confirm', [KategoriFasilitasController::class, 'confirm']);
		Route::delete('/{id}/delete', [KategoriFasilitasController::class, 'delete']);
	});

	Route::prefix('ruangan')->group(function () {
		Route::get('/', [RuanganController::class, 'index']);
		Route::post('/data', [RuanganController::class, 'getAll']);
		Route::get('/gedung/{gedungId}', [RuanganController::class, 'getByGedung']);
		Route::get('/create', [RuanganController::class, 'create']);
		Route::post('/store', [RuanganController::class, 'store']);
		Route::get('/{id}/show', [RuanganController::class, 'show']);
		Route::get('/{id}/edit', [RuanganController::class, 'edit']);
		Route::put('/{id}/update', [RuanganController::class, 'update']);
		Route::get('/{id}/confirm', [RuanganController::class, 'confirm']);
		Route::delete('/{id}/delete', [RuanganController::class, 'delete']);
	});

	Route::prefix('kategori_gedung')->group(function () {
		Route::get('/data', [KategoriGedungController::class, 'getAll']);
		Route::get('/create', [KategoriGedungController::class, 'create']);
		Route::post('/store', [KategoriGedungController::class, 'storeKategoriGedung']);
		Route::get('/{id}/show', [KategoriGedungController::class, 'show']);
		Route::get('/{id}/edit', [KategoriGedungController::class, 'edit']);
		Route::put('/{id}/update', [KategoriGedungController::class, 'update']);
		Route::get('/{id}/confirm', [KategoriGedungController::class, 'confirm']);
		Route::delete('/{id}/delete', [KategoriGedungController::class, 'delete']);
	});

	Route::prefix('peran')->group(function () {
		Route::get('/', [PeranController::class, 'index']);
		Route::get('/create', [PeranController::class, 'create']);
		Route::post('/store', [PeranController::class, 'storePeran']);
		Route::post('/data', [PeranController::class, 'getAll']);
		Route::get('/{id}/show', [PeranController::class, 'show']);
		Route::get('/{id}/edit', [PeranController::class, 'edit']);
		Route::put('/{id}/update', [PeranController::class, 'update']);
		Route::get('/{id}/confirm', [PeranController::class, 'confirm']);
		Route::delete('/{id}/delete', [PeranController::class, 'delete']);
	});

	Route::prefix('log')->group(function () {
		Route::get('/', [LogActivityController::class, 'index']);
		Route::post('/store', [LogActivityController::class, 'storeLog']);
		Route::get('/{id}/show', [LogActivityController::class, 'show']);
	});

	Route::prefix('pelaporan')->group(function () {
		Route::get('/', [PelaporanController::class, 'index']);
		Route::post('/data', [PelaporanController::class, 'getAll']);
		Route::get('/create', [PelaporanController::class, 'create']);
		Route::post('/store', [PelaporanController::class, 'storePelaporan']);
		Route::get('/{id}/show', [PelaporanController::class, 'show']);
		Route::get('/{id}/edit', [PelaporanController::class, 'edit']);
		Route::put('/{id}/update', [PelaporanController::class, 'update']);
		Route::get('/{id}/confirm', [PelaporanController::class, 'confirm']);
		Route::delete('/{id}/delete', [PelaporanController::class, 'delete']);
		Route::get('/coba', [PelaporanController::class, 'coba']);

		Route::prefix('{pelaporanId}/pendukung')->group(function () {
			Route::get('/create', [PendukungLaporanController::class, 'create']);
			Route::post('/store', [PendukungLaporanController::class, 'store']);
		});
	});

	Route::prefix('fasilitas')->group(function () {
		Route::get('/', [FasilitasController::class, 'index']);
		Route::get('/search', [FasilitasController::class, 'searchFasilitas']);
		Route::get('/data', [FasilitasController::class, 'getAll']);
		Route::get('/create', [FasilitasController::class, 'create']);
		Route::post('/store', [FasilitasController::class, 'storeFasilitas']);
		Route::get('/{id}/show', [FasilitasController::class, 'show']);
		Route::get('/{id}/edit', [FasilitasController::class, 'edit']);
		Route::put('/{id}/update', [FasilitasController::class, 'update']);
		Route::get('/{id}/confirm', [FasilitasController::class, 'confirm']);
		Route::delete('/{id}/delete', [FasilitasController::class, 'delete']);
	});

	Route::prefix('feedback')->group(function () {
		Route::get('/', [FasilitasController::class, 'index']);
		Route::get('/create', [FasilitasController::class, 'create']);
		Route::post('/store', [FasilitasController::class, 'storeFeedback']);
		Route::get('/{id}/show', [FasilitasController::class, 'show']);
		Route::get('/{id}/edit', [FasilitasController::class, 'edit']);
		Route::put('/{id}/update', [FasilitasController::class, 'update']);
		Route::get('/{id}/confirm', [FasilitasController::class, 'confirm']);
		Route::delete('/{id}/delete', [FasilitasController::class, 'delete']);
	});

	Route::prefix('user')->group(function () {
		Route::get('/', [UserController::class, 'index']);
		Route::post('/data', [UserController::class, 'getAll']);
		Route::post('/search', [UserController::class, 'search']);
		Route::get('/create', [UserController::class, 'create']);
		Route::get('/{id}/edit_profil', [UserController::class, 'editProfil']);
		Route::post('/store-user', [UserController::class, 'storeUser']);
		Route::post('/{id}/store-profil', [UserController::class, 'storeProfil']);
		Route::get('/{id}/show', [UserController::class, 'show']);
		Route::get('/{id}/edit', [UserController::class, 'edit']);
		Route::put('/{id}/update', [UserController::class, 'updateProfile']);
		Route::get('/{id}/confirm', [UserController::class, 'confirmDelete']);
		Route::delete('/{id}/delete', [UserController::class, 'delete']);
	});

		Route::prefix('laporan_periode')->group(function () {
		Route::get('/', [LaporanPeriodeController::class, 'index']);
	});

	Route::prefix('profil')->group(function () {
		Route::get('/', [ProfilController::class, 'index']);
	});

	Route::get('/pelaporan/ruangan-by-gedung/{id_gedung}', [PelaporanController::class, 'getRuanganByGedung']);
	Route::get('/pelaporan/fasilitas-by-ruangan/{id_ruangan}', [PelaporanController::class, 'getFasilitasByRuangan']);
	Route::get('/pelaporan/all-fasilitas-by-ruangan/{id_ruangan}', [PelaporanController::class, 'getAllFasilitasByRuangan']);
});
