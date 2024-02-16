<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PdfDownloadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenyelenggaraController;

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
//     return view('welcome');
// });

// Route::middleware(['guest'])->group(function () {
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/prosesLogin', [LoginController::class, 'prosesLogin']);
Route::get('/regis', [LoginController::class, 'regis'])->name('regis');
Route::post('/prosesRegis', [LoginController::class, 'prosesRegis']);
// });

// Route::get('/home', function () {
//     return redirect('/');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->middleware('HakAkses:admin');
    Route::get('/admin/konser', [AdminController::class, 'dataKonser'])->middleware('HakAkses:admin');
    Route::post('/updateKonser', [AdminController::class, 'updateKonser'])->middleware('HakAkses:admin');
    Route::post('/deleteKonser', [AdminController::class, 'deleteKonser'])->middleware('HakAkses:admin');

    Route::get('/admin/transaksi', [AdminController::class, 'dataTransaksi'])->middleware('HakAkses:admin');
    Route::post('/updateTransaksi', [AdminController::class, 'updateTransaksi'])->middleware('HakAkses:admin');

    Route::post('/tambahLokasi', [AdminController::class, 'tambahLokasi'])->middleware('HakAkses:admin');
    Route::post('/updateLokasi', [AdminController::class, 'updateLokasi'])->middleware('HakAkses:admin');

    Route::get('/admin/pembeli', [AdminController::class, 'dataPembeli'])->middleware('HakAkses:admin');

    Route::get('/pembeli', [PembeliController::class, 'index'])->middleware('HakAkses:pembeli');
    Route::get('/pembeli/dataTiket', [PembeliController::class, 'dataTiket'])->middleware('HakAkses:pembeli');
    Route::post('/transaksiPembeli', [PembeliController::class, 'tambahTransaksi'])->middleware('HakAkses:pembeli');

    Route::get('/unduh-pdf/{id_transaksi}',[PdfDownloadController::class,'unduhPDF'])->name('unduh.pdf');

    Route::get('/penyelenggara', [PenyelenggaraController::class, 'index'])->middleware('HakAkses:penyelenggara');
    Route::get('/penyelenggara/dataKonser', [PenyelenggaraController::class, 'dataKonser'])->middleware('HakAkses:penyelenggara');
    Route::post('/penyelenggara/insertKonser', [PenyelenggaraController::class, 'insertKonser'])->middleware('HakAkses:penyelenggara');
    Route::post('/penyelenggara/updateKonser', [PenyelenggaraController::class, 'updateKonser'])->middleware('HakAkses:penyelenggara');
    Route::post('/penyelenggara/deleteKonser', [PenyelenggaraController::class, 'deleteKonser'])->middleware('HakAkses:penyelenggara');

    Route::get('/penyelenggara/dataTransaksi', [PenyelenggaraController::class, 'dataTransaksi'])->middleware('HakAkses:penyelenggara');
    Route::post('/penyelenggara/updateTransaksi', [PenyelenggaraController::class, 'updateTransaksi'])->middleware('HakAkses:penyelenggara');

    Route::get('/logout', [LoginController::class, 'prosesLogout']);
});