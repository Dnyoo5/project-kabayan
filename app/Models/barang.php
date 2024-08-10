<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class barang extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = ['nama_barang','jumlah','kategori'];
    

    protected $dates = ['deleted_at']; 
}
