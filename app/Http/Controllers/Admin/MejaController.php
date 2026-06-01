<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Galeri;
use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\Facades\DataTables;

class MejaController extends Controller
{

    public function index(Request $request)
    {
        $query = Meja::with('bagian')->orderBy('id', 'DESC');

        // filter berdasarkan bagian
        if ($request->filled('bagian_id')) {
            $query->where('bagian_id', $request->bagian_id);
        }

        return view('admin.meja.index', [
            'title'        => 'Meja',
            'active'       => 'Meja',
            'meja'         => $query->get(),
            'bagian'       => Bagian::all(),
            'bagianAktif'  => $request->bagian_id,
            'user'         => auth()->user(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'namameja'  => 'required|string|max:100',
            'bagian_id' => 'required|exists:bagian,id'
        ]);

        Meja::create($validated);

        return back()->with('success', 'Meja berhasil ditambahkan.');
    }



    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {

        $meja = Meja::findOrFail($id);
        $bagian = Bagian::all();

        return view('admin.meja.edit', [
            'title' => 'Meja',
            'active' => 'Edit',
            'meja' => $meja,
            'bagian' => $bagian,
            'user' => auth()->user(),
        ]);
    }



    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'namameja' => 'required|string|max:100',
            'bagian_id' => 'required|exists:bagian,id'
        ]);

        $meja = Meja::findOrFail($id);

        $meja->update([
            'namameja' => $validated['namameja'],
            'bagian_id' => $validated['bagian_id']
        ]);

        return redirect()->route('admin.meja.index')
            ->with('success', 'meja berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $meja = Meja::findOrFail($id);

        // Hapus data meja
        $meja->delete();

        return redirect()->route('admin.meja.index')->with('success', 'Data meja dan galeri terkait berhasil dihapus.');
    }
}
