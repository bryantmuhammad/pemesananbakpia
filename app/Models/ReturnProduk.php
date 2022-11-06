<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\DetailPemesanan;
use Illuminate\Support\Facades\Auth;

class ReturnProduk extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_return_produk';
    protected $guarded      = ['id_return_produk'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function detail_pemesanan()
    {
        return $this->belongsTo(DetailPemesanan::class, 'id_detail_pemesanan');
    }

    public function scopeUser($q)
    {
        return $q->whereHas('detail_pemesanan', function ($q) {
            $q->whereHas('pemesanan', function ($q) {
                $q->where('id_user', Auth()->user()->id_user);
            });
        });
    }
}
