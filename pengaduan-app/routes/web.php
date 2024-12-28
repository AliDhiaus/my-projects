<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CSController;
use App\Http\Controllers\LaporanKonsumen;
use App\Http\Controllers\AdminController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'linkDashboard'])->name('dashboard.admin');
    Route::get('/form-tanggapan/{id}', [AdminController::class, 'getDataCS'])->name('tanggapan.admin');
    Route::put('/form-tanggapan/{id}', [AdminController::class, 'updateDataCS'])->name('dataTanggapan.admin');
    Route::get('/data-costumer-service', [AdminController::class, 'dataCS'])->name('dataCS.admin');
    Route::get('/data-sektor', [AdminController::class, 'dataSektor'])->name('sektor.admin');
});

Route::get('/', function () {
    return redirect()->route('login'); 
});

Route::prefix('cs')->middleware(['auth', 'verified', 'role:Costumer Service'])->group(function () {
    Route::get('/dashboard', [LaporanKonsumen::class, 'linkDashboard'])->name('dashboard.cs');
    Route::get('/data-sektor', [LaporanKonsumen::class, 'dataSektor'])->name('dataSektor.cs');
    Route::get('/laporan-konsumen', [LaporanKonsumen::class, 'index'])->name('laporan.cs');
    Route::get('/data-costumer-service', [LaporanKonsumen::class, 'dataCS'])->name('dataCS.cs');
    Route::put('/laporan-konsumen/{id}', [LaporanKonsumen::class, 'updateStatus'])->name('laporan.update');
    
});

Route::prefix('user')->middleware(['auth', 'verified','role:User'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('user/Dashboard');
    })->name('dashboard.user');
    Route::get('/costumer-service', function () {
        return Inertia::render('user/FormCS');
    })->name('formCS.user');
    Route::post('/costumer-service', [CSController::class, 'postCS'])->name('postCS.user');
    Route::get('/data-keluhan', [CSController::class, 'dataKeluhan'])->name('dataKeluhan.user');
    Route::get('/Tutor', function () {
        return Inertia::render('user/Tutor');
    })->name('tutor.user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
