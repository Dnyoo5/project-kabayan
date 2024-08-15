<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        return view('data.kategori');
    }

    public function datatables() {
       
            $data = kategori::orderBy('kategori','asc')->get();
            

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('aksi', function ($data) {
                    return view('components.btn-kategori',compact('data'));
            })->rawColumns(['aksi'])
                ->make(true);
            }


    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'kategori' => 'required|string|max:255|unique:kategoris',
    ]);

    // Buat kategori baru menggunakan mass assignment
    $kategori = Kategori::create([
        'kategori' => $request->kategori,
    ]);

    // Kembalikan response JSON dengan data kategori yang baru dibuat
    return response()->json([
        'success' => true,
        'message' => 'Kategori berhasil ditambahkan',
        'kategori' => [
            'id' => $kategori->id,
            'kategori' => $kategori->kategori,
        ],
    ]);
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
        $kategori = Kategori::find($id);

        // Cek apakah kategori ditemukan
        if ($kategori) {
            // Kembalikan data kategori dalam format JSON
            return response()->json([
                'success' => true,
                'kategori' => $kategori
            ]);
        } else {
            // Jika kategori tidak ditemukan, kembalikan respons error
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan.'
            ], 404);
    }
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
       // Validasi input
    $request->validate([
        'kategori' => 'required|string|max:255',  // Validasi untuk kategori
    ]);

    // Cari kategori berdasarkan ID
    $kategori = Kategori::find($id);

    // Cek apakah kategori ditemukan
    if ($kategori) {
        $kategori->kategori = $request->input('kategori');
        $kategori->save();  // Simpan perubahan ke database

        // Kembalikan respons sukses dalam bentuk JSON
        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui.',
            'kategori' => $kategori
        ]);
    } else {
        // Jika kategori tidak ditemukan, kembalikan respons error
        return response()->json([
            'success' => false,
            'message' => 'Kategori tidak ditemukan.'
        ], 404);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = kategori::findOrFail($id);
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
