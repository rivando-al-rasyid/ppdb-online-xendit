<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\InformasiSekolahController;


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

// Route::get('/dashboard', function () {
//     return view('pembayaran.create');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [PembayaranController::class, 'create'])->name('dashboard');
    Route::post('/pembayaran', [PembayaranController::class, 'createInvoice'])->name('pembayaran.store');
    Route::get('/bukti-pembayaran', [PembayaranController::class, 'generateAndDisplayInvoice'])->name('pembayaran.invoice');
    Route::post('/bukti-pembayaran', [PembayaranController::class, 'generateAndDisplayInvoice'])->name('pembayaran.upload');

});
Route::post('/xendit/webhook', [PembayaranController::class, 'webhook'])->middleware('web');
Route::get('/laporan/siswa', [DashboardController::class, 'exportindex'])->name('laporan.index.export');

Route::get('/LaporanDiterima', [LaporanController::class, 'LaporanDiterima'])->name('laporan.diterima');
Route::get('/LaporanDiterimaPerempuan', [LaporanController::class, 'LaporanDiterimaPerempuan'])->name('laporan.diterima.perempuan');
Route::get('/LaporanDiterimaLakiLaki', [LaporanController::class, 'LaporanDiterimaLakiLaki'])->name('laporan.diterima.laki');
Route::get('/LaporanPembayaran', [LaporanController::class, 'LaporanPembayaran'])->name('laporan.diterima.laki');
Route::get('/LaporanSemua', [LaporanController::class, 'LaporanSemua'])->name('laporan.semua');


Route::get('/informasi-sekolah', [InformasiSekolahController::class, 'manage'])->name('informasi_sekolah.manage');
Route::post('/informasi-sekolah', [InformasiSekolahController::class, 'store'])->name('informasi_sekolah.store');
Route::put('/informasi-sekolah/{id}', [InformasiSekolahController::class, 'update'])->name('informasi_sekolah.update');
Route::get('download/{file}', [DashboardController::class, 'download'])->name('download.file');

require __DIR__ . '/auth.php';
