<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\DashboardController;



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
});
Route::post('/xendit/webhook', [PembayaranController::class, 'webhook'])->middleware('web');
Route::get('/laporan/siswa', [DashboardController::class, 'exportindex'])->name('laporan.index.export');

require __DIR__ . '/auth.php';
