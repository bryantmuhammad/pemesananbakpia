@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Return Produk<span>.</span></h2>
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
            <form action="{{ route('return.user.store') }}" method="POST" class="checkout-form" id="formpengiriman">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Informasi Return</h3>
                    </div>
                    <div class="col-lg-8">
                        <input type="hidden" name="id_detail_pemesanan"
                            value="{{ $detail_pemesanan->id_detail_pemesanan }}">
                        <input type="hidden" name="id_produk" value="{{ $detail_pemesanan->id_produk }}">
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Nama Barang*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="nama_produk" id="nama_produk"
                                    value="{{ old('nama_produk', $detail_pemesanan->produk->nama_produk) }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Jumlah Beli*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" value="{{ old('jumlah', $jumlah) }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Jumlah Return*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="number" max="{{ $jumlah }}" name="jumlah" value="{{ old('jumlah') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Link Video Unboxing*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="url" value="{{ old('url') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Alasan Return*</p>
                            </div>
                            <div class="col-lg-8">
                                <textarea name="alasan" id="alasan" class="form-control" cols="30" rows="10">{{ old('alasan') }}</textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-method">
                            @if ($jumlah <= 0)
                                <button class="btn btn-danger" disabled>Tidak bisa melakukan return</button>
                            @else
                                <button type="submit">Ajukan Return</button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
