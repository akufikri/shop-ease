<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TypeProdukController;
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

Route::get('/login', [authController::class, 'login'])->name('login');
Route::post('/login/proccess', [authController::class, 'processLogin']);
Route::get('/register', [authController::class, 'register']);
Route::post('/register/proccess', [authController::class, 'processRegistration']);
Route::get('/logout', [authController::class, 'logout']);

Route::get('/', function () {
    return view('frontend.template');
});

Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::get('/get', [KategoriController::class, 'getData']);
        Route::get('/show/{id}', [KategoriController::class, 'showData']);
        Route::delete('/delete/{id}', [KategoriController::class, 'deleteData']);
        Route::put('/update/{id}', [KategoriController::class, 'update']);
        Route::post('/create', [KategoriController::class, 'create']);
    });

    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index']);
        Route::post('/store', [ProdukController::class, 'store']);
        Route::get('/get', [ProdukController::class, 'get']);
        Route::delete('/delete/{id}', [ProdukController::class, 'destroy']);
        Route::put('/update/{id}', [ProdukController::class, 'update']);
        Route::get('/show/{id}', [ProdukController::class, 'edit']);
    });

    Route::prefix('type')->group(function () {
        Route::get('/', [TypeProdukController::class, 'index']);
        Route::get('/get', [TypeProdukController::class, 'getData']);
        Route::get('/show/{id}', [TypeProdukController::class, 'showData']);
        Route::delete('/delete/{id}', [TypeProdukController::class, 'deleteData']);
        Route::put('/update/{id}', [TypeProdukController::class, 'update']);
        Route::post('/create', [TypeProdukController::class, 'create']);
    });
});
