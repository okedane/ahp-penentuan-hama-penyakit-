<?php

use App\Http\Controllers\ahli\hama\SubKriteriaHamaController;
use App\Http\Controllers\ahli\hama\KriteriaHamaController;
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


Route::prefix('kriteria')->group(function () {
    Route::get('/', [KriteriaHamaController::class, 'index'])->name('kriteria.index');
    Route::post('/', [KriteriaHamaController::class, 'store'])->name('kriteria.post');
    Route::put('/{id}', [KriteriaHamaController::class, 'update'])->name('kriteria.put');
    Route::delete('/{id}', [KriteriaHamaController::class, 'delete'])->name('kriteria.delete');
    Route::get('/matriks', [KriteriaHamaController::class, 'matriks'])->name('kriteria.matriks');
    Route::post('/matriks/store', [KriteriaHamaController::class, 'storeMatriks'])->name('kriteria.matriks.store');
});

Route::prefix('subKriteria')->group(function () {
    Route::get('/{id}', [SubKriteriaHamaController::class, 'index'])->name('subKriteria.index');
    Route::post('/', [SubKriteriaHamaController::class, 'post'])->name('subKriteria.post');
    Route::put('/{id}', [SubKriteriaHamaController::class, 'put'])->name('subKriteria.put');
    Route::delete('/{id}', [SubKriteriaHamaController::class, 'delete'])->name('subKriteria.delete');

    Route::get('/{id}/matriks/go', [SubKriteriaHamaController::class, 'matriks'])->name('matriks');
    Route::post('/{id}/matriks/store/go', [SubKriteriaHamaController::class, 'postMatriks'])->name('matriks.post');
});
