<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Models\barang;
use Maatwebsite\Excel\Facades\Excel;

class halamanController extends Controller
{
    public function export() 
{
    return Excel::download(new BarangExport, 'barang.xlsx');
}


}




                