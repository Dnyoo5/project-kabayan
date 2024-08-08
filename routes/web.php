<?php

use App\Http\Controllers\alaman;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Barangiventory;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\iventory;
use App\Models\iventori;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

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

Route::get('/barang',function() {
    return view('data.index');
});

Route::resource('BarangAjax',BarangController::class);

Route::get('barang/export/', [halamanController::class, 'export']);