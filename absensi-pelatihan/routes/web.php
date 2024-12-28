<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RekapAbsenController;
use App\Http\Controllers\ManajemenPesertaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
    ]);
});

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'getDashboard'])->name('dashboard.admin');
    Route::get('/Kelola-Absensi', [AbsensiController::class, 'linkKelolaAbsensi'])->name('kelolaAbsensi');
    Route::delete('/Kelola-Absensi', [AbsensiController::class, 'destroy'])->name('deleteAbsensi');
    Route::get('/Rekap-Absensi', [RekapAbsenController::class, 'link'])->name('rekapAbsensi');
    Route::get('/Manajemen-Peserta', [ManajemenPesertaController::class, 'link'])->name('manajemenPeserta');
    Route::get('/Tambah-Peserta', [ManajemenPesertaController::class, 'linkTambahPeserta'])->name('tambahPeserta');
    Route::post('/Post-Peserta', [RegisteredUserController::class, 'store'])->name('postPeserta');
    Route::get('/Edit-Peserta/{id}', [ManajemenPesertaController::class, 'getEdit'])->name('geEditPeserta');
    Route::put('/Edit-Peserta/{id}', [ManajemenPesertaController::class, 'updatePeserta'])->name('updatePeserta');
    Route::delete('/Delete-Peserta/{id}', [ManajemenPesertaController::class, 'destroy'])->name('deletePeserta');
});

Route::prefix('user')->middleware(['auth', 'verified','role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('user/Dashboard');
    })->name('dashboard.user');
    Route::get('/Absensi', [AbsensiController::class, 'link'])->name('linkAbsensi');
    Route::post('/Absensi', [AbsensiController::class, 'postAbsensi'])->name('postAbsensi');
    Route::put('/Absensi/{id}', [AbsensiController::class, 'updateAbsensi'])->name('updateAbsensi');
    Route::get('/laporan-absensi', [AbsensiController::class, 'linkLaporan'])->name('laporanAbsensi');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
