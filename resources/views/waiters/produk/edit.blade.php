@extends('waiters.template')
@section('content')
    <a href="{{ route('waiters.produk.index') }}" class="btn btn-secondary btn-sm text-white mb-2"><i
            class="fas fa-angles-left"></i>Kembali</a>

    <div class="white-box">
        <h3 class="box-title mb-4">Edit Produk</h3>

        <form id="formEditProduk" action="{{ route('waiters.produk.update', $produk->id) }}" method="post"
            enctype="multipart/form-data">

            @method('PUT')
            @csrf



            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ $produk->nama }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                        </select>
                    </div>


                </div>


            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Produk</button>
        </form>
    </div>

    @push('scripts')
        <script>

        </script>
    @endpush
@endsection