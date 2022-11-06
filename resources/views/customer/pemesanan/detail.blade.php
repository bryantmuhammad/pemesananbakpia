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
            @if ($pemesanan->status == 3)
                <button class="btn btn-success btn-block mb-4 pesananselesai"
                    data-id="{{ $pemesanan->id_pemesanan }}">Pesanan sudah
                    diterima</button>
            @endif

            <div class="cart-table">
                @if ($pemesanan->pembayaran)
                    <h2 class="text-center">Informasi Pembayaran</h2>
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">Bank Tujuan</th>
                                <th class="text-center">VA Number</th>
                                <th class="text-center">PDF</th>
                                @if ($pemesanan->resi)
                                    <th class="text-center">No Resi</th>
                                @endif
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
                                @if ($pemesanan->resi)
                                    <td class="price-col text-center">{{ $pemesanan->resi }}</td>
                                @endif

                            </tr>
                        </tbody>
                    </table>

                    <br>
                    <br>
                @endif

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
                            @if ($pemesanan->status == 3)
                                <th class="text-center">Aksi</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailpemesanans as $detailpemesanan)
                            <tr>
                                <td class="price-col text-center">{{ $detailpemesanan->produk->nama_produk }}
                                </td>
                                <td class="price-col text-center">{{ currency_IDR($detailpemesanan->produk->harga) }}</td>
                                <td class="price-col text-center">{{ $detailpemesanan->jumlah }}</td>
                                <td class="price-col text-center">
                                    {{ currency_IDR($detailpemesanan->produk->harga * $detailpemesanan->jumlah) }}
                                </td>
                                @if ($pemesanan->status >= 3)
                                    <td class="price-col text-center">
                                        @if (!$detailpemesanan->review)
                                            <button class="btn btn-sm btn-primary review"
                                                data-id="{{ $detailpemesanan->id_detail_pemesanan }}" data-toggle="modal"
                                                data-target="#modalReview">Penilaian</button>
                                        @endif
                                        @if (!count($detailpemesanan->return_produk))
                                            <a
                                                href="{{ route('pemesanan.return', $detailpemesanan->id_detail_pemesanan) }}">
                                                <button class="btn btn-sm btn-danger">Return</button>
                                            </a>
                                        @endif

                                    </td>
                                @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalReview" tabindex="-1" role="dialog" aria-labelledby="modalReviewTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Review Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_detail_pemesanan" id="id_detail_pemesanan">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <p style="font-size:12px;margin-bottom:-6px;">Berikan Penilaian</p>
                                <i class="fa fa-star fa-1x penilaian" data-index="0"></i>
                                <i class="fa fa-star fa-1x penilaian" data-index="1"></i>
                                <i class="fa fa-star fa-1x penilaian" data-index="2"></i>
                                <i class="fa fa-star fa-1x penilaian" data-index="3"></i>
                                <i class="fa fa-star fa-1x penilaian" data-index="4"></i>
                            </div>
                            <div class="col-lg-12">
                                <input type="hidden" name="rating" id="rating" value="5">
                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea name="komentar" id="komentar" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Cart Page Section End -->
@endsection
