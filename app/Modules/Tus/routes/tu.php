<?php

use App\Modules\Tus\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


// Route::middleware(['web', 'tu.auth', 'tu.verified'])->get('/tu', function () {
//     return view('tu.dashboard');
// })->name('tu.dashboard');

Route::group(['as' => 'tu.', 'prefix' => '/tu', 'middleware' => ['web', 'tu.auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.u`pdate');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/laporan/siswa', [DashboardController::class, 'laporan'])->name('laporan.index');
    Route::get('/laporan/ortu', [DashboardController::class, 'dataortu'])->name('laporan.dataortu');
    Route::get('/laporan/kartusosial', [DashboardController::class, 'indextu'])->name('laporan.kartu');
    Route::get('/transaksi', [DashboardController::class, 'transaksi'])->name('laporan.transaksi');
    Route::get('/detail/{id}', [DashboardController::class, 'detail'])->name('peserta.detail');
    Route::patch('/diterima/{id}', [DashboardController::class, 'terima'])->name('peserta.diterima');
    Route::patch('/cadangan/{id}', [DashboardController::class, 'cadangan'])->name('peserta.cadangan');
    Route::patch('/ditolak/{id}', [DashboardController::class, 'tolak'])->name('peserta.ditolak');
});

require __DIR__ . '/auth.php';
