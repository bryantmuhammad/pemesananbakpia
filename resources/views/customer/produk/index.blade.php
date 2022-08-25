@extends('customer.layouts.main')
@section('content')
    <!-- Latest Product Begin -->
    <section class="latest-products spad">
        <div class="container">
            <div class="product-filter">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="section-title">
                            <h2>Daftar Bakpia</h2>
                        </div>
                        <ul class="product-controls">
                            <li data-filter="*">All</li>
                            @foreach ($kategoris as $kategori)
                                <li data-filter=".{{ preg_replace('/\s+/', '_', $kategori->nama_kategori) }}">
                                    {{ $kategori->nama_kategori }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
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
                {{-- <div class="col-lg-12">
                    {{ $produks->links() }}
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Latest Product End -->
    <!-- Page Add Section End -->
@endsection
