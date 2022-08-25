@extends('admin.layouts.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Kategori</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></div>
                    <div class="breadcrumb-item">Tambah Kategori</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form class="" id="formadmins" method="post" action="{{ route('kategori.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Nama Kategori</label>
                                                <input type="text" value="{{ old('nama_kategori') }}"
                                                    name="nama_kategori" id="nama_kategori"
                                                    class="form-control @error('nama_kategori') is-invalid @enderror"
                                                    required>
                                                @error('nama_kategori')
                                                    <label id="nama_kategori-error" class="error"
                                                        for="nama_kategori">{{ $message }}</label>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary" type="submit" name="submit">Tambah
                                            Kategori</button>
                                    </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
