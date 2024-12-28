<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\dataUsersController;
use App\Http\Controllers\kelurahanAksesController;
use App\Http\Controllers\AnswerUserController;

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


Route::prefix('user')->group(function () {
    Route::post('/home/insert', [dataUsersController::class, 'insert'])->name('home.insert');
    Route::get('/home', [dataUsersController::class, 'home'])->name('home');
    Route::post('/home/ipwl', [dataUsersController::class, 'updateIpwl'])->name('home.ipwl');
    Route::post('/home/insert/quiz', [AnswerUserController::class, 'insertQuiz'])->name('home.insertQuiz');
});


Route::get('/', function () {
    return Inertia::render('login');
})->name('login');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/demografi', [dataUsersController::class, 'getData'])->name('demografi');
    Route::delete('/demografi/destroy/{nik}', [dataUsersController::class, 'destroy'])->name('demografi.destroy');
    Route::get('/demografi/detail/{nik}', [dataUsersController::class, 'detailData'])->name('demografi.detail');
    Route::get('/demografi/detail/quiz/{nik}', [dataUsersController::class, 'detailDataQuiz'])->name('demografi.detailQuiz');
    
    Route::get('/kelurahan-akses', [kelurahanAksesController::class, 'getDataKelurahan'])->name('kelurahan');
    Route::get('/kelurahan-akses/addPage', [kelurahanAksesController::class, 'kelurahanAddPage'])->name('kelurahan.add');
    Route::post('/kelurahan-post', [kelurahanAksesController::class, 'postDataKelurahan'])->name('kelurahan.post');
    Route::delete('/kelurahan/destroy/{id}', [kelurahanAksesController::class, 'destroyKelurahan'])->name('kelurahan.destroy');    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
