<?php

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

Route::get('/', function () {
    return view('backend.page.dashboard.index');
});


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
});

Route::prefix('type')->group(function () {
    Route::get('/', [TypeProdukController::class, 'index']);
});
