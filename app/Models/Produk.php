<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Review;

class Produk extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_produk';
    protected $guarded      = ['id_produk'];


    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'id_produk');
    }
}
