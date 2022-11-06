@extends('customer.layouts.main')
@section('content')
    <!-- Page Add Section Begin -->
    <section class="page-add">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-breadcrumb">
                        <h2>Bakpia<span>.</span></h2>
                        <a href="/">Home</a>
                        <a href="#" class="active">{{ $produk->nama_produk }}</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Page Add Section End -->

    <section class="product-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-slider owl-carousel">
                        <div class="product-img">
                            <figure>
                                <img src="{{ asset('storage/' . $produk->foto) }}" alt=""
                                    style="width:255px;height:410px;">
                                <div class="p-status">new</div>
                            </figure>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-content">
                        <h2>{{ $produk->nama }}</h2>
                        <div class="pc-meta">
                            <h5>{{ currency_IDR($produk->harga) }}</h5>

                        </div>
                        {{ draw_rating($produk->review->sum('rating'), $produk->review->count()) }}
                        <p>{{ $produk->keterangan }}</p>
                        <ul class="tags">
                            <li><span>Kategori :</span> {{ $produk->kategori->nama_kategori }}</li>
                        </ul>
                        <form method="POST" class="d-inline" action="/keranjang/tambah">
                            <div class="product-quantity">
                                <div class="pro-qty">
                                    <input type="text" name="jumlah" value="1" max="50">
                                </div>
                            </div>
                            @auth
                                @csrf
                                <input type="hidden" name="id_produk" value="{{ $produk->id_produk }}">
                                <button href="#" class="primary-btn pc-btn" style="cursor:pointer;">Tambahkan Ke
                                    Keranjang</button>
                            @else
                                <a href="{{ route('logincustomer') }}" class="primary-btn pc-btn">Login Dulu</a>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (count($produk->review))
        <section class="product-page">
            <div class="container">
                <div class="row pt-4">
                    <div class="col-lg-12">
                        <hr>
                        <h4>Review Produk</h4>
                    </div>
                    @foreach ($produk->review as $review)
                        <div class="col-lg-12" style="margin-top:20px;">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <i class="fa fa-star" style="color:gold;"></i>
                            @endfor
                            <h6>{{ $review->user->name }}</h6>
                            <p>{{ $review->created_at->diffForHumans() }}</p>
                            <p>{{ $review->komentar }}</p>
                            <div style="display: block;width:100%;border:1px solid black;"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    <!-- Related Product Section Begin -->
    <section class="related-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <hr>
                    <div class="section-title">
                        <h2>Produk Berkaitan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($produks as $produk)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-product-item">
                            <figure>
                                <a href="{{ route('bakpia.show', $produk->id_produk) }}"><img
                                        src="{{ asset('storage/' . $produk->foto) }}" alt=""
                                        style="width:255px;height:251px;"></a>
                            </figure>
                            <div class="product-text">
                                {{ draw_rating($produk->review->sum('rating'), $produk->review->count()) }}
                                <h6>{{ $produk->nama_produk }}</h6>
                                <p>{{ currency_IDR($produk->harga) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection
