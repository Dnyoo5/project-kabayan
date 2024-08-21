<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Models\Kategori;
use App\Models\supplier;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class homeController extends Controller
{

    public function index()
    {
        $data = barang::select('kategoris.kategori')
            ->selectRaw('SUM(barangs.jumlah) as total')
            ->join('kategoris', 'barangs.kategori_id', '=', 'kategoris.id')
            ->groupBy('kategoris.kategori')
            ->get();
    
        // Kirim data ke view
        return view('data.home', ['data' => $data]);
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
                'kategori' => Kategori::count(), // Jumlah kategori unik
                'jumlah' => barang::sum('jumlah') // Total jumlah barang
            ];
            return response()->json($statistik);
        }

        return view('data.home');
    }

public function supplier() {
    $totalSupplier = Supplier::count();

    // Kembalikan data dalam bentuk JSON
    return response()->json(['totalSupplier' => $totalSupplier]);

}
}





                