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

        .checkout-form input[type=number] {
            width: 100%;
            border: 0;
            padding-bottom: 12px;
            border-bottom: 2px solid #E7EBED;
            color: #838383;
            font-size: 17px;
            font-weight: 500;
            margin-bottom: 32px;
        }

        .overlay {
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            /* Black see-through */
            color: #140202;
            width: 100%;
            height: 100%;
            opacity: 1;
            text-align: center;
        }


        .overlay span {
            color: #fff;
            font-size: 30px;
            font-weight: 500;
            list-style: none;
            line-height: 36px;
            opacity: 0.5;
            margin-top: 40%;
            display: inline-block;
        }

        #sub-notification li:hover {
            background-color: lightgrey;
            padding: 15px 0;
        }

        #sub-notification li {
            padding: 10px 0;
            cursor: pointer;
        }


        .notification-bell {
            font-size: 12px;
            position: relative;
            bottom: 10px;
        }

        .notification-unread {
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    {{-- < !-- Search model --> --}}
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form"><input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    {{-- < !-- Search model end -->
            < !-- Header Section Begin --> --}}
    <header class="header-section">
        <div class="container-fluid">
            <div class="inner-header">
                <div class="logo"><a href="/">
                        <h3>Bakpia 716 Annur</h3>
                    </a></div>
                <div class="header-right"><a href="{{ route('keranjang.produk') }}" class="containerkeranjang"><img
                            src="/customer/img/icons/bag.png" alt="">{{-- <span id="jumlakeranjang">2</span> --}} </a></div>
                <div class="user-access">
                    @auth()
                        <a href="/customer/logout">Logout</a>
                    @else
                        <a href="{{ route('user.create') }}">Register</a><a href="{{ route('logincustomer') }}"
                            class="in">Login</a>
                    @endauth
                </div>
                <nav class="main-menu mobile-menu">
                    <ul>
                        <li><a class=" {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                        <li><a class=" {{ Request::is('customer/bakpia*') ? 'active' : '' }}"
                                href="{{ route('bakpia.index') }}">Produk</a></li>
                        @auth()
                            <li><a href="/">Hi,
                                    {{ auth()->user()->name }}</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('user.show', auth()->user()->id_user) }}">Profil</a>
                                    </li>
                                    <li><a href="/pemesanan/riwayatpesanan">Riwayat Pesanan</a></li>
                                    <li><a href="/pemesanan/customer">Pesanan</a></li>
                                    <li><a href="{{ route('return.index') }}">Return</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javscript:void(0)">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification-bell"></span>
                                </a>
                                <ul id="sub-notification" class="sub-menu" style="width: 450px;">
                                    <li><a href="javascript:void(0)">Tidak ada notifikasi</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </nav>
            </div>
        </div>
    </header>
