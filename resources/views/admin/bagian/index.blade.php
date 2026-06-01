@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-12">

            <a href="#tambahBagian" data-bs-toggle="modal" class="btn btn-primary btn-sm float-end">
                + Tambah Bagian
            </a>

            <div class="white-box">
                <div class="box-title mb-3">Daftar Bagian</div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Bagian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bagian as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->namabagian }}</td>
                                    <td>
                                        {{-- edit --}}
                                        <a href="{{ route('admin.bagian.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm">
                                            Edit
                                        </a>
                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('admin.bagian.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm text-white"
                                                onclick="confirmDelete({{ $item->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahBagian" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.bagian.store') }}">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Bagian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Bagian</label>
                            <input type="text" name="namabagian" class="form-control" required>
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
