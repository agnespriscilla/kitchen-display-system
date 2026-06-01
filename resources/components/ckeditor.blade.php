<div class="mb-3">
    <label for="keterangan" class="form-label">keterangan</label>
    <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
    <script>
        CKEDITOR.replace('keterangan');
    </script>
</div>


<div class="mb-3">
    <label for="edit_keterangan" class="form-label">Keterangan</label>
    <textarea class="form-control" id="edit_keterangan" name="keterangan" rows="4" required></textarea>
    <script>
        CKEDITOR.replace('edit_keterangan');
    </script>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('a[data-bs-toggle="modal"][href="#editVersion"]');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const keterangan = this.dataset.keterangan;
                const file = this.dataset.file;

                const form = document.getElementById('formEditVersion');
                form.action = "{{ url('admin/version') }}/" + id;

                document.getElementById('edit_version').value = nama;

                if (CKEDITOR.instances['edit_keterangan']) {
                    CKEDITOR.instances['edit_keterangan'].setData(keterangan);
                }
            });
        });
    });
</script>