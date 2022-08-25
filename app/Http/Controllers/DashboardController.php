<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Pemesanan;


class DashboardController extends Controller
{
    public function index()
    {
        $produk = Produk::count();


        return view('admin.dashboard', [
            'produk' => Produk::count(),
            'admin' => User::where('role', '!=', 3)->count(),
            'pemesanan' => Pemesanan::where('status', '>=', 3)->count(),
        ]);
    }
}
