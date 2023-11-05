<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PekerjaanOrtuController;
use App\Http\Controllers\PenghasilanOrtuController;
use App\Http\Controllers\KelolaTUController;


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
    return view('home.index');
})->name('landing-page');


Route::get('/daftar', [DaftarController::class, 'index'])->name('daftar');
Route::get('/hasil', [DaftarController::class, 'hasil'])->name('hasil');
Route::post('/daftar', [DaftarController::class, 'daftar'])->name('daftar.kirim');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.create');
    Route::get('/invoice', [PembayaranController::class, 'hasil'])->name('pembayaran.hasil');
});
Route::get('/test', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/test/detail/{id}', [DashboardController::class, 'detail'])->name('peserta.detail');
Route::patch('/test/diterima/{id}', [DashboardController::class, 'terima'])->name('peserta.diterima');
Route::patch('/test/ditolak/{id}', [DashboardController::class, 'tolak'])->name('peserta.ditolak');
Route::get('/download', [DashboardController::class, 'download'])->name('download');

Route::resource('test/pekerjaan_ortu', PekerjaanOrtuController::class);
Route::resource('test/penghasilan_ortu', PenghasilanOrtuController::class);
Route::resource('test/kelola_tu', KelolaTUController::class);

require __DIR__ . '/auth.php';
