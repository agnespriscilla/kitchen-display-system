@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="white-box">

                <h4 class="mb-3">Detail Transaksi #{{ $transaksi->id }}</h4>




                {{-- INFORMASI TRANSAKSI --}}
                <table class="table table-bordered">

                    <tr>
                        <th>Tanggal</th>
                        <td>{{ $transaksi->tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Bagian</th>
                        <td>{{ $transaksi->bagian->namabagian }}</td>
                    </tr>


                    <tr>
                        <th>Catatan</th>
                        <td>
                            <form action="{{ route('admin.transaksi.updateCatatan', $transaksi->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <textarea name="catatan" class="form-control mb-2" rows="3">{{ $transaksi->catatan }}</textarea>

                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-save"></i> Update
                                </button>
                            </form>
                        </td>
                    </tr>

                </table>


                {{-- CRUD PRODUK --}}
                <h5 class="mt-4">Produk dalam Transaksi</h5>

                {{-- FORM TAMBAH --}}
                <form class="row g-2 mb-3" method="POST" action="{{ route('admin.transaksi.detail.store') }}">
                    @csrf

                    <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">

                    <div class="col-md-5">
                        <select name="produk_id" class="form-control select2" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach (App\Models\Produk::all() as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="number" name="jumlah" class="form-control" placeholder="Qty" min="1" required>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Tambah</button>
                    </div>
                </form>


                {{-- TABLE PRODUK --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi->transaksidetail as $d)
                            <tr>
                                <td>{{ $d->produk->nama }}</td>

                                <td>
                                    <form method="POST" action="{{ route('admin.transaksi.detail.update', $d->id) }}"
                                        class="d-flex">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="jumlah" class="form-control"
                                            value="{{ $d->jumlah }}" min="1" style="width: 80px;">
                                        <button class="btn btn-warning btn-sm ms-1">Ubah</button>
                                    </form>
                                </td>



                                <td>
                                    <form action="{{ route('admin.transaksi.detail.delete', $d->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                {{-- BUKTI BAYAR --}}
                {{-- <h5 class="mt-4">Bukti Pembayaran</h5>

                @if ($transaksi->buktibayar)
                    <img src="{{ asset('uploads/bukti/' . $transaksi->buktibayar) }}" class="img-fluid mb-3"
                        style="max-width:300px;">
                @else
                    <p class="text-muted">Tidak ada bukti pembayaran.</p>
                @endif --}}




            </div>

        </div>
    </div>
@endsection
