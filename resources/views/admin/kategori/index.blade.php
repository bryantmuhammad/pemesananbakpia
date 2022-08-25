@extends('admin.layouts.main')

@section('content')
    <!-- Main Content -->
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Kategori</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Kategori</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('kategori.create') }}">
                                    <button class="btn btn-primary float-right">Tambah Kategori</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="mytable" class="table table-bordered table-md">
                                        <thead>

                                            <tr>
                                                <th class="text-center">Nama Kategori</th>
                                                <th class="text-center">Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($kategoris as $kategori)
                                                <tr>
                                                    <td class="text-center">{{ $kategori->nama_kategori }}</td>

                                                    <td class="text-center">
                                                        <button class="btn btn-success"
                                                            data-id="{{ $kategori->id_kategori }}"
                                                            onclick="editKategori($(this).data('id'))" data-toggle="modal"
                                                            data-target="#exampleModalCenter">
                                                            <i class="fa fa-pen"></i>
                                                        </button>

                                                        <form class="d-inline"
                                                            action="{{ route('kategori.destroy', $kategori->id_kategori) }}"
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" id="formkategori" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" value="{{ old('nama_kategori') }}" name="nama_kategori"
                                            id="nama_kategori"
                                            class="form-control @error('nama_kategori') is-invalid @enderror" required>
                                        @error('nama_kategori')
                                            <label id="nama_kategori-error" class="error"
                                                for="nama_kategori">{{ $message }}</label>
                                        @enderror
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
