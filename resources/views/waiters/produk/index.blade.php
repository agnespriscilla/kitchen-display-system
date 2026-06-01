@extends('waiters.template')

@section('content')
    <div class="row">
        <div class="col-12">

            <a href="#tambahProduk" type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm float-end">
                + Tambah Produk
            </a>

            <div class="white-box">
                <div class="box-title mb-3">Daftar Produk</div>

                <!-- Bagian Tabs -->
                <ul class="nav nav-tabs mb-3" id="bagianTabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-bagian="">Semua</a>
                    </li>
                    @foreach($bagian as $bg)
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bagian="{{ $bg->id }}">{{ $bg->namabagian }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="table-responsive">
                    <table id="dataTables" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="tambahProduk" tabindex="-1" data-bs-backdrop="static" aria-labelledby="tambahProdukLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="formtambahProduk" method="POST" action="{{ route('waiters.produk.store') }}"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahProdukLabel">Tambah Data Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                            </select>
                        </div>







                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

    {{-- DataTables --}}
    <script>
        $(document).ready(function () {
            var table = $('#dataTables').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('waiters/getproduk') }}",
                    data: function (d) {
                        d.bagian_id = $('#bagianTabs .nav-link.active').data('bagian');
                    }
                },
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama'
                },

                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false
                }
                ]
            });

            // Handle Tab Click
            $('#bagianTabs .nav-link').on('click', function (e) {
                e.preventDefault();
                $('#bagianTabs .nav-link').removeClass('active');
                $(this).addClass('active');
                table.draw();
            });
        });
    </script>
@endsection