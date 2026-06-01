@extends('admin.template')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <h3 class="box-title">Customer</h3>
                <div class="table-responsive">
                    <table id="dataTables" class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer as $w)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $w->nama }}</td>
                                    <td>{{ $w->email }} </td>
                                    <td>{{ $w->nohp }} </td>
                                    <td>
                                        <a href="#detail" type="button" data-bs-toggle="modal" class="btn btn-primary btn-sm"
                                            data-pesan="{{ $w->pesan }}">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if (hasPermission('customer', 'delete'))
                                            <form id="delete-form-{{ $w->id }}"
                                                action="{{ route('admin.customer.destroy', $w->id) }}" method="POST"
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

    <!-- Modal Detail Customer -->
    <div class="modal fade" id="detail" tabindex="-1" data-bs-backdrop="static" aria-labelledby="detailLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailLabel">Detail Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea id="edit-pesan" class="form-control" readonly></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const detailModal = document.getElementById('detail');
        detailModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            const pesan = button.getAttribute('data-pesan');

            detailModal.querySelector('#edit-pesan').value = pesan;
        });
    </script>
@endsection
