@extends('admin.layouts.main')
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Return Selesai</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Return Selesai</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="mytable" class="table table-bordered table-md">
                                        <thead>

                                            <tr>
                                                <th class="text-center">ID Transaksi</th>
                                                <th class="text-center">Customer</th>
                                                <th class="text-center">Jumlah Return</th>
                                                <th class="text-center">Url</th>
                                                <th class="text-center">Alasan</th>
                                                <th class="text-center">Tanggal Return</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($return_produks as $return_produk)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $return_produk->detail_pemesanan->id_pemesanan }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $return_produk->detail_pemesanan->pemesanan->user->name }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $return_produk->jumlah }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="//{{ $return_produk->url }}" target="__blank"
                                                            class="btn btn-sm btn-info">Link
                                                            Unboxing</a>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $return_produk->alasan }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $return_produk->created_at->isoFormat('dddd, D MMMM Y') }}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
