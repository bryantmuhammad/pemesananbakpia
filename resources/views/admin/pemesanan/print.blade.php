<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Print Invoice Penjualan</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    <!-- END GA -->
</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Content -->
            <div class="main-content">
                <section class="section">
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
                                                    {{ $pemesanan->alamat->provinsi }}, {{ $pemesanan->alamat->kodepos
                                                    }} <br>

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
                                                    {{ $pemesanan->tanggal_diperlukan->isoFormat('dddd, D MMMM Y')
                                                    }}<br>
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
                                                    <td class="text-center">{{
                                                        currency_IDR($detailpemesanan->produk->harga) }}
                                                    </td>
                                                    <td class="text-center">{{ $detailpemesanan->jumlah }}</td>
                                                    <td class="text-right">
                                                        {{ currency_IDR($detailpemesanan->produk->harga *
                                                        $detailpemesanan->jumlah)
                                                        }}
                                                    </td>
                                                </tr>
                                                @php($total += $detailpemesanan->produk->harga *
                                                $detailpemesanan->jumlah)
                                                @endforeach

                                                <tr>
                                                    <td colspan="4" class="text-center"><b>Sub Total</b></td>
                                                    <td class="text-right"><b>{{ currency_IDR($total) }}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-center"><b>Biaya Kirim</b></td>
                                                    <td class="text-right"><b>{{ currency_IDR($pemesanan->ongkir) }}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-center"><b>Total</b></td>
                                                    <td class="text-right"><b>{{ currency_IDR($pemesanan->ongkir +
                                                            $total) }}</b>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>
                </section>
            </div>


        </div>
    </div>

    <script>
        window.print();
    </script>

</body>


</html>