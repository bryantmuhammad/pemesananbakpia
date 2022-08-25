@extends('admin.layouts.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Laporan Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Laporan Produk</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-lg-12 mb-4">

                        <a href="/admin/laporan/produk?cetak=true" target="_blank" class="btn btn-info">
                            <i class="fa fa-print"></i>
                        </a>

                    </div>
                </div>


                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="mytable" class="table table-bordered table-md">
                                        <thead>

                                            <tr>
                                                <th class="text-center">Nama Produk</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Harga</th>
                                                <th class="text-center">Berat</th>
                                                <th class="text-center">Keterangan</th>
                                                <th class="text-center">Foto</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($produks as $produk)
                                                <tr>
                                                    <td class="text-center">{{ $produk->nama_produk }}</td>
                                                    <td class="text-center">{{ $produk->kategori->nama_kategori }}</td>
                                                    <td class="text-center">{{ currency_IDR($produk->harga) }}</td>
                                                    <td class="text-center">{{ $produk->berat }}</td>
                                                    <td class="text-center">{{ $produk->keterangan }}</td>
                                                    <td class="text-center">
                                                        <a target="_blank" href="{{ asset('storage/' . $produk->foto) }}">
                                                            <img src="{{ asset('storage/' . $produk->foto) }}"
                                                                alt="Foto Produk" style="width:150px;height:130px;">
                                                        </a>
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

    <script></script>
@endsection
