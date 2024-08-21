<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengiriman;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengirimanController extends Controller
{
    public function index()
    {
        return view('data.pengiriman.index');
    }

    public function datatables(Request $request)
    {
        $data = Pengiriman::select([
            'id',
            'barang_id',
            'nomor_pengiriman',
            'jumlah',
            'total_harga',
            'pengirim',
            'penerima',
            'status',
            'barang_nama' // Ambil nama barang dari kolom yang sudah disimpan
        ]);
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('total_harga', function ($row) {
                return number_format($row->total_harga, 2);
            })
            ->addColumn('status_label', function ($row) {
                $statusClasses = [
                    'dikirim' => 'btn-warning',
                    'diterima' => 'btn-primary'
                ];
                $statusClass = $statusClasses[$row->status] ?? 'btn-secondary';
                return '<button class="btn btn-sm ' . $statusClass . '">' . ucfirst($row->status) . '</button>';
            })
            ->rawColumns(['status_label']) // Pastikan kolom status_label di-render sebagai HTML
            ->make(true);

    }
    public function create()
    {
        $barang = Barang::all();
        $users =  User::all();
        return view('data.pengiriman.create', compact('barang', 'users'));
    }
    
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'jumlah' => 'required|integer|min:1',
        'pengirim' => 'required|string|max:255',
        'penerima' => 'required|exists:users,id',
    ]);

    // Ambil data barang berdasarkan ID
    $barang = Barang::find($request->barang_id);

    // Pastikan barang ditemukan
    if (!$barang) {
        return response()->json(['error' => 'Barang tidak ditemukan.'], 404);
    }

    $harga_satuan = $barang->harga;
    $total_harga = $harga_satuan * $request->jumlah;

    // Simpan data pengiriman
    $pengiriman = new Pengiriman();
    $pengiriman->barang_id = $request->barang_id;
    $pengiriman->barang_nama = $barang->nama_barang; 
    $pengiriman->nomor_pengiriman = now()->format('YmdHis'); // Format nomor pengiriman
    $pengiriman->jumlah = $request->jumlah;
    $pengiriman->total_harga = $total_harga;
    $pengiriman->pengirim = $request->pengirim;
    $pengiriman->penerima = $request->penerima;
    $pengiriman->status = 'dikirim'; // Status awal adalah 'dikirim'
    $pengiriman->save();

    // Kurangi stok barang di tabel barang
    if ($request->jumlah >= $barang->jumlah) {
        // Hapus barang jika stok yang dikirim sama dengan atau lebih dari stok
        $barang->delete();
    } else {
        // Kurangi stok jika tidak sama dengan atau lebih dari stok
        $barang->jumlah -= $request->jumlah;
        $barang->save();
    }

    // Return JSON response
    return response()->json(['success' => 'Pengiriman berhasil ditambahkan.'], 200);
}


// PengirimanController.php
public function getBarang($id)
{
    $barang = Barang::find($id);
    if ($barang) {
        return response()->json([
            'stok' => $barang->jumlah, // Sesuaikan dengan nama kolom di database Anda
            'harga' => $barang->harga
        ]);
    }

    return response()->json(['error' => 'Barang tidak ditemukan'], 404);
}


}
