<?php

use App\Http\Controllers\Admin\BagianController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\MejaController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\WaitersController;
use App\Http\Controllers\Admin\WebsiteController;
use Illuminate\Support\Facades\Route;






Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin');

    Route::resource('/admin/produk', ProdukController::class)->names('admin.produk');
    Route::get('/admin/getproduk', [ProdukController::class, 'produkDatatable'])->name('admin.produk.datatable');
    Route::resource('/admin/galeri', GaleriController::class)->names('admin.galeri');
    Route::resource('/admin/meja', MejaController::class)->names('admin.meja');
    Route::resource('/admin/bagian', BagianController::class)->names('admin.bagian');
    Route::resource('/admin/waiters', WaitersController::class)->names('admin.waiters');

    Route::resource('/admin/customer', CustomerController::class)->names('admin.customer');

    Route::get('/admin/website', [WebsiteController::class, 'index'])->name('admin.website');
    Route::put('/admin/website/update', [WebsiteController::class, 'update'])->name('admin.website.update');

    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi');
    Route::get('/admin/transaksitambah', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
    Route::post('/admin/transaksisimpan', [TransaksiController::class, 'store'])->name('admin.transaksi.store');

    Route::get('/admin/gettransaksi', [TransaksiController::class, 'transaksiDatatable'])->name('admin.gettransaksi');
    Route::get('/admin/transaksidetail/{id}', [TransaksiController::class, 'detail'])->name('admin.transaksidetail');
    Route::post('/admin/transaksidetailstore', [TransaksiController::class, 'detailStore'])->name('admin.transaksi.detail.store');
    Route::put('/admin/transaksidetailupdate/{id}', [TransaksiController::class, 'detailUpdate'])->name('admin.transaksi.detail.update');
    Route::put('/admin/transaksiupdatecatatan/{id}', [TransaksiController::class, 'updateCatatan'])->name('admin.transaksi.updateCatatan');
    Route::delete('/admin/transaksidetaildelete/{id}', [TransaksiController::class, 'detailDelete'])->name('admin.transaksi.detail.delete');
    // Route::put('/admin/transaksiupdatestatus/{id}', [TransaksiController::class, 'updateStatus'])->name('admin.transaksi.updatestatus');
    Route::delete('/admin/transaksidestroy/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksidestroy');
    Route::get('/admin/cetaknota/{id}', [TransaksiController::class, 'cetaknota'])->name('admin.cetaknota');

    Route::get('/admin/get-meja/{bagian_id}', [TransaksiController::class, 'getMeja']);
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin', [DashboardController::class, 'index'])->name('superadmin');

    Route::resource('/superadmin/produk', ProdukController::class)->names('superadmin.produk');
    Route::resource('/superadmin/galeri', GaleriController::class)->names('superadmin.galeri');

    Route::resource('/superadmin/customer', CustomerController::class)->names('superadmin.customer');

    Route::get('/superadmin/website', [WebsiteController::class, 'index'])->name('superadmin.website');
    Route::put('/superadmin/website/update', [WebsiteController::class, 'update'])->name('superadmin.website.update');
});
