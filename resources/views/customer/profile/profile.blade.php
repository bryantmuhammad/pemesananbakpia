@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Profil<span>.</span></h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <img src="img/add.jpg" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Cart Total Page Begin -->
    <section class="cart-total-page spad">
        <div class="container">
            <form action="{{ route('user.update', $user->id_user) }}" class="checkout-form" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Profil Customer</h3>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Nama Customer</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Email</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Password</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="password" name="password">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-method">
                            <button type="submit" name="submit">Edit Profil</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
