<?php

namespace App\Http\Controllers\Waiters;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{

    public function index()
    {
        return view('waiters.produk.index', [
            'title' => 'Produk',
            'active' => 'Produk',
            'user' => auth()->user(),
            'bagian' => \App\Models\Bagian::all()
        ]);
    }

    public function produkDatatable()
    {
        $query = Produk::query();

        if (request()->has('bagian_id') && request()->bagian_id != '') {
            $query->where('bagian_id', request()->bagian_id);
        }

        return DataTables::of($query)
            ->addIndexColumn()





            ->addColumn('aksi', function ($row) {
                $edit = '<a href="' . route('waiters.produk.edit', $row->id) . '" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>';

                $delete = '
                <form id="delete-form-' . $row->id . '" action="' . route('waiters.produk.destroy', $row->id) . '"
                    method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <button type="button" class="btn btn-danger btn-sm text-white"
                        onclick="confirmDelete(' . $row->id . ')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>';

                return $edit . " " . $delete;
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // if (!hasPermission('produk', 'creaate')) {
        //     return redirect()->back()
        //         ->with('error', 'Anda tidak memiliki izin.');
        // }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required',
            'galeri.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);



        $slug = Str::slug($validated['nama']);
        $cekSlug = Produk::where('slug', $slug)->exists();
        if ($cekSlug) {
            $slug .= '-' . Str::random(5);
        }

        Produk::create([
            'nama' => $validated['nama'],
            'slug' => $slug,
            'kategori' => $validated['kategori'],
            'bagian_id' => auth()->user()->bagian_id,
        ]);

        return redirect()->route('waiters.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        // if (!hasPermission('produk', 'update')) {
        //     return redirect()->back()
        //         ->with('error', 'Anda tidak memiliki izin.');
        // }

        $produk = Produk::findOrFail($id);

        return view('waiters.produk.edit', [
            'title' => 'Produk',
            'active' => 'Edit',
            'produk' => $produk,
            'user' => auth()->user(),
        ]);
    }



    public function update(Request $request, $id)
    {
        // if (!hasPermission('produk', 'update')) {
        //     return redirect()->back()
        //         ->with('error', 'Anda tidak memiliki izin.');
        // }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required',
        ]);

        $produk = Produk::findOrFail($id);

        $slug = Str::slug($validated['nama']);
        $cekSlug = Produk::where('slug', $slug)
            ->where('id', '!=', $produk->id)
            ->exists();

        if ($cekSlug) {
            $slug .= '-' . Str::random(5);
        }



        $produk->update([
            'nama' => $validated['nama'],
            'kategori' => $validated['kategori'],
            'slug' => $slug,
        ]);

        return redirect()->back()
            ->with('success', 'Produk berhasil diperbarui.');
    }



    public function destroy(string $id)
    {
        // if (!hasPermission('produk', 'delete')) {
        //     return redirect()->back()
        //         ->with('error', 'Anda tidak memiliki izin.');
        // }

        $produk = Produk::findOrFail($id);



        $produk->delete();

        return redirect()->route('waiters.produk.index')->with('success', 'Data produk dan galeri terkait berhasil dihapus.');
    }
}
