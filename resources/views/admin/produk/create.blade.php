@extends('admin.layouts.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Produk</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></div>
                    <div class="breadcrumb-item">Tambah Produk</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form class="" id="formadmins" method="post" action="{{ route('produk.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <input type="text" value="{{ old('nama_produk') }}" name="nama_produk"
                                                    id="nama_produk"
                                                    class="form-control @error('nama_produk') is-invalid @enderror"
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
                                                <input class="form-control @error('harga') is-invalid @enderror"
                                                    type="number" name="harga" id="harga" value="{{ old('harga') }}"
                                                    required>
                                                @error('harga')
                                                    <label id="harga-error" class="error"
                                                        for="harga">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">Berat</label>
                                                <input class="form-control @error('berat') is-invalid @enderror"
                                                    type="number" name="berat" id="berat" value="{{ old('berat') }}"
                                                    required>
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
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit" name="submit">Tambah Produk</button>
                                    </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
