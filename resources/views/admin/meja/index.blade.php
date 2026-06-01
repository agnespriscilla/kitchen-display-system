@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-12">

            {{-- TAB NAVIGATION --}}
            <ul class="nav nav-tabs mb-3">

                {{-- TAB SEMUA --}}
                <li class="nav-item">
                    <a class="nav-link {{ empty($bagianAktif) ? 'active' : '' }}" href="{{ route('admin.meja.index') }}">
                        Semua
                    </a>
                </li>

                {{-- TAB PER BAGIAN --}}
                @foreach ($bagian as $b)
                    <li class="nav-item">
                        <a class="nav-link {{ $bagianAktif == $b->id ? 'active' : '' }}"
                            href="{{ route('admin.meja.index', ['bagian_id' => $b->id]) }}">
                            {{ $b->namabagian }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- TOMBOL TAMBAH MEJA --}}
            <a href="#tambahMeja" data-bs-toggle="modal" class="btn btn-primary btn-sm float-end mb-2">
                + Tambah Meja
            </a>

            <div class="white-box">
                <div class="box-title mb-3">Daftar Meja</div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTables">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Nama Meja</th>
                                <th>Bagian</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($meja as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->namameja }}</td>
                                    <td>{{ $item->bagian->namabagian ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.meja.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ route('admin.meja.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
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

    {{-- MODAL TAMBAH MEJA --}}
    <div class="modal fade" id="tambahMeja" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.meja.store') }}">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Meja</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        {{-- NAMA MEJA --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Meja</label>
                            <input type="text" name="namameja" class="form-control" required>
                        </div>

                        {{-- PILIH BAGIAN --}}
                        <div class="mb-3">
                            <label class="form-label">Bagian</label>
                            <select name="bagian_id" class="form-control" required>
                                <option value="">-- Pilih Bagian --</option>
                                @foreach ($bagian as $b)
                                    <option value="{{ $b->id }}" {{ $bagianAktif == $b->id ? 'selected' : '' }}>
                                        {{ $b->namabagian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-success">
                            Simpan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
