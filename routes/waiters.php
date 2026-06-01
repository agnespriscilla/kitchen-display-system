<?php


use App\Http\Controllers\Waiters\DashboardController;
use App\Http\Controllers\Waiters\GaleriController;
use App\Http\Controllers\Waiters\ProdukController;
use App\Http\Controllers\Waiters\TransaksiController;
use Illuminate\Support\Facades\Route;





Route::middleware(['auth', 'role:waiters'])->group(function () {
    Route::get('/waiters', [DashboardController::class, 'index'])->name('waiters');
    Route::resource('/waiters/produk', ProdukController::class)->names('waiters.produk');
    Route::get('/waiters/getproduk', [ProdukController::class, 'produkDatatable'])->name('waiters.produk.datatable');
    Route::resource('/waiters/galeri', GaleriController::class)->names('waiters.galeri');

    Route::get('/waiters/transaksi', [TransaksiController::class, 'index'])->name('waiters.transaksi');
    Route::get('/waiters/transaksitambah', [TransaksiController::class, 'create'])->name('waiters.transaksi.create');
    Route::post('/waiters/transaksisimpan', [TransaksiController::class, 'store'])->name('waiters.transaksi.store');

    Route::get('/waiters/gettransaksi', [TransaksiController::class, 'transaksiDatatable'])->name('waiters.gettransaksi');
    Route::get('/waiters/transaksidetail/{id}', [TransaksiController::class, 'detail'])->name('waiters.transaksidetail');
    Route::post('/waiters/transaksidetailstore', [TransaksiController::class, 'detailStore'])->name('waiters.transaksi.detail.store');
    Route::put('/waiters/transaksidetailupdate/{id}', [TransaksiController::class, 'detailUpdate'])->name('waiters.transaksi.detail.update');
    Route::delete('/waiters/transaksidetaildelete/{id}', [TransaksiController::class, 'detailDelete'])->name('waiters.transaksi.detail.delete');
    Route::put('/waiters/transaksiupdatecatatan/{id}', [TransaksiController::class, 'updateCatatan'])->name('waiters.transaksi.updateCatatan');

    Route::delete('/waiters/transaksidestroy/{id}', [TransaksiController::class, 'destroy'])->name('waiters.transaksidestroy');

    Route::get('/waiters/cetaknota/{id}', [TransaksiController::class, 'cetaknota'])->name('waiters.cetaknota');
});
