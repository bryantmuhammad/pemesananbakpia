@extends('admin.layouts.main')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Pemesanan </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Detail Pemesanan </div>
                </div>
            </div>

            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">Order #{{ $pemesanan->id_pemesanan }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Dikirim Ke:</strong><br>
                                            {{ $pemesanan->alamat->nama_penerima }}<br>
                                            {{ $pemesanan->alamat->telepon }}<br>
                                            {{ $pemesanan->alamat->alamat }},
                                            {{ ucwords($pemesanan->alamat->kecamatan) }}<br>
                                            {{ $pemesanan->alamat->kabupaten }},
                                            {{ $pemesanan->alamat->provinsi }}, {{ $pemesanan->alamat->kodepos }} <br>

                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Pengiriman:</strong><br>
                                            {{ strtoupper($pemesanan->ekspedisi) }}<br>
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Pembayaran:</strong><br>
                                            {{ $pemesanan->pembayaran->bank_tujuan }}<br>
                                            {{ $pemesanan->pembayaran->va_number }}<br>
                                            <a href="{{ $pemesanan->pembayaran->pdf }}" target="_blank">Cara
                                                Membayar</a><br>
                                            @if ($pemesanan->status == 0)
                                                <b>Belum Membayar</b>
                                            @else
                                                <b>Sudah Membayar</b>
                                            @endif
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Tanggal Pemesanan:</strong><br>
                                            {{ $pemesanan->tanggal_pemesanan->isoFormat('dddd, D MMMM Y') }}<br>
                                            <strong>Tanggal Diperlukan:</strong><br>
                                            {{ $pemesanan->tanggal_diperlukan->isoFormat('dddd, D MMMM Y') }}<br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <tr>
                                            <th data-width="40">#</th>
                                            <th>Produk</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                        @php($total = 0)
                                        @foreach ($pemesanan->detail_pemesanan as $detailpemesanan)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $detailpemesanan->produk->nama_produk }}</td>
                                                <td class="text-center">{{ currency_IDR($detailpemesanan->produk->harga) }}
                                                </td>
                                                <td class="text-center">{{ $detailpemesanan->jumlah }}</td>
                                                <td class="text-right">
                                                    {{ currency_IDR($detailpemesanan->produk->harga * $detailpemesanan->jumlah) }}
                                                </td>
                                            </tr>
                                            @php($total += $detailpemesanan->produk->harga * $detailpemesanan->jumlah)
                                        @endforeach

                                        <tr>
                                            <td colspan="4" class="text-center"><b>Sub Total</b></td>
                                            <td class="text-right"><b>{{ currency_IDR($total) }}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Biaya Kirim</b></td>
                                            <td class="text-right"><b>{{ currency_IDR($pemesanan->ongkir) }}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Total</b></td>
                                            <td class="text-right"><b>{{ currency_IDR($pemesanan->ongkir + $total) }}</b>
                                            </td>
                                        </tr>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">

                        <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
