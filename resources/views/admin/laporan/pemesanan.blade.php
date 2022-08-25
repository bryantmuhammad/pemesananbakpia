@extends('admin.layouts.main')
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Laporan Pemesanan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Laporan Pemesanan</div>
                </div>
            </div>



            <div class="section-body">



                <form action="{{ route('laporan.pemesanan') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" value="{{ old('tanggalawal', request('tanggalawal')) }}"
                                    name="tanggalawal" id="tanggalawal"
                                    class="form-control @error('tanggalawal') is-invalid @enderror" required>
                                @error('tanggalawal')
                                    <label id="nama_produk-error" class="error" for="nama_produk">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal Awal</label>
                                <input type="date" value="{{ old('tanggalakhir', request('tanggalakhir')) }}"
                                    name="tanggalakhir" id="tanggalakhir"
                                    class="form-control @error('tanggalakhir') is-invalid @enderror" required>
                                @error('tanggalakhir')
                                    <label id="nama_produk-error" class="error" for="nama_produk">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-4">
                        <button class="btn btn-success" type="submit" name="submit">Cari</button>
                        @if (request('tanggalakhir') && request('tanggalawal'))
                            <a class="btn btn-info"
                                href="/admin/laporan/pemesanan?cetak=true&tanggalawal={{ request('tanggalawal') }}&tanggalakhir={{ request('tanggalakhir') }}"
                                target="_blank" class="btn btn-info">
                                <i class="fa fa-print"></i>
                            </a>
                        @else
                            <a href="/admin/laporan/pemesanan?cetak=true" target="_blank" class="btn btn-info">
                                <i class="fa fa-print"></i>
                            </a>
                        @endif
                    </div>
                </form>

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
                                                <th class="text-center">Tanggal Pemesanan</th>
                                                <th class="text-center">Tanggal Diperlukan</th>
                                                <th class="text-center">Detail Pemesanan</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($pemesanans as $pemesanan)
                                                <tr>
                                                    <td class="text-center">{{ $pemesanan->id_pemesanan }}</td>
                                                    <td class="text-center">{{ $pemesanan->user->name }}</td>
                                                    <td class="text-center">
                                                        {{ $pemesanan->tanggal_pemesanan->isoFormat('dddd, D MMMM Y') }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $pemesanan->tanggal_diperlukan->isoFormat('dddd, D MMMM Y') }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('pemesanan.detail', $pemesanan->id_pemesanan) }}"
                                                            class="btn btn-info">Detail Pemesanan</a>
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
