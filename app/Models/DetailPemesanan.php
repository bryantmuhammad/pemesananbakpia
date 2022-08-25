<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class DetailPemesanan extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_detail_pemesanan';
    protected $guarded      = ['id_detail_pemesanan'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
