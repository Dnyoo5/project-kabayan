<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.supplier.supplier');
    }

    public function datatables(Request $request) {
        $data = Supplier::select(['id', 'nama', 'kontak', 'alamat', 'email']);

        return DataTables::of($data)->addIndexColumn()
            ->addColumn('aksi', function ($row) {
                return view('data.supplier.supplier-btn',compact('row'));
            })
            ->make(true);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'kontak' => 'required',
            'alamat' => 'required',
          
        ]);

        supplier::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);
        
       

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
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
        $supplier = Supplier::findOrFail($id);
        return view('data.supplier.edit', compact('supplier'));
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required',
            'alamat' => 'required',
            'email' => 'required',
        ]);
    
        // Temukan supplier berdasarkan ID
        $supplier = Supplier::findOrFail($id);
    
        // Update data supplier
        $supplier->update([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);
    
        // Redirect ke halaman daftar supplier dengan pesan sukses
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = supplier::findOrFail($id);
        $supplier->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
