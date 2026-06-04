<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerAuthController;
//use App\Http\Controllers\PemilikController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PembeliAuthController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RiwayatController;

Route::get('/', function () {
    return view('home');//beranda
});
Route::view('/about', 'about');//tentang
Route::view('/contact','contact');//kontak

Route::get('/owner/login', [OwnerAuthController::class, 'showLogin']);
Route::post('/owner/login', [OwnerAuthController::class, 'login']);
Route::get('/owner/dashboard', [OwnerAuthController::class, 'dashboard']);
Route::get('/owner/dashboard', [OwnerAuthController::class, 'dashboard'])
->name('owner.dashboard');
// Tambahkan baris ini di file routes/web.php
Route::get('/logoutowner', [OwnerAuthController::class, 'logout']);
Route::get(
    '/owner/produk',
    [ProdukController::class, 'index']
);
Route::post(
    '/owner/produk/simpan',
    [ProdukController::class, 'simpan']
);
Route::get(
    '/owner/produk/hapus/{id}',
    [ProdukController::class, 'hapus']
);
Route::get(
    '/owner/produk/edit/{id}',
    [ProdukController::class, 'edit']
);

Route::get('/pembeli/login', [PembeliAuthController::class, 'showLogin']);
Route::post('/pembeli/login', [PembeliAuthController::class, 'login']);
Route::get('pembeli/katalog', [KatalogController::class, 'index']);
Route::get('/logoutpembeli', [PembeliAuthController::class, 'logout']);
Route::get('/detail_produk/{id}', [KatalogController::class, 'detail']);
Route::post('/checkout', [KatalogController::class, 'checkout'])->name('checkout');
Route::post('/proses-pesanan', [KatalogController::class, 'prosesPesanan'])->name('proses.pesanan');
Route::get('/riwayat/{id}', [KatalogController::class, 'riwayat'])->name('riwayat');
Route::get('/lihat_pesanan', [KatalogController::class, 'lihatPesanan'])->name('lihat.pesanan');


Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::get('/logoutadmin', [AdminAuthController::class, 'logout']);
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/pesanan', [AdminController::class, 'pesanan']);
    
    // Rute POST untuk menangani perubahan status
    Route::post('/pesanan/update-status', [AdminController::class, 'updateStatus']);
    Route::post('/pesanan/update-pembayaran', [AdminController::class, 'updatePembayaran']);
    
    Route::get('/pembayaran', [AdminController::class, 'pembayaran']);
    Route::get('/grafik', [AdminController::class, 'grafik']);
    Route::get('/lihatpesanan', [AdminController::class, 'lihatPesanan']);
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
    Route::post('/produk/simpan', [ProdukController::class, 'simpan']);
});

Route::get('/owner/pesanan', [PesananController::class, 'index']);
Route::get('/admin/detail-pesanan/{id}', [PesananController::class, 'detail']);
Route::get('/owner/pembayaran', [PembayaranController::class, 'index']);
Route::post('/owner/pembayaran/update', [PembayaranController::class, 'update'])->name('pembayaran.update');
Route::get('/owner/riwayat', [RiwayatController::class, 'index']);

// Pastikan rute ini ada di bagian area owner/admin
Route::prefix('owner')->group(function () {
    // Rute Produk (bisa diakses admin juga jika mereka masuk ke URL ini)
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::post('/produk/simpan', [ProdukController::class, 'simpan']);
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']);
    
    // Rute Hapus (ini yang dilindungi di Controller)
    Route::get('/produk/hapus/{id}', [ProdukController::class, 'hapus']);
});