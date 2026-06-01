@extends('admin.template')

@section('content')
    <a href="{{ route('admin.bagian.index') }}" class="btn btn-secondary btn-sm text-white mb-2">
        <i class="fas fa-angles-left"></i> Kembali
    </a>

    <div class="white-box">
        <h3 class="box-title mb-4">Edit Bagian</h3>

        <form id="formEditBagian" action="{{ route('admin.bagian.update', $bagian->id) }}" method="post">
            @method('PUT')
            @csrf

            <div class="form-group mb-3">
                <label for="namabagian" class="form-label">Nama Bagian</label>
                <input type="text" name="namabagian" id="namabagian" class="form-control"
                    value="{{ $bagian->namabagian }}" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Bagian
            </button>
        </form>
    </div>
@endsection
