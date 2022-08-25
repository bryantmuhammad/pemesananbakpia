<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PemesananController extends Controller
{
    public function destroy(Pemesanan $pemesanan)
    {
        Pemesanan::destroy($pemesanan->id_pemesanan);

        return redirect()->back()->with('success', 'Pemesanan berhasil dihapus');
    }

    public function show(Pemesanan $pemesanan)
    {
        $detailpemesanan = $pemesanan->load(['alamat', 'pembayaran', 'detail_pemesanan.produk']);

        return view('admin.pemesanan.detailpemesanan', [
            'pemesanan' => $detailpemesanan
        ]);
    }


    public function belum_bayar()
    {
        $pemesanan = Pemesanan::where('status', 0)->get();
        if (session()->has('success')) {
            Alert::success(session('success'), 'success');
        }
        return view('admin.pemesanan.belumbayar', [
            'pemesanans' => $pemesanan
        ]);
    }

    public function sudah_bayar()
    {
        $pemesanan = Pemesanan::where('status', 1)->get();
        if (session()->has('success')) {
            Alert::success(session('success'), 'success');
        }
        return view('admin.pemesanan.sudahbayar', [
            'pemesanans' => $pemesanan
        ]);
    }

    public function pembuatan()
    {
        $pemesanan = Pemesanan::where('status', 2)->get();
        if (session()->has('success')) {
            Alert::success(session('success'));
        }

        return view('admin.pemesanan.pembuatan', [
            'pemesanans' => $pemesanan
        ]);
    }

    public function update_pembuatan(Pemesanan $pemesanan, Request $request)
    {
        try {
            Pemesanan::where('id_pemesanan', $request->idpemesanan)->update([
                'status' => 2
            ]);
        } catch (Exception $e) {
            return response()->json([
                'result' => 400,
                'type' => 'error',
                'message' => 'Terjadi kesalahan coba beberapa saat lagi'
            ]);
        }

        return response()->json([
            'result' => 200,
            'type' => 'success',
            'message' => 'Status berhasil diupdate'
        ]);
    }

    public function kirim_resi(Pemesanan $pemesanan, Request $request)
    {
        Pemesanan::where('id_pemesanan', $pemesanan->id_pemesanan)->update([
            'resi' => $request->resi,
            'status' => 3
        ]);

        return redirect('/admin/pemesanan/pembuatan')->with('success', 'Pesanan status bersahil diupdate');
    }

    public function dikirim()
    {
        return view('admin.pemesanan.dikirim', [
            'pemesanans' => Pemesanan::where('status', 3)->latest()->get()
        ]);
    }
}
