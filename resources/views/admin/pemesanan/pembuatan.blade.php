@extends('admin.layouts.main')
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Pemesanan Proses Pembuatan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Pemesanan Proses Pembuatan</div>
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
                                                        <button class="btn btn-success resi"
                                                            data-id="{{ $pemesanan->id_pemesanan }}" data-toggle="modal"
                                                            data-target="#exampleModalCenter">Kirim</button>
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

    <!-- Modal Kirim Resi -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal Kirim Resi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="formkirimresi" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>ID Pemesanan</label>
                                    <input type="text" value="{{ old('id_pemesanan') }}" name="id_pemesanan"
                                        id="id_pemesanan" class="form-control @error('id_pemesanan') is-invalid @enderror"
                                        required readonly>
                                    @error('id_pemesanan')
                                        <label id="id_pemesanan-error" class="error"
                                            for="id_pemesanan">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>No Resi</label>
                                    <input type="text" value="{{ old('resi') }}" name="resi" id="resi"
                                        class="form-control @error('resi') is-invalid @enderror" required>
                                    @error('resi')
                                        <label id="resi-error" class="error" for="resi">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
