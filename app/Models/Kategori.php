<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Kategori extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_kategori';
    protected $guarded      = ['id_kategori'];


    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }
}
