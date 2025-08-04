<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ahli\hama\alternatifHamaController;
use App\Http\Controllers\ahli\hama\SubKriteriaHamaController;
use App\Http\Controllers\ahli\hama\KriteriaHamaController;
use App\Http\Controllers\ahli\penyakit\AlternatifPenyakitController;
use App\Http\Controllers\ahli\penyakit\KriteriaPenyakitController;
use App\Http\Controllers\ahli\penyakit\SubKriteraPenyakitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\petani\DiagnosaController;
use App\Http\Controllers\petani\PetaniController;
use App\Http\Controllers\petani\PetaniPenyakitController as PetaniPetaniPenyakitController;
use App\Http\Controllers\PetaniPenyakitController;
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

// Route::get('/', function () {
//     return view('ahli.dashboard.index');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('login-proses', [AuthController::class, 'login_proses'])->name('login-proses');

    Route::get('/register', [AuthController::class, 'show'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});


Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('ahli.dashboard.index');
    })->name('dashboard.ahli')->middleware('userAkses:ahli');

    //dahboard admin
    Route::get('/dashboard-admin', function () {
        $users = \App\Models\User::all();
        return view('welcome', compact('users'));
    })->name('dashboard.admin')->middleware('userAkses:admin');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');



    Route::middleware(['userAkses:ahli'])->prefix('kriteria')->group(function () {
        Route::get('/', [KriteriaHamaController::class, 'index'])->name('kriteria.index');
        Route::post('/', [KriteriaHamaController::class, 'store'])->name('kriteria.post');
        Route::put('/{id}', [KriteriaHamaController::class, 'update'])->name('kriteria.put');
        Route::delete('/{id}', [KriteriaHamaController::class, 'delete'])->name('kriteria.delete');
        Route::get('/matriks', [KriteriaHamaController::class, 'matriks'])->name('kriteria.matriks');
        Route::post('/matriks/store', [KriteriaHamaController::class, 'storeMatriks'])->name('kriteria.matriks.store');


        Route::get('/penyakit/', [KriteriaPenyakitController::class, 'index'])->name('kriteria.penyakit.index');
        Route::post('/penyakit/', [KriteriaPenyakitController::class, 'store'])->name('kriteria.penyakit.post');
        Route::put('/penyakit/{id}', [KriteriaPenyakitController::class, 'update'])->name('kriteria.penyakit.put');
        Route::delete('/penyakit/{id}', [KriteriaPenyakitController::class, 'delete'])->name('kriteria.penyakit.delete');
        Route::get('/penyakit/matriks', [KriteriaPenyakitController::class, 'matriks'])->name('kriteria.penyakit.matriks');
        Route::post('/penyakit/matriks/store', [KriteriaPenyakitController::class, 'storeMatriks'])->name('kriteria.penyakit.matriks.store');


        // Buatkan route management account
        Route::get('/management-account', [AdminController::class, 'index'])->name('users.index');
        Route::post('/management-account', [AdminController::class, 'store'])->name('users.store');
        Route::put('/management-account/{id}', [AdminController::class, 'update'])->name('users.update');
        Route::delete('/management-account/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
    });

    Route::middleware(['userAkses:ahli'])->prefix('subKriteria')->group(function () {
        Route::get('/{id}', [SubKriteriaHamaController::class, 'index'])->name('subKriteria.index');
        Route::post('/', [SubKriteriaHamaController::class, 'post'])->name('subKriteria.post');
        Route::put('/{id}', [SubKriteriaHamaController::class, 'put'])->name('subKriteria.put');
        Route::delete('/{id}', [SubKriteriaHamaController::class, 'delete'])->name('subKriteria.delete');
        Route::get('/{id}/matriks/go', [SubKriteriaHamaController::class, 'matriks'])->name('matriks');
        Route::post('/{id}/matriks/store/go', [SubKriteriaHamaController::class, 'postMatriks'])->name('matriks.post');


        Route::get('/penyakit/{id}', [SubKriteraPenyakitController::class, 'index'])->name('subKriteria.penyakit.index');
        Route::post('/penyakit/', [SubKriteraPenyakitController::class, 'post'])->name('subKriteria.penyakit.post');
        Route::put('/penyakit/{id}', [SubKriteraPenyakitController::class, 'put'])->name('subKriteria.penyakit.put');
        Route::delete('/penyakit/{id}', [SubKriteraPenyakitController::class, 'delete'])->name('subKriteria.penyakit.delete');
        Route::get('/penyakit/{id}/matriks/go', [SubKriteraPenyakitController::class, 'matriks'])->name('matriks.penyakit');
        Route::post('/penyakit/{id}/matriks/store/go', [SubKriteraPenyakitController::class, 'postMatriks'])->name('matriks.penyakit.post');
    });



    Route::middleware(['userAkses:ahli'])->prefix('alternatif')->group(function () {
        Route::get('/', [alternatifHamaController::class, 'index'])->name('alternatif.index');
        Route::post('/', [alternatifHamaController::class, 'store'])->name('alternatif.post');
        Route::put('/{id}', [alternatifHamaController::class, 'update'])->name('alternatif.put');
        Route::delete('/{id}', [alternatifHamaController::class, 'delete'])->name('alternatif.delete');
        Route::get('/penilaian-alternatif', [AlternatifHamaController::class, 'tampilPenilaianAlternatif'])->name('alternatif.penilaian.form');
        Route::post('/penilaian-alternatif', [AlternatifHamaController::class, 'simpanPenilaian'])->name('alternatif.penilaian.simpan');

        Route::get('/penyakit/', [AlternatifPenyakitController::class, 'index'])->name('alternatif.penyakit.index');
        Route::post('/penyakit/', [alternatifPenyakitController::class, 'store'])->name('alternatif.penyakit.post');
        Route::put('/penyakit/{id}', [alternatifPenyakitController::class, 'update'])->name('alternatif.penyakit.put');
        Route::delete('/penyakit/{id}', [alternatifPenyakitController::class, 'delete'])->name('alternatif.penyakit.delete');
        Route::get('/penyakit/penilaian-alternatif', [alternatifPenyakitController::class, 'tampilPenilaianAlternatif'])->name('alternatif.penilaian.penyakit.form');
        Route::post('/penyakit/penilaian-alternatif', [alternatifPenyakitController::class, 'simpanPenilaian'])->name('alternatif.penilaian.penyakit.simpan');
    });

    // buatkan route middleware untuk users dan userAkses:admin
    Route::middleware(['userAkses:admin'])->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'admin'])->name('admin.admin');
        Route::get('/ahli', [AdminController::class, 'ahli'])->name('admin.ahli');
        Route::get('/petani', [AdminController::class, 'petani'])->name('admin.petani');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });

    Route::middleware(['userAkses:ahli'])->prefix('ahli')->group(function () {
        Route::get('/', [AdminController::class, 'ahli'])->name('adminA.index');
        Route::post('/', [AdminController::class, 'store'])->name('admin.store');
        Route::put('/{id}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    });



    Route::middleware(['auth', 'userAkses:petani'])->prefix('petani')->group(function () {
        Route::get('/dashboard/ku', function () {
            return view('petani.dashboard.index');
        })->name('dashboard.petani');

        Route::get('/input-gejala', [PetaniController::class, 'inputGejalaForm'])->name('petani.input.gejala');
        Route::post('/input-gejala', [PetaniController::class, 'simpanGejala'])->name('petani.input.gejala.hama.store');
        Route::get('/diagnosa', [PetaniController::class, 'diagnosa'])->name('petani.diagnosa');

        Route::get('penyakit/input-gejala', [PetaniPetaniPenyakitController::class, 'inputGejalaForm'])->name('petani.input.gejala.penyakit');
        Route::post('penyakit/input-gejala', [PetaniPetaniPenyakitController::class, 'simpanGejala'])->name('petani.input.gejala.penyakit.store');
        Route::get('penyakit/diagnosa', [PetaniPetaniPenyakitController::class, 'diagnosa'])->name('petani.diagnosa.penyakit');

        Route::get('/penyakit/history', [HistoryController::class, 'index'])->name('diagnosis.index');
        Route::get('/Hama/history', [HistoryController::class, 'hama'])->name('histori.hama');

        Route::get('/create akun', function () {
            return view('ahli.dashbo');
        });
    });
});
