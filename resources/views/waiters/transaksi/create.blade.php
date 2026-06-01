@extends('waiters.template')

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="white-box">

                <h4 class="mb-3">Tambah Transaksi</h4>

                <form method="POST" action="{{ route('waiters.transaksi.store') }}">
                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <input type="hidden" name="bagian_id" id="bagian_id" value="{{ auth()->user()->bagian_id }}">

                        <div class="col-md-12 mb-3">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3"></textarea>
                        </div>

                        <hr>

                        <h5 class="mt-4">Produk yang Dibeli</h5>

                        <table class="table table-bordered" id="produkTable">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th width="120px">Jumlah</th>
                                    <th width="80px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="produk_id[]" class="form-control select2" required>
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach ($produk as $p)
                                                <option value="{{ $p->id }}">
                                                    {{ $p->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="jumlah[]" min="1" class="form-control" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm addRow">+</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="col-md-12 mt-3">
                            <button class="btn btn-primary">Simpan Transaksi</button>
                            <a href="{{ route('waiters.transaksi') }}" class="btn btn-secondary">Kembali</a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {

            // tambah baris
            $(document).on('click', '.addRow', function () {
                let row = `
                                        <tr>
                                            <td>
                                                <select name="produk_id[]" class="form-control select2" required>
                                                    <option value="">-- Pilih Produk --</option>
                                                    @foreach ($produk as $p)
                                                        <option value="{{ $p->id }}">
                                                            {{ $p->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah[]" min="1" class="form-control" required>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm removeRow">x</button>
                                            </td>
                                        </tr>
                                    `;

                $('#produkTable tbody').append(row);

                // 🔥 RE-INIT SELECT2 untuk row baru
                $('#produkTable tbody tr:last .select2').select2();
            });

            // hapus baris
            $(document).on('click', '.removeRow', function () {
                $(this).closest('tr').remove();
            });

        });
    </script>
@endsection