@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-12">

            <a href="#tambahWaiters" data-bs-toggle="modal" class="btn btn-primary btn-sm float-end">
                + Tambah Waiters
            </a>

            <div class="white-box">
                <div class="box-title mb-3">Daftar Waiters</div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Bagian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($waiters as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->bagian->namabagian ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.waiters.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.waiters.destroy', $item->id) }}" method="POST"
                                            style="display:inline;" onsubmit="return confirm('Hapus waiters ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
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
    <!-- Modal Tambah Waiters -->
    <div class="modal fade" id="tambahWaiters" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.waiters.store') }}">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Waiters</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Bagian</label>
                            <select name="bagian_id" class="form-control" required>
                                <option value="">-- Pilih Bagian --</option>
                                @foreach ($bagian as $b)
                                    <option value="{{ $b->id }}">{{ $b->namabagian }}</option>
                                @endforeach
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
