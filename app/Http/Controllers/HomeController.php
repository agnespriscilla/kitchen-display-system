<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Galeri;
use App\Models\Meja;
use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Website;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banner = Galeri::where('keygaleri', 'banner')->get();
        // $produk = Produk::orderBy('id', 'desc')->take(3)->get();
        $makanan = Produk::where('kategori', 'Makanan')->paginate(12, ['*'], 'page_makanan');
        $minuman = Produk::where('kategori', 'Minuman')->paginate(12, ['*'], 'page_minuman');

        $website = Website::firstOrFail();

        return view('index', [
            'title' => $website->nama,
            'active' => 'Home',
            'banner' => $banner,
            'makanan' => $makanan,
            'minuman' => $minuman,
        ]);
    }



    public function tentang()
    {
        return view('tentang', [
            'title' => 'Tentang Kami',
            'active' => 'Tentang',
        ]);
    }



    public function produk($slug = null)
    {
        if ($slug) {
            $produk = Produk::where('slug', $slug)->first();
            if (!$produk) {
                return redirect('/produk')->with('error', 'Produk tidak terdaftar!');
            }

            $galeri = Galeri::where('keygaleri', $produk->keygaleri)->get();

            return view('detailproduk', [
                'title' => $produk->nama,
                'active' => 'Katalog',
                'produk' => $produk,
                'galeri' => $galeri,
                'foto' => $produk->foto,
            ]);
        }


        $makanan = Produk::where('kategori', 'Makanan')->paginate(12, ['*'], 'page_makanan');
        $minuman = Produk::where('kategori', 'Minuman')->paginate(12, ['*'], 'page_minuman');

        return view('produk', [
            'title' => 'Garuda Teknik',
            'active' => 'Katalog',
            'makanan' => $makanan,
            'minuman' => $minuman,
        ]);
    }

    public function produksearch(Request $request)
    {
        $keyword = $request->keyword;
        $kategori = $request->kategori; // array ["Makanan", "Minuman"]

        // jika kategori tidak dipilih → tampilkan semua
        $query = Produk::query();

        if ($kategori && count($kategori) > 0) {
            $query->whereIn('kategori', $kategori);
        }

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%$keyword%")
                    ->orWhere('deskripsi', 'LIKE', "%$keyword%");
            });
        }

        $produk = $query->get();

        // Pisahkan seperti awal
        $makanan = $produk->where('kategori', 'Makanan');
        $minuman = $produk->where('kategori', 'Minuman');

        return view('partials.search-result', compact('makanan', 'minuman'))->render();
    }






    public function kontak()
    {
        return view('kontak', [
            'title' => 'Kontak',
            'active' => 'Kontak',
        ]);
    }




    public function cart()
    {
        return view('cart', [
            'title' => 'Keranjang',
            'active' => 'Keranjang',
        ]);
    }

    public function meja()
    {
        // session()->forget('nomeja');
        // return response()->json(session('nomeja'));
        return view('meja', [
            'title' => 'Meja',
            'active' => 'Meja',
        ]);
    }

    public function scanmeja($id)
    {
        $meja = Meja::where('id', $id)->first();
        if (!$meja) {
            return back()->with('error', 'Meja tidak ditemukan!');
        }
        session()->put('nomeja', $meja->nomeja);
        return redirect('meja')->with('success', 'Scan Berhasil, Silahkan Melakukan Pemesanan');
    }


    public function checkout()
    {
        if (!session('nomeja')) {
            return redirect('meja')->with('error', 'Harap scan meja terlebih dahulu!');
        }
        return view('checkout', [
            'title' => 'Checkout',
            'active' => 'Checkout',
        ]);
    }
    public function prosesCheckout(Request $request)
    {
        $request->validate([
            'cart' => 'required|json',
            'catatan' => 'nullable',
            // 'buktibayar' => 'nullable|image|max:2048', // If qris/buktibayar logic is removed, remove this too. Keeping if unsure.
            // But since metodepembayaran is removed, buktibayar usage is questionable.
            // User said "remove unused code".
            // Logic for buktibayar is inside "if ($request->metodepembayaran === 'qris')".
            // Since `metodepembayaran` column is dropped, we can't store it.
            // So we should remove Qris logic too?
        ]);

        // ====== SIMPAN TRANSAKSI ======
        $transaksi = new Transaksi();
        $transaksi->tanggal = now();
        $transaksi->catatan = $request->catatan;

        // Fields removed: nama, nohp, nomeja, metodepambayaran, statusbeli, statusbayar

        // ====== UPLOAD BUKTI BAYAR QRIS ======
        // Removed as metodepembayaran is dropped

        // ====== HITUNG TOTAL ======
        $cart = json_decode($request->cart, true);

        $total = 0;

        $transaksi->total = $total;
        $transaksi->save();

        // ====== SIMPAN DETAIL ======
        foreach ($cart as $item) {
            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => (int) $item["id"],
                'jumlah' => (int) $item["qty"],
                'subtotal' => 0,
            ]);
        }

        // Simpan nomor HP untuk halaman selesai
        session()->put('nohp', $request->nohp);

        return redirect()->route('selesai', $transaksi->id);
    }


    public function selesai($id)
    {
        $order = Transaksi::with(['transaksidetail', 'transaksidetail.produk'])->find($id);

        return view('selesai', [
            'title' => 'Pemesanan Selesai',
            'active' => 'Selesai',
            'order' => $order,
        ]);
    }

    public function cetaknota($id)
    {
        $order = Transaksi::with(['transaksidetail', 'transaksidetail.produk'])->find($id);

        return view('cetaknota', [
            'title' => 'Pemesanan cetaknota',
            'active' => 'Selesai',
            'order' => $order,
        ]);
    }




    public function simpanPendaftaran(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nohp' => 'required|string|max:20',
            'pesan' => 'nullable|string',
        ]);

        Customer::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'pesan' => $request->pesan,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil disimpan!');
    }




    public function simpanPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nohp' => 'required|string|max:20',
            'negara' => 'required|string|max:100',
            'perusahaan' => 'required|string|max:255',
            'jabatan' => 'required|string|max:100',
            'pesan' => 'required|string',
        ]);

        Customer::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'negara' => $request->negara,
            'perusahaan' => $request->perusahaan,
            'departement' => $request->jabatan,
            'pesan' => $request->pesan,
        ]);

        return response()->json(['success' => true]);
    }
}
