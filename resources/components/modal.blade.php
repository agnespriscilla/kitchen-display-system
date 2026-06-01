<!-- Modal Tambah Afiliasi -->
<div class="modal fade" id="tambahAfiliasi" tabindex="-1" data-bs-backdrop="static" aria-labelledby="tambahAfiliasiLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAfiliasiLabel">Tambah Afiliasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.afiliasi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="daerah" class="form-label">Daerah</label>
                        <input type="text" class="form-control" id="daerah" name="daerah" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Afiliator -->
<div class="modal fade" id="editAfiliasi" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editAfiliasiLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Afiliator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="formeditAfiliasi" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_daerah" class="form-label">Daerah</label>
                        <input type="text" class="form-control" id="edit_daerah" name="daerah" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('a[data-bs-toggle="modal"][href="#editAfiliasi"]');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const daerah = this.dataset.daerah;

                const form = document.getElementById('formeditAfiliasi');
                form.action = "{{ url('admin/afiliasi') }}/" + id;

                document.getElementById('edit_nama').value = nama;
                document.getElementById('edit_daerah').value = daerah;
            });
        });
    });
</script>