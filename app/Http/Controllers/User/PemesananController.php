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
use Illuminate\Support\Facades\Auth;
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
                    'resi'                  => '',
                    'notif'                 => 0
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
                        'jumlah'        => $keranjang->jumlah,
                    ]);
                }

                Keranjang::where('id_user', auth()->user()->id_user)->delete();
            });
        } catch (\PDOException $e) {
            dd($e->getMessage());

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

        if ($pemesanan->notif == 0) {
            $pemesanan->notif = 1;
            $pemesanan->save();
        }

        return view('customer.pemesanan.detail', [
            'pemesanan'             => $pemesanan->load(['alamat', 'pembayaran']),
            'detailpemesanans'      => DetailPemesanan::where(['id_pemesanan' => $pemesanan->id_pemesanan])->with(['produk', 'return_produk' => function ($q) {
                return $q->where('status', '<', 2);
            }])->get()
        ]);
    }


    public function checkout()
    {
        $keranjangs = Keranjang::user()->get();
        $total = 0;
        $berat = 0;
        foreach ($keranjangs as $keranjang) {
            $total += $keranjang->jumlah * $keranjang->produk->harga;
            $berat += $keranjang->jumlah * $keranjang->produk->berat;
        }
        return view('customer.pemesanan.checkout', [
            'keranjangs'    => $keranjangs,
            'total'         => $total,
            'berat'         => $berat,
            'user'          => auth()->user()
        ]);
    }

    public function notifikasi()
    {
        if (!auth()->check()) return response()->json(['status' => 200, 'data' => []], 200);
        $notifikasi = Pemesanan::notification()->get();

        return response()->json(['status' => 200, 'data' => $notifikasi], 200);
    }

    public function return_produk(DetailPemesanan $detailpemesanan)
    {
        $detailpemesanan = $detailpemesanan->load('produk', 'return_produk');
        $jumlah = $detailpemesanan->jumlah;

        foreach ($detailpemesanan->return_produk as $return_produk) {
            $jumlah -= $return_produk->jumlah;
        }

        return view('customer.return.index', [
            'detail_pemesanan' => $detailpemesanan,
            'jumlah' => $jumlah
        ]);
    }

    public function finish(Request $request, Pemesanan $pemesanan)
    {
        $pemesanan->update(['status' => 4]);

        return response()->json([
            'message'       => 'Pemesanan berhasil dikonfirmasi',
            'status'        => 'success',
            'status_code'   => 200
        ], 200);
    }

    public function riwayat_pemesanan()
    {
        $data = [
            'pemesanans' => Pemesanan::with('detail_pemesanan.produk')->where('id_user', auth()->user()->id_user)->get()
        ];


        return view('customer.pemesanan.riwayat', $data);
    }
}
