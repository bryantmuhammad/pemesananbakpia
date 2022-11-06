<?php

namespace App\Http\Controllers;

use App\Http\Requests\KeranjangRequest;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\DetailPemesanan;
use App\Services\KeranjangService;

class KeranjangController extends Controller
{
    private KeranjangService $keranjangService;

    public function __construct(KeranjangService $keranjangService)
    {
        $this->keranjangService = $keranjangService;
    }

    public function index()
    {
        $keranjangs = Keranjang::with('produk')->user()->get();
        $total      = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->produk->harga * $keranjang->jumlah;
        }

        if (session()->has('success')) {
            Alert::toast(session('success'), 'success')->position('bottom-end');
        }

        return view('customer.keranjang.index', [
            'keranjangs'    => $keranjangs,
            'total'         => $total
        ]);
    }

    public function tambah(KeranjangRequest $request)
    {
        $keranjang      = Keranjang::user()->where('id_produk', $request->id_produk)->first();
        $validatedData  = $request->validated();
        $this->keranjangService->tambah($validatedData, $keranjang);

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

    public function update(KeranjangRequest $request, Keranjang $keranjang)
    {

        [$grandTotal, $subTotal] = $this->keranjangService->getTotal($request, $keranjang);

        return response()->json([
            'grandtotal'    => currency_IDR($grandTotal),
            'subtotal'      => currency_IDR($subTotal)
        ]);
    }
}
