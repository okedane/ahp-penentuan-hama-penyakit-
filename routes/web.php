<?php

use App\Http\Controllers\ahli\hama\alternatifHamaController;
use App\Http\Controllers\ahli\hama\SubKriteriaHamaController;
use App\Http\Controllers\ahli\hama\KriteriaHamaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\petani\DiagnosaController;
use App\Http\Controllers\petani\PetaniController;
// use App\Http\Controllers\KriteriaHamaController;
use App\Models\KriteriaHama;
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
    return view('ahli.dashboard.index');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('login-proses', [AuthController::class, 'login_proses'])->name('login-proses');
});


Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('ahli.dashboard.index');
    })->name('dashboard.ahli')->middleware('userAkses:ahli');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');



    Route::middleware(['userAkses:ahli'])->prefix('kriteria')->group(function () {
        Route::get('/', [KriteriaHamaController::class, 'index'])->name('kriteria.index');
        Route::post('/', [KriteriaHamaController::class, 'store'])->name('kriteria.post');
        Route::put('/{id}', [KriteriaHamaController::class, 'update'])->name('kriteria.put');
        Route::delete('/{id}', [KriteriaHamaController::class, 'delete'])->name('kriteria.delete');
        Route::get('/matriks', [KriteriaHamaController::class, 'matriks'])->name('kriteria.matriks');
        Route::post('/matriks/store', [KriteriaHamaController::class, 'storeMatriks'])->name('kriteria.matriks.store');
    });

    Route::middleware(['userAkses:ahli'])->prefix('subKriteria')->group(function () {
        Route::get('/{id}', [SubKriteriaHamaController::class, 'index'])->name('subKriteria.index');
        Route::post('/', [SubKriteriaHamaController::class, 'post'])->name('subKriteria.post');
        Route::put('/{id}', [SubKriteriaHamaController::class, 'put'])->name('subKriteria.put');
        Route::delete('/{id}', [SubKriteriaHamaController::class, 'delete'])->name('subKriteria.delete');
        Route::get('/{id}/matriks/go', [SubKriteriaHamaController::class, 'matriks'])->name('matriks');
        Route::post('/{id}/matriks/store/go', [SubKriteriaHamaController::class, 'postMatriks'])->name('matriks.post');
    });

    Route::middleware(['userAkses:ahli'])->prefix('alternatif')->group(function () {
        Route::get('/', [alternatifHamaController::class, 'index'])->name('alternatif.index');
        Route::post('/', [alternatifHamaController::class, 'store'])->name('alternatif.post');
        Route::put('/{id}', [alternatifHamaController::class, 'update'])->name('alternatif.put');
        Route::delete('/{id}', [alternatifHamaController::class, 'delete'])->name('alternatif.delete');
        Route::get('/penilaian-alternatif', [AlternatifHamaController::class, 'tampilPenilaianAlternatif'])->name('alternatif.penilaian.form');
        Route::post('/penilaian-alternatif', [AlternatifHamaController::class, 'simpanPenilaian'])->name('alternatif.penilaian.simpan');
    });




    Route::middleware(['auth', 'userAkses:petani'])->prefix('petani')->group(function () {
        Route::get('/dashboard/ku', function () {
            return view('petani.dashboard.index');
        })->name('dashboard.petani');

        Route::get('/input-gejala', [PetaniController::class, 'inputGejalaForm'])->name('petani.input.gejala');
        Route::post('/input-gejala', [PetaniController::class, 'simpanGejala'])->name('petani.input.gejala.store');
        Route::get('/diagnosa', [PetaniController::class, 'diagnosa'])->name('petani.diagnosa');
    });
});
