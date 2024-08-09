<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\iventori;
use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Exports\ExportPeople;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = barang::orderBy('nama_barang','asc');

            // Apply filters
            if ($request->filled('kategori')) {
                $data->where('kategori', $request->kategori);
            }

            if ($request->filled('min_jumlah')) {
                $data->where('jumlah', '>=', $request->min_jumlah);
            }

            if ($request->filled('max_jumlah')) {
                $data->where('jumlah', '<=', $request->max_jumlah);
            }




      
        return DataTables::of($data)->addIndexColumn()
        ->addColumn('aksi',function($data) {
            return view('data.tombol')->with('data',$data);
        })->make(true);
    }

}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = Barang::where('nama_barang', $request->nama_barang)->first();
        $validasi =Validator::make($request->all(),[
            'nama_barang'=>'required',
            'kategori'=>'required',
            'jumlah'=>'required',
            
        ],[
            'nama_barang.required'=>'nama Barang Wajib di isi',
            'kategori.required'=>'kategori wajib di isi',
            'jumlah.required'=>' jumlah Wajib di isi',
        ]);
        if($validasi->fails()) {
            return response()->json(['errors'=>$validasi->errors()]);
        }
        else {


            $data =[
                'nama_barang'=>$request->nama_barang,
                'kategori'=>$request->kategori,
                'jumlah'=>$request->jumlah
    
            ];

        }

        barang::create($data);
        return response()->json(['success'=> 'berhasil menambahkan data']);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = barang::where('id',$id)->first();
        return response()->json(['result' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi =Validator::make($request->all(),[
            'nama_barang'=>'required',
            'kategori'=>'required',
            'jumlah'=>'required',
            
        ],[
            'nama_barang.required'=>'nama Barang Wajib di isi',
            'kategori.required'=>'kategori wajib di isi',
            'jumlah.required'=>'isi jumlah barang',
        ]);
        if($validasi->fails()) {
            return response()->json(['errors'=>$validasi->errors()]);
        }
        else {

            $data =[
                'nama_barang'=>$request->nama_barang,
                'kategori'=>$request->kategori,
                'jumlah'=>$request->jumlah
    
            ];
        }
        barang::where('id',$id)->update($data);
        return response()->json(['berhasil'=> 'berhasil update data']);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        barang::where('id',$id)->delete();
    }
}
