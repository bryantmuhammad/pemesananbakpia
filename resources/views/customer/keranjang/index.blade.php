@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add cart-page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Keranjang<span>.</span></h2>
                        <a href="/">Home</a>
                        <a class="active" href="#">Keranjang</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <!-- Cart Page Section Begin -->
    <div class="cart-page">
        <div class="container">
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th class="text-center" width="30%">Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keranjangs as $keranjang)
                            <tr>
                                <td class="price-col text-center">{{ $keranjang->produk->nama_produk }}</td>
                                <td class="price-col text-center">{{ currency_IDR($keranjang->produk->harga) }}</td>
                                <td class="quantity-col text-center">
                                    <div class="pro-qty mr-auto ml-auto">
                                        <input type="text" value="{{ $keranjang->jumlah }}"
                                            data-keranjang="{{ $keranjang->id_keranjang }}" class="u-keranjang">
                                    </div>
                                </td>
                                <td class="total text-center">
                                    {{ currency_IDR($keranjang->produk->harga * $keranjang->jumlah) }}</td>
                                <td class="product-close">
                                    <form action="{{ route('keranjang.destroy', $keranjang->id_keranjang) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button-delete"
                                            style="cursor:pointer;color:black;border:none;background-color:inherit;">x</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
        <div class="shopping-method">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="total-info">
                            <div class="total-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="total text-right" colspan="4">Total</td>
                                            <td class="sub-total text-right" id="grandtotal">{{ currency_IDR($total) }}</td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <a href="/pemesanan/checkout" class="primary-btn chechout-btn">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page Section End -->
@endsection
