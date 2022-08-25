<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Yoga Studio Template">
    <meta name="keywords" content="Yoga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bakpia 716 Annur</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/customer/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/customer/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/customer/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/customer/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/customer/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/customer/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/customer/css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



    <style>
        .checkout-form input[type=date] {
            width: 100%;
            border: 0;
            padding-bottom: 12px;
            border-bottom: 2px solid #E7EBED;
            color: #838383;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 32px;
        }

        .checkout-form input[type=password] {
            width: 100%;
            border: 0;
            padding-bottom: 12px;
            border-bottom: 2px solid #E7EBED;
            color: #838383;
            font-size: 17px;
            font-weight: 500;
            margin-bottom: 32px;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Search model -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container-fluid">
            <div class="inner-header">
                <div class="logo">
                    <a href="/">
                        <h3>Bakpia 716 Annur</h3>
                    </a>
                </div>
                <div class="header-right">
                    <a href="{{ route('keranjang.produk') }}" class="containerkeranjang">
                        <img src="/customer/img/icons/bag.png" alt="">
                        {{-- <span id="jumlakeranjang">2</span> --}}
                    </a>
                </div>

                <div class="user-access">
                    @auth()
                        <a href="/customer/logout">Logout</a>
                    @else
                        <a href="{{ route('user.create') }}">Register</a>
                        <a href="{{ route('logincustomer') }}" class="in">Login</a>
                    @endauth
                </div>
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li><a class=" {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                        <li><a class=" {{ Request::is('customer/bakpia*') ? 'active' : '' }}"
                                href="{{ route('bakpia.index') }}">Produk</a>
                        </li>
                        @auth()
                            <li><a href="">Hi, {{ auth()->user()->name }}</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('user.show', auth()->user()->id_user) }}">Profil</a></li>
                                    <li><a href="/pemesanan/customer">Pesanan</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </header>