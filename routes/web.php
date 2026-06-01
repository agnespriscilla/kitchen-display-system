<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/', [HomeController::class, 'index']);

Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');


Route::get('/meja', [HomeController::class, 'meja'])->name('meja');
Route::get('/scan-meja/{id}', [HomeController::class, 'scanmeja'])->name('scanmeja');
Route::get('/produk', [HomeController::class, 'produk'])->name('produk');
Route::get('/produk/{slug}', [HomeController::class, 'produk'])->name('produk.detail');
Route::get('/produk-search', [HomeController::class, 'produksearch'])->name('produk.search');
Route::get('/cetaknota/{id}', [HomeController::class, 'cetaknota']);


Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

Route::get('/selesai/{id}', [HomeController::class, 'selesai'])->name('selesai');

Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/prosesCheckout', [HomeController::class, 'prosesCheckout'])->name('prosesCheckout');

Route::post('/simpanPendaftaran', [HomeController::class, 'simpanPendaftaran'])->name('simpanPendaftaran');
Route::post('/simpanPesan', [HomeController::class, 'simpanPesan'])->name('simpanPesan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';

require __DIR__ . '/waiters.php';
