@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="page-breadcrumb">
                        <h2>Daftar Akun Baru</h2>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Page Add Section End -->
    <!-- Contact Section Begin -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('user.store') }}" class="contact-form" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" name="name" id="name" placeholder="Nama Customer"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" id="email" placeholder="Email Customer"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="col-lg-6">
                                <input type="password" name="password" id="password" placeholder="Password Customer">
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-block" type="submit">Daftar Akun</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <!-- Contact Section End -->
@endsection
