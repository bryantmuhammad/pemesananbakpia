<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.produk.index', [
            'kategoris' => Kategori::all(),
            'produks' => Produk::all()->load('kategori')
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $bakpium)
    {

        if (session()->has('success')) {
            Alert::toast(session('success'), 'success')->position('bottom-end');
        }

        $idkategori = $bakpium->kategori->id_kategori;

        return view('customer.produk.show', [
            'produk' => $bakpium,
            'produks' => Produk::where('id_kategori', $idkategori)->where('id_produk', '!=', $bakpium->id_produk)->get()
        ]);
    }


    public function home()
    {

        return view('customer.index', [
            'kategoris' => Kategori::all(),
            'produks' => Produk::with('kategori')->latest()->take(8)->get()
        ]);
    }
}
