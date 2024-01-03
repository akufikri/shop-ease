<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\frontend;
use App\Http\Controllers\RoleController;
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

Route::get('/', [frontend\HomeController::class, 'index']);
Route::get('/produks', [frontend\ProdukController::class, 'index']);

Route::middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index']);
    });

    Route::prefix('produk')->group(function () {
        Route::get('/', [ProdukController::class, 'index']);
    });

    Route::prefix('type')->group(function () {
        Route::get('/', [TypeProdukController::class, 'index']);
    });

    Route::get('/admin/role', [RoleController::class, 'index']);
});

// public
Route::get('/kategori/get', [KategoriController::class, 'getData']);
Route::get('/kategori/show/{id}', [KategoriController::class, 'showData']);
Route::delete('/kategori/delete/{id}', [KategoriController::class, 'deleteData']);
Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
Route::post('/kategori/create', [KategoriController::class, 'create']);

Route::post('/produk/store', [ProdukController::class, 'store']);
Route::get('/produk/get', [ProdukController::class, 'get']);
Route::delete('/produk/delete/{id}', [ProdukController::class, 'destroy']);
Route::put('/produk/update/{id}', [ProdukController::class, 'update']);
Route::get('/produk/show/{id}', [ProdukController::class, 'edit']);

Route::get('/get', [TypeProdukController::class, 'getData']);
Route::get('/show/{id}', [TypeProdukController::class, 'showData']);
Route::delete('/delete/{id}', [TypeProdukController::class, 'deleteData']);
Route::put('/update/{id}', [TypeProdukController::class, 'update']);
Route::post('/create', [TypeProdukController::class, 'create']);
