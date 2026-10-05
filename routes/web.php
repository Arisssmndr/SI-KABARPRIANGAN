<?php

use App\Http\Controllers\IklanCetakController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\IklanOnlineController;
use App\Http\Controllers\IklanPrianganController;
use App\Http\Controllers\LaporanOnlineController;
use App\Http\Controllers\LaporanPrianganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiIklanOnlineController;
use App\Http\Controllers\TransaksiIklanPrianganController;
use App\Http\Controllers\TransaksiOnlineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('laporanpriangan', LaporanPrianganController::class)->middleware('auth');
Route::resource('laporanonline', LaporanOnlineController::class)->middleware('auth');
Route::resource('iklanpriangan', IklanPrianganController::class)->middleware('auth');
Route::resource('iklanonline', IklanOnlineController::class)->middleware('auth');

Route::resource('transaksipriangan', TransaksiIklanPrianganController::class)->middleware('auth');
Route::get('/transaksipriangan/{id}/cetak', [TransaksiIklanPrianganController::class, 'cetak'])
    ->name('transaksipriangan.cetak');
    
Route::resource('transaksionline', TransaksiOnlineController::class)->middleware('auth');
Route::get('/transaksionline/{id}/cetak', [TransaksiOnlineController::class, 'cetak'])
    ->name('transaksionline.cetak');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
