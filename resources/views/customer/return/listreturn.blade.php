@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Return <span>.</span></h2>
                        <a href="/">Home</a>
                        <a class="active" href="#">Return </a>
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

                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Jumlah Return</th>
                            <th class="text-center">Tanggal Return</th>
                            <th class="text-center">Catatan</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($returns as $return)
                            <tr>
                                <td class="price-col text-center">{{ $return->produk->nama_produk }}</td>
                                <td class="price-col text-center">{{ $return->jumlah }}</td>
                                <td class="price-col text-center">{{ $return->created_at }}</td>
                                <td class="price-col text-center">{{ $return->keterangan }}</td>
                                <td class="price-col text-center">
                                    @if ($return->status == 0)
                                        <button class="btn btn-danger">Proses Return</button>
                                    @endif
                                    @if ($return->status == 1)
                                        <button class="btn btn-success">Diterima</button>
                                    @endif
                                    @if ($return->status == 2)
                                        <button class="btn btn-success">Return Selesai</button>
                                    @endif
                                    @if ($return->status == 3)
                                        <button class="btn btn-danger">Return Ditolak</button>
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
