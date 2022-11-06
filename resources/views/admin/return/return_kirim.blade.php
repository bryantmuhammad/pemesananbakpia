@extends('admin.layouts.main')
@section('content')
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Return Siap Kirim</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Return Siap Kirim</div>
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
                                                        <button class="btn btn-success alamatcustomer" data-toggle="modal"
                                                            data-target="#exampleModal"
                                                            data-id="{{ $return_produk->detail_pemesanan->pemesanan->id_pemesanan }}"
                                                            data-id_return="{{ $return_produk->id_return_produk }}">Kirim
                                                            Return</button>


                                                        <button onclick="return false" class="btn btn-danger hapusreturn"
                                                            data-toggle="modal" data-target="#modalHapus"
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kirim Return</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('return.kirim') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pemesanan" id="id_pemesanan">
                    <input type="hidden" name="id_return_produk" id="id_return_produk">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Penerima</label>
                                    <input type="text" value="" name="nama_penerima" id="nama_penerima"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>No Telepon Penerima</label>
                                    <input type="text" value="" name="telepon" id="telepon" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Provinsi</label>
                                    <input type="text" value="" name="provinsi" id="provinsi" class="form-control"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kabupaten</label>
                                    <input type="text" value="" name="kabupaten" id="kabupaten"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input type="text" value="" name="kodepos" id="kodepos"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" value="" name="kecamatan" id="kecamatan"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" value="" name="alamat" id="alamat"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>No Resi</label>
                                    <input type="text" value="" name="resi" id="resi"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim Return</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHapusLabel">Hapus Return</h5>
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
