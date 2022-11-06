@extends('admin.layouts.main')
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Return Masuk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Return Masuk</div>
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
                                                <th class="text-center">Aksi</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($return_produks as $return_produk)
                                                @php
                                                    var_dump($return_produk->url);
                                                @endphp
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
                                                    <td class="text-center">
                                                        <button class="btn btn-success"
                                                            data-id="{{ $return_produk->detail_pemesanan->pemesanan->user->id_user }}">Terima
                                                            Return</button>

                                                        <button class="btn btn-danger hapusreturn" data-toggle="modal"
                                                            data-target="#exampleModal"
                                                            data-id="{{ $return_produk->id_return_produk }}">
                                                            <i class="fa fa-trash"></i> </button>
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





    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Return</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="formhapusreturn">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Alasan Pembatalan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Batalkan Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
