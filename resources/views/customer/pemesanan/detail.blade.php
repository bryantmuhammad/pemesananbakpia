@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-breadcrumb">
                        <h2>Detail Pemesanan<span>.</span></h2>
                        <a href="/">Home</a>
                        <a class="active" href="#">Detail Pemesanan</a>
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
                <h2 class="text-center">Informasi Pembayaran</h2>
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">Bank Tujuan</th>
                            <th class="text-center">VA Number</th>
                            <th class="text-center">PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="price-col text-center">{{ strtoupper($pemesanan->pembayaran->bank_tujuan) }}</td>
                            <td class="price-col text-center">{{ $pemesanan->pembayaran->va_number }}</td>
                            <td class="price-col text-center">
                                <a target="_blank" href="{{ $pemesanan->pembayaran->pdf }}">
                                    <button class="btn btn-info">Cara Membayar</button>
                                </a>
                            </td>

                        </tr>
                    </tbody>
                </table>

                <br>
                <br>
                <h2 class="text-center">Alamat Pengiriman</h2>
                <table>
                    <thead>
                        <tr>
                            <th class="text-center">Nama Penerima</th>
                            <th class="text-center">No Telepon Penerima</th>
                            <th class="text-center">Provinsi</th>
                            <th class="text-center">Kabupaten</th>
                            <th class="text-center">Kodepos</th>
                            <th class="text-center">Kecamatan</th>
                            <th class="text-center">Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="price-col text-center">{{ $pemesanan->alamat->nama_penerima }}</td>
                            <td class="price-col text-center">{{ $pemesanan->alamat->telepon }}</td>
                            <td class="price-col text-center">{{ $pemesanan->alamat->provinsi }}</td>
                            <td class="price-col text-center">{{ $pemesanan->alamat->kabupaten }}</td>
                            <td class="price-col text-center">{{ $pemesanan->alamat->kodepos }}</td>
                            <td class="price-col text-center">{{ $pemesanan->alamat->kecamatan }}</td>
                            <td class="price-col text-center">{{ $pemesanan->alamat->alamat }}</td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <br>
                <h2 class="text-center">Detail Produk</h2>

                <table>
                    <thead>
                        <tr>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Sub Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanan->detail_pemesanan as $detailpemesanan)
                            <tr>
                                <td class="price-col text-center">{{ $detailpemesanan->produk->nama_produk }}
                                </td>
                                <td class="price-col text-center">{{ currency_IDR($detailpemesanan->produk->harga) }}</td>
                                <td class="price-col text-center">{{ $detailpemesanan->jumlah }}</td>
                                <td class="price-col text-center">
                                    {{ currency_IDR($detailpemesanan->produk->harga * $detailpemesanan->jumlah) }}
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
