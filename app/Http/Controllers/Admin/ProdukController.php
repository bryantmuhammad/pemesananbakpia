<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
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
        if (session()->has('success')) {
            Alert::toast(session('success'), 'success');
        }

        return view('admin.produk.index', [
            'produks' => Produk::all()->load('kategori'),
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.produk.create', [
            'kategoris' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_produk'   => 'required',
                'harga'         => 'required|numeric',
                'berat'         => 'required|numeric',
                'id_kategori'   => 'required|numeric',
                'keterangan'    => 'required',
                'foto'          => 'image|file|max:10240'
            ]);

            $validatedData['foto'] = $request->file('foto')->store('foto-produk');

            Produk::create($validatedData);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect('/admin/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return response()->json($produk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {

        $validatedData = $request->validate([
            'nama_produk'   => 'required',
            'harga'         => 'required|numeric',
            'berat'         => 'required|numeric',
            'id_kategori'   => 'required|numeric',
            'keterangan'    => 'required',
            'foto'          => 'image|file|max:10240'
        ]);

        if ($request->file('foto')) {
            if ($produk->foto) {
                Storage::delete($produk->foto);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-produk');
        }

        Produk::where('id_produk', $produk->id_produk)->update($validatedData);
        return redirect('/admin/produk')->with('success', 'Produk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        Storage::delete($produk->foto);
        Produk::destroy($produk->id_produk);

        return redirect('/admin/produk')->with('success', 'Produk berhasil dihapus');
    }
}
