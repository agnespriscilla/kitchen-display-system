<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class BagianController extends Controller
{

    public function index()
    {
        $bagian = Bagian::all();

        return view('admin.bagian.index', [
            'title'  => 'Bagian',
            'active' => 'Bagian',
            'bagian'   => $bagian,
            'user'   => auth()->user()
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'namabagian' => 'required|string|max:100'
        ]);

        // 1. Simpan sementara tanpa qrcode
        $bagian = Bagian::create([
            'namabagian' => $validated['namabagian'],
        ]);

        return redirect()->route('admin.bagian.index')
            ->with('success', 'bagian berhasil ditambahkan.');
    }



    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        // if (!hasPermission('bagian', 'update')) {
        //     return redirect()->back()
        //         ->with('error', 'Anda tidak memiliki izin.');
        // }

        $bagian = Bagian::findOrFail($id);

        return view('admin.bagian.edit', [
            'title' => 'Bagian',
            'active' => 'Edit',
            'bagian' => $bagian,
            'user' => auth()->user(),
        ]);
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'namabagian' => 'required|string|max:100'
        ]);

        $bagian = Bagian::findOrFail($id);

        $bagian->update([
            'namabagian' => $validated['namabagian']
        ]);

        return redirect()->route('admin.bagian.index')
            ->with('success', 'bagian berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $bagian = Bagian::findOrFail($id);

        // Hapus data bagian
        $bagian->delete();

        return redirect()->route('admin.bagian.index')->with('success', 'Data bagian dan galeri terkait berhasil dihapus.');
    }
}
