<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class homeController extends Controller
{

    public function index()
    {
       
        $data = barang::select('kategori')
        ->selectRaw('SUM(jumlah) as total')
        ->join('kategoris', 'barang.kategori_id', '=', 'kategoris.id') // Ganti dengan nama tabel dan kolom yang benar
        ->groupBy('kategori_id', 'kategoris.kategori') // Ganti dengan nama kolom yang benar
        ->get();
    
    // Kirim data ke view
    return view('data.home', ['data' => $data]);
    }


    public function export() 
{
    return Excel::download(new BarangExport, 'barang.xlsx');
}


    public function getTopBarang()
{
    // Ambil data barang beserta jumlahnya, diurutkan dari yang terbanyak
    $barangData = barang::select('nama_barang', DB::raw('SUM(jumlah) as total'))
                        ->groupBy('nama_barang')
                        ->orderBy('total', 'desc')
                        ->get();

    // Siapkan data untuk Highcharts
    $chartData = $barangData->map(function($item) {
        return [
            'name' => $item->nama_barang,
            'y' => (int)$item->total
        ];
    });

    return response()->json($chartData);

 
}
public function getStatistik(Request $request)
    {
        if ($request->ajax()) {
            $statistik = [
                'nama_barang' => barang::count(), // Jumlah total barang
                'kategori' => barang::distinct('kategori_id')->count('kategori_id'), // Jumlah kategori unik
                'jumlah' => barang::sum('jumlah') // Total jumlah barang
            ];
            return response()->json($statistik);
        }

        return view('data.home');
    }

}




                