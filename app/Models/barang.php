<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = ['nama_barang', 'jumlah', 'kategori_id'];

    // Definisikan relasi belongsTo ke model Kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }
}
