<?php

namespace App\Services;

use App\Models\Keranjang;

class KeranjangService
{
    public function getTotal($request, $keranjang)
    {
        $jumlah = $request->jumlah;

        if ($jumlah > 50) $jumlah = 50;
        Keranjang::where('id_keranjang', $keranjang->id_keranjang)->update([
            'jumlah' =>  $jumlah
        ]);

        $keranjangs     = Keranjang::with('produk')->user()->get();
        $grandTotal     = 0;
        $subTotal       = 0;
        foreach ($keranjangs as $key => $value) {
            if ($value->id_keranjang == $keranjang->id_keranjang) $subTotal = $value->jumlah * $value->produk->harga;
            $grandTotal += $value->jumlah * $value->produk->harga;
        }

        return [$grandTotal, $subTotal];
    }

    public function tambah($validatedData, $keranjang)
    {
        if ($keranjang) {
            $validatedData['jumlah'] += $keranjang->jumlah;
            if ($validatedData['jumlah'] > 50) $validatedData['jumlah'] = 50;
            Keranjang::where('id_keranjang', $keranjang->id_keranjang)->update($validatedData);
        } else {
            if ($validatedData['jumlah'] > 50) $validatedData['jumlah'] = 50;
            $validatedData['id_user'] = auth()->user()->id_user;
            Keranjang::create($validatedData);
        }
    }
}
