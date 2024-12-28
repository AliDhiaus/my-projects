<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/forgot-password', [AuthController::class, 'forgot'])->name('forgot');
Route::match(['get', 'post'], '/account/manage', [AuthController::class, 'manageAccount'])->middleware('auth:sanctum');

Route::get('/das', [AuthController::class, 'getDas']);

Route::match(['get', 'post'], '/manage/das', [AuthController::class, 'manageDas'])->middleware('auth:sanctum');
Route::delete('/delete-das/{id}', [AuthController::class, 'deleteDas']);
Route::post('/isi-das/{id}', [AuthController::class, 'isiDas']);
Route::get('/isi/das/{id}', [AuthController::class, 'getIsiDas']);
Route::put('/update-isi-das/{id}', [AuthController::class, 'updateIsiDas']);
Route::delete('/delete-isi-das/{id}', [AuthController::class, 'deleteIsiDas']);

Route::match(['get', 'post'], '/manage-jadwal', [AuthController::class, 'manageJadwal']);
Route::put('/update-jadwal/{id}', [AuthController::class, 'updateJadwal']);
Route::delete('/delete-jadwal/{id}', [AuthController::class, 'deleteJadwal']);

Route::get('/manage-penyiar', [AuthController::class, 'managePenyiar']);

