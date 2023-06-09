<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post(
            'register',
            [RegisterController::class, 'store']
        )->name('registerAuth');

        Route::post(
            'login',
            [LoginController::class, 'auth']
        )->name('loginAuth');

        Route::post('logout', [LoginController::class, 'logout'])
            ->name('logoutAuth')
            ->middleware('token.auth');

        Route::get('csrf-token', function () {
            return response()->json(['csrf_token' => csrf_token()]);
        });
    });

    Route::get('user', [LoginController::class, 'index'])
        ->middleware('token.auth')
        ->name('dataListUser');

    Route::prefix('mahasiswa')->group(function () {
        Route::post('insert', [MahasiswaController::class, 'store'])
            ->name('insertDataMahasiswa')
            ->middleware('token.auth');

        Route::post('search/{nim}', [MahasiswaController::class, 'search'])
            ->name('searchDataMahasiswa')
            ->middleware('token.auth');
    });


});


Route::get('/', function () {
    return "hello world";
})->name('index');