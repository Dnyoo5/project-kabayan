<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengiriman';
    protected $fillable = [
        'nomor_pengiriman',
        'barang_id',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'pengirim_id',
        'penerima_id',
        'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

 
}
