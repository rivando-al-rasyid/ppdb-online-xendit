<?php

use App\Modules\Tus\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;


// Route::middleware(['web', 'tu.auth', 'tu.verified'])->get('/tu', function () {
//     return view('tu.dashboard');
// })->name('tu.dashboard');

Route::group(['as' => 'tu.', 'prefix' => '/tu', 'middleware' => ['web', 'tu.auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [DashboardController::class, 'indextu'])->name('dashboard');
    Route::get('/laporan/siswa', [DashboardController::class, 'laporan'])->name('laporan.siswa.index');
    Route::get('/laporan/siswa/diterima', [DashboardController::class, 'laporanterima'])->name('laporan.terima.index');
    Route::get('/laporan/siswa/diterima/pria', [DashboardController::class, 'laporanterimalaki'])->name('laporan.terima.pria');
    Route::get('/laporan/siswa/diterima/perempuan', [DashboardController::class, 'laporanterimaperempuan'])->name('laporan.terima.perempuan');
    Route::get('/transaksi', [DashboardController::class, 'transaksi'])->name('laporan.terima.transaksi');
    Route::get('/detail/{id}', [DashboardController::class, 'detailtu'])->name('peserta.detail');
    Route::patch('/diterima/{id}', [DashboardController::class, 'terima'])->name('peserta.diterima');
    Route::patch('/cadangan/{id}', [DashboardController::class, 'cadangan'])->name('peserta.cadangan');
    Route::patch('/ditolak/{id}', [DashboardController::class, 'tolak'])->name('peserta.ditolak');
    Route::get('/LaporanDiterima', [LaporanController::class, 'LaporanDiterima'])->name('laporan.diterima');
    Route::get('/LaporanDiterimaPerempuan', [LaporanController::class, 'LaporanDiterimaPerempuan'])->name('laporan.diterima.perempuan');
    Route::get('/LaporanDiterimaLakiLaki', [LaporanController::class, 'LaporanDiterimaLakiLaki'])->name('laporan.diterima.laki');
    Route::get('/LaporanPembayaran', [LaporanController::class, 'LaporanPembayaran'])->name('laporan.transaksi');
    Route::get('/LaporanSemua', [LaporanController::class, 'LaporanSemua'])->name('laporan.semua');
    Route::get('download/{file}', [DashboardController::class, 'download'])->name('download.file');
});

require __DIR__ . '/auth.php';
