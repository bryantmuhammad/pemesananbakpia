@extends('customer.layouts.main')
@section('content')
    <!-- Hero Slider Begin -->
    <section class="hero-slider">
        <div class="hero-items owl-carousel">
            <div class="single-slider-item set-bg" data-setbg="/customer/img/slider-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>2019</h1>
                            <h2>Lookbook.</h2>
                            <a href="#" class="primary-btn">See More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider-item set-bg" data-setbg="/customer/img/slider-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>2019</h1>
                            <h2>Lookbook.</h2>
                            <a href="#" class="primary-btn">See More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider-item set-bg" data-setbg="/customer/img/slider-3.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1>2019</h1>
                            <h2>Lookbook.</h2>
                            <a href="#" class="primary-btn">See More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Slider End -->

    <!-- Features Section Begin -->
    <section class="features-section spad">
        <div class="features-ads">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-features-ads first">
                            <img src="/customer/img/icons/f-delivery.png" alt="">
                            <h4>Pengiriman Cepat</h4>
                            <p>Kami akan langsung mengirimkan pesanan setelah produk jadi dibuat agar konsumen mendapatkan
                                bakpia terbaik. </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-features-ads second">
                            <img src="/customer/img/icons/coin.png" alt="">
                            <h4>100% Uang Kembali </h4>
                            <p>Jika pesanan tidak sesuai apa yang dipesan kami akan mengembalikan uang yang sudah dikirim.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-features-ads">
                            <img src="/customer/img/icons/chat.png" alt="">
                            <h4>Layanan 24/7</h4>
                            <p>Kami melayani 24 jam penuh untuk para pelanggan agar pelanggan bisa dengan mudah memesan
                                bakpia. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Features Section End -->

    <!-- Latest Product Begin -->
    <section class="latest-products spad">
        <div class="container">
            <div class="product-filter">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Produk Terbaru</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="product-list">
                <div class="row" id="product-list">
                    @foreach ($produks as $produk)
                        <div
                            class="col-lg-3 col-sm-6 mix all {{ preg_replace('/\s+/', '_', $produk->kategori->nama_kategori) }}">
                            <div class="single-product-item">
                                <figure>
                                    <a href="{{ route('bakpia.show', $produk->id_produk) }}"><img
                                            src="{{ asset('storage/' . $produk->foto) }}" alt=""
                                            style="width:255px;height:251px;"></a>
                                </figure>
                                <div class="product-text">
                                    <h6>{{ $produk->nama_produk }}</h6>
                                    <p>{{ currency_IDR($produk->harga) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product End -->



    <!-- Logo Section Begin -->
    <div class="logo-section spad">
        <div class="logo-items owl-carousel">
            <div class="logo-item">
                <img src="/customer/img/logos/logo-1.png" alt="">
            </div>
            <div class="logo-item">
                <img src="/customer/img/logos/logo-2.png" alt="">
            </div>
            <div class="logo-item">
                <img src="/customer/img/logos/logo-3.png" alt="">
            </div>
            <div class="logo-item">
                <img src="/customer/img/logos/logo-4.png" alt="">
            </div>
            <div class="logo-item">
                <img src="/customer/img/logos/logo-5.png" alt="">
            </div>
        </div>
    </div>
    <!-- Logo Section End -->
@endsection
