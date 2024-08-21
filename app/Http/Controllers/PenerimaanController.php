<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pengiriman;
use App\Models\Barang;
use DataTables;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class PenerimaanController extends Controller
{
    public function index()
    {
        return view('data.penerimaan.index');
    }

    public function datatables()
    {
        $data = Pengiriman::with('barang')->get(); // Mengambil data pengiriman dengan relasi barang

        return FacadesDataTables::of($data)
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
            ->addColumn('action', function ($row) {
                $button = '<a href="' . route('penerimaan.show', $row->id) . '" class="btn btn-primary btn-sm">Terima</a>';
                return $button;
            })
            ->rawColumns(['status_label', 'action'])
            ->make(true);
    }

    public function show($id)
    {
        $pengiriman = Pengiriman::findOrFail($id);
        return view('data.penerimaan.show', compact('pengiriman'));
    }

    public function receive(Request $request, $id)
    {
        $pengiriman = Pengiriman::findOrFail($id);

        // Validasi
        $request->validate([
            'penerima' => 'required|string',
            'total_harga' => 'required|numeric'
        ]);

        // Update status pengiriman
        $pengiriman->status = 'diterima';
        $pengiriman->penerima = $request->input('penerima');
        $pengiriman->save();

        // Update barang
        $barang = Barang::find($pengiriman->barang_id);
        $barang->jumlah -= $pengiriman->jumlah;
        $barang->save();
        

        return redirect()->route('penerimaan.index')->with('success', 'Barang berhasil diterima dan pembayaran berhasil.');
    }
}
