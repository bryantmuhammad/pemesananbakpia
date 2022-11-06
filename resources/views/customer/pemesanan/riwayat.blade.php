@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Riwayat Pemesanan<span>.</span></h2>
                        <a href="/">Home</a>
                        <a class="active" href="#">Riwayat Pemesanan</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Cart Page Section Begin -->
    <div class="cart-page mb-4">
        <div class="container">
            <div class="row">
                @foreach ($pemesanans as $pemesanan)
                    <div class="col-lg-12 mb-4">
                        <div class="card" style="width: 50rem;">
                            <div class="card-header">
                                <i class="fa fa-shopping-bag"></i>
                                <p class="d-inline" style="color:black;"><b>Belanja</b></p>
                                <p>{{ $pemesanan->tanggal_pemesanan->isoFormat('dddd, D MMMM Y') }}</p>
                                @if ($pemesanan->status == 0)
                                    <span class="badge badge-danger d-inline">Belum Membayar</span>
                                @endif
                                @if ($pemesanan->status == 1)
                                    <span class="badge badge-info d-inline">Sudah Membayar</span>
                                @endif
                                @if ($pemesanan->status == 2)
                                    <span class="badge badge-info d-inline">Pembuatan</span>
                                @endif
                                @if ($pemesanan->status == 3)
                                    <span class="badge badge-success d-inline">Sedang Dikirim</span>
                                @endif
                                @if ($pemesanan->status == 4)
                                    <span class="badge badge-success d-inline">Selesai</span>
                                @endif


                            </div>
                            <ul class="list-group list-group-flush">
                                @foreach ($pemesanan->detail_pemesanan as $detail_pemesanan)
                                    <table>
                                        <tr>
                                            <td width="120px;"> <img
                                                    src="{{ asset('storage/' . $detail_pemesanan->produk->foto) }}"
                                                    alt="" style="width:110px;height:100px;">
                                            </td>
                                            <td class="text-left">
                                                <p style="color:black;">
                                                    {{ $detail_pemesanan->produk->nama_produk }}</p>
                                                <p>{{ $detail_pemesanan->jumlah }} Barang</p>
                                            </td>
                                        </tr>
                                    </table>
                                    <div style="width: 100%;border:0.2px solid #d1c8c859;"></div>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>

    </div>
    <!-- Cart Page Section End -->
@endsection
