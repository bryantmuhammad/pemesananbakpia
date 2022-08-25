@extends('admin.layouts.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Produk</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('produk.create') }}">
                                    <button class="btn btn-primary float-right">Tambah Produk</button>
                                </a>
                            </div>
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
                                                <th class="text-center">Action</th>
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
                                                    <td class="text-center">
                                                        <button class="btn btn-success" data-id="{{ $produk->id_produk }}"
                                                            onclick="editProduk($(this).data('id'))" data-toggle="modal"
                                                            data-target="#exampleModalCenter">
                                                            <i class="fa fa-pen"></i>
                                                        </button>

                                                        <form class="d-inline"
                                                            action="{{ route('produk.destroy', $produk->id_produk) }}"
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




        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" id="formproduk" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" value="{{ old('nama_produk') }}" name="nama_produk"
                                            id="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror"
                                            required>
                                        @error('nama_produk')
                                            <label id="nama_produk-error" class="error"
                                                for="nama_produk">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Harga</label>
                                        <input class="form-control @error('harga') is-invalid @enderror" type="number"
                                            name="harga" id="harga" value="{{ old('harga') }}" required>
                                        @error('harga')
                                            <label id="harga-error" class="error" for="harga">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Berat</label>
                                        <input class="form-control @error('berat') is-invalid @enderror" type="number"
                                            name="berat" id="berat" value="{{ old('berat') }}" required>
                                        @error('berat')
                                            <label id="berat-error" class="error"
                                                for="berat">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_kategori">Kategori</label>
                                        <select name="id_kategori" id="id_kategori" class="form-control">
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id_kategori }}">
                                                    {{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori')
                                            <label id="id_kategori-error" class="error"
                                                for="id_kategori">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <label id="keterangan-error" class="error"
                                                for="keterangan">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="email">Foto Produk</label>
                                        <input type="file" onchange="previewImage()" class="form-control"
                                            name="foto" id="image">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email">Preview Foto</label>
                                        <br>
                                        <img class="img-preview img-fluid" alt="Preview Image"
                                            style="width: 150px;height:130px;">
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Edit Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script></script>
@endsection
