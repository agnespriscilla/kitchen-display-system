@extends('admin.template')

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="white-box">
                <div class="box-title mb-3">Edit Meja</div>

                {{-- FORM EDIT --}}
                <form method="POST" action="{{ route('admin.meja.update', $meja->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- NAMA MEJA --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Meja</label>
                        <input type="text" name="namameja" class="form-control @error('namameja') is-invalid @enderror"
                            value="{{ old('namameja', $meja->namameja) }}" required>

                        @error('namameja')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PILIH BAGIAN --}}
                    <div class="mb-3">
                        <label class="form-label">Bagian</label>
                        <select name="bagian_id" class="form-control @error('bagian_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Bagian --</option>
                            @foreach ($bagian as $b)
                                <option value="{{ $b->id }}"
                                    {{ old('bagian_id', $meja->bagian_id) == $b->id ? 'selected' : '' }}>
                                    {{ $b->namabagian }}
                                </option>
                            @endforeach
                        </select>

                        @error('bagian_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- TOMBOL --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.meja.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                        <button type="submit" class="btn btn-success">
                            Update
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
@endsection
