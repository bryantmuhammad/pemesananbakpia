<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Pemesanan;
use App\Models\ReturnProduk;

class DetailPemesanan extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_detail_pemesanan';
    protected $guarded      = ['id_detail_pemesanan'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    public function return_produk()
    {
        return $this->hasMany(ReturnProduk::class, 'id_detail_pemesanan');
    }
}
