@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Checkout<span>.</span></h2>
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
            <form action="#" class="checkout-form" id="formpengiriman">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Informasi Pengiriman</h3>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Nama Penerima*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="nama_penerima" id="nama_penerima"
                                    value="{{ old('nama_penerima') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Telepon Penerima*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="telepon" value="{{ old('telepon') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Provinsi*</p>
                            </div>
                            <div class="col-lg-8">
                                <select class="cart-select country-usa" name="provinsiongkir" id="provinsiongkir">
                                    <option value="0" selected>- Pilih Provinsi -</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Kabupaten*</p>
                            </div>
                            <div class="col-lg-8">
                                <select class="cart-select country-usa" name="kabupatenongkir" id="kabupatenongkir">
                                    <option value="0" selected>- Pilih Kabupaten -</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Pengiriman*</p>
                            </div>
                            <div class="col-lg-8">
                                <select class="cart-select country-usa" name="pengiriman" id="pengiriman">
                                    <option value="0" selected>- Pilih Pengiriman -</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Kecamatan*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Kode Pos*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="kodepos" id="kodepos" value="{{ old('kodepos') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Alamat*</p>
                            </div>
                            <div class="col-lg-8">
                                <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="in-name">Tanggal Diperlukan*</p>
                            </div>
                            <div class="col-lg-8">
                                {{-- <input type="date" name="tanggal" id="tanggal" value="{{ old('alamat') }}"> --}}
                                <input type="text" name="tanggal" id="tanggal" value="10/24/1984" />

                            </div>
                        </div>
                        <input type="hidden" name="provinsi" id="provinsi">
                        <input type="hidden" name="berat" id="berat" value="{{ $berat }}">
                        <input type="hidden" name="total" id="total" value="{{ $total }}">
                        <input type="hidden" name="kabupaten" id="kabupaten">
                        <input type="hidden" name="service" id="service">
                        <input type="hidden" name="code" id="code">
                    </div>
                    <div class="col-lg-4">
                        <div class="order-table">
                            @foreach ($keranjangs as $keranjang)
                                <div class="cart-item">
                                    <span>{{ substr($keranjang->produk->nama_produk, 0, 15) }}</span>
                                    <p class="product-name">x{{ $keranjang->jumlah }}</p>
                                </div>
                            @endforeach

                            <hr>
                            <div class="cart-item">
                                <span>Sub Total</span>
                                <p>{{ currency_IDR($total) }}</p>
                            </div>
                            <div class="cart-item">
                                <span>Ongkir</span>
                                <p class="ongkir">0</p>
                            </div>
                            <div class="cart-total">
                                <span>Total</span>
                                <p class="grandtotal">{{ currency_IDR($total) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="payment-method">
                            <button type="submit" id="bayar">Pesan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <h5 class="text-center">Sedang Memproses Pembayaran</h5>
                    <hr>
                    <button class="btn btn-primary btn-block" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- Cart Total Page End -->
@endsection
