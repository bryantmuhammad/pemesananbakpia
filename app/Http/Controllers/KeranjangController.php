<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\DetailPemesanan;

class KeranjangController extends Controller
{

    public function index()
    {
        $keranjangs = Keranjang::where('id_user', auth()->user()->id_user)->get();
        $total = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->produk->harga * $keranjang->jumlah;
        }

        if (session()->has('success')) {
            Alert::toast(session('success'), 'success')->position('bottom-end');
        }

        return view('customer.keranjang.index', [
            'keranjangs' => $keranjangs,
            'total' => $total
        ]);
    }

    public function tambah(Request $request)
    {
        $keranjang      = Keranjang::where('id_user', auth()->user()->id_user)->where('id_produk', $request->id_produk)->first();
        $validatedData  = $request->validate([
            'jumlah'    => 'required|min:1',
            'id_produk' => 'required',
        ]);
        if ($keranjang) {
            $validatedData['jumlah'] += $keranjang->jumlah;
            Keranjang::where('id_keranjang', $keranjang->id_keranjang)->update($validatedData);
        } else {
            $validatedData['id_user'] = auth()->user()->id_user;
            Keranjang::create($validatedData);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan kedalam keranjang');
    }

    public function jumlah()
    {
        if (!auth()->check()) return response()->json(['jumlah' => 0]);

        return response()->json([
            'jumlah' => Keranjang::where('id_user', auth()->user()->id_user)->count()
        ]);
    }

    public function destroy(Keranjang $keranjang)
    {
        Keranjang::destroy($keranjang->id_keranjang);
        return redirect('/keranjang/produk')->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function update(Request $request, Keranjang $keranjang)
    {
        Keranjang::where('id_keranjang', $keranjang->id_keranjang)->update([
            'jumlah' =>  $request->jumlah
        ]);
        $keranjangs     = Keranjang::with('produk')->where('id_user', auth()->user()->id_user)->get();
        $grandTotal     = 0;
        $subTotal       = 0;
        foreach ($keranjangs as $key => $value) {
            if ($value->id_keranjang == $keranjang->id_keranjang) $subTotal = $value->jumlah * $value->produk->harga;
            $grandTotal += $value->jumlah * $value->produk->harga;
        }

        return response()->json([
            'grandtotal'    => currency_IDR($grandTotal),
            'subtotal'      => currency_IDR($subTotal)
        ]);
    }
}
