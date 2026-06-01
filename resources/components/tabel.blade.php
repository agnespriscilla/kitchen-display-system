<div class="row">
    <div class="col-12">
        <a href="#tambahSekolah" type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm float-end">+
            Sekolah</a>
        <div class="white-box">
            <div class="box-title mb-3">Sekolah Terdaftar</div>

            <div class="table-responsive">
                <table id="dataTables" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sekolah</th>
                            <th>Paket</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sekolah as $s)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $s->nama }}</td>
                            <td class="text-capitalize">{{ $s->namaPaket }} </td>
                            <td class="text-capitalize">{{ $s->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                            <td>
                                <a href="#editSekolah" type="button" data-bs-toggle="modal"
                                    class="btn btn-warning btn-sm" data-id="{{ $s->id }}"
                                    data-nama="{{ $s->nama }}" data-link="{{ $s->link }}"
                                    data-paket="{{ $s->paket }}" data-afiliasi="{{ $s->idAfiliasi }}"
                                    data-tampil="{{ $s->tampil }}" data-status="{{ $s->status }}"
                                    data-update="{{ $s->update_version }}" data-gambar="{{ $s->gambar }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.sekolah.destroy', $s->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?');">
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


<!-- Modal Tambah Sekolah -->
<div class="modal fade" id="tambahSekolah" tabindex="-1" data-bs-backdrop="static" aria-labelledby="tambahSekolahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="formTambahSekolah" method="POST" action="{{ route('admin.sekolah.store') }}"
            enctype="multipart/form-data">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahSekolahLabel">Tambah Data Sekolah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Sekolah</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Link</label>
                                <input type="text" class="form-control" name="link" id="link" required>
                            </div>

                            <div class="mb-3">
                                <label for="paket" class="form-label">Paket</label>
                                <select class="form-select" name="paket" id="paket" required>
                                    @foreach ($paket as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="masaAktif" class="form-label">Masa Aktif</label>
                                <select class="form-select" name="masaAktif" id="masaAktif" required>
                                    <option value="Seumur Hidup">Seumur Hidup</option>
                                    <option value="1 Tahun">1 Tahun</option>
                                    <option value="6 Bulan">6 Bulan</option>
                                    <option value="3 Bulan">3 Bulan</option>
                                    <option value="1 Bulan">1 Bulan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="afiliasi" class="form-label">Affiliator</label>
                                <select class="form-select" name="afiliasi" id="afiliasi">
                                    <option value="">Tidak ada</option>
                                    @foreach ($afiliasi as $a)
                                    <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="update" class="form-label">Update</label>
                                <select class="form-select" name="update" id="update" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tampil" class="form-label">Tampil di Landing Page?</label>
                                <select class="form-select" name="tampil" id="tampil" required>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Sekolah</label><br>
                                <input type="file" class="form-control" name="gambar" id="gambar" required>
                            </div>
                        </div>
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


<!-- Modal Edit Sekolah -->
<div class="modal fade" id="editSekolah" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="editSekolahLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="formEditSekolah" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSekolahLabel">Edit Data Sekolah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="edit-id">

                    <center>
                        <img id="preview-gambar" src="" alt="Gambar Sekolah" class="img-fluid mb-2"
                            style="max-height: 120px;">
                    </center>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-nama" class="form-label">Nama Sekolah</label>
                                <input type="text" class="form-control" name="nama" id="edit-nama" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit-link" class="form-label">Link</label>
                                <input type="text" class="form-control" name="link" id="edit-link">
                            </div>

                            <div class="mb-3">
                                <label for="edit-paket" class="form-label">Paket</label>
                                <select class="form-select" name="paket" id="edit-paket">
                                    @foreach ($paket as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit-afiliasi" class="form-label">Affiliator</label>
                                <select class="form-select" name="afiliasi" id="edit-afiliasi">
                                    @foreach ($afiliasi as $a)
                                    <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit-update" class="form-label">Update</label>
                                <select class="form-select" name="update" id="edit-update">
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit-tampil" class="form-label">Tampil di Landing Page?</label>
                                <select class="form-select" name="tampil" id="edit-tampil">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit-status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="edit-status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit-gambar" class="form-label">Gambar Sekolah</label><br>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                        </div>
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