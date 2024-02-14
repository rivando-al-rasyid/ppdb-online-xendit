<?php

use App\Modules\Admins\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PekerjaanOrtuController;
use App\Http\Controllers\KelolaTUController;
use App\Http\Controllers\PembayaranController;


Route::middleware(['web', 'admin.auth', 'admin.verified'])->get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::group(['as' => 'admin.', 'prefix' => '/admin', 'middleware' => ['web', 'admin.auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/download', [DashboardController::class, 'download'])->name('download');
    Route::get('/detail/{id}', [DashboardController::class, 'detail'])->name('peserta.detail');
    Route::patch('/diterima/{id}', [DashboardController::class, 'terima'])->name('peserta.diterima');
    Route::patch('/cadangan/{id}', [DashboardController::class, 'cadangan'])->name('peserta.cadangan');
    Route::patch('/ditolak/{id}', [DashboardController::class, 'tolak'])->name('peserta.ditolak');
    Route::resource('pekerjaan_ortu', PekerjaanOrtuController::class);
    Route::resource('kelola_tu', KelolaTUController::class);
    // Route to update existing data
    Route::get('/create-user', [PembayaranController::class, 'createCustomer'])->name('create.customer');

});

require __DIR__ . '/auth.php';
