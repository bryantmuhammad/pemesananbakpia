@extends('admin.layouts.main')
@section('content')
    <!-- Main Content -->
    <div class="main-content">

        <section class="section">
            <div class="section-header">
                <h1>Admin</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="index.php">Dashboard</a></div>
                    <div class="breadcrumb-item">Admin</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">

                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('users.create') }}">
                                    <button class="btn btn-primary float-right">Tambah Admin</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="mytable" class="table table-bordered table-md">
                                        <thead>

                                            <tr>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Action</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td class="text-center">{{ $admin->name }}</td>
                                                    <td class="text-center">{{ $admin->email }}</td>
                                                    @if ($admin->role == 1)
                                                        <td class="text-center">Admin</td>
                                                    @else
                                                        <td class="text-center">Pemilik</td>
                                                    @endif

                                                    <td class="text-center">
                                                        <button class="btn btn-success" data-id="{{ $admin->id_user }}"
                                                            onclick="editAdmin($(this).data('id'))" data-toggle="modal"
                                                            data-target="#exampleModalCenter">
                                                            <i class="fa fa-pen"></i>
                                                        </button>
                                                        @if ($admin->id_user !== auth()->user()->id_user)
                                                            <form class="d-inline"
                                                                action="{{ route('users.destroy', $admin->id_user) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button onclick="return false"
                                                                    class="btn btn-danger button-delete">
                                                                    <i class="fa fa-trash"></i> </button>
                                                            </form>
                                                        @endif


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
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" id="formadmin">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Admin</label>
                                        <input type="text" value="{{ old('name') }}" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror" required>
                                        @error('name')
                                            <label id="name-error" class="error" for="name">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                            name="email" id="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <label id="email-error" class="error" for="email">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="nohp">Role</label>
                                        <select name="role" id="role" class="form-control">
                                            @if (old('role') == '1')
                                                <option value="1" selected>Admin</option>
                                                <option value="2">Pemilik</option>
                                            @else
                                                <option value="1">Admin</option>
                                                <option value="2" selected>Pemilik</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <hr>
                                    <p style="color:red;font-size:12px;">*Abaikan jika tidak ingin mengganti password</p>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                                            name="password" id="password">
                                        @error('password')
                                            <label id="password-error" class="error"
                                                for="password">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Edit Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
