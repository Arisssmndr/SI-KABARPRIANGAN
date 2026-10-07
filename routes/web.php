<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriMediaController;
use App\Http\Controllers\JenisIklanController;
use App\Http\Controllers\LaporanKoranController;
use App\Http\Controllers\LaporanOnlineController;
use App\Http\Controllers\LaporanPrianganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiIklanPrianganController;
use App\Http\Controllers\TransaksiKoranController;
use App\Http\Controllers\TransaksiOnlineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Master Data Terpadu (Standar Industri: 2 Menu Kategori & Tipe/Jenis Iklan)
Route::resource('kategori-media', KategoriMediaController::class)->middleware('auth');
Route::resource('jenis-iklan', JenisIklanController::class)->middleware('auth');
Route::get('/api/kategori-media/{id}/next-code', [JenisIklanController::class, 'getNextCode'])
    ->middleware('auth')
    ->name('kategori-media.next-code');

// Rute Kategori Lama (Diarahkan ke Master Baru agar tidak terjadi error 404)
Route::get('/iklankoran', fn() => redirect()->route('jenis-iklan.index'))->middleware('auth')->name('iklankoran.index');
Route::get('/iklanonline', fn() => redirect()->route('jenis-iklan.index'))->middleware('auth')->name('iklanonline.index');
Route::get('/iklanpriangan', fn() => redirect()->route('jenis-iklan.index'))->middleware('auth')->name('iklanpriangan.index');

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

use App\Http\Controllers\LaporanController;

// Laporan Keuangan Terpadu (1 Pusat Laporan untuk Koran, Online, dan TV)
Route::get('/laporan', [LaporanController::class, 'index'])->middleware('auth')->name('laporan.index');
Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->middleware('auth')->name('laporan.cetak');

// Pengalihan Rute Laporan Lama (Mencegah 404)
Route::match(['get', 'post'], '/laporankoran', fn() => redirect()->route('laporan.index', ['media' => 'koran']))->middleware('auth')->name('laporankoran.index');
Route::match(['get', 'post'], '/laporanonline', fn() => redirect()->route('laporan.index', ['media' => 'online']))->middleware('auth')->name('laporanonline.index');
Route::match(['get', 'post'], '/laporanpriangan', fn() => redirect()->route('laporan.index', ['media' => 'tv']))->middleware('auth')->name('laporanpriangan.index');

// Profil Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
