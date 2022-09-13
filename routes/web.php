<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProdukController as AdminProduk;
use App\Http\Controllers\User\ProdukController as CustomerProduk;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\User\UserController as CustomerUser;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\User\PemesananController as UserPemesanan;
use App\Http\Controllers\Admin\PemesananController as AdminPemesanan;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Admin\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CustomerProduk::class, 'home']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');
// ===========================================================================================
// Admin Auth
Route::get('/admin/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
// Customer Auth
Route::post('/customer/login', [LoginController::class, 'authenticatecustomer']);
Route::get('/customer/login', [LoginController::class, 'customer'])->name('logincustomer')->middleware('guest');
Route::get('/customer/logout', [LoginController::class, 'customerlogout']);
// ===========================================================================================
Route::resource('/customer/user', CustomerUser::class)->except(['edit']);
Route::resource('/customer/bakpia', CustomerProduk::class)->except(['edit', 'update', 'destroy', 'store', 'create']);
Route::resource('/admin/users', AdminUser::class)->middleware('auth')->except('edit');
Route::resource('/admin/produk', AdminProduk::class)->middleware(['can:crud', 'auth'])->except('edit');
Route::resource('/admin/kategori', KategoriController::class)->middleware(['can:crud', 'auth'])->except('edit');


Route::middleware(['authcustomer'])->prefix('keranjang')->group(function () {
    Route::post('/tambah', [KeranjangController::class, 'tambah']);
    Route::get('/jumlah', [KeranjangController::class, 'jumlah']);
    Route::get('/produk', [KeranjangController::class, 'index'])->name('keranjang.produk');
    Route::delete('/hapus/{keranjang}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    Route::put('/edit/{keranjang}', [KeranjangController::class, 'update']);
});


Route::middleware(['authcustomer'])->prefix('pemesanan')->group(function () {
    Route::get('/checkout', [UserPemesanan::class, 'checkout']);
    Route::post('/simpan', [UserPemesanan::class, 'store']);
    Route::get('/customer', [UserPemesanan::class, 'index']);
    Route::get('/detail/{pemesanan}', [UserPemesanan::class, 'show']);
});


Route::prefix('ongkir')->group(function () {
    Route::get('/provinsi', [OngkirController::class, 'provinsi']);
    Route::post('/kabupaten', [OngkirController::class, 'kabupaten']);
    Route::post('/ongkir', [OngkirController::class, 'ongkir']);
});

Route::middleware(['can:transaksi', 'auth'])->prefix('admin/pemesanan')->group(function () {
    Route::get('/pembuatan', [AdminPemesanan::class, 'pembuatan'])->name('pemesanan.pembuatan');
    Route::get('/sudahbayar', [AdminPemesanan::class, 'sudah_bayar'])->name('pemesanan.sudahbayar');
    Route::get('/belumbayar', [AdminPemesanan::class, 'belum_bayar'])->name('pemesanan.belumbayar');
    Route::delete('/delete/{pemesanan}', [AdminPemesanan::class, 'destroy'])->name('pemesanan.destroy');
    Route::get('/detail/{pemesanan}', [AdminPemesanan::class, 'show'])->name('pemesanan.detail');
    Route::put('/updatepembuatan/{pemesanan}', [AdminPemesanan::class, 'update_pembuatan']);
    Route::put('/kirimresi/{pemesanan}', [AdminPemesanan::class, 'kirim_resi']);
    Route::get('/dikirim', [AdminPemesanan::class, 'dikirim'])->name('pemesanan.dikirim');
});


Route::middleware(['auth'])->prefix('admin/laporan')->group(function () {
    Route::any('/pemesanan', [LaporanController::class, 'pemesanan'])->name('laporan.pemesanan');
    Route::any('/produk', [LaporanController::class, 'produk'])->name('laporan.produk');
});

Route::post('/checkout/pay', [CheckoutController::class, 'pay']);
