@extends('admin.layouts.main')
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Pemesanan Sudah Membayar</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Pemesanan Sudah Membayar</div>
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
                                                <th class="text-center">Tanggal Pemesanan</th>
                                                <th class="text-center">Tanggal Diperlukan</th>
                                                <th class="text-center">Detail Pemesanan</th>
                                                <th class="text-center">Aksi</th>
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
                                                    <td class="text-center">
                                                        <button class="btn btn-success pembuatan"
                                                            data-id="{{ $pemesanan->id_pemesanan }}">Pembuatan</button>
                                                        <form class="d-inline"
                                                            action="{{ route('pemesanan.destroy', $pemesanan->id_pemesanan) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return false"
                                                                class="btn btn-danger button-delete">
                                                                <i class="fa fa-trash"></i> </button>
                                                        </form>


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
