<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\DetailPemesanan;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        $detail_pemesanan = DetailPemesanan::select('id_detail_pemesanan', 'id_produk', 'id_pemesanan')
            ->where('id_detail_pemesanan', $request->id_detail_pemesanan)
            ->first();
        Alert::success('Success', 'Berhasil memberikan review');

        DetailPemesanan::where('id_detail_pemesanan', $request->id_detail_pemesanan)->update(['review' => 1]);
        Review::create([
            'id_produk' => $detail_pemesanan->id_produk,
            'id_user'   => Auth()->user()->id_user,
            'komentar'  => $request->komentar,
            'rating'    => $request->rating
        ]);

        return redirect('/pemesanan/detail/' . $detail_pemesanan->id_pemesanan);
    }
}
