@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Pemesanan<span>.</span></h2>
                        <a href="/">Home</a>
                        <a class="active" href="#">Pemesanan</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Cart Page Section Begin -->
    <div class="cart-page">
        <div class="container">
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>

                            <th class="text-center">No Order</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">Tanggal Pemesanan</th>
                            <th class="text-center">Detail Pemesanan</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanans as $pemesanan)
                            <tr>
                                <td class="price-col text-center">{{ $pemesanan->id_pemesanan }}</td>
                                <td class="price-col text-center">{{ currency_IDR($pemesanan->total_harga) }}</td>
                                <td class="price-col text-center">{{ $pemesanan->tanggal_pemesanan }}</td>
                                <td class="price-col text-center">
                                    <a href="/pemesanan/detail/{{ $pemesanan->id_pemesanan }}"
                                        class="btn btn-info">Detail</a>
                                </td>
                                <td class="price-col text-center">
                                    @if ($pemesanan->status == 0)
                                        <a href="/pemesanan/checkout" class="btn btn-danger">Belum Membayar</a>
                                    @endif
                                    @if ($pemesanan->status == 1)
                                        <button class="btn btn-success">Sudah Membayar</button>
                                    @endif
                                    @if ($pemesanan->status == 2)
                                        <button class="btn btn-success">Pembuatan</button>
                                    @endif
                                    @if ($pemesanan->status == 3)
                                        <button class="btn btn-success">Sedang Dikirim</button>
                                    @endif
                                    @if ($pemesanan->status == 4)
                                        <button class="btn btn-success">Pesanan Diterima</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>
    <!-- Cart Page Section End -->
@endsection
