<?php

use App\Http\Controllers\DepanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
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


Route::prefix('/')->controller(DepanController::class)->group(function () { 
    Route::get('/', 'index')->name('index');
    Route::get('/belanja', 'belanja')->name('belanja');
    Route::get('/belanja/{slug}', 'belanjaShow')->name('belanjaShow');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('/home/pelanggan')->controller(PelangganController::class)->group(function ($id = null) {
    Route::get('/dataPelanggan', 'dataPelanggan')->name('dataPelanggan');
    Route::get('/dataPelanggan/{id}/beliProduk', 'beliProduk')->name('beliProduk');
    Route::get('/dataPelanggan/{id}/detailPelanggan', 'detailPelanggan')->name('detailPelanggan');

    Route::post('/dataPelanggan/{id}/beliProduk/uploadPembelian', 'uploadPembelian')->name('uploadPembelian');

    Route::post('/dataPelanggan/uploadPelanggan', 'uploadPelanggan')->name('uploadPelanggan');

})->middleware(['can:isAdmin']);


Route::prefix('/home/produk')->controller(ProdukController::class)->group(function () {
    
    // KATEGORI
    Route::get('/kategoriProduk', 'kategoriProduk')->name('kategoriProduk');
    Route::post('/kategoriProduk/tambahKategori','tambahKategori')->name('tambahKategori');

    // PRODUK
    Route::get('/dataProduk', 'dataProduk')->name('dataProduk');
    Route::post('/dataProduk/uploadProduk', 'uploadProduk')->name('uploadProduk');
    Route::put('/dataProduk/updateProduk/{id}', 'updateProduk')->name('updateProduk');
    Route::get('/dataProduk/hapusProduk/{id}', 'hapusProduk')->name('hapusProduk');

    Route::post('/dataProduk/bulk-action', 'bulkAction')->name('produk.bulk-action');



})->middleware(['can:isAdmin']);