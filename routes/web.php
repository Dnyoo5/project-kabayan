<?php

use App\Models\iventori;
use App\Http\Controllers\alaman;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\iventory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Barangiventory;
use App\Http\Controllers\homeController;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Controllers\halamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\kirim;
use App\Http\Controllers\sesiController;




Route::prefix('barang')->group(function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');    
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::post('/', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/{id}',[BarangController::class,'show'])->name('barang.show');
    Route::get('/barang/datatables', [BarangController::class, 'datatables'])->name('barang.datatables');
});


Route::prefix('kategori')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori/datatables', [KategoriController::class, 'datatables'])->name('kategori.datatables');
});

Route::prefix('home')->group(function () {
    Route::get('/', [homeController::class, 'index'])->name('home.index');
    Route::get('/statistik', [homeController::class, 'getStatistik'])->name('home.statistik');
    Route::get('/barang', [homeController::class, 'getTopBarang'])->name('home.getTopBarang');
    Route::get('/barang/export', [homeController::class, 'export'])->name('home.export');
});


