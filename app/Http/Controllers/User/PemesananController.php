<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Alamat;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use App\Models\DetailPemesanan;
use Illuminate\Support\Facades\Gate;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.pemesanan.index', [
            'pemesanans' => Pemesanan::where('id_user', auth()->user()->id_user)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment    = json_decode($request->payment);

        try {
            DB::transaction(function () use ($request, $payment) {

                $pdf        = $payment->pdf_url;
                $orderId    = $payment->order_id;
                $bank       = $payment->va_numbers[0]->bank;
                $va_number  = $payment->va_numbers[0]->va_number;

                Pemesanan::create([
                    'id_pemesanan'          => $orderId,
                    'id_user'               => auth()->user()->id_user,
                    'total_harga'           => $request->total,
                    'ongkir'                => $request->ongkir,
                    'ekspedisi'             => $request->code . ' - ' . $request->service,
                    'estimasi'              => $request->estimasi,
                    'status'                => 0,
                    'tanggal_diperlukan'    => $request->tanggal,
                    'tanggal_pemesanan'     => date('Y-m-d H:i:s'),
                    'resi'                  => ''
                ]);

                Alamat::create([
                    'id_pemesanan'  => $orderId,
                    'provinsi'      => $request->provinsi,
                    'kabupaten'     => $request->kabupaten,
                    'kodepos'       => $request->kodepos,
                    'kecamatan'     => $request->kecamatan,
                    'alamat'        => $request->alamat,
                    'nama_penerima' => $request->nama_penerima,
                    'telepon'       => $request->telepon
                ]);

                Pembayaran::create([
                    'id_pemesanan'          => $orderId,
                    'total_bayar'           => $request->total + $request->ongkir,
                    'tanggal_pembayaran'    => date("Y-m-d H:i:s"),
                    'bank_tujuan'           => $bank,
                    'va_number'             => $va_number,
                    'pdf'                   => $pdf
                ]);

                $keranjangs = Keranjang::where('id_user', auth()->user()->id_user)->get();
                foreach ($keranjangs as $keranjang) {
                    DetailPemesanan::create([
                        'id_pemesanan'  => $orderId,
                        'id_produk'     => $keranjang->id_produk,
                        'jumlah'        => $keranjang->jumlah
                    ]);
                }

                Keranjang::where('id_user', auth()->user()->id_user)->delete();
            });
        } catch (\PDOException $e) {
            return response()->json([
                'status'    => 400,
                'message'   => 'Terjadi kesalahan silahkan coba beberapa saat lagi',
                'type'      => 'error'
            ]);
        }

        return response()->json([
            'status'    => 200,
            'message'   => 'Silahkan selesaikan pembayaran',
            'type'      => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function show(pemesanan $pemesanan)
    {
        Gate::authorize('view', $pemesanan);

        return view('customer.pemesanan.detail', [
            'pemesanan' => $pemesanan->load(['alamat', 'pembayaran', 'detail_pemesanan.produk'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(pemesanan $pemesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pemesanan $pemesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemesanan  $pemesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemesanan $pemesanan)
    {
        //
    }



    public function checkout()
    {
        $keranjangs = Keranjang::where('id_user', auth()->user()->id_user)->get();
        $total = 0;
        $berat = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->jumlah * $keranjang->produk->harga;
            $berat += $keranjang->jumlah * $keranjang->produk->berat;
        }
        return view('customer.pemesanan.checkout', [
            'keranjangs' => $keranjangs,
            'total' => $total,
            'berat' => $berat
        ]);
    }
}
