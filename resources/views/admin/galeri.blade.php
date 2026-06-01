@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-12">
            @if (hasPermission('galeri', 'create'))
                <a href="#tambahGaleri" type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm float-end">+
                    Banner</a>
            @endif
            <div class="white-box">
                <h3 class="box-title">Banner</h3>
                <div class="table-responsive">
                    <table id="dataTables" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($galeri as $w)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>
                                        <img src="{{ asset('uploads/galeri/' . $w->gambar) }}" alt="Gambar"
                                            width="150">
                                    </td>
                                    <td>{{ $w->judul }}</td>
                                    <td>{{ $w->keterangan }} </td>
                                    <td>
                                        <a href="#editGaleri" type="button" data-bs-toggle="modal"
                                            class="btn btn-warning btn-sm" data-id="{{ $w->id }}"
                                            data-judul="{{ $w->judul }}" data-keterangan="{{ $w->keterangan }}"
                                            data-gambar="{{ $w->gambar }}"><i class="fas fa-edit"></i></a>

                                        @if ($w->id != 3)
                                            <form id="delete-form-{{ $w->id }}"
                                                action="{{ route('admin.galeri.destroy', $w->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm text-white"
                                                    onclick="confirmDelete({{ $w->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Galeri -->
    <div class="modal fade" id="tambahGaleri" data-bs-backdrop="static" tabindex="-1" aria-labelledby="tambahGaleriLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahGaleriLabel">Tambah Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal Edit Galeri -->
    <div class="modal fade" id="editGaleri" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editGaleriLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-edit-galeri" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit-id">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGaleriLabel">Edit Galeri</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit-judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="edit-judul" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-keterangan" class="form-label">Keterangan</label>
                            <input type="text" name="keterangan" id="edit-keterangan" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-gambar" class="form-label">Gambar Baru (opsional)</label>
                            <input type="file" name="gambar" id="edit-gambar" class="form-control">
                            <img id="gambar-preview" alt="Gambar Saat Ini" class="img-thumbnail mt-2" width="100">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const editModal = document.getElementById('editGaleri');
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            const id = button.getAttribute('data-id');
            const judul = button.getAttribute('data-judul');
            const keterangan = button.getAttribute('data-keterangan');
            const gambar = button.getAttribute('data-gambar');

            const form = document.getElementById('form-edit-galeri');
            form.action = "{{ url('admin/galeri') }}/" + id;

            editModal.querySelector('#edit-id').value = id;
            editModal.querySelector('#edit-judul').value = judul;
            editModal.querySelector('#edit-keterangan').value = keterangan;
            editModal.querySelector('#gambar-preview').src = "{{ asset('uploads/galeri') }}/" + gambar;
        });
    </script>
@endsection
