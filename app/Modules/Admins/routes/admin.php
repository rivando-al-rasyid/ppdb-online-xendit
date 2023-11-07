<?php

use App\Modules\Admins\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'admin.auth', 'admin.verified'])->get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::group(['as' => 'admin.', 'prefix' => '/admin', 'middleware' => ['web', 'admin.auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/detail/{id}', [DashboardController::class, 'detail'])->name('peserta.detail');
    Route::patch('/dashboard/diterima/{id}', [DashboardController::class, 'terima'])->name('peserta.diterima');
    Route::patch('/dashboard/ditolak/{id}', [DashboardController::class, 'tolak'])->name('peserta.ditolak');
    Route::get('/dashboard/download', [DashboardController::class, 'download'])->name('download');
    Route::resource('dashboard/pekerjaan_ortu', PekerjaanOrtuController::class);
    Route::resource('dashboard/penghasilan_ortu', PenghasilanOrtuController::class);
    Route::resource('dashboard/kelola_tu', KelolaTUController::class);
});



require __DIR__ . '/auth.php';
