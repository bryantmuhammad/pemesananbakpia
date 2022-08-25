<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Produk;

class LaporanController extends Controller
{
    public function pemesanan(Request $request)
    {
        if ($request->has('tanggalawal') && $request->has('tanggalakhir')) {
            $pemesanan = Pemesanan::where('status', '>=', 3)->whereBetween('tanggal_pemesanan', [$request->tanggalawal, $request->tanggalakhir])->get();
        } else {
            $pemesanan = Pemesanan::where('status', '>=', 3)->get();
        }

        if ($request->has('cetak')) {
            return view('admin.laporan.cetak.pemesanan', [
                'pemesanans' => $pemesanan
            ]);
        }

        return view('admin.laporan.pemesanan', [
            'pemesanans' => $pemesanan
        ]);
    }

    public function produk(Request $request)
    {
        if ($request->has('cetak')) {
            return view('admin.laporan.cetak.produk', [
                'produks' => Produk::all()
            ]);
        }


        return view('admin.laporan.produk', [
            'produks' => Produk::all()
        ]);
    }
}
