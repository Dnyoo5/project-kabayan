<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
   public function index() {
    $kategori = Kategori::all();
    return view('data.index',compact('kategori'));

   }

   public function datatables(Request $request)
   {
    if ($request->ajax()) {
        $data = barang::orderBy('id','asc');

        // Apply filters
        if ($request->filled('kategori')) {
            $data->where('kategori_id', $request->kategori);
        }

        if ($request->filled('min_jumlah')) {
            $data->where('jumlah', '>=', $request->min_jumlah);
        }

        if ($request->filled('max_jumlah')) {
            $data->where('jumlah', '<=', $request->max_jumlah);
        }
        if ($request->filled('min_harga')) {
            $data->where('harga', '>=', $request->min_harga);
        }

        if ($request->filled('max_harga')) {
            $data->where('harga', '<=', $request->max_harga);
        }



    
    return DataTables::of($data)
        ->addIndexColumn()->addColumn('kategori', function($row) {
            return $row->kategori->kategori;
        }) ->addColumn('harga', function($row) {
            return 'Rp. ' . number_format($row->harga, 0, ',', '.');
        })
        ->addColumn('aksi', function($row){
            return view('components.btn',compact('row'));
        }) ->rawColumns(['aksi'])
        ->make(true);
   }
}

   

   public function store(Request $request)
   {
    $barang = Barang::where('nama_barang', $request->nama_barang)->first();
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'kategori_id' => 'required|exists:kategoris,id',
        'jumlah' => 'required|integer|min:1',
        'harga' => 'required|integer|min:1',
    ]);

    // Buat barang baru
    if ($barang) {
        // Jika barang sudah ada, tambahkan jumlahnya
        $barang->jumlah += $request->jumlah;
        $barang->save();
        return response()->json([
            'success' => true,
            'message' => 'Jumlah barang diperbarui',
            'barang' => $barang
        ]);
    } else {
        // Jika barang tidak ada, buat record baru
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
        ]);

    return response()->json([
        'success' => true,
        'message' => 'Data barang berhasil ditambahkan',
    ]);
}
}
    

public function export() 
{
    return Excel::download(new BarangExport, 'barang.xlsx');
}

    public function show($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        return response()->json(['result' => $barang]);
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();
        return response()->json([
            'barang' => $barang,
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
 }


