<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IklanKoranController;
use App\Http\Controllers\IklanOnlineController;
use App\Http\Controllers\IklanPrianganController;
use App\Http\Controllers\LaporanKoranController;
use App\Http\Controllers\LaporanOnlineController;
use App\Http\Controllers\LaporanPrianganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiIklanPrianganController;
use App\Http\Controllers\TransaksiKoranController;
use App\Http\Controllers\TransaksiOnlineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Master Data Iklan
Route::resource('iklankoran', IklanKoranController::class)->middleware('auth');
Route::resource('iklanonline', IklanOnlineController::class)->middleware('auth');
Route::resource('iklanpriangan', IklanPrianganController::class)->middleware('auth');

// Transaksi Iklan
Route::resource('transaksikoran', TransaksiKoranController::class)->middleware('auth');
Route::get('/transaksikoran/{id}/cetak', [TransaksiKoranController::class, 'cetak'])
    ->middleware('auth')
    ->name('transaksikoran.cetak');

Route::resource('transaksionline', TransaksiOnlineController::class)->middleware('auth');
Route::get('/transaksionline/{id}/cetak', [TransaksiOnlineController::class, 'cetak'])
    ->middleware('auth')
    ->name('transaksionline.cetak');

Route::resource('transaksipriangan', TransaksiIklanPrianganController::class)->middleware('auth');
Route::get('/transaksipriangan/{id}/cetak', [TransaksiIklanPrianganController::class, 'cetak'])
    ->middleware('auth')
    ->name('transaksipriangan.cetak');

// Laporan Keuangan
Route::resource('laporankoran', LaporanKoranController::class)->middleware('auth');
Route::resource('laporanonline', LaporanOnlineController::class)->middleware('auth');
Route::resource('laporanpriangan', LaporanPrianganController::class)->middleware('auth');

// Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
