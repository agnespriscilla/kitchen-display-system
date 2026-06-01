<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $produk = Produk::count();

        return view('admin.dashboard', [
            'title' => 'Dashboard Admin',
            'active' => 'Dashboard',
            'produk' => $produk,
            'user' => auth()->user(),
        ]);
    }
}
