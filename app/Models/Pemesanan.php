<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Alamat;
use App\Models\DetailPemesanan;

class Pemesanan extends Model
{
    use HasFactory;
    public $incrementing    = false;
    protected $primaryKey   = 'id_pemesanan';
    protected $fillable     = ['id_pemesanan', 'id_user', 'total_harga', 'ongkir', 'ekspedisi', 'estimasi', 'status', 'tanggal_pemesanan', 'tanggal_diperlukan', 'resi'];
    protected $dates        = ['tanggal_pemesanan', 'tanggal_diperlukan'];
    protected $with         = ['user'];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pemesanan');
    }

    public function alamat()
    {
        return $this->hasOne(Alamat::class, 'id_pemesanan');
    }

    public function detail_pemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id_pemesanan');
    }
}
