<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReturnProdukAdminRequest;
use App\Models\ReturnProduk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\Alamat;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{

    public function return_masuk()
    {
        $data = [
            'return_produks' => ReturnProduk::where('status', 0)->with('produk', 'detail_pemesanan.pemesanan.user')->get()
        ];


        return view('admin.return.return_masuk', $data);
    }

    public function return_kirim()
    {
        $data = [
            'return_produks' => ReturnProduk::where('status', 1)->with('produk', 'detail_pemesanan.pemesanan.user')->get()
        ];


        return view('admin.return.return_kirim', $data);
    }

    public function return_selesai()
    {
        $data = [
            'return_produks' => ReturnProduk::where('status', 2)->with('produk', 'detail_pemesanan.pemesanan.user')->get()
        ];


        return view('admin.return.return_selesai', $data);
    }

    public function alamat_customer(Pemesanan $pemesanan)
    {
        return response()->json([
            'data' => $pemesanan->alamat,
            'test' => 'asdasd'
        ], 200);
    }

    public function proses_kirim(ReturnProdukAdminRequest $request)
    {
        $pemesanan      = Pemesanan::where('id_pemesanan', $request->id_pemesanan)->with('alamat')->first();
        $return_produk  = ReturnProduk::where('id_return_produk', $request->id_return_produk)->with('produk')->first();
        $resi           = $request->resi;


        $idPemesanan = 'RETURN-' . Str::random(8);

        DB::transaction(function () use ($pemesanan, $return_produk, $resi, $idPemesanan) {
            try {
                Pemesanan::create([
                    'id_pemesanan'          => $idPemesanan,
                    'id_user'               => $pemesanan->id_user,
                    'total_harga'           => $return_produk->produk->harga * $return_produk->jumlah,
                    'ongkir'                => 0,
                    'ekspedisi'             => $pemesanan->ekspedisi,
                    'estimasi'              => $pemesanan->estimasi,
                    'status'                => 3,
                    'tanggal_pemesanan'     => Carbon::now(),
                    'tanggal_diperlukan'    => Carbon::now()->isoFormat('Y-m-d'),
                    'resi'                  => $resi,
                    'notif'                 => 0
                ]);

                Alamat::create([
                    'id_pemesanan'  => $idPemesanan,
                    'provinsi'      => $pemesanan->alamat->provinsi,
                    'kabupaten'     => $pemesanan->alamat->kabupaten,
                    'kodepos'       => $pemesanan->alamat->kodepos,
                    'kecamatan'     => $pemesanan->alamat->kecamatan,
                    'alamat'        => $pemesanan->alamat->alamat,
                    'nama_penerima' => $pemesanan->alamat->nama_penerima,
                    'telepon'       => $pemesanan->alamat->telepon
                ]);

                DetailPemesanan::create([
                    'id_pemesanan'  => $idPemesanan,
                    'id_produk'     => $return_produk->id_produk,
                    'jumlah'        => $return_produk->jumlah,
                    'review'        => 0
                ]);

                ReturnProduk::where('id_detail_pemesanan', $return_produk->id_detail_pemesanan)->update(['status' => 2]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        });

        Alert::success('Success', 'Berhasil mengirim return');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReturnProduk  $returnProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnProduk $returnproduk)
    {
        $returnproduk->update(['status' => $request->status]);

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengupdate status return produk'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReturnProduk  $returnProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ReturnProduk $returnproduk)
    {
        $returnproduk->update([
            'keterangan' => $request->keterangan,
            'status' => 3
        ]);
        Alert::success('Success', 'Berhasil menghapus return');
        return redirect()->back();
    }
}
