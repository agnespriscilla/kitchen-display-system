<?php

namespace App\Http\Controllers\Waiters;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Meja;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::with([
            'transaksidetail',
            'transaksidetail.produk',
            'bagian'
        ])
            ->orderBy('id', 'DESC')
            ->where('bagian_id', Auth::user()->bagian_id);

        if ($request->filled('bagian_id')) {
            $query->where('bagian_id', Auth::user()->bagian_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                // $q->where('nama', 'like', "%{$search}%"); // Columns removed
            });
        }

        $transaksi = $query->paginate(9)->withQueryString();

        return view('waiters.transaksi.index', [
            'title' => 'Transaksi',
            'active' => 'Transaksi',
            'user' => auth()->user(),
            'transaksi' => $transaksi,
            'bagian' => \App\Models\Bagian::all(),
            'bagianAktif' => $request->bagian_id,
            'search' => $request->search
        ]);
    }

    public function detail($id)
    {
        $data['transaksi'] = Transaksi::with(['transaksidetail', 'transaksidetail.produk', 'bagian'])->find($id);
        $data['title'] = 'Detail Transaksi';
        $data['active'] = 'Transaksi';
        $data['user'] = auth()->user();

        return view('waiters.transaksi.detail', $data);
    }

    public function cetaknota($id)
    {
        $data['transaksi'] = Transaksi::with(['transaksidetail', 'transaksidetail.produk', 'bagian'])->find($id);
        $data['user'] = auth()->user();

        return view('waiters.transaksi.cetaknota', $data);
    }

    public function detailStore(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required',
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $produk = Produk::find($request->produk_id);

        TransaksiDetail::create([
            'transaksi_id' => $request->transaksi_id,
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'subtotal' => 0
        ]);

        // update total
        $this->updateTotal($request->transaksi_id);

        return back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function detailUpdate(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1'
        ]);

        $detail = TransaksiDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = 0;
        $detail->save();

        $this->updateTotal($detail->transaksi_id);

        return back()->with('success', 'Jumlah berhasil diubah');
    }

    public function updateCatatan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string'
        ]);

        $transaksi = Transaksi::find($id);
        $transaksi->catatan = $request->catatan;
        $transaksi->save();

        return back()->with('success', 'Catatan berhasil diperbarui');
    }

    public function detailDelete($id)
    {
        $detail = TransaksiDetail::find($id);

        $transaksiId = $detail->transaksi_id;

        $detail->delete();

        $this->updateTotal($transaksiId);

        return back()->with('success', 'Produk berhasil dihapus');
    }

    private function updateTotal($transaksiId)
    {
        $total = TransaksiDetail::where('transaksi_id', $transaksiId)->sum('subtotal');

        Transaksi::where('id', $transaksiId)->update(['total' => $total]);
    }

    public function create()
    {
        $data['title'] = 'Tambah Transaksi';
        $data['active'] = 'Transaksi';
        $data['user'] = auth()->user();

        $data['produk'] = Produk::all();
        $data['bagian'] = Bagian::all();


        return view('waiters.transaksi.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'bagian_id' => 'required',
            'produk_id' => 'required|array',
            'jumlah' => 'required|array',
        ]);

        // hitung total
        $total = 0;
        foreach ($request->produk_id as $index => $pid) {
            $qty = $request->jumlah[$index];
            $total = 0;
        }

        // simpan transaksi
        $transaksi = Transaksi::create([
            'tanggal' => $request->tanggal,
            'bagian_id' => $request->bagian_id,
            'catatan' => $request->catatan,
            'total' => $total,
        ]);

        // simpan detail
        foreach ($request->produk_id as $index => $pid) {
            $qty = $request->jumlah[$index];

            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $pid,
                'jumlah' => $qty,
                'subtotal' => 0,
            ]);
        }

        return redirect()->route('waiters.transaksi')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        TransaksiDetail::where('transaksi_id', $id)->delete();
        $transaksi->delete();
        return redirect()->route('waiters.transaksi')->with('success', 'Transaksi berhasil dihapus');
    }
}
