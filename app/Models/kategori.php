<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $fillable = ['kategori'];

    // Definisikan relasi hasMany ke model Barang
    public function barang(): HasMany
    {
        return $this->hasMany(barang::class, 'kategori_id');
    }
}
