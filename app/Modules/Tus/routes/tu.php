<?php

use App\Modules\Tus\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


// Route::middleware(['web', 'tu.auth', 'tu.verified'])->get('/tu', function () {
//     return view('tu.dashboard');
// })->name('tu.dashboard');

Route::group(['as' => 'tu.', 'prefix' => '/tu', 'middleware' => ['web', 'tu.auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [DashboardController::class, 'indextu'])->name('dashboard');
    Route::get('/transaksi', [DashboardController::class, 'transaksi'])->name('laporan.transaksi');
    Route::get('/download', [DashboardController::class, 'download'])->name('download');
    Route::get('/detail/{id}', [DashboardController::class, 'detailtu'])->name('peserta.detail');
    Route::patch('/diterima/{id}', [DashboardController::class, 'terima'])->name('peserta.diterima');
    Route::patch('/ditolak/{id}', [DashboardController::class, 'tolak'])->name('peserta.ditolak');
});

require __DIR__ . '/auth.php';
