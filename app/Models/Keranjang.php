<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\User;

class Keranjang extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_keranjang';
    protected $guarded      = ['id_keranjang'];
    protected $with         = ['produk'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function scopeUser()
    {
        return $this->where('id_user', auth()->user()->id_user);
    }
}
