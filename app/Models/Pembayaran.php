<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pemesanan;

class Pembayaran extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_pembayaran';
    protected $guarded      = ['id_pembayaran'];

    public function getBankTujuanAttribute($value)
    {
        return strtoupper($value);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
