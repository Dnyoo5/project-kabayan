<?php


use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\PenerimaanController;

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
    Route::get('/supplier', [homeController::class, 'supplier'])->name('home.supplier');
});

Route::prefix('supplier')->group(function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/{id}', [SupplierController::class, 'show'])->name('supplier.show');
    Route::get('/supplier/datatables', [SupplierController::class, 'datatables'])->name('supplier.datatables');
    Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
});

Route::prefix('pengiriman')->group(function () {
    Route::get('/', [PengirimanController::class, 'index'])->name('pengiriman.index');
    Route::get('/datatables', [PengirimanController::class, 'datatables'])->name('pengiriman.datatables');
    Route::get('/create', [PengirimanController::class, 'create'])->name('pengiriman.create');
    Route::post('/', [PengirimanController::class, 'store'])->name('pengiriman.store');
    Route::get('/{id}', [PengirimanController::class, 'show'])->name('pengiriman.show');
    Route::put('/{id}', [PengirimanController::class, 'update'])->name('pengiriman.update');
    Route::get('/datatables', [PengirimanController::class, 'datatables'])->name('pengiriman.datatables');
    Route::delete('/{id}', [PengirimanController::class, 'destroy'])->name('pengiriman.destroy');
    Route::get('/get-barang/{id}', [PengirimanController::class, 'getBarang']);
    Route::get('/', [PengirimanController::class, 'index'])->name('pengiriman.index');
    Route::post('/{id}/receive', [PengirimanController::class, 'receive'])->name('pengiriman.receive');
    Route::post('/{id}/pay', [PengirimanController::class, 'pay'])->name('pengiriman.pay');
});

Route::prefix('penerimaan')->group(function () {
    Route::get('/', [PenerimaanController::class, 'index'])->name('penerimaan.index');
    Route::get('/datatables', [PenerimaanController::class, 'datatables'])->name('penerimaan.datatables');
    Route::get('/{id}/show', [PenerimaanController::class, 'show'])->name('penerimaan.show');
    Route::post('/{id}/receive', [PenerimaanController::class, 'receive'])->name('penerimaan.receive');
});


